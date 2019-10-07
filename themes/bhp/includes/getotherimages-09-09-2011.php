<?php
include_once("connect.php");
$q_interior = "SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid, field_data_field_gallery_interior.field_gallery_interior_fid as uniID,field_data_field_gallery_interior.field_gallery_interior_title,field_data_field_gallery_interior.entity_id, file_managed.uri FROM node, file_managed, field_data_field_gallery_interior, field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_interior.field_gallery_interior_fid AND field_data_field_gallery_model.field_gallery_model_nid =".$_POST['mid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid order by field_data_field_gallery_interior.field_gallery_interior_fid desc";
$q_engine = "SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid, field_data_field_gallery_engine.field_gallery_engine_fid as uniID,field_data_field_gallery_engine.field_gallery_engine_title,field_data_field_gallery_engine.entity_id, file_managed.uri FROM node, file_managed, field_data_field_gallery_engine, field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_engine.field_gallery_engine_fid AND field_data_field_gallery_model.field_gallery_model_nid =".$_POST['mid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid order by field_data_field_gallery_engine.field_gallery_engine_fid desc";
$q_small = "SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid, field_data_field_gallery_smaller.field_gallery_smaller_fid as uniID,field_data_field_gallery_smaller.field_gallery_smaller_title,field_data_field_gallery_smaller.entity_id, file_managed.uri FROM node, file_managed, field_data_field_gallery_smaller, field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_smaller.field_gallery_smaller_fid AND field_data_field_gallery_model.field_gallery_model_nid =".$_POST['mid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid order by field_data_field_gallery_smaller.field_gallery_smaller_fid desc";
if((@mysqli_num_rows(mysqli_query($q_interior))>0) || (@mysqli_num_rows(mysqli_query($q_engine))>0) ||(@mysqli_num_rows(mysqli_query($q_small))>0))
	{
		$allImages = '';
		$carouselImages = '';
		$spanImages = '';
		$counter = 0;
		//get interior images
		$sql_interior_new=@mysqli_query($q_interior);
		while($data_int_imgnew=@mysqli_fetch_array($sql_interior_new))
			{
			$sql_imgtitle=mysqli_fetch_array(mysqli_query("select title from node where nid=".$data_int_imgnew['uniID']));
			$allImages .= '<li>
				<a href="http://www.team-bhp.com/?q=sites/default/files/styles/check_photo_gallery/public/'.str_replace("public://","",$data_int_imgnew['uri']).'" title="'.$sql_imgtitle['title'].'" rel="lightbox[all]" onclick="Lightbox.initialize({autoPlay:false}); return false;">
					<span class="photosBucketImg"><img src="http://www.team-bhp.com/?q=sites/default/files/styles/check_medium_medium/public/'.str_replace("public://","",$data_int_imgnew['uri']).'" alt="'.$sql_imgtitle['title'].'" /></span>
				</a>
			</li>';
			$carouselImages .= '<li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-1 jcarousel-item-1-horizontal" style="float: left; list-style: none outside none;" jcarouselindex="1">	
				<a onclick="return showMain('.$counter.');" title="'.$sql_imgtitle['title'].'" href="#">
					<span class="photosBucketImg"><img alt="'.$sql_imgtitle['title'].'" src="http://www.team-bhp.com/?q=sites/default/files/styles/check_medium_medium/public/'.str_replace("public://","",$data_int_imgnew['uri']).'"></span>
				</a>
			</li>';
			$counter++;
			}
		//get engine images
		$sql_engine_new=@mysqli_query($q_engine);
		while($data_engine_imgnew=@mysqli_fetch_array($sql_engine_new))
			{
			$sql_imgtitle=mysqli_fetch_array(mysqli_query("select title from node where nid=".$data_engine_imgnew['uniID']));
			$allImages .= '<li>
				<a href="http://www.team-bhp.com/?q=sites/default/files/styles/check_photo_gallery/public/'.str_replace("public://","",$data_engine_imgnew['uri']).'" title="'.$sql_imgtitle['title'].'" rel="lightbox[all]" onclick="Lightbox.initialize({autoPlay:false}); return false;">
					<span class="photosBucketImg"><img alt="'.$sql_imgtitle['title'].'" src="http://www.team-bhp.com/?q=sites/default/files/styles/check_medium_medium/public/'.str_replace("public://","",$data_engine_imgnew['uri']).'" /></span>
				</a>
			</li>';
			$carouselImages .= '<li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-1 jcarousel-item-1-horizontal" style="float: left; list-style: none outside none;" jcarouselindex="1">	
				<a onclick="return showMain('.$counter.');" title="'.$sql_imgtitle['title'].'" href="#">
					<span class="photosBucketImg"><img alt="'.$sql_imgtitle['title'].'" src="http://www.team-bhp.com/?q=sites/default/files/styles/check_medium_medium/public/'.str_replace("public://","",$data_engine_imgnew['uri']).'"></span>
				</a>
			</li>';
			$counter++;
			}
		//get smaller & significant images
		$sql_smaller_new=@mysqli_query($q_small);
		while($data_smaller_imgnew=@mysqli_fetch_array($sql_smaller_new))
			{
			$sql_imgtitle=mysqli_fetch_array(mysqli_query("select title from node where nid=".$data_smaller_imgnew['uniID']));
			$allImages .= '<li>
				<a href="http://www.team-bhp.com/?q=sites/default/files/styles/check_photo_gallery/public/'.str_replace("public://","",$data_smaller_imgnew['uri']).'" title="'.$sql_imgtitle['title'].'" rel="lightbox[all]" onclick="Lightbox.initialize({autoPlay:false}); return false;">
					<span class="photosBucketImg"><img src="http://www.team-bhp.com/?q=sites/default/files/styles/check_medium_medium/public/'.str_replace("public://","",$data_smaller_imgnew['uri']).'" alt="'.$sql_imgtitle['title'].'" /></span>
				</a>
			</li>';
			$carouselImages .= '<li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-1 jcarousel-item-1-horizontal" style="float: left; list-style: none outside none;" jcarouselindex="1">	
				<a onclick="return showMain('.$counter.');" title="'.$sql_imgtitle['title'].'" href="#">
					<span class="photosBucketImg"><img alt="'.$sql_imgtitle['title'].'" src="http://www.team-bhp.com/?q=sites/default/files/styles/check_medium_medium/public/'.str_replace("public://","",$data_smaller_imgnew['uri']).'"></span>
				</a>
			</li>';
			$counter++;
			}
		echo $allImages."--break--".$carouselImages;
	}
else
	{
echo "0";
	}
