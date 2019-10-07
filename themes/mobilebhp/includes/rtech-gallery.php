
<link rel="stylesheet" href="<?php print base_path().path_to_theme() ?>/styles/lightbox.css" type="text/css"/>

<script type="text/javascript" src="<?php print base_path().path_to_theme() ?>/scripts/lightbox.js"></script>
<script type="text/javascript">

	$(document).ready(function(){


		lightbox.option({
			'resizeDuration': 200,
			'wrapAround': true,
			'showImageNumberLabel': false
		})

	});
</script>
<?php
include_once("connect.php");
$limit = 8;
$slice = 7;
$start = 1;
if(!isset($_REQUEST['page']) || !is_numeric($_REQUEST['page']))
{
	$page = 1;
} 
else 
{
	$page = $_REQUEST['page'];
}
// commented as on 27-02-2012 $sql_rgallery=@mysqli_query("SELECT field_data_field_rtech_image.field_rtech_image_title as title,field_data_field_rtech_image.field_rtech_image_fid,file_managed.uri from node,field_data_field_rtech_image,file_managed where file_managed.fid=field_data_field_rtech_image.field_rtech_image_fid and field_data_field_rtech_image.entity_id=node.nid and node.type='rtech_memorial' and node.status=1 order by node.changed desc");
$sql_rgallery=@mysqli_query("select title,uri from node,file_managed,field_data_field_rtech_image where node.nid=field_data_field_rtech_image.entity_id and field_data_field_rtech_image.field_rtech_image_fid=file_managed.fid and node.status=1 and node.type='rtech_image' order by created desc");

$numbof_rgallery=@mysqli_num_rows($sql_rgallery);
		if($numbof_rgallery>0)
		{
?>


<div class="memorial-slider">
			<?php
			$i=0;
			while($data_gallery=mysqli_fetch_array($sql_rgallery))
			{
			?>


	<div class="memorial">
		<a href="/sites/default/files/<?php echo str_replace("public://","",$data_gallery['uri']);?>" data-lightbox="rtech-gallery" rel="lightbox[rtech]" >
			<img rel="<?php if($page){ echo $data_gallery['title']; } ?>" title="<?php echo $data_gallery['title'];?>" alt="<?php echo $data_gallery['title'];?>" src="/sites/default/files/<?php echo str_replace("public://","",$data_gallery['uri']);?>">
		</a>
		<div class="caption"><?php echo $data_gallery['title'];?></div>
	</div>

			<?php
				if($i==0)
				{
				$caption = $data_gallery['title'];
				}
			$i++;
			}
			?>

	</div>

	<?php
	}
	?>
