<?php
include_once("connect.php");
			
			if($_POST['action']=='show')
			{
				if($_POST['category']=='Interiors')
					{
						$res = @mysqli_query("SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid,field_data_field_gallery_interior.entity_id, field_data_field_gallery_interior.field_gallery_interior_title as imgtitle,field_data_field_gallery_interior.field_gallery_interior_fid as fid, file_managed.uri FROM node, file_managed, field_data_field_gallery_interior, field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_interior.field_gallery_interior_fid  AND field_data_field_gallery_model.field_gallery_model_nid =".$_POST['mid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid and field_data_field_gallery_interior.field_gallery_interior_alt !='' order by field_data_field_gallery_interior.field_gallery_interior_alt asc");
						$res1 = @mysqli_query("SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid,field_data_field_gallery_interior.entity_id, field_data_field_gallery_interior.field_gallery_interior_title as imgtitle,field_data_field_gallery_interior.field_gallery_interior_fid as fid, file_managed.uri FROM node, file_managed, field_data_field_gallery_interior, field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_interior.field_gallery_interior_fid  AND field_data_field_gallery_model.field_gallery_model_nid =".$_POST['mid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid and field_data_field_gallery_interior.field_gallery_interior_alt = '' order by field_data_field_gallery_interior.delta");
					}
				else if($_POST['category']=='Exterior')
					{
						$res = @mysqli_query("SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid,field_data_field_gallery_exterior.entity_id,field_data_field_gallery_exterior.field_gallery_exterior_title as imgtitle,field_data_field_gallery_exterior.field_gallery_exterior_fid as fid, file_managed.uri FROM node, file_managed, field_data_field_gallery_exterior, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_exterior.field_gallery_exterior_fid AND field_data_field_gallery_model.field_gallery_model_nid =".$_POST['mid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid and field_data_field_gallery_exterior.field_gallery_exterior_alt !='' order by field_data_field_gallery_exterior.field_gallery_exterior_alt asc");
						$res1 = @mysqli_query("SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid,field_data_field_gallery_exterior.entity_id,field_data_field_gallery_exterior.field_gallery_exterior_title as imgtitle,field_data_field_gallery_exterior.field_gallery_exterior_fid as fid, file_managed.uri FROM node, file_managed, field_data_field_gallery_exterior, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_exterior.field_gallery_exterior_fid AND field_data_field_gallery_model.field_gallery_model_nid =".$_POST['mid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid and field_data_field_gallery_exterior.field_gallery_exterior_alt = '' order by field_data_field_gallery_exterior.delta");
					}
				else if($_POST['category']=='Engine')
					{
						$res = @mysqli_query("SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid,field_data_field_gallery_engine.entity_id,field_data_field_gallery_engine.field_gallery_engine_title as imgtitle,field_data_field_gallery_engine.field_gallery_engine_fid as fid, file_managed.uri FROM node, file_managed, field_data_field_gallery_engine, field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_engine.field_gallery_engine_fid  AND field_data_field_gallery_model.field_gallery_model_nid =".$_POST['mid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid and field_data_field_gallery_engine.field_gallery_engine_alt !='' order by field_data_field_gallery_engine.field_gallery_engine_alt asc");
						$res1 = @mysqli_query("SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid,field_data_field_gallery_engine.entity_id,field_data_field_gallery_engine.field_gallery_engine_title as imgtitle,field_data_field_gallery_engine.field_gallery_engine_fid as fid, file_managed.uri FROM node, file_managed, field_data_field_gallery_engine, field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_engine.field_gallery_engine_fid  AND field_data_field_gallery_model.field_gallery_model_nid =".$_POST['mid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid and field_data_field_gallery_engine.field_gallery_engine_alt ='' order by fid");
					}
				else
					{
						$res = @mysqli_query("SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid,field_data_field_gallery_smaller.entity_id,field_data_field_gallery_smaller.field_gallery_smaller_title as imgtitle,field_data_field_gallery_smaller.field_gallery_smaller_fid as fid, file_managed.uri FROM node, file_managed, field_data_field_gallery_smaller, field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_smaller.field_gallery_smaller_fid  AND field_data_field_gallery_model.field_gallery_model_nid =".$_POST['mid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid and field_data_field_gallery_smaller.field_gallery_smaller_alt !='' order by field_data_field_gallery_smaller.field_gallery_smaller_alt asc");
						$res1 = @mysqli_query("SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid,field_data_field_gallery_smaller.entity_id,field_data_field_gallery_smaller.field_gallery_smaller_title as imgtitle,field_data_field_gallery_smaller.field_gallery_smaller_fid as fid, file_managed.uri FROM node, file_managed, field_data_field_gallery_smaller, field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_smaller.field_gallery_smaller_fid  AND field_data_field_gallery_model.field_gallery_model_nid =".$_POST['mid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid and field_data_field_gallery_smaller.field_gallery_smaller_alt ='' order by field_data_field_gallery_smaller.delta");
					}
				$num_rows = @mysqli_num_rows($res);
				$num_rows1 = @mysqli_num_rows($res1);
				$counter = 0;
				if($num_rows >0 || $num_rows1 >0)
					{
					?>
					<div id="gallery">
						<?php
							$nid='';
							if($num_rows >0)
							{
								$counter=1;
								while($data_ext_img=mysqli_fetch_array($res))
								{
									if($counter==1)
									{
										$nid.=$data_ext_img['fid'];
									}
							?>
							<span<?php if($counter==1) {?> class="show" style="opacity:1"<?php $showSet = 1; } else { ?> style="opacity:0"<?php }?>>
								<img src="/?q=sites/default/files/styles/check_photo_gallery/public/<?php echo str_replace("public://","",str_replace("+","%2B",$data_ext_img['uri']));?>" alt="<?php echo $data_ext_img['imgtitle'];?>" title="<?php echo $data_ext_img['imgtitle'];?>" />
							</span>
							<?php
									$counter++;
								}
							}
							 if($num_rows1 >0)
							 {
								//$nid='';
								if($num_rows >0)
								{
									
								}
								else
								{
									$counter=1;
								}
								$counter1 = 1;
								while($data_ext_img1=mysqli_fetch_array($res1))
								{
									
									if($counter1==1 && $nid=='')
									{
										$nid.=$data_ext_img1['fid'];
									}
							?>
							<span<?php if($counter==1 && $showSet!='1') {?> class="show" style="opacity:1"<?php } else { ?> style="opacity:0"<?php }?>>
								<img src="/?q=sites/default/files/styles/check_photo_gallery/public/<?php echo str_replace("public://","",str_replace("+","%2B",$data_ext_img1['uri']));?>" alt="<?php echo $data_ext_img1['imgtitle'];?>" title="<?php echo $data_ext_img1['imgtitle'];?>" />
							</span>
							<?php
									$counter++;
									$counter1 ++ ;
							   }
							}
							if($_POST['category']=='Interiors')
							{
								$sql_qry=@mysql_fetch_assoc(mysqli_query("select field_gallery_interior_title as t from field_data_field_gallery_interior where field_gallery_interior_fid=".$nid));
							}
							else if($_POST['category']=='Exterior')
							{
								$sql_qry=@mysql_fetch_assoc(mysqli_query("select field_gallery_exterior_title as t  from field_data_field_gallery_exterior where field_gallery_exterior_fid=".$nid));	
							}
							else if($_POST['category']=='Engine')
							{
								$sql_qry=@mysql_fetch_assoc(mysqli_query("select field_gallery_engine_title as t  from field_data_field_gallery_engine where field_gallery_engine_fid=".$nid));
							}
							else
							{
								//echo "select field_gallery_smaller_title as t from field_data_field_gallery_smaller where entity_id=".$nid;
								$sql_qry=@mysql_fetch_assoc(mysqli_query("select field_gallery_smaller_title as t from field_data_field_gallery_smaller where field_gallery_smaller_fid =".$nid));	
							}
						?>
						<div class="caption" style="opacity: 0.7;">
							<div class="content"><?php echo $sql_qry['t'];?></div>
						</div>
						<div class="controls clearfix">
							<a href="#" class="next<?php if($num_rows<=1 || $num_rows1<=1) { ?> disable<?php } ?>" onclick="galleryNext(); return false;"><b>&nbsp;</b></a>
							<a href="#" class="prev disable" onclick="galleryPrev(); return false;"><b>&nbsp;</b></a>
						</div>
						
					</div><!-- gallery -->
					<?php
					}
					else
					{
					?>
					<div id="gallery">
						<span>Image unavailable</span>
					</div>
					<?php
					}			
			}
?>
