
Drupal.TeamBhp = {};
Drupal.TeamBhp.Variant = {};
Drupal.TeamBhp.Variant.Prices = {};

var Prices = Drupal.TeamBhp.Variant.Prices;

jQuery.extend(Prices, {
  cities: null,

  initialize: function(cities) {
  
    jQuery(document).ready(function() {
      Prices.cities = jQuery.JSON.decode(cities);
      var html = '';
      html += '<table class="variant-prices">';
      html += '</table>';
      html += '<input type="button" value="Add City" class="btn-add-city" onclick="Prices.addFieldSet();return(false);" />';
      jQuery('#edit-teambhp-variant-price .fieldset-wrapper').append(html);
      
      var prices = jQuery.JSON.decode(jQuery('#edit-teambhp-variant-price input[type=hidden]').val());
      for(var i=0; i < prices.length; i++) {
        var price = prices[i];
        Prices.addFieldSet(price);
      }
      
      jQuery('#edit-teambhp-variant-price').parents('form').submit(Prices.serializeValues);
    });
  },
  
  serializeValues: function() {
    var values = [];

    var result = true;
    
    jQuery('#edit-teambhp-variant-price .variant-price-set').each(function(index, element) {
      var obj = {};      
      obj.on_road_price = jQuery(element).find('.on-road-price').val();
      obj.ex_showroom_price = jQuery(element).find('.ex-showroom-price').val();
      obj.taxes = jQuery(element).find('.taxes').val();
      obj.insurance = jQuery(element).find('.insurance').val();
      
      jQuery.each(obj, function(key, val) {
        if(parseInt(val) != val) {
          jQuery('#teambhp_variant_price_non_numeric').dialog({
                    modal: true,
                    title: 'Invalid input',
                    buttons: {
                      Ok: function() {
                        jQuery( this ).dialog( "close" );
                        jQuery(element).find('.on-road-price').focus();
                      }
                    }
                  });

          result = false;
          
          return(false);
        }
      });
      
      obj.city = jQuery(element).find('.city').val();

      values.push(obj);
    });

    jQuery('#edit-teambhp-variant-price input[type=hidden]').val(jQuery.JSON.encode(values));
    return(result);
  },
  
  addFieldSet: function(price) {
    var html = '<tr class="variant-price-set">';
    html += '<td class="label"><label>City</label></td>'
    html += '<td class="input">' + Prices.getCitySelect(price) + '</td>';
    html += '<td class="label"><label>On Road Price</label></td>';
    html += '<td class="input"><input type="text" class="on-road-price form-text" value="{0}" /></td>'.replace('{0}', price ? price.on_road_price : '');
    html += '<td class="label"><label>Ex ShowRoom Price</label></td>';
    html += '<td class="input"><input type="text" class="ex-showroom-price form-text" value="{0}" /></td>'.replace('{0}', price ? price.ex_showroom_price : '');
    html += '<td class="label"><label>Taxes</label></td>';
    html += '<td class="input"><input type="text" class="taxes form-text" value="{0}" /></td>'.replace('{0}', price ? price.taxes : '');
    html += '<td class="label"><label>Insurance</label></td>';
    html += '<td class="input"><input type="text" class="insurance form-text" value="{0}" /></td>'.replace('{0}', price ? price.insurance : '');
    html += '<td class="remove"><a href="#" onclick="return(Prices.removeFieldSet(this));">Remove</a></td>';
    html += '</tr>';
    
    $inserted = jQuery('#edit-teambhp-variant-price .variant-prices').append(html);
    if(!price) {
      $inserted.find('.city').focus();
    }
  },
  
  getCitySelect: function(price) {
    var html = '';
    html += '<select class="city">';
    for(var i=0; i < Prices.cities.length; i++) {
      var city = Prices.cities[i];
      html += '<option value="{0}" {2}>{1}</option>'
                  .replace('{0}', city.value)
                  .replace('{1}', city.text)
                  .replace('{2}', price && price.city == city.value ? 'selected="selected"' : '');
    }
    html += '</select>';
    
    return(html);
  },
  
  removeFieldSet: function(lnk) {
    jQuery(lnk).parents('tr').remove();
    
    return(false);
  }
});
