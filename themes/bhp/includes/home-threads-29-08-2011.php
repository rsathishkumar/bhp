<?php
$q_ht="SELECT node.title,node.changed,node.created,node.nid from node where node.status=1 and node.type='hot_threads' order by node.changed desc limit 0 ,15";
$res=@mysqli_query($q_ht);
$noft=mysqli_num_rows($res);
	if($noft>0)
		{
?>
<div class="homeThreads">
	<h4 class="TLR5">Hot Threads</h4>
	<div class="threadsList BLR5">
		<ul>
			<?php
			while($d_thread=mysqli_fetch_array($res))
				{
				$furl=@mysqli_fetch_array(mysqli_query("select field_ht_forum_url from field_data_field_ht_forum where entity_id=".$d_thread['nid']));
					$nod_hot_thread=node_load($d_thread['nid']);
			?>
			<li><a href="<?php echo $furl['field_ht_forum_url'];?>" target="_blank" onclick="updatethreadcounter('<?php  echo $furl['field_ht_forum_url'];?>','<?php echo $d_thread['nid'];?>');" title="<?php echo $nod_hot_thread->title;?>"><?php echo $nod_hot_thread->title;?></a></li>
			<?php
				}
			?>
		</ul>
		<div class="marR15 clearfix">
			<a href="?q=node/10" class="fright btnRight">
				<span>More Hot Threads</span>
			</a>
		</div><!-- marR15 -->
	</div><!-- threadsList -->
</div><!-- homeThreads -->
<?php
	}
?>
