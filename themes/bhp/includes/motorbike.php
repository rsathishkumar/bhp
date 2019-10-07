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
//$sql_mbike="select node.title,node.nid,field_data_field_external_url.field_external_url_value from node,field_data_field_external_url where node.nid=field_data_field_external_url.entity_id and node.status=1 order by node.changed desc limit 0,5";
$sql_mbike="SELECT title, field_ht_forum_url,nid FROM node,field_data_field_ht_threads,field_data_field_ht_forum WHERE field_data_field_ht_threads.entity_id = node.nid AND field_data_field_ht_forum.entity_id = field_data_field_ht_threads.entity_id
AND field_data_field_ht_threads.field_ht_threads_value = 'Motorbikes' ORDER BY `node`.`changed` desc  limit 0,5";
$res_mbike=@mysqli_query($sql_mbike);
$nofmbike=@mysqli_num_rows($res_mbike);
if($nofmbike>0)
	{
?>
<div class="marB10 homeThreads">
	<h4 class="TLR5" id="mtrbik">Motorbikes</h4><!-- code for this click event wriiten in home-news-->
	<div class="threadsList BLR5">
		<ul>
			<?php
				
				while($data_mbike=mysql_fetch_assoc($res_mbike))
					{
						$pthmbike="";	
						if(strstr($data_mbike['field_ht_forum_url'],"http://"))
						{
						$pthmbike.=$data_mbike['field_ht_forum_url'];
						}
						else
						{
						$pthmbike.="http://".$data_mbike['field_ht_forum_url'];
						}
						$desc='';
						if(strlen($data_mbike['title'])>30)
					 	{
							if(truncatestringwithspace($data_mbike['title'],24)!=false)
							{
							$desc.= truncatestringwithspace($data_mbike['title'],24);
							}
							else
							{
							$desc.= $data_mbike['title'];
							}
						}
						else
						{
						$desc.= $data_mbike['title'];
						}
				/*if(strlen($data_mbike['title'])>33)
					{
					$finddot=@strpos($data_mbike['title'],".",33);
					$findspcetostop=@strpos($data_mbike['title']," ",33);
					if(intval($finddot)<intval($findspcetostop) && intval($finddot)>1)
						{
						$pos=$finddot;
						}
					else
						{
						$pos=$findspcetostop;
						}
						$pos=$pos+1;
					 }
					if($pos>1)
					{
						$desc = trim(substr($data_mbike['title'],0 , $pos));
					}
					else
					{
						$desc = $data_mbike['title'];
					}
					if(strlen($data_mbike['title'])>33)
					{
					trim($desc.="&hellip;");
					}*/
				?>
			<li><a href="<?php echo bhp_replace_http_strings($data_mbike['field_ht_forum_url']);?>" target="_blank" title="<?php echo $data_mbike['title'];?>"><?php echo $desc;//$data_mbike['title'];?></a></li>
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
		<a title="More bike threads" href="/?q=hot-threads&catname=Motorbikes" class="fright btnRight">
			<!-- <a href="/forum/motorbikes/" target="_blank" class="fright btnRight"> -->
				<span>More Bike Threads</span>
			</a>
		</div><!-- marR15 -->
	</div><!-- threadsList -->
</div><!-- homeThreads -->
<?php
	}
?>
