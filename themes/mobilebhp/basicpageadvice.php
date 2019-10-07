
<h1 class="hastabs">Advice</h1>


<div class="sub-nav slide-content" id="advicecat">
    <div class="">
        <a href="#" class="item <?php if ($_GET['catname'] == 'All') { ?> active<?php } ?>" title="All"
           rel="&catname=%">
            <i class="icon-show-all"></i><span>All</span></a></div>
    <div class="selected">
        <a class="item <?php if ($_GET['catname'] == '' || $_GET['catname'] == 'On Buying') { ?> active<?php } ?>"
           href="#" title="On Buying" rel="&catname=On Buying">
            <i class="icon-rupee"></i><span>Buying</span></a></div>
    <div class="">
        <a class="item <?php if ($_GET['catname'] == 'On Owning') { ?> active<?php } ?>" href="#"
           title="On Owning" rel="&catname=On Owning"><i
                class="icon-fiat-car"></i><span>Owning</span></a></div>
    <div class="">
        <a href="#" class="item <?php if ($_GET['catname'] == 'On Modifying') { ?> active<?php } ?>"
           title="On Modifying" rel="&catname=On Modifying"><i
                class="icon-blower"></i><span>Modifying</span></a></div>
    <div class="">
        <a href="#" class="item <?php if ($_GET['catname'] == 'Miscellany') { ?> active<?php } ?>" title="Miscellany"
           rel="&catname=Miscellany"><i
                class="icon-misc"></i><span>Misc</span></a></div>
</div>

<!-- /1063105/mobileleaderboardportal -->
<div id='div-gpt-ad-1497367115460-0' style='height:100px; width:320px;display: block; margin: 0 auto 15px auto'>
    <script>
        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1497367115460-0'); googletag.pubads().refresh(); });
    </script>
</div>

<div class="article">
    <div class="container-fluid advice-list">
        <div class="threadsList with-thumb" style="margin-bottom: 0;">
            <ul id="ajax">
                <?php include("advice.inc"); ?>
            </ul>
        </div>
    </div>
</div>
<div id="listEnds">&nbsp;</div>

<?php include(drupal_get_path('theme', 'mobilebhp') . '/includes/other-sections.php'); ?>
<script type="text/javascript">

    $(window).load(function () {
        $('.slide-content').slick('slickGoTo', parseInt(1));
    });

    $(document).on('click', '.slide-content .slick-slide', function (e) {
        e.preventDefault();
        slideIndex = $(this).index();
        $('.slide-content').slick('slickGoTo', parseInt(slideIndex));
//            alert(slideIndex);
    });


    $(document).on('click', '#advicecat a.item', function (e) {
        e.preventDefault();
        var loaders = $('#loaderWrap').html();
        $("#ajax").html(loaders);
        var url = "<?php echo $base_url;?>?q=advice-list/callback";
        var catname = "&catname=" + $(this).attr('title');
        url += catname + "&m";

        //alert(url);


        $(this).addClass('active');


        $.ajax({
            cache: false,
            url: url,
            dataType: 'text',
            error: function (request, status, error) {
                $("#ajax").html("<div>some error while fetching records...</div>");
            },
            success: function (data, status, request) {
                //console.log(data);
                $('#ajax').html(data);
            }
        });

    });
    function appendNext(url){
        var ajaxUrl = "<?php echo $base_url;?>" + url + "&m";
        $.ajax({
            cache: false,
            url: ajaxUrl,
            dataType: 'text',
            error: function (request, status, error) {
                window.fetchingData = false;
                $("#ajax").append("<li>some error while fetching records...</li>");
            },
            success: function (data, status, request) {
                //console.log(data);
                window.fetchingData = false;
                $('#ajax').append(data);
            }
        });
    }

    //go to active slide
    $(".slide-content .slick-slide").click(function(e){
        e.preventDefault();
        slideIndex = $(this).index();
        $('.slide-content').slick('slickGoTo', parseInt(slideIndex));
        // alert(slideIndex);
    });
    //ajax call once scroll till footer
    $(function () {
        var loaders = $('#loaderWrap').html();
        // show hide subnav depending on scroll direction
        var position = $(window).scrollTop();
        var scrollDirection = '';
        window.fetchingData = false;
        $(window).scroll(function () {
            var scroll = $(window).scrollTop();
            if (scroll > position) {
                // scrolling downwards, only here for dev purposes
                scrollDirection = 'up';
            } else {
                // scrolling upwards
                scrollDirection = 'down';
            }
            position = scroll;
        });


        $("#listEnds").on('inview', function (event, isInView) {
            // if (isInView && scrollDirection=='up' && !window.fetchingData) {
            if (isInView && !window.fetchingData) {
                // element is now visible in the viewport
                window.fetchingData = true;
                //console.log('yes',window.fetchingData,$("#wrapList-hotthread li").last().attr('data-nextpage'));
                $(this).html(loaders);
                var dataURL = $("#ajax li").last().attr('data-nextpage');
                if (dataURL) {
                    appendNext(dataURL);
                } else {
                    //console.log('OFF',dataURL);
                    window.fetchingData = false;
                    $(this).html('&nbsp;');
                    //$(this).off('inview');
                }


                //  $("body").css('overflow','hidden');


            } else {
                //fetchingData = false;
                // element has gone out of viewport
                //console.log('no',window.fetchingData);

            }
        });

    });

</script>
