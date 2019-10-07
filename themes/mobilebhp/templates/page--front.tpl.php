<?php
// $Id: page.tpl.php,v 1.9 2010/11/07 21:48:56 dries Exp $

/**
 * @file
 * Team BHP's theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template normally located in the
 * modules/system folder.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bhp.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $hide_site_name: TRUE if the site name has been toggled off on the theme
 *   settings page. If hidden, the "element-invisible" class is added to make
 *   the site name visually hidden, but still accessible.
 * - $hide_site_slogan: TRUE if the site slogan has been toggled off on the
 *   theme settings page. If hidden, the "element-invisible" class is added to
 *   make the site slogan visually hidden, but still accessible.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['header']: Items for the header region.
 * - $page['featured']: Items for the featured region.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['triptych_first']: Items for the first triptych.
 * - $page['triptych_middle']: Items for the middle triptych.
 * - $page['triptych_last']: Items for the last triptych.
 * - $page['footer_firstcolumn']: Items for the first footer column.
 * - $page['footer_secondcolumn']: Items for the second footer column.
 * - $page['footer_thirdcolumn']: Items for the third footer column.
 * - $page['footer_fourthcolumn']: Items for the fourth footer column.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 * @see bartik_process_page()
 */
error_reporting(E_ALL ^ E_NOTICE);

?>
<div class="home-wrapper">


    <!--header-->
    <?php include(drupal_get_path('theme', 'mobilebhp') . '/templates/header.tpl.php'); ?>

    <!--slider-->
    <?php include(drupal_get_path('theme', 'mobilebhp') . '/templates/home-banner.tpl.php'); ?>


    <!--hot threads-->
    <section class="hot-threads">
        <div class="container-fluid">
            <h4 class="section-title text-center">
                <span>Hot Threads</span>
            </h4>

            <?php include(drupal_get_path('theme', 'mobilebhp') . '/home-hotthread.php'); ?>

        </div>
    </section>

    <!-- /1063105/mobileislandportal -->
    <div id='div-gpt-ad-1497334572605-0' style='height:250px; width:300px; display: block; margin: 0 auto 15px auto;'>
        <script>
            googletag.cmd.push(function() { googletag.display('div-gpt-ad-1497334572605-0'); googletag.pubads().refresh(); });
        </script>
    </div>

    <!--news-->
    <section class="home-news-list">
        <div class="container-fluid">
            <h4 class="section-title text-center">
                <span>News</span>
            </h4>

            <?php include(drupal_get_path('theme', 'mobilebhp') . '/includes/home-news.php'); ?>

        </div>
    </section>

    <!--ad wrapper-->
<div class="ad-wrapper text-center">
<!--            ad goes here-->
<!--<!--            <script type='text/javascript'>-->
<!--<!--                googletag.cmd.push(function() { googletag.display('div-gpt-ad-1355997698878-0'); });-->
<!--<!--            </script>-->
</div>


    <!--reviews section-->
    <?php include(drupal_get_path('theme', 'mobilebhp') . '/includes/home-review.php'); ?>


    <!--travels section-->
    <?php include(drupal_get_path('theme', 'mobilebhp') . '/includes/home-travelogues.php'); ?>


    <!--services section-->
    <section class="home-services">
        <div class="container-fluid">
            <ul>
                <li><a href="http://classifieds.team-bhp.com/" class="text-center"><span class="circle"><i class="icon-glossary"></i></span><span
                            class="text text-center">CLASSIFIEDS</span></a></li>
                <li><a href="https://www.cars24.com/mkt-lp/carculator?utm_source=teambhp&utm_medium=banner&utm_campaign=mobile" rel="nofollow" target="_blank" class="text-center"><span class="circle"><i
                                class="icon-rupee"></i></span><span class="text text-center">PRICE CHECK</span></a></li>
                <li><a href="/tech-stuff" class="text-center"><span class="circle"><i class="icon-tools"></i></span><span
                            class="text text-center">TECH STUFF</span></a></li>
                <li><a href="/safety" class="text-center"><span class="circle"><i
                                class="icon-roadsafety"></i></span><span class="text text-center">ROAD SAFETY</span></a>
                </li>
                <li><a href="/advice" class="text-center"><span class="circle"><i
                                class="icon-bulb"></i></span><span class="text text-center">ADVICE</span></a></li>
                <li><a href="http://www.team-bhp.com/forum/team-bhp-directory/" class="text-center"><span class="circle"><i class="icon-directory"></i></span><span
                            class="text text-center">DIRECTORY</span></a></li>
            </ul>
        </div>
    </section>


    <!--products section-->
    <?php include_once("././themes/mobilebhp/includes/browse-products-bhpian.php");?>


    <!--subscribe section-->
    <?php  include(drupal_get_path('theme', 'mobilebhp') . '/includes/newsletter.php'); ?>




 <!--social section-->

    <section class="home-social">
        <div class="container-fluid">
            <div class="well social-well text-center">
                <div class="social-circle text-center">
                    <span class="circle">
                        <i class="icon-facebook"></i>
                    </span>
                </div>

                <div class="text">

                    <h4>STAY UPDATED</h4>

                    <p>Keep yourself tuned into the Indian automotive scene</p>

                </div>

                <div class="fb-like-wrap text-center" style="margin-bottom: 15px;">
                    <!--                        <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false"></div>-->
                    <div class="fb-like" data-href="https://www.facebook.com/teambhp/" data-layout="button_count" data-action="like" data-size="large" data-show-faces="false" data-share="false"></div>
                </div>

            </div>
        </div>
    </section>


    <!--footer-->
    <?php include(drupal_get_path('theme', 'mobilebhp') . '/templates/footer.tpl.php'); ?>

</div>






     