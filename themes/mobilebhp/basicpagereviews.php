<?php
/**
 * Created by PhpStorm.
 * User: cliste2
 * Date: 10/11/16
 * Time: 3:02 PM
 */

?>

<h1 class="hastabs">Reviews</h1>

<script type="text/javascript">

    var loaders = $('#loaderWrap').html();

    $(document).on('click', '.brand-lists li a', function (e) {
        e.preventDefault();
        $('#listEnds').html(loaders);
        var makeid = $(this).attr('data-value');
        $('.dropdown-toggle').html($(this).html() + '<i class="icon-angle-down"></i>');
        $.ajax(
            {
                cache: false,
                url: "/themes/mobilebhp/show_modelbymake_1.php",
                type: "POST",
                data: "makeid="+makeid+"&action=show",
                error: function(request, status, error)
                {
                    alert(status);
                    $('.review-list').html(request.responseText);
                },
                success: function(data, status, request)
                {
                    //console.log(data);
                    $("div#ajax").html(data);
                    //$('.review-list').html(data);
                }
            });
    });


</script>
<?php

$q_model = "SELECT node.title,node.nid, field_data_field_make_home_page.field_make_home_page_nid
				FROM node,field_data_field_make_home_page WHERE field_data_field_make_home_page.entity_id = node.nid  AND node.status =1  order by node.created desc";
$sql_model=@mysqli_query($q_model);

$numberofrows=@mysqli_num_rows($sql_model);

//if($numberofrows>0)
//{
//    $mid='';
//    while($data_modelfornid=mysqli_fetch_array($sql_model))
//    {
//        $mid.=$data_modelfornid['nid'].",";
//    }
//}
//if($numberofrows<20)
//{
//    $Minus = 20 - $numberofrows;
//}
//else
//{
//    $Minus = 1 ;
//}

$sql_modelrand=@mysqli_query("SELECT node.title,node.nid, field_data_field_make_home_page.field_make_home_page_nid
				FROM node,field_data_field_make_home_page WHERE field_data_field_make_home_page.entity_id = node.nid  AND node.status =1 AND node.nid not in (".@substr($mid,0,-1).") order by rand() ".$Minus);
$numberofrowsrand=@mysqli_num_rows($sql_modelrand);

$sql_make=@mysqli_query("select node.title,node.nid from node,field_data_field_make_home_page where field_data_field_make_home_page.field_make_home_page_nid=node.nid and node.status=1 group by field_data_field_make_home_page.field_make_home_page_nid order by node.title");
$data_make=mysqli_fetch_array($sql_make);
$nofmake=mysqli_num_rows($sql_make);
?>



<!--button select brands-->
<div class="news-filters text-center">
    <button type="button" class="btn btn-brand all-news">
        <span class="ellipsis">All Brands</span>
        <i class="icon-angle-down"></i>
    </button>
</div>

<!--        dropdown menu-->
<div class="news-brands" style="display: none;">
    <div class="brand-lists">
        <!-- By Brand -->
        <ul id="newsBrandList">
            <li>
                <a href="javascript:void(0)" class="text-center brand-all" data-brandname="All Brands"
                   data-value="0">
                    <span class="c-logo">
                        <i class="icon-all-brand"></i>
                    </span>

                    <span class="text">All Brands</span>
                </a>
            </li>

            <?php
            $sql_model=@mysqli_query($q_model);

            if($nofmake>0)
            {
                while($data_make=mysqli_fetch_array($sql_make))
                {

                    ?>
                    <li>
                        <?php
                        $node = node_load($data_make['nid']);
                        if (!empty($node->field_make_logo['und'][0]['uri'])) {
                            $logo = $base_url . '/sites/default/files/' . str_replace("public://", "", $node->field_make_logo['und'][0]['uri']);
                        } else {
                            $logo = "http://placehold.it/80x80";
                        }
                        ?>
                        <a href="javascript:void(0)" data-brandname="<?php echo $data_make['title'];?>" data-value="<?php echo $data_make['nid'];?>">
                            <!--                                    --><?php //echo $data_make['title'];?>
                            <span class="c-logo">
                                <img src="<?php echo $logo;?>" alt="" title="">
                            </span>
                                    <span class="text">
                                        <?php echo $data_make['title'];?>

                                    </span>
                        </a>
                    </li>

                <?php
                }
            }
            ?>
        </ul>
    </div>
</div>


<!-- /1063105/mobileleaderboardportal -->
<div id='div-gpt-ad-1497367115460-0' style='height:100px; width:320px;display: block; margin: 10px auto 5px auto'>
    <script>
        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1497367115460-0'); googletag.pubads().refresh(); });
    </script>
</div>

<!--review listing-->
<section id="newsListings" class="">
    <div class="container-fluid">
        <div id="ajax">
            <div class="threadsList with-thumb review-listing">
                <ul>

                    <?php
                    if($numberofrows>=1)
                    {
                        while($data_model=@mysqli_fetch_array($sql_model))
                        {
                            $sql_img=@mysqli_fetch_array(mysqli_query("SELECT  field_home_page_review_image_fid as fid,uri FROM `field_data_field_home_page_review_image`,file_managed WHERE file_managed.fid=field_data_field_home_page_review_image.field_home_page_review_image_fid and field_data_field_home_page_review_image.entity_id='".$data_model['nid']."'"));
                            //$model_imgname="sites/default/files/defaultmodel_131.gif";
                            //$makeRow = @mysqli_fetch_array(mysqli_query("select title from node where nid=".$data_model['field_nr_make_nid']));
                            $makeRow = @mysqli_fetch_array(mysqli_query("select title from node where nid=".$data_model['field_make_home_page_nid']));
                            $Link = @mysqli_fetch_array(mysqli_query("select field_home_page_review_url_link_value from field_data_field_home_page_review_url_link where entity_id=".$data_model['nid']));
                            ?>


                            <li>
                                <a href="<?php echo $Link['field_home_page_review_url_link_value'];?>" title="<?php echo $data_model['title'];?>">

                                <span class="thumb" style="background-image: url('/sites/default/files/styles/check_mobile_thumb/public/<?php echo str_replace("public://","",$sql_img['uri']);?>');">

                                </span>
								  <span class="text">
									<span class="ellipsis-3-line"><?php echo /*$makeRow['title']." ".*/$data_model['title'];?></span>
								  </span>
                                    <!--								-->
                                    <!--								<img class="slider-image" src="/sites/default/files/styles/check_car_review_home/public/--><?php //echo str_replace("public://","",$sql_img['uri']);?><!--" alt="--><?php //echo $data_model['title'];?><!--" />-->
                                    <!--								<div class="caption">--><?php //echo /*$makeRow['title']." ".*/$data_model['title'];?><!--</div>-->
                                </a>
                            </li>


                        <?php
                        }
                    }
                    else
                    {
                        ?>
                        <li>
                            <span>No review found</span>
                        </li>
                    <?php
                    }
                    ?>

                </ul>
            </div>

            <div id="listEnds"></div>
        </div><!-- end of ajax -->

    </div>
    <div id="listEnds"></div>
</section>


<script>



    $(document).ready(function() {

        var myList1 = $('.review-listing ul');
        var loaders = $('#loaderWrap').html();

        $('#listEnds').html(loaders);
//        console.log($('#listEnds').html());
        myList1.find('li:gt(10)').addClass('hideme');

        /* Every time the window is scrolled ... */
//        $(window).scroll( function(){
//
//            /* Check the location of each desired element */
//            $('.hideme').each( function(i){
//
//                var bottom_of_object = $(this).offset().top + $(this).outerHeight();
//                var bottom_of_window = $(window).scrollTop() + $(window).height() - 20;
////
////                console.log(bottom_of_object);
////                console.log(bottom_of_window);
//
//
//                /* If the object is completely visible in the window, fade it it */
//                if( bottom_of_window > bottom_of_object ){
//
//                    $('#listEnds').show();
//
//                    $(this).animate({'opacity':'1'},500);
//
//                    if ($('.hideme').index($(this)) + 1 === $('.hideme').length) {
//                        // We've shown them all, stop listening for scroll events!!!
//                        $(window).off('scroll');
//                        $('#listEnds').hide();
//                    }
//
//                }else {
//                    $('#listEnds').hide();
//                }
//            });
//
//        });


    });

        function isScrolledIntoView(elem) {
            var docViewTop = $(window).scrollTop();
            var docViewBottom = docViewTop + $(window).height();

            var elemTop = $(elem).offset().top;
            var elemBottom = elemTop + $(elem).height();

            return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
        }


        $(window).load(function(){
            $('.review-listing ul li:gt(10)').each(function(){
                if(!isScrolledIntoView($(this))){
                    $(this).addClass('hideme');
                }
            });

            $(document).on('scroll', function(){

                setTimeout(function(){
                    $('.hideme').each(function(){
                        if(isScrolledIntoView($(this))){

                            $(this).removeClass('hideme');
                            $('#listEnds').hide();

                        }else {
                            $('#listEnds').show();
                        }

                    });
                }, 1500);


            });
        });



    $('#ajax').bind('contentchanged', function() {
        // do something after the div content has changed
        $(document).on('scroll', function(){

            setTimeout(function(){
                $('.hideme').each(function(){
                    if(isScrolledIntoView($(this))){

                        $(this).removeClass('hideme');
                        $('#listEnds').hide();

                    }else {
                        $('#listEnds').show();
                    }

                });
            }, 300);


        });
    });










</script>

<!--button-->
<!--            <div class="text-center">-->
<!--                <a href="/forum/official-new-car-reviews/?pp=25&sort=dateline&order=desc&daysprune=-1" ripple-background="radial-gradient(red, yellow)" ripple-opacity="0.7" class="btn btn-red ripple">All Reviews</a>-->
<!--            </div>-->
