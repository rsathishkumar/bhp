<?php
$sql_mustread=@mysqli_query("SELECT node.title,node.nid,field_data_field_advice_media_type.field_advice_media_type_value FROM node,field_data_field_show_on_review_price,field_data_field_advice_media_type  WHERE node.nid = field_data_field_show_on_review_price.entity_id and node.nid = field_data_field_advice_media_type.entity_id AND node.type = 'advice' and node.status=1 order by node.changed desc limit 0,6");
$numberofmustread=mysqli_num_rows($sql_mustread);
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
				 window.location="news-details.php";
			});
		}
	);
});
</script>
<?php
	if($numberofmustread>0)
	{
?>
<div class="roundAll5 clearfix mostViewed marB10">
	<h4>Must-Read Articles</h4>
	
	<div class="mv_tab_content BLR5" style="display:block">	
			<ul>
				<?php
					while($data_mustread=mysqli_fetch_array($sql_mustread))
					{
						$sql_Advice_Img = '';
						if($data_mustread['field_advice_media_type_value']=="Image")
						{	
							$sql_Advice_Img = mysqli_fetch_array(mysqli_query("select f.uri from file_managed as f,field_data_field_advice_images where field_data_field_advice_images.field_advice_images_fid=f.fid and field_data_field_advice_images.entity_id=".$data_mustread['nid']));
							if($sql_Advice_Img=='')
							{
								$sql_Advice_Thumb_Img="sites/default/files/defaultmodel_53.gif";
							}
							else
							{
								$sql_Advice_Thumb_Img="?q=sites/default/files/styles/check_thumb_review_detail/public/".str_replace("public://","",$sql_Advice_Img['uri']);
							}
						}
						else
						{
							$sql_Advice_Img = mysqli_fetch_array(mysqli_query("select f.uri from file_managed as f,field_data_field_advice_optional_image where field_data_field_advice_optional_image.field_advice_optional_image_fid=f.fid and field_data_field_advice_images.entity_id=".$data_mustread['nid']));
							if($sql_Advice_Img=='')
							{
								$sql_Advice_Thumb_Img="sites/default/files/defaultmodel_53.gif";
							}
							else
							{
								$sql_Advice_Thumb_Img="?q=sites/default/files/styles/check_thumb_review_detail/public/".str_replace("public://","",$sql_Advice_Img['uri']);
							}
						}
				?>
				<li class="clearfix">
					<div class="listBox clearfix">
						<div class="fleft w70 marR10">
							<a class="listImg" href="<?php echo url("node/".$data_mustread['nid']);?>" title="<?php echo $data_mustread['title'];?>">
								<strong>
									<img src="/<?php echo $sql_Advice_Thumb_Img;?>" alt="<?php echo $data_mustread['title'];?>" />
								</strong>
							</a>
						</div><!-- fleft w70 -->
					
						<a href="<?php echo url("node/".$data_mustread['nid']);?>" title="<?php echo $data_mustread['title'];?>"><?php echo $data_mustread['title'];?></a>
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
