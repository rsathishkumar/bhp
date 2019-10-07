<?php
$sql_buckleup=@mysqli_fetch_array(mysqli_query("SELECT node.title,field_data_field_buckle_up_url.field_buckle_up_url_value,file_managed.uri FROM node,field_data_field_buckle_up_image,field_data_field_buckle_up_url,file_managed WHERE field_data_field_buckle_up_image.entity_id = node.nid AND field_data_field_buckle_up_url.entity_id = node.nid AND file_managed.fid = field_data_field_buckle_up_image.field_buckle_up_image_fid AND node.status =1 ORDER BY MD5(RAND()) limit 5"));
?>
<div id="footer" class="clearfix">
	<div class="clearfix">
		<div class="fleft w480">
			<h3>Team-BHP.com</h3>
			<ul class="fleft">
				<li><a href="/advice" title="Advice">Advice</a></li>
				<li><a href="http://classifieds.team-bhp.com/" title="Classifieds">Classifieds</a></li>
				<li><a href="http://www.team-bhp.com/forum/" title="Forum">Forum</a></li>
				<li><a href="/hot-threads" title="Hot Threads">Hot Threads</a></li>
				<!--<li><a href="http://www.team-bhp.com/forum/" title="Directory">Directory</a></li>-->
			</ul>
			<ul class="fleft">
				
				<li><a href="/news" title="News">News</a></li>
				<li><a href="?q=photos" title="Photos">Photos</a></li>
				<li><a href="/reviews" title="Reviews">Reviews</a></li>
			</ul>
	
			<ul class="fleft">
				<li><a href="/safety" title="Road Safety">Road Safety</a></li>
				<li><a href="http://store.team-bhp.com/" title="Store" target="blank">Store</a></li>
				<li><a href="/tech-stuff" title="Tech Stuff">Tech Stuff</a></li>
			</ul>
		</div><!-- 480 -->
		
		<div class="fleft marL40 w160">
			<h3>About Us</h3>
			<ul class="fleft">
				<li><a href="/aboutus/overview" title="Overview">Overview</a></li>
				<li><a href="/aboutus/team" title="The Team">The Team</a></li>
				<li><a href="/aboutus/key-features" title="Key Features">Key Features</a></li>
				<li><a href="/aboutus/philosophy" title="Philosophy">Philosophy</a></li>
				<li><a href="/aboutus/history" title="History">History</a></li>			
			</ul>
		</div>
		<div class="fleft marL40 w100">
			<h3>Contact Us</h3>
			<ul class="fleft">
				<li><a href="/contactus/speak" title="Speak">Speak</a></li>
				<li><a href="/contactus/share" title="Share">Share</a></li>
				<li><a href="/contactus/advertise" title="Advertise">Advertise</a></li>
			</ul>
		</div><!-- w460 -->
		
	</div><!-- clearfix -->	
	<div class="clearfix">&nbsp;</div>
	<div class="clearfix marT40">
		<div class="fleft cRight">Copyright <?php echo date("Y");?> - www.team-bhp.com</div>
		<div class="fright marR40" id="footnote">
			<a href="/sitemap" title="Site Map">Site Map</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
			<a href="/privacy-policy" title="Privacy Policy">Privacy Policy</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
			<a href="/terms-conditions" title="Terms &amp; Conditions">Terms &amp; Conditions</a>
		</div>
	</div>
	<?php
	if($sql_buckleup!='')
	{
	 $restofind=strstr($sql_buckleup['field_buckle_up_url_value'],"http://");
	?>
	<div class="marT50">
		<img src="http://www.team-bhp.com/sites/default/files/<?php echo str_replace("public://","",$sql_buckleup['uri']);?>" width="792" height="57" alt="<?php echo $sql_buckleup['title'];?>" />
	</div>
	<?php
	}
	?>
</div><!-- footer -->
