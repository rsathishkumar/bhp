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
					$ins_email=@mysqli_query("insert into subscribefornewsletter values('".$email."','".$_POST['session_id']."')");
					?>
					<body style="font-family:'Lucida Grande', 'arial';margin:0;padding:0;font-size:12px;color:#333">

	<div style="width:740px;">
		<table width="730" cellpadding="0" cellspacing="0" border="0" align="center" bgcolor="#ffffff">
			<tr>
				<td bgcolor="#000000">
					<table width="730" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td align="left" width="60%"  style="padding:10px 0px 15px 15px">
								<a href="http://www.team-bhp.com/" target="_blank" title="Team BHP" style="cursor:pointer">
									<img src="http://www.team-bhp.com/themes/bhp//images/team-bhp-logo.png" width="305"  height="128" alt="Team BHP Logo" border="0" />
								</a>	
							</td>
							<td width="40%" style="padding-top:10px;padding-bottom:30px" align="right" valign="bottom">
									<img src="http://www.team-bhp.com/sites/default/files/promo-product.png" width="158"  height="61" alt="Car" border="0" />
							</td> 
						</tr>
					</table>
				</td>
			</tr><!-- header end here -->
				
			<!-- body start here -->
			<tr>
				<td align="left" style="padding:0px 15px">
					<table  cellpadding="0" cellspacing="0" border="0" width="100%">
						<tr>
							<td>
								<h1 style="font-size:24px;margin:25px 0px 15px 0;">Thank You for subscribing to the Team-BHP newsletter.</h1>
								<div style="font-size:14px;color:#333333;sline-height:28px;margin-bottom:20px">You will recieve regular updates about the latest news, reviews and articles 
								to keep you posted about the Indian automotive scene. </div>
							</td>
						</tr>
							<tr>
							<td>
								&nbsp;
							</td>
						</tr>
					</table>
				</td>
			</tr><!-- footer -->
			<tr>
				<td align="right" style="color:#999999;font-size:11px;">
					<div style="padding:5px 15px;background:#000000">
					To unsubcribe, <a href="http://www.team-bhp.com/?q=unsubscribenews&e=<?php echo base64_encode($email);?>" title="click here unsubcribe" style="color:#ffffff;text-decoration:none;cursor:pointer"><strong>click here</strong></a>
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
$mail->Subject = "Your Team-BHP Newsletter";
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
