<script type="text/javascript">	
(function ($) {
	$(function(){
		$(".newslist li").click(function(){
			 window.location=$(this).find('h2 a').attr('href');
		});
	});
})(jQuery);
	</script>
<div class="tab_container BLR5 marB10">								
<div style="display: block;" class="tab_content">
<ul class="newslist" id="tstufflist">
										<?php
										include_once("connect.php");
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
$q = "SELECT node.title,node.nid,body_value FROM node,field_data_body WHERE field_data_body.entity_id = node.nid 
AND node.status =1 and field_data_body.bundle='tech_stuff' order by node.created desc";
			$r = mysqli_query($q);
			$totalrows = mysqli_num_rows($r);
			$numofpages = ceil($totalrows / $limit);
			$limitvalue = $page * $limit - ($limit);
			
			$q = "SELECT node.title,node.nid,body_value FROM node,field_data_body WHERE field_data_body.entity_id = node.nid AND node.status =1 and field_data_body.bundle='tech_stuff' order by node.created desc limit $limitvalue, $limit";

if ($r = mysqli_query($q))
{
while($d_tstuff=@mysqli_fetch_array($r))
{

$sql_img=@mysqli_fetch_array(mysqli_query("select file_managed.uri from field_data_field_tech_stuff_image, file_managed where file_managed.fid = field_data_field_tech_stuff_image.field_tech_stuff_image_fid and field_data_field_tech_stuff_image.entity_id=".$d_tstuff['nid']));
$url_res = @mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$d_tstuff['nid']."'"));
$url = $url_res['alias'];
//echo date("y-m-d",$d_tstuff['created']);
?>
<li>
<div class="clearfix listHolder">
<div class="fleft w170">
<a class="holderImg" title="<?php echo $d_tstuff['title'];?>" href="<?php echo $url;?>">
<strong>
<img  alt="<?php echo $d_tstuff['title'];?>" src="/?q=sites/default/files/styles/check_medium_medium/public/<?php echo str_replace("public://","",$sql_img['uri']);?>">
</strong>
</a>
</div><!-- News thum holder -->
<div class="fright w460 ShortNews">
<h2><a title="<?php echo $d_tstuff['title'];?>" href="<?php echo $url;?>"><?php echo $d_tstuff['title'];?></a></h2>

														<div class="past_shornote">
																<?php
														/*if(strlen($d_tstuff['body_value'])>195)
															{
															$finddot=@strpos($d_tstuff['body_value'],".",195);
															$findspcetostop=@strpos($d_tstuff['body_value']," ",195);
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
																$desc = trim(substr($d_tstuff['body_value'],0 , $pos));
															}
															else
															{
																$desc = $d_tstuff['body_value'];
															}
														if(strlen($d_tstuff['body_value'])>200)
															{
															//trim($desc.="<a href='?q=".$url."'>"."&hellip;"."</a>");
															trim($desc.="&hellip;");
															}
															echo $desc;*/
															 echo truncate(str_replace("&lt;!--pagebreak--&gt;","",trim($d_tstuff['body_value'])), 195	, '...', false,true);
											
															
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
<?php
echo "No thread found" ;
?>
</li><!-- news list -->
<?php
}
?>
</div>
</div><!-- tab content -->

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
										//echo '<a href="'.$_SERVER['php_SELF'].'?page='.$pageprev.'">PREV</a> - ';
								?>
									<a class="btnLeft fleft" href="<?php echo 'page='.$pageprev; ?>" onclick="nav_tstuff(this); return false;">
										<span>Newer</span>
									</a>
									<?php
										}
									else
										{
										echo '<a class="btnLeft fleft btnLeftDisabled" href="#" onclick="return false;">
										<span>Newer</span>
									</a>';
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
										?>
										<li><a<?php if($c=='') {?> title="go to page <?php echo $k; ?>"<?php } echo $c; ?> href="<?php if($c=='') {echo 'page='.$k; } else {echo "/#";}?>" onclick="<?php if($c=="") { ?>nav_tstuff(this); <?php } ?>return false;"><?php echo $k; ?></a></li>
										<?php
										
										}
									?>
								</ul>
										<?php
										if(($totalrows - ($limit * $page)) > 0)
											{
										$pagenext = $page + 1;
										?>
										 <a class="btnRight fright rPos"  href="page=<?php echo $pagenext;?>" onclick="nav_tstuff(this); return false;">
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
