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
<ul id="advicelist" class="newslist">
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
                    if($flr == 1){ 
                        $date_string = '1 hour ago'; 
                    } 
                    else{ 
                        $date_string =  $flr.' hours ago'; 
                    } 
        break; 
        
        case ($minusdate > 2359 && $minusdate < 310000): 
                    $flr = floor($minusdate * .0001); 
                    if($flr == 1){ 
                        $date_string = '1 day ago'; 
                    } 
                    else{ 
                        $date_string =  $flr.' days ago'; 
                    } 
        break; 
        
        case ($minusdate > 310001 && $minusdate < 12320000): 
                    $flr = floor($minusdate * .000001); 
                    if($flr == 1){ 
                        $date_string = "1 month ago"; 
                    } 
                    else{ 
                        $date_string =  $flr.' months ago'; 
                    } 
        break; 
        
        case ($minusdate > 100000000): 
                $flr = floor($minusdate * .00000001); 
                if($flr == 1){ 
                        $date_string = '1 year ago.'; 
                } 
                else
                { 
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
if(isset($_REQUEST['catname']) && ($_REQUEST['catname']!='%') && ($_REQUEST['catname']!='All'))
	{
 $q = "SELECT node.title,node.nid, field_data_field_advice_categories.field_advice_categories_value
FROM node, field_data_field_advice_categories WHERE field_data_field_advice_categories.entity_id = node.nid 
AND node.status =1
AND node.nid = field_data_field_advice_categories.entity_id
AND field_data_field_advice_categories.field_advice_categories_value like '%".$_REQUEST['catname']."%' and node.status=1 order by node.created desc";
	$r = mysqli_query($q);
	$totalrows = mysqli_num_rows($r);
	$numofpages = ceil($totalrows / $limit);
	$limitvalue = $page * $limit - ($limit);
	 
$q = "SELECT node.title,node.nid, field_data_field_advice_categories.field_advice_categories_value
FROM node, field_data_field_advice_categories WHERE field_data_field_advice_categories.entity_id = node.nid 
AND node.status =1
AND node.nid = field_data_field_advice_categories.entity_id
AND field_data_field_advice_categories.field_advice_categories_value like '%".$_REQUEST['catname']."%' and node.status=1 order by node.created desc limit $limitvalue, $limit";
	}
else
	{
$q = "SELECT node.title,node.nid, field_data_field_advice_categories.field_advice_categories_value
FROM node, field_data_field_advice_categories WHERE field_data_field_advice_categories.entity_id = node.nid 
AND node.status =1
AND node.nid = field_data_field_advice_categories.entity_id order by node.created desc";	
	$r = mysqli_query($q);
	$totalrows = mysqli_num_rows($r);
	$numofpages = ceil($totalrows / $limit);
	$limitvalue = $page * $limit - ($limit);
	
	$q = "SELECT node.title,node.nid, field_data_field_advice_categories.field_advice_categories_value
FROM node, field_data_field_advice_categories WHERE field_data_field_advice_categories.entity_id = node.nid 
AND node.status =1
AND node.nid = field_data_field_advice_categories.entity_id order by node.created desc limit $limitvalue, $limit";	
	}



if ($r = mysqli_query($q)) 
{
while($d_advice=@mysqli_fetch_array($r))
{
$url_res = @mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$d_advice['nid']."'"));
$url = $url_res['alias'];
$sql_img_check=@mysqli_fetch_array(mysqli_query("select field_advice_media_type_value from field_data_field_advice_media_type where entity_id =".$d_advice['nid']));
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
<a title="<?php echo $d_advice['title'];?>" href="<?php echo $url; ?>">
<?php
//$img_res = @mysqli_query("select field_news_images_fid, uri from field_data_field_news_images, file_managed where field_data_field_news_images.field_news_images_fid=file_managed.fid and field_data_field_news_images.delta=0 and field_data_field_news_images.entity_id=".$d_advice['nid']) or die(mysql_error());
//$img_news=mysqli_fetch_array($img_res);
if($sql_img!='')
		{
?>
<!--<img width="165" height="124" alt="<?php echo $d_advice['title'];?>" src="sites/default/files/<?php echo str_replace("public://","",$sql_img['uri']);?>">-->
<Strong>
<img alt="<?php echo $d_advice['title'];?>" src="/?q=sites/default/files/styles/check_medium_medium/public/<?php echo str_replace("public://","",$sql_img['uri']);?>">
</strong>
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
<h2><a title="<?php echo $d_advice['title'];?>" href="<?php echo $url; ?>"><?php echo $d_advice['title'];?></a></h2>
<div class="past_shornote">
<?php
$sql_advice=mysqli_fetch_array(mysqli_query("select field_advice_content_value from field_data_field_advice_content where entity_id=".$d_advice['nid']));

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
					//trim($desc.="<a href='?q=".$url."'>"."&hellip;"."</a>");
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
<?php
echo "No Advice found" ;
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
										
										
										if (($page + $slice) < $numofpages) {
										$this_far = $page + $slice;
										} else {
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
