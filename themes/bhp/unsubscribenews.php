<?php
if(isset($_GET['e']))
	{
	$email=@base64_decode($_GET['e']);
//$sql_user_news=mysqli_fetch_array(mysqli_query("select mail,uid from users where mail ='".$email."'"));
$sql_user_news=@mysqli_query("select email from subscribefornewsletter where email ='".$email."'");
	}
	if(isset($_GET['e']) && (mysqli_num_rows($sql_user_news)>0))
	{
	$d_mail=mysql_fetch_assoc($sql_user_news);
	$email_val=$d_mail['email'];
	}
	else
	{
	$email_val='Your Email ID';
	}
?>
<script type="text/javascript">
(function ($) {
	$(function(){
		$("#newsletterEmail").bind("focus click", function(){
		 	if($(this).val()=="Your Email ID")
		 		{
		 			$(this).val('');
		 		}
		 });
		 
		 $("#newsletterEmail").bind("blur", function(){
		 	if(($(this).val()=="Your Email ID") || ($(this).val()==''))
		 		{
		 			$(this).val('Your Email ID');
		 		}
		 });
	});
})(jQuery);
</script>
<div class="roundAll3 cta newsletter clearfix">
	<div class="newsletterInner unsubscribeInner">
			
		<h3>Newsletter Unsubscribe</h3>
		<div class="marB20">Enter your email id to unsubscribe</div>
		<form id="newsletter" name="newsletter" action="#" onsubmit="validate_newsletterunsub(); return false;">
			
			<div class="clearfix">
				<input type="text" name="newsletterEmail" id="newsletterEmail" class="normal" value="<?php echo $email_val;?>"/>
			</div>	
			<p class="marT10">A confirmation email will be sent on this email id</p>
			
			<div class="clearfix marT20">
				<input type="submit" class="unsubscribeBtn" value="Unsubscribe">
			</div><!-- submit button -->
		</form>
		<div id="newsletterSuccessMsg" style="display:none;">Please click the confirmation link that has just been emailed to you</div>
	</div><!-- newsletter inner -->
	
	
	
</div><!-- Travelogues CTA -->
