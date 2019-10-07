
<header class="border-btm-red">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="javascript:void(0)" class="pull-left menu-toggle" onclick="ga('secondTracker.send','event','Mobile_Menu_Open','Portal')">
                    <i class="icon-menu"></i>
                </a>
                <a href="/" class="brand">
                    <img src="<?php print base_path().path_to_theme() ?>/images/logo-teambhp.png" alt="Team BHP" title="Team BHP" class="img-responsive"></a>
<!--                <a href="/searchmobilebhp.php?q=&cx=partner-pub-8422315737402856%3Azcmboq-gw8i&cof=FORID%3A9&ie=ISO-8859-1&sa=Search" class="pull-right search">-->
<!--                    <i class="icon-search"></i>-->
<!--                </a>-->

                <a href="javascript:void(0)" class="pull-right search">
                    <i class="icon-search"></i>
                </a>
            </div>
        </div>

    </div>


    <!--sliding main nav-->
    <div class="menu-mobile border-top-red">
        <?php include(drupal_get_path('theme', 'mobilebhp') . '/includes/common/navigation.php'); ?>
    </div>



    <!--    search-->
    <?php include(drupal_get_path('theme', 'mobilebhp') . '/includes/search-side-wrap.php'); ?>


    <!--    search-->



</header>