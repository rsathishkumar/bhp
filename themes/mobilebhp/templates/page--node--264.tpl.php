<!-- page node tpl for aboutus- special moments 264-->

<style type="text/css">
    ul.tab,
    .article h1,
    .blackBullet + p {
        display: none;
    }
    .blackBullet li {
        margin-bottom: 12px!important;
    }
    .blackBullet li a {
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
        padding: 0.7142857143rem 1.4285714286rem;
        font-family: "open_sansregular", Helvetica, Arial, sans-serif;
        font-size: 1rem;
        line-height: 1.2857142857rem;
        min-height: 72px;
    }

</style>

<div class="page-wrapper">
<!--header-->
<?php include(drupal_get_path('theme', 'mobilebhp').'/templates/header.tpl.php'); ?>


<h1>Special Moments</h1>

<section class="moments-all">
        <div class="container-fluid">
          <div class="threadsList">
            <?php print render(field_view_field('node', $node, 'body', array('label'=>'hidden'))); ?>
          </div>
        </div>
</section>



    <!--contact card section-->
    <?php include_once("././themes/mobilebhp/includes/product-contact-card.php"); ?>

    <!--moment card section 264-->
    <?php //include_once("././themes/mobilebhp/includes/product-moment-card.php"); ?>


    <!--rtech card section-->
    <?php include_once("././themes/mobilebhp/includes/rtech-card.php"); ?>




<?php include(drupal_get_path('theme', 'mobilebhp').'/templates/footer.tpl.php'); ?>

</div>

