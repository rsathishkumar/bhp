<?php
/**
 * @file
 * Default theme implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   tag.
 * - $head_title_array: (array) An associative array containing the string parts
 *   that were used to generate the $head_title variable, already prepared to be
 *   output as TITLE tag. The key/value pairs may contain one or more of the
 *   following, depending on conditions:
 *   - title: The title of the current page, if any.
 *   - name: The name of the site.
 *   - slogan: The slogan of the site, if any, and if there is no title.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes String of classes that can be used to style contextually through
 *   CSS.
 *
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see template_process()
 *
 * @ingroup themeable
 */
global $base_url;
?>
<!doctype html>
<html class="no-js" lang="<?php print $language->language;?>" dir="<?php print $language->dir;?>"<?php print $rdf_namespaces;?>>

<head profile="<?php print $grddl_profile;?>">
  <meta charset="utf-8">
  <meta content="IE=edge" http-equiv="X-UA-Compatible">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="msapplication-TileColor" content="#000000">
  <meta name="theme-color" content="#000000">
  <link rel="manifest" href="/manifest.json">

  <meta property="og:title" content="Home | Team-BHP - The Definitive Indian Car Website">
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://www.team-bhp.com">
  <meta property="og:image" content="https://www.team-bhp.com/themes/bhp/images/teambhp-og-image-fb.jpg">
  <meta property="og:site_name" content="Team-BHP.com">
  <meta property="fb:admins" content="1504944662">
  <meta property="og:description" content="Team-BHP - Redlining the Indian Automobile Scene">


  <?php
//custom description for mobile reviews

if (arg(0) == 'node' && is_numeric(arg(1))) {
	$nid = arg(1);
	$path = 'node/' . (int) $nid;
	$alias = drupal_get_path_alias($path);
}

$catname = false;

if (isset($_GET['catname']) && !empty($_GET['catname'])) {

	$catname = strtolower($_GET['catname']);

}

?>

  <?php if ($alias === 'team-bhp-reviews'): ?>

    <meta name="description" content="Read detailed reviews of cars and bikes. Find ✓Pricing ✓Pictures ✓Features ✓Specifications ✓Fuel Economy ✓Performance of cars. Check out the latest ownership reviews and service costs by car & bike enthusiasts right here!" />

  <?php endif;?>

  <?php if ($alias === 'news'): ?>

    <meta name="description" content="Your one stop guide to the latest trends in the Indian car and bike industry. Check ✓News ✓Launch dates ✓Prices ✓Pictures ✓Sales figures ✓Market analysis about newly launched Indian cars and bikes. Latest updates on new car and bike launches." />

  <?php endif;?>


  <?php if ($alias === 'advice'): ?>

    <meta name="description" content="List of things to check before taking delivery of your new car. Find your car's real manufacturing date by decoding the VIN. Tips on how to safely run-in your new car. How to drive for the best fuel economy. Keeping your car safe from theft." />

  <?php endif;?>


  <?php if ($alias === 'hot-threads'): ?>

    <?php if ($catname === 'travelogues'): ?>

      <meta name="description" content="Read the adventurous travel stories by BHPians and know their first-hand experience on these car & bike trips in their travelogues. Find the best locations to travel to within India." />

    <?php else: ?>

      <meta name="description" content="Find the most unbiased and informative updates about Cars & Bikes in India. Discussions including everything from ✓Reviews ✓Prices ✓Launch Dates ✓Scoops ✓Features and detailed analysis of all the new cars & bikes. All available only right here!" />

    <?php endif;?>


  <?php endif;?>



  <?php //print $head; ?>
  <title><?php print $head_title;?></title>
  <?php //print $styles; ?>
  <?php //print $scripts; ?>

  <!-- mobile theme css -->
  <link rel="stylesheet" href="<?php print base_path() . path_to_theme()?>/styles/main.css?v=3">

  <!--  theme custom css-->
  <link rel="stylesheet" href="<?php print base_path() . path_to_theme()?>/styles/mobilebhp.css">


  <!--[if lt IE 9]> <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script> <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script> <![endif]-->

  <!--js files-->
  <script src="<?php print base_path() . path_to_theme()?>/scripts/vendors.min.js"></script>
  <script src="<?php print base_path() . path_to_theme()?>/scripts/jquery.inview.min.js"></script>

<!--  <script type="text/javascript">-->
<!--    var googletag = googletag || {};-->
<!--    googletag.cmd = googletag.cmd || [];-->
<!--    (function() {-->
<!--      var gads = document.createElement('script');-->
<!--      gads.async = true;-->
<!--      gads.type = 'text/javascript';-->
<!--      var useSSL = 'https:' == document.location.protocol;-->
<!--      gads.src = (useSSL ? 'https:' : 'http:') +-->
<!--      '//www.googletagservices.com/tag/js/gpt.js';-->
<!--      var node = document.getElementsByTagName('script')[0];-->
<!--      node.parentNode.insertBefore(gads, node);-->
<!--    })();-->
<!--  </script>-->
<!---->
<!--  <script type="text/javascript">-->
<!--    googletag.cmd.push(function() {-->
<!--      googletag.defineSlot('/1063105/Portal_Section_Top_Banner', [728, 90], 'div-gpt-ad-1355997698878-0').addService(googletag.pubads());-->
<!--      googletag.defineSlot('/1063105/belownews', [618, 80], 'div-gpt-ad-1455011226405-0').addService(googletag.pubads());-->
<!--      googletag.defineSlot('/1063105/newsskyscraper', [225, 500], 'div-gpt-ad-1455703231503-0').addService(googletag.pubads());-->
<!--      googletag.pubads().enableSingleRequest();-->
<!--      googletag.pubads().collapseEmptyDivs();-->
<!--      googletag.enableServices();-->
<!--    });-->
<!--  </script>-->
    <script async='async' src='https://www.googletagservices.com/tag/js/gpt.js'></script>
    <script>
        var googletag = googletag || {};
        googletag.cmd = googletag.cmd || [];
    </script>

    <script>
        googletag.cmd.push(function() {
            googletag.defineSlot('/1063105/mobileislandportal', [300, 250], 'div-gpt-ad-1497334572605-0').addService(googletag.pubads());
            googletag.defineSlot('/1063105/mobileleaderboardportal', [320, 100], 'div-gpt-ad-1497367115460-0').addService(googletag.pubads());
//            googletag.pubads().enableSingleRequest(); //disabled by Sachin
            googletag.pubads().disableInitialLoad(); //triggered later by googletag.pubads().refresh();
            googletag.enableServices();
        });
    </script>
</head>
<body class="<?php print $classes;?>" <?php print $attributes;?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.7";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
<?php print $page_top;?>
<?php print $page;?>
<?php print $page_bottom;?>


<script src="<?php print base_path() . path_to_theme()?>/scripts/scripts.js"></script>

<!-- <script src="<?php print base_path() . path_to_theme()?>/scripts/scripts.js"></script> -->

</body>
</html>
