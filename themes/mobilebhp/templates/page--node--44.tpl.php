<!-- page node tpl for rtech memorial-->


<div class="page-wrapper">
    <!--#mobilebhp/templates/page.tpl-->
    <!--@@rtech 44-->
    <!--header-->
    <?php include(drupal_get_path('theme', 'mobilebhp') . '/templates/header.tpl.php'); ?>

    <div class="article">
        <div class="testimonial text-center">
            <h1>RTECH MEMORIAL
                <span>Robin Shroff</span>
                <span class="date">27th Jun 1978 - 23rd Dec 2007</span>
            </h1>

            <div class="memorial-bg text-center">
                <?php include_once("././themes/mobilebhp/includes/rtech-gallery.php"); ?>
            </div>
            <div class="container-fluid">
                <p>A beautiful human being, Ace biker & Team-BHP Moderator</p>
            </div>
        </div>


        <?php include_once("././themes/mobilebhp/includes/testimonial.php"); ?>

        <?php $block = module_invoke('block', 'block_view', 42); /*  Testimonial*/
        //print $block['content'];
        ?>


        <?php
        include_once("././themes/mobilebhp/includes/rTech-pagination.php");
        ?>
    </div>

    <?php include(drupal_get_path('theme', 'mobilebhp') . '/templates/footer.tpl.php'); ?>

</div>
