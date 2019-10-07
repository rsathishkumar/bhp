<script type="text/javascript">
				function nav_techstuff(link)
					{
						//if(document.getElementById("newsBrandList").value=='%' && document.getElementById("newsTagList").value=='%')
						$('html, body').animate({scrollTop: $("h1").offset().top-10}, 300);
						var url = Drupal.settings.basePath  +'?q=techstuff-list/callback';
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
					nav_techstuff(this.rel);
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
							nav_techstuff(this.rel);
							//$('#ajax').html('<div class="loader">&nbsp;<\/div>');
							$('#ajax').html('<div class="loader">&nbsp;');
							return(false);
						}
				});
			</script>
<div class="article">
					<h1>Tech Stuff</h1>
					<div class="compareBox active">
							<div class="campareBar">
								<h3>All Tech Stuff Articles</h3>
							</div>
					</div>
					<div id="ajax">
						<?php 	include("tech-stuff.inc"); ?>
					</div> <!-- End of ajax -->
</div>
<script type="text/javascript">
nav_techstuff('&page=1');
</script>
