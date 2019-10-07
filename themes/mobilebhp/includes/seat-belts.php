<?php
include_once("connect.php");
$sql_ad=mysqli_query("SELECT node.title,field_data_field_ad_url.field_ad_url_value,field_data_field_ad_image.field_ad_image_fid, file_managed.uri
FROM node, field_data_field_ad_url, field_data_field_ad_image ,file_managed
WHERE node.nid = field_data_field_ad_url.entity_id
AND field_data_field_ad_image .entity_id = node.nid
AND field_data_field_ad_image.field_ad_image_fid = file_managed.fid
AND node.status =1 order by md5(rand()) limit 0,1");
$num=@mysqli_num_rows($sql_ad);
if($num>0)
	 {
	$data_ad=mysqli_fetch_array($sql_ad);
?>
<div class="seatBelt">
<a href="<?php echo $data_ad['field_ad_url_value'];?>" title="<?php echo $data_ad['title'];?>">
	<img src="/sites/default/files/<?php echo str_replace("public://","",$data_ad['uri']);?>" alt="<?php echo $data_ad['title'];?>" class="roundAll5" />
</a>
</div>
<!-- -->
<?php
	}
?>
