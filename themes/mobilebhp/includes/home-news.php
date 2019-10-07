
<?php

function returnDate($timestamp)
{
	$difference = time() - $timestamp;

	$seven_daysbefore = time() - strtotime(" - 7 day");

	if ($difference <= $seven_daysbefore) {
		$periods = array('second', 'minute', 'hour', 'day', 'week', 'month', 'year');
		$multiples = array('seconds', 'minutes', 'hours', 'days', 'weeks', 'months', 'years');
		$lengths = array('60', '60', '24', '7', '4.35', '12');
		for ($i = 0; $difference >= $lengths[$i]; $i++) {
			$difference /= $lengths[$i];
		}
		$difference = round($difference);
		if ($difference != 1) {
			$periods[$i] = $multiples[$i];
		}
		$text = $difference . ' ' . $periods[$i];
		if ($text == "7 days") {
			$text = date("jS F Y, H:i", $timestamp);
			return $text;
		} else {
			return $text . " ago";
		}

		//return date("Y-m-d",$timestamp);
	} else {
		return date("jS F Y, H:i", $timestamp);
	}

}


//$q_hnewsinternational="SELECT title, nid FROM node, field_data_field_news_category WHERE field_data_field_news_category.field_news_category_value = 'International' AND node.nid = field_data_field_news_category.entity_id AND node.status =1 AND node.type = 'news' order by node.created desc limit 0,6";
$q_hnewsinternational="SELECT node.title,node.nid,node_counter.totalcount, node_counter.daycount FROM node, node_counter WHERE node.nid = node_counter.nid and node.type = 'news' and node_counter.timestamp >='".strtotime("- 30 day")."' and node.created >='".strtotime("- 30 days")."' and node.status=1 order by node_counter.totalcount desc limit 0,6";
$res_hnewsinternational=@mysqli_query($q_hnewsinternational);
$nof_hnewsinternational=@mysqli_num_rows($res_hnewsinternational);

$q_hnews="SELECT title, nid FROM node, field_data_field_news_category WHERE field_data_field_news_category.field_news_category_value = 'Indian' AND node.nid = field_data_field_news_category.entity_id AND node.status =1 AND node.type = 'news' order by node.created desc limit 0,8";
$res_hnews=@mysqli_query($q_hnews);
$nof_hnews=@mysqli_num_rows($res_hnews);
if($nof_hnews>0 || $nof_hnewsinternational>0)
	{
?>

				<?php if($nof_hnews>0) { ?>
		<div class="threadsList">
					<ul>
						<?php
							while($d_india=mysqli_fetch_array($res_hnews))
								{
				$sql_img_check=@mysqli_fetch_array(mysqli_query("select field_news_media_type_value from field_data_field_news_media_type where entity_id =".$d_india['nid']));
							if($sql_img_check['field_news_media_type_value']=='Images')
							{
							$img_res = @mysqli_query("select field_news_images_fid, uri from field_data_field_news_images, file_managed where field_data_field_news_images.field_news_images_fid=file_managed.fid  and field_data_field_news_images.entity_id=".$d_india['nid']) or die(mysql_error());
		$img_news=mysqli_fetch_array($img_res);
							}
							else
							{
							$img_res = @mysqli_query("select field_news_list_image_fid, uri from field_data_field_news_list_image, file_managed where field_data_field_news_list_image.field_news_list_image_fid=file_managed.fid  and field_data_field_news_list_image.entity_id=".$d_india['nid']) or die(mysql_error());
						$img_news=mysqli_fetch_array($img_res);
							}
								$nodedata_india=node_load($d_india['nid']);
						?>
						<li>
							<a class="clearfix" href="<?php echo url("node/".$d_india['nid']);?>" title="<?php echo $nodedata_india->title;?>">
								<!-- <img width="70" height="53" src="sites/default/files/<?php echo str_replace("public://","",$img_news['uri']);?>" alt="<?php echo $nodedata_india->title;?>" />-->
<!--								<img src="/?q=sites/default/files/styles/check_thumb_review_detail/public/--><?php //echo str_replace("public://","",$img_news['uri']);?><!--" alt="--><?php ////echo $nodedata_india->title;?><!--" />-->

								<span class="text">
									<span class="ellipsis-2-line">
										<?php echo $nodedata_india->title;?>
									</span>
									<small class="date"><?php echo returnDate($nodedata_india->created);?></small>
								</span>
							</a>
						</li>
					<?php } ?>
				 	</ul><!-- homeCarList -->
		</div>

		<!--button-->
		<div class="text-center">
			<a href="/news/" ripple-background="radial-gradient(red, yellow)" ripple-opacity="0.7" class="btn btn-red ripple">All News</a>
		</div>
<!--					<div class="marT10 marR12 clearfix">-->
<!--						<a title="View All News" href="news" class="fright btnRight">-->
<!--							<span>View All News</span>-->
<!--						</a>-->
<!--					</div>-->


			<?php } else { ?>
				<div>Currently no news is available in this category.</div>
			<?php } ?>

<?php
	}
?>
