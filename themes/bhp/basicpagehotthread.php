<script type="text/javascript">
$(function(){
	$(".newslist li").live("click",function(e){
		window.open($(this).attr("rel"),"_blank");
		return false;
	});
		$(".newslist li a").live("click",function(e){
		//e.stopPropagation();
	});
});
</script>
						<div class="article">
							<h1>Hot Threads</h1>
							<div id="ajax">
							  <?php
							  include("hotthread.inc");
							  ?>
							</div> <!-- End of ajax -->
						</div>
