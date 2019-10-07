<?php
include_once("connect.php");
$make_res = @mysqli_query("select nid, title from node where type='make' and status='1'") or die(mysql_error());
drupal_add_js('jQuery(document).ready(function() {	jQuery("#showReview").click(function() { if(jQuery("#selModel").val()!="Select Model") { location.href="?q="+jQuery("#selModel").val(); } else if(jQuery("#selMake").val()!="Select Make") { jQuery("#recent_launch").css("display", "none"); jQuery("#review_result").html("<div class=\"loader\">&nbsp;</div>"); jQuery("#review_result").css("display", "block"); jQuery.ajax({ type: "POST", url: "themes/bhp/includes/review-result.php", data: "make="+jQuery("#selMake").val(), success: function(data){ jQuery("#review_result").html(data); } }); } return false; }); jQuery("#showPrefResult").click(function() { jQuery("#recent_launch").css("display", "none"); jQuery("#review_result").html("<div class=\"loader\">&nbsp;</div>"); jQuery("#review_result").css("display", "block"); var data="city="+jQuery("#onRoad").val()+"&minPrice="+jQuery("#minPrice").val()+"&maxPrice="+jQuery("#maxPrice").val(); var bodyVals = []; jQuery("#body_style:checked").each(function() { bodyVals.push(jQuery(this).val()); }); if(bodyVals!="") {data += "&bs="+bodyVals; } var fuelVals = []; jQuery("#fuel:checked").each(function() { fuelVals.push(jQuery(this).val()); }); if(fuelVals!="") {data += "&fuel="+fuelVals; }  var transVals = []; jQuery("#trans:checked").each(function() { transVals.push(jQuery(this).val()); }); if(transVals!="") {data += "&trans="+transVals; }  jQuery.ajax({ type: "POST", url: "themes/bhp/includes/review-result-preferences.php", data: data, success: function(data){ jQuery("#review_result").html(data); } }); return false; }); }); function getModel(id){jQuery.ajax({type: "POST",url: "themes/bhp/includes/getModel.php",data: "make="+id,success: function(data){ jQuery("select#selModel").html(data);}}); } function sort(order, make, city){jQuery("#review_result").html("<div class=\"loader\">&nbsp;</div>"); jQuery("#review_result").css("display", "block"); jQuery.ajax({ type: "POST", url: "themes/bhp/includes/review-result.php", data: "order="+order+"&make="+make+"&city="+city, success: function(data){ jQuery("#review_result").html(data); } }); } function sortPreferences(city, minPrice, maxPrice, bs, fuel, trans, orderBy, order){jQuery("#review_result").html("<div class=\"loader\">&nbsp;</div>"); jQuery("#review_result").css("display", "block"); var data="city="+city+"&minPrice="+minPrice+"&maxPrice="+maxPrice+"&orderBy="+orderBy+"&order="+order; if(bs!=0) { data=data+"&bs="+bs; } if(fuel!=0) { data=data+"&fuel="+fuel; } if(trans!=0) { data=data+"&trans="+trans; } jQuery.ajax({ type: "POST", url: "themes/bhp/includes/review-result-preferences.php", data: data, success: function(data){ jQuery("#review_result").html(data); } }); } function city(make, city){jQuery("#review_result").html("<div class=\"loader\">&nbsp;</div>"); jQuery("#review_result").css("display", "block"); jQuery.ajax({ type: "POST", url: "themes/bhp/includes/review-result.php", data: "city="+city+"&make="+make, success: function(data){ jQuery("#review_result").html(data); } }); } function showVariants(id) { jQuery(".viewDropDwn").css("display", "none"); jQuery("#"+id).css("display", "block"); } function closeDiv() { jQuery(".viewDropDwn").css("display", "none"); } function changePrice(id){var url = Drupal.settings.basePath + "?q=price"; jQuery.ajax({type: "POST",url: url,data: "city="+id,success: function(data){ jQuery("div.priceRange").html(data);}}); }', 'inline');
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
				<option value="<?php echo $make_row['nid']; ?>"><?php echo $make_row['title']; ?></option>
				<?php
				}
				?>
			</select>
			<select class="marB30 w150" id="selModel">
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
		</ul><!-- tab -->
		<div class="tab_container BLR5">
			<ul class="reviewFilter clearfix">
				<li class="first">
					<h4>Price</h4>
					<label>On Road:</label>
					<select class="onRoad" id="onRoad" onchange="changePrice(this.value); return false;">
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
					<label class="clearfix"><input type="checkbox" class="styled" value="Hatchback" id="body_style"> <em>Hatchback</em></label>
					<label class="clearfix"><input type="checkbox" class="styled" value="Sedan" id="body_style"> <em>Sedan</em></label>
					<label class="clearfix"><input type="checkbox" class="styled" value="SUV / 4x4" id="body_style"> <em>SUV / 4x4</em></label>
					<label class="clearfix"><input type="checkbox" class="styled" value="MUV" id="body_style"> <em>MUV</em></label>
					<label class="clearfix"><input type="checkbox" class="styled" value="Niche" id="body_style"> <em>Niche</em></label>
				</li>
				<li>
					<h4>Fuel</h4>
					<label class="clearfix"><input type="checkbox" class="styled" value="Petrol" id="fuel"> <em>Petrol</em></label>
					<label class="clearfix"><input type="checkbox" class="styled" value="Diesel" id="fuel"> <em>Diesel</em></label>
					<label class="clearfix"><input type="checkbox" class="styled" value="Other" id="fuel"> <em>Other</em></label>
				</li>
				<li>
					<h4>Transmission</h4>
					<label class="clearfix"><input type="checkbox" class="styled" value="Manual" id="trans"> <em>Manual</em></label>
					<label class="clearfix"><input type="checkbox" class="styled" value="Auto" id="trans"> <em>Automatic</em></label>
				</li>
				<li class="last">
					<!--<span class="totalMatches"><strong>25</strong> Matches</span>-->
					<p class="btnBox clearfix">
						<a href="#" class="btnRight fright" id="showPrefResult">
							<span>Show Results</span>
						</a>
					</p>
				</li>
			</ul><!-- reviewFilter -->
		</div><!-- tab_container -->
	</div><!-- rightBox -->
</div><!-- reviewSearch -->
