<!-- page node tpl for aboutus- Key Feature -->
<div class="page-wrapper">
	<!--#mobilebhp/templates/page.tpl-->

<!--header-->
<?php include(drupal_get_path('theme', 'mobilebhp').'/templates/header.tpl.php'); ?>

	<section>
		<h1 class="hastabs">About Us</h1>

<!--	--><?php //include(drupal_get_path('theme', 'mobilebhp').'/templates/about-slick.tpl.php'); ?>

		<div class="sub-nav slide-content about-slide-tabs">
			<div><a href="/aboutus/overview"><i class="icon-overview"></i><span>Overview</span></a></div>
			<div><a href="/aboutus/team"><i class="icon-team"></i><span>Team</span></a></div>
			<div class="selected slick-current"><a href="/aboutus/key-features"><i class="icon-features"></i><span>Features</span></a></div>
			<div><a href="/aboutus/philosophy"><i class="icon-philosophy"></i><span>Philosophy</span></a></div>
			<div><a href="/aboutus/history"><i class="icon-history"></i><span>History</span></a></div>

            <div><a href="/special-moments"><i class="icon-heart-book"></i><span>Special Moments</span></a></div>
            <div><a href="/rtech-memorial"><i class="icon-candle"></i><span>Rtech Memorial</span></a></div>
            <div><a href="/contactus/speak"><i class="icon-cellphone"></i><span>Contact Us</span></a></div>
		</div>


		<div class="about-content">
		<?php        
                      
//           print render(field_view_field('node', $node, 'field_key_features', array('label'=>'hidden')));
           print render(field_view_field('node', $node, 'field_key_features'));

//added title for member section
            echo('<div class="field-label field-mem-profile-title">Member profile:</div>');

            echo('<p class="marT10">We have an eclectic list of members. They:</p>');

           print render(field_view_field('node', $node, 'field_member_profile', array('label'=>'hidden')));

        ?>
		</div>



	<!--also see section-->
	<?php include_once("././themes/mobilebhp/includes/about-also-see.php"); ?>


	<!--contact card section-->
	<?php include_once("././themes/mobilebhp/includes/product-contact-card.php"); ?>

	<!--moment card section 3592-->
	<?php include_once("././themes/mobilebhp/includes/product-moment-card.php"); ?>


	<!--rtech card section-->
	<?php include_once("././themes/mobilebhp/includes/rtech-card.php"); ?>


<?php include(drupal_get_path('theme', 'mobilebhp').'/templates/footer.tpl.php'); ?>
</section>
</div>

<script>
	$(window).load(function () {
//		go to slide index
		$('.about-slide-tabs').slick('slickGoTo', parseInt(2));
	})
</script>

<style type="text/css">
	.field-item {
		margin-bottom: 2.8571428571rem;
		padding-left: 15px;
		position: relative;
	}
	.field-item:before {
		position: absolute;
		content: '\2022';
		left: 0;
		top: 0;
	}

</style>