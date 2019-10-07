<?php
$descArray = explode('<!--pagebreak-->', $node->field_advice_content['und'][0]['safe_value']);
?>
<script type="text/javascript">
function redirectbycat(catname)
	{
	window.location='http://www.team-bhp.com/?q=advice&catname='+catname;
	}
	<?php
		if(sizeof($descArray)==1)
			{
	?>
(function (jQuery) {
	jQuery(function(){
var oldImgSrc, oldImgHeight, oldImgWidth, imgSrc;
	jQuery(".zoomSingleImg").hover(
	  function () {
			oldImgSrc = jQuery(this).find("img").attr("src");
			oldImgHeight = jQuery(this).find("img").attr("height");
			oldImgWidth = jQuery(this).find("img").attr("width");
			imgSrc = jQuery(this).find("img").attr("src");
			//jQuery(this).css("height", 480);
			//jQuery(this).css("width", 640);
			jQuery(this).find("img").addClass("zoomImg");
			//jQuery(this).find("img").removeAttr("width");
			//jQuery(this).find("img").removeAttr("height");
			jQuery(this).find("img").attr("src", imgSrc);
			jQuery(this).find("img").attr("height", 480);
			jQuery(this).find("img").attr("width", 640);
	  }, 
	  function () {
			jQuery(this).find("img").removeClass("zoomImg");
			jQuery(this).find("img").attr("src", oldImgSrc);
			jQuery(this).find("img").attr("height", 161);
			jQuery(this).find("img").attr("width", 215);
	  }
	);
		});
	})(jQuery);
		<?php
			}
		?>
</script>
						<div class="article">
							<h1 class="padL20 marB10">Advice</h1>
							
							<ul class="tab TLR5 clearfix">
								<li><a href="#" class="TLR5<?php if($node->field_advice_categories['und'][0]['value']=='All'){?> active<?php }?>" title="All" onclick="javascript:redirectbycat('All');return false;">All</a></li>
								<li><a href="#" class="TLR5<?php if($node->field_advice_categories['und'][0]['value']=='On Buying'){?> active<?php }?>" title="On Buying" onclick="javascript:redirectbycat('<?php echo urldecode('On Buying');?>');return false;">On Buying </a></li>
								<li><a href="#" class="TLR5<?php if($node->field_advice_categories['und'][0]['value']=='On Owning'){?> active<?php }?>" title="On Selling" onclick="javascript:redirectbycat('<?php echo urldecode('On Owning');?>');return false;">On Owning</a></li>
								<li><a href="#" class="TLR5<?php if($node->field_advice_categories['und'][0]['value']=='On Modifying'){?> active<?php }?>" title="On Modifying" onclick="javascript:redirectbycat('<?php echo urldecode('On Modifying');?>');return false;">On Modifying</a></li>
								<li><a href="#" class="TLR5<?php if($node->field_advice_categories['und'][0]['value']=='Miscellany'){?> active<?php }?>" title="Miscellany" onclick="javascript:redirectbycat('<?php echo urldecode('Miscellany');?>');return false;">Miscellany</a></li>								
							</ul>
							
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
											//include ("includes/common/inner-pagination.php");
											//$descArray = explode('<!--pagebreak-->', $node->field_advice_content['und'][0]['safe_value']);
											if(count($descArray)>1)
											{
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
														return false;
													});
													jQuery('ul.pagination li a').click(function(){
														jQuery('.desc').css('display', 'none');
														jQuery('ul.pagination li a').removeClass('active');
														jQuery('ul.pagination li a[href="'+jQuery(this).attr('href')+'"]').addClass('active');
														jQuery(jQuery(this).attr('href')).css('display', 'block');
														return false;
													});
													
													var oldImgSrc, oldImgHeight, oldImgWidth, imgSrc;
													jQuery(".zoomSingleImg").hover(
													  function () {
															oldImgSrc = jQuery(this).find("img").attr("src");
															oldImgHeight = jQuery(this).find("img").attr("height");
															oldImgWidth = jQuery(this).find("img").attr("width");
															imgSrc = jQuery(this).find("img").attr("src");
															//jQuery(this).css("height", 480);
															//jQuery(this).css("width", 640);
															jQuery(this).find("img").addClass("zoomImg");
															//jQuery(this).find("img").removeAttr("width");
															//jQuery(this).find("img").removeAttr("height");
															jQuery(this).find("img").attr("src", imgSrc);
															jQuery(this).find("img").attr("height", 480);
															jQuery(this).find("img").attr("width", 640);
													  }, 
													  function () {
															jQuery(this).find("img").removeClass("zoomImg");
															jQuery(this).find("img").attr("src", oldImgSrc);
															jQuery(this).find("img").attr("height", 161);
															jQuery(this).find("img").attr("width", 215);
													  }
													);
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
											<?php
											if($node->field_advice_media_type['und'][0]['value']=='Image')
													{
											?>
											<div class="fleft newPhotoGallery marB10 clearfix">
												<div class="photogalleryHolder marB10 clearfix">
												
												<div class="mainPhoto zoomSingleImg">
														<img src="http://www.team-bhp.com/?q=sites/default/files/styles/extra_large_for_review/public/<?php echo str_replace("public://","",$node->field_advice_images['und'][0]['uri']);?>" rel="<?php echo str_replace("public://","",$node->field_advice_images['und'][0]['uri']);?>" class="zoomLt" alt="<?php echo $node->title;?>" width="215" height="161" />
														<a href="#" title="<?php echo $node->title;?>" class="zoomIt">&nbsp;</a>
													</div>
													
												
												</div><!-- photo gallery Holder -->
												<?php
												if($node->field_advice_forum['und'][0]['url']!='')
													{
												?>
												<a href="<?php echo $node->field_advice_forum['und'][0]['url'];?>" target="_blank" class="discussBtn"><span>View Forum Discussion</span></a>
												<?php
													}
												?>
											</div><!-- new photo galler -->
												<?php
													}
													else
													{
														if(strpos($node->field_advice_video['und'][0]['url'], "youtu.be/")>1)
												  	    {
														$uVid = substr($node->field_advice_video['und'][0]['url'], 16);
														}
														else
														{
														$strfinded="&feature=related";
														$replaced_videosource=@str_replace($strfinded,"", $node->field_advice_video['und'][0]['url']);
														$explodedsource=@explode("=",$replaced_videosource);
														if(strpos($explodedsource[1], '&feature')>0)
															{
															$uVid = substr($explodedsource[1], 0, strpos($explodedsource[1], '&feature'));
															}
														else
															{
															$uVid = $explodedsource[1];
															}
														}
													
													
												?>
												<div class="aln_center marB20 marT20">
																<object width="428" height="256" id="youtubeVideo">
																<param name="movie" value="http://www.youtube.com/v/<?php echo $uVid;?>&hl=en_US&feature=player_embedded&version=3"></param>
																<embed src="http://www.youtube.com/v/<?php echo $uVid;?>&hl=en_US&feature=player_embedded&version=3"
																type="application/x-shockwave-flash" width="428" height="256" wmode="opaque">
																</embed>
																</object>
													</div>	 
													<?php
													}
													?>
											
											<div class="descripptionFlow">
												<?php
												if(count($descArray)>1)
												{
													for($i=0; $i<count($descArray); $i++)
														{
														?>
															<div class="desc" id="p<?php echo $i; ?>"<?php if($i>0) { ?> style="display:none;"<?php } ?>>
														<?php
															echo $descArray[$i];
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
													echo $node->field_advice_content['und'][0]['safe_value'];
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
							include ("includes/common/navigate-articles.php"); ?>
							
							<?php include ("includes/realated-articles.php"); ?>
							
						</div><!-- article -->
