//cookie functions
// To use, simple do: Get_Cookie('cookie_name'); 
// replace cookie_name with the real cookie name, '' are required
function Get_Cookie( check_name ) {
	// first we'll split this cookie up into name/value pairs
	// note: document.cookie only returns name=value, not the other components
	var a_all_cookies = document.cookie.split( ';' );
	var a_temp_cookie = '';
	var cookie_name = '';
	var cookie_value = '';
	var b_cookie_found = false; // set boolean t/f default f
	var i = '';
	
	for ( i = 0; i < a_all_cookies.length; i++ )
	{
		// now we'll split apart each name=value pair
		a_temp_cookie = a_all_cookies[i].split( '=' );
		
		
		// and trim left/right whitespace while we're at it
		cookie_name = a_temp_cookie[0].replace(/^\s+|\s+$/g, '');
	
		// if the extracted name matches passed check_name
		if ( cookie_name == check_name )
		{
			b_cookie_found = true;
			// we need to handle case where cookie has no value but exists (no = sign, that is):
			if ( a_temp_cookie.length > 1 )
			{
				cookie_value = unescape( a_temp_cookie[1].replace(/^\s+|\s+$/g, '') );
			}
			// note that in cases where cookie is initialized but no value, null is returned
			return cookie_value;
			break;
		}
		a_temp_cookie = null;
		cookie_name = '';
	}
	if ( !b_cookie_found ) 
	{
		return null;
	}
}


function Set_Cookie( name, value, expires, path, domain, secure ) {
	// set time, it's in milliseconds
	var today = new Date();
	today.setTime( today.getTime() );
	// if the expires variable is set, make the correct expires time, the
	// current script below will set it for x number of days, to make it
	// for hours, delete * 24, for minutes, delete * 60 * 24
	if ( expires )
	{
		expires = expires * 1000 * 60 * 60 * 24;
	}
	//alert( 'today ' + today.toGMTString() );// this is for testing purpose only
	var expires_date = new Date( today.getTime() + (expires) );
	//alert('expires ' + expires_date.toGMTString());// this is for testing purposes only

	document.cookie = name + "=" +escape( value ) +
		( ( expires ) ? ";expires=" + expires_date.toGMTString() : "" ) + //expires.toGMTString()
		( ( path ) ? ";path=" + path : "" ) + 
		( ( domain ) ? ";domain=" + domain : "" ) +
		( ( secure ) ? ";secure" : "" );
}
//cookie functions

var abc = 10;
var nt = 'ibi';
var nwindow;
function test(){
   // if($("#edit-field-image").length()>0){
        //alert(jQuery("#edit-field-image").length());
  //  }
    //if(jQuery("#edit-field-image").length>0 && jQuery("#overlay-title").html().indexOf('Create')== -1){
    //if(jQuery("#edit-field-image").length>0 && jQuery("title").html().indexOf('Create')== -1){
    /*if(jQuery("form#article-node-form").length>0 && jQuery("title").html().indexOf('Create')== -1){
    	nt = 'ibi';
    	appendData();
        abc = 10;
    }
    else if(jQuery("form#page-node-form").length>0 && jQuery("title").html().indexOf('Create')== -1){
    	nt = 'page';
    	appendData();
        abc = 10;
    }
    else if(jQuery("form#test-node-form").length>0 && jQuery("title").html().indexOf('Create')== -1){
    	nt = 'test';
    	appendData();
        abc = 10;
    }
    else */
    	if(jQuery("#edit-field-gallery-exterior-und").length>0 && jQuery("title").html().indexOf('Create')== -1){
    	appendGal();
        abc = 10;
    }
    //if(jQuery("#overlay-title").html().indexOf('imagebunch')!= -1 || jQuery(".page-title").html().indexOf('imagebunch')!= -1){
    if(jQuery(".page-title").length>0)
    {
    	var title = jQuery(".page-title").html();
    }
    else
    {
    	var title = "";
    }
    if(jQuery("title").html().indexOf('imagebunch')!= -1 || title.indexOf('imagebunch')!= -1){
    	appendData2();
        abc = 10;
    }
    
    if ( Get_Cookie( 'clearCache' ) == 1 ) 
		{
		Set_Cookie( 'clearCache', '0', '30', '/', '', '' );
		window.parent.closeAndRefresh();
		}
    //alert(jQuery("#overlay").find(".status").length);
    if(document.location.href.indexOf('bulkupload=finalpage') != -1)
    	{
		Set_Cookie( 'clearCache', '1', '30', '/', '', '' );
    	document.forms["system-performance-settings"].submit();
        //alert("Please click on Clear all Cache to update current changes");
       	}
       
}

function appendData(){
    var  str = '<input type="submit" class="form-submit" value="Add Bulk Images" onclick=\'openInnewWindow("'+nt+'");return false;\' name="op" id="edit-preview">';
   // alert(jQuery("#edit-field-image .fieldset-wrapper").length);
    jQuery("#edit-actions").append(str);
}


function appendData2(){
    var loc = document.location.href;
    var length = (loc.indexOf('#')-loc.indexOf('imagebunch')-10);
    var nt1 = (loc.substr(loc.indexOf('node/add')+19, length));
    
    jQuery(".vertical-tabs").hide();
    jQuery("#edit-submit").hide();
    jQuery("#edit-preview").hide();
    jQuery(".form-item-title").hide();
    var desc = jQuery(".field-type-image .description").eq(0).html();
    jQuery(".field-type-image .description").hide();
    jQuery("#edit-field-gallery-exterior1-und-0-ajax-wrapper").before("<div class='description'>"+desc+"</div>");
    jQuery("#overlay-title").html("Select images to upload");

    jQuery("#edit-field-"+nt1+"1-und-0-upload-button").hide();
    jQuery("#edit-field-"+nt1+"2-und-0-upload-button").hide();
    jQuery("#edit-field-"+nt1+"3-und-0-upload-button").hide();
    jQuery("#edit-field-"+nt1+"4-und-0-upload-button").hide();
    jQuery("#edit-field-"+nt1+"5-und-0-upload-button").hide();
    jQuery("#edit-field-"+nt1+"6-und-0-upload-button").hide();
    jQuery("#edit-field-"+nt1+"7-und-0-upload-button").hide();
    jQuery("#edit-field-"+nt1+"8-und-0-upload-button").hide();
    jQuery("#edit-field-"+nt1+"9-und-0-upload-button").hide();
    jQuery("#edit-field-"+nt1+"10-und-0-upload-button").hide();

    var  str = '<input type="submit" class="form-submit" value="Upload All" onclick=\'uploadAll();return false;\' name="op" id="edit-upload">';
    //str += '<input type="submit" class="form-submit" value="Save to parent Images" onclick=\'submitCustomisedImageData();return false;\' name="op" id="edit-submitcontent">';
   // alert(jQuery("#edit-field-image .fieldset-wrapper").length);
    jQuery("#edit-actions").append(str);


}

//functions for gallery images
function appendGal()
{
	var  str = '<input type="submit" class="form-submit" value="Add Bulk Images" onclick=\'openInnewWindow("gallery-exterior");return false;\' name="op" id="edit-preview">';
	jQuery("#edit-field-gallery-exterior-und").append(str);
	var  str1 = '<input type="submit" class="form-submit" value="Add Bulk Images" onclick=\'openInnewWindow("gallery-interior");return false;\' name="op" id="edit-preview">';
	jQuery("#edit-field-gallery-interior-und").append(str1);
	var  str2 = '<input type="submit" class="form-submit" value="Add Bulk Images" onclick=\'openInnewWindow("gallery-engine");return false;\' name="op" id="edit-preview">';
	jQuery("#edit-field-gallery-engine-und").append(str2);
	var  str3 = '<input type="submit" class="form-submit" value="Add Bulk Images" onclick=\'openInnewWindow("gallery-smaller");return false;\' name="op" id="edit-preview">';
	jQuery("#edit-field-gallery-smaller-und").append(str3);
}

function showAlert(){

}
var currentUpload = 1;
function uploadAll(){
    //alert(jQuery("#edit-field-image2-und-0-upload").val());
    //alert(jQuery("#edit-field-image1-und-0-upload").val());
    //alert('here'+jQuery("#edit-field-image1-und-0-upload-button").val());
   // jQuery("#edit-field-image1-und-0-upload-button").mousedown();
    doUpload();
  // setTimeout('jQuery("#edit-field-image2-und-0-upload-button").mousedown()',3000);
  // setTimeout('jQuery("#edit-field-image3-und-0-upload-button").mousedown()',6000);
  // setTimeout('jQuery("#edit-field-image4-und-0-upload-button").mousedown()',9000);
  // setTimeout('jQuery("#edit-field-image5-und-0-upload-button").mousedown()',12000);
   // jQuery("#edit-field-image3-und-0-upload-button").mousedown();
   // jQuery("#edit-field-image4-und-0-upload-button").mousedown();
   // jQuery("#edit-field-image5-und-0-upload-button").mousedown();
}

function doUpload(){
    var loc = document.location.href;
    var length = (loc.indexOf('#')-loc.indexOf('imagebunch')-10);
    var nt1 = (loc.substr(loc.indexOf('node/add')+19, length));
    if(currentUpload>10){
        submitCustomisedImageData();
        return;}
    if(jQuery("#edit-field-"+nt1+currentUpload+"-und-0-upload").val()==''){
        currentUpload++;
        doUpload();
    }else{
        jQuery("#edit-field-"+nt1+currentUpload+"-und-0-upload-button").mousedown();
        waitForUpload();
    }
}
function waitForUpload(){
    var loc = document.location.href;
    var length = (loc.indexOf('#')-loc.indexOf('imagebunch')-10);
    var nt1 = (loc.substr(loc.indexOf('node/add')+19, length));
    if(jQuery("#edit-field-"+nt1+currentUpload+"-und-0-remove-button").length >0){
    	currentUpload++;
        doUpload();
    }else{
        setTimeout("waitForUpload()",1000);
    }
}

var finalUrl = "/u.php?id="
function submitCustomisedImageData(){
    var str = getNodeId();
    finalUrl = finalUrl+str;
    var loc = document.location.href;
    var length = (loc.indexOf('#')-loc.indexOf('imagebunch')-10);
    var nt1 = (loc.substr(loc.indexOf('node/add')+19, length));
    if(nt1.indexOf('-')>0)
    {
    	nt1 = nt1.replace('-', '_');
    }
    jQuery('.image-widget-data input').each(function(){
        if(jQuery(this).attr("name")=='field_'+nt1+'1[und][0][fid]'){
             finalUrl = finalUrl+"&img1="+jQuery(this).val();
        }if(jQuery(this).attr("name")=='field_'+nt1+'2[und][0][fid]'){
             finalUrl = finalUrl+"&img2="+jQuery(this).val();
        }if(jQuery(this).attr("name")=='field_'+nt1+'3[und][0][fid]'){
             finalUrl = finalUrl+"&img3="+jQuery(this).val();
        }if(jQuery(this).attr("name")=='field_'+nt1+'4[und][0][fid]'){
             finalUrl = finalUrl+"&img4="+jQuery(this).val();
        }if(jQuery(this).attr("name")=='field_'+nt1+'5[und][0][fid]'){
             finalUrl = finalUrl+"&img5="+jQuery(this).val();
        }if(jQuery(this).attr("name")=='field_'+nt1+'6[und][0][fid]'){
             finalUrl = finalUrl+"&img6="+jQuery(this).val();
        }if(jQuery(this).attr("name")=='field_'+nt1+'7[und][0][fid]'){
             finalUrl = finalUrl+"&img7="+jQuery(this).val();
        }if(jQuery(this).attr("name")=='field_'+nt1+'8[und][0][fid]'){
             finalUrl = finalUrl+"&img8="+jQuery(this).val();
        }if(jQuery(this).attr("name")=='field_'+nt1+'9[und][0][fid]'){
             finalUrl = finalUrl+"&img9="+jQuery(this).val();
        }if(jQuery(this).attr("name")=='field_'+nt1+'10[und][0][fid]'){
             finalUrl = finalUrl+"&img10="+jQuery(this).val();
        }
    });
	if(nt1.indexOf('gallery_')==0)
	{
		finalUrl = finalUrl+"&bundle="+nt1;
	}
    document.location.href=(finalUrl);
}

function getNodeId(){
    var url = (parent.window.opener.window.location.href);
    var ind = (url.indexOf("node/")+"node/".length);
    //alert(url.substr(ind)+"  "+ind +"   "+url.indexOf("/",ind+1));
    var id = url.substr((ind), url.indexOf("/",ind+1)-ind);
    return id;
}

function openInnewWindow(nodeType){
	var url = (window.location.href);
    var ind = (url.indexOf("node/")+"node/".length);
    var id = url.substr((ind), url.indexOf("/",ind+1)-ind);
	nwindow = window.open("/node/add/imagebunch"+nodeType+"#overlay-context=node/"+id,"multiUpload","width=900,height=550,scrollbars=yes,menubar=yes,status=yes,resizable=yes,directories=false,location=false,left=0,top=0");
     if(!nwindow.opener){ nwindow.opener = this.window; }
     
}


function closeAndRefresh()
{
	parent.window.opener.window.location.reload();
	window.close();
}
