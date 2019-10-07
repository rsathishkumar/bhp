<?php
//echo ($node->field_news_images['und'][0]['filename']);
//print_r($node->field_news_media_type['und'][0]['value']);
?>
<script type="text/javascript">		    
(function ($) {  $(function(){
$(".listHolder").hover(
function(){
$(this).addClass("hover");
},
function(){
$(this).removeClass("hover");
}
);

$(".mv_tab_content li").hover(
function(){
$(this).addClass("hover");
},
function(){
$(this).removeClass("hover");
}
);
//Most Viewed tab 				
$(".most_view li").click(function() {
$(".most_view li a").removeClass("active"); //Remove any "active" class
$(this).find("a").addClass("active"); //Remove any "active" class
$(this).addClass("active"); //Add "active" class to selected tab
$(".mv_tab_content").hide(); //Hide all tab content

var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
$(activeTab).fadeIn(); //Fade in the active ID content
return false;
});
$(".gallery_thumb li").click(function(){
$(".gallery_thumb li a").removeClass("active");
$(this).find("a").addClass("active");
$("img#mainPhoto").attr("src", $(this).find("a").attr("href"));
$(".lightbox").attr("href", $(this).find("a").attr("href"));
return false;
});
$(".lightbox").lightbox();
});
})(jQuery);
</script>
<?php
$make_res = @mysql_fetch_assoc(mysqli_query("select field_data_field_make_url.`field_make_url_url`, title from field_data_field_price_nr_variant, field_data_field_variant_nr_engine, field_data_field_nr_make_model, field_data_field_nr_make, field_data_field_make_url, node where field_data_field_price_nr_variant.entity_id=".$node->nid." and field_data_field_price_nr_variant.field_price_nr_variant_nid=field_data_field_variant_nr_engine.entity_id and field_data_field_variant_nr_engine.field_variant_nr_engine_nid=field_data_field_nr_make_model.entity_id and field_data_field_nr_make_model.field_nr_make_model_nid=field_data_field_nr_make.entity_id and field_data_field_nr_make.field_nr_make_nid=node.nid and field_data_field_nr_make.field_nr_make_nid=field_data_field_make_url.entity_id"));

$model_res = @mysql_fetch_assoc(mysqli_query("select node.nid, node.title from field_data_field_price_nr_variant, field_data_field_variant_nr_engine, field_data_field_nr_make_model, node where field_data_field_price_nr_variant.entity_id=".$node->nid." and field_data_field_price_nr_variant.field_price_nr_variant_nid=field_data_field_variant_nr_engine.entity_id and field_data_field_variant_nr_engine.field_variant_nr_engine_nid=field_data_field_nr_make_model.entity_id and field_data_field_nr_make_model.field_nr_make_model_nid=node.nid"));

$res_std_warr=@mysqli_query("select field_model_s_warranty_value from field_data_field_model_s_warranty where entity_id=".$model_res['nid']);
$std_warranty = @mysql_fetch_assoc($res_std_warr);

$ext_warranty = @mysqli_query("select field_model_e_warranty_value from field_data_field_model_e_warranty where entity_id=".$model_res['nid']);

if(strpos($make_res['field_make_url_url'], 'http://')>=0)
{
$url = $make_res['field_make_url_url'];
}
else
{
$url = "http://".$make_res['field_make_url_url'];
}


$firstvariant=@mysqli_fetch_array(mysqli_query("SELECT field_variant_nr_engine_nid FROM field_data_field_variant_nr_engine,node WHERE field_data_field_variant_nr_engine.field_variant_nr_engine_nid=node.nid and node.status=1 and  entity_id =".$node->field_price_nr_variant['und'][0]['nid']));
	if($firstvariant!='')
		{
		//echo "select node.title,node.nid from node,field_data_field_variant_nr_engine where field_data_field_variant_nr_engine.field_variant_nr_engine_nid=".$firstvariant['field_variant_nr_engine_nid'];
	
		$sql_e=@mysqli_query("select node.title,node.nid from node,field_data_field_variant_nr_engine where node.nid=field_data_field_variant_nr_engine.field_variant_nr_engine_nid and node.status=1 and field_data_field_variant_nr_engine.field_variant_nr_engine_nid=".$firstvariant['field_variant_nr_engine_nid']);
		$nofr=@mysqli_num_rows($sql_e);
			if($nofr>0)
				{
					$row_e=mysqli_fetch_array($sql_e);
					$vid=$row_e['nid'];
					$enginename=$row_e['title'];
				}
				
		}


	$photos_nid = @mysqli_fetch_array(mysqli_query("select entity_id from field_data_field_gallery_model where field_gallery_model_nid=".$model_res['nid']));
	if($photos_nid!='')
	{
	$photos_alias = @mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$photos_nid['entity_id']."' and alias !='gallery/ant'"));
	}
	
	$sql_urlforspecification=@mysqli_fetch_array(mysqli_query("select field_data_field_spec_nr_engine_type.entity_id,field_data_field_nr_make_model.field_nr_make_model_nid from field_data_field_nr_make_model, field_data_field_spec_nr_engine_type where field_data_field_nr_make_model.field_nr_make_model_nid=".$model_res['nid']." and field_data_field_nr_make_model.entity_id=field_data_field_spec_nr_engine_type.field_spec_nr_engine_type_nid LIMIT 1"));
	
	if($sql_urlforspecification!='')
		{
$sql_urlforspecific=@mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$sql_urlforspecification['entity_id']."'"));
		}

	
	$sql_forengine=mysqli_query("select node.title,field_data_field_nr_make_model.entity_id,field_data_field_nr_make_model.field_nr_make_model_nid from node,field_data_field_nr_make_model where node.nid=field_data_field_nr_make_model.entity_id and node.status=1 and field_data_field_nr_make_model.field_nr_make_model_nid=".$model_res['nid']);
			$engineid='';
			while($dateforengineid=mysqli_fetch_array($sql_forengine))
				{
				$engineid.=$dateforengineid['entity_id'].",";
				}
		
		
		$sql_urlforfeature=@mysqli_fetch_array(mysqli_query("select field_data_field_features_nr_variant.entity_id from field_data_field_features_nr_variant,field_data_field_variant_nr_engine where field_data_field_features_nr_variant.field_features_nr_variant_nid=field_data_field_variant_nr_engine.entity_id and field_data_field_variant_nr_engine.field_variant_nr_engine_nid in (".@substr($engineid,0,-1).") limit 1"));
	if($sql_urlforfeature!='')
		{
$sql_urlforfeaturedata=@mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$sql_urlforfeature['entity_id']."'"));
		}
		
		$forum_review_nid = @mysqli_fetch_array(mysqli_query("select entity_id from field_data_field_forum_model where field_forum_model_nid=".$model_res['nid']));
		if($forum_review_nid!='')
		{
$forum_review_alias = @mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$forum_review_nid['entity_id']."'"));
		}
		
		
		$sql_urlforprice=@mysqli_fetch_array(mysqli_query("select field_data_field_price_nr_variant.entity_id from field_data_field_nr_make_model, field_data_field_variant_nr_engine, field_data_field_price_nr_variant where field_data_field_nr_make_model.field_nr_make_model_nid=".$model_res['nid']." and field_data_field_nr_make_model.entity_id=field_data_field_variant_nr_engine.field_variant_nr_engine_nid and field_data_field_variant_nr_engine.entity_id=field_data_field_price_nr_variant.field_price_nr_variant_nid"));
		if($sql_urlforprice!='')
		{
$sql_urlforpricedata=@mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$sql_urlforprice['entity_id']."'"));
		}
$res_engine=@mysqli_query("SELECT node.nid,node.title FROM field_data_field_nr_make_model, node WHERE node.nid = field_data_field_nr_make_model.entity_id and node.status=1 AND field_data_field_nr_make_model.field_nr_make_model_nid=".$model_res['nid']." and node.nid!=$vid");
	$nofengine=mysqli_num_rows($res_engine);
	$sql_Engine_toshow=mysqli_query("select title,nid from node where nid=".$vid);
	$data_Engine_toshow=@mysqli_fetch_array($sql_Engine_toshow);
	$sql_vrnts=@mysqli_query("SELECT field_data_field_price_nr_variant.field_price_nr_variant_nid,team_bhp_variant_price.ex_showroom_price,team_bhp_variant_price.ex_showroom_price,team_bhp_variant_price.on_road_price,team_bhp_variant_price.taxes,team_bhp_variant_price.insurance,node.title,field_data_field_price_nr_variant.entity_id ,field_data_field_variant_nr_engine.field_variant_nr_engine_nid FROM field_data_field_price_nr_variant, node,team_bhp_variant_price, field_data_field_variant_nr_engine WHERE field_data_field_price_nr_variant.field_price_nr_variant_nid = field_data_field_variant_nr_engine.entity_id AND node.status =1 AND node.nid = field_data_field_price_nr_variant.field_price_nr_variant_nid AND team_bhp_variant_price.nid=field_data_field_price_nr_variant.entity_id AND team_bhp_variant_price.city='Delhi' AND field_data_field_variant_nr_engine.field_variant_nr_engine_nid=".$data_Engine_toshow['nid']);
	$entity_id='';
	while($data_entity=@mysqli_fetch_array($sql_vrnts))
		{
		//$variant_id.=$data_entity['field_price_nr_variant_nid'].",";
		$entity_id.=$data_entity['entity_id'].",";
		}
	$sql_cityname=@mysqli_query("select DISTINCT(city) from team_bhp_variant_price where nid in (".substr($entity_id,0,-1).") and city!='Delhi' order by city");
	$sql_citynamedelhi=@mysqli_query("select DISTINCT(city) from team_bhp_variant_price where nid in (".substr($entity_id,0,-1).") and city='Delhi' order by city");
function to_lakh($no)
		{
		if(intval($no)>=100000)
			{
				$res = (intval($no)/100000);
				if(strpos($res, '.')>0)
				{
					$res = round($res, 1);
				}
				else
				{
				$res=$res.".0";
				}
				return $res;
			}
		else
			{
				return 0;
			}
		}
?>
<div id="leftColumn" class="clearfix fleft">
<div class="article">
		<h1 class="padL20 marB10">Reviews</h1>
		
		<ul class="tab TLR5 clearfix">
			<li><a href="<?php echo url("node/".$model_res['nid']);?>" class="TLR5" title="Overview">Overview</a></li>
			<?php
				if($photos_alias!='')
					{
			?>
			<li><a href="?q=<?php echo $photos_alias['alias'];?>" class="TLR5" title="Photos">Photos</a></li>
			<?php
					}
					if($sql_urlforspecific!='')
					{
			?>
			<li><a href="?q=<?php echo $sql_urlforspecific['alias'];?>" class="TLR5" title="Specifications">Specifications</a></li>
			<?php
					}
					if($sql_urlforfeaturedata!='')
					{
			?>
			<li><a href="?q=<?php echo $sql_urlforfeaturedata['alias'];?>" class="TLR5" title="Features">Features</a></li>
			<?php
					}
					if($forum_review_alias!='')
					{
			?>
			<li><a href="?q=<?php echo $forum_review_alias['alias'];?>" class="TLR5" title="Forum Reviews">Forum Reviews</a></li>
			<?php
					}
			?>
			<li><a href="<?php echo url("node/".$node->nid);?>" class="TLR5 active" title="Price">Price</a></li>
		</ul>
		
		<div class="Overview price">
			<div class="carOverview marB10 BLR5">
				<div class="clearfix">
					<div class="fleft w480">
						<h1><?php echo $make_res['title']." ".$model_res['title']; ?> <span>Price</span></h1>
					</div>
					<?php include ("themes/bhp/includes/common/share.php") ?>
				</div><!-- clearfix -->
					
				<div class="clearfix marT10 clearfix">
					<div class="fleft w658 priceTab">
						<div class="variantFilter clearfix">
							<dl class="clearfix">
								<dt>On Road Price</dt>
								<dd>
									<select class="w120" onchange="show_priceby_city(this.value,'<?php echo $vid?>');" id="cityname">
										<?php
											$row_citynamedelhi=@mysqli_fetch_array($sql_citynamedelhi);
											?>
											<option value="<?php echo $row_citynamedelhi['city'];?>"><?php echo $row_citynamedelhi['city'];?></option>
											<?php
											while($row_cityname=mysqli_fetch_array($sql_cityname))
												{
											?>
											<option value="<?php echo $row_cityname['city'];?>"><?php echo $row_cityname['city'];?></option>
											<?php
												}
											?>												
									</select>
								</dd>
							</dl>
							
							<?php
								$r=mysqli_num_rows($sql_Engine_toshow);
								if($r>0)
								{
								
								?>
								<dl class="clearfix">
								<dt>Engine Type</dt>
								<dd>
								<select class="w120" onchange="show_priceby_engine(this.value);" >
									<option value="<?php echo $data_Engine_toshow['nid'];?>"><?php echo $data_Engine_toshow['title'];?></option>
									<?php
								if($nofengine>0)
									{
									while($rowenginedata=mysqli_fetch_array($res_engine))
										{
										$sql_specifi_check=mysqli_num_rows(mysqli_query("SELECT node.title FROM field_data_field_price_nr_variant,field_data_field_variant_nr_engine,node where field_data_field_variant_nr_engine.entity_id=field_data_field_price_nr_variant.field_price_nr_variant_nid and node.nid=field_data_field_variant_nr_engine.field_variant_nr_engine_nid and node.status=1 and field_data_field_variant_nr_engine.field_variant_nr_engine_nid=".$rowenginedata['nid']));							
										if($sql_specifi_check>0)	
											{
									?>
						 <option value="<?php echo $rowenginedata['nid'];?>"><?php echo $rowenginedata['title'];?></option>
								<?php
											}
										}	
									}
								?>													
								</select>
								</dd>
							</dl>
								<?php } ?>
							
						</div><!-- variantFilter -->
						
						<h2 class="priceRs">Price</h2>
						
						<div id="ajax">
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
								$sql_p=@mysqli_query("select * from team_bhp_variant_price where city='Delhi' and nid in(".@substr($entity_id,0,-1).") group by nid");
								while($d_price=mysqli_fetch_array($sql_p))
									{
										$sql_var=@mysqli_fetch_array(mysqli_query("select title from node,field_data_field_price_nr_variant  where node.nid=field_data_field_price_nr_variant.field_price_nr_variant_nid and node.status=1 and field_data_field_price_nr_variant.entity_id=".$d_price['nid']));
								?>
								<tr>
									<td class="vari"><?php echo $sql_var['title'];?></td>
									<td><span class="WebRupee">Rs.</span> <?php echo number_format($d_price['ex_showroom_price']);?></td>
									<td><span class="WebRupee">Rs.</span> <?php echo number_format($d_price['taxes']);?></td>
									<td><span class="WebRupee">Rs.</span> <?php echo number_format($d_price['insurance']);?></td>
									<td class="onRaod"><span class="WebRupee">Rs.</span> <?php echo number_format($d_price['on_road_price']);?></td>
								</tr>
								<?php
									}
								?>
								<!-- <tr>
									<td class="vari">Lxi</td>
									<td><span class="WebRupee">Rs.</span> 4,18,000</td>
									<td><span class="WebRupee">Rs.</span> 45,000</td>
									<td><span class="WebRupee">Rs.</span> 13,000</td>
									<td class="onRaod"><span class="WebRupee">Rs.</span> 5,32,000</td>
								</tr>
								<tr>
									<td class="vari">Lxi</td>
									<td><span class="WebRupee">Rs.</span> 4,18,000</td>
									<td><span class="WebRupee">Rs.</span> 45,000</td>
									<td><span class="WebRupee">Rs.</span> 13,000</td>
									<td class="onRaod"><span class="WebRupee">Rs.</span> 5,32,000</td>
								</tr>
								<tr>
									<td class="vari">Lxi</td>
									<td><span class="WebRupee">Rs.</span> 4,18,000</td>
									<td><span class="WebRupee">Rs.</span> 45,000</td>
									<td><span class="WebRupee">Rs.</span> 13,000</td>
									<td class="onRaod"><span class="WebRupee">Rs.</span> 5,32,000</td>
								</tr>
								<tr>
									<td class="vari">Lxi</td>
									<td><span class="WebRupee">Rs.</span> 4,18,000</td>
									<td><span class="WebRupee">Rs.</span> 45,000</td>
									<td><span class="WebRupee">Rs.</span> 13,000</td>
									<td class="onRaod"><span class="WebRupee">Rs.</span> 5,32,000</td>
								</tr> -->
								</tbody>
							</table>
							
						</div><!-- -->
						
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
												<dl class="clearfix">
													<dt>Downpayment</dt>
													<dd><input type="text" name="" class="dwnAmt" id="downpayment" value="<?php echo($totalamountsql['ex_showroom_price']*.15);?>" /><span class="WebRupee">Rs.</span></dd>
												</dl>
												<dl class="clearfix">
													<dt>Interest rate</dt>
													<dd><input type="text" name="" class="intRate"  id="i_rate" value="10.5" /><span>%</span></dd>
												</dl>
												<dl class="clearfix">
													<dt>Duration</dt>
													<dd>
														<select id="duration">
															<option value="36">36</option>
															<option value="48">48</option>
															<option value="52">52</option>
															<option value="60">60</option>	
															<option value="72">72</option>	
															<option value="84">84</option>																
														</select>
														<span>Months</span>
													</dd>
												</dl>
												<input type="submit" class="submit" name="submit" value="Calculate">
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
										$I = (10.5/12)/100;
										$one = pow((1+$I),35);
										$EMI = ($deductedamount*$I)*($one / ($one-1));
											?>
											<tr>
												<td class="vari"><?php echo $sql_varforemi['title']; ?></td>
												<td class="emi">
												<div id="amountcalculated<?php echo $cnt_emi; ?>">
												<!--<span class="WebRupee">Rs.</span> <?php //echo number_format(round($ttalamountincl_intrest/36)); ?>-->
												<span class="WebRupee">Rs.</span> <?php echo number_format(round($EMI)); ?>
												</div>
											<input type="hidden" name="one_month_amount<?php echo $cnt_emi; ?>" id="one_month_amount<?php echo $cnt_emi; ?>" value="<?php echo number_format(round($ttalamountincl_intrest/36)); ?>">
											<input type="hidden" name="actual_amount<?php echo $cnt_emi; ?>" id="actual_amount<?php echo $cnt_emi; ?>" class="actual" value="<?php echo $d_price_emi['ex_showroom_price'];?>">									</td>
											</tr>
											<?php
											$cnt_emi++;
												}
											?>
											  <!--  <tr>
												<td class="vari">Lxi</td>
												<td><span class="WebRupee">Rs.</span> 5,32,000</td>
											</tr>
											<tr>
												<td class="vari">Lxi</td>
												<td><span class="WebRupee">Rs.</span> 5,32,000</td>
											</tr>
											<tr>
												<td class="vari">Lxi</td>
												<td><span class="WebRupee">Rs.</span> 5,32,000</td>
											</tr>
											<tr>
												<td class="vari">Lxi</td>
												<td><span class="WebRupee">Rs.</span> 5,32,000</td>
											</tr>-->
											
											</tbody>
										</table>
									</div><!--priceVariant -->
							</div><!-- emi calcbox -->
						</div><!-- emiContent -->
						<?php
							}
						?>
						</div><!-- End of ajax-->
						<?php
							$nofswarr=@mysqli_num_rows($res_std_warr);
							$nofextwarr=@mysqli_num_rows($ext_warranty);
							if($nofswarr>0 || $nofextwarr>0)
								{
								
						?>
						<h2 class="marT20 warranty">Warranty</h2>
						
						<div class="warrantytable roundAll5 marT10">
								<table class="priceVariant">
									<thead>
										<tr>
											<th>Standard</th>
											<th>Extended Warranty Options</th>
										</tr>	
									</thead>
									<tbody>
									<?php
									if($nofextwarr>0)
										{
											$i=0;
											while($ext_row = mysql_fetch_assoc($ext_warranty))
											//for($i=0; $i<@mysqli_num_rows($ext_warranty);$i++)
											{
											?>
											<tr>
											<?php
												if($i==0)
												{
											?>
												<td class="lastBtm" rowspan="<?php echo @mysqli_num_rows($ext_warranty); ?>"><?php echo $std_warranty['field_model_s_warranty_value']; ?></td>
											<?php
												}
												if($i==@mysqli_num_rows($ext_warranty)-1)
												{
													$c = " class=\"lastBtm\"";
												}
											?>
												<td<?php echo $c; ?>><?php echo $ext_row['field_model_e_warranty_value']; ?></td>
											</tr>
											<?php
											$i++;
											}
										}
										else
										{
										?>
											<tr>
											<td class="lastBtm" rowspan="4"><?php echo $std_warranty['field_model_s_warranty_value']; ?></td>
											<td>&nbsp;</td>
											</tr>
											<?php
										}
									//echo $model_res['nid'];
									?>
									</tbody>
								</table>
						</div><!--priceVariant -->
						
						<?php
							}
						?>
					</div><!-- cleafix -->
					
					<div class="fright w225">
						<div class="roundAll5 clearfix OtherSections">
							<h4>Manufacturer Website</h4>
							<div class="manfWeb">
								<a href="<?php echo $url; ?>" title="<?php echo $make_res['title'];?>" target="_blank"><?php echo $url; ?></a>
							</div>
						</div><!-- most viewed -->
						<?php //include ("themes/bhp/includes/manufacturer-website.php") ?>
						<?php include ("themes/bhp/includes/must-read-articles-price.php"); ?>
					</div><!-- 225 -->
				</div><!-- clearfix -->
			</div><!-- car over view -->

			<div class="clearfix marL10">
				<a class="fleft btnLeft" href="?q=reviews">
					<span>Back to Index</span>
				</a>
				<!--<a class="compareClose" id="compareBtn" href="#" onclick="return false;">&nbsp;</a>-->
			</div>	<!-- lcearfix -->
			
			<?php 
			$sql_model=@mysqli_query("SELECT node.title,node.nid, file_managed.uri,field_data_field_nr_make.field_nr_make_nid,field_data_field_model_dashboard.field_model_dashboard_fid
FROM node,file_managed,field_data_field_nr_make,field_data_field_model_dashboard
WHERE field_data_field_model_dashboard.field_model_dashboard_fid = file_managed.fid
AND field_data_field_model_dashboard.entity_id = node.nid
AND node.status =1 AND field_data_field_nr_make.entity_id=field_data_field_model_dashboard.entity_id and node.nid=".$model_res['nid']." order by node.changed desc");
$numberofrows=@mysqli_num_rows($sql_model);
							if($numberofrows>0)
									{
							?>
						<div class="compareMesgInside"><p class="compareMesgPad roundAll5">You have already added that car. Please choose another car.</p></div>
						<div class="marB10 BLR5 reviewCompare" style="display:block">
						<ul class="clearfix" id="compareUL">
							<?php
							$data_model=mysqli_fetch_array($sql_model);
							$mktitle=@mysqli_fetch_array(mysqli_query("select title from node,field_data_field_nr_make where field_data_field_nr_make.entity_id =".$data_model['nid']." and field_data_field_nr_make.field_nr_make_nid=node.nid"));
							$price_res = @mysql_fetch_assoc(mysqli_query("select min(on_road_price) as minPrice, max(on_road_price) as maxPrice from team_bhp_variant_price, field_data_field_price_nr_variant, field_data_field_variant_nr_engine, field_data_field_nr_make_model where team_bhp_variant_price.city='Delhi' and team_bhp_variant_price.nid=field_data_field_price_nr_variant.entity_id and field_data_field_price_nr_variant.field_price_nr_variant_nid=field_data_field_variant_nr_engine.entity_id and field_data_field_variant_nr_engine.field_variant_nr_engine_nid=field_data_field_nr_make_model.entity_id and field_data_field_nr_make_model.field_nr_make_model_nid=".$data_model['nid']));
							?>
							<li class="clearfix">
								<div class="content firstContent clearfix" id="<?php echo $data_model['nid']; ?>">
									<div class="img">
									<!-- <img src="http://www.team-bhp.com/sites/default/files/<?php echo str_replace("public://","",$data_model['uri']);?>" alt="car" width="61" height="46" />-->
									<img src="http://www.team-bhp.com/?q=sites/default/files/styles/thumb_review_detail/public/<?php echo str_replace("public://","",$data_model['uri']);?>" alt="car" width="61" height="46" />
									</div>
									<p class="desc">
										<span class="title"><?php echo $mktitle['title']." ".$data_model['title'];?></span>
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
										<span class="price"><span class="WebRupee">Rs.</span> <?php echo $minPrice." - ".$maxPrice; ?></span>
						 <?php
					  	}
						 ?>
									</p>
									<!--<span class="iconRemove">&nbsp;</span>-->
								</div>
							</li>
							<?php							
									include_once("includes/compare-inside.php");
							?>
							</ul><!-- clearfix -->
						</div><!-- reviewCompare -->
						<?php 
									}
			//include_once("includes/reviews-alternatives.php");
			//$sql_modelalternative=@mysqli_query("SELECT node.title,node.nid,field_data_field_model_alternatives.field_model_alternatives_nid from node,field_data_field_model_alternatives WHERE field_data_field_model_alternatives.field_model_alternatives_nid = node.nid AND node.status =1  and field_data_field_model_alternatives.entity_id =".$model_res['nid']." order by node.changed desc");
			$sql_modelalternative=@mysqli_query("SELECT node.title AS title, node.nid AS nid, field_data_field_model_alternatives.field_model_alternatives_nid FROM node, field_data_field_model_alternatives WHERE field_data_field_model_alternatives.field_model_alternatives_nid = node.nid AND node.status =1 AND field_data_field_model_alternatives.entity_id=".$model_res['nid']." UNION SELECT node.title AS title, node.nid AS nid, field_data_field_model_alternatives.entity_id FROM node, field_data_field_model_alternatives WHERE field_data_field_model_alternatives.entity_id = node.nid AND node.status =1 AND field_data_field_model_alternatives.field_model_alternatives_nid=".$model_res['nid']." ORDER BY title");
			include_once("includes/alternative_forreview.php");
			?>
			
		</div><!-- overviewContainer -->
	</div><!-- articles -->
</div><!-- Left Column -->




