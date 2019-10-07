<?php
$sql_next_ts=@mysqli_query("select nid from node where nid < ".$node->nid." and status=1 and type='tech_stuff' order by created desc");
$nofa=mysqli_num_rows($sql_next_ts);
//echo "select nid from node where nid < ".$node->nid." and status=1 and type='tech_stuff' order by created desc";
?>
<div class="clearfix articleNavi">
	<a class="fleft btnLeft" href="/tech-stuff"><span>Back to Index</span></a>
	<?php
	if($nofa>0)
		{
		$tsdetail=mysqli_fetch_array($sql_next_ts)
	?>
	<a class="fright btnRight" href="<?php echo url("node/".$tsdetail['nid']);?>"><span>Next Article</span></a>
	<?php
		}
	?>
</div>	
