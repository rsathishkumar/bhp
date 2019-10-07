<?php global $base_url;
if (arg(0) == 'node' && is_numeric(arg(1))) {
    $nid = arg(1);
    $node = node_load(array('nid' => $nid));
    $nodes = array('9, 8, 216, 9, 12, 10, 217');
    $nodetypes = array('news, advice, reviews, photos, tech-stuff, hot-tread');
}
//echo "$node->type";
?>

<div class="row">
<!--    left-->
    <div class="col-xs-6">
        <ul class="clearfix nav nav-pills main-nav">

            <li role="presentation" class="close-icon">
                <a href="javascript:void(0)" class="pull-left menu-toggle">
                    <i class="icon-close"></i>
                </a>
            </li>

            <li role="presentation"><a href="/forum/" title="Forum"><span>Forum</span></a></li>

            <li role="presentation"><a class="<?php if ($nid == '10') {
                    echo " active";
                } ?>" href="/hot-threads" title="Hot Threads"><span>Hot Threads</span></a></li>

            <li role="presentation"><a class="<?php if (($nid == '7') or ($node->type == 'news')) {
                    echo " active";
                } ?>" href="/news" title="News"><span>News</span></a></li>

            <li role="presentation">
                <a class="<?php if (($nid == '8') or ($node->type == 'model') or ($node->type == 'specifications') or ($node->type == 'features') or ($node->type == 'review') or ($node->type == 'forum_reviews') or ($node->type == 'price')) {
                    echo " active";
                } ?>" href="/forum/official-new-car-reviews/?pp=25&sort=dateline&order=desc&daysprune=-1"
                   title="Reviews"><span>Reviews</span></a></li>

            <li role="presentation"><a href="/forum/travelogues/">Travelogues</a></li>

            <li role="presentation"><a href="/aboutus/overview">About Us</a></li>

        </ul>
    </div>

<!--    right-->
    <div class="col-xs-6">

        <ul class="clearfix nav nav-pills main-nav">

            <li role="presentation" class="close-icon">
                <a href="/" class="pull-right">
                    <i class="icon-home"></i>
                </a>
            </li>

            <li role="presentation"><a href="http://classifieds.team-bhp.com/" title="Classifieds"><span>Classifieds</span></a>

            <li role="presentation"><a href="http://store.team-bhp.com/?utm_source=Portal&utm_medium=TextLink&utm_content=Footer&utm_campaign=TBHP" title="News"><span>Store</span></a></li>

            <li role="presentation"><a href="https://www.coverfox.com/team-bhp/?utm_source=Team-BHP&utm_medium=CPM&utm_content=Home-Page-Link&utm_campaign=Team-BHP&network=Team-BHP&category=home-page-menu">Car Insurance</a></li>

            <li role="presentation"><a class="<?php if (($nid == '9' || $nid == '19') or ($node->type == 'advice')) {
                    echo " active";
                } ?>" href="/advice" title="Advice"><span>Advice</span></a></li>

            <li role="presentation"><a href="/forum/motorbikes/">Motorcycles</a></li>

            <li role="presentation"><a href="/contactus/speak">Contact Us</a></li>


<!--            <li role="presentation"><a href="/safety">Road Safety</a></li>-->
<!---->
<!--            <li role="presentation"><a class="" href="/forum/gallery.php" title="Photos"><span>Photos</span></a></li>-->
<!---->
<!--            <li role="presentation"><a href="/tech-stuff">Tech Stuff</a></li>-->

        </ul>

    </div>
</div>

<div class="text-center">
    <img src="<?php print $base_url;?>/themes/mobilebhp/images/team-bhp-logo.png" alt="Team BHP" title="Team BHP" class="brand img-responsive">
</div>
<!-- navigation -->
