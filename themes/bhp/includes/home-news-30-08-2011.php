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
	});
})(jQuery);
</script>
<?php
$q_hnewsinternational="SELECT title, nid FROM node, field_data_field_news_category WHERE field_data_field_news_category.field_news_category_value = 'International' AND node.nid = field_data_field_news_category.entity_id AND node.status =1 AND node.type = 'news' order by node.changed desc limit 0,6";
$res_hnewsinternational=@mysqli_query($q_hnewsinternational);
$nof_hnewsinternational=@mysqli_num_rows($res_hnewsinternational);

$q_hnewsmotorsport="SELECT title, nid FROM node, field_data_field_news_category WHERE field_data_field_news_category.field_news_category_value = 'Motor Sports' AND node.nid = field_data_field_news_category.entity_id AND node.status =1 AND node.type = 'news' order by node.changed desc limit 0,6";
$res_hnewsmotorsport=@mysqli_query($q_hnewsmotorsport);
$nof_hnewsmotorsport=@mysqli_num_rows($res_hnewsmotorsport);


$q_hnews="SELECT title, nid FROM node, field_data_field_news_category WHERE field_data_field_news_category.field_news_category_value = 'Indian' AND node.nid = field_data_field_news_category.entity_id AND node.status =1 AND node.type = 'news' order by node.changed desc limit 0,6";
$res_hnews=@mysqli_query($q_hnews);
$nof_hnews=@mysqli_num_rows($res_hnews);
if($nof_hnews>0 || $nof_hnewsinternational>0  || $nof_hnewsmotorsport>0 )
	{
?>
<div class="homeTab">
	<ul class="tab TLR5 clearfix">
		<li class="titleLi">News</li>
		<li class="secondLi"><a title="Indian" class="TLR5 active news" href="#tab1" id="tab1indian">Indian</a></li>
		<li><a title="International" class="TLR5" href="#tab2" id="tab2International">International</a></li>
		<li><a title="Motor Sports" class="TLR5" href="#tab3" id="tab3MotorSports">Motor Sports</a></li>
	</ul>
	<div class="tab_container BLR5">
		<div id="tab1" class="tabContent" style="display:block">
			<ul class="homeCarList clearfix">
				<?php
					if($nof_hnews>0)
					{
					while($d_india=mysqli_fetch_array($res_hnews))
						{
					$img_res = @mysqli_query("select field_news_images_fid, uri from field_data_field_news_images, file_managed where field_data_field_news_images.field_news_images_fid=file_managed.fid  and field_data_field_news_images.entity_id=".$d_india['nid']) or die(mysql_error());
$img_news=mysqli_fetch_array($img_res);
					if($img_news=='')
						{
					$img_res = @mysqli_query("select field_news_list_image_fid, uri from field_data_field_news_list_image, file_managed where field_data_field_news_list_image.field_news_list_image_fid=file_managed.fid  and field_data_field_news_list_image.entity_id=".$d_india['nid']) or die(mysql_error());
				$img_news=mysqli_fetch_array($img_res);	
						}
						$nodedata_india=node_load($d_india['nid']);
				?>
				<li>
					<a class="clearfix" href="<?php echo url("node/".$d_india['nid']);?>" title="<?php echo $nodedata_india->title;?>">
		<!-- <img width="70" height="53" src="sites/default/files/<?php echo str_replace("public://","",$img_news['uri']);?>" alt="<?php echo $nodedata_india->title;?>" />-->
						<span><img width="70" height="53" src="http://www.team-bhp.com/?q=sites/default/files/styles/thumb_review_detail/public/<?php echo str_replace("public://","",$img_news['uri']);?>" alt="<?php echo $nodedata_india->title;?>" /></span>
						<em><?php echo $nodedata_india->title;?></em>
					</a>	
				</li>
				<?php
						}
					}
					else
					{
					?>
				<li>
					<a class="clearfix">
					No news found under Indian	
					</a>	
				</li>	
				<?php
					}
				?>
				 
			</ul><!-- homeCarList -->
			<div class="marT10 marR12 clearfix">
				<a href="?q=news" class="fright btnRight">
					<span>View All News</span>
				</a>
			</div>
		</div><!-- tabContent -->
		<div id="tab2" class="tabContent news" style="display:none">
			<ul class="homeCarList clearfix">
				<?php
				if($nof_hnewsinternational>0)
					{
					while($d_newsinternational=mysqli_fetch_array($res_hnewsinternational))
						{
						$img_resinter = @mysqli_query("select field_news_images_fid, uri from field_data_field_news_images, file_managed where field_data_field_news_images.field_news_images_fid=file_managed.fid  and field_data_field_news_images.entity_id=".$d_newsinternational['nid']) or die(mysql_error());
$img_newsintern=mysqli_fetch_array($img_resinter);
					if($img_newsintern=='')
						{
					$img_resinter = @mysqli_query("select field_news_list_image_fid, uri from field_data_field_news_list_image, file_managed where field_data_field_news_list_image.field_news_list_image_fid=file_managed.fid  and field_data_field_news_list_image.entity_id=".$d_newsinternational['nid']) or die(mysql_error());
				$img_newsintern=mysqli_fetch_array($img_resinter);	
						}
						$nodedata_int=node_load($d_newsinternational['nid']);
				?>
				<li>
					<a class="clearfix" href="<?php echo url("node/".$d_newsinternational['nid']);?>" title="<?php echo $nodedata_int->title;?>">
					<!-- <img width="70" height="53" src="sites/default/files/<?php echo str_replace("public://","",$img_newsintern['uri']);?>" alt="<?php echo $nodedata_int->title;?>" /> -->
					<img width="70" height="53" src="http://www.team-bhp.com/?q=sites/default/files/styles/thumb_review_detail/public/<?php echo str_replace("public://","",$img_newsintern['uri']);?>" alt="<?php echo $nodedata_int->title;?>" />
						<em><?php echo $nodedata_int->title;?></em>
					</a>	
				</li>
				<?php
						}
					}
					else
					{
				?>
				<li>
					<a class="clearfix">
						No news found under International
					</a>	
				</li>
				<?php
				   }
				?>
				
			</ul><!-- homeCarList -->
			<div class="marT10 marR12 clearfix">
				<a href="?q=news&catname=International" class="fright btnRight">
					<span>View All News</span>
				</a>
			</div>
		</div><!-- tabContent -->
		<div id="tab3" class="tabContent news" style="display:none">
			<ul class="homeCarList clearfix">
				<?php
				if($nof_hnewsmotorsport>0)
					{
					
					while($d_newsmotorsport=mysqli_fetch_array($res_hnewsmotorsport))
						{
						$img_resmsp = @mysqli_query("select field_news_images_fid, uri from field_data_field_news_images, file_managed where field_data_field_news_images.field_news_images_fid=file_managed.fid  and field_data_field_news_images.entity_id=".$d_newsmotorsport['nid']) or die(mysql_error());
$img_newsms=mysqli_fetch_array($img_resmsp);
					if($img_newsms=='')
						{
					$img_resmsp = @mysqli_query("select field_news_list_image_fid, uri from field_data_field_news_list_image, file_managed where field_data_field_news_list_image.field_news_list_image_fid=file_managed.fid  and field_data_field_news_list_image.entity_id=".$d_newsmotorsport['nid']) or die(mysql_error());
				$img_newsms=mysqli_fetch_array($img_resmsp);	
						}
						$nodedata_msport=node_load($d_newsmotorsport['nid']);
				?>
				<li>
					<a class="clearfix" href="<?php echo url("node/".$d_newsmotorsport['nid']);?>" title="<?php echo $nodedata_msport->title;?>">
						<!-- <img width="70" height="53" src="sites/default/files/<?php echo str_replace("public://","",$img_newsms['uri']);?>" alt="<?php echo $nodedata_msport->title;?>" />-->
						<img width="70" height="53" src="http://www.team-bhp.com/?q=sites/default/files/styles/thumb_review_detail/public/<?php echo str_replace("public://","",$img_newsms['uri']);?>" alt="<?php echo $nodedata_msport->title;?>" />
						<em><?php echo $nodedata_msport->title;?></em>
					</a>	
				</li>
				<?php
						}
					}
					else
					{
				?>
				<li>
					<a class="clearfix">
						No news found under Motorsports
					</a>	
				</li>
				<?php
					}
				?>
				
			</ul><!-- homeCarList -->
			<div class="marT10 marR12 clearfix">
				<a href="?q=news&catname=Motor Sports" class="fright btnRight">
					<span>View All News</span>
				</a>
			</div>
		</div><!-- tabContent -->
	</div><!-- tab_container -->	
</div><!-- homeTab -->
<?php
	}
?>
