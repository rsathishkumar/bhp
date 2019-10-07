<script type="text/javascript">	
var count=0;
var count1=0;
(function ($) {
$(function(){

$i=0;
$n=0;

	var myInt = setInterval(function(){
  		count ++;
  		if(count==5){
			$j = $i+1;
		 	count = 0;
		 
		 	if($j<$("div.banner").length)
		 		{
		 		$("div.banner").eq($i).fadeIn(800, function(){
					$("div.banner").fadeOut("slow");
					$("div.banner").eq($j).fadeIn("slow");
   					$(".bannerTabs ul li").removeClass("active");
	   				$(".bannerTabs ul li").eq($j).addClass("active");
	   				$("#bannerTitle").text($(this).next().attr("title"));
	   			});	   			
		 		$i = $i+1;
		 		}
		 	else
		 		{
		 		$i=0;
		 		$("div.banner").eq($("div.banner").length-1).fadeIn(800, function(){
		 			$("div.banner").fadeOut("slow");
   					$("div.banner").eq(0).fadeIn("slow");
   					$(".bannerTabs ul li").removeClass("active");
	   				$(".bannerTabs ul li").eq(0).addClass("active");
	   				$("#bannerTitle").text($("div.banner").eq(0).attr("title"));
	   			});
		 		}
		 	}
		},1000);

	$(".bannerTabs ul li").click(function(){
		$listItem = $('ul.highlighter li').index(this);
		$(".bannerTabs ul li").removeClass("active");
		$(this).addClass("active");
		$("div.banner").fadeOut(600);
		$($(this).attr("rel")).fadeIn(600);
		$bannerTitle = $(this).attr("rel");
		$("#bannerTitle").text($($bannerTitle).attr("title"));
		count=0;
		$i=$listItem;
		return false;
	});
});
})(jQuery);
</script>
<?php
//$sql_hpbanner="select node.title,node.nid,file_managed.uri from node,file_managed,field_data_field_banner_image where field_data_field_banner_image.entity_id=node.nid and node.status=1 and field_data_field_banner_image.field_banner_image_fid=file_managed.fid order by node. changed desc";
$sql_hpbanner = "select node.title, node.nid, file_managed.uri, field_banner_url_url from node, file_managed,field_data_field_banner_image, field_data_field_banner_url where field_data_field_banner_image.entity_id=node.nid and node.status=1 and field_data_field_banner_image.field_banner_image_fid=file_managed.fid and field_data_field_banner_url.entity_id=node.nid order by node. changed desc";

$res_hbanner=@mysqli_query($sql_hpbanner);
$nofbanner=@mysqli_num_rows($res_hbanner);
$cnthbanner=1;
		if($nofbanner>0)
			{
			
?>
<div id="highlights" class="homeBanner">
	<div class="BLR5 bannerTabs clearfix">
		<ul class="highlighter clearfix">
			<?php
				while($bannerdata=mysqli_fetch_array($res_hbanner))
					{
			?>
			<li<?php if($cnthbanner==1){?> class="active"<?php }?> rel="#story-<?php echo $cnthbanner;?>">&nbsp;</li>  
			<?php
					$cnthbanner++;
					}
			?>
			<!--  <li rel="#story-2">&nbsp;</li>   
			<li rel="#story-3">&nbsp;</li>  
			<li rel="#story-4">&nbsp;</li>  -->
				
		</ul>
		<?php
		$res_hbanner=@mysqli_query($sql_hpbanner);
		$dataoffimage=@mysqli_fetch_array($res_hbanner);
		?>
		<!-- <a id="nextBanner" class="fright" href="#">&nbsp;</a> -->
		<div id="bannerTitle" class="fright"><?php echo $dataoffimage['title'];?></div>
	</div>
			<?php
				$cnforb=1;
				$res_hbanner=@mysqli_query($sql_hpbanner);
				while($bannerdata=@mysqli_fetch_array($res_hbanner))
					{
			?>
	<!--   <div class="roundAll5 banner homeBanner<?php echo $cnforb;?>" title="<?php echo $bannerdata['title'];?> <?php echo $cnforb;?>" id="story-<?php echo $cnforb;?>" style="display:<?php if($cnforb==1){?>table<?php } else { ?>none<?php }?>;">&nbsp;</div>-->
	<div class="roundAll5 banner" title="<?php echo $bannerdata['title'];?>" id="story-<?php echo $cnforb;?>" style="display:<?php if($cnforb==1){?>table<?php } else { ?>none<?php }?>;"><a href="<?php echo $bannerdata['field_banner_url_url']; ?>"><img src="sites/default/files/<?php echo str_replace("public://","",$bannerdata['uri']);?>" width="620" height="230" alt="<?php echo $bannerdata['title'];?>"/></a></div>
			<?php
					$cnforb++;
					}
			?>
	<!--  <div class="roundAll5 banner homeBanner2" title="The Mercedes CLS AMG 2" id="story-2" style="display:none;">&nbsp;</div>
	<div class="roundAll5 banner homeBanner3" title="The Mercedes CLS AMG 3" id="story-3" style="display:none;">&nbsp;</div>
	<div class="roundAll5 banner homeBanner4" title="The Mercedes CLS AMG 4" id="story-4" style="display:none;">&nbsp;</div>-->
</div><!--homePageBanner-->
<?php
		}
?>
