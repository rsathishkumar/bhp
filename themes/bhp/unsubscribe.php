
				<?php 
				if(isset($_GET['e']))
					{
				$email=@base64_decode($_GET['e']);
				$sql_user_news=@mysqli_query("select email from subscribefornewsletter where email ='".$email."'") or die(mysql_error());
						if(mysqli_num_rows($sql_user_news)>0)
						{
						$del_res=@mysqli_query("delete from subscribefornewsletter where email='".$email."'");
					?>
				<div class="roundAll3 cta newsletter clearfix">
					<div class="newsletterInner unsubscribeInner">
						<h3 class="marB10">We're sorry to see you go.</h3>
						<div>You have successfully unsubscribed from our newsletter. You will not receive any further mails from us. If its something we did, please <a href="/?q=speak" target="_blank">let us know</a>. In the meantime, keep revvin...</div>
					</div><!-- newsletter inner -->
				</div>

					<script type="text/javascript">
						var count=0;
						var myInt = setInterval(function(){
						count++;
						 if(count==3){
								window.location.href='/';
								return false;
							}
						 },1000);
					</script>
					<?php
						}
						else
						{
					?>
					<div class="roundAll3 cta newsletter clearfix">
						<div class="newsletterInner unsubscribeInner">
							<h3 class="marB10">Newsletter Unsubscribe</h3>
							<div>Looks like you have already unsubscribed! <br/> Your email address is not available in our subscription list.</div>
						</div><!-- newsletter inner -->
					</div>
					
					<script type="text/javascript">
						var count=0;
						var myInt = setInterval(function(){
						count++;
						 if(count==3){
								window.location.href='/';
								return false;
							}
						 },1000);
					</script>
				<?php 
					}
				}
				?>
											
