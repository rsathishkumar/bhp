<script type="text/javascript">
//var $ = jQuery.noConflict();
	(function ($) {
	$(function(){
		$("#name").bind("focus click", function(){
		 	if($(this).val()=="First & Last Name")
		 		{
		 			$(this).val('').removeClass("itl");
		 		}
		 });
		 
		 $("#name").bind("blur", function(){
		 	if(($(this).val()=="First & Last Name") || ($(this).val()==''))
		 		{
		 			$(this).val("First & Last Name").addClass("itl");
		 		}
		 });
		 
		 $("#email").bind("focus click", function(){
		 	if($(this).val()=="Your Email")
		 		{
		 			$(this).val('').removeClass("itl");
		 		}
		 });
		 
		 $("#email").bind("blur", function(){
		 	if(($(this).val()=="Your Email") || ($(this).val()==''))
		 		{
		 			$(this).val("Your Email").addClass("itl");
		 		}
		 });
		 
		 
		
	});
	})(jQuery);
</script>
<div class="article">
	<h1 class="padL20 marB10">Speak</h1>
	
	<ul class="tab TLR5 clearfix">
		<li><a title="Speak" class="TLR5 active" href="#">Speak</a></li>
		<li><a title="Share" class="TLR5" href="/contactus/share">Share</a></li>
		<li><a title="Advertise" class="TLR5" href="/contactus/advertise">Advertise</a></li>
		<li><a title="Reach" class="TLR5" href="/contactus/reach">Reach</a></li>	
	</ul>
	
	<div class="tab_container BLR5 marB10 contact">
	<div id="maincontent">
	<form method="post" name="speak_frm" id="speak_frm" onsubmit="spk();return false;">
		<div class="tab_content">
			<ul class="contactForm">
				<li class="clearfix">
					<label class="left">Name:</label>
					<div class="inputcol"><input type="text" class="itl" name="name" id="name" value="First &amp; Last Name" /></div>
				</li>
				<li class="clearfix">
					<label class="left">Email ID:</label>
					<div class="inputcol"><input type="text" name="email" id="email" class="itl" value="Your Email"/></div>
				</li>
				
				<li class="clearfix">
					
					<label class="left" >Subject:</label>
					
					<div class="inputcol">
						<div><input type="radio" id="compliments" name="speak_type"  />
						<label for="compliments">Compliments</label></div>
						<div><input type="radio" id="suggestions" name="speak_type" /> 
						<label for="suggestions">Suggestions</label></div>
						<div><input type="radio" id="classifieds" name="speak_type" /> 
						<label for="classifieds">Classifieds</label></div>
						<div><input type="radio" id="merchandise" name="speak_type"  /> 
						<label for="merchandise">Merchandise</label></div>
						<div><input type="radio" id="complaints" name="speak_type"  /> 
						<label for="complaints">Complaints</label></div>
						<div><input type="radio" id="other" name="speak_type"  /> 
						<label for="other">Other</label>
						<input type="text" class="other" name="speak_otherval" id="speak_otherval" />
						</div>
					</div>
				</li>
				<li class="clearfix">
					<label class="left">Message:</label>
					<div class="inputcol"><textarea class="textarea" rows="3" cols="10" id="message"></textarea>
					</div>
				</li>
				<li class="clearfix">
					<label class="left">&nbsp;</label>
					<div class="inputcol">
						<input type="submit" name="Submit" id="showPrefResult" class="submit" value="Submit">
						<!--  <a id="showPrefResult" class="btnLeft" href="#">
							<span>Send Message</span>
						</a>-->
					</div>
				</li>

			</ul>
				
		</div><!-- tab content -->
		</form>
		</div>
		<div id="thanks" style="display:none">
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		Thank You for your feedback to Team-BHP.
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		<br />
		</div>
<div class="hang">Speak</div>
	</div><!-- tab container -->
	
</div>
