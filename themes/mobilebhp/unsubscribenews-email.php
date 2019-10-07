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
				if($num>0)
					{
					?>
					<body style="font-family:'Lucida Grande', 'arial';margin:0;padding:0;font-size:12px;color:#333">

	<div style="width:740px;">
		<table width="730" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#ffffff">
			<?php
			include("ajax/include/header.php");
			?>
			<!-- body start here -->
			<tr>
				<td align="left" style="padding:0px 15px">
					<table  cellpadding="0" cellspacing="0" border="0" width="100%">
						<tr>
							<td>
								<h1 style="font-size:24px;margin:25px 0px 15px 0;">Unsubscribe from the Team-BHP Newsletter</h1>
								<div style="font-size:16px;color:#333333;sline-height:28px;margin-bottom:20px">You will no longer recieve updates on the latest news, reviews and hot threads.<br />
								To confirm your request to unsubscribe <a href="/?q=unsubscribe&e=<?php echo base64_encode($email);?>" title="click here to unsubscribe" style="text-decoration:none;cursor:pointer">click here</a>
								</div>
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
			<!-- footer -->
			 <tr>
				<td align="right" style="color:#999999;font-size:11px;">
					<div style="padding:5px 15px;background:#000000">
					to unsubscribe <a href="/?q=unsubscribe&e=<?php echo base64_encode($email);?>" title="click here to unsubscribe" style="color:#ffffff;text-decoration:none;cursor:pointer"><strong>click here</strong></a>
					</div>
				</td>
			</tr> 
			
			
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
$mail->Subject = "Newsletter Unsubscribe: Confirmation Required";
$mail->Body = $mailbody;
$mail->Send();
echo $mailbody;
					}
					else
					{
					echo "Email does not exist";
					}
					//print_r($_SESSION);				
			}
?>
