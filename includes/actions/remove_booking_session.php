<?php 
//this page allows counsellors to start counselling sessions

//including contants definition file
include('../initialize.php');

//check if the request method to this file is post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //get id of complaint to be started
    $booking_id = $_POST['booking_id'];
    //fetch record with that specific id
    $booking = booking::find_by_id($booking_id);
    //delete booking
    if($booking->delete()){
      header("location:../../public/index.php?page=sessions&status=0");
    } else {
        header("location:../../public/index.php?page=sessions&status=1");
    }

} else {
    //indicate error
    echo "status=1&message=no request method specified";
}

?>