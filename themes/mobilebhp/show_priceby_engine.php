<?php
			include("connect.php");
		if($_POST['action']=='show')
					{
					
						$sql_vrnts=@mysqli_query("SELECT field_data_field_price_nr_variant.field_price_nr_variant_nid,team_bhp_variant_price.ex_showroom_price,team_bhp_variant_price.ex_showroom_price,team_bhp_variant_price.on_road_price,team_bhp_variant_price.taxes,team_bhp_variant_price.insurance,node.title,field_data_field_price_nr_variant.entity_id ,field_data_field_variant_nr_engine.field_variant_nr_engine_nid FROM field_data_field_price_nr_variant, node,team_bhp_variant_price, field_data_field_variant_nr_engine WHERE field_data_field_price_nr_variant.field_price_nr_variant_nid = field_data_field_variant_nr_engine.entity_id AND node.status =1 AND node.nid = field_data_field_price_nr_variant.field_price_nr_variant_nid AND team_bhp_variant_price.nid=field_data_field_price_nr_variant.entity_id AND team_bhp_variant_price.city='Delhi' AND field_data_field_variant_nr_engine.field_variant_nr_engine_nid=".$_POST['engineid']);
					$variant_id='';
					$entity_id='';
					while($data_entity=@mysqli_fetch_array($sql_vrnts))
						{
						//$variant_id.=$data_entity['field_price_nr_variant_nid'].",";
						$entity_id.=$data_entity['entity_id'].",";
						}
						?>
						<div class="marT10 PricingTable roundAll5">
						<table class="priceVariant roundAll5">
								<thead>
									<tr>
										<th>Variant</th>
										<th>Ex-Showroom</th>
										<th>Taxes</th>
										<th>Insurance</th>
										<th>On-Road Price</th>
									</tr>	
								</thead>
								<tbody>
						<?php
						if($entity_id!='')
							{
							?>
							
						<?php
						$sql_p=@mysqli_query("select * from team_bhp_variant_price where city='Delhi' and nid in(".@substr($entity_id,0,-1).") group by nid");
							while($d_price=mysqli_fetch_array($sql_p))
								{
									$sql_var=@mysqli_fetch_array(mysqli_query("select title from node,field_data_field_price_nr_variant  where node.nid=field_data_field_price_nr_variant.field_price_nr_variant_nid and node.status=1 and field_data_field_price_nr_variant.entity_id=".$d_price['nid']))
							?>
							<tr>
								<td class="vari"><?php echo $sql_var['title'];?></td>
								<td><span class="rsymbol">Rs.</span> <?php echo number_format($d_price['ex_showroom_price']);?></td>
								<td><span class="rsymbol">Rs.</span> <?php echo number_format($d_price['taxes']);?></td>
								<td><span class="rsymbol">Rs.</span> <?php echo number_format($d_price['insurance']);?></td>
								<td class="onRaod"><span class="rsymbol">Rs.</span> <?php echo number_format($d_price['on_road_price']);?></td>
							</tr>
							<?php
								}
						
							}
							else
							{
							?>
							<tr>
								<td colspan="5" align="center">No price found under <strong><?php echo ucfirst($_POST['city']);?></strong></td>
							</tr>
							<?php
								}
							?>
						</tbody>
							</table>
							<?php
							}
							?>
							</div>
							<div class="tableNote">Note : These prices are only indicative. For exact prices, please contact your local dealership.</div>
						<?php
						if($entity_id!='')
							{
							$totalamountsql=@mysqli_fetch_array(mysqli_query("select ex_showroom_price from team_bhp_variant_price where city='Delhi' and nid in (".@substr($entity_id,0,-1).") order by nid"));
							//echo $totalamountsql['ex_showroom_price'];
							$fifteenpercentamout=$totalamountsql['ex_showroom_price']*.15;
							$emiamount=$totalamountsql['ex_showroom_price']+$fifteenpercentamout;
							
						?>
						<h2 class="marT20 emi">EMI Calculator</h2>
						
						<div class="emiContent">
							<div class="emiCalcBox roundAll5 ">
									<div class="emiCalcHolder roundAll5">
									<form name="cac_emi" id="cac_emi" onsubmit="calculate_emiamount();return false;">
											<div class="emiCalc roundAll5">
												<p>Downpayment</p>
												<input type="text" name="" class="dwnAmt" id="downpayment" value="<?php echo ($totalamountsql['ex_showroom_price']*.15);?>" /><span>Rupees</span>
		
												<p>Interest rate</p>
												<input type="text" name="" class="intRate" id="i_rate"  value="10.5"/><span>%</span>
												<p>Duration</p>
												<select id="duration">
													<option value="36">36</option>
													<option value="48">48</option>
													<option value="52">52</option>
													<option value="60">60</option>	
													<option value="72">72</option>	
													<option value="84">84</option>															
												</select>
												
												<span>Months</span>
												<br /><br />
												<input type="submit" name="submit" value="Calculate">
		
											</div><!-- emiCalc -->
											</form>
									</div><!-- emiCalcHolder calc -->
									<div class="emiTable roundAll5">
										<table class="priceVariant emi">
											<thead>
												<tr>
													<th>Variant</th>
													<th>EMI</th>
												</tr>	
											</thead>
											<tbody>
											<?php
										$emisql=@mysqli_query("select * from team_bhp_variant_price where city='Delhi' and nid in (".@substr($entity_id,0,-1).")");
											$cnt_emi=0;
											while($d_price_emi=mysqli_fetch_array($emisql))
												{
												$fifteenpercent_emiamout='';
												$deductedamount=0;
										$sql_varforemi=@mysqli_fetch_array(mysqli_query("select title from node,field_data_field_price_nr_variant  where node.nid=field_data_field_price_nr_variant.field_price_nr_variant_nid and node.status=1 and field_data_field_price_nr_variant.entity_id=".$d_price_emi['nid']));
										$fifteenpercent_emiamout=$d_price_emi['ex_showroom_price']*.15;
										$deductedamount=$d_price_emi['ex_showroom_price']-$fifteenpercent_emiamout;
										$ttalamountincl_intrest=$deductedamount*.105+$deductedamount;
											?>
											<tr>
												<td class="vari"><?php echo $sql_varforemi['title']; ?></td>
												<td class="emi">
												<div id="amountcalculated<?php echo $cnt_emi; ?>">
												<span class="WebRupee">Rs.</span> <?php echo number_format(round($ttalamountincl_intrest/36)); ?>
												</div>
											<input type="hidden" name="one_month_amount<?php echo $cnt_emi; ?>" id="one_month_amount<?php echo $cnt_emi; ?>" value="<?php echo number_format(round($ttalamountincl_intrest/36)); ?>">
											<input type="hidden" name="actual_amount<?php echo $cnt_emi; ?>" id="actual_amount<?php echo $cnt_emi; ?>" class="actual" value="<?php echo $d_price_emi['ex_showroom_price'];?>">	</td>
											</tr>
											<?php
											$cnt_emi++;
												}
											?>
											  <!--  <tr>
												<td class="vari">Lxi</td>
												<td><span class="rsymbol">Rs.</span> 5,32,000</td>
											</tr>
											<tr>
												<td class="vari">Lxi</td>
												<td><span class="rsymbol">Rs.</span> 5,32,000</td>
											</tr>
											<tr>
												<td class="vari">Lxi</td>
												<td><span class="rsymbol">Rs.</span> 5,32,000</td>
											</tr>
											<tr>
												<td class="vari">Lxi</td>
												<td><span class="rsymbol">Rs.</span> 5,32,000</td>
											</tr>-->
											
											</tbody>
										</table>
									</div><!--priceVariant -->
							</div><!-- emi calcbox -->
						</div><!-- emiContent -->
						<?php
							}
						?>
