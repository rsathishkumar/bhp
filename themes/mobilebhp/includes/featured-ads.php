<?php
include_once("connect.php");
$sql_preowned=@mysqli_query("SELECT field_data_field_pre_owned_image.field_pre_owned_image_fid, node.title, file_managed.uri, field_data_field_pre_owned_url.field_pre_owned_url_value
FROM field_data_field_pre_owned_image, node, file_managed, field_data_field_pre_owned_url WHERE field_data_field_pre_owned_image.entity_id = node.nid
AND field_data_field_pre_owned_url.entity_id = node.nid
AND file_managed.fid = field_data_field_pre_owned_image.field_pre_owned_image_fid order by MD5(RAND()) limit 2");
$num=@mysqli_num_rows($sql_preowned);
if($num>0)
	{
?>
<div class="roundAll3 cta featured-ads">
	<h3 class="padB10"><img src="/themes/mobilebhp/images/cta/featured-ads/pre-owned-cars.png" alt="Feature Ads" width="198"  height="21" /></h3>
	<?php
	while($data_preowned=mysqli_fetch_array($sql_preowned))
		{
	?>
	<div class="clearfix marB10">
		<div class="fleft imgBox">
			<a href="<?php echo $data_preowned['field_pre_owned_url_value'];?>" target="_blank" title="<?php echo $data_preowned['title'];?>">
				<img src="/sites/default/files/<?php echo str_replace("public://","",$data_preowned['uri']);?>" alt="<?php echo $data_preowned['title'];?>" />
			</a>
		</div><!-- w110 -->
		
		<div class="fleft imgDesc">
			<a href="<?php echo $data_preowned['field_pre_owned_url_value'];?>" target="_blank" title="<?php echo $data_preowned['title'];?>"><h4><?php echo $data_preowned['title'];?></h4></a>
			<p><a href="<?php echo $data_preowned['field_pre_owned_url_value'];?>" target="_blank" title="See All Ads">See All Ads</a></p>
		</div><!-- w90 -->
	</div><!-- clearfix -->
	
	<?php
		}
	?>
</div><!-- featured-ads -->
<?php
	}
?>
