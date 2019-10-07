<?php
/*if($_REQUEST['searchType']=="make")
{
session_start();
$make = $_REQUEST['make'];
}
else
{
session_start();
$_SESSION['searchType'] = "";
$_SESSION['make'] = "";
}*/
include_once("connect.php");
$make_res = @mysqli_query("select nid, title from node where type='make' and status='1' order by title") or die(mysql_error());
drupal_add_js('var isAdded =0; jQuery(document).ready(function() { jQuery(".searchby").click(function() { jQuery("span.totalMatches").html("<img src=\"/themes/bhp/images/loader.gif\" width=\"16\" height=\"16\" alt=\"loading...\" title=\"loading...\" />"); var data="city="+jQuery("#onRoad").val()+"&minPrice="+jQuery("#minPrice").val()+"&maxPrice="+jQuery("#maxPrice").val(); var bodyVals = []; jQuery("#body_style:checked").each(function() { bodyVals.push(jQuery(this).val()); }); if(bodyVals!="") {data += "&bs="+bodyVals; } var fuelVals = []; jQuery("#fuel:checked").each(function() { fuelVals.push(jQuery(this).val()); }); if(fuelVals!="") {data += "&fuel="+fuelVals; }  var transVals = []; jQuery("#trans:checked").each(function() { transVals.push(jQuery(this).val()); }); if(transVals!="") {data += "&trans="+transVals; }  jQuery.ajax({ type: "POST", url: "themes/bhp/includes/ajaxRes.php", data: data, success: function(data){ jQuery("span.totalMatches").html(data); } }); }); jQuery("#reset").click(function(){ jQuery("#searchPreference")[0].reset(); jQuery("span.checkbox").removeAttr("style"); jQuery("#slider-range").slider( "option", "values", [3, 10]); jQuery("#mini-amount").html("3 L"); jQuery("#max-amount").html("10 L"); jQuery("#mini-amount").css("left", parseInt(jQuery(".ui-slider-handle").eq(0).attr("style").substr(jQuery(".ui-slider-handle").eq(0).attr("style").indexOf("left:")+6, (jQuery(".ui-slider-handle").eq(0).attr("style").indexOf("%;")+1)-jQuery(".ui-slider-handle").eq(0).attr("style").indexOf("left:")))+"%"); jQuery("#max-amount").css("left", parseInt(jQuery(".ui-slider-handle").eq(1).attr("style").substr(jQuery(".ui-slider-handle").eq(1).attr("style").indexOf("left:")+6, (jQuery(".ui-slider-handle").eq(1).attr("style").indexOf("%;")+1)-jQuery(".ui-slider-handle").eq(1).attr("style").indexOf("left:")))+"%"); jQuery("span.totalMatches").html("<img src=\"/themes/bhp/images/loader.gif\" width=\"16\" height=\"16\" alt=\"loading...\" title=\"loading...\" />"); var data="city="+jQuery("#onRoad").val()+"&minPrice=300000&maxPrice=1000000"; var bodyVals = []; jQuery("#body_style:checked").each(function() { bodyVals.push(jQuery(this).val()); }); if(bodyVals!="") {data += "&bs="+bodyVals; } var fuelVals = []; jQuery("#fuel:checked").each(function() { fuelVals.push(jQuery(this).val()); }); if(fuelVals!="") {data += "&fuel="+fuelVals; }  var transVals = []; jQuery("#trans:checked").each(function() { transVals.push(jQuery(this).val()); }); if(transVals!="") {data += "&trans="+transVals; }  jQuery.ajax({ type: "POST", async: false, url: "themes/bhp/includes/ajaxRes.php", data: data, success: function(data){ jQuery("span.totalMatches").html(data); } }); return false; }); jQuery("#showReview").click(function() { if(jQuery("#selModel").val()!="Select Model") { location.href="?q="+jQuery("#selModel").val(); } else if(jQuery("#selMake").val()!="Select Make") { jQuery.post("?q=session", { searchType: "make", make: jQuery("#selMake").val() }); jQuery("#recent_launch").css("display", "none"); jQuery("#review_result").html("<div class=\"loader\">&nbsp;</div>"); jQuery("#review_result").css("display", "block"); var data = "make="+jQuery("#selMake").val(); data = data+"&isAdded="+isAdded; if(isAdded==0) { isAdded++; } jQuery.ajax({ type: "POST", url: "themes/bhp/includes/review-result.php", data: data, success: function(data){ jQuery("#review_result").html(data); } }); } return false; }); jQuery("#showPrefResult").click(function() { jQuery("#recent_launch").css("display", "none"); jQuery("#review_result").html("<div class=\"loader\">&nbsp;</div>"); jQuery("#review_result").css("display", "block"); var data="city="+jQuery("#onRoad").val()+"&minPrice="+jQuery("#minPrice").val()+"&maxPrice="+jQuery("#maxPrice").val(); var bodyVals = []; jQuery("#body_style:checked").each(function() { bodyVals.push(jQuery(this).val()); }); if(bodyVals!="") {data += "&bs="+bodyVals; } var fuelVals = []; jQuery("#fuel:checked").each(function() { fuelVals.push(jQuery(this).val()); }); if(fuelVals!="") {data += "&fu
el="+fuelVals; }  var transVals = []; jQuery("#trans:checked").each(function() { transVals.push(jQuery(this).val()); }); if(transVals!="") {data += "&trans="+transVals; } data = data+"&isAdded="+isAdded; if(isAdded==0) { isAdded++; } jQuery.ajax({ type: "POST", url: "themes/bhp/includes/review-result-preferences.php", data: data, success: function(data){ jQuery("#review_result").html(data); } }); return false; }); }); function getModel(id){jQuery.ajax({type: "POST",url: "themes/bhp/includes/getModel.php",data: "make="+id,success: function(data){ jQuery("select#selModel").html(data);}}); } function sort(order, make, city){jQuery("#review_result").html("<div class=\"loader\">&nbsp;</div>"); jQuery("#review_result").css("display", "block"); jQuery.ajax({ type: "POST", url: "themes/bhp/includes/review-result.php", data: "order="+order+"&make="+make+"&city="+city, success: function(data){ jQuery("#review_result").html(data); } }); } function sortPreferences(city, minPrice, maxPrice, bs, fuel, trans, orderBy, order){jQuery("#review_result").html("<div class=\"loader\">&nbsp;</div>"); jQuery("#review_result").css("display", "block"); var data="city="+city+"&minPrice="+minPrice+"&maxPrice="+maxPrice+"&orderBy="+orderBy+"&order="+order; if(bs!=0) { data=data+"&bs="+bs; } if(fuel!=0) { data=data+"&fuel="+fuel; } if(trans!=0) { data=data+"&trans="+trans; } jQuery.ajax({ type: "POST", url: "themes/bhp/includes/review-result-preferences.php", data: data, success: function(data){ jQuery("#review_result").html(data); } }); } function city(make, city){jQuery("#review_result").html("<div class=\"loader\">&nbsp;</div>"); jQuery("#review_result").css("display", "block"); jQuery.ajax({ type: "POST", url: "themes/bhp/includes/review-result.php", data: "city="+city+"&make="+make, success: function(data){ jQuery("#review_result").html(data); } }); } function showVariants(id) { jQuery(".viewDropDwn").css("display", "none"); jQuery("#"+id).css("display", "block"); } function closeDiv() { jQuery(".viewDropDwn").css("display", "none"); } /*function changePrice(id){var url = Drupal.settings.basePath + "?q=price"; jQuery.ajax({type: "POST",url: url,data: "city="+id,success: function(data){ jQuery("div.priceRange").html(data);}}); }*/ function changePrice(){ jQuery("span.totalMatches").html("<img src=\"/themes/bhp/images/loader.gif\" width=\"16\" height=\"16\" alt=\"loading...\" title=\"loading...\" />"); var data="city="+jQuery("#onRoad").val()+"&minPrice="+jQuery("#minPrice").val()+"&maxPrice="+jQuery("#maxPrice").val(); var bodyVals = []; jQuery("#body_style:checked").each(function() { bodyVals.push(jQuery(this).val()); }); if(bodyVals!="") {data += "&bs="+bodyVals; } var fuelVals = []; jQuery("#fuel:checked").each(function() { fuelVals.push(jQuery(this).val()); }); if(fuelVals!="") {data += "&fuel="+fuelVals; }  var transVals = []; jQuery("#trans:checked").each(function() { transVals.push(jQuery(this).val()); }); if(transVals!="") {data += "&trans="+transVals; }  jQuery.ajax({ type: "POST", async: false, url: "themes/bhp/includes/ajaxRes.php", data: data, success: function(data){ jQuery("span.totalMatches").html(data); } }); } function reset(){ jQuery("div#review_result").css("display", "none"); jQuery("div#recent_launch").css("display", "block"); jQuery("#searchPreference")[0].reset(); jQuery("span.checkbox").removeAttr("style"); jQuery("#slider-range").slider( "option", "values", [3, 10]); jQuery("#mini-amount").html("3 L"); jQuery("#max-amount").html("10 L"); jQuery("#mini-amount").css("left", parseInt(jQuery(".ui-slider-handle").eq(0).attr("style").substr(jQuery(".ui-slider-handle").eq(0).attr("style").indexOf("left:")+6, (jQuery(".ui-slider-handle").eq(0).attr("style").indexOf("%;")+1)-jQuery(".ui-slider-handle").eq(0).attr("style").indexOf("left:")))+"%"); jQuery("#max-amount").css("left", parseInt(jQuery(".ui-slider-handle").eq(1).attr("style").substr(jQuery(".ui-slider-handle").eq(1).attr("style").indexOf("left:")+6, (jQuery(".ui-slider-handle").eq(1).attr("style").indexOf("%;")+1)-jQuery(".ui-slider-handle").eq(1)
.attr("style").indexOf("left:")))+"%"); jQuery("span.totalMatches").html("<img src=\"/themes/bhp/images/loader.gif\" width=\"16\" height=\"16\" alt=\"loading...\" title=\"loading...\" />"); var data="city="+jQuery("#onRoad").val()+"&minPrice=300000&maxPrice=1000000"; var bodyVals = []; jQuery("#body_style:checked").each(function() { bodyVals.push(jQuery(this).val()); }); if(bodyVals!="") {data += "&bs="+bodyVals; } var fuelVals = []; jQuery("#fuel:checked").each(function() { fuelVals.push(jQuery(this).val()); }); if(fuelVals!="") {data += "&fuel="+fuelVals; }  var transVals = []; jQuery("#trans:checked").each(function() { transVals.push(jQuery(this).val()); }); if(transVals!="") {data += "&trans="+transVals; }  jQuery.ajax({ type: "POST", async: false, url: "themes/bhp/includes/ajaxRes.php", data: data, success: function(data){ jQuery("span.totalMatches").html(data); } }); return false; }', 'inline');
$mkid = '';
if($_REQUEST['make'] && isset($_REQUEST['make']) && !is_numeric($_REQUEST['make']))
{
	$sql_mk = @mysqli_query("select nid from node where type='make' and status='1' and title like '%".$_REQUEST['make']."%'");
	if(mysqli_num_rows($sql_mk)>0)
	{
		$mkid = mysql_fetch_assoc($sql_mk);
		$sql_modelforchkforlimit=@mysqli_query("SELECT node.title FROM node,field_data_field_nr_make,field_data_field_moel_launched WHERE field_data_field_nr_make.entity_id = node.nid AND field_data_field_nr_make.field_nr_make_nid=".$mkid['nid']." AND node.status =1 AND field_data_field_moel_launched.entity_id=node.nid order by field_moel_launched_value desc limit 0,7");
		if(mysqli_num_rows($sql_modelforchkforlimit)>6)
		{
?>
			<script type="text/javascript">
			jQuery(document).ready(function(){
			jQuery.post("?q=session", { searchType: "make", make: jQuery("#selMake").val() }); jQuery("#recent_launch").css("display", "none"); jQuery("#review_result").html("<div class=\"loader\">&nbsp;</div>"); jQuery("#review_result").css("display", "block"); var data = "make="+<?php echo $mkid['nid']?>; data = data+"&isAdded="+isAdded; if(isAdded==0) { isAdded++; } jQuery.ajax({ type: "POST", url: "themes/bhp/includes/review-result.php", data: data, success: function(data){ jQuery("#review_result").html(data); } });  return false;
			});
			</script>
<?php
		}
		else
		{
			$mkid = '';
		}
	}
}
?>
<div class="reviewSearch clearfix">
	<span class="revoewOr">&nbsp;</span>
	<div class="leftBox">
		<ul class="tab TLR5 clearfix">
			<li><span>Choose a Car</span></li>
		</ul><!-- tab -->
		<div class="tab_container BLR5 clearfix">
			<h4>Make & Model</h4>
			<select class="marB20 w150" onchange="getModel(this.value);return false;" id="selMake">
				<option>Select Make</option>
				<?php
				while($make_row=mysqli_fetch_array($make_res))
				{
				?>
				<option value="<?php echo $make_row['nid']; ?>"<?php if($make==$make_row['nid'] || $mkid['nid']==$make_row['nid']) {?> selected="selected"<?php } ?>><?php echo $make_row['title']; ?></option>
				<?php
				}
				?>
			</select>
			<select class="marB20 w150" id="selModel">
				<option>Select Model</option>
			</select>
			<a href="#" class="btnRight fright" id="showReview">
				<span>Show</span>
			</a>
		</div><!-- tab_container -->
	</div><!-- leftBox -->
	<div class="rightBox">
		<ul class="tab TLR5 clearfix">
			<li><span>Find Cars by Requirement</span></li>
			<li class="last reset"><a id="reset" href="#" title="reset">reset</a></li>
		</ul><!-- tab -->
		<div class="tab_container BLR5">
		<form id="searchPreference" name="searchPreference" action="#" onsubmit="return false;" method="post">
			<ul class="reviewFilter clearfix">
				<li class="first">
					<h4>Price</h4>
					<label>On Road:</label>
					<!--<select class="onRoad" id="onRoad" onchange="changePrice(this.value); return false;">-->
					<!--<select class="onRoad" id="onRoad">-->
					<select class="onRoad" id="onRoad" onchange="changePrice();">
						<optgroup label="- select city -">
						<option value="Delhi">Delhi</option>
						<option value="Mumbai">Mumbai</option>
						<option value="Bangalore">Bangalore</option>
						<option value="Kolkatta">Kolkatta</option>
						<option value="Hyderabad">Hyderabad</option>
						<option value="Chennai">Chennai</option>
						<option value="Pune">Pune</option>
						<option value="Cochin">Cochin</option>
						<option value="Others">Others</option>
					</select>
					<div class="priceRange">
						<!--<div class="priceRangePad">
							<span id="max-amount" class="amount"></span>
							<span id="mini-amount" class="amount"></span>
							<div id="slider-range"></div>
						</div> priceRange -->
						<?php include_once("price.inc"); ?>
					</div>
				</li>
				<li>
					<h4>Body Style</h4>
					<label class="clearfix"><input type="checkbox" class="styled searchby" value="Hatchback" id="body_style"> <em>Hatchback</em></label>
					<label class="clearfix"><input type="checkbox" class="styled searchby" value="Sedan" id="body_style"> <em>Sedan</em></label>
					<label class="clearfix"><input type="checkbox" class="styled searchby" value="SUV / 4x4" id="body_style"> <em>SUV / 4x4</em></label>
					<label class="clearfix"><input type="checkbox" class="styled searchby" value="MUV" id="body_style"> <em>MUV</em></label>
					<label class="clearfix"><input type="checkbox" class="styled searchby" value="Niche" id="body_style"> <em>Niche</em></label>
				</li>
				<li>
					<h4>Fuel</h4>
					<label class="clearfix"><input type="checkbox" class="styled searchby" value="Petrol" id="fuel"> <em>Petrol</em></label>
					<label class="clearfix"><input type="checkbox" class="styled searchby" value="Diesel" id="fuel"> <em>Diesel</em></label>
					<label class="clearfix"><input type="checkbox" class="styled searchby" value="Other" id="fuel"> <em>Other</em></label>
				</li>
				<li>
					<h4>Transmission</h4>
					<label class="clearfix"><input type="checkbox" class="styled searchby" value="Manual" id="trans"> <em>Manual</em></label>
					<label class="clearfix"><input type="checkbox" class="styled searchby" value="Auto" id="trans"> <em>Automatic</em></label>
				</li>
				<li class="last">
					<span class="totalMatches">
					<?php
						$totalRes = @mysqli_query("select distinct(field_data_field_nr_make.entity_id) as ModelID, node.title as title from team_bhp_variant_price, field_data_field_price_nr_variant, field_data_field_variant_nr_engine, field_data_field_nr_make_model, field_data_field_engine_fuel, field_data_field_engine_transmission, field_data_field_nr_make, field_data_field_model_body, node where city='Delhi' and on_road_price>=300000 and on_road_price<=1000000 and team_bhp_variant_price.nid=field_data_field_price_nr_variant.entity_id and field_data_field_price_nr_variant.field_price_nr_variant_nid=field_data_field_variant_nr_engine.entity_id and field_data_field_variant_nr_engine.field_variant_nr_engine_nid=field_data_field_nr_make_model.entity_id and field_data_field_nr_make_model.field_nr_make_model_nid=field_data_field_nr_make.entity_id and field_data_field_nr_make.field_nr_make_nid=node.nid order by on_road_price desc");
						if(@mysqli_num_rows($totalRes)>0)
						{
							$res = "<strong>".mysqli_num_rows($totalRes)."</strong> Match";
							if(mysqli_num_rows($totalRes)>1)
							{
							$res .= "es";
							}
							echo $res;
						}
						else
						{
							echo "<strong>0</strong> Match";
						}
					?>
					</span>
					<p class="btnBox clearfix">
						<a href="#" class="btnRight fright" id="showPrefResult">
							<span>Show Results</span>
						</a>
					</p>
				</li>
			</ul><!-- reviewFilter -->
		</form>
		</div><!-- tab_container -->
	</div><!-- rightBox -->
</div><!-- reviewSearch -->
