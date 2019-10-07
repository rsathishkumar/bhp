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



    <!--    team member list-->
    <div class="main-team-wrapper">
        <div class="about-team-wrapper">
            <div class="container-fluid">
                <ul class="row team-listing">
                    <?php
                    $i = 1;
                    while ($data_menber = mysqli_fetch_array($sql_memberfotos)) {

                        //  if ($i % 2 != 0) {
                        $sql_mod_avtar = @mysqli_fetch_array(mysqli_query("SELECT file_managed.uri
FROM field_data_field_moderator_avatar, file_managed
WHERE file_managed.fid = field_data_field_moderator_avatar.field_moderator_avatar_fid
AND field_data_field_moderator_avatar.entity_id =" . $data_menber['nid']));
                        ?>

                        <li class="col-xs-6 col-sm-4"
                            data-id="<?php print (str_replace(' ', '-', strtolower($data_menber['title']))); ?>">
                            <a href="javascript:void(0)" class="team-thumbnail">
                                <span class="thumb"
                                      style="background-image: url('/sites/default/files/<?php if ($sql_mod_avtar != '') {
//
                                          echo str_replace("public://", "", $data_menber['uri']);
                                      } else {
                                          echo str_replace("public://", "", $sql_mod_avtar['uri']);
                                      }
                                      ?>')" title="<?php echo
                                $data_menber['title']; ?>">

                                </span>
                                <!--                                <img src="/sites/default/files/-->
                                <?php //if ($sql_mod_avtar != '') {
                                //                                    echo str_replace("public://", "", $sql_mod_avtar['uri']);
                                //                                } else {
                                //                                    echo str_replace("public://", "", $data_menber['uri']);
                                //                                }?><!--" alt="--><?php //echo
                                //                                $data_menber['title'];?><!--"/>-->

                                <span class="text">
                                    <span
                                        class="ellipsis"><?php echo $data_menber['field_team_nickname_value']; ?></span>
                                <!--<h4>--><?php //echo $data_menber['title'];
                                    ?><!--</h4>-->
                                </span>
                            </a>
                        </li>

                        <?php

                        //  }

                        $i++;
                    }

                    $sql_memberfotosone = @mysqli_query($q);
                    ?>

                </ul>
            </div>
        </div>


        <!-- team member infor carousel -->

        <?php include(drupal_get_path('theme', 'mobilebhp') . '/includes/team-member-profile.php'); ?>


    </div>
    <!--team slider-->
    <?php include(drupal_get_path('theme', 'mobilebhp') . '/includes/team-member-slider.php'); ?>
<?php
}
?>


<script type="text/javascript">

    (function ($) {

        $(function () {

//                $(".carousel-inner").find(".item:first-child").addClass("active");

            var teamInfoWrap = $(".member-info-wrapper");

//            hide other bhpian slider by default
            $('.other-bhpians').hide();


//            open member profile carousel
            $(".team-listing li").click(function () {
                $("." + $(this).attr('data-id')).addClass("active").siblings().removeClass("active");

//
                teamInfoWrap.addClass("activated").show();

//                $(".about-team-wrapper").hide();


                if (teamInfoWrap.hasClass("activated")) {
//                    alert('hide');
                    $(".about-team-wrapper").fadeOut( "fast" );
                    $('.other-bhpians').show();
                    $('h1.hastabs').hide();
                    $('.sub-nav').hide();
                    //bhpianSlick();

                } else {
//                    alert('show');
                    $(".about-team-wrapper").fadeIn( "slow" );
                    $('.other-bhpians').hide();
                    $('h1.hastabs').show();
                    $('.sub-nav').show();
                }

//                $('html, body').animate({scrollTop: teamInfoWrap.offset().top}, 200);

                $('html, body').animate({scrollTop: 0}, 200);

            });


            // close member profile carousel
            $(document).on('click', '.carousel-close', function () {
                $(".about-team-wrapper").fadeIn( "fast" );
                teamInfoWrap.removeClass("activated").fadeOut( "slow" );
                $('.other-bhpians').hide();
                $('h1.hastabs').show();
                $('.sub-nav').show();

            });


        });
    })(jQuery);

</script>
