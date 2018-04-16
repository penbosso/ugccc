<?php 
    /* purpose:this page allows a student using the android application to book for a period
    Status codes => their meaning
        0        => booking process successful
        1        => operation failed: expect the REQUEST_METHOD to be POST
        2        => booking process unsuccessful
    */

    //including contants definition file
    include('../includes/initialize.php');

    //check if the request method to this file is POST
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //initialize a response for the request
        $response = array();
        //create new booking
        $booking = new Booking();
        
        //recieve inputs to file from the $_POST array
        $booking->scheduled_date = $_POST['scheduled_date'];
        $booking->assign_counsellor_id = $_POST['assign_counsellor_id'];
        $booking->location_id = 1;

        if($booking->save()){
            //return success message
            echo json_encode(array("status"=>0, "message"=>"booking process successful"));
        } else {
            //return failure message
            echo json_encode(array("status"=>2, "message"=>"booking process unsuccessful"));
        }
    } else {
        //indicate error
        echo json_encode(array("status" => 1, "message" => "operation failed: expect the REQUEST_METHOD to be POST"));
    }

    //return the data in JSON format 
    header("Content-Type: application/json");
?>