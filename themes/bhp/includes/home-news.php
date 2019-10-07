<script type="text/javascript">
(function ($) {
	$(function(){
		$(".homeTab .tab a").click(function(){
			if ($($(this).attr("href")).css("display")=="none") {
				$(".homeTab .tab a").removeClass("active");
				$(this).addClass("active");
				$(".homeTab .tabContent").css("display","none");
				$($(this).attr("href")).fadeIn(800);
			}
			return false;
		});
			$(".titleLi").click(function()
			{
			location.href='/news';
			});
		
		 	$("#mtrbik").click(function()
			{
			location.href='/?q=hot-threads&catname=Motorbikes';
			});
			
			 $("#car_rview").click(function()
			{
				//location.href='/reviews';
			    location.href='/forum/official-new-car-reviews/?pp=25&sort=dateline&order=desc&daysprune=-1';
			}); 
			$("#htthread").click(function()
			{
			location.href='/hot-threads';
			});
			 $("div.primBlock h4.TLR5").click(function()
			{
			location.href='/advice';
			});
			 $("div.primBlock h4.tech_stuffspcl").click(function()
			{
			location.href='/tech-stuff';
			});
			 $("div#trav_home").click(function()
			{
			location.href='/?q=hot-threads&catname=Travelogues';
			});
			$(".app").click(function()
			{
			window.open('/forum/team-bhp-apps-mobile-access/', '_blank');
			return false;
			});
			$("div.searchClassi h4.TLR5").click(function(){
				location.href = "http://classifieds.team-bhp.com/";
				return false;
			});
		
	});
	
	
	
})(jQuery);
</script>
<?php
//$q_hnewsinternational="SELECT title, nid FROM node, field_data_field_news_category WHERE field_data_field_news_category.field_news_category_value = 'International' AND node.nid = field_data_field_news_category.entity_id AND node.status =1 AND node.type = 'news' order by node.created desc limit 0,6";
$q_hnewsinternational="SELECT node.title,node.nid,node_counter.totalcount, node_counter.daycount FROM node, node_counter WHERE node.nid = node_counter.nid and node.type = 'news' and node_counter.timestamp >='".strtotime("- 30 day")."' and node.created >='".strtotime("- 30 days")."' and node.status=1 order by node_counter.totalcount desc limit 0,6";
$res_hnewsinternational=@mysqli_query($q_hnewsinternational);
$nof_hnewsinternational=@mysqli_num_rows($res_hnewsinternational);

$q_hnews="SELECT title, nid FROM node, field_data_field_news_category WHERE field_data_field_news_category.field_news_category_value = 'Indian' AND node.nid = field_data_field_news_category.entity_id AND node.status =1 AND node.type = 'news' order by node.created desc limit 0,6";
$res_hnews=@mysqli_query($q_hnews);
$nof_hnews=@mysqli_num_rows($res_hnews);
if($nof_hnews>0 || $nof_hnewsinternational>0)
	{
?>
<div class="homeTab">
	<ul class="tab TLR5 clearfix">
		<li class="titleLi">News</li>
		<li class="secondLi"><a title="Latest" class="TLR5 active news" href="#tab1" id="tab1indian">Latest</a></li>
		<li><a title="Most Viewed" class="TLR5" href="#tab2" id="tab2International">Most Viewed</a></li>
	</ul>
	<div class="tab_container BLR5">
		<div id="tab1" class="tabContent" style="display:block">
			
				<?php if($nof_hnews>0) { ?>
					<ul class="homeCarList clearfix">
						<?php
							while($d_india=mysqli_fetch_array($res_hnews))
								{
				$sql_img_check=@mysqli_fetch_array(mysqli_query("select field_news_media_type_value from field_data_field_news_media_type where entity_id =".$d_india['nid']));
							if($sql_img_check['field_news_media_type_value']=='Images')
							{
							$img_res = @mysqli_query("select field_news_images_fid, uri from field_data_field_news_images, file_managed where field_data_field_news_images.field_news_images_fid=file_managed.fid  and field_data_field_news_images.entity_id=".$d_india['nid']) or die(mysql_error());
		$img_news=mysqli_fetch_array($img_res);
							}
							else	
							{
							$img_res = @mysqli_query("select field_news_list_image_fid, uri from field_data_field_news_list_image, file_managed where field_data_field_news_list_image.field_news_list_image_fid=file_managed.fid  and field_data_field_news_list_image.entity_id=".$d_india['nid']) or die(mysql_error());
						$img_news=mysqli_fetch_array($img_res);	
							}
								$nodedata_india=node_load($d_india['nid']);
						?>
						<li>
							<a class="clearfix" href="<?php echo url("node/".$d_india['nid']);?>" title="<?php echo $nodedata_india->title;?>">
								<!-- <img width="70" height="53" src="sites/default/files/<?php echo str_replace("public://","",$img_news['uri']);?>" alt="<?php echo $nodedata_india->title;?>" />-->
								<span>
									<strong>
									<img src="/?q=sites/default/files/styles/check_thumb_review_detail/public/<?php echo str_replace("public://","",$img_news['uri']);?>" alt="<?php //echo $nodedata_india->title;?>" />
									</strong></span>
								<em><?php echo $nodedata_india->title;?></em>
							</a>	
						</li>
					<?php } ?>
				 	</ul><!-- homeCarList -->
					<div class="marT10 marR12 clearfix">
						<a title="View All News" href="news" class="fright btnRight">
							<span>View All News</span>
						</a>
					</div>
			
			<?php } else { ?>
				<div class="noNewsHome">Currently no news is available in this category.</div>	
			<?php } ?>
			
		</div><!-- tabContent -->
		<div id="tab2" class="tabContent news" style="display:none">
			
				<?php
				if($nof_hnewsinternational>0)
					{
				?>
					<ul class="homeCarList clearfix">
					
				<?php
					while($d_newsinternational=mysqli_fetch_array($res_hnewsinternational))
						{
						$sql_img_checkintern=@mysqli_fetch_array(mysqli_query("select field_news_media_type_value from field_data_field_news_media_type where entity_id =".$d_newsinternational['nid']));
						if($sql_img_checkintern['field_news_media_type_value']=='Images')
						{
						$img_resinter = @mysqli_query("select field_news_images_fid, uri from field_data_field_news_images, file_managed where field_data_field_news_images.field_news_images_fid=file_managed.fid  and field_data_field_news_images.entity_id=".$d_newsinternational['nid']) or die(mysql_error());
$img_newsintern=mysqli_fetch_array($img_resinter);
						}
						else
						{
					$img_resinter = @mysqli_query("select field_news_list_image_fid, uri from field_data_field_news_list_image, file_managed where field_data_field_news_list_image.field_news_list_image_fid=file_managed.fid  and field_data_field_news_list_image.entity_id=".$d_newsinternational['nid']) or die(mysql_error());
				$img_newsintern=mysqli_fetch_array($img_resinter);	
						}
						$nodedata_int=node_load($d_newsinternational['nid']);
				?>
				<li>
					<a class="clearfix" href="<?php echo url("node/".$d_newsinternational['nid']);?>" title="<?php echo $nodedata_int->title;?>">
					<!-- <img width="70" height="53" src="sites/default/files/<?php echo str_replace("public://","",$img_newsintern['uri']);?>" alt="<?php echo $nodedata_int->title;?>" /> -->
					<span>
						<strong>
						<img src="/?q=sites/default/files/styles/check_thumb_review_detail/public/<?php echo str_replace("public://","",$img_newsintern['uri']);?>" alt="<?php //echo $nodedata_int->title;?>" />
						</strong>
						</span>
						
						<em><?php echo $nodedata_int->title;?></em>
					</a>	
				</li>
				<?php } ?>
				
				</ul><!-- homeCarList -->
				<div class="marT10 marR12 clearfix">
					<a title="View All News" href="news" class="fright btnRight">
						<span>View All News</span>
					</a>
				</div>
			
			<?php } else { ?>
				<div class="noNewsHome">Currently no news is available in this category.</div>	
			<?php } ?>
			
		</div><!-- tabContent -->
	</div><!-- tab_container -->	
</div><!-- homeTab -->

<!-- /1063105/belownews -->
<div id='div-gpt-ad-1455011226405-0' style='height:80px; width:618px; margin-bottom:10px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1455011226405-0'); });
</script>
</div>
<?php
	}
?>
