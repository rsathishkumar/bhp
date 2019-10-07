<?php
$descArray = explode('&lt;!--pagebreak--&gt;', $node->field_advice_content['und'][0]['safe_value']);

function returnDate($timestamp)
{
    $difference = time() - $timestamp;

    $seven_daysbefore = time() - strtotime(" - 7 day");

    if ($difference <= $seven_daysbefore) {
        $periods = array('second', 'minute', 'hour', 'day', 'week', 'month', 'year');
        $multiples = array('seconds', 'minutes', 'hours', 'days', 'weeks', 'months', 'years');
        $lengths = array('60', '60', '24', '7', '4.35', '12');
        for ($i = 0; $difference >= $lengths[$i]; $i++) {
            $difference /= $lengths[$i];
        }
        $difference = round($difference);
        if ($difference != 1) {
            $periods[$i] = $multiples[$i];
        }
        $text = $difference . ' ' . $periods[$i];
        if ($text == "7 days") {
            $text = date("jS F Y, H:i", $timestamp);
            return $text;
        } else {
            return $text . " ago";
        }

    } else {
        return date("jS F Y, H:i", $timestamp);
    }

}

?>

<link rel="stylesheet" href="<?php print base_path().path_to_theme() ?>/styles/lightbox.css" type="text/css"/>

<script type="text/javascript" src="<?php print base_path().path_to_theme() ?>/scripts/lightbox.js"></script>

<script type="text/javascript">

    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true,
        'showImageNumberLabel': false
    })

    function redirectbycat(catname) {
        window.location = '/?q=advice&catname=' + catname;
    }
    (function (jQuery) {

    })(jQuery);
</script>


<div class="article">

    <div class="container-fluid">
            <h1><?php echo $node->title; ?></h1>

        <div class="date" style="display: none;">
            <?php echo returnDate($node->created); ?>
            <a href="javascript:void(0);"><?php print $name; ?></a>
        </div>

    </div>

            <div class="news_details clearfix">

                <!--clearfix -->

                <?php
                //include ("includes/common/inner-pagination.php");
                //$descArray = explode('<!--pagebreak-->', $node->field_advice_content['und'][0]['safe_value']);
                if (count($descArray) > 1) {
                    $node->field_advice_content['und'][0]['safe_value'] = explode('&lt;!--pagebreak--&gt;', $node->field_advice_content['und'][0]['safe_value']);

                    ?>
                            <script type="text/javascript">
                                (function (jQuery) {

                                    jQuery(function () {
                                        jQuery('.next').click(function () {
                                            jQuery('.article-desc').css('display', 'none');
                                            jQuery(jQuery(this).attr('href')).css('display', 'block');
                                            jQuery('ul.pagination li a').removeClass('active');
                                            jQuery('ul.pagination li a[href="' + jQuery(this).attr('href') + '"]').addClass('active');
                                            jQuery('html, body').animate({scrollTop: jQuery("h1").offset().top - 10}, 300);
                                            return false;
                                        });
                                        jQuery('ul.pagination li a').click(function () {
                                            jQuery('.article-desc').css('display', 'none');
                                            jQuery('ul.pagination li a').removeClass('active');
                                            jQuery('ul.pagination li a[href="' + jQuery(this).attr('href') + '"]').addClass('active');
                                            jQuery('html, body').animate({scrollTop: jQuery("h1").offset().top - 10}, 300);
                                            jQuery(jQuery(this).attr('href')).css('display', 'block');
                                            return false;
                                        });

                                    });
                                })(jQuery);
                            </script>
<!--                            <div class="text-center InnerPagination">-->
<!--                                <ul class="pagination pagination-sm">-->
<!--                                    <li class="first">Page</li>-->
<!--                                    --><?php
//                                    for ($i = 0; $i < count($descArray); $i++) {
//                                        ?>
<!--                                        <li>-->
<!--                                            <a title="go to page --><?php //echo $i + 1; ?><!--"--><?php //if ($i == 0) { ?><!-- class="active"--><?php //} ?>
<!--                                               href="#p--><?php //echo $i; ?><!--">--><?php //echo $i + 1; ?><!--</a></li>-->
<!--                                    --><?php
//                                    }
//                                    ?>
<!--                                </ul>-->
<!--                            </div>-->

                <?php
                }
                ?>

                <div class="full_news marT10">
                    <?php
                    if ($node->field_advice_media_type['und'][0]['value'] == 'Image') {
                        ?>

                        <div class="slider-bg single">
                            <div class="container-fluid">
                                <div class="content-img">
                                    <a href="/?q=sites/default/files/styles/check_tech_stuff_hover/public/<?php echo str_replace("public://", "", $node->field_advice_images['und'][0]['uri']);?>"
                                       data-lightbox="image-1" class="text-center <?php if ($cnt_newsimg == 0) { ?> active<?php } ?>"
                                       title="<?php echo $node->title; ?>" rel="lightbox[advice]" style="background-image: url('/?q=sites/default/files/styles/check_tech_stuff/public/<?php echo str_replace("public://", "", $node->field_advice_images['und'][0]['uri']);?>');">

<!--                                        <img src="/?q=sites/default/files/styles/check_tech_stuff/public/--><?php //echo str_replace("public://", "", $node->field_advice_images['und'][0]['uri']);?><!--"--><?php //if ($cnt_newsimg == 0) { ?><!-- id="mainPhoto"--><?php //} ?>
<!--                                             alt="--><?php //echo $node->title; ?><!--" class="slider-image"/>-->
                                    </a>
                                </div>
                            </div>

                        </div>


                    <?php
                    } else {
                        if (strpos($node->field_advice_video['und'][0]['url'], "youtu.be/") > 1) {
                            $uVid = substr($node->field_advice_video['und'][0]['url'], 16);
                        } else {
                            $strfinded = "&feature=related";
                            $replaced_videosource = @str_replace($strfinded, "", $node->field_advice_video['und'][0]['url']);
                            $explodedsource = @explode("=", $replaced_videosource);
                            if (strpos($explodedsource[1], '&feature') > 0) {
                                $uVid = substr($explodedsource[1], 0, strpos($explodedsource[1], '&feature'));
                            } else {
                                $uVid = $explodedsource[1];
                            }
                        }
                        ?>
                        <div class="aln_center marB20 marT20">
                            <object width="428" height="256" id="youtubeVideo">
                                <param name="movie" value="http://www.youtube.com/v/<?php echo $uVid;?>&hl=en_US&feature=player_embedded&version=3"></param>
                                <embed
                                    src="http://www.youtube.com/v/<?php echo $uVid;?>&hl=en_US&feature=player_embedded&version=3"
                                    type="application/x-shockwave-flash" width="428" height="256" wmode="opaque">
                                </embed>
                            </object>
                        </div>
                    <?php
                    }
                    ?>

                    <div class="descripptionFlow">
                        <?php
                        if (count($descArray) > 1) {

                            for ($i = 0; $i < count($descArray); $i++) {
                                //echo "";
                                ?>
                                <div class="article-desc"
                                     id="p<?php echo $i; ?>"<?php if ($i > 0) { ?> style="display:none;"<?php } ?>>
                                    <?php
                                    //echo $descArray[$i];
                                    /*$search = array('&amp;l', '&lt;','>','<','!--smart_paging_filter_done---','!--smart_paging_filter_done--p','&gt;');
                                    $replace = array('','','','','','','');*/
                                    $node->field_advice_content['und'][0]['safe_value'][$i] = str_replace("&lt;!--pagebreak--&gt;", "", $node->field_advice_content['und'][0]['safe_value'][$i]);
                                    //$node->field_advice_content['und'][0]['safe_value'][$i]=str_replace("&lt;!--pagebreak--&gt;","",$node->field_advice_content['und'][0]['safe_value'][$i]);
                                    $node->field_advice_content['und'][0]['safe_value'][$i] = str_replace("&gt;", "", $node->field_advice_content['und'][0]['safe_value'][$i]);
                                    $node->field_advice_content['und'][0]['safe_value'][$i] = str_replace("&lt;", "", $node->field_advice_content['und'][0]['safe_value'][$i]);
                                    $node->field_advice_content['und'][0]['safe_value'][$i] = str_replace("<div>", "", $node->field_advice_content['und'][0]['safe_value'][$i]);
                                    $node->field_advice_content['und'][0]['safe_value'][$i] = str_replace("</div>", "", $node->field_advice_content['und'][0]['safe_value'][$i]);
                                    $node->field_advice_content['und'][0]['safe_value'][$i] = str_replace("<p></p>", "", $node->field_advice_content['und'][0]['safe_value'][$i]);
//                                    $node->field_advice_content['und'][0]['safe_value'][$i] = str_replace('<em class="placeholder">!--</em>start--', "<strong class='reviewQuotes'><span class='openingQuotes'>&ldquo;</span>", $node->field_advice_content['und'][0]['safe_value'][$i]);
//                                    $node->field_advice_content['und'][0]['safe_value'][$i] = str_replace('<em class="placeholder">!--</em>end--', "<span class='closingQuots'>&rdquo;</span></strong>", $node->field_advice_content['und'][0]['safe_value'][$i]);
                                    if ($i != 0) {
                                        echo "<p>";
                                    }

//                                    print $node->field_advice_content['und'][0]['safe_value'][$i];

                                    print str_replace('<p>&nbsp;</p>', '',  $node->field_advice_content['und'][0]['safe_value'][$i]);


                                    if ($i != 0) {
                                        echo "</p>";
                                    }
                                    if ($i < count($descArray) - 1) {
                                        ?>
                                        <a title="Next Page" href="#p<?php echo $i + 1; ?>" class="next">Next Page ></a>
                                    <?php
                                    }
                                    ?>


                                    <div class="text-center">
                                        <a href="<?php echo $node->field_advice_forum['und'][0]['url'];?>" target="_blank"
                                           class="btn btn-red"><span>View Forum Discussion</span></a>
                                    </div>

                                </div>

                            <?php
                            }
                        } else {
                            ?>
                            <div class="article-desc">
                                <?php
                                echo str_replace('<p>&nbsp;</p>', '',  $node->field_advice_content['und'][0]['value']);
                                ?>

                                <?php
                                if ($node->field_advice_forum['und'][0]['url'] != '') {
                                    ?>
                                    <div class="text-center">
                                        <a href="<?php echo $node->field_advice_forum['und'][0]['url'];?>" target="_blank"
                                           class="btn btn-red"><span>View Forum Discussion</span></a>
                                    </div>

                                <?php
                                }
                                ?>




                            </div>
                        <?php
                        }
                        ?>

                        <!-- /1063105/mobileislandportal -->
                        <div id='div-gpt-ad-1497334572605-0' style='height:250px; width:300px; display: block; margin: 0 auto 15px auto;'>
                            <script>
                                googletag.cmd.push(function() { googletag.display('div-gpt-ad-1497334572605-0'); googletag.pubads().refresh(); });
                            </script>
                        </div>

                    </div>
                    <!-- description flow -->

<!--                    <div class="fright ">-->
<!--                        --><?php
//                        //include ("includes/common/inner-pagination.php");
//                        if (count($descArray) > 1) {
//                            ?>
<!--                            <div class="clearfix InnerPagination">-->
<!--                                <ul class="pagination">-->
<!--                                    <li class="first">Page</li>-->
<!--                                    --><?php
//                                    for ($i = 0; $i < count($descArray); $i++) {
//                                        ?>
<!--                                        <li>-->
<!--                                            <a title="go to page --><?php //echo $i + 1; ?><!--"--><?php //if ($i == 0) { ?><!-- class="active"--><?php //} ?>
<!--                                               href="#p--><?php //echo $i; ?><!--">--><?php //echo $i + 1; ?><!--</a></li>-->
<!--                                    --><?php
//                                    }
//                                    ?>
<!--                                </ul>-->
<!--                            </div>-->
<!--                        --><?php
//                        }
//                        ?>
<!--                    </div>-->


                </div>
                <!-- full news -->





            </div>

    <!--share buttons-->
    <?php include("includes/common/share.php") ?>

    <?php //include("includes/common/navigate-articles.php"); ?>



    <!--		ad wrpper-->
<!--    <div class="ad-wrapper text-center">-->
<!--        Ad goes here-->
<!--    </div>-->
    <!--		ad wrpper-->


    <?php include("includes/realated-articles.php"); ?>

</div><!-- article -->

<style>
    em.placeholder {
        font-style: normal;
    }
</style>