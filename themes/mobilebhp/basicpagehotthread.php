<!--hot threads-->
<h1 class="hastabs">Hot Threads</h1>
<?php include(drupal_get_path('theme', 'mobilebhp') . '/includes/find-threads.php'); ?>
<!-- /1063105/mobileleaderboardportal -->
<div id='div-gpt-ad-1497367115460-0' style='height:100px; width:320px;display: block; margin: 0 auto 15px auto'>
    <script>
        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1497367115460-0'); googletag.pubads().refresh(); });
    </script>
</div>
<section class="hot-threads">
    <div class="container-fluid">

        <!--	fullcode		-->


        <div id="war-htread" class="threadsList with-thumb" style="min-height: 300px; padding-top: 0;">
            <ul id="wrapList-hotthread">
                <?php include(drupal_get_path('theme', 'mobilebhp') . '/hotthread.inc'); ?>
            </ul>
        </div>
        <div id="listEnds">&nbsp;</div>

    </div>
</section>
<script type="text/javascript">

    $(document).ready(function(){

        //go to active slide
        $(".slide-content .slick-slide").click(function(e){
            e.preventDefault();
            slideIndex = $(this).index();
            $('.slide-content').slick('slickGoTo', parseInt(slideIndex));
//            alert(slideIndex);
        });


//       check if window url has travelogue then select the tab and shift the tab to center
        var wloc = window.location.href; // returns the full URL
        if(/Travelogues/.test(wloc)) {
          $('.slick-slide').removeClass('selected');
          $('.slick-slide[data-slick-index="5"]').addClass('selected');
          $('.slide-content').slick('slickGoTo', parseInt(5));
        }




    });


    $(document).on('click', '.btn-htread', function (e) {
        e.preventDefault();

        //var loaders = $('#loaderWrap').html();

        //console.log(loaders);

        //$("#war-htread").html(loaders);
        var url = "<?php echo $base_url;?>?q=hot-thread/callback";
        if ($(this).hasClass('btn-htread')) {

            var catname = "&catname=" + $(this).attr('data-catid');
            $('.btn-htread').removeClass('active');
            $(this).addClass('active');
            url += catname;

        } else {
            //console.log('.pagination');

        }

        url += "&m";
        $.ajax({
            cache: false,
            url: url,
            dataType: 'text',
            error: function (request, status, error) {
                $("#war-htread").html("<div>some error while fetching records...</div>");
            },
            success: function (data, status, request) {
                //console.log(data);
                $('#war-htread').html('<ul id="wrapList-hotthread">' + data + '</ul>');
                //$('#war-wrapList-hotthread').html(data);
            }
        });

    });

    function appendNext(url) {
        var ajaxUrl = "<?php echo $base_url;?>" + url + "&m";
        $.ajax({
            cache: false,
            url: ajaxUrl,
            dataType: 'text',
            error: function (request, status, error) {
                window.fetchingData = false;
                $("#wrapList-hotthread").append("<li>some error while fetching records...</li>");
            },
            success: function (data, status, request) {
                //console.log(data);
                window.fetchingData = false;
                $('#wrapList-hotthread').append(data);
            }
        });
    }


    //				$(document).on('click','', function(){
    //
    //				})
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
                var dataURL = $("#wrapList-hotthread li").last().attr('data-nextpage');
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


<!--	fullcode		-->



