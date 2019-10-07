<?php
ob_start();
@session_start();
require("class.phpmailer.php");
$mail = new PHPMailer();
include("connect.php");
$action=$_POST['action'];
$array_email=explode(";",$_POST['toShareForm']);
	
			
		if($action=='show')
			{
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
								<h1 style="font-size:24px;margin:25px 0px 15px 0;"><?php //echo $_POST['sharelink'];?>Hi there,</h1>
								<div style="font-size:14px;color:#333333;sline-height:28px;margin-bottom:20px"><?php echo $_POST['fromShareForm'];?> thinks you might find this Team-BHP link interesting, and wants you to check it out.</div>
							</td>
						</tr>
						<tr>
							<td>
								<?php echo $_POST['sharelink'];?>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
						</tr>
					</table>
				</td>
			</tr><!-- footer -->
			<tr>
				<td align="right" bgcolor="#000000" style="color:#999999;font-size:11px;padding:5px 15px;" height="25px">
					 <a href="<?php echo $_POST['sharelink'];?>" title="click here" style="color:#ffffff;text-decoration:none;cursor:pointer;" target="_blank"><strong> click here</strong></a>
				</td>
			</tr>
			
			
		</table>
	</div><!-- wrapper -->
	
</body>
<?php
$mailbody=ob_get_contents();
ob_end_clean ();
$mail->From = $_POST['fromShareForm'];
$mail->FromName ="Team BHP";
	if(sizeof($array_email)>0 && (isset($array_email)))
		{
		

	for($j=0;$j<sizeof($array_email);$j++)
			{
			
				if($j==0)
					{
					
			$mail->AddAddress($array_email[$j],"");
			//echo "Iffffffff = > ".$array_email[$j];
					}
					else
					{
					
			$mail->AddBCC($array_email[$j],'');
			$array_email[$j];
					}
					
			}
		}
		else
		{
		//echo "Elseeeeeeee";
$mail->AddAddress($_POST['toShareForm'],"");		
		}
$mail->IsHTML(true);                             
$mail->Subject = "You'll like this Team-BHP Link (from ".$_POST['fromShareForm'].")";
$mail->Body = $mailbody;
$mail->Send();
$mail->ClearAddresses();
	}
?>
