<?php
$sql_news_weekly_viewd = @mysqli_query("SELECT node.title,node.nid,node_counter.totalcount, node_counter.daycount
FROM node, node_counter WHERE node.nid = node_counter.nid AND node.type = 'hot_threads' and node_counter.timestamp and  node_counter.timestamp >=" . strtotime("- 7 day") . " and node.created >='" . strtotime("- 7 day") . "' order by node_counter.totalcount desc limit 0,5");

$sql_news_monthly_viewd = @mysqli_query("SELECT node.title,node.nid,node_counter.totalcount, node_counter.daycount
FROM node, node_counter WHERE node.nid = node_counter.nid AND node.type = 'hot_threads' and node_counter.timestamp and  node_counter.timestamp >=" . strtotime("- 30 day") . " and node.created >='" . strtotime("- 30 day") . "'order by node_counter.totalcount desc limit 0,5");
$num_monthli = @mysqli_num_rows($sql_news_monthly_viewd);
$num_weekly = @mysqli_num_rows($sql_news_weekly_viewd);
?>
<script type="text/javascript">
(function ($) {
$(function(){
	$(".listHolder").hover(
	function(){
			$(this).addClass("hover");
		},
	function(){
			$(this).removeClass("hover");
			}
	);

	$(".mv_tab_content li .listBox").hover(
	function(){
			$(this).addClass("hover");
		},
	function(){
			$(this).removeClass("hover");
			}
	);

	$(function()
					{
						$(".mv_tab_content li").click(function(e){
						window.open($(this).attr("rel"),"_blank");
						return false;
							// window.location="news-details.php";
						});
					}
		);

	jQuery("ul.most_view li a").click(function(){
		jQuery("ul.most_view li a").removeClass('active');
		jQuery(this).addClass('active');
		jQuery('div.mv_tab_content').css('display', 'none');
		jQuery(jQuery(this).attr('href')).fadeIn("fast");
		return false;
	});

	});
})(jQuery);

</script>

<?php
if (($num_weekly > 0) || ($num_monthli > 0)) {
	?>
<div class="roundAll5 clearfix mostViewed marB10">
	<h4>Most Viewed</h4>

	<ul class="most_view clearfix marT10">
		<?php
if ($num_weekly > 0) {
		?>
		<li class="TLR5"><a href="#mv_tab1" class="TLR5 active">This Week</a></li>
		<?php
}
	if ($num_monthli > 0) {
		?>
		<li class="TLR5"><a href="#mv_tab2" class="TLR5">This Month</a></li>
		<?php
}
	?>
	</ul>

	<div class="mv_tab_container">
		<?php
if ($num_weekly > 0) {
		?>
		<div id="mv_tab1" class="mv_tab_content BLR5" style="display:block">

			<ul>
			<?php
while ($weekly_ht = mysqli_fetch_array($sql_news_weekly_viewd)) {
			$d_thread = mysqli_fetch_array(mysqli_query("select field_ht_forum_url from field_data_field_ht_forum where entity_id=" . $weekly_ht['nid']));
			$sql_imgweekly = @mysqli_fetch_array(mysqli_query("select uri from file_managed,field_data_field_ht_image where field_data_field_ht_image.field_ht_image_fid=file_managed.fid and field_data_field_ht_image.entity_id=" . $weekly_ht['nid']));
			$restofindweekly = strstr($d_thread['field_ht_forum_url'], "http://");
			$weekly_noaddata = node_load($weekly_ht['nid']);

			$forum_link_is_http = strstr($d_thread['field_ht_forum_url'], "http://");
			$forum_link_is_https = strstr($d_thread['field_ht_forum_url'], "https://");
			$forum_discussion_url = $d_thread['field_ht_forum_url'];
			//no leading http or https found

			if (!$forum_link_is_http && !$forum_link_is_https) {

				$forum_discussion_url = 'https://' . $d_thread['field_ht_forum_url'];
			}

			//link is http, so let us move it to https
			if ($forum_link_is_http) {

				$forum_discussion_url = str_replace('http://', 'https://', $forum_discussion_url);
			}
			//echo $forum_discussion_url;
			$d_thread['field_ht_forum_url'] = $forum_discussion_url;
			?>
				<li class="clearfix"  rel="<?php echo $forum_discussion_url; ?>" onclick="return updatethreadcounter('<?php echo $forum_discussion_url; ?>','<?php echo $weekly_ht['nid']; ?>')">
					<div class="listBox clearfix">
						<div class="fleft w70 marR10">
							<a class="listImg" title="<?php echo $weekly_ht['title']; ?>" href="<?php echo $forum_discussion_url; ?>" >
								<strong>
								<!--<img src="/sites/default/files/<?php echo str_replace("public://", "", $sql_imgweekly['uri']); ?>" width="70" height="53" alt="<?php echo $weekly_noaddata->title; ?>" />-->
								<img src="/?q=sites/default/files/styles/check_thumb_review_detail/public/<?php echo str_replace("public://", "", $sql_imgweekly['uri']); ?>" alt="<?php echo $weekly_noaddata->title; ?>" />
								</strong>
							</a>
						</div><!-- fleft w70 -->

						<a title="<?php echo $weekly_noaddata->title; ?>" href="<?php echo $forum_discussion_url;?>"><?php echo $weekly_noaddata->title; ?></a>

					</div>
				</li>
			<?php
}
		?>


			</ul>

		</div><!-- tab 1 -->
	<?php
}
	if ($num_monthli > 0) {
		?>
		<div id="mv_tab2" class="mv_tab_content" style="display:<?php if ($num_weekly == 0) {?>block<?php } else {?>none<?php }?>">
			<ul>
				<?php
while ($monthly_ht = mysqli_fetch_array($sql_news_monthly_viewd)) {
			$d_threadmonthly = mysqli_fetch_array(mysqli_query("select field_ht_forum_url from field_data_field_ht_forum where entity_id=" . $monthly_ht['nid']));
			$sql_imgmonthly = @mysqli_fetch_array(mysqli_query("select uri from file_managed,field_data_field_ht_image where field_data_field_ht_image.field_ht_image_fid=file_managed.fid and field_data_field_ht_image.entity_id=" . $monthly_ht['nid']));
			$restofindmonthly = strstr($d_threadmonthly['field_ht_forum_url'], "http://");
			$monthly_noaddata = node_load($monthly_ht['nid']);

			$forum_link_is_http = strstr($d_threadmonthly['field_ht_forum_url'], "http://");
			$forum_link_is_https = strstr($d_threadmonthly['field_ht_forum_url'], "https://");
			$forum_discussion_url = $d_threadmonthly['field_ht_forum_url'];
			//no leading http or https found

			if (!$forum_link_is_http && !$forum_link_is_https) {

				$forum_discussion_url = 'https://' . $d_threadmonthly['field_ht_forum_url'];
			}

			//link is http, so let us move it to https
			if ($forum_link_is_http) {

				$forum_discussion_url = str_replace('http://', 'https://', $forum_discussion_url);
			}
			//echo $forum_discussion_url;
			$d_threadmonthly['field_ht_forum_url'] = $forum_discussion_url;

			?>
			<li class="clearfix" rel="<?php echo $forum_discussion_url; ?>" onclick="return updatethreadcounter('<?php echo $forum_discussion_url; ?>','<?php echo $monthly_ht['nid']; ?>')">
					<div class="listBox clearfix">
						<div class="fleft w70 marR10">
							<a class="listImg" href="<?php echo $forum_discussion_url; ?>" title="<?php echo $monthly_noaddata->title; ?>">
								<strong>
								<!-- <img src="/sites/default/files/<?php echo str_replace("public://", "", $sql_imgmonthly['uri']); ?>" width="70" height="53" alt="<?php echo $monthly_ht['title']; ?>" /> -->
								<img src="/?q=sites/default/files/styles/check_thumb_review_detail/public/<?php echo str_replace("public://", "", $sql_imgmonthly['uri']); ?>" alt="<?php echo $monthly_ht['title']; ?>" />
								</strong>
							</a>
						</div><!-- fleft w70 -->
						<a href="<?php echo $forum_discussion_url;?>"  title="<?php echo $monthly_ht['title']; ?>"><?php echo $monthly_noaddata->title; ?></a>
					</div><!-- list box -->
				</li>
			<?php
}
		?>

			</ul>
		</div><!-- tab 2 -->
		<?php
}
	?>

	</div><!-- tab container -->
</div><!-- most viewed -->
<?php
}
?>
