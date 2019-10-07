<?php
$sql_mostviews=@mysqli_query("SELECT node.title,node.nid,node_counter.totalcount, node_counter.daycount
FROM node, node_counter
WHERE node.nid = node_counter.nid
AND node.type = 'advice' and node_counter.timestamp order by node_counter.totalcount desc limit 0,5");
$numberofadviceview=mysqli_num_rows($sql_mostviews);
?>
<script type="text/javascript">		    
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
					$("ul li.clearfix").click(function(e){
						location.href=$(this).attr("rel");
						return false;
						});
	
});
</script>
<?php
	if($numberofadviceview>0)
		{
?>
<div class="roundAll5 clearfix mostViewed marB10">
	<h4>Most Viewed</h4>
	
	<div class="mv_tab_content BLR5" style="display:block">	
			<ul>
				<?php
				while($data_mviewed=mysqli_fetch_array($sql_mostviews))
				{
					$mviewed_data = node_load($data_mviewed['nid']);
					$sql_img=@mysqli_fetch_array(mysqli_query("select uri from file_managed,field_data_field_advice_images where field_data_field_advice_images.field_advice_images_fid=file_managed.fid and field_data_field_advice_images.entity_id=".$data_mviewed['nid']));
					if($sql_img=='')
					{
						$sql_img=mysqli_fetch_array(mysqli_query("select file_managed.uri from field_data_field_advice_optional_image, file_managed where file_managed.fid = field_data_field_advice_optional_image.field_advice_optional_image_fid and field_data_field_advice_optional_image.entity_id=".$data_mviewed['nid']));
					}
				?>
				<li class="clearfix" rel="<?php echo url("node/".$data_mviewed['nid']);?>">
					<div class="listBox clearfix">
						<div class="fleft w70 marR10">
							<a  class="listImg" href="<?php echo url("node/".$data_mviewed['nid']);?>" title="<?php echo $mviewed_data->title;?>">
								<strong>
								<img src="/?q=sites/default/files/styles/check_thumb_review_detail/public/<?php echo str_replace("public://","",$sql_img['uri']);?>" alt="<?php echo $mviewed_data->title;?>" />
								</strong>
							</a>
						</div><!-- fleft w70 -->
					
						<a href="<?php echo url("node/".$data_mviewed['nid']);?>" title="<?php echo $mviewed_data->title;?>"><?php echo $mviewed_data->title;?></a>
					</div><!-- list box -->
				</li>
				 <?php
				 }
				 ?>

				
			</ul>
	</div>					
</div><!-- most viewed -->
<?php
	}
?>
