<script type="text/javascript">
//var $ = jQuery.noConflict();
	(function ($) {
	$(function(){
		$("#name").bind("focus click", function(){
		 	if($(this).val()=="First & Last Name")
		 		{
		 			$(this).val('');
		 		}
		 });
		 
		 $("#name").bind("blur", function(){
		 	if(($(this).val()=="First & Last Name") || ($(this).val()==''))
		 		{
		 			$(this).val("First & Last Name");
		 		}
		 });
		 
		 $("#email").bind("focus click", function(){
		 	if($(this).val()=="Your email")
		 		{
		 			$(this).val('');
		 		}
		 });
		 
		 $("#email").bind("blur", function(){
		 	if(($(this).val()=="Your email") || ($(this).val()==''))
		 		{
		 			$(this).val("Your email");
		 		}
		 });
		 
		 
		
	});
	})(jQuery);
</script>
<div class="article">
	<h1 class="padL20 marB10">Speak</h1>
	
	<ul class="tab TLR5 clearfix">
		<li><a title="Speak" class="TLR5 active" href="#">Speak</a></li>
		<li><a title="Share" class="TLR5" href="?q=share">Share</a></li>
		<li><a title="Advertise" class="TLR5" href="?q=advertise">Advertise</a></li>		
	</ul>
	
	<div class="tab_container BLR5 marB10 contact">
	<form method="post" name="speak_frm" id="speak_frm" onsubmit="spk();return false;">
		<div class="tab_content">
			<ul class="contactForm">
				<li class="clearfix">
					<label class="left">Name:</label>
					<div class="inputcol"><input type="text" class="itl" name="name" id="name" value="First &amp; Last Name" /></div>
				</li>
				<li class="clearfix">
					<label class="left">Email ID:</label>
					<div class="inputcol"><input type="text" name="email" id="email" class="itl" value="Your email"/></div>
				</li>
				<li class="clearfix">
					<label class="left">Subject</label>
					<div class="inputcol">
						<div><input type="radio" id="compliments" name="speak_type"  value="Compliments" />
						<label for="compliments">Compliments</label></div>
						<div><input type="radio" id="suggestions" name="speak_type" value="Suggestions"/> 
						<label for="suggestions">Suggestions</label></div>
						<div><input type="radio" id="classifieds" name="speak_type" value="Classifieds"/> 
						<label for="classifieds">Classifieds</label></div>
						<div><input type="radio" id="merchandise" name="speak_type" value="Merchandise" /> 
						<label for="merchandise">Merchandise</label></div>
						<div><input type="radio" id="complaints" name="speak_type" value="Complaints" /> 
						<label for="complaints">Complaints</label></div>
						<div><input type="radio" id="other" name="speak_type" value="Other" /> 
						<label for="other">Other</label>
						<input type="text" class="other" name="speak_otherval" id="speak_otherval" value="" />
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
						<input type="submit" name="Submit" id="showPrefResult" value="Submit">
						<!--  <a id="showPrefResult" class="btnLeft" href="#">
							<span>Send Message</span>
						</a>-->
					</div>
				</li>

			</ul>
				
		</div><!-- tab content -->
		</form>
<div class="hang">Speak</div>
	</div><!-- tab container -->
	
</div>
