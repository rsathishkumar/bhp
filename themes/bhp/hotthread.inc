<?php
										include_once("connect.php");
										$limit = 10;
										$slice = 9;
										$start = 1;
										if(!isset($_GET['page']) || !is_numeric($_GET['page']))
											{
											$page = 1;
											} 
											else 
											{
											$page = $_GET['page'];
											}
											
										
		if($_GET['catname']=='' || $_GET['catname']=='%' || $_GET['catname']=='All')
				{
		//$hotthread_res = @mysqli_query(" ORDER BY node.changed DESC limit ".$start.", ".$toshow."") or die(mysql_error());
		 $q = "SELECT node.title,node.changed,node.created,node.nid,field_data_field_ht_summary.field_ht_summary_value,field_data_field_ht_threads.field_ht_threads_value,file_managed.uri,field_data_field_ht_forum.field_ht_forum_url,field_data_field_ht_author.field_ht_author_value as author
		FROM node,file_managed,field_data_field_ht_forum,field_data_field_ht_summary,field_data_field_ht_threads,field_data_field_ht_image,field_data_field_ht_author
		WHERE field_data_field_ht_threads.entity_id = node.nid
		AND file_managed.fid = field_data_field_ht_image.field_ht_image_fid AND node.status=1 AND field_data_field_ht_image.entity_id=node.nid AND field_data_field_ht_summary.entity_id = field_data_field_ht_threads.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_forum.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_threads.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_author.entity_id group by node.nid ORDER BY node.changed DESC";							
			$r = mysqli_query($q);
			$totalrows = mysqli_num_rows($r);
			$numofpages = ceil($totalrows / $limit);
			$limitvalue = $page * $limit - ($limit);
		
	  $q = "SELECT node.title,node.changed,node.created,node.nid,field_data_field_ht_summary.field_ht_summary_value,field_data_field_ht_threads.field_ht_threads_value,file_managed.uri,field_data_field_ht_forum.field_ht_forum_url,field_data_field_ht_author.field_ht_author_value as author
		FROM node,file_managed,field_data_field_ht_forum,field_data_field_ht_summary,field_data_field_ht_threads,field_data_field_ht_image,field_data_field_ht_author
		WHERE field_data_field_ht_threads.entity_id = node.nid
		AND file_managed.fid = field_data_field_ht_image.field_ht_image_fid AND node.status=1 AND field_data_field_ht_image.entity_id=node.nid AND field_data_field_ht_summary.entity_id = field_data_field_ht_threads.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_forum.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_threads.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_author.entity_id group by node.nid ORDER BY node.changed DESC LIMIT $limitvalue, $limit";
				}
				
				else
				{
		 $q = "SELECT node.title,node.changed,node.created,node.nid,field_data_field_ht_summary.field_ht_summary_value,field_data_field_ht_threads.field_ht_threads_value,file_managed.uri,field_data_field_ht_forum.field_ht_forum_url,field_data_field_ht_author.field_ht_author_value as author
		FROM node,file_managed,field_data_field_ht_forum,field_data_field_ht_summary,field_data_field_ht_threads,field_data_field_ht_image,field_data_field_ht_author
		WHERE field_data_field_ht_threads.entity_id = node.nid AND field_data_field_ht_threads.field_ht_threads_value ='".$_GET['catname']."' AND file_managed.fid = field_data_field_ht_image.field_ht_image_fid AND node.status=1 AND field_data_field_ht_image.entity_id=node.nid AND field_data_field_ht_summary.entity_id = field_data_field_ht_threads.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_forum.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_threads.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_author.entity_id group by node.nid ORDER BY node.changed DESC";
			
			$r = mysqli_query($q);
			$totalrows = mysqli_num_rows($r);
			$numofpages = ceil($totalrows / $limit);
			$limitvalue = $page * $limit - ($limit);
			$q ="SELECT node.title,node.changed,node.created,node.nid,field_data_field_ht_summary.field_ht_summary_value,field_data_field_ht_threads.field_ht_threads_value,file_managed.uri,field_data_field_ht_forum.field_ht_forum_url,field_data_field_ht_author.field_ht_author_value as author
		FROM node,file_managed,field_data_field_ht_forum,field_data_field_ht_summary,field_data_field_ht_threads,field_data_field_ht_image,field_data_field_ht_author
		WHERE field_data_field_ht_threads.entity_id = node.nid AND field_data_field_ht_threads.field_ht_threads_value ='".$_GET['catname']."' AND file_managed.fid = field_data_field_ht_image.field_ht_image_fid AND node.status=1 AND field_data_field_ht_image.entity_id=node.nid AND field_data_field_ht_summary.entity_id = field_data_field_ht_threads.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_forum.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_threads.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_author.entity_id group by node.nid ORDER BY node.changed DESC LIMIT $limitvalue, $limit";
				}
	

//function to format date in 'xx days ago'
		function returnDate($querydate)
			{ 
		$minusdate = date('ymdHi') - date("ymdHi", $querydate);
		
		if($minusdate > 88697640 && $minusdate < 100000000)
			{ 
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
							if($flr == 1){ 
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

						   <div class="compareBox active">
									<div class="campareBar">
										<h3><?php if($_GET['catname']=='' || $_GET['catname']=='%') {?>All<?php } else { echo $_GET['catname'];}?></h3>
									</div>
							</div>
							
							<div class="tab_container BLR5 marB10">								
								<div style="display: block;" class="tab_content">
									<ul class="newslist" id="threadlist">
										<?php
											if ($r = mysqli_query($q)) {
											while($d_thread=mysqli_fetch_array($r))
														{
												 $restofind=strstr($d_thread['field_ht_forum_url'],"http://");
												 $noaddata=node_load($d_thread['nid']);
												 $forum_link_is_http=strstr($d_thread['field_ht_forum_url'],"http://");	
												 $forum_link_is_https=strstr($d_thread['field_ht_forum_url'],"https://");
												 $forum_discussion_url = $d_thread['field_ht_forum_url'];
												
												//no leading http or https found

												if (!$forum_link_is_http && !$forum_link_is_https) {

													 $forum_discussion_url = 'https://'.$d_thread['field_ht_forum_url'];
												}

												//link is http, so let us move it to https
						                                                if ($forum_link_is_http) {
													
													 $forum_discussion_url = str_replace('http://', 'https://',  $forum_discussion_url);
												 }
												 //echo $forum_discussion_url;
                                                						 $d_thread['field_ht_forum_url'] = $forum_discussion_url;


												?>
										<li onclick="return updatethreadcounter('<?php echo $forum_discussion_url;?>','<?php echo $d_thread['nid'];?>');" rel="<?php echo $forum_discussion_url;?>">
											<div class="clearfix listHolder">
												<div class="fleft w170">
													<!--<a title="<?php echo $d_thread['title']; ?>"  href="Javascript:void(0);" onclick="updatethreadcounter('<?php echo $forum_discussion_url;?>','<?php echo $d_thread['nid'];?>');">
														<img width="165" height="124" alt="<?php echo  $noaddata->title;?>" src="sites/default/files/<?php echo str_replace("public://","",$d_thread['uri']);?>"> 
                                                    <img width="165" height="124" alt="<?php echo  $noaddata->title;?>" src="/?q=sites/default/files/styles/medium_medium/public/<?php echo str_replace("public://","",$d_thread['uri']);?>">
													</a>-->
													<a class="holderImg" title="<?php echo $d_thread['title']; ?>"  href="<?php echo $forum_discussion_url;?>" target="_blank">
<strong>
														<img alt="<?php echo  $noaddata->title;?>" src="/?q=sites/default/files/styles/check_medium_medium/public/<?php echo str_replace("public://","",$d_thread['uri']);?>"></strong>
													</a>
												</div><!-- News thum holder -->
												
												<div class="fright w460 ShortNews">
													<h2><a title="<?php echo $noaddata->title;?>"  href="<?php echo $forum_discussion_url;?>" target="_blank"><?php  echo $noaddata->title;?></a></h2>
													<div class="postDate">Posted <?php //echo returnDate($d_thread['changed']); ?> by: <?php echo $d_thread['author']; ?></div>
													<div class="past_shornote">
														<?php if(strlen($noaddata->field_ht_summary['und'][0]['value'])>195)
															{
															$finddot=@strpos($noaddata->field_ht_summary['und'][0]['value'],".",195);
															$findspcetostop=@strpos($noaddata->field_ht_summary['und'][0]['value']," ",195);
															if(intval($finddot)<intval($findspcetostop) && intval($finddot)>1)
																{
																$pos=$finddot;
																}
															else
																{
																$pos=$findspcetostop;
																}
																$pos=$pos+1;
															 }
															if($pos>1)
															{
																$desc = trim(substr($noaddata->field_ht_summary['und'][0]['value'],0 , $pos));
															}
															else
															{
																$desc = $noaddata->field_ht_summary['und'][0]['value'];
															}
															if(strlen($noaddata->field_ht_summary['und'][0]['value'])>200)
															{
															//trim($desc.="<a href='".url('node/'.$d_advice['nid'])."'>"."&hellip;"."</a>");
															
															$ex_url='';
															if($restofind=='') 
																{ 
																 $ex_url.="http://";
																}
																$ex_url.=$d_thread['field_ht_forum_url'];
																$ex_url = $forum_discussion_url;
															//trim($desc.="<a href='".$ex_url."'>"."&hellip;"."</a>");
															}
															if(strlen($noaddata->field_ht_summary['und'][0]['value'])>200)
																{
															//echo $desc."<a href='".$ex_url."'>"."&hellip;"."</a>";
                                                                 echo $desc."&hellip;";
                                                                                                                      //  echo $desc;
																}
																else
																{
																echo $desc;
																} ?>
													</div>
												</div><!-- w460 -->
											</div><!-- List holder  -->
										</li><!-- thread list -->
										<?php
													}
												}
												else
												{
												
											?>
										<li>
											<div class="clearfix listHolder">
												
												
												<div class="fright w460 ShortNews">
													<h2>No Thread Found</a></h2>
													
												
												</div><!-- w460 -->
											</div><!-- List holder  -->
										</li><!-- thread list -->
										<?php
												}
										?>
									
									</ul>
								</div>																
							</div><!-- tab content -->
							
							<?php
							if ($r = mysqli_query($q) && $totalrows>10) 
								{
								if(isset($_REQUEST['catname']) && ($_REQUEST['catname']!='%') && ($_REQUEST['catname']!='All'))
									{
										$q1 .= '&catname='.$_REQUEST['catname'];
									}
								else
									{
										$q1 .= '&catname=%';
									}
							?>
							<div class="marT10 clearfix">
								
								<div class="clearfix w100p">
								<?php
									if($page!= 1)
										{
										$pageprev = $page - 1;
										//echo '<a href="'.$_SERVER['php_SELF'].'?page='.$pageprev.'">PREV</a> - ';
										
								?>
									<a class="firstbtn btnLeft fleft" href="#" rel="<?php echo '&page='.$pageprev.$q1; ?>">
										<span>Newer</span>
									</a>
									<?php
										}
										else
										{
									?>
									<a class="btnLeft fleft btnLeftDisabled" href="#" onclick="return false;">
										<span>Newer</span>
									</a>
									<?php
										}
									?>
							<ul class="pagination">
							<?php
										
										
										if (($page + $slice) < $numofpages) {
										$this_far = $page + $slice;
										} else {
										$this_far = $numofpages;
										}
										
										if (($start + $page) >= 10 && ($page - 10) > 0) {
										$start = $page - 6;
										}
											for ($k = $start; $k <= $this_far; $k++)
												{
														if($k==$start && $_REQUEST['page']=='')
															{
																$c = " class=\"active\"";
															}
														else if(($_REQUEST['page']==$k))
															{
																$c = " class=\"active\"";
															}
														else
															{
																$c = "";
															}
												?>
												<li><a<?php if($c=='') {?> title="go to page <?php echo $k; ?>" href="#" <?php } echo $c; ?> rel="<?php echo '&page='.$k.$q1; ?>"><?php echo $k; ?></a></li>
												<?php
												}
										?>
								</ul>
								<?php
									   if(($totalrows - ($limit * $page)) > 0)
											{
										$pagenext = $page + 1;
										//$href='page='.$pagenext.$q1;
										?>
										 &nbsp;&nbsp;<a class="btnnew btnRight fright rPos"  href="#"  rel="<?php echo '&page='.$pagenext.$q1; ?>">
												<span>Older</span></a>
												<?php
											}
											else
											{
											echo '<a class="btnRight fright btnRightDisabled" href="#" onclick="return false;"><span>Older</span></a>';
											}
								?>
											
									</div>	
							</div>
							<?php
							}
							?>
					<!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js">	</script> -->
						<script type="text/javascript">
				function nav_hotthreads(link)
					{
						//jQuery.url.setUrl(url);
						//var url = Drupal.settings.basePath +'?q=hot-thread/callback';
						$('html, body').animate({scrollTop: $("h1").offset().top-10}, 300);
						var url = Drupal.settings.basePath  +'?q=hot-thread/callback';
						url += link;
						//jQuery.url.setUrl(url);
						$.ajax( 
						{
						cache: false,
						url: url,
						dataType: 'text',
						error: function(request, status, error) 
						{
							alert(status);
							//$('#container').html(request.responseText);
						},
						success: function(data, status, request) 
						{
							$('#ajax').html(data);
						}
						});
				}
				$('.pagination li a').click(function(){
					if($(this).hasClass("active"))
					{
					return false;
					}
					else
					{
					//alert(this.href);
					nav_hotthreads(this.rel);
					$("ul#threadlist").html("<div class='loader'>&nbsp;"+"<"+"/div>");
					//alert(this.attr("rel"));
					return(false);
					}
				});
					$('.btnnew').click(function()
					{
					nav_hotthreads(this.rel);
					$("ul#threadlist").html("<div class='loader'>&nbsp;"+"<"+"/div>");
					//alert(this.attr("rel"));
					return(false);
				});
				
				$('.firstbtn').click(function()
					{
					nav_hotthreads(this.rel);
					$("ul#threadlist").html("<div class='loader'>&nbsp;"+"<"+"/div>");
					//alert(this.attr("rel"));
					return(false);
				});
				
				function showthread_bycat(cat)
					{
						$("ul#threadlist").html("<div class='loader'>&nbsp;"+"<"+"/div>");
						var url = Drupal.settings.basePath  +'?q=hot-thread/callback';
						url += "&catname="+cat;
						//jQuery.url.setUrl(url);
						$.ajax( 
						{
						cache: false,
						url: url,
						dataType: 'text',
						error: function(request, status, error) 
						{
							alert(status);
							//$('#container').html(request.responseText);
						},
						success: function(data, status, request) 
						{
							$('#ajax').html(data);
						}
						});
				}
				
			</script>
