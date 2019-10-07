<?php
	if(isset($_GET['e']))
		{
			$email=@base64_decode($_GET['e']);
		   //$sql_user_news=mysqli_fetch_array(mysqli_query("select mail,uid from users where mail ='".$email."'"));
		    $sql_user_news=@mysqli_query("select email from subscribefornewsletter where email ='".$email."'");
			
			if(mysqli_num_rows($sql_user_news)>0)
			   {
				$sql_user_news_notconfirm=@mysqli_query("select email from subscribefornewsletter where email ='".$email."' and status= 0");
					if(mysqli_num_rows($sql_user_news_notconfirm)>0)
					{
?>
	<div class="roundAll3 cta newsletter clearfix">
		<div class="newsletterInner unsubscribeInner">
			<h3>Newsletter Confirmation</h3>
			<br />
				<div class="marB20">Thanks for signing up!</div>
			
		</div><!-- newsletter inner -->
	</div><!-- CTA -->
<?php			include("ajax/confirmnews-emailer.php");
				$update_status=@mysqli_query("update subscribefornewsletter set status = 1 where email = '".$email."'");
				}
				 else
				 {
				 ?>
	<div class="roundAll3 cta newsletter clearfix">
			<div class="newsletterInner unsubscribeInner">
				<h3>Newsletter Confirm</h3>
				<br />
				<div class="marB20">Looks like you have already confirmed yor status!</div>
						
			</div><!-- newsletter inner -->
	</div>	
				<?php
				}
		   }
			else
			{
			?>
	<div class="roundAll3 cta newsletter clearfix">
		<div class="newsletterInner unsubscribeInner">
			<h3>Newsletter Confirm</h3>
			<br />
			<div>Your email address is not available in our subscription list.</div>		
		</div><!-- newsletter inner -->
	</div><!-- CTA -->
			<?php
			}
	}
?>
<script type="text/javascript">
(function ($) {
	$(function(){
			var count=0;
			var myInt = setInterval(function(){
			count++;
			 if(count==5)
			 {
			window.location.href='/';
					return false;
				}
			 },1000);
	});
})(jQuery);
</script>
