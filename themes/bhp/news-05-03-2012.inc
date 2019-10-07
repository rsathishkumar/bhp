<script type="text/javascript">
$(function(){
	$(".newslist li").click(function(e){
		window.location.href="http://"+'<?php echo $_SERVER["HTTP_HOST"]?>'+$(this).attr("rel");
	});
	$(".newslist li a").click(function(e){
		e.stopPropagation();
	});
});
</script>
<div class="tab_container BLR5">
		<div id="tab2" class="tab_content">
			<ul id="newslist" class="newslist">
			<?php
			/*class String_truncate 
			{
				public static function truncate($text, $length, $suffix = '&hellip;', $isHTML = true)
					{
					$i = 0;
					$tags = array();
					if($isHTML)
						{
						preg_match_all('/<[^>]+>([^<]*)/', $text, $m, PREG_OFFSET_CAPTURE | PREG_SET_ORDER);
						foreach($m as $o)
							{
							if($o[0][1] - $i >= $length)
								break;
							$t = substr(strtok($o[0][0], " \t\n\r\0\x0B>"), 1);
							if($t[0] != '/')
								$tags[] = $t;
							elseif(end($tags) == substr($t, 1))
								array_pop($tags);
							$i += $o[1][1] - $o[0][1];
							}
						}
						$output = substr($text, 0, $length = min(strlen($text),  $length + $i)) . (count($tags = array_reverse($tags)) ? '</' . implode('></', $tags) . '>' : '');
						if (strlen($text) > $length)
						{
							$output = substr($output,-4,4)=='</p>' ? $output=substr($output,0,(strlen($output)-4)).$suffix.'</p>' : $output.=$suffix;
						}
						return $output;
					}
			} */
			function truncate($text, $length = 195, $ending = '...', $exact = false, $considerHtml = true) 
			{
			if ($considerHtml) 
				{
				// if the plain text is shorter than the maximum length, return the whole text
				if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) 
					{
					return $text;
					}
				// splits all html-tags to scanable lines
				preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);
				$total_length = strlen($ending);
				$open_tags = array();
				$truncate = '';
				foreach ($lines as $line_matchings) {
					// if there is any html-tag in this line, handle it and add it (uncounted) to the output
					if (!empty($line_matchings[1])) {
						// if it's an "empty element" with or without xhtml-conform closing slash
						if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
							// do nothing
						// if tag is a closing tag
						} else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
							// delete tag from $open_tags list
							$pos = array_search($tag_matchings[1], $open_tags);
							if ($pos !== false) {
							unset($open_tags[$pos]);
							}
						// if tag is an opening tag
						} else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
							// add tag to the beginning of $open_tags list
							array_unshift($open_tags, strtolower($tag_matchings[1]));
						}
						// add html-tag to $truncate'd text
						$truncate .= $line_matchings[1];
					}
					// calculate the length of the plain text part of the line; handle entities as one character
					$content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
					if ($total_length+$content_length> $length) {
						// the number of characters which are left
						$left = $length - $total_length;
						$entities_length = 0;
						// search for html entities
						if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
							// calculate the real length of all entities in the legal range
							foreach ($entities[0] as $entity) {
								if ($entity[1]+1-$entities_length <= $left) {
									$left--;
									$entities_length += strlen($entity[0]);
								} else {
									// no more characters left
									break;
								}
							}
						}
						$truncate .= substr($line_matchings[2], 0, $left+$entities_length);
						// maximum lenght is reached, so get off the loop
						break;
					} else {
						$truncate .= $line_matchings[2];
						$total_length += $content_length;
					}
					// if the maximum length is reached, get off the loop
					if($total_length>= $length) {
						break;
					}
				}
						} else 
					{
					if (strlen($text) <= $length) {
						return $text;
					} else {
						$truncate = substr($text, 0, $length - strlen($ending));
					}
				}
	// if the words shouldn't be cut in the middle...
	if (!$exact) 
		{
		// ...search the last occurance of a space...
		$spacepos = strrpos($truncate, ' ');
		if (isset($spacepos)) {
			// ...and cut the text in this position
			$truncate = substr($truncate, 0, $spacepos);
			}
		}
	// add the defined ending to the text
	$truncate .= $ending;
			if($considerHtml) {
				// close all unclosed html-tags
				foreach ($open_tags as $tag) {
					$truncate .= '</' . $tag . '>';
				}
			}
			return $truncate;
	}
			
			//function to format date in 'xx days ago'
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
								if($flr == 1  || $flr == 0){ 
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
							if($flr == 1  || $flr == 0){ 
									$date_string = '1 year ago.'; 
							} 
							else{ 
									$date_string = $flr.' years ago'; 
							} 
					} 
				return $date_string; 
			}*/
			function returnDate($timestamp)
					{
						$difference = time() - $timestamp;
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
						return $text ." ago";
					}
			include_once("./themes/bhp/connect.php");
										$limit = 10;
										$slice = 9;
										$start = 1;
										if(!isset($_REQUEST['page']) || !is_numeric($_REQUEST['page']))
											{
											$page = 1;
											} 
											else 
											{
											$page = $_REQUEST['page'];
											}
			if(isset($_REQUEST['catname']))
			{
			$q = "select node.nid as nid, node.created as created, title, field_news_category_value from node, field_data_field_news_category where type='news' and node.nid=field_data_field_news_category.entity_id and field_data_field_news_category.field_news_category_value like '%".$_REQUEST['catname']."%' and node.status=1 order by node.created desc";
				$r = mysqli_query($q);
				$totalrows = mysqli_num_rows($r);
				$numofpages = ceil($totalrows / $limit);
				$limitvalue = $page * $limit - ($limit);
			 $q = "select node.nid as nid, node.created as created, title, field_news_category_value from node, field_data_field_news_category where type='news' and node.nid=field_data_field_news_category.entity_id and field_data_field_news_category.field_news_category_value like '%".$_REQUEST['catname']."%' and node.status=1 order by node.created desc limit $limitvalue, $limit";
			}
			else if(isset($_REQUEST['model']))
			{
			$q ="select node.nid as nid, node.created as created, title, field_news_category_value from node, field_data_field_news_category, field_data_field_news_make where type='news' and node.nid=field_data_field_news_category.entity_id and field_data_field_news_make.entity_id=node.nid and field_data_field_news_make.field_news_make_nid='".$_REQUEST['model']."' and node.status=1 order by node.created desc";
				$r = mysqli_query($q);
				$totalrows = mysqli_num_rows($r);
				$numofpages = ceil($totalrows / $limit);
				$limitvalue = $page * $limit - ($limit);
			 $q ="select node.nid as nid, node.created as created, title, field_news_category_value from node, field_data_field_news_category, field_data_field_news_make where type='news' and node.nid=field_data_field_news_category.entity_id and field_data_field_news_make.entity_id=node.nid and field_data_field_news_make.field_news_make_nid='".$_REQUEST['model']."' and node.status=1 order by node.created desc limit $limitvalue, $limit";
			}
			else if(isset($_REQUEST['tag']))
			{
			//$q = "select node.nid as nid, node.created as created, title, field_news_category_value from node, field_data_field_news_category, field_data_field_news_tags where type='news' and node.nid=field_data_field_news_category.entity_id and node.nid=field_data_field_news_tags.entity_id and field_data_field_news_tags.field_news_tags_tid='".$_REQUEST['tag']."' and node.status=1 order by node.created desc";
			$q = "select node.nid as nid, node.created as created, title from node, field_data_field_news_cat, field_data_field_news_tags where type='news' and node.nid=field_data_field_news_cat.entity_id and node.nid=field_data_field_news_tags.entity_id and field_data_field_news_cat.field_news_cat_nid='".$_GET['tag']."' and node.status=1 group by node.nid order by node.created desc";
				$r = mysqli_query($q);
				$totalrows = mysqli_num_rows($r);
				$numofpages = ceil($totalrows / $limit);
				$limitvalue = $page * $limit - ($limit);
			 $q ="select node.nid as nid, node.created as created, title from node, field_data_field_news_cat, field_data_field_news_tags where type='news' and node.nid=field_data_field_news_cat.entity_id and node.nid=field_data_field_news_tags.entity_id and field_data_field_news_cat.field_news_cat_nid='".$_GET['tag']."' and node.status=1 group by node.nid order by node.created desc limit $limitvalue, $limit";
			}
			else if(isset($_REQUEST['t']))
			{
			$q = "select node.nid as nid, node.created as created, title from node, field_data_field_news_tags where type='news' and node.nid=field_data_field_news_tags.entity_id and field_data_field_news_tags.field_news_tags_tid='".$_GET['t']."' and node.status=1 group by node.nid order by node.created desc";
				$r = mysqli_query($q);
				$totalrows = mysqli_num_rows($r);
				$numofpages = ceil($totalrows / $limit);
				$limitvalue = $page * $limit - ($limit);
			 $q ="select node.nid as nid, node.created as created, title from node, field_data_field_news_tags where type='news' and node.nid=field_data_field_news_tags.entity_id and field_data_field_news_tags.field_news_tags_tid='".$_GET['t']."' and node.status=1 group by node.nid order by node.created desc limit $limitvalue, $limit";
			}
			else
			{
			 	$q = "select node.nid as nid, node.created as created, title, field_news_category_value from node, field_data_field_news_category where type='news' and node.nid=field_data_field_news_category.entity_id and field_data_field_news_category.field_news_category_value like 'Indian' and node.status=1 order by node.created desc";
				$r = mysqli_query($q);
				$totalrows = mysqli_num_rows($r);
				$numofpages = ceil($totalrows / $limit);
				$limitvalue = $page * $limit - ($limit);
			 	$q = "select node.nid as nid, node.created as created, title, field_news_category_value from node, field_data_field_news_category where type='news' and node.nid=field_data_field_news_category.entity_id and field_data_field_news_category.field_news_category_value like 'Indian' and node.status=1 order by node.created desc limit $limitvalue, $limit";
			}
			//echo "here ".base64_encode($_REQUEST['t']);
			
			if ($r = mysqli_query($q))
			{
					if(mysqli_num_rows($r)>0)
						{
						  while($d_news=mysqli_fetch_array($r))
							{
							//$url_res = @mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$d_news['nid']."'"));
								$atoappend='';
							   if($_REQUEST['tab']!='' || $_REQUEST['catname']=='All' || $_REQUEST['catname']=='%' || $_REQUEST['model']!='' || $_REQUEST['t']!='' || $_REQUEST['tag']!='')
									{
									//echo "select alias from url_alias where source = 'node/".$d_advice['nid']."'";
									$url_alias1=mysqli_fetch_array(mysqli_query("select alias from url_alias where source = 'node/".$d_news['nid']."'"));
									if($_REQUEST['catname']=='All' || $_REQUEST['catname']=='%' || $_REQUEST['tab']!='')
										{
									$url="/?q=".$url_alias1['alias']."&tab=1";
										}
										else if($_REQUEST['model']!='')
										{
									$url="/?q=".$url_alias1['alias']."&model=".base64_encode($_REQUEST['model']);	
										}
										else if($_REQUEST['t']!='')
										{
										//$qry_tocheck_tags=mysqli_fetch_array(mysqli_query("select field_data_field_news_tags.field_news_tags_tid,taxonomy_term_data.name from field_data_field_news_tags,taxonomy_term_data where field_data_field_news_tags.entity_id=".$d_news['nid']." and taxonomy_term_data.tid=field_data_field_news_tags.field_news_tags_tid"));
										$url="/?q=".$url_alias1['alias']."&t=".base64_encode($_REQUEST['t']);	
										}
									 else if($_REQUEST['tag']!='')
										{
									$url="/?q=".$url_alias1['alias']."&tag=".base64_encode($_REQUEST['tag']);		
										}
									}
									else
									{
									$url=url('node/'.$d_news['nid']);
									}
							//$url = $url_res['alias'];
							$sql_img_check=@mysqli_fetch_array(mysqli_query("select field_data_field_news_media_type.field_news_media_type_value,field_data_field_news_category.field_news_category_value,node.title from field_data_field_news_media_type,node,field_data_field_news_category where field_data_field_news_media_type.entity_id =".$d_news['nid']." and field_data_field_news_media_type.entity_id=node.nid and field_data_field_news_category.entity_id=node.nid"));
								
					  ?>
							<li rel="<?php echo $url; ?>">
								<div class="clearfix listHolder">
									<div class="fleft w170">
										<a class="holderImg" title="<?php echo $d_news['title'];?>" href="<?php echo $url; ?>">
											<?php
												 if($sql_img_check['field_news_media_type_value']=='Images')
													 {
												$img_res = @mysqli_query("select field_news_images_fid, uri from field_data_field_news_images, file_managed where field_data_field_news_images.field_news_images_fid=file_managed.fid  and field_data_field_news_images.entity_id=".$d_news['nid']) or die(mysql_error());
												$img_news=@mysqli_fetch_array($img_res);
													 }
												  else  
													{
													$img_res = @mysqli_query("select field_news_list_image_fid, uri from field_data_field_news_list_image, file_managed where field_data_field_news_list_image.field_news_list_image_fid=file_managed.fid  and field_data_field_news_list_image.entity_id=".$d_news['nid']) or die(mysql_error());
												$img_news=mysqli_fetch_array($img_res);	
													}
											?>
											<strong>
											<img  alt="<?php echo $d_news['title'];?>" src="http://www.team-bhp.com/?q=sites/default/files/styles/check_medium_medium/public/<?php echo str_replace('public://','',$img_news['uri']);?>" />
											</strong>
										</a>
									</div><!-- News thum holder -->
									
									<div class="fright w460 ShortNews">
										<h2><a title="<?php echo $d_news['title'];?>" href="<?php echo $url; ?>"><?php echo $d_news['title'];?></a></h2>
										<div class="postDate">Posted: <?php echo returnDate($d_news['created']); ?></div>
										<div class="past_shornote">
									    	<?php
											$desc_res = @mysqli_query("select field_news_content_summary, field_news_content_value from field_data_field_news_content where entity_id=".$d_news['nid']) or die(mysql_error());
											$desc_news=mysqli_fetch_array($desc_res);
											$news_data = node_load($d_news['nid']);
											$desc='';
											echo truncate(str_replace("&lt;!--pagebreak--&gt;","",trim($news_data->field_news_content['und'][0]['safe_value'])), 195	, '...', false,true);
											?>
										</div><!-- past_shornote -->
									</div><!-- w460 -->
								</div><!-- List holder  -->
							</li><!-- news list -->
							<?php 
							}
				}
				else
					{
					?>
					<li>
						<?php
						echo "<div align ='center'><b>No news found</b></div>" ;
						?>
					</li><!-- news list -->
					<?php
					}
			}
			else
			{
			?>
			<li>
				<?php
				echo "<div align ='center'><b>No news found</b></div>" ; 
				?>
			</li><!-- news list -->
			<?php
			}
			?>
		</ul>
		</div><!-- tab content -->
							
</div>
							<?php
							if ($r = mysqli_query($q) && $totalrows>10) 
							{
							?>
							<div class="marT10 clearfix">
								<div class="clearfix w100p">
								<?php
								if($page!= 1)
										{
										$pageprev = $page - 1;
										$q = '&page='.($pageprev);
										if(isset($_REQUEST['catname']))
											{
												if($_REQUEST['catname']=='%')
												{
												$q .= '&catname=%';	
												}
												else
												{
												$q .= '&catname=Indian';
												}
											}
										else if(isset($_REQUEST['model']))
											{
												$q .= '&model='.$_REQUEST['model'];
											}
										else if(isset($_REQUEST['tag']))
											{
												$q .= '&tag='.$_REQUEST['tag'];
											}
										else if(isset($_REQUEST['t']))
											{
												$q .= '&t='.$_REQUEST['t'];
											}
										else
											{
												if($_REQUEST['tag']=='' || $_REQUEST['model']=='' || $_REQUEST['catname']!='')
													{
														if($_REQUEST['catname']=='%')
														{
														$q .= '&catname=%';	
														}
														else
														{
														$q .= '&catname=Indian';
														}
													}
											}
											/*if($_REQUEST['tab']!='' || $_REQUEST['catname']=='All' || $_REQUEST['catname']=='%' || $_REQUEST['model']!='' || $_REQUEST['m']!='' || $_REQUEST['t']!='' || $_REQUEST['tg']!='' || $_REQUEST['tag']!='' || $_REQUEST['tags']!='')
												{
													if($_REQUEST['catname']=='All' || $_REQUEST['catname']=='%' || $_REQUEST['tab']!='')
													{
													$q .= '&tab=1';	
													}
													else if($_REQUEST['model']!='' || $_REQUEST['m']!='' )
													{
													$q .= '&m=1';	
													}
													else if($_REQUEST['t']!='' || $_REQUEST['tg']!='')
													{
													$q .= '&tg=1';	
													}
													else if($_REQUEST['tag']!=''|| $_REQUEST['tags']!='')
													{
													$q .= '&tags=1';	
													}
												}*/
											
										//echo '<a href="'.$_SERVER['php_SELF'].'?page='.$pageprev.'">PREV</a> - ';
								?><a class="paging btnLeft fleft" href="#" rel="<?php echo $q; ?>"><span>Newer</span></a>
									<?php
										}
									else
										{ echo "<a class='btnLeft fleft btnLeftDisabled' href='#' onclick='return false;'><span>Newer</span></a>";}?>
										<!--<a class="btnLeft fleft btnLeftDisabled" href="#" onclick="return false;"><span>Newer</span></a>-->
									<ul class="pagination">
									<?php
										if (($page + $slice) < $numofpages) 
										{
										$this_far = $page + $slice;
										} 
										else 
										{
										$this_far = $numofpages;
										}
										
										if (($start + $page) >= 10 && ($page - 10) > 0) {
										$start = $page - 10;
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
											
												$q = '&page='.$k;
												if(isset($_REQUEST['catname']))
													{
															if($_REQUEST['catname']=='%')
																{
																$q .= '&catname=%';	
																}
																else
																{
																$q .= '&catname=Indian';
																}
													}
												else if(isset($_REQUEST['model']))
													{
														$q .= '&model='.$_REQUEST['model'];
													}
												else if(isset($_REQUEST['tag']))
													{
														$q .= '&tag='.$_REQUEST['tag'];
													}
												else if(isset($_REQUEST['t']))
												{
													$q .= '&t='.$_REQUEST['t'];
												}
												else
													{
															if($_REQUEST['tag']=='' || $_REQUEST['model']=='' || $_REQUEST['catname']!='')
																{
																	if($_REQUEST['catname']=='%')
																		{
																		$q .= '&catname=%';	
																		}
																		else
																		{
																		$q .= '&catname=Indian';
																		}
																}
													}
												/*if($_REQUEST['tab']!='' || $_REQUEST['catname']=='All' || $_REQUEST['catname']=='%' || $_REQUEST['model']!='' || $_REQUEST['m']!='' || $_REQUEST['t']!='' || $_REQUEST['tg']!='' || $_REQUEST['tag']!='' || $_REQUEST['tags']!='')
												{
													if($_REQUEST['catname']=='All' || $_REQUEST['catname']=='%' || $_REQUEST['tab']!='')
													{
													$q .= '&tab=1';	
													}
													else if($_REQUEST['model']!='' || $_REQUEST['m']!='' )
													{
													$q .= '&m=1';	
													}
													else if($_REQUEST['t']!='' || $_REQUEST['tg']!='')
													{
													$q .= '&tg=1';	
													}
													else if($_REQUEST['tag']!=''|| $_REQUEST['tags']!='')
													{
													$q .= '&tags=1';	
													}
												}*/
										?>
										<li><a<?php if($c=='') {?> title="go to page <?php echo $k; ?>" href="#" <?php } echo $c; ?> rel="<?php  echo $q; ?>"><?php echo $k; ?></a></li>
										<?php
										
										}
										?>
								</ul>
								<?php
								if(($totalrows - ($limit * $page)) > 0)
											{
											$pagenext = $page + 1;
											$q = '&page='.($pagenext);
												if(isset($_REQUEST['catname']))
													{
														if($_REQUEST['catname']=='%')
															{
															$q .= '&catname=%';	
															}
															else
															{
															$q .= '&catname=Indian';
															}
													}
												else if(isset($_REQUEST['model']))
													{
														$q .= '&model='.$_REQUEST['model'];
													}
												else if(isset($_REQUEST['tag']))
													{
														$q .= '&tag='.$_REQUEST['tag'];
													}
												else if(isset($_REQUEST['t']))
												{
													$q .= '&t='.$_REQUEST['t'];
												}
												else
													{
														if($_REQUEST['tag']=='' || $_REQUEST['model']=='' || $_REQUEST['catname']!='')
																{
																if($_REQUEST['catname']=='%')
																	{
																	$q .= '&catname=%';	
																	}
																	else
																	{
																	$q .= '&catname=Indian';
																	}
																}
													}
												/*if($_REQUEST['tab']!='' || $_REQUEST['catname']=='All' || $_REQUEST['catname']=='%' || $_REQUEST['model']!='' || $_REQUEST['m']!='' || $_REQUEST['t']!='' || $_REQUEST['tg']!='' || $_REQUEST['tag']!='' || $_REQUEST['tags']!='')
												{
													if($_REQUEST['catname']=='All' || $_REQUEST['catname']=='%' || $_REQUEST['tab']!='')
													{
													$q .= '&tab=1';	
													}
													else if($_REQUEST['model']!='' || $_REQUEST['m']!='' )
													{
													$q .= '&m=1';	
													}
													else if($_REQUEST['t']!='' || $_REQUEST['tg']!='')
													{
													$q .= '&tg=1';	
													}
													else if($_REQUEST['tag']!=''|| $_REQUEST['tags']!='')
													{
													$q .= '&tags=1';	
													}
												}*/
										?>
										 <a class="paging btnRight fright rPos"  rel="<?php echo $q;?>" href="#"><span>Older</span></a>
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
