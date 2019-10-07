<?php
//$q="select node.title,field_data_field_forum_model.field_forum_model_nid,field_data_field_forum_model.entity_id from node,field_data_field_forum_model where field_data_field_forum_model.field_forum_model_nid=node.nid and field_data_field_forum_model.entity_id=".$node->nid;
$q="SELECT nid,field_data_field_forum_model.field_forum_model_nid,node.type FROM field_data_field_forum_model, node
WHERE node.nid = field_data_field_forum_model.field_forum_model_nid
AND node.title LIKE '%".str_replace("-"," ",$_GET['modelname'])."%'";

$sql_modeltitle=@mysqli_query($q);
$numberoff=mysqli_num_rows($sql_modeltitle);
$sql_modeldata=@mysqli_fetch_array($sql_modeltitle);
	$node_data=node_load($sql_modeldata['field_forum_model_nid']);
	
$sql_f="select field_forum_model_nid,entity_id from field_data_field_forum_model where field_forum_model_nid=".$sql_modeldata['field_forum_model_nid']." order by  entity_id desc";
$make_res = @mysqli_fetch_array(mysqli_query("select node.title,field_data_field_nr_make.field_nr_make_nid from node,field_data_field_nr_make where field_data_field_nr_make.entity_id =".$sql_modeldata['field_forum_model_nid']." and node.nid=field_data_field_nr_make.field_nr_make_nid"));



$photos_nid = @mysqli_fetch_array(mysqli_query("select entity_id from field_data_field_gallery_model where field_gallery_model_nid=".$sql_modeldata['field_forum_model_nid']));
	if($photos_nid!='')
	{
$photos_alias = @mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$photos_nid['entity_id']."'"));
	}


$sql_urlforspecification=@mysqli_fetch_array(mysqli_query("select field_data_field_spec_nr_engine_type.entity_id,field_data_field_nr_make_model.field_nr_make_model_nid from field_data_field_nr_make_model, field_data_field_spec_nr_engine_type where field_data_field_nr_make_model.field_nr_make_model_nid=".$sql_modeldata['field_forum_model_nid']." and field_data_field_nr_make_model.entity_id=field_data_field_spec_nr_engine_type.field_spec_nr_engine_type_nid LIMIT 1"));
	if($sql_urlforspecification!='')
		{
$sql_urlforspecific=@mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$sql_urlforspecification['entity_id']."'"));
		}



$sql_forengine=mysqli_query("select node.title,field_data_field_nr_make_model.entity_id,field_data_field_nr_make_model.field_nr_make_model_nid from node,field_data_field_nr_make_model where node.nid=field_data_field_nr_make_model.entity_id and node.status=1 and field_data_field_nr_make_model.field_nr_make_model_nid=".$sql_modeldata['field_forum_model_nid']);
			$engineid='';
			while($dateforengineid=mysqli_fetch_array($sql_forengine))
				{
				$engineid.=$dateforengineid['entity_id'].",";
				}
			//	echo $engineid;
			$sql_urlforfeature=@mysqli_fetch_array(mysqli_query("select field_data_field_features_nr_variant.entity_id from field_data_field_features_nr_variant,field_data_field_variant_nr_engine where field_data_field_features_nr_variant.field_features_nr_variant_nid=field_data_field_variant_nr_engine.entity_id and field_data_field_variant_nr_engine.field_variant_nr_engine_nid in (".@substr($engineid,0,-1).") limit 1"));
	if($sql_urlforfeature!='')
		{
$sql_urlforfeaturedata=@mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$sql_urlforfeature['entity_id']."'"));
		}

$forum_review_nid = @mysqli_fetch_array(mysqli_query("select entity_id from field_data_field_forum_model where field_forum_model_nid=".$sql_modeldata['field_forum_model_nid']));
	if($forum_review_nid!='')
		{
$forum_review_alias = @mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$forum_review_nid['entity_id']."'"));
		}
		$sql_urlforprice=@mysqli_fetch_array(mysqli_query("select field_data_field_price_nr_variant.entity_id from field_data_field_nr_make_model, field_data_field_variant_nr_engine, field_data_field_price_nr_variant where field_data_field_nr_make_model.field_nr_make_model_nid=".$sql_modeldata['field_forum_model_nid']." and field_data_field_nr_make_model.entity_id=field_data_field_variant_nr_engine.field_variant_nr_engine_nid and field_data_field_variant_nr_engine.entity_id=field_data_field_price_nr_variant.field_price_nr_variant_nid"));
		if($sql_urlforprice!='')
		{
$sql_urlforpricedata=@mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$sql_urlforprice['entity_id']."'"));
		}
		
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
											$res_forum=@mysqli_query($sql_f);
											$nofff=@mysqli_num_rows($res_forum);
											if($nofff>0)
												{
	?>
				<div class="article">
							<h1 class="padL20 marB10">Reviews</h1>
							<ul class="tab TLR5 clearfix">
								<li><a href="<?php echo url("node/".$sql_modeldata['field_forum_model_nid']);?>" class="TLR5" title="Overview">Overview</a></li>
								<?php
								if($photos_alias!='')
									{
								?>
								<li><a href="<?php echo $photos_alias['alias'];?>" class="TLR5" title="Photos">Photos</a></li>
								<?php
									}
									if($sql_urlforspecific!='')
									{
								?>
								<li><a href="<?php echo $sql_urlforspecific['alias'];?>" class="TLR5" title="Specifications">Specifications</a></li>
								<?php
									}
									if($sql_urlforfeaturedata!='')
									{
								?>
								<li><a href="<?php echo $sql_urlforfeaturedata['alias'];?>" class="TLR5" title="Features">Features</a></li>
								<?php
									}
								?>
								<li><a href="<?php echo "http://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI'];//url("node/".$sql_modeldata['nid']);?>" class="TLR5 active" title="Forum Reviews">Forum Reviews</a></li>
								<?php
									if($sql_urlforpricedata!='')
									{
								?>
								<li><a href="<?php echo $sql_urlforpricedata['alias'];?>" class="TLR5" title="Price">Price</a></li>	
								<?php
									}
								?>															
							</ul>
							
						<div class="tab_container marB10 BLR5">								
							<div class="tab_content forum clearfix" style="display:block">
								<div class="clearfix marB10">
										<div class="fleft w480 padL20">
											<h1><?php echo $make_res['title']." ".$node_data->title;?> <span>Forum Reviews</span></h1>
										</div>
										<?php include ("includes/common/share.php") ?>
								</div><!-- clearfix -->								
								<div class="forumLeft clearfix fleft">
									<ul class="newslist">
											<?php
											
											while($row_forum=@mysqli_fetch_array($res_forum))
												{
										 $sql_image=@mysqli_fetch_array(mysqli_query("select field_data_field_forum_review_image.entity_id,field_data_field_forum_review_image.field_forum_review_image_fid,file_managed.uri from file_managed,field_data_field_forum_review_image where field_data_field_forum_review_image.field_forum_review_image_fid =file_managed.fid and field_data_field_forum_review_image.entity_id=".$row_forum['entity_id']));
										 $sql_title=@mysqli_fetch_array(mysqli_query("select title from node where nid=".$row_forum['entity_id']));
										 $sql_submittedby=@mysqli_fetch_array(mysqli_query("select field_forum_review_posted_by_value from field_data_field_forum_review_posted_by where entity_id=".$row_forum['entity_id']));
										 $sql_forumreview=@mysqli_fetch_array(mysqli_query("select field_forum_review_description_value from field_data_field_forum_review_description where entity_id=".$row_forum['entity_id']));
										 $sql_link=@mysqli_fetch_array(mysqli_query("select field_forum_link_url from field_data_field_forum_link where entity_id=".$row_forum['entity_id']));
										 	
										?>
										<li>
											<div class="clearfix listHolder">
												<div class="fleft w170">
													<a class="holderImg" href="<?php echo $sql_link['field_forum_link_url'];?>" title="<?php echo $sql_title['title'];?>" target="_blank">
														<!-- <img src="http://www.team-bhp.com/sites/default/files/<?php echo str_replace("public://","",$sql_image['uri']);?>" alt="<?php echo $sql_title['title'];?>" width="165" height="124" /> -->
														<strong>
														<img src="http://www.team-bhp.com/?q=sites/default/files/styles/check_medium_medium/public/<?php echo str_replace("public://","",$sql_image['uri']);?>" alt="<?php echo $sql_title['title'];?>" /> 
														</strong>
													</a>
												</div><!-- News thum holder -->
												
												<div class="fright w460 ShortNews">
													<h2><a href="<?php echo $sql_link['field_forum_link_url'];?>" title="<?php echo $sql_title['title'];?>" target="_blank"><?php echo $sql_title['title'];?></a></h2>
													<div class="postDate">By <?php echo $sql_submittedby['field_forum_review_posted_by_value'];?></div>
													<div class="past_shornote">
																<?php
																if(strlen($sql_forumreview['field_forum_review_description_value'])>195)
																		{
																		$finddot=@strpos($sql_forumreview['field_forum_review_description_value'],".",195);
																		$findspcetostop=@strpos($sql_forumreview['field_forum_review_description_value']," ",195);
																		if(intval($finddot)<intval($findspcetostop) && intval($finddot)>1)
																			{
																			$pos=$finddot;
																			}
																		else
																			{
																			$pos=$findspcetostop;
																			}
																			$pos=$pos+1;
																		 }
																		else
																		{
																			$pos=strlen($sql_forumreview['field_forum_review_description_value']);
																		}
																			if($pos>1)
																		{
																			$desc = trim(substr($sql_forumreview['field_forum_review_description_value'],0 , $pos));
																		}
																		else
																		{
																			 $desc = $sql_forumreview['field_forum_review_description_value'];
																		}
																		if(strlen($sql_forumreview['field_forum_review_description_value'])>200)
																		{
																		//trim($desc.="<a href='".$sql_link['field_forum_link_url']."' target='_blank'>&hellip;</a>");
																		trim($desc.="&hellip;");
																		}
																		echo $desc;
																?>
													</div>
												</div><!-- w460 -->
											</div><!-- List holder  -->
										</li><!-- news list -->
										<?php
												}
											 
											?>
											
										
									</ul>
								</div>
								<div class="fright" style="padding-top:0" id="sidebar">
									<?php include ("includes/member-threads.php"); //On The Forum?>
									<?php include ("includes/member-photos.php") ;?>
									<?php include ("includes/add-banner.php"); ?>									
								</div>
							</div><!-- tab_content -->
						</div><!-- tab_container -->
							
						<div class="clearfix padL20">
							<a href="reviews<?php //echo url("node/".$node->field_forum_model['und'][0]['nid']);?>" class="fleft btnLeft">
								<span>Back to Index</span>
							</a>
							<!--<a class="compareClose" id="compareBtn" href="#" onclick="return false;">&nbsp;</a>-->
						</div>	
							<?php 
			$sql_model=@mysqli_query("SELECT node.title,node.nid, field_data_field_nr_make.field_nr_make_nid
FROM node,field_data_field_nr_make WHERE field_data_field_nr_make.entity_id = node.nid AND node.status =1 AND  node.nid=".$sql_modeldata['field_forum_model_nid']." order by node.changed desc");
$numberofrows=@mysqli_num_rows($sql_model);
							if($numberofrows>0)
									{
				$sql_sequenceimgmainimg=@mysqli_fetch_array(mysqli_query("SELECT distinct(field_gallery_interior_alt) as alt, field_gallery_interior_title as title, field_gallery_interior_fid as fid FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$sql_modeldata['field_forum_model_nid']."' and field_data_field_gallery_interior.field_gallery_interior_alt!='' UNION SELECT distinct(field_gallery_exterior_alt) as alt, field_gallery_exterior_title as title, field_gallery_exterior_fid as fid FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$sql_modeldata['field_forum_model_nid']."' and field_data_field_gallery_exterior.field_gallery_exterior_alt!='' UNION SELECT distinct(field_gallery_engine_alt) as alt, field_gallery_engine_title as title, field_gallery_engine_fid as fid FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$sql_modeldata['field_forum_model_nid']."' and field_data_field_gallery_engine.field_gallery_engine_alt!='' UNION SELECT distinct(field_gallery_smaller_alt) as alt, field_gallery_smaller_title as title, field_gallery_smaller_fid as fid FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$sql_modeldata['field_forum_model_nid']."' and field_data_field_gallery_smaller.field_gallery_smaller_alt!='' order by alt limit 0,1"));
						if($sql_sequenceimgmainimg=='')
							{
							$sql_sequenceimgwithoutorder=@mysqli_fetch_array(mysqli_query("SELECT field_data_field_gallery_interior.delta as delta , field_gallery_interior_title as title, field_gallery_interior_fid as fidint FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$sql_modeldata['field_forum_model_nid']."' UNION SELECT field_data_field_gallery_exterior.delta as delta, field_gallery_exterior_title as title, field_gallery_exterior_fid as fidint FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$sql_modeldata['field_forum_model_nid']."' UNION SELECT field_data_field_gallery_engine.delta as delta, field_gallery_engine_title as title, field_gallery_engine_fid as fidint FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$sql_modeldata['field_forum_model_nid']."' UNION SELECT field_data_field_gallery_smaller.delta as delta, field_gallery_smaller_title as title, field_gallery_smaller_fid as fidint FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$sql_modeldata['field_forum_model_nid']."' order by delta limit 0,1"));
								if($sql_sequenceimgwithoutorder=='')
									{
									$model_modleimgname="sites/default/files/defaultmodel_46.gif";
									}
								else
									{
								$model_img=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$sql_sequenceimgwithoutorder['fidint']));
								$model_modleimgname="?q=sites/default/files/styles/check_thumb_compare_car/public/".str_replace("public://","",$model_img['uri']);
									}
							}
						else
							{
							$model_img=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$sql_sequenceimgmainimg['fid']));
							$model_modleimgname="?q=sites/default/files/styles/check_thumb_compare_car/public/".str_replace("public://","",$model_img['uri']);
							}	
							?>
						<div class="compareMesgInside"><p class="compareMesgPad roundAll5">You have already added that car. Please choose another car.</p></div>
						<div class="marB10 BLR5 reviewCompare" style="display:block">
						<ul class="clearfix" id="compareUL">
							<?php
							$data_model=mysqli_fetch_array($sql_model);
							$sql_url=@mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$data_model['nid']."'"));
							$mktitle=@mysqli_fetch_array(mysqli_query("select title from node,field_data_field_nr_make where field_data_field_nr_make.entity_id =".$data_model['nid']." and field_data_field_nr_make.field_nr_make_nid=node.nid"));
							$price_res = @mysql_fetch_assoc(mysqli_query("select min(on_road_price) as minPrice, max(on_road_price) as maxPrice from team_bhp_variant_price, field_data_field_price_nr_variant, field_data_field_variant_nr_engine, field_data_field_nr_make_model where team_bhp_variant_price.city='Delhi' and team_bhp_variant_price.nid=field_data_field_price_nr_variant.entity_id and field_data_field_price_nr_variant.field_price_nr_variant_nid=field_data_field_variant_nr_engine.entity_id and field_data_field_variant_nr_engine.field_variant_nr_engine_nid=field_data_field_nr_make_model.entity_id and field_data_field_nr_make_model.field_nr_make_model_nid=".$sql_modeldata['field_forum_model_nid']));
							?>
							<li class="clearfix">
								<div class="content firstContent clearfix" id="<?php echo $data_model['nid']; ?>" rel="<?php echo str_replace("review/","",$sql_url['alias'])?>">
									<div class="img">
									<strong>
									<!-- <img src="http://www.team-bhp.com/sites/default/files/<?php echo str_replace("public://","",$data_model['uri']);?>" alt="car" width="61" height="48" />-->
									<img src="http://www.team-bhp.com/<?php echo $model_modleimgname;?>" alt="<?php echo $mktitle['title']." ".$data_model['title'];?>" />
									</strong>
									</div>
									<p class="desc">
										<span class="title"><?php echo $mktitle['title']." ".$data_model['title'];?></span>
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
										<span class="price"><span class="WebRupee">Rs.</span> <?php echo $minPrice." - ".$maxPrice; ?></span>
						 <?php
					  	}
						 ?>
									</p>
									<!--<span class="iconRemove">&nbsp;</span>-->
								</div>
							</li>
							<?php							
									include_once("includes/compare-inside.php");
							?>
							</ul><!-- clearfix -->
						</div><!-- reviewCompare -->
					<?php 
									}
			//$sql_modelalternative=@mysqli_query("SELECT node.title,node.nid,field_data_field_model_alternatives.field_model_alternatives_nid from node,field_data_field_model_alternatives WHERE field_data_field_model_alternatives.field_model_alternatives_nid = node.nid AND node.status =1  and field_data_field_model_alternatives.entity_id =".$sql_modeldata['field_forum_model_nid']." order by node.changed desc");
			$sql_modelalternative=@mysqli_query("SELECT node.title AS title, node.nid AS nid, field_data_field_model_alternatives.field_model_alternatives_nid FROM node, field_data_field_model_alternatives WHERE field_data_field_model_alternatives.field_model_alternatives_nid = node.nid AND node.status =1 AND field_data_field_model_alternatives.entity_id=".$sql_modeldata['field_forum_model_nid']." UNION SELECT node.title AS title, node.nid AS nid, field_data_field_model_alternatives.entity_id FROM node, field_data_field_model_alternatives WHERE field_data_field_model_alternatives.entity_id = node.nid AND node.status =1 AND field_data_field_model_alternatives.field_model_alternatives_nid=".$sql_modeldata['field_forum_model_nid']." ORDER BY title");
			include_once("includes/alternative_forreview.php");
					?>
		</div><!-- articles -->
										<?php
											}
											else
											{
											//print(node_load(223)->body['und'][0]['value']);
											//return drupal_not_found();
											drupal_goto('page-not-found');
											}
										?>
