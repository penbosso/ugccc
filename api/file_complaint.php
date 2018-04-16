<?php 
/* purpose: this returns the available time slots for a successfully assigned counsellor
            or a success message in case counsellor is not found
            
    Status codes => their meaning
        0        => counsellor assigned successfully
        1        => invalid REQUEST_METHOD
        2        => invalid student details
        3        => failed to file complaint
        4        => no counsellor assigned
*/

//including contants definition file
include('../includes/initialize.php');

//return the data in JSON format 
header("Content-Type: application/json");



//check if the request method to this file is post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //initialize a response for the request
    $response = array();

    //confirm if student is registered
    $student_id = isset($_POST["student_id"]) ? trim($_POST["student_id"]) : "";
    $password = isset($_POST["password"]) ? trim($_POST["password"]) : "";
    $sql = "SELECT * FROM student WHERE student_id='$student_id' AND password='$password'";
    $result = Student::find_by_sql($sql);
    $student = array_shift($result);

    //check record was found
    if(!$student){
        //if not found
        echo json_encode(array("status"=>2, "message"=>"invalid student details"));
        exit;
    } else {
        //if found
        //echo json_encode(array("status"=>1, "message"=>"valid student details"));

        //create new complaint
        $complaint = new complaint();
        //fetch complaint details
        $complaint->stressor = isset($_POST["stressor"]) ? trim($_POST["stressor"]) : "";
        $complaint->short_desc = isset($_POST["short_desc"]) ? trim($_POST["short_desc"]) : "";
        $complaint->student_id = $student->id;
        $complaint->date_logged = mysql_date_format(time());
        $complaint->date_couns_started = null;
        $complaint->date_couns_ended = null;

        //check if complaint saved successfully
        if($complaint->save()){
            //if complaint saved then find a counsellor for the given stressor
            $sql = "SELECT cs.* FROM speciality s JOIN counsellor_speciality cs ON " 
                 . "cs.speciality_id=s.id WHERE s.name LIKE '{$complaint->stressor}'";
            //get all the counsellors with speciality in the given stressor
            $counsellor_specialities = CounsellorSpeciality::find_by_sql($sql);
            //finds and the  id of a system selected counsellor 
            $selected_counsellor = Counsellor::get_selected_counsellor($counsellor_specialities);

            if($selected_counsellor){
                //create and save counsellor assignment
                $assign_counsellor = new AssignCounsellor();
                $assign_counsellor->counsel_id = $selected_counsellor;
                $assign_counsellor->date_assigned = strftime("%Y-%m-%d", time());
                $assign_counsellor->complaint_id = $complaint->id;
                $assign_counsellor->save();
                //get the available booking for the given counsellor
                $available_booking = Counsellor::get_available_booking($selected_counsellor);
                //return response
                echo json_encode(array("status"=>0, "message"=>"counsellor assigned successfully", 
                                        "available_booking" => $available_booking, 
                                        "assign_counsellor_id" => $assign_counsellor->id));
                exit;     
            } else {
                //return response
                echo json_encode(array("status"=>4, "message"=>"no counsellor assigned"));
                exit;  
            }
           
        } else {
            //if saving failed
            echo json_encode(array("status"=>3, "message"=>"failed to file complaint"));
            exit;
        }
    }

} else {
    //indicate error
    echo json_encode(array("status" => 1, "message" => "operation failed: expect the REQUEST_METHOD to be POST"));
}


?>