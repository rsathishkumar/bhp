<?php
$sql_mostviews=@mysqli_query("SELECT node.title,node.nid,node_counter.totalcount, node_counter.daycount FROM node, node_counter WHERE node.nid = node_counter.nid AND node.type = 'safety' order by node_counter.totalcount desc limit 0,5");
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
	
	$(function()
		{	
			$(".mv_tab_content ul li").click(function(){
			location.href=$(this).attr("rel");
				// window.location="news-details.php";
			});
		}
	);
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
						$sql_img=@mysqli_fetch_array(mysqli_query("select uri from file_managed,field_data_field_safety_image where field_data_field_safety_image.field_safety_image_fid=file_managed.fid and field_data_field_safety_image.entity_id=".$data_mviewed['nid']));
						$mviewed_data = node_load($data_mviewed['nid']);
				?>
				<li class="clearfix" rel="<?php echo url("node/".$data_mviewed['nid']);?>">
					<div class="listBox clearfix">
						<div class="fleft w70 marR10"> 
							<a  class="listImg" href="<?php echo url("node/".$data_mviewed['nid']);?>" title="<?php echo $mviewed_data->title;?>">
								<!-- <img src="/?q=sites/default/files/styles/thumb_review_detail/public/<?php echo str_replace("public://","",$sql_img['uri']);?>" alt="<?php echo $mviewed_data->title;?>" /> -->
								<strong><img src="/?q=sites/default/files/styles/check_thumb_review_detail/public/<?php echo str_replace("public://","",$sql_img['uri']);?>" alt="<?php echo $mviewed_data->title;?>" /></strong>
								
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
