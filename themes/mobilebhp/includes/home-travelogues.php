<?php
$sql_bnner = @mysqli_fetch_array(mysqli_query("select title,uri from node,field_data_field_travelogue_banner_img,file_managed where field_data_field_travelogue_banner_img.entity_id = node.nid and file_managed.fid = field_data_field_travelogue_banner_img.field_travelogue_banner_img_fid and node.status=1 and node.type='travelogues_home_banner' order by md5(rand()) limit 0,5"));
$sql_travel = "SELECT title, field_ht_forum_url,nid FROM node,field_data_field_ht_threads,field_data_field_ht_forum
WHERE field_data_field_ht_threads.entity_id = node.nid AND field_data_field_ht_forum.entity_id = field_data_field_ht_threads.entity_id
AND field_data_field_ht_threads.field_ht_threads_value = 'Travelogues' ORDER BY `node`.`changed` desc limit 0,5";
$res_trvel = @mysqli_query($sql_travel);
$noftravel = @mysqli_num_rows($res_trvel);
if ($noftravel > 0) {
	?>
	<section class="home-travels">
		<div class="container-fluid">

<!--			<a href="/?q=hot-threads&catname=Travelogues" class="roundAll5 homeTravel clearfix">-->
			<?php
$trbannerimage = "";
	$trbannerimagetitle = "";
	if ($sql_bnner != '') {
		$trbannerimage = "/sites/default/files/" . str_replace("public://", "", $sql_bnner['uri']);
		$trbannerimagetitle = $sql_bnner['title'];
	} else {
		$trbannerimage = "/themes/mobilebhp/images/home/travelBg.jpg";

	}
	?>
<!--			<img src="--><?php //echo $trbannerimage;?><!--" alt="--><?php //echo $trbannerimagetitle;?><!--" />-->
<!--			</a>-->


			<div class="travel-img has-caption-grd" style="background-image: url('<?php echo $trbannerimage; ?>')">

				<img src="<?php print base_path() . path_to_theme()?>/images/travelogues.png" alt="" title="" class="travelogues">
<!--				<div class="text">Discover Experiences, Routes &amp; Photos</div>-->
				<span class="caption"></span>
			</div>

			<div class="travel-list">

				<ul>
					<?php
while ($d_travel = mysqli_fetch_array($res_trvel)) {
		$hot_thread = node_load($d_travel['nid']);
		$pth = "";

		$travelogue_url = str_replace('http://', 'https://', $d_travel['field_ht_forum_url']);

		if (strstr($d_travel['field_ht_forum_url'], "http://")) {
			$pth .= $d_travel['field_ht_forum_url'];
		} else {
			$pth .= "http://" . $d_travel['field_ht_forum_url'];
		}
		$ttle = '';
		if (strlen($hot_thread->title) > 30) {
			if (truncatestringwithspace($hot_thread->title, 24) != false) {
				$ttle .= truncatestringwithspace($hot_thread->title, 24);
			} else {
				$ttle .= $hot_thread->title;
			}
		} else {
			$ttle .= $hot_thread->title;
		}
		?>
						<li>
							<a href="<?php echo $travelogue_url; ?>" title="<?php echo $hot_thread->title; ?>"><?php echo $ttle; ?></a>
						</li>
					<?php
}
	?>
					<!--  <li><a href="#">Road trip to Ladakh</a></li>
                    <li><a href="#">Strange sightings on the road</a></li>
                    <li><a href="#">Route query: Delhi to Rajasthan</a></li>
                    <li><a href="#">Bike trip: Mumbai to Goa</a></li>-->
				</ul>
			</div>


			<div class="text-center btn-adjust">
				<a href="/?q=hot-threads&catname=Travelogues&m" ripple-background="radial-gradient(red, yellow)" ripple-opacity="0.7" class="btn btn-red ripple">More Travelogues</a>
			</div>
		</div>
	</section>
<?php
}
?>
