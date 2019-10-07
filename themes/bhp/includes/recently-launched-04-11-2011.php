<?php
include_once("connect.php");
//$sql_model=@mysqli_query("SELECT node.title,node.nid, file_managed.uri,field_data_field_nr_make.field_nr_make_nid,field_data_field_model_dashboard.field_model_dashboard_fid FROM node,file_managed,field_data_field_nr_make,field_data_field_model_dashboard WHERE field_data_field_model_dashboard.field_model_dashboard_fid = file_managed.fid AND field_data_field_model_dashboard.entity_id = node.nid AND node.status =1 AND field_data_field_nr_make.entity_id=field_data_field_model_dashboard.entity_id order by node.changed desc");
echo "SELECT node.title,node.nid, field_data_field_nr_make.field_nr_make_nid FROM node,field_data_field_nr_make,field_data_field_moel_launched WHERE field_data_field_nr_make.entity_id = node.nid AND field_data_field_moel_launched.entity_id=node.nid AND node.status =1  AND node.nid=field_data_field_moel_launched.entity_id order by field_data_field_moel_launched.field_moel_launched_value desc limit 0,8";
$sql_model=@mysqli_query("SELECT node.title,node.nid, field_data_field_nr_make.field_nr_make_nid FROM node,field_data_field_nr_make,field_data_field_moel_launched WHERE field_data_field_nr_make.entity_id = node.nid AND field_data_field_moel_launched.entity_id=node.nid AND node.status =1  AND node.nid=field_data_field_moel_launched.entity_id order by field_data_field_moel_launched.field_moel_launched_value desc limit 0,8");
$numberofrows=@mysqli_num_rows($sql_model);

$sql_model_viewed=@mysqli_query("SELECT node.title,node.nid,node_counter.totalcount, node_counter.daycount
FROM node, node_counter
WHERE node.nid = node_counter.nid
AND node.type = 'model' and node_counter.timestamp order by node_counter.totalcount desc limit 0,8");
$nofcarviewd=@mysqli_num_rows($sql_model_viewed);
if($numberofrows>0 || $nofcarviewd>0)
	{

function to_lakh($no)
{
if(intval($no)>=100000)
	{
		$res = (intval($no)/100000);
		if(strpos($res, '.')>0)
		{
			$res = round($res, 1);
		}
		else
		{
		$res=$res.".0";
		}
		return $res;
	}
else
	{
		return 0;
	}
}
?>
<div class="recently_launched roundAll5 pad10 clearfix" id="recent_launch">
		<?php
		if($numberofrows>0)
				{
		?>
		<div class="clearfix">
			<h3 class="fleft">Recently Launched</h3>
			<div class="filterByPrice">
				<div class="fleft marR10">
					All prices on road: 
				</div>
				
				<select>
					<option>Delhi</option>
					<option>Mumbai</option>												
				</select>												
			</div><!-- filterByPrice -->
		</div><!-- clearfix -->

		<ul class="carListing clearfix">
		<?php
			while($data_model=mysqli_fetch_array($sql_model))
					{
							$sql_sequenceimg=@mysqli_fetch_array(mysqli_query("SELECT distinct(field_gallery_interior_alt) as alt, field_gallery_interior_title as title, field_gallery_interior_fid as fid FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_model['nid']."' and field_data_field_gallery_interior.field_gallery_interior_alt!='' UNION SELECT distinct(field_gallery_exterior_alt) as alt, field_gallery_exterior_title as title, field_gallery_exterior_fid as fid FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_model['nid']."' and field_data_field_gallery_exterior.field_gallery_exterior_alt!='' UNION SELECT distinct(field_gallery_engine_alt) as alt, field_gallery_engine_title as title, field_gallery_engine_fid as fid FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_model['nid']."' and field_data_field_gallery_engine.field_gallery_engine_alt!='' UNION SELECT distinct(field_gallery_smaller_alt) as alt, field_gallery_smaller_title as title, field_gallery_smaller_fid as fid FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_model['nid']."' and field_data_field_gallery_smaller.field_gallery_smaller_alt!='' order by alt limit 0,1"));
								if($sql_sequenceimg=='')
									{
									
									$sql_sequenceimgwithorder=@mysqli_fetch_array(mysqli_query("SELECT field_data_field_gallery_interior.delta as delta , field_gallery_interior_title as title, field_gallery_interior_fid as fidint FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_model['nid']."' UNION SELECT field_data_field_gallery_exterior.delta as delta, field_gallery_exterior_title as title, field_gallery_exterior_fid as fidint FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_model['nid']."' UNION SELECT field_data_field_gallery_engine.delta as delta, field_gallery_engine_title as title, field_gallery_engine_fid as fidint FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_model['nid']."' UNION SELECT field_data_field_gallery_smaller.delta as delta, field_gallery_smaller_title as title, field_gallery_smaller_fid as fidint FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$data_model['nid']."' order by delta limit 0,1"));
										if($sql_sequenceimgwithorder=='')
											{
											$model_imgname="sites/default/files/defaultmodel_53.gif";
											}
										else
											{
										$model_img=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$sql_sequenceimgwithorder['fidint']));
										$model_imgname="?q=sites/default/files/styles/check_thumb_review_detail/public/".str_replace("public://","",$model_img['uri']);
											}
									}
								else
									{
									$model_img=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$sql_sequenceimg['fid']));
									$model_imgname="?q=sites/default/files/styles/check_thumb_review_detail/public/".str_replace("public://","",$model_img['uri']);
									}
					$mktitlerlaunch=@mysqli_fetch_array(mysqli_query("select title from node,field_data_field_nr_make where field_data_field_nr_make.entity_id =".$data_model['nid']." and field_data_field_nr_make.field_nr_make_nid=node.nid"));
					$price_res = @mysql_fetch_assoc(mysqli_query("select min(on_road_price) as minPrice, max(on_road_price) as maxPrice from team_bhp_variant_price, field_data_field_price_nr_variant, field_data_field_variant_nr_engine, field_data_field_nr_make_model where team_bhp_variant_price.city='Delhi' and team_bhp_variant_price.nid=field_data_field_price_nr_variant.entity_id and field_data_field_price_nr_variant.field_price_nr_variant_nid=field_data_field_variant_nr_engine.entity_id and field_data_field_variant_nr_engine.field_variant_nr_engine_nid=field_data_field_nr_make_model.entity_id and field_data_field_nr_make_model.field_nr_make_model_nid=".$data_model['nid']));
		?>
			<li class="clearfix">
				<a href="<?php echo url("node/".$data_model['nid'])?>" class="carImage" title="<?php echo $mktitlerlaunch['title']." ".$data_model['title'];?>">
					<!--<img src="/sites/default/files/<?php echo str_replace("public://","",$data_model['uri']);?>" alt="<?php echo $data_model['title'];?>" width="70" height="53" />-->
					<img src="/<?php echo $model_imgname;?>" alt="<?php echo $mktitlerlaunch['title']." ".$data_model['title'];?>" />
				</a>
				
				<div class="Rec_carinfo">
					<p><a href="<?php echo url("node/".$data_model['nid'])?>" title="<?php echo /*$mktitlerlaunch['title']." ".*/$data_model['title'];?>"><?php echo /*$mktitlerlaunch['title']." ".*/$data_model['title'];?></a></p>
					<?php
					if($price_res['minPrice']!='' & $price_res['maxPrice']!='')
					{
						if($price_res['minPrice']>=100000)
							{
								$minPrice = to_lakh($price_res['minPrice']);
							}
						else
							{
								$minPrice = $price_res['minPrice'];
							}
						if($price_res['maxPrice']>=100000)
							{
								$maxPrice = to_lakh($price_res['maxPrice'])." Lakh";
							}
						else
							{
								$maxPrice = $price_res['maxPrice'];
							}
					?>
					<div class="price"><span class="WebRupee">Rs.</span> <?php echo $minPrice." - ".$maxPrice; ?></div>
					<?php
					}
					?>
					<div class="ReviewBtns">
						<a href="<?php echo url("node/".$data_model['nid'])?>" title="Overview"><img src="themes/bhp/images/buttons/review.png" alt="Review"
						width="47" height="12" /></a>
						<a href="#" class="add" onclick="getCarID('<?php echo $data_model['nid']; ?>'); return false;"><img src="themes/bhp/images/buttons/compare.png" alt="Compare" width="57" height="12" /></a>												
					</div>
				</div>
			</li>
			<?php
				}
			?>
		</ul>
			<?php
				}
			if($nofcarviewd>0)
					{
			?>
		<h3 class="marT10">Most Viewed</h3>
		<ul class="carListing MostViewList noBorder">
			<?php
			while($mostviewdata=mysqli_fetch_array($sql_model_viewed))
				{
				$sql_carimage=mysqli_fetch_array(mysqli_query("select field_data_field_model_dashboard.field_model_dashboard_fid,field_data_field_model_dashboard.entity_id,file_managed.uri from file_managed,field_data_field_model_dashboard where field_data_field_model_dashboard.field_model_dashboard_fid=file_managed.fid and field_data_field_model_dashboard.entity_id=".$mostviewdata['nid']));
				$price_res = @mysql_fetch_assoc(mysqli_query("select min(on_road_price) as minPrice, max(on_road_price) as maxPrice from team_bhp_variant_price, field_data_field_price_nr_variant, field_data_field_variant_nr_engine, field_data_field_nr_make_model where team_bhp_variant_price.city='Delhi' and team_bhp_variant_price.nid=field_data_field_price_nr_variant.entity_id and field_data_field_price_nr_variant.field_price_nr_variant_nid=field_data_field_variant_nr_engine.entity_id and field_data_field_variant_nr_engine.field_variant_nr_engine_nid=field_data_field_nr_make_model.entity_id and field_data_field_nr_make_model.field_nr_make_model_nid=".$mostviewdata['nid']));
			$mktitle=@mysqli_fetch_array(mysqli_query("select title from node,field_data_field_nr_make where field_data_field_nr_make.entity_id =".$mostviewdata['nid']." and field_data_field_nr_make.field_nr_make_nid=node.nid"));
					
					$sql_sequenceimg=@mysqli_fetch_array(mysqli_query("SELECT distinct(field_gallery_interior_alt) as alt, field_gallery_interior_title as title, field_gallery_interior_fid as fid FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$mostviewdata['nid']."' and field_data_field_gallery_interior.field_gallery_interior_alt!='' UNION SELECT distinct(field_gallery_exterior_alt) as alt, field_gallery_exterior_title as title, field_gallery_exterior_fid as fid FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$mostviewdata['nid']."' and field_data_field_gallery_exterior.field_gallery_exterior_alt!='' UNION SELECT distinct(field_gallery_engine_alt) as alt, field_gallery_engine_title as title, field_gallery_engine_fid as fid FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$mostviewdata['nid']."' and field_data_field_gallery_engine.field_gallery_engine_alt!='' UNION SELECT distinct(field_gallery_smaller_alt) as alt, field_gallery_smaller_title as title, field_gallery_smaller_fid as fid FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$mostviewdata['nid']."' and field_data_field_gallery_smaller.field_gallery_smaller_alt!='' order by alt limit 0,1"));
								if($sql_sequenceimg=='')
									{
									
									$sql_sequenceimgwithorder=@mysqli_fetch_array(mysqli_query("SELECT field_data_field_gallery_interior.delta as delta , field_gallery_interior_title as title, field_gallery_interior_fid as fidint FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$mostviewdata['nid']."' UNION SELECT field_data_field_gallery_exterior.delta as delta, field_gallery_exterior_title as title, field_gallery_exterior_fid as fidint FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$mostviewdata['nid']."' UNION SELECT field_data_field_gallery_engine.delta as delta, field_gallery_engine_title as title, field_gallery_engine_fid as fidint FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$mostviewdata['nid']."' UNION SELECT field_data_field_gallery_smaller.delta as delta, field_gallery_smaller_title as title, field_gallery_smaller_fid as fidint FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$mostviewdata['nid']."' order by delta limit 0,1"));
										if($sql_sequenceimgwithorder=='')
											{
											$model_imgname="sites/default/files/defaultmodel_53.gif";
											}
										else
											{
										$model_img=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$sql_sequenceimgwithorder['fidint']));
										$model_imgname="?q=sites/default/files/styles/check_thumb_review_detail/public/".str_replace("public://","",$model_img['uri']);
											}
									}
								else
									{
									$model_img=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$sql_sequenceimg['fid']));
									$model_imgname="?q=sites/default/files/styles/check_thumb_review_detail/public/".str_replace("public://","",$model_img['uri']);
									}
			?>
			<li class="clearfix"> 
				<a href="<?php echo url("node/".$mostviewdata['nid'])?>" class="carImage" title="<?php echo $mktitle['title']." ".$mostviewdata['title'];?>">
					<!--<img src="/sites/default/files/<?php echo str_replace("public://","",$sql_carimage['uri']);?>" alt="<?php echo $mostviewdata['title'];?>" width="70" height="53" />-->
					<img src="/<?php echo $model_imgname;?>" alt="<?php echo $mktitle['title']." ".$mostviewdata['title'];?>" />
				</a>
				
				<div class="Rec_carinfo">
					<p><a href="<?php echo url("node/".$mostviewdata['nid'])?>" title="<?php echo /*$mktitle['title']." ".*/$mostviewdata['title'];?>"><?php echo /*$mktitle['title']." ".*/$mostviewdata['title'];?></a></p>
					<?php
					if($price_res['minPrice']!='' & $price_res['maxPrice']!='')
					{
						if($price_res['minPrice']>=100000)
							{
								$minPrice = to_lakh($price_res['minPrice']);
							}
						else
							{
								$minPrice = $price_res['minPrice'];
							}
						if($price_res['maxPrice']>=100000)
							{
								$maxPrice = to_lakh($price_res['maxPrice'])." Lakh";
							}
						else
							{
								$maxPrice = $price_res['maxPrice'];
							}
					?>
					<div class="price"><span class="WebRupee">Rs.</span> <?php echo $minPrice." - ".$maxPrice; ?></div>
					<?php
					}
					?>
					<div class="ReviewBtns">
						<a href="<?php echo url("node/".$mostviewdata['nid'])?>" title="Overview"><img src="themes/bhp/images/buttons/review.png" alt="Review" width="47" height="12" /></a>
						<a href="#" class="add" onclick="getCarID('<?php echo $mostviewdata['nid']; ?>'); return false;"><img src="themes/bhp/images/buttons/compare.png" alt="Compare" width="57" height="12" /></a>													
					</div>
				</div>
			</li>
			<?php
				}
			?>
		</ul>
		<?php
			}
		?>
	</div><!-- recently_launched -->
<?php
	}
	?>
