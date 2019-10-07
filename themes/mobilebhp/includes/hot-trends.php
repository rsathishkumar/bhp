<?php
include_once("connect.php");
$sql_hthreads=mysqli_query("select node.title,node.nid from node where type='hot_threads' order by node.changed desc limit 0,5");
$numberofhthreads=mysqli_num_rows($sql_hthreads);
	if($numberofhthreads>0)
		{
		$cn=1;
?>
<div class="clearfix hotTrends roundAll5">
	<h3 class="padL10">Hot Threads</h3>
	<ul>
	<?php
		while($d_hthreads=@mysqli_fetch_array($sql_hthreads))
			{
			$furl=@mysqli_fetch_array(mysqli_query("select field_ht_forum_url from field_data_field_ht_forum where entity_id=".$d_hthreads['nid']));
			$nod_hot_thread=node_load($d_hthreads['nid']);
			$cn++;
				$sql_url_alias=@mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$d_hthreads['nid']."'"));
	?>
		<li<?php if($cn>$numberofhthreads){?> class="last"<?php }?>><a href="<?php echo $furl['field_ht_forum_url'];?>" target="_blank" title="<?php echo $nod_hot_thread->title;?>"><?php echo $nod_hot_thread->title;?></a></li>
	<?php
			}
	?>
	</ul>
	<div class="clearfix fright marT10">
		<a href="/hot-threads" class="buttonSmall" title=""><span>View All</span></a>
	</div>
</div><!-- clearfix -->
<?php
	  }
?>
