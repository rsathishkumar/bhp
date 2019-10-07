<?php
//$descArray = explode('pagebreak', $node->field_advice_content['und'][0]['safe_value']);
$descArray = explode('&lt;!--pagebreak--&gt;', $node->body['und'][0]['safe_value']);
$cnt = count($descArray);

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
<link rel="stylesheet" href="<?php print base_path() . path_to_theme() ?>/styles/lightbox.css" type="text/css"/>

<script type="text/javascript" src="<?php print base_path() . path_to_theme() ?>/scripts/lightbox.js"></script>

<script type="text/javascript">

    function redirectbycat(catname) {
        location.href = '/?q=advice&catname=' + catname;
    }

</script>
<input type="hidden" id="manimageforhover"
       value="/?q=sites/default/files/styles/check_tech_stuff_hover/public/<?php echo str_replace("public://", "", $node->field_tech_stuff_image['und'][0]['uri']); ?>"/>
<input type="hidden" id="manimage"
       value="/?q=sites/default/files/styles/check_tech_stuff/public/<?php echo str_replace("public://", "", $node->field_tech_stuff_image['und'][0]['uri']); ?>"/>
<div class="article content-page-video-img">
    <div class="news_details clearfix">
        <div class="container-fluid">
            <h1><?php echo $node->title; ?></h1>

            <div class="date" style="display: none;">
                <?php echo returnDate($node->created); ?>
                <a href="javascript:void(0);"><?php print $name; ?></a>
            </div>

        </div>
        <!--clearfix -->

        <?php
        //print_r($node);
        //include ("includes/common/inner-pagination.php");
        //$descArray = explode('<!--pagebreak-->', $node->body['und'][0]['safe_value']);
        if (count($descArray) > 1)
        {
        $node->body['und'][0]['safe_value'] = explode('&lt;!--pagebreak--&gt;', $node->body['und'][0]['safe_value']);
        ?>
        <div class="clearfix">
            <div class="fright">
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


            </div>
            <?php
            }
            ?>

            <!--main image-->
            <div class="slider-bg single">
                <div class="container-fluid">
                    <div class="content-img">
                        <a href="/?q=sites/default/files/styles/check_tech_stuff/public/<?php echo str_replace("public://", "", $node->field_tech_stuff_image['und'][0]['uri']); ?>"
                           data-lightbox="image-1" rel="lightbox[tech_stuff]" style="background-image: url('/?q=sites/default/files/styles/check_tech_stuff/public/<?php echo str_replace("public://", "", $node->field_tech_stuff_image['und'][0]['uri']); ?>')">
<!--                            <img src="/?q=sites/default/files/styles/check_tech_stuff/public/--><?php //echo str_replace("public://", "", $node->field_tech_stuff_image['und'][0]['uri']); ?><!--"-->
<!--                                rel="--><?php //echo str_replace("public://", "", $node->field_tech_stuff_image['und'][0]['uri']); ?><!--"-->
<!--                                class="zoomLt" alt="--><?php //echo $node->title; ?><!--" style="display:inline"/>-->
                        </a>
                    </div>
                </div>
            </div>


            <div class="full_news">

                <div class="descripptionFlow">
                    <?php
                    if (count($descArray) > 1) {
                        for ($i = 0; $i < count($node->body['und'][0]['safe_value']); $i++) {
                            ?>
                            <div class="article-desc"
                                 id="p<?php echo $i; ?>"<?php if ($i > 0) { ?> style="display:none;"<?php } ?>>
                                <?php

                                $node->body['und'][0]['safe_value'][$i] = str_replace("&lt;!--pagebreak--&gt;", "", $node->body['und'][0]['safe_value'][$i]);
                                //  $node->body['und'][0]['safe_value'][$i]=str_replace("&lt;!--pagebreak--&gt;","",$node->body['und'][0]['safe_value'][$i]);
                                $node->body['und'][0]['safe_value'][$i] = str_replace("&gt;", "", $node->body['und'][0]['safe_value'][$i]);
                                $node->body['und'][0]['safe_value'][$i] = str_replace("&lt;", "", $node->body['und'][0]['safe_value'][$i]);
                                $node->body['und'][0]['safe_value'][$i] = str_replace("<div>", "", $node->body['und'][0]['safe_value'][$i]);
                                $node->body['und'][0]['safe_value'][$i] = str_replace("</div>", "", $node->body['und'][0]['safe_value'][$i]);
                                $node->body['und'][0]['safe_value'][$i] = str_replace("<p></p>", "", $node->body['und'][0]['safe_value'][$i]);
                                $node->body['und'][0]['safe_value'][$i] = str_replace('<em class="placeholder">!--</em>start--', "<strong class='reviewQuotes'><span class='openingQuotes'>&ldquo;</span>", $node->body['und'][0]['safe_value'][$i]);
                                $node->body['und'][0]['safe_value'][$i] = str_replace('<em class="placeholder">!--</em>end--', "<span class='closingQuots'>&rdquo;</span></strong>", $node->body['und'][0]['safe_value'][$i]);
                                if ($i != 0) {
                                    echo "<p>";
                                }

//                                print $node->body['und'][0]['safe_value'][$i];

                                print str_replace('<p>&nbsp;</p>', '',  $node->body['und'][0]['safe_value'][$i]);


                                if ($i != 0) {
                                    echo "</p>";
                                }
                                if ($i < count($descArray) - 1) {
                                    ?>
                                    <a title="Next Page" href="#p<?php echo $i + 1; ?>" class="next">Next Page ></a>
                                <?php
                                }
                                ?>

                                <?php
                                if($node->field_tech_stuff_forum_link['und'][0]['value']!='')
                                {
                                    ?>
                                    <div class="text-center">
                                        <a href="<?php echo $node->field_tech_stuff_forum_link['und'][0]['value'];?>" class="btn btn-red"><span>View Forum Discussion</span></a>
                                    </div>
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
//                            echo $node->body['und'][0]['safe_value'];
/*                            $googleAdCode = "</p> <div id='div-gpt-ad-1497334572605-0' style='height:250px; width:300px; display: block; margin: 0 auto 15px auto;'> <script> googletag.cmd.push(function() { googletag.display('div-gpt-ad-1497334572605-0'); googletag.pubads().refresh(); }); </script> </div>";

                            $tmp_content = str_replace('<p>&nbsp;</p>', '',  $node->body['und'][0]['value']);
                            $tmp_content = str_replace('</P>', '</p>',  $node->body['und'][0]['value']);*/

                            echo $node->body['und'][0]['value'];
                           // echo str_replace_first('</p>', $googleAdCode, $tmp_content);


                            ?>

                            <?php
                            if($node->field_tech_stuff_forum_link['und'][0]['value']!='')
                            {
                            ?>
                            <div class="text-center">
                                <a href="<?php echo $node->field_tech_stuff_forum_link['und'][0]['value'];?>" class="btn btn-red"><span>View Forum Discussion</span></a>
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

                <!-- inner pagination -->
                <div class="clearfix InnerPagination hide">
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
            </div>
            <!-- fright -->


        </div>
        <!-- full news -->


    </div>
    <!-- news deatils -->


    <!--	share-->
    <?php include("includes/common/share.php") ?>

    <!--		ad wrpper-->
<!--    <div class="ad-wrapper text-center">-->
<!--        Ad goes here-->
<!--    </div>-->
    <!--		ad wrpper-->


    <?php include("includes/realated-articles-techstuff.php"); ?>

</div>
<!-- article -->
