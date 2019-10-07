<script type="text/javascript">		    
$(function(){
	$(".listHolder").hover(
	function(){
			$(this).addClass("hover");
		},
	function(){
			$(this).removeClass("hover");
			}
	);
	
	$(".mv_tab_content li .listBox").hover(
	function(){
			$(this).addClass("hover");
		},
	function(){
			$(this).removeClass("hover");
			}
	);
	
	$(function()
		{	
			$(".mv_tab_content li").click(function(){
				 window.location="news-details.php";
			});
		}
	);
});
</script>
<?php
$flink='';
$postofind='';
$postofind = strstr($node_data->field_model_forum_link['und'][0]['url'], "http://");
 if($postofind=='')
 	{
	$flink.="http://".$node_data->field_model_forum_link['und'][0]['url']; 
	}
 	else
 	{
 	$flink.=$node_data->field_model_forum_link['und'][0]['url'];
 	}
 	
?>
<div class="roundAll5 clearfix mostViewed marB10">
	<h4>On The Forum</h4>
	
	<div class="mv_tab_content BLR5 forumMember" style="display:block">	
		<p>View discussions specific to this model, including member opinions, modifications, troubleshooting, tips, advice and more.</p>
		<a href="/search.php?cx=partner-pub-8422315737402856%3Azcmboq-gw8i&cof=FORID%3A9&ie=ISO-8859-1&q=<?php echo urlencode($node_data->title); ?>&sa=" class="discussBtn marT10" target="_blank"><span>Search the forum for this car</span></a>
	</div>	
	
</div><!-- most viewed -->
