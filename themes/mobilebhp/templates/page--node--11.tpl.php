<!-- page node tpl for aboutus overview -->
<div class="page-wrapper">
    <!--#mobilebhp/templates/page.tpl-->

    <!--header-->
    <?php include(drupal_get_path('theme', 'mobilebhp') . '/templates/header.tpl.php'); ?>

<section>
    <h1 class="hastabs">About Us</h1>

    <div class="article">

<!--        about tabs-->
<!--        --><?php //include(drupal_get_path('theme', 'mobilebhp') . '/templates/about-slick.tpl.php'); ?>


        <div class="sub-nav slide-content about-slide-tabs">
            <div class="selected slick-current"><a href="/aboutus/overview"><i class="icon-overview"></i><span>Overview</span></a></div>
            <div><a href="/aboutus/team"><i class="icon-team"></i><span>Team</span></a></div>
            <div><a href="/aboutus/key-features"><i class="icon-features"></i><span>Features</span></a></div>
            <div><a href="/aboutus/philosophy"><i class="icon-philosophy"></i><span>Philosophy</span></a></div>
            <div><a href="/aboutus/history"><i class="icon-history"></i><span>History</span></a></div>

            <div><a href="/special-moments"><i class="icon-heart-book"></i><span>Special Moments</span></a></div>
            <div><a href="/rtech-memorial"><i class="icon-candle"></i><span>Rtech Memorial</span></a></div>
            <div><a href="/contactus/speak"><i class="icon-cellphone"></i><span>Contact Us</span></a></div>
        </div>


<!--        gallery-->
        <?php include_once("././themes/mobilebhp/includes/overview-gallery.php"); ?>

<!--        content-->
        <div class="about-content">

            <?php
            print render(field_view_field('node', $node, 'body', array('label' => 'hidden')));
            ?>

        </div>
    </div>


    <!--also see section-->
    <?php include_once("././themes/mobilebhp/includes/about-also-see.php"); ?>


    <!--contact card section-->
    <?php include_once("././themes/mobilebhp/includes/product-contact-card.php"); ?>

    <!--moment card section 11-->
    <?php include_once("././themes/mobilebhp/includes/product-moment-card.php"); ?>


    <!--rtech card section-->
    <?php include_once("././themes/mobilebhp/includes/rtech-card.php"); ?>


<!--    footer-->
    <?php include(drupal_get_path('theme', 'mobilebhp') . '/templates/footer.tpl.php'); ?>

</section>
</div>

<!--go to top button-->
<a class="go-to-top"><i class="icon-angle-up"></i></a>

<script>
    $(window).load(function () {

//        slideIndex = $('.selected.slick-current').index();
//        $(".about-slide-tabs").slickGoTo( parseInt(0) );


//        var slider = $( '.slide-content' );
        $('.about-slide-tabs').slick('slickGoTo', parseInt(0));


//        $('.sub-nav div[data-slick-index="0"]').addClass('selected slick-current slick-active');
    })
</script>
