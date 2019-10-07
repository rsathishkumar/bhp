<?php
$sql_model=@mysqli_query("SELECT * FROM `field_data_field_nr_make_model`,node WHERE field_data_field_nr_make_model.entity_id = node.nid AND node.status =1 and field_data_field_nr_make_model.entity_id=".$node->field_spec_nr_engine_type['und'][0]['nid']);
$num=@mysqli_num_rows($sql_model);
// $midforavailablewith = '';	
	if($num>0)
	{
		$mid='';
		$model_id=mysqli_fetch_array($sql_model);
	// echo "select entity_id from field_data_field_nr_make_model,node where field_data_field_nr_make_model.field_nr_make_model_nid = node.nid and node.status=1 and field_data_field_nr_make_model.field_nr_make_model_nid=".$model_id['field_nr_make_model_nid'];
		$sql_m=mysqli_query("select entity_id,field_nr_make_model_nid from field_data_field_nr_make_model,node where field_data_field_nr_make_model.field_nr_make_model_nid = node.nid and node.status=1 and field_data_field_nr_make_model.field_nr_make_model_nid=".$model_id['field_nr_make_model_nid']);
		while($d_m=mysqli_fetch_array($sql_m))
		{
			$mid.=$d_m['entity_id'].", ";
			$midforavailablewith.=$d_m['field_nr_make_model_nid'].",";
		}
		/* $midforavailablewith = explode(",",$midforavailablewith);
		$cnverttostrforavailblwith = implode(",",array_unique($midforavailablewith)); */
	}
		// $cnverttostrforavailblwith;
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
$q_mwithe="select field_spec_nr_engine_type_nid,entity_id from field_data_field_spec_nr_engine_type where field_spec_nr_engine_type_nid in (".substr($mid,0,-2)." ) and bundle='specifications' order by entity_id desc limit 0,5";
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
			
			$(window).scroll(function() {
			   var p = $("head");
			   var position = p.position();
			   if (position.top>"605" && position.top<"1735"){
			       $("#tableHead").addClass("pFixHead");
			       return false;
			   }else {
			       $("#tableHead").removeClass("pFixHead");
			       return false;
			   }
			});
			
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
				<li><a href="/<?php echo $sql_aliasforphotos['alias'];?>" class="TLR5" title="Photos">Photos</a></li>
			<?php
			}
			?>
				<li><a href="<?php echo url("node/".$node->nid);?>" class="TLR5 active" title="Specifications">Specifications</a></li>
			<?php
			if($sql_urlforfeaturedata!='')
			{
			?>
				<li><a href="/<?php echo $sql_urlforfeaturedata['alias'];?>" class="TLR5" title="Features">Features</a></li>
			<?php
			}
			if($forum_review_alias!='')
			{
			?>
				<li><a href="<?php echo "/?q=forum-reviews&modelname=".strtolower($model_title['title']);//$forum_review_alias['alias'];?>" class="TLR5" title="Forum Reviews">Forum Reviews</a></li>
			<?php
			}
			if($sql_urlforpricedata!='')
			{
			?>
				<li><a href="/<?php echo $sql_urlforpricedata['alias'];?>" class="TLR5" title="Price">Price</a></li>		
			<?php
			}
			?>														
		</ul>
		
		<div class="Overview marB10">
			<div class="carOverview marB20 BLR5">
				<div class="clearfix marB10">
					<div class="fleft w480">
						<h1><?php echo /*$make_res['title']." ".*/$model_title['title'];?> <span>Specifications</span></h1>
					</div>
					<?php include ("themes/mobilebhp/includes/common/share.php") ?>
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
							// commented as on 12-04-2012 $sql_modelengine=@mysqli_query("select node.title,field_data_field_nr_make_model.entity_id,field_data_field_nr_make_model.field_nr_make_model_nid from node,field_data_field_nr_make_model where field_data_field_nr_make_model.entity_id=node.nid and node.status=1 and field_data_field_nr_make_model.entity_id in (".substr($mid,0,-2).") group by field_data_field_nr_make_model.entity_id");
							$sql_modelengine=@mysqli_query("select field_model_available_value from node,field_data_field_model_available where field_data_field_model_available.entity_id=node.nid and node.status=1 and field_data_field_model_available.entity_id in (".$model_id['field_nr_make_model_nid'].")");
							//echo "select field_model_available_value from node,field_data_field_model_available where field_data_field_model_available.entity_id=node.nid and node.status=1 and field_data_field_model_available.entity_id in (".$model_id['field_nr_make_model_nid'].")";
							
								while($engine_data=@mysqli_fetch_array($sql_modelengine))
								{
								//$engine_title=mysqli_fetch_array(mysqli_query("select title from node where nid=".$engine_data['field_spec_nr_engine_type_nid']));
							?>
								<!-- <li><?php echo $engine_data['title'];?></li> -->
								<li><?php echo $engine_data['field_model_available_value'];?></li>
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
						<a href="/sites/default/files/<?php echo str_replace("public://","",$sql_brochure['uri']);?>" class="btnLeft downloadBtn"><span>Download Brochure</span></a>
						<?php
						}
						?>
					</div><!-- w380 -->
						<?php
						}
						if($mid!='')
						{
							$qry_engine=@mysqli_query("select node.title,field_data_field_nr_make_model.entity_id,field_data_field_nr_make_model.field_nr_make_model_nid from node,field_data_field_nr_make_model where field_data_field_nr_make_model.entity_id=node.nid and node.status=1 and field_data_field_nr_make_model.entity_id in (".substr($mid,0,-2).") group by field_data_field_nr_make_model.entity_id");
						}
						$res_lwh=@mysqli_query("select field_spec_length_value from field_data_field_spec_length where entity_id in (".substr($entyti_id,0,-1).") order by entity_id");
					?>
					<div class="carWireframe">
						<img src="/sites/default/files/<?php echo str_replace("public://","",$sql_line_image['uri']);?>" width="550" height="230" alt="<?php echo $data_model['title'];?>"/>
					</div><!-- w490 -->
				
				</div><!-- clearfix -->
			</div><!-- car over view -->
			<div class="reviewbar speciTableCol<?php echo @mysqli_num_rows($res_lwh); ?> roundAll5 clearfix"><!-- car Review -->
				<?php
				if($mid!='')
				{
					$colspan = 1;
					$Cspn = 0;
					if(@mysqli_num_rows($qry_engine)<@mysqli_num_rows($res_lwh))
					{
						$Cspn = mysqli_num_rows($res_lwh) - mysqli_num_rows($qry_engine);
					}
				?>
				<div class="tableHeadWrap">
					<table id="tableHead" class="speciTable">
						<thead>
							<tr>
								<th>&nbsp;</th>
								<?php
									while($data_engine=mysqli_fetch_array($qry_engine))
									{
									/*for($j=0;$j<count($array_mid);$j++)
										{
										$data_engine=@mysqli_fetch_array(mysqli_query("select node.title,field_data_field_nr_make_model.entity_id,field_data_field_nr_make_model.field_nr_make_model_nid from node,field_data_field_nr_make_model where field_data_field_nr_make_model.entity_id=node.nid and node.status=1 and field_data_field_nr_make_model.entity_id =".$array_mid[$j]." group by field_data_field_nr_make_model.entity_id"));
									//echo "select node.title,field_data_field_nr_make_model.entity_id,field_data_field_nr_make_model.field_nr_make_model_nid from node,field_data_field_nr_make_model where field_data_field_nr_make_model.entity_id=node.nid and node.status=1 and field_data_field_nr_make_model.entity_id =".$array_mid[$j]." group by field_data_field_nr_make_model.entity_id";*/
										?>
								<th<?php if($colspan==mysqli_num_rows($qry_engine)){ echo " colspan='".$Cspn."'" ;}?>><?php echo $data_engine['title'];?></th>
								<?php
										//}
										$colspan++;
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
				$q="SELECT field_spec_nr_engine_type_nid, entity_id FROM field_data_field_spec_nr_engine_type, node WHERE field_spec_nr_engine_type_nid in (".substr($mid,0,-2).") AND field_data_field_spec_nr_engine_type.bundle = 'specifications' AND field_data_field_spec_nr_engine_type.entity_id = node.nid AND node.status =1 limit 0,5";
				$e=@mysqli_query($q);
				$n=@mysqli_num_rows($e);
				if($n>0)
					{
				?>
				<!-- <table class="speciTable<?php if($nofmodel==1){?> flexColum<?php }  else if($nofmodel==2){?> flexColum flexColum2<?php } else if($nofmodel==3){?> flexColum flexColum3<?php } else if($nofmodel==4){?> flexColum flexColum4<?php } ?>"> -->
				<table class="speciTable">
					<thead>
						<tr>
							<th colspan="<?php echo @mysqli_num_rows($res_lwh)+1; ?>">DIMENSIONS</th>
						</tr>	
					</thead>
					<!-- <tr><td class="blankTr"></td><td class="blankTr"></td><td class="blankTr"></td><td class="blankTr"></td></tr>	-->
					<tr>
						<td>Length   X   Width   X   Height</td>
							<?php
							//$dimens=@mysqli_query($q);
							//while($d_spc_length=@mysqli_fetch_array($dimens))
								//{
								$ct=1;
							//$res_lwh=mysqli_query("select DISTINCT(field_spec_length_value) from field_data_field_spec_length  where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
							/*$res_lwh=mysqli_query("select DISTINCT(field_spec_length_value) from field_data_field_spec_length  where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id");
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
								}*/
							
							$start = 1;
							$cols = 0;
							while($dimensionvalvalue=mysqli_fetch_array($res_lwh))
							{
								if($start==1)
								{
									$current = $dimensionvalvalue['field_spec_length_value'];
									$start = 0;
								}
								else
								{
									$prev = $current;
									$current = $dimensionvalvalue['field_spec_length_value'];
									if($prev!=$current)
									{
										if($cols>1)
										{
											$lengthVal .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$prev." mm</td>";
										}
										else
										{
											$lengthVal .= "<td class=\"aCenter\">".$prev." mm</td>";
										}
										$cols = 0;
									}
								}
								$cols++;
							}
							if($cols>1)
							{
								$lengthVal .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$current." mm</td>";
							}
							else
							{
								$lengthVal .= "<td class=\"aCenter\">".$current." mm</td>";
							}
							echo $lengthVal;
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
							$res_wb=mysqli_query("select field_spec_wheel_value from field_data_field_spec_wheel  where entity_id in (".substr($entyti_id,0,-1).") order by entity_id");
							$nofwb=@mysqli_num_rows($res_wb);
							$start = 1;
							$cols = 0;
							while($wbvalue=@mysqli_fetch_array($res_wb))
								{
								if($start==1)
										{
										 	$current = $wbvalue['field_spec_wheel_value'];
											$start = 0;
										}
										else
										{
											$prev = $current;
											$current = $wbvalue['field_spec_wheel_value'];
											if($prev!=$current)
												{
													if($cols>1)
													{
														$WheelbaseVal .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$prev." mm</td>";
													}
													else
													{
														$WheelbaseVal .= "<td class=\"aCenter\">".$prev." mm</td>";
													}
													$cols = 0;
												}
										}
											$cols++;
								}
							if($cols>1)
							{
								$WheelbaseVal .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$current." mm</td>";
							}
							else
							{
								$WheelbaseVal .= "<td class=\"aCenter\">".$current." mm</td>";
							}
							echo $WheelbaseVal;
							?>
					</tr>
					<tr>
						<td>Track : Front / Rear</td>
							<?php
							//$track_frontrear=@mysqli_query($q);
							//while($frontrear_data=mysqli_fetch_array($track_frontrear))
							//{
							//$res_tfr=@mysqli_query("select DISTINCT(field_spec_track_value) from field_data_field_spec_track  where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
							$res_tfr=@mysqli_query("select field_spec_track_value from field_data_field_spec_track  where entity_id in (".substr($entyti_id,0,-1).") order by entity_id");
							$numb_tfr=mysqli_num_rows($res_tfr);
							$start = 1;
							$cols = 0;
							while($frvalue=@mysqli_fetch_array($res_tfr))
							{
									if($start==1)
									{
										$current = $frvalue['field_spec_track_value'];
										$start = 0;
									}
									else
									{
										$prev = $current;
										$current = $frvalue['field_spec_track_value'];
										if($prev!=$current)
											{
												if($cols>1)
												{
													$FrontVal .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$prev." mm</td>";
												}
												else
												{
													$FrontVal .= "<td class=\"aCenter\">".$prev." mm</td>";
												}
												$cols = 0;
											}
									}
								$cols++;
							}
							if($cols>1)
							{
								$FrontVal .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$current." mm</td>";
							}
							else
							{
								$FrontVal .= "<td class=\"aCenter\">".$current." mm</td>";
							}
							echo $FrontVal;
							
							//}
							?>
					</tr>
					<tr>
						<td>Kerb weight</td>
						<?php
							/*$kerb_wight=@mysqli_query($q);
							while($kerb_wight_data=mysqli_fetch_array($kerb_wight))
							{*/
						//$res_kw=mysqli_query("select DISTINCT(field_spec_kerb_value),entity_id from field_data_field_spec_kerb where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
						$res_kw=@mysqli_query("select field_spec_kerb_value, entity_id from field_data_field_spec_kerb where entity_id in (".substr($entyti_id,0,-1).") order by entity_id");
						$start = 1;
						$cols = 0;
						$prevnew='';
						while($kwvalue=@mysqli_fetch_array($res_kw))
						{
							$kerbResult = @mysqli_query("select field_kerb_info_value from field_data_field_kerb_info where entity_id =".$kwvalue['entity_id']);
							if(@mysqli_num_rows($kerbResult)>0)
							{
								$Kerb_wightinfo=@mysqli_fetch_array($kerbResult);
								$prevnew = ' <a href="#" class="infoIcon">&nbsp;<div class="infoBox"><span></span>'.$Kerb_wightinfo['field_kerb_info_value'].'</div></a>';
							}
							else
							{
								$prevnew = '';
							}
							if($start==1)
							{
								$current = $kwvalue['field_spec_kerb_value'];
								$start = 0;
								$curID = $kwvalue['entity_id'];
							}
							else
							{
								$prev = $current;
								$prevID = $curID;
								$curID = $kwvalue['entity_id'];
								$current = $kwvalue['field_spec_kerb_value'];
								if($prev!=$current)
								{
									$kerbResultPrev = @mysqli_query("select field_kerb_info_value from field_data_field_kerb_info where entity_id =".$prevID);
									if(@mysqli_num_rows($kerbResultPrev)>0)
									{
										$Kerb_wightinfo_prev=@mysqli_fetch_array($kerbResultPrev);
										$prevnewPrev = ' <a href="#" class="infoIcon">&nbsp;<div class="infoBox"><span></span>'.$Kerb_wightinfo_prev['field_kerb_info_value'].'</div></a>';
									}
									else
									{
										$prevnew = '';
									}
									$kVal .= "<td colspan=\"".$cols."\" class=\"aCenter\">";
									$kVal .= $prev." kgs ".$prevnewPrev."</td>";
									$cols = 0;
								}
							}
							$cols++;
						}
						if(@mysqli_num_rows($kerbResult)>0)
						{
							$prevnew = ' <a href="#" class="infoIcon">&nbsp;<div class="infoBox">
							<span></span>'. $Kerb_wightinfo['field_kerb_info_value'].'</div>
							</a>';
						}
						else
						{
							$prevnew = '';
						}
						$kVal .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$current." kgs ".$prevnew."</td>";
						echo $kVal;	
						?>
					</tr>
					<tr>
						<td>Ground Clearance</td>
							<?php
							/*$g_c=@mysqli_query($q);
							while($g_c_data=mysqli_fetch_array($g_c))
							{*/
							//$res_gc=@mysqli_query("select field_spec_ground_value from field_data_field_spec_ground where entity_id=".$g_c_data['entity_id']);
							//$res_gc=@mysqli_query("select DISTINCT(field_spec_ground_value),entity_id from field_data_field_spec_ground where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
							$res_gc=@mysqli_query("select field_spec_ground_value, entity_id from field_data_field_spec_ground where entity_id in (".substr($entyti_id,0,-1).") order by entity_id");
							$nofg_clearance=mysqli_num_rows($res_gc);
							$start = 1;
							$cols = 0;
							$prevGround='';
							while($gcvalue=mysqli_fetch_array($res_gc))
							{
								$groundResult = @mysqli_query("select field_ground_info_value from field_data_field_ground_info where entity_id =".$gcvalue['entity_id']);
								if(@mysqli_num_rows($groundResult)>0)
								{
									$Ground_wightinfo=@mysqli_fetch_array($groundResult);
									$prevGround = ' <a href="#" class="infoIcon">&nbsp;<div class="infoBox"><span></span>'.$Ground_wightinfo['field_ground_info_value'].'</div></a>';
								}
								else
								{
									$prevGround = '';
								}
								if($start==1)
								{
									$current = $gcvalue['field_spec_ground_value'];
									$start = 0;
									$curID = $gcvalue['entity_id'];
								}
								else
								{
									$prev = $current;
									$prevID = $curID;
									$curID = $gcvalue['entity_id'];
									$current = $gcvalue['field_spec_ground_value'];
									if($prev!=$current)
									{
										$groundResultPrev = @mysqli_query("select field_ground_info_value from field_data_field_ground_info where entity_id =".$prevID);
										if(@mysqli_num_rows($groundResultPrev)>0)
										{
											$Ground_wightinfo_prev=@mysqli_fetch_array($groundResultPrev);
											$prevGroundPrev = ' <a href="#" class="infoIcon">&nbsp;<div class="infoBox"><span></span>'.$Ground_wightinfo_prev['field_ground_info_value'].'</div></a>';
										}
										else
										{
											$prevGround = '';
										}
										$gVal .= "<td colspan=\"".$cols."\" class=\"aCenter\">";
										$gVal .= $prev." mm ".$prevGroundPrev."</td>";
										$cols = 0;
									}
								}
								$cols++;
							}
							if(@mysqli_num_rows($groundResult)>0)
							{
								$prevGround = ' <a href="#" class="infoIcon">&nbsp;<div class="infoBox">
								<span></span>'. $Ground_wightinfo['field_ground_info_value'].'</div>
								</a>';
							}
							else
							{
								$prevnew = '';
							}
							$gVal .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$current." mm ".$prevGround."</td>";
							echo $gVal;
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
								$res_tr=@mysqli_query("select field_spec_radius_value from field_data_field_spec_radius where entity_id in (".substr($entyti_id,0,-1).") order by entity_id");
								$nolwht_r=@mysqli_num_rows($res_tr);
								$cvalt_radius=0;
								$start = 1;
								$cols = 0;
								while($tr_value=@mysqli_fetch_array($res_tr))
								{
									if($start==1)
									{
										$current = $tr_value['field_spec_radius_value'];
										$start = 0;
									}
									else
									{
										$prev = $current;
										$current = $tr_value['field_spec_radius_value'];
										if($prev!=$current)
											{
												if($cols>1)
												{
													$tradval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$prev." mm</td>";
												}
												else
												{
													$tradval .= "<td class=\"aCenter\">".$prev." mm</td>";
												}
												$cols = 0;
											}
									}
									$cols++;
							 }
							 if($cols>1)
							 {
								$tradval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$current." mm</td>";
							 }
							 else
							 {
								$tradval .= "<td class=\"aCenter\">".$current." mm</td>";
							 }
							 echo $tradval;
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
							$res_sc=@mysqli_query("select field_spec_seating_value, entity_id from field_data_field_spec_seating where entity_id in (".substr($entyti_id,0,-1).") order by entity_id");
							$nofs_cap=@mysqli_num_rows($res_sc);
							$gVal='';
							$start = 1;
							$cols = 0;
							$prevGround='';
							while($sc_value=@mysqli_fetch_array($res_sc))
								{
							$groundResult=@mysqli_query("select field_seating_info_value from field_data_field_seating_info where entity_id =".$sc_value['entity_id']);
									if(@mysqli_num_rows($groundResult)>0)
									{
										$Ground_wightinfo=@mysqli_fetch_array($groundResult);
										$prevGround = ' <a href="#" class="infoIcon">&nbsp;<div class="infoBox"><span></span>'.$Ground_wightinfo['field_seating_info_value'].'</div></a>';
									}
								else
									{
										$prevGround = '';
									}
									if($start==1)
									{
										$current = $sc_value['field_spec_seating_value'];
										$start = 0;
										$curID = $sc_value['entity_id'];
									}
									else
									{
										$prev = $current;
										$prevID = $curID;
										$curID = $sc_value['entity_id'];
										$current = $sc_value['field_spec_seating_value'];
										if($prev!=$current)
											{
											$groundResultPrev = @mysqli_query("select field_seating_info_value from field_data_field_seating_info where entity_id =".$prevID);
											if(@mysqli_num_rows($groundResultPrev)>0)
												{
													$Ground_wightinfo_prev=@mysqli_fetch_array($groundResultPrev);
													$prevGroundPrev = ' <a href="#" class="infoIcon">&nbsp;<div class="infoBox"><span></span>'.$Ground_wightinfo_prev['field_seating_info_value'].'</div></a>';
												}
											else
												{
													$prevGround = '';
												}
											$gVal .= "<td colspan=\"".$cols."\" class=\"aCenter\">";
											$gVal .= $prev." People ".$prevGroundPrev."</td>";
											$cols = 0;
											}
									}
										$cols++;
								}
							if(@mysqli_num_rows($groundResult)>0)
							{
								$prevGround = ' <a href="#" class="infoIcon">&nbsp;<div class="infoBox">
								<span></span>'. $Ground_wightinfo['field_seating_info_value'].'</div>
								</a>';
							}
							else
							{
								$prevnew = '';
							}
							$gVal .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$current." People ".$prevGround."</td>";
							echo $gVal;
						
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
							$res_bc=@mysqli_query("select field_spec_boot_value from field_data_field_spec_boot where entity_id in (".substr($entyti_id,0,-1).") order by entity_id");
							$nofs_boot_cap=@mysqli_num_rows($res_bc);
							$start = 1;
							$cols = 0;
							while($bc_value=mysqli_fetch_array($res_bc))
							{
								if($start==1)
								{
									$current = $bc_value['field_spec_boot_value'];
									$start = 0;
								}
								else
								{
									$prev = $current;
									$current = $bc_value['field_spec_boot_value'];
									if($prev!=$current)
									{
										if($cols>1)
										{
											$bcval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$prev." Liters</td>";
										}
										else
										{
											$bcval .= "<td class=\"aCenter\">".$prev." Liters</td>";
										}
										$cols = 0;
									}
								}
								$cols++;
							}
							if($cols>1)
							{
								$bcval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$current." Liters</td>";
							}
							else
							{
								$bcval .= "<td class=\"aCenter\">".$current." Liters</td>";
							}
							echo $bcval;
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
							$res_ftc=@mysqli_query("select field_spec_fuel_tank_value from field_data_field_spec_fuel_tank where entity_id in (".substr($entyti_id,0,-1).") order by entity_id");
							$nof_fuel_tank_cap=@mysqli_num_rows($res_ftc);
							$start = 1;
							$cols = 0;
							$C = 0;
							while($ftc_value=mysqli_fetch_array($res_ftc))
							{
								if($start==1)
								{
									$current = $ftc_value['field_spec_fuel_tank_value'];
									$start = 0;
								}
								else
								{
									$prev = $current;
									$current = $ftc_value['field_spec_fuel_tank_value'];
									if($prev!=$current)
										{
											if($cols>1)
											{
												$ftval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$prev." Liters</td>";
											}
											else
											{
												$ftval .= "<td class=\"aCenter\">".$prev." Liters</td>";
											}
										  $cols = 0;
										}
								}
								$cols++;
							}
							if($cols>1)
							{
								$ftval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$current." Liters</td>";
							}
							else
							{
								$ftval .= "<td class=\"aCenter\">".$current." Liters</td>";
							}
							echo $ftval;
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
							<th colspan="<?php echo @mysqli_num_rows($res_lwh)+1; ?>">ENGINE</th>
						</tr>	
					</thead>
					<!-- <tr><td class="blankTr"></td><td class="blankTr"></td><td class="blankTr"></td><td class="blankTr"></td></tr>	-->
						<tr>
						<td>Fuel Type</td>
						<?php
								//echo "select node.title,field_data_field_nr_make_model.entity_id,field_data_field_nr_make_model.field_nr_make_model_nid from node,field_data_field_nr_make_model where field_data_field_nr_make_model.entity_id=node.nid and node.status=1 and field_data_field_nr_make_model.entity_id in (".substr($mid,0,-2).") group by field_data_field_nr_make_model.entity_id";
								$res_engineFuel=@mysqli_query("select field_data_field_engine_fuel.entity_id,field_data_field_engine_fuel.field_engine_fuel_value from node,field_data_field_engine_fuel where field_data_field_engine_fuel.entity_id=node.nid and node.status=1 and field_data_field_engine_fuel.entity_id in (".substr($mid,0,-2).") order by field_data_field_engine_fuel.entity_id limit 0,".$nof_fuel_tank_cap);
								$n_etyperes_engineFuel=@mysqli_num_rows($res_engineFuel);
								$start = 1;
								$cols = 0;
								while($titleFueltype=mysqli_fetch_array($res_engineFuel))
								{
									if($start==1)
									{
										$current = $titleFueltype['field_engine_fuel_value'];
										$start = 0;
									}
									else
									{
										$prev = $current;
										$current = $titleFueltype['field_engine_fuel_value'];
										if($prev!=$current)
										{
											if($cols>1)
											{
												$Fuelval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$prev."</td>";
											}
										else
											{
												$Fuelval .= "<td class=\"aCenter\">".$prev."</td>";
											}
											$cols = 0;
										}
											
									}
									$cols++;
							   }
							   if($cols>1)
							   {
									$Fuelval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$current."</td>";
							   }
							   else
							   {
								    $Fuelval .= "<td class=\"aCenter\" colspan=\"".($nof_fuel_tank_cap) ."\">".$current."</td>";
							   }
							   echo $Fuelval;
						?>
					</tr>
					<tr>
						<td>Type</td>
						<?php
						/*while($eng_d=mysqli_fetch_array($e))
							{
							$title=mysqli_fetch_array(mysqli_query("select field_spec_engine_type_value from field_data_field_spec_engine_type where entity_id=".$eng_d['entity_id']));*/
								$colval_etank=0;
								$cnt_etype=1;
								//$res_engine=@mysqli_query("select DISTINCT(field_spec_engine_type_value) from field_data_field_spec_engine_type where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
								$res_engine=@mysqli_query("select field_spec_engine_type_value from field_data_field_spec_engine_type where entity_id in (".substr($entyti_id,0,-1).") order by entity_id");
								$n_etype=@mysqli_num_rows($res_engine);
								$start = 1;
								$cols = 0;
								while($titletype=mysqli_fetch_array($res_engine))
									{
										if($start==1)
										{
											$current = $titletype['field_spec_engine_type_value'];
											$start = 0;
										}
										else
										{
											$prev = $current;
											$current = $titletype['field_spec_engine_type_value'];
											if($prev!=$current)
												{
												/* if($cols>1)
													{
														$ltypeal .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$prev." Liters</td>";
													}
												else
													{
														$ltypeal .= "<td class=\"aCenter\">".$prev." Liters</td>";
													} */
													if($cols>1)
													{
														$ltypeal .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$prev."</td>";
													}
												else
													{
														$ltypeal .= "<td class=\"aCenter\">".$prev."</td>";
													}
												 $cols = 0;	
												}
										}
										$cols++;
								}
							/* if($cols>1)
							{
								$ltypeal .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$current." Liters</td>";
							}
							else
							{
								$ltypeal .= "<td class=\"aCenter\">".$current." Liters</td>";
							} */
							if($cols>1)
							{
								$ltypeal .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$current."</td>";
							}
							else
							{
								$ltypeal .= "<td class=\"aCenter\">".$current."</td>";
							}
							echo $ltypeal;
						?>
						
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
							$res_displ=@mysqli_query("select field_spec_engine_displacement_value from field_data_field_spec_engine_displacement  where entity_id in (".substr($entyti_id,0,-1).") order by entity_id");
							$n_displace=@mysqli_num_rows($res_displ);
							$start = 1;
							$cols = 0;
							while($titledisplace=mysqli_fetch_array($res_displ))
								{
										if($start==1)
										{
											$current = $titledisplace['field_spec_engine_displacement_value'];
											$start = 0;
										}
										else
										{
											$prev = $current;
											$current = $titledisplace['field_spec_engine_displacement_value'];
											if($prev!=$current)
												{
												if($cols>1)
												{
													$displval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$prev." cc</td>";
												}
												else
												{
													$displval .= "<td class=\"aCenter\">".$prev." cc</td>";
												}
												$cols = 0;
												}
										}
											$cols++;
								 }
							if($cols>1)
							{
								$displval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$current." cc</td>";
							}
							else
							{
								$displval .= "<td class=\"aCenter\">".$current." cc</td>";
							}
							echo $displval;
							?>
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
							$res_cylinder=@mysqli_query("select field_spec_engine_cylinders_value from field_data_field_spec_engine_cylinders where entity_id in (".substr($entyti_id,0,-1).") order by entity_id");
							$n_cylinder=@mysqli_num_rows($res_cylinder);
							$start = 1;
							$cols = 0;
							while($titlecylinder=@mysqli_fetch_array($res_cylinder))
								{
								if($start==1)
										{
											$current = $titlecylinder['field_spec_engine_cylinders_value'];
											$start = 0;
										}
										else
										{
											$prev = $current;
											$current = $titlecylinder['field_spec_engine_cylinders_value'];
											if($prev!=$current)
												{
												if($cols>1)
													{
												  		$cylval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$prev." Cyl</td>";
												  	}
												else
													{
												  		$cylval .= "<td class=\"aCenter\">".$prev." Cyl</td>";
													}
												  $cols = 0;
												}
										}
									$cols++;
								}
							if($cols>1)
							{
								$cylval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$current." Cyl</td>";
							}
							else
							{
								$cylval .= "<td class=\"aCenter\">".$current." Cyl</td>";
							}
							echo $cylval;
							?>
						
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
							$res_valve=@mysqli_query("select field_spec_engine_valvetrain_value from field_data_field_spec_engine_valvetrain where entity_id in (".substr($entyti_id,0,-1).") order by entity_id");
							$n_valve=@mysqli_num_rows($res_valve);
							$start = 1;
							$cols = 0;
							while($d_valve=@mysqli_fetch_array($res_valve))
									{
									if($start==1)
										{
											$current = $d_valve['field_spec_engine_valvetrain_value'];
											$start = 0;
										}
										else
										{
											$prev = $current;
											$current = $d_valve['field_spec_engine_valvetrain_value'];
											if($prev!=$current)
												{
												if($cols>1)
													{
														$dval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$prev."</td>";
													}
												else
													{
														$dval .= "<td class=\"aCenter\">".$prev."</td>";
													}
											    $cols = 0;
												}
										}
											$cols++;
									}
							if($cols>1)
							{
								$dval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$current."</td>";
							}
							else
							{
								$dval .= "<td class=\"aCenter\">".$current."</td>";
							}
							echo $dval;
							?>
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
							$bore_s_res=@mysqli_query("select field_spec_engine_bore_value from field_data_field_spec_engine_bore where entity_id in (".substr($entyti_id,0,-1).") order by entity_id");
							$n_bands=@mysqli_num_rows($bore_s_res);
							$start = 1;
							$cols = 0;
							while($d_bs=@mysqli_fetch_array($bore_s_res))
								{
								if($start==1)
										{
											$current = $d_bs['field_spec_engine_bore_value'];
											$start = 0;
										}
										else
										{
											$prev = $current;
											$current = $d_bs['field_spec_engine_bore_value'];
											if($prev!=$current)
												{
												if($cols>1)
													{
														$d_bsal .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$prev."</td>";
													}
												else
													{
														$d_bsal .= "<td class=\"aCenter\">".$prev."</td>";
													}
											    $cols = 0;
												}
										}
									$cols++;
								}
								if($cols>1)
								{
									$d_bsal .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$current."</td>";
								}
								else
								{
									$d_bsal .= "<td class=\"aCenter\">".$current."</td>";
								}
							echo $d_bsal;
							?>
						
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
							$cratio_res=@mysqli_query("select field_spec_engine_comp_ratio_value from field_data_field_spec_engine_comp_ratio where entity_id in (".substr($entyti_id,0,-1).") order by entity_id");
							$n_cratio=@mysqli_num_rows($cratio_res);
							$start = 1;
							$cols = 0;
							while($d_cratio=@mysqli_fetch_array($cratio_res))
								{
								if($start==1)
										{
											$current = $d_cratio['field_spec_engine_comp_ratio_value'];
											$start = 0;
										}
										else
										{
											$prev = $current;
											$current = $d_cratio['field_spec_engine_comp_ratio_value'];
											if($prev!=$current)
												{
												if($cols>1)
													{
														$ratioval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$prev."</td>";
													}
												else
													{
														$ratioval .= "<td class=\"aCenter\">".$prev."</td>";
													}
												$cols = 0;
												}
										}
											$cols++;
								}
							if($cols>1)
							{
								$ratioval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$current."</td>";
							}
							else
							{
								$ratioval .= "<td class=\"aCenter\">".$current."</td>";
							}
							echo $ratioval;
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
							$res_mxpower=mysqli_query("select field_spec_engine_power_value from field_data_field_spec_engine_power where entity_id in (".substr($entyti_id,0,-1).") order by entity_id");
							$n_mxpower=@mysqli_num_rows($res_mxpower);
							$start = 1;
							$cols = 0;
							while($d_mpower=mysqli_fetch_array($res_mxpower))
								{
								if($start==1)
										{
											
											$current = $d_mpower['field_spec_engine_power_value'];
											$start = 0;
										}
										else
										{
											$prev = $current;
											$current = $d_mpower['field_spec_engine_power_value'];
											if($prev!=$current)
												{
												if($cols>1)
													{
													$mpowerval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$prev."</td>";
													}
												else
													{
													$mpowerval .= "<td class=\"aCenter\">".$prev."</td>";
													}
												$cols = 0;
												}
										}
											$cols++;
								}
							if($cols>1)
							{
								$mpowerval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$current."</td>";
							}
							else
							{
								$mpowerval .= "<td class=\"aCenter\">".$current."</td>";
							}
							echo $mpowerval;
						?>
						
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
							$res_mtorq=mysqli_query("select field_spec_engine_torque_value from field_data_field_spec_engine_torque where entity_id in (".substr($entyti_id,0,-1).") order by entity_id");
							$n_torque=@mysqli_num_rows($res_mtorq);
							$start = 1;
							$cols = 0;
							while($d_mtorq=mysqli_fetch_array($res_mtorq))
								{
								if($start==1)
										{
											$current = $d_mtorq['field_spec_engine_torque_value'];
											$start = 0;
										}
										else
										{
											$prev = $current;
											$current = $d_mtorq['field_spec_engine_torque_value'];
											if($prev!=$current)
												{
												if($cols>1)
													{
														$torqueval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$prev."</td>";
													}
												else
													{
														$torqueval .= "<td class=\"aCenter\">".$prev."</td>";
													}
												$cols = 0;
												}
										}
											$cols++;
								}
							if($cols>1)
							{
								$torqueval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$current."</td>";
							}
							else
							{
								$torqueval .= "<td class=\"aCenter\">".$current."</td>";
							}
							echo $torqueval;
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
							$res_ptwr=mysqli_query("select field_spec_engine_power_weight_value from field_data_field_spec_engine_power_weight where entity_id in (".substr($entyti_id,0,-1).") order by entity_id");
							$n_ptwr=@mysqli_num_rows($res_ptwr);
							$start = 1;
							$cols = 0;
							while($d_ptwr=mysqli_fetch_array($res_ptwr))
									{
										if($start==1)
										{
											$current = number_format($d_ptwr['field_spec_engine_power_weight_value'], 2, ".", "");
											
											/*$p = strpos($current,".");
											if($p >0)
											{
												//$prev = $prev .$p;
											}
											else
											{
												$current = $current .".00";
											} */
											$start = 0;
										}
										else
										{
											$prev = $current;
											 $current = $d_ptwr['field_spec_engine_power_weight_value'];
											if($prev!=$current)
												{
												if($cols>1)
													{
														/*$p = strpos($prev,".");
														if($p >0)
														{
															//$prev = $prev .$p;
														}
														else
														{
															$prev = $prev .".00";
														} */
														$ptwrval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".number_format($prev, 2, ".", "")." BHP/Ton</td>";
													}
												else
													{
														
														/*$p = strpos($prev,".");
														if($p >0)
														{
															//$prev = $prev .$p;
														}
														else
														{
															$prev = $prev .".00";
														} */
														$ptwrval .= "<td class=\"aCenter\">".number_format($prev, 2, ".", "")." BHP/Ton</td>";
													}
												$cols = 0;
												}
												
										}
									$cols++;
								}
							if($cols>1)
							{
								$ptwrval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".number_format($current, 2, ".", "")." BHP/Ton</td>";
							}
							else
							{
								/*$p = strpos($current,".");
								if($p >0)
								{
									//$prev = $prev .$p;
								}
								else
								{
									$current = $current .".00";
								} */
								$ptwrval .= "<td class=\"aCenter\">".number_format($current, 2, ".", "")." BHP/Ton</td>";
							}
							echo $ptwrval;
							?>
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
							$res_ttwr=mysqli_query("select field_spec_engine_torque_weight_value from field_data_field_spec_engine_torque_weight where entity_id in (".substr($entyti_id,0,-1).") order by entity_id");
							$n_ttwr=@mysqli_num_rows($res_ttwr);
							$start = 1;
							$cols = 0;
							while($d_ttwr=@mysqli_fetch_array($res_ttwr))
								{
									if($start==1)
									{
										//$current = $d_ttwr['field_spec_engine_torque_weight_value'];
										$current = number_format($d_ttwr['field_spec_engine_torque_weight_value'], 2, ".", "");
										$start = 0;
									}
									else
									{
										$prev = $current;
										$current = $d_ttwr['field_spec_engine_torque_weight_value'];
										if($prev!=$current)
										{
											if($cols>1)
											{
												$ttwrval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".number_format($prev, 2, ".", "")." Nm/Ton</td>";
											}
											else
											{
												$ttwrval .= "<td class=\"aCenter\">".number_format($prev, 2, ".", "")." Nm/Ton</td>";
											}
											$cols = 0;
										}
									}
									$cols++;
								}
							if($cols>1)
							{
								$ttwrval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".number_format($current, 2, ".", "")." Nm/Ton</td>";
							}
							else
							{
								$ttwrval .= "<td class=\"aCenter\">".number_format($current, 2, ".", "")." Nm/Ton</td>";
							}
						 	echo $ttwrval;
							?>
						<!--  <td>227 Nm/tonne</td>
						<td>289 Nm/tonne</td>
						<td>312 Nm/tonne</td>
						-->
					</tr>
					<tr>
						<td>BHP / Liter</td>
							<?php
							$cnt_bhpliture=1;
							$col_bhpliture=0;
							//$res_bhp_liter=mysqli_query("select DISTINCT(field_spec_engine_bhp_value) from field_data_field_spec_engine_bhp where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
							$res_bhp_liter=mysqli_query("select field_spec_engine_bhp_value from field_data_field_spec_engine_bhp where entity_id in (".substr($entyti_id,0,-1).") order by entity_id");
							$n_bhpliture=@mysqli_num_rows($res_bhp_liter);
							$start = 1;
							$cols = 0;
							while($d_bhp_liter=@mysqli_fetch_array($res_bhp_liter))
								{
								if($start==1)
										{
											//$current = $d_bhp_liter['field_spec_engine_bhp_value'];
											$current = number_format($d_bhp_liter['field_spec_engine_bhp_value'], 2, ".", "");
											$start = 0;
										}
										else
										{
											$prev = $current;
											$current = $d_bhp_liter['field_spec_engine_bhp_value'];
											if($prev!=$current)
												{
												if($cols>1)
													{
														$bhpltrval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".number_format($prev, 2, ".", "")." BHP/L</td>";
													}
												else
													{
														$bhpltrval .= "<td class=\"aCenter\">".number_format($prev, 2, ".", "")." BHP/L</td>";
													}
												$cols = 0;
												}
										}
											$cols++;
								}
							if($cols>1)
							{
								$bhpltrval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".number_format($current, 2, ".", "")." BHP/L</td>";
							}
							else
							{
								$bhpltrval .= "<td class=\"aCenter\">".number_format($current, 2, ".", "")." BHP/L</td>";
							}
							echo $bhpltrval;
							?>
					</tr>
					<tr>
						<td>Drivetrain</td>
							<?php
							$cnt_Drivetrain=1;
							$col_Drivetrain=0;
							$res_drivetrain=@mysqli_query("select field_spec_engine_drivetrain_value from field_data_field_spec_engine_drivetrain where entity_id in (".substr($entyti_id,0,-1).") order by entity_id");
							$n_Drivetrain=@mysqli_num_rows($res_drivetrain);
							$start = 1;
							$cols = 0;
							while($d_dvt=mysqli_fetch_array($res_drivetrain))
								{
								if($start==1)
										{
											$current = $d_dvt['field_spec_engine_drivetrain_value'];
											$start = 0;
										}
										else
										{
											$prev = $current;
											$current = $d_dvt['field_spec_engine_drivetrain_value'];
											if($prev!=$current)
												{
												if($cols>1)
													{
														$drival .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$prev."</td>";
													}
												else
													{
														$drival .= "<td class=\"aCenter\">".$prev."</td>";
													}
												$cols = 0;
												}
										}
											$cols++;
								}
							if($cols>1)
							{
								$drival .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$current."</td>";
							}
							else
							{
								$drival .= "<td class=\"aCenter\">".$current."</td>";
							}
							echo $drival;
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
							$res_transmission=@mysqli_query("select field_spec_engine_transmission_value from field_data_field_spec_engine_transmission where entity_id in (".substr($entyti_id,0,-1).") order by entity_id");
							$n_transmission=@mysqli_num_rows($res_transmission);
							$start = 1;
							$cols = 0;
							while($d_trans=mysqli_fetch_array($res_transmission))
								{
									if($start==1)
										{
											$current = $d_trans['field_spec_engine_transmission_value'];
											$start = 0;
										}
										else
										{
											$prev = $current;
											$current = $d_trans['field_spec_engine_transmission_value'];
											if($prev!=$current)
												{
												if($cols>1)
													{
														$transval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$prev."</td>";
													}
												else
													{
														$transval .= "<td class=\"aCenter\">".$prev."</td>";
													}
												$cols = 0;
												}
										}
											$cols++;
								}
							if($cols>1)
							{
								$transval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$current."</td>";
							}
							else
							{
								$transval .= "<td class=\"aCenter\">".$current."</td>";
							}
							echo $transval;
							?>
						<!-- <td>6-speed Manual</td>
						<td>5-speed Manual</td>
						<td>7-speed DSG with paddle shift</td> -->
					</tr>
					<tr>
						<td>Service Intervals</td>
							<?php
							$cnt_intervals=1;
							$col_intervals=0;
							$res_serv_i=@mysqli_query("select field_spec_engine_service_value from field_data_field_spec_engine_service where entity_id in (".substr($entyti_id,0,-1).") order by entity_id");
							$n_serv_i=@mysqli_num_rows($res_serv_i);
							$start = 1;
							$cols = 0;
							while($d_trans=mysqli_fetch_array($res_serv_i))
								{
								if($start==1)
										{
											$current = $d_trans['field_spec_engine_service_value'];
											$start = 0;
										}
										else
										{
											$prev = $current;
											$current = $d_trans['field_spec_engine_service_value'];
											if($prev!=$current)
												{
												if($cols>1)
													{
														$d_transval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$prev." Km</td>";
													}
												else
													{
														$d_transval .= "<td class=\"aCenter\">".$prev." Km</td>";
													}
												$cols = 0;
												}
										}
											$cols++;
								}
							if($cols>1)
							{
								$d_transval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$current." Km</td>";
							}
							else
							{
								$d_transval .= "<td class=\"aCenter\">".$current." Km</td>";
							}
							echo $d_transval;
							?>
					</tr>
				</table><!-- speciTable -->
					
				<!-- <table class="speciTable<?php if($nofmodel==1){?> flexColum<?php }  else if($nofmodel==2){?> flexColum flexColum2<?php } else if($nofmodel==3){?> flexColum flexColum3<?php } else if($nofmodel==4){?> flexColum flexColum4<?php } ?>">-->
				<table class="speciTable">
					<thead>
						<tr>
							<th colspan="<?php echo @mysqli_num_rows($res_lwh)+1;  ?>">SUSPENSION</th>
						</tr>	
					</thead>
				<!-- <tr><td class="blankTr"></td><td class="blankTr"></td><td class="blankTr"></td><td class="blankTr"></td></tr>	-->	
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
							$res_st_type=@mysqli_query("select field_spec_steering_value from field_data_field_spec_steering where entity_id in (".substr($entyti_id,0,-1).") order by entity_id");
							$n_st_type=@mysqli_num_rows($res_st_type);
							$start = 1;
							$cols = 0;
							while($d_stype=@mysqli_fetch_array($res_st_type))
								{
									if($start==1)
										{
											$current = $d_stype['field_spec_steering_value'];
											$start = 0;
										}
										else
										{
											$prev = $current;
											$current = $d_stype['field_spec_steering_value'];
											if($prev!=$current)
												{
												if($cols>1)
													{
														$d_stypeval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$prev."</td>";
													}
												else
													{
														$d_stypeval .= "<td class=\"aCenter\">".$prev."</td>";
													}
												$cols = 0;
												}
										}
											$cols++;
								}
							if($cols>1)
							{
								$d_stypeval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$current."</td>";
							}
							else
							{
								$d_stypeval .= "<td class=\"aCenter\">".$current."</td>";
							}
							echo $d_stypeval;
							?>
					</tr>
					
					<tr>
						<td>Front suspension</td>
							<?php
							$cnt_suspension=1;
							$col_suspension=0;
							//$res_fsus=@mysqli_query("select DISTINCT(field_spec_front_value) from field_data_field_spec_front where entity_id in (".substr($entyti_id,0,-1).")  group by entity_id order by entity_id desc");
							$res_fsus=@mysqli_query("select field_spec_front_value from field_data_field_spec_front where entity_id in (".substr($entyti_id,0,-1).")  order by entity_id");
							$n_suspension=@mysqli_num_rows($res_fsus);
							$start = 1;
							$cols = 0;
							while($d_fsus=@mysqli_fetch_array($res_fsus))
								{
								if($start==1)
										{
											$current = $d_fsus['field_spec_front_value'];
											$start = 0;
										}
										else
										{
											$prev = $current;
											$current = $d_fsus['field_spec_front_value'];
											if($prev!=$current)
												{
												if($cols>1)
													{
														$d_fsuseval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$prev."</td>";
													}
												else
													{
														$d_fsuseval .= "<td class=\"aCenter\">".$prev."</td>";
													}
												$cols = 0;
												}
										}
											$cols++;
								}
							if($cols>1)
							{
								$d_fsuseval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$current."</td>";
							}
							else
							{
								$d_fsuseval .= "<td class=\"aCenter\">".$current."</td>";
							}
							echo $d_fsuseval;
							?>
					</tr>
					<tr> 
						<td>Rear suspension</td>
							<?php
							$cnt_rearsuspension=1;
							$col_rearsuspension=0;
							//$res_rearsus=@mysqli_query("select DISTINCT(field_spec_rear_value) from field_data_field_spec_rear where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
							$res_rearsus=@mysqli_query("select field_spec_rear_value from field_data_field_spec_rear where entity_id in (".substr($entyti_id,0,-1).") order by entity_id");
							$n_rearsus=@mysqli_num_rows($res_rearsus);
							$start = 1;
							$cols = 0;
							while($d_rear_sus=@mysqli_fetch_array($res_rearsus))
								{
								if($start==1)
										{
											$current = $d_rear_sus['field_spec_rear_value'];
											$start = 0;
										}
										else
										{
											$prev = $current;
											$current = $d_rear_sus['field_spec_rear_value'];
											if($prev!=$current)
												{
												if($cols>1)
													{
														$rearsuspval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$prev."</td>";
													}
												else
													{
														$rearsuspval .= "<td class=\"aCenter\">".$prev."</td>";
													}
												$cols = 0;
												}
										}
											$cols++;
								}
							if($cols>1)
							{
								$rearsuspval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$current."</td>";
							}
							else
							{
								$rearsuspval .= "<td class=\"aCenter\">".$current."</td>";
							}
							echo $rearsuspval;
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
							$res_tyre_size=@mysqli_query("select field_spec_tyre_value,entity_id from field_data_field_spec_tyre where entity_id in (".substr($entyti_id,0,-1).")  order by entity_id");
							$n_tyre_size=@mysqli_num_rows($res_tyre_size);
							$start = 1;
							$cols = 0;
							$prevGround='';
							$tsize='';
							while($d_tyre_size=@mysqli_fetch_array($res_tyre_size))
								{
								$groundResult =@mysqli_query("select field_tyre_size_caption_value from field_data_field_tyre_size_caption where entity_id =".$d_tyre_size['entity_id']);
								if(@mysqli_num_rows($groundResult)>0)
									{
										$Ground_wightinfo=@mysqli_fetch_array($groundResult);
										$prevGround = ' <a href="#" class="infoIcon">&nbsp;<div class="infoBox"><span></span>'.$Ground_wightinfo['field_tyre_size_caption_value'].'</div></a>';
									}
								else
									{
										$prevGround = '';
									}
									if($start==1)
									{
										$current = $d_tyre_size['field_spec_tyre_value'];
										$start = 0;
										$curID = $d_tyre_size['entity_id'];
									}
									else
									{
										$prev = $current;
										$prevID = $curID;
										$curID = $d_tyre_size['entity_id'];
										$current = $d_tyre_size['field_spec_tyre_value'];
										if($prev!=$current)
											{
											$groundResultPrev = @mysqli_query("select field_tyre_size_caption_value from field_data_field_tyre_size_caption where entity_id =".$prevID);
											if(@mysqli_num_rows($groundResultPrev)>0)
												{
													$Ground_wightinfo_prev=@mysqli_fetch_array($groundResultPrev);
													$prevGroundPrev = ' <a href="#" class="infoIcon">&nbsp;<div class="infoBox"><span></span>'.$Ground_wightinfo_prev['field_tyre_size_caption_value'].'</div></a>';
												}
											else
												{
													$prevGround = '';
												}
											$tsize .= "<td colspan=\"".$cols."\" class=\"aCenter\">";
											$tsize .= $prev." ".$prevGroundPrev."</td>";
											$cols = 0;
											}
									}
										$cols++;
								}
							if(@mysqli_num_rows($groundResult)>0)
							{
								$prevGround = ' <a href="#" class="infoIcon">&nbsp;<div class="infoBox">
								<span></span>'. $Ground_wightinfo['field_tyre_size_caption_value'].'</div>
								</a>';
							}
							else
							{
								$prevnew = '';
							}
							$tsize .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$current." ".$prevGround."</td>";
							echo $tsize;
							?>
					
					</tr>
					<tr>
						<td>Brakes : Front / Rear</td>
						<?php
						//$res_break=@mysqli_query("select DISTINCT(field_spec_brakes_value),entity_id from field_data_field_spec_brakes where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
						$res_break=@mysqli_query("select field_spec_brakes_value, entity_id from field_data_field_spec_brakes where entity_id in (".substr($entyti_id,0,-1).") order by entity_id");
						$n_brake_front_rear=@mysqli_num_rows($res_break);
						$start = 1;
						$cols = 0;
						$prevGround='';
						$brkfrnt='';
						$current='';
						while($d_bfr=mysqli_fetch_array($res_break))
							{
							$groundResult=@mysqli_query("select field_brakes_info_value from field_data_field_brakes_info where entity_id =".$d_bfr['entity_id']);
							if(@mysqli_num_rows($groundResult)>0)
									{
										$Ground_wightinfo=@mysqli_fetch_array($groundResult);
										$prevGround = ' <a href="#" class="infoIcon">&nbsp;<div class="infoBox"><span></span>'.$Ground_wightinfo['field_brakes_info_value'].'</div></a>';
									}
								else
									{
										$prevGround = '';
									}
									if($start==1)
									{
										$current = $d_bfr['field_spec_brakes_value'];
										$start = 0;
										$curID = $d_bfr['entity_id'];
									}
									else
									{
										$prev = $current;
										$prevID = $curID;
										$curID = $d_bfr['entity_id'];
										$current = $d_bfr['field_spec_brakes_value'];
										if($prev!=$current)
											{
											$groundResultPrev = @mysqli_query("select field_brakes_info_value from field_data_field_brakes_info where entity_id =".$prevID);
											if(@mysqli_num_rows($groundResultPrev)>0)
												{
													$Ground_wightinfo_prev=@mysqli_fetch_array($groundResultPrev);
													$prevGroundPrev = ' <a href="#" class="infoIcon">&nbsp;<div class="infoBox"><span></span>'.$Ground_wightinfo_prev['field_brakes_info_value'].'</div></a>';
												}
											else
												{
													$prevGround = '';
												}
											
											$brkfrnt .= "<td colspan=\"".$cols."\" class=\"aCenter\">";
											$brkfrnt .= $prev." ".$prevGroundPrev."</td>";
											$cols = 0;
											}
									}
										$cols++;
								}
							if(@mysqli_num_rows($groundResult)>0)
							{
								$prevGround = ' <a href="#" class="infoIcon">&nbsp;<div class="infoBox">
								<span></span>'. $Ground_wightinfo['field_brakes_info_value'].'</div>
								</a>';
							}
							else
							{
								$prevnew = '';
							}
							$brkfrnt .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$current." ".$prevGround."</td>";
							echo $brkfrnt;
						?>
					</tr>
				</table><!-- speciTable -->
				
				<!-- <table class="speciTable<?php if($nofmodel==1){?> flexColum<?php }  else if($nofmodel==2){?> flexColum flexColum2<?php } else if($nofmodel==3){?> flexColum flexColum3<?php } else if($nofmodel==4){?> flexColum flexColum4<?php } ?>"> -->
				<table class="speciTable">
					<thead>
						<tr>
							<th colspan="<?php echo @mysqli_num_rows($res_lwh)+1;  ?>">FUEL EFFICIENCY</th>
						</tr>	
					</thead>
				<!-- <tr><td class="blankTr"></td><td class="blankTr"></td><td class="blankTr"></td><td class="blankTr"></td></tr>	-->
				<tr>
						<td>City</td>
						<?php
							$cnt_city=1;
							$col_city=0;
							//$res_city=mysqli_query("select DISTINCT(field_spec_fuel_city_value) from field_data_field_spec_fuel_city where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
							$res_city=mysqli_query("select field_spec_fuel_city_value from field_data_field_spec_fuel_city where entity_id in (".substr($entyti_id,0,-1).") order by entity_id");
							$n_city=@mysqli_num_rows($res_city);
							$start = 1;
							$cols = 0;
							while($d_city=mysqli_fetch_array($res_city))
							{
									if($start==1)
									{
										$current = $d_city['field_spec_fuel_city_value'];
										$start = 0;
									}
									else
									{
										$prev = $current;
										$current = $d_city['field_spec_fuel_city_value'];
										if($prev!=$current)
											{
											if($cols>1)
												{
													$cityval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$prev." kpl</td>";
												}
											else
												{
													$cityval .= "<td class=\"aCenter\">".$prev." kpl</td>";
												}
											$cols = 0;
											}
									}
									$cols++;
							}
							if($cols>1)
							{
								$cityval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$current." kpl</td>";
							}
							else
							{
								$cityval .= "<td class=\"aCenter\">".$current." kpl</td>";
							}
							echo $cityval;
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
						$res_highway=@mysqli_query("select field_spec_fuel_highway_value from field_data_field_spec_fuel_highway where entity_id in (".substr($entyti_id,0,-1).") order by entity_id");
						$n_highway=@mysqli_num_rows($res_highway);
						$start = 1;
						$cols = 0;
						while($d_highway=@mysqli_fetch_array($res_highway))
								{
								if($start==1)
										{
											$current = $d_highway['field_spec_fuel_highway_value'];
											$start = 0;
										}
										else
										{
											$prev = $current;
											$current = $d_highway['field_spec_fuel_highway_value'];
											if($prev!=$current)
												{
												if($cols>1)
													{
														$highwayval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$prev." kpl</td>";
													}
												else
													{
														$highwayval .= "<td class=\"aCenter\">".$prev." kpl</td>";
													}
												$cols = 0;
												}
										}
											$cols++;
								}
							if($cols>1)
							{
								$highwayval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$current." kpl</td>";
							}
							else
							{
								$highwayval .= "<td class=\"aCenter\">".$current." kpl</td>";
							}
							echo $highwayval;
						?>
						<!--  <td>17.2 kpl</td>
						<td>20.2 kpl</td>
						<td>14.2 kpl</td>-->
					</tr>
					<tr>
						<td>ARAI Rating</td>
						<?php
							$cnt_api_rating=1;
							$col_api_rating=0;
							//$res_apirating=@mysqli_query("select DISTINCT(field_spec_fuel_arai_value) from field_data_field_spec_fuel_arai where entity_id in (".substr($entyti_id,0,-1).") group by entity_id order by entity_id desc");
							$res_apirating=@mysqli_query("select field_spec_fuel_arai_value from field_data_field_spec_fuel_arai where entity_id in (".substr($entyti_id,0,-1).") order by entity_id");
							$n_apirating=@mysqli_num_rows($res_apirating);
							$start = 1;
							$cols = 0;
							while($d_apirating=@mysqli_fetch_array($res_apirating))
								{
								if($start==1)
										{
											$current = $d_apirating['field_spec_fuel_arai_value'];
											$start = 0;
										}
										else
										{
											$prev = $current;
											$current = $d_apirating['field_spec_fuel_arai_value'];
											if($prev!=$current)
												{
												if($cols>1)
													{
														$apirateval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$prev." kpl</td>";
													}
												else
													{
														$apirateval .= "<td class=\"aCenter\">".$prev." kpl</td>";
													}
												$cols = 0;
												}
										}
											$cols++;
								}
							if($cols>1)
							{
								$apirateval .= "<td colspan=\"".$cols."\" class=\"aCenter\">".$current." kpl</td>";
							}
							else
							{
								$apirateval .= "<td class=\"aCenter\">".$current." kpl</td>";
							}
							echo $apirateval;
						?>
						</tr>
				</table><!-- speciTable -->
					<?php
					}
					?>
			</div><!-- car review -->
		</div><!-- overviewContainer -->
		
		<div class="clearfix articleNavi">
			<a class="fleft btnLeft" href="/reviews">
				<span>Back to Index</span>
			</a>
			<!--<a class="compareClose" id="compareBtn" href="#" onclick="return false;">&nbsp;</a>-->
		</div>
		<?php //include ("../themes/mobilebhp/includes/compare.php"); 
		$sql_model=@mysqli_query("SELECT node.title,node.nid, file_managed.uri,field_data_field_nr_make.field_nr_make_nid,field_data_field_model_dashboard.field_model_dashboard_fid
FROM node,file_managed,field_data_field_nr_make,field_data_field_model_dashboard
WHERE field_data_field_model_dashboard.field_model_dashboard_fid = file_managed.fid
AND field_data_field_model_dashboard.entity_id = node.nid
AND node.status =1 AND field_data_field_nr_make.entity_id=field_data_field_model_dashboard.entity_id and node.nid=".$model_id['field_nr_make_model_nid']." order by node.changed desc");
$numberofrows=@mysqli_num_rows($sql_model);
if($numberofrows>0)
		{
		$mktitle=@mysqli_fetch_array(mysqli_query("select title from node,field_data_field_nr_make where field_data_field_nr_make.entity_id =".$model_id['field_nr_make_model_nid']." and field_data_field_nr_make.field_nr_make_nid=node.nid"));
			$sql_sequenceimgmainimg=@mysqli_fetch_array(mysqli_query("SELECT distinct(field_gallery_interior_alt) as alt, field_gallery_interior_title as title, field_gallery_interior_fid as fid FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_id['field_nr_make_model_nid']."' and field_data_field_gallery_interior.field_gallery_interior_alt!='' UNION SELECT distinct(field_gallery_exterior_alt) as alt, field_gallery_exterior_title as title, field_gallery_exterior_fid as fid FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_id['field_nr_make_model_nid']."' and field_data_field_gallery_exterior.field_gallery_exterior_alt!='' UNION SELECT distinct(field_gallery_engine_alt) as alt, field_gallery_engine_title as title, field_gallery_engine_fid as fid FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_id['field_nr_make_model_nid']."' and field_data_field_gallery_engine.field_gallery_engine_alt!='' UNION SELECT distinct(field_gallery_smaller_alt) as alt, field_gallery_smaller_title as title, field_gallery_smaller_fid as fid FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_id['field_nr_make_model_nid']."' and field_data_field_gallery_smaller.field_gallery_smaller_alt!='' order by alt limit 0,1"));
				if($sql_sequenceimgmainimg=='')
					{
					    $sql_sequenceimgwithoutorder=@mysqli_fetch_array(mysqli_query("SELECT field_data_field_gallery_interior.delta as delta , field_gallery_interior_title as title, field_gallery_interior_fid as fidint FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_id['field_nr_make_model_nid']."' UNION SELECT field_data_field_gallery_exterior.delta as delta, field_gallery_exterior_title as title, field_gallery_exterior_fid as fidint FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_id['field_nr_make_model_nid']."' UNION SELECT field_data_field_gallery_engine.delta as delta, field_gallery_engine_title as title, field_gallery_engine_fid as fidint FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_id['field_nr_make_model_nid']."' UNION SELECT field_data_field_gallery_smaller.delta as delta, field_gallery_smaller_title as title, field_gallery_smaller_fid as fidint FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_id['field_nr_make_model_nid']."' order by delta limit 0,1"));
						if($sql_sequenceimgwithoutorder=='')
							{
							$model_modleimgname="sites/default/files/defaultmodel_46.gif";
							}
						else
							{
						$model_img=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$sql_sequenceimgwithoutorder['fidint']));
						$model_modleimgname="?q=sites/default/files/styles/thumb_compare_car/public/".str_replace("public://","",$model_img['uri']);
							}
					}
				else
					{
						$model_img=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$sql_sequenceimgmainimg['fid']));
						$model_modleimgname="?q=sites/default/files/styles/thumb_compare_car/public/".str_replace("public://","",$model_img['uri']);
					}											
		?>
				<div class="compareMesgInside"><p class="compareMesgPad roundAll5">You have already added that car. Please choose another car.</p></div>
				<div class="marB10 BLR5 reviewCompare" style="display:block">
						<ul class="clearfix" id="compareUL">
							<?php
							$data_model=mysqli_fetch_array($sql_model);
							$sql_url=@mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$data_model['nid']."'"));
							$price_res = @mysql_fetch_assoc(mysqli_query("select min(on_road_price) as minPrice, max(on_road_price) as maxPrice from team_bhp_variant_price, field_data_field_price_nr_variant, field_data_field_variant_nr_engine, field_data_field_nr_make_model where team_bhp_variant_price.city='Delhi' and team_bhp_variant_price.nid=field_data_field_price_nr_variant.entity_id and field_data_field_price_nr_variant.field_price_nr_variant_nid=field_data_field_variant_nr_engine.entity_id and field_data_field_variant_nr_engine.field_variant_nr_engine_nid=field_data_field_nr_make_model.entity_id and field_data_field_nr_make_model.field_nr_make_model_nid=".$data_model['nid']));
							?>
							<li class="clearfix">
								<div class="content firstContent clearfix" id="<?php echo $data_model['nid']; ?>"  rel="<?php echo str_replace("review/","",$sql_url['alias'])?>">
									<div class="img">
										<strong>
									<!--<img src="/sites/default/files/<?php echo str_replace("public://","",$data_model['uri']);?>" alt="<?php echo $data_model['title'];?>" width="61" height="48" />-->
									<img src="/<?php echo $model_modleimgname;?>" alt="<?php echo $data_model['title'];?>" />
									</strong>
									</div>
									<p class="desc">
										<span class="title"><?php echo /*$mktitle['title']." ".*/$data_model['title'];?></span>
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
