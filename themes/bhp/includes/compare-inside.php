<?php
include_once("connect.php");
$make_res = @mysqli_query("select nid, title from node where type='make' order by title") or die(mysql_error());
$contentOpt = '<div class="contentOpt" style="display:block"><select class="marB5 w150" onchange="getModelCompare(this.value);return false;" id="selMakeCompare"><option selected="selected">Select Make</option>';
while($make_row=mysqli_fetch_array($make_res))
{
$contentOpt .= '<option value="'.$make_row['nid'].'">'.$make_row['title'].'</option>';
}
$contentOpt .= '</select><select class="w150" id="selModelCompare" onchange="getCar(this); return false;"><option>Select Model</option></select></div>';
drupal_add_js('if(screen.width<="1024") { var is1024 = 1; var totalLi = 4; } else { var is1024 = 0; var totalLi = 5; } jQuery(function(){ if(is1024==1){ jQuery("ul#compareUL li.num:last").find("span.n").text("pls upgrage ur screen resolutoin"); jQuery("ul#compareUL li.num:last").attr("class", "inst"); } }); function getModelCompare(id){jQuery("select#selModelCompare").attr("disabled", "disabled"); jQuery.ajax({type: "POST",url: "/themes/bhp/includes/getModel.php",data: "make="+id,success: function(data){ jQuery("select#selModelCompare").html(data); jQuery("select#selModelCompare").removeAttr("disabled"); }}); } function getCar(element){ if(jQuery("div#"+element.options[element.selectedIndex].getAttribute("rel")).length>0) { jQuery("div.compareMesgInside").css("display", "block"); } else { jQuery("div.compareMesgInside").css("display", "none"); jQuery.ajax({type: "POST",url: "/themes/bhp/includes/compareCar.php",data: "model="+element.options[element.selectedIndex].getAttribute("rel"),success: function(data){ $next=jQuery(element).closest("li.clearfix").next("li.num"); jQuery("select#selModelCompare").closest("li").html(data); $next.html(\''.$contentOpt.'\').attr("class", "clearfix"); }}); } } function removeCar(id) { jQuery("div.compareMesgInside").css("display", "none"); jQuery(id).closest("li.clearfix").remove(); if(is1024==0){jQuery("li#compareLi").before("<li class=\'num\'><span class=\'n\'>5</span></li>");} else {jQuery("li.inst").before("<li class=\'num\'><span class=\'n\'>4</span></li>");}  if(jQuery("ul#compareUL").find("select#selMakeCompare").length==0) { jQuery("ul#compareUL li.num").html(\''.$contentOpt.'\'); jQuery("ul#compareUL li.num").attr("class", "clearfix"); } else { jQuery("ul#compareUL li:not(\'.inst\')").each(function(index){ if(jQuery(this).hasClass("num")) { jQuery(this).find("span.n").text(index+1); } }); } } function compare() { if(jQuery("ul#compareUL li.clearfix div.content").length>1) { var ids=""; jQuery("ul#compareUL li.clearfix div.content").each(function(index){ids += jQuery(this).attr("rel")+"/"; }); window.location = "/?q=compare="+ids.substr(0,ids.length-1); } } function getCarID(id){ if(jQuery("ul#compareUL li.clearfix div.content").length<totalLi) { if(jQuery("div#"+id).length>0) { jQuery("div.compareMesgInside p").text("You have already added that car. Please choose another car."); jQuery("div.compareMesgInside").css("display", "block"); } else { jQuery("div.compareMesgInside").css("display", "none"); jQuery.ajax({ type: "POST", url: "/themes/bhp/includes/compareCar.php", data: "model="+id, success: function(data){$next=jQuery("li.num:first"); jQuery("ul#compareUL li.clearfix:last").html(data); $next.html(\''.$contentOpt.'\').attr("class", "clearfix"); jQuery(".reviewCompare").css("display","block"); } }); } } else { jQuery("div.compareMesgInside p").text("You can only compare "+totalLi+" cars at a time. Please remove one from your current selection."); jQuery("div.compareMesgInside").css("display", "block"); } }  function compare() { if(jQuery("ul#compareUL li.clearfix div.content").length>0) { var ids=""; jQuery("ul#compareUL li.clearfix div.content").each(function(index){ids += jQuery(this).attr("rel")+"/"; }); window.location = "/?q=compare&models="+ids.substr(0,ids.length-1); } }', 'inline');
?>
<!--<div class="marB10 BLR5 reviewCompare">
	<ul class="clearfix" id="compareUL">-->
		<li class="clearfix">
			<?php echo $contentOpt; ?>
		</li>
		<li class="num">
			<span class="n">3</span>
		</li>
		<li class="num">
			<span class="n">4</span>
		</li>
		<li class="num">
			<span class="n">5</span>
		</li>
		<li id="compareLi">
			<p class="clearfix">
				<a class="btnRight fright" href="#" id="compare" onclick="compare(); return false;">
					<span>Compare</span>
				</a>
			</p>
		</li>
	<!--</ul>
</div>-->
