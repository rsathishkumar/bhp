<!DOCTYPE html>
<html>
<head>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>TEAM BHP :: Advice Details</title>

		<?php include ("includes/common/css-js.php") ?> 

		
		<script type="text/javascript">		    
			$(function(){
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
	    			$("img#mainPhoto").attr("src", "/images/news/big/"+$(this).find("a").attr("href"));
	    			$(".lightbox").attr("href", "/images/news/large/"+$(this).find("a").attr("href"));
	    			return false;
	    		});
				
				$(".zoomSingleImg").hover(
				  function () {
						$oldImgSrc = $(this).find("img").attr("src");
						$oldImgHeight = $(this).find("img").attr("height");
						$oldImgWidth = $(this).find("img").attr("width");
						$imgSrc = $(this).find("img").attr("rel");
						$(this).css("height", $oldImgHeight)
						$(this).find("img").addClass("zoomImg");
						$(this).find("img").removeAttr("width");
						$(this).find("img").removeAttr("height");
						$(this).find("img").attr("src", $imgSrc);
				  }, 
				  function () {
						$(this).find("img").removeClass("zoomImg");
						$(this).find("img").attr("src", $oldImgSrc);
						$(this).find("img").attr("height", $oldImgHeight);
						$(this).find("img").attr("width", $oldImgWidth);
				  }
				);
				
			});
		</script>
	</head>
	
<body class="clearfix">
	<div class="bgHolder clearfix">
		<div class="clearfix page" id="page">
	
			<div id="leftPage" class="fleft">
				
				<?php include ("includes/common/header.php") ?>
				
				<?php include ("includes/common/navigation.php") ?>			
				
				<div id="container" class="clearfix roundAll3">
					<div id="leftColumn" class="clearfix fleft">
						<div class="article">
							<h1 class="padL20 marB10">Advice</h1>
							
							<ul class="tab TLR5 clearfix">
								<li><a href="advice.php" class="TLR5" title="All">All</a></li>
								<li><a href="advice.php" class="TLR5 active" title="On Buying ">On Buying </a></li>
								<li><a href="advice.php" class="TLR5" title="On Selling">On Owning</a></li>
								<li><a href="advice.php" class="TLR5" title="On Modifying">On Modifying</a></li>
								<li><a href="advice.php" class="TLR5" title="Miscellany">Miscellany</a></li>								
							</ul>
							
							<div class="tab_container BLR5 marB10">
								<div id="tab2" class="tab_content"  style="display:block">
									<div class="news_details clearfix">
										<div class="clearfix marB20">
											<div class="fleft w460">
												<h1>How to buy a *NEW* car in India</h1>
											</div><!-- fleft -->
											<?php include ("includes/common/share.php") ?>
										</div><!--clearfix -->
										
										<div class="clearfix">
											<div class="fright"><?php include ("includes/common/inner-pagination.php") ?></div><!-- inner pagination -->
										</div>
										
										<div class="full_news marT10">
											
											<div class="fleft newPhotoGallery marB10 clearfix">
												<div class="photogalleryHolder marB10 clearfix">
													<div class="mainPhoto zoomSingleImg">
														<img src="/images/temp/car7-7.jpg" rel="/images/temp/car7.jpg" class="zoomLt" alt="car7" width="215" height="165" />
														<a href="#" title="car7" class="zoomIt">&nbsp;</a>
													</div>
												</div><!-- photo gallery Holder -->
												<a href="/forum/" target="_blank" class="discussBtn"><span>View Forum Discussion</span></a>
											</div><!-- new photo galler -->
											
											
											<div class="descripptionFlow">
												<p>Swedish auto maker Volvo launched refreshed model of its premium sedan S80 in India.
												The company has massive expansion plans lined up for the Indian auto market which not only includes
												new product launches but also new and upgraded variants of existing models.</p>
												
												<p>The new high performance S80 model comes with twin-turbo Diesel engine that delivers 205 Hp 
												and 420 Nm torque. It also offers best in class fuel consumption and CO2 emissions. The car 
												delivers 13.1 Hp and 420 Nm torque. It also offers best in class fuel consumption and CO2 emissions. </p>
												
												<h2>Get a car loan</h2>
												
												<div class="para marB10">The new high performance S80 model comes with twin-turbo Diesel engine that delivers 205 Hp and 420 Nm
												torque. It also offers best in class fuel consumption and CO2 emissions. The car delivers 13.1 kmpl
												mileage and CO2 emission of 203gm/km. The model 
												
												<div class="fleft newPhotoGallery marT10">
													<div class="photogalleryHolder clearfix">
														<div class="mainPhoto zoomSingleImg">
															<img src="/images/temp/car7-7.jpg" rel="/images/temp/car7.jpg" class="zoomLt" alt="car7" width="215" height="165" />
															<a href="#" title="car7" class="zoomIt">&nbsp;</a>
														</div>
													</div><!-- photo gallery Holder -->
												</div><!-- new photo galler -->
												Swedish auto maker Volvo launched refreshed model of its premium sedan S80 in India.
												The company has massive expansion plans lined up for the Indian auto market which
												not only includes new product launches but also new and upgraded variants of existing models.
												</div>
												
												<p>The new high performance S80 model comes with twin-turbo Diesel engine that delivers 205 Hp and 420 Nm torque.
												It also offers best in class fuel consumption and CO2 emissions. The car delivers 13.1 kmpl mileage and CO2
												emission of 203gm/km. The model also features standard safety features from Volvo like Intelligent Driver
												Information System, Adaptive Brake Lights, Ready Alert Brakes that reduce braking distanc</p>
												
												<h2>Car Insurance</h2>
												<p><strong>Warranties:</strong> performance S80 model comes with twin-turbo Diesel engine that delivers 205 Hp
												and 420 Nm torque. It also offers best in class fuel consumption and CO2 emis</p>
												
												<p><strong>Certified Cars:</strong> The car delivers 13.1 features from Volvo like Intelligent Driver Information System,
												Adaptive Brake Lights, Ready Alert Brak that reduce braking distance in case of emergency. It also highlights
												advanced technical particulate filter that effectively reduces soot particles in exhaust gases&hellip;
												<a href="#" title="Next Page">Next Page ></a>
											</div><!-- description flow -->
											
											<div class="fright ">
												<?php include ("includes/common/inner-pagination.php") ?>
											</div><!-- inner pagination -->
											
											<div class="clearfix">&nbsp;</div>
											
										</div><!-- full news -->
										
										
									</div><!-- news deatils -->
								</div>
							</div><!-- tab content -->
								
							<?php include ("includes/common/navigate-articles.php") ?>
							
							<?php include ("includes/cta/realated-articles.php") ?>
							
						</div><!-- article -->
						
					</div><!-- Left Column -->
					
					<div class="clearfix fright roundAll5" id="sidebar">
						<?php include ("includes/cta/other-sections.php") ?>
						<?php include ("includes/cta/most-viewed-notab.php") ?>
						<?php include ("includes/cta/add-banner.php") ?>
					</div>
				</div><!-- container -->
					
				<?php include ("includes/common/footer.php") ?>
				
			</div><!-- page -->
			
			<div id="sidePage" class="fright" style="display:none;">
				<?php include ("includes/cta/promo-holder.php") ?>
				<?php include ("includes/cta/buy-sell.php") ?>
				<?php include ("includes/cta/hot-trends.php") ?>
				<?php include ("includes/cta/travelogues.php") ?>
				<?php include ("includes/cta/newsletter.php") ?>
			</div><!-- side page -->
	</div><!-- page -->		
</div><!-- bg holder-->
</body><!-- body -->

</html>
