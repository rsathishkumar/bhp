<?php
include_once("connect.php");
$sql_resad=mysqli_query("SELECT node.title, field_data_field_advertise_url.field_advertise_url_value, field_data_field_advertise_image.field_advertise_image_fid, file_managed.uri
FROM node, field_data_field_advertise_url, field_data_field_advertise_image, file_managed WHERE node.nid = field_data_field_advertise_url.entity_id AND field_data_field_advertise_image.entity_id = node.nid AND field_data_field_advertise_image.field_advertise_image_fid = file_managed.fid AND node.status =1 order by rand() limit 0,1");
$num=@mysqli_num_rows($sql_resad);
if($num>0)
	{
	$data_ad=mysqli_fetch_array($sql_resad);
?>
<!--  <div class="roundAll5 roadSafety marB10">-->
<div class="roundAll5 marB10">
	<a href="<?php echo $data_ad['field_advertise_url_value'];?>"><img src="/sites/default/files/<?php echo str_replace("public://","",$data_ad['uri']);?>" height="289" width="235"> </a>
</div><!-- road Safety -->
<?php
	}
?>
