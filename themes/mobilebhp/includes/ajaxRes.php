<?php
$city = $_REQUEST['city'];
$minPrice = $_REQUEST['minPrice'];
$maxPrice = $_REQUEST['maxPrice'];
if($_REQUEST['bs']!='')
{
$body_style = $_REQUEST['bs'];
$addBody = " and field_data_field_nr_make.entity_id=field_data_field_model_body.entity_id and ";
if(strpos($body_style, ',')>1)
	{
$b = explode(',', $body_style);
$addb = "(";
foreach($b as $val)
	{
	$addb .= " field_data_field_model_body.field_model_body_value='".$val."' or";
	}
	$addBody .= substr($addb,0, -3).")";
	}
else
	{
	$addBody .= " field_data_field_model_body.field_model_body_value='".$body_style."'";
	}
}
else
{
	$addBody = "";
}
if($_REQUEST['fuel']!='')
{
$fuel = $_REQUEST['fuel'];
$addFuel = " and field_data_field_nr_make_model.entity_id=field_data_field_engine_fuel.entity_id and ";
if(strpos($fuel, ',')>1)
	{
$f = explode(',', $fuel);
$addf = "(";
foreach($f as $val)
	{
	$addf .= " field_data_field_engine_fuel.field_engine_fuel_value='".$val."' or";
	}
	$addFuel .= substr($addf,0, -3).")";
	}
else
	{
	$addFuel .= " field_data_field_engine_fuel.field_engine_fuel_value='".$fuel."'";
	}
}
else
{
	$addFuel = "";
}
if($_REQUEST['trans']!='')
{
$trans = $_REQUEST['trans'];
$addTrans = " and field_data_field_nr_make_model.entity_id=field_data_field_engine_transmission.entity_id and ";
if(strpos($trans, ',')>1)
	{
$t = explode(',', $trans);
$addt = "(";
foreach($t as $val)
	{
	$addt .= " field_data_field_engine_transmission.field_engine_transmission_value='".$val."' or";
	}
	$addTrans .= substr($addt,0, -3).")";
	}
else
	{
	$addTrans .= " field_data_field_engine_transmission.field_engine_transmission_value='".$trans."'";
	}
}
else
{
	$addTrans = "";
}
include_once("connect.php");
if($_REQUEST['order']!='')
{
$order = " ".$_REQUEST['order'];
}
else
{
$order = " desc";
}
if($_REQUEST['orderBy']!='')
{
$orderBy = $_REQUEST['orderBy'];
}
else
{
$orderBy = "on_road_price";
}
if($order==" desc")
{
	if($orderBy=="on_road_price")
	{
	$pc = " class=\"upArrow\"";
	$mc = "";
	$Psort = "asc";
	$Msort = "asc";
	}
	else
	{
	$mc = " class=\"upArrow\"";
	$pc = "";
	$Psort = "desc";
	$Msort = "desc";
	}
}
else
{
	if($orderBy=="on_road_price")
	{
	$pc = " class=\"downArrow\"";
	$mc = "";
	$Psort = "desc";
	$Msort = "desc";
	}
	else
	{
	$mc = " class=\"downArrow\"";
	$pc = "";
	$Psort = "asc";
	$Msort = "asc";
	}
}
$model_res = @mysqli_query("select distinct(field_data_field_nr_make.entity_id) as ModelID, node.title as title from team_bhp_variant_price, field_data_field_price_nr_variant, field_data_field_variant_nr_engine, field_data_field_nr_make_model, field_data_field_engine_fuel, field_data_field_engine_transmission, field_data_field_nr_make, field_data_field_model_body, node where city='".$city."' and on_road_price>=".$minPrice." and on_road_price<=".$maxPrice." and team_bhp_variant_price.nid=field_data_field_price_nr_variant.entity_id and field_data_field_price_nr_variant.field_price_nr_variant_nid=field_data_field_variant_nr_engine.entity_id and field_data_field_variant_nr_engine.field_variant_nr_engine_nid=field_data_field_nr_make_model.entity_id".$addFuel.$addTrans." and field_data_field_nr_make_model.field_nr_make_model_nid=field_data_field_nr_make.entity_id and field_data_field_nr_make.field_nr_make_nid=node.nid".$addBody." order by ".$orderBy.$order) or die(mysql_error());
if(mysqli_num_rows($model_res)==1)
	{
		$res = "<strong>1</strong> Match";
	}
	else
	{
		$res = "<strong>".mysqli_num_rows($model_res)."</strong> Matches";
	}
echo $res;
