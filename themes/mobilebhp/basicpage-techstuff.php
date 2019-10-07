
<script type="text/javascript">
	var loaders = $('#loaderWrap').html();
/*
				function nav_techstuff(link)

					{
						//if(document.getElementById("newsBrandList").value=='%' && document.getElementById("newsTagList").value=='%')
						$('html, body').animate({scrollTop: $("h1").offset().top-10}, 300);
						var url = "<?php //echo $base_url;?>?q=techstuff-list/callback";
						url += link +'';
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

*/


				$('.paging').on("click",function(){
					nav_techstuff(this.rel);
					//$("ul#newslist").html('<div class="loader">&nbsp;<\/div>');
					$('#ajax').html(loaders);
					//alert(this.attr("rel"));
					
					return(false);
				});
					
				$('.pagination li a').on("click",function(){
						if($(this).hasClass("active"))
						{
							return false;
						}
						else
						{
							nav_techstuff(this.rel);
							//$('#ajax').html('<div class="loader">&nbsp;<\/div>');
							$('#ajax').html(loaders);
							return(false);
						}
				});
			</script>

<h1>Tech Stuff</h1>
<!-- /1063105/mobileleaderboardportal -->
<div id='div-gpt-ad-1497367115460-0' style='height:100px; width:320px;display: block; margin: 15px auto -20px auto'>
    <script>
        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1497367115460-0'); googletag.pubads().refresh(); });
    </script>
</div>
<div class="article">

<!--Temporary load here for ui-->
	<?php //include(drupal_get_path('theme', 'mobilebhp').'/tech-stuff.inc');
	?>

					<div id="ajax">

						<?php
						include("tech-stuff.inc");

						?>
					</div> <!-- End of ajax -->



</div>
<script type="text/javascript">
nav_techstuff('&page=1');
</script>
