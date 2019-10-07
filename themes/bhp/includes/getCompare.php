<?php
header('Content-type: application/json');
$model = $_REQUEST['model'];
include_once("connect.php");
$sql_model=@mysqli_query("SELECT node.title as title, node.nid as nid FROM node,  field_data_field_nr_make WHERE field_data_field_nr_make.entity_id = node.nid AND node.status =1  and node.nid=".$model) or die(mysql_error());
$data_model=@mysqli_fetch_array($sql_model);
$url = @mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$data_model['nid']."'"));
$engine = '<select class="w160" onchange="changeByEngine(this, this.value, '.$model.');">';
$sql_engine = @mysqli_query("select field_nr_make_model_nid,entity_id from field_data_field_nr_make_model where field_nr_make_model_nid=".$model." and bundle='engine_type'");
			$sql_sequenceimg=@mysqli_fetch_array(mysqli_query("SELECT distinct(field_gallery_interior_alt) as alt, field_gallery_interior_title as title, field_gallery_interior_fid as fid FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model."' and field_data_field_gallery_interior.field_gallery_interior_alt!='' UNION SELECT distinct(field_gallery_exterior_alt) as alt, field_gallery_exterior_title as title, field_gallery_exterior_fid as fid FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model."' and field_data_field_gallery_exterior.field_gallery_exterior_alt!='' UNION SELECT distinct(field_gallery_engine_alt) as alt, field_gallery_engine_title as title, field_gallery_engine_fid as fid FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model."' and field_data_field_gallery_engine.field_gallery_engine_alt!='' UNION SELECT distinct(field_gallery_smaller_alt) as alt, field_gallery_smaller_title as title, field_gallery_smaller_fid as fid FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model."' and field_data_field_gallery_smaller.field_gallery_smaller_alt!='' order by alt limit 0,1"));
			if($sql_sequenceimg=='')
				{
				$sql_sequenceimgwithorder=@mysqli_fetch_array(mysqli_query("SELECT field_data_field_gallery_interior.delta as delta , field_gallery_interior_title as title, field_gallery_interior_fid as fidint FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model."' UNION SELECT field_data_field_gallery_exterior.delta as delta, field_gallery_exterior_title as title, field_gallery_exterior_fid as fidint FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model."' UNION SELECT field_data_field_gallery_engine.delta as delta, field_gallery_engine_title as title, field_gallery_engine_fid as fidint FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model."' UNION SELECT field_data_field_gallery_smaller.delta as delta, field_gallery_smaller_title as title, field_gallery_smaller_fid as fidint FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model."' order by delta limit 0,1"));
					if($sql_sequenceimgwithorder=='')
						{
						$model_imgname="sites/default/files/defaultmodel_124.gif";
						}
					else
						{
					$model_img=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$sql_sequenceimgwithorder['fidint']));
					$model_imgname="?q=sites/default/files/styles/check_medium_medium/public/".str_replace("public://","",$model_img['uri']);
						}
				}
			else
				{
				$model_img=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$sql_sequenceimg['fid']));
				$model_imgname="?q=sites/default/files/styles/check_medium_medium/public/".str_replace("public://","",$model_img['uri']);
				}
$naimgpath = "<img src='/themes/bhp/images/cross.png' />";
$e_id='';
$j = 0;
while($data_eid=@mysqli_fetch_array($sql_engine))
{
	if($j==0)
	{
		$firstEngine = $data_eid['entity_id'];
	}
	$e_id.=$data_eid['entity_id'].",";
	$j++;
}
$sql_modelengine=@mysqli_query("select nid, title from node where nid in (".substr($e_id,0,-1).") order by nid");
while($engine_title=@mysqli_fetch_array($sql_modelengine))
	{
	$engine .= '<option value="'.$engine_title['nid'].'">'.$engine_title['title'].'</option>';
	}
$engine .= '</select>';
if($_REQUEST['engine']!="")
{
	$firstEngine = $_REQUEST['engine'];
}
$res = @mysqli_query("SELECT node.nid, node.title FROM field_data_field_variant_nr_engine,node WHERE field_data_field_variant_nr_engine.entity_id=node.nid and node.status=1 and field_variant_nr_engine_nid=".$firstEngine);
$variant = '<select class="w160" onchange="changeByVariant(this, this.value, '.$model.')">';
if($_REQUEST['city']!='')
{
	$city = $_REQUEST['city'];
}
else
{
	$city = 'Delhi';
}
$p = 0;
while($fv_row=@mysql_fetch_assoc($res))
{
	if($p==0)
	{
		$firstPrice = $fv_row['nid'];
	}
	$variant .= '<option value="'.$fv_row['nid'].'">'.$fv_row['title'].'</option>';
	$p++;
}
$variant .= '</select>';
if($_REQUEST['variant']!="")
{
$firstPrice = $_REQUEST['variant'];
}
//

$qp = "select * from field_data_field_price_nr_variant, team_bhp_variant_price where field_data_field_price_nr_variant.entity_id=team_bhp_variant_price.nid and team_bhp_variant_price.city='".$city."' and field_data_field_price_nr_variant.field_price_nr_variant_nid=".$firstPrice;
$res_p = @mysqli_query($qp);
$fp_res = @mysql_fetch_assoc($res_p);
if($fp_res['ex_showroom_price']!='')
{
	$p = '<span class="WebRupee">Rs.</span> '.number_format($fp_res['ex_showroom_price']);
}
else
{
	$p = "No price available";
}

$air_q = "select field_features_air_bags_value from field_data_field_features_air_bags, field_data_field_features_nr_variant where field_data_field_features_air_bags.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;

$fq = "SELECT max(field_data_field_spec_fuel_highway.field_spec_fuel_highway_value) as maxHighway, max(field_data_field_spec_fuel_city.field_spec_fuel_city_value) as maxCity FROM field_data_field_spec_nr_engine_type, field_data_field_spec_fuel_city, field_data_field_spec_fuel_highway, field_data_field_variant_nr_engine, node WHERE field_data_field_spec_nr_engine_type.entity_id = field_data_field_spec_fuel_city.entity_id AND field_data_field_spec_fuel_highway.entity_id = field_data_field_spec_fuel_city.entity_id AND field_data_field_spec_fuel_city.entity_id = node.nid AND node.status =1 AND field_data_field_variant_nr_engine.field_variant_nr_engine_nid = field_data_field_spec_nr_engine_type.field_spec_nr_engine_type_nid AND field_data_field_spec_nr_engine_type.field_spec_nr_engine_type_nid=".$firstEngine;
$res_fq = @mysqli_query($fq);
$fq_res = @mysql_fetch_assoc($res_fq);
if($fq_res['maxHighway']!='')
{
	$maxHighway = $fq_res['maxHighway'];
}
else
{
	//$maxHighway = "N/A";
	$maxHighway = $naimgpath;
	
}
if($fq_res['maxCity']!='')
{
	$maxCity = $fq_res['maxCity'];
}
else
{
	//$maxCity = "N/A";
	$maxCity = $naimgpath;
}
$fuel = '<span class="city">City : <em class="grey">'.$maxCity.'</em></span><span class="highway">Highway : <em class="grey">'.$maxHighway.'</em></span>';

$model_liked=@mysqli_query("SELECT node.title,field_data_field_model_liked.revision_id,field_data_field_model_liked.field_model_liked_value from node,field_data_field_model_liked where field_data_field_model_liked.entity_id=node.nid and node.status=1 and node.type='model' and node.nid=".$model);
$liked = '<ul class="bulletList">';
if(@mysqli_num_rows($model_liked)>0)
{
	while($like=mysqli_fetch_array($model_liked))
	{
$liked .= '<li>'.$like['field_model_liked_value'].'</li>';
	}
}
else
{
//$liked .= '<li>N/A</li>';
$liked .= $naimgpath;

}
$liked .= '</ul>';

$model_disliked=@mysqli_query("SELECT node.title,field_data_field_model_disliked.revision_id,field_data_field_model_disliked.field_model_disliked_value from node,field_data_field_model_disliked where field_data_field_model_disliked.entity_id=node.nid and node.status=1 and node.type='model' and node.nid=".$model);
$disliked = '<ul class="bulletList">';
if(@mysqli_num_rows($model_disliked)>0)
{
	while($dislike=mysqli_fetch_array($model_disliked))
	{
$disliked .= '<li>'.$dislike['field_model_disliked_value'].'</li>';
	}
}
else
{
//$disliked .= '<li>N/A</li>';
$disliked .= $naimgpath;

}
$disliked .= '</ul>';

$uc_row = @mysql_fetch_assoc(mysqli_query("select field_model_upkeep_value from field_data_field_model_upkeep where entity_id=".$model));
if($uc_row['field_model_upkeep_value']!='')
{
$upkeepCosts = $uc_row['field_model_upkeep_value'];
}
else
{
//$upkeepCosts = 'N/A';
$upkeepCosts .= $naimgpath;
}
$upkeep = $upkeepCosts;

$or_row = @mysql_fetch_assoc(mysqli_query("select field_model_reliability_value from field_data_field_model_reliability where entity_id=".$model));
if($or_row['field_model_reliability_value']!='')
{
$overallReliability = $or_row['field_model_reliability_value'];
}
else
{
//$overallReliability = 'N/A';
$overallReliability .= $naimgpath;
}
$reliability = $overallReliability;

$service_row = @mysql_fetch_assoc(mysqli_query("select field_model_service_value from field_data_field_model_service where entity_id=".$model));
if($service_row['field_model_service_value']!='')
{
$service = $service_row['field_model_service_value'];
}
else
{
//$service = 'N/A';
$service .= $naimgpath;
}
$ser = $service;

$sw_row = @mysql_fetch_assoc(mysqli_query("select field_model_s_warranty_value from field_data_field_model_s_warranty where entity_id=".$model));
if($sw_row['field_model_s_warranty_value']!='')
{
$sWarranty = $sw_row['field_model_s_warranty_value'];
}
else
{
//$sWarranty = 'N/A';
$sWarranty .= $naimgpath;
}
$sWar = $sWarranty;

$ew_res = @mysqli_query("select field_model_e_warranty_value from field_data_field_model_e_warranty where entity_id=".$model);
if(@mysqli_num_rows($ew_res)>0)
{
	while($ew_row=mysql_fetch_assoc($ew_res))
	{
	$eWar .= '<p>'.$ew_row['field_model_e_warranty_value'].'</p>';
	}
}
else
{
	//$eWar = '<p>N/A</p>';
	$eWar .= $naimgpath;
}

$rv_res = @mysqli_query("select field_model_resale_value from field_data_field_model_resale where entity_id=".$model);
if($rv_res['field_model_resale_value']!='')
{
$rValue = $rv_res['field_model_resale_value'];
}
else
{
//$rValue = 'N/A';
$rValue = $naimgpath;
}

$slq_row = @mysql_fetch_assoc(mysqli_query("select field_spec_length_value from field_data_field_spec_length, field_data_field_spec_nr_engine_type where field_data_field_spec_length.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1"));
if($slq_row['field_spec_length_value']!='')
{
	$length = $slq_row['field_spec_length_value']." mm";
}
else
{
	//$length = 'N/A';
	$length = $naimgpath;
}

$wlq_row = @mysql_fetch_assoc(mysqli_query("select field_spec_wheel_value from field_data_field_spec_wheel, field_data_field_spec_nr_engine_type where field_data_field_spec_wheel.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1"));
if($wlq_row['field_spec_wheel_value']!='')
{
	$wheel = $wlq_row['field_spec_wheel_value']." mm";
}
else
{
	//$wheel = 'N/A';
	$wheel = $naimgpath;
}

$tlq_row = @mysql_fetch_assoc(mysqli_query("select field_spec_track_value from field_data_field_spec_track, field_data_field_spec_nr_engine_type where field_data_field_spec_track.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1"));
if($tlq_row['field_spec_track_value']!='')
{
	$track = $tlq_row['field_spec_track_value']." mm";
}
else
{
	//$track = 'N/A';
	$track = $naimgpath;
}

$klq_row = @mysql_fetch_assoc(mysqli_query("select field_spec_kerb_value, field_data_field_spec_kerb.entity_id as entity_id from field_data_field_spec_kerb, field_data_field_spec_nr_engine_type where field_data_field_spec_kerb.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1"));
if($klq_row['field_spec_kerb_value']!='')
{
	$kwieghtinfo_row =@mysql_fetch_assoc(mysqli_query("select field_kerb_info_value from field_data_field_kerb_info where entity_id =".$klq_row['entity_id']));
	if($kwieghtinfo_row['field_kerb_info_value']!="")
	{
		$kerb = $klq_row['field_spec_kerb_value']." kgs"." "."<a href='#' class='infoIcon'>&nbsp;<div class='infoBox'><span></span>".$kwieghtinfo_row['field_kerb_info_value']."</div></a>";
	}
	else
	{
		$kerb = $klq_row['field_spec_kerb_value']." kgs";
	}
}
else
{
	//$kerb = 'N/A';
	$kerb = $naimgpath;
}

$glq_row = @mysql_fetch_assoc(mysqli_query("select field_spec_ground_value,field_data_field_spec_ground.entity_id as entity_id from field_data_field_spec_ground, field_data_field_spec_nr_engine_type where field_data_field_spec_ground.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1"));
if($glq_row['field_spec_ground_value']!='')
{
	$groundinfo_row =@mysql_fetch_assoc(mysqli_query("select field_ground_info_value from field_data_field_ground_info where entity_id=".$glq_row['entity_id']));
	if($groundinfo_row['field_ground_info_value']!="")
	{
		$ground = $glq_row['field_spec_ground_value']." mm"." "."<a href='#' class='infoIcon'>&nbsp;<div class='infoBox'><span></span>".$groundinfo_row['field_ground_info_value']."</div></a>";
	}
	else
	{
		$ground = $glq_row['field_spec_ground_value']." mm";
	}
}
else
{
	//$ground = 'N/A';
	$ground = $naimgpath;
}

$rlq_row = @mysql_fetch_assoc(mysqli_query("select field_spec_radius_value from field_data_field_spec_radius, field_data_field_spec_nr_engine_type where field_data_field_spec_radius.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1"));
if($rlq_row['field_spec_radius_value']!='')
{
	$radius = $rlq_row['field_spec_radius_value']." meters";
}
else
{
	//$radius = 'N/A';
	$radius =$naimgpath; 
}

$selq_row = @mysql_fetch_assoc(mysqli_query("select field_spec_seating_value, field_data_field_spec_seating.entity_id as entity_id from field_data_field_spec_seating, field_data_field_spec_nr_engine_type where field_data_field_spec_seating.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1"));
if($selq_row['field_spec_seating_value']!='')
{
	$seatinginfo_row = @mysql_fetch_assoc(mysqli_query("select field_seating_info_value from field_data_field_seating_info where entity_id=".$selq_row['entity_id']));
	if($seatinginfo_row['field_seating_info_value']!="")
	{
		$seatCapacity = $selq_row['field_spec_seating_value']." People"." "."<a href='#' class='infoIcon'>&nbsp;<div class='infoBox'><span></span>".$seatinginfo_row['field_seating_info_value']."</div></a>";
	}
	else
	{
		$seatCapacity = $selq_row['field_spec_seating_value']." People";
	}
}
else
{
	//$seatCapacity = 'N/A';
	$seatCapacity =$naimgpath; 
}

$bootlq_row = @mysql_fetch_assoc(mysqli_query("select field_spec_boot_value from field_data_field_spec_radius, field_data_field_spec_nr_engine_type where field_data_field_spec_boot.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1"));
if($bootlq_row['field_spec_boot_value']!='')
{
	$bootCapacity = $bootlq_row['field_spec_boot_value']." Liters";
}
else
{
	//$bootCapacity = 'N/A';
	$bootCapacity =$naimgpath; 
}

$fulq_row = @mysql_fetch_assoc(mysqli_query("select field_spec_fuel_tank_value from field_data_field_spec_fuel_tank, field_data_field_spec_nr_engine_type where field_data_field_spec_fuel_tank.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1"));
if($fulq_row['field_spec_fuel_tank_value']!='')
{
	$fuelCapacity = $fulq_row['field_spec_fuel_tank_value']." Liters";
}
else
{
	//$fuelCapacity = 'N/A';
	$fuelCapacity =$naimgpath; 
}
$engine_fuel_type = @mysql_fetch_assoc(mysqli_query("select field_engine_fuel_value from field_data_field_engine_fuel where entity_id =".$firstEngine." limit 1"));
if($engine_fuel_type['field_engine_fuel_value']!='')
{
	$e_fuel_Type = $engine_fuel_type['field_engine_fuel_value'];
}
else
{
	$e_fuel_Type =$naimgpath; 
}

$etype_row = @mysql_fetch_assoc(mysqli_query("select field_spec_engine_type_value from field_data_field_spec_engine_type, field_data_field_spec_nr_engine_type where field_data_field_spec_engine_type.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1"));
if($etype_row['field_spec_engine_type_value']!='')
{
	$eType = $etype_row['field_spec_engine_type_value'];
}
else
{
	//$eType = 'N/A';
	$eType =$naimgpath; 
}


$disp_row = @mysql_fetch_assoc(mysqli_query("select field_spec_engine_displacement_value from field_data_field_spec_engine_displacement, field_data_field_spec_nr_engine_type where field_data_field_spec_engine_displacement.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1"));
if($disp_row['field_spec_engine_displacement_value']!='')
{
	$displacement = $disp_row['field_spec_engine_displacement_value']." cc";
}
else
{
	//$displacement = 'N/A';
	$displacement =$naimgpath; 
	
}

$cyln_row = @mysql_fetch_assoc(mysqli_query("select field_spec_engine_cylinders_value from field_data_field_spec_engine_cylinders, field_data_field_spec_nr_engine_type where field_data_field_spec_engine_cylinders.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1"));
if($cyln_row['field_spec_engine_cylinders_value']!='')
{
	$cylinders = $cyln_row['field_spec_engine_cylinders_value'];//." cyl";
}
else
{
	//$cylinders = 'N/A';
	$cylinders =$naimgpath; 
}

$vtrain_row = @mysql_fetch_assoc(mysqli_query("select field_spec_engine_valvetrain_value from field_data_field_spec_engine_valvetrain, field_data_field_spec_nr_engine_type where field_data_field_spec_engine_valvetrain.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1"));
if($vtrain_row['field_spec_engine_valvetrain_value']!='')
{
	$valveTrain = $vtrain_row['field_spec_engine_valvetrain_value'];
}
else
{
	//$valveTrain = 'N/A';
	$valveTrain =$naimgpath; 
}

$bore_row = @mysql_fetch_assoc(mysqli_query("select field_spec_engine_bore_value from field_data_field_spec_engine_bore, field_data_field_spec_nr_engine_type where field_data_field_spec_engine_bore.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1"));
if($bore_row['field_spec_engine_bore_value']!='')
{
	$boreStroke = $bore_row['field_spec_engine_bore_value']." mm";
}
else
{
	//$boreStroke = 'N/A';
	$boreStroke =$naimgpath; 
}

$comp_row = @mysql_fetch_assoc(mysqli_query("select field_spec_engine_comp_ratio_value from field_data_field_spec_engine_comp_ratio, field_data_field_spec_nr_engine_type where field_data_field_spec_engine_comp_ratio.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1"));
if($comp_row['field_spec_engine_comp_ratio_value']!='')
{
	$compressionRatio = $comp_row['field_spec_engine_comp_ratio_value'];
}
else
{
	//$compressionRatio = 'N/A';
	$compressionRatio =$naimgpath; 
}

$mPower_row = @mysql_fetch_assoc(mysqli_query("select field_spec_engine_power_value from field_data_field_spec_engine_power, field_data_field_spec_nr_engine_type where field_data_field_spec_engine_power.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1"));
if($mPower_row['field_spec_engine_power_value']!='')
{
	$maxPower = $mPower_row['field_spec_engine_power_value']." rpm";
}
else
{
	//$maxPower = 'N/A';
	$maxPower =$naimgpath; 
}

$mTorque_row = @mysql_fetch_assoc(mysqli_query("select field_spec_engine_torque_value from field_data_field_spec_engine_torque, field_data_field_spec_nr_engine_type where field_data_field_spec_engine_torque.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1"));
if($mTorque_row['field_spec_engine_torque_value']!='' && $mTorque_row['field_spec_engine_torque_value']!=NULL && $mTorque_row['field_spec_engine_torque_value']!=null)
{
	$maxTorque = $mTorque_row['field_spec_engine_torque_value'];
}
else
{
	//$maxTorque = 'N/A';
	$maxPower =$naimgpath; 
}

$p2w_row = @mysql_fetch_assoc(mysqli_query("select field_spec_engine_power_weight_value from field_data_field_spec_engine_power_weight, field_data_field_spec_nr_engine_type where field_data_field_spec_engine_power_weight.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1"));
if($p2w_row['field_spec_engine_power_weight_value']!='')
{
	$powerWeight = $p2w_row['field_spec_engine_power_weight_value']." BHP/tonne";
}
else
{
	//$powerWeight = 'N/A';
	$powerWeight =$naimgpath; 
}

$p2t_row = @mysql_fetch_assoc(mysqli_query("select field_spec_engine_torque_weight_value from field_data_field_spec_engine_torque_weight, field_data_field_spec_nr_engine_type where field_data_field_spec_engine_torque_weight.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1"));
if($p2t_row['field_spec_engine_torque_weight_value']!='')
{
	$torqueWeight = $p2t_row['field_spec_engine_torque_weight_value']." Nm/tonne";
}
else
{
	//$torqueWeight = 'N/A';
	$torqueWeight =$naimgpath; 
}

$p2t_row = @mysql_fetch_assoc(mysqli_query("select field_spec_engine_bhp_value from field_data_field_spec_engine_bhp, field_data_field_spec_nr_engine_type where field_data_field_spec_engine_bhp.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1"));
if($p2t_row['field_spec_engine_bhp_value']!='')
{
	$bhpLiter = $p2t_row['field_spec_engine_bhp_value']." bhp/liter";
}
else
{
	//$bhpLiter = 'N/A';
	$bhpLiter =$naimgpath; 
}

$dtrain_row = @mysql_fetch_assoc(mysqli_query("select field_spec_engine_drivetrain_value from field_data_field_spec_engine_drivetrain, field_data_field_spec_nr_engine_type where field_data_field_spec_engine_drivetrain.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1"));
if($dtrain_row['field_spec_engine_drivetrain_value']!='')
{
	$driveTrain = $dtrain_row['field_spec_engine_drivetrain_value'];
}
else
{
	//$driveTrain = 'N/A';
	$driveTrain =$naimgpath; 
}

$etrans_row = @mysql_fetch_assoc(mysqli_query("select field_spec_engine_transmission_value from field_data_field_spec_engine_transmission, field_data_field_spec_nr_engine_type where field_data_field_spec_engine_transmission.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1"));
if($etrans_row['field_spec_engine_transmission_value']!='')
{
	$eTransmission = $etrans_row['field_spec_engine_transmission_value'];
}
else
{
	//$eTransmission = 'N/A';
	$eTransmission =$naimgpath; 
}

$sInt_row = @mysql_fetch_assoc(mysqli_query("select field_spec_engine_service_value from field_data_field_spec_engine_service, field_data_field_spec_nr_engine_type where field_data_field_spec_engine_service.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1"));
if($sInt_row['field_spec_engine_service_value']!='')
{
	$serviceInterval = $sInt_row['field_spec_engine_service_value']." kms";
}
else
{
	//$serviceInterval = 'N/A';
	$serviceInterval =$naimgpath; 
}

$steer_row = @mysql_fetch_assoc(mysqli_query("select field_spec_steering_value from field_data_field_spec_steering, field_data_field_spec_nr_engine_type where field_data_field_spec_steering.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1"));
if($steer_row['field_spec_steering_value']!='')
{
	$steering = $steer_row['field_spec_steering_value'];
}
else
{
	//$steering = 'N/A';
	$steering =$naimgpath; 
}

$front_row = @mysql_fetch_assoc(mysqli_query("select field_spec_front_value from field_data_field_spec_front, field_data_field_spec_nr_engine_type where field_data_field_spec_front.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1"));
if($front_row['field_spec_front_value']!='')
{
	$fSuspension = $front_row['field_spec_front_value'];
}
else
{
	//$fSuspension = 'N/A';
	$fSuspension =$naimgpath; 
}

$rear_row = @mysql_fetch_assoc(mysqli_query("select field_spec_rear_value from field_data_field_spec_rear, field_data_field_spec_nr_engine_type where field_data_field_spec_rear.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1"));
if($rear_row['field_spec_fuel_tank_value']!='')
{
	$rSuspension = $rear_row['field_spec_fuel_tank_value'];
}
else
{
	//$rSuspension = 'N/A';
	$rSuspension =$naimgpath; 
}

$tSize_row = @mysql_fetch_assoc(mysqli_query("select field_data_field_spec_tyre.field_spec_tyre_value,field_data_field_spec_tyre.entity_id as entity_id from field_data_field_spec_tyre, field_data_field_spec_nr_engine_type where field_data_field_spec_tyre.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1"));
if($tSize_row['field_spec_tyre_value']!='')
{
	$tSizeCaption_row= @mysql_fetch_assoc(mysqli_query("select field_tyre_size_caption_value from field_data_field_tyre_size_caption where field_data_field_tyre_size_caption.entity_id=".$tSize_row['entity_id']));
	if($tSizeCaption_row['field_tyre_size_caption_value']!="")
	{
		$tyreSize = $tSize_row['field_spec_tyre_value']." "."<a href='#' class='infoIcon'>&nbsp;<div class='infoBox'><span></span>".$tSizeCaption_row['field_tyre_size_caption_value']."</div></a>";
	}
	else
	{
		$tyreSize = $tSize_row['field_spec_tyre_value'];
	}
}
else
{
	//$tyreSize = 'N/A';
	$tyreSize =$naimgpath; 
}

$breaks_row = @mysql_fetch_assoc(mysqli_query("select field_spec_brakes_value, field_data_field_spec_brakes.entity_id as entity_id from field_data_field_spec_brakes, field_data_field_spec_nr_engine_type where field_data_field_spec_brakes.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1"));
if($breaks_row['field_spec_brakes_value']!='')
{
	$brakeinfo_row = @mysql_fetch_assoc(mysqli_query("select field_brakes_info_value from field_data_field_brakes_info where entity_id=".$breaks_row['entity_id']));
	if($brakeinfo_row['field_brakes_info_value']!="")
	{
		$brakes = $breaks_row['field_spec_brakes_value']." "."<a href='#' class='infoIcon'>&nbsp;<div class='infoBox'><span></span>".$brakeinfo_row['field_brakes_info_value']."</div></a>";
	}
	else
	{
		$brakes = $breaks_row['field_spec_brakes_value'];
	}
}
else
{
	//$brakes = 'N/A';
	$brakes =$naimgpath; 
}


function getOption($val)
{
	switch($val){
		case 0:
			//$r = "<td class='aCenter'>N/A</td>";
			$r = "<td class='aCenter'><img src='/themes/bhp/images/cross.png' /></td>";
			break;
		case 1:
			$r = "<td><div class='tickMarkIcon'>&nbsp;</div></td>";
			break;
		case 2:
			$r = "<td class='aCenter'>Optional</td>";
			break;
		default:
			//$r = "<td class='aCenter'>N/A</td>";
			$r = "<td class='aCenter'><img src='/themes/bhp/images/cross.png' /></td>";
			break;								
	}
	return($r);
}
$air_q_row = @mysql_fetch_assoc(mysqli_query("select field_data_field_features_air_bags.field_features_air_bags_value,field_data_field_features_nr_variant.entity_id from field_data_field_features_air_bags, field_data_field_features_nr_variant where field_data_field_features_air_bags.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$air_q = getOption($air_q_row['field_features_air_bags_value']);
$fid=$air_q_row['entity_id'];
$sql_sfty=@mysqli_query("select * from team_bhp_features where nid=".$fid." and category='Safety'");
if(@mysqli_num_rows($sql_sfty)>0)
	{
	$safetyarr = array();
	while($d_safety=mysqli_fetch_array($sql_sfty))
		{
		if (!isset($safetyarr[$d_safety['feature_name']])) {
				$safetyarr[str_replace(" ", "_", $d_safety['feature_name'])] = getOption($d_safety['feature_option']);
			} else {
				$safetyarr[str_replace(" ", "_", $d_safety['feature_name'])] += getOption($d_safety['feature_option']);
			}
		/*$arra_sfty.=$d_safety['feature_name']."=>".getOption($d_safety['feature_option']).",";
		$datearr[] = array($newdate,$d_safety['feature_name'],getOption($d_safety['feature_option'])); */
		}
		//$actual_sfty_ar=array("Safety"=>$arra_sfty);
	}
	//print_r($datearr);
$sql_d_enhance=@mysqli_query("select * from team_bhp_features where nid=".$fid." and category='Driver Enhancements'");
if(@mysqli_num_rows($sql_d_enhance)>0)
	{
	$enhancearr = array();
	while($d_enhance=mysqli_fetch_array($sql_d_enhance))
		{
			if (!isset($enhancearr[$d_enhance['feature_name']])) {
				$enhancearr[str_replace(" ", "_", $d_enhance['feature_name'])] = getOption($d_enhance['feature_option']);
			} else {
				$enhancearr[str_replace(" ", "_", $d_enhance['feature_name'])] += getOption($d_enhance['feature_option']);
			}
		//$arra_enhance.=$d_enhance['feature_name']."=>".getOption($d_enhance['feature_option']).",";
		
		}
		//$actual_enhance_ar=array("Driver Enhancements"=>$arra_enhance);
	}


	
$sql_Convenience=@mysqli_query("select * from team_bhp_features where nid=".$fid." and category='Convenience'");
if(@mysqli_num_rows($sql_Convenience)>0)
	{
	$conarr = array();
	while($d_Convenience=mysqli_fetch_array($sql_Convenience))
		{
		if (!isset($conarr[$d_Convenience['feature_name']])) {
				$conarr[str_replace(" ", "_", $d_Convenience['feature_name'])] = getOption($d_Convenience['feature_option']);
			} else {
				$conarr[str_replace(" ", "_", $d_Convenience['feature_name'])] += getOption($d_Convenience['feature_option']);
			}
		//$arra_Convenience.=$d_Convenience['feature_name']."=>".getOption($d_Convenience['feature_option']).",";
		}
		//$actual_Convenience_ar=array("Convenience"=>$arra_Convenience);
	}	

$sql_ent=@mysqli_query("select * from team_bhp_features where nid=".$fid." and category='Entertainment'");
if(@mysqli_num_rows($sql_ent)>0)
	{
	$entarr = array();
	while($d_ent=mysqli_fetch_array($sql_ent))
		{
		if (!isset($entarr[$d_ent['feature_name']])) {
				$entarr[str_replace(" ", "_", $d_ent['feature_name'])] = getOption($d_ent['feature_option']);
			} else {
				$entarr[str_replace(" ", "_", $d_ent['feature_name'])] += getOption($d_ent['feature_option']);
			}
		//$arra_ent.=$d_ent['feature_name']."=>".getOption($d_ent['feature_option']).",";
		}
		//$actual_ent_ar=array("Entertainment"=>$arra_ent);
	}	

$abs_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_abs_value from ield_data_field_features_abs, field_data_field_features_nr_variant where ield_data_field_features_abs.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$abs_q = getOption($abs_q_row['field_features_abs_value']);

$traction_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_traction_value from field_data_field_features_traction, field_data_field_features_nr_variant where field_data_field_features_traction.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$traction_q = getOption($traction_q_row['field_features_traction_value']);

$esc_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_esc_value from field_data_field_features_esc, field_data_field_features_nr_variant where field_data_field_features_esc.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$esc_q = getOption($esc_q_row['field_features_esc_value']);

$fog_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_fog_value from field_data_field_features_fog, field_data_field_features_nr_variant where field_data_field_features_fog.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$fog_q = getOption($fog_q_row['field_features_fog_value']);


$rear_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_wipe_value from field_data_field_features_wipe, field_data_field_features_nr_variant where field_data_field_features_wipe.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$rear_q = getOption($rear_q_row['field_features_wipe_value']);

$engine_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_immobiliser_value from field_data_field_features_immobiliser, field_data_field_features_nr_variant where field_data_field_features_immobiliser.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$engine_q = getOption($engine_q_row['field_features_immobiliser_value']);

$alloy_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_alloy_value from field_data_field_features_alloy, field_data_field_features_nr_variant where field_data_field_features_alloy.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$alloy_q = getOption($alloy_q_row['field_features_alloy_value']);

$psteer_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_power_steering_value from field_data_field_features_power_steering, field_data_field_features_nr_variant where field_data_field_features_power_steering.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$psteer_q = getOption($psteer_q_row['field_features_power_steering_value']);

$tilt_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_steering_tilt_value from field_data_field_features_steering_tilt, field_data_field_features_nr_variant where field_data_field_features_steering_tilt.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$tilt_q = getOption($tilt_q_row['field_features_steering_tilt_value']);

$st_reach_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_steering_reach_value from field_data_field_features_steering_reach, field_data_field_features_nr_variant where field_data_field_features_steering_reach.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$st_reach_q = getOption($st_reach_q_row['field_features_steering_reach_value']);

$fHeight_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_height_value from field_data_field_features_height, field_data_field_features_nr_variant where field_data_field_features_height.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$fHeight_q = getOption($fHeight_q_row['field_features_height_value']);

$lumbar_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_lumbar_value from field_data_field_features_lumbar, field_data_field_features_nr_variant where field_data_field_features_lumbar.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$lumbar_q = getOption($lumbar_q_row['field_features_lumbar_value']);

$dead_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_dead_pedal_value from field_data_field_features_dead_pedal, field_data_field_features_nr_variant where field_data_field_features_dead_pedal.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$dead_q = getOption($dead_q_row['field_features_dead_pedal_value']);

$arm_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_armrest_value from field_data_field_features_armrest, field_data_field_features_nr_variant where field_data_field_features_armrest.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$arm_q = getOption($arm_q_row['field_features_armrest_value']);

$mirror_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_mirrors_value from field_data_field_features_mirrors, field_data_field_features_nr_variant where field_data_field_features_mirrors.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$mirror_q = getOption($mirror_q_row['field_features_mirrors_value']);

$infoDisplay_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_info_display_value from field_data_field_features_info_display, field_data_field_features_nr_variant where field_data_field_features_info_display.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$infoDisplay_q = getOption($infoDisplay_q_row['field_features_info_display_value']);

$sensors_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_sensors_value from field_data_field_features_sensors, field_data_field_features_nr_variant where field_data_field_features_sensors.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$sensors_q = getOption($sensors_q_row['field_features_sensors_value']);

$gear_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_gear_box_value from field_data_field_features_gear_box, field_data_field_features_nr_variant where field_data_field_features_gear_box.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$gear_q = getOption($gear_q_row['field_features_gear_box_value']);

$remote_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_remote_value from field_data_field_features_remote, field_data_field_features_nr_variant where field_data_field_features_remote.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$remote_q = getOption($remote_q_row['field_features_remote_value']);

$central_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_central_value from field_data_field_features_central, field_data_field_features_nr_variant where field_data_field_features_central.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$central_q = getOption($central_q_row['field_features_central_value']);

$window_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_window_value from field_data_field_features_window, field_data_field_features_nr_variant where field_data_field_features_window.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$window_q = getOption($window_q_row['field_features_window_value']);

$airC_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_air_conditioner_value from field_data_field_features_air_conditioner, field_data_field_features_nr_variant where field_data_field_features_air_conditioner.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$airC_q = getOption($airC_q_row['field_features_air_conditioner_value']);

$climate_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_climate_value from field_data_field_features_climate, field_data_field_features_nr_variant where field_data_field_features_climate.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$climate_q = getOption($climate_q_row['field_features_climate_value']);

$vents_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_vents_value from field_data_field_features_vents, field_data_field_features_nr_variant where field_data_field_features_vents.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$vents_q = getOption($vents_q_row['field_features_vents_value']);

$seats_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_seats_value from field_data_field_features_seats, field_data_field_features_nr_variant where field_data_field_features_seats.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$seats_q = getOption($seats_q_row['field_features_seats_value']);

$sunRoof_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_sun_roof_value from field_data_field_features_sun_roof, field_data_field_features_nr_variant where field_data_field_features_sun_roof.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$sunRoof_q = getOption($sunRoof_q_row['field_features_sun_roof_value']);

$fold_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_fold_value from field_data_field_features_fold, field_data_field_features_nr_variant where field_data_field_features_fold.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$fold_q = getOption($fold_q_row['field_features_fold_value']);

$split_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_split_value from field_data_field_features_split, field_data_field_features_nr_variant where field_data_field_features_split.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$split_q = getOption($split_q_row['field_features_split_value']);

$speakers_q_row = @mysql_fetch_assoc(mysqli_query("select field_number_of_speakers_value from field_data_field_number_of_speakers, field_data_field_features_nr_variant where field_data_field_number_of_speakers.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
if($speakers_q_row['field_number_of_speakers_value']!='')
	{
		$speakers_q = "<td class='aCenter'>".$speakers_q_row['field_number_of_speakers_value']."</td>";
	}
else
	{
		//$speakers_q = "<td class='aCenter'>N/A</td>";
		$speakers_q = "<td class='aCenter'>".$naimgpath."</td>";
		
	}

$cd_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_cd_value from field_data_field_features_cd, field_data_field_features_nr_variant where field_data_field_features_cd.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$cd_q = getOption($cd_q_row['field_features_cd_value']);

$aux_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_aux_value from field_data_field_features_aux, field_data_field_features_nr_variant where field_data_field_features_aux.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$aux_q = getOption($aux_q_row['field_features_aux_value']);

$usb_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_usb_value from field_data_field_features_usb, field_data_field_features_nr_variant where field_data_field_features_usb.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$usb_q = getOption($usb_q_row['field_features_usb_value']);

$bTooth_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_bluetooth_value from field_data_field_features_bluetooth, field_data_field_features_nr_variant where field_data_field_features_bluetooth.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$bTooth_q = getOption($bTooth_q_row['field_features_bluetooth_value']);

$steeMoun_q_row = @mysql_fetch_assoc(mysqli_query("select field_features_steering_value from field_data_field_features_steering, field_data_field_features_nr_variant where field_data_field_features_steering.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice));
$steeMoun_q = getOption($steeMoun_q_row['field_features_steering_value']);

$data = array('title'=>$data_model['title'], 'nid'=>$data_model['nid'],'uri'=>$model_imgname,'url'=>$url['alias'], 'engine'=>$engine, 'variant'=>$variant, 'price'=>$p, 'fuel'=>$fuel, 'liked'=>$liked, 'dislike'=>$disliked, 'upkeep'=>$upkeep, 'reliability'=>$reliability, 'ser'=>$ser, 'sWar'=>$sWar, 'eWar'=>$eWar, 'resale'=>$rValue, 'length'=>$length, 'wheel'=>$wheel, 'track'=>$track, 'kerb'=>$kerb, 'ground'=>$ground, 'radius'=>$radius, 'seatCapacity'=>$seatCapacity, 'bootCapacity'=>$bootCapacity, 'fuelCapacity'=>$fuelCapacity,'eType'=>$eType, 'e_fuel_Type'=>$e_fuel_Type, 'displacement'=>$displacement, 'cylinders'=>$cylinders, 'valveTrain'=>$valveTrain, 'boreStroke'=>$boreStroke, 'compressionRatio'=>$compressionRatio, 'maxPower'=>$maxPower, 'maxTorque'=>$maxTorque, 'powerWeight'=>$powerWeight, 'torqueWeight'=>$torqueWeight, 'bhpLiter'=>$bhpLiter, 'driveTrain'=>$driveTrain, 'eTransmission'=>$eTransmission, 'serviceInterval'=>$serviceInterval, 'steering'=>$steering, 'fSuspension'=>$fSuspension, 'rSuspension'=>$rSuspension, 'tyreSize'=>$tyreSize, 'brakes'=>$brakes, 'air_q'=>$air_q, 'abs_q'=>$abs_q, 'traction_q'=>$traction_q, 'esc_q'=>$esc_q, 'fog_q'=>$fog_q, 'rear_q'=>$rear_q, 'engine_q'=>$engine_q, 'alloy_q'=>$alloy_q, 'psteer_q'=>$psteer_q, 'tilt_q'=>$tilt_q, 'st_reach_q'=>$st_reach_q, 'fHeight_q'=>$fHeight_q, 'lumbar_q'=>$lumbar_q, 'dead_q'=>$dead_q, 'arm_q'=>$arm_q, 'mirror_q'=>$mirror_q, 'infoDisplay_q'=>$infoDisplay_q, 'sensors_q'=>$sensors_q, 'gear_q'=>$gear_q, 'remote_q'=>$remote_q, 'central_q'=>$central_q, 'window_q'=>$window_q, 'airC_q'=>$airC_q, 'climate_q'=>$climate_q, 'vents_q'=>$vents_q, 'seats_q'=>$seats_q, 'sunRoof_q'=>$sunRoof_q, 'fold_q'=>$fold_q, 'split_q'=>$split_q, 'speakers_q'=>$speakers_q, 'cd_q'=>$cd_q, 'aux_q'=>$aux_q, 'usb_q'=>$usb_q, 'bTooth_q'=>$bTooth_q, 'steeMoun_q'=>$steeMoun_q, 'Safety'=>array($safetyarr), 'Enhancement'=>array($enhancearr), 'Convinience'=>array($conarr), 'Entertainment'=>array($entarr));

	function array_push_array(&$arr)
	{
		$args = func_get_args();
		array_shift($args);
	
		if (!is_array($arr)) {
			trigger_error(sprintf("%s: Cannot perform push on something that isn't an array!", __FUNCTION__), E_USER_WARNING);
			return false;
		}
	
		foreach($args as $v) {
			if (is_array($v)) {
				if (count($v) > 0) {
					array_unshift($v, &$arr);
					call_user_func_array('array_push',  $v);
				}
			} else {
				$arr[] = $v;
			}
		}
		//return count($arr);
		return $arr;
	}
//$arfa = array("name" => "arfa", "age" => "26", "skills" => array("web" => "php", "system" => "windows xp", "db" => "mysql", "company" => "paperplane solutions"));
echo json_encode($data);
?>
