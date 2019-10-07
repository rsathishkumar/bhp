var abc = 5;
function test(){
//alert("hi wasim");
   // if($("#edit-field-image").length()>0){
        //alert(jQuery("#edit-field-image").length());
  //  }
    //if(jQuery("#edit-field-image").length>0 && jQuery("#overlay-title").html().indexOf('Create')== -1){
    if(jQuery("#edit-field-image").length>0 && jQuery("title").html().indexOf('Create')== -1){
    	appendData();
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
    	//appendData2();
        abc = 15;
    }

    if(document.location.href.indexOf('bulkupload=finalpage') != -1){
        alert("Please click on Clear all Cache to update current changes");
       }


}

function appendData(){

    var  str = '<input type="submit" class="form-submit" value="Add Bulk Images" onclick=\'openInnewWindow();return false;\' name="op" id="edit-preview">';
   // alert(jQuery("#edit-field-image .fieldset-wrapper").length);
    jQuery("#edit-actions").append(str);


}


function appendData2(){
    //alert(document.location.href);
    jQuery(".vertical-tabs").hide();
    jQuery("#edit-submit").hide();
    jQuery("#edit-preview").hide();
    jQuery(".form-item-title").hide();
    jQuery(".field-type-image .description").hide();
    jQuery("#overlay-title").html("Select images to upload");

    jQuery("#edit-field-ibi1-und-0-upload-button").hide();
    jQuery("#edit-field-ibi2-und-0-upload-button").hide();
    jQuery("#edit-field-ibi3-und-0-upload-button").hide();
    jQuery("#edit-field-ibi4-und-0-upload-button").hide();
    jQuery("#edit-field-ibi5-und-0-upload-button").hide();
    jQuery("#edit-field-ibi6-und-0-upload-button").hide();
    jQuery("#edit-field-ibi7-und-0-upload-button").hide();
    jQuery("#edit-field-ibi8-und-0-upload-button").hide();
    jQuery("#edit-field-ibi9-und-0-upload-button").hide();
    jQuery("#edit-field-ibi10-und-0-upload-button").hide();
    jQuery("#edit-field-ibi11-und-0-upload-button").hide();
    jQuery("#edit-field-ibi12-und-0-upload-button").hide();
    jQuery("#edit-field-ibi13-und-0-upload-button").hide();
    jQuery("#edit-field-ibi14-und-0-upload-button").hide();
    jQuery("#edit-field-ibi15-und-0-upload-button").hide();

    var  str = '<input type="submit" class="form-submit" value="Upload All" onclick=\'uploadAll();return false;\' name="op" id="edit-upload">';
    //str += '<input type="submit" class="form-submit" value="Save to parent Images" onclick=\'submitCustomisedImageData();return false;\' name="op" id="edit-submitcontent">';
   // alert(jQuery("#edit-field-image .fieldset-wrapper").length);
    jQuery("#edit-actions").append(str);


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
    if(currentUpload>5){
        submitCustomisedImageData();
        return;}
    if(jQuery("#edit-field-ibi"+currentUpload+"-und-0-upload").val()==''){
        currentUpload++;
        doUpload();
    }else{
        jQuery("#edit-field-ibi"+currentUpload+"-und-0-upload-button").mousedown();
        waitForUpload();
    }
}
function waitForUpload(){
    if(jQuery("#edit-field-ibi"+currentUpload+"-und-0-remove-button").length >0){
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
    jQuery('.image-widget-data input').each(function(){
        if(jQuery(this).attr("name")=='field_image1[und][0][fid]'){
             finalUrl = finalUrl+"&img1="+jQuery(this).val();
        }
        if(jQuery(this).attr("name")=='field_image2[und][0][fid]'){
             finalUrl = finalUrl+"&img2="+jQuery(this).val();
        }if(jQuery(this).attr("name")=='field_image3[und][0][fid]'){
             finalUrl = finalUrl+"&img3="+jQuery(this).val();
        }if(jQuery(this).attr("name")=='field_image4[und][0][fid]'){
             finalUrl = finalUrl+"&img4="+jQuery(this).val();
        }if(jQuery(this).attr("name")=='field_image5[und][0][fid]'){
             finalUrl = finalUrl+"&img5="+jQuery(this).val();
        }
    });

    document.location.href="/d7.7"+(finalUrl);
}

function getNodeId(){
    var url = (parent.window.opener.window.location.href);
    var ind = (url.indexOf("node/")+"node/".length);
    //alert(url.substr(ind)+"  "+ind +"   "+url.indexOf("/",ind+1));
    var id = url.substr((ind), url.indexOf("/",ind+1)-ind);
    return id;
}

function openInnewWindow(){
     var nwindow = window.open("/d7.7/node/2#overlay-context=node/1&overlay=node/add/imagebunch","","width=900,height=480,scrollbars=yes,menubar=yes,status=yes,resizable=yes,directories=false,location=false,left=0,top=0");
     if(!nwindow.opener){ nwindow.opener = this.window; }
     
}

//field_image1[und][0][fid]
