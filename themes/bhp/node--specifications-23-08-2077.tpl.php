<?php
$sql_model=@mysqli_query("SELECT * FROM `field_data_field_nr_make_model`,node WHERE field_data_field_nr_make_model.entity_id = node.nid AND node.status =1 and field_data_field_nr_make_model.entity_id=".$node->field_spec_nr_engine_type['und'][0]['nid']);

$num=@mysqli_num_rows($sql_model);
	if($num>0)
		{
		$mid='';
		$model_id=mysqli_fetch_array($sql_model);
		// echo "select entity_id from field_data_field_nr_make_model,node where field_data_field_nr_make_model.field_nr_make_model_nid = node.nid and node.status=1 and field_data_field_nr_make_model.field_nr_make_model_nid=".$model_id['field_nr_make_model_nid'];
			$sql_m=mysqli_query("select entity_id from field_data_field_nr_make_model,node where field_data_field_nr_make_model.field_nr_make_model_nid = node.nid and node.status=1 and field_data_field_nr_make_model.field_nr_make_model_nid=".$model_id['field_nr_make_model_nid']);
		while($d_m=mysqli_fetch_array($sql_m))
			{
			$mid.=$d_m['entity_id'].", ";
			}
		
		}
		//echo $mid;
		$array_mid=explode(",",substr($mid,0,-2));
$make_res = @mysqli_fetch_array(mysqli_query("select node.title,field_data_field_nr_make.field_nr_make_nid from node,field_data_field_nr_make where field_data_field_nr_make.entity_id =".$model_id['field_nr_make_model_nid']." and node.nid=field_data_field_nr_make.field_nr_make_nid"));
$d=@mysqli_fetch_array($sql_model);
$model_title=@mysqli_fetch_array(mysqli_query("select title from node where nid=".$model_id['field_nr_make_model_nid']));

$sql_brochure=@mysqli_fetch_array(mysqli_query("select field_data_field_model_brochure.field_model_brochure_fid,file_managed.uri from file_managed,field_data_field_model_brochure where field_data_field_model_brochure.field_model_brochure_fid=file_managed.fid and field_data_field_model_brochure.entity_id=".$model_id['field_nr_make_model_nid']));

$sql_line_image=@mysqli_fetch_array(mysqli_query("select field_data_field_model_line.field_model_line_fid,file_managed.uri from file_managed,field_data_field_model_line where field_data_field_model_line.field_model_line_fid=file_managed.fid and field_data_field_model_line.entity_id=".$model_id['field_nr_make_model_nid']));

//$sql_engine=@mysqli_query("select node.title,field_data_field_nr_make_model.entity_id,field_data_field_nr_make_model.field_nr_make_model_nid from node,field_data_field_nr_make_model where field_data_field_nr_make_model.entity_id=node.nid and field_data_field_nr_make_model.field_nr_make_model_nid=".$node->field_news_model['und'][0]['nid']);

$sql_engine=@mysqli_query("select node.title,field_data_field_nr_make_model.entity_id,field_data_field_nr_make_model.field_nr_make_model_nid from node,field_data_field_nr_make_model where field_data_field_nr_make_model.entity_id=node.nid and node.status=1 and field_data_field_nr_make_model.entity_id in (".substr($mid,0,-2).") group by field_data_field_nr_make_model.entity_id");
$nofmodel=mysqli_num_rows($sql_engine);

//echo $q_mwithe="select field_spec_nr_engine_type_nid,entity_id from field_data_field_spec_nr_engine_type where field_spec_nr_engine_type_nid in (".substr($mid,0,-2)." ) and bundle='specifications' group by field_spec_nr_engine_type_nid";
$q_mwithe="select field_spec_nr_engine_type_nid,entity_id from field_data_field_spec_nr_engine_type where field_spec_nr_engine_type_nid in (".substr($mid,0,-2)." ) and bundle='specifications' order by entity_id desc limit 0,4";
$sql_modelwithengine=@mysqli_query($q_mwithe);
$entyti_id='';
	while($data_eid=@mysqli_fetch_array($sql_modelwithengine))
			{
			$entyti_id.=$data_eid['entity_id'].",";
			}
		$array=explode(",",substr($entyti_id,0,-1));
		
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
$sql_aliasforphotos=@mysqli_fetch_array(mysqli_query("SELECT * FROM url_alias WHERE `source` = 'node/".$sql_urlforfoto['entity_id']."' and alias !='gallery/ant'"));
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
									/*for($j=0;$j<count($array_mid);$j++)
										{
										$data_engine=@mysqli_fetch_array(mysqli_query("select node.title,field_data_field_nr_make_model.entity_id,field_data_field_nr_make_model.field_nr_make_model_nid from node,field_data_field_nr_make_model where field_data_field_nr_make_model.entity_id=node.nid and node.status=1 and field_data_field_nr_make_model.entity_id =".$array_mid[$j]." group by field_data_field_nr_make_model.entity_id"));
									//echo "select node.title,field_data_field_nr_make_model.entity_id,field_data_field_nr_make_model.field_nr_make_model_nid from node,field_data_field_nr_make_model where field_data_field_nr_make_model.entity_id=node.nid and node.status=1 and field_data_field_nr_make_model.entity_id =".$array_mid[$j]." group by field_data_field_nr_make_model.entity_id";*/
										?>
								<th><?php echo $data_engine['title'];?></th>
								<?php
										//}
									}
								?>
								
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
				$n=@mysqli_num_rows($e);
				if($n>0)
					{
					$colspan=4;
				?>
				<!-- <table class="speciTable<?php if($nofmodel==1){?> flexColum<?php }  else if($nofmodel==2){?> flexColum flexColum2<?php } else if($nofmodel==3){?> flexColum flexColum3<?php } else if($nofmodel==4){?> flexColum flexColum4<?php } ?>"> -->
				<table class="speciTable">
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
								$ct=1;
							//$res_lwh=mysqli_query("select DISTINCT(field_spec_length_value) from field_data_field_spec_length  where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
							$res_lwh=mysqli_query("select DISTINCT(field_spec_length_value) from field_data_field_spec_length  where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							$nolwh=mysqli_num_rows($res_lwh);
							while($dimensionvalvalue=mysqli_fetch_array($res_lwh))
								{
								$cval=0;
								if($nolwh==2)
									{
									$cval=3;
									}
									else if($nolwh==3)
									{
									$cval=2;
									}
									else if($nolwh==4)
									{
									$cval=2;
									}
						?>
						<td  class="aCenter"<?php  if($nolwh==1){?> colspan="<?php echo $nofmodel?>"<?php } else if($ct>1 && $ct==$nolwh && $nolwh<4) { ?> colspan="<?php echo $cval;?>" <?php }?> ><?php echo $dimensionvalvalue['field_spec_length_value']." mm";?></td>
							<?php
							$ct++;
								}
						?>
					</tr>
						
					<tr>
						<td>Wheelbase</td>
						<?php
							//$Wheelbase=@mysqli_query($q);
							//while($Wheelbase_data=mysqli_fetch_array($Wheelbase))
							//{
							$ctwb=1;
							//$res_wb=mysqli_query("select DISTINCT(field_spec_wheel_value) from field_data_field_spec_wheel  where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
							$res_wb=mysqli_query("select DISTINCT(field_spec_wheel_value) from field_data_field_spec_wheel  where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							$nofwb=@mysqli_num_rows($res_wb);
							$colval_wb=0;
							while($wbvalue=@mysqli_fetch_array($res_wb))
								{
								if($nofwb==2)
									{
									$colval_wb=3;
									}
									else if($nofwb==3)
									{
									$colval_wb=2;
									}
									else if($nofwb==4)
									{
									$colval_wb=2;
									}
								
						?>
						<td class="aCenter" <?php if($nofwb==1){?> colspan="<?php echo $nofmodel?>"<?php } else if($ctwb>1 && $ctwb==$nofwb && $nofwb<4) { ?> colspan="<?php echo $colval_wb;?>" <?php }?>><?php echo $wbvalue['field_spec_wheel_value']." mm";?></td>
							<?php
								$ctwb++;
								}
							?>
					</tr>
					<tr>
						<td>Track : Front / Rear</td>
							<?php
							//$track_frontrear=@mysqli_query($q);
							//while($frontrear_data=mysqli_fetch_array($track_frontrear))
							//{
							//$res_tfr=@mysqli_query("select DISTINCT(field_spec_track_value) from field_data_field_spec_track  where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
							$res_tfr=@mysqli_query("select DISTINCT(field_spec_track_value) from field_data_field_spec_track  where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							$numb_tfr=mysqli_num_rows($res_tfr);
							$cttrack_front=1;
							$col_valtrack=0;
							while($frvalue=@mysqli_fetch_array($res_tfr))
								{
								if($array==2)
									{
									$col_valtrack=3;
									}
									else if($array==3)
									{
									$col_valtrack=2;
									}
									else if($array==4)
									{
									$col_valtrack=2;
									}
						?>
						<td class="aCenter"<?php if($numb_tfr==1){?> colspan="<?php echo $nofmodel?>"<?php } else if($cttrack_front>1 && $cttrack_front==$numb_tfr && $numb_tfr<4) { ?> colspan="<?php echo $col_valtrack;?>" <?php }?>><?php echo $frvalue['field_spec_track_value']." mm";?></td>
							<?php
								$cttrack_front++;
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
						$ctkw=1;
						$cvalkw=0;
						//$res_kw=mysqli_query("select DISTINCT(field_spec_kerb_value),entity_id from field_data_field_spec_kerb where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
						$res_kw=mysqli_query("select DISTINCT(field_spec_kerb_value),entity_id from field_data_field_spec_kerb where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
						$nofkw=mysqli_num_rows($res_kw);
							while($kwvalue=mysqli_fetch_array($res_kw))
								{
								if($nofkw==2)
									{
									$cvalkw=3;
									}
									else if($nofkw==3)
									{
									$cvalkw=2;
									}
									else if($nofkw==4)
									{
									$cvalkw=2;
									}
								$Kerb_wightinfo=mysqli_fetch_array(mysqli_query("select field_kerb_info_value from field_data_field_kerb_info where entity_id =".$kwvalue['entity_id']));
							?>
						<td class="aCenter"<?php if($nofkw==1){?> colspan="<?php echo $nofmodel?>"<?php } else if($ctkw>1 && $ctkw==$nofkw && $nofkw<4) { ?> colspan="<?php echo $cvalkw;?>" <?php }?>><?php echo $kwvalue['field_spec_kerb_value']." kgs";?>
						<?php
							if($Kerb_wightinfo!='')
								{
						?>
						<a href="#" class="infoIcon">&nbsp;
								<div class="infoBox">
								<span></span>
									<?php echo $Kerb_wightinfo['field_kerb_info_value'];?>
								</div>
								
						</a>
							<?php
								}
							?>
						</td>
						<?php
							$ctkw++;
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
							$cnt_gc=1;
							$colvalgclearance=0;
							//$res_gc=@mysqli_query("select DISTINCT(field_spec_ground_value),entity_id from field_data_field_spec_ground where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
							$res_gc=@mysqli_query("select DISTINCT(field_spec_ground_value),entity_id from field_data_field_spec_ground where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							$nofg_clearance=mysqli_num_rows($res_gc);
							while($gcvalue=mysqli_fetch_array($res_gc))
								{
								if($nofg_clearance==2)
									{
									$colvalgclearance=3;
									}
									else if($nofg_clearance==3)
									{
									$colvalgclearance=2;
									}
									else if($nofg_clearance==4)
									{
									$colvalgclearance=2;
									}
								$g_clear_info=mysqli_fetch_array(mysqli_query("select field_ground_info_value from field_data_field_ground_info where entity_id =".$gcvalue['entity_id']));
			
							?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_gc)==1){?> colspan="<?php echo $nofmodel?>"<?php } else if($cnt_gc>1 && $cnt_gc==$nofg_clearance && $nofg_clearance<4) { ?> colspan="<?php echo $colvalgclearance;?>" <?php }?>><?php echo $gcvalue['field_spec_ground_value']." mm";?>
						<?php
						if($g_clear_info!='')
							{
						?>
						<a href="#" class="infoIcon">&nbsp;
								<div class="infoBox">
								<span></span>
									<?php echo $g_clear_info['field_ground_info_value'];?>
								</div>
								
						</a>
						<?php
							}
						?>
						</td>
							<?php
							$cnt_gc++;
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
								$ct_t_r=1;
								//$res_tr=@mysqli_query("select DISTINCT(field_spec_radius_value) from field_data_field_spec_radius where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
								$res_tr=@mysqli_query("select DISTINCT(field_spec_radius_value) from field_data_field_spec_radius where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
								$nolwht_r=@mysqli_num_rows($res_tr);
								$cvalt_radius=0;
								while($tr_value=@mysqli_fetch_array($res_tr))
									{
								if($nolwht_r==2)
									{
									$cvalt_radius=3;
									}
									else if($nolwht_r==3)
									{
									$cvalt_radius=2;
									}
									else if($nolwht_r==4)
									{
									$cvalt_radius=2;
									}
						?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_tr)==1){?> colspan="<?php echo $nofmodel?>"<?php } else if($ct_t_r>1 && $ct_t_r==$nolwht_r && $nolwht_r<4) { ?> colspan="<?php echo $cvalt_radius;?>" <?php }?>><?php echo $tr_value['field_spec_radius_value']." meteres";?></td>
						<?php
								$ct_t_r++;
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
							$cvalseat_cap=0;
							$cnt_seat_cap=1;
							//$res_sc=@mysqli_query("select DISTINCT(field_spec_seating_value),entity_id from field_data_field_spec_seating where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
							$res_sc=@mysqli_query("select DISTINCT(field_spec_seating_value),entity_id from field_data_field_spec_seating where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							$nofs_cap=@mysqli_num_rows($res_sc);
							while($sc_value=@mysqli_fetch_array($res_sc))
								{
								if($nofs_cap==2)
									{
									if(count($array)==2)
										{
										$cvalseat_cap=1;
										}
										else
										{
									$cvalseat_cap=3;
										}
									}
									else if($nofs_cap==3)
									{
									if(count($array)==2)
										{
										$cvalseat_cap=1;
										}
										else
										{
									$cvalseat_cap=3;
										}
									}
									else if($nofs_cap==4)
									{
									if(count($array)==2)
										{
										$cvalseat_cap=1;
										}
										else
										{
									$cvalseat_cap=3;
										}
									}
							$seat_cap_info=@mysqli_fetch_array(mysqli_query("select field_seating_info_value from field_data_field_seating_info where entity_id =".$sc_value['entity_id']));
							?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_sc)==1){?> colspan="<?php echo $nofmodel?>"<?php } else if($cnt_seat_cap>1 && $cnt_seat_cap==$nofs_cap && $nofs_cap<4) { ?> colspan="<?php echo $cvalseat_cap;?>" <?php }?>><?php echo $sc_value['field_spec_seating_value']." People";?>
						<?php
							if($seat_cap_info!='')
								{
						?>
						<a href="#" class="infoIcon">&nbsp;
								<div class="infoBox">
								<span></span>
									<?php echo $seat_cap_info['field_seating_info_value'];?>
								</div>
								
						</a>
						<?php
								}
						?>
						</td>
						<?php
							$cnt_seat_cap++;
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
							$colval_bcap=0;
							$cnt_b_cap=1;
							//$res_bc=@mysqli_query("select DISTINCT(field_spec_boot_value) from field_data_field_spec_boot where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
							$res_bc=@mysqli_query("select DISTINCT(field_spec_boot_value) from field_data_field_spec_boot where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							$nofs_boot_cap=@mysqli_num_rows($res_bc);
							while($bc_value=mysqli_fetch_array($res_bc))
								{
								if($nofs_boot_cap==2)
									{
									if(count($array)==2)
										{
										$colval_bcap=1;
										}
										else
										{
									$colval_bcap=3;
										}
									}
									else if($nofs_boot_cap==3)
									{
									if(count($array)==2)
										{
										$colval_bcap=1;
										}
										else
										{
									$colval_bcap=3;
										}
									}
									else if($nofs_boot_cap==4)
									{
									if(count($array)==2)
										{
										$colval_bcap=1;
										}
										else
										{
									$colval_bcap=3;
										}
									}
						?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_bc)==1){?> colspan="<?php echo $nofmodel?>"<?php } else if($cnt_b_cap>1 && $cnt_b_cap==$nofs_boot_cap && $nofs_boot_cap<4) { ?> colspan="<?php echo $colval_bcap;?>" <?php }?>><?php echo $bc_value['field_spec_boot_value']." Liters";?></td>
						<?php
							$cnt_b_cap++;
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
							$colval_fuel_tank=0;
							$cnt_ftank=1;
							//$res_ftc=@mysqli_query("select DISTINCT(field_spec_fuel_tank_value) from field_data_field_spec_fuel_tank where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
							$res_ftc=@mysqli_query("select DISTINCT(field_spec_fuel_tank_value) from field_data_field_spec_fuel_tank where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							$nof_fuel_tank_cap=@mysqli_num_rows($res_ftc);
							while($ftc_value=mysqli_fetch_array($res_ftc))
								{
								if($nof_fuel_tank_cap==2)
									{
									if(count($array)==2)
										{
										$colval_fuel_tank=1;
										}
										else
										{
									$colval_fuel_tank=3;
										}
									}
									else if($nof_fuel_tank_cap==3)
									{
									if(count($array)==2)
										{
										$colval_fuel_tank=1;
										}
										else
										{
									$colval_fuel_tank=3;
										}
									}
									else if($nof_fuel_tank_cap==4)
									{
									if(count($array)==2)
										{
										$colval_fuel_tank=1;
										}
										else
										{
									$colval_fuel_tank=3;
										}
									}
						?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_ftc)==1){?> colspan="<?php echo $nofmodel?>"<?php } else if($cnt_ftank>1 && $cnt_ftank==$nof_fuel_tank_cap && $nof_fuel_tank_cap<4) { ?> colspan="<?php echo $colval_fuel_tank;?>" <?php }?>><?php echo $ftc_value['field_spec_fuel_tank_value']." Liters";?></td>
						<?php
								$cnt_ftank++;
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
				<!-- <table class="speciTable<?php if($nofmodel==1){?> flexColum<?php }  else if($nofmodel==2){?> flexColum flexColum2<?php } else if($nofmodel==3){?> flexColum flexColum3<?php } else if($nofmodel==4){?> flexColum flexColum4<?php } ?>"> -->
				<table class="speciTable">
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
								$colval_etank=0;
								$cnt_etype=1;
								//$res_engine=@mysqli_query("select DISTINCT(field_spec_engine_type_value) from field_data_field_spec_engine_type where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
								$res_engine=@mysqli_query("select DISTINCT(field_spec_engine_type_value) from field_data_field_spec_engine_type where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
								$n_etype=@mysqli_num_rows($res_engine);
								while($titletype=mysqli_fetch_array($res_engine))
									{
									if($n_etype==2)
									{
									if(count($array)==2)
										{
										$colval_etank=1;
										}
										else
										{
									$colval_etank=3;
										}
									}
									else if($n_etype==3)
									{
									if(count($array)==2)
										{
										$colval_etank=1;
										}
										else
										{
									$colval_etank=3;
										}
									}
									else if($n_etype==4)
									{
									if(count($array)==2)
										{
										$colval_etank=1;
										}
										else
										{
									$colval_etank=3;
										}
									}
						?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_engine)==1){?> colspan="<?php echo $nofmodel?>"<?php } else if($cnt_etype>1 && $cnt_etype==$n_etype && $n_etype<4) { ?> colspan="<?php echo $colval_etank;?>" <?php }?>><?php echo $titletype['field_spec_engine_type_value'];?></td>
						<?php
								$cnt_etype++;
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
							$cnt_displacement=1;
							$colval_displacement=0;
							//$res_displ=@mysqli_query("select DISTINCT(field_spec_engine_displacement_value) from field_data_field_spec_engine_displacement  where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
							$res_displ=@mysqli_query("select DISTINCT(field_spec_engine_displacement_value) from field_data_field_spec_engine_displacement  where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							$n_displace=@mysqli_num_rows($res_displ);
							while($titledisplace=mysqli_fetch_array($res_displ))
								{
								if($n_displace==2)
									{
									if(count($array)==2)
										{
										$colval_displacement=1;
										}
										else
										{
									$colval_displacement=3;
										}
									}
									else if($n_displace==3)
									{
									if(count($array)==2)
										{
										$colval_displacement=1;
										}
										else
										{
									$colval_displacement=3;
										}
									}
									else if($n_displace==4)
									{
									if(count($array)==2)
										{
										$colval_displacement=1;
										}
										else
										{
									$colval_displacement=3;
										}
									}
							?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_displ)==1){?> colspan="<?php echo $nofmodel?>"<?php } else if($cnt_displacement>1 && $cnt_displacement==$n_displace && $n_displace<4) { ?> colspan="<?php echo $colval_etank;?>" <?php }?>><?php echo $titledisplace['field_spec_engine_displacement_value']." cc";?></td>
							<?php
								$cnt_displacement++;
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
							$cnt_cylinder=1;
							$colval_cylinder=0;
							//$res_cylinder=@mysqli_query("select DISTINCT(field_spec_engine_cylinders_value) from field_data_field_spec_engine_cylinders where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
							$res_cylinder=@mysqli_query("select DISTINCT(field_spec_engine_cylinders_value) from field_data_field_spec_engine_cylinders where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							$n_cylinder=@mysqli_num_rows($res_cylinder);
							while($titlecylinder=@mysqli_fetch_array($res_cylinder))
								{
								if($n_cylinder==2)
									{
									if(count($array)==2)
										{
										$colval_cylinder=1;
										}
										else
										{
									$colval_cylinder=3;
										}
									}
									else if($n_cylinder==3)
									{
									if(count($array)==2)
										{
										$colval_cylinder=1;
										}
										else
										{
									$colval_cylinder=3;
										}
									}
									else if($n_cylinder==4)
									{
									if(count($array)==2)
										{
										$colval_cylinder=1;
										}
										else
										{
									$colval_cylinder=3;
										}
									}
							?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_cylinder)==1){?> colspan="<?php echo $nofmodel?>"<?php } else if($cnt_cylinder>1 && $cnt_cylinder==$n_cylinder && $n_cylinder<4) { ?> colspan="<?php echo $colval_cylinder;?>" <?php }?>><?php echo $titlecylinder['field_spec_engine_cylinders_value'];?></td>
							<?php
								$cnt_cylinder++;
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
							$cnt_valve=1;
							$colvalve=0;
							//$res_valve=@mysqli_query("select DISTINCT(field_spec_engine_valvetrain_value) from field_data_field_spec_engine_valvetrain where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
							$res_valve=@mysqli_query("select DISTINCT(field_spec_engine_valvetrain_value) from field_data_field_spec_engine_valvetrain where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							$n_valve=@mysqli_num_rows($res_valve);
								while($d_valve=@mysqli_fetch_array($res_valve))
									{
									if($n_valve==2)
									{
									if(count($array)==2)
										{
										$colvalve=1;
										}
										else
										{
									$colvalve=3;
										}
									}
									else if($n_valve==3)
									{
									if(count($array)==2)
										{
										$colvalve=1;
										}
										else
										{
									$colvalve=3;
										}
									}
									else if($n_valve==4)
									{
									if(count($array)==2)
										{
										$colvalve=1;
										}
										else
										{
									$colvalve=3;
										}
									}
							?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_valve)==1){?> colspan="<?php echo $nofmodel?>"<?php } else if($cnt_valve>1 && $cnt_valve==$n_valve && $n_valve<4) { ?> colspan="<?php echo $colvalve;?>" <?php }?>><?php echo $d_valve['field_spec_engine_valvetrain_value'];?></td>
							<?php
									$cnt_valve++;
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
							$cnt_bore=1;
							$colbore=0;
							//$bore_s_res=@mysqli_query("select DISTINCT(field_spec_engine_bore_value) from field_data_field_spec_engine_bore where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
							$bore_s_res=@mysqli_query("select DISTINCT(field_spec_engine_bore_value) from field_data_field_spec_engine_bore where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							$n_bands=@mysqli_num_rows($bore_s_res);
							while($d_bs=@mysqli_fetch_array($bore_s_res))
								{
								if($n_bands==2)
									{
									if(count($array)==2)
										{
										$colbore=1;
										}
										else
										{
									$colbore=3;
										}
									}
									else if($n_bands==3)
									{
									if(count($array)==2)
										{
										$colbore=1;
										}
										else
										{
									$colbore=3;
										}
									}
									else if($n_bands==4)
									{
									if(count($array)==2)
										{
										$colbore=1;
										}
										else
										{
									$colbore=3;
										}
									}
							?>
						<td class="aCenter"<?php if(mysqli_num_rows($bore_s_res)==1){?> colspan="<?php echo $nofmodel?>"<?php } else if($cnt_bore>1 && $cnt_bore==$n_bands && $n_bands<4) { ?> colspan="<?php echo $colbore;?>" <?php }?>><?php echo $d_bs['field_spec_engine_bore_value']." mm";?></td>
							<?php
									$cnt_bore++;
								}
							//}
							?>
						<!--  <td>97 x 91 mm</td>
						<td>84 x 101 mm</td>
						<td>84 x 109 mm</td>-->
					</tr>
					  <tr>
						<td>Compression ratio</td>
						<?php
							/*$Compression=@mysqli_query($q);
							while($Compression_data=mysqli_fetch_array($Compression))
							{*/
							$cnt_cratio=1;
							$colcratio=0;
							//$cratio_res=@mysqli_query("select DISTINCT(field_spec_engine_comp_ratio_value) from field_data_field_spec_engine_comp_ratio where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
							$cratio_res=@mysqli_query("select DISTINCT(field_spec_engine_comp_ratio_value) from field_data_field_spec_engine_comp_ratio where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							$n_cratio=@mysqli_num_rows($cratio_res);
							while($d_cratio=@mysqli_fetch_array($cratio_res))
								{
								if($n_cratio==2)
									{
									if(count($array)==2)
										{
										$colcratio=1;
										}
										else
										{
									$colcratio=3;
										}
									}
									else if($n_cratio==3)
									{
									if(count($array)==2)
										{
										$colcratio=1;
										}
										else
										{
									$colcratio=3;
										}
									}
									else if($n_cratio==4)
									{
									if(count($array)==2)
										{
										$colcratio=1;
										}
										else
										{
										$colcratio=3;
										}
									}
							?>
						<td class="aCenter"<?php if(@mysqli_num_rows($cratio_res)==1){?> colspan="<?php echo $nofmodel?>"<?php } else if($cnt_cratio>1 && $cnt_cratio==$n_cratio && $n_cratio<4) { ?> colspan="<?php echo $colcratio;?>" <?php }?>><?php echo $d_cratio['field_spec_engine_comp_ratio_value'];?></td>
							<?php
								$cnt_cratio++;
								}
							?>
					
					</tr>
					<tr>
						<td>Max Power</td>
							<?php
							/*$maxpower=@mysqli_query($q);
							while($maxpower_data=mysqli_fetch_array($maxpower))
							{
							$title=mysqli_fetch_array(mysqli_query("select field_spec_engine_power_value from field_data_field_spec_engine_power where entity_id=".$maxpower_data['entity_id']));*/
							$cnt_mpower=1;
							$colmpower=0;
							//$res_mxpower=mysqli_query("select DISTINCT(field_spec_engine_power_value) from field_data_field_spec_engine_power where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
							$res_mxpower=mysqli_query("select DISTINCT(field_spec_engine_power_value) from field_data_field_spec_engine_power where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							$n_mxpower=@mysqli_num_rows($res_mxpower);
							while($d_mpower=mysqli_fetch_array($res_mxpower))
								{
								if($n_mxpower==2)
									{
									if(count($array)==2)
										{
										$colmpower=1;
										}
										else
										{
									$colmpower=3;
										}
									}
									else if($n_mxpower==3)
									{
									if(count($array)==2)
										{
										$colmpower=1;
										}
										else
										{
									$colmpower=3;
										}
									}
									else if($n_mxpower==4)
									{
									if(count($array)==2)
										{
										$colmpower=1;
										}
										else
										{
									$colmpower=3;
										}
									}
							?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_mxpower)==1){?> colspan="<?php echo $nofmodel?>"<?php } else if($cnt_mpower>1 && $cnt_mpower==$n_mxpower && $n_mxpower<4) { ?> colspan="<?php echo $colmpower;?>" <?php }?>><?php echo $d_mpower['field_spec_engine_power_value'];?></td>
						<?php
								$cnt_mpower++;
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
							$cnt_torque=1;
							$coltorque=0;
							//$res_mtorq=mysqli_query("select DISTINCT(field_spec_engine_torque_value) from field_data_field_spec_engine_torque where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
							$res_mtorq=mysqli_query("select DISTINCT(field_spec_engine_torque_value) from field_data_field_spec_engine_torque where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							$n_torque=@mysqli_num_rows($res_mtorq);
							while($d_mtorq=mysqli_fetch_array($res_mtorq))
								{
								if($n_torque==2)
									{
									if(count($array)==2)
										{
										$coltorque=1;
										}
										else
										{
									$coltorque=3;
										}
									}
									else if($n_torque==3)
									{
									if(count($array)==2)
										{
										$coltorque=1;
										}
										else
										{
									$coltorque=3;
										}
									}
									else if($n_torque==4)
									{
									if(count($array)==2)
										{
										$coltorque=1;
										}
										else
										{
									$coltorque=3;
										}
									}
							?>
						 <td class="aCenter"<?php if(mysqli_num_rows($res_mtorq)==1){?> colspan="<?php echo $nofmodel?>"<?php } else if($cnt_torque>1 && $cnt_torque==$n_torque && $n_torque<4) { ?> colspan="<?php echo $coltorque;?>" <?php }?>><?php echo $d_mtorq['field_spec_engine_torque_value'];?></td>
						 <?php
						 		$cnt_torque++;
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
							$cnt_ptwr=1;
							$colptwr=0;
							//$res_ptwr=mysqli_query("select DISTINCT(field_spec_engine_power_weight_value) from field_data_field_spec_engine_power_weight where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
							$res_ptwr=mysqli_query("select DISTINCT(field_spec_engine_power_weight_value) from field_data_field_spec_engine_power_weight where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							$n_ptwr=@mysqli_num_rows($res_ptwr);
							while($d_ptwr=mysqli_fetch_array($res_ptwr))
									{
								if($n_ptwr==2)
									{
									if(count($array)==2)
										{
										$colptwr=1;
										}
										else
										{
									$colptwr=3;
										}
									}
									else if($n_ptwr==3)
									{
									if(count($array)==2)
										{
										$colptwr=1;
										}
										else
										{
									$colptwr=3;
										}
									}
									else if($n_ptwr==4)
									{
									if(count($array)==2)
										{
										$colptwr=1;
										}
										else
										{
									$colptwr=3;
										}
									}
							?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_ptwr)==1){?> colspan="<?php echo $nofmodel?>"<?php } else if($cnt_ptwr>1 && $cnt_ptwr==$n_ptwr && $n_ptwr<4) { ?> colspan="<?php echo $colptwr;?>" <?php }?>><?php echo $d_ptwr['field_spec_engine_power_weight_value']." BHP/tonne";?></td>
						 <?php
						 			$cnt_ptwr++;
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
							$cnt_tt_wr=1;
							$coltt_wr=0;
							//$res_ttwr=mysqli_query("select DISTINCT(field_spec_engine_torque_weight_value) from field_data_field_spec_engine_torque_weight where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
							$res_ttwr=mysqli_query("select DISTINCT(field_spec_engine_torque_weight_value) from field_data_field_spec_engine_torque_weight where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							$n_ttwr=@mysqli_num_rows($res_ttwr);
							while($d_ttwr=@mysqli_fetch_array($res_ttwr))
								{
								if($n_ttwr==2)
									{
									if(count($array)==2)
										{
										$coltt_wr=1;
										}
										else
										{
									$coltt_wr=3;
										}
									}
									else if($n_ttwr==3)
									{
									if(count($array)==2)
										{
										$coltt_wr=1;
										}
										else
										{
									$coltt_wr=3;
										}
									}
									else if($n_ttwr==4)
									{
									if(count($array)==2)
										{
										$coltt_wr=1;
										}
										else
										{
									$coltt_wr=3;
										}
									}
							?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_ttwr)==1){?> colspan="<?php echo $nofmodel?>"<?php } else if($cnt_tt_wr>1 && $cnt_tt_wr==$n_ttwr && $n_ttwr<4) { ?> colspan="<?php echo $coltt_wr;?>" <?php }?>><?php echo $d_ttwr['field_spec_engine_torque_weight_value']." Nm/tonne"?></td>
						 <?php
						 		$cnt_tt_wr++;
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
							$cnt_bhpliture=1;
							$col_bhpliture=0;
							//$res_bhp_liter=mysqli_query("select DISTINCT(field_spec_engine_bhp_value) from field_data_field_spec_engine_bhp where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
							$res_bhp_liter=mysqli_query("select DISTINCT(field_spec_engine_bhp_value) from field_data_field_spec_engine_bhp where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							$n_bhpliture=@mysqli_num_rows($res_bhp_liter);
							while($d_bhp_liter=@mysqli_fetch_array($res_bhp_liter))
								{
								if($n_bhpliture==2)
									{
									if(count($array)==2)
										{
										$col_bhpliture=1;
										}
										else
										{
									$col_bhpliture=3;
										}
									}
									else if($n_bhpliture==3)
									{
									if(count($array)==2)
										{
										$col_bhpliture=1;
										}
										else
										{
									$col_bhpliture=3;
										}
									}
									else if($n_bhpliture==4)
									{
									if(count($array)==2)
										{
										$col_bhpliture=1;
										}
										else
										{
									$col_bhpliture=3;
										}
									}
							?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_bhp_liter)==1){?> colspan="<?php echo $nofmodel?>"<?php } else if($cnt_bhpliture>1 && $cnt_bhpliture==$n_bhpliture && $n_bhpliture<4) { ?> colspan="<?php echo $col_bhpliture;?>" <?php } ?>><?php echo $d_bhp_liter['field_spec_engine_bhp_value'];?></td>
						 <?php
						 		$cnt_bhpliture++;
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
							$cnt_Drivetrain=1;
							$col_Drivetrain=0;
							//$res_drivetrain=@mysqli_query("select DISTINCT(field_spec_engine_drivetrain_value) from field_data_field_spec_engine_drivetrain where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
							$res_drivetrain=@mysqli_query("select DISTINCT(field_spec_engine_drivetrain_value) from field_data_field_spec_engine_drivetrain where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							$n_Drivetrain=@mysqli_num_rows($res_drivetrain);
							while($d_dvt=mysqli_fetch_array($res_drivetrain))
								{
								if($n_Drivetrain==2)
									{
									if(count($array)==2)
										{
										$col_Drivetrain=1;
										}
										else
										{
									$col_Drivetrain=3;
										}
									}
									else if($n_Drivetrain==3)
									{
									if(count($array)==2)
										{
										$col_Drivetrain=1;
										}
										else
										{
									$col_Drivetrain=3;
										}
									}
									else if($n_Drivetrain==4)
									{
									if(count($array)==2)
										{
										$col_Drivetrain=1;
										}
										else
										{
									$col_Drivetrain=3;
										}
									}
							?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_drivetrain)==1){?> colspan="<?php echo $nofmodel?>"<?php } else if($cnt_Drivetrain>1 && $cnt_Drivetrain==$n_Drivetrain && $n_Drivetrain<4) { ?> colspan="<?php echo $col_Drivetrain;?>" <?php } ?>><?php echo $d_dvt['field_spec_engine_drivetrain_value'];?></td>
							 <?php
							 	$cnt_Drivetrain++;
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
							$cnt_Transmission=1;
							$col_Transmission=0;
							//$res_transmission=@mysqli_query("select DISTINCT(field_spec_engine_transmission_value) from field_data_field_spec_engine_transmission where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
							$res_transmission=@mysqli_query("select DISTINCT(field_spec_engine_transmission_value) from field_data_field_spec_engine_transmission where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							$n_transmission=@mysqli_num_rows($res_transmission);
							while($d_trans=mysqli_fetch_array($res_transmission))
								{
								if($n_transmission==2)
									{
									if(count($array)==2)
										{
										$col_Transmission=1;
										}
										else
										{
									$col_Transmission=3;
										}
									}
									else if($n_transmission==3)
									{
									if(count($array)==2)
										{
										$col_Transmission=1;
										}
										else
										{
										$col_Transmission=3;
										}
									}
									else if($n_transmission==4)
									{
									if(count($array)==2)
										{
										$col_Transmission=1;
										}
										else
										{
										$col_Transmission=3;
										}
									}
							?>
							<td class="aCenter"<?php if(mysqli_num_rows($res_transmission)==1){?> colspan="<?php echo $nofmodel?>"<?php } else if($cnt_Transmission>1 && $cnt_Transmission==$n_transmission && $n_transmission<4) { ?> colspan="<?php echo $col_Transmission;?>" <?php } ?>><?php echo $d_trans['field_spec_engine_transmission_value'];?></td>
							 <?php
							 		$cnt_Transmission++;
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
							$cnt_intervals=1;
							$col_intervals=0;
							//$res_serv_i=@mysqli_query("select DISTINCT(field_spec_engine_service_value) from field_data_field_spec_engine_service where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
							$res_serv_i=@mysqli_query("select DISTINCT(field_spec_engine_service_value) from field_data_field_spec_engine_service where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							$n_serv_i=@mysqli_num_rows($res_serv_i);
							while($d_trans=mysqli_fetch_array($res_serv_i))
								{
								if($n_serv_i==2)
									{
									if(count($array)==2)
										{
										$col_intervals=1;
										}
										else
										{
									$col_intervals=3;
										}
									}
									else if($n_serv_i==3)
									{
									if(count($array)==2)
										{
										$col_intervals=1;
										}
										else
										{
										$col_intervals=3;
										}
									}
									else if($n_serv_i==4)
									{
									if(count($array)==2)
										{
										$col_intervals=1;
										}
										else
										{
										$col_intervals=3;
										}
									}
							?>
							<td class="aCenter"<?php if(mysqli_num_rows($res_serv_i)==1){?> colspan="<?php echo $nofmodel?>"<?php } else if($cnt_intervals>1 && $cnt_intervals==$n_serv_i && $n_serv_i<4) { ?> colspan="<?php echo $col_intervals;?>" <?php } ?>><?php echo $d_trans['field_spec_engine_service_value']." kms";?></td>
							 <?php
							 	$cnt_intervals++;
							 	}
							//}
							?>
					</tr>
				</table><!-- speciTable -->
					
				<!-- <table class="speciTable<?php if($nofmodel==1){?> flexColum<?php }  else if($nofmodel==2){?> flexColum flexColum2<?php } else if($nofmodel==3){?> flexColum flexColum3<?php } else if($nofmodel==4){?> flexColum flexColum4<?php } ?>">-->
				<table class="speciTable">
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
							$cnt_st_type=1;
							$col_st_type=0;
							//$res_st_type=@mysqli_query("select DISTINCT(field_spec_steering_value) from field_data_field_spec_steering where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
							$res_st_type=@mysqli_query("select DISTINCT(field_spec_steering_value) from field_data_field_spec_steering where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							$n_st_type=@mysqli_num_rows($res_st_type);
							while($d_stype=@mysqli_fetch_array($res_st_type))
								{
							if($n_st_type==2)
									{
									if(count($array)==2)
										{
										$col_st_type=1;
										}
										else
										{
									$col_st_type=3;
										}
									}
									else if($n_st_type==3)
									{
									if(count($array)==2)
										{
										$col_st_type=1;
										}
										else
										{
										$col_st_type=3;
										}
									}
									else if($n_st_type==4)
									{
									if(count($array)==2)
										{
										$col_st_type=1;
										}
										else
										{
										$col_st_type=3;
										}
									}
							?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_st_type)==1){?> colspan="<?php echo $nofmodel?>"<?php } else if($cnt_st_type>1 && $cnt_st_type==$n_st_type && $n_st_type<4) { ?> colspan="<?php echo $col_st_type;?>" <?php } ?>><?php echo $d_stype['field_spec_steering_value'];?></td>
							<?php
									$cnt_st_type++;
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
							$cnt_suspension=1;
							$col_suspension=0;
							//$res_fsus=@mysqli_query("select DISTINCT(field_spec_front_value) from field_data_field_spec_front where entity_id in (".substr($entyti_id,0,-1).")  group by entity_id order by entity_id desc");
							$res_fsus=@mysqli_query("select DISTINCT(field_spec_front_value) from field_data_field_spec_front where entity_id in (".substr($entyti_id,0,-1).")  group by entity_id order by entity_id");
							$n_suspension=@mysqli_num_rows($res_fsus);
							while($d_fsus=@mysqli_fetch_array($res_fsus))
								{
								if($n_suspension==2)
									{
									if(count($array)==2)
										{
										$col_suspension=1;
										}
										else
										{
									$col_suspension=3;
										}
									}
									else if($n_suspension==3)
									{
									if(count($array)==2)
										{
										$col_suspension=1;
										}
										else
										{
										$col_suspension=3;
										}
									}
									else if($n_suspension==4)
									{
									if(count($array)==2)
										{
										$col_suspension=1;
										}
										else
										{
										$col_suspension=3;
										}
									}
							?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_fsus)==1){?> colspan="<?php echo $nofmodel?>"<?php } else if($cnt_suspension>1 && $cnt_suspension==$n_suspension && $n_suspension<4) { ?> colspan="<?php echo $col_suspension;?>" <?php } ?>><?php echo $d_fsus['field_spec_front_value'];?></td>
							<?php
								$cnt_suspension++;
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
							$cnt_rearsuspension=1;
							$col_rearsuspension=0;
							//$res_rearsus=@mysqli_query("select DISTINCT(field_spec_rear_value) from field_data_field_spec_rear where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
							$res_rearsus=@mysqli_query("select DISTINCT(field_spec_rear_value) from field_data_field_spec_rear where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							$n_rearsus=@mysqli_num_rows($res_rearsus);
							while($d_rear_sus=@mysqli_fetch_array($res_rearsus))
								{
								if($n_rearsus==2)
									{
									if(count($array)==2)
										{
										$col_rearsuspension=1;
										}
										else
										{
										$col_rearsuspension=3;
										}
									}
									else if($n_rearsus==3)
									{
									if(count($array)==2)
										{
										$col_rearsuspension=1;
										}
										else
										{
										$col_rearsuspension=3;
										}
									}
									else if($n_rearsus==4)
									{
									if(count($array)==2)
										{
										$col_rearsuspension=1;
										}
										else
										{
										$col_rearsuspension=3;
										}
									}
							?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_rearsus)==1){?> colspan="<?php echo $nofmodel?>"<?php } else if($cnt_rearsuspension>1 && $cnt_rearsuspension==$n_rearsus && $n_rearsus<4) { ?> colspan="<?php echo $col_rearsuspension;?>" <?php } ?>><?php echo $d_rear_sus['field_spec_rear_value'];?></td>
							<?php
									$cnt_rearsuspension++;
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
							$cnt_tyre_size=1;
							$col_tyre_size=0;
							//$res_tyre_size=@mysqli_query("select field_spec_tyre_value,entity_id from field_data_field_spec_tyre where entity_id in (".substr($entyti_id,0,-1).") group by field_spec_tyre_value order by entity_id desc");
							$res_tyre_size=@mysqli_query("select field_spec_tyre_value,entity_id from field_data_field_spec_tyre where entity_id in (".substr($entyti_id,0,-1).") group by field_spec_tyre_value order by entity_id");
							$n_tyre_size=@mysqli_num_rows($res_tyre_size);
							while($d_tyre_size=@mysqli_fetch_array($res_tyre_size))
								{
								$sql_tyre_caption=@mysql_fetch_assoc(mysqli_query("select field_tyre_size_caption_value from field_data_field_tyre_size_caption where entity_id =".$d_tyre_size['entity_id']." group by entity_id order by entity_id"));
								if($n_tyre_size==2)
									{
									if(count($array)==2)
										{
										$col_tyre_size=1;
										}
										else
										{
										$col_tyre_size=3;
										}
									}
									else if($n_tyre_size==3)
									{
									if(count($array)==2)
										{
										$col_tyre_size=1;
										}
										else
										{
										$col_tyre_size=3;
										}
									}
									else if($n_tyre_size==4)
									{
									if(count($array)==2)
										{
										$col_tyre_size=1;
										}
										else
										{
										$col_tyre_size=3;
										}
									}
						?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_tyre_size)==1){?> colspan="<?php echo $nofmodel?>"<?php } else if($cnt_tyre_size>1 && $cnt_tyre_size==$n_tyre_size && $n_tyre_size<4) { ?> colspan="<?php echo $col_rearsuspension;?>" <?php } ?>>
							<?php echo $d_tyre_size['field_spec_tyre_value'];?>
							<?php
								if($sql_tyre_caption!='')
									{
							?>
					    	<a href="#" class="infoIcon">&nbsp;
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
									$cnt_tyre_size++;
								}
								//}
							?>
					
					</tr>
					<tr>
						<td>Brakes : Front / Rear</td>
						<?php
							/*$break_value=@mysqli_query($q);
							while($break_data=@mysqli_fetch_array($break_value))
								{
						$titlebreak=@mysqli_fetch_array(mysqli_query("select field_spec_brakes_value from field_data_field_spec_brakes where entity_id =".$break_data['entity_id']." and bundle='specifications'"));*/
						$cnt_brake_front_rear=1;
						$col_brake_front_rear=0;
						//$res_break=@mysqli_query("select DISTINCT(field_spec_brakes_value),entity_id from field_data_field_spec_brakes where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
						$res_break=@mysqli_query("select DISTINCT(field_spec_brakes_value),entity_id from field_data_field_spec_brakes where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
						$n_brake_front_rear=@mysqli_num_rows($res_break);
						while($d_bfr=mysqli_fetch_array($res_break))
							{
							if($n_brake_front_rear==2)
									{
									if(count($array)==2)
										{
										$col_brake_front_rear=1;
										}
										else
										{
										$col_brake_front_rear=3;
										}
									}
									else if($n_brake_front_rear==3)
									{
									if(count($array)==2)
										{
										$col_brake_front_rear=1;
										}
										else
										{
										$col_brake_front_rear=3;
										}
									}
									else if($n_brake_front_rear==4)
									{
									if(count($array)==2)
										{
										$col_brake_front_rear=1;
										}
										else
										{
										$col_brake_front_rear=3;
										}
									}
								$brakes_front_info=@mysqli_fetch_array(mysqli_query("select field_brakes_info_value from field_data_field_brakes_info where entity_id =".$d_bfr['entity_id']));
						?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_break)==1){?> colspan="<?php echo $nofmodel?>"<?php } else if($cnt_brake_front_rear>1 && $cnt_brake_front_rear==$n_brake_front_rear && $n_brake_front_rear<4) { ?> colspan="<?php echo $col_brake_front_rear;?>" <?php } ?>><?php echo $d_bfr['field_spec_brakes_value'];?>
						 <?php
							if($brakes_front_info!='')
								{
						 ?>
							<a href="#" class="infoIcon">&nbsp;
								<div class="infoBox">
								<span></span>
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
							$cnt_brake_front_rear++;
							}
								//}
						?>
					</tr>
				</table><!-- speciTable -->
				
				<!-- <table class="speciTable<?php if($nofmodel==1){?> flexColum<?php }  else if($nofmodel==2){?> flexColum flexColum2<?php } else if($nofmodel==3){?> flexColum flexColum3<?php } else if($nofmodel==4){?> flexColum flexColum4<?php } ?>"> -->
				<table class="speciTable">
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
							$cnt_city=1;
							$col_city=0;
							//$res_city=mysqli_query("select DISTINCT(field_spec_fuel_city_value) from field_data_field_spec_fuel_city where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
							$res_city=mysqli_query("select DISTINCT(field_spec_fuel_city_value) from field_data_field_spec_fuel_city where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							$n_city=@mysqli_num_rows($res_city);
							while($d_city=mysqli_fetch_array($res_city))
								{
								if($n_city==2)
									{
									if(count($array)==2)
										{
										$col_city=1;
										}
										else
										{
										$col_city=3;
										}
									}
									else if($n_city==3)
									{
									if(count($array)==2)
										{
										$col_city=1;
										}
										else
										{
										$col_city=3;
										}
									}
									else if($n_city==4)
									{
									if(count($array)==2)
										{
										$col_city=1;
										}
										else
										{
										$col_city=3;
										}
									}
						?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_city)==1){?> colspan="<?php echo $nofmodel?>"<?php } else if($cnt_city>1 && $cnt_city==$n_city && $n_city<4) { ?> colspan="<?php echo $col_city;?>" <?php } ?>><?php echo $d_city['field_spec_fuel_city_value']." kpl";?></td>
						<?php
								$cnt_city++;
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
						$cnt_highway=1;
						$col_highway=0;
						$res_highway=@mysqli_query("select DISTINCT(field_spec_fuel_highway_value) from field_data_field_spec_fuel_highway where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
						$n_highway=@mysqli_num_rows($res_highway);
						while($d_highway=@mysqli_fetch_array($res_highway))
								{
								if($n_highway==2)
									{
									if(count($array)==2)
										{
										$n_highway=1;
										}
										else
										{
										$col_highway=3;
										}
									}
									else if($n_highway==3)
									{
									if(count($array)==2)
										{
										$col_highway=1;
										}
										else
										{
										$col_highway=3;
										}
									}
									else if($n_highway==4)
									{
									if(count($array)==2)
										{
										$col_highway=1;
										}
										else
										{
										$col_highway=3;
										}
									}
						?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_highway)==1){?> colspan="<?php echo $nofmodel?>"<?php } else if($cnt_highway>1 && $cnt_highway==$n_highway && $n_highway<4) { ?> colspan="<?php echo $col_highway;?>" <?php } ?>><?php echo $d_highway['field_spec_fuel_highway_value']." kpl";?></td>
						<?php
								$cnt_highway++;
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
							$cnt_api_rating=1;
							$col_api_rating=0;
							//$res_apirating=@mysqli_query("select DISTINCT(field_spec_fuel_arai_value) from field_data_field_spec_fuel_arai where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
							$res_apirating=@mysqli_query("select DISTINCT(field_spec_fuel_arai_value) from field_data_field_spec_fuel_arai where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
							$n_apirating=@mysqli_num_rows($res_apirating);
							while($d_apirating=@mysqli_fetch_array($res_apirating))
								{
								if($n_apirating==2)
									{
									if(count($array)==2)
										{
										$col_api_rating=1;
										}
										else
										{
										$col_api_rating=3;
										}
									}
									else if($n_apirating==3)
									{
									if(count($array)==2)
										{
										$col_api_rating=1;
										}
										else
										{
										$col_api_rating=3;
										}
									}
									else if($n_apirating==4)
									{
									if(count($array)==2)
										{
										$col_api_rating=1;
										}
										else
										{
										$col_api_rating=3;
										}
									}
						?>
						<td class="aCenter"<?php if(mysqli_num_rows($res_apirating)==1){?> colspan="<?php echo $nofmodel?>"<?php } else if($cnt_api_rating>1 && $cnt_api_rating==$n_apirating && $n_apirating<4) { ?> colspan="<?php echo $col_api_rating;?>" <?php } ?>><?php echo $d_apirating['field_spec_fuel_arai_value']." kpl";?></td>
						<?php
								$cnt_api_rating++;
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
			<!--<a class="compareClose" id="compareBtn" href="#" onclick="return false;">&nbsp;</a>-->
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
		$mktitle=@mysqli_fetch_array(mysqli_query("select title from node,field_data_field_nr_make where field_data_field_nr_make.entity_id =".$model_id['field_nr_make_model_nid']." and field_data_field_nr_make.field_nr_make_nid=node.nid"));
												
		?>
				<div class="compareMesgInside"><p class="compareMesgPad roundAll5">You have already added that car. Please choose another car.</p></div>
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
