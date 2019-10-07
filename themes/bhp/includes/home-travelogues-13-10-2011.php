<?php
$sql_travel="select node.title,node.nid,field_data_field_travelog_url.field_travelog_url_value from node,field_data_field_travelog_url where node.nid=field_data_field_travelog_url.entity_id and node.status=1 order by node.changed desc limit 0,5";
$res_trvel=@mysqli_query($sql_travel);
$noftravel=@mysqli_num_rows($res_trvel);
if($noftravel>0)
	{
?>
<div class="homeTra">
	<a href="http://www.team-bhp.com/forum/travelogues/" target="_blank" class="roundAll5 homeTravel clearfix">
		&nbsp;
	</a>
	<div class="fleft travels">
		<h4>Travelogues</h4>
		<p>Experiences, Route info & Photos posed by Team BHP members</p>
	</div>
	<ul class="travelList roundAll5">
		<?php
		while($d_travel=mysqli_fetch_array($res_trvel))
			{
			$hot_thread=node_load($d_travel['nid']);
			$pth="";
			if(strstr($d_travel['field_travelog_url_value'],"http://"))
				{
				$pth.=$d_travel['field_travelog_url_value'];
				}
				else
				{
				$pth.="http://".$d_travel['field_travelog_url_value'];
				}
		?>
		<li><a href="<?php echo $pth;?>" target="_blank" title="<?php echo $hot_thread->title;?>"><?php echo $hot_thread->title; ?></a></li>
		<?php
			}
		?>
		<!--  <li><a href="#">Road trip to Ladakh</a></li>
		<li><a href="#">Strange sightings on the road</a></li>
		<li><a href="#">Route query: Delhi to Rajasthan</a></li>
		<li><a href="#">Bike trip: Mumbai to Goa</a></li>-->
	</ul>
</div>
<?php
	}
?>
