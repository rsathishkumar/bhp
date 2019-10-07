<!-- page node tpl for aboutus- the Team member-->

<div class="page-wrapper">

<!--header-->
<?php include(drupal_get_path('theme', 'mobilebhp').'/templates/header.tpl.php'); ?>

	<section>
		<h1 class="hastabs">About Us</h1>

		<div class="article">

			<!-- about tabs-->
<!--			--><?php //include(drupal_get_path('theme', 'mobilebhp') . '/templates/about-slick.tpl.php'); ?>


			<div class="sub-nav slide-content about-slide-tabs">
				<div><a href="/aboutus/overview"><i class="icon-overview"></i><span>Overview</span></a></div>
				<div class="selected slick-current"><a href="/aboutus/team"><i class="icon-team"></i><span>Team</span></a></div>
				<div><a href="/aboutus/key-features"><i class="icon-features"></i><span>Features</span></a></div>
				<div><a href="/aboutus/philosophy"><i class="icon-philosophy"></i><span>Philosophy</span></a></div>
				<div><a href="/aboutus/history"><i class="icon-history"></i><span>History</span></a></div>

                <div><a href="/special-moments"><i class="icon-heart-book"></i><span>Special Moments</span></a></div>
                <div><a href="/rtech-memorial"><i class="icon-candle"></i><span>Rtech Memorial</span></a></div>
                <div><a href="/contactus/speak"><i class="icon-cellphone"></i><span>Contact Us</span></a></div>
			</div>


			<!--content-->
			<?php include_once("././themes/mobilebhp/includes/team-member.php"); ?>

		</div>




		<!--also see section-->
		<?php include_once("././themes/mobilebhp/includes/about-also-see.php"); ?>


		<!--contact card section-->
		<?php include_once("././themes/mobilebhp/includes/product-contact-card.php"); ?>

		<!--moment card section 15-->
		<?php include_once("././themes/mobilebhp/includes/product-moment-card.php"); ?>


		<!--rtech card section-->
		<?php include_once("././themes/mobilebhp/includes/rtech-card.php"); ?>

	</section>



<?php include(drupal_get_path('theme', 'mobilebhp').'/templates/footer.tpl.php'); ?>


</div>

<script>
	$(window).load(function () {
//		go to slide index
		$('.about-slide-tabs').slick('slickGoTo', parseInt(1));
	})
</script>

