
				
						<script type="text/javascript">
				function nav_sfty(link)
					{
						//if(document.getElementById("newsBrandList").value=='%' && document.getElementById("newsTagList").value=='%')
						$('html, body').animate({scrollTop: $("h1").offset().top-10}, 300);
						var url = Drupal.settings.basePath  +'?q=safety-list/callback';
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
					nav_sfty(this.rel);
					//$("ul#newslist").html('<div class="loader">&nbsp;<\/div>');
					$('#ajax').html('<div class="loader">&nbsp;<\/div>');
					//alert(this.attr("rel"));
					
					return(false);
				});
					
				$('.pagination li a').live("click",function(){
					//alert(this.href);
					nav_sfty(this.rel);
					//$('#ajax').html('<div class="loader">&nbsp;<\/div>');
					$('#ajax').html('<div class="loader">&nbsp;');
					
					return(false);
				});
			</script>
<div class="article">
				<h1>Road Safety</h1>
			<div class="compareBox active">
				<div class="campareBar">
				<h3>All Road Safety Articles</h3>
				</div>
			</div>
		<div id="ajax">
		</div> <!-- End of ajax -->
</div>
<script type="text/javascript">
nav_sfty('&page=1');
</script>
