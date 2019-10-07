<?php
//$q_model="SELECT node.title,node.nid, field_data_field_nr_make.field_nr_make_nid FROM node,field_data_field_nr_make WHERE field_data_field_nr_make.entity_id = node.nid AND node.status =1  order by node.created desc limit 0,3";
$q_model = "SELECT node.title,node.nid, field_data_field_nr_make.field_nr_make_nid,field_data_field_moel_launched.entity_id,field_moel_launched_value FROM node,field_data_field_nr_make,field_data_field_moel_launched WHERE field_data_field_nr_make.entity_id = node.nid AND node.status =1 AND field_data_field_moel_launched.entity_id=node.nid  order by field_moel_launched_value desc limit 0,3";
$sql_model=@mysqli_query($q_model);
$numberofrows=@mysqli_num_rows($sql_model);
if($numberofrows>0)
{
	$mid='';
	while($data_modelfornid=mysqli_fetch_array($sql_model))
	{
	$mid.=$data_modelfornid['nid'].",";
	}
}
$sql_modelrand=@mysqli_query("SELECT node.title,node.nid, field_data_field_nr_make.field_nr_make_nid 
FROM node,field_data_field_nr_make
WHERE field_data_field_nr_make.entity_id = node.nid
AND node.status =1 AND node.nid not in (".@substr($mid,0,-1).") order by rand() limit 0,3");
$numberofrowsrand=@mysqli_num_rows($sql_modelrand);
$sql_make=@mysqli_query("select node.title,node.nid from node,field_data_field_nr_make where field_data_field_nr_make.field_nr_make_nid=node.nid and node.status=1 group by field_data_field_nr_make.field_nr_make_nid order by node.title");
$nofmake=mysqli_num_rows($sql_make);
?>
<div class="homeReview">
	<h4 class="TLR5 clearfix">
		<strong class="title" id="car_rview">Car Reviews</strong><!-- code for this click event writen in home-news-->
		<span class="options">
			<select name="make" onchange="showmodelbymake(this.value);">
				<option value="0">Select a Make</option>
				<?php
					$sql_model=@mysqli_query($q_model);
					if($nofmake>0)
					{
						while($data_make=mysqli_fetch_array($sql_make))
						{
				?>
				<option value="<?php echo $data_make['nid'];?>"><?php echo $data_make['title'];?></option>
				<?php
						}
					}
				?>
			</select>
		</span>
	</h4>
	<div id="ajax">
	<div class="reviewContent BLR5">
	
		<ul class="reviewList clearfix">
				<?php
				if($numberofrows>0 || $numberofrowsrand>0)
				{
						if($numberofrows>0)
						{
							while($data_model=@mysqli_fetch_array($sql_model))
							{
								$sql_sequenceimg=@mysqli_fetch_array(mysqli_query("SELECT distinct(field_gallery_interior_alt) as alt, field_gallery_interior_title as title, field_gallery_interior_fid as fid FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_model['nid']."' and field_data_field_gallery_interior.field_gallery_interior_alt!='' UNION SELECT distinct(field_gallery_exterior_alt) as alt, field_gallery_exterior_title as title, field_gallery_exterior_fid as fid FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_model['nid']."' and field_data_field_gallery_exterior.field_gallery_exterior_alt!='' UNION SELECT distinct(field_gallery_engine_alt) as alt, field_gallery_engine_title as title, field_gallery_engine_fid as fid FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_model['nid']."' and field_data_field_gallery_engine.field_gallery_engine_alt!='' UNION SELECT distinct(field_gallery_smaller_alt) as alt, field_gallery_smaller_title as title, field_gallery_smaller_fid as fid FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_model['nid']."' and field_data_field_gallery_smaller.field_gallery_smaller_alt!='' order by alt limit 0,1"));
								if($sql_sequenceimg=='')
								{
									$sql_sequenceimgwithorder=@mysqli_fetch_array(mysqli_query("SELECT field_data_field_gallery_interior.delta as delta , field_gallery_interior_title as title, field_gallery_interior_fid as fidint FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_model['nid']."' UNION SELECT field_data_field_gallery_exterior.delta as delta, field_gallery_exterior_title as title, field_gallery_exterior_fid as fidint FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_model['nid']."' UNION SELECT field_data_field_gallery_engine.delta as delta, field_gallery_engine_title as title, field_gallery_engine_fid as fidint FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_model['nid']."' UNION SELECT field_data_field_gallery_smaller.delta as delta, field_gallery_smaller_title as title, field_gallery_smaller_fid as fidint FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_model['nid']."' order by delta limit 0,1"));
									if($sql_sequenceimgwithorder=='')
									{
										$model_imgname="sites/default/files/defaultmodel_131.gif";
									}
									else
									{
										$model_img=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$sql_sequenceimgwithorder['fidint']));
										$model_imgname="?q=sites/default/files/styles/check_car_review_home/public/".str_replace("public://","",$model_img['uri']);
									}
								}
								else
								{
									$model_img=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$sql_sequenceimg['fid']));
									$model_imgname="?q=sites/default/files/styles/check_car_review_home/public/".str_replace("public://","",$model_img['uri']);
								}
								$makeRow = @mysqli_fetch_array(mysqli_query("select title from node where nid=".$data_model['field_nr_make_nid']));
			   ?>
					<li>
						<a href="<?php echo url("node/".$data_model['nid'])?>" title="<?php echo $makeRow['title']." ".$data_model['title'];?>">
							<!-- <img width="175" height="131" src="sites/default/files/<?php echo str_replace("public://","",$data_model['uri']);?>" alt="<?php echo $data_model['title'];?>" /> -->
							<img src="http://www.team-bhp.com/<?php echo $model_imgname;?>" alt="<?php echo $data_model['title'];?>" />
							<b>
							<span><?php echo /*$makeRow['title']." ".*/$data_model['title'];?></span>
							</b>
						</a>
					</li>
				<?php
							}
						}
						if($numberofrowsrand>0)
						{
							while($data_modelrand=mysqli_fetch_array($sql_modelrand))
							{
								$sql_sequenceimg=@mysqli_fetch_array(mysqli_query("SELECT distinct(field_gallery_interior_alt) as alt, field_gallery_interior_title as title, field_gallery_interior_fid as fid FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_modelrand['nid']."' and field_data_field_gallery_interior.field_gallery_interior_alt!='' UNION SELECT distinct(field_gallery_exterior_alt) as alt, field_gallery_exterior_title as title, field_gallery_exterior_fid as fid FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_modelrand['nid']."' and field_data_field_gallery_exterior.field_gallery_exterior_alt!='' UNION SELECT distinct(field_gallery_engine_alt) as alt, field_gallery_engine_title as title, field_gallery_engine_fid as fid FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_modelrand['nid']."' and field_data_field_gallery_engine.field_gallery_engine_alt!='' UNION SELECT distinct(field_gallery_smaller_alt) as alt, field_gallery_smaller_title as title, field_gallery_smaller_fid as fid FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_modelrand['nid']."' and field_data_field_gallery_smaller.field_gallery_smaller_alt!='' order by alt limit 0,1"));
								if($sql_sequenceimg=='')
								{
									$sql_sequenceimgwithorder=@mysqli_fetch_array(mysqli_query("SELECT field_data_field_gallery_interior.delta as delta , field_gallery_interior_title as title, field_gallery_interior_fid as fidint FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_modelrand['nid']."' UNION SELECT field_data_field_gallery_exterior.delta as delta, field_gallery_exterior_title as title, field_gallery_exterior_fid as fidint FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_modelrand['nid']."' UNION SELECT field_data_field_gallery_engine.delta as delta, field_gallery_engine_title as title, field_gallery_engine_fid as fidint FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_modelrand['nid']."' UNION SELECT field_data_field_gallery_smaller.delta as delta, field_gallery_smaller_title as title, field_gallery_smaller_fid as fidint FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_modelrand['nid']."' order by delta limit 0,1"));
									if($sql_sequenceimgwithorder=='')
									{
										$model_imgname="sites/default/files/defaultmodel_131.gif";
									}
									else
									{
										$model_img=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$sql_sequenceimgwithorder['fidint']));
										$model_imgname="?q=sites/default/files/styles/check_car_review_home/public/".str_replace("public://","",$model_img['uri']);
									}
								}
								else
								{
									$model_img=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$sql_sequenceimg['fid']));
									$model_imgname="?q=sites/default/files/styles/check_car_review_home/public/".str_replace("public://","",$model_img['uri']);
								}
								$makeRow = @mysqli_fetch_array(mysqli_query("select title from node where nid=".$data_modelrand['field_nr_make_nid']));
				?>
				<li>
					<a href="<?php echo url("node/".$data_modelrand['nid'])?>" title="<?php echo $makeRow['title']." ".$data_modelrand['title'];?>">
						<!-- <img width="175" height="131" src="sites/default/files/<?php echo str_replace("public://","",$data_model['uri']);?>" alt="<?php echo $data_model['title'];?>" /> -->
						<img src="http://www.team-bhp.com/<?php echo $model_imgname;?>" alt="<?php echo $data_modelrand['title'];?>" />
						<b>
						<span><?php echo /*$makeRow['title']." ".*/$data_modelrand['title'];?></span>
						</b>
					</a>
				</li>
				<?php
						}
					}
			}
			else
			{
			?>
				 <li>
				 <a>
					<span>No review found</span>
				</a>
				</li>
			<?php
			}
			?>
			
		</ul><!-- reviewList -->
		<div class="marR12 marT10 clearfix">
			<a title="View all car reviews" href="http://www.team-bhp.com/forum/official-new-car-reviews/?pp=25&sort=dateline&order=desc&daysprune=-1" class="fright btnRight">
				<span>View All Car Reviews</span>
			</a>
		</div>
	</div><!-- reviewContent -->
	</div><!-- end of ajax -->
</div><!-- homeReview -->
