<?php global $base_url; ?>		
<!doctype html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Search | Team-BHP</title>
	
	<link rel="stylesheet" href="//www.google.com/cse/style/look/default.css" type="text/css" />


	<link rel="stylesheet" href="themes/mobilebhp/styles/main.css" type="text/css" />	

<!--	<link rel="stylesheet" href="themes/mobilebhp/css/cse-teambhp.css" type="text/css" />-->
	<script src="<?php print $base_url?>/themes/mobilebhp/scripts/vendors.min.js"></script>
   

	<?php //include ("themes/bhp/includes/common/css-js.php") ?>
	<!-- <script type="text/javascript" src="/misc/jquery.js?v=1.4.4"></script> -->








</head>

<body class="mob-search-page">


<style type="text/css">
.mob-search-page {
	    font-family: "open_sansregular", Helvetica, Arial, sans-serif;

}
	form.gsc-search-box,.gsc-refinementsArea {
		background-color: #000;
		padding: 10px;
		margin-bottom: 0;
	}

.gsc-control-cse {
	border: none!important;
}
	table.gsc-search-box > tbody > tr {
		   display: -ms-flexbox;
		    display: -webkit-flex;
		    display: flex;
		    -webkit-flex-direction: column;
		    -ms-flex-direction: column;
		    flex-direction: column;
		    -webkit-flex-wrap: nowrap;
		    -ms-flex-wrap: nowrap;
		    flex-wrap: nowrap;
		    -webkit-justify-content: flex-start;
		    -ms-flex-pack: start;
		    justify-content: flex-start;
		    -webkit-align-content: stretch;
		    -ms-flex-line-pack: stretch;
		    align-content: stretch;
		    -webkit-align-items: center;
		    -ms-flex-align: center;
		    align-items: center;
	}
	.gsib_a,
	.gsc-resultsbox-visible {
		padding: 10px;
	}
	.mob-search-page .gsib_a {
		padding-bottom: 0;
	}
	.gsc-input-box {
		height: auto;
		border: 0;
		background: none;
		position: relative!important;
	}

	.gsc-input-box input[type="text"] {
		color: #fff;
		background-color: transparent!important;
	    border-top: none!important;
	    border-right: none!important;
	    border-left: none!important;
	    border-bottom: 1px solid #616161!important;
	    box-shadow: none;
	    border-radius: 0;
	    /*margin-bottom: 20px!important;*/
	    height: 34px!important;
	    font-family: "open_sansregular", Helvetica, Arial, sans-serif;
	    font-size: 1.1428571429rem;
	    padding-right: 32px!important;

	}
	.gsst_a .gscb_a {
		vertical-align: middle;
		color: #666;
		font-family: "open_sansregular", Helvetica, Arial, sans-serif!important;
		font-size: 1.5rem;

	}
	.gsc-input, .gsc-control-cse,.gsc-thumbnail-inside,.gsc-url-top {
		padding: 0;
	}

	.gsc-input {
		padding: 0!important;
		width: 100%;
	}
	.gsib_b {
		position: absolute;
		right: 5px;
		z-index: 9;
		top: 10px;
	}
	.gsc-tabsArea,
	.gsc-adBlock, 
	.gsc-thumbnail,
	.gs-per-result-labels span,
	.gsc-above-wrapper-area {
		display: none!important;
	}
	.gsc-refinementsArea {
		padding: 0;
		overflow-y: hidden;
		overflow-x: scroll;
	}
	/*.gsc-refinementHeader {
		padding: 0;
		line-height: 25px;
		text-align: center;
		margin-right: 0;
		font-weight: 300;
			}*/

	.gsc-refinementsArea > div {
		height: 30px;
		padding-bottom: 10px;
		max-height: 30px;
		overflow-y: hidden;
		overflow-x: scroll;
		width: 575px;

	}
	.gsc-refinementHeader {
		width: 88px;
		text-align: center;
		padding: 0;
		margin: 0;
	}
	.gsc-refinementHeader > span {
		display: inline-block;
	}
.gsc-refinementHeader.gsc-refinementhActive,
.gs-spelling a {
	color: #d00f15;
	/*border-bottom: 2px solid  #d00f15;*/
}
td.gsc-search-button {
	width: 100%;
	text-align: center;
}
.gsc-search-button {
	width: 100%;
	text-align: center;
	padding: 20px 0;
}
input.gsc-search-button-v2 {
	display: inline-block;
  margin-bottom: 0;
  font-weight: normal;
  text-align: center;
  vertical-align: middle;
  cursor: pointer;
  background-image: none;
  border: 1px solid transparent;
  white-space: nowrap;
    font-size: 14px;
  line-height: 1.428571429;
  border-radius: 4px;
  background-color: #d00f15;
  color: #ffffff !important;
  box-shadow: 0 2px 0 0 #ac0d12;
  border-top-right-radius: 1.4285714286rem;
	border-top-left-radius: 1.4285714286rem;
	border-bottom-right-radius: 1.4285714286rem;
	border-top-right-radius: 1.4285714286rem;
	border-bottom-right-radius: 1.4285714286rem;
	border-bottom-left-radius: 1.4285714286rem;
	border-bottom-left-radius: 1.4285714286rem;
	border-top-left-radius: 1.4285714286rem;
	padding: 0.6428571429rem 1.7857142857rem;
	transition: all ease 0.3s;
	width: auto;
	height: auto;

}

input.gsc-search-button-v2:hover, 
input.gsc-search-button-v2:focus, 
input.gsc-search-button-v2:active, 
input.gsc-search-button-v2:active:hover {
  box-shadow: 0 2px 0 0 #54080a;
  background: #AC0D12;
  color: #ffffff;
  outline: none;
}


	.gsc-results {
		width: 100%;
		
	}

	.gsc-result {
		margin-bottom: 0.8571428571rem!important;
	  display: -moz-flex;
	  display: flex;
	  -moz-flex-direction: column;
	  flex-direction: column;
	  flex-wrap: nowrap;
	  transition: all ease 0.5s;
		border-radius: 0.3571428571rem;
		  box-shadow: 0 0.1428571429rem 0 0 rgba(0, 0, 0, 0.1);
		  background-color: #ffffff!important;
		  color: #000000;
		  text-decoration: none;
		  padding: 1.0714285714rem!important;
	}

	.gs-title {
			font-family: "open_sansregular", Helvetica, Arial, sans-serif;
			  font-size: 1rem;
			  margin-bottom: 1rem;
			  text-decoration: none!important;
			  height: 100%!important;
	}
	.gs-snippet,.gs-visibleUrl {
		font-family: "open_sansregular", Helvetica, Arial, sans-serif;
		  font-size: 0.8571428571rem;
		  color: #333333!important;
		  margin-bottom: 10px!important;
	}
	.gs-per-result-labels .gs-label {
		display: inline;
		background-color: #777;
		font-size: 75%;
		font-weight: bold;
		line-height: 1;
		color: #fff!important;
		text-align: center;
		white-space: nowrap;
		vertical-align: baseline;
		border-radius: 1.4285714286rem;
 		 padding: 0.1428571429rem 1.5714285714rem 0.2857142857rem!important;	
 		 text-decoration: none!important;
 		 pointer-events: none;
	}
	.gsc-completion-container td,.gsc-cursor-page {
		font-family: "open_sansregular", Helvetica, Arial, sans-serif!important;
		  font-size: 0.8571428571rem!important;
	}
	.search-box {
		background-color: #000;
	}
.search-icon,.search-icon:active,.search-icon:focus,.search-icon:hover,.search-icon:active:hover {
	padding: 1.5rem;
	color: #fff;
	text-decoration: none;
}
#gsc-i-id1 {
    background: transparent!important;
    margin-top: 0!important;
}
.gsc-cursor {
	display: inline-block;
}
.gsc-cursor-box {
	text-align: center;
	margin: 20px 10px!important;
}
.gsc-cursor-page {
	padding: 5px 8px;
	margin-right: 0!important;
}
.gsc-cursor-current-page {
	background-color: #fff!important;
	color: #d00f15!important; 
}


.gssb_a table tr td {
	padding: 5px;
	font-family: "open_sansbold", Helvetica ,Arial ,sans-serif!important;

}
.gssb_a table tr td b  {
	font-family: "open_sansregular", Helvetica ,Arial ,sans-serif!important;
	font-weight: normal;
}



		</style>

<?php ?>



<div id="content">
	<div class="search-box clearfix">
	<a href="/" class="pull-right search search-icon"><i class="icon-close"></i></a>

</div>

									<div id="cse-search-results"></div>

									<script>
									  (function() {
										var cx = 'partner-pub-8422315737402856:zcmboq-gw8i';

										var gcse = document.createElement('script');
										gcse.type = 'text/javascript';
										gcse.async = true;
										gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
											'//www.google.com/cse/cse.js?cx=' + cx;
										var s = document.getElementsByTagName('script')[0];
										
										s.parentNode.insertBefore(gcse, s);
									  })();
									</script>




									<gcse:search linktarget="_parent" resultsUrl="https://www.team-bhp.com/searchmobilebhp.php"></gcse:search>
								</div>
					


<script type="text/javascript">
 $(document).ready(function() {



 });

// 	$(".gsc-refinementsArea").find("span.gs-spacer").remove();

// 	var width = 0;
// 	$(".gsc-refinementHeader").each(function() {
// 	    width += $(this).outerWidth( true );
// 	});

// 	alert(width);

// 	$(".gsc-refinementsArea > div").css('width', width);

// });

//alert('hi');
// function tabsSlick() {

// 	$(".gsc-refinementsArea > div").slick({
//     dots: false,
//     infinite: false,
//     arrows: false,
//     speed: 300,
//     slidesToShow: 3,
//     slidesToScroll: 3,
//     responsive: [{
//     breakpoint: 1024,
//       settings: {
//         slidesToShow: 5,
//         slidesToScroll: 5,
//         infinite: false,
//         dots: false
//       }
//     }, {
//     breakpoint: 600,
//       settings: {
//         slidesToShow: 3,
//         slidesToScroll: 3
//       }
//     }, {
//     breakpoint: 480,
//       settings: {
//         slidesToShow: 3,
//         slidesToScroll: 3
//       }
//     }]
//   });
// }



// $(document).bind("DOMSubtreeModified",function(){
// 	//alert('keypress');
// 	tabsSlick();

// })
	
</script>



	 <script src="<?php print $base_url?>/themes/mobilebhp/scripts/scripts.js"></script>	
</body><!-- body -->
</html>
