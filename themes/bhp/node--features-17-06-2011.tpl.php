<?php
//$q="select node.title,field_data_field_features_model.field_features_model_nid from node,field_data_field_features_model where field_data_field_features_model.field_features_model_nid=node.nid and field_data_field_features_model.entity_id=".$node->nid;

echo $q="SELECT field_data_field_nr_make_model.field_nr_make_model_nid  FROM field_data_field_variant_nr_engine,field_data_field_features_nr_variant,field_data_field_nr_make_model where field_data_field_variant_nr_engine.entity_id=field_data_field_features_nr_variant .field_features_nr_variant_nid  and field_data_field_variant_nr_engine.field_variant_nr_engine_nid=field_data_field_nr_make_model.entity_id  and field_data_field_features_nr_variant.entity_id=".$node->nid;
$sql_modeltitle=mysqli_query($q);
$sql_modeldata=mysqli_fetch_array($sql_modeltitle);

$sql_brochure=@mysqli_fetch_array(mysqli_query("select field_data_field_model_brochure.field_model_brochure_fid,file_managed.uri from file_managed,field_data_field_model_brochure where field_data_field_model_brochure.field_model_brochure_fid=file_managed.fid and field_data_field_model_brochure.entity_id=".$sql_modeldata['field_nr_make_model_nid']));

$sql_line_image=@mysqli_fetch_array(mysqli_query("select field_data_field_model_dashboard.field_model_dashboard_fid,file_managed.uri from file_managed,field_data_field_model_dashboard where field_data_field_model_dashboard.field_model_dashboard_fid=file_managed.fid and field_data_field_model_dashboard.entity_id=".$sql_modeldata['field_nr_make_model_nid']));


$sql_engine="SELECT node.title, field_data_field_features_engine.field_features_engine_nid, field_data_field_features_engine.entity_id, field_data_field_features_model.field_features_model_nid
FROM node, field_data_field_features_engine, field_data_field_features_model
WHERE field_data_field_features_model.entity_id = field_data_field_features_engine.entity_id
AND node.nid = field_data_field_features_engine.field_features_engine_nid
AND field_data_field_features_model.field_features_model_nid =".$sql_modeldata['field_nr_make_model_nid'];

$sql_engineforlist="SELECT node.title, field_data_field_features_engine.field_features_engine_nid, field_data_field_features_engine.entity_id, field_data_field_features_model.field_features_model_nid
FROM node, field_data_field_features_engine, field_data_field_features_model
WHERE field_data_field_features_model.entity_id = field_data_field_features_engine.entity_id
AND node.nid = field_data_field_features_engine.field_features_engine_nid
AND field_data_field_features_model.field_features_model_nid =".$sql_modeldata['field_nr_make_model_nid']." group by node.nid";


$sql_variant="SELECT node.title, field_data_field_features_engine.field_features_engine_nid, field_data_field_features_nr_variant.field_features_nr_variant_nid, field_data_field_features_engine.entity_id, field_data_field_features_model.field_features_model_nid
FROM node, field_data_field_features_engine, field_data_field_features_nr_variant, field_data_field_features_model
WHERE field_data_field_features_model.entity_id = field_data_field_features_engine.entity_id
AND field_data_field_features_model.entity_id = field_data_field_features_nr_variant.entity_id
AND node.nid = field_data_field_features_nr_variant.field_features_nr_variant_nid
AND field_data_field_features_model.field_features_model_nid =".$sql_modeldata['field_nr_make_model_nid']." limit 0,4";

$resvariant=@mysqli_query($sql_variant);

$sql_image=@mysqli_fetch_array(mysqli_query("select field_data_field_model_dashboard.field_model_dashboard_fid,field_data_field_model_dashboard.entity_id,file_managed.uri from field_data_field_model_dashboard,file_managed where field_data_field_model_dashboard.field_model_dashboard_fid=file_managed.fid and field_data_field_model_dashboard.entity_id=".$sql_modeldata['field_nr_make_model_nid']));
$f_id=$node->field_features_model['und'][0]['nid'];
?>
<script type="text/javascript">		    
		(function ($) {  $(function(){
			$(".listHolder").hover(
			function(){
					$(this).addClass("hover");
				},
			function(){
					$(this).removeClass("hover");
					}
			);
			
			$(".mv_tab_content li").hover(
			function(){
					$(this).addClass("hover");
				},
			function(){
					$(this).removeClass("hover");
					}
			);
			//Most Viewed tab 				
			$(".most_view li").click(function() {
			$(".most_view li a").removeClass("active"); //Remove any "active" class
			$(this).find("a").addClass("active"); //Remove any "active" class
			$(this).addClass("active"); //Add "active" class to selected tab
			$(".mv_tab_content").hide(); //Hide all tab content
	
			var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
				$(activeTab).fadeIn(); //Fade in the active ID content
				return false;
			});
			$(".gallery_thumb li").click(function(){
    			$(".gallery_thumb li a").removeClass("active");
    			$(this).find("a").addClass("active");
    			$("img#mainPhoto").attr("src", $(this).find("a").attr("href"));
    			$(".lightbox").attr("href", $(this).find("a").attr("href"));
    			return false;
    		});
			$(".lightbox").lightbox();
		});
})(jQuery);
	</script>
<?php
$photos_nid = @mysqli_fetch_array(mysqli_query("select entity_id from field_data_field_gallery_model where field_gallery_model_nid=".$node->field_features_model['und'][0]['nid']));
	if($photos_nid!='')
	{
$photos_alias = @mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$photos_nid['entity_id']."'"));
	}

//$sql_urlforspecification=@mysqli_fetch_array(mysqli_query("select entity_id from field_data_field_news_model where field_news_model_nid=".$node->field_features_model['und'][0]['nid']. " and bundle ='specifications'"));
$sql_urlforspecification=@mysqli_fetch_array(mysqli_query("SELECT field_data_field_spec_nr_engine_type.entity_id FROM field_data_field_spec_nr_engine_type, field_data_field_variant_nr_engine
WHERE field_data_field_variant_nr_engine.field_variant_nr_engine_nid = field_data_field_spec_nr_engine_type.field_spec_nr_engine_type_nid
AND field_data_field_spec_nr_engine_type.field_spec_nr_engine_type_nid =".$node->field_features_nr_variant['und'][0][nid]." limit 1"));


	if($sql_urlforspecification!='')
	{
$sql_urlforspecific=@mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$sql_urlforspecification['entity_id']."'"));
	}

$forum_review_nid = @mysqli_fetch_array(mysqli_query("select entity_id from field_data_field_forum_model where field_forum_model_nid=".$node->field_features_model['und'][0]['nid']));
	if($forum_review_nid!='')
	{
$forum_review_alias = @mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$forum_review_nid['entity_id']."'"));
	}
?>
	<div id="leftColumn" class="clearfix fleft">
	<div class="article">
	<h1 class="padL20 marB10">Reviews</h1>
	<ul class="tab TLR5 clearfix">
		<li><a href="<?php echo url("node/".$node->field_features_model['und'][0]['nid']);?>" class="TLR5" title="Overview">Overview</a></li>
		<?php
			if($photos_alias!='')
			{
		?>
		<li><a href="?q=<?php echo $photos_alias['alias'];?>" class="TLR5" title="Photos">Photos</a></li>
		<?php
			}
			if($sql_urlforspecific!='')
			{
		?>
		<li><a href="?q=<?php echo $sql_urlforspecific['alias'];?>" class="TLR5" title="Specifications">Specifications</a></li>
		<?php
			}
		?>
		<li><a href="<?php echo url("node/".$node->nid);?>" class="TLR5 active" title="Features">Features</a></li>
		<?php
			if($forum_review_alias!='')
			{
		?>
		<li><a href="?q=<?php echo $forum_review_alias['alias'];?>" class="TLR5" title="Forum Reviews">Forum Reviews</a></li>
		<?php
			}
		?>
		<li><a href="#price.php" class="TLR5" title="Price">Price</a></li>																
	</ul>
	
	<div class="Overview marB10">
		<div class="carOverview marB20 BLR5">
			<div class="clearfix marB10">
				<div class="fleft w480">
					<h1><?php echo $node->title;?> <span>Features</span></h1>
				</div>
				<?php include ("themes/bhp/includes/common/share.php") ?>
			</div><!-- clearfix -->
				
			<div class="carSpeci clearfix">
				<div class="specifications">									
					<h4 class="TLR5">Overview of Features</h4>
					<div class="text pad10">
						<p><?php echo $node->field_features['und'][0]['value'];?></p>
					</div>
					<a href="http://www.team-bhp.com/sites/default/files/<?php echo str_replace("public://","",$sql_brochure['uri']);?>" class="btnLeft downloadBtn"><span>Download Brochure</span></a>
				</div><!-- w380 -->
					
				<div class="carWireframe">
					<img src="http://www.team-bhp.com/sites/default/files/<?php echo str_replace("public://","",$sql_image['uri']);?>" width="550" height="230" alt="SKODA Superb"/>
				</div><!-- w490 -->
			
			</div><!-- clearfix -->
		</div><!-- car over view -->
		<div class="engineOptionWrap">
			<div class="TLR5 engineOption">
				<?php
							$res_engine=@mysqli_query($sql_engine);
							$numofrows=@mysqli_num_rows($res_engine);
							$res_e=@mysqli_query($sql_engineforlist);
							if($numofrows>0)
							{
				?>
				<div class="optionPad">
					Currently showing features for:
					<select onchange="show_by_engine(this.value,'<?php echo $node->field_features_model['und'][0]['nid'];?>');">
							<?php
							//$entity_id='';
							while($rowengine=mysqli_fetch_array($res_e))
								{
								//$entity_id.=$rowengine['entity_id'].",";
								?>
						<option value="<?php echo $rowengine['field_features_engine_nid'];?>"><?php echo $rowengine['title'];?></option>
							<?php
								}
								//	echo "Hi Wasim".$entity_id;
							?>
					</select>
				</div>
						<?php
							}
								$res_forlist=@mysqli_query($sql_engineforlist);
								$data_entity=mysqli_fetch_array($res_forlist);
								$eid=$data_entity['field_features_engine_nid'];
								
								$sql_forfirstlist=@mysqli_query("SELECT node.title, field_data_field_features_engine.field_features_engine_nid, field_data_field_features_nr_variant.field_features_nr_variant_nid, field_data_field_features_engine.entity_id,field_data_field_features_model.field_features_model_nid FROM node, field_data_field_features_engine,field_data_field_features_nr_variant, field_data_field_features_model WHERE field_data_field_features_model.entity_id = field_data_field_features_engine.entity_id AND field_data_field_features_model.entity_id = field_data_field_features_nr_variant.entity_id AND node.nid = field_data_field_features_nr_variant.field_features_nr_variant_nid AND field_data_field_features_engine.field_features_engine_nid =".$eid ." and field_data_field_features_model.entity_id=field_data_field_features_engine.entity_id and field_data_field_features_model.field_features_model_nid=".$node->field_features_model['und'][0]['nid']);
	
								while($data_entity=@mysqli_fetch_array($sql_forfirstlist))
									{
									$entity_id.=$data_entity['entity_id'].",";
									}
									
								
							?>
			</div>
		</div>
		<?php
		if($numofrows>0)
					{
		?>
		<div class="reviewbar BLR5 clearfix"><!-- car Review -->
		<div id="ajax">
			<div class="tableHeadWrap">
				<div id="tableHead">
					<table class="speciTable">
							<thead>
								<tr>
									<?php
									$qry_var=mysqli_query("select field_data_field_features_nr_variant.field_features_nr_variant_nid,node.title from node,field_data_field_features_nr_variant where field_data_field_features_nr_variant.field_features_nr_variant_nid=node.nid and field_data_field_features_nr_variant.entity_id in (".substr($entity_id,0,-1).")");
								$numberofvaraint=mysqli_num_rows($qry_var);
									if(mysqli_num_rows($resvariant)>1)
											{
									?>
									<th>&nbsp;</th>
									<?php
											}
										if(mysqli_num_rows($resvariant)>0)
											{
											//$entity_id='';
											
											while($row_variant=mysqli_fetch_array($qry_var))
												{
											//	echo $row_variant['entity_id'];
												//$entity_id.=$row_variant['entity_id'].",";
									?>
									<th class="aCenter"><?php echo $row_variant['title'];?></th>
									<?php
												}
											}
									?>
									<!--  <th class="aCenter">Lxi</th>
									<th class="aCenter">Vxi</th>
									<th class="aCenter">Zxi</th>-->
									</tr>	
							</thead>
						</table>
					</div>
			</div>
			
			<table class="speciTable">
				<thead>
					<tr>
						<th colspan="5">SAFETY</th>
					</tr>	
				</thead>
				<tr>
					<td>Airbags</td>
							<?php
						//for($i=0;$i<$numberofvaraint;$i++)
							//{
						$sql_airbag=@mysqli_query("select field_features_air_bags_value,entity_id from field_data_field_features_air_bags where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_ab=mysqli_fetch_array($sql_airbag))
									{
									//print_r($d_ab);
									//echo $d_ab['entity_id'];
									
										if($d_ab['field_features_air_bags_value']==0)
										{
							?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_ab['field_features_air_bags_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--  <td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>ABS</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
							//{
							$sql_abs=@mysqli_query("select field_features_abs_value from field_data_field_features_abs where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_abs=mysqli_fetch_array($sql_abs))
									{
									//echo $d_abs['field_features_abs_value'];
									if($d_abs['field_features_abs_value']==0)
										{
						?>
						<td>&nbsp;</td>
						<?php
										}
										else if($d_abs['field_features_abs_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!-- <td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
					
				<tr>
					<td>Traction control</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
							//{
							$sql_tcontrol=@mysqli_query("select field_features_traction_value from field_data_field_features_traction where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_tcontrol=mysqli_fetch_array($sql_tcontrol))
									{
										if($d_tcontrol['field_features_traction_value']==0)
										{
						?>
						<td>&nbsp;</td>
						<?php
										}
										else if($d_tcontrol['field_features_traction_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--  <td><div class="tickMarkIcon">&nbsp;</div></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>-->
				</tr>
				<tr>
					<td>ESC / ESP</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
							//{
							$sql_esc=@mysqli_query("select field_features_esc_value from field_data_field_features_esc where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_esc=mysqli_fetch_array($sql_esc))
									{
										if($d_esc['field_features_esc_value']==0)
										{
						?>
						<td>&nbsp;</td>
						<?php
										}
										else if($d_esc['field_features_esc_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--  <td><div class="tickMarkIcon">&nbsp;</div></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>-->
				</tr>
				<tr>
					<td>Fog lights</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
						//	{
							$sql_flight=@mysqli_query("select field_features_fog_value from field_data_field_features_fog where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_flight=mysqli_fetch_array($sql_flight))
									{
										if($d_flight['field_features_fog_value']==0)
										{
						?>
						<td>&nbsp;</td>
									<?php
										}
										else if($d_flight['field_features_fog_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--  <td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td>&nbsp;</td>-->
				</tr>
				<tr>
					<td>Rear wash / wipe</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
						//	{
							$sql_rear=@mysqli_query("select field_features_wipe_value from field_data_field_features_wipe where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_rear=@mysqli_fetch_array($sql_rear))
									{
										if($d_rear['field_features_wipe_value']==0)
										{
						?>
										<td>&nbsp;</td>
										<?php
										}
										else if($d_rear['field_features_wipe_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--  <td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Engine immobiliser</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
						//	{
							$sql_ei=@mysqli_query("select field_features_immobiliser_value from field_data_field_features_immobiliser where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_ei=mysqli_fetch_array($sql_ei))
									{
										if($d_ei['field_features_immobiliser_value']==0)
										{
						?>
						<td>&nbsp;</td>
									<?php
										}
										else if($d_ei['field_features_immobiliser_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--  <td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Alloy wheels</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
							//{
							$sql_aw=@mysqli_query("select field_features_alloy_value from field_data_field_features_alloy where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_aw=@mysqli_fetch_array($sql_aw))
									{
										if($d_aw['field_features_alloy_value']==0)
										{
						?>
						<td>&nbsp;</td>
									<?php
										}
										else if($d_aw['field_features_alloy_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--  <td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
			</table><!-- speciTable -->
			
			<table class="speciTable">
				<thead>
					<tr>
						<th colspan="5">DRIVER ENHANCEMENTS</th>
					</tr>	
				</thead>
				<tr>
					<td>Power steering</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
						//	{
							$sql_ps=@mysqli_query("select field_features_power_steering_value from field_data_field_features_power_steering where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_ps=mysqli_fetch_array($sql_ps))
									{
										if($d_ps['field_features_power_steering_value']==0)
										{
						?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_ps['field_features_power_steering_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--  <td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Steering - Tilt adjustment</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
							//{
							$sql_sta=@mysqli_query("select field_features_steering_tilt_value from field_data_field_features_steering_tilt where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_sta=mysqli_fetch_array($sql_sta))
									{
										if($d_sta['field_features_steering_tilt_value']==0)
										{
						?>
										<td>&nbsp;</td>
									<?php
										}
										else if($d_sta['field_features_steering_tilt_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--  <td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Steering - Reach adjustment</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
						//	{
							$sql_sra=@mysqli_query("select field_features_steering_reach_value from field_data_field_features_steering_reach where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_sra=mysqli_fetch_array($sql_sra))
									{
										if($d_sra['field_features_steering_reach_value']==0)
										{
							?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_sra['field_features_steering_reach_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--  <td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Height adjustable driver seat</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
							//{
							$sql_hads=@mysqli_query("select field_features_height_value from field_data_field_features_height where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_hads=mysqli_fetch_array($sql_hads))
									{
										if($d_hads['field_features_height_value']==0)
										{
						?>
										<td>&nbsp;</td>
									<?php
										}
										else if($d_hads['field_features_height_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--<td class="aCenter">Optional</td>
					<td class="aCenter">Optional</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Adjustable lumbar support</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
						//	{
							$sql_als=@mysqli_query("select field_features_lumbar_value from field_data_field_features_lumbar where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_als=mysqli_fetch_array($sql_als))
									{
										if($d_als['field_features_lumbar_value']==0)
										{
						?>
						<td>&nbsp;</td>
									<?php
										}
										else if($d_als['field_features_lumbar_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Dead pedal</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
							//{
							$sql_deadpedal=@mysqli_query("select field_features_dead_pedal_value from field_data_field_features_dead_pedal where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_deadpedal=@mysqli_fetch_array($sql_deadpedal))
									{
									
										if($d_deadpedal['field_features_dead_pedal_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_deadpedal['field_features_dead_pedal_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--<td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Center armrest</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
						//	{
							$sql_centerarm=@mysqli_query("select field_features_armrest_value from field_data_field_features_armrest where entity_id in (".substr($entity_id,0,-1).") ");
								while($d_centerarm=mysqli_fetch_array($sql_centerarm))
									{
										if($d_centerarm['field_features_armrest_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_centerarm['field_features_armrest_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Electric mirrors</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
							//{
							$sql_electricmirror=@mysqli_query("select field_features_mirrors_value from field_data_field_features_mirrors  where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_electricmirror=mysqli_fetch_array($sql_electricmirror))
									{
										if($d_electricmirror['field_features_mirrors_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_electricmirror['field_features_mirrors_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }						
							//}
						?>
					<!--<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Multi-information display</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
							//{
							$sql_multiinfo=@mysqli_query("select field_features_info_display_value from field_data_field_features_info_display  where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_multiinfo=mysqli_fetch_array($sql_multiinfo))
									{
										if($d_multiinfo['field_features_info_display_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_multiinfo['field_features_info_display_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--<td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Parking sensors</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
						//	{
							$sql_parkingsensor=@mysqli_query("select field_features_sensors_value from field_data_field_features_sensors  where entity_id in (".substr($entity_id,0,-1).") ");
								while($d_parkingsensor=mysqli_fetch_array($sql_parkingsensor))
									{
										if($d_parkingsensor['field_features_sensors_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_parkingsensor['field_features_sensors_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }							
							// }
						?>
					<!--<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Automatic gearbox</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
						//	{
							$sql_autogear=@mysqli_query("select field_features_gear_box_value from field_data_field_features_gear_box  where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_autogear=mysqli_fetch_array($sql_autogear))
									{
										if($d_autogear['field_features_gear_box_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_autogear['field_features_gear_box_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
			</table><!-- speciTable -->
			
			<table class="speciTable">
				<thead>
					<tr>
						<th colspan="5">CONVENIENCE</th>
					</tr>	
				</thead>
				<tr>
					<td>Remote locking</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
							//{
							$sql_rlocking=@mysqli_query("select field_features_remote_value from field_data_field_features_remote  where entity_id in (".substr($entity_id,0,-1).")  order by entity_id");
								while($d_rlocking=mysqli_fetch_array($sql_rlocking))
									{
										if($d_rlocking['field_features_remote_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_rlocking['field_features_remote_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Central locking</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
							//{
							$sql_centerlocking=@mysqli_query("select field_features_central_value from field_data_field_features_central where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_centerlocking=mysqli_fetch_array($sql_centerlocking))
									{
										if($d_centerlocking['field_features_central_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_centerlocking['field_features_central_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Power windows</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
						//	{
							$sql_powerwindow=@mysqli_query("select field_features_window_value from field_data_field_features_window where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_powerwindow=mysqli_fetch_array($sql_powerwindow))
									{
										if($d_powerwindow['field_features_window_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_powerwindow['field_features_window_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Air-conditioner</td>
						<?php
						//for($i=0;$i<$numberofvaraint;$i++)
							//{
							$sql_airconditionar=@mysqli_query("select field_features_air_conditioner_value from field_data_field_features_air_conditioner where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_airconditionar=mysqli_fetch_array($sql_airconditionar))
									{
										if($d_airconditionar['field_features_air_conditioner_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_airconditionar['field_features_air_conditioner_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Climate control</td>
						<?php
						/*for($i=0;$i<$numberofvaraint;$i++)
							{*/
							$sql_climatecontrol=@mysqli_query("select field_features_climate_value from field_data_field_features_climate where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_climatecontrol=mysqli_fetch_array($sql_climatecontrol))
									{
										if($d_climatecontrol['field_features_climate_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_climatecontrol['field_features_climate_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							  //}
						?>
					<!--<td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Rear air-con vents</td>
						<?php
						/*for($i=0;$i<$numberofvaraint;$i++)
							{*/
							$sql_rearaicon=@mysqli_query("select field_features_vents_value from field_data_field_features_vents where entity_id in (".substr($entity_id,0,-1).")  order by entity_id");
								while($d_rearaicon=mysqli_fetch_array($sql_rearaicon))
									{
										if($d_rearaicon['field_features_vents_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_rearaicon['field_features_vents_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--<td>&nbsp;</td>
					<td class="aCenter">Optional</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Leather seats</td>
						<?php
					/*	for($i=0;$i<$numberofvaraint;$i++)
							{*/
							$sql_leather=@mysqli_query("select field_features_seats_value from field_data_field_features_seats where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_leather=mysqli_fetch_array($sql_leather))
									{
										if($d_leather['field_features_seats_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_leather['field_features_seats_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Sunroof</td>
						<?php
						/*for($i=0;$i<$numberofvaraint;$i++)
							{*/
							$sql_sunroof=@mysqli_query("select field_features_sun_roof_value from field_data_field_features_sun_roof where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_sunroof=mysqli_fetch_array($sql_sunroof))
									{
										if($d_sunroof['field_features_sun_roof_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_sunroof['field_features_sun_roof_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
								//}
						?>
					<!--<td>&nbsp;</td>
					<td class="aCenter">Optional</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Fold-down rear seat</td>
						<?php
						/*for($i=0;$i<$numberofvaraint;$i++)
							{*/
							$sql_fdown=@mysqli_query("select field_features_fold_value from field_data_field_features_fold where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_fdown=mysqli_fetch_array($sql_fdown))
									{
										if($d_fdown['field_features_fold_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_fdown['field_features_fold_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Split rear seats</td>
						<?php
						/*for($i=0;$i<$numberofvaraint;$i++)
							{*/
							$sql_sp_rear=@mysqli_query("select field_features_split_value from field_data_field_features_split where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_sp_rear=mysqli_fetch_array($sql_sp_rear))
									{
										if($d_sp_rear['field_features_split_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_sp_rear['field_features_split_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
			</table><!-- speciTable -->
			
			<table class="speciTable">
				<thead>
					<tr>
						<th colspan="5">Entertainment</th>
					</tr>	
				</thead>
				<tr>
					<td>Number of speakers</td>
						<?php
						/*for($i=0;$i<$numberofvaraint;$i++)
							{*/
							$sql_nofspeaker=@mysqli_query("select field_features_speaker_value from field_data_field_features_speaker where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_nofspeaker=mysqli_fetch_array($sql_nofspeaker))
									{
										if($d_nofspeaker['field_features_speaker_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_nofspeaker['field_features_speaker_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--<td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->	
				</tr>
				<tr>
					<td>CD Player</td>
						<?php
						/*for($i=0;$i<$numberofvaraint;$i++)
							{*/
							$sql_cdplayer=@mysqli_query("select field_features_cd_value from field_data_field_features_cd where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_cdplayer=mysqli_fetch_array($sql_cdplayer))
									{
										if($d_cdplayer['field_features_cd_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_cdplayer['field_features_cd_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--<td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>AUX input</td>
						<?php
						/*for($i=0;$i<$numberofvaraint;$i++)
							{*/
							$sql_auxinput=@mysqli_query("select field_features_aux_value from field_data_field_features_aux where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_auxinput=mysqli_fetch_array($sql_auxinput))
									{
										if($d_auxinput['field_features_aux_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_auxinput['field_features_aux_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--<td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>USB input</td>
						<?php
						/*for($i=0;$i<$numberofvaraint;$i++)
							{*/
							$sql_usbinput=@mysqli_query("select field_features_usb_value from field_data_field_features_usb where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_usbinput=mysqli_fetch_array($sql_usbinput))
									{
										if($d_usbinput['field_features_usb_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_usbinput['field_features_usb_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
								 //}
						?>
					<!--<td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Bluetooth connectivity</td>
						<?php
						/*for($i=0;$i<$numberofvaraint;$i++)
							{*/
							$sql_btooth=@mysqli_query("select field_features_bluetooth_value from field_data_field_features_bluetooth where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_btooth=mysqli_fetch_array($sql_btooth))
									{
										if($d_btooth['field_features_bluetooth_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_btooth['field_features_bluetooth_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
				<!--  <td>&nbsp;</td>
					<td class="aCenter">Optional</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<tr>
					<td>Steering-mounted controls</td>
						<?php
						/*for($i=0;$i<$numberofvaraint;$i++)
							{*/
							$sql_smc=@mysqli_query("select field_features_steering_value from field_data_field_features_steering where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_smc=mysqli_fetch_array($sql_smc))
									{
								if($d_smc['field_features_steering_value']==0)
										{
										?>
									<td>&nbsp;</td>
									<?php
										}
										else if($d_smc['field_features_steering_value']==2)
										{
										?>
										<td class="aCenter">Optional</td>
										<?php
										}
										else
										{
									?>
									<td><div class="tickMarkIcon">&nbsp;</div></td>
									<?php	
										}
								   }
							//}
						?>
					<!--  <td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
			</table><!-- speciTable -->
			</div>
		</div><!-- car review -->
		<?php
			}
		?>
	</div><!-- overviewContainer -->
	
	<div class="clearfix articleNavi">
		<a class="fleft btnLeft" href="#">
			<span>Back to Index</span>
		</a>
	</div>
			<?php 
			$sql_model=@mysqli_query("SELECT node.title,node.nid, file_managed.uri,field_data_field_nr_make.field_nr_make_nid,field_data_field_model_dashboard.field_model_dashboard_fid
FROM node,file_managed,field_data_field_nr_make,field_data_field_model_dashboard
WHERE field_data_field_model_dashboard.field_model_dashboard_fid = file_managed.fid
AND field_data_field_model_dashboard.entity_id = node.nid
AND node.status =1 AND field_data_field_nr_make.entity_id=field_data_field_model_dashboard.entity_id and node.nid=".$node->field_features_model['und'][0]['nid']." order by node.changed desc");
$numberofrows=@mysqli_num_rows($sql_model);
							if($numberofrows>0)
									{
							?>
						<div class="marB10 BLR5 reviewCompare" style="display:block">
						<ul class="clearfix">
							<?php
							$counter=1;
							while($data_model=mysqli_fetch_array($sql_model))
							{
							$counter++;
							?>
							<li class="clearfix <?php //if($counter>$numberofrows){?><?php //last}?>" style="display:<?php if($counter==2){?>block<?php } else {?>none<?php }?>">
								<div class="contentOpt">
								<select class="marB5 w150">
									<option selected="selected">Select Make</option>
									<option>Honda</option>
								</select>
								<select class="w150">
									<option selected="selected">Select Model</option>
									<option class="flip">Accord</option>
								</select>
								</div>
								<div class="content firstContent clearfix"  style="display:<?php if($counter==2){?>block<?php } else {?>none<?php }?>">
									<div class="img"><img src="http://www.team-bhp.com/sites/default/files/<?php echo str_replace("public://","",$data_model['uri']);?>" alt="car" width="61" height="48" /></div>
									<p class="desc">
										<span class="title"><?php echo $data_model['title'];?></span>
										<span class="price">6.5 - 9.2 Lakh</span>
									</p>
									<span class="iconRemove">&nbsp;</span>
								</div>
							</li>
							<?php
							}
							?>
								<li>
									<p class="clearfix">
									<a class="btnRight fright" id="compare">
										<span>Compare</span>
									</a>
									</p>
								</li>
							
							</ul><!-- clearfix -->
						</div><!-- reviewCompare -->
					<?php 
											}
									$sql_modelalternative=@mysqli_query("SELECT node.title,node.nid,field_data_field_model_alternatives.field_model_alternatives_nid from node,field_data_field_model_alternatives WHERE field_data_field_model_alternatives.field_model_alternatives_nid = node.nid AND node.status =1  and field_data_field_model_alternatives.entity_id =".$node->field_features_model['und'][0]['nid']." order by node.changed desc");
									$numberofrowsforalternative=@mysqli_num_rows($sql_modelalternative);
										if($numberofrowsforalternative>0)
										{
										?>
										<div class="reviewAlt clearfix roundAll5">
										<h3 class="marB10">Alternatives
											<span>Move your mouse over a car name to view the <strong>review</strong> or <strong>compare</strong> buttons</span>
										</h3>
										<div>
											<ul>
												<?php
													$counter=1;
													while($data_model=@mysqli_fetch_array($sql_modelalternative))
														{
												?>
													<li>
													<p><?php echo $data_model['title'];?></p>
													<div class="ReviewBtns">
														<a href="<?php echo url("node/".$data_model['nid'])?>"><img width="47" height="12" alt="<?php echo $data_model['title'];?>" src="/themes/bhp/images/buttons/review.png" /></a>
														<a href="#compare.php" class="add"><img width="57" height="12" alt="Compare" src="/themes/bhp/images/buttons/compare.png" /></a>
													</div>
													</li>
													<?php
														
														}
													?>
										
											</ul>
										</div><!-- mar T20 -->
										</div>
										<?php
										}
										?>
	
	<?php //include ("../themes/bhp/includes/compare.php") ?>
	
	<?php //include ("../themes/bhp/includes/reviews-alternatives.php") ?>
			
</div><!-- articles -->
</div><!-- Left Column -->
	
	

	
	
