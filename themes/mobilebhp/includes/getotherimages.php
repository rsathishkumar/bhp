<?php
include_once("connect.php");
//$q = "(SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid, field_data_field_gallery_interior.field_gallery_interior_fid as uniID, file_managed.uri FROM node, file_managed, field_data_field_gallery_interior, field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_interior.field_gallery_interior_fid  AND field_data_field_gallery_model.field_gallery_model_nid =".$_POST['mid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid) UNION (SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid, field_data_field_gallery_engine.field_gallery_engine_fid as uniID, file_managed.uri FROM node, file_managed, field_data_field_gallery_engine, field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_engine.field_gallery_engine_fid  AND field_data_field_gallery_model.field_gallery_model_nid =".$_POST['mid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid) UNION (SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid, field_data_field_gallery_smaller.field_gallery_smaller_fid  as uniID, file_managed.uri FROM node, file_managed, field_data_field_gallery_smaller, field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_smaller.field_gallery_smaller_fid  AND field_data_field_gallery_model.field_gallery_model_nid =".$_POST['mid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid)";
$q_interior = "SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid, field_data_field_gallery_interior.field_gallery_interior_fid as uniID,field_data_field_gallery_interior.field_gallery_interior_title,field_data_field_gallery_interior.entity_id, file_managed.uri FROM node, file_managed, field_data_field_gallery_interior, field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_interior.field_gallery_interior_fid AND field_data_field_gallery_model.field_gallery_model_nid =".$_POST['mid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid and field_data_field_gallery_interior.field_gallery_interior_alt !='' order by field_data_field_gallery_interior.field_gallery_interior_alt";
$q_interior1 = "SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid, field_data_field_gallery_interior.field_gallery_interior_fid as uniID,field_data_field_gallery_interior.field_gallery_interior_title,field_data_field_gallery_interior.entity_id, file_managed.uri FROM node, file_managed, field_data_field_gallery_interior, field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_interior.field_gallery_interior_fid AND field_data_field_gallery_model.field_gallery_model_nid =".$_POST['mid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid and field_data_field_gallery_interior.field_gallery_interior_alt ='' order by field_data_field_gallery_interior.delta";
$q_engine = "SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid, field_data_field_gallery_engine.field_gallery_engine_fid as uniID,field_data_field_gallery_engine.field_gallery_engine_title,field_data_field_gallery_engine.entity_id, file_managed.uri FROM node, file_managed, field_data_field_gallery_engine, field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_engine.field_gallery_engine_fid AND field_data_field_gallery_model.field_gallery_model_nid =".$_POST['mid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid and field_data_field_gallery_engine.field_gallery_engine_alt !='' order by field_data_field_gallery_engine.field_gallery_engine_alt";
$q_engine1 = "SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid, field_data_field_gallery_engine.field_gallery_engine_fid as uniID,field_data_field_gallery_engine.field_gallery_engine_title,field_data_field_gallery_engine.entity_id, file_managed.uri FROM node, file_managed, field_data_field_gallery_engine, field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_engine.field_gallery_engine_fid AND field_data_field_gallery_model.field_gallery_model_nid =".$_POST['mid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid and field_data_field_gallery_engine.field_gallery_engine_alt ='' order by field_data_field_gallery_engine.delta";
$q_small = "SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid, field_data_field_gallery_smaller.field_gallery_smaller_fid as uniID,field_data_field_gallery_smaller.field_gallery_smaller_title,field_data_field_gallery_smaller.entity_id, file_managed.uri FROM node, file_managed, field_data_field_gallery_smaller, field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_smaller.field_gallery_smaller_fid AND field_data_field_gallery_model.field_gallery_model_nid =".$_POST['mid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid and field_data_field_gallery_smaller.field_gallery_smaller_alt !='' order by field_data_field_gallery_smaller.field_gallery_smaller_alt";
$q_small1 = "SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid, field_data_field_gallery_smaller.field_gallery_smaller_fid as uniID,field_data_field_gallery_smaller.field_gallery_smaller_title,field_data_field_gallery_smaller.entity_id, file_managed.uri FROM node, file_managed, field_data_field_gallery_smaller, field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_smaller.field_gallery_smaller_fid AND field_data_field_gallery_model.field_gallery_model_nid =".$_POST['mid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid and field_data_field_gallery_smaller.field_gallery_smaller_alt ='' order by field_data_field_gallery_smaller.delta";
if((@mysqli_num_rows(mysqli_query($q_interior))>0) || (@mysqli_num_rows(mysqli_query($q_interior1))>0) || (@mysqli_num_rows(mysqli_query($q_engine))>0) || (@mysqli_num_rows(mysqli_query($q_engine1))>0) ||(@mysqli_num_rows(mysqli_query($q_small))>0|| (@mysqli_num_rows(mysqli_query($q_small1))>0) ))
	{
		$allImages = '';
		$carouselImages = '';
		$spanImages = '';
		//get interior images
		if(@mysqli_num_rows(mysqli_query($q_interior))>0)
		{
			$sql_interior_new=@mysqli_query($q_interior);
			while($data_int_imgnew=@mysqli_fetch_array($sql_interior_new))
			{
			$sql_imgtitle=mysqli_fetch_array(mysqli_query("select title from node where nid=".$data_int_imgnew['uniID']));
?>
			<li>
				<a href="/?q=sites/default/files/styles/check_photo_gallery/public/<?php echo str_replace("public://","",$data_int_imgnew['uri']);?>" title="<?php echo $sql_imgtitle['title'];?>" rel="lightbox[all]" onclick="Lightbox.initialize({autoPlay:false}); return false;">
					<span class="photosBucketImg">
						<strong>
						<img src="/?q=sites/default/files/styles/check_medium_medium/public/<?php echo str_replace("public://","",$data_int_imgnew['uri']);?>" alt="<?php echo $sql_imgtitle['title'];?>" />
						</strong>
					</span>
				</a>
			</li>
		<?php
			}
		 }
		 if(@mysqli_num_rows(mysqli_query($q_interior1))>0)
		{
			$sql_interior_new1=@mysqli_query($q_interior1);
			while($data_int_imgnew1=@mysqli_fetch_array($sql_interior_new1))
			{
			$sql_imgtitle1=mysqli_fetch_array(mysqli_query("select title from node where nid=".$data_int_imgnew1['uniID']));
			?>
			<li>
				<a href="/?q=sites/default/files/styles/check_photo_gallery/public/<?php echo str_replace("public://","",$data_int_imgnew1['uri']);?>" title="<?php echo $sql_imgtitle1['title'];?>" rel="lightbox[all]" onclick="Lightbox.initialize({autoPlay:false}); return false;">
					<span class="photosBucketImg">
						<strong>
						<img src="/?q=sites/default/files/styles/check_medium_medium/public/<?php echo str_replace("public://","",$data_int_imgnew1['uri']);?>" alt="<?php echo $sql_imgtitle1['title'];?>" />
						</strong>
					</span>
				</a>
			</li>
		<?php
			}
		}
		//get engine images
		if(@mysqli_num_rows(mysqli_query($q_engine))>0)
		{
			$sql_engine_new=@mysqli_query($q_engine);
			while($data_engine_imgnew=@mysqli_fetch_array($sql_engine_new))
			{
			$sql_imgtitle=mysqli_fetch_array(mysqli_query("select title from node where nid=".$data_engine_imgnew['uniID']));
?>
			<li>
				<a href="/?q=sites/default/files/styles/check_photo_gallery/public/<?php echo str_replace("public://","",$data_engine_imgnew['uri']);?>" title="<?php echo $sql_imgtitle['title'];?>" rel="lightbox[all]" onclick="Lightbox.initialize({autoPlay:false}); return false;">
					<span class="photosBucketImg">
						<strong>
						<img src="/?q=sites/default/files/styles/check_medium_medium/public/<?php echo str_replace("public://","",$data_engine_imgnew['uri']);?>" alt="<?php echo $sql_imgtitle['title'];?>" />
						</strong>
					</span>
				</a>
			</li>
		<?php
			}
		}
		if(@mysqli_num_rows(mysqli_query($q_engine1))>0)
		{
			$sql_engine_new1=@mysqli_query($q_engine1);
			while($data_engine_imgnew1=@mysqli_fetch_array($sql_engine_new1))
			{
			$sql_imgtitle1=mysqli_fetch_array(mysqli_query("select title from node where nid=".$data_engine_imgnew1['uniID']));
?>
			<li>
				<a href="/?q=sites/default/files/styles/check_photo_gallery/public/<?php echo str_replace("public://","",$data_engine_imgnew1['uri']);?>" title="<?php echo $sql_imgtitle1['title'];?>" rel="lightbox[all]" onclick="Lightbox.initialize({autoPlay:false}); return false;">
					<span class="photosBucketImg">
						<strong>
						<img src="/?q=sites/default/files/styles/check_medium_medium/public/<?php echo str_replace("public://","",$data_engine_imgnew1['uri']);?>" alt="<?php echo $sql_imgtitle1['title'];?>" />
						</strong>
					</span>
				</a>
			</li>
		<?php
			}
		}
		//get smaller & significant images
		if(@mysqli_num_rows(mysqli_query($q_small))>0)
		{
			$sql_smaller_new=@mysqli_query($q_small);
			while($data_smaller_imgnew=@mysqli_fetch_array($sql_smaller_new))
			{
			$sql_imgtitle=mysqli_fetch_array(mysqli_query("select title from node where nid=".$data_smaller_imgnew['uniID']));
?>
			<li>
				<a href="/?q=sites/default/files/styles/check_photo_gallery/public/<?php echo str_replace("public://","",$data_smaller_imgnew['uri']);?>" title="<?php echo $sql_imgtitle['title'];?>" rel="lightbox[all]" onclick="Lightbox.initialize({autoPlay:false}); return false;">
					<span class="photosBucketImg">
						<strong>
						<img src="/?q=sites/default/files/styles/check_medium_medium/public/<?php echo str_replace("public://","",$data_smaller_imgnew['uri']);?>" alt="<?php echo $sql_imgtitle['title'];?>" />
						</strong>
					</span>
				</a>
			</li>
		<?php
			}
		}
		if(@mysqli_num_rows(mysqli_query($q_small1))>0)
		{
			$sql_smaller_new1=@mysqli_query($q_small1);
			while($data_smaller_imgnew1=@mysqli_fetch_array($sql_smaller_new1))
			{
			$sql_imgtitle1=mysqli_fetch_array(mysqli_query("select title from node where nid=".$data_smaller_imgnew1['uniID']));
?>
			<li>
				<a href="/?q=sites/default/files/styles/check_photo_gallery/public/<?php echo str_replace("public://","",$data_smaller_imgnew1['uri']);?>" title="<?php echo $sql_imgtitle1['title'];?>" rel="lightbox[all]" onclick="Lightbox.initialize({autoPlay:false}); return false;">
					<span class="photosBucketImg">
						<strong>
						<img src="/?q=sites/default/files/styles/check_medium_medium/public/<?php echo str_replace("public://","",$data_smaller_imgnew1['uri']);?>" alt="<?php echo $sql_imgtitle1['title'];?>" />
						</strong>
					</span>
				</a>
			</li>
		<?php
			}
		}
	}
