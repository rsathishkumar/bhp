<?php
//$sql_travel="select node.title,node.nid,field_data_field_travelog_url.field_travelog_url_value from node,field_data_field_travelog_url where node.nid=field_data_field_travelog_url.entity_id and node.status=1 order by node.changed desc limit 0,5";
$sql_travel="SELECT title, field_ht_forum_url,nid FROM node,field_data_field_ht_threads,field_data_field_ht_forum
WHERE field_data_field_ht_threads.entity_id = node.nid AND field_data_field_ht_forum.entity_id = field_data_field_ht_threads.entity_id
AND field_data_field_ht_threads.field_ht_threads_value = 'Travelogues' ORDER BY `node`.`changed` desc limit 0,5";
$res_trvel=@mysqli_query($sql_travel);
$noftravel=@mysqli_num_rows($res_trvel);
if($noftravel>0)
	{
?>
<div class="homeTra">
	<a href="http://<?php echo $_SERVER['HTTP_HOST']."/?q=hot-threads&catname=Travelogues";?>"  class="roundAll5 homeTravel clearfix">
		&nbsp;
	</a>
	<div class="fleft travels" id="trav_home"><!-- code for this click event wriiten in home-news-->
		<h4>Travelogues</h4>
		<p>Experiences, Route info & Photos posed by Team BHP members</p>
	</div>
	<ul class="travelList roundAll5">
		<?php
		while($d_travel=mysqli_fetch_array($res_trvel))
			{
			$hot_thread=node_load($d_travel['nid']);
			$pth="";
			if(strstr($d_travel['field_ht_forum_url'],"http://"))
				{
				$pth.=$d_travel['field_ht_forum_url'];
				}
				else
				{
				$pth.="http://".$d_travel['field_ht_forum_url'];
				}
					$ttle='';
						if(strlen($hot_thread->title)>30)
							{
								if(truncatestringwithspace($hot_thread->title,24)!=false)
								{
								$ttle.= truncatestringwithspace($hot_thread->title,24);
								}
								else
								{
								$ttle.= $hot_thread->title;
								}
							}
						else
							{
						$ttle.= $hot_thread->title;	
							}
		?>
		<li><a href="<?php echo $pth;?>" target="_blank" title="<?php echo $hot_thread->title;?>"><?php echo $ttle; ?></a></li>
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
