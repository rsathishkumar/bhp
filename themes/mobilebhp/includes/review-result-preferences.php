<?php
if($_REQUEST['isAdded']==0)
{
?>
<script type="text/javascript" src="/themes/mobilebhp/js/jquery.fancybox-1.3.4.pack.js"></script>
<?php
}
?>
<link rel="stylesheet" type="text/css" href="/themes/mobilebhp/css/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
jQuery(function(){
	jQuery.fancybox.init();
	jQuery(".viewVariant").fancybox();
});
</script>
<?php
$city = $_REQUEST['city'];
$minPrice = $_REQUEST['minPrice'];
$maxPrice = $_REQUEST['maxPrice'];
if($minPrice<=9000000)
{
$mn = ($minPrice/100000)." Lakh";
}
else
{
$mn = ($minPrice/1000000)." Crore";
}
if($maxPrice<=9000000)
{
$mx = ($maxPrice/100000)." Lakh";
}
else
{
$mx = ($maxPrice/1000000)." Crore";
}
$for1 = $mn." - ".$mx." (".$city.")";
if($_REQUEST['bs']!='')
{
$for1 = $for1." & ".str_replace(",",", ",$_REQUEST['bs']);
$body_style = $_REQUEST['bs'];
$addBody = " and field_data_field_nr_make.entity_id=field_data_field_model_body.entity_id and ";
if(strpos($body_style, ',')>1)
	{
$b = explode(',', $body_style);
$addb = "(";
foreach($b as $val)
	{
	$addb .= " field_data_field_model_body.field_model_body_value='".$val."' or";
	}
	$addBody .= substr($addb,0, -3).")";
	}
else
	{
	$addBody .= " field_data_field_model_body.field_model_body_value='".$body_style."'";
	}
}
else
{
	$addBody = "";
}
if($_REQUEST['fuel']!='')
{
$for1 = $for1." & ".str_replace(",",", ",$_REQUEST['fuel']);
$fuel = $_REQUEST['fuel'];
$addFuel = " and field_data_field_nr_make_model.entity_id=field_data_field_engine_fuel.entity_id and ";
if(strpos($fuel, ',')>1)
	{
$f = explode(',', $fuel);
$addf = "(";
foreach($f as $val)
	{
	$addf .= " field_data_field_engine_fuel.field_engine_fuel_value='".$val."' or";
	}
	$addFuel .= substr($addf,0, -3).")";
	}
else
	{
	$addFuel .= " field_data_field_engine_fuel.field_engine_fuel_value='".$fuel."'";
	}
}
else
{
	$addFuel = "";
}
if($_REQUEST['trans']!='')
{
$for1 = $for1." & ".str_replace(",",", ",$_REQUEST['trans']);
$trans = $_REQUEST['trans'];
$addTrans = " and field_data_field_nr_make_model.entity_id=field_data_field_engine_transmission.entity_id and ";
if(strpos($trans, ',')>1)
	{
$t = explode(',', $trans);
$addt = "(";
foreach($t as $val)
	{
	$addt .= " field_data_field_engine_transmission.field_engine_transmission_value='".$val."' or";
	}
	$addTrans .= substr($addt,0, -3).")";
	}
else
	{
	$addTrans .= " field_data_field_engine_transmission.field_engine_transmission_value='".$trans."'";
	}
}
else
{
	$addTrans = "";
}
include_once("connect.php");
if($_REQUEST['order']!='')
{
$order = " ".$_REQUEST['order'];
}
else
{
$order = " desc";
}
if($_REQUEST['orderBy']!='')
{
$orderBy = $_REQUEST['orderBy'];
}
else
{
$orderBy = "on_road_price";
}
if($order==" desc")
{
	if($orderBy=="on_road_price")
	{
	$pc = " class=\"upArrow\"";
	$mc = "";
	$Psort = "asc";
	$Msort = "asc";
	}
	else
	{
	$mc = " class=\"upArrow\"";
	$pc = "";
	$Psort = "desc";
	$Msort = "desc";
	}
}
else
{
	if($orderBy=="on_road_price")
	{
	$pc = " class=\"downArrow\"";
	$mc = "";
	$Psort = "desc";
	$Msort = "asc";
	}
	else
	{
	$mc = " class=\"downArrow\"";
	$pc = "";
	$Psort = "asc";
	$Msort = "desc";
	}
}
$model_res = @mysqli_query("select distinct(field_data_field_nr_make.entity_id) as ModelID, node.title as title from team_bhp_variant_price, field_data_field_price_nr_variant, field_data_field_variant_nr_engine, field_data_field_nr_make_model, field_data_field_engine_fuel, field_data_field_engine_transmission, field_data_field_nr_make, field_data_field_model_body, node where city='".$city."' and on_road_price>=".$minPrice." and on_road_price<=".$maxPrice." and team_bhp_variant_price.nid=field_data_field_price_nr_variant.entity_id and field_data_field_price_nr_variant.field_price_nr_variant_nid=field_data_field_variant_nr_engine.entity_id and field_data_field_variant_nr_engine.field_variant_nr_engine_nid=field_data_field_nr_make_model.entity_id".$addFuel.$addTrans." and field_data_field_nr_make_model.field_nr_make_model_nid=field_data_field_nr_make.entity_id and field_data_field_nr_make.field_nr_make_nid=node.nid".$addBody." order by ".$orderBy.$order) or die(mysql_error());
if(@mysqli_num_rows($model_res)>0)
{
//function to convert price to lakh
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
			$res = $res.".0";
		}
		return $res;
	}
else
	{
		return 0;
	}
}


function is_divisible ($num, $numtwo) 
{
	$divide = $num % $numtwo;
	if($divide!= 0)
		{
		return FALSE;
		}
	else
	{
		if($num == 0)
		{
		return false;
		}
		else
		{
		return true;
		}
	}
}

function limitChars ($str)
	{
	if($str>=1000000)
		{
	$chars = strlen($str);
	$str = preg_split('//', $str, -1, PREG_SPLIT_NO_EMPTY);
	$k=0;
	$remainder = $chars % 5;
	$charsleft = $chars;
	while($k < $chars)
			{
			if(is_divisible($charsleft, 4))
			{
			if($k!= 0)
			{
			$quotient = $chars - $k;
			}
			else
			{
			$quotient = 0;
			}
			if(is_divisible($quotient, 3))
			{
			$particle = $particle.",".$str[$k];
			}
			else
			{
			$particle = $particle.$str[$k];
			}
			}
			else
			{
			$charsleft--;
				if($k == $remainder)
				{
				 $particle = $particle.",".$str[$k];
				}
				else
				{
				 $particle = $particle.$str[$k];
				}
			}
			$k++;
			}
		}
		else
		{
		$str=number_format($str);
		$chars = strlen($str);
		$str = preg_split('//', $str, -1, PREG_SPLIT_NO_EMPTY);
		$k=0;
		$remainder = $chars % 3;
		$charsleft = $chars;
		while($k < $chars)
			{
			if(is_divisible($charsleft, 3))
				{
					if($k!= 0)
					{
					$quotient = $chars - $k;
					}
					else
					{
					$quotient = 0;
					}
					if(is_divisible($quotient, 3))
					{
					$particle = $particle.",".$str[$k];
					}
					else
					{
					$particle = $particle.$str[$k];
					}
				}
				else
				{
						$charsleft--;
						if($k == $remainder)
						{
						$particle = $particle.",".$str[$k];
						}
						else
						{
						$particle = $particle.$str[$k];
						}
				}
				$particle=str_replace(",,",",",$particle);
			$k++;
			}	
		}
	return $particle;
	}

?>
	<div class="clearfix">
		<h3 class="fleft pad10"><?php echo mysqli_num_rows($model_res); ?> Result<?php if(mysqli_num_rows($model_res)>1) { ?>s<?php } ?> Found</h3>
		<span class="filter">For <?php echo $for1; ?></span>
		
	</div><!-- clearfix -->
	<div class="borderBottom clearfix sortBox">
		<span class="fleft">Sort By:
			<?php
			if(mysqli_num_rows($model_res)>1)
			{
				if($_REQUEST['bs']!='')
				{
					$sendBS = $_REQUEST['bs'];
				}
				else
				{
					$sendBS = 0;
				}
				if($_REQUEST['fuel']!='')
				{
					$sendFUEL = $_REQUEST['fuel'];
				}
				else
				{
					$sendFUEL = 0;
				}
				if($_REQUEST['trans']!='')
				{
					$sendTRANS = $_REQUEST['trans'];
				}
				else
				{
					$sendTRANS = 0;
				}
			?>
			<a href="#"<?php echo $pc; ?> title="sort" onclick="sortPreferences('<?php echo $city; ?>','<?php echo $minPrice; ?>','<?php echo $maxPrice; ?>','<?php echo $sendBS; ?>','<?php echo $sendFUEL; ?>','<?php echo $sendTRANS; ?>','on_road_price','<?php echo $Psort; ?>'); return false;">Price</a>
			<a href="#"<?php echo $mc; ?> title="sort" onclick="sortPreferences('<?php echo $city; ?>','<?php echo $minPrice; ?>','<?php echo $maxPrice; ?>','<?php echo $sendBS; ?>','<?php echo $sendFUEL; ?>','<?php echo $sendTRANS; ?>','title','<?php echo $Msort; ?>'); return false;">Make</a>
			<?php
			}
			else
			{
			?>
			<a href="#" onclick="return false;">Price</a>
				|
			<a href="#" onclick="return false;">Make</a>
			<?php
			}
			?>
		</span>
		
		
		<div class="fright clearfix InnerPagination">
			<ul class="pagination">
				<?php
				if(@mysqli_num_rows($model_res)<=10)
				{
				?>
				<li class="first">Showing <?php echo @mysqli_num_rows($model_res); ?> of <?php echo @mysqli_num_rows($model_res); ?></li>
				<?php
				}
				else
				{
				?>
				<li class="first">Showing 10 of <?php echo @mysqli_num_rows($model_res); ?></li>
				<li class="first">Page</li>
				<?php
				$i = 1;
					while($i<=@mysqli_num_rows($model_res))
					{
				?>
				<li><a title="go to page <?php echo $i; ?>"<?php if($i==1) { ?> class="active"<?php } ?> href="#"><?php echo $i; ?></a></li>
				<?php
				$i++;
					}
			 }
				?>
			</ul>
		</div>
		
	</div><!-- clearfix -->
	<?php
	$i = 1;
	while($model_row=mysql_fetch_assoc($model_res))
	{
						$sql_sequenceimg=@mysqli_fetch_array(mysqli_query("SELECT distinct(field_gallery_interior_alt) as alt, field_gallery_interior_title as title, field_gallery_interior_fid as fid FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_row['ModelID']."' and field_data_field_gallery_interior.field_gallery_interior_alt!='' UNION SELECT distinct(field_gallery_exterior_alt) as alt, field_gallery_exterior_title as title, field_gallery_exterior_fid as fid FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_row['ModelID']."' and field_data_field_gallery_exterior.field_gallery_exterior_alt!='' UNION SELECT distinct(field_gallery_engine_alt) as alt, field_gallery_engine_title as title, field_gallery_engine_fid as fid FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_row['ModelID']."' and field_data_field_gallery_engine.field_gallery_engine_alt!='' UNION SELECT distinct(field_gallery_smaller_alt) as alt, field_gallery_smaller_title as title, field_gallery_smaller_fid as fid FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_row['ModelID']."' and field_data_field_gallery_smaller.field_gallery_smaller_alt!='' order by alt limit 0,1"));
								if($sql_sequenceimg=='')
									{
									
									$sql_sequenceimgwithorder=@mysqli_fetch_array(mysqli_query("SELECT field_data_field_gallery_interior.delta as delta , field_gallery_interior_title as title, field_gallery_interior_fid as fidint FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_row['ModelID']."' UNION SELECT field_data_field_gallery_exterior.delta as delta, field_gallery_exterior_title as title, field_gallery_exterior_fid as fidint FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_row['ModelID']."' UNION SELECT field_data_field_gallery_engine.delta as delta, field_gallery_engine_title as title, field_gallery_engine_fid as fidint FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_row['ModelID']."' UNION SELECT field_data_field_gallery_smaller.delta as delta, field_gallery_smaller_title as title, field_gallery_smaller_fid as fidint FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_row['ModelID']."' order by delta limit 0,1"));
										if($sql_sequenceimgwithorder=='')
											{
											$model_imgname="sites/default/files/defaultmodel_53.gif";
											$model_imgnamemedium="sites/default/files/defaultmodel_75.gif";
											}
										else
											{
										$model_img=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$sql_sequenceimgwithorder['fidint']));
										$model_imgname="?q=sites/default/files/styles/thumb_review_detail/public/".str_replace("public://","",$model_img['uri']);
										$model_imgnamemedium="?q=sites/default/files/styles/check_variant_popup/public/".str_replace("public://","",$model_img['uri']);
											}
									}
								else
									{
									$model_img=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$sql_sequenceimg['fid']));
									$model_imgname="?q=sites/default/files/styles/thumb_review_detail/public/".str_replace("public://","",$model_img['uri']);
									$model_imgnamemedium="?q=sites/default/files/styles/check_variant_popup/public/".str_replace("public://","",$model_img['uri']);
									}
	$model_row1 = @mysql_fetch_assoc(mysqli_query("select title, nid from node where nid=".$model_row['ModelID']));
	$review = @mysql_fetch_assoc(mysqli_query("SELECT file_managed.uri, field_data_field_model_dashboard.field_model_dashboard_fid FROM node,file_managed, field_data_field_model_dashboard WHERE field_data_field_model_dashboard.field_model_dashboard_fid = file_managed.fid AND field_data_field_model_dashboard.entity_id = node.nid AND node.nid=".$model_row1['nid']." AND node.status=1 order by node.changed desc"));
	$url = @mysql_fetch_assoc(mysqli_query("select alias from url_alias where source='node/".$model_row1['nid']."'"));
	$body_style = @mysql_fetch_assoc(mysqli_query("select field_model_body_value from field_data_field_model_body where entity_id=".$model_row1['nid']));
	$owners_liked = @mysqli_query("select field_model_liked_value from field_data_field_model_liked where entity_id=".$model_row1['nid']." limit 3");
	$price_res = @mysql_fetch_assoc(mysqli_query("select min(on_road_price) as minPrice, max(on_road_price) as maxPrice from team_bhp_variant_price, field_data_field_price_nr_variant, field_data_field_variant_nr_engine, field_data_field_nr_make_model where team_bhp_variant_price.city='".$city."' and team_bhp_variant_price.nid=field_data_field_price_nr_variant.entity_id and field_data_field_price_nr_variant.field_price_nr_variant_nid=field_data_field_variant_nr_engine.entity_id and field_data_field_variant_nr_engine.field_variant_nr_engine_nid=field_data_field_nr_make_model.entity_id and field_data_field_nr_make_model.field_nr_make_model_nid=".$model_row1['nid']));
	include("search-row.php");
	$i++;
	}
	?>
	<div class="borderTop clearfix sortBox">
		<div class="fright clearfix InnerPagination">
			<ul class="pagination">
			<?php
			if(@mysqli_num_rows($model_res)<=10)
			{
			?>
				<li class="first">Showing <?php echo @mysqli_num_rows($model_res); ?> of <?php echo @mysqli_num_rows($model_res); ?></li>

		<?php
			}
			else
			{
			?>
			<li class="first">Showing 10 of <?php echo @mysqli_num_rows($model_res); ?></li>
				<li class="first">Page</li>
				<?php
				$i = 1;
					while($i<=@mysqli_num_rows($model_res))
					{
				?>
				<li><a title="go to page <?php echo $i; ?>"<?php if($i==1) { ?> class="active"<?php } ?> href="#"><?php echo $i; ?></a></li>
				<?php
				$i++;
					}
		}
		?>
			</ul>
		</div>
	</div><!-- clearfix -->
<?php
}
else
{
?>
<div class="noResultWrap">
	<div class="clearfix marB40">
		<h3 class="fleft">0 Car Results</h3>
		<span class="filter">For <?php echo $for1; ?></span>
	</div>
	<div class="noResult">
		<strong>No cars match your search.</strong>
		<p>To reset the filter &amp; start again <a href="#" onclick="reset(); return false;">Click Here</a></p>
	</div>
</div><!-- clearfix -->

<?php
}
?>
