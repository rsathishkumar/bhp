<script type="text/javascript" src="js/jquery-1.5.1.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/formValidation.js"></script>
<link rel="stylesheet" href="css/main.css" type="text/css" />
<link rel="stylesheet" href="css/lightbox.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/rs.css" />


<!--[if lt IE 9]>
		<script type="text/javascript" src="/js/selectivizr.js"></script>
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

<!--[if lte IE 6]>
	<link rel="stylesheet" href="/css/ie6.css" type="text/css" media="screen" charset="utf-8" />
<![endif]-->
