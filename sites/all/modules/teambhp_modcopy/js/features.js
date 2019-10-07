
Drupal.TeamBhp = {};
Drupal.TeamBhp.Features = {};

var Features = Drupal.TeamBhp.Features;
var count=0;

jQuery.extend(Features, {
 initialize: function() {
  	   jQuery(document).ready(function() {
	   // Features.city = jQuery.JSON.decode(city);
        
      var html = '';
 	  html += '<table class="variant-prices">';
      html += '</table>';
      html += '<input type="button" value="Add Feature" class="btn-add-city" onclick="Features.addfeatureFieldSet();return(false);" />';
      jQuery('#edit-teambhp-features .fieldset-wrapper').append(html);
       var features = jQuery.JSON.decode(jQuery('#edit-teambhp-features input[type=hidden]').val());
       for(var i=0; i < features.length; i++) {
       	var feature = features[i];
        Features.addfeatureFieldSet(feature);
      }
      jQuery('#edit-teambhp-features').parents('form').submit(Features.serializeValues);
    });
  },
  
  serializeValues: function() {
	var values = [];
    var result = true;
    jQuery('#edit-teambhp-features .feature-value').each(function(index, element) {
 
      var obj = {};      
     
      obj.feature_name = jQuery(element).find('.city').val();
      obj.category = jQuery(element).find('.feat_cat').val();
      obj.feature_options = jQuery(element).find('.feature_options:checked').val();
        jQuery.each(obj, function(key, val) {
        if(jQuery(element).find('.city').val()=='' || jQuery(element).find('.feat_cat').val()=='')
        	{
       // if(parseInt(val) != val) {
          jQuery('#teambhp_features_non_numeric').dialog({
                    modal: true,
                    title: 'Invalid input',
                    buttons: {
                      Ok: function() {
                        jQuery( this ).dialog( "close" );
                        if(jQuery(element).find('.feat_cat').val()=='' )
                        	{
                         jQuery(element).find('.feat_cat').focus();	
                        	}
                        	else
                        	{
                        jQuery(element).find('.city').focus();
                        	}
                      }
                    }
                  });

          result = false;
          
          return(false);
       // }
         }
       /* if(parseInt(val) != val) {
          jQuery('#teambhp_features_non_numeric').dialog({
                    modal: true,
                    title: 'Invalid input',
                    buttons: {
                      Ok: function() {
                        jQuery( this ).dialog( "close" );
                        jQuery(element).find('.feature_option').focus();
                      }
                    }
                  });

          result = false;
          
          return(false);
        }*/
      });
      
      obj.feature_name = jQuery(element).find('.city').val();
  //   obj.feature_options = jQuery(element).find('.feature_options').val();

      values.push(obj);
    });

    jQuery('#edit-teambhp-features input[type=hidden]').val(jQuery.JSON.encode(values));
    return(result);
  },
  addfeatureFieldSet: function(feature) {
  var chkyes = '';
  var chkno = '';
  var chkoptional = '';
  var sel_ent = '';
  var sel_safety = '';
  var sel_conve = '';
  var sel_dri_enhan = '';
  var def_feat_cat = '';
  if(feature)
  	{
  	if(feature.feature_option=='1')
  		{
  	chkyes+="checked=checked";
  		}
  	if(feature.feature_option=='0')
  		{
  	chkno+="checked=checked";
  		}
  	if(feature.feature_option=='2')
  		{
  	chkoptional+="checked=checked";
  		}
  	if(feature.category=='Entertainment')
  		{
  	sel_ent+="selected=selected";
  		}
  	if(feature.category=='Safety')
  		{
  	sel_safety+="selected=selected";
  		}
  	if(feature.category=='Convenience')
  		{
  	sel_conve+="selected=selected";
  		}
  	if(feature.category=='Driver Enhancements')
  		{
  	sel_dri_enhan+="selected=selected";
  		}
  	
  	}
  	else
  	{
  	chkyes+="checked=checked";
  	def_feat_cat+="selected=selected";
  	}
 	var html = '<tr class="feature-value">';
 	html += '<td class="label"><label>Category</label></td>'
    html += '<td class="input"><select name="" class="feat_cat"><option value="" '+def_feat_cat+'>please select</option><option value="Entertainment" '+sel_ent+'>Entertainment</option><option value="Safety" '+sel_safety+'>Safety</option><option value="Convenience" '+sel_conve+'>Convenience</option><option value="Driver Enhancements" '+sel_dri_enhan+'>Driver Enhancements</option></select></td>'.replace('{0}', feature ? feature.feature_name : '');
    html += '<td class="label"><label>Feature Name</label></td>'
    html += '<td class="input"><input type="text" class="city" value="{0}" /></td>'.replace('{0}', feature ? feature.feature_name : '');
    html += '<td class="label"><label>Feature Option</label></td>';
    html += '<td class="input"><input type="radio" class="feature_options" value="1" name="feat'+count+'" '+chkyes+'/>Yes<input type="radio" class="feature_options" value="0" name="feat'+count+'" '+chkno+'/>No<input type="radio" class="feature_options" value="2" name="feat'+count+'" '+chkoptional+'/>Optional</td>';
    html += '<td class="remove"><a href="#" onclick="return(Features.removeFieldSet(this));">Remove</a></td>';
    html += '</tr>';
     $inserted = jQuery('#edit-teambhp-features .variant-prices').append(html);
    if(!feature) {
      $inserted.find('.city').focus();
    }
    count++;
  },
  
 /* getCitySelect: function(price) {
    var html = '';
    html += '<select class="city">';
    for(var i=0; i < Features.cities.length; i++) {
      var city = Features.cities[i];
      html += '<option value="{0}" {2}>{1}</option>'
                  .replace('{0}', city.value)
                  .replace('{1}', city.text)
                  .replace('{2}', price && price.city == city.value ? 'selected="selected"' : '');
    }
    html += '</select>';
    
    return(html);
  },*/
  getCitySelect: function() {
    var html = '';
    html += '<input type ="text" class="city" value="{0}">';
     return(html);
  },
  
  removeFieldSet: function(lnk) {
    jQuery(lnk).parents('tr').remove();
    return(false);
  }
});
