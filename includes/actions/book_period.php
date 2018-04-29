<?php 
    /* purpose:this page allows a student using the android application to book for a period
    Status codes => their meaning
        0        => booking process successful
        1        => operation failed: expect the REQUEST_METHOD to be POST
        2        => booking process unsuccessful
    */

    //including contants definition file
    include('../initialize.php');

    //check if the request method to this file is POST
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //initialize a response for the request
        //create new booking
        $booking = new Booking();
        
        //recieve inputs to file from the $_POST array
        $booking->scheduled_date = $_POST['scheduled_date'];
        $booking->assign_counsellor_id = $_POST['assign_counsellor_id'];
        $booking->location_id = 1;

        if($booking->save()){
            //return success message
            header("location:../../public/index.php?page=sessions&status=0");
        } else {
            //return failure message
            header("location:../../public/index.php?page=sessions&status=1");

        }
    } else {
        //indicate error
        header("location:../../public/index.php?page=sessions&status=1");
    }

?>