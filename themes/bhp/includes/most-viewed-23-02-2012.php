<?php
$sql_news_weekly_viewd=@mysqli_query("SELECT node.title,node.nid,node_counter.totalcount, node_counter.daycount
FROM node, node_counter
WHERE node.nid = node_counter.nid
AND node.type = 'news' and node_counter.timestamp and  node_counter.timestamp >=".strtotime("- 7 day")." order by node_counter.totalcount desc limit 0,5");

$sql_news_monthly_viewd=@mysqli_query("SELECT node.title,node.nid,node_counter.totalcount, node_counter.daycount
FROM node, node_counter
WHERE node.nid = node_counter.nid
AND node.type = 'news' and node_counter.timestamp and  node_counter.timestamp >=".strtotime("- 30 day")." order by node_counter.totalcount desc limit 0,5");
$num_monthli=mysqli_num_rows($sql_news_monthly_viewd);
$num_weekly=mysqli_num_rows($sql_news_weekly_viewd);
?>
<script type="text/javascript">		    
(function ($) {
$(function(){
	$(".listHolder").hover(
	function(){
			$(this).addClass("hover");
		},
	function(){
			$(this).removeClass("hover");
			}
	);
	
	$(".mv_tab_content li .listBox").hover(
	function(){
			$(this).addClass("hover");
		},
	function(){
			$(this).removeClass("hover");
			}
	);
	
	$(function()
					{	
						$(".mv_tab_content li").click(function(){
							 window.location="news-details.php";
						});
					}
		);
		
	jQuery("ul.most_view li a").click(function(){
		jQuery("ul.most_view li a").removeClass('active');
		jQuery(this).addClass('active');
		jQuery('div.mv_tab_content').css('display', 'none');
		jQuery(jQuery(this).attr('href')).fadeIn("fast");
		return false;
	});
	
	});
})(jQuery);

</script>

<?php
if(($num_weekly >0 ) ||($num_monthli >0 ))
	{
?>
<div class="roundAll5 clearfix mostViewed marB10">
	<h4>Most Viewed</h4>
	
	<ul class="most_view clearfix marT10">
		<?php
		if($num_weekly>0)
			{
		?>
		<li class="TLR5"><a href="#mv_tab1" class="TLR5 active">This Week</a></li>
		<?php
			}
		if($num_monthli>0)
			{
		?>
		<li class="TLR5"><a href="#mv_tab2" class="TLR5">This Month</a></li>
		<?php
			}
		?>
	</ul>
	
	<div class="mv_tab_container">
		<?php
		if($num_weekly >0)
			{
		?>
		<div id="mv_tab1" class="mv_tab_content BLR5" style="display:block">
			
			<ul>
			<?php
			while($weekly_news=mysqli_fetch_array($sql_news_weekly_viewd))
				{
				$sql_img=@mysqli_fetch_array(mysqli_query("select uri from file_managed,field_data_field_news_images where field_data_field_news_images.field_news_images_fid=file_managed.fid and field_data_field_news_images.entity_id=".$weekly_news['nid']));
					if($sql_img=='')
						{
				$sql_img = @mysqli_fetch_array(mysqli_query("select field_news_list_image_fid, uri from field_data_field_news_list_image, file_managed where field_data_field_news_list_image.field_news_list_image_fid=file_managed.fid  and field_data_field_news_list_image.entity_id=".$weekly_news['nid']));// or die(mysql_error());
						}

			?>
				<li class="clearfix">
					<div class="listBox clearfix">
						<div class="fleft w70 marR10" class="listBoxHolder">
							
							
							<a class="listImg" href="<?php echo url("node/".$weekly_news['nid']);?>" title="<?php echo $weekly_news['title'];?>">
								<?php
									if($sql_img)
									{
								?>
								<!--<img src="http://www.team-bhp.com/sites/default/files/<?php echo str_replace("public://","",$sql_img['uri']);?>" width="70" height="53" alt="<?php echo $weekly_news['title'];?>" />-->
								<strong>
								<img src="http://www.team-bhp.com/sites/default/files/styles/check_thumb_review_detail/public/<?php echo str_replace("public://","",$sql_img['uri']);?>" alt="<?php echo $weekly_news['title'];?>" />
								</strong>
								<?php
									}
									else
									{
									echo "No image";
									}
									
								?>
							</a>
						</div><!-- fleft w70 -->
					
						<a href="<?php echo url("node/".$weekly_news['nid']);?>" title="<?php echo $weekly_news['title'];?>"><?php echo $weekly_news['title'];?></a>
						
					</div>
				</li>
			<?php
				}
			?>
				

			</ul>
					
		</div><!-- tab 1 -->
	<?php
		}
		if($num_monthli>0)
			{
			if($num_weekly==0)
				{
				$style="block";
				}
			else
				{
			   $style="none";	
				}
	?>
		<div id="mv_tab2" class="mv_tab_content" style="display:<?php echo $style;?>">
			<ul>
				<?php
			while($monthly_news=mysqli_fetch_array($sql_news_monthly_viewd))
				{
				$sql_imgmonthly=@mysqli_fetch_array(mysqli_query("select uri from file_managed,field_data_field_news_images where field_data_field_news_images.field_news_images_fid=file_managed.fid and field_data_field_news_images.entity_id=".$monthly_news['nid']));
					if($sql_imgmonthly=='')
						{
				$sql_imgmonthly=@mysqli_fetch_array(mysqli_query("select field_news_list_image_fid, uri from field_data_field_news_list_image, file_managed where field_data_field_news_list_image.field_news_list_image_fid=file_managed.fid  and field_data_field_news_list_image.entity_id=".$monthly_news['nid']));
						}
			?>

				<li class="clearfix">
					<div class="listBox clearfix">
						<div class="fleft w70 marR10">
							<a class="listImg" href="<?php echo url("node/".$monthly_news['nid']);?>" title="<?php echo $monthly_news['title'];?>">
								<?php
									if($sql_imgmonthly)
									{
								?>
								<!--<img src="http://www.team-bhp.com/sites/default/files/<?php echo str_replace("public://","",$sql_imgmonthly['uri']);?>" width="70" height="53" alt="<?php echo $monthly_news['title'];?>" />-->
								<strong>
								<img src="http://www.team-bhp.com/sites/default/files/styles/check_thumb_review_detail/public/<?php echo str_replace("public://","",$sql_imgmonthly['uri']);?>" alt="<?php echo $monthly_news['title'];?>" />
								</strong>
								<?php
									}
									else
									{
									echo "No image";
									}
									
								?>
							</a>
						</div><!-- fleft w70 -->
						
						<a href="<?php echo url("node/".$monthly_news['nid']);?>" title="<?php echo $monthly_news['title'];?>"><?php echo $monthly_news['title'];?></a>
					</div><!-- list box -->
				</li>
			<?php
				}
			?>
				
			</ul>
		</div><!-- tab 2 -->
		<?php
			}
		?>
		
	</div><!-- tab container -->
</div><!-- most viewed -->
<?php
	}
?>
