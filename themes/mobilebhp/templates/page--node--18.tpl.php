<!-- page node tpl for aboutus- history -->
<div class="page-wrapper">
	<!--#mobilebhp/templates/page.tpl-->

<!--header-->
<?php include(drupal_get_path('theme', 'mobilebhp').'/templates/header.tpl.php'); ?>

	<section>
		<h1 class="hastabs">About Us</h1>

		<div class="article">
<!--	--><?php //include(drupal_get_path('theme', 'mobilebhp').'/templates/about-slick.tpl.php'); ?>

			<div class="sub-nav slide-content about-slide-tabs">
				<div><a href="/aboutus/overview"><i class="icon-overview"></i><span>Overview</span></a></div>
				<div><a href="/aboutus/team"><i class="icon-team"></i><span>Team</span></a></div>
				<div><a href="/aboutus/key-features"><i class="icon-features"></i><span>Features</span></a></div>
				<div><a href="/aboutus/philosophy"><i class="icon-philosophy"></i><span>Philosophy</span></a></div>
				<div class="selected slick-current"><a href="/aboutus/history"><i class="icon-history"></i><span>History</span></a></div>

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

	<!--moment card section 18-->
	<?php include_once("././themes/mobilebhp/includes/product-moment-card.php"); ?>


	<!--rtech card section-->
	<?php include_once("././themes/mobilebhp/includes/rtech-card.php"); ?>


<?php include(drupal_get_path('theme', 'mobilebhp').'/templates/footer.tpl.php'); ?>
</section>
</div>
<script>

//	$(document).ready(function(){
//		$('.slide-content').slick({
//			infinite: true,
//			centerMode: true,
//			slickGoTo: 4
//		});
//	});

	$(window).load(function () {
//		go to slide index
		$('.about-slide-tabs').slick('slickGoTo', parseInt(4));

//      remove zoom icon
		$('.zoomIt').hide();

//        console.log($('.singlePhoto img').attr('rel'));
//        console.log($('.singlePhoto img').attr('src'));


//      disable zoom functionality of images
//        $(document).find('img.zoomLt').each(function(){
//
//            console.log($(this).attr('rel'));
//            console.log($(this).attr('src'));
//
//            //        get rel path of big image
//            var imgrelpath = $(this).attr('rel');
//
//            //        replace src with rel path
//            $(this).attr('src', imgrelpath).removeAttr('height width');
//
//            //        remove zoom classes
//            $('.singlePhoto').removeClass('zoomSingleImg fleft').css('pointer-events','none');
//
//            $(document).on('click','.singlePhoto', function(){
//
//                $(this).removeAttr('style');
//
//            });
//
//
//        });







	});

</script>
