<?php
$sql_imglist = mysqli_query("SELECT file_managed.uri FROM `file_managed` , field_data_field_news_images
WHERE field_data_field_news_images.field_news_images_fid = file_managed.`fid`
AND field_data_field_news_images.entity_id =" . $node->nid);

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

    $(document).ready(function(){


        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'showImageNumberLabel': false
        })

    });

</script>

<div class="article content-page-video-img">
    <div class="news_details clearfix">
        <div class="container-fluid">
            <h1><?php echo $node->title; ?> </h1>

            <div class="date">
                <?php echo returnDate($node->created); ?>
                <a href="/aboutus/team"><?php print $name; ?></a>
            </div>
        </div>


        <!--inner pagination-->
        <div class="clearfix">
            <?php
            //include ("includes/common/inner-pagination.php");
            $descArray = explode('&lt;!--pagebreak--&gt;', $node->field_news_content['und'][0]['safe_value']);
            if (count($descArray) > 1) {
                $node->field_news_content['und'][0]['safe_value'] = explode('!--pagebreak--', $node->field_news_content['und'][0]['safe_value']);

                ?>
                <script type="text/javascript">
                    jQuery(function () {
                        jQuery('.next').click(function () {
                            jQuery('.article-desc').css('display', 'none');
                            jQuery(jQuery(this).attr('href')).css('display', 'block');
                            jQuery('ul.pagination li a').removeClass('active');
                            jQuery('ul.pagination li a[href="' + jQuery(this).attr('href') + '"]').addClass('active');
                            jQuery('html, body').animate({scrollTop: jQuery("h1").offset().top - 10}, 300);
                            if (jQuery(this).attr('href') == '#p0') {
                                $("#mainfotocontainer").css("display", "block");
                            }
                            else {
                                $("#mainfotocontainer").css("display", "none");
                            }
                            return false;
                        });
                        jQuery('ul.pagination li a').click(function () {
                            jQuery('.article-desc').css('display', 'none');
                            jQuery('ul.pagination li a').removeClass('active');
                            jQuery('ul.pagination li a[href="' + jQuery(this).attr('href') + '"]').addClass('active');
                            jQuery('html, body').animate({scrollTop: jQuery("h1").offset().top - 10}, 300);
                            jQuery(jQuery(this).attr('href')).css('display', 'block');
                            if (jQuery(this).attr('href') == '#p0') {
                                $("#mainfotocontainer").css("display", "block");
                            }
                            else {
                                $("#mainfotocontainer").css("display", "none");
                            }
                            return false;
                        });

                    });
                </script>
                <div class="clearfix InnerPagination">
                    <ul class="pagination">
                        <li class="first">Page</li>
                        <?php
                        for ($i = 0; $i < count($descArray); $i++) {
                            ?>
                            <li>
                                <a title="go to page <?php echo $i + 1; ?>"<?php if ($i == 0) { ?> class="active"<?php } ?>
                                   href="#p<?php echo $i; ?>"><?php echo $i + 1; ?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            <?php
            }
            ?>
        </div>
        <!-- inner pagination -->


        <div class="full_news clearfix">
            <?php

            if ($node->field_news_media_type['und'][0]['value'] == 'Images') {

//                if there is only one image or no image - no slider
                if (sizeof($node->field_news_images['und']) <= 1) {
                    while ($data_news = mysql_fetch_assoc($sql_imglist)) {
                        ?>
                        <div class="slider-bg single">
                            <div class="container-fluid">
                                <div class="content-img">
                            <a href="/?q=sites/default/files/styles/check_extra_large_for_review/public/<?php echo str_replace("public://", "", $data_news['uri']); ?>"
                               data-lightbox="image-1" class="text-center <?php if ($cnt_newsimg == 0) { ?> active<?php } ?>"
                               title="<?php echo $node->title; ?>" rel="lightbox[news]" style="background-image: url('/?q=sites/default/files/styles/check_large_review/public/<?php echo str_replace("public://", "", str_replace(" ", "%20", $data_news['uri'])); ?>');">

<!--                                <img src="/?q=sites/default/files/styles/check_large_review/public/--><?php //echo str_replace("public://", "", str_replace(" ", "%20", $data_news['uri'])); ?><!--"--><?php //if ($cnt_newsimg == 0) { ?><!-- id="mainPhoto"--><?php //} ?>
<!--                                    alt="--><?php //echo $node->title; ?><!--" class="slider-image"/>-->
                            </a>
                                    </div>
                            </div>
                        </div>

                    <?php

                    }
                }


                if (sizeof($node->field_news_images['und']) > 1) {
                    ?>
                    <div class="car-slider content-slider slider-bg">
                        <?php
                        $cnt_newsimg = 0;

                        // if there is more than one image - print slider
                        if (sizeof($node->field_news_images['und']) > 1) {
                            while ($data_news = mysql_fetch_assoc($sql_imglist)) {
                                ?>

                                <div class="text-center">
                                    <a href="/?q=sites/default/files/styles/check_extra_large_for_review/public/<?php echo str_replace("public://", "", $data_news['uri']);?>"
                                       data-lightbox="image-1" class="text-center <?php if ($cnt_newsimg == 0) { ?> active<?php } ?>" title="<?php echo $node->title;?>" rel="lightbox[news]">

                                        <img src="/?q=sites/default/files/styles/check_large_review/public/<?php echo str_replace("public://", "", str_replace(" ", "%20", $data_news['uri']));?>"<?php if ($cnt_newsimg == 0) { ?> id="mainPhoto"<?php } ?>
                                             alt="<?php echo $node->title;?>" class="slider-image"/>
                                    </a>
                                </div>

                                <?php
                                $cnt_newsimg++;
                            }
                        }

                        ?>


                    </div>
                <?php
                }
            } else {

                if (strpos($node->field_news_video['und'][0]['title'], "youtu.be/") > 1) {
                    $uVid = substr($node->field_news_video['und'][0]['title'], 16);
                } else {
                    $strfinded = "&feature=related";
                    $replaced_videosource = @str_replace($strfinded, "", $node->field_news_video['und'][0]['title']);
                    $explodedsource = @explode("=", $replaced_videosource);
                    //print_r($explodedsource);
                    if (strpos($explodedsource[1], '&feature') > 0) {
                        $uVid = substr($explodedsource[1], 0, strpos($explodedsource[1], '&feature'));
                    } else {
                        $uVid = $explodedsource[1];
                    }
                }


                ?>
                <div class="text-center">
                    <!--<object width="428" height="256" id="youtubeVideo">
                        <param name="movie" value="http://www.youtube.com/v/<?php echo $uVid;?>&hl=en_US&feature=player_embedded&version=3"></param>
                        <embed
                            src="http://www.youtube.com/v/<?php echo $uVid;?>&hl=en_US&feature=player_embedded&version=3"
                            type="application/x-shockwave-flash" width="428" height="256" wmode="opaque">
                        </embed>
                    </object>
		    -->

			<iframe width="428" height="256" src="https://www.youtube.com/embed/<?php echo $uVid;?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>	

                </div>
                <?php
                $positionofhttp = '';
                if ($node->field_new_forum['und'][0]['url'] != '') {
                    $restofind = strstr($node->field_new_forum['und'][0]['url'], "http://");
                    ?>
<!--                    <a href="--><?php //if ($restofind == '') {
//                        echo "http://";
//                    }
//                    echo $node->field_new_forum['und'][0]['url'];?><!--" target="_blank" class="discussBtn"><span>View Forum Discussion</span></a>-->
                    <br/>
                    <br/>
                <?php
                }

            }

            //print_r($node);
            ?>
            <div class="descripptionFlow">
                <?php

                if (count($descArray) > 1) {
                    for ($i = 0; $i < count($descArray); $i++) {
                        $flag = 1;
                        ?>
                        <div class="article-desc" id="p<?php echo $i; ?>"<?php if ($i > 0) { ?> style="display:none;"<?php } ?>>
                            <?php


                            $node->field_news_content['und'][0]['safe_value'][$i] = str_replace("&lt;!--pagebreak--&gt;", "", $node->field_news_content['und'][0]['safe_value'][$i]);
                            $node->field_news_content['und'][0]['safe_value'][$i] = str_replace("&gt;", "", $node->field_news_content['und'][0]['safe_value'][$i]);
                            $node->field_news_content['und'][0]['safe_value'][$i] = str_replace("&lt;", "", $node->field_news_content['und'][0]['safe_value'][$i]);
                            $node->field_news_content['und'][0]['safe_value'][$i] = str_replace("<div>", "", $node->field_news_content['und'][0]['safe_value'][$i]);
                            $node->field_news_content['und'][0]['safe_value'][$i] = str_replace("</div>", "", $node->field_news_content['und'][0]['safe_value'][$i]);
                            $node->field_news_content['und'][0]['safe_value'][$i] = str_replace("<p></p>", "", $node->field_news_content['und'][0]['safe_value'][$i]);
                            $node->field_news_content['und'][0]['safe_value'][$i] = str_replace('<em class="placeholder">!--</em>start--', "<strong class='reviewQuotes'><span class='openingQuotes'>&ldquo;</span>", $node->field_news_content['und'][0]['safe_value'][$i]);
                            $node->field_news_content['und'][0]['safe_value'][$i] = str_replace('<em class="placeholder">!--</em>end--', "<span class='closingQuots'>&rdquo;</span></strong>", $node->field_news_content['und'][0]['safe_value'][$i]);
                            if ($i != 0) {
                                echo "<p>";
                            }
//                            print $node->field_news_content['und'][0]['safe_value'][$i];

                            print str_replace('<p>&nbsp;</p>', '',  $node->field_news_content['und'][0]['safe_value'][$i]);

                            //echo str_replace($search, $replace, $descArray[$i]);
                            if ($i != 0) {
                                echo "</p>";
                            }
                            if ($i < count($descArray) - 1) {
                                ?>
                                <a title="Next Page" href="#p<?php echo $i + 1; ?>" class="next">Next Page ></a>
                            <?php
                            }
                            ?>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="article-desc">
                        <?php
                        function str_replace_first($from, $to, $subject){
                            $from = '/'.preg_quote($from, '/').'/';
                            return preg_replace($from, $to, $subject, 1);
                        }
                        //
                        $googleAdCode = "</p> <div id='div-gpt-ad-1497334572605-0' style='height:250px; width:300px; display: block; margin: 0 auto 15px auto;'> <script> googletag.cmd.push(function() { googletag.display('div-gpt-ad-1497334572605-0'); googletag.pubads().refresh(); }); </script> </div>";

                        //                        echo $node->field_news_content['und'][0]['safe_value'];
                        $tmp_content = str_replace('<p>&nbsp;</p>', '',  $node->field_news_content['und'][0]['value']);
                        $tmp_content = str_replace('</P>', '</p>',  $node->field_news_content['und'][0]['value']);


                        echo str_replace_first('</p>', $googleAdCode, $tmp_content);
                        //                        echo $tmp_content;

                        ?>

                        <?php
                        if ($node->field_new_forum['und'][0]['url'] != '') {
                            ?>
                            <div class="text-center">
                                <a href="<?php echo $node->field_new_forum['und'][0]['url'];?>"
                                   ripple-background="radial-gradient(red, yellow)" ripple-opacity="0.7"
                                   class="btn btn-red ripple">View Forum Discussion</a>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                <?php
                }
                ?>


            </div>
            <!-- description flow -->

            <div class="text-center">
                <?php
                //include ("includes/common/inner-pagination.php");
                if (count($descArray) > 1) {
                    ?>
                    <div class="clearfix InnerPagination">
                        <ul class="pagination">
                            <li class="first">Page</li>
                            <?php
                            for ($i = 0; $i < count($descArray); $i++) {
                                ?>
                                <li>
                                    <a title="go to page <?php echo $i + 1; ?>"<?php if ($i == 0) { ?> class="active"<?php } ?>
                                       href="#p<?php echo $i; ?>"><?php echo $i + 1; ?></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                <?php
                }
                ?>
            </div>
            <!--inner pagination-->


            <!-- tags keep here for related news -->
            <div class="clearfix marT20" style="display: none;">
                <?php include("includes/common/tags.php") ?>
            </div>
            <!-- tags  -->


        </div>
        <!-- full news -->


    </div>
    <!-- news deatils -->



    <!--share buttons-->
    <?php include("includes/common/share.php") ?>




    <?php //include ("includes/common/navigate-articles.php") ?>

    <?php //include ("includes/cta/realated-news.php") ?>




<!--<div class="ad-wrapper text-center">Ad goes here</div>-->




<?php
include_once("././themes/mobilebhp/includes/realated-news.php");
?>

<!--products section-->
<?php
include_once("././themes/mobilebhp/includes/browse-products-bhpian.php");
?>

</div><!-- article -->


    <?php //include ("includes/cta/find-news.php") ?>
    <?php //include ("includes/cta/most-viewed.php") ?>
    <?php //include ("includes/cta/add-banner.php") ?>


<style>

</style>
