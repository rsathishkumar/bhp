<?php
$sql_mostviews=@mysqli_query("SELECT node.title,node.nid,node_counter.totalcount, node_counter.daycount FROM node, node_counter WHERE node.nid = node_counter.nid AND node.type = 'model' and node_counter.timestamp order by node_counter.totalcount desc limit 0,5");
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
				 window.location="news-details.php";
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
	<h4>Must-Read Articles</h4>
	
	<div class="mv_tab_content BLR5" style="display:block">	
			<ul>
				<?php
				while($data_mviewed=mysqli_fetch_array($sql_mostviews))
					{
					//$sql_carimage=mysqli_fetch_array(mysqli_query("select field_data_field_model_dashboard.field_model_dashboard_fid,field_data_field_model_dashboard.entity_id,file_managed.uri from file_managed,field_data_field_model_dashboard where field_data_field_model_dashboard.field_model_dashboard_fid=file_managed.fid and field_data_field_model_dashboard.entity_id=".$data_mviewed['nid']));
				$sql_sequenceimgprice=@mysqli_fetch_array(mysqli_query("SELECT distinct(field_gallery_interior_alt) as alt, field_gallery_interior_title as title, field_gallery_interior_fid as fid FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_mviewed['nid']."' and field_data_field_gallery_interior.field_gallery_interior_alt!='' UNION SELECT distinct(field_gallery_exterior_alt) as alt, field_gallery_exterior_title as title, field_gallery_exterior_fid as fid FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_mviewed['nid']."' and field_data_field_gallery_exterior.field_gallery_exterior_alt!='' UNION SELECT distinct(field_gallery_engine_alt) as alt, field_gallery_engine_title as title, field_gallery_engine_fid as fid FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_mviewed['nid']."' and field_data_field_gallery_engine.field_gallery_engine_alt!='' UNION SELECT distinct(field_gallery_smaller_alt) as alt, field_gallery_smaller_title as title, field_gallery_smaller_fid as fid FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_mviewed['nid']."' and field_data_field_gallery_smaller.field_gallery_smaller_alt!='' order by alt limit 0,1"));
				if($sql_sequenceimgprice=='')
					{
					$sql_sequencenopimg=@mysqli_fetch_array(mysqli_query("SELECT field_data_field_gallery_interior.delta as delta , field_gallery_interior_title as title, field_gallery_interior_fid as fidint FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_mviewed['nid']."' UNION SELECT field_data_field_gallery_exterior.delta as delta, field_gallery_exterior_title as title, field_gallery_exterior_fid as fidint FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_mviewed['nid']."' UNION SELECT field_data_field_gallery_engine.delta as delta, field_gallery_engine_title as title, field_gallery_engine_fid as fidint FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_mviewed['nid']."' UNION SELECT field_data_field_gallery_smaller.delta as delta, field_gallery_smaller_title as title, field_gallery_smaller_fid as fidint FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_mviewed['nid']."' order by delta limit 0,1"));
						if($sql_sequencenopimg=='')
							{
							
							$model_modleimgnameprice="sites/default/files/defaultmodel_53.gif";
							}
						else
							{
						$model_imgprice=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$sql_sequencenopimg['fidint']));
						$model_modleimgnameprice="?q=sites/default/files/styles/check_thumb_review_detail/public/".str_replace("public://","",$model_imgprice['uri']);
							}
					}
				else
					{
					$model_imgprice=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$sql_sequenceimgprice['fid']));
					$model_modleimgnameprice="?q=sites/default/files/styles/check_thumb_review_detail/public/".str_replace("public://","",$model_imgprice['uri']);
					}	
				?>
				<li class="clearfix">
					<div class="listBox clearfix">
						<div class="fleft w70 marR10">
							<a class="listImg" href="<?php echo url("node/".$data_mviewed['nid']);?>" title="<?php echo $data_mviewed['title'];?>">
								<!-- <img src="http://www.team-bhp.com/sites/default/files/<?php echo str_replace("public://","",$sql_carimage['uri']);?>" width="70" height="53" alt="<?php echo $data_mviewed['title'];?>" />-->
								<strong>
									<img src="http://www.team-bhp.com/<?php echo $model_modleimgnameprice;?>" alt="<?php echo $data_mviewed['title'];?>" />
								</strong>
							</a>
						</div><!-- fleft w70 -->
					
						<a href="<?php echo url("node/".$data_mviewed['nid']);?>" title="<?php echo $data_mviewed['title'];?>"><?php echo $data_mviewed['title'];?></a>
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
