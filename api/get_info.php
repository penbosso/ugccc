<?php 
/* purpose:this page returns a list of announcements

*/

//including contants definition file
include('../includes/initialize.php');

//return the data in JSON format 
header("Content-Type: application/json");

//check if the request method to this file is get
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    //initialize a response for the request
    $response = array();

    //check for the type of information requested
    if( $_GET['info_type'] == 'announcement'){  //case announcement requested
        //get last date of announcementon the device
        $last_date = isset($_GET['date'])?$_GET['date']:'';

        //check if last date was provided
        if ($last_date != ''){
            //if provided, fetch announcements published after last date
            $sql = "SELECT * FROM announcement WHERE date_created>'$last_date'";  
        } else {
            //else fetch all annnouncements
            $sql = "SELECT * FROM announcement";
        }
        
        //get a list of all registered personnel
        $announcements = Announcement::find_by_sql($sql);

        //forming response
        $response['status'] = "0";
        //check if announcements not 0
        if(count($announcements) != 0){ //case count of announcements greater than 0
            //add success message to response
            $response['message'] = "operation successfull";
            foreach($announcements as $announcement){
                //adding individual announcements
                $response['announcements'][] = get_object_vars($announcement); 
            }
        } else {    //case count of announcements equals 0
            //add no new announcements found
            $response['message'] = "no new announcements found";
        }
            
        echo json_encode($response);
    } else {    //other info requested
        echo json_encode(array("status" => 1, "message" => "no method defined for the info_type=".$_GET['info_type']));
    }

} else {
    //indicate error
    echo json_encode(array("status" => 1, "message" => "operation failed: expect the REQUEST_METHOD to be GET"));
}

?>