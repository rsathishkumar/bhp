<?php
//print_r($node->field_news_tags);
$sql_qry=@mysqli_query("select field_data_field_news_tags.field_news_tags_tid,taxonomy_term_data.name from field_data_field_news_tags,taxonomy_term_data where field_data_field_news_tags.entity_id=".$node->nid." and taxonomy_term_data.tid=field_data_field_news_tags.field_news_tags_tid");

$nofcat=@mysqli_num_rows($sql_qry);
$tid='';
	if($nofcat>0)
		{
?>
 <ul class="tag clearfix marB10">
	<li class="fleft tagLi w40">Tags:</li>
	<?php
	while($d_news=mysqli_fetch_array($sql_qry))
		{
		$tid.=$d_news['field_news_tags_tid'].",";
	?>
	<!--<li><a href="#" title="<?php echo $d_news['name']?>"><?php echo $d_news['name']?></a></li>-->
	<li><?php echo $d_news['name']?></li>
	<?php
		}
	?>
</ul>
<?php
		}
?>
