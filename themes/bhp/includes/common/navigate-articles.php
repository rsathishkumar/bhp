<?php
	if($_REQUEST['tab']=='')
	{
//$sql_next_advice=@mysqli_query("select nid from node where nid < ".$node->nid." and status=1 and type='advice' and node.status=1");
$sql_next_advice=@mysqli_query("SELECT nid FROM node, field_data_field_advice_categories WHERE nid < '".$node->nid."' AND  field_data_field_advice_categories.entity_id=node.nid AND  field_data_field_advice_categories.field_advice_categories_value = '".$node->field_advice_categories['und'][0]['value']."' AND STATUS =1 AND TYPE =  'advice' AND node.status =1 order by nid desc");
	}
	else
	{
//$sql_next_advice=@mysqli_query("select nid from node where nid < ".$node->nid." and status=1 and type='advice' and node.status=1");
$sql_next_advice=@mysqli_query("select nid from node where nid < ".$node->nid." and status=1 and type='advice' and node.status=1 order by nid desc");
	}
$nofa=mysqli_num_rows($sql_next_advice);
?>
<div class="clearfix articleNavi">
	<a class="fleft btnLeft" href="/advice"><span>Back to Index</span></a>
	<?php
	if($nofa>0)
		{
		$adetail=mysqli_fetch_array($sql_next_advice);
		if($_REQUEST['tab']=='')
			{
		$url_als=url("node/".$adetail['nid']);	
			}
			else
			{
		$url_als1=mysqli_fetch_array(mysqli_query("select alias from url_alias where source = 'node/".$adetail['nid']."'"));
		$url_als="/?q=".$url_als1['alias']."&tab=1";
			}
	?>
	<a class="fright btnRight" href="<?php echo $url_als;?>"><span>Next Article</span></a>
	<?php
		}
		/*else
		{
		$sql_prev_advice=@mysqli_query("select nid from node where nid !=".$node->nid." and status=1 and type='advice' and node.status=1 order by nid desc" );	
		if(@mysqli_num_rows($sql_prev_advice)>0)
			{
			$adetail=@mysqli_fetch_array($sql_prev_advice);*/
		?>
		<!-- <a class="fright btnRight" href="<?php echo url("node/".$adetail['nid']);?>"><span>Prev Article</span></a> -->
		<?php
			/*}
		}*/
	?>
</div>	
