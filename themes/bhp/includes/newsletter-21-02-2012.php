<?php
@session_start();
$sql_chk_email=@mysqli_query("select * from subscribefornewsletter where session_id='".session_id()."'");

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
	<div class="newsletterInner">
			<?php 
			
		/*	if(mysqli_num_rows($sql_chk_email)==0)
				{*/
			?>
		<h3>Newsletter</h3>
		<div class="marB20">Get your daily dose of the<br /> Indian Car Scene</div>
		<form id="newsletter" name="newsletter" action="#" onsubmit="validate_newsletter('<?php echo session_id();?>'); return false;">
			
			<div>
				<input type="text" name="newsletterEmail" id="newsletterEmail" class="normal" value="Your Email ID" />
			</div>	
		<p class="marT10">We will never share this address!</p>
			
			<div class="aln_center clearfix marT20">
				<div class="buttonHolder">
					<button id="submit-newsletter" name="submit-newsletter" type="submit">
						<img src="/themes/bhp/images/sprites/subcribebtn.png" alt="subrcibe Btn" width="106" height="28" />
					</button>
				</div>
			</div><!-- submit button -->
		</form>
		<div id="newsletterSuccessMsg" style="display:none;">Please click the confirmation link that has just been emailed to you</div>
	</div><!-- newsletter inner -->
	<a class="unsubscribeLink" href='http://www.team-bhp.com/unsubscribenews'>Click here to unsubscribe</a>
	<div class="clearfix marT20 padL10">
		<h3>Stay Updated</h3>
		<p>Be updated about the Indian automotive scene via Twitter, Facebook or RSS feeds.</p>
		
		<ul class="stayUpdated marT20 marB10 clearfix">
			<li><a href="http://twitter.com/#!/teambhpforum" title="Twitter" class="twitter" target="_blank">&nbsp;</a></li>
			<li><a href="http://www.facebook.com/TeamBHP" title="Facebook" class="facebook" target="_blank">&nbsp;</a></li>
			<li><a href="/?q=rss" title="RSS" class="rss" target="_blank">&nbsp;</a></li>			
		</ul>
		<?php
				/*}
				else
				{*/
				?>
				<!-- <h3>Newsletter</h3>
				<div class="marB20">Get your daily dose of the<br /> Indian Car Scene</div>
				<?php
				$da_e=@mysql_fetch_assoc($sql_chk_email);
				/*echo "<a href='http://www.team-bhp.com/?q=unsubscribenews&e=".base64_encode($da_e['email'])."' target='_blank'>Click here to unsubscribe</a>";
				}*/
				echo "<a href='http://www.team-bhp.com/?q=unsubscribenews&e=".base64_encode($da_e['email'])."' target='_blank'>Click here to unsubscribe</a>";
			?>
				-->
		
	</div><!-- staty -->
	
	
</div><!-- Travelogues CTA -->
