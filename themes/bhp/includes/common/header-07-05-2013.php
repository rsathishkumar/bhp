<script type="text/javascript">
(function ($) {
		$(function(){
			$(".listHolder").hover(
			function(){
					$(this).addClass("hover");
				},
			function(){
					$(this).removeClass("hover");
					}
			);
			
			$(".mv_tab_content li").hover(
			function(){
					$(this).addClass("hover");
				},
			function(){
					$(this).removeClass("hover");
					}
			);
			
			$(".carAdded").hover(
			function(){
					$(this).addClass("carAddedhover");
				},
			function(){
					$(this).removeClass("carAddedhover");
					}
			);
			
			$(".carListing li").hover(
			function(){
					$(this).addClass("hover");
				},
			function(){
					$(this).removeClass("hover");
					}
			);
			
			$("ul#newslist li").click(function(){
						 window.location=$(this).find('h2 a').attr('href');
					});
			
		

			$("#compareBtn").click(function() {
				if($(".reviewCompare").css("display")=="none") {
					$(this).removeClass("compareOpen");
					$(this).parent("div").removeClass("marB10");
					$(this).addClass("compareClose");
					$(".reviewCompare").css("display","block");
					//$(".contentOpt:first").css("display","block");
					return false;
				}else {
					$(this).removeClass("compareClose");
					$(this).parent("div").addClass("marB10");
					$(this).addClass("compareOpen");
					$(".reviewCompare").css("display","none");
					/*$(".reviewCompare, .contentOpt, .content").css("display","none");
					$(".reviewCompare li:not(:last)").attr("class", "num");
					$(".reviewCompare li").find(".n").removeAttr("style");
					$(".reviewCompare li:first").attr("class", "clearfix");
					$(".contentOpt select.marB5 option:first").attr('selected', 'selected');
					$(".contentOpt select.w150 option:first").attr('selected', 'selected');*/
					return false;
				}
			});
			
			//show/hide interaction
			$i = 1;
			$('option.flip').click(function(){
				if($(this).closest('.contentOpt').find('select.marB5 option:selected').text()=='Honda')
					{
						$(this).closest('.contentOpt').hide();
						$(this).closest('.clearfix').find('.content').show();
						$(this).closest('.clearfix').next('li.num').find('.n').hide();
						$(this).closest('.clearfix').next('li.num').find('.contentOpt').show();
						$(this).closest('.clearfix').next('li.num').attr('class', 'clearfix');
					}
				if($i>1)
				{
				$('#compare').attr('href', 'compare.php?s='+$i);
				}
				$i++
			});
			
			//add car to compare
			/*$(".add").click(function(){
				$('.reviewCompare').css('display', 'block');
				$('div.content:hidden').eq(0).closest('li').find('.contentOpt').hide();
				$('div.content:hidden').eq(0).closest('li').attr('class', 'clearfix');
				$('div.content:hidden').eq(1).closest('li').find('.n').hide();
				$('div.content:hidden').eq(1).closest('li').find('.contentOpt').show();
				$('div.content:hidden').eq(1).closest('li').attr('class', 'clearfix');
				$('div.content:hidden').eq(0).show();
				$('#compareBtn').removeClass("compareOpen");
				$('#compareBtn').parent("div").removeClass("marB10");
				$('#compareBtn').addClass("compareClose");
				if($i>1)
				{
				$('#compare').attr('href', 'compare.php?s='+$i);
				}
				$i++;
				return false;
			});*/
			
			
	
			/*var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
			$(activeTab).fadeIn(); //Fade in the active ID content
			return false;
			});*/
			
			$("#addCar").click(function(){
				if ($(this).siblings(".addCarForm").css("display")=="none"){
					$(this).parent(".addCarBox").addClass("addCarOpen");
					$(this).siblings(".addCarForm").fadeIn(500);
					return false;
				}else {
					$(this).parent(".addCarBox").removeClass("addCarOpen");
					$(this).siblings(".addCarForm").fadeOut("fast");
					return false;
				}
			});
			
			$("#closeForm").click(function(){
				$(this).parent().parent(".addCarBox").removeClass("addCarOpen");
				$(this).parent(".addCarForm").fadeOut("fast");
				return false;
			});
			
			$("#knowMore").click(function(){
				$("#reviewContent").fadeIn("slow");
				$(".showLess").fadeIn("slow");
				$("#overviewmore").parent().fadeOut("slow");
				$(this).parent().fadeOut("slow");
				$(this).parent().parent().addClass("reviewRollrBorder");
				return false;
			});
			
			$(".showLess").click(function(){
				$("#reviewContent").fadeOut("slow");
				$(this).fadeOut("slow");
				$("#knowMore").parent().fadeIn("slow");
				$("#overviewmore").parent().fadeIn("slow");
				$(this).parent().removeClass("reviewRollrBorder");
				return false;
			});
			
			/*$( "#slider-range" ).slider({
				orientation: "horizontal",
				range: true,
				values: [ 15, 20 ],
				max: 30,
				min: 5,
				slide: function( event, ui ) {
					
					$("#max-amount").text(ui.values[ 1 ]);
					$("#mini-amount").text(ui.values[ 0 ]);
					
					$maxRange = $("#slider-range").find("a").eq(1).attr("style").substr(6);
					$miniRange = $("#slider-range").find("a").eq(0).attr("style").substr(6);
					
					$("#max-amount").attr("style", "left:"+$maxRange);
					$("#mini-amount").attr("style", "left:"+$miniRange);
				},
				
				change: function(event, ui) {
					$maxRange = $("#slider-range").find("a").eq(1).attr("style").substr(6);
					$miniRange = $("#slider-range").find("a").eq(0).attr("style").substr(6);
					
					$("#max-amount").attr("style", "left:"+$maxRange);
					$("#mini-amount").attr("style", "left:"+$miniRange);
				}
				
			});
			
			if($("#slider-range").length>0)
			{
			$maxRange = $("#slider-range").find("a").eq(1).attr("style").substr(6);
			$miniRange = $("#slider-range").find("a").eq(0).attr("style").substr(6);
			}
			
			$("#max-amount").text($("#slider-range" ).slider( "values", 1 ));
			$("#mini-amount").text( $( "#slider-range" ).slider( "values", 0 ));
			
			if($("#slider-range").length>0)
			{
			$("#max-amount").attr("style", "left:"+$maxRange);
			$("#mini-amount").attr("style", "left:"+$miniRange);
			}*/
			
		$("#search_input").bind("focus click", function(){
		 	if($(this).val()=="Search")
		 		{
		 			$(this).val('');
		 		}
		 });
		 
		 $("#search_input").bind("blur", function(){
		 	if(($(this).val()=="Search") || ($(this).val()==''))
		 		{
		 			$(this).val('Search');
		 		}
		 });
		 	
		 	$("#setHomePage").click(function(){
		 		//setHomePage();
			 });
	
	});
})(jQuery);	

</script>

<div id="header" class="clearfix">
	<div class="fleft w400">
		<h1 class="marT10">
			<a href="/" title="Go to Home page">
				<img src="/themes/bhp/images/team-bhp-logo.png" alt="TEAM-BHP-LOGO" class="logoTeam" />	
				<div class="printlogo"><img src="/themes/bhp/images/team-bhp-logo-print.gif" alt="TEAM-BHP-LOGO" />	</div>
			</a>
		</h1>
	</div><!-- w400 -->
	
	<div class="fright aln_right w400 clearfix">
		<div class="topLink marT5">
			<!-- <a id="setHomePage" href="#" title="Make Team-BHP your Home Page">Make Team-BHP your Home Page</a>&nbsp;&nbsp;| -->
			<a href="/aboutus/overview" title="About Us">About Us</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="/contactus/speak" title="Contact Us">Contact Us</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="/sitemap" title="Sitemap">Sitemap</a>
		</div>	<!-- tab Link -->

		<a href="#" class="marT5 quicklinks" >
			&lt; Close Links
		</a>
		<div class="marT10 clearfix">
			<!--  <form id="cse-search-box" class="roundAll5" action="q=node/247">-->
			<form id="cse-search-box" class="roundAll5" action="search.php">
			    <input type="hidden" value="partner-pub-8422315737402856:zcmboq-gw8i" name="cx" />
			    <input type="hidden" value="FORID:9" name="cof" />
			    <input type="hidden" value="ISO-8859-1" name="ie" />
			    <input type="text" id="search_input" class="gloablSearch roundAll3" value="Search" name="q" />
			    <input type="submit" id="search_button" class="gloablSearchBtn" value="" name="sa" />
			</form>
			<!-- <div id="cse" style="width: 100%;">Loading</div>
			<script src="http://www.google.co.in/jsapi" type="text/javascript"></script>
			<script type="text/javascript"> 
			  google.load('search', '1', {language : 'en'});
			  google.setOnLoadCallback(function() {
			    var customSearchOptions = {};
			    var imageSearchOptions = {};
			    imageSearchOptions['layout'] = google.search.ImageSearch.LAYOUT_POPUP;
			    customSearchOptions['enableImageSearch'] = true;
			    customSearchOptions['imageSearchOptions'] = imageSearchOptions;
			    var googleAnalyticsOptions = {};
			    googleAnalyticsOptions['queryParameter'] = '\x3B';
			    googleAnalyticsOptions['categoryParameter'] = '';
			    customSearchOptions['googleAnalyticsOptions'] = googleAnalyticsOptions;
			    customSearchOptions['adoptions'] = {'layout': 'noTop'};
			    var customSearchControl = new google.search.CustomSearchControl(
			      'partner-pub-8422315737402856:zcmboq-gw8i', customSearchOptions);
			    customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
			    var options = new google.search.DrawOptions();
			    options.setAutoComplete(true);
			    customSearchControl.draw('cse', options);
			  }, true);
			</script> -->
		</div>
	</div><!-- w400-->
</div> <!--  header -->	
