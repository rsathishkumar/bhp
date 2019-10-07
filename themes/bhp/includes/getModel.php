<?php
$make = $_REQUEST['make'];
include_once("connect.php");
$model_res = @mysqli_query("select nid, title from node, field_data_field_nr_make where node.type='model' and node.nid=field_data_field_nr_make.entity_id and status='1' and field_data_field_nr_make.field_nr_make_nid=".$make." order by node.title") or die(mysql_error());
if(@mysqli_num_rows($model_res)>0)
{
?>
	<option>Select Model</option>
	<?php
	while($model_row=mysql_fetch_assoc($model_res))
	{
	$url_res = @mysql_fetch_assoc(mysqli_query("select alias from url_alias where source='node/".$model_row['nid']."'"));
	?>
	<option value="<?php echo $url_res['alias']; ?>" rel="<?php echo $model_row['nid']; ?>"><?php echo $model_row['title']; ?></option>
	<?php
	}
}
else
{
?>
<option>Select Model<option>
<?php
}
?>

