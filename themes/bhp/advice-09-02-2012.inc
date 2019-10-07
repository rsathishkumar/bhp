<?php
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
										if($_GET['catname']=='')
											{
											$cname='On Buying';
											}
										else
											{
											if($_GET['catname']=='All' || $_GET['catname']=='%')
												{
												$cname="%";
												}
												else
												{
											$cname=$_GET['catname'];
												}
											}
											
	$q = "SELECT node.title,node.nid, field_data_field_advice_categories.field_advice_categories_value
	FROM node, field_data_field_advice_categories WHERE field_data_field_advice_categories.entity_id = node.nid 
	AND node.status =1
	AND node.nid = field_data_field_advice_categories.entity_id
	AND field_data_field_advice_categories.field_advice_categories_value like '%".$cname."%' order by node.created desc";
	$r = mysqli_query($q);
	$totalrows = mysqli_num_rows($r);
	$numofpages = ceil($totalrows / $limit);
	$limitvalue = $page * $limit - ($limit);
	$q = "SELECT node.title,node.nid, field_data_field_advice_categories.field_advice_categories_value
	FROM node, field_data_field_advice_categories WHERE field_data_field_advice_categories.entity_id = node.nid 
	AND node.status =1
	AND node.nid = field_data_field_advice_categories.entity_id
	AND field_data_field_advice_categories.field_advice_categories_value like '%".$cname."%' order by node.created desc limit $limitvalue, $limit";
	
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
?>
					<div class="tab_container BLR5">
								
								<div style="display: block;" class="tab_content" id="tab2">
									<ul class="newslist" id="advicelist">
									<?php
										if ($r = mysqli_query($q)) 
												{
										while($d_advice=mysqli_fetch_array($r))
													{
													$node_data=node_load($d_advice['nid']);
														//print_r($node_data->field_advice_content['und'][0]['value']);
$sql_img_check=@mysqli_fetch_array(mysqli_query("select field_advice_media_type_value from field_data_field_advice_media_type where entity_id =".$d_advice['nid']));
$sql_advice=mysqli_fetch_array(mysqli_query("select field_advice_content_value from field_data_field_advice_content where entity_id=".$d_advice['nid']));
		                                               if($sql_img_check['field_advice_media_type_value']=='Image')
			                                              {
													  $sql_img=mysqli_fetch_array(mysqli_query("select file_managed.uri from field_data_field_advice_images, file_managed where file_managed.fid = field_data_field_advice_images.field_advice_images_fid and field_data_field_advice_images.entity_id=".$d_advice['nid']));
													      }
													   else
														{
														$sql_img=mysqli_fetch_array(mysqli_query("select file_managed.uri from field_data_field_advice_optional_image, file_managed where file_managed.fid = field_data_field_advice_optional_image.field_advice_optional_image_fid and field_data_field_advice_optional_image.entity_id=".$d_advice['nid']));
														}
									?>
										<li>
											<div class="clearfix listHolder">
												<div class="fleft w170">
													<a class="holderImg" title="<?php echo $d_advice['title'];?>" href="<?php echo url('node/'.$d_advice['nid']); ?>">
														<?php
														if($sql_img!='')
															{
														?>
														<!--<img width="165" height="124" alt="<?php echo $d_advice['title'];?>" src="sites/default/files/<?php echo str_replace("public://","",$sql_img['uri']);?>">--><strong>
														<img alt="<?php echo $d_advice['title'];?>" src="http://www.team-bhp.com/?q=sites/default/files/styles/check_medium_medium/public/<?php echo str_replace("public://","",$sql_img['uri']);?>"></strong>
														<?php
															}
															else
															{
															echo $d_advice['title'];
															}
														?>
													</a>
												</div><!-- News thum holder -->
												
												<div class="fright w460 ShortNews">
													<h2><a title="<?php echo $d_advice['title'];?>" href="<?php echo url('node/'.$d_advice['nid']); ?>"><?php echo $d_advice['title'];?></a></h2>
													
													<div class="past_shornote">
														<?php
														/* if(strlen($sql_advice['field_advice_content_value'])>195)
															{
															$finddot=@strpos($sql_advice['field_advice_content_value'],".",195);
															$findspcetostop=@strpos($sql_advice['field_advice_content_value']," ",195);
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
																$desc = trim(substr($sql_advice['field_advice_content_value'],0 , $pos));
															}
															else
															{
																$desc = $sql_advice['field_advice_content_value'];
															}
															if(strlen($sql_advice['field_advice_content_value'])>200)
															{
															    trim($desc.="&hellip;");
															}
															*/
															/*if(strlen($node_data->field_advice_content['und'][0]['value'])>195)
															{
															$finddot=@strpos($node_data->field_advice_content['und'][0]['value'],".",195);
															$findspcetostop=@strpos($node_data->field_advice_content['und'][0]['value']," ",195);
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
																//$desc = trim(substr($node_data->field_advice_content['und'][0]['value'],0 , $pos));
																$desc = trim($node_data->field_advice_content['und'][0]['value']);
															}
															else
															{
																$desc = substr($node_data->field_advice_content['und'][0]['value'],0,200);
															}
															if(strlen($node_data->field_advice_content['und'][0]['value'])>195)
															{
															//trim($desc.="<a href='".url('node/'.$d_advice['nid'])."'>"."&hellip;"."</a>");
                                                               trim($desc.="&hellip;");
															} */
															echo truncate(str_replace("&lt;!--pagebreak--&gt;","",trim($node_data->field_advice_content['und'][0]['value'])), 195	, '...', false,true);
																			
														//	echo str_replace("&lt;!--pagebreak--&gt;","",$desc);
														?>
													</div>
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
											<div class="clearfix listHolder">
												No News found 
										</li>
									<?php	
										}
									?>
										<!-- news list -->
									</ul>
								</div><!-- tab2 -->
								
								
								
							</div><!-- tab content -->
							<?php
								if ($r = mysqli_query($q) && $totalrows >10) 
									{
										
							?>
							<div class="marT10 clearfix">
								<div class="clearfix w100p">
								<?php
								if($page!= 1)
										{
										$pageprev = $page - 1;
										$q1 = '&page='.($pageprev);
										if(isset($_REQUEST['catname']) )
										{
											$q1 .= '&catname='.$_REQUEST['catname'];
										}
									else
										{
											$q1 .= '&catname=On Buying';
										}
										//echo '<a href="'.$_SERVER['php_SELF'].'?page='.$pageprev.'">PREV</a> - ';
										
										
								?>
									<a class="paging btnLeft fleft" href="#" rel="<?php echo $q1; ?>">
										<span>Newer</span>
									</a>
									<?php
										}
									else
										{
										echo '<a class="btnLeft fleft btnLeftDisabled" href="#" onclick="return false;">
										<span>Newer</span></a>';
										}
									?>
								<ul class="pagination">
									<?php
										if (($page + $slice) < $numofpages) 
										{
										$this_far = $page + $slice;
										} else 
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
										$q1 = '&page='.$k;
										if(isset($_REQUEST['catname']) )
										{
											$q1 .= '&catname='.$_REQUEST['catname'];
										}
									else
										{
											$q1 .= '&catname=On Buying';
										}
										?>
										<li><a<?php if($c=='') {?> title="go to page <?php echo $k; ?>"  href="#" <?php } echo $c; ?> rel="<?php echo $q1;?>"><?php echo $k; ?></a></li>
										<?php
										
										}
										
										
										?>
								</ul>
										<?php
										if(($totalrows - ($limit * $page)) > 0)
											{
										$pagenext = $page + 1;
										$q1 = '&page='.($pagenext);
										if(isset($_REQUEST['catname']) )
										{
											$q1 .= '&catname='.$_REQUEST['catname'];
										}
									else
										{
											$q1 .= '&catname=On Buying';
										}
										?>
										 <a class="paging btnRight fright rPos"  href="#" rel="<?php echo $q1;?>">
											<span>Older</span>
										</a>
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
