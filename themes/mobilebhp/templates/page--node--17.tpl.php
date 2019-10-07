<!-- page node tpl for aboutus- philosophy -->
<div class="page-wrapper">
	<!--#mobilebhp/templates/page.tpl-->

<!--header-->
<?php include(drupal_get_path('theme', 'mobilebhp').'/templates/header.tpl.php'); ?>


	<section>
		<h1 class="hastabs">About Us</h1>

		<div class="article">

<!--	--><?php //include(drupal_get_path('theme', 'mobilebhp').'/templates/about-slick.tpl.php'); ?>
			<!--overview in center active-->

			<div class="sub-nav slide-content about-slide-tabs">
				<div><a href="/aboutus/overview"><i class="icon-overview"></i><span>Overview</span></a></div>
				<div><a href="/aboutus/team"><i class="icon-team"></i><span>Team</span></a></div>
				<div><a href="/aboutus/key-features"><i class="icon-features"></i><span>Features</span></a></div>
				<div class="selected slick-current"><a href="/aboutus/philosophy"><i class="icon-philosophy"></i><span>Philosophy</span></a></div>
				<div><a href="/aboutus/history"><i class="icon-history"></i><span>History</span></a></div>

                <div><a href="/special-moments"><i class="icon-heart-book"></i><span>Special Moments</span></a></div>
                <div><a href="/rtech-memorial"><i class="icon-candle"></i><span>Rtech Memorial</span></a></div>
                <div><a href="/contactus/speak"><i class="icon-cellphone"></i><span>Contact Us</span></a></div>
			</div>





			<div class="about-content">
		<?php        
                      
           print render(field_view_field('node', $node, 'body', array('label'=>'hidden')));
           
        ?>
		</div><!-- tab 2-->

</div>



	<!--also see section-->
	<?php include_once("././themes/mobilebhp/includes/about-also-see.php"); ?>


	<!--contact card section-->
	<?php include_once("././themes/mobilebhp/includes/product-contact-card.php"); ?>

	<!--moment card section 17-->
	<?php include_once("././themes/mobilebhp/includes/product-moment-card.php"); ?>


	<!--rtech card section-->
	<?php include_once("././themes/mobilebhp/includes/rtech-card.php"); ?>


<?php include(drupal_get_path('theme', 'mobilebhp').'/templates/footer.tpl.php'); ?>
</section>
</div>





<script>
	$(window).load(function () {
//		go to slide index
		$('.about-slide-tabs').slick('slickGoTo', parseInt(3));
	})
</script>

<style>
	.article img {
		width: 100%;
		display: block;
		margin-bottom: 10px;
	}
	.article div {
		font-family: "open_sansregular", Helvetica, Arial, sans-serif;
		/*font-size: 1.1428571429rem;*/
	}

</style>