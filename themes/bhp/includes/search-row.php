<div class="resultReview clearfix<?php if($i==mysqli_num_rows($model_res)) { ?> last<?php }?>">
		<table>
			<tr>
				<td class="w100 aln_center">
				<a class="resultimg" href="<?php echo $url['alias']; ?>" title="<?php echo $model_row1['title']; ?>">
					<strong>
					<!-- <img src="/sites/default/files/<?php echo str_replace("public://","",$review['uri']);?>" alt="<?php echo $model_row1['title']; ?>" width="70" height="53" border="0" />-->
					<img src="/<?php echo $model_imgname;?>" alt="<?php echo $model_row1['title']; ?>" />
					</strong>
				</a>
				</td>
				<td class="owners borderRight w200">
					<h4><a href="<?php echo $url['alias']; ?>" title="<?php echo $model_row1['title']; ?>"><?php echo /*$model_row['title']." ".*/$model_row1['title']; ?></a></h4>
					<?php
					if($price_res['minPrice']!='' & $price_res['maxPrice']!='')
					{
						if($price_res['minPrice']>=100000)
							{
								$minPrice = to_lakh($price_res['minPrice']);
							}
						else
							{
								$minPrice = $price_res['minPrice'];
							}
						if($price_res['maxPrice']>=100000)
							{
								$maxPrice = to_lakh($price_res['maxPrice'])." Lakh";
							}
						else
							{
								$maxPrice = $price_res['maxPrice'];
							}
					?>
					<span><span class="WebRupee">Rs.</span> <?php echo $minPrice." - ".$maxPrice; ?></span>
					<div class="viewVarDiv">
						<!--<a href="#" class="viewVariant" onclick="showVariants('<?php echo $model_row1['nid']; ?>', '<?php echo $city; ?>'); return false;">View variant Pricing</a>-->
						<!--<a href="#" class="viewVariant" onclick="jQuery(this).colorbox({inline:true, href:'#var<?php //echo $model_row1['nid']; ?>'}); return false;">View variant Pricing</a>-->
						<!-- 13-07-2011 <a href="#" class="viewVariant" onclick="showVariants('var<?php echo $model_row1['nid']; ?>'); return false;">View variant Pricing</a>-->
						<a href="#var<?php echo $model_row1['nid']; ?>" class="viewVariant">View variant Pricing</a>
						<div style="display: none;">
						<div class="viewDropDwn" id="var<?php echo $model_row1['nid']; ?>">
							<!--<a href="#" class="close" class="close" onclick="closeDiv(); return false;">X</a>
							<a href="#" class="close" class="close" onclick="jQuery.fancybox.close(); return false;">X</a>-->
							<div class="clearfix marB10">
								<div class="fleft w140 aln_center">
									<!-- <img src="/sites/default/files/<?php echo str_replace("public://","",$review['uri']);?>" alt="<?php echo $model_row1['title']; ?>" width="100" height="75" />-->
									<span class="variantImg"><img src="/<?php echo $model_imgnamemedium;?>" alt="<?php echo $model_row1['title']; ?>" /></span>
								</div>
								
								<div class="fleft fancyCarDetails">
									<h4><?php echo /*$model_row['title']." ".*/$model_row1['title']; ?></h4>
									<span class="amount"><span class="WebRupee">Rs.</span><?php echo $minPrice." - ".$maxPrice; ?> </span>
									<span class="onRoad">On Road Price: <?php echo $city; ?></span>
									<a title="Review Overview" href="<?php echo $url['alias']; ?>"><img width="47" height="12" alt="Review" src="themes/bhp/images/buttons/review.png" border="0"></a>
									<a href="#" onclick="getCarID('<?php echo $model_row1['nid']; ?>'); return false;"><img width="47" height="12" alt="Compare" src="themes/bhp/images/buttons/compare.png" border="0"></a>
								</div>
							</div><!-- clearfix -->
							<?php
								$model_engine = mysqli_query("select entity_id from field_data_field_nr_make_model where field_nr_make_model_nid=".$model_row1['nid']) or die(mysql_error());
								if(@mysqli_num_rows($model_engine)>0)
								{
							?>
							<ul class="viewVari">
								<li class="thead">
									<table border="0" class="datatable">
										<tbody>
											<tr>
												<td class="varianttxt">Engine Type</td>
												<td class="interior">Variant</td>
												<td class="modeltxt">Price</td>
											</tr>
										</tbody>
									</table>
								</li>
							
								<?php
								while($me_row=mysql_fetch_assoc($model_engine))
								{
								$engine_res = @mysql_fetch_assoc(mysqli_query("select title, nid from node where nid=".$me_row['entity_id'])) or die(mysql_error());
								?>
								<li>				
									<table class="datatable" border="0">
									<?php
										$engine_variant = mysqli_query("select field_data_field_variant_nr_engine.entity_id as entity_id, on_road_price as price from field_data_field_variant_nr_engine, field_data_field_price_nr_variant, team_bhp_variant_price where field_variant_nr_engine_nid=".$engine_res['nid']." and field_data_field_variant_nr_engine.entity_id=field_data_field_price_nr_variant.field_price_nr_variant_nid and field_data_field_price_nr_variant.entity_id=team_bhp_variant_price.nid and city='".$city."'") or die(mysql_error());
										$variantCount = @mysqli_num_rows($engine_variant);
									if($variantCount>0)
										{
										$v = 0;
											while($ev_row=mysql_fetch_assoc($engine_variant))
											{
											//echo "<br />select title, nid from node where nid=".$ev_row['entity_id']."<br />";
											$variant_res = @mysql_fetch_assoc(mysqli_query("select title, nid from node where nid=".$ev_row['entity_id'])) or die(mysql_error());
										?>
											<tr>
											<?php
											if($v==0)
											{
											?>
											<td class="varianttxt" rowspan="<?php echo $variantCount; ?>"><?php echo $engine_res['title']; ?></td>
											<?php
											}
											?>
												<td class="interior"><?php echo $variant_res['title']; ?></td>
											<?php
											if($ev_row['price']!='')
												{
													$varPrice = "Rs. ".limitChars($ev_row['price']);
												}
											else
												{
													//$varPrice = "(Rs.".str_replace(",,",",",limitChars(number_format($ev_row['price']))).")";
												}
												if($varPrice!='')
													{
											?>
												<td class="modeltxt"><span class="WebRupee">Rs.</span> <?php echo $varPrice; ?></td>
												<?php
													}
												?>
											</tr>
										<?php
											$v++;
											}
										}
									?>
									</table>
								</li>
								<?php
								}
								?>
							</ul>
							<?php
								}
							?>
						</div>
						</div>
					</div>
					<?php
					}
					else
					{
					?>
					<div class="viewVarDiv">
						No prices available
					</div>
					<?php
					}
					?>
				</td>
				<td class="borderRight w125">
					<p><!--Body style: --><?php echo $body_style['field_model_body_value']; ?></p>
					<?php
					$fuel = "";
					$transmission = "";
					$fuel_res = @mysqli_query("select distinct(field_engine_fuel_value) as fuel from field_data_field_engine_fuel,  field_data_field_nr_make_model where field_data_field_engine_fuel.entity_id=field_data_field_nr_make_model.entity_id and field_data_field_nr_make_model.field_nr_make_model_nid=".$model_row1['nid']) or die(mysql_error());
					while($fuel_row=mysql_fetch_assoc($fuel_res))
					{
						$fuel .= $fuel_row['fuel'].", ";
					}
					$transmission_res = @mysqli_query("select distinct(field_engine_transmission_value) as transmission from field_data_field_engine_transmission, field_data_field_nr_make_model where field_data_field_engine_transmission.entity_id=field_data_field_nr_make_model.entity_id and field_data_field_nr_make_model.field_nr_make_model_nid=".$model_row1['nid']) or die(mysql_error());
					while($transmission_row=mysql_fetch_assoc($transmission_res))
					{
						$transmission .= $transmission_row['transmission'].", ";
					}
					if($fuel!='')
					{
					?>
					<p><?php echo substr($fuel, 0, -2); ?></p>
					<?php
					}
					if($transmission!='')
					{
					?>
					<p><?php echo substr($transmission, 0, -2); ?></p>
					<?php
					}
					?>
				</td>
				<td class="owners padL20">
					<div class="clearfix">
					<h4 class="fleft">Owners liked</h4>
						<div class="fright resultReviewBtn padR10">
						<a href="<?php echo $url['alias']; ?>" title="Review Overview"><img src="themes/bhp/images/buttons/review.png" alt="Review" width="57" height="12" /></a>
						<a href="#" onclick="getCarID('<?php echo $model_row1['nid']; ?>'); return false;"><img src="themes/bhp/images/buttons/compare.png" alt="Compare" width="57" height="12" /></a>												
						</div>
					</div>
					<ul class="bulletList">
					<?php
					$nofowlike=@mysqli_num_rows($owners_liked);
					if($nofowlike>0)
							{
							while($o_row=@mysql_fetch_assoc($owners_liked))
								{
								?>
									<li><?php echo $o_row['field_model_liked_value']; ?></li>
								<?php
								}
							}
							else
							{
							?>
							<li>N/A</li>
							<?php
							}
					?>
					</ul>													
				</td>
			</tr>
		</table>
	</div><!-- resultReview -->
