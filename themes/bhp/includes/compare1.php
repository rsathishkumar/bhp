<?php
session_start();
if($_REQUEST['q']=="compare")
{
  	$modle_name=substr($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'],strpos("http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'],"&models=")+1,strlen($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']));
	$ids='';
	$model_array=explode("/",$modle_name);
	for($m=0;$m<count($model_array);$m++)
	{
		 $sql_model_ids=@mysqli_fetch_array(mysqli_query("select source from url_alias where alias='review/".$model_array[$m]."'"));
		$ids.=str_replace("node/","",$sql_model_ids['source'])."/";
	}
	//$ids=substr($ids,0,-1);
	//echo $ids;
	if($_SESSION['searchType']!="")
	{
		$ses = "&searchType=".$_SESSION['searchType'];
	}
	if($_SESSION['make']!="")
	{
		$ses .= "&make=".$_SESSION['make'];
	}
	if(substr($ids, -1)=="/")
	{
		$ids = explode("/", substr($ids, 0, -1));
	}
	else
	{
		$ids = explode("/", $ids);
	}
	$id = @array_unique($ids);
	$s = count($id);
	$naimgpath = "<img src='/themes/bhp/images/cross.png' />";
	include_once("connect.php");
	$qry = "select nid, title from node where type='make' order by title";
	$make_res = @mysqli_query($qry) or die(mysql_error());
?>
<style type="text/css">
		.compareHideShow .elementHeadFix, .elementHeadFix {
			position:fixed;
			top:0;
			background-color:#fff;
			cursor:default;
		}
		.compareHideShow .elementHeadFix a {
			cursor:default;
		}
	</style>
	
<script type="text/javascript">	
	
	var ownerPos, speciPos, featuPos, headPos, titlePos, enginePos;
	
	$(function(){
		
		var titleHeight = $("#compareTitle").height();
		var engineHeight = $("#compareEngine").height();
		var variantHeight = $("#compareVariant").height();
		
		var rowHeight2 = titleHeight+engineHeight;
		var rowHeight3 = titleHeight+engineHeight+variantHeight;
		
		$("#compareTitle").css("height", titleHeight);
		$("#compareEngine").css("height", engineHeight);
		$("#compareVariant").css("height", variantHeight);
		
		var compareTitle = $("#compareTitle");
		var compareEngine = $("#compareEngine");
		
		var ownerHead = $(".ownerHead");
  		var speciHead = $(".speciHead");
  		var featuHead = $(".featuHead");
  		var mainHead = $("head");
		function loadFloat(){
  			
  			
  			headPos = mainHead.offset();
  			ownerPos = ownerHead.offset();
			speciPos = speciHead.offset();
			featuPos = featuHead.offset();
			
			titlePos = compareTitle.offset();
			enginePos = compareEngine.offset();
			
			//alert(headPos.top+" "+titlePos.top); 
			
			if (headPos.top>=titlePos.top){
				
			 	$("#compareTitle table").addClass("elementHeadFix");
				$("#compareTitle table").css({
					position:"fixed",
					top:0,
					zIndex:10
				});
			}else {
				$("#compareTitle table").removeClass("elementHeadFix");
				$("#compareTitle table").css("position","static");
			}
			
			if (headPos.top>=enginePos.top-titleHeight){
  				$("#compareEngine table").addClass("elementHeadFix");
				$("#compareEngine table").css({
					position:"fixed",
					top:titleHeight,
					zIndex:10
				});
				$("#compareVariant table").addClass("elementHeadFix");
				$("#compareVariant table").css({
					position:"fixed",
					top:rowHeight2,
					zIndex:10
				});
			}else {
				$("#compareEngine table").removeClass("elementHeadFix");
				$("#compareEngine table").css("position","static");
				$("#compareVariant table").removeClass("elementHeadFix");
				$("#compareVariant table").css("position","static");
			}
			
  			if (headPos.top>=ownerPos.top-rowHeight3){
  				$(".ownerHead h4").addClass("elementHeadFix");
				$(".ownerHead h4").css({
					position:"fixed",
					top:rowHeight3,
					zIndex:10
				});
				$(".ownerHead").next("div").css("paddingTop","48px");
			}else {
				$(".ownerHead h4").removeClass("elementHeadFix");
				$(".ownerHead h4").css("position","static");
				$(".ownerHead").next("div").css("paddingTop","0");
			}
			
			if (headPos.top>=(speciPos.top)-(48+rowHeight3)){
				$(".speciHead h4").addClass("elementHeadFix");
				$(".speciHead h4").css({
					position:"fixed",
					top:48+rowHeight3,
					zIndex:15
				});
				$(".speciHead").next("div").css("paddingTop","48px");
			}else {
				$(".speciHead h4").removeClass("elementHeadFix");
				$(".speciHead h4").css("position","static");
				$(".speciHead").next("div").css("paddingTop","0");
			}
			
			if (headPos.top>=(featuPos.top)-(96+rowHeight3)){
				$(".featuHead h4").addClass("elementHeadFix");
				$(".featuHead h4").css({
					position:"fixed",
					top:96+rowHeight3,
					zIndex:20
				});
				$(".featuHead").next("div").css("paddingTop","48px");
			}else {
				$(".featuHead h4").removeClass("elementHeadFix");
				$(".featuHead h4").css("position","static");
				$(".featuHead").next("div").css("paddingTop","0");
			}
  		}
  		
  		$(window).scroll(function(){
  			loadFloat();
  			
		});
		
		$(".compareHideShow .accTitle").click(function(){
			if ($(this).find("h4").css("position")=="fixed") {
				if($(this).hasClass("ownerHead")){
					$thisEleTop = 104;
				} else if($(this).hasClass("speciHead")){
					$thisEleTop = 152;
				} else if($(this).hasClass("featuHead")){
					$thisEleTop = 200;
				}
				
				$thisEle1 = $(this);
				
				if ($(this).next("div").css("display")=="none") {
					
					$(this).find("h4").removeClass("ui-state-active");
					$(this).next("div").fadeIn(100, function(){
						ownerPos = ownerHead.offset();
						speciPos = speciHead.offset();
						featuPos = featuHead.offset();
						$('html, body').animate({scrollTop: $($thisEle1.next("div")).offset().top-$thisEleTop}, 600);
					});
					
				}else {
					
					if($(this).next(".accTitle").find("h4").css("position")=="fixed" || $(this).next().next(".accTitle").find("h4").css("position")=="fixed"){
						$('html, body').animate({scrollTop: $($(this).next("div")).offset().top-$thisEleTop}, 600);
						//alert();
						
					}else {
					//alert('1');
						$(this).find("h4").addClass("ui-state-active");
						$(this).next("div").fadeOut(100, function(){
							ownerPos = ownerHead.offset();
							speciPos = speciHead.offset();
							featuPos = featuHead.offset();
							loadFloat();
							$nextEle1 = $(this).next(".accTitle");
							if($nextEle1.hasClass("ownerHead")){
								$nextEleTop = 0;
								$('html, body').animate({scrollTop: $nextEle1.next("div").offset().top-1}, 100);
							} else if($nextEle1.hasClass("speciHead")){
								$nextEleTop = 96;
								$('html, body').animate({scrollTop: $nextEle1.next("div").offset().top-1}, 100);
							} else if($nextEle1.hasClass("featuHead")){
								$nextEleTop = 144;
							}
							
							//$('html, body').animate({scrollTop: $($(this).next().next("div")).offset().top}, 600);
						});
						
					}
				
				}
			}else {
				if ($(this).next("div").css("display")=="none") {
					$(this).find("h4").removeClass("ui-state-active");
					$(this).next("div").fadeIn(100, function(){
						ownerPos = ownerHead.position();
						speciPos = speciHead.position();
						featuPos = featuHead.position();
						
					});
				}else {
					//alert('2');
					$(this).find("h4").addClass("ui-state-active");
					$(this).next("div").fadeOut(100, function(){
						ownerPos = ownerHead.offset();
						speciPos = speciHead.offset();
						featuPos = featuHead.offset();
					});
				}
				
			}
			return false;
		});
		
		
		$(".carListing li").hover(
		function(){
				$(this).addClass("hover");
			},
		function(){
				$(this).removeClass("hover");
				}
		);
		
		/*
		var s = <?php echo $_REQUEST['s']; ?>;
		if(s>1)
		{
		$('.speciTable tr').find('td:gt('+<?php echo $_REQUEST['s']; ?>+')').html('&nbsp;');
		$('.speciTable tr:first').find('td').eq(<?php echo $_REQUEST['s']+1; ?>).html('<div class="carDetails"><h3>Add Car</h3><div class="optionsBox"><select class="w140 marB15"><option selected="selected">Select Make</option><option>Mercedes</option></select><select class="w140"><option selected="selected">Select Model</option><option class="flip">C- Class</option></select></div><div class="clearfix"><a class="fright btnRight" href="#" onclick="addCar(this); return false;"><span>Add Car</span></a></div></div>');
		}
		
		$('.removeBtn').click(function(){
			var index = $('table.speciTable tr td').index($(this).closest('td'));
			$('.speciTable tr').each(function(){
				$(this).find('td').eq(index).html('&nbsp;');
			});
			if($('.speciTable tr td').eq(index+1).find('.optionsBox').length>0)
			{
			$('.speciTable tr td').eq(index+1).find('.carDetails').html('&nbsp;');
			}
			$('.speciTable tr td').eq(index).html('<div class="carDetails"><h3>Add Car</h3><div class="optionsBox"><select class="w140 marB15"><option selected="selected">Select Make</option><option>Mercedes</option></select><select class="w140"><option selected="selected">Select Model</option><option class="flip">C- Class</option></select></div><div class="clearfix"><a class="fright btnRight" href="#" onclick="addCar(this); return false;"><span>Add Car</span></a></div></div>');
			return false;
		});
		*/
		
	}); 
	</script>
<div class="article">
	<div class="padL20 marB5 clearfix">
		<h1 class="fleft w480">Compare Cars</h1>
			<?php include ("common/share.php") ?>
	</div>
	<div class="roundAll5 marB10 compareContent">
	<div id="compareTitle">
								<table class="speciTable compareTable tblBborder" id="car_title">
									<tr>
										<td class="blankTd">&nbsp;</td>
										<?php
										$flg = true;
										for($i=0; $i<5; $i++)
										{
											if($i<$s)
											{
												$sql_model=@mysqli_query("SELECT node.title,node.nid, field_data_field_nr_make.field_nr_make_nid FROM node,  field_data_field_nr_make WHERE field_data_field_nr_make.entity_id = node.nid AND node.status =1 AND  node.nid=".$id[$i]) or die(mysql_error());
												$data_model=mysqli_fetch_array($sql_model);
										?>
										<td>
											<div class="carDetails">
												<h3><?php echo $data_model['title'];?></h3>
											</div>
										</td>
										<?php
											}
											else
											{
												if($flg==true)
												{
												$txt = '<div class="carDetails"><h3>Add Car</h3></div>';
												}
												else
												{
												$txt = "&nbsp;" ;
												}
												$flg = false;
											?>
											<td><?php echo $txt;?></td>
											<?php
											}
										}										
										?>
										
									</tr>
								</table>
							</div>
		<table class="speciTable compareTable tblBborder" id="car_details">
			<tr>
				<td class="blankTd">&nbsp;</td>
				<?php
$contentOpt = '<div class="carDetails search"><div class="optionsBox"><div class="contentOpt" style="display:block"><select class="w160 marB15" onchange="getModelCompare(this.value);return false;" id="selMakeCompare"><option selected="selected">Select Make</option>';
while($make_row=mysqli_fetch_array($make_res))
{
	$contentOpt .= '<option value="'.$make_row['nid'].'">'.$make_row['title'].'</option>';
}
$contentOpt .= '</select><select class="w160" id="selModelCompare" onchange="setID(this); return false;"><option>Select Model</option></select></div></div><div class="clearfix"><a onclick="return false;" href="#" class="fright btnRight" id="addCar"><span>Add Car</span></a></div></div>';

drupal_add_js('if(screen.width<="1024") { var is1024 = 1; var totalLi = 4; } else { var is1024 = 0; var totalLi = 5; } var ownerPos; var speciPos; var featuPos; jQuery(function(){ var ownerHead = jQuery(".ownerHead"); var speciHead = jQuery(".speciHead"); var featuHead = jQuery(".featuHead"); ownerPos = ownerHead.offset(); speciPos = speciHead.offset(); featuPos = featuHead.offset(); jQuery(".infoIcon").css("zIndex","5"); jQuery(window).scroll(function() { var mainHead = jQuery("head"); var headPos = mainHead.offset(); if (headPos.top>=ownerPos.top){ jQuery(".ownerHead h4").addClass("elementHeadFix"); jQuery(".ownerHead h4").css({ position:"fixed", top:0, zIndex:10 }); jQuery(".ownerHead").next("div").css("paddingTop","48px"); }else { jQuery(".ownerHead h4").removeClass("elementHeadFix"); jQuery(".ownerHead h4").css("position","static"); jQuery(".ownerHead").next("div").css("paddingTop","0"); } if (headPos.top>=(speciPos.top)-48){ jQuery(".speciHead h4").addClass("elementHeadFix"); jQuery(".speciHead h4").css({ position:"fixed", top:48, zIndex:15 }); jQuery(".speciHead").next("div").css("paddingTop","48px"); }else { jQuery(".speciHead h4").removeClass("elementHeadFix"); jQuery(".speciHead h4").css("position","static"); jQuery(".speciHead").next("div").css("paddingTop","0"); } if (headPos.top>=(featuPos.top)-96){ jQuery(".featuHead h4").addClass("elementHeadFix"); jQuery(".featuHead h4").css({ position:"fixed", top:96, zIndex:20 }); jQuery(".featuHead").next("div").css("paddingTop","48px"); }else { jQuery(".featuHead h4").removeClass("elementHeadFix"); jQuery(".featuHead h4").css("position","static"); jQuery(".featuHead").next("div").css("paddingTop","0"); } }); if(is1024==1) { jQuery("td[colspan=\'6\']").each(function(index){ jQuery(this).attr("colspan", "5"); });jQuery("body").addClass("comparePage1024"); jQuery("table.compareTable tr").each(function(index){ jQuery(this).find("td").eq(5).remove();}); } jQuery(".infoIcon").hover(function(){ jQuery(".infoIcon").css("zIndex","5"); jQuery(this).css("zIndex","7"); }); }); function removeTD(id) {
var i = jQuery("table#car_details tr:first td").index(jQuery(id).closest("td")); 
jQuery("#car_title tr").eq(0).find("td").eq(i).remove();
jQuery("#car_title tr").eq(0).append("<td></td>");
var j = 0;
jQuery("table#car_details tr").each(function(index){ 

jQuery(this).find("td").eq(i).remove(); if(jQuery(this).find("td").length>0) { 

if(jQuery("div.search").length==0) { if(j==0) {
jQuery(this).append(\'<td>'.$contentOpt.'</td>\'); jQuery("#car_title tr:first").find("td").eq(5).html("<div class=\"carDetails\"><h3>Add Car</h3></div>");} else {jQuery(this).append("<td></td>");} } else { 
var flg = true ;
for(var k = jQuery("table#car_details tr:first td").index(jQuery("div.optionsBox").closest("td"));k<=5;k++)
{
	if(flg==true) 
	{
		jQuery("#car_title tr:first").find("td").eq(jQuery("table#car_details tr:first td").index(jQuery("div.optionsBox").closest("td"))).html("<div class=\"carDetails\"><h3>Add Car</h3></div>");
		flg = false;
	}
	else
	{
		jQuery("#car_title tr:first").find("td").eq(k).html("<div class=\"carDetails\"><h3></h3></div>");
	}
}

jQuery(this).append("<td></td>");} } j++; }); 


jQuery("#other-details tr").eq(0).find("td").eq(i).remove();
jQuery("#other-details tr").eq(0).append("<td></td>");
jQuery("#other-details tr").eq(1).find("td").eq(i).remove();
jQuery("#other-details tr").eq(1).append("<td></td>");
jQuery("#other-details tr").eq(2).find("td").eq(i).remove();
jQuery("#other-details tr").eq(2).append("<td></td>");
jQuery("#other-details tr").eq(3).find("td").eq(i).remove();
jQuery("#other-details tr").eq(3).append("<td></td>");
jQuery("#compareEngine").find("table tr td").eq(i).remove();
jQuery("#compareEngine").find("table tr").append("<td></td>");
jQuery("#compareVariant table.compareTable tr").eq(0).find("td").eq(i).remove();
jQuery("#compareVariant table.compareTable tr").eq(0).append("<td></td>");
jQuery("#ownership tr").eq(0).find("td").eq(i).remove();
jQuery("#ownership tr").eq(0).append("<td></td>");
jQuery("#ownership tr").eq(1).find("td").eq(i).remove();
jQuery("#ownership tr").eq(1).append("<td></td>");
jQuery("#ownership tr").eq(2).find("td").eq(i).remove();
jQuery("#ownership tr").eq(2).append("<td></td>");
jQuery("#ownership tr").eq(3).find("td").eq(i).remove();
jQuery("#ownership tr").eq(3).append("<td></td>");
jQuery("#ownership tr").eq(4).find("td").eq(i).remove();
jQuery("#ownership tr").eq(4).append("<td></td>");
jQuery("#ownership tr").eq(5).find("td").eq(i).remove();
jQuery("#ownership tr").eq(5).append("<td></td>");
jQuery("#spec-dimension tr").eq(1).find("td").eq(i).remove();
jQuery("#spec-dimension tr").eq(1).append("<td></td>");
jQuery("#spec-dimension tr").eq(2).find("td").eq(i).remove();
jQuery("#spec-dimension tr").eq(2).append("<td></td>");
jQuery("#spec-dimension tr").eq(3).find("td").eq(i).remove();
jQuery("#spec-dimension tr").eq(3).append("<td></td>");
jQuery("#spec-dimension tr").eq(4).find("td").eq(i).remove();
jQuery("#spec-dimension tr").eq(4).append("<td></td>");
jQuery("#spec-dimension tr").eq(5).find("td").eq(i).remove();
jQuery("#spec-dimension tr").eq(5).append("<td></td>");
jQuery("#spec-dimension tr").eq(6).find("td").eq(i).remove();
jQuery("#spec-dimension tr").eq(6).append("<td></td>");
jQuery("#spec-dimension tr").eq(7).find("td").eq(i).remove();
jQuery("#spec-dimension tr").eq(7).append("<td></td>");
jQuery("#spec-dimension tr").eq(8).find("td").eq(i).remove();
jQuery("#spec-dimension tr").eq(8).append("<td></td>");
jQuery("#spec-dimension tr").eq(9).find("td").eq(i).remove();
jQuery("#spec-dimension tr").eq(9).append("<td></td>");
jQuery("#engine-type tr").eq(1).find("td").eq(i).remove();
jQuery("#engine-type tr").eq(1).append("<td></td>");
jQuery("#engine-type tr").eq(2).find("td").eq(i).remove();
jQuery("#engine-type tr").eq(2).append("<td></td>");
jQuery("#engine-type tr").eq(3).find("td").eq(i).remove();
jQuery("#engine-type tr").eq(3).append("<td></td>");
jQuery("#engine-type tr").eq(4).find("td").eq(i).remove();
jQuery("#engine-type tr").eq(4).append("<td></td>");
jQuery("#engine-type tr").eq(5).find("td").eq(i).remove();
jQuery("#engine-type tr").eq(5).append("<td></td>");
jQuery("#engine-type tr").eq(6).find("td").eq(i).remove();
jQuery("#engine-type tr").eq(6).append("<td></td>");
jQuery("#engine-type tr").eq(7).find("td").eq(i).remove();
jQuery("#engine-type tr").eq(7).append("<td></td>");
jQuery("#engine-type tr").eq(8).find("td").eq(i).remove();
jQuery("#engine-type tr").eq(8).append("<td></td>");
jQuery("#engine-type tr").eq(9).find("td").eq(i).remove();
jQuery("#engine-type tr").eq(9).append("<td></td>");
jQuery("#engine-type tr").eq(10).find("td").eq(i).remove();
jQuery("#engine-type tr").eq(10).append("<td></td>");
jQuery("#engine-type tr").eq(11).find("td").eq(i).remove();
jQuery("#engine-type tr").eq(11).append("<td></td>");
jQuery("#engine-type tr").eq(12).find("td").eq(i).remove();
jQuery("#engine-type tr").eq(12).append("<td></td>");
jQuery("#engine-type tr").eq(13).find("td").eq(i).remove();
jQuery("#engine-type tr").eq(13).append("<td></td>");
jQuery("#engine-type tr").eq(14).find("td").eq(i).remove();
jQuery("#engine-type tr").eq(14).append("<td></td>");
jQuery("#engine-type tr").eq(15).find("td").eq(i).remove();
jQuery("#engine-type tr").eq(15).append("<td></td>");
jQuery("#spec-suspension tr").eq(1).find("td").eq(i).remove();
jQuery("#spec-suspension tr").eq(1).append("<td></td>");
jQuery("#spec-suspension tr").eq(2).find("td").eq(i).remove();
jQuery("#spec-suspension tr").eq(2).append("<td></td>");
jQuery("#spec-suspension tr").eq(3).find("td").eq(i).remove();
jQuery("#spec-suspension tr").eq(3).append("<td></td>");
jQuery("#spec-suspension tr").eq(4).find("td").eq(i).remove();
jQuery("#spec-suspension tr").eq(4).append("<td></td>");
jQuery("#spec-suspension tr").eq(5).find("td").eq(i).remove();
jQuery("#spec-suspension tr").eq(5).append("<td></td>");
jQuery("#features-safety tr").eq(1).find("td").eq(i).remove();
jQuery("#features-safety tr").eq(1).append("<td></td>");
jQuery("#features-safety tr").eq(2).find("td").eq(i).remove();
jQuery("#features-safety tr").eq(2).append("<td></td>");
jQuery("#features-safety tr").eq(3).find("td").eq(i).remove();
jQuery("#features-safety tr").eq(3).append("<td></td>");
jQuery("#features-safety tr").eq(4).find("td").eq(i).remove();
jQuery("#features-safety tr").eq(4).append("<td></td>");
jQuery("#features-safety tr").eq(5).find("td").eq(i).remove();
jQuery("#features-safety tr").eq(5).append("<td></td>");
jQuery("#features-safety tr").eq(6).find("td").eq(i).remove();
jQuery("#features-safety tr").eq(6).append("<td></td>");
jQuery("#features-safety tr").eq(7).find("td").eq(i).remove();
jQuery("#features-safety tr").eq(7).append("<td></td>");
jQuery("#features-safety tr").eq(8).find("td").eq(i).remove();
jQuery("#features-safety tr").eq(8).append("<td></td>");
jQuery("#features-safety tr").eq(9).find("td").eq(i).remove();
jQuery("#features-safety tr").eq(9).append("<td></td>");
jQuery("#features-safety tr").eq(10).find("td").eq(i).remove();
jQuery("#features-safety tr").eq(10).append("<td></td>");
jQuery("#features-enhancements tr").eq(1).find("td").eq(i).remove();
jQuery("#features-enhancements tr").eq(1).append("<td></td>");
jQuery("#features-enhancements tr").eq(2).find("td").eq(i).remove();
jQuery("#features-enhancements tr").eq(2).append("<td></td>");
jQuery("#features-enhancements tr").eq(3).find("td").eq(i).remove();
jQuery("#features-enhancements tr").eq(3).append("<td></td>");
jQuery("#features-enhancements tr").eq(4).find("td").eq(i).remove();
jQuery("#features-enhancements tr").eq(4).append("<td></td>");
jQuery("#features-enhancements tr").eq(5).find("td").eq(i).remove();
jQuery("#features-enhancements tr").eq(5).append("<td></td>");
jQuery("#features-enhancements tr").eq(6).find("td").eq(i).remove();
jQuery("#features-enhancements tr").eq(6).append("<td></td>");
jQuery("#features-enhancements tr").eq(7).find("td").eq(i).remove();
jQuery("#features-enhancements tr").eq(7).append("<td></td>");
jQuery("#features-enhancements tr").eq(8).find("td").eq(i).remove();
jQuery("#features-enhancements tr").eq(8).append("<td></td>");
jQuery("#features-enhancements tr").eq(9).find("td").eq(i).remove();
jQuery("#features-enhancements tr").eq(9).append("<td></td>");
jQuery("#features-enhancements tr").eq(10).find("td").eq(i).remove();
jQuery("#features-enhancements tr").eq(10).append("<td></td>");
jQuery("#features-enhancements tr").eq(11).find("td").eq(i).remove();
jQuery("#features-enhancements tr").eq(11).append("<td></td>");
jQuery("#features-convinience tr").eq(1).find("td").eq(i).remove();
jQuery("#features-convinience tr").eq(1).append("<td></td>");
jQuery("#features-convinience tr").eq(2).find("td").eq(i).remove();
jQuery("#features-convinience tr").eq(2).append("<td></td>");
jQuery("#features-convinience tr").eq(3).find("td").eq(i).remove();
jQuery("#features-convinience tr").eq(3).append("<td></td>");
jQuery("#features-convinience tr").eq(4).find("td").eq(i).remove();
jQuery("#features-convinience tr").eq(4).append("<td></td>");
jQuery("#features-convinience tr").eq(5).find("td").eq(i).remove();
jQuery("#features-convinience tr").eq(5).append("<td></td>");
jQuery("#features-convinience tr").eq(6).find("td").eq(i).remove();
jQuery("#features-convinience tr").eq(6).append("<td></td>");
jQuery("#features-convinience tr").eq(7).find("td").eq(i).remove();
jQuery("#features-convinience tr").eq(7).append("<td></td>");
jQuery("#features-convinience tr").eq(8).find("td").eq(i).remove();
jQuery("#features-convinience tr").eq(8).append("<td></td>");
jQuery("#features-convinience tr").eq(9).find("td").eq(i).remove();
jQuery("#features-convinience tr").eq(9).append("<td></td>");
jQuery("#features-convinience tr").eq(10).find("td").eq(i).remove();
jQuery("#features-convinience tr").eq(10).append("<td></td>");
jQuery("#features-entertainment tr").eq(1).find("td").eq(i).remove();
jQuery("#features-entertainment tr").eq(1).append("<td></td>");
jQuery("#features-entertainment tr").eq(2).find("td").eq(i).remove();
jQuery("#features-entertainment tr").eq(2).append("<td></td>");
jQuery("#features-entertainment tr").eq(3).find("td").eq(i).remove();
jQuery("#features-entertainment tr").eq(3).append("<td></td>");
jQuery("#features-entertainment tr").eq(4).find("td").eq(i).remove();
jQuery("#features-entertainment tr").eq(4).append("<td></td>");
jQuery("#features-entertainment tr").eq(5).find("td").eq(i).remove();
jQuery("#features-entertainment tr").eq(5).append("<td></td>");
jQuery("#features-entertainment tr").eq(6).find("td").eq(i).remove();
jQuery("#features-entertainment tr").eq(6).append("<td></td>");
jQuery("#features-entertainment tr").eq(7).find("td").eq(i).remove();
jQuery("#features-entertainment tr").eq(7).append("<td></td>");
jQuery("#features-entertainment tr").eq(8).find("td").eq(i).remove();
jQuery("#features-entertainment tr").eq(8).append("<td></td>");
} function changeByEngine(id, engine, model) {var i = jQuery("#compareEngine table.compareTable tr").eq(0).find("td").index(jQuery(id).closest("td")); 
jQuery.getJSON("/themes/bhp/includes/getCompare.php", {model: model, engine:engine, city:jQuery("#city").val()}, function(json){ 
jQuery("#compareVariant table.compareTable tr").eq(0).find("td").eq(i).html(json.variant); 
jQuery("#other-details tr").eq(0).find("td").eq(i).html(json.price); 
jQuery("#spec-dimension tr").eq(0).find("td").eq(i).html(json.length); jQuery("#spec-dimension tr").eq(1).find("td").eq(i).html(json.wheel); jQuery("#spec-dimension tr").eq(2).find("td").eq(i).html(json.track); jQuery("#spec-dimension tr").eq(3).find("td").eq(i).html(json.kerb); jQuery("#spec-dimension tr").eq(4).find("td").eq(i).html(json.ground); jQuery("#spec-dimension tr").eq(5).find("td").eq(i).html(json.radius); jQuery("#spec-dimension tr").eq(6).find("td").eq(i).html(json.seatCapacity); jQuery("#spec-dimension tr").eq(7).find("td").eq(i).html(json.bootCapacity);  jQuery("#spec-dimension tr").eq(8).find("td").eq(i).html(json.fuelCapacity); jQuery("#engine-type tr").eq(0).find("td").eq(i).html(json.e_fuel_Type); jQuery("#engine-type tr").eq(1).find("td").eq(i).html(json.eType); jQuery("#engine-type tr").eq(2).find("td").eq(i).html(json.displacement); jQuery("#engine-type tr").eq(3).find("td").eq(i).html(json.cylinders); jQuery("#engine-type tr").eq(4).find("td").eq(i).html(json.valveTrain); jQuery("#engine-type tr").eq(5).find("td").eq(i).html(json.boreStroke); jQuery("#engine-type tr").eq(6).find("td").eq(i).html(json.compressionRatio); jQuery("#engine-type tr").eq(7).find("td").eq(i).html(json.maxPower); jQuery("#engine-type tr").eq(8).find("td").eq(i).html(json.maxTorque); jQuery("#engine-type tr").eq(9).find("td").eq(i).html(json.powerWeight); jQuery("#engine-type tr").eq(10).find("td").eq(i).html(json.torqueWeight); jQuery("#engine-type tr").eq(11).find("td").eq(i).html(json.bhpLiter); jQuery("#engine-type tr").eq(12).find("td").eq(i).html(json.driveTrain); jQuery("#engine-type tr").eq(13).find("td").eq(i).html(json.eTransmission); jQuery("#engine-type tr").eq(14).find("td").eq(i).html(json.serviceInterval); jQuery("#spec-suspension tr").eq(0).find("td").eq(i).html(json.steering); jQuery("#spec-suspension tr").eq(1).find("td").eq(i).html(json.fSuspension); jQuery("#spec-suspension tr").eq(2).find("td").eq(i).html(json.rSuspension); jQuery("#spec-suspension tr").eq(3).find("td").eq(i).html(json.tyreSize); jQuery("#spec-suspension tr").eq(4).find("td").eq(i).html(json.brakes); jQuery("#features-safety tr").eq(0).find("td").eq(i).replaceWith(json.air_q); jQuery("#features-safety tr").eq(1).find("td").eq(i).replaceWith(json.abs_q); jQuery("#features-safety tr").eq(2).find("td").eq(i).replaceWith(json.traction_q); jQuery("#features-safety tr").eq(3).find("td").eq(i).replaceWith(json.esc_q); jQuery("#features-safety tr").eq(4).find("td").eq(i).replaceWith(json.fog_q); jQuery("#features-safety tr").eq(5).find("td").eq(i).replaceWith(json.rear_q); jQuery("#features-safety tr").eq(6).find("td").eq(i).replaceWith(json.engine_q); jQuery("#features-safety tr").eq(7).find("td").eq(i).replaceWith(json.alloy_q); jQuery("#features-enhancements tr").eq(0).find("td").eq(i).replaceWith(json.psteer_q); jQuery("#features-enhancements tr").eq(1).find("td").eq(i).replaceWith(json.tilt_q); 
jQuery("#features-enhancements tr").eq(2).find("td").eq(i).replaceWith(json.st_reach_q); jQuery("#features-enhancements tr").eq(3).find("td").eq(i).replaceWith(json.fHeight_q); jQuery("#features-enhancements tr").eq(4).find("td").eq(i).replaceWith(json.lumbar_q); jQuery("#features-enhancements tr").eq(5).find("td").eq(i).replaceWith(json.dead_q); 
jQuery("#features-enhancements tr").eq(6).find("td").eq(i).replaceWith(json.arm_q); 
jQuery("#features-enhancements tr").eq(7).find("td").eq(i).replaceWith(json.mirror_q); jQuery("#features-enhancements tr").eq(8).find("td").eq(i).replaceWith(json.infoDisplay_q); jQuery("#features-enhancements tr").eq(9).find("td").eq(i).replaceWith(json.sensors_q); jQuery("#features-enhancements tr").eq(10).find("td").eq(i).replaceWith(json.gear_q); jQuery("#features-convinience tr").eq(0).find("td").eq(i).replaceWith(json.remote_q); jQuery("#features-convinience tr").eq(1).find("td").eq(i).replaceWith(json.central_q); jQuery("#features-convinience tr").eq(2).find("td").eq(i).replaceWith(json.window_q); jQuery("#features-convinience tr").eq(3).find("td").eq(i).replaceWith(json.airC_q);
jQuery("#features-convinience tr").eq(4).find("td").eq(i).replaceWith(json.climate_q); jQuery("#features-convinience tr").eq(5).find("td").eq(i).replaceWith(json.vents_q); jQuery("#features-convinience tr").eq(6).find("td").eq(i).replaceWith(json.seats_q); jQuery("#features-convinience tr").eq(7).find("td").eq(i).replaceWith(json.sunRoof_q); jQuery("#features-convinience tr").eq(8).find("td").eq(i).replaceWith(json.fold_q); 
jQuery("#features-convinience tr").eq(9).find("td").eq(i).replaceWith(json.split_q); jQuery("#features-entertainment tr").eq(0).find("td").eq(i).replaceWith(json.speakers_q); jQuery("#features-entertainment tr").eq(1).find("td").eq(i).replaceWith(json.cd_q); 
jQuery("#features-entertainment tr").eq(2).find("td").eq(i).replaceWith(json.aux_q); 
jQuery("#features-entertainment tr").eq(3).find("td").eq(i).replaceWith(json.usb_q); 
jQuery("#features-entertainment tr").eq(4).find("td").eq(i).replaceWith(json.bTooth_q); jQuery("#features-entertainment tr").eq(5).find("td").eq(i).replaceWith(json.steeMoun_q); }); } function changeByVariant(id, variant, model) {var i = jQuery("#compareVariant table.compareTable tr").eq(0).find("td").index(jQuery(id).closest("td")); jQuery.getJSON("/themes/bhp/includes/getCompare.php", {model: model, variant:variant, city:jQuery("#city").val()}, function(json){ 
jQuery("#other-details tr").eq(0).find("td").eq(i).html(json.price); 
jQuery("#features-safety tr").eq(0).find("td").eq(i).replaceWith(json.air_q); jQuery("#features-safety tr").eq(1).find("td").eq(i).replaceWith(json.abs_q); jQuery("#features-safety tr").eq(2).find("td").eq(i).replaceWith(json.traction_q); jQuery("#features-safety tr").eq(3).find("td").eq(i).replaceWith(json.esc_q); jQuery("#features-safety tr").eq(5).find("td").eq(i).replaceWith(json.fog_q); jQuery("#features-safety tr").eq(6).find("td").eq(i).replaceWith(json.rear_q); jQuery("#features-safety tr").eq(7).find("td").eq(i).replaceWith(json.engine_q); jQuery("#features-safety tr").eq(8).find("td").eq(i).replaceWith(json.alloy_q); jQuery("#features-enhancements tr").eq(0).find("td").eq(i).replaceWith(json.psteer_q); jQuery("#features-enhancements tr").eq(1).find("td").eq(i).replaceWith(json.tilt_q); 
jQuery("#features-enhancements tr").eq(2).find("td").eq(i).replaceWith(json.st_reach_q); jQuery("#features-enhancements tr").eq(3).find("td").eq(i).replaceWith(json.fHeight_q); jQuery("#features-enhancements tr").eq(4).find("td").eq(i).replaceWith(json.lumbar_q); jQuery("#features-enhancements tr").eq(5).find("td").eq(i).replaceWith(json.dead_q); 
jQuery("#features-enhancements tr").eq(6).find("td").eq(i).replaceWith(json.arm_q); 
jQuery("#features-enhancements tr").eq(7).find("td").eq(i).replaceWith(json.mirror_q); jQuery("#features-enhancements tr").eq(8).find("td").eq(i).replaceWith(json.infoDisplay_q); jQuery("#features-enhancements tr").eq(9).find("td").eq(i).replaceWith(json.sensors_q); jQuery("#features-enhancements tr").eq(10).find("td").eq(i).replaceWith(json.gear_q); jQuery("#features-convinience tr").eq(0).find("td").eq(i).replaceWith(json.remote_q); jQuery("#features-convinience tr").eq(1).find("td").eq(i).replaceWith(json.central_q); jQuery("#features-convinience tr").eq(2).find("td").eq(i).replaceWith(json.window_q); jQuery("#features-convinience tr").eq(3).find("td").eq(i).replaceWith(json.airC_q); 
jQuery("#features-convinience tr").eq(4).find("td").eq(i).replaceWith(json.climate_q); jQuery("#features-convinience tr").eq(5).find("td").eq(i).replaceWith(json.vents_q); jQuery("#features-convinience tr").eq(6).find("td").eq(i).replaceWith(json.seats_q); jQuery("#features-convinience tr").eq(7).find("td").eq(i).replaceWith(json.sunRoof_q); jQuery("#features-convinience tr").eq(8).find("td").eq(i).replaceWith(json.fold_q); 
jQuery("#features-convinience tr").eq(9).find("td").eq(i).replaceWith(json.split_q); jQuery("#features-entertainment tr").eq(0).find("td").eq(i).replaceWith(json.speakers_q); jQuery("#features-entertainment tr").eq(1).find("td").eq(i).replaceWith(json.cd_q); 
jQuery("#features-entertainment tr").eq(2).find("td").eq(i).replaceWith(json.aux_q); 
jQuery("#features-entertainment tr").eq(3).find("td").eq(i).replaceWith(json.usb_q); 
jQuery("#features-entertainment tr").eq(4).find("td").eq(i).replaceWith(json.bTooth_q); jQuery("#features-entertainment tr").eq(5).find("td").eq(i).replaceWith(json.steeMoun_q); var total = jQuery(".nid").length; if(json.Safety!="") {jQuery.each(json.Safety, function(k, object) { jQuery.each(object, function(property, value) { var trID = (property.replace("_", "")).toLowerCase(); if(jQuery("tr#"+trID).length>0) { jQuery("tr#"+trID).find("td").eq(i).replaceWith(value); } else { jQuery("table#features-safety").append("<tr id=\'" + trID + "\'><td>" + property.replace(\'_\', \' \') + "</td></tr>"); for(var trCount=0; trCount<jQuery("#features-convinience tr").eq(9).find("td").length-1; trCount++){ if(trCount<total){ jQuery("tr#"+trID).append("<td class=\'aCenter\'>N/A</td>");} else { jQuery("tr#"+trID).append("<td>&nbsp;</td>"); } } jQuery("tr#"+trID).find("td").eq(i).replaceWith(value); } }); });} }); } function setID(model) {var id = model.options[model.selectedIndex].getAttribute("rel"); if(jQuery("input[value=\'"+id+"\']").length>0) {jQuery("div.search h3").text("Add other car").addClass("error"); jQuery("a#addCar").attr("onClick", "return false;"); } else {jQuery("div.search h3").text("Add Car").removeClass("error"); jQuery("#addCar").attr("onClick", "getCar(\'"+id+"\'); return false;"); } } function getModelCompare(id){ jQuery("select#selModelCompare").attr("disabled", "disabled"); jQuery.ajax({type: "POST",url: "/themes/bhp/includes/getModel.php",data: "make="+id,success: function(data){ jQuery("select#selModelCompare").html(data); jQuery("select#selModelCompare").removeAttr("disabled") }}); } function getCar(mod){ jQuery.getJSON("/themes/bhp/includes/getCompare.php", {model: mod, city:jQuery("#city").val()}, function(json) { var i = jQuery("table#car_details tr:first td").index(jQuery("div.search").closest("td"));jQuery("#car_title tr:first").find("td").eq(i+1).html("<div class=\"carDetails\"><h3>Add Car</h3></div>"); jQuery("#car_title tr:first").find("td").eq(i).html("<div class=\"carDetails\"><h3>"+json.title+"</h3></div>"); jQuery("div.search").html("</h3><img alt=\""+json.title+"\" src=\"/"+json.uri+"\"><div class=\"clearfix\"><a href=\"/"+json.url+"\" class=\"fleft reviewBtn\"><span>Full Review</span></a><a href=\"#\" onclick=\"removeTD(this); return false;\" class=\"fleft removeBtn\" rel=\""+json.nid+"\">&nbsp;</a></div><input type=\"hidden\" id=\"nid"+(i-1)+"\" name=\"nid"+(i-1)+"\" class=\"nid\" value=\""+json.nid+"\" />").removeClass("search");  jQuery("div#compareEngine").find("td").eq(i).html(json.engine);  jQuery("div#compareVariant").find("td").eq(i).html(json.variant); jQuery("table.compareTable tr").eq(4).find("td").eq(i).html(json.price); jQuery("table.compareTable tr").eq(5).find("td").eq(i).html(json.fuel); jQuery("table.compareTable tr").eq(6).find("td").eq(i).html(json.liked); jQuery("table.compareTable tr").eq(7).find("td").eq(i).html(json.dislike); jQuery("table.compareTable tr").eq(8).find("td").eq(i).html(json.upkeep); jQuery("table.compareTable tr").eq(9).find("td").eq(i).html(json.reliability); jQuery("table.compareTable tr").eq(10).find("td").eq(i).html(json.ser); jQuery("table.compareTable tr").eq(11).find("td").eq(i).html(json.sWar); jQuery("table.compareTable tr").eq(12).find("td").eq(i).html(json.eWar); jQuery("table.compareTable tr").eq(13).find("td").eq(i).html(json.resale); jQuery("table.compareTable tr").eq(15).find("td").eq(i).html(json.length); jQuery("table.compareTable tr").eq(16).find("td").eq(i).html(json.wheel); jQuery("table.compareTable tr").eq(17).find("td").eq(i).html(json.track); jQuery("table.compareTable tr").eq(18).find("td").eq(i).html(json.kerb); jQuery("table.compareTable tr").eq(19).find("td").eq(i).html(json.ground); jQuery("table.compareTable tr").eq(20).find("td").eq(i).html(json.radius); jQuery("table.compareTable tr").eq(21).find("td").eq(i).html(json.seatCapacity); jQuery("table.compareTable tr").eq(22).find("td").eq(i).html(json.bootCapacity); jQuery("table.compareTable tr").eq(23).find("td").eq(i).html(json.fuelCapacity); jQuery("t

able.compareTable tr").eq(25).find("td").eq(i).html(json.e_fuel_Type); jQuery("table.compareTable tr").eq(26).find("td").eq(i).html(json.eType);jQuery("table.compareTable tr").eq(27).find("td").eq(i).html(json.displacement); jQuery("table.compareTable tr").eq(28).find("td").eq(i).html(json.cylinders); jQuery("table.compareTable tr").eq(29).find("td").eq(i).html(json.valveTrain); jQuery("table.compareTable tr").eq(30).find("td").eq(i).html(json.boreStroke); jQuery("table.compareTable tr").eq(31).find("td").eq(i).html(json.compressionRatio); jQuery("table.compareTable tr").eq(32).find("td").eq(i).html(json.maxPower); jQuery("table.compareTable tr").eq(33).find("td").eq(i).html(json.maxTorque); jQuery("table.compareTable tr").eq(34).find("td").eq(i).html(json.powerWeight); jQuery("table.compareTable tr").eq(35).find("td").eq(i).html(json.torqueWeight); jQuery("table.compareTable tr").eq(36).find("td").eq(i).html(json.bhpLiter); jQuery("table.compareTable tr").eq(37).find("td").eq(i).html(json.driveTrain); jQuery("table.compareTable tr").eq(38).find("td").eq(i).html(json.eTransmission); jQuery("table.compareTable tr").eq(39).find("td").eq(i).html(json.serviceInterval); jQuery("table.compareTable tr").eq(41).find("td").eq(i).html(json.steering); jQuery("table.compareTable tr").eq(42).find("td").eq(i).html(json.fSuspension); jQuery("table.compareTable tr").eq(43).find("td").eq(i).html(json.rSuspension); jQuery("table.compareTable tr").eq(44).find("td").eq(i).html(json.tyreSize); jQuery("table.compareTable tr").eq(45).find("td").eq(i).html(json.brakes); jQuery("table.compareTable tr").eq(47).find("td").eq(i).replaceWith(json.air_q); jQuery("table.compareTable tr").eq(48).find("td").eq(i).replaceWith(json.abs_q); jQuery("table.compareTable tr").eq(49).find("td").eq(i).replaceWith(json.traction_q); jQuery("table.compareTable tr").eq(50).find("td").eq(i).replaceWith(json.esc_q); jQuery("table.compareTable tr").eq(51).find("td").eq(i).replaceWith(json.fog_q); jQuery("table.compareTable tr").eq(52).find("td").eq(i).replaceWith(json.rear_q); jQuery("table.compareTable tr").eq(53).find("td").eq(i).replaceWith(json.engine_q); jQuery("table.compareTable tr").eq(54).find("td").eq(i).replaceWith(json.alloy_q); jQuery("table.compareTable tr").eq(56).find("td").eq(i).replaceWith(json.psteer_q); jQuery("table.compareTable tr").eq(57).find("td").eq(i).replaceWith(json.tilt_q); jQuery("table.compareTable tr").eq(58).find("td").eq(i).replaceWith(json.st_reach_q); jQuery("table.compareTable tr").eq(59).find("td").eq(i).replaceWith(json.fHeight_q); jQuery("table.compareTable tr").eq(60).find("td").eq(i).replaceWith(json.lumbar_q); jQuery("table.compareTable tr").eq(61).find("td").eq(i).replaceWith(json.dead_q); jQuery("table.compareTable tr").eq(62).find("td").eq(i).replaceWith(json.arm_q); jQuery("table.compareTable tr").eq(63).find("td").eq(i).replaceWith(json.mirror_q); jQuery("table.compareTable tr").eq(64).find("td").eq(i).replaceWith(json.infoDisplay_q); jQuery("table.compareTable tr").eq(65).find("td").eq(i).replaceWith(json.sensors_q); jQuery("table.compareTable tr").eq(66).find("td").eq(i).replaceWith(json.gear_q); jQuery("table.compareTable tr").eq(68).find("td").eq(i).replaceWith(json.remote_q); jQuery("table.compareTable tr").eq(69).find("td").eq(i).replaceWith(json.central_q); jQuery("table.compareTable tr").eq(70).find("td").eq(i).replaceWith(json.window_q); jQuery("table.compareTable tr").eq(71).find("td").eq(i).replaceWith(json.airC_q); jQuery("table.compareTable tr").eq(72).find("td").eq(i).replaceWith(json.climate_q); jQuery("table.compareTable tr").eq(73).find("td").eq(i).replaceWith(json.vents_q); jQuery("table.compareTable tr").eq(74).find("td").eq(i).replaceWith(json.seats_q); jQuery("table.compareTable tr").eq(75).find("td").eq(i).replaceWith(json.sunRoof_q); jQuery("table.compareTable tr").eq(76).find("td").eq(i).replaceWith(json.fold_q); jQuery("table.compareTable tr").eq(77).find("td").eq(i).replaceWith(json.split_q); jQuery("table.compareTable tr").eq(79).find("td").eq(i).replaceWith(json.speakers_q); jQuery("table.com

pareTable tr").eq(80).find("td").eq(i).replaceWith(json.cd_q); jQuery("table.compareTable tr").eq(81).find("td").eq(i).replaceWith(json.aux_q); jQuery("table.compareTable tr").eq(82).find("td").eq(i).replaceWith(json.usb_q); jQuery("table.compareTable tr").eq(83).find("td").eq(i).replaceWith(json.bTooth_q); jQuery("table.compareTable tr").eq(84).find("td").eq(i).replaceWith(json.steeMoun_q); if(i<5) {jQuery("table#car_details tr:first td").eq(i+1).html(\''.$contentOpt.'\');} } ); } function removeCar(id) { jQuery(id).closest("li.clearfix").remove(); jQuery("li#compareLi").before("<li class=\'num\'><span class=\'n\'>5</span></li>"); if(jQuery("ul#compareUL").find("select#selMakeCompare").length==0) { jQuery("ul#compareUL li.num").html(\''.$contentOpt.'\'); jQuery("ul#compareUL li.num").attr("class", "clearfix"); } else { jQuery("ul#compareUL li").each(function(index){ if(jQuery(this).hasClass("num")) { jQuery(this).find("span.n").text(index+1); } }); } } function addCommas(nStr) { nStr += ""; x = nStr.split("."); x1 = x[0]; x2 = x.length > 1 ? "." + x[1] : ""; var rgx = /(\d+)(\d{3})/; while (rgx.test(x1)) { x1 = x1.replace(rgx, "$1" + "," + "$2"); } return x1 + x2; } function changePrice(city) { var nid=""; jQuery("#city").val(city); jQuery("select.w110").each(function(index){ nid = jQuery(this).val(); jQuery.ajax({type: "POST", url: "/themes/bhp/includes/getPrice.php", data: "city="+city+"&nid="+nid, success: function(data){if(data!="") { jQuery(".compareTable tr").eq(3).find("td").eq(index+1).html("<span class=\"WebRupee\">Rs.</span>"+addCommas(data)); } else { jQuery(".compareTable tr").eq(3).find("td").eq(index+1).html("No price available"); } }}); })} ', 'inline');

				for($i=0; $i<5; $i++)
				{
					if($i<$s)
					{
						$sql_model=@mysqli_query("SELECT node.title,node.nid, field_data_field_nr_make.field_nr_make_nid FROM node,  field_data_field_nr_make WHERE field_data_field_nr_make.entity_id = node.nid AND node.status =1 AND  node.nid=".$id[$i]) or die(mysql_error());
						$data_model=mysqli_fetch_array($sql_model);
						$price_res = @mysql_fetch_assoc(mysqli_query("select min(ex_showroom_price) as minPrice, max(ex_showroom_price) as maxPrice from team_bhp_variant_price, field_data_field_price_nr_variant, field_data_field_variant_nr_engine, field_data_field_nr_make_model where team_bhp_variant_price.city='Delhi' and team_bhp_variant_price.nid=field_data_field_price_nr_variant.entity_id and field_data_field_price_nr_variant.field_price_nr_variant_nid=field_data_field_variant_nr_engine.entity_id and field_data_field_variant_nr_engine.field_variant_nr_engine_nid=field_data_field_nr_make_model.entity_id and field_data_field_nr_make_model.field_nr_make_model_nid=".$data_model['nid']));
						$sql_sequenceimg=@mysqli_fetch_array(mysqli_query("SELECT distinct(field_gallery_interior_alt) as alt, field_gallery_interior_title as title, field_gallery_interior_fid as fid FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_model['nid']."' and field_data_field_gallery_interior.field_gallery_interior_alt!='' UNION SELECT distinct(field_gallery_exterior_alt) as alt, field_gallery_exterior_title as title, field_gallery_exterior_fid as fid FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_model['nid']."' and field_data_field_gallery_exterior.field_gallery_exterior_alt!='' UNION SELECT distinct(field_gallery_engine_alt) as alt, field_gallery_engine_title as title, field_gallery_engine_fid as fid FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_model['nid']."' and field_data_field_gallery_engine.field_gallery_engine_alt!='' UNION SELECT distinct(field_gallery_smaller_alt) as alt, field_gallery_smaller_title as title, field_gallery_smaller_fid as fid FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_model['nid']."' and field_data_field_gallery_smaller.field_gallery_smaller_alt!='' order by alt limit 0,1"));
						if($sql_sequenceimg=='')
						{
						$sql_sequenceimgwithorder=@mysqli_fetch_array(mysqli_query("SELECT field_data_field_gallery_interior.delta as delta , field_gallery_interior_title as title, field_gallery_interior_fid as fidint FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_model['nid']."' UNION SELECT field_data_field_gallery_exterior.delta as delta, field_gallery_exterior_title as title, field_gallery_exterior_fid as fidint FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_model['nid']."' UNION SELECT field_data_field_gallery_engine.delta as delta, field_gallery_engine_title as title, field_gallery_engine_fid as fidint FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_model['nid']."' UNION SELECT field_data_field_gallery_smaller.delta as delta, field_gallery_smaller_title as title, field_gallery_smaller_fid as fidint FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_model['nid']."' order by delta limit 0,1"));
							if($sql_sequenceimgwithorder=='')
								{
								$model_imgname="sites/default/files/defaultmodel_124.gif";
								}
							else
								{
							$model_img=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$sql_sequenceimgwithorder['fidint']));
							$model_imgname="?q=sites/default/files/styles/check_medium_medium/public/".str_replace("public://","",$model_img['uri']);
								}
						}
						else
						{
						$model_img=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$sql_sequenceimg['fid']));
						$model_imgname="?q=sites/default/files/styles/check_medium_medium/public/".str_replace("public://","",$model_img['uri']);
						}
					?>
					<td>
						<div class="carDetails">
							<!-- <h3><?php echo $data_model['title'];?></h3> -->
							<!--<img src="/sites/default/files/<?php echo str_replace("public://","",$data_model['uri']);?>" width="165" height="124" alt="<?php echo $data_model['title'];?>" />-->
							<img src="/<?php echo $model_imgname;?>" alt="<?php echo $data_model['title'];?>" />
							<div class="clearfix">
								<a class="fleft reviewBtn" href="<?php echo url("node/".$data_model['nid'])?>"><span>Full Review</span></a>
								<a class="fleft removeBtn" href="#" onclick="removeTD(this); return false;">&nbsp;</a>
							</div>
						<input type="hidden" id="nid<?php echo $i; ?>" name="nid<?php echo $i; ?>" class="nid" value="<?php echo $data_model['nid']; ?>" />
						</div>
					</td>
					<?php
					}
					else
					{
						if($i<=4 && $isSet!=1)
						{
							$isSet = 1;
							?>
							<td>
							<?php echo $contentOpt; ?>
							</td>
							<?php
						}
						else
						{
					?>
						<td>&nbsp;</td>
					<?php
						}
					}
				}
				?>
			</tr>
			</table>
					<div id="compareEngine">
								<table class="speciTable compareTable tblBborder" >
									<tr>
										<td>Engine</td>
										<?php
										for($i=0; $i<5; $i++)
										{
											if($i<$s)
											{
												$j = 0;
										?>
										<td>
											<select class="w160" onchange="changeByEngine(this, this.value, <?php echo $id[$i]; ?>);">
											<?php
											$sql_engine = @mysqli_query("select field_nr_make_model_nid,entity_id from field_data_field_nr_make_model where field_nr_make_model_nid=".$id[$i]." and bundle='engine_type'");
											$e_id='';
											while($data_eid=@mysqli_fetch_array($sql_engine))
												{
												if($j==0)
												{
													$firstEngine = $data_eid['entity_id'];
												}
												$e_id.=$data_eid['entity_id'].",";
												$j++;
												}
											$sql_modelengine=@mysqli_query("select nid, title from node where nid in (".substr($e_id,0,-1).") order by nid");
											while($engine_title=@mysqli_fetch_array($sql_modelengine))
													{
													?>
													<option value="<?php echo $engine_title['nid']; ?>"><?php echo $engine_title['title']; ?></option>
													<?php
													}
											?>
											</select>
										</td>
										<?php
											$q = "firstEngine".$i;
											$$q = "SELECT node.nid, node.title FROM field_data_field_variant_nr_engine,node WHERE field_data_field_variant_nr_engine.entity_id=node.nid and node.status=1 and field_variant_nr_engine_nid=".$firstEngine;
											$fq = "firstFuel".$i;
											$$fq = "SELECT max(field_data_field_spec_fuel_highway.field_spec_fuel_highway_value) as maxHighway, max(field_data_field_spec_fuel_city.field_spec_fuel_city_value) as maxCity FROM field_data_field_spec_nr_engine_type, field_data_field_spec_fuel_city, field_data_field_spec_fuel_highway, field_data_field_variant_nr_engine, node WHERE field_data_field_spec_nr_engine_type.entity_id = field_data_field_spec_fuel_city.entity_id AND field_data_field_spec_fuel_highway.entity_id = field_data_field_spec_fuel_city.entity_id AND field_data_field_spec_fuel_city.entity_id = node.nid AND node.status =1 AND field_data_field_variant_nr_engine.field_variant_nr_engine_nid = field_data_field_spec_nr_engine_type.field_spec_nr_engine_type_nid AND field_data_field_spec_nr_engine_type.field_spec_nr_engine_type_nid=".$firstEngine;
											$slq = "spec".$i;
											$$slq = "select field_spec_length_value from field_data_field_spec_length, field_data_field_spec_nr_engine_type where field_data_field_spec_length.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1";
											$wlq = "wheel".$i;
											$$wlq = "select field_spec_wheel_value from field_data_field_spec_wheel, field_data_field_spec_nr_engine_type where field_data_field_spec_wheel.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1";
											$tlq = "track".$i;
											$$tlq = "select field_spec_track_value from field_data_field_spec_track, field_data_field_spec_nr_engine_type where field_data_field_spec_track.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1";
											$klq = "kerb".$i;
											$$klq = "select field_data_field_spec_kerb.field_spec_kerb_value,field_data_field_spec_kerb.entity_id from field_data_field_spec_kerb, field_data_field_spec_nr_engine_type where field_data_field_spec_kerb.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1";
											$glq = "ground".$i;
											$$glq = "select field_data_field_spec_ground.field_spec_ground_value,field_data_field_spec_ground.entity_id from field_data_field_spec_ground, field_data_field_spec_nr_engine_type where field_data_field_spec_ground.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1";
											$rlq = "radius".$i;
											$$rlq = "select field_spec_radius_value from field_data_field_spec_radius, field_data_field_spec_nr_engine_type where field_data_field_spec_radius.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1";
											$selq = "seat".$i;
											$$selq = "select field_data_field_spec_seating.field_spec_seating_value,field_data_field_spec_seating.entity_id from field_data_field_spec_seating, field_data_field_spec_nr_engine_type where field_data_field_spec_seating.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1";
											$bootlq = "radius".$i;
											$$bootlq = "select field_spec_boot_value from field_data_field_spec_radius, field_data_field_spec_nr_engine_type where field_data_field_spec_boot.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1";
											$fulq = "fuel".$i;
											$$fulq = "select field_spec_fuel_tank_value from field_data_field_spec_fuel_tank, field_data_field_spec_nr_engine_type where field_data_field_spec_fuel_tank.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1";
											$etype = "etype".$i;
											$$etype = "select field_spec_engine_type_value from field_data_field_spec_engine_type, field_data_field_spec_nr_engine_type where field_data_field_spec_engine_type.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1";
											$fueltype = "fueltype".$i;
											$$fueltype = "select entity_id,field_engine_fuel_value from field_data_field_engine_fuel where entity_id =".$firstEngine." limit 1";
											$disp = "disp".$i;
											$$disp = "select field_spec_engine_displacement_value from field_data_field_spec_engine_displacement, field_data_field_spec_nr_engine_type where field_data_field_spec_engine_displacement.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1";
											$cyln = "cyln".$i;
											$$cyln = "select field_spec_engine_cylinders_value from field_data_field_spec_engine_cylinders, field_data_field_spec_nr_engine_type where field_data_field_spec_engine_cylinders.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1";
											$vtrain = "vtrain".$i;
											$$vtrain = "select field_spec_engine_valvetrain_value from field_data_field_spec_engine_valvetrain, field_data_field_spec_nr_engine_type where field_data_field_spec_engine_valvetrain.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1";
											$bore = "bore".$i;
											$$bore = "select field_spec_engine_bore_value from field_data_field_spec_engine_bore, field_data_field_spec_nr_engine_type where field_data_field_spec_engine_bore.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1";
											$comp = "comp".$i;
											$$comp = "select field_spec_engine_comp_ratio_value from field_data_field_spec_engine_comp_ratio, field_data_field_spec_nr_engine_type where field_data_field_spec_engine_comp_ratio.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1";
											$mPower = "mPower".$i;
											$$mPower = "select field_spec_engine_power_value from field_data_field_spec_engine_power, field_data_field_spec_nr_engine_type where field_data_field_spec_engine_power.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1";
											$mTorque = "mTorque".$i;
											$$mTorque = "select field_spec_engine_torque_value from field_data_field_spec_engine_torque, field_data_field_spec_nr_engine_type where field_data_field_spec_engine_torque.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1";
											$p2w = "p2w".$i;
											$$p2w = "select field_spec_engine_power_weight_value from field_data_field_spec_engine_power_weight, field_data_field_spec_nr_engine_type where field_data_field_spec_engine_power_weight.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1";
											$p2t = "p2t".$i;
											$$p2t = "select field_spec_engine_torque_weight_value from field_data_field_spec_engine_torque_weight, field_data_field_spec_nr_engine_type where field_data_field_spec_engine_torque_weight.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1";
											$bhpp = "bhpp".$i;
											$$bhpp = "select field_spec_engine_bhp_value from field_data_field_spec_engine_bhp, field_data_field_spec_nr_engine_type where field_data_field_spec_engine_bhp.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1";
											$dtrain = "dtrain".$i;
											$$dtrain = "select field_spec_engine_drivetrain_value from field_data_field_spec_engine_drivetrain, field_data_field_spec_nr_engine_type where field_data_field_spec_engine_drivetrain.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1";
											$etrans = "etrans".$i;
											$$etrans = "select field_spec_engine_transmission_value from field_data_field_spec_engine_transmission, field_data_field_spec_nr_engine_type where field_data_field_spec_engine_transmission.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1";
											$sInt = "sInt".$i;
											$$sInt = "select field_spec_engine_service_value from field_data_field_spec_engine_service, field_data_field_spec_nr_engine_type where field_data_field_spec_engine_service.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1";
											$steer = "steer".$i;
											$$steer = "select field_spec_steering_value from field_data_field_spec_steering, field_data_field_spec_nr_engine_type where field_data_field_spec_steering.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1";
											$front = "front".$i;
											$$front = "select field_spec_front_value from field_data_field_spec_front, field_data_field_spec_nr_engine_type where field_data_field_spec_front.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1";
											$rear = "rear".$i;
											$$rear = "select field_spec_rear_value from field_data_field_spec_rear, field_data_field_spec_nr_engine_type where field_data_field_spec_rear.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1";
											$tSize = "tSize".$i;
											$$tSize = "select field_data_field_spec_tyre.field_spec_tyre_value,field_data_field_spec_tyre.entity_id from field_data_field_spec_tyre, field_data_field_spec_nr_engine_type where field_data_field_spec_tyre.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1";
											$breaks = "breaks".$i;
											$$breaks = "select field_data_field_spec_brakes.field_spec_brakes_value,field_data_field_spec_brakes.entity_id from field_data_field_spec_brakes, field_data_field_spec_nr_engine_type where field_data_field_spec_brakes.entity_id=field_data_field_spec_nr_engine_type.entity_id and field_spec_nr_engine_type_nid=".$firstEngine." limit 1";
											}
											else
											{
											?>
											<td>&nbsp;</td>
											<?php
											}
										 }
										?>
									</tr>
									
								</table>
							</div>	
					<div id="compareVariant">
								<table class="speciTable compareTable tblBborder">
									<tr>
										<td>Variant</td>
										<?php
										for($i=0; $i<5; $i++)
										{
											if($i<$s)
											{
											$q = "firstEngine".$i;
											$res = @mysqli_query($$q);
											$p = 0;
										?>
										<td>
											<select class="w160" onchange="changeByVariant(this, this.value, <?php echo $id[$i]; ?>)">
											<?php
											if($_REQUEST['city']!='')
											{
												$city = $_REQUEST['city'];
											}
											else
											{
												$city = 'Delhi';
											}
											while($fv_row=@mysql_fetch_assoc($res))
											{
											if($p==0)
											{
												$firstPrice = $fv_row['nid'];
											}
											?>
												<option value="<?php echo $fv_row['nid']; ?>"><?php echo $fv_row['title']; ?></option>
											<?php
											$p++;
											}
											?>
											</select>
										</td>
										<?php
											$qp = "firstPrice".$i;
											$$qp = "select * from field_data_field_price_nr_variant, team_bhp_variant_price where field_data_field_price_nr_variant.entity_id=team_bhp_variant_price.nid and team_bhp_variant_price.city='".$city."' and field_data_field_price_nr_variant.field_price_nr_variant_nid=".$firstPrice;
											$air_q = "air".$i;
											$$air_q = "select * from field_data_field_features_air_bags, field_data_field_features_nr_variant where field_data_field_features_air_bags.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$abs_q = "abs".$i;
											$$abs_q = "select field_features_abs_value from ield_data_field_features_abs, field_data_field_features_nr_variant where ield_data_field_features_abs.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$traction_q = "traction".$i;
											$$traction_q = "select field_features_traction_value from field_data_field_features_traction, field_data_field_features_nr_variant where field_data_field_features_traction.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$esc_q = "esc".$i;
											$$esc_q = "select field_features_esc_value from field_data_field_features_esc, field_data_field_features_nr_variant where field_data_field_features_esc.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$fog_q = "fog".$i;
											$$fog_q = "select field_features_fog_value from field_data_field_features_fog, field_data_field_features_nr_variant where field_data_field_features_fog.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$rear_q = "rear".$i;
											$$rear_q = "select field_features_wipe_value from field_data_field_features_wipe, field_data_field_features_nr_variant where field_data_field_features_wipe.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$engine_q = "engine".$i;
											$$engine_q = "select field_features_immobiliser_value from field_data_field_features_immobiliser, field_data_field_features_nr_variant where field_data_field_features_immobiliser.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$alloy_q = "alloy".$i;
											$$alloy_q = "select field_features_alloy_value from field_data_field_features_alloy, field_data_field_features_nr_variant where field_data_field_features_alloy.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$psteer_q = "psteering".$i;
											$$psteer_q = "select field_features_power_steering_value from field_data_field_features_power_steering, field_data_field_features_nr_variant where field_data_field_features_power_steering.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$tilt_q = "tilt".$i;
											$$tilt_q = "select field_features_steering_tilt_value from field_data_field_features_steering_tilt, field_data_field_features_nr_variant where field_data_field_features_steering_tilt.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$st_reach_q = "st_reach".$i;
											$$st_reach_q = "select field_features_steering_reach_value from field_data_field_features_steering_reach, field_data_field_features_nr_variant where field_data_field_features_steering_reach.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$fHeight_q = "fHeight".$i;
											$$fHeight_q = "select field_features_height_value from field_data_field_features_height, field_data_field_features_nr_variant where field_data_field_features_height.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$lumbar_q = "lumbar".$i;
											$$lumbar_q = "select field_features_lumbar_value from field_data_field_features_lumbar, field_data_field_features_nr_variant where field_data_field_features_lumbar.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$dead_q = "dead".$i;
											$$dead_q = "select field_features_dead_pedal_value from field_data_field_features_dead_pedal, field_data_field_features_nr_variant where field_data_field_features_dead_pedal.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$arm_q = "arm".$i;
											$$arm_q = "select field_features_armrest_value from field_data_field_features_armrest, field_data_field_features_nr_variant where field_data_field_features_armrest.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$mirror_q = "mirror".$i;
											$$mirror_q = "select field_features_mirrors_value from field_data_field_features_mirrors, field_data_field_features_nr_variant where field_data_field_features_mirrors.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$infoDisplay_q = "infoDisplay".$i;
											$$infoDisplay_q = "select field_features_info_display_value from field_data_field_features_info_display, field_data_field_features_nr_variant where field_data_field_features_info_display.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$sensors_q = "sensors".$i;
											$$sensors_q = "select field_features_sensors_value from field_data_field_features_sensors, field_data_field_features_nr_variant where field_data_field_features_sensors.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$gear_q = "gear".$i;
											$$gear_q = "select field_features_gear_box_value from field_data_field_features_gear_box, field_data_field_features_nr_variant where field_data_field_features_gear_box.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$remote_q = "remote".$i;
											$$remote_q = "select field_features_remote_value from field_data_field_features_remote, field_data_field_features_nr_variant where field_data_field_features_remote.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$central_q = "central".$i;
											$$central_q = "select field_features_central_value from field_data_field_features_central, field_data_field_features_nr_variant where field_data_field_features_central.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$window_q = "window".$i;
											$$window_q = "select field_features_window_value from field_data_field_features_window, field_data_field_features_nr_variant where field_data_field_features_window.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$airC_q = "airC".$i;
											$$airC_q = "select field_features_air_conditioner_value from field_data_field_features_air_conditioner, field_data_field_features_nr_variant where field_data_field_features_air_conditioner.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$climate_q = "climate".$i;
											$$climate_q = "select field_features_climate_value from field_data_field_features_climate, field_data_field_features_nr_variant where field_data_field_features_climate.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$vents_q = "vents".$i;
											$$vents_q = "select field_features_vents_value from field_data_field_features_vents, field_data_field_features_nr_variant where field_data_field_features_vents.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$seats_q = "seats".$i;
											$$seats_q = "select field_features_seats_value from field_data_field_features_seats, field_data_field_features_nr_variant where field_data_field_features_seats.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$sunRoof_q = "sunRoof".$i;
											$$sunRoof_q = "select field_features_sun_roof_value from field_data_field_features_sun_roof, field_data_field_features_nr_variant where field_data_field_features_sun_roof.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$fold_q = "fold".$i;
											$$fold_q = "select field_features_fold_value from field_data_field_features_fold, field_data_field_features_nr_variant where field_data_field_features_fold.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$split_q = "split".$i;
											$$split_q = "select field_features_split_value from field_data_field_features_split, field_data_field_features_nr_variant where field_data_field_features_split.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$speakers_q = "speakers".$i;
											$$speakers_q = "select field_number_of_speakers_value from field_data_field_number_of_speakers, field_data_field_features_nr_variant where field_data_field_number_of_speakers.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$cd_q = "cd".$i;
											$$cd_q = "select field_features_cd_value from field_data_field_features_cd, field_data_field_features_nr_variant where field_data_field_features_cd.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$aux_q = "aux".$i;
											$$aux_q = "select field_features_aux_value from field_data_field_features_aux, field_data_field_features_nr_variant where field_data_field_features_aux.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$usb_q = "usb".$i;
											$$usb_q = "select field_features_usb_value from field_data_field_features_usb, field_data_field_features_nr_variant where field_data_field_features_usb.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$bTooth_q = "bTooth".$i;
											$$bTooth_q = "select * from field_data_field_features_bluetooth, field_data_field_features_nr_variant where field_data_field_features_bluetooth.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
											$steeMoun_q = "steeMoun".$i;
											$$steeMoun_q = "select field_features_steering_value from field_data_field_features_steering, field_data_field_features_nr_variant where field_data_field_features_steering.entity_id=field_data_field_features_nr_variant.entity_id and field_data_field_features_nr_variant.field_features_nr_variant_nid=".$firstPrice;
										
											}
											else
											{
											?>
											<td>&nbsp;</td>
											<?php
											}
										}
										?>
									</tr>
								</table>
					</div>	
			<table class="other-details speciTable compareTable" id="other-details">
			<tr>
				<td>On-road Price
					<select onchange="changePrice(this.value); return false;" id="onRoad" name="onRoad" class="w120 marT5">
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
				</td>
				<input type="hidden" name="city" id="city" value="<?php echo $city; ?>" />
				<?php
				for($i=0; $i<5; $i++)
				{
					if($i<$s)
					{
					$qp = "firstPrice".$i;
					$res_p = @mysqli_query($$qp);
					$fp_res = @mysql_fetch_assoc($res_p);
					if($fp_res['ex_showroom_price']!='')
					{
						$price = "<span class=\"WebRupee\">Rs.</span> ".number_format($fp_res['ex_showroom_price']);
					}
					else
					{
						$price = "No price available";
					}
					?>
					<td class="alignCenter vAlignMiddle">
					<?php echo $price; ?>
					</td>
					<?php
					}
					else
					{
					?>
					<td class="alignCenter vAlignMiddle">&nbsp;</td>
					<?php
					}
				}
				?>
			</tr>
			<tr class="fuelEfficTr">
				<td>Fuel Efficiency <span class="tip">(kpl)</span></td>
				<?php
				for($i=0; $i<5; $i++)
				{
					if($i<$s)
					{
					$fq = "firstFuel".$i;
					$res_fq = @mysqli_query($$fq);
					$fq_res = @mysql_fetch_assoc($res_fq);
					if($fq_res['maxHighway']!='')
					{
						$maxHighway = $fq_res['maxHighway'];
					}
					else
					{
						//$maxHighway = "N/A";
						$maxHighway = $naimgpath;
						
					}
					if($fq_res['maxCity']!='')
					{
						$maxCity = $fq_res['maxCity'];
					}
					else
					{
						//$maxCity = "N/A";
						$maxCity = $naimgpath;
					}
					?>
					<td>
						<span class="city">City : <em class="grey"><?php echo $maxCity; ?></em></span>
						<span class="highway">Highway : <em class="grey"><?php echo $maxHighway; ?></em></span>
					</td>
					<?php
					}
					else
					{
					?>
					<td>&nbsp;</td>
					<?php
					}
				}
				?>
			</tr>
			<tr>
				<td class="bigText">Owners liked</td>
				<?php
				for($i=0; $i<5; $i++)
				{
					if($i<$s)
					{
					?>
					<td>
						<ul class="bulletList">
					<?php
						$model_liked=@mysqli_query("SELECT node.title,field_data_field_model_liked.revision_id,field_data_field_model_liked.field_model_liked_value from node,field_data_field_model_liked where field_data_field_model_liked.entity_id=node.nid and node.status=1 and node.type='model' and node.nid=".$id[$i]);
						if(@mysqli_num_rows($model_liked)>0)
						{
							while($like=mysqli_fetch_array($model_liked))
							{
					?>
							<li><?php echo $like['field_model_liked_value'];?></li>
					<?php
							}
						}
						else
						{
					?>
							<?php echo $naimgpath;?>
					<?php
						}
					?>
						</ul>
					</td>
					<?php
					}
					else
					{
					?>
					<td>&nbsp;</td>
					<?php
					}
				}
				?>
			</tr>
			<tr>
				<td class="bigText">Owners disliked</td>
				<?php
				for($i=0; $i<5; $i++)
				{
					if($i<$s)
					{
					?>
					<td>
						<ul class="bulletList">
					<?php
						$model_disliked=@mysqli_query("SELECT node.title,field_data_field_model_disliked.revision_id,field_data_field_model_disliked.field_model_disliked_value from node,field_data_field_model_disliked where field_data_field_model_disliked.entity_id=node.nid and node.status=1 and node.type='model' and node.nid=".$id[$i]);
						if(@mysqli_num_rows($model_disliked)>0)
						{
							while($dislike=mysqli_fetch_array($model_disliked))
							{
					?>
							<li><?php echo $dislike['field_model_disliked_value'];?></li>
					<?php
							}
						}
						else
						{
					?>
							<?php echo $naimgpath;?>
					<?php
						}
					?>
						</ul>
					</td>
					<?php
					}
					else
					{
					?>
					<td>&nbsp;</td>
					<?php
					}
				}
				?>
			</tr>
		</table><!-- compareTable -->
		
		<div class="compareHideShow">
			<div class="accTitle ownerHead">
				<h4><a href="#">OWNERSHIP</a></h4>
			</div>
			<div>
				<table class="speciTable compareTable" id="ownership">
					<tr>
						<td>Upkeep Costs</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$uc_row = @mysql_fetch_assoc(mysqli_query("select field_model_upkeep_value from field_data_field_model_upkeep where entity_id=".$id[$i]));
							if($uc_row['field_model_upkeep_value']!='')
							{
							$upkeepCosts = $uc_row['field_model_upkeep_value'];
							}
							else
							{
							//$upkeepCosts = 'N/A';
							$upkeepCosts = $naimgpath;
							}
							?>
							<td><?php echo $upkeepCosts; ?></td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Overall Reliability</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$or_row = @mysql_fetch_assoc(mysqli_query("select field_model_reliability_value from field_data_field_model_reliability where entity_id=".$id[$i]));
							if($or_row['field_model_reliability_value']!='')
							{
							$overallReliability = $or_row['field_model_reliability_value'];
							}
							else
							{
							//$overallReliability = 'N/A';
							$overallReliability = $naimgpath;
							}
							?>
							<td><?php echo $overallReliability; ?></td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Service</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$service_row = @mysql_fetch_assoc(mysqli_query("select field_model_service_value from field_data_field_model_service where entity_id=".$id[$i]));
							if($service_row['field_model_service_value']!='')
							{
							$service = $service_row['field_model_service_value'];
							}
							else
							{
							//$service = 'N/A';
							$service = $naimgpath;
							}
							?>
							<td><?php echo $service; ?></td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Standard Warranty</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$sw_row = @mysql_fetch_assoc(mysqli_query("select field_model_s_warranty_value from field_data_field_model_s_warranty where entity_id=".$id[$i]));
							if($sw_row['field_model_s_warranty_value']!='')
							{
							$sWarranty = $sw_row['field_model_s_warranty_value'];
							}
							else
							{
							//$sWarranty = 'N/A';
							$sWarranty = $naimgpath;
							}
							?>
							<td><?php echo $sWarranty; ?></td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Extended Warranty</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$ew_res = @mysqli_query("select field_model_e_warranty_value from field_data_field_model_e_warranty where entity_id=".$id[$i]);
							?>
							<td>
								<?php
								if(@mysqli_num_rows($ew_res)>0)
								{
								while($ew_row=mysql_fetch_assoc($ew_res))
								{
								?>
								<p><?php echo $ew_row['field_model_e_warranty_value']; ?></p>
								<?php
								}
								}
								else
								{
								?>
								<p><?php echo $naimgpath;?></p>
								<?php
								}
								?>
							</td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Resale Value</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$rv_res = @mysqli_query("select field_model_resale_value from field_data_field_model_resale where entity_id=".$id[$i]);
							if($rv_res['field_model_resale_value']!='')
							{
							$rValue = $rv_res['field_model_resale_value'];
							}
							else
							{
							//$rValue = 'N/A';
							$rValue = $naimgpath;
							}
							?>
							<td><?php echo $rValue; ?></td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
				</table><!-- speciTable -->
			</div>
			<div class="accTitle speciHead">
				<h4><a href="#">SPECIFICATIONS</a></h4>
			</div>
			<div class="padT5">
				<table class="speciTable compareTable" id="spec-dimension">
					<thead>
						<tr>
							<th colspan="6">Dimensions</th>
						</tr>	
					</thead>
					<tr>
						<td>Length X Width X Height</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$slq = "spec".$i;
							$slq_row = @mysql_fetch_assoc(mysqli_query($$slq));
							if($slq_row['field_spec_length_value']!='')
							{
								$length = $slq_row['field_spec_length_value']." mm";
							}
							else
							{
								//$length = 'N/A';
								$length = $naimgpath;
								
							}
							
							
							?>
							<td><?php echo $length; ?></td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Wheelbase</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$wlq = "wheel".$i;
							$wlq_row = @mysql_fetch_assoc(mysqli_query($$wlq));
							if($wlq_row['field_spec_wheel_value']!='')
							{
								$wheel = $wlq_row['field_spec_wheel_value']." mm";
							}
							else
							{
								//$wheel = 'N/A';
								$wheel = $naimgpath;
							}
							?>
							<td><?php echo $wheel; ?></td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Track : Front / Rear</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$tlq = "track".$i;
							$tlq_row = @mysql_fetch_assoc(mysqli_query($$tlq));
							if($tlq_row['field_spec_track_value']!='')
							{
								$track = $tlq_row['field_spec_track_value']." mm";
							}
							else
							{
								//$track = 'N/A';
								 $track = $naimgpath;
							}
							?>
							<td><?php echo $track; ?></td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Kerb weight</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$klq = "kerb".$i;
							$klq_row = @mysql_fetch_assoc(mysqli_query($$klq));
							if($klq_row['field_spec_kerb_value']!='')
							{
								$kerb = $klq_row['field_spec_kerb_value']." kgs";
							}
							else
							{
								//$kerb = 'N/A';
								$kerb=$naimgpath;
							}
							$kwieghtinfo_row =@mysql_fetch_assoc(mysqli_query("select field_kerb_info_value from field_data_field_kerb_info where entity_id =".$klq_row['entity_id']));
							?>
							<td><?php echo $kerb; ?>
								  <?php
								  if($kwieghtinfo_row!='')
									{
									?>
									<a href="#" class="infoIcon">&nbsp;
									<div class="infoBox">
									<span></span>
										<?php echo $kwieghtinfo_row['field_kerb_info_value'];?>
									</div>
									</a>
									<?php
									}
									?>
							</td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Ground Clearance</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$glq = "ground".$i;
							$glq_row = @mysql_fetch_assoc(mysqli_query($$glq));
							if($glq_row['field_spec_ground_value']!='')
							{
								$ground = $glq_row['field_spec_ground_value']." mm";
							}
							else
							{
								//$ground = 'N/A';
								$ground = $naimgpath;
							}
							$groundinfo_row = @mysql_fetch_assoc(mysqli_query("select field_ground_info_value from field_data_field_ground_info where entity_id=".$glq_row['entity_id']));
							
							?>
							<td><?php echo $ground; ?>
							    	<?php
								  if($groundinfo_row!='')
									{
									?>
							<a href="#" class="infoIcon">&nbsp;
									<div class="infoBox">
									<span></span>
										<?php echo $groundinfo_row['field_ground_info_value'];?>
									</div>
							</a>
								<?php
									}
								?>
							</td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Turning Radius</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$rlq = "radius".$i;
							$rlq_row = @mysql_fetch_assoc(mysqli_query($$rlq));
							if($rlq_row['field_spec_radius_value']!='')
							{
								$radius = $rlq_row['field_spec_radius_value']." meters";
							}
							else
							{
								//$radius = 'N/A';
								$radius= $naimgpath;
							}
							?>
							<td><?php echo $radius; ?></td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Seating Capacity</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$selq = "seat".$i;
							$selq_row = @mysql_fetch_assoc(mysqli_query($$selq));
							if($selq_row['field_spec_seating_value']!='')
							{
								$seatCapacity = $selq_row['field_spec_seating_value']." People";
							}
							else
							{
								//$seatCapacity = 'N/A';
								$seatCapacity = $naimgpath;
							}
							$seating_capinfo = @mysql_fetch_assoc(mysqli_query("select field_seating_info_value from field_data_field_seating_info where entity_id=".$selq_row['entity_id']));
							
							?>
							<td><?php echo $seatCapacity; ?>
								<?php
								  if($seating_capinfo!='')
									{
									?>
							<a href="#" class="infoIcon">&nbsp;
									<div class="infoBox">
									<span></span>
										<?php echo $seating_capinfo['field_seating_info_value'];?>
									</div>
							</a>
								<?php
									}
								?>
							</td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Boot Capacity</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$bootlq = "radius".$i;
							$bootlq_row = @mysql_fetch_assoc(mysqli_query($$bootlq));
							if($bootlq_row['field_spec_boot_value']!='')
							{
								$bootCapacity = $bootlq_row['field_spec_boot_value']." Liters";
							}
							else
							{
								//$bootCapacity = 'N/A';
								$bootCapacity = $naimgpath;
							}
							?>
							<td><?php echo $bootCapacity; ?></td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Fuel Tank Capacity</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$fulq = "fuel".$i;
							$fulq_row = @mysql_fetch_assoc(mysqli_query($$fulq));
							if($fulq_row['field_spec_fuel_tank_value']!='')
							{
								$fuelCapacity = $fulq_row['field_spec_fuel_tank_value']." Liters";
							}
							else
							{
								//$fuelCapacity = 'N/A';
								$fuelCapacity = $naimgpath ;
							}
							?>
							<td><?php echo $fuelCapacity; ?></td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
				</table><!-- speciTable -->
				
				<table class="speciTable compareTable" id="engine-type">
					<thead>
						<tr>
							<th colspan="6">Engine</th>
						</tr>	
					</thead>
					<tr>
						<td>Fuel Type</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$fueltype = "fueltype".$i;
							$fueltype_row = @mysql_fetch_assoc(mysqli_query($$fueltype));
							if($fueltype_row['field_engine_fuel_value']!='')
							{
								$fType = $fueltype_row['field_engine_fuel_value'];
							}
							else
							{
								//$eType = 'N/A';
								$fType = $naimgpath ;
							}
							?>
							<td><?php echo $fType; ?></td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Type</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$etype = "etype".$i;
							$etype_row = @mysql_fetch_assoc(mysqli_query($$etype));
							if($etype_row['field_spec_engine_type_value']!='')
							{
								$eType = $etype_row['field_spec_engine_type_value'];
							}
							else
							{
								//$eType = 'N/A';
								$eType = $naimgpath ;
							}
							?>
							<td><?php echo $eType; ?></td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Displacement</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
								$disp = "disp".$i;
								$disp_row = @mysql_fetch_assoc(mysqli_query($$disp));
								if($disp_row['field_spec_engine_displacement_value']!='')
								{
									$displacement = $disp_row['field_spec_engine_displacement_value']." cc";
								}
								else
								{
									//$displacement = 'N/A';
									$displacement = $naimgpath ;
								}
							?>
								<td><?php echo $displacement; ?></td>
							<?php
							}
							else
							{
							?>
								<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Cylinders</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
								$cyln = "cyln".$i;
								$cyln_row = @mysql_fetch_assoc(mysqli_query($$cyln));
								if($cyln_row['field_spec_engine_cylinders_value']!='')
								{
									$cylinders = $cyln_row['field_spec_engine_cylinders_value'];//." cyl";
								}
								else
								{
									//$cylinders = 'N/A';
									$cylinders = $naimgpath;
								}
							?>
							<td><?php echo $cylinders; ?></td>
							<?php
							}
							else
							{
							?>
								<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Valvetrain</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$vtrain = "vtrain".$i;
							$vtrain_row = @mysql_fetch_assoc(mysqli_query($$vtrain));
							if($vtrain_row['field_spec_engine_valvetrain_value']!='')
							{
								$valveTrain = $vtrain_row['field_spec_engine_valvetrain_value'];
							}
							else
							{
								//$valveTrain = 'N/A';
								$valveTrain = $naimgpath;
							}
							?>
							<td><?php echo $valveTrain; ?></td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Bore & Stroke</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$bore = "bore".$i;
							$bore_row = @mysql_fetch_assoc(mysqli_query($$bore));
							if($bore_row['field_spec_engine_bore_value']!='')
							{
								$boreStroke = $bore_row['field_spec_engine_bore_value']." mm";
							}
							else
							{
								//$boreStroke = 'N/A';
								$boreStroke =$naimgpath;
							}
							?>
							<td><?php echo $boreStroke; ?></td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Compression ratio</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$comp = "comp".$i;
							$comp_row = @mysql_fetch_assoc(mysqli_query($$comp));
							if($comp_row['field_spec_engine_comp_ratio_value']!='')
							{
								$compressionRatio = $comp_row['field_spec_engine_comp_ratio_value'];
							}
							else
							{
								//$compressionRatio = 'N/A';
								$compressionRatio = $naimgpath;
							}
							?>
							<td><?php echo $compressionRatio; ?></td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Max Power</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$mPower = "mPower".$i;
							$mPower_row = @mysql_fetch_assoc(mysqli_query($$mPower));
							if($mPower_row['field_spec_engine_power_value']!='')
							{
								$maxPower = $mPower_row['field_spec_engine_power_value']." rpm";
							}
							else
							{
								//$maxPower = 'N/A';
								$maxPower = $naimgpath;
							}
							?>
							<td><?php echo $maxPower; ?></td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Max Torque</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$mTorque = "mTorque".$i;
							$mTorque_row = @mysql_fetch_assoc(mysqli_query($$mTorque));
							if($mTorque_row['field_spec_fuel_tank_value']!='')
							{
								$maxTorque = $mTorque_row['field_spec_fuel_tank_value']." rpm";
							}
							else
							{
								//$maxTorque = 'N/A';
								$maxTorque = $naimgpath;
							}
							?>
							<td><?php echo $maxTorque; ?></td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Power to weight ratio</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$p2w = "p2w".$i;
							$p2w_row = @mysql_fetch_assoc(mysqli_query($$p2w));
							if($p2w_row['field_spec_engine_power_weight_value']!='')
							{
								$powerWeight = $p2w_row['field_spec_engine_power_weight_value']." Nm/tonne";
							}
							else
							{
								//$powerWeight = 'N/A';
								$powerWeight = $naimgpath;
							}
							?>
							<td><?php echo $powerWeight; ?></td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Torque to weight ratio</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$p2t = "p2t".$i;
							$p2t_row = @mysql_fetch_assoc(mysqli_query($$p2t));
							if($p2t_row['field_spec_engine_torque_weight_value']!='')
							{
								$torqueWeight = $p2t_row['field_spec_engine_torque_weight_value']." Nm/tonne";
							}
							else
							{
								//$torqueWeight = 'N/A'; 
								$torqueWeight = $naimgpath;
							}
							?>
							<td><?php echo $torqueWeight; ?></td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>BHP / Liter</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$p2t = "p2t".$i;
							$p2t_row = @mysql_fetch_assoc(mysqli_query($$p2t));
							if($p2t_row['field_spec_engine_bhp_value']!='')
							{
								$bhpLiter = $p2t_row['field_spec_engine_bhp_value']." bhp/liter";
							}
							else
							{
								//$bhpLiter = 'N/A';
								$bhpLiter = $naimgpath;
							}
							?>
							<td><?php echo $bhpLiter; ?></td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Drivetrain</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$dtrain = "dtrain".$i;
							$dtrain_row = @mysql_fetch_assoc(mysqli_query($$dtrain));
							if($dtrain_row['field_spec_engine_drivetrain_value']!='')
							{
								$driveTrain = $dtrain_row['field_spec_engine_drivetrain_value'];
							}
							else
							{
								//$driveTrain = 'N/A';
								$driveTrain = $naimgpath;
							}
							?>
							<td><?php echo $driveTrain; ?></td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Transmission</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$etrans = "etrans".$i;
							$etrans_row = @mysql_fetch_assoc(mysqli_query($$etrans));
							if($etrans_row['field_spec_engine_transmission_value']!='')
							{
								$eTransmission = $etrans_row['field_spec_engine_transmission_value'];
							}
							else
							{
								//$eTransmission = 'N/A';
								$eTransmission = $naimgpath;
							}
							?>
							<td><?php echo $eTransmission; ?></td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Service Intervals</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$sInt = "sInt".$i;
							$sInt_row = @mysql_fetch_assoc(mysqli_query($$sInt));
							if($sInt_row['field_spec_engine_service_value']!='')
							{
								$serviceInterval = $sInt_row['field_spec_engine_service_value']." kms";
							}
							else
							{
								//$serviceInterval = 'N/A'; 
								$serviceInterval = $naimgpath;
							}
							?>
							<td><?php echo $serviceInterval; ?></td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
				</table><!-- speciTable -->
				
				<table class="speciTable compareTable" id="spec-suspension">
					<thead>
						<tr>
							<th colspan="6">Suspension</th>
						</tr>	
					</thead>
					<tr>
						<td>Steering type</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$steer = "steer".$i;
							$steer_row = @mysql_fetch_assoc(mysqli_query($$steer));
							if($steer_row['field_spec_steering_value']!='')
							{
								$steering = $steer_row['field_spec_steering_value'];
							}
							else
							{
								//$steering = 'N/A';
								$steering = $naimgpath;
							}
							?>
							<td><?php echo $steering; ?></td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Front suspension</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$front = "front".$i;
							$front_row = @mysql_fetch_assoc(mysqli_query($$front));
							if($front_row['field_spec_front_value']!='')
							{
								$fSuspension = $front_row['field_spec_front_value'];
							}
							else
							{
								//$fSuspension = 'N/A';
								$fSuspension = $naimgpath;
							}
							?>
							<td><?php echo $fSuspension; ?></td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Rear suspension</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$rear = "rear".$i;
							$rear_row = @mysql_fetch_assoc(mysqli_query($$rear));
							if($rear_row['field_spec_fuel_tank_value']!='')
							{
								$rSuspension = $rear_row['field_spec_fuel_tank_value'];
							}
							else
							{
								//$rSuspension = 'N/A';
								$rSuspension = $naimgpath;
							}
							?>
							<td><?php echo $rSuspension; ?></td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>
							Tyre size
						</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$tSize = "tSize".$i;
							$tSizeCaption = "tSizeCaption".$i;
							$tSize_row = @mysql_fetch_assoc(mysqli_query($$tSize));
							if($tSize_row['field_spec_tyre_value']!='')
							{
								$tyreSize = $tSize_row['field_spec_tyre_value'];
							}
							else
							{
								//$tyreSize = 'N/A';
								$tyreSize = $naimgpath;
							}
					$tSizeCaption_row= @mysql_fetch_assoc(mysqli_query("select field_tyre_size_caption_value from field_data_field_tyre_size_caption where field_data_field_tyre_size_caption.entity_id=".$tSize_row['entity_id']));
							?>
							<td>
								<?php echo $tyreSize; ?>
								<?php
								if($tSizeCaption_row!='')
									{
								?>
								<a href="#" class="infoIcon">&nbsp;
									<div class="infoBox">
										<span></span>
										<?php
										echo $tSizeCaption_row['field_tyre_size_caption_value'];
										?>
									</div>
								</a>
								<?php
									}
								?>
							</td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Brakes : Front / Rear</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$breaks = "breaks".$i;
							$breaks_row = @mysql_fetch_assoc(mysqli_query($$breaks));
							if($breaks_row['field_spec_brakes_value']!='')
							{
								$brakes = $breaks_row['field_spec_brakes_value'];
							}
							else
							{
								//$brakes = 'N/A'; 
								$brakes = $naimgpath;
							}
							$brakeinfo_row = @mysql_fetch_assoc(mysqli_query("select field_brakes_info_value from field_data_field_brakes_info where entity_id=".$breaks_row['entity_id']));
							?>
							<td><?php echo $brakes; ?>
							<?php
							if($brakeinfo_row!='')
								{
							?>
							<a href="#" class="infoIcon">&nbsp;
									<div class="infoBox">
									<span></span>
									<?php echo $brakeinfo_row['field_brakes_info_value'];?>
									</div>
							</a>
							<?php
								}
							?>
							</td>
							<?php
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
				</table><!-- speciTable -->
			</div><!-- padT5 -->
			
			<div class="accTitle featuHead">
				<h4><a href="#">FEATURES</a></h4>
			</div>
			<div class="padT5">
				<table class="speciTable compareTable" id="features-safety">
					<thead>
						<tr>
							<th colspan="6">Safety</th>
						</tr>	
					</thead>
					<tr>
						<td>Airbags</td>
						<?php
						
						function getOption($val)
						{
							switch($val){
								case 0:
									//echo "<td class='aCenter'>N/A</td>";
									echo "<td class='aCenter'><img src='/themes/bhp/images/cross.png' /></td>";
									break;
								case 1:
									echo "<td><div class='tickMarkIcon'>&nbsp;</div></td>";
									break;
								case 2:
									echo "<td class='aCenter'>Optional</td>";
									break;
								default:
									//echo "<td class='aCenter'>N/A</td>";
									echo "<td class='aCenter'><img src='/themes/bhp/images/cross.png' /></td>";
									break;								
							}
						}
						$fid='';
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$air_q = "air".$i;
							$air_q_row = @mysql_fetch_assoc(mysqli_query($$air_q));
								if($air_q_row['entity_id']!='')
									{
							$fid.=$air_q_row['entity_id'].",";
									}
							echo getOption($air_q_row['field_features_air_bags_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>ABS</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$abs_q = "abs".$i;
							$abs_q_row = @mysql_fetch_assoc(mysqli_query($$abs_q));
							echo getOption($abs_q_row['field_features_abs_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Traction control</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$traction_q = "traction".$i;
							$traction_q_row = @mysql_fetch_assoc(mysqli_query($$traction_q));
							echo getOption($traction_q_row['field_features_traction_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>ESC / ESP</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$esc_q = "esc".$i;
							$esc_q_row = @mysql_fetch_assoc(mysqli_query($$esc_q));
							echo getOption($esc_q_row['field_features_esc_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Fog lights</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$fog_q = "fog".$i;
							$fog_q_row = @mysql_fetch_assoc(mysqli_query($$fog_q));
							echo getOption($fog_q_row['field_features_fog_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Rear wash / wipe</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$rear_q = "rear".$i;
							$rear_q_row = @mysql_fetch_assoc(mysqli_query($$rear_q));
							echo getOption($rear_q_row['field_features_wipe_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Engine immobiliser</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$engine_q = "engine".$i;
							$engine_q_row = @mysql_fetch_assoc(mysqli_query($$engine_q));
							echo getOption($engine_q_row['field_features_immobiliser_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Alloy wheels</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$alloy_q = "alloy".$i;
							$alloy_q_row = @mysql_fetch_assoc(mysqli_query($$alloy_q));
							echo getOption($alloy_q_row['field_features_alloy_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<?php
			$sql_add_Safety=@mysqli_query("SELECT * FROM `team_bhp_features` WHERE nid IN (".substr($fid,0,-1).") AND category = 'Safety' GROUP BY feature_name ORDER BY nid");
				if(mysqli_num_rows($sql_add_Safety)>0)
					{
					$e=explode(",",substr($fid,0,-1));
					while($d_sft_addit=@mysqli_fetch_array($sql_add_Safety))
									{
									$safetyID = strtolower(str_replace(" ", "", $d_sft_addit['feature_name']));
						?>
						<tr id="<?php echo $safetyID ?>">
							<td><?php echo $d_sft_addit['feature_name'];?></td>
						 <?php
							 for($l=0;$l<count($e);$l++)
							 	{
							 	$sql_safety=mysqli_query("select feature_option from team_bhp_features where nid=".$e[$l]." and category='Safety' and feature_name='".$d_sft_addit['feature_name']."'");
							 		$r_sft=mysql_fetch_assoc($sql_safety);
							 		echo getOption($r_sft['feature_option']);	
							 	}
							 	if(count($e)<5)
										{
										for($m=0;$m<(5-count($e));$m++)
											{
										echo "<td class='aCenter'>&nbsp;</td>";	
											}
										}
						?>
						</tr>
					<?php
								   }
				 	 }
				?>
				</table><!-- speciTable -->
				
				<table class="speciTable compareTable" id="features-enhancements">
					<thead>
						<tr>
							<th colspan="6">Driver Enhancements</th>
						</tr>	
					</thead>
					<tr>
						<td>Power steering</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$psteer_q = "psteering".$i;
							$psteer_q_row = @mysql_fetch_assoc(mysqli_query($$psteer_q));
							echo getOption($psteer_q_row['field_features_power_steering_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Steering - Tilt adj.</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$tilt_q = "tilt".$i;
							$tilt_q_row = @mysql_fetch_assoc(mysqli_query($$tilt_q));
							echo getOption($tilt_q_row['field_features_steering_tilt_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Steering - Reach adj.</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$st_reach_q = "st_reach".$i;
							$st_reach_q_row = @mysql_fetch_assoc(mysqli_query($$st_reach_q));
							echo getOption($st_reach_q_row['field_features_steering_reach_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Height adj. driver seat</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$fHeight_q = "fHeight".$i;
							$fHeight_q_row = @mysql_fetch_assoc(mysqli_query($$fHeight_q));
							echo getOption($fHeight_q_row['field_features_height_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Adj. lumbar support</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$lumbar_q = "lumbar".$i;
							$lumbar_q_row = @mysql_fetch_assoc(mysqli_query($$lumbar_q));
							echo getOption($lumbar_q_row['field_features_lumbar_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Dead pedal</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$dead_q = "dead".$i;
							$dead_q_row = @mysql_fetch_assoc(mysqli_query($$dead_q));
							echo getOption($dead_q_row['field_features_dead_pedal_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Center armrest</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$arm_q = "arm".$i;
							$arm_q_row = @mysql_fetch_assoc(mysqli_query($$arm_q));
							echo getOption($arm_q_row['field_features_armrest_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Electric mirrors</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$mirror_q = "mirror".$i;
							$mirror_q_row = @mysql_fetch_assoc(mysqli_query($$mirror_q));
							echo getOption($mirror_q_row['field_features_mirrors_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Multi-information display</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$infoDisplay_q = "infoDisplay".$i;
							$infoDisplay_q_row = @mysql_fetch_assoc(mysqli_query($$infoDisplay_q));
							echo getOption($infoDisplay_q_row['field_features_info_display_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Parking sensors</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$sensors_q = "sensors".$i;
							$sensors_q_row = @mysql_fetch_assoc(mysqli_query($$sensors_q));
							echo getOption($sensors_q_row['field_features_sensors_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Automatic gearbox</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$gear_q = "gear".$i;
							$gear_q_row = @mysql_fetch_assoc(mysqli_query($$gear_q));
							echo getOption($gear_q_row['field_features_gear_box_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					
					<?php
			$sql_add_denhance=@mysqli_query("SELECT * FROM `team_bhp_features` WHERE nid IN (".substr($fid,0,-1).") AND category = 'Driver Enhancements' GROUP BY feature_name ORDER BY nid");
				if(mysqli_num_rows($sql_add_denhance)>0)
					{
					$e=explode(",",substr($fid,0,-1));
					while($d_add_denh=@mysqli_fetch_array($sql_add_denhance))
									{
								$driverID = strtolower(str_replace(" ", "", $d_add_denh['feature_name']));
						?>
						<tr id="<?php echo $driverID ?>">
							<td><?php echo $d_add_denh['feature_name'];?></td>
						 <?php
							 for($l=0;$l<count($e);$l++)
										{
										$sql_denhance=mysqli_query("select feature_option from team_bhp_features where nid=".$e[$l]." and category='Driver Enhancements' and feature_name='".$d_add_denh['feature_name']."'");
											$r_den=mysql_fetch_assoc($sql_denhance);
											echo getOption($r_den['feature_option']);	
										}
									if(count($e)<5)
										{
										for($m=0;$m<(5-count($e));$m++)
											{
										echo "<td class='aCenter'>&nbsp;</td>";	
											}
										}
						?>
						</tr>
					<?php
								   }
				 	 }
			?>
				</table><!-- speciTable -->
				
				<table class="speciTable compareTable" id="features-convinience">
					<thead>
						<tr>
							<th colspan="6">Convenience</th>
						</tr>	
					</thead>
					<tr>
						<td>Remote locking</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$remote_q = "remote".$i;
							$remote_q_row = @mysql_fetch_assoc(mysqli_query($$remote_q));
							echo getOption($remote_q_row['field_features_remote_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Central locking</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$central_q = "central".$i;
							$central_q_row = @mysql_fetch_assoc(mysqli_query($$central_q));
							echo getOption($central_q_row['field_features_central_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Power windows</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$window_q = "window".$i;
							$window_q_row = @mysql_fetch_assoc(mysqli_query($$window_q));
							echo getOption($window_q_row['field_features_window_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Air-conditioner</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$airC_q = "airC".$i;
							$airC_q_row = @mysql_fetch_assoc(mysqli_query($$airC_q));
							echo getOption($airC_q_row['field_features_air_conditioner_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Climate control</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$climate_q = "climate".$i;
							$climate_q_row = @mysql_fetch_assoc(mysqli_query($$climate_q));
							echo getOption($climate_q_row['field_features_climate_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Rear air-con vents</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$vents_q = "vents".$i;
							$vents_q_row = @mysql_fetch_assoc(mysqli_query($$vents_q));
							echo getOption($vents_q_row['field_features_vents_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Leather seats</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$seats_q = "seats".$i;
							$seats_q_row = @mysql_fetch_assoc(mysqli_query($$seats_q));
							echo getOption($seats_q_row['field_features_seats_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Sunroof</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$sunRoof_q = "sunRoof".$i;
							$sunRoof_q_row = @mysql_fetch_assoc(mysqli_query($$sunRoof_q));
							echo getOption($sunRoof_q_row['field_features_sun_roof_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Fold-down rear seat</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$fold_q = "fold".$i;
							$fold_q_row = @mysql_fetch_assoc(mysqli_query($$fold_q));
							echo getOption($fold_q_row['field_features_fold_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Split rear seats</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$split_q = "split".$i;
							$split_q_row = @mysql_fetch_assoc(mysqli_query($$split_q));
							echo getOption($split_q_row['field_features_split_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<?php
			$sql_add_Convenience=@mysqli_query("SELECT * FROM `team_bhp_features` WHERE nid IN (".substr($fid,0,-1).") AND category = 'Convenience' GROUP BY feature_name ORDER BY nid");
				if(mysqli_num_rows($sql_add_Convenience)>0)
					{
					$e=explode(",",substr($fid,0,-1));
					while($d_add_conv=@mysqli_fetch_array($sql_add_Convenience))
									{
								$convenienceID = strtolower(str_replace(" ", "", $d_add_conv['feature_name']));
						?>
						<tr id="<?php echo $convenienceID ?>">
							<td><?php echo $d_add_conv['feature_name'];?></td>
						 <?php
							 for($l=0;$l<count($e);$l++)
										{
										$sql_Convenience=mysqli_query("select feature_option from team_bhp_features where nid=".$e[$l]." and category='Convenience' and feature_name='".$d_add_conv['feature_name']."'");
											$r_Convenience=mysql_fetch_assoc($sql_Convenience);
											echo getOption($r_Convenience['feature_option']);	
										}
									if(count($e)<5)
										{
										for($m=0;$m<(5-count($e));$m++)
											{
										echo "<td class='aCenter'>&nbsp;</td>";	
											}
										}
						?>
						</tr>
					<?php
								   }
				 	 }
			?>
				</table><!-- speciTable -->
				
				<table class="speciTable compareTable" id="features-entertainment">
					<thead>
						<tr>
							<th colspan="6">Entertainment</th>
						</tr>	
					</thead>
					<tr>
						<td>Number of speakers</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$speakers_q = "speakers".$i;
							$speakers_q_row = @mysql_fetch_assoc(mysqli_query($$speakers_q));
							if($speakers_q_row['field_number_of_speakers_value']!='')
								{
									echo "<td class='aCenter'>".$speakers_q_row['field_number_of_speakers_value']."</td>";
								}
							else
								{
									//echo "<td class='aCenter'>N/A</td>";
									echo "<td class='aCenter'>".$naimgpath."</td>";
									
								}
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>CD Player</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$cd_q = "cd".$i;
							$cd_q_row = @mysql_fetch_assoc(mysqli_query($$cd_q));
							echo getOption($cd_q_row['field_features_cd_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>AUX input</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$aux_q = "aux".$i;
							$aux_q_row = @mysql_fetch_assoc(mysqli_query($$aux_q));
							echo getOption($aux_q_row['field_features_aux_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>USB input</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$usb_q = "usb".$i;
							$usb_q_row = @mysql_fetch_assoc(mysqli_query($$usb_q));
							echo getOption($usb_q_row['field_features_usb_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<tr>
						<td>Bluetooth connectivity</td>
						<?php
						$fid='';
						for($i=0; $i<5; $i++)
						{
							
							if($i<$s)
							{
							$bTooth_q = "bTooth".$i;
							$bTooth_q_row = @mysql_fetch_assoc(mysqli_query($$bTooth_q));
							if($bTooth_q_row['entity_id']!='')
								{
							$fid.=$bTooth_q_row['entity_id'].",";
								}
							echo getOption($bTooth_q_row['field_features_bluetooth_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						
						?>
					</tr>
					<tr>
						<td>Steering-mounted controls</td>
						<?php
						for($i=0; $i<5; $i++)
						{
							if($i<$s)
							{
							$steeMoun_q = "steeMoun".$i;
							$steeMoun_q_row = @mysql_fetch_assoc(mysqli_query($$steeMoun_q));
							echo getOption($steeMoun_q_row['field_features_steering_value']);
							}
							else
							{
							?>
							<td>&nbsp;</td>
							<?php
							}
						}
						?>
					</tr>
					<?php
			$sql_add_entertainment=@mysqli_query("SELECT * FROM `team_bhp_features` WHERE nid IN (".substr($fid,0,-1).") AND category = 'Entertainment' GROUP BY feature_name ORDER BY nid");
				if(mysqli_num_rows($sql_add_entertainment)>0)
					{
					$e=explode(",",substr($fid,0,-1));
					while($d_ent_addit=@mysqli_fetch_array($sql_add_entertainment))
									{
							$entertainmentID = strtolower(str_replace(" ", "", $d_ent_addit['feature_name']));
					?>
					<tr id="<?php echo $entertainmentID ?>">
					<td><?php echo $d_ent_addit['feature_name'];?></td>
						<?php
								 for($l=0;$l<count($e);$l++)
										{
										$sql_ent=mysqli_query("select feature_option from team_bhp_features where nid=".$e[$l]." and category='Entertainment' and feature_name='".$d_ent_addit['feature_name']."'");
											$r=mysql_fetch_assoc($sql_ent);
											echo getOption($r['feature_option']);	
										}
									if(count($e)<5)
										{
										for($m=0;$m<(5-count($e));$m++)
											{
										echo "<td class='aCenter'>&nbsp;</td>";	
											}
										}
							?>
					</tr>
					<?php
									}
						}
					?>
				</table><!-- speciTable -->
			</div><!-- padT5 -->
		</div><!-- compareHideShow -->
	</div><!-- compareContent -->
	<div class="padLR10 clearfix">
		<a class="fleft btnLeft" href="/?q=reviews&<?php echo $ses; ?>" title="Back to Search Result">
			<span>Back to Search Result</span>
		</a>
	</div><!-- padLR10 -->
</div><!-- articles -->
<?php
}
?>
