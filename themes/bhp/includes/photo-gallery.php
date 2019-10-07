<?php
include_once("connect.php");
$sql_ad_photo=mysqli_query("SELECT node.title, field_data_field_ad_photo_url.field_ad_photo_url_value, field_data_field_ad_photo_image.field_ad_photo_image_fid, file_managed.uri
FROM node, field_data_field_ad_photo_url, field_data_field_ad_photo_image, file_managed
WHERE node.nid = field_data_field_ad_photo_url.entity_id
AND field_data_field_ad_photo_image.entity_id = node.nid
AND field_data_field_ad_photo_image.field_ad_photo_image_fid = file_managed.fid
AND node.status =1 ORDER BY MD5( RAND( ) )  LIMIT 0 , 1");
$num_ad_photo=@mysqli_num_rows($sql_ad_photo);
if($num_ad_photo>0)
 {
	$data_ad_photo=mysqli_fetch_array($sql_ad_photo);
?>
<div class="">
		<a href="<?php echo $data_ad_photo['field_ad_photo_url_value'];?>" title="<?php echo $data_ad_photo['title'];?>">
				<img src="/sites/default/files/<?php echo str_replace("public://","",$data_ad_photo['uri']);?>" class="roundAll3"  alt="<?php echo $data_ad_photo['title'];?>" />
			</a>
	
</div><!-- Just Reviewed -->
<?php
 }
?>
