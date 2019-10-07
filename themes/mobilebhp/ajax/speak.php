<?php
//@session_start();
include("connect.php");
$action=$_POST['action'];
$name=$_POST['name'];
$email=$_POST['email'];
$message=$_POST['message'];
//$subject=$_POST['subject'];
//$o_val=$_POST['o_val'];

$speaktype = null;

if (isset($_POST['speaktype']) && !empty($_POST['speaktype']))
{
	$speaktype=$_POST['speaktype'];
}
	if($con)
	{
		if($action=='submit')
			{
			// include("speak_email_user.php");
			include("speak_email_admin.php");
			echo 1;
			}
		else
		{
			echo 0;
		}
	}
	else
	{
	echo 0;
	}
	
?>
