<?php
$sql_next_advice=@mysqli_query("select nid from node where nid > ".$node->nid." and status=1 and type='advice' and node.status=1");
$nofa=mysqli_num_rows($sql_next_advice);
?>
<div class="clearfix articleNavi">
	<a class="fleft btnLeft" href="/advice"><span>Back to Index</span></a>
	<?php
	if($nofa>0)
		{
		$adetail=mysqli_fetch_array($sql_next_advice);
	?>
	<a class="fright btnRight" href="<?php echo url("node/".$adetail['nid']);?>"><span>Next Article</span></a>
	<?php
		}
		else
		{
	$sql_prev_advice=@mysqli_query("select nid from node where nid !=".$node->nid." and status=1 and type='advice' and node.status=1 order by nid desc" );	
		if(@mysqli_num_rows($sql_prev_advice)>0)
			{
			$adetail=@mysqli_fetch_array($sql_prev_advice);
		?>
		<a class="fright btnRight" href="<?php echo url("node/".$adetail['nid']);?>"><span>Prev Article</span></a>
		<?php
			}
		}
	?>
</div>	
