<?php
ob_start();
@session_start();
require("class.phpmailer.php");
$mail = new PHPMailer();
include("connect.php");
$action=$_POST['action'];
$email=$_POST['email'];
//$_SESSION["emailtoset"]=0;
		if($action=='submit')
			{
			$sql_sel_email=@mysqli_query("select * from subscribefornewsletter where email='".$email."'");
			$num=@mysqli_num_rows($sql_sel_email);
				if($num==0)
					{
					$ins_email=@mysqli_query("insert into subscribefornewsletter values('".$email."','0','".$_POST['session_id']."')");
					?>
					<body style="font-family:'Lucida Grande', 'arial';margin:0;padding:0;font-size:12px;color:#333">

	<div style="width:740px;">
		<table width="730" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#ffffff">
			<?php
			include("include/header.php");
			?>
			<!-- body start here -->
			<tr>
				<td align="left" style="padding:0px 15px">
					<table  cellpadding="0" cellspacing="0" border="0" width="100%">
						<tr>
							<td>
								<h1 style="font-size:24px;margin:25px 0px 15px 0;">One last step before you receive our Newsletter...</h1>
								<div style="font-size:16px;color:#333333;sline-height:28px;margin-bottom:20px">To confirm your request <a href="/?q=confirm&e=<?php echo base64_encode($email);?>" title="click here to confirm" style="text-decoration:none;cursor:pointer">click here</a></div>
							</td>
						</tr>
							<tr>
							<td>
								&nbsp;
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<?php
			include("include/footer-news.php");
			?>
		</table>
	</div><!-- wrapper -->
	
</body>
<?php
//$emailtoset = $email;
//$_SESSION["emailtoset"]=1;
$mailbody=ob_get_contents();
ob_end_clean ();
$mail->From = "newsletter@team-bhp.com";
$mail->FromName ="Team BHP";
$mail->AddAddress($email,"");
$mail->IsHTML(true);                             
$mail->Subject = "Newsletter Subscription: Confirmation Required";
$mail->Body = $mailbody;
$mail->Send();
					}
					else
					{
					echo "Email already exist";
					}
					//print_r($_SESSION);				
			}
?>
