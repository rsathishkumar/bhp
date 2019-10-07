
var count=0;
  var count1=0;
  (function ($) {
   //$(function(){
      
      $i=0;
      $n=0;

      var myInt = setInterval(function(){
        //alert('inbanner');
        count ++;
        if(count==5){
          $j = $i+1;
          count = 0;

          if($j<$("div.banner").length)
          {

            $("div.banner").eq($i).fadeIn(800, function(){
              $("div.banner").fadeOut("slow");
              $("div.banner").eq($j).fadeIn("slow");
              $(".bannerTabs ul li").removeClass("active");
              $(".bannerTabs ul li").eq($j).addClass("active");
              $("#bannerTitle a").text($(this).next().attr("title"));
              $("#bannerTitle a").attr("href", $(this).next().attr("rel"));
            });
            $i = $i+1;
          }
          else
          {
            $i=0;
            $("div.banner").eq($("div.banner").length-1).fadeIn(800, function(){
              $("div.banner").fadeOut("slow");
              $("div.banner").eq(0).fadeIn("slow");
              $(".bannerTabs ul li").removeClass("active");
              $(".bannerTabs ul li").eq(0).addClass("active");
              $("#bannerTitle a").text($("div.banner").eq(0).attr("title"));
              $("#bannerTitle a").attr("href", $("div.banner").eq(0).attr("rel"));
            });
          }
        }
      },1000);

      $(".bannerTabs ul li").click(function(){
        $listItem = $('ul.highlighter li').index(this);
        $(".bannerTabs ul li").removeClass("active");
        $(this).addClass("active");
        $("div.banner").fadeOut(600);
        $($(this).attr("rel")).fadeIn(600);
        $bannerTitle = $(this).attr("rel");
        $("#bannerTitle a").text($($bannerTitle).attr("title"));
        $("#bannerTitle a").attr("href", $($bannerTitle).attr("rel"));
        count=0;
        $i=$listItem;
        return false;
     // });
    });
  })(jQuery);