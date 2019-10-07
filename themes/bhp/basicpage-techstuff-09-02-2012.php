<script type="text/javascript">	
(function ($) {
	$(function(){
		$(".newslist li").click(function(){
			 window.location=$(this).find('h2 a').attr('href');
		});
	});
})(jQuery);
	</script>

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
			$q = "SELECT node.title,node.nid,body_value FROM node,field_data_body WHERE field_data_body.entity_id = node.nid AND node.status =1 and field_data_body.bundle='tech_stuff' order by node.changed desc";
			$r = mysqli_query($q);
			$totalrows = mysqli_num_rows($r);
			$numofpages = ceil($totalrows / $limit);
			$limitvalue = $page * $limit - ($limit);
			
			$q = "SELECT node.title,node.nid,body_value
			FROM node,field_data_body WHERE field_data_body.entity_id = node.nid 
			AND node.status =1 and field_data_body.bundle='tech_stuff' order by node.changed desc LIMIT $limitvalue, $limit";
		 ?>
<div class="article">
										<h1>Tech Stuff</h1>
	<div class="compareBox active">
								<div class="campareBar">
									<h3>All Tech Stuff Articles</h3>
								</div>
							</div>
							<div id="ajax">
							<div class="tab_container BLR5">
								<div class="tab_content" id="tab1">
									<ul class="newslist" id="tstufflist">
										<?php
										if ($r = mysqli_query($q))
												{
												while($d_tstuff=mysqli_fetch_array($r))
													{
													$sql_img=mysqli_fetch_array(mysqli_query("select file_managed.uri from field_data_field_tech_stuff_image, file_managed where file_managed.fid = field_data_field_tech_stuff_image.field_tech_stuff_image_fid and field_data_field_tech_stuff_image.entity_id=".$d_tstuff['nid']));
										?>
										<li>
											<div class="clearfix listHolder">
												<div class="fleft w170">
													<a class="holderImg" title="<?php echo $d_tstuff['title'];?>" href="<?php echo url("node/".$d_tstuff['nid']);?>">
														<!--<img width="165" height="124" alt="<?php echo $d_tstuff['title'];?>" src="sites/default/files/<?php echo str_replace("public://","",$sql_img['uri']);?>">-->
														<strong>
														<img alt="<?php echo $d_tstuff['title'];?>" src="http://www.team-bhp.com/?q=sites/default/files/styles/check_medium_medium/public/<?php echo str_replace("public://","",$sql_img['uri']);?>">
														</strong>
													</a>
												</div><!-- News thum holder -->
												
												<div class="fright w460 ShortNews">
													<h2><a title="<?php echo $d_tstuff['title'];?>" href="<?php echo url("node/".$d_tstuff['nid']);?>"><?php echo $d_tstuff['title'];?></a></h2>
													
													<div class="past_shornote">
														<?php
														if(strlen($d_tstuff['body_value'])>195)
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
															//trim($desc.="<a href='".url('node/'.$d_tstuff['nid'])."'>"."&hellip;"."</a>");
															trim($desc.="&hellip;");
															}
															echo $desc;
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
												No Tech Stuff found 
												</div>
										</li><!-- news list -->
										<?php
										}
										?>
									</ul>
								</div><!-- tab 4 -->
								
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
						</div> <!-- End of ajax -->
						</div>
						
