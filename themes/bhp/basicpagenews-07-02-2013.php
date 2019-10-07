 <?php
if(isset($_REQUEST['catname']))
{
$cat = $_REQUEST['catname'];
}
else if(!isset($_REQUEST['catname']) and !isset($_REQUEST['model']) and !isset($_REQUEST['tag']) and !isset($_REQUEST['t']))
{
$cat = 'Indian';
}
?>
				<script type="text/javascript">
				function nav_news(link)
					{
						//if(document.getElementById("newsBrandList").value=='%' && document.getElementById("newsTagList").value=='%')
						if($("#newsBrandList").val()=='%' && $("#newsTagList").val()=='%')
							{
							jQuery("select#newsTagList, select#newsBrandList").each(function()
								{
								var field = jQuery(this);
								field.val( jQuery("option:first", field).val() );
								});
							}
						
						$('html, body').animate({scrollTop: $("h1").offset().top-10}, 300);
						var url = Drupal.settings.basePath  +'?q=news-list/callback';
						url += link;
						//jQuery.url.setUrl(url);
						$.ajax( 
						{
						cache: false,
						url: url,
						dataType: 'text',
						error: function(request, status, error) 
						{
							alert(status);
							//$('#container').html(request.responseText);
						},
						success: function(data, status, request) 
						{
							$('#ajax').html(data);
						}
						});
				}
				$('.paging').live("click",function(){
					nav_news(this.rel);
					//$("ul#newslist").html('<div class="loader">&nbsp;<\/div>');
					$('#ajax').html('<div class="loader">&nbsp;<\/div>');
					//alert(this.attr("rel"));
					
					return(false);
				});
					
				$('.pagination li a').live("click",function(){
					if($(this).hasClass("active"))
						{
						return false;
						}
						else
						{
					nav_news(this.rel);
					//$('#ajax').html('<div class="loader">&nbsp;<\/div>');
					$('#ajax').html('<div class="loader">&nbsp;');
						}
					
					return(false);
				});
				
				$('#maincatlist li a').live("click",function(){
					if($(this).hasClass("active"))
					{
						return false;
					}
					else
					{
						$("#maincatlist li a").removeClass("active");
						$(this).addClass("active");
						jQuery("select#newsTagList, select#newsBrandList").each(function()
						{
						var field = jQuery(this);
						field.val( jQuery("option:first", field).val() );
						});
						//alert(this.href);
						nav_news(this.rel);
						//$("ul#newslist").html();
						//$('#ajax').html('<div class="loader">&nbsp;<\/div>');
						$('#ajax').html('<div class="loader">&nbsp;');						
						return false;
					}
				});
				
				 	function shownews_bybrand(modelcat)
					{
					//$('#ajax').html('<div class="loader">&nbsp;<\/div>');
					$('#ajax').html('<div class="loader">&nbsp;');
						jQuery("select#newsTagList").each(function()
						{
							var field = jQuery(this);
							field.val( jQuery("option:first", field).val() );
						});
						$("ul.tab li a").removeClass("active");
						$("ul.tab li a").eq(0).addClass("active");
						$('html, body').animate({scrollTop: $("h1").offset().top-10}, 300);
						var url = Drupal.settings.basePath  +'?q=news-list/callback';
						url += "&model="+modelcat;
						//jQuery.url.setUrl(url);
						$.ajax( 
						{
						cache: false,
						url: url,
						dataType: 'text',
						error: function(request, status, error) 
						{
							alert(status);
							//$('#container').html(request.responseText);
						},
						success: function(data, status, request) 
						{
							
							$('#ajax').html(data);
						}
						});
				 }	
				 function shownews_bytag(tagname)
					{
						//$('#ajax').html('<div class="loader">&nbsp;<\/div>');
						$('#ajax').html('<div class="loader">&nbsp;');
						$("ul.tab li a").removeClass("active");
						$("ul.tab li a").eq(0).addClass("active");
						jQuery("select#newsBrandList").each(function()
							{
							var field = jQuery(this);
							field.val( jQuery("option:first", field).val() );
							});
						$('html, body').animate({scrollTop: $("h1").offset().top-10}, 300);
						var url = Drupal.settings.basePath  +'?q=news-list/callback';
						url += "&tag="+tagname;
						//jQuery.url.setUrl(url);
						$.ajax( 
						{
						cache: false,
						url: url,
						dataType: 'text',
						error: function(request, status, error) 
						{
							alert(status);
							//$('#container').html(request.responseText);
						},
						success: function(data, status, request) 
						{
						   // $("ul#newslist").html("<div class='loader'>&nbsp;<\/div>");
							  $('#ajax').html(data);
						}
						});
				 }	
				 
				
			</script>
<div class="article">
	<h1 class="padL20 marB10">News</h1>
		<ul class="tab TLR5 clearfix" id="maincatlist">
			<li><a title="All" class="TLR5<?php if(($cat=='%') or isset($_REQUEST['model']) or isset($_REQUEST['tag']) or isset($_REQUEST['t'])) { ?> active<?php } ?>" href="#" rel="&page=1&catname=%">All</a></li>
			<li><a title="Indian" class="TLR5<?php if(($cat=='Indian') or (!isset($_REQUEST['catname']) and !isset($_REQUEST['model']) and !isset($_REQUEST['tag']) and !isset($_REQUEST['t']))) { ?> active<?php } ?>" href="#" rel="&page=1&catname=Indian">Indian</a></li>
			<li><a title="International" class="TLR5<?php if($cat=='International') { ?> active<?php } ?>" href="#" rel="&page=1&catname=International">International</a></li>
			<li><a title="Motor Sports" class="TLR5<?php if($cat=='Motor Sports') { ?> active<?php } ?>" href="#"  rel="&page=1&catname=Motor Sports">Motor Sports</a></li>
		</ul>
	<div id="ajax">
	<?php //include("news.inc");?>
	</div><!-- ajax -->
</div>
<?php
$pQ = "&page=1";
if(count($_REQUEST)>1)
{
	while (list($key, $val) = each($_REQUEST)) {
	    if($key!="page" && $key!="q")
	    {
	    	$pQ .= "&".$key."=".$val;
	    }
	    //echo "$key => $val\n";
	}
}
else
{
$pQ .= "&catname=Indian";
}

?>
<script type="text/javascript">
nav_news(link='<?php echo $pQ; ?>');
</script>
