<?php
$response = array();
include 'include/db_connect.php';
include 'include/functions.php';

//Get the input request parameters
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE); //convert JSON into array

//Check for Mandatory parameters
if(isset($input['userId']) && isset($input['password'])){
	$userId = $input['userId'];
	$password = $input['password'];
	$query    = "SELECT full_name,password_hash, salt FROM appuser WHERE userId = ?";

	if($stmt = $con->prepare($query)){
		$stmt->bind_param("s",$userId);
		$stmt->execute();
		$stmt->bind_result($fullName,$passwordHashDB,$salt);
		if($stmt->fetch()){
			//Validate the password
			if(password_verify(concatPasswordWithSalt($password,$salt),$passwordHashDB)){
				$response["status"] = 0;
				$response["message"] = "Login successful";
				$response["full_name"] = $fullName;
			}
			else{
				$response["status"] = 1;
				$response["message"] = "Invalid userId and password combination";
			}
		}
		else{
			$response["status"] = 1;
			$response["message"] = "Invalid userId and password combination";
		}
		
		$stmt->close();
	}
}
else{
	$response["status"] = 2;
	$response["message"] = "Missing mandatory parameters";
}
//Display the JSON response
echo json_encode($response);
?>