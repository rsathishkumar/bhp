<div id="userContent" style="display:none">
<?php
include('http://www.team-bhp.com/forum/forumstats.php');
?>
</div>
<?php
drupal_add_js('var usersOnline; jQuery(function(){ usersOnline = jQuery("div#userContent").find("td").eq(1).text(); if(usersOnline.length>5) {usersOnline = usersOnline.substr(-5); } for(var i=0; i<usersOnline.length; i++){ jQuery("div.userCount").find("li").eq(i).text(usersOnline.substr(i, 1)); } jQuery("div.siteStats ul li:first").find("strong").text(jQuery("div#userContent").find("tr").eq(3).find("td").eq(1).text()); jQuery("div.siteStats ul li").eq(1).find("strong").text(jQuery("div#userContent").find("tr").eq(5).find("td").eq(1).text()); jQuery("div.siteStats ul li").eq(2).find("strong").text(jQuery("div#userContent").find("tr").eq(7).find("td").eq(1).text()); });', 'inline');
?>
<div class="roundAll3 cta userOnline clearfix">
	<h5 class="aln_center paB5">USERS ONLINE</h5>
	<div class="userCount">
		<ul class="clearfix">
			<li>0</li>
			<li>0</li>
			<li>0</li>
			<li>0</li>
			<li class="last">0</li>
		</ul><!-- userCount -->
	</div>
	<div class="siteStats">
		<ul>
			<li class="clearfix">
				<span>Members:</span>
				<strong>&nbsp;</strong>
			</li>
			<li class="clearfix">
				<span>Threads:</span>
				<strong>&nbsp;</strong>
			</li>
			<li class="clearfix last">
				<span>Posts:</span>
				<strong>&nbsp;</strong>
			</li>
		</ul><!-- siteStats -->
	</div>
</div>
