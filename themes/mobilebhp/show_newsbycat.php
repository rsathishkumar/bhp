<script type="text/javascript">	
(function ($) {
	$(function(){
		$(".newslist li").click(function(){
			 window.location=$(this).find('h2 a').attr('href');
		});
	});
})(jQuery);
	</script>
<div class="tab_container BLR5">
<div id="tab2" class="tab_content">
<ul id="newslist" class="newslist">
<?php
//function to format date in 'xx days ago'
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
include_once("connect.php");
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
$q = "select node.nid as nid, node.created as created, title, field_news_category_value from node, field_data_field_news_category where type='news' and node.nid=field_data_field_news_category.entity_id and field_data_field_news_category.field_news_category_value like '%".$_POST['catname']."%' and node.status=1 order by node.created desc";
				$r = mysqli_query($q);
				$totalrows = mysqli_num_rows($r);
				$numofpages = ceil($totalrows / $limit);
				$limitvalue = $page * $limit - ($limit);
$q = "select node.nid as nid, node.created as created, title, field_news_category_value from node, field_data_field_news_category where type='news' and node.nid=field_data_field_news_category.entity_id and field_data_field_news_category.field_news_category_value like '%".$_POST['catname']."%' and node.status=1 order by node.created desc limit $limitvalue, $limit";
}
else if(isset($_REQUEST['model']))
{
$q ="select node.nid as nid, node.created as created, title, field_news_category_value from node, field_data_field_news_category, field_data_field_news_make where type='news' and node.nid=field_data_field_news_category.entity_id and field_data_field_news_make.entity_id=node.nid and field_data_field_news_make.field_news_make_nid like '".$_POST['model']."' and node.status=1 order by node.created desc";
			$r = mysqli_query($q);
				$totalrows = mysqli_num_rows($r);
				$numofpages = ceil($totalrows / $limit);
				$limitvalue = $page * $limit - ($limit);
$q ="select node.nid as nid, node.created as created, title, field_news_category_value from node, field_data_field_news_category, field_data_field_news_make where type='news' and node.nid=field_data_field_news_category.entity_id and field_data_field_news_make.entity_id=node.nid and field_data_field_news_make.field_news_make_nid like '".$_POST['model']."' and node.status=1 order by node.created desc limit $limitvalue, $limit";
}
else if(isset($_REQUEST['tag']))
{
$q = "select node.nid as nid, node.created as created, title from node, field_data_field_news_cat, field_data_field_news_tags where type='news' and node.nid=field_data_field_news_cat.entity_id and node.nid=field_data_field_news_tags.entity_id and field_data_field_news_cat.field_news_cat_nid like '".$_POST['tag']."' and node.status=1 group by node.nid order by node.created desc";
		$r = mysqli_query($q);
				$totalrows = mysqli_num_rows($r);
				$numofpages = ceil($totalrows / $limit);
				$limitvalue = $page * $limit - ($limit);
$q = "select node.nid as nid, node.created as created, title from node, field_data_field_news_cat, field_data_field_news_tags where type='news' and node.nid=field_data_field_news_cat.entity_id and node.nid=field_data_field_news_tags.entity_id and field_data_field_news_cat.field_news_cat_nid like '".$_POST['tag']."' and node.status=1 group by node.nid order by node.created desc limit $limitvalue, $limit";
}



//if ($r = mysqli_query($q))
if ($r = mysqli_query($q))
{
	if(mysqli_num_rows($r)>0)
		{
while($d_news=mysqli_fetch_array($r))
			{
			$url_res = @mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$d_news['nid']."'"));
			$url = $url_res['alias'];
			$sql_img_check=@mysqli_fetch_array(mysqli_query("select field_data_field_news_media_type.field_news_media_type_value,field_data_field_news_category.field_news_category_value,node.title from field_data_field_news_media_type,node,field_data_field_news_category where field_data_field_news_media_type.entity_id =".$d_news['nid']." and field_data_field_news_media_type.entity_id=node.nid and field_data_field_news_category.entity_id=node.nid"));
					
			?>
			<li>
			<div class="clearfix listHolder">
			<div class="fleft w170">
			<a class="holderImg" title="<?php echo $d_news['title'];?>" href="<?php echo $url; ?>">
			<?php
			if($sql_img_check['field_news_media_type_value']=='Images')
				{
			$img_res = @mysqli_query("select field_news_images_fid, uri from field_data_field_news_images, file_managed where field_data_field_news_images.field_news_images_fid=file_managed.fid and field_data_field_news_images.delta=0 and field_data_field_news_images.entity_id=".$d_news['nid']) or die(mysql_error());
			$img_news=mysqli_fetch_array($img_res);
				}
				else
				{
			$img_res = @mysqli_query("select field_news_list_image_fid, uri from field_data_field_news_list_image, file_managed where field_data_field_news_list_image.field_news_list_image_fid=file_managed.fid  and field_data_field_news_list_image.entity_id=".$d_news['nid']) or die(mysql_error());
			$img_news=mysqli_fetch_array($img_res);
				}
			?>
			<!--<img width="165" height="124" alt="<?php echo $d_news['title'];?>" src="sites/default/files/<?php echo str_replace("public://","",$img_news['uri']);?>">-->
			<strong>
			<img alt="<?php echo $d_news['title'];?>" src="/?q=sites/default/files/styles/check_medium_medium/public/<?php echo str_replace("public://","",$img_news['uri']);?>">
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
			//echo substr($desc_news['field_news_content_value'], 0, 100);
																$desc='';
																	if(strlen($desc_news['field_news_content_value'])>195)
																		{
																		$finddot=@strpos($desc_news['field_news_content_value'],".",195);
																		$findspcetostop=@strpos($desc_news['field_news_content_value']," ",195);
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
																			$desc = trim(substr($desc_news['field_news_content_value'],0 , $pos));
																		}
																		else
																		{
																			$desc = $desc_news['field_news_content_value'];
																		}
																		
																	
																		if(strlen($desc_news['field_news_content_value'])>195)
																			{
																		//echo $desc."<a href='?q=".$url."'>"."&hellip;"."</a>";
																		//echo $desc."&hellip;";
																			 $desc=$desc."&hellip;";
																			 $desc= trim(str_replace("&lt;&hellip;","&hellip;",str_replace("br&hellip;","&hellip;",$desc)));
																			 echo str_replace("<&hellip;","&hellip;",$desc);
																			}
																			else
																			{
																		echo $desc;	
																			}
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
		echo "No News found" ;
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
	echo "No News found" ;
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
										$q = 'page='.($pageprev);
										if(isset($_REQUEST['catname']))
											{
												$q .= '&catname='.$_REQUEST['catname'];
											}
										else if(isset($_REQUEST['model']))
											{
												$q .= '&model='.$_REQUEST['model'];
											}
										else if(isset($_REQUEST['tag']))
											{
												$q .= '&tag='.$_REQUEST['tag'];
											}
										else
											{
												$q .= '&catname=Indian';
											}
										//echo '<a href="'.$_SERVER['php_SELF'].'?page='.$pageprev.'">PREV</a> - ';
								?>
									<a class="btnLeft fleft" href="<?php echo $q; ?>" onclick="nav(this); return false;">
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
											
												$q = 'page='.$k;
												if(isset($_REQUEST['catname']))
													{
														$q .= '&catname='.$_REQUEST['catname'];
													}
												else if(isset($_REQUEST['model']))
													{
														$q .= '&model='.$_REQUEST['model'];
													}
												else if(isset($_REQUEST['tag']))
													{
														$q .= '&tag='.$_REQUEST['tag'];
													}
												else
													{
														$q .= '&catname=Indian';
													}
										?>
										<li><a<?php if($c=='') {?> title="go to page <?php echo $k; ?>"<?php } echo $c; ?> href="<?php if($c=='') {echo $q; } else {echo "/#";}?>" onclick="<?php if($c=="") { ?>nav(this); <?php } ?>return false;"><?php echo $k; ?></a></li>
										<?php
										
										}
										?>
								</ul>
								<?php
								if(($totalrows - ($limit * $page)) > 0)
											{
											$pagenext = $page + 1;
											$q = 'page='.($pagenext);
												if(isset($_REQUEST['catname']))
													{
														$q .= '&catname='.$_REQUEST['catname'];
													}
												else if(isset($_REQUEST['model']))
													{
														$q .= '&model='.$_REQUEST['model'];
													}
												else if(isset($_REQUEST['tag']))
													{
														$q .= '&tag='.$_REQUEST['tag'];
													}
												else
													{
														$q .= '&catname=Indian';
													}
										
										?>
										 <a class="btnRight fright rPos"  href="<?php echo $q;?>" onclick="nav(this); return false;">
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
