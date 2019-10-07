<style>

</style>

<?php
include_once("connect.php");
$sql_overview = @mysqli_query("SELECT node.title,field_data_field_overview_image.field_overview_image_fid,file_managed.uri from node,file_managed,field_data_field_overview_image where field_data_field_overview_image.field_overview_image_fid=file_managed.fid and field_data_field_overview_image.entity_id=node.nid and node.status=1 and node.type='overview'");
$num = mysqli_num_rows($sql_overview);

if ($num > 0) {

    ?>

    <div class="home-slider border-btm-red overview-slider has-caption-grd">

        <?php
        $i = 0;
        while ($data_img = mysqli_fetch_array($sql_overview)) {

            ?>
            <div class="banner-item">
                <a href="javascript:void(0);" title="<?php echo $data_img['title']; ?>" style="background-image: url('/sites/default/files/<?php echo str_replace("public://", "", $data_img['uri']); ?>')">
<!--                    <img rel="--><?php //echo $data_img['title']; ?><!--" title="--><?php //echo $data_img['title']; ?><!--"-->
<!--                         alt="--><?php //echo $data_img['title']; ?><!--"-->
<!--                         src="/sites/default/files/--><?php //echo str_replace("public://", "", $data_img['uri']); ?><!--">-->
				<span class="caption">
					<?php echo $data_img['title']; ?>
				</span>
                </a>
            </div>

            <?php
            $i++;
        }
        ?>

    </div>

<?php

}
?>
