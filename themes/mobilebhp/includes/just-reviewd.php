<?php
include_once("connect.php");
$sql_justreview=@mysqli_query("SELECT field_data_field_just_review_url.field_just_review_url_value,node.title,field_data_field_car_review_image.field_car_review_image_fid,file_managed.uri from field_data_field_just_review_url,node,field_data_field_car_review_image,file_managed where field_data_field_just_review_url.entity_id=field_data_field_car_review_image.entity_id and field_data_field_car_review_image.entity_id=node.nid and field_data_field_car_review_image.field_car_review_image_fid=file_managed.fid and node.status=1 order by node.changed desc limit 0,1");
$num=@mysqli_num_rows($sql_justreview);
if($num>0)
	{
	$data_justreview=mysqli_fetch_array($sql_justreview);
?>
<div class="roundAll3 cta justReviewed">
	<h3 class="padB10"><img src="/themes/mobilebhp/images/cta/just-reviewed/just-reviewed.png" title="" width="174"  height="20" /></h3>
	<div class="clearfix marB10 clearfix">
		<a href="<?php echo $data_justreview['field_just_review_url_value'];?>" title="<?php echo $data_justreview['title'];?>">
			<img src="/sites/default/files/<?php echo str_replace("public://","",$data_justreview['uri']);?>" alt="<?php echo $data_justreview['title'];?>"  class="png" />
			<div class="carInfo clearfix"><?php echo $data_justreview['title'];?></div>
		</a>
	</div><!-- clearfix -->
</div><!-- Just Reviewed -->
<?php
	}
?>
