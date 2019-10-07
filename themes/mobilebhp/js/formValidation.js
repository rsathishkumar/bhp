function isValidURL(url){
    var RegExp = /^(([\w]+:)?\/\/)?(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w][-\d\w]{0,253}[\d\w]\.)+[\w]{2,4}(:[\d]+)?(\/([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&?([-+_~.\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)?$/;
    if(RegExp.test(url)){
        return true;
    }else{
        return false;
    }
} 

function isValidEmail(value){
	var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	if(filter.test(trim(value))) {
		return true;
	}	
	else {
		return false; 
	}
}

function isPhone(value){
  var iChars = "0123456789+-#/() ";
  for (var i = 0; i < value.length; i++) {
	if (iChars.indexOf(value.charAt(i)) == -1) 
	{
		return false;
	}
  }	
  return true;
}

function trim(str)
{ 
	return((""+str).replace(/^\s*([\s\S]*\S+)\s*$|^\s*$/,'$1') ); 
}

function changeError(id)
	{
		$("#"+id).closest("dl").removeClass("has-error");
		$("#"+id).removeClass("has-error");
		$("#"+id).closest("dd").find("div.help-block").remove();
	}

function showError(msg, id){
	if($("#"+id).closest("dl").hasClass("has-error"))
		{
			$("#"+id).closest("dd").find("div.help-block").html(msg);
		}
	else
		{
			$("#"+id).closest("dl").addClass("has-error");
			$("#"+id).closest("dd").append("<div class='help-block'></div>");
			$("#"+id).closest("dd").find("div.help-block").html(msg);
		}
		
}

function changeErrorInput(id)
	{
		(function ($) { 
		$("#"+id).closest("div").removeClass("has-error");
		$("#"+id).removeClass("has-error");
		$("#"+id).closest("div").find("div.help-block").remove();
		})(jQuery)
	}

function showErrorInput(msg, id){
(function ($) {
	if($("#"+id).parent("div").hasClass("has-error"))
		{
			$("#"+id).parent("div").find("div.help-block").html(msg);
		}
	else
		{
			$("#"+id).parent("div").addClass("has-error");
			$("#"+id).parent("div").append("<div class='help-block'></div>");
			$("#"+id).parent("div").find("div.help-block").html(msg);
		}
})(jQuery);	
}


function validate_shareForm() 
	{
	
var isvalid=true;
var toShareForm=document.getElementById('toShareForm').value;
var fromShareForm=document.getElementById('fromShareForm').value;
var sharelink=document.getElementById('current_url').value;
var arraytoShareForm='';

//var multipleemail=toShareForm.replace(/microsoft/i, "W3Schools");

var lastPos = toShareForm.length-1;
//alert( toShareForm.charAt(lastPos) +"  "+ toShareForm.charCodeAt(lastPos) );

	if(toShareForm.charAt(lastPos)==';')
	{
	
	toShareForm=toShareForm.substring(0, toShareForm.length-1);
	//showErrorInput("Please remove comma from last or you must enter another email", "toShareForm");
	//isvalid=false;
	//return false;
	}
	 if((toShareForm.charAt(lastPos)!=';') && (toShareForm!="Receipient's email"))
		{
		var arraytoShareForm=toShareForm.split(";");
		}
		if(arraytoShareForm!='')
			{
			for(var i=0;i<arraytoShareForm.length;i++)
			{
		
			//alert("<b>arraytoShareForm["+i+"] is </b>=>"+arraytoShareForm[i]+"<br>");
					if(arraytoShareForm[i]==false || arraytoShareForm[i]=="Receipient's email")
				{
					showErrorInput("Please enter email address", "toShareForm");
					isvalid=false;
				}
			else if(isValidEmail(arraytoShareForm[i]))
					{
							if(arraytoShareForm.length<=10)
								{
							changeErrorInput("toShareForm");
								}
								else
								{
							showErrorInput("You can only send this link to 10 friends at a time", "toShareForm");
							isvalid=false;	
								}
					}
				else
					{
					showErrorInput("You have entered an invalid email", "toShareForm");
					isvalid=false;
					}
				}
					
			}
			else
			{
			
				if(toShareForm==false || toShareForm=="Receipient's email")
				{
					showErrorInput("Please enter email address", "toShareForm");
					isvalid=false;
				}
			else if(isValidEmail(toShareForm))
				{
						changeErrorInput("toShareForm");
				}
			else{
				showErrorInput("You have entered an invalid email", "toShareForm");
				isvalid=false;
				}
			}

	if(fromShareForm==false || fromShareForm=="Your email"){
		showErrorInput("Please enter your email address", "fromShareForm");
		isvalid=false;
	}else if(isValidEmail(fromShareForm)){
		changeErrorInput("fromShareForm");
	}else{
		showErrorInput("You have entered an invalid email", "fromShareForm");
		isvalid=false;
	}
	
	if(isvalid==false)
		{
			return false;
		}
	else
		{
			 (function ($) {	$.ajax(
			 	{
						  type: "POST",
						  url: '/themes/mobilebhp/ajax/sharebymail.php',
						  data: "toShareForm="+toShareForm+"&action=show"+"&fromShareForm="+fromShareForm+"&sharelink="+sharelink,
						  cache: false,
						  success: function(data)
						  	{
						document.getElementById('toShareForm').value='';
						$("#shareForm").css("display","none");
						$("#successMsg").css("display","block");
						return true;  	
						 	}
				}
						  	)})(jQuery);
						
							return true;
			
		}		
	}

function validate_newsletter(session_id) {
var isvalid=true;
var newsletterEmail=document.getElementById('newsletterEmail').value;
		
	if(newsletterEmail==false || newsletterEmail=="Your Email ID"){
	//alert("Please enter email");
		showErrorInput("Please enter your email address", "newsletterEmail");
		isvalid=false;
		return false;
	}else if(isValidEmail(newsletterEmail)){
		changeErrorInput("newsletterEmail");
	}else{
		//alert("Please enter valid email");
		showErrorInput("You have entered an invalid email", "newsletterEmail");
		isvalid=false;
		return false;
	}
	
	if(isvalid==false)
		{
			return false;
		}
	else
		{
						 (function ($) {	$.ajax({
						  type: "POST",
						  url: '/themes/mobilebhp/ajax/subscribefronewsletter.php',
						  data: "email="+newsletterEmail+"&action=submit&session_id="+session_id,
						  cache: false,
						  success: function(data) {
						  //alert('Load was performed.');
						  if(data!="Email already exist")
							{
					(function ($) { $("#newsletter").css("display","none")})(jQuery);
					(function ($) { $("#newsletterSuccessMsg").css("display","block")})(jQuery);
			
							}
							else
							{
						showErrorInput(data, "newsletterEmail");
						return true;			
							}
						  }
						})})(jQuery);
						
							return true;
		}	
}
	
	function validate_newsletterunsub() {
var isvalid=true;
var newsletterEmail=document.getElementById('newsletterEmail').value;
		
	if(newsletterEmail==false || newsletterEmail=="Your Email ID"){
	//alert("Please enter email");
		showErrorInput("Please enter your email address", "newsletterEmail");
		isvalid=false;
		return false;
	}else if(isValidEmail(newsletterEmail)){
		changeErrorInput("newsletterEmail");
	}else{
		//alert("Please enter valid email");
		showErrorInput("You have entered an invalid email", "newsletterEmail");
		isvalid=false;
		return false;
	}
	
	if(isvalid==false)
		{
			return false;
		}
	else
		{
						 (function ($) {	$.ajax({
						  type: "POST",
						  url: '/themes/mobilebhp/unsubscribenews-email.php',
						  data: "email="+newsletterEmail+"&action=submit",
						  cache: false,
						  success: function(data) {
						  //alert('Load was performed.');
						  if(data!="Email does not exist")
							{
					(function ($) { $("#newsletter").css("display","none")})(jQuery);
					(function ($) { $("#newsletterSuccessMsg").css("display","block")})(jQuery);
			
							}
							else
							{
						showErrorInput(data, "newsletterEmail");
						return true;			
							}
						  }
						})})(jQuery);
						
							return true;
		}	
}
	
	function spk()
			{
                //alert('formtest');

                //event.preventDefault();
                //return false;

	var isvalid=true;
	var name=document.getElementById('name').value;
	var email=document.getElementById('email').value;
	//var subject=document.getElementById('subject').value;
	var message=document.getElementById('message').value;
	var o_val='';
	var c_value = "";
	var speaktype = "";
	if(name=='' || name=='First & Last Name')
		{
		showErrorInput("Please first name and last name", "name");
		isvalid=false;
		}
		else
		{
		changeErrorInput("name");
		}
	if(email==false || email=="" || email=='Your Email'){
	//alert("Please enter email");
		showErrorInput("Please enter your email address", "email");
		isvalid=false;
		
	}
	else if(isValidEmail(email))
	{
		changeErrorInput("email");
	}
	else
	{
		//alert("Please enter valid email");
		showErrorInput("You have entered an invalid email", "email");
		isvalid=false;
		
	}
	/*if(subject=='' || subject=='subject' || subject=='Subject')
		{
		showErrorInput("Please enter subject", "subject");
		isvalid=false;
		}
		else
		{
		changeErrorInput("subject");
		}*/
for(var i=0; i < document.speak_frm.speak_type.length; i++)
   	{
   	if(document.speak_frm.speak_type[i].checked)
      	{
      		c_value = c_value + document.speak_frm.speak_type[i].value + ",";
      	}
   	}
  	if(c_value=='')
   		{
   		//showErrorInput("Please select at least one", "Subject");
		isvalid=false;
		if((function ($) { $("#"+"compliments").closest("div").hasClass("help-block")})(jQuery))
						{
						//alert("Ifffffffff");
						//$("#"+"compliments").closest("div").find("div").text("Please select at least one");
						}
						else
						{
							//alert((function ($) { $("#"+"compliments").closest("div")})(jQuery));
							if(!$("#"+"compliments").hasClass("has-error"))
								{
							(function ($) { //$("#"+"speak_otherval").closest("div").addClass("has-error");
							$("#"+"compliments").addClass("has-error");
							$("#"+"compliments").closest("div").append("<div class='help-block'>" + "Please select at least one" + "</div>");
							})(jQuery);
								}
						}
   		}
   		else
   		{
   		c_value=document.speak_frm.speak_type.checked;
   		changeErrorInput("compliments");
   		}
   		if(c_value!='')
   			{
   				if(document.getElementById("compliments").checked==true)
   					{
   				speaktype='Compliments';	
   				changeErrorInput("speak_otherval");
   					}
   			 else if(document.getElementById("suggestions").checked==true)
   			 		{
   			 	speaktype='Suggestions';	
   			 	changeErrorInput("speak_otherval");
   			 		}
   			 	 else if(document.getElementById("classifieds").checked==true)
   			 		{
   			 	speaktype='Classifieds';	
   			 	changeErrorInput("speak_otherval");
   			 		}
   			 	 else if(document.getElementById("merchandise").checked==true)
   			 		{
   			 	speaktype='Merchandise';	
   			 	changeErrorInput("speak_otherval");
   			 		}
   			 	else if(document.getElementById("complaints").checked==true)
   			 		{
   			 	speaktype='Complaints';	
   			 	changeErrorInput("speak_otherval");
   			 		}
   			 	else if(document.getElementById("other").checked==true)
   			 		{
   			 		speaktype='Other';		
   			 		
		   			if(document.getElementById("other").checked==true && document.getElementById("speak_otherval").value=='')
		   				{
		   				//showErrorInput("Please enter other value", "speak_otherval");
						if((function ($) { $("#"+"speak_otherval").hasClass("other")})(jQuery))
						{
						//$("#"+"speak_otherval").closest("div").find("div").text("Please enter other value");
						}
						else
						{
						if($("#"+"speak_otherval").parent("div").find("div.erDiv").html()==null)
								{ 
								(function ($) 
								{
								$("#"+"speak_otherval").closest("div").append("<div style='display: inline;' class='erDiv'><div class='help-block'>" + "Please enter email subject" + "</div></div>");
								//alert("");
								return false;
								})(jQuery);
								}
								
							
						}
						isvalid=false;	
						
		   				}
		   				else
		   				{
		   			changeErrorInput("compliments");	
		   			changeErrorInput("speak_otherval");
		   			
		   				o_val=document.getElementById("speak_otherval").value;	
						}
   					}
   			}
   		if((message=='') || (message=='Message') || (message=='message'))
		{
		showErrorInput("Please enter message", "message");
		isvalid=false;
		}
		else
		{
		changeErrorInput("message");
		}
		if(isvalid==true)
			{
			 (function ($) {	$.ajax({
						  type: "POST",
						  url: '/themes/mobilebhp/ajax/speak.php',
						  data: "name="+name+"&action=submit"+"&email="+email+"&message="+message,
						  cache: false,

						  success: function(data) {
						  	if(data==1)
						  		{
						  		(function ($) { //$("#"+"speak_otherval").closest("div").addClass("has-error");
							$("#speak_frm").fadeOut("600");

                             //alert('Thank You for your feedback to Team-BHP');


							$("#thanks").css("display","block");

								})(jQuery);
						  		}
						  		else
						  		{
						  		alert("has-error");
						  		}
						  //alert('Load was per/formed.');

						  }
						})})(jQuery);

							return true;
			}
}
