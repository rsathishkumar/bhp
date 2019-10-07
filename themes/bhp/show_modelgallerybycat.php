<?php
include_once("connect.php");
			
			if($_POST['action']=='show')
				{
					if($_POST['category']=='Interiors')
						{
							$res = @mysqli_query("SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid,field_data_field_gallery_interior.field_gallery_interior_title as imgtitle,field_data_field_gallery_interior.field_gallery_interior_fid as fid, file_managed.uri FROM node, file_managed, field_data_field_gallery_interior, field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_interior.field_gallery_interior_fid  AND field_data_field_gallery_model.field_gallery_model_nid =".$_POST['mid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid and field_data_field_gallery_interior.field_gallery_interior_alt != '' order by field_data_field_gallery_interior.field_gallery_interior_alt");
							$res1 = @mysqli_query("SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid,field_data_field_gallery_interior.field_gallery_interior_title as imgtitle,field_data_field_gallery_interior.field_gallery_interior_fid as fid, file_managed.uri FROM node, file_managed, field_data_field_gallery_interior, field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_interior.field_gallery_interior_fid  AND field_data_field_gallery_model.field_gallery_model_nid =".$_POST['mid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid and field_data_field_gallery_interior.field_gallery_interior_alt = '' order by field_data_field_gallery_interior.delta");
						}
					else if($_POST['category']=='Exterior')
						{
							$res = @mysqli_query("SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid,field_data_field_gallery_exterior.field_gallery_exterior_title as imgtitle, field_data_field_gallery_exterior.field_gallery_exterior_fid as fid,file_managed.uri FROM node, file_managed, field_data_field_gallery_exterior, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_exterior.field_gallery_exterior_fid AND field_data_field_gallery_model.field_gallery_model_nid =".$_POST['mid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid and field_data_field_gallery_exterior.field_gallery_exterior_alt != '' order by field_data_field_gallery_exterior.field_gallery_exterior_alt");
							$res1 = @mysqli_query("SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid,field_data_field_gallery_exterior.field_gallery_exterior_title as imgtitle, field_data_field_gallery_exterior.field_gallery_exterior_fid as fid,file_managed.uri FROM node, file_managed, field_data_field_gallery_exterior, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_exterior.field_gallery_exterior_fid AND field_data_field_gallery_model.field_gallery_model_nid =".$_POST['mid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid and field_data_field_gallery_exterior.field_gallery_exterior_alt = '' order by field_data_field_gallery_exterior.delta");		
						}
					else if($_POST['category']=='Engine')
						{
							$res = @mysqli_query("SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid,field_data_field_gallery_engine.field_gallery_engine_title as imgtitle,field_data_field_gallery_engine.field_gallery_engine_fid as fid, file_managed.uri FROM node, file_managed, field_data_field_gallery_engine, field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_engine.field_gallery_engine_fid  AND field_data_field_gallery_model.field_gallery_model_nid =".$_POST['mid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid and field_data_field_gallery_engine.field_gallery_engine_alt != '' order by field_data_field_gallery_engine.field_gallery_engine_alt");
							$res1 = @mysqli_query("SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid,field_data_field_gallery_engine.field_gallery_engine_title as imgtitle,field_data_field_gallery_engine.field_gallery_engine_fid as fid, file_managed.uri FROM node, file_managed, field_data_field_gallery_engine, field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_engine.field_gallery_engine_fid  AND field_data_field_gallery_model.field_gallery_model_nid =".$_POST['mid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid and field_data_field_gallery_engine.field_gallery_engine_alt = '' order by field_data_field_gallery_engine.delta");
						}
					else
						{
							$res = @mysqli_query("SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid,field_data_field_gallery_smaller.field_gallery_smaller_title as imgtitle,field_data_field_gallery_smaller.field_gallery_smaller_fid as fid, file_managed.uri FROM node, file_managed, field_data_field_gallery_smaller, field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_smaller.field_gallery_smaller_fid  AND field_data_field_gallery_model.field_gallery_model_nid =".$_POST['mid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid and field_data_field_gallery_smaller.field_gallery_smaller_alt != '' order by field_data_field_gallery_smaller.field_gallery_smaller_alt");
							$res1 = @mysqli_query("SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid,field_data_field_gallery_smaller.field_gallery_smaller_title as imgtitle,field_data_field_gallery_smaller.field_gallery_smaller_fid as fid, file_managed.uri FROM node, file_managed, field_data_field_gallery_smaller, field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_smaller.field_gallery_smaller_fid  AND field_data_field_gallery_model.field_gallery_model_nid =".$_POST['mid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid  and field_data_field_gallery_smaller.field_gallery_smaller_alt = '' order by field_data_field_gallery_smaller.delta");
						}
					$num_rows = @mysqli_num_rows($res);
					$num_rows1 = @mysqli_num_rows($res1);
					$counter = 0;
					if($num_rows >0 || $num_rows1 >0 )
					{
					?>
					<div class="jcarousel-skin-tango clearfix">
						<ul id="mycarousel" class="clearfix">
						<?php
						$itemCount = 1;
						if($num_rows >0)
						{
							while($data_int_img=@mysqli_fetch_array($res))
							{
								$sql_imgtitle=@mysqli_fetch_array(mysqli_query("select title from node where nid=".$data_int_img['fid']));
							?>
								<li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-<?php echo $itemCount; ?> jcarousel-item-<?php echo $itemCount; ?>-horizontal">	
								<a<?php if($counter==0) {?> class="active"<?php }?> onclick="return showMain(<?php echo $counter; ?>);" title="<?php $data_int_img['imgtitle'];?>" href="#">
									<span class="photosBucketImg">
										<strong>
											<img  alt="<?php echo $data_int_img['imgtitle'];?>" title="<?php $data_int_img['imgtitle'];?>" src="/?q=sites/default/files/styles/check_medium_medium/public/<?php echo str_replace("public://","",str_replace("+","%2B",$data_int_img['uri']));?>">
										</strong>	
									</span>	
								</a>
								</li>
					<?php
						$counter++;
						$itemCount++;
						}
					 } 
					 if($num_rows1 >0)
					 {
						if($num_rows >0)
						{
							//$counter = 1;
						}
						else
						{
							$counter = 0;
						}
						while($data_int_img1=@mysqli_fetch_array($res1))
						{
							$sql_imgtitle1=@mysqli_fetch_array(mysqli_query("select title from node where nid=".$data_int_img1['fid']));
						?>
							<li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-<?php echo $itemCount; ?> jcarousel-item-<?php echo $itemCount; ?>-horizontal">	
							<a<?php if($counter==0) {?> class="active"<?php }?> onclick="return showMain(<?php echo $counter; ?>);" title="<?php $data_int_img1['imgtitle'];?>" href="#">
								<span class="photosBucketImg">
									<strong>
										<img  alt="<?php echo $data_int_img1['imgtitle'];?>" title="<?php $data_int_img1['imgtitle'];?>" src="/?q=sites/default/files/styles/check_medium_medium/public/<?php echo str_replace("public://","",str_replace("+","%2B",$data_int_img1['uri']));?>">
									</strong>	
								</span>	
							</a>
							</li>
				<?php
							$counter++;
							$itemCount++;
						}
					}
						
					?>
						</ul>
					</div>
					<?php
				}
				else
				{
				?>
				<div class="jcarousel-skin-tango clearfix">
					<ul id="mycarousel" class="clearfix">
					<li>Image unavailable</li>
					</ul>
				</div>
				<?php
				}			
			}
?>
