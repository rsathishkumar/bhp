<!--[if lte IE 6]>
	<link rel="stylesheet" href="css/ie6.css" type="text/css" media="screen" charset="utf-8" />
<![endif]-->	
<script type="text/javascript">		    
	$(function(){
		
		$(".quicklinks").click(function(){
			if($("#sidePage").css("display")=="none"){
				$.cookie("forQuicklinks", "foo", { path: '/' });
				$("#sidePage").fadeIn("slow");
				$(this).html("&lt; Close Links");
				$("#page").addClass("pageWithSlide");
				return false;
			}else {
				$.cookie("forQuicklinks", null);
				$.cookie("forScreenWidth", "foo", { path: '/' });
				$("#sidePage").fadeOut("slow");
				$(this).html("Quick Links &gt;");
				$("#page").removeClass("pageWithSlide");
				return false;
			}
		});
		
		if(screen.width>=1280 && $.cookie("forScreenWidth")!="foo"){
			$("#sidePage").fadeIn("fast");
			$("#header a.quicklinks").html("&lt; Close Links");
			$("#page").addClass("pageWithSlide");
		}
		
		if($.cookie("forQuicklinks")=="foo"){
			$("#sidePage").fadeIn("fast");
			$("#header a.quicklinks").html("&lt; Close Links");
			$("#page").addClass("pageWithSlide");
		}
		
		$(".Email .email").click(function(){
			if ($(this).siblings(".shareForm").css("display")=="none") {
				$(this).closest(".Email").addClass("EmailActive");
				$(this).siblings(".shareForm").fadeIn();
				return false;
			}else{
				$(this).closest(".Email").removeClass("EmailActive");
				$(this).siblings(".shareForm").fadeOut();
				return false;
			}
		});
		
		$(".Email .closeShareForm").click(function(){
			$(this).closest(".Email").removeClass("EmailActive");
			$(this).closest(".shareForm").fadeOut();
			return false;
		});
		
	});
</script>		


	<script type="text/javascript" src="js/jquery.lightbox.js"></script>
	<link rel="stylesheet" href="css/lightbox.css" type="text/css" />
		
	<script type="text/javascript">		    
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
			

			//Most Viewed tab 				
			$(".most_view li").click(function() {
			$(".most_view li a").removeClass("active"); //Remove any "active" class
			$(this).find("a").addClass("active"); //Remove any "active" class
			$(this).addClass("active"); //Add "active" class to selected tab
			$(".mv_tab_content").hide(); //Hide all tab content
	
			var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
				$(activeTab).fadeIn(); //Fade in the active ID content
				return false;
			});
			
			$(".gallery_thumb li").click(function(){
    			$(".gallery_thumb li a").removeClass("active");
    			$(this).find("a").addClass("active");
    			$("img#mainPhoto").attr("src", "/images/news/big/"+$(this).find("a").attr("href"));
    			$(".lightbox").attr("href", "/images/news/large/"+$(this).find("a").attr("href"));
    			return false;
    		});
			
			$(".lightbox").lightbox();
			
		});
	</script>
</head>
	
			
<script type="text/javascript">

	$(function(){
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
	
	});
	
</script>



<script type="text/javascript">

	$(function(){
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
	
	});
	
</script>

<div id="header" class="clearfix">
	<div class="fleft w400">
		<h1 class="marL10 marT10">
			<a href="index.php" title="Go to Home page">
				<img src="/themes/bhp/images/team-bhp-logo.png" alt="TEAM-BHP-LOGO" />	
			</a>
		</h1>
	</div><!-- w400 -->
	
	<div class="fright aln_right w400 clearfix">
		<div class="topLink marT5">
			<a id="setHomePage" href="#" title="Make Team-BHP your Home Page">Make Team-BHP your Home Page</a>&nbsp;&nbsp;|
			<a href="about-us.php" title="About Us">About Us</a>&nbsp;&nbsp;|
			<a href="#" title="Contact Us">Contact Us</a>&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="site-map.php" title="Sitemap">Sitemap</a>
		</div>	<!-- tab Link -->

		<a href="#" class="marT5 quicklinks" >
			Quick Links >
		</a>
		<div class="marT10 clearfix">
			<form id="cse-search-box" class="roundAll5" action="search.php">
			    <input type="hidden" value="partner-pub-8422315737402856:zcmboq-gw8i" name="cx">
			    <input type="hidden" value="FORID:9" name="cof">
			    <input type="hidden" value="ISO-8859-1" name="ie">
			    <input type="text" id="search_input" class="gloablSearch roundAll3" value="Search" name="q">
			    <input type="submit" id="search_button" class="gloablSearchBtn" value="" name="sa">
			</form>
		</div>
	</div><!-- w400-->
</div> <!--  header -->	

