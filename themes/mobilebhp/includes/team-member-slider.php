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


    <script type="text/javascript">

        (function ($) {

            $(function () {

//                $(".carousel-inner").find(".item:first-child").addClass("active");


                var teamInfoWrap = $(".member-info-wrapper");

                $(".team-listing .slick-slide").click(function() {
                    //alert($(this).attr('data-id'));
                    $("." + $(this).attr('data-id')).addClass("active").siblings().removeClass("active");

                    //hide member thumb list
                    $(".about-team-wrapper").hide();

                    teamInfoWrap.addClass("activated");

//                    $('html, body').animate({scrollTop: teamInfoWrap.offset().top}, 200);

                    $('html, body').animate({scrollTop: 0}, 200);

                });


            });
        })(jQuery);

    </script>

<!--    team member list slider-->
    <div class="other-bhpians">
        <div class="container-fluid">
            <h4 class="section-title text-center">
                <span>Other Team Members</span>
            </h4>
        </div>

        <div class="other-bhpianslider team-listing">

                <?php
                $i = 1;
                while ($data_menber = mysqli_fetch_array($sql_memberfotos)) {

//                    if ($i % 2 != 0) {
                        $sql_mod_avtar = @mysqli_fetch_array(mysqli_query("SELECT file_managed.uri
FROM field_data_field_moderator_avatar, file_managed
WHERE file_managed.fid = field_data_field_moderator_avatar.field_moderator_avatar_fid
AND field_data_field_moderator_avatar.entity_id =" . $data_menber['nid']));
                        ?>

                        <div class="text-center feature-thumbnail" data-id="<?php print (str_replace(' ', '-', strtolower($data_menber['title']))); ?>">
                            <a href="javascript:void(0)" class="team-thumbnail">
                                <span class="thumb" style="overflow: hidden; background-image: url('/sites/default/files/<?php if ($sql_mod_avtar != '') {
                                    echo str_replace("public://", "", $data_menber['uri']);
                                } else {
                                    echo str_replace("public://", "", $sql_mod_avtar['uri']);
                                }?>')" title="<?php echo
                                $data_menber['title'];?>">

                                </span>
<!--                                <img src="/sites/default/files/--><?php //if ($sql_mod_avtar != '') {
//                                    echo str_replace("public://", "", $sql_mod_avtar['uri']);
//                                } else {
//                                    echo str_replace("public://", "", $data_menber['uri']);
//                                }?><!--" alt="--><?php //echo
//                                $data_menber['title'];?><!--"/>-->

                                <span class="text">
                                    <span class="ellipsis">
                                        <?php echo $data_menber['field_team_nickname_value'];?>
                                    </span>
                                </span>
                            </a>
                        </div>

                    <?php

//                    }

                    $i++;
                }

                $sql_memberfotosone = @mysqli_query($q);
                ?>

        </div>


    </div>
<?php
}
?>




