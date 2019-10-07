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
$make = $_REQUEST['make'];
include_once("connect.php");
//$model_res = @mysqli_query("select nid, title from node, field_data_field_nr_make where node.type='model' and node.nid=field_data_field_nr_make.entity_id and status='1' and field_data_field_nr_make.field_nr_make_nid=".$make) or die(mysql_error());
if($_REQUEST['order']!='')
{
$order = " ".$_REQUEST['order'];
}
else
{
$order = " desc";
}
if($order==" desc")
{
	$sort = "asc";
	$c = "upArrow";
}
else
{
	$sort = "desc";
	$c = "downArrow";
}
if($_REQUEST['city']!='')
{
$city = $_REQUEST['city'];
}
else
{
$city = 'Delhi';
}
//echo "select distinct(field_data_field_nr_make.entity_id) as ModelID from node INNER JOIN field_data_field_nr_make LEFT JOIN field_data_field_nr_make_model ON field_data_field_nr_make.entity_id=field_data_field_nr_make_model.field_nr_make_model_nid LEFT JOIN field_data_field_variant_nr_engine ON field_data_field_nr_make_model.entity_id=field_data_field_variant_nr_engine.field_variant_nr_engine_nid LEFT JOIN field_data_field_price_nr_variant ON field_data_field_variant_nr_engine.entity_id=field_data_field_price_nr_variant.field_price_nr_variant_nid LEFT JOIN team_bhp_variant_price ON field_data_field_price_nr_variant.entity_id=team_bhp_variant_price.nid where node.nid=field_data_field_nr_make.field_nr_make_nid and node.status=1 and node.nid=".$make." order by on_road_price".$order;
$model_res = @mysqli_query("select distinct(field_data_field_nr_make.entity_id) as ModelID from node INNER JOIN field_data_field_nr_make LEFT JOIN field_data_field_nr_make_model ON field_data_field_nr_make.entity_id=field_data_field_nr_make_model.field_nr_make_model_nid LEFT JOIN field_data_field_variant_nr_engine ON field_data_field_nr_make_model.entity_id=field_data_field_variant_nr_engine.field_variant_nr_engine_nid LEFT JOIN field_data_field_price_nr_variant ON field_data_field_variant_nr_engine.entity_id=field_data_field_price_nr_variant.field_price_nr_variant_nid LEFT JOIN team_bhp_variant_price ON field_data_field_price_nr_variant.entity_id=team_bhp_variant_price.nid where node.nid=field_data_field_nr_make.field_nr_make_nid and node.status=1 and node.nid=".$make." order by on_road_price".$order) or die(mysql_error());
$make_res = @mysql_fetch_assoc(mysqli_query("select title from node where nid=".$make." and status='1'"));
if(@mysqli_num_rows($model_res)>0)
{
$model_restochecknumber = @mysqli_query("select distinct(field_data_field_nr_make.entity_id) as ModelID from node INNER JOIN field_data_field_nr_make LEFT JOIN field_data_field_nr_make_model ON field_data_field_nr_make.entity_id=field_data_field_nr_make_model.field_nr_make_model_nid LEFT JOIN field_data_field_variant_nr_engine ON field_data_field_nr_make_model.entity_id=field_data_field_variant_nr_engine.field_variant_nr_engine_nid LEFT JOIN field_data_field_price_nr_variant ON field_data_field_variant_nr_engine.entity_id=field_data_field_price_nr_variant.field_price_nr_variant_nid LEFT JOIN team_bhp_variant_price ON field_data_field_price_nr_variant.entity_id=team_bhp_variant_price.nid where node.nid=field_data_field_nr_make.field_nr_make_nid and node.status=1 and node.nid=".$make) or die(mysql_error());

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
		$res=$res.".0";
		}
		return $res;
	}
else
	{
		return 0;
	}
}
//echo "Here. ".to_lakh("255850");

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
	if(@mysqli_num_rows($model_res)>0)
	{
?>
	<div class="clearfix">
			<h3 class="fleft pad10"><?php echo mysqli_num_rows($model_res); ?> Result<?php if(mysqli_num_rows($model_res)>1) { ?>s<?php } ?> Found</h3><span class="filter">For <?php echo $make_res['title']; ?></span>
		
	</div><!-- clearfix -->
	<div class="borderBottom clearfix sortBox">
		<div class="fleft">Sort By:
			<?php
			if(mysqli_num_rows($model_res)>1)
			{
			?>
			<a href="#" class="<?php echo $c; ?>" title="sort" onclick="sort('<?php echo $sort; ?>', '<?php echo $make; ?>', '<?php echo $city; ?>'); return false;">Price</a>
			<?php
			}
			else
			{
			?>
			<a href="#" onclick="return false;">Price</a>
			<?php
			}
			?>
		</div>
		
		<div class="priceByCity">
			on Road Price : 
			<select onchange="city('<?php echo $make; ?>', this.value)">
				<optgroup label="- select city -">
					<option value="Mumbai"<?php if($city=='Mumbai') { ?> selected="selected"<?php } ?>>Mumbai</option>
					<option value="Delhi"<?php if($city=='Delhi') { ?> selected="selected"<?php } ?>>Delhi</option>
					<option value="Bangalore"<?php if($city=='Bangalore') { ?> selected="selected"<?php } ?>>Bangalore</option>
					<option value="Kolkatta"<?php if($city=='Kolkatta') { ?> selected="selected"<?php } ?>>Kolkatta</option>
					<option value="Hyderabad"<?php if($city=='Hyderabad') { ?> selected="selected"<?php } ?>>Hyderabad</option>
					<option value="Chennai"<?php if($city=='Chennai') { ?> selected="selected"<?php } ?>>Chennai</option>
					<option value="Pune"<?php if($city=='Pune') { ?> selected="selected"<?php } ?>>Pune</option>
					<option value="Cochin"<?php if($city=='Cochin') { ?> selected="selected"<?php } ?>>Cochin</option>
					<option value="Others"<?php if($city=='Others') { ?> selected="selected"<?php } ?>>Others</option>
				</optgroup>
			</select>
		</div>
		
		
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
					<!-- <li><a title="go to page <?php echo $i; ?>"<?php if($i==1) { ?> class="active"<?php } ?> href="#"><?php echo $i; ?></a></li> -->
					<?php
					$i++;
						}
					}
				?>
			</ul>
		</div>
		<?php
		}
		?>
	</div><!-- clearfix -->
	<?php
	$i = 1;
	while($model_row=mysql_fetch_assoc($model_res))
	{
	$model_row1 = @mysql_fetch_assoc(mysqli_query("select title, nid from node where nid=".$model_row['ModelID']));
	$review = @mysql_fetch_assoc(mysqli_query("SELECT file_managed.uri, field_data_field_model_dashboard.field_model_dashboard_fid FROM node,file_managed, field_data_field_model_dashboard WHERE field_data_field_model_dashboard.field_model_dashboard_fid = file_managed.fid AND field_data_field_model_dashboard.entity_id = node.nid AND node.nid=".$model_row1['nid']." AND node.status=1 order by node.changed desc"));
	$url = @mysql_fetch_assoc(mysqli_query("select alias from url_alias where source='node/".$model_row1['nid']."'"));
	$body_style = @mysql_fetch_assoc(mysqli_query("select field_model_body_value from field_data_field_model_body where entity_id=".$model_row1['nid']));
	$owners_liked = @mysqli_query("select field_model_liked_value from field_data_field_model_liked where entity_id=".$model_row1['nid']." limit 3");
	$price_res = @mysql_fetch_assoc(mysqli_query("select min(on_road_price) as minPrice, max(on_road_price) as maxPrice from team_bhp_variant_price, field_data_field_price_nr_variant, field_data_field_variant_nr_engine, field_data_field_nr_make_model where team_bhp_variant_price.city='".$city."' and team_bhp_variant_price.nid=field_data_field_price_nr_variant.entity_id and field_data_field_price_nr_variant.field_price_nr_variant_nid=field_data_field_variant_nr_engine.entity_id and field_data_field_variant_nr_engine.field_variant_nr_engine_nid=field_data_field_nr_make_model.entity_id and field_data_field_nr_make_model.field_nr_make_model_nid=".$model_row1['nid']));
	//new code
	$sql_sequenceimg=@mysqli_fetch_array(mysqli_query("SELECT distinct(field_gallery_interior_alt) as alt, field_gallery_interior_title as title, field_gallery_interior_fid as fid FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_row1['nid']."' and field_data_field_gallery_interior.field_gallery_interior_alt!='' UNION SELECT distinct(field_gallery_exterior_alt) as alt, field_gallery_exterior_title as title, field_gallery_exterior_fid as fid FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_row1['nid']."' and field_data_field_gallery_exterior.field_gallery_exterior_alt!='' UNION SELECT distinct(field_gallery_engine_alt) as alt, field_gallery_engine_title as title, field_gallery_engine_fid as fid FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_row1['nid']."' and field_data_field_gallery_engine.field_gallery_engine_alt!='' UNION SELECT distinct(field_gallery_smaller_alt) as alt, field_gallery_smaller_title as title, field_gallery_smaller_fid as fid FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_row1['nid']."' and field_data_field_gallery_smaller.field_gallery_smaller_alt!='' order by alt limit 0,1"));
	if($sql_sequenceimg=='')
		{
		$sql_sequenceimgwithorder=@mysqli_fetch_array(mysqli_query("SELECT field_data_field_gallery_interior.delta as delta , field_gallery_interior_title as title, field_gallery_interior_fid as fidint FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_row1['nid']."' UNION SELECT field_data_field_gallery_exterior.delta as delta, field_gallery_exterior_title as title, field_gallery_exterior_fid as fidint FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_row1['nid']."' UNION SELECT field_data_field_gallery_engine.delta as delta, field_gallery_engine_title as title, field_gallery_engine_fid as fidint FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_row1['nid']."' UNION SELECT field_data_field_gallery_smaller.delta as delta, field_gallery_smaller_title as title, field_gallery_smaller_fid as fidint FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$model_row1['nid']."' order by delta limit 0,1"));
			if($sql_sequenceimgwithorder=='')
				{
				$model_imgname="sites/default/files/defaultmodel_53.gif";
				$model_imgnamemedium="sites/default/files/defaultmodel_75.gif";
				}
			else
				{
			$model_img=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$sql_sequenceimgwithorder['fidint']));
			$model_imgname="?q=sites/default/files/styles/check_thumb_review_detail/public/".str_replace("public://","",$model_img['uri']);
			$model_imgnamemedium="?q=sites/default/files/styles/medium_medium/public/".str_replace("public://","",$model_img['uri']);
				}
		}
	else
		{
		$model_img=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$sql_sequenceimg['fid']));
		$model_imgname="?q=sites/default/files/styles/check_thumb_review_detail/public/".str_replace("public://","",$model_img['uri']);
		$model_imgnamemedium="?q=sites/default/files/styles/medium_medium/public/".str_replace("public://","",$model_img['uri']);
		}
	//new code
	
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
					<!-- <li><a title="go to page <?php echo $i; ?>"<?php if($i==1) { ?> class="active"<?php } ?> href="#"><?php echo $i; ?></a></li> -->
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
		<span class="filter">For <?php echo $make_res['title']; ?></span>
	</div>
	<div class="noResult">
		<strong>No cars match your search.</strong>
		<p>To reset the filter &amp; start again <a href="#" onclick="reset(); return false;">Click Here</a></p>
	</div>
	</div><!-- clearfix -->
	<?php
	}
	?>
