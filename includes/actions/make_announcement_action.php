<?php 
//this page allows the front desk officer to publish an announcement

//including contants definition file
include('../initialize.php');

//check if the request method to this file is post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //create a new announcement object
    $announcement =  new Announcement();
    //fill object with inputs from the interface
    $announcement->title = $_POST['title'];
    $announcement->content = $_POST['content'];
    $announcement->created_by_user = $_POST['created_by_user'];
    $date = mysql_datetime_format(time()); //getting the current date time
    $announcement->date_created = $date;

    //checking if image was uploaded
    if(isset($_FILES["image"]["name"])){
        //getting info about the uploaded image 
        $file_info = pathinfo($_FILES["image"]["name"]);
        $ext=$file_info['extension'];
        $image_name="img_".rand(1000, 9999).".".$ext;
        $announcement->image = $image_name; //setting the name to announcement object

        $uploadpath = "../../images/".$image_name;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $uploadpath) && 
            $announcement->create()) {
            echo "status=0&message=operation successfull";
        } else {
            echo "status=1&message=operation failed";
        }
    } else {
        //else save only announcement to db 
        $announcement->image = "";
        if ($announcement->create()) {
            echo "status=0&message=operation successfull";
        } else {
            echo "status=1&message=operation failed";
        }
    }
    
} else {
    //indicate error
    echo "status=1&message=no request method specified";
}

?>