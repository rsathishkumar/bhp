<?php
include_once("connect.php");
$sql_adcar=@mysqli_fetch_array(mysqli_query("select car_img.field_advertiselasrge_image_fid,field_data_field_ext_url.field_ext_url_value,n.title,n.nid,img.uri from node as n,field_data_field_ext_url,file_managed as img,field_data_field_advertiselasrge_image as car_img where car_img.field_advertiselasrge_image_fid=img.fid and field_data_field_ext_url.entity_id=n.nid and car_img.entity_id=n.nid and n.status=1 order by MD5(RAND()) limit 0,2"));
 

	if($sql_adcar!='')
	{
	 $restofindtrav=strstr($sql_adcar['field_ext_url_value'],"http://");
	//$sql_e_url=mysqli_fetch_array(mysqli_query("select field_ext_url_value from field_data_field_ext_url where entity_id=".$sql_adcar['nid']));
?>
<div class="roundAll3 cta travelogues clearfix">
	<div class="traveloguesInner roundAll5">
		<div class="traveloguesContent">
			<!-- <h3>Travelogues</h3> -->
			<p><?php echo $sql_adcar['title'];?></p>
		</div>
		<a href="<?php echo bhp_replace_http_strings($sql_adcar['field_ext_url_value']);?>" target="_blank">
			<img class="roundAll5" src="/sites/default/files/<?php echo str_replace("public://","",$sql_adcar['uri']);?>" alt="<?php echo $sql_adcar['uri'];?>" />
		</a>
	</div>
</div><!-- Travelogues CTA -->
<?php
	}
?>
