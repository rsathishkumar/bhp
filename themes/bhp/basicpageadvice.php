<script type="text/javascript">	
(function ($) {
	    
		$(function(){
			

/*         $(".newslist li").click(function(){
				 window.location=$(this).find('h2 a').attr('href');
			});
			//category tab 
			$("ul.tab li").click(function() {
			$("ul.tab li a").removeClass("active"); //Remove any "active" class
			$(this).find("a").addClass("active"); //Remove any "active" class
			$(this).addClass("active"); //Add "active" class to selected tab
			$(".tab_content").hide(); //Hide all tab content
	
			var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
			$(activeTab).fadeIn(); //Fade in the active ID content
			return false;
			});
*/
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

		});
})(jQuery);
	</script>
	
						<script type="text/javascript">
							function nav_advice(link)
							{
								$('html, body').animate({scrollTop: $("h1").offset().top-10}, 300);
								var url = Drupal.settings.basePath  +'?q=advice-list/callback';
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
				
						$('.paging').live("click", function()
						{
							nav_advice(this.rel);
							//$("ul#newslist").html('<div class="loader">&nbsp;<\/div>');
							$('#ajax').html('<div class="loader">&nbsp;<\/div>');
							//alert(this.attr("rel"));
							
							return(false);
						});
					
						$('.pagination li a').live("click", function(){
							if($(this).hasClass("active"))
							{
							return false;
							}
							else
							{
							nav_advice(this.rel);
							$('#ajax').html('<div class="loader">&nbsp;<\/div>');
							}
							return(false);
						});
					
					$('#advicecat li a').live("click", function(){
						if($(this).hasClass("active"))
						{
							return false;
						}
						else
						{
						$("#advicecat li a").removeClass("active");
						$(this).addClass("active");
						var numb = $("#advicecat li a").index(this);
						var urltopass='';
						if(numb==0)
							{
							urltopass = urltopass + this.rel + "&tab=1"
							}
							else
							{
							urltopass = urltopass + this.rel
							}
						nav_advice(urltopass);
						//$("ul#newslist").html("<div class='loader'>&nbsp;<\/div>");
						$('#ajax').html('<div class="loader">&nbsp;<\/div>');
						
						return(false);
						}
					});
				
			</script>
					<div class="article">
							<h1>Advice</h1>
							<ul id="advicecat" class="tab TLR5 clearfix">
								<li><a title="All" class="TLR5 <?php if($_GET['catname']=='All'){?> active<?php } ?>" href="#" rel="&catname=%">All</a></li>
								<li><a title="On Buying" class="TLR5<?php if($_GET['catname']=='' || $_GET['catname']=='On Buying'){?> active<?php } ?>" href="#" rel="&catname=On Buying">On Buying </a></li>
								<li><a title="On Selling" class="TLR5<?php if($_GET['catname']=='On Owning'){?> active<?php } ?>" href="#" rel="&catname=On Owning">On Owning</a></li>
								<li><a title="On Modifying" class="TLR5<?php if($_GET['catname']=='On Modifying'){?> active<?php } ?>" href="#" rel="&catname=On Modifying">On Modifying</a></li>
								<li><a title="Miscellany" class="TLR5<?php if($_GET['catname']=='Miscellany'){?> active<?php } ?>" href="#" rel="&catname=Miscellany">Miscellany</a></li>								
							</ul>
							<div id="ajax">
							<?php
							include("advice.inc");
							?>
							</div> <!-- End of ajax -->
					</div>
