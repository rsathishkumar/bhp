<?php
  if (arg(0) == 'node' && is_numeric(arg(1))) {
    $nid = arg(1);
    $node = node_load(array('nid' => $nid));
    $nodes = array('9, 8, 216, 9, 12, 10, 217');
    $nodetypes = array('news, advice, reviews, photos, tech-stuff, hot-tread');
    }
    //echo "$node->type";
  ?>


<?php if (drupal_is_front_page()):

    //SiteNavigationElement should be shown only on the home page. Any changes to the navigation has to be made twice. Once for the the front page block and the other for the non-front page block.

    $base_url = $GLOBALS['base_url'];
?>

<div class="clearfix" id="navigation">
        <ul class="clearfix"  itemscope itemtype="https://www.schema.org/SiteNavigationElement">
               <li class="home"><a class="<?php if($nid=='210') { echo " active"; }  ?>" href="<?php echo $base_url;?>/" title="Go to Home page"><span>&nbsp;</span></a>
</li>
                <li itemprop="name"><a itemprop="url" href="<?php echo $base_url;?>/forum/" title="Forum"><span>Forum</span></a></li>
                <li itemprop="name"><a itemprop="url" class="<?php if($nid=='10') { echo " active"; }  ?>" href="<?php echo $base_url;?>/hot-threads" title="Hot Threads
"><span>Hot Threads</span></a></li>
                <li itemprop="name"><a itemprop="url" class="<?php if(($nid=='7') or ($node->type=='news')) { echo " active"; } ?>" href="<?php echo $base_url;?>/news"
title="News"><span>News</span></a></li>
                <li itemprop="name"><a itemprop="url" class="<?php if(($nid=='8') or ($node->type=='model') or ($node->type=='specifications') or ($node->type=='feature
s') or ($node->type=='review') or ($node->type=='forum_reviews')  or ($node->type=='price') ) { echo " active"; }  ?>" href="/forum/official-new-car-
reviews/?pp=25&sort=dateline&order=desc&daysprune=-1" title="Reviews"><span>Reviews</span></a></li>
				<li><a class="" href="https://www.cars24.com/mkt-lp/carculator?utm_source=teambhp&utm_medium=header_nav_bar&utm_campaign=desktop" rel="nofollow" onclick="ga('secondTracker.send','event','Cars24_Navbar', 'Portal')" target="_blank" title="Sell Your Car"><span>Sell Your Car</span></a></li>
                <li><a class="" href="http://oriparts.com/?utm_source=team-bhp&utm_medium=link&utm_campaign=main" rel="nofollow" onclick="ga('secondTracker.send','event','Boodmo_Navbar', 'Portal')" target="_blank" title="Spare Parts"><span>Spare Parts</span></a></li>
                <li><a href="https://www.coverfox.com/lp/cms/car-insurance/team-bhp/?utm_source=Team-BHP&utm_medium=CPM&utm_content=Home-Page-Link&utm_campaign=Team-BHP&network=Team-BHP&category=home-page-menu" rel="nofollow" onclick="ga('secondTracker.send','event','Car_Insurance_Navbar','Portal')" target="_blank" title="Car Insurance"><span>Car Insurance</s
pan></a></li>
                <li itemprop="name"><a itemprop="url" href="https://classifieds.team-bhp.com/" title="Classifieds"><span>Classifieds</span></a></li>
                <li itemprop="name" class="last"><a itemprop="url" class="<?php if($nid=='217') { echo " active"; }  ?>" href="https://store.team-bhp.com/?utm_source=Por
tal&utm_medium=NavBar&utm_campaign=TBHP" title="Store"><span>Store</span></a></li>
                </ul>
</div><!-- navigation -->

<?php else:?>
  
<div class="clearfix" id="navigation">
	<ul class="clearfix">
		<li class="home"><a class="<?php if($nid=='210') { echo " active"; }  ?>" href="/" title="Go to Home page"><span>&nbsp;</span></a></li>
		<li><a href="/forum/" title="Forum"><span>Forum</span></a></li>		
		<li><a class="<?php if($nid=='10') { echo " active"; }  ?>" href="/hot-threads" title="Hot Threads"><span>Hot Threads</span></a></li>		
		<li><a class="<?php if(($nid=='7') or ($node->type=='news')) { echo " active"; } ?>" href="/news" title="News"><span>News</span></a></li>		
		<li><a class="<?php if(($nid=='8') or ($node->type=='model') or ($node->type=='specifications') or ($node->type=='features') or ($node->type=='review') or ($node->type=='forum_reviews')  or ($node->type=='price') ) { echo " active"; }  ?>" href="/forum/official-new-car-reviews/?pp=25&sort=dateline&order=desc&daysprune=-1" title="Reviews"><span>Reviews</span></a></li>		
		<li><a class="" href="https://www.cars24.com/mkt-lp/carculator?utm_source=teambhp&utm_medium=header_nav_bar&utm_campaign=desktop" rel="nofollow" onclick="ga('secondTracker.send','event','Cars24_Navbar', 'Portal')" target="_blank" title="Sell Your Car"><span>Sell Your Car</span></a></li>
		<li><a class="" href="http://oriparts.com/?utm_source=team-bhp&utm_medium=link&utm_campaign=main" rel="nofollow" onclick="ga('secondTracker.send','event','Boodmo_Navbar', 'Portal')" target="_blank" title="Spare Parts"><span>Spare Parts</span></a></li>
		<li><a href="https://www.coverfox.com/lp/cms/car-insurance/team-bhp/?utm_source=Team-BHP&utm_medium=CPM&utm_content=Home-Page-Link&utm_campaign=Team-BHP&network=Team-BHP&category=home-page-menu" rel="nofollow" onclick="ga('secondTracker.send','event','Car_Insurance_Navbar', 'Portal')" target="_blank" title="Car Insurance"><span>Car Insurance</span></a></li>
		<li><a href="http://classifieds.team-bhp.com/" title="Classifieds"><span>Classifieds</span></a></li>
		<li class="last"><a class="<?php if($nid=='217') { echo " active"; }  ?>" href="https://store.team-bhp.com/?utm_source=Portal&utm_medium=NavBar&utm_campaign=TBHP" title="Store"><span>Store</span></a></li>
		</ul>	
</div><!-- navigation -->	

<?php endif;?>
