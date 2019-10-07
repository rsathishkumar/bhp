<?php
include("connect.php");
$eid=$_POST['eid'];
/*$model_id=$_POST['model_id'];
$sql_variant="SELECT node.title, field_data_field_features_engine.field_features_engine_nid, field_data_field_features_nr_variant.field_features_nr_variant_nid, field_data_field_features_engine.entity_id, field_data_field_features_model.field_features_model_nid FROM node, field_data_field_features_engine,field_data_field_features_nr_variant, field_data_field_features_model WHERE field_data_field_features_model.entity_id = field_data_field_features_engine.entity_id AND field_data_field_features_model.entity_id = field_data_field_features_nr_variant.entity_id AND node.nid = field_data_field_features_nr_variant.field_features_nr_variant_nid AND field_data_field_features_engine.field_features_engine_nid =".$eid." and field_data_field_features_model.field_features_model_nid=".$model_id." limit 0,4" ;*/

// comment as on 4-7-2011  $sql_variant="SELECT field_data_field_features_nr_variant.field_features_nr_variant_nid, node.title, field_data_field_features_nr_variant.entity_id ,field_data_field_variant_nr_engine.field_variant_nr_engine_nid FROM field_data_field_features_nr_variant, node, field_data_field_variant_nr_engine WHERE field_data_field_features_nr_variant.field_features_nr_variant_nid = field_data_field_variant_nr_engine.entity_id AND node.status =1 AND node.nid = field_data_field_features_nr_variant.field_features_nr_variant_nid AND field_data_field_variant_nr_engine.field_variant_nr_engine_nid=".$eid." group by field_data_field_features_nr_variant.field_features_nr_variant_nid limit 0,4";

 $sql_variant="SELECT field_data_field_features_nr_variant.field_features_nr_variant_nid, node.title, field_data_field_features_nr_variant.entity_id ,field_data_field_variant_nr_engine.field_variant_nr_engine_nid FROM field_data_field_features_nr_variant, node, field_data_field_variant_nr_engine WHERE field_data_field_features_nr_variant.field_features_nr_variant_nid = field_data_field_variant_nr_engine.entity_id AND node.status =1 AND node.nid = field_data_field_features_nr_variant.field_features_nr_variant_nid AND field_data_field_variant_nr_engine.field_variant_nr_engine_nid=".$eid." limit 0,4";
$resvariant=@mysqli_query($sql_variant) or die(mysql_error());
$numofrows=@mysqli_num_rows($resvariant);
									$variant_id='';
									$entity_id='';
								while($data_entity=@mysqli_fetch_array($resvariant))
									{
									$variant_id.=$data_entity['field_features_nr_variant_nid'].",";
									$entity_id.=$data_entity['entity_id'].",";
									}
		function getOption($val)
						{
							switch($val){
								case 0:
									//echo "<td class='aCenter'>N/A</td>";
									echo "<td class='aCenter'><img src='/themes/mobilebhp/images/cross.png' /></td>";
									break;
								case 1:
									echo "<td><div class='tickMarkIcon'>&nbsp;</div></td>";
									break;
								case 2:
									echo "<td class='aCenter'>Optional</td>";
									break;
								default:
									echo "<td>&nbsp;</td>";
									break;								
							}
						}
?>
<div class="tableHeadWrap">
				<div id="tableHead">
					<table class="speciTable">
							<thead>
								<tr>
									<?php
									$sql_vtitle=mysqli_query("select title,nid from node where nid in (".@substr($variant_id,0,-1).") order by nid");
								$numberofvaraint=mysqli_num_rows($sql_vtitle);
									if($numberofvaraint >1)
											{
									?>
									<th>&nbsp;</th>
									<?php
											}
										if($numberofvaraint>0)
											{
											
											while($row_variant=mysqli_fetch_array($sql_vtitle))
												{
									?>
									<th class="aCenter"><?php echo $row_variant['title'];?></th>
									<?php
												}
											}
									?>
									<!--  <th class="aCenter">Lxi</th>
									<th class="aCenter">Vxi</th>
									<th class="aCenter">Zxi</th>-->
									</tr>	
							</thead>
						</table>
					</div>
			</div>
<table class="speciTable">
				<thead>
					<tr>
						<th colspan="5">SAFETY</th>
					</tr>	
				</thead>
				<tr>
					<td>Airbags</td>
							<?php
						//for($i=0;$i<$numberofvaraint;$i++)
							//{
						$sql_airbag=@mysqli_query("select field_features_air_bags_value,entity_id from field_data_field_features_air_bags where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_ab=@mysqli_fetch_array($sql_airbag))
									{
									echo getOption($d_ab['field_features_air_bags_value']);
								   }
							//}
						?>
					<!--  <td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>ABS</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
							//{
							$sql_abs=@mysqli_query("select field_features_abs_value from field_data_field_features_abs where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_abs=@mysqli_fetch_array($sql_abs))
									{
									//echo $d_abs['field_features_abs_value'];
									echo getOption($d_abs['field_features_abs_value']);
								   }
							//}
						?>
					<!-- <td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
					
				<tr>
					<td>Traction control</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
							//{
							$sql_tcontrol=@mysqli_query("select field_features_traction_value from field_data_field_features_traction where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_tcontrol=@mysqli_fetch_array($sql_tcontrol))
									{
										
									echo getOption($d_tcontrol['field_features_traction_value']);
										
								   }
							//}
						?>
					<!--  <td><div class="tickMarkIcon">&nbsp;</div></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>-->
				</tr>
				<tr>
					<td>ESC / ESP</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
							//{
							$sql_esc=@mysqli_query("select field_features_esc_value from field_data_field_features_esc where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_esc=@mysqli_fetch_array($sql_esc))
									{
										echo getOption($d_esc['field_features_esc_value']);
								   }
							//}
						?>
					<!--  <td><div class="tickMarkIcon">&nbsp;</div></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>-->
				</tr>
				<tr>
					<td>Fog lights</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
						//	{
							$sql_flight=@mysqli_query("select field_features_fog_value from field_data_field_features_fog where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_flight=@mysqli_fetch_array($sql_flight))
									{
									echo getOption($d_flight['field_features_fog_value']);
								   }
							//}
						?>
					<!--  <td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td>&nbsp;</td>-->
				</tr>
				<tr>
					<td>Rear wash / wipe</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
						//	{
							$sql_rear=@mysqli_query("select field_features_wipe_value from field_data_field_features_wipe where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_rear=@mysqli_fetch_array($sql_rear))
									{
										echo getOption($d_rear['field_features_wipe_value']);
								   }
							//}
						?>
					<!--  <td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Engine immobiliser</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
						//	{
							$sql_ei=@mysqli_query("select field_features_immobiliser_value from field_data_field_features_immobiliser where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_ei=@mysqli_fetch_array($sql_ei))
									{
									 echo getOption($d_ei['field_features_immobiliser_value']);
								   }
							//}
						?>
					<!--  <td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Alloy wheels</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
							//{
							$sql_aw=@mysqli_query("select field_features_alloy_value from field_data_field_features_alloy where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_aw=@mysqli_fetch_array($sql_aw))
									{
									echo getOption($d_aw['field_features_alloy_value']);
								   }
							//}
						?>
					<!--  <td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<?php
			$sql_add_Safety=@mysqli_query("SELECT * FROM `team_bhp_features` WHERE nid IN (".substr($entity_id,0,-1).") AND category = 'Safety' GROUP BY feature_name ORDER BY nid");
				if(mysqli_num_rows($sql_add_Safety)>0)
					{
					$e=explode(",",substr($entity_id,0,-1));
					while($d_sft_addit=@mysqli_fetch_array($sql_add_Safety))
									{
						?>
						<tr>
							<td><?php echo $d_sft_addit['feature_name'];?></td>
						 <?php
							 for($l=0;$l<count($e);$l++)
							 	{
							 	$sql_safety=mysqli_query("select feature_option from team_bhp_features where nid=".$e[$l]." and category='Safety' and feature_name='".$d_sft_addit['feature_name']."'");
							 		$r_sft=mysql_fetch_assoc($sql_safety);
							 		echo getOption($r_sft['feature_option']);	
							 	}
						?>
						</tr>
					<?php
								   }
				 	 }
				?>
			</table><!-- speciTable -->
			
			<table class="speciTable">
				<thead>
					<tr>
						<th colspan="5">DRIVER ENHANCEMENTS</th>
					</tr>	
				</thead>
				<tr>
					<td>Power steering</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
						//	{
							$sql_ps=@mysqli_query("select field_features_power_steering_value from field_data_field_features_power_steering where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_ps=@mysqli_fetch_array($sql_ps))
									{
										echo getOption($d_ps['field_features_power_steering_value']);
								   }
							//}
						?>
					<!--  <td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Steering - Tilt adjustment</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
							//{
							$sql_sta=@mysqli_query("select field_features_steering_tilt_value from field_data_field_features_steering_tilt where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_sta=@mysqli_fetch_array($sql_sta))
									{
										echo getOption($d_sta['field_features_steering_tilt_value']);
								   }
							//}
						?>
					<!--  <td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Steering - Reach adjustment</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
						//	{
							$sql_sra=@mysqli_query("select field_features_steering_reach_value from field_data_field_features_steering_reach where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_sra=@mysqli_fetch_array($sql_sra))
									{
										echo getOption($d_sra['field_features_steering_reach_value']);
								   }
							//}
						?>
					<!--  <td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Height adjustable driver seat</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
							//{
							$sql_hads=@mysqli_query("select field_features_height_value from field_data_field_features_height where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_hads=@mysqli_fetch_array($sql_hads))
									{
										echo getOption($d_hads['field_features_height_value']);
								   }
							//}
						?>
					<!--<td class="aCenter">Optional</td>
					<td class="aCenter">Optional</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Adjustable lumbar support</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
						//	{
							$sql_als=@mysqli_query("select field_features_lumbar_value from field_data_field_features_lumbar where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_als=@mysqli_fetch_array($sql_als))
									{
										echo getOption($d_als['field_features_lumbar_value']);
								   }
							//}
						?>
					<!--<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Dead pedal</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
							//{
							$sql_deadpedal=@mysqli_query("select field_features_dead_pedal_value from field_data_field_features_dead_pedal where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_deadpedal=@mysqli_fetch_array($sql_deadpedal))
									{
									echo getOption($d_deadpedal['field_features_dead_pedal_value']);
								    }
							//}
						?>
					<!--<td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Center armrest</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
						//	{
							$sql_centerarm=@mysqli_query("select field_features_armrest_value from field_data_field_features_armrest where entity_id in (".substr($entity_id,0,-1).") ");
								while($d_centerarm=@mysqli_fetch_array($sql_centerarm))
									{
										echo getOption($d_centerarm['field_features_armrest_value']);
								   }
							//}
						?>
					<!--<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Electric mirrors</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
							//{
							$sql_electricmirror=@mysqli_query("select field_features_mirrors_value from field_data_field_features_mirrors  where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_electricmirror=@mysqli_fetch_array($sql_electricmirror))
									{
										echo getOption($d_electricmirror['field_features_mirrors_value']);
								   }						
							//}
						?>
					<!--<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Multi-information display</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
							//{
							$sql_multiinfo=@mysqli_query("select field_features_info_display_value from field_data_field_features_info_display  where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_multiinfo=@mysqli_fetch_array($sql_multiinfo))
									{
									echo getOption($d_multiinfo['field_features_info_display_value']);
								   }
							//}
						?>
					<!--<td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Parking sensors</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
						//	{
							$sql_parkingsensor=@mysqli_query("select field_features_sensors_value from field_data_field_features_sensors  where entity_id in (".substr($entity_id,0,-1).") ");
								while($d_parkingsensor=@mysqli_fetch_array($sql_parkingsensor))
									{
									echo getOption($d_parkingsensor['field_features_sensors_value']);
								    }							
							// }
						?>
					<!--<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Automatic gearbox</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
						//	{
							$sql_autogear=@mysqli_query("select field_features_gear_box_value from field_data_field_features_gear_box  where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_autogear=@mysqli_fetch_array($sql_autogear))
									{
									 echo getOption($d_autogear['field_features_gear_box_value']);
								    }
							//}
						?>
					<!--<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<?php
			$sql_add_denhance=@mysqli_query("SELECT * FROM `team_bhp_features` WHERE nid IN (".substr($entity_id,0,-1).") AND category = 'Driver Enhancements' GROUP BY feature_name ORDER BY nid");
				if(mysqli_num_rows($sql_add_denhance)>0)
					{
					$e=explode(",",substr($entity_id,0,-1));
					while($d_add_denh=@mysqli_fetch_array($sql_add_denhance))
									{
						?>
						<tr>
							<td><?php echo $d_add_denh['feature_name'];?></td>
						 <?php
							 for($l=0;$l<count($e);$l++)
										{
										$sql_denhance=mysqli_query("select feature_option from team_bhp_features where nid=".$e[$l]." and category='Driver Enhancements' and feature_name='".$d_add_denh['feature_name']."'");
											$r_den=mysql_fetch_assoc($sql_denhance);
											echo getOption($r_den['feature_option']);	
										}
						?>
						</tr>
					<?php
								   }
				 	 }
			?>
			</table><!-- speciTable -->
			
			<table class="speciTable">
				<thead>
					<tr>
						<th colspan="5">CONVENIENCE</th>
					</tr>	
				</thead>
				<tr>
					<td>Remote locking</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
							//{
							$sql_rlocking=@mysqli_query("select field_features_remote_value from field_data_field_features_remote  where entity_id in (".substr($entity_id,0,-1).")  order by entity_id");
								while($d_rlocking=@mysqli_fetch_array($sql_rlocking))
									{
									echo getOption($d_rlocking['field_features_remote_value']);
								    }
							//}
						?>
					<!--<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Central locking</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
							//{
							$sql_centerlocking=@mysqli_query("select field_features_central_value from field_data_field_features_central where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_centerlocking=@mysqli_fetch_array($sql_centerlocking))
									{
									echo getOption($d_centerlocking['field_features_central_value']);
								    }
							//}
						?>
					<!--<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Power windows</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
						//	{
							$sql_powerwindow=@mysqli_query("select field_features_window_value from field_data_field_features_window where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_powerwindow=@mysqli_fetch_array($sql_powerwindow))
									{
										echo getOption($d_powerwindow['field_features_window_value']);
								   }
							//}
						?>
					<!--<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Air-conditioner</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
							//{
							$sql_airconditionar=@mysqli_query("select field_features_air_conditioner_value from field_data_field_features_air_conditioner where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_airconditionar=@mysqli_fetch_array($sql_airconditionar))
									{
									echo getOption($d_airconditionar['field_features_air_conditioner_value']);
								    }
							//}
						?>
					<!--<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Climate control</td>
						<?php
						/*for($i=0;$i<$numberofvaraint;$i++)
							{*/
							$sql_climatecontrol=@mysqli_query("select field_features_climate_value from field_data_field_features_climate where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_climatecontrol=@mysqli_fetch_array($sql_climatecontrol))
									{
									 echo getOption($d_climatecontrol['field_features_climate_value']);
								    }
							  //}
						?>
					<!--<td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Rear air-con vents</td>
						<?php
						/*for($i=0;$i<$numberofvaraint;$i++)
							{*/
							$sql_rearaicon=@mysqli_query("select field_features_vents_value from field_data_field_features_vents where entity_id in (".substr($entity_id,0,-1).")  order by entity_id");
								while($d_rearaicon=@mysqli_fetch_array($sql_rearaicon))
									{
									echo getOption($d_rearaicon['field_features_vents_value']);
								    }
							//}
						?>
					<!--<td>&nbsp;</td>
					<td class="aCenter">Optional</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Leather seats</td>
						<?php
					/*	for($i=0;$i<$numberofvaraint;$i++)
							{*/
							$sql_leather=@mysqli_query("select field_features_seats_value from field_data_field_features_seats where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_leather=@mysqli_fetch_array($sql_leather))
									{
									echo getOption($d_leather['field_features_seats_value']);
								    }
							//}
						?>
					<!--<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Sunroof</td>
						<?php
						/*for($i=0;$i<$numberofvaraint;$i++)
							{*/
							$sql_sunroof=@mysqli_query("select field_features_sun_roof_value from field_data_field_features_sun_roof where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_sunroof=@mysqli_fetch_array($sql_sunroof))
									{
									echo getOption($d_sunroof['field_features_sun_roof_value']);
								    }
								//}
						?>
					<!--<td>&nbsp;</td>
					<td class="aCenter">Optional</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Fold-down rear seat</td>
						<?php
						/*for($i=0;$i<$numberofvaraint;$i++)
							{*/
							$sql_fdown=@mysqli_query("select field_features_fold_value from field_data_field_features_fold where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_fdown=@mysqli_fetch_array($sql_fdown))
									{
									echo getOption($d_fdown['field_features_fold_value']);
								   }
							//}
						?>
					<!--<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Split rear seats</td>
						<?php
						/*for($i=0;$i<$numberofvaraint;$i++)
							{*/
							$sql_sp_rear=@mysqli_query("select field_features_split_value from field_data_field_features_split where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_sp_rear=@mysqli_fetch_array($sql_sp_rear))
									{
									echo getOption($d_sp_rear['field_features_split_value']);
								    }
							//}
						?>
					<!--<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<?php
			$sql_add_Convenience=@mysqli_query("SELECT * FROM `team_bhp_features` WHERE nid IN (".substr($entity_id,0,-1).") AND category = 'Convenience' GROUP BY feature_name ORDER BY nid");
				if(mysqli_num_rows($sql_add_Convenience)>0)
					{
					$e=explode(",",substr($entity_id,0,-1));
					while($d_add_conv=@mysqli_fetch_array($sql_add_Convenience))
									{
						?>
						<tr>
							<td><?php echo $d_add_conv['feature_name'];?></td>
						 <?php
							 for($l=0;$l<count($e);$l++)
										{
										$sql_Convenience=mysqli_query("select feature_option from team_bhp_features where nid=".$e[$l]." and category='Convenience' and feature_name='".$d_add_conv['feature_name']."'");
											$r_Convenience=mysql_fetch_assoc($sql_Convenience);
											echo getOption($r_Convenience['feature_option']);	
										}
						?>
						</tr>
					<?php
								   }
				 	 }
			?>
			</table><!-- speciTable -->
			
			<table class="speciTable">
				<thead>
					<tr>
						<th colspan="5">Entertainment</th>
					</tr>	
				</thead>
				<?php
			$sql_nofspeaker=@mysqli_query("select field_number_of_speakers_value from field_data_field_number_of_speakers where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
				if(@mysqli_num_rows($sql_nofspeaker)>0)
					{
				?>
				<tr>
					<td>Number of speakers</td>
						<?php
						/*for($i=0;$i<$numberofvaraint;$i++)
							{*/
							
								while($d_nofspeaker=@mysqli_fetch_array($sql_nofspeaker))
									{
									?>
									<td class='aCenter'><?php echo $d_nofspeaker['field_number_of_speakers_value'];?></td>
									<?php
									}
							//}
						?>
					<!--<td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->	
				</tr>
				<?php
					}
				?>
				<tr>
					<td>CD Player</td>
						<?php
						/*for($i=0;$i<$numberofvaraint;$i++)
							{*/
							$sql_cdplayer=@mysqli_query("select field_features_cd_value from field_data_field_features_cd where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_cdplayer=@mysqli_fetch_array($sql_cdplayer))
									{
									echo getOption($d_cdplayer['field_features_cd_value']);
								    }
							//}
						?>
					<!--<td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>AUX input</td>
						<?php
						/*for($i=0;$i<$numberofvaraint;$i++)
							{*/
							$sql_auxinput=@mysqli_query("select field_features_aux_value from field_data_field_features_aux where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_auxinput=@mysqli_fetch_array($sql_auxinput))
									{
									echo getOption($d_auxinput['field_features_aux_value']);
								    }
							//}
						?>
					<!--<td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>USB input</td>
						<?php
						/*for($i=0;$i<$numberofvaraint;$i++)
							{*/
							$sql_usbinput=@mysqli_query("select field_features_usb_value from field_data_field_features_usb where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_usbinput=@mysqli_fetch_array($sql_usbinput))
									{
									echo getOption($d_usbinput['field_features_usb_value']);
								    }
								 //}
						?>
					<!--<td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Bluetooth connectivity</td>
						<?php
						/*for($i=0;$i<$numberofvaraint;$i++)
							{*/
							$sql_btooth=@mysqli_query("select field_features_bluetooth_value from field_data_field_features_bluetooth where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_btooth=@mysqli_fetch_array($sql_btooth))
									{
									echo getOption($d_btooth['field_features_bluetooth_value']);
								    }
							//}
						?>
				<!--  <td>&nbsp;</td>
					<td class="aCenter">Optional</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Steering-mounted controls</td>
						<?php
						/*for($i=0;$i<$numberofvaraint;$i++)
							{*/
							$sql_smc=@mysqli_query("select field_features_steering_value from field_data_field_features_steering where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_smc=@mysqli_fetch_array($sql_smc))
									{
									echo getOption($d_smc['field_features_steering_value']);
								    }
							//}
						?>
					<!--  <td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<?php
			$sql_add_entertainment=@mysqli_query("SELECT * FROM `team_bhp_features` WHERE nid IN (".substr($entity_id,0,-1).") AND category = 'Entertainment' GROUP BY feature_name ORDER BY nid");
				if(mysqli_num_rows($sql_add_entertainment)>0)
					{
					$e=explode(",",substr($entity_id,0,-1));
					while($d_ent_addit=@mysqli_fetch_array($sql_add_entertainment))
									{
						?>
						<tr>
							<td><?php echo $d_ent_addit['feature_name'];?></td>
						 <?php
							 for($l=0;$l<count($e);$l++)
							 	{
							 	$sql_ent=mysqli_query("select feature_option from team_bhp_features where nid=".$e[$l]." and category='Entertainment' and feature_name='".$d_ent_addit['feature_name']."'");
							 		$r=mysql_fetch_assoc($sql_ent);
							 		echo getOption($r['feature_option']);	
							 	}
						?>
						</tr>
					<?php
								   }
				 	 }
					?>
			</table>
