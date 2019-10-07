	<?php
	$urltoshareimage='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

	if($node->type=='news')
		{
		if($node->field_news_media_type['und'][0]['value']=='Images')
			{
			 $urltoshareimage.="?q=sites/default/files/styles/check_medium_medium/public/".str_replace("public://","",$node->field_news_images['und'][0]['uri']);
			}
		else
			{
			if(strpos($node->field_news_video['und'][0]['url'], "youtu.be/")>1)
			    {
					$Vid = substr($node->field_news_video['und'][0]['url'], 16);
				}
				else
				{
					$strfinded="&feature=related";
					$replaced_videosource=@str_replace($strfinded,"", $node->field_news_video['und'][0]['url']);
					$explodedsource=@explode("=",$replaced_videosource);
					if(strpos($explodedsource[1], '&feature')>0)
						{
						$Vid = substr($explodedsource[1], 0, strpos($explodedsource[1], '&feature'));
						}
					else
						{
						$Vid = $explodedsource[1];
						}
				}
				$urltoshareimage='';
			 $urltoshareimage.='http://img.youtube.com/vi/'.$Vid.'/1.jpp';
			}
			if($node->field_news_content['und'][0]['safe_value']!="")
				{
					if(strlen($node->field_news_content['und'][0]['safe_value'])>200)
					{
					$finddottostop=@strpos($node->field_news_content['und'][0]['safe_value'],". ",200);
					$findspacetostop=@strpos($node->field_news_content['und'][0]['safe_value']," ",200);
						if(intval($finddottostop)<intval($findspacetostop) && intval($finddottostop)>1)
							{
							$postostart=$finddottostop;
							}
						else
							{
							$postostart=$findspacetostop;
							}
							$postostart=$postostart+1;
					}
					else
					{
						$postostart=strlen($node->field_news_content['und'][0]['safe_value']);
					}
					if($postostart>1)
					{
						$ogDesc = substr($node->field_news_content['und'][0]['safe_value'],0 , $postostart	);
					}
					else
					{
						$ogDesc = $node->field_news_content['und'][0]['safe_value'];
					}
					if(strlen($node->field_news_content['und'][0]['safe_value'])>200)
					{
					$ogDesc.= "...";
					}
					
					?>
					<meta property="og:type" content="<?php echo $node->field_news_category['und'][0]['value'];?>" />
					<meta property="og:description" content="<?php echo strip_tags(trim($ogDesc)); ?>" />
					<meta property="og:title" content="<?php echo $node->title?>" />
			<?php
			   }
	  	}
	  	else if ($node->type=='model' || $node->type=='gallery_images' || $node->type=='specifications' || $node->type=='features' || $_GET['q']!='' || $node->type=='price')
	  			{
	  			
	  				if($node->type=='model')
	  					{
	  					if($node->field_review_summary['und'][0]['value']!="")
							{
								if(strlen($node->field_review_summary['und'][0]['value'])>200)
								{
								$finddottostop=@strpos($node->field_review_summary['und'][0]['value'],". ",200);
								$findspacetostop=@strpos($node->field_review_summary['und'][0]['value']," ",200);
									if(intval($finddottostop)<intval($findspacetostop) && intval($finddottostop)>1)
										{
										$postostart=$finddottostop;
										}
									else
										{
										$postostart=$findspacetostop;
										}
										$postostart=$postostart+1;
								}
								else
								{
									$postostart=strlen($node->field_review_summary['und'][0]['value']);
								}
								if($postostart>1)
								{
									$ogDesc = substr($node->field_review_summary['und'][0]['value'],0 , $postostart);
								}
								else
								{
									$ogDesc = $node->field_review_summary['und'][0]['value'];
								}
								if(strlen($node->field_review_summary['und'][0]['value'])>200)
								{
								$ogDesc.= "...";
								}
							?>
							<meta property="og:description" content="<?php echo strip_tags(trim($ogDesc)); ?>" />
							<?php
									}
									 $q_e_imgtosharewithseq=mysqli_query("SELECT distinct(field_gallery_interior_alt) as alt, field_gallery_interior_title as title, field_gallery_interior_fid as fid FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$node->nid."' and field_data_field_gallery_interior.field_gallery_interior_alt!='' 
UNION SELECT distinct(field_gallery_exterior_alt) as alt, field_gallery_exterior_title as title, field_gallery_exterior_fid as fid  FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$node->nid."' and field_data_field_gallery_exterior.field_gallery_exterior_alt!=''
UNION SELECT distinct(field_gallery_engine_alt) as alt, field_gallery_engine_title as title, field_gallery_engine_fid as fid  FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$node->nid."' and field_data_field_gallery_engine.field_gallery_engine_alt!=''
UNION SELECT distinct(field_gallery_smaller_alt) as alt, field_gallery_smaller_title as title, field_gallery_smaller_fid as fid FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$node->nid."' and field_data_field_gallery_smaller.field_gallery_smaller_alt!='' order by alt limit 0,4");
									if(@mysqli_num_rows($q_e_imgtosharewithseq)>0)
										{
										$d_singleextimgforshare=mysqli_fetch_array($q_e_imgtosharewithseq);
										$model_imgtoshare=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$d_singleextimgforshare['fid']));
										$urltoshareimage.="?q=sites/default/files/styles/check_tech_stuff/public/".str_replace("public://","",$model_imgtoshare['uri']);
										}
									else
										{
										$sql_withoutseqforshare=@mysqli_query("SELECT field_data_field_gallery_interior.delta as delta , field_gallery_interior_title as title, field_gallery_interior_fid as fidint FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$node->nid."' UNION SELECT field_data_field_gallery_exterior.delta as delta, field_gallery_exterior_title as title, field_gallery_exterior_fid as fidint FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$node->nid."' UNION SELECT field_data_field_gallery_engine.delta as delta, field_gallery_engine_title as title, field_gallery_engine_fid as fidint FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$node->nid."' UNION SELECT field_data_field_gallery_smaller.delta as delta, field_gallery_smaller_title as title, field_gallery_smaller_fid as fidint FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$node->nid."' order by delta limit 0,4");
									if(@mysqli_num_rows($sql_withoutseqforshare)==0)
										{
										$urltoshareimage='';
									$urltoshareimage.='http://'.$_SERVER['HTTP_HOST']."/sites/default/files/defaultmodel_278.gif";
										}
										else
											{
										$sql_withoutseqforshare=@mysqli_fetch_array($sql_withoutseqforshare);	
										$model_imgtoshare=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$sql_withoutseqforshare['fidint']));
										$urltoshareimage.="?q=sites/default/files/styles/check_tech_stuff/public/".str_replace("public://","",$model_imgtoshare['uri']);
											}
									}
							?>
							<meta property="og:type" content="reviews" />
							<meta property="og:title" content="<?php echo $node->title?>" />
									<?php
								
	  				}
	  				else if($node->type=='gallery_images')
	  					{
	  					
	  					$node_modelbygallery=node_load($node->field_gallery_model['und'][0]['nid']);
	  					 $q_e_imgtosharewithseq=mysqli_query("SELECT distinct(field_gallery_interior_alt) as alt, field_gallery_interior_title as title, field_gallery_interior_fid as fid FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$node->field_gallery_model['und'][0]['nid']."' and field_data_field_gallery_interior.field_gallery_interior_alt!='' 
UNION SELECT distinct(field_gallery_exterior_alt) as alt, field_gallery_exterior_title as title, field_gallery_exterior_fid as fid  FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$node->field_gallery_model['und'][0]['nid']."' and field_data_field_gallery_exterior.field_gallery_exterior_alt!=''
UNION SELECT distinct(field_gallery_engine_alt) as alt, field_gallery_engine_title as title, field_gallery_engine_fid as fid  FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$node->field_gallery_model['und'][0]['nid']."' and field_data_field_gallery_engine.field_gallery_engine_alt!=''
UNION SELECT distinct(field_gallery_smaller_alt) as alt, field_gallery_smaller_title as title, field_gallery_smaller_fid as fid FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$node->field_gallery_model['und'][0]['nid']."' and field_data_field_gallery_smaller.field_gallery_smaller_alt!='' order by alt limit 0,4");
									if(@mysqli_num_rows($q_e_imgtosharewithseq)>0)
										{
										$d_singleextimgforshare=mysqli_fetch_array($q_e_imgtosharewithseq);
										$model_imgtoshare=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$d_singleextimgforshare['fid']));
										$urltoshareimage.="?q=sites/default/files/styles/check_thumb_review_detail/public/".str_replace("public://","",$model_imgtoshare['uri']);
										}
									else
										{
										$sql_withoutseqforshare=@mysqli_query("SELECT field_data_field_gallery_interior.delta as delta , field_gallery_interior_title as title, field_gallery_interior_fid as fidint FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$node->field_gallery_model['und'][0]['nid']."' UNION SELECT field_data_field_gallery_exterior.delta as delta, field_gallery_exterior_title as title, field_gallery_exterior_fid as fidint FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$node->field_gallery_model['und'][0]['nid']."' UNION SELECT field_data_field_gallery_engine.delta as delta, field_gallery_engine_title as title, field_gallery_engine_fid as fidint FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$node->field_gallery_model['und'][0]['nid']."' UNION SELECT field_data_field_gallery_smaller.delta as delta, field_gallery_smaller_title as title, field_gallery_smaller_fid as fidint FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$node->field_gallery_model['und'][0]['nid']."' order by delta limit 0,4");
									if(@mysqli_num_rows($sql_withoutseqforshare)==0)
										{
										$urltoshareimage='';
									$urltoshareimage.='http://'.$_SERVER['HTTP_HOST']."/sites/default/files/defaultmodel_278.gif";
										}
										else
											{
										$sql_withoutseqforshare=@mysqli_fetch_array($sql_withoutseqforshare);
										$model_imgtoshare=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$sql_withoutseqforshare['fidint']));
									    $urltoshareimage.="?q=sites/default/files/styles/check_thumb_review_detail/public/".str_replace("public://","",$model_imgtoshare['uri']);
											}
										}
	  					if($node_modelbygallery->field_review_summary['und'][0]['value']!="")
							{
								if(strlen($node_modelbygallery->field_review_summary['und'][0]['value'])>200)
								{
								$finddottostop=@strpos($node_modelbygallery->field_review_summary['und'][0]['value'],". ",200);
								$findspacetostop=@strpos($node_modelbygallery->field_review_summary['und'][0]['value']," ",200);
									if(intval($finddottostop)<intval($findspacetostop) && intval($finddottostop)>1)
										{
										$postostart=$finddottostop;
										}
									else
										{
										$postostart=$findspacetostop;
										}
										$postostart=$postostart+1;
								}
								else
								{
									$postostart=strlen($node_modelbygallery->field_review_summary['und'][0]['value']);
								}
								if($postostart>1)
								{
									$ogDesc = substr($node_modelbygallery->field_review_summary['und'][0]['value'],0 , $postostart);
								}
								else
								{
									$ogDesc = $node_modelbygallery->field_review_summary['und'][0]['value'];
								}
								if(strlen($node_modelbygallery->field_review_summary['und'][0]['value'])>200)
								{
								$ogDesc.= "...";
								}
							?>
							<meta property="og:description" content="<?php echo strip_tags(trim($ogDesc)); ?>" />
							<?php
									}
									?>
									<meta property="og:type" content="reviews" />
									<meta property="og:title" content="<?php echo $node_modelbygallery->title?>" />
	  					<?php
	  					}
	  					else if($node->type=='specifications')
	  					{
	  					
	  					$node_modelbygallery=node_load($model_id['field_nr_make_model_nid']);
	  					 $q_e_imgtosharewithseq=mysqli_query("SELECT distinct(field_gallery_interior_alt) as alt, field_gallery_interior_title as title, field_gallery_interior_fid as fid FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_id['field_nr_make_model_nid']."' and field_data_field_gallery_interior.field_gallery_interior_alt!='' 
UNION SELECT distinct(field_gallery_exterior_alt) as alt, field_gallery_exterior_title as title, field_gallery_exterior_fid as fid  FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_id['field_nr_make_model_nid']."' and field_data_field_gallery_exterior.field_gallery_exterior_alt!=''
UNION SELECT distinct(field_gallery_engine_alt) as alt, field_gallery_engine_title as title, field_gallery_engine_fid as fid  FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_id['field_nr_make_model_nid']."' and field_data_field_gallery_engine.field_gallery_engine_alt!=''
UNION SELECT distinct(field_gallery_smaller_alt) as alt, field_gallery_smaller_title as title, field_gallery_smaller_fid as fid FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_id['field_nr_make_model_nid']."' and field_data_field_gallery_smaller.field_gallery_smaller_alt!='' order by alt limit 0,4");
									if(@mysqli_num_rows($q_e_imgtosharewithseq)>0)
										{
										$d_singleextimgforshare=mysqli_fetch_array($q_e_imgtosharewithseq);
										$model_imgtoshare=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$d_singleextimgforshare['fid']));
										$urltoshareimage.="?q=sites/default/files/styles/check_thumb_review_detail/public/".str_replace("public://","",$model_imgtoshare['uri']);
										}
									else
										{
										$sql_withoutseqforshare=@mysqli_query("SELECT field_data_field_gallery_interior.delta as delta , field_gallery_interior_title as title, field_gallery_interior_fid as fidint FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_id['field_nr_make_model_nid']."' UNION SELECT field_data_field_gallery_exterior.delta as delta, field_gallery_exterior_title as title, field_gallery_exterior_fid as fidint FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_id['field_nr_make_model_nid']."' UNION SELECT field_data_field_gallery_engine.delta as delta, field_gallery_engine_title as title, field_gallery_engine_fid as fidint FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_id['field_nr_make_model_nid']."' UNION SELECT field_data_field_gallery_smaller.delta as delta, field_gallery_smaller_title as title, field_gallery_smaller_fid as fidint FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_id['field_nr_make_model_nid']."' order by delta limit 0,4");
									if(@mysqli_num_rows($sql_withoutseqforshare)==0)
										{
										$urltoshareimage='';
									$urltoshareimage.='http://'.$_SERVER['HTTP_HOST']."/sites/default/files/defaultmodel_278.gif";
										}
										else
											{
										$sql_withoutseqforshare=@mysqli_fetch_array($sql_withoutseqforshare);
										$model_imgtoshare=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$sql_withoutseqforshare['fidint']));
									    $urltoshareimage.="?q=sites/default/files/styles/check_thumb_review_detail/public/".str_replace("public://","",$model_imgtoshare['uri']);
											}
										}
	  					if($node_modelbygallery->field_review_summary['und'][0]['value']!="")
							{
								if(strlen($node_modelbygallery->field_review_summary['und'][0]['value'])>200)
								{
								$finddottostop=@strpos($node_modelbygallery->field_review_summary['und'][0]['value'],". ",200);
								$findspacetostop=@strpos($node_modelbygallery->field_review_summary['und'][0]['value']," ",200);
									if(intval($finddottostop)<intval($findspacetostop) && intval($finddottostop)>1)
										{
										$postostart=$finddottostop;
										}
									else
										{
										$postostart=$findspacetostop;
										}
										$postostart=$postostart+1;
								}
								else
								{
									$postostart=strlen($node_modelbygallery->field_review_summary['und'][0]['value']);
								}
								if($postostart>1)
								{
									$ogDesc = substr($node_modelbygallery->field_review_summary['und'][0]['value'],0 , $postostart);
								}
								else
								{
									$ogDesc = $node_modelbygallery->field_review_summary['und'][0]['value'];
								}
								if(strlen($node_modelbygallery->field_review_summary['und'][0]['value'])>200)
								{
								$ogDesc.= "...";
								}
							?>
							<meta property="og:description" content="<?php echo strip_tags(trim($ogDesc)); ?>" />
							<?php
									}
									?>
									<meta property="og:type" content="reviews" />
									<meta property="og:title" content="<?php echo $node_modelbygallery->title?>" />
	  					<?php
	  					}
	  					else if($node->type=='features')
	  					{
	  					 $node_modelbygallery=node_load($sql_modeldata['field_nr_make_model_nid']);
	  					 $q_e_imgtosharewithseq=mysqli_query("SELECT distinct(field_gallery_interior_alt) as alt, field_gallery_interior_title as title, field_gallery_interior_fid as fid FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$sql_modeldata['field_nr_make_model_nid']."' and field_data_field_gallery_interior.field_gallery_interior_alt!='' 
UNION SELECT distinct(field_gallery_exterior_alt) as alt, field_gallery_exterior_title as title, field_gallery_exterior_fid as fid  FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$sql_modeldata['field_nr_make_model_nid']."' and field_data_field_gallery_exterior.field_gallery_exterior_alt!=''
UNION SELECT distinct(field_gallery_engine_alt) as alt, field_gallery_engine_title as title, field_gallery_engine_fid as fid  FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$sql_modeldata['field_nr_make_model_nid']."' and field_data_field_gallery_engine.field_gallery_engine_alt!=''
UNION SELECT distinct(field_gallery_smaller_alt) as alt, field_gallery_smaller_title as title, field_gallery_smaller_fid as fid FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$sql_modeldata['field_nr_make_model_nid']."' and field_data_field_gallery_smaller.field_gallery_smaller_alt!='' order by alt limit 0,4");
									if(@mysqli_num_rows($q_e_imgtosharewithseq)>0)
										{
										$d_singleextimgforshare=mysqli_fetch_array($q_e_imgtosharewithseq);
										$model_imgtoshare=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$d_singleextimgforshare['fid']));
										$urltoshareimage.="?q=sites/default/files/styles/check_thumb_review_detail/public/".str_replace("public://","",$model_imgtoshare['uri']);
										}
									else
										{
										$sql_withoutseqforshare=@mysqli_query("SELECT field_data_field_gallery_interior.delta as delta , field_gallery_interior_title as title, field_gallery_interior_fid as fidint FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$sql_modeldata['field_nr_make_model_nid']."' UNION SELECT field_data_field_gallery_exterior.delta as delta, field_gallery_exterior_title as title, field_gallery_exterior_fid as fidint FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$sql_modeldata['field_nr_make_model_nid']."' UNION SELECT field_data_field_gallery_engine.delta as delta, field_gallery_engine_title as title, field_gallery_engine_fid as fidint FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$sql_modeldata['field_nr_make_model_nid']."' UNION SELECT field_data_field_gallery_smaller.delta as delta, field_gallery_smaller_title as title, field_gallery_smaller_fid as fidint FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$sql_modeldata['field_nr_make_model_nid']."' order by delta limit 0,4");
									if(@mysqli_num_rows($sql_withoutseqforshare)==0)
										{
										$urltoshareimage='';
									$urltoshareimage.='http://'.$_SERVER['HTTP_HOST']."/sites/default/files/defaultmodel_278.gif";
										}
										else
											{
										$sql_withoutseqforshare=@mysqli_fetch_array($sql_withoutseqforshare);
										$model_imgtoshare=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$sql_withoutseqforshare['fidint']));
									    $urltoshareimage.="?q=sites/default/files/styles/check_thumb_review_detail/public/".str_replace("public://","",$model_imgtoshare['uri']);
											}
										}
	  					if($node_modelbygallery->field_review_summary['und'][0]['value']!="")
							{
								if(strlen($node_modelbygallery->field_review_summary['und'][0]['value'])>200)
								{
								$finddottostop=@strpos($node_modelbygallery->field_review_summary['und'][0]['value'],". ",200);
								$findspacetostop=@strpos($node_modelbygallery->field_review_summary['und'][0]['value']," ",200);
									if(intval($finddottostop)<intval($findspacetostop) && intval($finddottostop)>1)
										{
										$postostart=$finddottostop;
										}
									else
										{
										$postostart=$findspacetostop;
										}
										$postostart=$postostart+1;
								}
								else
								{
									$postostart=strlen($node_modelbygallery->field_review_summary['und'][0]['value']);
								}
								if($postostart>1)
								{
									$ogDesc = substr($node_modelbygallery->field_review_summary['und'][0]['value'],0 , $postostart);
								}
								else
								{
									$ogDesc = $node_modelbygallery->field_review_summary['und'][0]['value'];
								}
								if(strlen($node_modelbygallery->field_review_summary['und'][0]['value'])>200)
								{
								$ogDesc.= "...";
								}
							?>
							<meta property="og:description" content="<?php echo strip_tags(trim($ogDesc)); ?>" />
							<?php
									}
									?>
									<meta property="og:type" content="reviews" />
									<meta property="og:title" content="<?php echo $node_modelbygallery->title?>" />
	  					<?php
	  					}
	  					else if($_GET['q']!='' && $sql_modeldata['type']=='model')
	  					{
	  					 $node_modelbygallery=node_load($sql_modeldata['field_forum_model_nid']);
	  					 $q_e_imgtosharewithseq=mysqli_query("SELECT distinct(field_gallery_interior_alt) as alt, field_gallery_interior_title as title, field_gallery_interior_fid as fid FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$sql_modeldata['field_forum_model_nid']."' and field_data_field_gallery_interior.field_gallery_interior_alt!='' 
UNION SELECT distinct(field_gallery_exterior_alt) as alt, field_gallery_exterior_title as title, field_gallery_exterior_fid as fid  FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$sql_modeldata['field_forum_model_nid']."' and field_data_field_gallery_exterior.field_gallery_exterior_alt!=''
UNION SELECT distinct(field_gallery_engine_alt) as alt, field_gallery_engine_title as title, field_gallery_engine_fid as fid  FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$sql_modeldata['field_forum_model_nid']."' and field_data_field_gallery_engine.field_gallery_engine_alt!=''
UNION SELECT distinct(field_gallery_smaller_alt) as alt, field_gallery_smaller_title as title, field_gallery_smaller_fid as fid FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$sql_modeldata['field_forum_model_nid']."' and field_data_field_gallery_smaller.field_gallery_smaller_alt!='' order by alt limit 0,4");
									if(@mysqli_num_rows($q_e_imgtosharewithseq)>0)
										{
										$d_singleextimgforshare=mysqli_fetch_array($q_e_imgtosharewithseq);
										$model_imgtoshare=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$d_singleextimgforshare['fid']));
										$urltoshareimage.="?q=sites/default/files/styles/check_thumb_review_detail/public/".str_replace("public://","",$model_imgtoshare['uri']);
										}
									else
										{
										$sql_withoutseqforshare=@mysqli_query("SELECT field_data_field_gallery_interior.delta as delta , field_gallery_interior_title as title, field_gallery_interior_fid as fidint FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$sql_modeldata['field_forum_model_nid']."' UNION SELECT field_data_field_gallery_exterior.delta as delta, field_gallery_exterior_title as title, field_gallery_exterior_fid as fidint FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$sql_modeldata['field_forum_model_nid']."' UNION SELECT field_data_field_gallery_engine.delta as delta, field_gallery_engine_title as title, field_gallery_engine_fid as fidint FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$sql_modeldata['field_forum_model_nid']."' UNION SELECT field_data_field_gallery_smaller.delta as delta, field_gallery_smaller_title as title, field_gallery_smaller_fid as fidint FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$sql_modeldata['field_forum_model_nid']."' order by delta limit 0,4");
									if(@mysqli_num_rows($sql_withoutseqforshare)==0)
										{
										$urltoshareimage='';
									$urltoshareimage.='http://'.$_SERVER['HTTP_HOST']."/sites/default/files/defaultmodel_278.gif";
										}
										else
											{
										$sql_withoutseqforshare=@mysqli_fetch_array($sql_withoutseqforshare);
										$model_imgtoshare=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$sql_withoutseqforshare['fidint']));
									    $urltoshareimage.="?q=sites/default/files/styles/check_thumb_review_detail/public/".str_replace("public://","",$model_imgtoshare['uri']);
											}
										}
	  					if($node_modelbygallery->field_review_summary['und'][0]['safe_value']!="")
							{
								if(strlen($node_modelbygallery->field_review_summary['und'][0]['value'])>200)
								{
								$finddottostop=@strpos($node_modelbygallery->field_review_summary['und'][0]['value'],". ",200);
								$findspacetostop=@strpos($node_modelbygallery->field_review_summary['und'][0]['value']," ",200);
									if(intval($finddottostop)<intval($findspacetostop) && intval($finddottostop)>1)
										{
										$postostart=$finddottostop;
										}
									else
										{
										$postostart=$findspacetostop;
										}
										$postostart=$postostart+1;
								}
								else
								{
									$postostart=strlen($node_modelbygallery->field_review_summary['und'][0]['value']);
								}
								if($postostart>1)
								{
									$ogDesc = substr($node_modelbygallery->field_review_summary['und'][0]['value'],0 , $postostart);
								}
								else
								{
									$ogDesc = $node_modelbygallery->field_review_summary['und'][0]['value'];
								}
								if(strlen($node_modelbygallery->field_review_summary['und'][0]['value'])>200)
								{
								$ogDesc.= "...";
								}
							?>
							<meta property="og:description" content="<?php echo strip_tags(trim($ogDesc)); ?>" />
							<?php
									}
									?>
									<meta property="og:type" content="reviews" />
									<meta property="og:title" content="<?php echo $node_modelbygallery->title?>" />
	  					<?php
	  					}
	  					else if($node->type=='price')
	  					{
	  					 $node_modelbygallery=node_load($model_res['nid']);
	  					 $q_e_imgtosharewithseq=mysqli_query("SELECT distinct(field_gallery_interior_alt) as alt, field_gallery_interior_title as title, field_gallery_interior_fid as fid FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_res['nid']."' and field_data_field_gallery_interior.field_gallery_interior_alt!='' 
UNION SELECT distinct(field_gallery_exterior_alt) as alt, field_gallery_exterior_title as title, field_gallery_exterior_fid as fid  FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_res['nid']."' and field_data_field_gallery_exterior.field_gallery_exterior_alt!=''
UNION SELECT distinct(field_gallery_engine_alt) as alt, field_gallery_engine_title as title, field_gallery_engine_fid as fid  FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_res['nid']."' and field_data_field_gallery_engine.field_gallery_engine_alt!=''
UNION SELECT distinct(field_gallery_smaller_alt) as alt, field_gallery_smaller_title as title, field_gallery_smaller_fid as fid FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_res['nid']."' and field_data_field_gallery_smaller.field_gallery_smaller_alt!='' order by alt limit 0,4");
									if(@mysqli_num_rows($q_e_imgtosharewithseq)>0)
										{
										$d_singleextimgforshare=mysqli_fetch_array($q_e_imgtosharewithseq);
										$model_imgtoshare=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$d_singleextimgforshare['fid']));
										$urltoshareimage.="?q=sites/default/files/styles/check_thumb_review_detail/public/".str_replace("public://","",$model_imgtoshare['uri']);
										}
									else
										{
										$sql_withoutseqforshare=@mysqli_query("SELECT field_data_field_gallery_interior.delta as delta , field_gallery_interior_title as title, field_gallery_interior_fid as fidint FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_res['nid']."' UNION SELECT field_data_field_gallery_exterior.delta as delta, field_gallery_exterior_title as title, field_gallery_exterior_fid as fidint FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_res['nid']."' UNION SELECT field_data_field_gallery_engine.delta as delta, field_gallery_engine_title as title, field_gallery_engine_fid as fidint FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_res['nid']."' UNION SELECT field_data_field_gallery_smaller.delta as delta, field_gallery_smaller_title as title, field_gallery_smaller_fid as fidint FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_res['nid']."' order by delta limit 0,4");
									if(@mysqli_num_rows($sql_withoutseqforshare)==0)
										{
										$urltoshareimage='';
									$urltoshareimage.='http://'.$_SERVER['HTTP_HOST']."/sites/default/files/defaultmodel_278.gif";
										}
										else
											{
										$sql_withoutseqforshare=@mysqli_fetch_array($sql_withoutseqforshare);
										$model_imgtoshare=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$sql_withoutseqforshare['fidint']));
									    $urltoshareimage.="?q=sites/default/files/styles/check_thumb_review_detail/public/".str_replace("public://","",$model_imgtoshare['uri']);
											}
										}
	  					if($node_modelbygallery->field_review_summary['und'][0]['safe_value']!="")
							{
								if(strlen($node_modelbygallery->field_review_summary['und'][0]['value'])>200)
								{
								$finddottostop=@strpos($node_modelbygallery->field_review_summary['und'][0]['value'],". ",200);
								$findspacetostop=@strpos($node_modelbygallery->field_review_summary['und'][0]['value']," ",200);
									if(intval($finddottostop)<intval($findspacetostop) && intval($finddottostop)>1)
										{
										$postostart=$finddottostop;
										}
									else
										{
										$postostart=$findspacetostop;
										}
										$postostart=$postostart+1;
								}
								else
								{
									$postostart=strlen($node_modelbygallery->field_review_summary['und'][0]['value']);
								}
								if($postostart>1)
								{
									$ogDesc = substr($node_modelbygallery->field_review_summary['und'][0]['value'],0 , $postostart);
								}
								else
								{
									$ogDesc = $node_modelbygallery->field_review_summary['und'][0]['value'];
								}
								if(strlen($node_modelbygallery->field_review_summary['und'][0]['value'])>200)
								{
								$ogDesc.= "...";
								}
							?>
							<meta property="og:description" content="<?php echo strip_tags(trim($ogDesc)); ?>" />
							<?php
									}
									?>
									<meta property="og:type" content="reviews" />
									<meta property="og:title" content="<?php echo $node_modelbygallery->title?>" />
	  					<?php
	  					}
	  			}
	  		
	  			
	  	else if ($node->type=='advice')
	  			{
	  				if($node->field_advice_media_type['und'][0]['value']=='Image')
	  					{
	  					$urltoshareimage.="?q=sites/default/files/styles/check_tech_stuff/public/".str_replace("public://","",$node->field_advice_images['und'][0]['uri']);
						}
					else
						{
						if(strpos($node->field_advice_video['und'][0]['url'], "youtu.be/")>1)
							{
								$Vid = substr($node->field_advice_video['und'][0]['url'], 16);
							}
							else
							{
								$strfinded="&feature=related";
								$replaced_videosource=@str_replace($strfinded,"", $node->field_advice_video['und'][0]['url']);
								$explodedsource=@explode("=",$replaced_videosource);
								if(strpos($explodedsource[1], '&feature')>0)
									{
									$Vid = substr($explodedsource[1], 0, strpos($explodedsource[1], '&feature'));
									}
								else
									{
									$Vid = $explodedsource[1];
									}
							}
							$urltoshareimage='';
							$urltoshareimage.='http://img.youtube.com/vi/'.$Vid.'/1.jpp';
						}
							if($node->field_advice_content['und'][0]['safe_value']!="")
						{
					if(strlen($node->field_advice_content['und'][0]['safe_value'])>200)
					{
					$finddottostop=@strpos($node->field_advice_content['und'][0]['safe_value'],". ",200);
					$findspacetostop=@strpos($node->field_advice_content['und'][0]['safe_value']," ",200);
						if(intval($finddottostop)<intval($findspacetostop) && intval($finddottostop)>1)
							{
							$postostart=$finddottostop;
							}
						else
							{
							$postostart=$findspacetostop;
							}
							$postostart=$postostart+1;
					}
					else
					{
						$postostart=strlen($node->field_advice_content['und'][0]['safe_value']);
					}
					if($postostart>1)
					{
						$ogDesc = substr($node->field_advice_content['und'][0]['safe_value'],0 , $postostart	);
					}
					else
					{
						$ogDesc = $node->field_advice_content['und'][0]['safe_value'];
					}
					if(strlen($node->field_advice_content['und'][0]['safe_value'])>200)
					{
					$ogDesc.= "...";
					}
	  			?>
	  			<meta property="og:description" content="<?php echo strip_tags(trim($ogDesc)); ?>" />
	  				<?php
	  			}
	  			?>
	  			<meta property="og:type" content="<?php echo $node->field_advice_categories['und'][0]['value'];?>" />
				<meta property="og:title" content="<?php echo $node->title?>" />
	  		<?php
	  		}
		else if ($node->type=='tech_stuff')
			{
				$urltoshareimage.="?q=sites/default/files/styles/check_tech_stuff/public/".str_replace("public://","",$node->field_tech_stuff_image['und'][0]['uri']);
						
					if($node->body['und'][0]['safe_value']!="")
						{
					if(strlen($node->body['und'][0]['safe_value'])>200)
					{
					$finddottostop=@strpos($node->body['und'][0]['safe_value'],". ",200);
					$findspacetostop=@strpos($node->body['und'][0]['safe_value']," ",200);
						if(intval($finddottostop)<intval($findspacetostop) && intval($finddottostop)>1)
							{
							$postostart=$finddottostop;
							}
						else
							{
							$postostart=$findspacetostop;
							}
							$postostart=$postostart+1;
					}
					else
					{
						$postostart=strlen($node->body['und'][0]['safe_value']);
					}
					if($postostart>1)
					{
						$ogDesc = substr($node->body['und'][0]['safe_value'],0 , $postostart	);
					}
					else
					{
						$ogDesc = $node->body['und'][0]['safe_value'];
					}
					if(strlen($node->body['und'][0]['safe_value'])>200)
					{
					$ogDesc.= "...";
					}
	  			?>
	  			<meta property="og:description" content="<?php echo strip_tags(trim($ogDesc)); ?>" />
	  				<?php
	  				}
	  			?>
	  		<meta property="og:type" content="" />
	  		<meta property="og:title" content="<?php echo $node->title?>" />
			<?php
			}
			
		else if ($node->type=='safety')
			{
			$urltoshareimage.="?q=sites/default/files/styles/check_tech_stuff/public/".str_replace("public://","",$node->field_safety_image['und'][0]['uri']);
						
					if($node->body['und'][0]['safe_value']!="")
						{
					if(strlen($node->body['und'][0]['safe_value'])>200)
					{
					$finddottostop=@strpos($node->body['und'][0]['safe_value'],". ",200);
					$findspacetostop=@strpos($node->body['und'][0]['safe_value']," ",200);
						if(intval($finddottostop)<intval($findspacetostop) && intval($finddottostop)>1)
							{
							$postostart=$finddottostop;
							}
						else
							{
							$postostart=$findspacetostop;
							}
							$postostart=$postostart+1;
					}
					else
					{
						$postostart=strlen($node->body['und'][0]['safe_value']);
					}
					if($postostart>1)
					{
						$ogDesc = substr($node->body['und'][0]['safe_value'],0 , $postostart	);
					}
					else
					{
						$ogDesc = $node->body['und'][0]['safe_value'];
					}
					if(strlen($node->body['und'][0]['safe_value'])>200)
					{
					$ogDesc.= "...";
					}
	  			?>
	  			<meta property="og:description" content="<?php echo strip_tags(trim($ogDesc)); ?>" />
	  				<?php
	  				}
	  			?>
	  		<meta property="og:type" content="" />
	  		<meta property="og:title" content="<?php echo $node->title?>" />
			<?php
			}
			else if ($node->type=='safety')
			{
			$urltoshareimage="";
				?>
	  		<meta property="og:description" content="<?php echo strip_tags(trim($ogDesc)); ?>" />
	  		<meta property="og:type" content="<?php echo "glossary";?>" />
	  		<meta property="og:title" content="<?php echo "glossary";?>" />
			<?php
			 }
			else if(strpos($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],'abbreviations')>1)
			{
			$urltoshareimage="";
			?>
	  		<meta property="og:description" content="<?php echo strip_tags(trim($ogDesc)); ?>" />
	  		<meta property="og:type" content="<?php echo "abbreviations";?>" />
	  		<meta property="og:title" content="<?php echo "abbreviations";?>" />
			<?php
			 }
			
			else if(strpos($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],'glossary')>1)
			{
			$urltoshareimage="";
			?>
	  		<meta property="og:description" content="<?php echo strip_tags(trim($ogDesc)); ?>" />
	  		<meta property="og:type" content="<?php echo "glossary";?>" />
	  		<meta property="og:title" content="<?php echo "glossary";?>" />
			<?php
			 }
			?>
	<meta property="og:image" content="<?php echo $urltoshareimage;?>" />
	<meta property="og:url" content="<?php echo 'http://'.$_SERVER['HTTP_HOST'].url("node/".$node->nid);?>" />
	<meta property="og:site_name" content="teamBHP" />
	<meta property="fb:app_id" content="159284707451530" />
	<meta property="fb:admins" content="100000321210958" />
<script type="text/javascript">
	(function ($) {
	$(function(){
		$("#toShareForm").bind("focus click", function(){
		 	if($(this).val()=="Receipient's email")
		 		{
		 			$(this).val('');
		 		}
		 });
		 
		 $("#toShareForm").bind("blur", function(){
		 	if(($(this).val()=="Receipient's email") || ($(this).val()==''))
		 		{
		 			$(this).val("Receipient's email");
		 		}
		 });
		 
		 $("#fromShareForm").bind("focus click", function(){
		 	if($(this).val()=="Your email")
		 		{
		 			$(this).val('');
		 		}
		 });
		 
		 $("#fromShareForm").bind("blur", function(){
		 	if(($(this).val()=="Your email") || ($(this).val()==''))
		 		{
		 			$(this).val("Your email");
		 		}
		 });
	});
	})(jQuery);
</script>
<?php
$fburl='';
$flaglink='';
//print_r($node);
if(strpos($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],'glossary')>1)
	{
$flaglink='glossary';
$fburl='http://'.$_SERVER['HTTP_HOST']."/glossary";
	}
else if(strpos($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],'abbreviations')>1)
	{
$flaglink='abbreviations';
$fburl='http://'.$_SERVER['HTTP_HOST']."/abbreviations";
	}
else if($_GET['q']!='' && $sql_modeldata['type']=='model')
	{
$flaglink='forum-review';
$fburl='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	}
else if(strpos($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],'glossary')==0 && strpos($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],'abbreviations')==0 && $sql_modeldata['type']!='model')
	{
$fburl='http://'.$_SERVER['HTTP_HOST'].url("node/".$node->nid);
	}
$twurl = file_get_contents("http://api.bit.ly/v3/shorten?login=paperplane&apiKey=R_00a59a6b87bfbe0712c58d244812f7f5&longUrl=".$fburl."&format=txt");
?>
<ul class="w180 shareCTA clearfix">
	<li class="print"><a href="javascript:window.print();" class="print" title="Print">Print</a></li>
	<li class="Email"><a href="#" title="Share via Email" class="email" onclick="javascript:document.getElementById('successMsg').style.display='none';document.getElementById('shareForm').style.display='block'">Email</a>
		<div class="shareForm" style="display:none" >
		<div class="shareFormPad">
			<a href="#" class="close closeShareForm">&nbsp;</a>
			<form id="shareForm" name="shareForm" action="#" onsubmit="validate_shareForm(); return false;">
				<div class="marT5">To</div>
				<div><input type="text" id="toShareForm" name="toShareForm" value="Receipient's email" class="medium itl" /></div>
				<div class="shareNote">Seperate multiple addresses with “ ; ”</div> 
				
				<div class="marT20">From</div>
				<div class="marB10"><input type="text" id="fromShareForm" name="fromShareForm" value="Your email" class="medium itl" /></div>
				
				<div class="clearfix">
					<button id="submitShareForm" name="submitShareForm" type="submit" class="saveBtn" value=""></button>
				</div>
	
			</form>
			<div id="successMsg" style="display:none;padding-top:10px;">Your request of emailing is successful.</div>
		</div>	
		</div>
		</li>	
	<li>
	<?php
	if($flaglink=='')
		{
	?>
	<a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode($fburl); ?>&t=<?php echo strtolower($node->title); ?>" class="facebook" title="share on Facebook" target="_blank">&nbsp;</a>
	<?php
		}
		else
		{
			if($flaglink=='glossary')
				{
			?>
			<a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode($fburl); ?>&t=glossary" class="facebook" title="share on Facebook" target="_blank">&nbsp;</a>
			<?php
				}
				else if($flaglink=='abbreviations')
				{
			?>
			<a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode($fburl); ?>&t=abbreviations" class="facebook" title="share on Facebook" target="_blank">&nbsp;</a>
			<?php
				}
				else if($flaglink=='forum-review')
				{
				
			?>
			<a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode($fburl); ?>&t=forum-review" class="facebook" title="share on Facebook" target="_blank">&nbsp;</a>
			<?php
				}
			
		}
	?>
	</li>	
	<!--  <li><fb:like href="<?php //echo urlencode('http://'.$_SERVER['HTTP_HOST'].url("node/".$node->nid));?>" layout="button_count" show_faces="false" width="100" font="lucida grande"></fb:like></li>	-->
	<li class="last">
	<a href="http://twitter.com/share?text=Check out <?php echo $title." at TEAM-BHP"; ?>&url=<?php echo $twurl; ?>" class="twitter" title="share on Twitter" target="_blank">&nbsp;</a></li>	
	
</ul>
		<?php
			if($flaglink=='')
						{
		?>
<input type="hidden" name="current_url" id="current_url" value="<?php echo "http://".$_SERVER['HTTP_HOST'].url("node/".$node->nid);?>">
		<?php
						}
						else
						{
							if($flaglink=='glossary')
								{
?>
<input type="hidden" name="current_url" id="current_url" value="<?php echo "http://".$_SERVER['HTTP_HOST']."/glossary";?>">
<?php
								}
							else if($flaglink=='abbreviations')
								{
?>
<input type="hidden" name="current_url" id="current_url" value="<?php echo "http://".$_SERVER['HTTP_HOST']."/abbreviations";?>">
<?php
								}
							else if($flaglink=='forum-review')
								{
?>
<input type="hidden" name="current_url" id="current_url" value="<?php echo "http://".$_SERVER['HTTP_HOST']."/forum-review";?>">
<?php
								}
						}
		?>
