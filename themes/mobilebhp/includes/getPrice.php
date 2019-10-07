<?php
include_once("connect.php");
$city = $_REQUEST['city'];
$nid = $_REQUEST['nid'];
$price = @mysql_fetch_assoc(mysqli_query("select on_road_price from field_data_field_price_nr_variant, team_bhp_variant_price where field_data_field_price_nr_variant.entity_id=team_bhp_variant_price.nid and team_bhp_variant_price.city='".$city."' and field_data_field_price_nr_variant.field_price_nr_variant_nid=".$nid));
echo $price['on_road_price'];
?>
