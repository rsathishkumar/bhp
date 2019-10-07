<?php
//$q="select node.title,field_data_field_features_model.field_features_model_nid from node,field_data_field_features_model where field_data_field_features_model.field_features_model_nid=node.nid and field_data_field_features_model.entity_id=".$node->nid;

$q="SELECT field_data_field_nr_make_model.field_nr_make_model_nid  FROM field_data_field_variant_nr_engine,field_data_field_features_nr_variant,field_data_field_nr_make_model where field_data_field_variant_nr_engine.entity_id=field_data_field_features_nr_variant .field_features_nr_variant_nid  and field_data_field_variant_nr_engine.field_variant_nr_engine_nid=field_data_field_nr_make_model.entity_id  and field_data_field_features_nr_variant.entity_id=".$node->nid;
$sql_modeltitle=mysqli_query($q);
$sql_modeldata=mysqli_fetch_array($sql_modeltitle);

$sql_brochure=@mysqli_fetch_array(mysqli_query("select field_data_field_model_brochure.field_model_brochure_fid,file_managed.uri from file_managed,field_data_field_model_brochure where field_data_field_model_brochure.field_model_brochure_fid=file_managed.fid and field_data_field_model_brochure.entity_id=".$sql_modeldata['field_nr_make_model_nid']));

$sql_line_image=@mysqli_fetch_array(mysqli_query("select field_data_field_model_dashboard.field_model_dashboard_fid,file_managed.uri from file_managed,field_data_field_model_dashboard where field_data_field_model_dashboard.field_model_dashboard_fid=file_managed.fid and field_data_field_model_dashboard.entity_id=".$sql_modeldata['field_nr_make_model_nid']));

$model_title=@mysqli_fetch_array(mysqli_query("select title from node where nid=".$sql_modeldata['field_nr_make_model_nid']));
$make_res = @mysqli_fetch_array(mysqli_query("select node.title,field_data_field_nr_make.field_nr_make_nid from node,field_data_field_nr_make where field_data_field_nr_make.entity_id =".$sql_modeldata['field_nr_make_model_nid']." and node.nid=field_data_field_nr_make.field_nr_make_nid"));

 $sql_engine="SELECT node.title, field_data_field_features_model.field_features_model_nid
FROM node, field_data_field_features_model
WHERE field_data_field_features_model.field_features_model_nid =".$sql_modeldata['field_nr_make_model_nid'];

// $sql_engineforlist="SELECT node.title, field_data_field_features_engine.field_features_engine_nid, field_data_field_features_engine.entity_id, field_data_field_features_model.field_features_model_nid FROM node, field_data_field_features_engine, field_data_field_features_model WHERE field_data_field_features_model.entity_id = field_data_field_features_engine.entity_id AND node.nid = field_data_field_features_engine.field_features_engine_nid AND field_data_field_features_model.field_features_model_nid =".$sql_modeldata['field_nr_make_model_nid']." group by node.nid";


$firstvariant=@mysqli_fetch_array(mysqli_query("SELECT field_variant_nr_engine_nid FROM field_data_field_variant_nr_engine,node WHERE field_data_field_variant_nr_engine.field_variant_nr_engine_nid=node.nid and node.status=1 and  entity_id =".$node->field_features_nr_variant['und'][0]['nid']));
	if($firstvariant!='')
		{
		//echo "select node.title,node.nid from node,field_data_field_variant_nr_engine where field_data_field_variant_nr_engine.field_variant_nr_engine_nid=".$firstvariant['field_variant_nr_engine_nid'];
	
		$sql_e=@mysqli_query("select node.title,node.nid from node,field_data_field_variant_nr_engine where node.nid=field_data_field_variant_nr_engine.field_variant_nr_engine_nid and node.status=1 and field_data_field_variant_nr_engine.field_variant_nr_engine_nid=".$firstvariant['field_variant_nr_engine_nid']);
		$nofr=@mysqli_num_rows($sql_e);
			if($nofr>0)
				{
					$row_e=mysqli_fetch_array($sql_e);
					$vid=$row_e['nid'];
					$enginename=$row_e['title'];
				}
				
		}
	
		

$sql_variant="SELECT node.title, field_data_field_features_engine.field_features_engine_nid, field_data_field_features_nr_variant.field_features_nr_variant_nid, field_data_field_features_engine.entity_id, field_data_field_features_model.field_features_model_nid
FROM node, field_data_field_features_engine, field_data_field_features_nr_variant, field_data_field_features_model
WHERE field_data_field_features_model.entity_id = field_data_field_features_engine.entity_id
AND field_data_field_features_model.entity_id = field_data_field_features_nr_variant.entity_id
AND node.nid = field_data_field_features_nr_variant.field_features_nr_variant_nid
AND field_data_field_features_model.field_features_model_nid =".$sql_modeldata['field_nr_make_model_nid']." limit 0,4";

$resvariant=@mysqli_query($sql_variant);
$sql_overview_feature=@mysql_fetch_assoc(mysqli_query("select field_feature_overview_value from field_data_field_feature_overview where entity_id =".$sql_modeldata['field_nr_make_model_nid']));

$sql_image=@mysqli_fetch_array(mysqli_query("select field_data_field_model_dashboard.field_model_dashboard_fid,field_data_field_model_dashboard.entity_id,file_managed.uri from field_data_field_model_dashboard,file_managed where field_data_field_model_dashboard.field_model_dashboard_fid=file_managed.fid and field_data_field_model_dashboard.entity_id=".$sql_modeldata['field_nr_make_model_nid']));
$f_id=$sql_modeldata['field_nr_make_model_nid'];


$qry_forengine=@mysqli_query("select entity_id  from field_data_field_nr_make_model where field_nr_make_model_nid=".$sql_modeldata['field_nr_make_model_nid']);


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

				function getOption($val)
						{
							switch($val){
								case 0:
									echo "<td class='aCenter'><img src='/themes/bhp/images/cross.png' /></td>";
									break;
								case 1:
									echo "<td><div class='tickMarkIcon'>&nbsp;</div></td>";
									break;
								case 2:
									echo "<td class='aCenter'>Optional</td>";
									break;
								default:
									echo "<td>&nbsp;</td>";
									break;								
							}
						}
$naimgpath = "<img src='/themes/bhp/images/cross.png' />";
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
			    
			    if (position.top>"590" && position.top<"1840"){
			        $("#tableHead").addClass("pFixHeadFeatu");
			        $(".engineOption").addClass("pFixHead");
			        return false;
			    }else {
			        $("#tableHead").removeClass("pFixHeadFeatu");
			        $(".engineOption").removeClass("pFixHead");
			        return false;
			    }
			});
			
		});
})(jQuery);
	</script>
<?php
$photos_nid = @mysqli_fetch_array(mysqli_query("select entity_id from field_data_field_gallery_model where field_gallery_model_nid=".$sql_modeldata['field_nr_make_model_nid']));
	if($photos_nid!='')
	{
$photos_alias = @mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$photos_nid['entity_id']."' and alias !='gallery/ant'"));
	}

//$sql_urlforspecification=@mysqli_fetch_array(mysqli_query("select entity_id from field_data_field_news_model where field_news_model_nid=".$node->field_features_model['und'][0]['nid']. " and bundle ='specifications'"));

$sql_urlforspecification=@mysqli_fetch_array(mysqli_query("SELECT field_data_field_spec_nr_engine_type.entity_id FROM field_data_field_spec_nr_engine_type, field_data_field_variant_nr_engine WHERE field_data_field_variant_nr_engine.field_variant_nr_engine_nid = field_data_field_spec_nr_engine_type.field_spec_nr_engine_type_nid
AND field_data_field_variant_nr_engine.entity_id =".$node->field_features_nr_variant['und'][0][nid]." limit 1"));


	if($sql_urlforspecification!='')
	{
$sql_urlforspecific=@mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$sql_urlforspecification['entity_id']."'"));
	}

$forum_review_nid = @mysqli_fetch_array(mysqli_query("select entity_id from field_data_field_forum_model where field_forum_model_nid=".$sql_modeldata['field_nr_make_model_nid']));
	if($forum_review_nid!='')
	{
$forum_review_alias = @mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$forum_review_nid['entity_id']."'"));
	}
	
	$sql_urlforprice=@mysqli_fetch_array(mysqli_query("select field_data_field_price_nr_variant.entity_id from field_data_field_nr_make_model, field_data_field_variant_nr_engine, field_data_field_price_nr_variant where field_data_field_nr_make_model.field_nr_make_model_nid=".$sql_modeldata['field_nr_make_model_nid']." and field_data_field_nr_make_model.entity_id=field_data_field_variant_nr_engine.field_variant_nr_engine_nid and field_data_field_variant_nr_engine.entity_id=field_data_field_price_nr_variant.field_price_nr_variant_nid"));
		if($sql_urlforprice!='')
		{
$sql_urlforpricedata=@mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$sql_urlforprice['entity_id']."'"));
		}

?>
	<div id="leftColumn" class="clearfix fleft">
	<div class="article">
	<h1 class="padL20 marB10">Reviews</h1>
	<ul class="tab TLR5 clearfix">
		<li><a href="<?php echo url("node/".$sql_modeldata['field_nr_make_model_nid']);?>" class="TLR5" title="Overview">Overview</a></li>
		<?php
			if($photos_alias!='')
			{
		?>
		<li><a href="/<?php echo $photos_alias['alias'];?>" class="TLR5" title="Photos">Photos</a></li>
		<?php
			}
			if($sql_urlforspecific!='')
			{
		?>
		<li><a href="/<?php echo $sql_urlforspecific['alias'];?>" class="TLR5" title="Specifications">Specifications</a></li>
		<?php
			}
		?>
		<li><a href="<?php echo url("node/".$node->nid);?>" class="TLR5 active" title="Features">Features</a></li>
		<?php
			if($forum_review_alias!='')
			{
		?>
		<li><a href="<?php echo "/?q=forum-reviews&modelname=".strtolower($model_title['title']); //$forum_review_alias['alias'];?>" class="TLR5" title="Forum Reviews">Forum Reviews</a></li>
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
					<h1><?php echo /*$make_res['title']." ".*/$model_title['title'];?> <span>Features</span></h1>
				</div>
				<?php include ("themes/bhp/includes/common/share.php") ?>
			</div><!-- clearfix -->
				
			<div class="carSpeci clearfix">
				<div class="specifications">									
					<h4 class="TLR5">Overview of Features</h4>
					<div class="text pad10">
						<p><?php echo $sql_overview_feature['field_feature_overview_value'];?></p>
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
					
				<div class="carWireframe">
					<img src="/sites/default/files/<?php echo str_replace("public://","",$sql_image['uri']);?>" width="550" height="230" alt="<?php echo $node->title; ?> Superb"/>
				</div><!-- w490 -->
			
			</div><!-- clearfix -->
		</div><!-- car over view -->
		<div class="engineOptionWrap">
			<div class="TLR5 engineOption">
				<?php
							
							$res_engine=@mysqli_query($sql_engine);
							
							$sql_Engine_toshow=mysqli_query("select title,nid from node where nid=".$vid);
							$r=mysqli_num_rows($sql_Engine_toshow);
							//$res_e=@mysqli_query("select node.title,node.nid from node,field_data_field_variant_nr_engine where node.nid=field_data_field_variant_nr_engine.field_variant_nr_engine_nid and node.status=1 and field_data_field_variant_nr_engine.field_variant_nr_engine_nid!=".$firstvariant['field_variant_nr_engine_nid']);
							
						
							//$res_e=@mysqli_query("SELECT * FROM `field_data_field_nr_make_model` , field_data_field_variant_nr_engine, node WHERE field_data_field_variant_nr_engine.field_variant_nr_engine_nid = field_data_field_nr_make_model.entity_id AND field_data_field_variant_nr_engine.field_variant_nr_engine_nid = node.nid AND node.status =1 AND field_data_field_variant_nr_engine. field_variant_nr_engine_nid !=$vid AND field_data_field_nr_make_model.field_nr_make_model_nid =".$sql_modeldata['field_nr_make_model_nid']." GROUP BY field_data_field_nr_make_model.entity_id");
							
							//echo "SELECT * FROM field_data_field_features_nr_variant, field_data_field_variant_nr_engine, node WHERE field_data_field_variant_nr_engine.entity_id = field_data_field_features_nr_variant.field_features_nr_variant_nid AND field_data_field_variant_nr_engine.field_variant_nr_engine_nid = node.nid AND node.nid!=$vid AND node.status =1 GROUP BY node.nid";
							
							//$res_e=@mysqli_query("SELECT * FROM field_data_field_features_nr_variant, field_data_field_variant_nr_engine, node WHERE field_data_field_variant_nr_engine.entity_id = field_data_field_features_nr_variant.field_features_nr_variant_nid AND field_data_field_variant_nr_engine.field_variant_nr_engine_nid = node.nid AND node.nid!=$vid AND node.status =1 GROUP BY node.nid");
							
		$res_eeeeeeee=@mysqli_query("SELECT node.nid,node.title FROM field_data_field_nr_make_model, node WHERE node.nid = field_data_field_nr_make_model.entity_id and node.status=1 AND field_data_field_nr_make_model.field_nr_make_model_nid=".$sql_modeldata['field_nr_make_model_nid']." and node.nid!=$vid");
	$nnnnnnnnnnn=mysqli_num_rows($res_eeeeeeee);
							
						if($r>0)
							{
							$data_Engine_toshow=@mysqli_fetch_array($sql_Engine_toshow);
							
				?>
				<div class="optionPad">
					Currently showing features for:
					<!--  <select onchange="show_by_engine(this.value,'<?php //echo $node->field_features_model['und'][0]['nid'];?>');">-->
					<select onchange="show_by_engine(this.value);">
					<option value="<?php echo $data_Engine_toshow['nid'];?>"><?php echo $data_Engine_toshow['title'];?></option>
							<?php
							//$entity_id='';
								if($nnnnnnnnnnn>0)
									{
									
									while($rowenginedata=mysqli_fetch_array($res_eeeeeeee))
										{
										$sql_specifi_check=mysqli_num_rows(mysqli_query("SELECT node.title FROM field_data_field_features_nr_variant,field_data_field_variant_nr_engine,node  where field_data_field_variant_nr_engine.entity_id=field_data_field_features_nr_variant.field_features_nr_variant_nid and node.nid=field_data_field_variant_nr_engine.field_variant_nr_engine_nid and node.status=1 and field_data_field_variant_nr_engine.field_variant_nr_engine_nid=".$rowenginedata['nid']));							
										if($sql_specifi_check>0)	
											{
								//$entity_id.=$rowengine['entity_id'].",";
								?>
						 <option value="<?php echo $rowenginedata['nid'];?>"><?php echo $rowenginedata['title'];?></option>
							<?php
											}
										}	
									}
										
								//	echo "Hi Wasim".$entity_id;
							?>
					</select>
				</div>
						<?php
							}
					

						// comment as on 4-7-2011 $sql_vrnts=@mysqli_query("SELECT field_data_field_features_nr_variant.field_features_nr_variant_nid, node.title, field_data_field_features_nr_variant.entity_id ,field_data_field_variant_nr_engine.field_variant_nr_engine_nid FROM field_data_field_features_nr_variant, node, field_data_field_variant_nr_engine WHERE field_data_field_features_nr_variant.field_features_nr_variant_nid = field_data_field_variant_nr_engine.entity_id AND node.status =1 AND node.nid = field_data_field_features_nr_variant.field_features_nr_variant_nid AND field_data_field_variant_nr_engine.field_variant_nr_engine_nid=".$data_Engine_toshow['nid']." group by field_data_field_features_nr_variant.field_features_nr_variant_nid limit 0,4");
								$sql_vrnts=@mysqli_query("SELECT field_data_field_features_nr_variant.field_features_nr_variant_nid, node.title, field_data_field_features_nr_variant.entity_id ,field_data_field_variant_nr_engine.field_variant_nr_engine_nid FROM field_data_field_features_nr_variant, node, field_data_field_variant_nr_engine WHERE field_data_field_features_nr_variant.field_features_nr_variant_nid = field_data_field_variant_nr_engine.entity_id AND node.status =1 AND node.nid = field_data_field_features_nr_variant.field_features_nr_variant_nid AND field_data_field_variant_nr_engine.field_variant_nr_engine_nid=".$data_Engine_toshow['nid']."  limit 0,4");
								$numofrows=@mysqli_num_rows($sql_vrnts);
								
								
								$res_forlist=@mysqli_query($sql_engineforlist);
								$data_entity=mysqli_fetch_array($res_forlist);
								$eid=$data_entity['field_features_engine_nid'];
								
								//$sql_forfirstlist=@mysqli_query("SELECT node.title, field_data_field_features_engine.field_features_engine_nid, field_data_field_features_nr_variant.field_features_nr_variant_nid, field_data_field_features_engine.entity_id,field_data_field_features_model.field_features_model_nid FROM node, field_data_field_features_engine,field_data_field_features_nr_variant, field_data_field_features_model WHERE field_data_field_features_model.entity_id = field_data_field_features_engine.entity_id AND field_data_field_features_model.entity_id = field_data_field_features_nr_variant.entity_id AND node.nid = field_data_field_features_nr_variant.field_features_nr_variant_nid AND field_data_field_features_engine.field_features_engine_nid =".$eid ." and field_data_field_features_model.entity_id=field_data_field_features_engine.entity_id and field_data_field_features_model.field_features_model_nid=".$node->field_features_model['und'][0]['nid']);
	
								$variant_id='';
								while($data_entity=@mysqli_fetch_array($sql_vrnts))
									{
									$variant_id.=$data_entity['field_features_nr_variant_nid'].",";
									$entity_id.=$data_entity['entity_id'].",";
									}
									
								//echo $entity_id;
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
									$sql_vtitle=mysqli_query("select title,nid from node where nid in (".@substr($variant_id,0,-1).") order by nid");
									//$qry_var=mysqli_query("select field_data_field_features_nr_variant.field_features_nr_variant_nid,node.title from node,field_data_field_features_nr_variant where field_data_field_features_nr_variant.field_features_nr_variant_nid=node.nid and field_data_field_features_nr_variant.entity_id in (".substr($entity_id,0,-1).")");
								//$numberofvaraint=mysqli_num_rows($sql_vtitle);
									if(mysqli_num_rows($sql_vtitle)>1)
											{
									?>
									<th>&nbsp;</th>
									<?php
											}
										if(mysqli_num_rows($sql_vtitle)>0)
											{
											//$entity_id='';
											
											while($row_variant=mysqli_fetch_array($sql_vtitle))
												{
											
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
								while($d_ab=@mysqli_fetch_array($sql_airbag))
									{
									echo getOption($d_ab['field_features_air_bags_value']);
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
								while($d_abs=@mysqli_fetch_array($sql_abs))
									{
									//echo $d_abs['field_features_abs_value'];
									echo getOption($d_abs['field_features_abs_value']);
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
								while($d_tcontrol=@mysqli_fetch_array($sql_tcontrol))
									{
										
									echo getOption($d_tcontrol['field_features_traction_value']);
										
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
								while($d_esc=@mysqli_fetch_array($sql_esc))
									{
										echo getOption($d_esc['field_features_esc_value']);
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
								while($d_flight=@mysqli_fetch_array($sql_flight))
									{
									echo getOption($d_flight['field_features_fog_value']);
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
										echo getOption($d_rear['field_features_wipe_value']);
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
								while($d_ei=@mysqli_fetch_array($sql_ei))
									{
									 echo getOption($d_ei['field_features_immobiliser_value']);
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
									echo getOption($d_aw['field_features_alloy_value']);
								   }
							//}
						?>
					<!--  <td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<?php
			$sql_add_Safety=@mysqli_query("SELECT * FROM `team_bhp_features` WHERE nid IN (".substr($entity_id,0,-1).") AND category = 'Safety' GROUP BY feature_name ORDER BY nid");
				if(mysqli_num_rows($sql_add_Safety)>0)
					{
					$e=explode(",",substr($entity_id,0,-1));
					while($d_sft_addit=@mysqli_fetch_array($sql_add_Safety))
									{
						?>
						<tr>
							<td><?php echo $d_sft_addit['feature_name'];?></td>
						 <?php
							 for($l=0;$l<count($e);$l++)
							 	{
							 	$sql_safety=mysqli_query("select feature_option from team_bhp_features where nid=".$e[$l]." and category='Safety' and feature_name='".$d_sft_addit['feature_name']."'");
							 		$r_sft=mysql_fetch_assoc($sql_safety);
							 		echo getOption($r_sft['feature_option']);	
							 	}
						?>
						</tr>
					<?php
								   }
				 	 }
				?>
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
								while($d_ps=@mysqli_fetch_array($sql_ps))
									{
										echo getOption($d_ps['field_features_power_steering_value']);
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
								while($d_sta=@mysqli_fetch_array($sql_sta))
									{
										echo getOption($d_sta['field_features_steering_tilt_value']);
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
								while($d_sra=@mysqli_fetch_array($sql_sra))
									{
										echo getOption($d_sra['field_features_steering_reach_value']);
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
								while($d_hads=@mysqli_fetch_array($sql_hads))
									{
										echo getOption($d_hads['field_features_height_value']);
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
								while($d_als=@mysqli_fetch_array($sql_als))
									{
										echo getOption($d_als['field_features_lumbar_value']);
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
									echo getOption($d_deadpedal['field_features_dead_pedal_value']);
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
								while($d_centerarm=@mysqli_fetch_array($sql_centerarm))
									{
										echo getOption($d_centerarm['field_features_armrest_value']);
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
								while($d_electricmirror=@mysqli_fetch_array($sql_electricmirror))
									{
										echo getOption($d_electricmirror['field_features_mirrors_value']);
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
								while($d_multiinfo=@mysqli_fetch_array($sql_multiinfo))
									{
									echo getOption($d_multiinfo['field_features_info_display_value']);
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
								while($d_parkingsensor=@mysqli_fetch_array($sql_parkingsensor))
									{
									echo getOption($d_parkingsensor['field_features_sensors_value']);
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
								while($d_autogear=@mysqli_fetch_array($sql_autogear))
									{
									 echo getOption($d_autogear['field_features_gear_box_value']);
								    }
							//}
						?>
					<!--<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				
			<?php
			$sql_add_denhance=@mysqli_query("SELECT * FROM `team_bhp_features` WHERE nid IN (".substr($entity_id,0,-1).") AND category = 'Driver Enhancements' GROUP BY feature_name ORDER BY nid");
				if(mysqli_num_rows($sql_add_denhance)>0)
					{
					$e=explode(",",substr($entity_id,0,-1));
					while($d_add_denh=@mysqli_fetch_array($sql_add_denhance))
									{
						?>
						<tr>
							<td><?php echo $d_add_denh['feature_name'];?></td>
						 <?php
							 for($l=0;$l<count($e);$l++)
										{
										$sql_denhance=mysqli_query("select feature_option from team_bhp_features where nid=".$e[$l]." and category='Driver Enhancements' and feature_name='".$d_add_denh['feature_name']."'");
											$r_den=mysql_fetch_assoc($sql_denhance);
											echo getOption($r_den['feature_option']);	
										}
						?>
						</tr>
					<?php
								   }
				 	 }
			?>
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
								while($d_rlocking=@mysqli_fetch_array($sql_rlocking))
									{
									echo getOption($d_rlocking['field_features_remote_value']);
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
								while($d_centerlocking=@mysqli_fetch_array($sql_centerlocking))
									{
									echo getOption($d_centerlocking['field_features_central_value']);
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
								while($d_powerwindow=@mysqli_fetch_array($sql_powerwindow))
									{
										echo getOption($d_powerwindow['field_features_window_value']);
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
								while($d_airconditionar=@mysqli_fetch_array($sql_airconditionar))
									{
									echo getOption($d_airconditionar['field_features_air_conditioner_value']);
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
								while($d_climatecontrol=@mysqli_fetch_array($sql_climatecontrol))
									{
									 echo getOption($d_climatecontrol['field_features_climate_value']);
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
								while($d_rearaicon=@mysqli_fetch_array($sql_rearaicon))
									{
									echo getOption($d_rearaicon['field_features_vents_value']);
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
								while($d_leather=@mysqli_fetch_array($sql_leather))
									{
									echo getOption($d_leather['field_features_seats_value']);
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
								while($d_sunroof=@mysqli_fetch_array($sql_sunroof))
									{
									echo getOption($d_sunroof['field_features_sun_roof_value']);
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
								while($d_fdown=@mysqli_fetch_array($sql_fdown))
									{
									echo getOption($d_fdown['field_features_fold_value']);
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
								while($d_sp_rear=@mysqli_fetch_array($sql_sp_rear))
									{
									echo getOption($d_sp_rear['field_features_split_value']);
								    }
							//}
						?>
					<!--<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
			<?php
			$sql_add_Convenience=@mysqli_query("SELECT * FROM `team_bhp_features` WHERE nid IN (".substr($entity_id,0,-1).") AND category = 'Convenience' GROUP BY feature_name ORDER BY nid");
				if(mysqli_num_rows($sql_add_Convenience)>0)
					{
					$e=explode(",",substr($entity_id,0,-1));
					while($d_add_conv=@mysqli_fetch_array($sql_add_Convenience))
									{
						?>
						<tr>
							<td><?php echo $d_add_conv['feature_name'];?></td>
						 <?php
							 for($l=0;$l<count($e);$l++)
										{
										$sql_Convenience=mysqli_query("select feature_option from team_bhp_features where nid=".$e[$l]." and category='Convenience' and feature_name='".$d_add_conv['feature_name']."'");
											$r_Convenience=mysql_fetch_assoc($sql_Convenience);
											echo getOption($r_Convenience['feature_option']);	
										}
						?>
						</tr>
					<?php
								   }
				 	 }
			?>
			</table><!-- speciTable -->
			
			<table class="speciTable">
				<thead>
					<tr>
						<th colspan="5">Entertainment</th>
					</tr>	
				</thead>
				<?php
			$sql_nofspeaker=@mysqli_query("select field_number_of_speakers_value from field_data_field_number_of_speakers where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
				if(@mysqli_num_rows($sql_nofspeaker)>0)
					{
				?>
				<tr>
					<td>Number of speakers</td>
						<?php
						/*for($i=0;$i<$numberofvaraint;$i++)
							{*/
							
								while($d_nofspeaker=@mysqli_fetch_array($sql_nofspeaker))
									{
									?>
									<td class='aCenter'><?php echo $d_nofspeaker['field_number_of_speakers_value'];?></td>
									<?php
									}
							//}
						?>
					<!--<td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->	
				</tr>
				<?php
					}
				?>
				<tr>
					<td>CD Player</td>
						<?php
						/*for($i=0;$i<$numberofvaraint;$i++)
							{*/
							$sql_cdplayer=@mysqli_query("select field_features_cd_value from field_data_field_features_cd where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_cdplayer=@mysqli_fetch_array($sql_cdplayer))
									{
									echo getOption($d_cdplayer['field_features_cd_value']);
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
								while($d_auxinput=@mysqli_fetch_array($sql_auxinput))
									{
									echo getOption($d_auxinput['field_features_aux_value']);
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
								while($d_usbinput=@mysqli_fetch_array($sql_usbinput))
									{
									echo getOption($d_usbinput['field_features_usb_value']);
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
								while($d_btooth=@mysqli_fetch_array($sql_btooth))
									{
									echo getOption($d_btooth['field_features_bluetooth_value']);
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
							$sql_smc=@mysqli_query("select field_features_steering_value,entity_id from field_data_field_features_steering where entity_id in (".substr($entity_id,0,-1).") order by entity_id");
								while($d_smc=@mysqli_fetch_array($sql_smc))
									{
									echo getOption($d_smc['field_features_steering_value']);
								    }
							//}
						?>
					<!--  <td>&nbsp;</td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>
					<td><div class="tickMarkIcon">&nbsp;</div></td>-->
				</tr>
				<?php
			$sql_add_entertainment=@mysqli_query("SELECT * FROM `team_bhp_features` WHERE nid IN (".substr($entity_id,0,-1).") AND category = 'Entertainment' GROUP BY feature_name ORDER BY nid");
				if(mysqli_num_rows($sql_add_entertainment)>0)
					{
					$e=explode(",",substr($entity_id,0,-1));
					while($d_ent_addit=@mysqli_fetch_array($sql_add_entertainment))
									{
						?>
						<tr>
							<td><?php echo $d_ent_addit['feature_name'];?></td>
						 <?php
							 for($l=0;$l<count($e);$l++)
							 	{
							 	$sql_ent=mysqli_query("select feature_option from team_bhp_features where nid=".$e[$l]." and category='Entertainment' and feature_name='".$d_ent_addit['feature_name']."'");
							 		$r=mysql_fetch_assoc($sql_ent);
							 		echo getOption($r['feature_option']);	
							 	}
						?>
						</tr>
					<?php
								   }
				 	 }
					?>
			</table><!-- speciTable -->
			</div>
		</div><!-- car review -->
		<?php
			}
		?>
	</div><!-- overviewContainer -->
	
	<div class="clearfix articleNavi">
		<a class="fleft btnLeft" href="/reviews">
			<span>Back to Index</span>
		</a>
		<!--<a class="compareClose" id="compareBtn" href="#" onclick="return false;">&nbsp;</a>-->
	</div>
			<?php 
			$sql_model=@mysqli_query("SELECT node.title,node.nid, file_managed.uri,field_data_field_nr_make.field_nr_make_nid,field_data_field_model_dashboard.field_model_dashboard_fid
FROM node,file_managed,field_data_field_nr_make,field_data_field_model_dashboard
WHERE field_data_field_model_dashboard.field_model_dashboard_fid = file_managed.fid
AND field_data_field_model_dashboard.entity_id = node.nid
AND node.status =1 AND field_data_field_nr_make.entity_id=field_data_field_model_dashboard.entity_id and node.nid=".$sql_modeldata['field_nr_make_model_nid']." order by node.changed desc");
$numberofrows=@mysqli_num_rows($sql_model);
							if($numberofrows>0)
									{
				    $sql_sequenceimgmainimg=@mysqli_fetch_array(mysqli_query("SELECT distinct(field_gallery_interior_alt) as alt, field_gallery_interior_title as title, field_gallery_interior_fid as fid FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$sql_modeldata['field_nr_make_model_nid']."' and field_data_field_gallery_interior.field_gallery_interior_alt!='' UNION SELECT distinct(field_gallery_exterior_alt) as alt, field_gallery_exterior_title as title, field_gallery_exterior_fid as fid FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$sql_modeldata['field_nr_make_model_nid']."' and field_data_field_gallery_exterior.field_gallery_exterior_alt!='' UNION SELECT distinct(field_gallery_engine_alt) as alt, field_gallery_engine_title as title, field_gallery_engine_fid as fid FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$sql_modeldata['field_nr_make_model_nid']."' and field_data_field_gallery_engine.field_gallery_engine_alt!='' UNION SELECT distinct(field_gallery_smaller_alt) as alt, field_gallery_smaller_title as title, field_gallery_smaller_fid as fid FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$sql_modeldata['field_nr_make_model_nid']."' and field_data_field_gallery_smaller.field_gallery_smaller_alt!='' order by alt limit 0,1"));
					if($sql_sequenceimgmainimg=='')
						{
						$sql_sequenceimgwithoutorder=@mysqli_fetch_array(mysqli_query("SELECT field_data_field_gallery_interior.delta as delta , field_gallery_interior_title as title, field_gallery_interior_fid as fidint FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$sql_modeldata['field_nr_make_model_nid']."' UNION SELECT field_data_field_gallery_exterior.delta as delta, field_gallery_exterior_title as title, field_gallery_exterior_fid as fidint FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$sql_modeldata['field_nr_make_model_nid']."' UNION SELECT field_data_field_gallery_engine.delta as delta, field_gallery_engine_title as title, field_gallery_engine_fid as fidint FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$sql_modeldata['field_nr_make_model_nid']."' UNION SELECT field_data_field_gallery_smaller.delta as delta, field_gallery_smaller_title as title, field_gallery_smaller_fid as fidint FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$sql_modeldata['field_nr_make_model_nid']."' order by delta limit 0,1"));
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
							$mktitle=@mysqli_fetch_array(mysqli_query("select title from node,field_data_field_nr_make where field_data_field_nr_make.entity_id =".$data_model['nid']." and field_data_field_nr_make.field_nr_make_nid=node.nid"));
							$price_res = @mysql_fetch_assoc(mysqli_query("select min(on_road_price) as minPrice, max(on_road_price) as maxPrice from team_bhp_variant_price, field_data_field_price_nr_variant, field_data_field_variant_nr_engine, field_data_field_nr_make_model where team_bhp_variant_price.city='Delhi' and team_bhp_variant_price.nid=field_data_field_price_nr_variant.entity_id and field_data_field_price_nr_variant.field_price_nr_variant_nid=field_data_field_variant_nr_engine.entity_id and field_data_field_variant_nr_engine.field_variant_nr_engine_nid=field_data_field_nr_make_model.entity_id and field_data_field_nr_make_model.field_nr_make_model_nid=".$data_model['nid']));
							?>
							<li class="clearfix">
								<div class="content firstContent clearfix" id="<?php echo $data_model['nid']; ?>" rel="<?php echo str_replace("review/","",$sql_url['alias'])?>">
									<div class="img">
									<strong>
									<!--<img src="/sites/default/files/<?php echo str_replace("public://","",$data_model['uri']);?>" alt="<?php echo $data_model['nid'];?>" width="61" height="46" />-->
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
									//$sql_modelalternative=@mysqli_query("SELECT node.title,node.nid,field_data_field_model_alternatives.field_model_alternatives_nid from node,field_data_field_model_alternatives WHERE field_data_field_model_alternatives.field_model_alternatives_nid = node.nid AND node.status =1  and field_data_field_model_alternatives.entity_id =".$sql_modeldata['field_nr_make_model_nid']." order by node.changed desc");
									$sql_modelalternative=@mysqli_query("SELECT node.title AS title, node.nid AS nid, field_data_field_model_alternatives.field_model_alternatives_nid FROM node, field_data_field_model_alternatives WHERE field_data_field_model_alternatives.field_model_alternatives_nid = node.nid AND node.status =1 AND field_data_field_model_alternatives.entity_id=".$sql_modeldata['field_nr_make_model_nid']." UNION SELECT node.title AS title, node.nid AS nid, field_data_field_model_alternatives.entity_id FROM node, field_data_field_model_alternatives WHERE field_data_field_model_alternatives.entity_id = node.nid AND node.status =1 AND field_data_field_model_alternatives.field_model_alternatives_nid=".$sql_modeldata['field_nr_make_model_nid']." ORDER BY title");
									include_once("includes/alternative_forreview.php");
									?>
	
	<?php //include ("../themes/bhp/includes/compare.php") ?>
	
	<?php //include ("../themes/bhp/includes/reviews-alternatives.php") ?>
			
</div><!-- articles -->
</div><!-- Left Column -->
	
	

	
	
