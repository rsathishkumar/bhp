<script type="text/javascript">
var arr = new Array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,25,30,35,40,45,50,55,60,70,80,90,100,125,150,200,250,300,350,400,450,500);
jQuery(document).ready(function() {

/* Price range slider code */
var minDefaultValue = 3;
var maxDefaultValue = 10;
var minValue = 0;
var maxValue = 41;

jQuery("#slider-range").slider({range: true,min: minValue,max: maxValue,step: 1,values: [minDefaultValue, maxDefaultValue],			
	slide: function(event, ui) {
		
		if( ui.values[0] >= 32 ){
			var unit0 = " CR";
		}else{
			var unit0 = " L";
		}
		
		if( ui.values[1] >= 32 ){
			var unit1 = " CR";
		}else{
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
		if(jQuery(".ui-slider-handle").eq(1).attr("style").substr(jQuery(".ui-slider-handle").eq(1).attr("style").indexOf("left:")+6, (jQuery(".ui-slider-handle").eq(1).attr("style").indexOf("%;")+1)-jQuery(".ui-slider-handle").eq(1).attr("style").indexOf("left:"))=="00%")
		{
			var r = "98%";
		}
		else
		{
			var r = jQuery(".ui-slider-handle").eq(1).attr("style").substr(jQuery(".ui-slider-handle").eq(1).attr("style").indexOf("left:")+6, (jQuery(".ui-slider-handle").eq(1).attr("style").indexOf("%;")+1)-jQuery(".ui-slider-handle").eq(1).attr("style").indexOf("left:"));
		}
		var l =jQuery(".ui-slider-handle").eq(0).attr("style").substr(jQuery(".ui-slider-handle").eq(0).attr("style").indexOf("left:")+6, (jQuery(".ui-slider-handle").eq(0).attr("style").indexOf("%;")+1)-jQuery(".ui-slider-handle").eq(0).attr("style").indexOf("left:"));
		jQuery("#mini-amount").css("left", parseInt(l)+"%");
		jQuery("#max-amount").css("left", parseInt(r)+"%");
	},
	stop: function(event, ui) {
	if(jQuery(".ui-slider-handle").eq(1).attr("style").substr(jQuery(".ui-slider-handle").eq(1).attr("style").indexOf("left:")+6, (jQuery(".ui-slider-handle").eq(1).attr("style").indexOf("%;")+1)-jQuery(".ui-slider-handle").eq(1).attr("style").indexOf("left:"))=="00%")
		{
			var r = "98%";
		}
		else
		{
			var r = jQuery(".ui-slider-handle").eq(1).attr("style").substr(jQuery(".ui-slider-handle").eq(1).attr("style").indexOf("left:")+6, (jQuery(".ui-slider-handle").eq(1).attr("style").indexOf("%;")+1)-jQuery(".ui-slider-handle").eq(1).attr("style").indexOf("left:"));
		}
		var l =jQuery(".ui-slider-handle").eq(0).attr("style").substr(jQuery(".ui-slider-handle").eq(0).attr("style").indexOf("left:")+6, (jQuery(".ui-slider-handle").eq(0).attr("style").indexOf("%;")+1)-jQuery(".ui-slider-handle").eq(0).attr("style").indexOf("left:"));
		jQuery("#mini-amount").css("left", parseInt(l)+"%");
		jQuery("#max-amount").css("left", parseInt(r)+"%");
		 jQuery("span.totalMatches").html("<img src=\"/themes/bhp/images/loader.gif\" width=\"16\" height=\"16\" alt=\"loading...\" title=\"loading...\" />");
		 var data="city="+jQuery("#onRoad").val()+"&minPrice="+jQuery("#minPrice").val()+"&maxPrice="+jQuery("#maxPrice").val();
		 var bodyVals = [];
		 jQuery("#body_style:checked").each(function() { bodyVals.push(jQuery(this).val()); }); if(bodyVals!="") {data += "&bs="+bodyVals; }
		 var fuelVals = []; jQuery("#fuel:checked").each(function() { fuelVals.push(jQuery(this).val()); }); if(fuelVals!="") {data += "&fuel="+fuelVals; }
		 var transVals = []; jQuery("#trans:checked").each(function() { transVals.push(jQuery(this).val()); }); if(transVals!="") {data += "&trans="+transVals; }  jQuery.ajax({ type: "POST", async: false, url: "themes/bhp/includes/ajaxRes.php", data: data, success: function(data){ jQuery("span.totalMatches").html(data); } });
	}
});
jQuery("#mini-amount").html("3 L");
jQuery("#max-amount").html("10 L");
var le = jQuery(".ui-slider-handle").eq(0).attr("style").substr(jQuery(".ui-slider-handle").eq(0).attr("style").indexOf("left:")+6, (jQuery(".ui-slider-handle").eq(0).attr("style").indexOf("%;")+1)-jQuery(".ui-slider-handle").eq(0).attr("style").indexOf("left:"));
var ri = jQuery(".ui-slider-handle").eq(1).attr("style").substr(jQuery(".ui-slider-handle").eq(1).attr("style").indexOf("left:")+6, (jQuery(".ui-slider-handle").eq(1).attr("style").indexOf("%;")+1)-jQuery(".ui-slider-handle").eq(1).attr("style").indexOf("left:"));
le = parseInt(le)+"%";
ri = parseInt(ri)+"%";
jQuery("#mini-amount").css("left", le);
jQuery("#max-amount").css("left", ri);
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
