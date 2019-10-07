<?php  //drupal_add_js(drupal_get_path('theme', 'mobilebhp').'/scripts/home-slider.js'); ?>
<?php
/*$d = mysqli_query("select DATABASE()");
$dRow = mysqli_fetch_array($d);
print_r($dRow);*/



$sql_hpbanner = "select node.title, node.nid, file_managed.uri, field_banner_url_url from node, file_managed,field_data_field_banner_image, field_data_field_banner_url where field_data_field_banner_image.entity_id=node.nid and node.status=1 and field_data_field_banner_image.field_banner_image_fid=file_managed.fid and field_data_field_banner_url.entity_id=node.nid order by node. changed desc";

$res_hbanner=@mysqli_query($sql_hpbanner);
$nofbanner=@mysqli_num_rows($res_hbanner);
$cnthbanner=1;

if($nofbanner>0)
{
	?>
	<section class="home-slider has-caption-grd border-btm-red animate-slider">

        <?php
        $cnforb = 1;
        $res_hbanner = @mysqli_query($sql_hpbanner);
        while ($bannerdata = @mysqli_fetch_array($res_hbanner)) {
            ?>
            <div title="<?php echo $bannerdata['title'];?>" rel="<?php echo $bannerdata['field_banner_url_url'];?>" id="story-<?php echo $cnforb;?>">
                <a href="<?php echo $bannerdata['field_banner_url_url']; ?>" title="<?php echo $bannerdata['title'];?>">

<!--                    style="background-image: url('sites/default/files/--><?php //echo str_replace("public://", "", $bannerdata['uri']);?><!--')"-->

                    <img src="sites/default/files/<?php echo str_replace("public://", "", $bannerdata['uri']);?>"
                        alt="<?php echo $bannerdata['title'];?>"/>

                    <span class="caption"><?php echo $bannerdata['title'];?></span>

                    </a>
            </div>
            <?php
            $cnforb++;
        }
        ?>

</section>
<?php
}
?>
