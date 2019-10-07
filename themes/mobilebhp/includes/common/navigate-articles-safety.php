<?php
$sql_next_safety=@mysqli_query("select nid from node where nid < ".$node->nid." and status=1 and type='safety' order by created desc");
$nofa=mysqli_num_rows($sql_next_safety);
?>
<div class="clearfix articleNavi">
	<a class="fleft btnLeft" href="/safety"><span>Back to Index</span></a>
	<?php
	if($nofa>0)
		{
		$sdetail=mysqli_fetch_array($sql_next_safety)
	?>
	<a class="fright btnRight" href="<?php echo url("node/".$sdetail['nid']);?>"><span>Next Article</span></a>
	<?php
		}
	?>
</div>	
