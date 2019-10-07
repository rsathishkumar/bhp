<?php
ob_start();
require("class.phpmailer.php");
$mail = new PHPMailer();
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
							<td colspan="2">
								<h1 style="font-size:24px;margin:25px 0px 15px 0;">Thank You for your feedback to Team-BHP.</h1>
								<div style="font-size:16px;color:#333333;sline-height:28px;margin-bottom:20px">Someone from our team will see your email soon.</div>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<?php
			include("include/footer.php");
			?>
		</table>
	</div><!-- wrapper -->
</body>
<?php
$mailbody=ob_get_contents();
ob_end_clean ();
$mail->From = "webmaster@team-bhp.com";
$mail->FromName ="Team BHP";
$mail->AddAddress($email,"");
$mail->IsHTML(true);                             
$mail->Subject = "Your Team-BHP Feedback";
$mail->Body = $mailbody;
$mail->Send();
?>
