<?php
include_once("connect.php");
$q = "SELECT field_data_field_team_image.field_team_image_fid,node.nid,field_data_field_team_nickname.field_team_nickname_value,
field_data_field_team_intro_text.field_team_intro_text_value, file_managed.uri, node.title,node.nid FROM node, field_data_field_team_nickname, file_managed, field_data_field_team_image,
field_data_field_team_intro_text WHERE field_data_field_team_nickname.entity_id = field_data_field_team_image.entity_id AND field_data_field_team_intro_text.entity_id = node.nid AND
field_data_field_team_image.entity_id=node.nid AND file_managed.fid = field_data_field_team_image.field_team_image_fid AND node.status =1 AND node.type = 'team_member'
GROUP BY field_data_field_team_image.field_team_image_fid ORDER BY field_team_nickname_value";
$sql_memberfotos = @mysqli_query($q);
$numbof_fotos = @mysqli_num_rows($sql_memberfotos);
if ($numbof_fotos > 0) {
    ?>



<!--    team member info-->
    <div class="member-info-wrapper">

        <div id="text-carousel" data-ride="carousel" data-interval="false" class="carousel">
        <div class="carousel-inner">

                <?php
                $i = 1;
                while ($data_menber = mysqli_fetch_array($sql_memberfotos)) {

//                    if ($i % 2 != 0) {
                        $sql_mod_avtar = @mysqli_fetch_array(mysqli_query("SELECT file_managed.uri
FROM field_data_field_moderator_avatar, file_managed
WHERE file_managed.fid = field_data_field_moderator_avatar.field_moderator_avatar_fid
AND field_data_field_moderator_avatar.entity_id =" . $data_menber['nid']));
                        ?>


                        <div class="item <?php print (str_replace(' ', '-', strtolower($data_menber['title']))); ?>">
                            <div class="carousel-content">
                                <h1 class="member-id">
                                    <?php echo $data_menber['title']; ?>
                                    <small><?php echo $data_menber['field_team_nickname_value'];?></small>
                                </h1>
                                <div class="about border-btm-red">
<!--                                    <img src="images/member.png" alt="" title="" class="img-responsive">-->
                                    <img src="/sites/default/files/<?php echo str_replace("public://", "", $data_menber['uri']);?>" alt="<?php echo
                                    $data_menber['title'];?>" class="img-responsive"/>

                                </div>
                                <div class="about-content">
                                    <?php echo $data_menber['field_team_intro_text_value'];?>
                                </div>

                        </div>
                        </div>

                    <?php

//                    }

                    $i++;
                }

                $sql_memberfotosone = @mysqli_query($q);
                ?>

        </div>


<!--        <a href="#text-carousel" data-slide="prev" class="slide-control slide-prev icon-angle-left"></a>-->
<!--        <a href="#text-carousel" data-slide="next" class="slide-control slide-next icon-angle-right"></a>-->

            <a href="javascript:void(0)" class="carousel-close"><i class="icon-close"></i></a>

    </div>




    </div>
<?php
}
?>

