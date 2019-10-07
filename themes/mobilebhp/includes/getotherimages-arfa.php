<?php
include_once("connect.php");
$q = "(SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid, field_data_field_gallery_interior.field_gallery_interior_fid as uniID, file_managed.uri FROM node, file_managed, field_data_field_gallery_interior, field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_interior.field_gallery_interior_fid  AND field_data_field_gallery_model.field_gallery_model_nid =".$_POST['mid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid) UNION (SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid, field_data_field_gallery_engine.field_gallery_engine_fid as uniID, file_managed.uri FROM node, file_managed, field_data_field_gallery_engine, field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_engine.field_gallery_engine_fid  AND field_data_field_gallery_model.field_gallery_model_nid =".$_POST['mid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid) UNION (SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid, field_data_field_gallery_smaller.field_gallery_smaller_fid  as uniID, file_managed.uri FROM node, file_managed, field_data_field_gallery_smaller, field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_smaller.field_gallery_smaller_fid  AND field_data_field_gallery_model.field_gallery_model_nid =".$_POST['mid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid)";
$counterinterir=1;
if(@mysqli_num_rows(mysqli_query($q))>0)
	{
		$sql_exterior_new=@mysqli_query($q);
		$counter=0;
		while($data_ext_imgnew=@mysqli_fetch_array($sql_exterior_new))
			{
			$sql_imgtitle=mysqli_fetch_array(mysqli_query("select title from node where nid=".$data_ext_imgnew['uniID']));
?>
			<li>
				<a href="/?q=sites/default/files/styles/check_photo_gallery/public/<?php echo str_replace("public://","",$data_ext_imgnew['uri']);?>" title="<?php echo $sql_imgtitle['title'];?>" rel="lightbox[all]" onclick="Lightbox.initialize({autoPlay:false}); return false;">
					<!-- <img src="/sites/default/files/<?php echo str_replace("public://","",$data_ext_imgnew['uri']);?>" alt="<?php echo $sql_imgtitle['title'];?>" width="165" height="124" />-->
					<span class="photosBucketImg"><img src="/?q=sites/default/files/styles/check_medium_medium/public/<?php echo str_replace("public://","",$data_ext_imgnew['uri']);?>" alt="<?php echo $sql_imgtitle['title'];?>"  /></span>
				</a>
			</li>
		<?php
			$counter++;
			}
	}
else
	{
echo "0";
	}
