<?php
$sql_relatedartcle=@mysqli_query("select node.title,node.nid,field_data_field_safety_related_articles.field_safety_related_articles_nid from node,field_data_field_safety_related_articles where field_data_field_safety_related_articles.field_safety_related_articles_nid=node.nid and field_data_field_safety_related_articles.entity_id=".$node->nid." and node.status=1");
$nofra=@mysqli_num_rows($sql_relatedartcle);
	if($nofra>0)
		{
?>
<div class="clearfix relatedNews roundAll5 marT10">
	<h3>Related Articles</h3>
	<ul class="marT10">
		<?php
		while($d_ra=mysqli_fetch_array($sql_relatedartcle))
			{
		?>
		<li>
			<a href="<?php echo url("node/".$d_ra['nid']);?>" title="<?php echo $d_ra['title'];?>">
				<?php echo $d_ra['title'];?> 
			</a>
		</li>
		<?php
			}
		?>
		
	</ul>
</div><!-- realated News -->
<?php
	}
?>
