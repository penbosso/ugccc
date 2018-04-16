<?php 
//this page allows counsellors to start counselling sessions

//including contants definition file
include('../initialize.php');

//check if the request method to this file is post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //get id of complaint to be started
    $complaint_id = $_POST['complaint_id'];
    //fetch record with that specific id
    $complaint = Complaint::find_by_id($complaint_id);
    //set the date ended 
    $complaint->date_couns_started = mysql_datetime_format(time());
    //save changes
    if($complaint->save()){
        echo "status=0&message=conselling session started";
    } else {
        echo "status=1&message=starting counselling session failed";
    }

} else {
    //indicate error
    echo "status=1&message=no request method specified";
}

?>