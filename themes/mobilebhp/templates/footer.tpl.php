<!--get page url-->
<?php

    $deskUrl = str_replace('','', strtolower($_SERVER['REQUEST_URI']));
//    $deskUrl = str_replace('&','-', $deskUrl);

?>

<div class="hidden">
    <div>current url</div>
    <?php

    echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    ?>
</div>

<div class="hidden">
    <div>desktop url</div>
    <?php

    echo 'http://' . $_SERVER['HTTP_HOST'] . $deskUrl;

    ?>
</div>




<footer class="border-top-red border-btm-red">
    <div class="border-btn-dash">
        <?php include(drupal_get_path('theme', 'mobilebhp') . '/includes/common/navigation.php'); ?>

    </div>
    <div class="sub-section social-icons border-btn-dash">
        <div class="text-center">
            <a href="https://www.facebook.com/teambhp/" class="circle fb"><i
                    class="icon-facebook"></i></a>
            <a href="https://mobile.twitter.com/teambhpforum" class="circle twt"><i
                    class="icon-twitter"></i></a>
            <a href="/rss-feed/" class="circle feeds"><i
                    class="icon-rss"></i></a></div>
        <div class="text-center">
            <a href="javascript:(void)" class="btn btn-default btn-outline subscribe btn-subscribe">Subscribe to Newsletter</a>
        </div>
    </div>
    <div class="sub-section desktop-view" style="padding: 1.8571428571rem 0;" onclick="createCookie('bhpshowdesktop',1,1);">

      <div class="text-center">
            <a href="javascript:void(0)" class="circle"><i class="icon-desktop"></i></a>
        </div>
        <div class="text-center">
            <a href="javascript:void(0)" class="btn btn-default btn-outline btn-view">Switch me to Desktop View</a>
        </div>
  </div>
    <div class="links">
        <div class="text-center">
            <a href="/privacy-policy">Privacy Policy</a>
            <a href="/terms-conditions">Terms &amp;
                Conditions</a></div>
        <div class="text-center">Copyright <?php echo date("Y");?> - <a href="http://www.team-bhp.com">www.team-bhp.com</a></div>
    </div>
    <div class="text-center"><a href="/" class="brand"><img
                src="<?php print base_path() . path_to_theme() ?>/images/logo-teambhp.png" alt="Team BHP"
                title="Team BHP" class="img-responsive"></a></div>

<!--    <div class="text-center made-by"><small>Made in India by</small><a href="javascript:void(0)"><img src="--><?php //print base_path() . path_to_theme() ?><!--/images/vivax_logo.svg" alt="vivax-logo" title="vivax-logo"></a></div>-->
</footer>


<!--loader initiated-->
<div id="loaderWrap" style="display: none;">
    <div class="loader text-center">
        <div class="loading"></div>
        <div class="message">Getting more results</div>
    </div>
</div>


<!--subscribe modal-->
<?php include(drupal_get_path('theme', 'mobilebhp') . '/includes/subscribe-modal.php'); ?>

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
<!-- Javascript tag  -->
<!-- begin ZEDO for channel:  Forum-Mobile , publisher: Team BHP , Ad Dimension: Slider - 1 x 1 -->
<script language="JavaScript">
    var zflag_nid="1893"; var zflag_cid="21"; var zflag_sid="1"; var zflag_width="1"; var zflag_height="1"; var zflag_sz="94";
</script>
<script language="JavaScript" src="https://tt3.zedo.com/jsc/tt3/fo.js"></script>
<!-- end ZEDO for channel:  Forum-Mobile , publisher: Team BHP , Ad Dimension: Slider - 1 x 1 -->

<script type="text/javascript">

    function createCookie(name,value,days) {
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days*24*60*60*1000));
            var expires = "; expires=" + date.toUTCString();
        }
        else var expires = "";
        document.cookie = name + "=" + value + expires + "; path=/";
        location.reload();
    }
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