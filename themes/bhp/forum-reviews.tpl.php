<?php
//echo ($node->field_news_images['und'][0]['filename']);
//print_r($node->field_news_media_type['und'][0]['value']);
?>
<script type="text/javascript">		    
		(function ($) {  $(function(){
			$(".listHolder").hover(
			function(){
					$(this).addClass("hover");
				},
			function(){
					$(this).removeClass("hover");
					}
			);
			
			$(".mv_tab_content li").hover(
			function(){
					$(this).addClass("hover");
				},
			function(){
					$(this).removeClass("hover");
					}
			);
			//Most Viewed tab 				
			$(".most_view li").click(function() {
			$(".most_view li a").removeClass("active"); //Remove any "active" class
			$(this).find("a").addClass("active"); //Remove any "active" class
			$(this).addClass("active"); //Add "active" class to selected tab
			$(".mv_tab_content").hide(); //Hide all tab content
	
			var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
				$(activeTab).fadeIn(); //Fade in the active ID content
				return false;
			});
			$(".gallery_thumb li").click(function(){
    			$(".gallery_thumb li a").removeClass("active");
    			$(this).find("a").addClass("active");
    			$("img#mainPhoto").attr("src", $(this).find("a").attr("href"));
    			$(".lightbox").attr("href", $(this).find("a").attr("href"));
    			return false;
    		});
			$(".lightbox").lightbox();
		});
})(jQuery);
	</script>
<div id="leftColumn" class="clearfix fleft">
		<div class="article">
			<h1 class="padL20 marB10">News</h1>
			
			<ul class="tab TLR5 clearfix">
				<li><a href="news.php?t=0" class="TLR5" title="All">All</a></li>
				<li><a href="news.php?t=1" class="TLR5 active" title="Indian">Indian</a></li>
				<li><a href="news.php?t=2" class="TLR5" title="International">International</a></li>
				<li><a href="news.php?t=3" class="TLR5" title="Motor Sports">Motor Sports</a></li>
			</ul>
			
			<div class="tab_container BLR5 marB10">
				<div class="tab_content" style="display:block">
				
					<div class="news_details clearfix">
						<div class="clearfix">
							<div class="fleft w460">
								<h1><?php echo $node->title;?> </h1>
								<div class="postDate">Posted: 5.5 hours ago</div>
							</div><!-- fleft -->
							<?php include ("includes/common/share.php") ?>
						</div><!--clearfix -->
						
						<div class="clearfix">
							<div class="fright "><?php include ("includes/common/inner-pagination.php") ?></div><!-- inner pagination -->
						</div>
						
						<div class="full_news marT10 clearfix">
							
							<div class="fleft PhotoGallery">
								<div class="photogalleryHolder clearfix marB15">
								<?php 
								if(sizeof($node->field_news_images['und'])>0)
									 {
									?>
									<!--  <a href="/sites/default/files/<?php echo str_replace("public://","",$node->field_news_images['und'][0]['uri']);?>" class="lightbox mainPhoto">-->
										<img src="/sites/default/files/<?php echo str_replace("public://","",$node->field_news_images['und'][0]['uri']);?>" id="mainPhoto" alt="car" width="370" height="275" />
										<div class="zoomIt">&nbsp;</div>
									<!--</a>-->
									<?php 											
									}
									
									if(sizeof($node->field_news_images['und'])>0)
										{
									?>
									<ul class="gallery_thumb clearfix marT10 marB5">
										
										<li>
											<a class="active" href="/sites/default/files/<?php echo str_replace("public://","",$node->field_news_images['und'][0]['uri']);?>" title="car">
												<img src="/sites/default/files/<?php echo str_replace("public://","",$node->field_news_images['und'][0]['uri']);?>" alt="car" width="70" height="50" />
											</a>
										</li>
										<?php
										if(sizeof($node->field_news_images['und'])>1)
										{
										?>
										<li>
											<a href="/sites/default/files/<?php echo str_replace("public://","",$node->field_news_images['und'][1]['uri']);?>" title="car">
												<img src="/sites/default/files/<?php echo str_replace("public://","",$node->field_news_images['und'][1]['uri']);?>" alt="car" width="70" height="50" />
											</a>
										</li>
										<?php
										}
										if(sizeof($node->field_news_images['und'])>2)
										{
										?>
										<li>
											<a href="/sites/default/files/<?php echo str_replace("public://","",$node->field_news_images['und'][2]['uri']);?>" title="car">
												<img src="/sites/default/files/<?php echo str_replace("public://","",$node->field_news_images['und'][2]['uri']);?>" alt="car" width="70" height="50" />
											</a>
										</li>
										<?php
										}
										if(sizeof($node->field_news_images['und'])>3)
										{
										?>
										<li>
											<a href="/sites/default/files/<?php echo str_replace("public://","",$node->field_news_images['und'][3]['uri']);?>" title="car" class="last">
												<img src="/sites/default/files/<?php echo str_replace("public://","",$node->field_news_images['und'][3]['uri']);?>" alt="car" width="70" height="50" />
											</a>
										</li>
										<?php
										}
										?>
									</ul>
									<?php
									}
									?>
								</div><!-- photo gallery Holder -->
								
								<a href="/forum/" target="_blank" class="discussBtn"><span>View Forum Discussion</span></a>
								
							</div><!-- new photo galler -->
							
							<div class="descripptionFlow">
							
								<!--  <p>Swedish auto maker Volvo launched refreshed model of its premium sedan S80 in India.
								The company has massive expansion plans lined up for the Indian auto market which not only includes
								new product launches but also new and upgraded variants of existing models.</p>
								
								<p>The new high performance S80 model comes with twin-turbo Diesel engine that delivers 205 Hp 
								and 420 Nm torque. It also offers best in class fuel consumption and CO2 emissions. The car 
								delivers 13.1 Hp and 420 Nm torque. It also offers best in class fuel consumption and CO2 emissions. </p>
								
								<p>Swedish auto maker Volvo launched refreshed model of its premium sedan S80 in India. The company has massive
								expansion plans lined up for the Indian auto market which not only includes new product launches but also
								new and upgraded variants of existing models.</p>
								
								<p>The new high performance S80 model comes with twin-turbo Diesel engine that delivers 205 Hp and 420 Nm torque.
								It also offers best in class fuel consumption and CO2 emissions. The car delivers 13.1 kmpl mileage and CO2
								emission of 203gm/km. The model also features standard safety features from Volvo like Intelligent Driver
								Information System, Adaptive Brake Lights, Ready Alert Brakes that reduce braking distanc-->
								<?php
								$strlen=0;
								if($_GET['start']=='')
									{
										if($_GET['prev']=='')
											{
								$finddottostop=@strpos($node->field_news_content['und'][0]['safe_value'],".",1450);
								$findspacetostop=@strpos($node->field_news_content['und'][0]['safe_value']," ",1450);
								 $strlen=strlen($node->field_news_content['und'][0]['safe_value']);
											}
											else
											{
								 $finddottostop=@strpos(substr($node->field_news_content['und'][0]['safe_value'],$_GET['prev'],1450),".",1450);
								$findspacetostop=@strpos(substr($node->field_news_content['und'][0]['safe_value'],$_GET['prev'],1450)," ",1450);	
								$strlen=strlen(substr($node->field_news_content['und'][0]['safe_value'],$_GET['prev'],1450));	
											}
									}
									else
									{
								$finddottostop=@strpos(substr($node->field_news_content['und'][0]['safe_value'],$_GET['start'],1450),".",1450);
								$findspacetostop=@strpos(substr($node->field_news_content['und'][0]['safe_value'],$_GET['start'],1450)," ",1450);	
								$strlen=strlen(substr($node->field_news_content['und'][0]['safe_value'],$_GET['start'],1450));
									}
								 if(strlen($strlen>1450))
										{
									if($finddottostop<$findspacetostop)
										{
										$postostart=$finddottostop;
										}
									else
										{
										$postostart=$findspacetostop;
										}
										$postostart=$postostart+1;
										if($postostart>1)
											{
											echo $str=trim(substr($node->field_news_content['und'][0]['safe_value'],0 ,$postostart))."&hellip;";
											}
											else
											{
											echo $str=trim(substr($node->field_news_content['und'][0]['safe_value'],0 ,$postostart))."&hellip;";
											}
										
										}
									else
									{
									echo $node->field_news_content['und'][0]['safe_value'];
									}
									
									 if(strlen($strlen>1450))
									 {
								?>
								<a href="#?q=node/#&start=<?php echo $postostart+1;?>" title="Next Page">Next Page ></a>
								<?php
									}
									
								if($_GET['start']!='')
									 {
								?>
								<a href="#?q=node/#&prev=<?php echo $_GET['start']-1;?>" title="Prev Page"><?php echo "<  "."Prev Page";?></a>
								<?php
									}
								?>
							</div><!-- description flow -->
							
							<div class="fright ">
								<?php include ("includes/common/inner-pagination.php") ?>
							</div><!-- inner pagination -->
							
							<div class="clearfix">&nbsp;</div>
							
							<div class="clearfix marT20">
								<?php include ("includes/common/tags.php") ?>
							</div><!-- tags  --> 
						</div><!-- full news -->
						
						
					</div><!-- news deatils -->
				</div><!-- tab content -->
			</div><!-- tab container -->
				
			<?php //include ("includes/common/navigate-articles.php") ?>
			
			<?php //include ("includes/cta/realated-news.php") ?>
			
		</div><!-- article -->
		
		<?php
			include_once("././themes/bhp/includes/realated-news.php");
		?>

		
	</div><!-- Left Column -->
	
	

	
	<div class="clearfix fright roundAll5" id="images/news">
		<?php //include ("includes/cta/find-news.php") ?>
		<?php //include ("includes/cta/most-viewed.php") ?>	
		<?php //include ("includes/cta/add-banner.php") ?>	
	</div>
