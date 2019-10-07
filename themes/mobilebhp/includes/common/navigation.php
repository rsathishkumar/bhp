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

    <?php if (drupal_is_front_page()):

	//SiteNavigationElement should be shown only on the home page. Any changes to the navigation has to be made twice. Once for the the front page block and the other for the  non-front page block.

	$base_url = $GLOBALS['base_url'];
	?>


					    <!--    left-->
					    <div class="col-xs-6">
					        <ul class="clearfix nav nav-pills main-nav"   itemscope itemtype="https://www.schema.org/SiteNavigationElement">

					            <li role="presentation" class="close-icon">
					                <a href="javascript:void(0)" class="pull-left menu-toggle">
					                    <i class="icon-close"></i>
					                </a>
					            </li>

					            <li itemprop="name" role="presentation"><a itemprop="url" href="/forum/" title="Forum"><span>Forum</span></a></li>

					            <li itemprop="name" role="presentation"><a itemprop="url" class="<?php if ($nid == '10') {
		echo " active";
	}?>" href="/hot-threads" title="Hot Threads"><span>Hot Threads</span></a></li>

					            <li itemprop="name" role="presentation"><a itemprop="url" class="<?php if (($nid == '7') or ($node->type == 'news')) {
		echo " active";
	}?>" href="/news" title="News"><span>News</span></a></li>

					<!--            <li itemprop="name" role="presentation">-->
					<!--                <a class="--><?php //if (($nid == '8') or ($node->type == 'model') or ($node->type == 'specifications') or ($node->type == 'features') or ($node->type == 'review') or ($node->type == 'forum_reviews') or ($node->type == 'price')) {
	//                    echo " active";
	//                } ?><!--" href="/forum/official-new-car-reviews/?pp=25&sort=dateline&order=desc&daysprune=-1"-->
					<!--                   title="Reviews"><span>Reviews</span></a>-->
					<!--            </li>-->

					            <li itemprop="name" role="presentation">
					                <a itemprop="url" class="<?php if (($nid == '8') or ($node->type == 'model') or ($node->type == 'specifications') or ($node->type == 'features') or ($node->type == 'review') or ($node->type == 'forum_reviews') or ($node->type == 'price')) {
		echo " active";
	}?>" href="/team-bhp-reviews/"
					                   title="Reviews"><span>Reviews</span></a>
					            </li>

					            <li itemprop="name" role="presentation"><a itemprop="url"  href="/?q=hot-threads&catname=Travelogues&m">Travelogues</a></li>

					            <li itemprop="name" role="presentation"><a itemprop="url" href="/aboutus/overview">About Us</a></li>

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

					            <li itemprop="name" role="presentation"><a itemprop="url" href="https://classifieds.team-bhp.com/" title="Classifieds"><span>Classifieds</span></a>

					            <li itemprop="name" role="presentation"><a itemprop="url" href="https://store.team-bhp.com/?utm_source=Portal&utm_medium=MobileNavList&utm_campaign=TBHP" title="Store"><span>Store</span></a></li>

					            <li role="presentation"><a href="https://www.cars24.com/mkt-lp/carculator?utm_source=teambhp&utm_medium=header_nav_bar&utm_campaign=mobile" rel="nofollow" onclick="ga('secondTracker.send','event','Cars24_Navbar', 'Portal')" target="_blank">Sell Your Car</a></li>

					            <li role="presentation"><a href="http://oriparts.com/?utm_source=team-bhp&utm_medium=link&utm_campaign=main" rel="nofollow" onclick="ga('secondTracker.send','event','Boodmo_Navbar', 'Portal')" target="_blank">Spare Parts</a></li>

					            <li role="presentation"><a href="https://www.coverfox.com/lp/cms/car-insurance/team-bhp/?utm_source=Team-BHP&utm_medium=CPM&utm_content=Home-Page-Link&utm_campaign=Team-BHP&network=Team-BHP&category=home-page-menu"  rel="nofollow" onclick="ga('secondTracker.send','event','Car_Insurance_Navbar', 'Portal')" target="_blank">Car Insurance</a></li>

					            <li  itemprop="name" role="presentation"><a itemprop="url"  href="/contactus/speak">Contact Us</a></li>


					<!--            <li role="presentation"><a href="/safety">Road Safety</a></li>-->
					<!---->
					<!--            <li role="presentation"><a class="" href="/forum/gallery.php" title="Photos"><span>Photos</span></a></li>-->
					<!---->
					<!--            <li role="presentation"><a href="/tech-stuff">Tech Stuff</a></li>-->

					        </ul>

					    </div>


					    <?php else: ?>

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
}?>" href="/hot-threads" title="Hot Threads"><span>Hot Threads</span></a></li>

            <li role="presentation"><a class="<?php if (($nid == '7') or ($node->type == 'news')) {
	echo " active";
}?>" href="/news" title="News"><span>News</span></a></li>

<!--            <li role="presentation">-->
<!--                <a class="--><?php //if (($nid == '8') or ($node->type == 'model') or ($node->type == 'specifications') or ($node->type == 'features') or ($node->type == 'review') or ($node->type == 'forum_reviews') or ($node->type == 'price')) {
//                    echo " active";
//                } ?><!--" href="/forum/official-new-car-reviews/?pp=25&sort=dateline&order=desc&daysprune=-1"-->
<!--                   title="Reviews"><span>Reviews</span></a>-->
<!--            </li>-->

            <li role="presentation">
                <a class="<?php if (($nid == '8') or ($node->type == 'model') or ($node->type == 'specifications') or ($node->type == 'features') or ($node->type == 'review') or ($node->type == 'forum_reviews') or ($node->type == 'price')) {
	echo " active";
}?>" href="/team-bhp-reviews/"
                   title="Reviews"><span>Reviews</span></a>
            </li>

            <li role="presentation"><a href="/?q=hot-threads&catname=Travelogues&m">Travelogues</a></li>

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

            <li role="presentation"><a href="https://classifieds.team-bhp.com/" title="Classifieds"><span>Classifieds</span></a>

            <li role="presentation"><a href="https://store.team-bhp.com/?utm_source=Portal&utm_medium=MobileNavList&utm_campaign=TBHP" title="Store"><span>Store</span></a></li>

            <li role="presentation"><a href="https://www.cars24.com/mkt-lp/carculator?utm_source=teambhp&utm_medium=header_nav_bar&utm_campaign=mobile" rel="nofollow" onclick="ga('secondTracker.send','event','Cars24_Navbar', 'Portal')" target="_blank">Sell Your Car</a></li>

            <li role="presentation"><a href="http://oriparts.com/?utm_source=team-bhp&utm_medium=link&utm_campaign=main" rel="nofollow" onclick="ga('secondTracker.send','event','Boodmo_Navbar', 'Portal')" target="_blank">Spare Parts</a></li>

            <li role="presentation"><a href="https://www.coverfox.com/lp/cms/car-insurance/team-bhp/?utm_source=Team-BHP&utm_medium=CPM&utm_content=Home-Page-Link&utm_campaign=Team-BHP&network=Team-BHP&category=home-page-menu"  rel="nofollow" onclick="ga('secondTracker.send','event','Car_Insurance_Navbar', 'Portal')" target="_blank">Car Insurance</a></li>

            <li role="presentation"><a href="/contactus/speak">Contact Us</a></li>


<!--            <li role="presentation"><a href="/safety">Road Safety</a></li>-->
<!---->
<!--            <li role="presentation"><a class="" href="/forum/gallery.php" title="Photos"><span>Photos</span></a></li>-->
<!---->
<!--            <li role="presentation"><a href="/tech-stuff">Tech Stuff</a></li>-->

        </ul>

    </div>

<?php endif;?>

</div>

<div class="text-center">
    <img class="maybehidelogo brand img-responsive" style="margin-bottom:2.4rem;" src="<?php print $base_url;?>/themes/mobilebhp/images/logo-teambhp.png" alt="Team BHP" title="Team BHP">
	
	<div id="bcd-container" class="hidefromfooter">
  
      <a class="bcd-box1" href="https://www.coverfox.com/lp/cms/car-insurance/team-bhp/?utm_source=Team-BHP&utm_medium=CPM&utm_content=Home-Page-Link&utm_campaign=Team-BHP&network=Team-BHP&category=home-page-menu" rel="nofollow" onclick="ga('secondTracker.send','event','Car_Insurance_Navbar', 'Portal')" target="_blank">
        <img class="bcd-logos" src="/themes/mobilebhp/images/menu/coverfox.png">
        
      </a><a class="bcd-box2" href="http://oriparts.com/?utm_source=team-bhp&amp;utm_medium=link&amp;utm_campaign=main" rel="nofollow" onclick="ga('secondTracker.send','event','Boodmo_Navbar', 'Portal')" target="_blank">
		<img class="bcd-logos" src="/themes/mobilebhp/images/menu/boodmo.png">
        
      </a><a class="bcd-box3" href="https://www.cars24.com/mkt-lp/carculator?utm_source=teambhp&utm_medium=banner&utm_campaign=mobile" title="Cars24 Used Car Price Check" rel="nofollow" onclick="ga('secondTracker.send','event','Cars24_Navbar', 'Portal')" target="_blank">
        <img class="bcd-logos" src="/themes/mobilebhp/images/menu/cars24.png">
      </a>

	</div>
</div>
<!-- navigation -->
