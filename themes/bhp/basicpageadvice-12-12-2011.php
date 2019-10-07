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
											if($_GET['catname']=='All')
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
																						
?>
<script type="text/javascript">	
(function ($) {
	    
		$(function(){
						
			
			$(".newslist li").click(function(){
													 window.location=$(this).find('h2 a').attr('href');
												});

/*
			//category tab 
			$("ul.tab li").click(function() {
			$("ul.tab li a").removeClass("active"); //Remove any "active" class
			$(this).find("a").addClass("active"); //Remove any "active" class
			$(this).addClass("active"); //Add "active" class to selected tab
			$(".tab_content").hide(); //Hide all tab content
	
			var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
			$(activeTab).fadeIn(); //Fade in the active ID content
			return false;
			});
*/
			//Most Viewed tab 				
			$(".most_view li").click(function() {
			$(".most_view li a").removeClass("active"); //Remove any "active" class
			$(this).find("a").addClass("active"); //Remove any "active" class
			$(this).addClass("active"); //Add "active" class to selected tab
			$(".mv_tab_content").hide(); //Hide all tab content
	
			var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
			$(activeTab).fadeIn(); //Fade in the active ID content
			return false;
			});

		});
})(jQuery);
	</script>

<div class="article">
<h1>Advice</h1>
							<ul id="advicecat" class="tab TLR5 clearfix">
								<li><a title="All" class="TLR5 <?php if($_GET['catname']=='All'){?> active<?php } ?>" href="#tab1" onclick="showadvice_bycat('%', this); return false;">All</a></li>
								<li><a title="On Buying" class="TLR5<?php if($_GET['catname']=='' || $_GET['catname']=='On Buying'){?> active<?php } ?>" href="#tab2" onclick="showadvice_bycat('On Buying', this); return false;">On Buying </a></li>
								<li><a title="On Selling" class="TLR5<?php if($_GET['catname']=='On Owning'){?> active<?php } ?>" href="#tab3" onclick="showadvice_bycat('On Owning', this); return false;">On Owning</a></li>
								<li><a title="On Modifying" class="TLR5<?php if($_GET['catname']=='On Modifying'){?> active<?php } ?>" href="#tab4" onclick="showadvice_bycat('On Modifying', this); return false;">On Modifying</a></li>
								<li><a title="Miscellany" class="TLR5<?php if($_GET['catname']=='Miscellany'){?> active<?php } ?>" href="#tab5" onclick="showadvice_bycat('Miscellany', this); return false;">Miscellany</a></li>								
							</ul>
							<div id="ajax">
							<div class="tab_container BLR5">
								
								<div style="display: block;" class="tab_content" id="tab2">
									<ul class="newslist" id="advicelist">
									<?php
										if ($r = mysqli_query($q)) 
												{
										while($d_advice=mysqli_fetch_array($r))
													{
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
														if(strlen($sql_advice['field_advice_content_value'])>195)
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
															//trim($desc.="<a href='".url('node/'.$d_advice['nid'])."'>"."&hellip;"."</a>");
                                                               trim($desc.="&hellip;");
															}
															echo str_replace("&lt;!--pagebreak--&gt;","",$desc);
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
										if(isset($_REQUEST['catname']) )
										{
											$q1 .= '&catname='.$_REQUEST['catname'];
										}
									else
										{
											$q1 .= '&catname=On Buying';
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
									<a class="btnLeft fleft" href="<?php echo 'page='.$pageprev.$q1; ?>" onclick="nav_advice(this); return false;">
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
										<li><a<?php if($c=='') {?> title="go to page <?php echo $k; ?>"<?php } echo $c; ?> href="<?php if($c=='') {echo 'page='.$k.$q1; } else {echo "/#";}?>" onclick="<?php if($c=="") { ?>nav_advice(this); <?php } ?>return false;"><?php echo $k; ?></a></li>
										<?php
										
										}
										
										
										?>
								</ul>
										<?php
										if(($totalrows - ($limit * $page)) > 0)
											{
										$pagenext = $page + 1;
										?>
										 <a class="btnRight fright rPos"  href="page=<?php echo $pagenext .$q1;?>" onclick="nav_advice(this); return false;">
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
