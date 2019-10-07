(function ($) { 
$(function(){
	/*$('ul.tab li').click(function(){
		$("ul#newslist").html('<div style="text-align:center;"><img src="images/loader.gif"></div>');
		$("ul.tab li a").removeClass("active");
		$(this).find('a').addClass("active");
		jQuery("select#newsTagList, select#newsBrandList").each(function(){
			var field = jQuery(this);
			field.val( jQuery("option:first", field).val() );
		});
		return false;
	});*/
	/*$(function(){
	$('#advicecat.tab li').click(function(){
		$("ul#advicelist").html('<div style="text-align:center;"><img src="images/loader.gif"></div>');
		$("ul.tab li a").removeClass("active");
		$(this).find('a').addClass("active");
		//jQuery("select#newsTagList, select#newsBrandList").each(function(){
		//	var field = jQuery(this);
		//	field.val( jQuery("option:first", field).val() );
		});
		return false;
	});*/
	/*if(screen.width>=1280 && $.cookie("forScreenWidth")!="foo"){
		$("#sidebar-second").fadeIn("fast");
		$("#header a.quicklinks").html("&lt; Close Links");
		$("#page").addClass("pageWithSlide");
	}*/
	if(screen.width<1280 && $.cookie("forScreenWidth")!="foo"){
		$("#sidebar-second").fadeOut("fast");
		$("#header a.quicklinks").html("Quick Links &gt;");
		$("#page").removeClass("pageWithSlide");
	}

	$(".quicklinks").click(function(){
		if($("#sidebar-second").css("display")=="none"){
			$.cookie("forQuicklinks", "foo", { path: '/' });
			$("#sidebar-second").fadeIn("slow");
			$(this).html("&lt; Close Links");
			$("#page").addClass("pageWithSlide");
			setCookie("showsidebar",0,365);
			return false;
		}else {
			$.cookie("forQuicklinks", null);
			$.cookie("forScreenWidth", "foo", { path: '/' });
			$("#sidebar-second").fadeOut("slow");
			$(this).html("Quick Links &gt;");
			$("#page").removeClass("pageWithSlide");
			setCookie("showsidebar",1,365);
			return false;
		}
	});
	
	if($.cookie("forQuicklinks")=="foo"){
		$("#sidebar-second").fadeIn("fast");
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
})(jQuery);

function shownews_cat(catname)
{
	window.location = "/news?catname="+catname;
}
/*************************************************************************************************************************************/
function shownews_brand()	//for brands dropdown on news details page
	{
		(function ($) {
			var e = document.getElementById("newsBrandList");
			var model = e.options[e.selectedIndex].value;
			window.location = "/?q=news&model="+model;
		})(jQuery);
	}
/*************************************************************************************************************************************/
function shownews_tag()	//for brands dropdown on news details page
	{
		(function ($) {
			var e = document.getElementById("newsTagList");
			var tag = e.options[e.selectedIndex].value;
			window.location = "/?q=news&tag="+tag;
		})(jQuery);
	}
/*************************************************************************************************************************************/
function shownews_bycat11111(catname, id)	//for tabs
	{
		(function ($) {	
			$("ul.tab li a").removeClass("active");
			$(id).addClass("active");
			jQuery("select#newsTagList, select#newsBrandList").each(function(){
				var field = jQuery(this);
				field.val( jQuery("option:first", field).val() );
			});
		    $('html, body').animate({scrollTop: $("h1").offset().top-10}, 300, function(){
				$("ul#newslist").html('<div class="loader">&nbsp;</div>');
				$.ajax({
				   type: "POST",
				   url: "/themes/mobilebhp/show_newsbycat.php",
				   data: "catname="+catname,
				   success: function(data){
					$("div#ajax").html(data);
				   }
				 });
		    });
		 })(jQuery);
	}
/*************************************************************************************************************************************/
function shownews_bybrand1111()	//for brands dropdown
	{
		(function ($) {	
		
		jQuery("select#newsTagList").each(function(){
			var field = jQuery(this);
			field.val( jQuery("option:first", field).val() );
		});
		var e = document.getElementById("newsBrandList");
		var catname = e.options[e.selectedIndex].value;
		if(catname!='0')
		{
		$('html, body').animate({scrollTop: $("h1").offset().top-10}, 300, function(){
			$("ul#newslist").html('<div class="loader">&nbsp;</div>');
			$.ajax({
			   type: "POST",
			   url: "/themes/mobilebhp/show_newsbycat.php",
			   data: "model="+catname,
			   success: function(data){
			    $("div#ajax").html(data);
				$("ul.tab li a").removeClass("active");
				$("ul.tab li a:first").addClass("active");
			   }
			 });
		});
		}
		 })(jQuery);
	}
	
/*************************************************************************************************************************************/
function showmodelbycityprice(city)	//for brands dropdown
	{
		$("#ajax").html('<div class="loader">&nbsp;</div>');
		$.ajax({
		   type: "POST",
		   url: "/themes/mobilebhp/showmodelbycityprice.php",
		   cache: false,
		   data: "city="+city+"&action=show",
		   success: function(data)
		   		{
		    $("div#ajax").html(data);
				}
		 });
			
	}
/*************************************************************************************************************************************/
function shownews_bytag11111()	//for categories dropdown
	{
		(function ($) {	
		
		jQuery("select#newsBrandList").each(function(){
			var field = jQuery(this);
			field.val( jQuery("option:first", field).val() );
		});
		var e = document.getElementById("newsTagList");
		var catname = e.options[e.selectedIndex].value;
		if(catname!=0)
		{
		$('html, body').animate({scrollTop: $("h1").offset().top-10}, 300, function(){
			$("ul#newslist").html('<div class="loader">&nbsp;</div>');
			$.ajax({
			   type: "POST",
			   url: "/themes/mobilebhp/show_newsbycat.php",
			   data: "tag="+catname,
			   success: function(data){
			    $("div#ajax").html(data);
				$("ul.tab li a").removeClass("active");
				$("ul.tab li a:first").addClass("active");
			   }
			 });
		});
		}
		 })(jQuery);
	}
/*************************************************************************************************************************************/
/*function shownews_bybrand(catname)	//for brands dropdown
	{
		(function ($) {	
		$("ul#newslist").html('<div style="text-align:center;"><img src="images/loader.gif"></div>');
		jQuery("select#newsTagList").each(function(){
			var field = jQuery(this);
			field.val( jQuery("option:first", field).val() );
		});
		$.ajax({
		   type: "POST",
		   url: "/themes/mobilebhp/show_newsbycat.php",
		   data: "model="+catname,
		   success: function(data){
		    $("div#ajax").html(data);
			$("ul.tab li a").removeClass("active");
			$("ul.tab li a:first").addClass("active");
		   }
		 });})(jQuery);
	}

function shownews_bytag(catname)	//for categories dropdown
	{
		(function ($) {	
		$("ul#newslist").html('<div style="text-align:center;"><img src="images/loader.gif"></div>');
		jQuery("select#newsBrandList").each(function(){
			var field = jQuery(this);
			field.val( jQuery("option:first", field).val() );
		});
		$.ajax({
		   type: "POST",
		   url: "/themes/mobilebhp/show_newsbycat.php",
		   data: "tag="+catname,
		   success: function(data){
		    $("div#ajax").html(data);
			$("ul.tab li a").removeClass("active");
			$("ul.tab li a:first").addClass("active");
		   }
		 });})(jQuery);
	}*/
/*************************************************************************************************************************************/
function nav(id)
	{
		(function ($) {
			var q = $(id).attr("href");
			var tab = 0;
			if(q.indexOf('Indian')>=0)
			{
				tab = 1;
			}
			else if(q.indexOf('International')>=0)
			{
				tab = 2;
			}
			else if(q.indexOf('Motor Sports')>=0)
			{
				tab = 3;
			}
			$('html, body').animate({scrollTop: $("h1").offset().top-10}, 300, function(){
				$("ul#newslist").html('<div class="loader">&nbsp;</div>');
				$.ajax({
				   type: "POST",
				   url: "/themes/mobilebhp/show_newsbycat.php",
				   data: q,
				   success: function(data){
				    $("ul.tab li a").removeClass("active");
					$("div#ajax").html(data);
					$("ul.tab li").eq(tab).find("a").addClass("active");
				   }
				 });
			});
		})(jQuery);
	}
/*************************************************************************************************************************************/	
	function nav_advice11111(id)
	{
			(function ($) {
			var q = $(id).attr("href");
			var tab = 0;
			if(q.indexOf('On Buying')>=0)
			{
				tab = 1;
			}
			else if(q.indexOf('On Owning')>=0)
			{
				tab = 2;
			}
			else if(q.indexOf('On Modifying')>=0)
			{
				tab = 3;
			}
			else if(q.indexOf('Miscellany')>=0)
			{
				tab = 3;
			}
			
		    $('html, body').animate({scrollTop: $("h1").offset().top-10}, 300, function(){
		    	$("ul#advicelist").html('<div class="loader">&nbsp;</div>');
				$.ajax({
				   type: "POST",
				   url: "/themes/mobilebhp/show_advicebycat.php",
				   data: q,
				   success: function(data){
				    $("ul.tab li a").removeClass("active");
					$("div#ajax").html(data);
					$("ul.tab li").eq(tab).find("a").addClass("active");
				   }
				 });
		    });
		})(jQuery);
	}
/*************************************************************************************************************************************/
	function showadvice_bycat(catname,id)	//for tabs
	{
		(function ($) {
			
			$("ul.tab li a").removeClass("active");
			$(id).addClass("active");
			//jQuery("select#newsTagList, select#newsBrandList").each(function(){
			//	var field = jQuery(this);
			//	field.val( jQuery("option:first", field).val() );
			//});
		    $('html, body').animate({scrollTop: $("h1").offset().top-10}, 300, function(){
		    	$("ul#advicelist").html('<div class="loader">&nbsp;</div>');
		    	$.ajax({
				   type: "POST",
				   url: "/themes/mobilebhp/show_advicebycat.php",
				   data: "catname="+catname,
				   success: function(data){
				 	$("div#ajax").html(data);
				   }
				 });
		    });
			
		 })(jQuery);
		 	
	}
/*************************************************************************************************************************************/
	function showthread_bycat111(catname)	//for brands dropdown
	{
		(function ($) {	
		
		$('html, body').animate({scrollTop: $("h1").offset().top-10}, 300, function(){
			$("ul#threadlist").html('<div class="loader">&nbsp;</div>');
			$.ajax({
			   type: "POST",
			   url: "/themes/mobilebhp/show_threadbycat.php",
			   data: "catname="+catname,
			   success: function(data){
			    $("div#ajax").html(data);
				//$("ul.tab li a").removeClass("active");
				//$("ul.tab li a:first").addClass("active");
			   }
			 });
		});
		})(jQuery);
	}
/*************************************************************************************************************************************/
	function nav_hotthreads111(catname)
	{
		(function ($) {
		var q = $(catname).attr("href");
			
			$('html, body').animate({scrollTop: $("h1").offset().top-10}, 300, function(){
				$("ul#threadlist").html('<div class="loader">&nbsp;</div>');
				$.ajax({
				   type: "POST",
				   url: "/themes/mobilebhp/show_threadbycat.php",
				   data: q,
				   success: function(data){
				    $("ul.tab li a").removeClass("active");
					$("div#ajax").html(data);
					//$("ul.tab li").eq(tab).find("a").addClass("active");
				   }
				 });
			});
			
		})(jQuery);
	}
	
/*************************************************************************************************************************************/
	function show_byalphabet(alphabet)	//for brands dropdown
	{
		(function ($) {	
		//$("#dictionarylist").find("a").("span").remove();
		/* alert($("#dictionarylist").find("a").attr("rel")+"\n "+ $(this).find("<span>").remove());
		 $(this).find("span>").remove();*/
		$("div#ajax").html('<div style="text-align:center;"><img src="/themes/mobilebhp/images/loader.gif"></div>');
		$.ajax({
		   type: "POST",
		   url: "/themes/mobilebhp/show_byalphabet.php",
		   data: "alphabet="+alphabet,
		   success: function(data){
		   if(data.length!=39)
		   		{
		    $("div#ajax").html(data);
		    	}
		    	else
		    	{
		   $("div#ajax").html('<div style="text-align:center;">'+data+'</div>');	
		    	}
			//$("ul.tab li a").removeClass("active");
			//$("ul.tab li a:first").addClass("active");
		   }
		 });})(jQuery);
	}
/*************************************************************************************************************************************/
	function show_by_engine(eid)	//for brands dropdown
	{
	//alert(eid+ "/ n"+modle_id);
		(function ($) {	
		$("#ajax").html('<div class="loader">&nbsp;</div>');
		$.ajax({
		   type: "POST",
		   url: "/themes/mobilebhp/show_by_engine.php",
		  // data: "model_id="+model_id+"&eid="+eid,
		   data: "eid="+eid,
		   success: function(data){
		    $("div#ajax").html(data);
		    	
		   }
		 });})(jQuery);
	}
/*************************************************************************************************************************************/	
	function nav_tstuff(id)
	{
			(function ($) {
			var q = $(id).attr("href");
			var tab = 0;
			if(q.indexOf('On Buying')>=0)
			{
				tab = 1;
			}
			else if(q.indexOf('On Owning')>=0)
			{
				tab = 2;
			}
			else if(q.indexOf('On Modifying')>=0)
			{
				tab = 3;
			}
			else if(q.indexOf('Miscellany')>=0)
			{
				tab = 3;
			}
			
			$('html, body').animate({scrollTop: $("h1").offset().top-10}, 300, function(){
				$("ul#tstufflist").html('<div class="loader">&nbsp;</div>');
				$.ajax({
				   type: "POST",
				   url: "/themes/mobilebhp/show_tstuff.php",
				   data: q,
				   success: function(data){
				   // $("ul.tab li a").removeClass("active");
					$("div#ajax").html(data);
					//$("ul.tab li").eq(tab).find("a").addClass("active");
				   }
				 });
			});
		})(jQuery);
	}
/*************************************************************************************************************************************/	
	function nav_safety(id)
	{
			(function ($) {
			var q = $(id).attr("href");
			var tab = 0;
			if(q.indexOf('On Buying')>=0)
			{
				tab = 1;
			}
			else if(q.indexOf('On Owning')>=0)
			{
				tab = 2;
			}
			else if(q.indexOf('On Modifying')>=0)
			{
				tab = 3;
			}
			else if(q.indexOf('Miscellany')>=0)
			{
				tab = 3;
			}
			$('html, body').animate({scrollTop: $("h1").offset().top-10}, 300, function(){
				$("ul#safetylist").html('<div class="loader">&nbsp;</div>');
				$.ajax({
				   type: "POST",
				   url: "/themes/mobilebhp/show_safety.php",
				   data: q,
				   success: function(data){
				   // $("ul.tab li a").removeClass("active");
					$("div#ajax").html(data);
					//$("ul.tab li").eq(tab).find("a").addClass("active");
				   }
				 });
			});
		})(jQuery);
	}
	
/*************************************************************************************************************************************/	
	function showmodelbymake(makeid)	//for brands dropdown
	{
		
				(function ($) {	
				$("div#ajax").html('<div class="loader">&nbsp;</div>');
				$.ajax({
				   type: "POST",
				   url: "/themes/mobilebhp/show_modelbymake.php",
				   cache: false,
				   data: "makeid="+makeid+"&action=show",
				   success: function(data){
				    $("div#ajax").html(data);
				   }
				 });})(jQuery);
		 
		 /*else
		 	{
				(function ($) {	
				$("div#ajax").html('<div class="loader">&nbsp;</div>');
				$.ajax({
				   type: "POST",
				   url: "/themes/mobilebhp/show_modelbymake.php",
				   success: function(data){
				    $("div#ajax").html(data);
				   }
				 });})(jQuery);
		 	}*/
	}
	
/*************************************************************************************************************************************/	
	function show_priceby_city(city,engineid)	//for brands dropdown
	{
	
		(function ($) {	
			$("div#ajax").html('<div class="loader">&nbsp;</div>');
			$.ajax({
			   type: "POST",
			   url: "/themes/mobilebhp/show_pricebycity.php",
			   cache: false,
			   data: "city="+city+"&engineid="+engineid+"&action=show",
			   success: function(data){
				$("#ajax").html(data);
			   }
			 });
		
		//alert($(".emiCalcHolder").height());
			 
		})(jQuery);
	}
	
/*************************************************************************************************************************************/	
	function show_priceby_engine(engineid)	//for brands dropdown
	{
	(function ($) {	
		$("div#ajax").html('<div class="loader">&nbsp;</div>');
		$.ajax({
		   type: "POST",
		   url: "/themes/mobilebhp/show_priceby_engine.php",
		   cache: false,
		   data: "&engineid="+engineid+"&action=show",
		   success: function(data){
		   document.getElementById("cityname").value='Delhi';
		    $("#ajax").html(data);
		   }
		 });})(jQuery);
	}
	
/*************************************************************************************************************************************/	
	function unsubscribed(email)	//for brands dropdown
	{
	(function ($) {	
		$("div#ajax").html('<div class="loader">&nbsp;</div>');
		$.ajax({
		   type: "POST",
		   url: "/themes/mobilebhp/unsubscribed.php",
		   cache: false,
		   data: "&email="+email+"&action=show",
		   success: function(data){
		   if(data.length!=32)
					{
					document.getElementById("subdiv").style.display='block';
					document.getElementById("uns").style.display='none';
					document.getElementById("unsubbtn").style.display='none';
										var count=0;
									    var myInt = setInterval(function(){
										count++;
										 if(count==5){
												window.location.href='/';
												return false;
											}
										 },1000);
										  
					}
					else
					{
					document.getElementById("subdiv").style.display='none';
					document.getElementById("uns").style.display='none';
					document.getElementById("unsubbtn").style.display='none';
					document.getElementById("unserror").style.display='block';
					document.getElementById("unserror").innerHTML='<p class="titleHead">'+"This email address is not present in our subscription list"+'</p>';
					}
		   }
		 });})(jQuery);
	}
	
/*************************************************************************************************************************************/

function isBlank(val)
{
	if (val=="" || val==" ")
	{
		return true;
	}
	return false;
	
}//End of isBlank()

function showEMIerror(msg, id)
{
	(function ($) {
		if($("#"+id).closest("dd").hasClass("error"))
			{
				$("#"+id).closest("dd").find(".error").text(msg);
			}
		else
			{
				$("#"+id).closest("dd").append("<span class='error'>"+msg+"</span>");
				$("#"+id).closest("dd").addClass("error");
			}
	})(jQuery);
}

function changeEMIerror(id)
{
	(function ($) {
		$("#"+id).closest("dd").find(".error").remove();
		$("#"+id).closest("dd").removeClass("error");
	})(jQuery);
}

function calculate_emiamount()
{
	var isError = 0;
	var downpayment=document.getElementById("downpayment").value;
	if(isBlank(downpayment))
	{
		showEMIerror(" Downpayment required", "downpayment");
		isError = 1;
	}
	else if(isNaN(downpayment))
	{
		showEMIerror(" Only numbers allowed", "downpayment");
		isError = 1;
	}
	else
	{
		changeEMIerror("downpayment");
	}
		parseInt(downpayment);
	if(downpayment>0)
	{
	var duration=document.getElementById("duration").value-1;
	}
	else
	{
	var duration=document.getElementById("duration").value;
	}
	var i_rate=document.getElementById("i_rate").value;
	if(isBlank(i_rate))
	{
		showEMIerror(" Interest rate required", "i_rate");
		isError = 1;
	}
	else if(isNaN(i_rate))
	{
		showEMIerror(" Only numbers allowed", "i_rate");
		isError = 1;
	}
	else
	{
		changeEMIerror("i_rate");
	}
	if(isError==0)
	{
		var I = (i_rate/12)/100;
		var one = Math.pow((1+I), duration);
		(function ($) {
			$(".actual").each(function(index){
				var remain = $(this).val()-downpayment;
				var listItem = $(".actual").index(this);
				var EMI = (remain*I)*(one / (one-1));
				$("#amountcalculated"+listItem).html('<span class="WebRupee">Rs.</span> '+addCommas(Math.round(EMI)));
			});
		})(jQuery);
	}
	else
	{
		return false;
	}
}
		
/*************************************************************************************************************************************/
		function addCommas(nStr)
		{
		  nStr += '';
		  x = nStr.split('.');
		  x1 = x[0];
		  x2 = x.length > 1 ? '.' + x[1] : '';
		  var rgx = /(\d+)(\d{3})/;
		  while (rgx.test(x1)) {
		    x1 = x1.replace(rgx, '$1' + ',' + '$2');
		  }
		  return x1 + x2;
		}
		
/*************************************************************************************************************************************/		
	function updatethreadcounter(siteurl,nid)	//for brands dropdown
	{
	(function ($) {	
		$.ajax({
		   type: "POST",
		   url: "/themes/mobilebhp/updatethreadcounter.php",
		   cache: false,
		   data: "siteurl="+siteurl+"&action=show"+"&nid="+nid,
		   success: function(data){
		     //window.open(siteurl, '_blank');
		     if(data==1)
		     	{
		      return true;
		     	}
		     	else
		     	{
		     	return false;
		     	}
		    }
		 });
		  
		 })(jQuery);
		 //return false;
	}

/*************************************************************************************************************************************/

function setCookie(c_name,value,exdays)
				{
				var exdate=new Date();
				exdate.setDate(exdate.getDate() + exdays);
				var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
				document.cookie=c_name + "=" + c_value;
				}
			
/*************************************************************************************************************************************/
