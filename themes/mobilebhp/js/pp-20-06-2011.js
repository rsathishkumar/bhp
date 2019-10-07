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

	$(".quicklinks").click(function(){
		if($("#sidebar-second").css("display")=="none"){
			$.cookie("forQuicklinks", "foo", { path: '/' });
			$("#sidebar-second").fadeIn("slow");
			$(this).html("&lt; Close Links");
			$("#page").addClass("pageWithSlide");
			return false;
		}else {
			$.cookie("forQuicklinks", null);
			$.cookie("forScreenWidth", "foo", { path: '/' });
			$("#sidebar-second").fadeOut("slow");
			$(this).html("Quick Links &gt;");
			$("#page").removeClass("pageWithSlide");
			return false;
		}
	});
	
	if(screen.width>=1280 && $.cookie("forScreenWidth")!="foo"){
		$("#sidebar-second").fadeIn("fast");
		$("#header a.quicklinks").html("&lt; Close Links");
		$("#page").addClass("pageWithSlide");
	}
	
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
	window.location = "?q=news&catname="+catname;
}

function shownews_brand()	//for brands dropdown on news details page
	{
		(function ($) {
			var e = document.getElementById("newsBrandList");
			var model = e.options[e.selectedIndex].value;
			window.location = "?q=news&model="+model;
		})(jQuery);
	}

function shownews_tag()	//for brands dropdown on news details page
	{
		(function ($) {
			var e = document.getElementById("newsTagList");
			var tag = e.options[e.selectedIndex].value;
			window.location = "?q=news&tag="+tag;
		})(jQuery);
	}

function shownews_bycat(catname, id)	//for tabs
	{
		(function ($) {	
			$("ul#newslist").html('<div class="loader">&nbsp;</div>');
			$("ul.tab li a").removeClass("active");
			$(id).addClass("active");
			jQuery("select#newsTagList, select#newsBrandList").each(function(){
				var field = jQuery(this);
				field.val( jQuery("option:first", field).val() );
			});
			$.ajax({
			   type: "POST",
			   url: "themes/mobilebhp/show_newsbycat.php",
			   data: "catname="+catname,
			   success: function(data){
				$("div#ajax").html(data);
			   }
			 });
		 })(jQuery);
	}

function shownews_bybrand()	//for brands dropdown
	{
		(function ($) {	
		$("ul#newslist").html('<div class="loader">&nbsp;</div>');
		jQuery("select#newsTagList").each(function(){
			var field = jQuery(this);
			field.val( jQuery("option:first", field).val() );
		});
		var e = document.getElementById("newsBrandList");
		var catname = e.options[e.selectedIndex].value;
		if(catname!=0)
		{
		$.ajax({
		   type: "POST",
		   url: "themes/mobilebhp/show_newsbycat.php",
		   data: "model="+catname,
		   success: function(data){
		    $("div#ajax").html(data);
			$("ul.tab li a").removeClass("active");
			$("ul.tab li a:first").addClass("active");
		   }
		 });
		}
		 })(jQuery);
	}

function shownews_bytag()	//for categories dropdown
	{
		(function ($) {	
		$("ul#newslist").html('<div class="loader">&nbsp;</div>');
		jQuery("select#newsBrandList").each(function(){
			var field = jQuery(this);
			field.val( jQuery("option:first", field).val() );
		});
		var e = document.getElementById("newsTagList");
		var catname = e.options[e.selectedIndex].value;
		if(catname!=0)
		{
		$.ajax({
		   type: "POST",
		   url: "themes/mobilebhp/show_newsbycat.php",
		   data: "tag="+catname,
		   success: function(data){
		    $("div#ajax").html(data);
			$("ul.tab li a").removeClass("active");
			$("ul.tab li a:first").addClass("active");
		   }
		 });
		}
		 })(jQuery);
	}

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
		   url: "themes/mobilebhp/show_newsbycat.php",
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
		   url: "themes/mobilebhp/show_newsbycat.php",
		   data: "tag="+catname,
		   success: function(data){
		    $("div#ajax").html(data);
			$("ul.tab li a").removeClass("active");
			$("ul.tab li a:first").addClass("active");
		   }
		 });})(jQuery);
	}*/

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
			$("ul#newslist").html('<div class="loader">&nbsp;</div>');
			$.ajax({
			   type: "POST",
			   url: "themes/mobilebhp/show_newsbycat.php",
			   data: q,
			   success: function(data){
			    $("ul.tab li a").removeClass("active");
				$("div#ajax").html(data);
				$("ul.tab li").eq(tab).find("a").addClass("active");
			   }
			 });
		})(jQuery);
	}
	
	function nav_advice(id)
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
			$("ul#advicelist").html('<div class="loader">&nbsp;</div>');
			$.ajax({
			   type: "POST",
			   url: "themes/mobilebhp/show_advicebycat.php",
			   data: q,
			   success: function(data){
			    $("ul.tab li a").removeClass("active");
				$("div#ajax").html(data);
				$("ul.tab li").eq(tab).find("a").addClass("active");
			   }
			 });
		})(jQuery);
	}
	function showadvice_bycat(catname,id)	//for tabs
	{
		(function ($) {	
			$("ul#advicelist").html('<div class="loader">&nbsp;</div>');
			$("ul.tab li a").removeClass("active");
			$(id).addClass("active");
			//jQuery("select#newsTagList, select#newsBrandList").each(function(){
			//	var field = jQuery(this);
			//	field.val( jQuery("option:first", field).val() );
			//});
			$.ajax({
			   type: "POST",
			   url: "themes/mobilebhp/show_advicebycat.php",
			   data: "catname="+catname,
			   success: function(data){
			 	$("div#ajax").html(data);
			   }
			 });
		 })(jQuery);
		 	
	}
	function showthread_bycat(catname)	//for brands dropdown
	{
		(function ($) {	
		$("ul#threadlist").html('<div class="loader">&nbsp;</div>');
		$.ajax({
		   type: "POST",
		   url: "themes/mobilebhp/show_threadbycat.php",
		   data: "catname="+catname,
		   success: function(data){
		    $("div#ajax").html(data);
			//$("ul.tab li a").removeClass("active");
			//$("ul.tab li a:first").addClass("active");
		   }
		 });})(jQuery);
	}
	function nav_hotthreads(catname)
	{
	
		(function ($) {
		var q = $(catname).attr("href");
			$("ul#threadlist").html('<div class="loader">&nbsp;</div>');
			$.ajax({
			   type: "POST",
			   url: "themes/mobilebhp/show_threadbycat.php",
			   data: q,
			   success: function(data){
			    $("ul.tab li a").removeClass("active");
				$("div#ajax").html(data);
				//$("ul.tab li").eq(tab).find("a").addClass("active");
			   }
			 });
		})(jQuery);
	}
	
	function show_byalphabet(alphabet)	//for brands dropdown
	{
		(function ($) {	
		//$(".descripptionFlow").html('<div style="text-align:center;"><img src="images/loader.gif"></div>');
		$.ajax({
		   type: "POST",
		   url: "themes/mobilebhp/show_byalphabet.php",
		   data: "alphabet="+alphabet,
		   success: function(data){
		    $("div#ajax").html(data);
			//$("ul.tab li a").removeClass("active");
			//$("ul.tab li a:first").addClass("active");
		   }
		 });})(jQuery);
	}
	function show_by_engine(eid,model_id)	//for brands dropdown
	{
	//alert(eid+ "/ n"+modle_id);
		(function ($) {	
		$("#ajax").html('<div class="loader">&nbsp;</div>');
		$.ajax({
		   type: "POST",
		   url: "themes/mobilebhp/show_by_engine.php",
		   data: "model_id="+model_id+"&eid="+eid,
		   success: function(data){
		    $("div#ajax").html(data);
		   }
		 });})(jQuery);
	}
	
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
			$("ul#tstufflist").html('<div class="loader">&nbsp;</div>');
			$.ajax({
			   type: "POST",
			   url: "themes/mobilebhp/show_tstuff.php",
			   data: q,
			   success: function(data){
			   // $("ul.tab li a").removeClass("active");
				$("div#ajax").html(data);
				//$("ul.tab li").eq(tab).find("a").addClass("active");
			   }
			 });
		})(jQuery);
	}
	
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
			$("ul#safetylist").html('<div class="loader">&nbsp;</div>');
			$.ajax({
			   type: "POST",
			   url: "themes/mobilebhp/show_safety.php",
			   data: q,
			   success: function(data){
			   // $("ul.tab li a").removeClass("active");
				$("div#ajax").html(data);
				//$("ul.tab li").eq(tab).find("a").addClass("active");
			   }
			 });
		})(jQuery);
	}
	
	
	function showmodelbymake(makeid)	//for brands dropdown
	{
		(function ($) {	
		$("div#ajax").html('<div class="loader">&nbsp;</div>');
		$.ajax({
		   type: "POST",
		   url: "themes/mobilebhp/show_modelbymake.php",
		   data: "makeid="+makeid+"&action=show",
		   success: function(data){
		    $("div#ajax").html(data);
		   }
		 });})(jQuery);
	}
