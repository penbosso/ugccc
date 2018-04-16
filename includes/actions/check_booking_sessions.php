<?php 
//this page allows the front desk officer to publish an announcement

//including contants definition file
include('../initialize.php');

//check if the request method to this file is post
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $counsellor_id = $_GET['counsellor_id'];
    $bookings = Counsellor::check_booking_sessions($counsellor_id);
    echo json_encode($bookings);

} else {
    //indicate error
    echo "status=1&message=no request method specified";
}

?>