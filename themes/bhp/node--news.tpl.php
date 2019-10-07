<?php
$con=mysqli_connect("localhost","root","root",'teambhp_site');

$sql_imglist=mysqli_query($con,"SELECT file_managed.uri FROM `file_managed` , field_data_field_news_images
WHERE field_data_field_news_images.field_news_images_fid = file_managed.`fid`
AND field_data_field_news_images.entity_id =".$node->nid);
// echo date("Y-m-d",strtotime("-12 days"));
 //echo strtotime("-12 days");
//echo ($node->field_news_images['und'][0]['filename']);
//print_r($node->field_news_media_type['und'][0]['value']);
/*function returnDate($querydate){ 

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
}	*/
				function returnDate($timestamp)
					{
						$difference = time() - $timestamp;
						/*$periods = array('second', 'minute', 'hour', 'day', 'week', 'month', 'year');
						$multiples = array('seconds', 'minutes', 'hours', 'days', 'weeks', 'months', 'years');
						$lengths = array('60', '60', '24', '7', '4.35', '12');
						for ($i=0; $difference >= $lengths[$i]; $i++)
						{
							$difference /= $lengths[$i];
						}
						$difference = round($difference);
						if ($difference != 1)
						{
							$periods[$i] = $multiples[$i];
						}
						$text = $difference.' '.$periods[$i];
						return $text ." ago";*/
						 $seven_daysbefore = time() - strtotime(" - 7 day");
						
							if($difference<=$seven_daysbefore)
								{
								$periods = array('second', 'minute', 'hour', 'day', 'week', 'month', 'year');
								$multiples = array('seconds', 'minutes', 'hours', 'days', 'weeks', 'months', 'years');
								$lengths = array('60', '60', '24', '7', '4.35', '12');
								for ($i=0; $difference >= $lengths[$i]; $i++)
								{
									$difference /= $lengths[$i];
								}
								$difference = round($difference);
								if ($difference != 1)
								{
									$periods[$i] = $multiples[$i];
								}
								$text = $difference.' '.$periods[$i];
								if($text=="7 days")
									{
								$text = date("jS F Y, H:i",$timestamp);
								return $text;
									}
									else
									{
								return $text ." ago";
									}
								
								//return date("Y-m-d",$timestamp);	
								}
								else
								{
						    	return date("jS F Y, H:i",$timestamp);
								}
						
					}
?>
<link rel="stylesheet" href="/themes/bhp/css/lightbox.css" type="text/css" />
<script type="text/javascript">		    
		(function ($) {  $(function(){
			$("ul.tab li a").click(function(){
				location.href = "/news?catname="+$(this).attr("title");
			});
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
			/*$(".gallery_thumb li").click(function(){
    			$(".gallery_thumb li a").removeClass("active");
    			$(this).find("a").addClass("active");
    			$("img#mainPhoto").attr("src", $(this).find("a").attr("href"));
    			imgsrc=$(this).find("a").attr("href").replace("check_large_review", "check_extra_large_for_review");
    			$(".lightbox").attr("href", imgsrc);
    			return false;
    		});*/
				
    		$(".gallery_thumb li").click(function(){
    			var index = $(".gallery_thumb li").index(this);
    			if($(this).find("a").hasClass("active")==false)
    			{
	    			$(".photogalleryHolder").find(".mainPhoto").css("display", "none").removeClass("active");
	    			$(".photogalleryHolder").find(".zoomIt").css("display", "none");
    				$(".photogalleryHolder").find(".mainPhoto").eq(index).fadeIn(600).addClass("active");
    				$(".photogalleryHolder").find(".zoomIt").eq(index).fadeIn(600);
    				$(".gallery_thumb li").find("a").removeClass("active");
    				$(this).find("a").addClass("active");
	    		}
    			return false;
    		});
			$(".lightbox").lightbox();
		});
})(jQuery);
	</script>
<div id="leftColumn" class="clearfix fleft">
		<div class="article">
			<h1 class="padL20 marB10">News</h1>
			<div class="compareBox active">
				<div class="campareBar">
					<h3>News</h3>
				</div>
			</div>
			<div class="tab_container BLR5 marB10">
				<div class="tab_content" style="display:block">
					<div class="news_details clearfix">
						<div class="clearfix">
							<div class="fleft w460">
								<h1><?php echo $node->title;?> </h1>
								<div class="postDate"><?php echo returnDate($node->created); ?> <span style="color:#cccccc;">by</span> <a href="../aboutus/team"><?php print $name; ?></a></div>								
							</div><!-- fleft -->
							<?php include ("includes/common/share.php") ?>
						</div><!--clearfix -->
						
						<div class="clearfix">
							<div class="fright ">
							<?php
							//include ("includes/common/inner-pagination.php");
							$descArray = explode('&lt;!--pagebreak--&gt;',$node->field_news_content['und'][0]['safe_value']);
							if(count($descArray)>1)
							{
							$node->field_news_content['und'][0]['safe_value'] = explode('!--pagebreak--',$node->field_news_content['und'][0]['safe_value']);
							
							?>
							<script type="text/javascript">
								jQuery(function(){
									jQuery('.next').click(function(){
										jQuery('.desc').css('display', 'none');
										jQuery(jQuery(this).attr('href')).css('display', 'block');
										jQuery('ul.pagination li a').removeClass('active');
										jQuery('ul.pagination li a[href="'+jQuery(this).attr('href')+'"]').addClass('active');
										jQuery('html, body').animate({scrollTop: jQuery("h1.padL20").offset().top-10}, 300);
										if(jQuery(this).attr('href')=='#p0')
											{
											$("#mainfotocontainer").css("display","block");
											}
										else
											{
											$("#mainfotocontainer").css("display","none");
											}
										return false;
									});
									jQuery('ul.pagination li a').click(function(){
										jQuery('.desc').css('display', 'none');
										jQuery('ul.pagination li a').removeClass('active');
										jQuery('ul.pagination li a[href="'+jQuery(this).attr('href')+'"]').addClass('active');
										jQuery('html, body').animate({scrollTop: jQuery("h1.padL20").offset().top-10}, 300);
										jQuery(jQuery(this).attr('href')).css('display', 'block');
										if(jQuery(this).attr('href')=='#p0')
											{
											$("#mainfotocontainer").css("display","block");
											}
										else
											{
											$("#mainfotocontainer").css("display","none");
											}
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
							<div class="fleft PhotoGallery" id="mainfotocontainer">
								<div class="photogalleryHolder clearfix marB15">
								<?php 
								$cnt_newsimg=0;
								if(sizeof($node->field_news_images['und'])>0)
									 {
									 while($data_news=mysqli_fetch_assoc($sql_imglist))
									 	{
									?>
										<a href="/?q=sites/default/files/styles/check_extra_large_for_review/public/<?php echo str_replace("public://","",$data_news['uri']);?>" class="lightbox mainPhoto<?php  if($cnt_newsimg==0) { ?> active<?php } ?>"<?php if($cnt_newsimg==0) {?> style="display:table"<?php } else {?> style="display:none"<?php }?> title="<?php echo $node->title;?>" rel="lightbox[news]">
											<!--<img src="/sites/default/files/<?php //echo str_replace("public://","",$node->field_news_images['und'][0]['uri']);?>" id="mainPhoto" alt="car" width="370" height="278" alt="<?php //echo $node->title;?> " />-->
											<strong>
												<img src="/?q=sites/default/files/styles/check_large_review/public/<?php echo str_replace("public://","",str_replace(" ","%20",$data_news['uri']));?>"<?php if($cnt_newsimg==0) {?> id="mainPhoto"<?php } ?> alt="<?php echo $node->title;?> " />
											</strong>
										</a>
										<a href="/?q=sites/default/files/styles/check_extra_large_for_review/public/<?php echo str_replace("public://","",$data_news['uri']);?>" title="<?php echo $node->title;?>" class="lightbox zoomIt"<?php if($cnt_newsimg==0) {?> style="display:block"<?php } else {?> style="display:none"<?php }?>  rel="lightbox[news]">&nbsp;</a>
									<?php
									$cnt_newsimg++;
										}
									}
									
									if(sizeof($node->field_news_images['und'])>0)
										{
									?>
									<div class="clearfix">&nbsp;</div>
									<ul class="gallery_thumb marT10 clearfix marB5">
										
										<li>
											
											<a class="active" href="/?q=sites/default/files/styles/check_large_review/public/<?php echo str_replace("public://","",$node->field_news_images['und'][0]['uri']);?>" title="<?php echo $node->title;?>">
												<strong>
												<!--<img src="/sites/default/files/<?php echo str_replace("public://","",$node->field_news_images['und'][0]['uri']);?>" alt="car" width="70" height="53" />-->
												<img src="/?q=sites/default/files/styles/check_thumb_review_detail/public/<?php echo str_replace("public://","",$node->field_news_images['und'][0]['uri']);?>" alt="<?php echo $node->title?>" />
												</strong>
											</a>
											
										</li>
										<?php
										if(sizeof($node->field_news_images['und'])>1)
										{
										?>
										<li>
											<a href="/?q=sites/default/files/styles/check_large_review/public/<?php echo str_replace("public://","",$node->field_news_images['und'][1]['uri']);?>" title="<?php echo $node->title?>">
												<strong>
												<img src="/?q=sites/default/files/styles/check_thumb_review_detail/public/<?php echo str_replace("public://","",$node->field_news_images['und'][1]['uri']);?>" alt="<?php echo $node->title?>" />
												</strong>
											</a>
										</li>
										<?php
										}
										if(sizeof($node->field_news_images['und'])>2)
										{
										?>
										<li>
											<a href="/?q=sites/default/files/styles/check_large_review/public/<?php echo str_replace("public://","",$node->field_news_images['und'][2]['uri']);?>" title="<?php echo $node->title?>">
												<strong>
												<img src="/?q=sites/default/files/styles/check_thumb_review_detail/public/<?php echo str_replace("public://","",$node->field_news_images['und'][2]['uri']);?>" />
												</strong>
											</a>
										</li>
										<?php
										}
										if(sizeof($node->field_news_images['und'])>3)
										{
										?>
										<li>
											<a href="/?q=sites/default/files/styles/check_large_review/public/<?php echo str_replace("public://","",$node->field_news_images['und'][3]['uri']);?>" title="<?php echo $node->title?>" class="last">
												<strong>
												<img src="/?q=sites/default/files/styles/check_thumb_review_detail/public/<?php echo str_replace("public://","",$node->field_news_images['und'][3]['uri']);?>" alt="<?php echo $node->title?>"  />
												</strong>
											</a>
										</li>
										<?php
										}
										?>
									</ul>
									<div class="clearfix"></div>
									<?php
									}
									?>
								</div><!-- photo gallery Holder -->
								<?php
								if($node->field_new_forum['und'][0]['url']!='')
									{
								?>
								<a href="<?php echo bhp_replace_http_strings($node->field_new_forum['und'][0]['url']);?>" target="_blank" class="discussBtn"><span>View Forum Discussion</span></a>
								<?php
									}
								?>
							</div><!-- new photo galler -->
							<?php
									   }
								}
								else
								{
									/*if(strpos($node->field_news_video['und'][0]['url'], "youtu.be/")>1)
								  	    {
										$uVid = substr($node->field_news_video['und'][0]['url'], 16);
										}
										else
										{
										$strfinded="&feature=related";
										$replaced_videosource=@str_replace($strfinded,"", $node->field_news_video['und'][0]['url']);
										$explodedsource=@explode("=",$replaced_videosource);
										//print_r($explodedsource);
										if(strpos($explodedsource[1], '&feature')>0)
											{
											$uVid = substr($explodedsource[1], 0, strpos($explodedsource[1], '&feature'));
											}
										else
											{
											$uVid = $explodedsource[1];
											}
										}*/
										if(strpos($node->field_news_video['und'][0]['title'], "youtu.be/")>1)
								  	    {
										$uVid = substr($node->field_news_video['und'][0]['title'], 16);
										}
										else
										{
										$strfinded="&feature=related";
										$replaced_videosource=@str_replace($strfinded,"", $node->field_news_video['und'][0]['title']);
										$explodedsource=@explode("=",$replaced_videosource);
										//print_r($explodedsource);
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
											<!--<object width="428" height="256" id="youtubeVideo">
											<param name="movie" value="https://www.youtube.com/v/<?php echo $uVid;?>&hl=en_US&feature=player_embedded&version=3"></param>
											<embed src="https://www.youtube.com/v/<?php echo $uVid;?>&hl=en_US&feature=player_embedded&version=3"
											type="application/x-shockwave-flash" width="428" height="256" wmode="opaque">
											</embed>
											</object>
											!-->

									  <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $uVid;?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>


								</div>
								<?php
								$positionofhttp='';
								if($node->field_new_forum['und'][0]['url']!='')
									{
									$restofind=strstr($node->field_new_forum['und'][0]['url'],"http://");
								?>
								<a href="<?php echo bhp_replace_http_strings($node->field_new_forum['und'][0]['url']);?>" target="_blank" class="discussBtn"><span>View Forum Discussion</span></a>
								<br /> 
								<br />
								<?php
									}
									
								}
								
								//print_r($node);
							?>
							<div class="descripptionFlow">
								<?php
								//print_r($node->field_news_content['und'][0]['safe_value']);
								if(count($descArray)>1)
								{
									for($i=0; $i<count($descArray); $i++)
										{
										$flag=1;
										?>
											<div class="desc" id="p<?php echo $i; ?>"<?php if($i>0) { ?> style="display:none;"<?php } ?>>
										<?php
											/*$search = array('&gt;', '&lt;','&lt; ');
											$replace = array('','','');*/
											
											$node->field_news_content['und'][0]['safe_value'][$i]=str_replace("&lt;!--pagebreak--&gt;","",$node->field_news_content['und'][0]['safe_value'][$i]);
											$node->field_news_content['und'][0]['safe_value'][$i]=str_replace("&gt;","",$node->field_news_content['und'][0]['safe_value'][$i]);
											$node->field_news_content['und'][0]['safe_value'][$i]=str_replace("&lt;","",$node->field_news_content['und'][0]['safe_value'][$i]);
											$node->field_news_content['und'][0]['safe_value'][$i]=str_replace("<div>","",$node->field_news_content['und'][0]['safe_value'][$i]);
											$node->field_news_content['und'][0]['safe_value'][$i]=str_replace("</div>","",$node->field_news_content['und'][0]['safe_value'][$i]);
											$node->field_news_content['und'][0]['safe_value'][$i]=str_replace("<p></p>","",$node->field_news_content['und'][0]['safe_value'][$i]);
											$node->field_news_content['und'][0]['safe_value'][$i]=str_replace('<em class="placeholder">!--</em>start--',"<strong class='reviewQuotes'><span class='openingQuotes'>&ldquo;</span>",$node->field_news_content['und'][0]['safe_value'][$i]);
											$node->field_news_content['und'][0]['safe_value'][$i]=str_replace('<em class="placeholder">!--</em>end--',"<span class='closingQuots'>&rdquo;</span></strong>",$node->field_news_content['und'][0]['safe_value'][$i]);
												if($i!=0)
												{
												echo "<p>";
												}
												print $node->field_news_content['und'][0]['safe_value'][$i];
											//echo str_replace($search, $replace, $descArray[$i]);
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
				<a href="/news" class="fleft btnLeft"><span>Back to Index</span></a>
				<?php
				    //echo $qry = "select nid from node,field_data_field_news_category where node.nid=field_data_field_news_category.entity_id and field_data_field_news_category.field_news_category_value='".$node->field_news_category['und'][0]['value']."' and type='news' and nid < '".$node->nid."' and status= 1 order by created desc limit 1";
					//$res = mysqli_query("select nid from node where type='news' and status= 1 and nid>".$node->nid." limit 1");
					if($_REQUEST['t']!='')
						{
						$res = @mysqli_query("select node.nid as nid from node,field_data_field_news_tags where type='news' and node.nid=field_data_field_news_tags.entity_id and field_data_field_news_tags.field_news_tags_tid='".base64_decode($_REQUEST['t'])."' and node.nid < '".$node->nid."' and node.status=1 group by node.nid order by node.created desc");
						if(mysqli_num_rows($res)>0)
							{
							$nextarticle=mysqli_fetch_array($res);
							/*$urlals=mysqli_fetch_array((mysqli_query("select alias from url_alias where source = 'node/".$nextarticle['nid']."'")));	
							$nexturl=$urlals['alias']."?t=".base64_encode(base64_decode($_REQUEST['t']));*/
							$nexturl=url("node/".$nextarticle['nid'])."?t=".base64_encode(base64_decode($_REQUEST['t']));
							}
						}
					else if($_REQUEST['model']!='')
						{
						 $res =mysqli_query("select node.nid as nid from node, field_data_field_news_category, field_data_field_news_make where type='news' and node.nid=field_data_field_news_category.entity_id and field_data_field_news_make.entity_id=node.nid and field_data_field_news_make.field_news_make_nid='".base64_decode($_REQUEST['model'])."' and node.nid < '".$node->nid."' and node.status=1 order by node.created desc");
					 	 if(mysqli_num_rows($res)>0)
							{
							$nextarticle=mysqli_fetch_array($res);
							/*$urlals=mysqli_fetch_array((mysqli_query("select alias from url_alias where source = 'node/".$nextarticle['nid']."'")));	
							$nexturl=$urlals['alias']."?model=".base64_encode(base64_decode($_REQUEST['model']));*/
							$nexturl=url("node/".$nextarticle['nid'])."?model=".base64_encode(base64_decode($_REQUEST['model']));
							}
						}
					else if($_REQUEST['tag']!='')
						{
						 $res =mysqli_query("select node.nid as nid from node, field_data_field_news_cat, field_data_field_news_tags where type='news' and node.nid=field_data_field_news_cat.entity_id and node.nid=field_data_field_news_tags.entity_id and field_data_field_news_cat.field_news_cat_nid='".base64_decode($_REQUEST['tag'])."'  and node.nid < '".$node->nid."' and node.status=1 group by node.nid order by node.created desc");
					 	 if(mysqli_num_rows($res)>0)
							{
							$nextarticle=mysqli_fetch_array($res);
							//$urlals=mysqli_fetch_array((mysqli_query("select alias from url_alias where source = 'node/".$nextarticle['nid']."'")));	
							//$nexturl=$urlals['alias']."?tag=".base64_encode(base64_decode($_REQUEST['tag']));	
							$nexturl=url("node/".$nextarticle['nid'])."?tag=".base64_encode(base64_decode($_REQUEST['tag']));
							}
						}
					else if($_REQUEST['tab']!='')
						{
						$res =mysqli_query("select node.nid as nid, node.created as created, title, field_news_category_value from node, field_data_field_news_category where type='news' and node.nid=field_data_field_news_category.entity_id and field_data_field_news_category.field_news_category_value like '%%%' and node.nid < '".$node->nid."' and node.status=1 order by node.created desc");
					 	 if(mysqli_num_rows($res)>0)
							{
						$nextarticle=mysqli_fetch_array($res);
						//$urlals=mysqli_fetch_array((mysqli_query("select alias from url_alias where source = 'node/".$nextarticle['nid']."'")));	
					    //$nexturl=$urlals['alias']."?tab=1";	
					    $nexturl=url("node/".$nextarticle['nid'])."?tab=1";	
					  		}
						}
						else
						{
					$res = mysqli_query("select nid from node,field_data_field_news_category where node.nid=field_data_field_news_category.entity_id and field_data_field_news_category.field_news_category_value='".$node->field_news_category['und'][0]['value']."' and type='news' and nid < '".$node->nid."' and status= 1 order by created desc limit 1");
						if(mysqli_num_rows($res)>0)
							{
						$nextarticle=mysqli_fetch_array($res);
						$nexturl=url("node/".$nextarticle['nid']);	
					  		}
						}
					
					//$result = mysqli_fetch_array($res_url);
					if(mysqli_num_rows($res)>0)
						{
				?>
				<a href="<?php echo $nexturl;//url("node/".$res1['nid']); ?>" class="fright btnRight"><span>Next Article</span></a>
					<?php
						}
					?>
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
