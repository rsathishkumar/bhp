<?php
include_once "connect.php";
$limit = 13;
$slice = 7;
$start = 1;
if (!isset($_GET['page']) || !is_numeric($_GET['page'])) {
	$page = 1;
} else {
	$page = $_GET['page'];
}

if ($_GET['catname'] == '' || $_GET['catname'] == '%' || $_GET['catname'] == 'All') {
	//$hotthread_res = @mysqli_query(" ORDER BY node.changed DESC limit ".$start.", ".$toshow."") or die(mysql_error());
	$q = "SELECT node.title,node.changed,node.created,node.nid,field_data_field_ht_summary.field_ht_summary_value,field_data_field_ht_threads.field_ht_threads_value,file_managed.uri,field_data_field_ht_forum.field_ht_forum_url,field_data_field_ht_author.field_ht_author_value as author
		FROM node,file_managed,field_data_field_ht_forum,field_data_field_ht_summary,field_data_field_ht_threads,field_data_field_ht_image,field_data_field_ht_author
		WHERE field_data_field_ht_threads.entity_id = node.nid
		AND file_managed.fid = field_data_field_ht_image.field_ht_image_fid AND node.status=1 AND field_data_field_ht_image.entity_id=node.nid AND field_data_field_ht_summary.entity_id = field_data_field_ht_threads.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_forum.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_threads.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_author.entity_id group by node.nid ORDER BY node.changed DESC";
	$r = mysqli_query($q);
	$totalrows = mysqli_num_rows($r);
	$numofpages = ceil($totalrows / $limit);
	$limitvalue = $page * $limit - ($limit);

	$q = "SELECT node.title,node.changed,node.created,node.nid,field_data_field_ht_summary.field_ht_summary_value,field_data_field_ht_threads.field_ht_threads_value,file_managed.uri,field_data_field_ht_forum.field_ht_forum_url,field_data_field_ht_author.field_ht_author_value as author
		FROM node,file_managed,field_data_field_ht_forum,field_data_field_ht_summary,field_data_field_ht_threads,field_data_field_ht_image,field_data_field_ht_author
		WHERE field_data_field_ht_threads.entity_id = node.nid
		AND file_managed.fid = field_data_field_ht_image.field_ht_image_fid AND node.status=1 AND field_data_field_ht_image.entity_id=node.nid AND field_data_field_ht_summary.entity_id = field_data_field_ht_threads.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_forum.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_threads.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_author.entity_id group by node.nid ORDER BY node.changed DESC LIMIT $limitvalue, $limit";
} else {
	$q = "SELECT node.title,node.changed,node.created,node.nid,field_data_field_ht_summary.field_ht_summary_value,field_data_field_ht_threads.field_ht_threads_value,file_managed.uri,field_data_field_ht_forum.field_ht_forum_url,field_data_field_ht_author.field_ht_author_value as author
		FROM node,file_managed,field_data_field_ht_forum,field_data_field_ht_summary,field_data_field_ht_threads,field_data_field_ht_image,field_data_field_ht_author
		WHERE field_data_field_ht_threads.entity_id = node.nid AND field_data_field_ht_threads.field_ht_threads_value ='" . $_GET['catname'] . "' AND file_managed.fid = field_data_field_ht_image.field_ht_image_fid AND node.status=1 AND field_data_field_ht_image.entity_id=node.nid AND field_data_field_ht_summary.entity_id = field_data_field_ht_threads.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_forum.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_threads.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_author.entity_id group by node.nid ORDER BY node.changed DESC";

	$r = mysqli_query($q);
	$totalrows = mysqli_num_rows($r);
	$numofpages = ceil($totalrows / $limit);
	$limitvalue = $page * $limit - ($limit);
	$q = "SELECT node.title,node.changed,node.created,node.nid,field_data_field_ht_summary.field_ht_summary_value,field_data_field_ht_threads.field_ht_threads_value,file_managed.uri,field_data_field_ht_forum.field_ht_forum_url,field_data_field_ht_author.field_ht_author_value as author
		FROM node,file_managed,field_data_field_ht_forum,field_data_field_ht_summary,field_data_field_ht_threads,field_data_field_ht_image,field_data_field_ht_author
		WHERE field_data_field_ht_threads.entity_id = node.nid AND field_data_field_ht_threads.field_ht_threads_value ='" . $_GET['catname'] . "' AND file_managed.fid = field_data_field_ht_image.field_ht_image_fid AND node.status=1 AND field_data_field_ht_image.entity_id=node.nid AND field_data_field_ht_summary.entity_id = field_data_field_ht_threads.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_forum.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_threads.entity_id AND field_data_field_ht_author.entity_id=field_data_field_ht_author.entity_id group by node.nid ORDER BY node.changed DESC LIMIT $limitvalue, $limit";
}

?>



								<div class="threadsList with-thumb">
									<ul id="homepage-threadsList">
										<?php
if ($r = mysqli_query($q)) {
	$aa = 0;
	while ($d_thread = mysqli_fetch_array($r)) {
		$restofind = strstr($d_thread['field_ht_forum_url'], "http://");
		$noaddata = node_load($d_thread['nid']);

		$thread_url = $d_thread['field_ht_forum_url'];

		if (stristr($thread_url, 'http://')) {

			$thread_url = str_replace('http://', 'https://', $thread_url);
		}

		?>
								<!--onclick="return updatethreadcounter('--><?php //if($restofind=='') { echo "http://";} echo $d_thread['field_ht_forum_url'];?><!--','--><?php //echo $d_thread['nid'];?><!--');"-->
											<li class="<?=($aa > $slice) ? 'hide' : '';?>" rel="<?php echo $thread_url; ?>">
											<a title="<?php echo $d_thread['title']; ?>"  href="<?php echo $thread_url; ?>" target="_blank" ripple-background="#FF8C00" ripple-opacity="0.7" class="ripple">
												<span class="thumb" data-title="<?php echo $noaddata->title; ?>" style="background-image: url('/?q=sites/default/files/styles/check_medium_medium/public/<?php echo str_replace("public://", "", $d_thread['uri']); ?>');">
<!--													<img alt="--><?php //echo  $noaddata->title;?><!--" src="/?q=sites/default/files/styles/check_medium_medium/public/--><?php //echo str_replace("public://","",$d_thread['uri']);?><!--">-->
												</span>
												<span class="text">
													<span class="ellipsis-2-line">
														<?php echo $noaddata->title; ?>
													</span>
													</span>
											</a>
										</li><!-- thread list -->
										<?php
$aa++;
	}
} else {

	?>
										<li>

											<h5>No Thread Found</h5>

										</li><!-- thread list -->
										<?php
}
?>

									</ul>
								</div>

<!--button-->
<div class="text-center">
	<a type="button" ripple-background="#FF8C00" ripple-opacity="0.7" class="btn btn-red ripple" id="btn-loademore" data-target="#homepage-threadsList">Load more </a>
	<a href="/hot-threads/" type="button" ripple-background="#FF8C00" ripple-opacity="0.7" class="btn btn-red ripple hide">All Threads </a>
</div>
