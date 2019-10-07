<?php
  if (arg(0) == 'node' && is_numeric(arg(1))) {
    $nid = arg(1);
    $node = node_load(array('nid' => $nid));
    $nodes = array('9, 8, 216, 9, 12, 10, 217');
    $nodetypes = array('news, advice, reviews, photos, tech-stuff, hot-tread');
    }
    //echo "$node->type";
  ?>
  
<div class="clearfix" id="navigation">
	<ul class="clearfix">
		<li class="home"><a class="<?php if($nid=='210') { echo " active"; }  ?>" href="/" title="Go to Home page"><span>&nbsp;</span></a></li>
		<li><a href="/forum/" title="Forum"><span>Forum</span></a></li>		
		<li><a class="<?php if($nid=='10') { echo " active"; }  ?>" href="/hot-threads" title="Hot Threads"><span>Hot Threads</span></a></li>		
		<li><a class="<?php if(($nid=='7') or ($node->type=='news')) { echo " active"; } ?>" href="/news" title="News"><span>News</span></a></li>		
		<li><a class="<?php if(($nid=='8') or ($node->type=='model') or ($node->type=='specifications') or ($node->type=='features') or ($node->type=='review') or ($node->type=='forum_reviews')  or ($node->type=='price') ) { echo " active"; }  ?>" href="/forum/official-new-car-reviews/?pp=25&sort=dateline&order=desc&daysprune=-1" title="Reviews"><span>Reviews</span></a></li>		
		 <li><a class="" href="/forum/gallery.php" title="Photos"><span>Photos</span></a></li>
		<li><a class="<?php if(($nid=='9' || $nid=='19') or ($node->type=='advice')) { echo " active"; }  ?>" href="/advice" title="Advice"><span>Advice</span></a></li>
		<li><a class="<?php if(($nid=='12') or ($node->type=='tech-stuff') or ($node->type=='tech_stuff') ) { echo " active"; }  ?>" href="/tech-stuff" title="Tech Stuff"><span>Tech Stuff</span></a></li>
		<li><a href="http://classifieds.team-bhp.com/" title="Classifieds"><span>Classifieds</span></a></li>
		<li class="last"><a class="<?php if($nid=='217') { echo " active"; }  ?>" href="http://store.team-bhp.com/?utm_source=Portal&utm_medium=NavBar&utm_campaign=TBHP" title="Store"><span>Store</span></a></li>
		</ul>	
</div><!-- navigation -->	
