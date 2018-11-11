<?php
$response = array();
include 'include/db_connect.php';
include 'include/functions.php';

//Get the input request parameters
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE); //convert JSON into array
$input['userId']='12345678';
$input['email'] = 'ck@gmail.com';
$input['password'] = '123456';
$input['full_name'] = 'Chris Check';
//Check for Mandatory parameters
if(isset($input['userId']) && isset($input['password']) && isset($input['full_name'])){
	$userId = $input['userId'];
	$email = $input['email'];
	$password = $input['password'];
	$fullName = $input['full_name'];
	
	//Check if user already exist
	if(!userExists($userId)){

		//Get a unique Salt
		$salt         = getSalt();
		
		//Generate a unique password Hash
		$passwordHash = password_hash(concatPasswordWithSalt($password,$salt),PASSWORD_DEFAULT);
		
		//Query to register new user
		$insertQuery  = "INSERT INTO appuser(userId, email, full_name, password_hash, salt) VALUES (?,?,?,?,?)";
		if($stmt = $con->prepare($insertQuery)){
			$stmt->bind_param("sssss",$userId,$email,$fullName,$passwordHash,$salt);
			$stmt->execute();
			$response["status"] = 0;
			$response["message"] = "User created";
			$stmt->close();
		}
	}
	else{
		$response["status"] = 1;
		$response["message"] = "User exists";
	}
}
else{
	$response["status"] = 2;
	$response["message"] = "Missing mandatory parameters";
}
echo json_encode($response);
?>