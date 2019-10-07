<?php
/**
 * Created by PhpStorm.
 * User: cliste2
 * Date: 28/10/16
 * Time: 1:06 PM
 */
@session_start();
include("connect.php");
$action=$_POST['action'];

// Here we get all the information from the fields sent over by the form.
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

	$to = 'dhananjay@clistesoft.com';
	$subject = 'Speak Feedback';
	$message = 'FROM: '.$name.' Email: '.$email.'Message: '.$message;
	$headers = 'From: youremail@domain.com' . "\r\n";

if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // this line checks that we have a valid email address
    mail($to, $subject, $message, $headers); //This method sends the mail.
    echo "Thanks for your feedback!"; // success message
}else{
    echo "Invalid Email, please provide an correct email.";
}







?>