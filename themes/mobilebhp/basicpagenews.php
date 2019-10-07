<?php
if (isset($_REQUEST['catname'])) {
    $cat = $_REQUEST['catname'];
} else if (!isset($_REQUEST['catname']) and !isset($_REQUEST['model']) and !isset($_REQUEST['tag']) and !isset($_REQUEST['t'])) {
    $cat = '%';
}
?>
<h1 class="hastabs">News</h1>

<!--find news includes-->
    <?php include(drupal_get_path('theme', 'mobilebhp').'/includes/find-news.php'); ?>
<!--find news includes-->

<!-- /1063105/mobileleaderboardportal -->
<div id='div-gpt-ad-1497367115460-0' style='height:100px; width:320px;display: block; margin: 10px auto 5px auto'>
    <script>
        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1497367115460-0'); googletag.pubads().refresh(); });
    </script>
</div>

<section id="newsListings" class="news">
    <div class="container-fluid">
        <div class="threadsList with-thumb">
            <ul id="ajax" style="min-height: 300px;">
                <?php include(drupal_get_path('theme', 'mobilebhp') . '/news.inc'); ?>
            </ul>
        </div>
    </div>
</section>
<div id="listEnds">&nbsp;</div>

<script type="text/javascript">

  /*  function nav_news(link) {

        //if(document.getElementById("newsBrandList").value=='%' && document.getElementById("newsTagList").value=='%')
        if ($("#newsBrandList").val() == '%' && $("#newsTagList").val() == '%') {
            jQuery("select#newsTagList, select#newsBrandList").each(function () {
                var field = jQuery(this);
                field.val(jQuery("option:first", field).val());
            });
        }

        //$('html, body').animate({scrollTop: $("h1").offset().top-10}, 300);
        var url =   //echo $base_url;?>?q=news-list/callback";
        url += link + '&m';
        //jQuery.url.setUrl(url);
        $.ajax(
            {
                cache: false,
                url: url,
                dataType: 'text',
                error: function (request, status, error) {
//							alert(status);
                    $('#container').html(request.responseText);
                },
                success: function (data, status, request) {
                    $('#ajax').html(data);
                }
            });
    }
    $('.paging').on("click", function () {
        nav_news(this.rel);
        //$("ul#newslist").html('<div class="loader">&nbsp;<\/div>');
        $('#ajax').html(loaders);
        //alert(this.attr("rel"));

        return (false);
    });

    $('.pagination li a').on("click", function () {
        if ($(this).hasClass("active")) {
            return false;
        }
        else {
            nav_news(this.rel);
            //$('#ajax').html('<div class="loader">&nbsp;<\/div>');
            $('#ajax').html(loaders);
        }

        return (false);
    });*/


    $(document).on('click', '#newsBrandList li a', function (e) {
        e.preventDefault();
        var loaders = $('#loaderWrap').html();
        $('#ajax').html(loaders);
        var modelcat = "&model=" + $(this).attr('data-id');
        var url = "<?php echo $base_url;?>?q=news-list/callback";

        url += modelcat + "&m";

        //alert(modelcat);

        $.ajax(
            {
                cache: false,
                url: url,
                dataType: 'text',
                error: function (request, status, error) {
                    alert(status);
                    $('#ajax').html(request.responseText);
                },
                success: function (data, status, request) {

                    //console.log(data);
                    $('#ajax').html(data);

                }
            });
    });

    $(document).on('click', '#newsCatList li a', function (e) {
        e.preventDefault();
        var loaders = $('#loaderWrap').html();
        $('#ajax').html(loaders);
        var modelcat = "&tag=" + $(this).attr('data-id');

        var url = "<?php echo $base_url;?>?q=news-list/callback";

        url += modelcat + "&m";
        //alert(url);


        $.ajax(
            {
                cache: false,
                url: url,
                dataType: 'text',
                error: function (request, status, error) {
                    alert(status);
                    $('#ajax').html(request.responseText);
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


<?php
$pQ = "&page=1";
if (count($_REQUEST) > 1) {
    while (list($key, $val) = each($_REQUEST)) {
        if ($key != "page" && $key != "q") {
            $pQ .= "&" . $key . "=" . $val;
        }
        //echo "$key => $val\n";
    }
} else {
    $pQ .= "&catname=%";
}

?>
