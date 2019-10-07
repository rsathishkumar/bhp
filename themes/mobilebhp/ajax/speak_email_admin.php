<?php
ob_start();
include_once("class.phpmailer.php");
$mail_admin = new PHPMailer();
?>
					<body style="font-family:'Lucida Grande', 'arial';margin:0;padding:0;font-size:12px;color:#333">

	<div style="width:740px;">
		<table width="730" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#ffffff">
			
			<!-- body start here -->
			<tr>
				<td align="left" style="padding:0px 15px">
					<table  cellpadding="0" cellspacing="0" border="0" width="100%">
						<tr>
							<td colspan="2">
								<h1 style="font-size:24px;margin:20px 0px 25px 0;">Team-BHP feedback</h1>
							</td>
						</tr>
						<tr>
							<td width="30%">
								<div style="font-size:16px;color:#333333;sline-height:28px;margin-bottom:20px">Name</div>
							</td>
							<td width="70%">
								<div style="font-size:16px;color:#333333;sline-height:28px;margin-bottom:20px"><?php echo $name;?></div>
							</td>
						</tr>
						<tr>
							<td width="30%">
								<div style="font-size:16px;color:#333333;sline-height:28px;margin-bottom:20px">Email ID</div>
							</td>
							<td width="70%">
								<div style="font-size:16px;color:#333333;sline-height:28px;margin-bottom:20px"><?php echo $email;?></div>
							</td>
						</tr>
<!--						<tr>-->
<!--							<td width="30%">-->
<!--								<div style="font-size:16px;color:#333333;sline-height:28px;margin-bottom:20px">Subject</div>-->
<!--							</td>-->
<!--							<td width="70%">-->
<!--								<div style="font-size:16px;color:#333333;sline-height:28px;margin-bottom:20px">--><?php //if($speaktype!='Other' && $o_val=='') {echo $speaktype;} else  { echo $o_val;}?><!--</div>-->
<!--							</td>-->
<!--						</tr>-->
						<tr>
							<td width="30%">
								<div style="font-size:16px;color:#333333;sline-height:28px;margin-bottom:20px">Message</div>
							</td>
							<td width="70%">
								<div style="font-size:16px;color:#333333;sline-height:28px;margin-bottom:20px"><?php echo $message;?></div>
							</td>
						</tr>
					</table>
				</td>
			</tr><!-- footer -->
			<!-- <tr>
				<td align="right" style="color:#999999;font-size:11px;">
					<div style="padding:5px 15px;background:#000000">
					 <a href="/" title="click here" style="color:#ffffff;text-decoration:none;cursor:pointer"><strong></strong></a>
					</div>
				</td>
			</tr>
			-->
			
		</table>
	</div><!-- wrapper -->
	
</body>
<?php
$mailbodyadmin=ob_get_contents();
ob_end_clean ();
$mail_admin->From = $email;
//$mail_admin->FromName ="Team BHP";
$mail_admin->FromName =ucfirst($name);

$mail_admin->AddAddress("webmaster@team-bhp.com","");
//$mail_admin->AddAddress("dhananjay@clistesoft.com","");

//$mail_admin->AddAddress("wasim@paperplane.net","");
//$mail_admin->AddBCC('test.paperplane@gmail.com', '');
//$mail_admin->AddBCC('rajeev@paperplane.net', '');

$mail_admin->IsHTML(true);                             
$mail_admin->Subject = "Team-BHP Feedback";
$mail_admin->Body = $mailbodyadmin;
$mail_admin->Send();
?>
