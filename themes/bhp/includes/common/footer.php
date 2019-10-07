<div id="footer" class="clearfix">
	<div class="clearfix">
		<div class="fleft w480">
			<h3>Team-BHP.com</h3>
			<ul class="fleft">
				<li><a href="/advice" title="Advice">Advice</a></li>
				<li><a href="http://classifieds.team-bhp.com/" title="Classifieds">Classifieds</a></li>
				<li><a href="/forum/" title="Forum">Forum</a></li>
				<li><a href="/hot-threads" title="Hot Threads">Hot Threads</a></li>
				<!--<li><a href="/forum/" title="Directory">Directory</a></li>-->
			</ul>
			<ul class="fleft">
				
				<li><a href="/news" title="News">News</a></li>
				<li><a href="/forum/gallery.php" title="Photos">Photos</a></li>
				<li><a href="/forum/official-new-car-reviews/?pp=25&sort=dateline&order=desc&daysprune=-1" title="Reviews">Reviews</a></li>
			</ul>
	
			<ul class="fleft">
				<li><a href="/safety" title="Road Safety">Road Safety</a></li>
				<li><a href="http://store.team-bhp.com/?utm_source=Portal&utm_medium=TextLink&utm_content=Footer&utm_campaign=TBHP" title="Store">Store</a></li>
				<li><a href="/tech-stuff" title="Tech Stuff">Tech Stuff</a></li>
			</ul>
		</div><!-- 480 -->
		
		<div class="fleft marL40 w160">
			<h3>About Us</h3>
			<ul class="fleft">
				<li><a href="/aboutus/overview" title="Overview">Overview</a></li>
				<li><a href="/aboutus/team" title="The Team">The Team</a></li>
				<li><a href="/aboutus/key-features" title="Key Features">Key Features</a></li>
				<li><a href="/aboutus/philosophy" title="Philosophy">Philosophy</a></li>
				<li><a href="/aboutus/history" title="History">History</a></li>			
			</ul>
		</div>
		<div class="fleft marL40 w100">
			<h3>Contact Us</h3>
			<ul class="fleft">
				<li><a href="/contactus/speak" title="Speak">Speak</a></li>
				<li><a href="/contactus/share" title="Share">Share</a></li>
				<li><a href="/contactus/advertise" title="Advertise">Advertise</a></li>
			</ul>
		</div><!-- w460 -->
		
	</div><!-- clearfix -->	
	<div class="clearfix">&nbsp;</div>

	<div class="clearfix marT40">
		<div class="fleft cRight">

            Copyright <?php echo date("Y");?> - www.team-bhp.com
        </div>
		<div class="fright marR40" id="footnote">
			<a href="/sitemap" title="Site Map">Site Map</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
			<a href="/privacy-policy" title="Privacy Policy">Privacy Policy</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
			<a href="/terms-conditions" title="Terms &amp; Conditions">Terms &amp; Conditions</a>
		</div>
	</div>
	
	<!-- Universal Analytics -->
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-4898097-10', 'auto');
	  ga('create', 'UA-4898097-11', 'auto', {'name': 'secondTracker'});  // New tracker
	  ga('require', 'linkid', {'levels': 5}); // Enhanced Link Attribution on PORTAL 2013 Account. Max DOM levels for element ID. 3 by default
	  ga('send', 'pageview');
	  ga('secondTracker.send', 'pageview'); // Send page view for second tracker
	</script>

	<!-- Begin comScore Tag -->
	<script>
	  var _comscore = _comscore || [];
	  _comscore.push({ c1: "2", c2: "24416377" });
	  (function() {
		var s = document.createElement("script"), el = document.getElementsByTagName("script")[0]; s.async = true;
		s.src = (document.location.protocol == "https:" ? "https://sb" : "http://b") + ".scorecardresearch.com/beacon.js";
		el.parentNode.insertBefore(s, el);
	  })();
	</script>
	<noscript>
	  <img src="https://sb.scorecardresearch.com/p?c1=2&c2=24416377&cv=2.0&cj=1" />
	</noscript>
	<!-- End comScore Tag -->
	
	<!-- Switch to mobile site code -->
	<?php
	$mobile_theme=themekey_custom_theme();
	if($mobile_theme=='bhp'){?>
		<div class="clearfix" style="width:160px; margin:auto; padding-top:60px;">
				<div class="text-center">
					<a style="font-size: 14px;" onclick="eraseCookie('bhpshowdesktop');" href="javascript:void(0)" class="btn btn-default btn-outline btn-view">Switch to Mobile View</a>
				</div>
		</div>
	<?php } ?>
	
</div><!-- footer -->
<script type="text/javascript">

    function eraseCookie(name) {

        document.cookie = name + "=" + "0" + -1 + "; path=/";

        location.reload();
    }
</script>

<!-- QUORA FILTER - DO NOT MODIFY -->
<?php
$url = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$url_parts = parse_url($url);

$path_pos = strpos(substr($url_parts['path'], 1), '/');
$path_check = substr($url_parts['path'], 1, $path_pos + 1);

if (strlen($url_parts['path']) > ($path_pos + 2) AND (
		$path_check == 'news/' OR $path_check == 'tech-stuff/' OR $path_check == 'advice/' OR $path_check == 'safety/')):
?>
<!-- Quora Pixel Code (JS Helper) -->
<script>
	!function(q,e,v,n,t,s){if(q.qp) return; n=q.qp=function(){n.qp?n.qp.apply(n,arguments):n.queue.push(arguments);}; n.queue=[];t=document.createElement(e);t.async=!0;t.src=v; s=document.getElementsByTagName(e)[0]; s.parentNode.insertBefore(t,s);}(window, 'script', 'https://a.quora.com/qevents.js');
	qp('init', '0b556ca5e5804a59b8a44dfaa1222d98');
	qp('track', 'ViewContent');
</script>
<noscript><img height="1" width="1" style="display:none" src="https://q.quora.com/_/ad/0b556ca5e5804a59b8a44dfaa1222d98/pixel?tag=ViewContent&noscript=1"/></noscript>
<!-- End of Quora Pixel Code -->
<?php endif; ?>
<!-- END OF QUORA FILTER -->