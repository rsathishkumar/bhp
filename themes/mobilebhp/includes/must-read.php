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

<div class="roundAll5 clearfix mostViewed marT10 marB10">
	<h4>Must-Read Articles</h4>
	
	<div class="mv_tab_content" style="display:block">	
			<ul>
				<li class="clearfix">
					<div class="listBox clearfix">
						<div class="fleft w70">
							<a href="#" title="">
								<img src="/themes/mobilebhp/images/temp/car2.jpg" width="70" height="53" alt="" />
							</a>
						</div><!-- fleft w70 -->
					
						<div class="fright w120">
							<div><a href="news-details.php" title="Tata apponts Forster as Global CEO">How to buy a new car in India</a></div>
						</div>
					</div><!-- list box -->
				</li>

				<li class="clearfix">
					<div class="listBox clearfix">
						<div class="fleft w70">
							<a href="#" title="">
								<img src="/themes/mobilebhp/images/temp/car3.jpg" width="70" height="53" alt="" />
							</a>
						</div><!-- fleft w70 -->
						
						<div class="fright w120">
							<div><a href="news-details.php" title="">No claim bonus - Save $$$</a></div>
						</div>
					</div><!-- list box -->
				</li>


				<li class="clearfix">
					<div class="listBox clearfix">
						<div class="fleft w70">
							<a href="#" title="">
								<img src="/themes/mobilebhp/images/temp/car6.jpg" width="70" height="53" alt="" />
							</a>
						</div><!-- fleft w70 -->
						
						<div class="fright w120">
							<div><a href="news-details.php" title="">Getting the lowest EMI</a></div>
						</div>
					</div><!-- list box -->
				</li>
				
				<li class="clearfix">
					<div class="listBox clearfix">
						<div class="fleft w70">
							<a href="#" title="">
								<img src="/themes/mobilebhp/images/temp/car3.jpg" width="70" height="53" alt="" />
							</a>
						</div><!-- fleft w70 -->
						
						<div class="fright w120">
							<div><a href="news-details.php" title="">Extended Warranty - Yes or No?</a></div>
						</div>
					</div><!-- list box -->
				</li>
				
				<li class="clearfix">
					<div class="listBox clearfix">
						<div class="fleft w70">
							<a href="#" title="">
								<img src="/themes/mobilebhp/images/temp/car3.jpg" width="70" height="53" alt="" />
							</a>
						</div><!-- fleft w70 -->
						
						<div class="fright w120">
							<div><a href="news-details.php" title="">Pre-delivery inspection checklist</a></div>
						</div>
					</div><!-- list box -->
				</li>
				
				<li class="clearfix last">
					<div class="listBox clearfix">
						<div class="fleft w70">
							<a href="#" title="">
								<img src="/themes/mobilebhp/images/temp/car6.jpg" width="70" height="53" alt="" />
							</a>
						</div><!-- fleft w70 -->
						
						<div class="fright w120">
							<div><a href="news-details.php" title="">The real cost of car ownership</a></div>
						</div>
					</div><!-- list box -->
				</li>
			</ul>
	</div>					
</div><!-- most viewed -->
