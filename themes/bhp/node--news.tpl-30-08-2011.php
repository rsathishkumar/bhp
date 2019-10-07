<?php
// echo date("Y-m-d",strtotime("-12 days"));
 //echo strtotime("-12 days");
//echo ($node->field_news_images['und'][0]['filename']);
//print_r($node->field_news_media_type['und'][0]['value']);
function returnDate($querydate){ 

$minusdate = date('ymdHi') - date("ymdHi", $querydate);

	if($minusdate > 88697640 && $minusdate < 100000000){ 
    $minusdate = $minusdate - 88697640; 
	} 

    switch ($minusdate) { 

        case ($minusdate < 99): 
                    if($minusdate == 1){ 
                        $date_string = '1 minute ago'; 
                    } 
                    elseif($minusdate > 59){ 
                        $date_string =  ($minusdate - 40).' minutes ago'; 
                    } 
                    elseif($minusdate > 1 && $minusdate < 59){ 
                        $date_string = $minusdate.' minutes ago'; 
                    } 
        break; 

        case ($minusdate > 99 && $minusdate < 2359): 
                    $flr = floor($minusdate * .01); 
                    if($flr == 1 || $flr == 0){ 
                        $date_string = '1 hour ago'; 
                    } 
                    else{ 
                        $date_string =  $flr.' hours ago'; 
                    } 
        break; 
        
        case ($minusdate > 2359 && $minusdate < 310000): 
                    $flr = floor($minusdate * .0001); 
                    if($flr == 1 || $flr == 0){ 
                        $date_string = '1 day ago'; 
                    } 
                    else{ 
                        $date_string =  $flr.' days ago'; 
                    } 
        break; 
        
        case ($minusdate > 310001 && $minusdate < 12320000): 
                    $flr = floor($minusdate * .000001); 
                    if($flr == 1 || $flr == 0){ 
                        $date_string = "1 month ago"; 
                    } 
                    else{ 
                        $date_string =  $flr.' months ago'; 
                    } 
        break; 
        
        case ($minusdate > 100000000): 
                $flr = floor($minusdate * .00000001); 
                if($flr == 1 || $flr == 0){ 
                        $date_string = '1 year ago.'; 
                } 
                else{ 
                        $date_string = $flr.' years ago'; 
                } 
        } 
    return $date_string; 
}	
?>
<link rel="stylesheet" href="themes/bhp/css/lightbox.css" type="text/css" />
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
			
			var oldImgSrc, oldImgHeight, oldImgWidth, imgSrc;
				jQuery(".zoomSingleImg").hover(
				  function () {
						oldImgSrc = jQuery(this).find("img").attr("src");
						oldImgHeight = jQuery(this).find("img").attr("height");
						oldImgWidth = jQuery(this).find("img").attr("width");
						imgSrc = jQuery(this).find("img").attr("src");
						jQuery(this).css("height", oldImgHeight)
						jQuery(this).find("img").addClass("zoomImg");
						jQuery(this).find("img").removeAttr("width");
						jQuery(this).find("img").removeAttr("height");
						jQuery(this).find("img").attr("src", imgSrc);
				  }, 
				  function () {
						jQuery(this).find("img").removeClass("zoomImg");
						jQuery(this).find("img").attr("src", oldImgSrc);
						jQuery(this).find("img").attr("height", oldImgHeight);
						jQuery(this).find("img").attr("width", oldImgWidth);
				  }
				);
													
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
				<li><a href="#" class="TLR5" title="All" onclick="shownews_cat('%'); return false;">All</a></li>
				<li><a href="#" class="TLR5<?php if($node->field_news_category['und'][0]['value']=='Indian') { ?> active<?php } ?>" title="Indian" onclick="shownews_cat('Indian'); return false;">Indian</a></li>
				<li><a href="#" class="TLR5<?php if($node->field_news_category['und'][0]['value']=='International') { ?> active<?php } ?>" title="International" onclick="shownews_cat('International'); return false;">International</a></li>
				<li><a href="#" class="TLR5<?php if($node->field_news_category['und'][0]['value']=='Motor Sports') { ?> active<?php } ?>" title="Motor Sports" onclick="shownews_cat('Motor Sports'); return false;">Motor Sports</a></li>
			</ul>
			
			<div class="tab_container BLR5 marB10">
				<div class="tab_content" style="display:block">
					<div class="news_details clearfix">
						<div class="clearfix">
							<div class="fleft w460">
								<h1><?php echo $node->title;?> </h1>
								<div class="postDate"><?php echo returnDate($node->created); ?></div>
							</div><!-- fleft -->
							<?php include ("includes/common/share.php") ?>
						</div><!--clearfix -->
						
						<div class="clearfix">
							<div class="fright ">
							<?php
							//include ("includes/common/inner-pagination.php");
							$descArray = explode('!--pagebreak--',$node->field_news_content['und'][0]['safe_value']);
							if(count($descArray)>1)
							{
							?>
							<script type="text/javascript">
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
								});
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
							<?php
							}
							?>
							</div><!-- inner pagination -->
						</div>
						
						<div class="full_news marT10 clearfix">
							<?php
							
								if($node->field_news_media_type['und'][0]['value']=='Images')
									{
							if(sizeof($node->field_news_images['und'])>0)
									 {
							?>
							<div class="fleft PhotoGallery">
								<div class="photogalleryHolder clearfix marB15">
								<?php 
								if(sizeof($node->field_news_images['und'])>0)
									 {
									?>
										<a href="http://www.team-bhp.com/?q=sites/default/files/styles/extra_large_for_review/public/<?php echo str_replace("public://","",$node->field_news_images['und'][0]['uri']);?>" class="lightbox mainPhoto" title="<?php echo $node->title;?> ">
											<!--<img src="http://www.team-bhp.com/sites/default/files/<?php echo str_replace("public://","",$node->field_news_images['und'][0]['uri']);?>" id="mainPhoto" alt="car" width="370" height="278" alt="<?php echo $node->title;?> " />-->
											<img src="http://www.team-bhp.com/?q=sites/default/files/styles/large_review/public/<?php echo str_replace("public://","",$node->field_news_images['und'][0]['uri']);?>" id="mainPhoto" alt="<?php echo $node->title;?>" width="370" height="278" alt="<?php echo $node->title;?> " />
											<a href="http://www.team-bhp.com/?q=sites/default/files/styles/extra_large_for_review/public/<?php echo str_replace("public://","",$node->field_news_images['und'][0]['uri']);?>" title="<?php echo $node->title;?> " class="lightbox zoomIt">&nbsp;</a>
										</a>
									<?php 											
									}
									
									if(sizeof($node->field_news_images['und'])>0)
										{
									?>
									<ul class="gallery_thumb clearfix marT10 marB5">
										
										<li>
											<a class="active" href="http://www.team-bhp.com/?q=sites/default/files/styles/extra_large_for_review/public/<?php echo str_replace("public://","",$node->field_news_images['und'][0]['uri']);?>" title="car">
												<!--<img src="http://www.team-bhp.com/sites/default/files/<?php echo str_replace("public://","",$node->field_news_images['und'][0]['uri']);?>" alt="car" width="70" height="53" />-->
												<img src="http://www.team-bhp.com/?q=sites/default/files/styles/thumb_review_detail/public/<?php echo str_replace("public://","",$node->field_news_images['und'][0]['uri']);?>" alt="car" width="70" height="53" />
											</a>
										</li>
										<?php
										if(sizeof($node->field_news_images['und'])>1)
										{
										?>
										<li>
											<a href="http://www.team-bhp.com/?q=sites/default/files/styles/extra_large_for_review/public/<?php echo str_replace("public://","",$node->field_news_images['und'][1]['uri']);?>" title="car">
												<img src="http://www.team-bhp.com/?q=sites/default/files/styles/thumb_review_detail/public/<?php echo str_replace("public://","",$node->field_news_images['und'][1]['uri']);?>" alt="car" width="70" height="53" />
											</a>
										</li>
										<?php
										}
										if(sizeof($node->field_news_images['und'])>2)
										{
										?>
										<li>
											<a href="http://www.team-bhp.com/?q=sites/default/files/styles/extra_large_for_review/public/<?php echo str_replace("public://","",$node->field_news_images['und'][2]['uri']);?>" title="car">
												<img src="http://www.team-bhp.com/?q=sites/default/files/styles/thumb_review_detail/public/<?php echo str_replace("public://","",$node->field_news_images['und'][2]['uri']);?>" alt="car" width="70" height="53" />
											</a>
										</li>
										<?php
										}
										if(sizeof($node->field_news_images['und'])>3)
										{
										?>
										<li>
											<a href="http://www.team-bhp.com/?q=sites/default/files/styles/extra_large_for_review/public/<?php echo str_replace("public://","",$node->field_news_images['und'][3]['uri']);?>" title="car" class="last">
												<img src="http://www.team-bhp.com/?q=sites/default/files/styles/thumb_review_detail/public/<?php echo str_replace("public://","",$node->field_news_images['und'][3]['uri']);?>" alt="car" width="70" height="53" />
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
								<?php
								if($node->field_new_forum['und'][0]['url']!='')
									{
								?>
								<a href="<?php echo $node->field_new_forum['und'][0]['url'];?>" target="_blank" class="discussBtn"><span>View Forum Discussion</span></a>
								<?php
									}
								?>
							</div><!-- new photo galler -->
							<?php
									}
								}
								else
								{
									if(strpos($node->field_news_video['und'][0]['url'], "youtu.be/")>1)
								  	    {
										$uVid = substr($node->field_news_video['und'][0]['url'], 16);
										}
										else
										{
										$strfinded="&feature=related";
										$replaced_videosource=@str_replace($strfinded,"", $node->field_news_video['und'][0]['url']);
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
								$positionofhttp='';
								if($node->field_new_forum['und'][0]['url']!='')
									{
									$restofind=strstr($node->field_new_forum['und'][0]['url'],"http://");
								?>
								<a href="<?php if($restofind=='') { echo "http://"; }echo $node->field_new_forum['und'][0]['url'];?>" target="_blank" class="discussBtn"><span>View Forum Discussion</span></a>
								<br /> 
								<br />
								<?php
									}
									
								}
								
								//print_r($node);
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
											$str_toreplace=str_replace("&amp;l","",$descArray[$i]);
											$str_toreplace=str_replace("&lt;","",$str_toreplace);
											if($i!=0)
												{
												echo "<p>";
												}
											echo $str_toreplace=str_replace("&gt;","",$str_toreplace);
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
									echo $node->field_news_content['und'][0]['safe_value'];
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
							</div><!-- inner pagination -->
							
							<div class="clearfix">&nbsp;</div>
							
							<div class="clearfix marT20">
								<?php include ("includes/common/tags.php") ?>
							</div><!-- tags  --> 
						</div><!-- full news -->
						
						
					</div><!-- news deatils -->
				</div><!-- tab content -->
			</div><!-- tab container -->
			<div class="clearfix articleNavi">
				<a href="?q=news" class="fleft btnLeft"><span>Back to Index</span></a>
				<?php
					$res = mysqli_query("select nid from node where type='news' and nid>".$node->nid." limit 1");
					if(mysqli_num_rows($res)>0)
					{
					$res1 = mysqli_fetch_array($res);
					$res_url = mysqli_query("select alias from url_alias where source='node/".$res1['nid']."'");
					}
					else
					{
					$res1 = mysqli_fetch_array(mysqli_query("select nid from node where type='news' and nid<".$node->nid." limit 1"));
					$res_url = mysqli_query("select alias from url_alias where source='node/".$res1['nid']."'");
					}
					$result = mysqli_fetch_array($res_url);
				?>
				<a href="?q=<?php echo $result['alias']; ?>" class="fright btnRight"><span>Next Article</span></a>
			</div>
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
