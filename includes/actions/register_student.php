<?php 
    //this page registers student unto the system
    //student can register through app or front desk officer an register a student
   
    //including contants definition file
    include('../initialize.php');

    //get the user performing the registration 
    $user_type = isset($_GET['user_type']) ? $_GET['user_type'] : ""; 

    //check if the request method to this file is post
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //create a student object
        $student  =  new Student();

        //fill object with inputs from the interface
        $student->student_id = $_POST['student_id'];
        $student->first_name = $_POST['first_name'];
        $student->last_name = $_POST['last_name'];
        $student->other_names = $_POST['other_names'];
        $student->telephone = $_POST['telephone'];
        $student->email = $_POST['email'];
        $student->hall_of_residence = $_POST['hall_of_residence'];
        $student->department = $_POST['department'];
        $student->course = $_POST['course'];
        $student->password = $_POST['password'];

        if($student->create()){
            $return = 0;
        } else {
            $return = 1;
        }
    } else {
        $return = -1;
    }

    if( $user_type == "student" ) {
    header("Content-Type: application/json");
    
        switch ($return) {
            case 0:
                    echo json_encode(array("status"=>0, "message"=>"registration successful"));
                break;
            
            case 1:
                    echo json_encode(array("status"=>1, "message"=>"registration failed"));
                break;

            case -1:
                    echo json_encode(array("status"=>-1, "message"=>"no request method specified"));
                break;
        }
    } else if ($user_type == "front_desk") {
        switch ($return) {
            case 0:
                header("location:../../public/index.php?page=register_student&status=0");
                break;
            
            case 1:
                header("location:../../public/index.php?page=register_student&status=1");
                break;

            case -1:
                header("location:../../public/index.php?page=register_student&status=1");
                break;
        }
    } else {
        
    }
?>