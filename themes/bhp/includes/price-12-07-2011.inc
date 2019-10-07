<?php
/*include_once("connect.php");
//function to convert price to lakh
function to_lakh_price($no)
{
if(intval($no)>=100000)
	{
		$res = (intval($no)/100000);
		if(strpos($res, '.')>0)
		{
			$res = round($res, 1);
		}
		return $res;
	}
else
	{
		return 0;
	}
}
if($_REQUEST['city']!='')
{
	$city = $_REQUEST['city'];
}
else
{
	$city = "Delhi";
}
$price_range = @mysql_fetch_assoc(mysqli_query("select max(on_road_price) as maxPrice, min(on_road_price) as minPrice from team_bhp_variant_price where city='".$city."'"));
$minPrice = to_lakh_price($price_range['minPrice']);
$maxPrice = to_lakh_price($price_range['maxPrice']);*/
?>
<script type="text/javascript">
var arr = new Array(1,1.5,2,2.5,3,3.5,4,4.5,5,5.5,6,6.5,7,7.5,8,8.5,9,9.5,10,11,12,13,14,15,16,17,18,19,20,25,30,35,40,45,50,55,60,70,80,90,100,125,150,200,250,300,350,400,450,500);
jQuery(document).ready(function() { 
/*jQuery( "#slider-range" ).slider({ 
	orientation: "horizontal", 
	range: true, 
	values: [  <?php //echo $minPrice; ?>,  <?php //echo $maxPrice; ?> ], 
	max:  <?php //echo $maxPrice; ?>, 
	min: <?php //echo $minPrice; ?>, 
	step: 0.5, 
	slide: function( event, ui ) { 
		jQuery("#max-amount").text(ui.values[ 1 ]+"L ");
		jQuery("#mini-amount").text(ui.values[ 0 ]+"L ");
		jQuery("#maxPrice").val(ui.values[ 1 ]);
		jQuery("#minPrice").val(ui.values[ 0 ]);
		var maxRange = jQuery("#slider-range").find("a").eq(1).attr("style").substr(6); 
		var miniRange = jQuery("#slider-range").find("a").eq(0).attr("style").substr(6); 
		jQuery("#max-amount").attr("style", "left:"+maxRange);	
		jQuery("#mini-amount").attr("style", "left:"+miniRange); 
	}, 
	change: function(event, ui) {
		var maxRange = jQuery("#slider-range").find("a").eq(1).attr("style").substr(6); 
		var miniRange = jQuery("#slider-range").find("a").eq(0).attr("style").substr(6); 
		jQuery("#max-amount").attr("style", "left:"+maxRange); 
		jQuery("#mini-amount").attr("style", "left:"+miniRange);
	}
});

if(jQuery("#slider-range").length>0) { 
	var maxRange = jQuery("#slider-range").find("a").eq(1).attr("style").substr(6); 
	var miniRange = jQuery("#slider-range").find("a").eq(0).attr("style").substr(6); 
}

jQuery("#max-amount").text(jQuery("#slider-range" ).slider( "values", 1 )+"L "); 
jQuery("#mini-amount").text( jQuery( "#slider-range" ).slider( "values", 0 )+"L "); 
jQuery("#maxPrice").val(jQuery("#slider-range" ).slider( "values", 1 )); 
jQuery("#minPrice").val(jQuery( "#slider-range" ).slider( "values", 0 )); 

if(jQuery("#slider-range").length>0) { 
	jQuery("#max-amount").attr("style", "left:"+maxRange); 
	jQuery("#mini-amount").attr("style", "left:"+miniRange);
}*/

/* Price range slider code */
var minDefaultValue = 5;
var maxDefaultValue = 20;
var minValue = 0;
var maxValue = 50;

jQuery("#slider-range").slider({range: true,min: minValue,max: maxValue,step: 1,values: [minDefaultValue, maxDefaultValue],			
	slide: function(event, ui) {
		
		if( ui.values[0] >= 41 ){
			//jQuery("#minUnit").html(" CR");
			var unit0 = " CR";
		}else{
			//jQuery("#minUnit").html(" L");
			var unit0 = " L";
		}
		
		if( ui.values[1] >= 41 ){
			//jQuery("#maxUnit").html(" CR");
			var unit1 = " CR";
		}else{
			//jQuery("#maxUnit").html(" L");
			var unit1 = " L";
		}
		
		jQuery("#mini-amount").html(getValue(ui.values[0]) + unit0);
		jQuery("#max-amount").html(getValue(ui.values[1]) + unit1);
		if(jQuery("#mini-amount").html().substr(-2)==' L')
		{
			jQuery("#minPrice").val(parseFloat(jQuery("#mini-amount").html())*100000);
		}
		else
		{
			jQuery("#minPrice").val(parseFloat(jQuery("#mini-amount").html())*10000000);
		}
		if(jQuery("#max-amount").html().substr(-2)==' L')
		{
			jQuery("#maxPrice").val(parseFloat(jQuery("#max-amount").html())*100000);
		}
		else
		{
			jQuery("#maxPrice").val(parseFloat(jQuery("#max-amount").html())*10000000);
		}
		if(jQuery(".ui-slider-handle").eq(1).attr("style").substr(-4, 3)=="00%")
		{
			var r = "98%";
		}
		else
		{
			var r = jQuery(".ui-slider-handle").eq(1).attr("style").substr(-4, 3);
		}
		jQuery("#mini-amount").css("left", jQuery(".ui-slider-handle").eq(0).attr("style").substr(-4, 3));
		jQuery("#max-amount").css("left", r);
	}
});
jQuery("#mini-amount").html("3 L");
jQuery("#max-amount").html("10 L");
jQuery("#mini-amount").css("left", jQuery(".ui-slider-handle").eq(0).attr("style").substr(-4, 3));
jQuery("#max-amount").css("left", jQuery(".ui-slider-handle").eq(1).attr("style").substr(-4, 3));
});
function getValue(val){		
	if( val == 0 ){ val = 1; }
	
	if( arr[val-1] < 100 ){			
		return arr[val-1];	
	}
	else{			
		return (arr[val-1]/100);
	}					
}
</script>
<div class="priceRangePad">
	<span id="max-amount" class="amount" style="width:45px;"></span>
	<span id="mini-amount" class="amount"></span>
	<input type="hidden" id="maxPrice" value="1000000" />
	<input type="hidden" id="minPrice" value="300000" />
	<div id="slider-range"></div>
</div><!-- priceRange -->
