<?php
ob_start();
@session_start();
require("class.phpmailer.php");
$mail = new PHPMailer();
include("connect.php");
$email=base64_decode($_REQUEST['e']);
//$_SESSION["emailtoset"]=0;
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
								<h1 style="font-size:24px;margin:25px 0px 15px 0;">Thank You for subscribing to the Team-BHP Newsletter.</h1>
								<div style="font-size:16px;color:#333333;sline-height:28px;margin-bottom:20px">We are still in the process of setting up our Newsletter service. In the near future you will begin to recieve weekly updates on the latest news, reviews, articles and hot threads related to the Indian automotive scene. Till then, stay tuned!</div>
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
			include("include/footer-news-confirm.php");
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
$mail->Subject = "Your Team-BHP Newsletter";
$mail->Body = $mailbody;
$mail->Send();
?>
