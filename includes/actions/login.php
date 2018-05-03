<?php 
    session_start();
        //including contants definition file
    include('../initialize.php');

    //check if the request method to this file is POST
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $email = isset($_POST["email"])?$_POST["email"]:"";
        $password = isset($_POST["password"]) ? $_POST["password"] : "";
        $sql= "SELECT * FROM user WHERE email='$email' AND password='$password'";
        $results = User::find_by_sql($sql);
        print_r($user);
        $user = array_shift($results);
        $_SESSION["user"] = $user->id;
        if(!$user){
            header("location:../../index.php?status=1");
        } else{
            header("location:../../public/index.php?status=0");
        }
    } else {
        //indicate error
        header("location:../../index.php?status=1");
    }

?>