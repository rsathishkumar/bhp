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
		$("#"+id).closest("dl").removeClass("error");
		$("#"+id).removeClass("error");
		$("#"+id).closest("dd").find("div.errorMesg").remove();
	}

function showError(msg, id){
	if($("#"+id).closest("dl").hasClass("error"))
		{
			$("#"+id).closest("dd").find("div.errorMesg span").html(msg);
		}
	else
		{
			$("#"+id).closest("dl").addClass("error");
			$("#"+id).closest("dd").append("<div class='errorMesg'><span></span></div>");
			$("#"+id).closest("dd").find("div.errorMesg span").html(msg);
		}
		
}

function changeErrorInput(id)
	{
		$("#"+id).closest("div").removeClass("error");
		$("#"+id).removeClass("error");
		$("#"+id).closest("div").find("div.errorMesg").remove();
	}

function showErrorInput(msg, id){
	if($("#"+id).parent("div").hasClass("error"))
		{
			$("#"+id).parent("div").find("div.errorMesg span").html(msg);
		}
	else
		{
			$("#"+id).parent("div").addClass("error");
			$("#"+id).parent("div").append("<div class='errorMesg'><span></span></div>");
			$("#"+id).parent("div").find("div.errorMesg span").html(msg);
		}
		
}


function validate_shareForm() {
var isvalid=true;
var toShareForm=document.getElementById('toShareForm').value;
var fromShareForm=document.getElementById('fromShareForm').value;

	
	if(toShareForm==false || toShareForm=="Receipient's email"){
		showErrorInput("Please enter email address", "toShareForm");
		isvalid=false;
	}else if(isValidEmail(toShareForm)){
		changeErrorInput("toShareForm");
	}else{
		showErrorInput("You have entered an invalid email/ domain", "toShareForm");
		isvalid=false;
	}

	if(fromShareForm==false || fromShareForm=="Your email"){
		showErrorInput("Please enter your email address", "fromShareForm");
		isvalid=false;
	}else if(isValidEmail(fromShareForm)){
		changeErrorInput("fromShareForm");
	}else{
		showErrorInput("You have entered an invalid email/ domain", "fromShareForm");
		isvalid=false;
	}
	
	if(isvalid==false)
		{
			return false;
		}
	else
		{
			$("#shareForm").css("display","none");
			$("#successMsg").css("display","block");
			return true;
		}		

}


function validate_newsletter() {
var isvalid=true;
var newsletterEmail=document.getElementById('newsletterEmail').value;
	
	if(newsletterEmail==false || newsletterEmail=="Your Email ID"){
		showErrorInput("Please enter your email address", "newsletterEmail");
		isvalid=false;
	}else if(isValidEmail(newsletterEmail)){
		changeErrorInput("newsletterEmail");
	}else{
		showErrorInput("You have entered an invalid email/ domain", "newsletterEmail");
		isvalid=false;
	}
	
	if(isvalid==false)
		{
			return false;
		}
	else
		{
			$("#newsletter").css("display","none");
			$("#newsletterSuccessMsg").css("display","block");
			return true;
		}	
}
