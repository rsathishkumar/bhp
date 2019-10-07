<?php
$model = $_REQUEST['model'];
include_once("connect.php");
$model_row1 = @mysql_fetch_assoc(mysqli_query("select title, nid from node where nid=".$model));
$review = @mysql_fetch_assoc(mysqli_query("SELECT file_managed.uri, field_data_field_model_dashboard.field_model_dashboard_fid FROM node,file_managed, field_data_field_model_dashboard WHERE field_data_field_model_dashboard.field_model_dashboard_fid = file_managed.fid AND field_data_field_model_dashboard.entity_id = node.nid AND node.nid=".$model." AND node.status=1 order by node.changed desc"));
$url = @mysql_fetch_assoc(mysqli_query("select alias from url_alias where source='node/".$model."'"));
$price_res = @mysql_fetch_assoc(mysqli_query("select min(on_road_price) as minPrice, max(on_road_price) as maxPrice from team_bhp_variant_price, field_data_field_price_nr_variant, field_data_field_variant_nr_engine, field_data_field_nr_make_model where team_bhp_variant_price.city='Delhi' and team_bhp_variant_price.nid=field_data_field_price_nr_variant.entity_id and field_data_field_price_nr_variant.field_price_nr_variant_nid=field_data_field_variant_nr_engine.entity_id and field_data_field_variant_nr_engine.field_variant_nr_engine_nid=field_data_field_nr_make_model.entity_id and field_data_field_nr_make_model.field_nr_make_model_nid=".$model));
$mktitle=@mysqli_fetch_array(mysqli_query("select title from node,field_data_field_nr_make where field_data_field_nr_make.entity_id =".$model_row1['nid']." and field_data_field_nr_make.field_nr_make_nid=node.nid"));
//function to convert price to lakh
function to_lakh_compareCar($no)
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
?>
<div class="content clearfix" id="<?php echo $model_row1['nid']; ?>">
	<div class="img">
	<!--<img src="http://www.team-bhp.com/sites/default/files/<?php echo str_replace("public://","",$review['uri']);?>" alt="<?php echo $model_row1['title']; ?>" width="61" height="48" border="0" />-->
	<img src="http://www.team-bhp.com/?q=sites/default/files/styles/thumb_compare_car/public/<?php echo str_replace("public://","",$review['uri']);?>" alt="<?php echo $mktitle['title']." ". $model_row1['title']; ?>" width="61" height="48" border="0" />
	
	</div>
	<p class="desc">
		<span class="title"><?php echo $mktitle['title']." ".$model_row1['title']; ?></span>
		<?php
		if($price_res['minPrice']!='' & $price_res['maxPrice']!='')
		{
			if($price_res['minPrice']>=100000)
				{
					$minPrice = to_lakh_compareCar($price_res['minPrice']);
				}
			else
				{
					$minPrice = $price_res['minPrice'];
				}
			if($price_res['maxPrice']>=100000)
				{
					$maxPrice = to_lakh_compareCar($price_res['maxPrice'])." Lakh";
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
	<span class="iconRemove" onclick="removeCar(this); return false;">&nbsp;</span>
</div>
