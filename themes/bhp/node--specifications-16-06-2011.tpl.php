<?php
$sql_model=@mysqli_query("SELECT * FROM `field_data_field_nr_make_model`,node WHERE field_data_field_nr_make_model.entity_id = node.nid AND node.status =1 and field_data_field_nr_make_model.entity_id=".$node->field_spec_nr_engine_type['und'][0]['nid']);

$num=@mysqli_num_rows($sql_model);
	if($num>0)
		{
		$mid='';
		$model_id=mysqli_fetch_array($sql_model);
			$sql_m=mysqli_query("select entity_id from field_data_field_nr_make_model,node where field_data_field_nr_make_model.field_nr_make_model_nid = node.nid and node.status=1 and field_data_field_nr_make_model.field_nr_make_model_nid=".$model_id['field_nr_make_model_nid']);
		while($d_m=mysqli_fetch_array($sql_m))
			{
			$mid.=$d_m['entity_id'].", ";
			}
		
		}
		//echo $mid;
$make_res = @mysqli_fetch_array(mysqli_query("select node.title,field_data_field_nr_make.field_nr_make_nid from node,field_data_field_nr_make where field_data_field_nr_make.entity_id =".$model_id['field_nr_make_model_nid']." and node.nid=field_data_field_nr_make.field_nr_make_nid"));
$d=@mysqli_fetch_array($sql_model);
$model_title=@mysqli_fetch_array(mysqli_query("select title from node where nid=".$model_id['field_nr_make_model_nid']));

$sql_brochure=@mysqli_fetch_array(mysqli_query("select field_data_field_model_brochure.field_model_brochure_fid,file_managed.uri from file_managed,field_data_field_model_brochure where field_data_field_model_brochure.field_model_brochure_fid=file_managed.fid and field_data_field_model_brochure.entity_id=".$model_id['field_nr_make_model_nid']));

$sql_line_image=@mysqli_fetch_array(mysqli_query("select field_data_field_model_line.field_model_line_fid,file_managed.uri from file_managed,field_data_field_model_line where field_data_field_model_line.field_model_line_fid=file_managed.fid and field_data_field_model_line.entity_id=".$model_id['field_nr_make_model_nid']));

//$sql_engine=@mysqli_query("select node.title,field_data_field_nr_make_model.entity_id,field_data_field_nr_make_model.field_nr_make_model_nid from node,field_data_field_nr_make_model where field_data_field_nr_make_model.entity_id=node.nid and field_data_field_nr_make_model.field_nr_make_model_nid=".$node->field_news_model['und'][0]['nid']);

$sql_engine=@mysqli_query("select node.title,field_data_field_nr_make_model.entity_id,field_data_field_nr_make_model.field_nr_make_model_nid from node,field_data_field_nr_make_model where field_data_field_nr_make_model.entity_id=node.nid and node.status=1 and field_data_field_nr_make_model.entity_id in (".substr($mid,0,-2).") group by field_data_field_nr_make_model.entity_id");
$nofmodel=mysqli_num_rows($sql_engine);

 $q_mwithe="select field_spec_nr_engine_type_nid,entity_id from field_data_field_spec_nr_engine_type where field_spec_nr_engine_type_nid in (".substr($mid,0,-2)." ) and bundle='specifications' group by field_spec_nr_engine_type_nid";
$sql_modelwithengine=@mysqli_query($q_mwithe);
$entyti_id='';
	while($data_eid=@mysqli_fetch_array($sql_modelwithengine))
			{
			$entyti_id.=$data_eid['entity_id'].",";
			}
		//echo $entyti_id;
		
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
function to_lakh($no)
{
if(intval($no)>=100000)
	{
		$res = (intval($no)/100000);
		if(strpos($res, '.')>0)
		{
			$res = round($res, 1);
		}
		return $res;
	}
else
	{
		return 0;
	}
}
$sql_urlforfoto=@mysqli_fetch_array(mysqli_query("select entity_id from field_data_field_gallery_model where field_gallery_model_nid=".$model_id['field_nr_make_model_nid']));
	if($sql_urlforfoto!='')
		{
$sql_aliasforphotos=@mysqli_fetch_array(mysqli_query("SELECT * FROM url_alias WHERE `source` = 'node/".$sql_urlforfoto['entity_id']."'"));
		}

//$sql_urlforfeature=@mysqli_fetch_array(mysqli_query("select entity_id from field_data_field_features_model where field_features_model_nid=".$model_id['field_nr_make_model_nid']));

$sql_urlforfeature=@mysqli_fetch_array(mysqli_query("SELECT field_data_field_features_nr_variant.entity_id FROM field_data_field_variant_nr_engine, field_data_field_features_nr_variant WHERE field_data_field_features_nr_variant.field_features_nr_variant_nid = field_data_field_variant_nr_engine.entity_id AND field_data_field_variant_nr_engine.field_variant_nr_engine_nid =".$node->field_spec_nr_engine_type['und'][0][nid]." limit 1"));

if($sql_urlforfeature!='')
		{
$sql_urlforfeaturedata=@mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$sql_urlforfeature['entity_id']."'"));
		}

$forum_review_nid = @mysqli_fetch_array(mysqli_query("select entity_id from field_data_field_forum_model where field_forum_model_nid=".$model_id['field_nr_make_model_nid']));
		if($forum_review_nid!='')
		{
$forum_review_alias = @mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$forum_review_nid['entity_id']."'"));
		}
		
		$sql_urlforprice=@mysqli_fetch_array(mysqli_query("select field_data_field_price_nr_variant.entity_id from field_data_field_nr_make_model, field_data_field_variant_nr_engine, field_data_field_price_nr_variant where field_data_field_nr_make_model.field_nr_make_model_nid=".$model_id['field_nr_make_model_nid']." and field_data_field_nr_make_model.entity_id=field_data_field_variant_nr_engine.field_variant_nr_engine_nid and field_data_field_variant_nr_engine.entity_id=field_data_field_price_nr_variant.field_price_nr_variant_nid"));
		if($sql_urlforprice!='')
		{
$sql_urlforpricedata=@mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$sql_urlforprice['entity_id']."'"));
		}
?>	
	<div id="leftColumn" class="clearfix fleft">
	<div class="article">
		<h1 class="padL20 marB10">Reviews</h1>
		<ul class="tab TLR5 clearfix">
			<li><a href="<?php echo url("node/".$model_id['field_nr_make_model_nid']);?>" class="TLR5" title="Overview">Overview</a></li>
			<?php
			if($sql_aliasforphotos!='')
				{
			?>
			<li><a href="?q=<?php echo $sql_aliasforphotos['alias'];?>" class="TLR5" title="Photos">Photos</a></li>
			<?php
				}
			?>
			<li><a href="<?php echo url("node/".$node->nid);?>" class="TLR5 active" title="Specifications">Specifications</a></li>
			<?php
			if($sql_urlforfeaturedata!='')
				{
			?>
			<li><a href="?q=<?php echo $sql_urlforfeaturedata['alias'];?>" class="TLR5" title="Features">Features</a></li>
			<?php
				}
				if($forum_review_alias!='')
				{
			?>
			<li><a href="?q=<?php echo $forum_review_alias['alias'];?>" class="TLR5" title="Forum Reviews">Forum Reviews</a></li>
			<?php
				}
				if($sql_urlforpricedata!='')
				{
			?>
			<li><a href="?q=<?php echo $sql_urlforpricedata['alias'];?>" class="TLR5" title="Price">Price</a></li>		
			<?php
				}
			?>														
		</ul>
		
		<div class="Overview marB10">
			<div class="carOverview marB20 BLR5">
				<div class="clearfix marB10">
					<div class="fleft w480">
						<h1><?php echo $make_res['title']." ".$model_title['title'];?> <span>Specifications</span></h1>
					</div>
					<?php include ("themes/bhp/includes/common/share.php") ?>
				</div><!-- clearfix -->
					
				<div class="carSpeci clearfix">
					<?php
					if($num>0)
						{
					?>
					<div class="specifications">									
						<h4 class="TLR5">Available with</h4>
						<div class="text">
							<ul>
							<?php
							//$sql_modelengine=@mysqli_query("select field_spec_nr_engine_type_nid from field_data_field_spec_nr_engine_type where entity_id in(".substr($entyti_id,0,-1).") and bundle ='specifications'");
							$sql_modelengine=@mysqli_query("select node.title,field_data_field_nr_make_model.entity_id,field_data_field_nr_make_model.field_nr_make_model_nid from node,field_data_field_nr_make_model where field_data_field_nr_make_model.entity_id=node.nid and node.status=1 and field_data_field_nr_make_model.entity_id in (".substr($mid,0,-2).") group by field_data_field_nr_make_model.entity_id");
							while($engine_data=@mysqli_fetch_array($sql_modelengine))
								{
								//$engine_title=mysqli_fetch_array(mysqli_query("select title from node where nid=".$engine_data['field_spec_nr_engine_type_nid']));
							?>
								<li><?php echo $engine_data['title'];?></li>
							<?php
								}
							?>
								<!--  <li>1.4L Petrol Automatic & Manual</li>
								<li>1.4L Petrol V6 Automatic</li>
								<li>1.8L Diesel Automatic AWD</li>-->
							</ul>
						</div>
						<?php
						if($sql_brochure!='')
							{
						?>
						<a href="http://www.team-bhp.com/sites/default/files/<?php echo str_replace("public://","",$sql_brochure['uri']);?>" class="btnLeft downloadBtn"><span>Download Brochure</span></a>
							<?php
							}
							?>
					</div><!-- w380 -->
						<?php
						}
						?>
					<div class="carWireframe">
						<img src="http://www.team-bhp.com/sites/default/files/<?php echo str_replace("public://","",$sql_line_image['uri']);?>" width="480" height="220" alt="SKODA Superb"/>
					</div><!-- w490 -->
				
				</div><!-- clearfix -->
			</div><!-- car over view -->
			<div class="reviewbar roundAll5 clearfix"><!-- car Review -->
				<?php
				if($mid!='')
					{
				?>
				<div class="tableHeadWrap">
					<table id="tableHead" class="speciTable">
						<thead>
							<tr>
								<th>&nbsp;</th>
								<?php
								
								$qry_engine=@mysqli_query("select node.title,field_data_field_nr_make_model.entity_id,field_data_field_nr_make_model.field_nr_make_model_nid from node,field_data_field_nr_make_model where field_data_field_nr_make_model.entity_id=node.nid and node.status=1 and field_data_field_nr_make_model.entity_id in (".substr($mid,0,-2).") group by field_data_field_nr_make_model.entity_id");
								while($data_engine=mysqli_fetch_array($qry_engine))
									{
									//echo $data_engine['entity_id'];
									//$engine_title=mysqli_fetch_array(mysqli_query("select title from node where nid=".$data_engine['field_spec_nr_engine_type_nid']));
								?>
								<th><?php echo $data_engine['title']?></th>
								<?php
									}
								?>
								<!--  <th>1.4L Petrol</th>
								<th>1.6L Diesel</th>
								<th>1.8L Diesel</th>-->
							</tr>	
						</thead>
					</table>
				</div>	
				<?php
					}
					
					
					//$sql_spec_wheel=@mysqli_query("select field_spec_length_value from field_data_field_spec_length where entity_id =".$node->nid);
					//$numofspeclwheel=@mysqli_num_rows($sql_spec_wheel);
					 $q="SELECT field_spec_nr_engine_type_nid, entity_id FROM field_data_field_spec_nr_engine_type, node WHERE field_spec_nr_engine_type_nid in (".substr($mid,0,-2).") AND field_data_field_spec_nr_engine_type.bundle = 'specifications' AND field_data_field_spec_nr_engine_type.entity_id = node.nid AND node.status =1 limit 0,4";
				$e=@mysqli_query($q);
				$n=mysqli_num_rows($e);
				if($n>0)
					{
					$colspan=4;
				?>
				<table class="speciTable<?php if($nofmodel==1){?> flexColum<?php }  else if($nofmodel==2){?> flexColum flexColum2<?php } else if($nofmodel==3){?> flexColum flexColum3<?php } else if($nofmodel==4){?> flexColum flexColum4<?php } ?>">
					<thead>
						<tr>
							<th colspan="5">DIMENSIONS</th>
						</tr>	
					</thead>
						
					<tr>
						<td>Length   X   Width   X   Height</td>
							<?php
							//$dimens=@mysqli_query($q);
							//while($d_spc_length=@mysqli_fetch_array($dimens))
								//{
							$res_lwh=mysqli_query("select DISTINCT(field_spec_length_value) from field_data_field_spec_length  where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							$nolwh=mysqli_num_rows($res_lwh);
							while($dimensionvalvalue=mysqli_fetch_array($res_lwh))
								{		
						?>
						<td  class="aCenter"<?php  if($nolwh==1){?> colspan="<?php echo $nofmodel?>"<?php }?>><?php echo $dimensionvalvalue['field_spec_length_value']." mm";?></td>
							<?php
								}
						?>
					</tr>
						
					<tr>
						<td>Wheelbase</td>
						<?php
							//$Wheelbase=@mysqli_query($q);
							//while($Wheelbase_data=mysqli_fetch_array($Wheelbase))
							//{
							$res_wb=mysqli_query("select DISTINCT(field_spec_wheel_value) from field_data_field_spec_wheel  where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							$nofwb=mysqli_num_rows($res_wb);
							while($wbvalue=mysqli_fetch_array($res_wb))
								{
						?>
						<td class="aCenter" <?php if($nofwb==1){?> colspan="<?php echo $nofmodel?>"<?php }?>><?php echo $wbvalue['field_spec_wheel_value']." mm";?></td>
							<?php
								}
							?>
					</tr>
					<tr>
						<td>Track : Front / Rear</td>
							<?php
							//$track_frontrear=@mysqli_query($q);
							//while($frontrear_data=mysqli_fetch_array($track_frontrear))
							//{
							$res_tfr=@mysqli_query("select DISTINCT(field_spec_track_value) from field_data_field_spec_track  where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							$numb_tfr=mysqli_num_rows($res_tfr);
							while($frvalue=@mysqli_fetch_array($res_tfr))
								{
						?>
						<td class="aCenter"<?php if($numb_tfr==1){?> colspan="<?php echo $nofmodel?>"<?php }?>><?php echo $frvalue['field_spec_track_value']." mm";?></td>
							<?php
								}
							//}
							?>
					</tr>
					<tr>
						<td>Kerb weight</td>
							<?php
							/*$kerb_wight=@mysqli_query($q);
							while($kerb_wight_data=mysqli_fetch_array($kerb_wight))
							{*/
						$res_kw=mysqli_query("select DISTINCT(field_spec_kerb_value),entity_id from field_data_field_spec_kerb where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							$nofkw=mysqli_num_rows($res_kw);
							while($kwvalue=mysqli_fetch_array($res_kw))
								{
								$Kerb_wightinfo=mysqli_fetch_array(mysqli_query("select field_kerb_info_value from field_data_field_kerb_info where entity_id =".$kwvalue['entity_id']));
							?>
						<td class="aCenter"<?php if($nofkw==1){?> colspan="<?php echo $nofmodel?>"<?php }?>><?php echo $kwvalue['field_spec_kerb_value']." kgs";?>
						<?php
							if($Kerb_wightinfo!='')
								{
						?>
						<a href="#" class="infoIcon" style="z-index:40">&nbsp;
								<div class="infoBox">
									<?php echo $Kerb_wightinfo['field_kerb_info_value'];?>
								</div>
								
						</a>
							<?php
								}
							?>
						</td>
						<?php
								}
							//}
						?>
						<!--  <td>890</td>
						<td>924</td>
						<td>980</td>-->
					</tr>
					<tr>
						<td>Ground Clearance</td>
							<?php
							/*$g_c=@mysqli_query($q);
							while($g_c_data=mysqli_fetch_array($g_c))
							{*/
							//$res_gc=@mysqli_query("select field_spec_ground_value from field_data_field_spec_ground where entity_id=".$g_c_data['entity_id']);
							$res_gc=@mysqli_query("select DISTINCT(field_spec_ground_value),entity_id from field_data_field_spec_ground where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							while($gcvalue=mysqli_fetch_array($res_gc))
								{
								$g_clear_info=mysqli_fetch_array(mysqli_query("select field_ground_info_value from field_data_field_ground_info where entity_id =".$gcvalue['entity_id']));
			
							?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_gc)==1){?> colspan="<?php echo $nofmodel?>"<?php }?>><?php echo $gcvalue['field_spec_ground_value']." mm";?>
						<?php
						if($g_clear_info!='')
							{
						?>
						<a href="#" class="infoIcon" style="z-index:40">&nbsp;
								<div class="infoBox">
									<?php echo $g_clear_info['field_ground_info_value'];?>
								</div>
								
						</a>
						<?php
							}
						?>
						</td>
							<?php
								}
							//}
						?>
					</tr>
					<tr>
						<td>Turning Radius</td>
						<?php
							/*$t_r=@mysqli_query($q);
							while($t_r_data=mysqli_fetch_array($t_r))
							{*/
							//$tr_value=mysqli_fetch_array(mysqli_query("select field_spec_radius_value from field_data_field_spec_radius where entity_id=".$t_r_data['entity_id']));
								$res_tr=@mysqli_query("select DISTINCT(field_spec_radius_value) from field_data_field_spec_radius where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
								while($tr_value=@mysqli_fetch_array($res_tr))
									{
						?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_tr)==1){?> colspan="<?php echo $nofmodel?>"<?php }?>><?php echo $tr_value['field_spec_radius_value']." meteres";?></td>
						<?php
									}
							//}
						?>
					</tr>
					<tr>
						<td>Seating Capacity</td>
						<?php
							/*$t_r=@mysqli_query($q);
							while($s_c_data=mysqli_fetch_array($t_r))
							{
							$sc_value=mysqli_fetch_array(mysqli_query("select field_spec_seating_value from field_data_field_spec_seating where entity_id=".$s_c_data['entity_id']));*/
							$res_sc=@mysqli_query("select DISTINCT(field_spec_seating_value),entity_id from field_data_field_spec_seating where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");

							while($sc_value=@mysqli_fetch_array($res_sc))
								{
							$seat_cap_info=@mysqli_fetch_array(mysqli_query("select field_seating_info_value from field_data_field_seating_info where entity_id =".$sc_value['entity_id']));
							?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_sc)==1){?> colspan="<?php echo $nofmodel?>"<?php }?>><?php echo $sc_value['field_spec_seating_value']." people";?>
						<?php
							if($seat_cap_info!='')
								{
						?>
						<a href="#" class="infoIcon" style="z-index:40">&nbsp;
								<div class="infoBox">
									<?php echo $seat_cap_info['field_seating_info_value'];?>
								</div>
								
						</a>
						<?php
								}
						?>
						</td>
						<?php
								}
							//}
						?>
					</tr>
					<tr>
						<td>Boot Capacity</td>
						<?php
							/*$t_r=@mysqli_query($q);
							while($bc_data=mysqli_fetch_array($t_r))
							{
							$bc_value=mysqli_fetch_array(mysqli_query("select field_spec_boot_value from field_data_field_spec_boot where entity_id=".$bc_data['entity_id']));*/
							$res_bc=@mysqli_query("select DISTINCT(field_spec_boot_value) from field_data_field_spec_boot where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							while($bc_value=mysqli_fetch_array($res_bc))
								{
						?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_bc)==1){?> colspan="<?php echo $nofmodel?>"<?php }?>><?php echo $bc_value['field_spec_boot_value']." liters";?></td>
						<?php
								}
							//}
						?>
					</tr>
					<tr>
						<td>Fuel Tank Capacity</td>
						<?php
							/*$ftc=@mysqli_query($q);
							while($ftc_data=mysqli_fetch_array($ftc))
							{
							$ftc_value=mysqli_fetch_array(mysqli_query("select field_spec_fuel_tank_value from field_data_field_spec_fuel_tank where entity_id=".$ftc_data['entity_id']));*/
							$res_ftc=@mysqli_query("select DISTINCT(field_spec_fuel_tank_value) from field_data_field_spec_fuel_tank where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							while($ftc_value=mysqli_fetch_array($res_ftc))
								{
						?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_ftc)==1){?> colspan="<?php echo $nofmodel?>"<?php }?>><?php echo $ftc_value['field_spec_fuel_tank_value']." liters";?></td>
						<?php
								}
								//}
						?>
					</tr>
				</table><!-- speciTable -->
				<?php
					}
				if($n>0)
					{
				?>
				<table class="speciTable<?php if($nofmodel==1){?> flexColum<?php }  else if($nofmodel==2){?> flexColum flexColum2<?php } else if($nofmodel==3){?> flexColum flexColum3<?php } else if($nofmodel==4){?> flexColum flexColum4<?php } ?>">
					<thead>
						<tr>
							<th colspan="5">ENGINE</th>
						</tr>	
					</thead>
					<tr>
						<td>Type</td>
						<?php
						/*while($eng_d=mysqli_fetch_array($e))
							{
							$title=mysqli_fetch_array(mysqli_query("select field_spec_engine_type_value from field_data_field_spec_engine_type where entity_id=".$eng_d['entity_id']));*/
								$res_engine=@mysqli_query("select DISTINCT(field_spec_engine_type_value) from field_data_field_spec_engine_type where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
								while($titletype=mysqli_fetch_array($res_engine))
									{
						?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_engine)==1){?> colspan="<?php echo $nofmodel?>"<?php }?>><?php echo $titletype['field_spec_engine_type_value'];?></td>
						<?php
									}
							//}
						?>
						<!--  <td>Turbocharged Direct Injection</td>
						<td>Turbocharged Common-Rail</td>
						<td>Turbocharged CommonRail</td>-->
					</tr>
					<tr>
						<td>Displacement</td>
						<?php
						/*$Displacement=@mysqli_query($q);
							while($dis_data=mysqli_fetch_array($Displacement))
							{
							$title=mysqli_fetch_array(mysqli_query("select field_spec_engine_displacement_value from field_data_field_spec_engine_displacement  where entity_id=".$dis_data['entity_id']));*/
							$res_displ=@mysqli_query("select DISTINCT(field_spec_engine_displacement_value) from field_data_field_spec_engine_displacement  where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							while($titledisplace=mysqli_fetch_array($res_displ))
								{
							?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_displ)==1){?> colspan="<?php echo $nofmodel?>"<?php }?>><?php echo $titledisplace['field_spec_engine_displacement_value']." cc";?></td>
							<?php
								}
							//}
							?>
						<!--  <td>1399 cc</td>
						<td>1584 cc</td>
						<td>1766 cc</td>-->
					</tr>
					<tr>
						<td>Cylinders</td>
							<?php
						/*$Cylinders=@mysqli_query($q);
							while($Cyl_data=mysqli_fetch_array($Cylinders))
							{
							$title=mysqli_fetch_array(mysqli_query("select field_spec_engine_cylinders_value from field_data_field_spec_engine_cylinders where entity_id=".$Cyl_data['entity_id']));*/
							$res_cylinder=@mysqli_query("select DISTINCT(field_spec_engine_cylinders_value) from field_data_field_spec_engine_cylinders where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							while($titlecylinder=@mysqli_fetch_array($res_cylinder))
								{
							?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_cylinder)==1){?> colspan="<?php echo $nofmodel?>"<?php }?>><?php echo $titlecylinder['field_spec_engine_cylinders_value'];?></td>
							<?php
								}
							//}
							?>
						<!--  <td>4 cyl</td>
						<td>6 cyl</td>
						<td>8 cyl</td>-->
					</tr>
					<tr>
						<td>Valvetrain</td>
						<?php
							/*$Valvetrain=@mysqli_query($q);
							while($Valve_data=mysqli_fetch_array($Valvetrain))
							{
							$title=mysqli_fetch_array(mysqli_query("select field_spec_engine_valvetrain_value from field_data_field_spec_engine_valvetrain where entity_id=".$Valve_data['entity_id']));*/
							$res_valve=@mysqli_query("select DISTINCT(field_spec_engine_valvetrain_value) from field_data_field_spec_engine_valvetrain where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");			
								while($d_valve=@mysqli_fetch_array($res_valve))
									{
							?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_valve)==1){?> colspan="<?php echo $nofmodel?>"<?php }?>><?php echo $d_valve['field_spec_engine_valvetrain_value'];?></td>
							<?php
									}
							//}
							?>
						<!--  <td>16v DOHC</td>
						<td>12v DOHC</td>
						<td>16v DOHC</td>-->
					</tr>
					<tr>
						<td>Bore & Stroke</td>
						<?php
							/*$Bore=@mysqli_query($q);
							while($Bore_data=mysqli_fetch_array($Bore))
							{
							$title=mysqli_fetch_array(mysqli_query("select field_spec_engine_bore_value from field_data_field_spec_engine_bore where entity_id=".$Bore_data['entity_id']));*/
							$bore_s_res=@mysqli_query("select DISTINCT(field_spec_engine_bore_value) from field_data_field_spec_engine_bore where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");			
								while($d_bs=@mysqli_fetch_array($bore_s_res))
								{
							?>
						<td class="aCenter"<?php if(mysqli_num_rows($bore_s_res)==1){?> colspan="<?php echo $nofmodel?>"<?php }?>><?php echo $d_bs['field_spec_engine_bore_value']." mm";?></td>
							<?php
								}
							//}
							?>
						<!--  <td>97 x 91 mm</td>
						<td>84 x 101 mm</td>
						<td>84 x 109 mm</td>-->
					</tr>
					<!--  <tr>
						<td>Compression ratio</td>
						<?php
							/*$Compression=@mysqli_query($q);
							while($Compression_data=mysqli_fetch_array($Compression))
							{*/
							$title=@mysqli_fetch_array(mysqli_query("select field_spec_engine_compression_value from field_data_field_spec_engine_compression where entity_id=".$Compression_data['entity_id']));
							?>
						<td><?php echo $title['field_spec_engine_compression_value'];?></td>
							<?php
							//}
							?>
					
					</tr>-->
					<tr>
						<td>Max Power</td>
							<?php
							/*$maxpower=@mysqli_query($q);
							while($maxpower_data=mysqli_fetch_array($maxpower))
							{
							$title=mysqli_fetch_array(mysqli_query("select field_spec_engine_power_value from field_data_field_spec_engine_power where entity_id=".$maxpower_data['entity_id']));*/
							$res_mxpower=mysqli_query("select DISTINCT(field_spec_engine_power_value) from field_data_field_spec_engine_power where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");			
							while($d_mpower=mysqli_fetch_array($res_mxpower))
								{
							?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_mxpower)==1){?> colspan="<?php echo $nofmodel?>"<?php }?>><?php echo $d_mpower['field_spec_engine_power_value'];?></td>
						<?php
								}
							//}
						?>
						<!--  <td>98 hp @ 6200 rpm</td>
						<td>102 hp @ 5400 rpm</td>
						<td>122 hp @ 5200 rpm</td>-->
					</tr>
					<tr>
						
						<td>Max Torque</td>
							<?php
							/*$MaxTorque=@mysqli_query($q);
							while($MaxTorque_data=mysqli_fetch_array($MaxTorque))
							{
							$title=mysqli_fetch_array(mysqli_query("select field_spec_engine_torque_value from field_data_field_spec_engine_torque where entity_id=".$MaxTorque_data['entity_id']));*/
							$res_mtorq=mysqli_query("select DISTINCT(field_spec_engine_torque_value) from field_data_field_spec_engine_torque where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");									
							while($d_mtorq=mysqli_fetch_array($res_mtorq))
								{
							?>
						 <td class="aCenter"<?php if(mysqli_num_rows($res_mtorq)==1){?> colspan="<?php echo $nofmodel?>"<?php }?>><?php echo $d_mtorq['field_spec_engine_torque_value'];?></td>
						 <?php
						 		}
							//}
							?>
						<!-- <td>163 Nm @ 3000 rpm</td>
						<td>191 Nm @ 1400-4300 rpm</td>
						<td>301 Nm @ 1200-4800 rpm</td>-->
					</tr>
					<tr>
						<td>Power to weight ratio</td>
							<?php
							/*$weightratio=@mysqli_query($q);
							while($weightratio_data=@mysqli_fetch_array($weightratio))
							{
							$title=@mysqli_fetch_array(mysqli_query("select field_spec_engine_power_weight_value from field_data_field_spec_engine_power_weight where entity_id=".$weightratio_data['entity_id']));*/
							$res_ptwr=mysqli_query("select DISTINCT(field_spec_engine_power_weight_value) from field_data_field_spec_engine_power_weight where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");														
								while($d_ptwr=mysqli_fetch_array($res_ptwr))
									{
							?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_ptwr)==1){?> colspan="<?php echo $nofmodel?>"<?php }?>><?php echo $d_ptwr['field_spec_engine_power_weight_value']." BHP/tonne";?></td>
						 <?php
						 			}
							//}
							?>
						<!-- <td>111 bhp/tonne</td>
						<td>114 bhp/tonne</td>
						<td>128 bhp/tonne</td>-->
					</tr>
					<tr>
						<td>Torque to weight ratio</td>
							<?php
							/*$torqueweightratio=@mysqli_query($q);
							while($torqueweightratio_data=@mysqli_fetch_array($torqueweightratio))
							{
							$title=@mysqli_fetch_array(mysqli_query("select field_spec_engine_torque_weight_value from field_data_field_spec_engine_torque_weight where entity_id=".$torqueweightratio_data['entity_id']));*/
							$res_ttwr=mysqli_query("select DISTINCT(field_spec_engine_torque_weight_value) from field_data_field_spec_engine_torque_weight where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");									
							while($d_ttwr=@mysqli_fetch_array($res_ttwr))
								{
								
							?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_ttwr)==1){?> colspan="<?php echo $nofmodel?>"<?php }?>><?php echo $d_ttwr['field_spec_engine_torque_weight_value']." Nm/tonne"?></td>
						 <?php
						 		}
							//}
							?>
						<!--  <td>227 Nm/tonne</td>
						<td>289 Nm/tonne</td>
						<td>312 Nm/tonne</td>
						-->
					</tr>
					<tr>
						<td>BHP / Liter</td>
							<?php
							/*$bhpliter=@mysqli_query($q);
							while($bhpliter_data=@mysqli_fetch_array($bhpliter))
							{
							$title=@mysqli_fetch_array(mysqli_query("select field_spec_engine_bhp_value from field_data_field_spec_engine_bhp where entity_id=".$bhpliter_data['entity_id']));*/
							$res_bhp_liter=mysqli_query("select DISTINCT(field_spec_engine_bhp_value) from field_data_field_spec_engine_bhp where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");									
							while($d_bhp_liter=@mysqli_fetch_array($res_bhp_liter))
								{
								
							?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_bhp_liter)==1){?> colspan="<?php echo $nofmodel?>"<?php }?>><?php echo $d_bhp_liter['field_spec_engine_bhp_value'];?></td>
						 <?php
						 		}
							//}
							?>
						<!--  <td>111 bhp/liter</td>
						<td>114 bhp/liter</td>
						<td>128 bhp/liter</td>-->
					</tr>
					<tr>
						<td>Drivetrain</td>
							<?php
							/*$Drivetrain=@mysqli_query($q);
							while($Drivetrain_data=@mysqli_fetch_array($Drivetrain))
							{
							$title=@mysqli_fetch_array(mysqli_query("select field_spec_engine_drivetrain_value from field_data_field_spec_engine_drivetrain where entity_id=".$Drivetrain_data['entity_id']));*/
							$res_drivetrain=@mysqli_query("select DISTINCT(field_spec_engine_drivetrain_value) from field_data_field_spec_engine_drivetrain where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							while($d_dvt=mysqli_fetch_array($res_drivetrain))
								{
								
							?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_drivetrain)==1){?> colspan="<?php echo $nofmodel?>"<?php }?>><?php echo $d_dvt['field_spec_engine_drivetrain_value'];?></td>
							 <?php
							 	}
							//}
							?>
						<!--  <td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>-->
					</tr>
					<tr>
						<td>Transmission</td>
							<?php
							/*$Transmission=@mysqli_query($q);
							while($Transmission_data=@mysqli_fetch_array($Transmission))
							{
							$title=@mysqli_fetch_array(mysqli_query("select field_spec_engine_transmission_value from field_data_field_spec_engine_transmission where entity_id=".$Transmission_data['entity_id']));*/
							$res_transmission=@mysqli_query("select DISTINCT(field_spec_engine_transmission_value) from field_data_field_spec_engine_transmission where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							while($d_trans=mysqli_fetch_array($res_transmission))
								{
							?>
							<td class="aCenter"<?php if(mysqli_num_rows($res_transmission)==1){?> colspan="<?php echo $nofmodel?>"<?php }?>><?php echo $d_trans['field_spec_engine_transmission_value'];?></td>
							 <?php
							 	}
							//}
							?>
						<!-- <td>6-speed Manual</td>
						<td>5-speed Manual</td>
						<td>7-speed DSG with paddle shift</td> -->
					</tr>
					<tr>
						<td>Service Intervals</td>
							<?php
							/*$ServiceIntervals=@mysqli_query($q);
							while($ServiceIntervals_data=@mysqli_fetch_array($ServiceIntervals))
							{
							$title=@mysqli_fetch_array(mysqli_query("select field_spec_engine_service_value from field_data_field_spec_engine_service where entity_id=".$ServiceIntervals_data['entity_id']));*/
							$res_serv_i=@mysqli_query("select DISTINCT(field_spec_engine_service_value) from field_data_field_spec_engine_service where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							while($d_trans=mysqli_fetch_array($res_serv_i))
								{
							?>
							<td class="aCenter"<?php if(mysqli_num_rows($res_serv_i)==1){?> colspan="<?php echo $nofmodel?>"<?php }?>><?php echo $d_trans['field_spec_engine_service_value']." kms";?></td>
							 <?php
							 	}
							//}
							?>
					</tr>
				</table><!-- speciTable -->
					
				<table class="speciTable<?php if($nofmodel==1){?> flexColum<?php }  else if($nofmodel==2){?> flexColum flexColum2<?php } else if($nofmodel==3){?> flexColum flexColum3<?php } else if($nofmodel==4){?> flexColum flexColum4<?php } ?>">
					<thead>
						<tr>
							<th colspan="5">SUSPENSION</th>
						</tr>	
					</thead>
					
					<tr>
						<td>Steering type</td>
							<?php
							/*$Steering=@mysqli_query($q);
							while($Steering_data=@mysqli_fetch_array($Steering))
								{
							$title=mysqli_fetch_array(mysqli_query("select field_spec_steering_value from field_data_field_spec_steering where entity_id =".$Steering_data['entity_id']." and bundle='specifications'"));*/
							$res_st_type=@mysqli_query("select DISTINCT(field_spec_steering_value) from field_data_field_spec_steering where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							while($d_stype=@mysqli_fetch_array($res_st_type))
								{
							
							?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_st_type)==1){?> colspan="<?php echo $nofmodel?>"<?php }?>><?php echo $d_stype['field_spec_steering_value'];?></td>
							<?php
								}
								//}
							?>
					</tr>
					
					<tr>
						<td>Front suspension</td>
							<?php
							/*$Frontsuspension=@mysqli_query($q);
							while($Frontsuspension_data=@mysqli_fetch_array($Frontsuspension))
								{
							$title=mysqli_fetch_array(mysqli_query("select field_spec_front_value from field_data_field_spec_front where entity_id =".$Frontsuspension_data['entity_id']." and bundle='specifications'"));*/
							$res_fsus=@mysqli_query("select DISTINCT(field_spec_front_value) from field_data_field_spec_front where entity_id in (".substr($entyti_id,0,-1).")  group by entity_id order by entity_id");
							while($d_fsus=@mysqli_fetch_array($res_fsus))
								{
							?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_fsus)==1){?> colspan="<?php echo $nofmodel?>"<?php }?>><?php echo $d_fsus['field_spec_front_value'];?></td>
							<?php
								}
								//}
							?>
					</tr>
					<tr> 
						<td>Rear suspension</td>
							<?php
							/*$rear_value=@mysqli_query($q);
							while($rear_data=@mysqli_fetch_array($rear_value))
								{
							$title=mysqli_fetch_array(mysqli_query("select field_spec_rear_value from field_data_field_spec_rear where entity_id =".$rear_data['entity_id']." and bundle='specifications'"));*/
							$res_rearsus=@mysqli_query("select DISTINCT(field_spec_rear_value) from field_data_field_spec_rear where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");								while($d_rear_sus=@mysqli_fetch_array($res_rearsus))
								{
							?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_rearsus)==1){?> colspan="<?php echo $nofmodel?>"<?php }?>><?php echo $d_rear_sus['field_spec_rear_value'];?></td>
							<?php
								}
							?>
					</tr>
					<tr>
						<td>
							Tyre size
							<!--  <a href="#" class="infoIcon">&nbsp;
								<div class="infoBox">
									<span></span>
									Tyre size listed for top variant. Lower variants come with 155/60 R14
								</div>
							</a>-->
						</td>
						<?php
							$res_tyre_size=@mysqli_query("select field_spec_tyre_value,entity_id from field_data_field_spec_tyre where entity_id in (".substr($entyti_id,0,-1).") group by field_spec_tyre_value order by entity_id");
							while($d_tyre_size=@mysqli_fetch_array($res_tyre_size))
								{
								$sql_tyre_caption=@mysql_fetch_assoc(mysqli_query("select field_tyre_size_caption_value from field_data_field_tyre_size_caption where entity_id =".$d_tyre_size['entity_id']." group by entity_id order by entity_id"));
						?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_tyre_size)==1){?> colspan="<?php echo $nofmodel?>"<?php }?>>
							<?php echo $d_tyre_size['field_spec_tyre_value'];?>
							<?php
								if($sql_tyre_caption!='')
									{
							?>
							<a href="#" class="infoIcon" style="z-index:40">&nbsp;
								<div class="infoBox">
									<span></span>
									<?php echo $sql_tyre_caption['field_tyre_size_caption_value'];?>
								</div>
								
							</a>
							<?php
									}
								?>
						</td>
							<?php
								}
								//}
							?>
						<!--  <td>
							185/60 R 14
							<a href="#" class="infoIcon" style="z-index:30">&nbsp;
								<div class="infoBox">
									<span></span>
									Tyre size listed for top variant. Lower variants come with 155/60 R14
								</div>
							</a>
						</td>
						<td>
							185/60 R 14
							<a href="#" class="infoIcon" style="z-index:20">&nbsp;
								<div class="infoBox">
									<span></span>
									Tyre size listed for top variant. Lower variants come with 155/60 R14
								</div>
							</a>
						</td>
						<td>
							185/65 R 15
							<a href="#" class="infoIcon" style="z-index:10">&nbsp;
								<div class="infoBox">
									<span></span>
									Tyre size listed for top variant. Lower variants come with 155/60 R14
								</div>
							</a>
						</td>
						-->
					</tr>
					<tr>
						<td>Brakes : Front / Rear</td>
						<?php
							/*$break_value=@mysqli_query($q);
							while($break_data=@mysqli_fetch_array($break_value))
								{
						$titlebreak=@mysqli_fetch_array(mysqli_query("select field_spec_brakes_value from field_data_field_spec_brakes where entity_id =".$break_data['entity_id']." and bundle='specifications'"));*/
						$res_break=@mysqli_query("select DISTINCT(field_spec_brakes_value),entity_id from field_data_field_spec_brakes where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");						
						while($d_bfr=mysqli_fetch_array($res_break))
							{
								$brakes_front_info=@mysqli_fetch_array(mysqli_query("select field_brakes_info_value from field_data_field_brakes_info where entity_id =".$d_bfr['entity_id']));
						?>
						<td class="aCenter"><?php echo $d_bfr['field_spec_brakes_value'];?>
						 <?php
							if($brakes_front_info!='')
								{
						 ?>
							<a href="#" class="infoIcon" style="z-index:40">&nbsp;
								<div class="infoBox">
									<?php
									echo $brakes_front_info['field_brakes_info_value'];
									?>
								</div>
								
							</a>
							<?php
								}
							?>
						</td>
						<?php
							}
								//}
						?>
					</tr>
				</table><!-- speciTable -->
				
				<table class="speciTable<?php if($nofmodel==1){?> flexColum<?php }  else if($nofmodel==2){?> flexColum flexColum2<?php } else if($nofmodel==3){?> flexColum flexColum3<?php } else if($nofmodel==4){?> flexColum flexColum4<?php } ?>">
					<thead>
						<tr>
							<th colspan="5">FUEL EFFICIENCY</th>
						</tr>	
					</thead>
					<tr>
						<td>City</td>
						<?php
							/*$citykpl=@mysqli_query($q);
							while($citykpl_data=@mysqli_fetch_array($citykpl))
							{
						$titlecitykpl=@mysqli_fetch_array(mysqli_query("select field_spec_fuel_city_value from field_data_field_spec_fuel_city where entity_id =".$citykpl_data['entity_id']." and bundle='specifications'"));*/
							$res_city=mysqli_query("select DISTINCT(field_spec_fuel_city_value) from field_data_field_spec_fuel_city where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");							
							while($d_city=mysqli_fetch_array($res_city))
								{
								
						?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_city)==1){?> colspan="<?php echo $nofmodel?>"<?php }?>><?php echo $d_city['field_spec_fuel_city_value']." kpl";?></td>
						<?php
								}
							//}
						?>
						<!--  <td>12.2 kpl</td>
						<td>18.2 kpl</td>
						<td>16.2 kpl</td>-->
					</tr>
					<tr>
						<td>Highway</td>
						<?php
							/*$highway=@mysqli_query($q);
							while($highway_data=@mysqli_fetch_array($highway))
							{
						$highway_name=@mysqli_fetch_array(mysqli_query("select field_spec_fuel_highway_value from field_data_field_spec_fuel_highway where entity_id =".$highway_data['entity_id']." and bundle='specifications'"));*/
						$res_highway=@mysqli_query("select DISTINCT(field_spec_fuel_highway_value) from field_data_field_spec_fuel_highway where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
								while($d_highway=@mysqli_fetch_array($res_highway))
								{
						
						?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_highway)==1){?> colspan="<?php echo $nofmodel?>"<?php }?>><?php echo $d_highway['field_spec_fuel_highway_value']." kpl";?></td>
						<?php
								}
							//}
						?>
						<!--  <td>17.2 kpl</td>
						<td>20.2 kpl</td>
						<td>14.2 kpl</td>-->
					</tr>
					<tr>
						<td>ARAI Rating</td>
						<?php
							/*$resapireating=@mysqli_query($q);
							while($araireating_data=@mysqli_fetch_array($resapireating))
							{
							$apirating_name=@mysqli_fetch_array(mysqli_query("select field_spec_fuel_arai_value from field_data_field_spec_fuel_arai where entity_id =".$araireating_data['entity_id']." and bundle='specifications'"));*/
							$res_apirating=@mysqli_query("select DISTINCT(field_spec_fuel_arai_value) from field_data_field_spec_fuel_arai where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
								while($d_apirating=@mysqli_fetch_array($res_apirating))
								{
							
						?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_apirating)==1){?> colspan="<?php echo $nofmodel?>"<?php }?>><?php echo $d_apirating['field_spec_fuel_arai_value']." kpl";?></td>
						<?php
								}
							//}
						?>
						<!--
						<td>12.2 kpl</td>
						<td>18.2 kpl</td>
						<td>16.2 kpl</td>-->
					</tr>
				</table><!-- speciTable -->
					<?php
					}
					?>
			</div><!-- car review -->
		</div><!-- overviewContainer -->
		
		<div class="clearfix articleNavi">
			<a class="fleft btnLeft" href="?q=reviews">
				<span>Back to Index</span>
			</a>
			<a class="compareClose" id="compareBtn" href="#" onclick="return false;">&nbsp;</a>
			<div class="compareMesg">You have already added that car. Please choose another car.</div>
		</div>
		<?php //include ("../themes/bhp/includes/compare.php"); 
		$sql_model=@mysqli_query("SELECT node.title,node.nid, file_managed.uri,field_data_field_nr_make.field_nr_make_nid,field_data_field_model_dashboard.field_model_dashboard_fid
FROM node,file_managed,field_data_field_nr_make,field_data_field_model_dashboard
WHERE field_data_field_model_dashboard.field_model_dashboard_fid = file_managed.fid
AND field_data_field_model_dashboard.entity_id = node.nid
AND node.status =1 AND field_data_field_nr_make.entity_id=field_data_field_model_dashboard.entity_id and node.nid=".$model_id['field_nr_make_model_nid']." order by node.changed desc");
$numberofrows=@mysqli_num_rows($sql_model);
if($numberofrows>0)
		{
		?>
				<div class="marB10 BLR5 reviewCompare" style="display:block">
						<ul class="clearfix" id="compareUL">
							<?php
							$data_model=mysqli_fetch_array($sql_model);
							$price_res = @mysql_fetch_assoc(mysqli_query("select min(on_road_price) as minPrice, max(on_road_price) as maxPrice from team_bhp_variant_price, field_data_field_price_nr_variant, field_data_field_variant_nr_engine, field_data_field_nr_make_model where team_bhp_variant_price.city='Delhi' and team_bhp_variant_price.nid=field_data_field_price_nr_variant.entity_id and field_data_field_price_nr_variant.field_price_nr_variant_nid=field_data_field_variant_nr_engine.entity_id and field_data_field_variant_nr_engine.field_variant_nr_engine_nid=field_data_field_nr_make_model.entity_id and field_data_field_nr_make_model.field_nr_make_model_nid=".$data_model['nid']));
							?>
							<li class="clearfix">
								<div class="content firstContent clearfix" id="<?php echo $data_model['nid']; ?>">
									<div class="img">
									<!--<img src="http://www.team-bhp.com/sites/default/files/<?php echo str_replace("public://","",$data_model['uri']);?>" alt="<?php echo $data_model['title'];?>" width="61" height="48" />-->
									<img src="http://www.team-bhp.com/?q=sites/default/files/styles/thumb_compare_car/public/<?php echo str_replace("public://","",$data_model['uri']);?>" alt="<?php echo $data_model['title'];?>" width="61" height="48" />
									
									</div>
									<p class="desc">
										<span class="title"><?php echo $data_model['title'];?></span>
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
								</div>
							</li>
							<?php
							include_once("includes/compare-inside.php");
							?>
						</ul><!-- clearfix -->
					</div><!-- reviewCompare -->
										<?php  
										}
					$sql_modelalternative=@mysqli_query("SELECT node.title,node.nid,field_data_field_model_alternatives.field_model_alternatives_nid from node,field_data_field_model_alternatives WHERE field_data_field_model_alternatives.field_model_alternatives_nid = node.nid AND node.status =1  and field_data_field_model_alternatives.entity_id =".$model_id['field_nr_make_model_nid']." order by node.changed desc");
				include("includes/alternative_forreview.php");
				//include ("includes/reviews-alternatives.php"); 
		?>				
	</div><!-- articles -->
</div><!-- Left Column -->
