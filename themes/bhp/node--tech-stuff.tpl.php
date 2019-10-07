<?php
//$descArray = explode('pagebreak', $node->field_advice_content['und'][0]['safe_value']);
$descArray = explode('&lt;!--pagebreak--&gt;', $node->body['und'][0]['safe_value']);
?>
<script type="text/javascript">
function redirectbycat(catname)
	{
	location.href='/?q=advice&catname='+catname;
	}
(function (jQuery) {
	jQuery(function(){
var oldImgSrc, oldImgHeight, oldImgWidth, imgSrc;
		jQuery(".zoomSingleImg").hover(
		  function () {
				jQuery(this).css("overflow","visible");
				$("#hoverimg").addClass("zoomImg");
				$("#loadimg").css("display","none");
				$("#hoverimg").css("display","block");
			  }, 
		  function () {
				$("#hoverimg").css("overflow","hidden");
				$("#hoverimg").removeClass("zoomImg");
				$("#hoverimg").css("display","none");
				$("#loadimg").css("display","inline");
			}
			);
			jQuery(".desc").find("img").removeAttr("height");
			jQuery(".desc").find("img").removeAttr("width");
			jQuery(".desc").find("img").css("width", "35%");
			jQuery(".desc").find("img").css("position", "relative");
			jQuery(".desc").find("img").css("z-index", "10");
			jQuery(".desc").find("img").hover(
			  function(){
				$(this).css("width", "100%");
			  },
			  function(){
				$(this).css("width", "35%");
			});
		});
	})(jQuery);
</script>
				<input type="hidden" id="manimageforhover"  value="/?q=sites/default/files/styles/check_tech_stuff_hover/public/<?php echo str_replace("public://","",$node->field_tech_stuff_image['und'][0]['uri']);?>"/>
				<input type="hidden" id="manimage" value="/?q=sites/default/files/styles/check_tech_stuff/public/<?php echo str_replace("public://","",$node->field_tech_stuff_image['und'][0]['uri']);?>" />
					<div class="article">
								<h1 class="padL20 marB10">Tech Stuff</h1>
								<div class="compareBox active">
								<div class="campareBar">
									<h3>Tech Stuff</h3>
								</div>
								</div>
							
							
							<div class="tab_container BLR5 marB10">
								<div id="tab2" class="tab_content"  style="display:block">
									<div class="news_details clearfix">
										<div class="clearfix marB20">
											<div class="fleft w460">
												<h1><?php echo $node->title;?></h1>
											</div><!-- fleft -->
											<?php include ("includes/common/share.php") ?>
										</div><!--clearfix -->
										
											<?php
											//print_r($node);
											//include ("includes/common/inner-pagination.php");
											//$descArray = explode('<!--pagebreak-->', $node->body['und'][0]['safe_value']);
											if(count($descArray)>1)
											{
											$node->body['und'][0]['safe_value']=explode('&lt;!--pagebreak--&gt;', $node->body['und'][0]['safe_value']);
											?>
										<div class="clearfix">
											<div class="fright">
											<script type="text/javascript">
											(function (jQuery) {
												jQuery(function(){
													jQuery('.next').click(function(){
														jQuery('.desc').css('display', 'none');
														jQuery(jQuery(this).attr('href')).css('display', 'block');
														jQuery('ul.pagination li a').removeClass('active');
														jQuery('ul.pagination li a[href="'+jQuery(this).attr('href')+'"]').addClass('active');
														jQuery('html, body').animate({scrollTop: jQuery("h1.padL20").offset().top-10}, 300);
														return false;
													});
													jQuery('ul.pagination li a').click(function(){
														jQuery('.desc').css('display', 'none');
														jQuery('ul.pagination li a').removeClass('active');
														jQuery('ul.pagination li a[href="'+jQuery(this).attr('href')+'"]').addClass('active');
														jQuery('html, body').animate({scrollTop: jQuery("h1.padL20").offset().top-10}, 300);
														jQuery(jQuery(this).attr('href')).css('display', 'block');
														return false;
													});
													var oldImgSrc, oldImgHeight, oldImgWidth, imgSrc;
													/*  comment as on 17-12-2012 jQuery(".zoomSingleImg").hover(
												  function () {
												 		//$("#hoverimg").attr('src', jQuery('.zoomSingleImg').find("img").attr("src"));
														jQuery(this).css("overflow","visible");
														$("#hoverimg").addClass("zoomImg");
														$("#loadimg").css("display","none");
														$("#hoverimg").css("display","inline");
													}, 
												  function () {
												  		//$("#hoverimg").attr('src', $("#manimage").val());
												  		$("#hoverimg").css("overflow","hidden");
														$("#hoverimg").removeClass("zoomImg");
														$("#hoverimg").attr('src', jQuery("#manimageforhover").val());
														$("#hoverimg").css("display","none");
														$("#loadimg").css("display","inline");
													}
												);
												
													jQuery(".desc").find("img").hover(
													  function () {
													  		jQuery(".zoomSingleImg").css("overflow","visible");
													  		$("#hoverimg").attr('src', jQuery(this).attr("src"));
															$("#hoverimg").addClass("zoomImg");
															$("#loadimg").css("display","none");
															$("#hoverimg").css("display","inline");
													  }, 
													  function () {
													  		$("#hoverimg").css("overflow","hidden");
															$("#hoverimg").removeClass("zoomImg");
															$("#hoverimg").css("display","none");
															$("#hoverimg").attr('src', jQuery("#manimageforhover").val());
															$("#loadimg").css("display","inline");
														}
													);  comment as on 17-12-2012 */ 
												
												});
											})(jQuery);
											</script>
											<div class="clearfix InnerPagination">
												<ul class="pagination">
													<li class="first">Page</li>
													<?php
													for($i=0; $i<count($descArray); $i++)
													{
													?>
													<li><a title="go to page <?php echo $i+1; ?>"<?php if($i==0) {?> class="active"<?php } ?> href="#p<?php echo $i; ?>"><?php echo $i+1; ?></a></li>
													<?php
													}
													?>
												</ul>
											</div>
											</div><!-- fright -->
										</div>
											<?php
											}
											?>
										
										<div class="full_news marT10">
											<div class="fleft newPhotoGallery marB10 clearfix">
													<div class="photogalleryHolder marB10 clearfix">
													
														<div class="mainPhoto zoomSingleImg">
															<!--<img src="/sites/default/files/<?php echo str_replace("public://","",$node->field_tech_stuff_image['und'][0]['uri']);?>" rel="<?php echo str_replace("public://","",$node->field_tech_stuff_image['und'][0]['uri']);?>" class="zoomLt" alt="<?php echo $node->title;?>" width="215" height="165" />-->
															<!-- <img src="/?q=sites/default/files/styles/check_tech_stuff/public/<?php echo str_replace("public://","",$node->field_tech_stuff_image['und'][0]['uri']);?>" rel="<?php echo str_replace("public://","",$node->field_tech_stuff_image['und'][0]['uri']);?>" class="zoomLt" alt="<?php echo $node->title;?>" width="215" height="165" /> -->
															<strong>
															<img id="loadimg" src="/?q=sites/default/files/styles/check_tech_stuff/public/<?php echo str_replace("public://","",$node->field_tech_stuff_image['und'][0]['uri']);?>" rel="<?php echo str_replace("public://","",$node->field_tech_stuff_image['und'][0]['uri']);?>" class="zoomLt" alt="<?php echo $node->title;?>" style="display:inline" />
															</strong>
															<img id="hoverimg" src="/?q=sites/default/files/styles/check_tech_stuff_hover/public/<?php echo str_replace("public://","",$node->field_tech_stuff_image['und'][0]['uri']);?>" rel="<?php echo str_replace("public://","",$node->field_tech_stuff_image['und'][0]['uri']);?>" class="zoomLt" alt="<?php echo $node->title;?>" style="display:none" />
														<a href="#" title="<?php echo $node->title;?>" class="zoomIt">&nbsp;</a>
																	</div>
														
													
													</div><!-- photo gallery Holder -->
												<?php
												//if($node->field_tech_stuff_forum_link['und'][0]['value']!='')
													//{
												?>
												  <a href="<?php echo $node->field_tech_stuff_forum_link['und'][0]['value'];?>" target="_blank" class="discussBtn"><span>View Forum Discussion</span></a>
												<?php
													//}
												?>
											</div><!-- new photo galler -->
												
											
											<div class="descripptionFlow">
												<?php
												if(count($descArray)>1)
												{
													for($i=0; $i<count($node->body['und'][0]['safe_value']); $i++)
														{
														?>
															<div class="desc" id="p<?php echo $i; ?>"<?php if($i>0) { ?> style="display:none;"<?php } ?>>
														<?php
															$node->body['und'][0]['safe_value'][$i]=str_replace("&lt;!--pagebreak--&gt;","",$node->body['und'][0]['safe_value'][$i]);
														//	$node->body['und'][0]['safe_value'][$i]=str_replace("&lt;!--pagebreak--&gt;","",$node->body['und'][0]['safe_value'][$i]);
															$node->body['und'][0]['safe_value'][$i]=str_replace("&gt;","",$node->body['und'][0]['safe_value'][$i]);
															$node->body['und'][0]['safe_value'][$i]=str_replace("&lt;","",$node->body['und'][0]['safe_value'][$i]);
															$node->body['und'][0]['safe_value'][$i]=str_replace("<div>","",$node->body['und'][0]['safe_value'][$i]);
															$node->body['und'][0]['safe_value'][$i]=str_replace("</div>","",$node->body['und'][0]['safe_value'][$i]);
															$node->body['und'][0]['safe_value'][$i]=str_replace("<p></p>","",$node->body['und'][0]['safe_value'][$i]);
															$node->body['und'][0]['safe_value'][$i]=str_replace('<em class="placeholder">!--</em>start--',"<strong class='reviewQuotes'><span class='openingQuotes'>&ldquo;</span>",$node->body['und'][0]['safe_value'][$i]);
															$node->body['und'][0]['safe_value'][$i]=str_replace('<em class="placeholder">!--</em>end--',"<span class='closingQuots'>&rdquo;</span></strong>",$node->body['und'][0]['safe_value'][$i]);
																if($i!=0)
																{
																echo "<p>";
																}
															
$node->body['und'][0]['safe_value'][$i]=str_replace("http://www.team-bhp.com","https://www.team-bhp.com",$node->body['und'][0]['safe_value'][$i]);
															print $node->body['und'][0]['safe_value'][$i];
															if($i!=0)
																{
																echo "</p>";
																}
															if($i<count($descArray)-1)
															{
															?>
															<a title="Next Page" href="#p<?php echo $i+1; ?>" class="next">Next Page ></a>
															<?php
															}
														?>
															</div>
														<?php
														}
												}
												else
												{
												?>
													<div class="desc">
												<?php
$node->body['und'][0]['safe_value']=str_replace("http://www.team-bhp.com","https://www.team-bhp.com",$node->body['und'][0]['safe_value']);
				
													echo $node->body['und'][0]['safe_value'];
												?>
													</div>
												<?php
												}
												?>
											</div><!-- description flow -->
											
													<div class="fright ">
														<?php
														//include ("includes/common/inner-pagination.php");
														if(count($descArray)>1)
														{
														?>
															<div class="clearfix InnerPagination">
																<ul class="pagination">
																	<li class="first">Page</li>
																	<?php
																	for($i=0; $i<count($descArray); $i++)
																	{
																	?>
																	<li><a title="go to page <?php echo $i+1; ?>"<?php if($i==0) {?> class="active"<?php } ?> href="#p<?php echo $i; ?>"><?php echo $i+1; ?></a></li>
																	<?php
																	}
																	?>
																</ul>
															</div>
														<?php
														}
														?>
													</div>
											
											<div class="clearfix">&nbsp;</div>
											
										</div><!-- full news -->
										
										
									</div><!-- news deatils -->
								</div>
							</div><!-- tab content -->
								
							<?php 
							include ("includes/common/navigate-articles-techstuff.php"); ?>
							
							<?php include ("includes/realated-articles-techstuff.php"); ?>
							
						</div><!-- article -->
