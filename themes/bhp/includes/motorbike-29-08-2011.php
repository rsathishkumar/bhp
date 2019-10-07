<script type="text/javascript">
(function ($) {
	$(function(){
	var vintageInt = setInterval(function(){
			  count1 ++;
			  if(count1==10){
			  	$j = $n+1;
					 count1 = 0;
					 
					 if($j<$("#vintageCars img").length)
					 	{	
					 		$("#vintageCars img").eq($n).fadeOut(500, function(){
					 			$("#vintageCars img").fadeOut(500);
								$("#vintageCars img").eq($j).fadeIn(500);
								$(".vintageBtn ul li").removeClass("active");
				   				$(".vintageBtn ul li").eq($j).addClass("active");
				   				$(".vintageCars h4").text($(this).next().attr("alt"));
				   				
			   				});
				   			
					 		$n = $n+1;
					 	}
					 else
					 	{
					 		$n=0;
					 		$("#vintageCars img").eq($("#vintageCars img").length-1).fadeOut(500, function(){
					 			$("#vintageCars img").fadeOut(500);
					 			$("#vintageCars img").eq(0).fadeIn(500);
					 			$(".vintageBtn ul li").removeClass("active");
				   				$(".vintageBtn ul li").eq(0).addClass("active");
				   				$(".vintageCars h4").text($("#vintage-1").attr("alt"))
			   				});
					 	}
					 }
			},1000);
			
			$(".vintageBtn ul li").click(function(){
				$listItem = $('.vintageBtn ul li').index(this);
				$(".vintageBtn ul li").removeClass("active");
				$(this).addClass("active");
				$("#vintageCars img").fadeOut(600);
				$($(this).attr("rel")).fadeIn(600);
				$bannerTitle = $(this).attr("rel");
				$(".vintageCars h4").text($($bannerTitle).attr("alt"));
				count1=0;
				$n=$listItem;
				return false;
			});
	});
})(jQuery);
</script>
<?php
$sql_mbike="select node.title,node.nid,field_data_field_external_url.field_external_url_value from node,field_data_field_external_url where node.nid=field_data_field_external_url.entity_id and node.status=1 order by node.changed desc limit 0,5";
$res_mbike=@mysqli_query($sql_mbike);
$nofmbike=@mysqli_num_rows($res_mbike);
if($nofmbike>0)
	{
?>
<div class="marB10 homeThreads">
	<h4 class="TLR5">Motorbikes</h4>
	<div class="threadsList BLR5">
		<ul>
			<?php
			
				while($data_mbike=mysql_fetch_assoc($res_mbike))
					{
				$pthmbike="";	
				if(strstr($data_mbike['field_external_url_value'],"http://"))
				{
				$pthmbike.=$data_mbike['field_external_url_value'];
				}
				else
				{
				$pthmbike.="http://".$data_mbike['field_external_url_value'];
				}
				?>
			<li><a href="<?php echo $pthmbike;?>" target="_blank"><?php echo $data_mbike['title'];?></a></li>
			<?php
					}
			?>
			<!--  <li><a href="#">ABS for Bikes</a></li>
			<li><a href="#">Retro Style Kwasaki W800 Launched</a></li>
			<li><a href="#">Honda 250CC Bike for India</a></li>
			<li><a href="#">How to buy a good helmet?</a></li>
			-->
		</ul>
		<div class="marR15 clearfix">
			<a href="http://www.team-bhp.com/forum/motorbikes/" target="_blank" class="fright btnRight">
				<span>More Bike Threads</span>
			</a>
		</div><!-- marR15 -->
	</div><!-- threadsList -->
</div><!-- homeThreads -->
<?php
	}
?>
