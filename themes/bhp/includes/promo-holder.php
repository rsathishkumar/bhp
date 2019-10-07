<?php
//include_once("../connect.php");
$sql_prom_car=@mysqli_fetch_array(mysqli_query("select car_img.field_car_image_fid,n.title,img.uri from node as n,file_managed as img,field_data_field_car_image as car_img where car_img.field_car_image_fid=img.fid and car_img.entity_id=n.nid and n.status=1 order by MD5(RAND()) limit 5"));
?>
<div class="promoHolder">
		<img src="/sites/default/files/<?php echo str_replace("public://","",$sql_prom_car['uri']);?>" alt="<?php echo $sql_prom_car['title'];?>"  />
</div>
