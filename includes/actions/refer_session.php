<?php 
//this page allows counsellors to refer counselling sessions

//including contants definition file
include('../initialize.php');

//check if the request method to this file is post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //create a  new counsellor assignment
    $assign_counsellor = new AssignCounsellor();
    //get id of chosen counsellor to be assigned
    $assign_counsellor->counsel_id = $_POST['counsel_id'];
    //fetch complaint for which a counsellor is being assigned
    $assign_counsellor->complaint_id = $_POST['complaint_id'];
    //set the date assigned 
    $assign_counsellor->date_assigned = mysql_datetime_format(time());
    //save changes
    if ($assign_counsellor->save()) {
    header("location:../../public/index.php?page=sessions&status=0");
} else {
    header("location:../../public/index.php?page=sessions&status=1");
}


} else {
    //indicate error
    echo "status=1&message=no request method specified";
}

?>