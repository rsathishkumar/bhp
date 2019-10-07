<?php
include("connect.php");
$eid=$_POST['eid'];
$model_id=$_POST['model_id'];
$sql_variant="SELECT node.title, field_data_field_features_engine.field_features_engine_nid, field_data_field_features_nr_variant.field_features_nr_variant_nid, field_data_field_features_engine.entity_id, field_data_field_features_model.field_features_model_nid
FROM node, field_data_field_features_engine, field_data_field_features_nr_variant, field_data_field_features_model
WHERE field_data_field_features_model.entity_id = field_data_field_features_engine.entity_id
AND field_data_field_features_model.entity_id = field_data_field_features_nr_variant.entity_id
AND node.nid = field_data_field_features_nr_variant.field_features_nr_variant_nid
AND field_data_field_features_engine.field_features_engine_nid =".$eid." and field_data_field_features_model.field_features_model_nid=".$model_id." limit 0,4" ;
$resvariant=@mysqli_query($sql_variant) or die(mysql_error());
?>
<div class="tableHeadWrap">
				<div id="tableHead">
					<table class="speciTable">
							<thead>
								<tr>
									<?php
								$numberofvaraint=mysqli_num_rows($resvariant);
									if(mysqli_num_rows($resvariant)>1)
											{
									?>
									<th>&nbsp;</th>
									<?php
											}
										if(mysqli_num_rows($resvariant)>0)
											{
											$entity_id='';
											while($row_variant=mysqli_fetch_array($resvariant))
												{
												$entity_id.=$row_variant['entity_id'].",";
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
									//print_r($d_ab);
									//echo $d_ab['entity_id'];
									
										if($d_ab['field_features_air_bags_value']==0)
										{
							?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_ab['field_features_air_bags_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
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
									if($d_abs['field_features_abs_value']==0)
										{
						?>
						<td>&nbsp;</td>
						<?php
										}
										else if($d_abs['field_features_abs_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
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
										if($d_tcontrol['field_features_traction_value']==0)
														{
									?>
										<td>&nbsp;</td>
									<?php
										}
										else if($d_tcontrol['field_features_traction_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
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
										if($d_esc['field_features_esc_value']==0)
										{
						?>
						<td>&nbsp;</td>
						<?php
										}
										else if($d_esc['field_features_esc_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
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
										if($d_flight['field_features_fog_value']==0)
										{
						?>
						<td>&nbsp;</td>
									<?php
										}
										else if($d_flight['field_features_fog_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
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
										if($d_rear['field_features_wipe_value']==0)
										{
						?>
										<td>&nbsp;</td>
										<?php
										}
										else if($d_rear['field_features_wipe_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
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
										if($d_ei['field_features_immobiliser_value']==0)
										{
						?>
						<td>&nbsp;</td>
									<?php
										}
										else if($d_ei['field_features_immobiliser_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
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
										if($d_aw['field_features_alloy_value']==0)
										{
						?>
						<td>&nbsp;</td>
									<?php
										}
										else if($d_aw['field_features_alloy_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--  <td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
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
										if($d_ps['field_features_power_steering_value']==0)
										{
						?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_ps['field_features_power_steering_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
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
										if($d_sta['field_features_steering_tilt_value']==0)
										{
						?>
										<td>&nbsp;</td>
									<?php
										}
										else if($d_sta['field_features_steering_tilt_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
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
										if($d_sra['field_features_steering_reach_value']==0)
										{
							?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_sra['field_features_steering_reach_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
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
										if($d_hads['field_features_height_value']==0)
										{
						?>
										<td>&nbsp;</td>
									<?php
										}
										else if($d_hads['field_features_height_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
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
										if($d_als['field_features_lumbar_value']==0)
										{
						?>
						<td>&nbsp;</td>
									<?php
										}
										else if($d_als['field_features_lumbar_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
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
									
										if($d_deadpedal['field_features_dead_pedal_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_deadpedal['field_features_dead_pedal_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
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
										if($d_centerarm['field_features_armrest_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_centerarm['field_features_armrest_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
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
										if($d_electricmirror['field_features_mirrors_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_electricmirror['field_features_mirrors_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
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
										if($d_multiinfo['field_features_info_display_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_multiinfo['field_features_info_display_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
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
										if($d_parkingsensor['field_features_sensors_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_parkingsensor['field_features_sensors_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
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
										if($d_autogear['field_features_gear_box_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_autogear['field_features_gear_box_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
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
										if($d_rlocking['field_features_remote_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_rlocking['field_features_remote_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
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
										if($d_centerlocking['field_features_central_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_centerlocking['field_features_central_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
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
										if($d_powerwindow['field_features_window_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_powerwindow['field_features_window_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
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
										if($d_airconditionar['field_features_air_conditioner_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_airconditionar['field_features_air_conditioner_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
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
										if($d_climatecontrol['field_features_climate_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_climatecontrol['field_features_climate_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
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
										if($d_rearaicon['field_features_vents_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_rearaicon['field_features_vents_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
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
										if($d_leather['field_features_seats_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_leather['field_features_seats_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
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
										if($d_sunroof['field_features_sun_roof_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_sunroof['field_features_sun_roof_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
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
										if($d_fdown['field_features_fold_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_fdown['field_features_fold_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
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
										if($d_sp_rear['field_features_split_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_sp_rear['field_features_split_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
			</table><!-- speciTable -->
			
			<table class="speciTable">
				<thead>
					<tr>
						<th colspan="5">Entertainment</th>
					</tr>	
				</thead>
				<tr>
					<td>Number of speakers</td>
						<?php
						/*for($i=0;$i<$numberofvaraint;$i++)
							{*/
							$sql_nofspeaker=@mysqli_query("select field_features_speaker_value from field_data_field_features_speaker where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_nofspeaker=@mysqli_fetch_array($sql_nofspeaker))
									{
										if($d_nofspeaker['field_features_speaker_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_nofspeaker['field_features_speaker_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--<td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->	
				</tr>
				<tr>
					<td>CD Player</td>
						<?php
						/*for($i=0;$i<$numberofvaraint;$i++)
							{*/
							$sql_cdplayer=@mysqli_query("select field_features_cd_value from field_data_field_features_cd where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_cdplayer=@mysqli_fetch_array($sql_cdplayer))
									{
										if($d_cdplayer['field_features_cd_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_cdplayer['field_features_cd_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
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
										if($d_auxinput['field_features_aux_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_auxinput['field_features_aux_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
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
										if($d_usbinput['field_features_usb_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_usbinput['field_features_usb_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
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
										if($d_btooth['field_features_bluetooth_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_btooth['field_features_bluetooth_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
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
								if($d_smc['field_features_steering_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_smc['field_features_steering_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--  <td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
			</table>
