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
										 $toshow = 10;
										if(isset($_REQUEST['start']))
										{
											$start = $_REQUEST['start'];
										}
										else
										{
											$start = 0;
										}
$tstuff_res = @mysqli_query("SELECT node.title,node.nid,body_value
FROM node,field_data_body WHERE field_data_body.entity_id = node.nid 
AND node.status =1 and field_data_body.bundle='safety' order by node.changed desc limit ".$start.", ".$toshow."") or die(mysql_error());

$total_res = @mysqli_query("SELECT node.title,node.nid,body_value
FROM node,field_data_body WHERE field_data_body.entity_id = node.nid 
AND node.status =1 and field_data_body.bundle='safety' order by node.changed desc") or die(mysql_error());
$total_rows=@mysqli_num_rows($total_res);
 ?>
					<div class="article">
						<h1>Safety</h1>
	<div class="compareBox active">
								<div class="campareBar">
									<h3>All Safety Articles</h3>
								</div>
							</div>
							<div id="ajax">
							<div class="tab_container BLR5">
								<div class="tab_content" id="tab1">
									<ul class="newslist" id="safetylist">
										<?php
										if($total_rows>0)
												{
												while($d_safety=mysqli_fetch_array($tstuff_res))
													{
													$sql_img=mysqli_fetch_array(mysqli_query("select file_managed.uri from field_data_field_safety_image,file_managed where file_managed.fid =field_data_field_safety_image.field_safety_image_fid and field_data_field_safety_image.entity_id=".$d_safety['nid']));
										?>
										<li>
											<div class="clearfix listHolder">
												<div class="fleft w170">
													<a title="<?php echo $d_safety['title'];?>" class="holderImg" href="<?php echo url("node/".$d_safety['nid']);?>">
														<!-- <img width="165" height="124" alt="<?php echo $d_safety['title'];?>" src="sites/default/files/<?php echo str_replace("public://","",$sql_img['uri']);?>"> -->
														<img alt="<?php echo $d_safety['title'];?>" src="http://www.team-bhp.com/?q=sites/default/files/styles/check_medium_medium/public/<?php echo str_replace("public://","",$sql_img['uri']);?>">
													</a>
												</div><!-- News thum holder -->
												
												<div class="fright w460 ShortNews">
													<h2><a title="<?php echo $d_safety['title'];?>" href="<?php echo url("node/".$d_safety['nid']);?>"><?php echo $d_safety['title'];?></a></h2>
													
													<div class="past_shornote">
														<?php
														if(strlen($d_safety['body_value'])>205)
															{
															$finddot=@strpos($d_safety['body_value'],".",205);
															$findspcetostop=@strpos($d_safety['body_value']," ",205);
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
																$desc = trim(substr($d_safety['body_value'],0 , $pos));
															}
															else
															{
																$desc = $d_safety['body_value'];
															}
															
															/*if(strlen($d_safety['body_value'])>205)
															{
															trim($desc.="<a href='".url('node/'.$d_safety['nid'])."'>"."&hellip;"."</a>");
															}*/
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
											<div class="clearfix">
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
							if($total_rows>$toshow)
							{
							?>
							<div class="marT10 clearfix">
								<div class="clearfix w100p">
								<a class="btnLeft fleft btnLeftDisabled" href="#" onclick="return false;">
								<span>Newer</span>
								</a>
	
									<ul class="pagination">
										<!--<li class="first disable"><a title="go to previews 10 results" href="#">…</a></li>-->
										<?php
											$j=1;
										for($i=0; $i<$total_rows; $i=$i+$toshow)
											{
											if($i==$start)
												{
													$c = "class=\"active\"";
												}
											else if(($start==0) && ($j==1))
												{
													$c = "class=\"active\"";
												}
											else
												{
													$c = "";
												}
										?>
											<li><a title="go to page <?php echo $j; ?>"<?php echo $c; ?> href="i=<?php echo $i; ?>" onclick="<?php if($c=="") { ?>nav_safety(this); <?php } ?>return false;"><?php echo $j; ?></a></li>
										<?php
										$j++;
											}
$next = $start+$toshow;
										?>
										<!--<li class="first"><a title="go to next 10 results" href="#">…</a></li>-->
										</ul>
										<a class="btnRight fright"  href="i=<?php echo $next; ?>" onclick="nav_safety(this); return false;">
											<span>Older</span>
										</a>
								</div>	
							</div>
							<?php
							}
						?>
						</div> <!-- End of ajax -->
						</div>
						
