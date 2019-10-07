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
