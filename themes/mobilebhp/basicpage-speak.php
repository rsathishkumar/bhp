
<script type="text/javascript" src="<?php print base_path().path_to_theme() ?>/js/formValidation.js"></script>


<script type="text/javascript">
//var $ = jQuery.noConflict();
	(function ($) {
<!--	$(function(){-->
<!--		$("#name").bind("focus click", function(){-->
<!--		 	if($(this).val()=="First & Last Name")-->
<!--		 		{-->
<!--		 			$(this).val('').removeClass("itl");-->
<!--		 		}-->
<!--		 });-->
<!--		 -->
<!--		 $("#name").bind("blur", function(){-->
<!--		 	if(($(this).val()=="First & Last Name") || ($(this).val()==''))-->
<!--		 		{-->
<!--		 			$(this).val("First & Last Name").addClass("itl");-->
<!--		 		}-->
<!--		 });-->
<!--		 -->
<!--		 $("#email").bind("focus click", function(){-->
<!--		 	if($(this).val()=="Your Email")-->
<!--		 		{-->
<!--		 			$(this).val('').removeClass("itl");-->
<!--		 		}-->
<!--		 });-->
<!--		 -->
<!--		 $("#email").bind("blur", function(){-->
<!--		 	if(($(this).val()=="Your Email") || ($(this).val()==''))-->
<!--		 		{-->
<!--		 			$(this).val("Your Email").addClass("itl");-->
<!--		 		}-->
<!--		 });-->
<!---->
<!--		 -->
<!--		-->
<!--	});-->


	})(jQuery);
</script>



<form method="post" name="speak_frm" id="speak_frm" onsubmit="spk();return false;">
    <div class="inputcol form-group">
        <input type="text" placeholder="Full Name" class="form-control itl" name="name" id="name" value="">
        <!--				<input type="text" class="itl" name="name" id="name" value="First &amp; Last Name" />-->
    </div>
    <div class="inputcol form-group">
        <input type="email" placeholder="Email" class="form-control itl" name="email" id="email" value="">
        <!--				<input type="text" name="email" id="email" class="itl" value="Your Email"/>-->
    </div>


    <div class="inputcol form-group">
        <textarea rows="5" placeholder="Message" class="form-control itl" id="message" style="margin-bottom: 0;"></textarea>
    </div>

    <div class="inputcol hidden">
        <div><input type="radio" id="compliments" name="speak_type"  value="Compliments" checked/>
            <label for="compliments">Compliments</label>
        </div>
        <div><input type="radio" id="suggestions" name="speak_type" value="Suggestions"/>
            <label for="suggestions">Suggestions</label>
        </div>
    </div>

    <div class="inputcol">
        <input type="submit" name="Submit" id="showPrefResult" class="btn btn-red ripple" ripple-background="radial-gradient(red,yellow)" ripple-opacity="0.7" value="Send">
    </div>
</form>


		<div id="thanks" class="well" style="display:none">
			Thank You for your feedback to<br>Team-BHP.
		</div>

