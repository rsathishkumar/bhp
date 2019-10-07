<?php
$sql_alternative=@mysqli_query("SELECT node.title,node.nid,field_data_field_model_alternatives.field_model_alternatives_nid from node,field_data_field_model_alternatives WHERE field_data_field_model_alternatives.field_model_alternatives_nid = node.nid AND node.status =1  and field_data_field_model_alternatives.entity_id =".$node->nid." order by node.changed desc");
$numberofalter=@mysqli_num_rows($sql_alternative);
if($numberofalter>0)
	{
	$price_res_car = @mysql_fetch_assoc(mysqli_query("select min(on_road_price) as minPrice, max(on_road_price) as maxPrice from team_bhp_variant_price, field_data_field_price_nr_variant, field_data_field_variant_nr_engine, field_data_field_nr_make_model where team_bhp_variant_price.city='Delhi' and team_bhp_variant_price.nid=field_data_field_price_nr_variant.entity_id and field_data_field_price_nr_variant.field_price_nr_variant_nid=field_data_field_variant_nr_engine.entity_id and field_data_field_variant_nr_engine.field_variant_nr_engine_nid=field_data_field_nr_make_model.entity_id and field_data_field_nr_make_model.field_nr_make_model_nid=".$node->nid));
	
	if($price_res_car['minPrice']>=100000)
		{
			$minPricecar = to_lakh($price_res_car['minPrice']);
		}
	else
		{
			//$minPricecar = $price_res_car['minPrice'];
		}
	if($price_res_car['maxPrice']>=100000)
		{
			$maxPricecar = to_lakh($price_res_car['maxPrice'])." Lakh";
		}
	else
		{
			//$maxPricecar = $price_res_car['maxPrice'];
		}
	?>
<div class="marB10 BLR5 reviewCompare" style="display:block">
	<ul class="clearfix">
		<li class="clearfix">
			<div class="contentOpt">
			<select class="marB5 w150">
				<option selected="selected">Select Make</option>
				<option><?php echo $node->title; ?></option>
			</select>
			<select class="w150">
				<option selected="selected">Select Model</option>
				<option class="flip">Accord</option>
			</select>
			</div>
			<div class="content firstContent clearfix"  style="display:block">
				<div class="img">
					<strong>
					<img src="/sites/default/files/<?php echo str_replace("public://","",$sql_model['uri']);?>" alt="car" width="61" height="48" />
					</strong>
				</div>
				<p class="desc">
					<span class="title"><?php echo $node->title;?></span>
					<span class="price"><span class="WebRupee">Rs.</span> <?php if($minPricecar!='') {echo $minPricecar." - ".$maxPricecar; } else { echo "No price declared";}?></span>
				</p>
				<span class="iconRemove">&nbsp;</span>
			</div>
		</li>
		<?php
		$cnt=3;
		while($d_c=mysqli_fetch_array($sql_alternative))
			{
			$sql_image=@mysqli_fetch_array(mysqli_query("select file_managed.uri,field_data_field_model_alternatives.field_model_alternatives_nid,field_data_field_model_dashboard.field_model_dashboard_fid from file_managed,field_data_field_model_alternatives,field_data_field_model_dashboard where field_data_field_model_dashboard.field_model_dashboard_fid=file_managed.fid and field_data_field_model_dashboard.entity_id= field_data_field_model_alternatives.field_model_alternatives_nid and field_data_field_model_alternatives.field_model_alternatives_nid=".$d_c['field_model_alternatives_nid']));
			$price_resalternatives = @mysql_fetch_assoc(mysqli_query("select min(on_road_price) as minPrice, max(on_road_price) as maxPrice from team_bhp_variant_price, field_data_field_price_nr_variant, field_data_field_variant_nr_engine, field_data_field_nr_make_model where team_bhp_variant_price.city='Delhi' and team_bhp_variant_price.nid=field_data_field_price_nr_variant.entity_id and field_data_field_price_nr_variant.field_price_nr_variant_nid=field_data_field_variant_nr_engine.entity_id and field_data_field_variant_nr_engine.field_variant_nr_engine_nid=field_data_field_nr_make_model.entity_id and field_data_field_nr_make_model.field_nr_make_model_nid=".$node->nid));
	
	if($price_resalternatives['minPrice']>=100000)
		{
			$minPricealternate = to_lakh($price_resalternatives['minPrice']);
		}
	else
		{
			//$minPricealternate = $price_resalternatives['minPrice'];
		}
	if($price_resalternatives['maxPrice']>=100000)
		{
			$maxPricealternate = to_lakh($price_resalternatives['maxPrice'])." Lakh";
		}
	else
		{
			//$maxPricealternate = $price_resalternatives['maxPrice'];
		}
			?>
		<li class="num">
			<!--  <span class="n"><?php //echo $cnt;?></span>-->
			<div class="contentOpt">
				<select class="marB5 w150">
					<option selected="selected">Select Make</option>
					<option>Honda</option>
				</select>
				<select class="w150">
					<option selected="selected">Select Model</option>
					<option class="flip">Accord</option>
				</select>
			</div>
			<div class="content clearfix" style="display:none">
				<div class="img">
					<strong>
					<img src="/sites/default/files/<?php echo str_replace("public://","",$sql_image['uri']);?>" alt="car" width="61" height="48" />
					</strong>
				</div>
				<p class="desc">
					<span class="title"><?php echo $d_c['title'];?></span>
					<span class="price"><span class="WebRupee">Rs.</span> <?php if($minPricealternate!='') {echo $minPricealternate." - ".$maxPricealternate; } else { echo "No price declared";}?></span>
				</p>
				<span class="iconRemove">&nbsp;</span>
			</div>
		</li>
		<?php
			$cnt++;
			}
		?>
		<!-- <li class="num">
			<span class="n">3</span>
			<div class="contentOpt">
				<select class="marB5 w150">
					<option selected="selected">Select Make</option>
					<option>Honda</option>
				</select>
				<select class="w150">
					<option selected="selected">Select Model</option>
					<option class="flip">Accord</option>
				</select>
			</div>
			<div class="content clearfix" style="display:none">
				<div class="img"><img src="/themes/bhp/images/temp/car5.jpg" alt="car" width="61" height="48" /></div>
				<p class="desc">
					<span class="title">Honda Accord</span>
					<span class="price">6.5 - 9.2 Lakh</span>
				</p>
				<span class="iconRemove">&nbsp;</span>
			</div>
		</li>
		<li class="num">
			<span class="n">4</span>
			<div class="contentOpt">
				<select class="marB5 w150">
					<option selected="selected">Select Make</option>
					<option>Honda</option>
				</select>
				<select class="w150">
					<option selected="selected">Select Model</option>
					<option class="flip">Accord</option>
				</select>
			</div>
			<div class="content clearfix" style="display:none">
				<div class="img"><img src="/themes/bhp/images/temp/car5.jpg" alt="car" width="61" height="48" /></div>
				<p class="desc">
					<span class="title">Honda Accord</span>
					<span class="price">6.5 - 9.2 Lakh</span>
				</p>
				<span class="iconRemove">&nbsp;</span>
			</div>
		</li>
		<li class="num">
			<span class="n">5</span>
			<div class="contentOpt">
				<select class="marB5 w150">
					<option selected="selected">Select Make</option>
					<option>Honda</option>
				</select>
				<select class="w150">
					<option selected="selected">Select Model</option>
					<option class="flip">Accord</option>
				</select>
			</div>
			<div class="content clearfix" style="display:none">
				<div class="img"><img src="/themes/bhp/images/temp/car5.jpg" alt="car" width="61" height="48" /></div>
				<p class="desc">
					<span class="title">Honda Accord</span>
					<span class="price">6.5 - 9.2 Lakh</span>
				</p>
				<span class="iconRemove">&nbsp;</span>
			</div>
		</li>
		<li>
			<p class="clearfix">
				<a class="btnRight fright" id="compare">
					<span>Compare</span>
				</a>
			</p>
		</li>-->
	</ul><!-- clearfix -->
</div><!-- reviewCompare -->
<?php
	}
?>
