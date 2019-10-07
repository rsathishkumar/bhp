<?php
include_once("connect.php");
$sql_manufacturer=mysqli_query("SELECT node.title,field_data_field_make_logo.field_make_logo_fid,file_managed.uri,field_data_field_make_url.field_make_url_url from node,file_managed,field_data_field_make_logo,field_data_field_make_url where node.nid=field_data_field_make_url.entity_id and field_data_field_make_logo.entity_id=node.nid and field_data_field_make_logo.field_make_logo_fid=file_managed.fid and node.status=1 and node.type='make' order by node.changed desc limit 0,1");
$numberofmanufacturer=mysqli_num_rows($sql_manufacturer);
	if($numberofmanufacturer>0)
		{
		$cn=1;
		$data=mysqli_fetch_array($sql_manufacturer);
?>
<div class="roundAll5 clearfix OtherSections">
	<h4>Manufacturer Website</h4>
	<div class="manfWeb">
		<a href="<?php echo $data['field_make_url_url'];?>" title="<?php echo $data['title'];?>"><?php echo $data['field_make_url_url'];?></a>
	</div>
</div><!-- most viewed -->
<?php
		}
?>

