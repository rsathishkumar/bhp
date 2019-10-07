 <?php
if(isset($_REQUEST['catname']))
{
$cat = $_REQUEST['catname'];
}
else if(!isset($_REQUEST['catname']) and !isset($_REQUEST['model']) and !isset($_REQUEST['tag']))
{
$cat = 'Indian';
}
?>
<div class="article">
	<h1 class="padL20 marB10">News</h1>
	<ul class="tab TLR5 clearfix">
		<li><a title="All" class="TLR5<?php if(($cat=='%') or isset($_REQUEST['model']) or isset($_REQUEST['tag'])) { ?> active<?php } ?>" href="#" onclick="shownews_bycat('%', this); return false;">All</a></li>
		<li><a title="Indian" class="TLR5<?php if(($cat=='Indian') or (!isset($_REQUEST['catname']) and !isset($_REQUEST['model']) and !isset($_REQUEST['tag']))) { ?> active<?php } ?>" href="#" onclick="shownews_bycat('Indian', this); return false;">Indian</a></li>
		<li><a title="International" class="TLR5<?php if($cat=='International') { ?> active<?php } ?>" href="#" onclick="shownews_bycat('International', this); return false;">International</a></li>
		<li><a title="Motor Sports" class="TLR5<?php if($cat=='Motor Sports') { ?> active<?php } ?>" href="#" onclick="shownews_bycat('Motor Sports', this); return false;">Motor Sports</a></li>
	</ul>
	<div id="ajax">
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
			}
			include_once("./themes/bhp/connect.php");
			$toshow = 10;
			if(isset($_REQUEST['catname']))
			{
			$q = "select node.nid as nid, node.created as created, title, field_news_category_value from node, field_data_field_news_category where type='news' and node.nid=field_data_field_news_category.entity_id and field_data_field_news_category.field_news_category_value like '%".$_REQUEST['catname']."%' and node.status=1 order by node.created desc";
			}
			else if(isset($_REQUEST['model']))
			{
			$q ="select node.nid as nid, node.created as created, title, field_news_category_value from node, field_data_field_news_category, field_data_field_news_make where type='news' and node.nid=field_data_field_news_category.entity_id and field_data_field_news_make.entity_id=node.nid and field_data_field_news_make.field_news_make_nid='".$_REQUEST['model']."' and node.status=1 order by node.created desc";
			}
			else if(isset($_REQUEST['tag']))
			{
			$q = "select node.nid as nid, node.created as created, title, field_news_category_value from node, field_data_field_news_category, field_data_field_news_tags where type='news' and node.nid=field_data_field_news_category.entity_id and node.nid=field_data_field_news_tags.entity_id and field_data_field_news_tags.field_news_tags_tid='".$_REQUEST['tag']."' and node.status=1 order by node.created desc";
			}
			else
			{
			$q = "select node.nid as nid, node.created as created, title, field_news_category_value from node, field_data_field_news_category where type='news' and node.nid=field_data_field_news_category.entity_id and field_data_field_news_category.field_news_category_value like 'Indian' and node.status=1 order by node.created desc";
			}
			
			if(isset($_REQUEST['i']))
			{
			$start = $_REQUEST['i'];
			}
			else
			{
			$start = 0;
			}
			$total_res = @mysqli_query($q) or die(mysql_error());
			$total_rows=@mysqli_num_rows($total_res);
			$q .= " limit ".$start.", ".$toshow;
			$news_res = @mysqli_query($q) or die(mysql_error());
			if($total_rows>0)
			{
			while($d_news=mysqli_fetch_array($news_res))
			{
			$url_res = @mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$d_news['nid']."'"));
			$url = $url_res['alias'];
			?>
			<li>
				<div class="clearfix listHolder">
					<div class="fleft w170">
						<a title="<?php echo $d_news['title'];?>" href="?q=<?php echo $url; ?>">
							<?php
								$img_res = @mysqli_query("select field_news_images_fid, uri from field_data_field_news_images, file_managed where field_data_field_news_images.field_news_images_fid=file_managed.fid  and field_data_field_news_images.entity_id=".$d_news['nid']) or die(mysql_error());
								$img_news=mysqli_fetch_array($img_res);
									if($img_news=='')
										{
									$img_res = @mysqli_query("select field_news_list_image_fid, uri from field_data_field_news_list_image, file_managed where field_data_field_news_list_image.field_news_list_image_fid=file_managed.fid  and field_data_field_news_list_image.entity_id=".$d_news['nid']) or die(mysql_error());
								$img_news=mysqli_fetch_array($img_res);	
										}
							?>
							<!--<img width="165" height="124" alt="<?php echo $d_news['title'];?>" src="sites/default/files/<?php echo str_replace('public://','',$img_news['uri']);?>" />-->
							<img width="165" height="124" alt="<?php echo $d_news['title'];?>" src="http://www.team-bhp.com/sites/default/files/styles/medium_medium/public/<?php echo str_replace('public://','',$img_news['uri']);?>" />
						</a>
					</div><!-- News thum holder -->
					
					<div class="fright w460 ShortNews">
						<h2><a title="<?php echo $d_news['title'];?>" href="?q=<?php echo $url; ?>"><?php echo $d_news['title'];?></a></h2>
						<div class="postDate">Posted: <?php echo returnDate($d_news['created']); ?></div>
						<div class="past_shornote">
							<?php
								$desc_res = @mysqli_query("select field_news_content_summary, field_news_content_value from field_data_field_news_content where entity_id=".$d_news['nid']) or die(mysql_error());
								$desc_news=mysqli_fetch_array($desc_res);
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
															if(strlen($desc_news['field_news_content_value'])>200)
															{
															//trim($desc.="<a href='".url('node/'.$d_advice['nid'])."'>"."&hellip;"."</a>");
															
															$ex_url='';
															if($restofind=='') 
																{ 
																 $ex_url.="http://";
																}
																//$ex_url.=$desc_news['field_ht_forum_url'];
															//trim($desc.="<a href='".url("node/".$d_news['nid'])."'>"."&hellip;"."</a>");
															}
//echo $desc;
															if(strlen($desc_news['field_news_content_value'])>200)
																{
															echo $desc."<a href='".url("node/".$d_news['nid'])."'>"."&hellip;"."</a>";
																}
																else
																{
																echo $desc;
																}
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
				echo "No News found" ;
				?>
			</li><!-- news list -->
			<?php
			}
			?>
		</ul>
		</div><!-- tab content -->
		<?php
if($total_rows>$toshow)
{
?>
		<div class="clearfix marT10">
			<div class="clearfix w100p">
				<?php
			if($start<$toshow)
			{
			?>
				<a class="btnLeft fleft btnLeftDisabled" href="#" onclick="return false;">
				<?php
			}
			else
			{
				$q = 'i='.($start-$toshow);
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
				<a class="btnLeft fleft" href="<?php echo $q; ?>" onclick="nav(this); return false;">
				<?php
			}
			?>
					<span>Newer</span>
				</a>
				<ul class="pagination">
					<!--<li class="first disable"><a title="go to previews 10 results" href="#">É</a></li>-->
					<?php
						$j=1;
						if($total_rows<=20)
							{
								$t = $total_rows;
							}
						else
							{
								$t = 20;
							}
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
							$q = 'i='.$i;
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
						<li><a title="go to page <?php echo $j; ?>"<?php echo $c; ?> href="<?php echo $q; ?>" onclick="<?php if($c=="") { ?>nav(this); <?php } ?>return false;"><?php echo $j; ?></a></li>
					<?php
					$j++;
						}
		$next = $start+$toshow;
					?>
					<!--<li class="first"><a title="go to next 10 results" href="#">É</a></li>-->
				</ul>
				<?php
				if($start<($t-$toshow))
				{
				$q = 'i='.($start+$toshow);
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
				<a class="btnRight fright" href="<?php echo $q; ?>" onclick="nav(this); return false;">
				<?php
				}
				else
				{
				?>
				<a class="btnRight fright btnRightDisabled" href="#" onclick="return false;">
				<?php
				}
				?>
					<span>Older</span>
				</a>
			</div><!-- w100p -->
		</div><!-- clearfix -->
<?php
}
?>
</div><!-- ajax -->
</div>
</div>
