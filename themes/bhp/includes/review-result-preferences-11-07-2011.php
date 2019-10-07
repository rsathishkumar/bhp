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
//for($b1=0; $b1<count($b); $b1)
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
//$model_res = @mysqli_query("select nid, title from node, field_data_field_nr_make where node.type='model' and node.nid=field_data_field_nr_make.entity_id and status='1' and field_data_field_nr_make.field_nr_make_nid=".$make) or die(mysql_error());
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
	$Msort = "desc";
	}
	else
	{
	$mc = " class=\"downArrow\"";
	$pc = "";
	$Psort = "asc";
	$Msort = "asc";
	}
}
//$model_res = @mysqli_query("select distinct(field_data_field_nr_make.entity_id) as ModelID from node INNER JOIN field_data_field_nr_make LEFT JOIN field_data_field_nr_make_model ON field_data_field_nr_make.entity_id=field_data_field_nr_make_model.field_nr_make_model_nid LEFT JOIN field_data_field_variant_nr_engine ON field_data_field_nr_make_model.entity_id=field_data_field_variant_nr_engine.field_variant_nr_engine_nid LEFT JOIN field_data_field_price_nr_variant ON field_data_field_variant_nr_engine.entity_id=field_data_field_price_nr_variant.field_price_nr_variant_nid LEFT JOIN team_bhp_variant_price ON field_data_field_price_nr_variant.entity_id=team_bhp_variant_price.nid where node.nid=field_data_field_nr_make.field_nr_make_nid and node.nid=".$make." order by on_road_price".$order) or die(mysql_error());
//$model_res = @mysqli_query("select distinct(field_data_field_nr_make.entity_id) as ModelID from team_bhp_variant_price, field_data_field_price_nr_variant, field_data_field_variant_nr_engine, field_data_field_nr_make_model, field_data_field_nr_make where city='".$city."' and on_road_price>=".($minPrice*100000)." and on_road_price<=".($maxPrice*100000)." and team_bhp_variant_price.nid=field_data_field_price_nr_variant.entity_id and field_data_field_price_nr_variant.field_price_nr_variant_nid=field_data_field_variant_nr_engine.entity_id and field_data_field_variant_nr_engine.field_variant_nr_engine_nid=field_data_field_nr_make_model.entity_id and field_data_field_nr_make_model.field_nr_make_model_nid=field_data_field_nr_make.entity_id order by on_road_price".$order) or die(mysql_error());
//echo "select distinct(field_data_field_nr_make.entity_id) as ModelID from team_bhp_variant_price, field_data_field_price_nr_variant, field_data_field_variant_nr_engine, field_data_field_nr_make_model, field_data_field_engine_fuel, field_data_field_engine_transmission, field_data_field_nr_make, field_data_field_model_body, node where city='".$city."' and on_road_price>=".($minPrice*100000)." and on_road_price<=".($maxPrice*100000)." and team_bhp_variant_price.nid=field_data_field_price_nr_variant.entity_id and field_data_field_price_nr_variant.field_price_nr_variant_nid=field_data_field_variant_nr_engine.entity_id and field_data_field_variant_nr_engine.field_variant_nr_engine_nid=field_data_field_nr_make_model.entity_id".$addFuel.$addTrans." and field_data_field_nr_make_model.field_nr_make_model_nid=field_data_field_nr_make.entity_id and field_data_field_nr_make.entity_id=node.nid".$addBody." order by on_road_price".$order;
//$model_res = @mysqli_query("select distinct(field_data_field_nr_make.entity_id) as ModelID from team_bhp_variant_price, field_data_field_price_nr_variant, field_data_field_variant_nr_engine, field_data_field_nr_make_model, field_data_field_nr_make, field_data_field_model_body where city='".$city."' and on_road_price>=".($minPrice*100000)." and on_road_price<=".($maxPrice*100000)." and team_bhp_variant_price.nid=field_data_field_price_nr_variant.entity_id and field_data_field_price_nr_variant.field_price_nr_variant_nid=field_data_field_variant_nr_engine.entity_id and field_data_field_variant_nr_engine.field_variant_nr_engine_nid=field_data_field_nr_make_model.entity_id and field_data_field_nr_make_model.field_nr_make_model_nid=field_data_field_nr_make.entity_id".$addBody." order by on_road_price".$order) or die(mysql_error());
//$model_res = @mysqli_query("select distinct(field_data_field_nr_make.entity_id) as ModelID, node.title as title from team_bhp_variant_price, field_data_field_price_nr_variant, field_data_field_variant_nr_engine, field_data_field_nr_make_model, field_data_field_engine_fuel, field_data_field_engine_transmission, field_data_field_nr_make, field_data_field_model_body, node where city='".$city."' and on_road_price>=".($minPrice*100000)." and on_road_price<=".($maxPrice*100000)." and team_bhp_variant_price.nid=field_data_field_price_nr_variant.entity_id and field_data_field_price_nr_variant.field_price_nr_variant_nid=field_data_field_variant_nr_engine.entity_id and field_data_field_variant_nr_engine.field_variant_nr_engine_nid=field_data_field_nr_make_model.entity_id".$addFuel.$addTrans." and field_data_field_nr_make_model.field_nr_make_model_nid=field_data_field_nr_make.entity_id and field_data_field_nr_make.field_nr_make_nid=node.nid".$addBody." order by ".$orderBy.$order) or die(mysql_error());
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
/*function limitChars ($str)
{
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
	$k++;
	}
return $particle;
}*/
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
	$model_row1 = @mysql_fetch_assoc(mysqli_query("select title, nid from node where nid=".$model_row['ModelID']));
	$review = @mysql_fetch_assoc(mysqli_query("SELECT file_managed.uri, field_data_field_model_dashboard.field_model_dashboard_fid FROM node,file_managed, field_data_field_model_dashboard WHERE field_data_field_model_dashboard.field_model_dashboard_fid = file_managed.fid AND field_data_field_model_dashboard.entity_id = node.nid AND node.nid=".$model_row1['nid']." AND node.status=1 order by node.changed desc"));
	$url = @mysql_fetch_assoc(mysqli_query("select alias from url_alias where source='node/".$model_row1['nid']."'"));
	$body_style = @mysql_fetch_assoc(mysqli_query("select field_model_body_value from field_data_field_model_body where entity_id=".$model_row1['nid']));
	$owners_liked = @mysqli_query("select field_model_liked_value from field_data_field_model_liked where entity_id=".$model_row1['nid']." limit 3");
	$price_res = @mysql_fetch_assoc(mysqli_query("select min(on_road_price) as minPrice, max(on_road_price) as maxPrice from team_bhp_variant_price, field_data_field_price_nr_variant, field_data_field_variant_nr_engine, field_data_field_nr_make_model where team_bhp_variant_price.city='".$city."' and team_bhp_variant_price.nid=field_data_field_price_nr_variant.entity_id and field_data_field_price_nr_variant.field_price_nr_variant_nid=field_data_field_variant_nr_engine.entity_id and field_data_field_variant_nr_engine.field_variant_nr_engine_nid=field_data_field_nr_make_model.entity_id and field_data_field_nr_make_model.field_nr_make_model_nid=".$model_row1['nid']));
	?>
	<div class="resultReview clearfix<?php if($i==mysqli_num_rows($model_res)) { ?> last<?php }?>">
		<table>
			<tr>
				<td class="w100 aln_center">
				<a href="?q=<?php echo $url['alias']; ?>" title="<?php echo $model_row1['title']; ?>">
					<img src="/sites/default/files/<?php echo str_replace("public://","",$review['uri']);?>" alt="<?php echo $model_row1['title']; ?>" width="70" height="55" border="0" />
				</a>
				</td>
				<td class="owners borderRight w175">
					<h4><a href="?q=<?php echo $url['alias']; ?>" title="<?php echo $model_row1['title']; ?>"><?php echo $model_row['title']." ".$model_row1['title']; ?></a></h4>
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
					<span>Price: <?php echo $minPrice." - ".$maxPrice; ?></span>
					<div class="viewVarDiv">
						<!--<a href="#" class="viewVariant" onclick="showVariants('<?php echo $model_row1['nid']; ?>', '<?php echo $city; ?>'); return false;">View variant Pricing</a>-->
						<a href="#" class="viewVariant" onclick="showVariants('var<?php echo $model_row1['nid']; ?>'); return false;">View variant Pricing</a>
						<div class="viewDropDwn" id="var<?php echo $model_row1['nid']; ?>">
							<a href="#" class="close" class="close" onclick="closeDiv(); return false;">X</a>
							<div class="clearfix marB20">
								<div class="fleft w175 aln_center">
									<img src="/sites/default/files/<?php echo str_replace("public://","",$review['uri']);?>" alt="<?php echo $model_row1['title']; ?>" width="100" height="75" />
								</div>
								
								<div class="fleft w250">
									<h4><?php echo $model_row1['title']; ?></h4>
									<span class="marB20"><?php echo $minPrice." - ".$maxPrice; ?> <br /><?php echo $city; ?></span>
									<a title="Review Overview" href="?q=<?php echo $url['alias']; ?>"><img width="47" height="12" alt="Review" src="themes/bhp/images/buttons/review.png" border="0"></a>
									<a href="compare.php" onclick="getCarID('<?php echo $model_row1['nid']; ?>'); return false;"><img width="57" height="12" alt="Compare" src="themes/bhp/images/buttons/compare.png" border="0"></a>
								</div>
							</div><!-- clearfix -->
							<?php
								$model_engine = mysqli_query("select entity_id from field_data_field_nr_make_model where field_nr_make_model_nid=".$model_row1['nid']) or die(mysql_error());
								if(@mysqli_num_rows($model_engine)>0)
								{
							?>
							<ul class="viewVari">
								<?php
								while($me_row=mysql_fetch_assoc($model_engine))
								{
								$engine_res = @mysql_fetch_assoc(mysqli_query("select title, nid from node where nid=".$me_row['entity_id'])) or die(mysql_error());
								?>
								<li>				
									<table class="datatable clearfix" border="0">
									<?php
										$engine_variant = mysqli_query("select field_data_field_variant_nr_engine.entity_id as entity_id, on_road_price as price from field_data_field_variant_nr_engine, field_data_field_price_nr_variant, team_bhp_variant_price where field_variant_nr_engine_nid=".$engine_res['nid']." and field_data_field_variant_nr_engine.entity_id=field_data_field_price_nr_variant.field_price_nr_variant_nid and field_data_field_price_nr_variant.entity_id=team_bhp_variant_price.nid and city='".$city."'") or die(mysql_error());
										$variantCount = @mysqli_num_rows($engine_variant);
									if($variantCount>0)
										{
										$v = 0;
											while($ev_row=mysql_fetch_assoc($engine_variant))
											{
											//echo "<br />select title, nid from node where nid=".$ev_row['entity_id']."<br />";
											$variant_res = @mysql_fetch_assoc(mysqli_query("select title, nid from node where nid=".$ev_row['entity_id'])) or die(mysql_error());
										?>
											<tr>
											<?php
											if($v==0)
											{
											?>
											<td class="varianttxt" rowspan="<?php echo $variantCount; ?>"><?php echo $engine_res['title']; ?></td>
											<?php
											}
											?>
												<td class="interior"><?php echo $variant_res['title']; ?></td>
											<?php
											if($ev_row['price']!='')
												{
													//$varPrice = to_lakh($ev_row['price'])." Lakh";
													
													$varPrice = "Rs. ".limitChars($ev_row['price']);
												}
											else
												{
													//$varPrice = "(Rs.".str_replace(",,",",",limitChars(number_format($ev_row['price']))).")";
												}
												if($varPrice!='')
													{
											?>
												<td class="modeltxt"><?php echo $varPrice; ?></td>
												<?php
													}
												?>
											</tr>
										<?php
											$v++;
											}
										}
									?>
									</table>
								</li>
								<?php
								}
								?>
							</ul>
							<?php
								}
							?>
						</div>
					</div>
					<?php
					}
					else
					{
					?>
					<div class="viewVarDiv">
						No prices available
					</div>
					<?php
					}
					?>
				</td>
				<td class="borderRight w190">
					<p><!--Body style: --><?php echo $body_style['field_model_body_value']; ?></p>
					<?php
					$fuel = "";
					$transmission = "";
					$fuel_res = @mysqli_query("select distinct(field_engine_fuel_value) as fuel from field_data_field_engine_fuel,  field_data_field_nr_make_model where field_data_field_engine_fuel.entity_id=field_data_field_nr_make_model.entity_id and field_data_field_nr_make_model.field_nr_make_model_nid=".$model_row1['nid']) or die(mysql_error());
					while($fuel_row=mysql_fetch_assoc($fuel_res))
					{
						$fuel .= $fuel_row['fuel'].", ";
					}
					$transmission_res = @mysqli_query("select distinct(field_engine_transmission_value) as transmission from field_data_field_engine_transmission, field_data_field_nr_make_model where field_data_field_engine_transmission.entity_id=field_data_field_nr_make_model.entity_id and field_data_field_nr_make_model.field_nr_make_model_nid=".$model_row1['nid']) or die(mysql_error());
					while($transmission_row=mysql_fetch_assoc($transmission_res))
					{
						$transmission .= $transmission_row['transmission'].", ";
					}
					if($fuel!='')
					{
					?>
					<p><?php echo substr($fuel, 0, -2); ?></p>
					<?php
					}
					if($transmission!='')
					{
					?>
					<p><?php echo substr($transmission, 0, -2); ?></p>
					<?php
					}
					?>
				</td>
				<td class="owners padL20">
					<div class="clearfix">
					<h4 class="fleft">Owner Liked</h4>
						<div class="fright resultReviewBtn padR10">
						<a href="?q=<?php echo $url['alias']; ?>" title="Review Overview"><img src="themes/bhp/images/buttons/review.png" alt="Review" width="47" height="12" /></a>
						<a href="compare.php" onclick="getCarID('<?php echo $model_row1['nid']; ?>'); return false;"><img src="themes/bhp/images/buttons/compare.png" alt="Compare" width="57" height="12" /></a>												
						</div>
					</div>
					
					<ul class="bulletList">
					<?php
					while($o_row=mysql_fetch_assoc($owners_liked))
					{
					?>
						<li><?php echo $o_row['field_model_liked_value']; ?></li>
					<?php
					}
					?>
					</ul>													
				</td>
			</tr>
		</table>
	</div><!-- resultReview -->
	<?php
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
<div class="clearfix">
	<h3 class="fleft pad10">No Reviews found</h3>
	<span class="filter">For <?php echo $for1; ?></span>
</div><!-- clearfix -->
<?php
}
?>
