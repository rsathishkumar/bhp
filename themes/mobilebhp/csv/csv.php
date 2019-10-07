<?php
/********************************/
/* Code at http://legend.ws/blog/tips-tricks/csv-php-mysql-import/
/* Edit the entries below to reflect the appropriate values
/********************************/
/* $databasehost = "localhost";
$databasename = "test";
$databaseusername ="test"; */
$databasehost = "172.16.110.34";
$databasename = "teambhp_site";
$databasepassword = "eE0K6F}72Zt*";
$databaseusername ="teambhp_site"; 
$fieldseparator = ",";
$lineseparator = "\n";
//$csvfile = "user.csv";
/********************************/
/* Would you like to add an ampty field at the beginning of these records?
/* This is useful if you have a table with the first field being an auto_increment integer
/* and the csv file does not have such as empty field before the records.
/* Set 1 for yes and 0 for no. ATTENTION: don't set to 1 if you are not sure.
/* This can dump data in the wrong fields if this extra field does not exist in the table
/********************************/
$addauto = 0;
/********************************/
/* Would you like to save the mysql queries in a file? If yes set $save to 1.
/* Permission on the file should be set to 777. Either upload a sample file through ftp and
/* change the permissions, or execute at the prompt: touch output.sql && chmod 777 output.sql
/********************************/
$save = 0;
$outputfile = "output.sql";
/********************************/

$con = @mysql_connect($databasehost,$databaseusername,$databasepassword) or die(mysql_error());
@mysql_select_db($databasename) or die(mysql_error());

foreach (glob("themes/mobilebhp/csv/*.csv") as $csvfile) 
{
	$file = fopen($csvfile,"r");
	$size = filesize($csvfile);
	
	if(!$size) 
	{
		echo "File is empty.\n";
		//exit;
	}
	else
	{
		$csvcontent = fread($file,$size);
	
		fclose($file);
	
		$lines = 0;
		$queries = "";
		$linearray = array();
		$startNow = 0;
		//echo "Total \n: ".$csvcontent." ".substr_count($csvcontent, $lineseparator)."<br />";
		$linesArrays = explode($lineseparator,$csvcontent);
		foreach($linesArrays as $line) {
	
			$lines++;
			$startNow++;
			$line = trim($line," \t");
			$line = str_replace("\r","",$line);
			if($startNow>2)
			{
				/************************************
				This line escapes the special character. remove it if entries are already escaped in the csv file
				************************************/
				$line = str_replace("'","\'",$line);
				/*************************************/
				$linearray = explode($fieldseparator,$line);
				//print_r($linearray);
				$linemysql = implode("','",$linearray);
				$c = 0;
				$engine_type = '';
				$title = '';
				$make = '';
				$model = '';
				$city = '';
				$highway = '';
				$api_rating = '';
				$steering_type = '';
				$front_suspension = '';
				$rear_suspension = '';
				$tye_size = '';
				$brake_front_rear = '';
				$length_width_height = '';
				$wheel_base = '';
				$track_front_rear = '';
				$kerb_weight = '';
				$ground_clearance = '';
				$turning_radius = '';
				$seating_capacity = '';
				$boot_capacity = '';
				$fuel_tank_capacity = '';
				$type = '';
				$displacement = '';
				$cylinders = '';
				$valvetrain  = '';
				$bore_stroke  = '';
				$compression_ratio  = '';
				$max_power  = '';
				$max_torque  = '';
				$power_to_weight_ratio  = '';
				$torque_to_weight_ratio  = '';
				$bhp_litre  = '';
				$drivetrain  = '';
				$transmission  = '';
				$service_intervals  = '';
				/* Tyre Size Information,Brakes Information,Kerb Weight Information,Ground Clearance Information,Seating Capacity Information */
				foreach($linearray as $la)
				{
	 				if($c==0 && $title=='')
					{
						 //$title = $la." Specifications";
						 $title = "";
					}
					else if($c==1  && $make=='')
					{
						$make = $la;
						//$title = $make." ";
					}
					else if($c==2 && $title=='')
					{
						$model = $la;
						$title = str_replace('"','',$make)." ".str_replace('"','',$model).''.' Specifications';
					}
					else if($c==3)
					{
						$engine_type = $la;
						$Data_engine_id =mysqli_query("SELECT node.nid, field_data_field_nr_make_model.field_nr_make_model_nid
FROM field_data_field_nr_make_model, node, field_data_field_nr_make WHERE node.nid = field_data_field_nr_make_model.entity_id
AND field_data_field_nr_make.entity_id = field_data_field_nr_make_model.field_nr_make_model_nid AND node.title ='".str_replace('"','',$engine_type)."' AND node.status =1");
						if(mysqli_num_rows($Data_engine_id)>0)
						{
							$model_id = '';
							while($data_Engine=mysql_fetch_assoc($Data_engine_id))
							{
								$model_id = $data_Engine['field_nr_make_model_nid'] .",";
							}
							if($model_id!='')
							{
								$sql_engine_by_model =mysqli_query("SELECT node.nid, field_data_field_nr_make_model.entity_id
	FROM field_data_field_nr_make_model, node WHERE node.nid = field_data_field_nr_make_model.field_nr_make_model_nid
	AND  node.nid in (".substr($model_id,0,-1).") AND node.title like '%".str_replace('"','',$model)."%' AND node.status =1");
								if(mysqli_num_rows($sql_engine_by_model)>0)
								{
									$Data_Engine_id = mysql_fetch_assoc($sql_engine_by_model);
									$engine_type = $Data_Engine_id['entity_id'];
								}
								else
								{
									$engine_type = '';
								}
							}
							else
							{
								$engine_type = '';
							}
						}
						else
						{
							$engine_type = '';
						}
						//$Data_make_id =mysqli_fetch_array(mysqli_query("SELECT node.nid FROM node, field_data_field_nr_make WHERE node.nid = field_data_field_nr_make.field_nr_make_nid AND node.title LIKE  '%".$make."%'"));	
					}
					else if($c==4)
					{
						$city = str_replace('"','',$la);
					}
					else if($c==5)
					{
						$highway =str_replace('"','',$la);
					}
					else if($c==6)
					{
						$api_rating = str_replace('"','',$la);
					}
					else if($c==7)
					{
						$steering_type = str_replace('"','',$la);
					}
					else if($c==8)
					{
						$front_suspension = str_replace('"','',$la);
					}
					else if($c==9)
					{
						$rear_suspension = str_replace('"','',$la);
					}
					else if($c==10)
					{
						$tye_size = str_replace('"','',$la);
					}
					else if($c==11)
					{
						$brake_front_rear = str_replace('"','',$la);
					}
					else if($c==12)
					{
						$length_width_height = str_replace('"','',$la);
					}
					else if($c==13)
					{
						$wheel_base = str_replace('"','',$la);
					}
					else if($c==14)
					{
						$track_front_rear = str_replace('"','',$la);
					}
					else if($c==15)
					{
						$kerb_weight = str_replace('"','',$la);
					}
					else if($c==16)
					{
						$ground_clearance =str_replace('"','',$la);
					}
					else if($c==17)
					{
						$turning_radius = str_replace('"','',$la);
					}
					else if($c==18)
					{
						$seating_capacity = str_replace('"','',$la);
					}
					else if($c==19)
					{
						$boot_capacity = str_replace('"','',$la);
					}
					else if($c==20)
					{
						$fuel_tank_capacity = str_replace('"','',$la);
					}
					else if($c==21)
					{
						$type = str_replace('"','',$la);
					}
					else if($c==22)
					{
						$displacement = str_replace('"','',$la);
					}
					else if($c==23)
					{
						$cylinders = str_replace('"','',$la);
					}
					else if($c==24)
					{
						$valvetrain = $la;
					}
					else if($c==25)
					{
						$bore_stroke = str_replace('"','',$la);
					}
					else if($c==26)
					{
						$compression_ratio = str_replace('"','',$la);
					}
					else if($c==27)
					{
						$max_power = str_replace('"','',$la);
					}
					else if($c==28)
					{
						$max_torque = str_replace('"','',$la);
					}
					else if($c==29)
					{
						$power_to_weight_ratio = str_replace('"','',$la);
					}
					else if($c==30)
					{
						$torque_to_weight_ratio = str_replace('"','',$la);
					}
					else if($c==31)
					{
						$bhp_litre = str_replace('"','',$la);
					}
					else if($c==32)
					{
						$drivetrain = str_replace('"','',$la);
					}
					else if($c==33)
					{
						$transmission = str_replace('"','',$la);
					}
					else if($c==34)
					{
						$service_intervals = str_replace('"','',$la);
					}
					$c++;
				}
				$ctime = time();
				if($title!='' && $engine_type!='')
				{
					/* print_r($Data_Engine_id);
					echo "city = ".$city."<br />";
					echo "highway = ".$highway."<br />";
					echo "api_rating = ".$api_rating."<br />";
					echo "steering_type = ".$steering_type."<br />";
					echo "rear_suspension = ".$rear_suspension."<br />";
					echo "tye_size = ".$tye_size."<br />";
					echo "brake_front_rear = ".$brake_front_rear."<br />";
					echo "length_width_height = ".$length_width_height."<br />";
					echo "wheel_base = ".$wheel_base."<br />";
					echo "track_front_rear = ".$track_front_rear."<br />";
					echo "kerb_weight = ".$kerb_weight."<br />";
					echo "ground_clearance = ".$ground_clearance."<br />";
					echo "turning_radius = ".$turning_radius."<br />";
					echo "seating_capacity = ".$seating_capacity."<br />";
					echo "boot_capacity = ".$boot_capacity."<br />";
					echo "fuel_tank_capacity = ".$fuel_tank_capacity."<br />";
					echo "type = ".$type."<br />";
					echo "displacement = ".$displacement."<br />";
					echo "cylinders = ".$cylinders."<br />";
					echo "valvetrain = ".$valvetrain."<br />";
					echo "bore_stroke = ".$bore_stroke."<br />";
					echo "compression_ratio = ".$compression_ratio."<br />";
					echo "max_power = ".$max_power."<br />";
					echo "max_torque = ".$max_torque."<br />";
					echo "power_to_weight_ratio = ".$power_to_weight_ratio."<br />";
					echo "torque_to_weight_ratio = ".$torque_to_weight_ratio."<br />";
					echo "bhp_litre = ".$bhp_litre."<br />";
					echo "drivetrain = ".$drivetrain."<br />";
					echo "transmission = ".$transmission."<br />";
					echo "service_intervals = ".$service_intervals."<br />";
					exit; */
					//$ins_node = "insert into node(vid,type,language,title,uid,status,created,changed,comment,promote,sticky,tnid,translate) values(NULL,'specifications','und','".$title."',1,1,".$ctime.",".$ctime.",1,0,0,0,0)";
					//$ins_node = "insert into node(vid,type,language,title,uid,status,created,changed,comment,promote,sticky,tnid,translate) values(NULL,'specifications','und','Wasim Momin',1,1,".$ctime.",".$ctime.",1,0,0,0,0)";
					//echo $ins_node ."<br />";
					//print_r($linearray);
					//$res_node = mysqli_query($ins_node) or die(mysql_error());
					//$nid = mysql_insert_id();
					//$Select_Data= mysql_fetch_assoc(mysqli_query("select * from node where nid =".$nid));
					$newNode = (object) NULL;
					$newNode->title = $title;
					$newNode->type = 'specifications';
					$newNode->uid = 1;
					$newNode->created = $ctime;
					$newNode->changed = $ctime;
					$newNode->status = 1;
					$newNode->comment = 0;
					$newNode->promote = 0;
					$newNode->moderate = 0;
					$newNode->sticky = 0;
					$newNode->language = 'und';
					//$engine_nid = 'Get it from Sql';
					$ins_array = node_save($newNode);
					$row_max_nid = mysqli_fetch_array(mysqli_query("SELECT MAX(nid) as nid FROM node"));
					$nid = $row_max_nid['nid'];
					
					$ins_engine_nid = "insert into field_data_field_spec_nr_engine_type(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_spec_nr_engine_type_nid) values('node','specifications',0,'".$nid."',NULL,'und',0,".$engine_type.")";
					$res_engine_nid = mysqli_query($ins_engine_nid) or die(mysql_error());
					//echo $ins_engine_nid ."<br />";
					
					$ins_city = "insert into field_data_field_spec_fuel_city(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_spec_fuel_city_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'".$city."')";
					$res_ins_city = mysqli_query($ins_city) or die(mysql_error());
					// echo $ins_city ."<br />";
					
					$ins_highway = "insert into field_data_field_spec_fuel_highway(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_spec_fuel_highway_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'".$highway."')";
					$res_ins_highway= mysqli_query($ins_highway) or die(mysql_error());
					//echo $ins_highway ."<br />";
					
					$ins_arai_rating = "insert into field_data_field_spec_fuel_arai(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_spec_fuel_arai_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'".$api_rating."')";
					$res_ins_arai_rating= mysqli_query($ins_arai_rating) or die(mysql_error());
					//echo $ins_arai_rating ."<br />";
					
					$ins_steering_type = "insert into field_data_field_spec_steering(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_spec_steering_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'".$steering_type."')";
					$res_ins_steering_type = mysqli_query($ins_steering_type) or die(mysql_error());
					//echo $ins_steering_type ."<br />";
					
					$ins_spec_front = "insert into field_data_field_spec_front(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_spec_front_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'".$front_suspension."')";
					$res_ins_spec_front = mysqli_query($ins_spec_front) or die(mysql_error());
					//echo $ins_spec_front ."<br />";
					
					$ins_spec_rear = "insert into field_data_field_spec_rear(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_spec_rear_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'".$rear_suspension."')";
					$res_ins_spec_rear = mysqli_query($ins_spec_rear) or die(mysql_error());
					//echo $ins_spec_rear ."<br />";
					
					$ins_spec_tyre = "insert into field_data_field_spec_tyre(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_spec_tyre_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'".$tye_size."')";
					$res_ins_spec_tyre = mysqli_query($ins_spec_tyre) or die(mysql_error());
					//echo $ins_spec_tyre ."<br />";
					
					$ins_spec_tyre_size = "insert into field_data_field_tyre_size_caption(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_tyre_size_caption_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'')"; 
					$res_ins_spec_tyre = mysqli_query($ins_spec_tyre_size) or die(mysql_error());
					//echo $ins_spec_tyre_size ."<br />";
					
					$ins_brake_front_rear = "insert into field_data_field_spec_brakes(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_spec_brakes_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'".$brake_front_rear."')";
					$res_ins_brake_front_rear = mysqli_query($ins_brake_front_rear) or die(mysql_error());
					//echo $ins_brake_front_rear ."<br />";
					
					$ins_brake_info = "insert into field_data_field_brakes_info(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_brakes_info_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'')";
					$res_ins_brake_info = mysqli_query($ins_brake_info) or die(mysql_error());
					//echo $ins_brake_info ."<br />";
					
					$ins_spec_length = "insert into field_data_field_spec_length(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_spec_length_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'".$length_width_height."')";
					$res_ins_spec_length = mysqli_query($ins_spec_length) or die(mysql_error());
					//echo $ins_spec_length ."<br />";
					
					$ins_wheel = "insert into field_data_field_spec_wheel(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_spec_wheel_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'".$wheel_base."')";
					$res_ins_wheel = mysqli_query($ins_wheel) or die(mysql_error());
					//echo $res_ins_wheel ."<br />";
					
					$ins_spec_track = "insert into field_data_field_spec_track(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_spec_track_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'".$track_front_rear."')";
					$res_ins_track = mysqli_query($ins_spec_track) or die(mysql_error());
					//echo $ins_spec_track ."<br />";
					
					$ins_kerb_weight = "insert into field_data_field_spec_kerb(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_spec_kerb_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'".$kerb_weight."')";
					$res_ins_kerb_weight = mysqli_query($ins_kerb_weight) or die(mysql_error());
					//echo $ins_kerb_weight ."<br />";
					
					$ins_kerb_info = "insert into field_data_field_kerb_info(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_kerb_info_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'')"; 
					$res_ins_kerb_info = mysqli_query($ins_kerb_info) or die(mysql_error());
					//echo $ins_kerb_info ."<br />";
					
					$ins_ground_clearance = "insert into field_data_field_spec_ground(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_spec_ground_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'".$ground_clearance."')";
					$res_ins_ground_clearance = mysqli_query($ins_ground_clearance) or die(mysql_error());
					//echo $ins_ground_clearance ."<br />";
					
					$ins_ground_info = "insert into field_data_field_ground_info(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_ground_info_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'')"; 
					$res_ins_ground_info = mysqli_query($ins_ground_info) or die(mysql_error());
					//echo $ins_ground_info ."<br />";
					
					$ins_turning_radius = "insert into field_data_field_spec_radius(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_spec_radius_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'".$turning_radius."')"; 
					$res_ins_turning_radius = mysqli_query($ins_turning_radius) or die(mysql_error());
					//echo $ins_turning_radius ."wasim".$turning_radius."<br />";
					
					$ins_seating_capacity = "insert into field_data_field_spec_seating(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_spec_seating_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'".$seating_capacity."')"; 
					$res_ins_seating_capacity = mysqli_query($ins_seating_capacity) or die(mysql_error());
					//echo $ins_seating_capacity ."<br />";
					
					$ins_seating_capacity_info = "insert into field_data_field_seating_info(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_seating_info_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'')"; 
					$res_ins_seating_capacity_info = mysqli_query($ins_seating_capacity_info) or die(mysql_error());
					//echo $ins_seating_capacity_info ."<br />";
					
					$ins_boot_value = "insert into field_data_field_spec_boot(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_spec_boot_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'".$boot_capacity."')"; 
					$res_ins_boot_value = mysqli_query($ins_boot_value) or die(mysql_error());
					//echo $ins_boot_value ."<br />";
					
					$ins_fuel_tank_capacity = "insert into field_data_field_spec_fuel_tank(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_spec_fuel_tank_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'".$fuel_tank_capacity."')"; 
					$res_ins_fuel_tank_capacity = mysqli_query($ins_fuel_tank_capacity) or die(mysql_error());
					//echo $ins_fuel_tank_capacity ."<br />";
					
					$ins_engine_type = "insert into field_data_field_spec_engine_type(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_spec_engine_type_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'".$type."')"; 
					$res_ins_engine_type = mysqli_query($ins_engine_type) or die(mysql_error());
					//echo $ins_engine_type ."<br />";
					
					$ins_displacement = "insert into field_data_field_spec_engine_displacement(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_spec_engine_displacement_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'".$displacement."')"; 
					$res_ins_displacement = mysqli_query($ins_displacement) or die(mysql_error());
					//echo $ins_displacement ."<br />";
					
					$ins_cylinders = "insert into field_data_field_spec_engine_cylinders(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_spec_engine_cylinders_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'".$cylinders."')"; 
					$res_ins_cylinders = mysqli_query($ins_cylinders) or die(mysql_error());
					//echo $ins_cylinders ."<br />";
					
					$ins_valvetrain = "insert into field_data_field_spec_engine_valvetrain(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_spec_engine_valvetrain_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'".$valvetrain."')"; 
					$res_ins_valvetrain = mysqli_query($ins_valvetrain) or die(mysql_error());
					//echo $ins_valvetrain ."<br />";
					
					$ins_bore_stroke = "insert into field_data_field_spec_engine_bore(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_spec_engine_bore_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'".$bore_stroke."')"; 
					$res_ins_bore_stroke = mysqli_query($ins_bore_stroke) or die(mysql_error());
					//echo $ins_bore_stroke ."<br />";
					
					$ins_compression_ratio = "insert into field_data_field_spec_engine_comp_ratio(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_spec_engine_comp_ratio_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'".$compression_ratio."')"; 
					$res_ins_compression_ratio = mysqli_query($ins_compression_ratio) or die(mysql_error());
					//echo $ins_compression_ratio ."<br />";
					
					$ins_max_power = "insert into field_data_field_spec_engine_power(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_spec_engine_power_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'".$max_power."')"; 
					$res_ins_max_power = mysqli_query($ins_max_power) or die(mysql_error());
					//echo $ins_max_power ."<br />";
					
					$ins_max_torque = "insert into field_data_field_spec_engine_torque(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_spec_engine_torque_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'".$max_torque."')"; 
					$res_ins_max_torque = mysqli_query($ins_max_torque) or die(mysql_error());
					//echo $ins_max_torque ."<br />";
					
					$ins_power_to_weight_ratio = "insert into field_data_field_spec_engine_power_weight(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_spec_engine_power_weight_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'".$power_to_weight_ratio."')"; 
					$res_ins_power_to_weight_ratio = mysqli_query($ins_power_to_weight_ratio) or die(mysql_error());
					//echo $ins_power_to_weight_ratio ."<br />";
					
					$ins_torque_to_weight_ratio = "insert into field_data_field_spec_engine_torque_weight(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_spec_engine_torque_weight_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'".$torque_to_weight_ratio."')"; 
					$res_ins_torque_to_weight_ratio = mysqli_query($ins_torque_to_weight_ratio) or die(mysql_error());
					//echo $ins_torque_to_weight_ratio ."<br />";
					
					$ins_bhp_litre = "insert into field_data_field_spec_engine_bhp(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_spec_engine_bhp_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'".$bhp_litre."')"; 
					$res_ins_bhp_litre = mysqli_query($ins_bhp_litre) or die(mysql_error());
					//echo $ins_bhp_litre ."<br />";
					
					$ins_bhp_drivetrain = "insert into field_data_field_spec_engine_drivetrain(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_spec_engine_drivetrain_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'".$drivetrain."')";  
					$res_ins_bhp_drivetrain = mysqli_query($ins_bhp_drivetrain) or die(mysql_error());
					//echo $ins_bhp_drivetrain ."<br />";
					
					$ins_bhp_transmission = "insert into field_data_field_spec_engine_transmission(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_spec_engine_transmission_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'".$transmission."')";  
					$res_ins_bhp_transmission = mysqli_query($ins_bhp_transmission) or die(mysql_error());
					//echo $ins_bhp_transmission ."<br />";
					
					$ins_service_intervals = "insert into field_data_field_spec_engine_service(entity_type,bundle,deleted,entity_id,revision_id,language,delta,field_spec_engine_service_value) values('node','specifications',0,'".$nid."',NULL,'und',0,'".$service_intervals."')";  
					$res_ins_service_intervals = mysqli_query($ins_service_intervals) or die(mysql_error());
					//echo $ins_service_intervals ."<br />";
					
					//echo "<br /><br />";
					//echo "end".drupal_lookup_path('alias',"node/56");
					//echo $ins_array."here is the array";
					//path_set_alias1111("node/".$nid,$Select_Data['title'],$pid = NULL, $language = 'und');
					//generate_seo_link($Select_Data['title'], '-', true, $bad_words,"node/".$nid);
					
					//echo $linemysql."<br />";
					/*if($addauto)
					$query = "insert into $databasetable values('','$linemysql');";
					else
					$query = "insert into $databasetable values('$linemysql');";
					$queries .= $query . "\n";
					@mysqli_query($query);*/
				}
		   }
		}
    }
}

@mysql_close($con);

if($save) {
	
	if(!is_writable($outputfile)) {
		echo "File is not writable, check permissions.\n";
	}
	
	else {
		$file2 = fopen($outputfile,"w");
		
		if(!$file2) {
			echo "Error writing to the output file.\n";
		}
		else {
			fwrite($file2,$queries);
			fclose($file2);
		}
	}
	
}

echo "Found a total of $lines records in this csv file.\n";


?>
