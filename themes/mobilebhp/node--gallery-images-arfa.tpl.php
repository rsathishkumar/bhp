<?php
//echo "SELECT * FROM url_alias WHERE `source` = 'node/".$node->nid."'";
//$sql_url_alias=@mysqli_fetch_array(mysqli_query("SELECT * FROM url_alias WHERE `source` = 'node/".$node->nid."'"));
$sql_url=@mysqli_fetch_array(mysqli_query("select entity_id,field_gallery_model_nid from field_data_field_gallery_model where entity_id=".$node->nid));

$q="SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid, field_data_field_gallery_exterior.field_gallery_exterior_fid,field_data_field_gallery_exterior.field_gallery_exterior_title,field_data_field_gallery_exterior.entity_id, file_managed.uri FROM node, file_managed, field_data_field_gallery_exterior, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_exterior.field_gallery_exterior_fid AND field_data_field_gallery_model.field_gallery_model_nid =".$node->field_gallery_model['und'][0]['nid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid order by field_data_field_gallery_exterior.field_gallery_exterior_fid desc";
$sql_exterior_img=@mysqli_query($q);
$num_exterior=@mysqli_num_rows($sql_exterior_img);

$q_interior="SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid, field_data_field_gallery_interior.field_gallery_interior_fid,field_data_field_gallery_interior.field_gallery_interior_title,field_data_field_gallery_interior.entity_id, file_managed.uri FROM node, file_managed, field_data_field_gallery_interior, field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_interior.field_gallery_interior_fid AND field_data_field_gallery_model.field_gallery_model_nid =".$node->field_gallery_model['und'][0]['nid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid order by field_data_field_gallery_interior.field_gallery_interior_fid desc";
$sql_interior_img=@mysqli_query($q_interior);
$num_interior=@mysqli_num_rows($sql_interior_img);

$q_engine="SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid, field_data_field_gallery_engine.field_gallery_engine_fid as uniID,field_data_field_gallery_engine.field_gallery_engine_title,field_data_field_gallery_engine.entity_id, file_managed.uri FROM node, file_managed, field_data_field_gallery_engine, field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_engine.field_gallery_engine_fid AND field_data_field_gallery_model.field_gallery_model_nid =".$node->field_gallery_model['und'][0]['nid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid order by field_data_field_gallery_engine.field_gallery_engine_fid desc";
$sql_engine_img=@mysqli_query($q_engine);
$num_engine=@mysqli_num_rows($sql_engine_img);

$q_smaller="SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid, field_data_field_gallery_smaller.field_gallery_smaller_fid as uniID,field_data_field_gallery_smaller.field_gallery_smaller_title,field_data_field_gallery_smaller.entity_id, file_managed.uri FROM node, file_managed, field_data_field_gallery_smaller, field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_smaller.field_gallery_smaller_fid AND field_data_field_gallery_model.field_gallery_model_nid =".$node->field_gallery_model['und'][0]['nid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid order by field_data_field_gallery_smaller.field_gallery_smaller_fid desc";
$sql_smaller_img=@mysqli_query($q_smaller);
$num_smaller=@mysqli_num_rows($sql_smaller_img);
//print_r($node->field_gallery_model['und'][0]['value']);
function to_lakh($no)
{
if(intval($no)>=100000)
	{
		$res = (intval($no)/100000);
		if(strpos($res, '.')>0)
		{
			$res = round($res, 1);
		}
		return $res;
	}
else
	{
		return 0;
	}
}
$make_res = @mysqli_fetch_array(mysqli_query("select node.title,field_data_field_nr_make.field_nr_make_nid from node,field_data_field_nr_make where field_data_field_nr_make.entity_id =".$node->field_gallery_model['und'][0]['nid']." and node.nid=field_data_field_nr_make.field_nr_make_nid"));
$model_title= @mysqli_fetch_array(mysqli_query("select node.title from node where nid=".$node->field_gallery_model['und'][0]['nid']));
?>
	<script type="text/javascript">
	var mid=<?php echo $node->field_gallery_model['und'][0]['nid'];?>;
	function showimgbycat(val, id)	//for brands dropdown
	{
	(function ($) {	
		if($(id).hasClass("active"))
		{
		return false;
		}
		else
		{
			$.ajax({
			   type: "POST",
			   url: "/themes/mobilebhp/show_modelgallerybycat.php",
			   cache: false,
			   data: "mid="+mid+"&action=show"+"&category="+val,
			   success: function(data){
				   	$('div.jcarousel-skin-tango').replaceWith(data);
				   	var l = $('#mycarousel').find("li").length;
				   	if(l>0)
				   	{
				   	$("#c").text("1");
				   	}
				   	else
				   	{
				   	$("#c").text("0");
				   	}
				   	$("#t").text(l);
			    	if(l>4)
			    	{
					    $('#mycarousel').jcarousel({
							scroll: 4,
							initCallback: mycarousel_initCallback
						});
					}
			   }
			 });
		 	$.ajax({
			   type: "POST",
			   url: "/themes/mobilebhp/show_gallerybycat.php",
			   cache: false,
			   data: "mid="+mid+"&action=show"+"&category="+val,
			   success: function(data){
				   	$('div#gallery').replaceWith(data);
			   }
			 });
		 }
		 })(jQuery);
		j('.allPhotos').css('display', 'none');
		j('html, body').animate({scrollTop: j("#container").offset().top}, 600);
		j('.lessPhotos, .jcarousel-skin-tango').show();
	}
	
	//js explode function
	function explode (delimiter, string, limit) {
	    var emptyArray = {
	        0: ''
	    };
	
	    // third argument is not required
	    if (arguments.length < 2 || typeof arguments[0] == 'undefined' || typeof arguments[1] == 'undefined') {
	        return null;
	    }
	
	    if (delimiter === '' || delimiter === false || delimiter === null) {
	        return false;
	    }
	
	    if (typeof delimiter == 'function' || typeof delimiter == 'object' || typeof string == 'function' || typeof string == 'object') {
	        return emptyArray;
	    }
	
	    if (delimiter === true) {
	        delimiter = '1';
	    }
	
	    if (!limit) {
	        return string.toString().split(delimiter.toString());
	    } else {
	        // support for limit argument
	        var splitted = string.toString().split(delimiter.toString());
	        var partA = splitted.splice(0, limit - 1);
	        var partB = splitted.join(delimiter.toString());
	        partA.push(partB);
	        return partA;
	    }
	}
		
		var j = jQuery.noConflict();
		var isOn = 0
		var refreshIntervalId;
		var p;
		var pos=0;
		function mycarousel_initCallback(carousel) {
		    jQuery('.controls .next').click(function(){
		    	if(pos%4==0)
		    	{
		    	carousel.scroll(jQuery.jcarousel.intval(pos+1));
		    	}
		    });
		    jQuery('.controls .prev').click(function(){
		    	if(pos%4==3)
		    	{
		    	carousel.scroll(jQuery.jcarousel.intval(pos-2));
		    	}
		    });
		};
		
		(function (j) {
			j(function(){
			j('#t').text(j('#gallery span').length);
			if(j('#mycarousel').find("li").length>4)
		    {
				j('#mycarousel').jcarousel({
					scroll: 4,
					initCallback: mycarousel_initCallback
				});
			}
			
			//Most Viewed tab 				
			j(".carListing li").hover(
			function(){
					j(this).addClass("hover");
				},
			function(){
					j(this).removeClass("hover");
					}
			);		
		
			j(".TeamMember").hover(
				function(){
					j(this).addClass("TeamMemberHover");
				},
				function(){
					j(this).removeClass("TeamMemberHover");
				}
			);
		
			//Most Viewed tab 				
			j(".most_view li").click(function() {
			j(".most_view li a").removeClass("active"); //Remove any "active" class
			j(this).find("a").addClass("active"); //Remove any "active" class
			j(this).addClass("active"); //Add "active" class to selected tab
			j(".mv_tab_content").hide(); //Hide all tab content
	
			var activeTab = j(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
			j(activeTab).fadeIn(); //Fade in the active ID content
			return false;
			});
			
			slideShow();
			
			j('a.window').click(function(){
				if(isOn==0)
				{
					refreshIntervalId = setInterval('gallery()',6000);
					isOn=1;
				}
				else
				{
					clearInterval(refreshIntervalId);
					isOn=0;
				}
				return false;
			});
			
			j('#showAll').click(function(){
				j('.lessPhotos, .jcarousel-skin-tango').css('display', 'none');
				j('.allPhotos, #showLess').css('display', 'block');
				j('html, body').animate({scrollTop: j("#allPhotos").offset().top}, 600);
				return false;
			});
				
			j('#showLess').click(function(){
				j('.allPhotos').css('display', 'none');
				j('html, body').animate({scrollTop: j("#container").offset().top}, 600);
				j('.lessPhotos, .jcarousel-skin-tango').show();
				return false;
			});
			
			j('.OtherSections li a').click(function(){
				j('.OtherSections li a').removeClass('active');
				j(this).addClass('active');
				return false;
			});
									
			j(".quicklinks").click(function(){
				if(j("#sidePage").css("display")=="none"){
					j.cookie("forQuicklinks", "foo", { path: '/' });
					j("#sidePage").fadeIn("slow");
					j(this).html("&lt; Close Links");
					j("#page").addClass("pageWithSlide");
					return false;
				}else {
					j.cookie("forQuicklinks", null);
					j.cookie("forScreenWidth", "foo", { path: '/' });
					j("#sidePage").fadeOut("slow");
					j(this).html("Quick Links &gt;");
					j("#page").removeClass("pageWithSlide");
					return false;
				}
			});
			
			if(screen.width>=1280 && j.cookie("forScreenWidth")!="foo"){
				j("#sidePage").fadeIn("fast");
				j("#header a.quicklinks").html("&lt; Close Links");
				j("#page").addClass("pageWithSlide");
			}
			
			if(j.cookie("forQuicklinks")=="foo"){
				j("#sidePage").fadeIn("fast");
				j("#header a.quicklinks").html("&lt; Close Links");
				j("#page").addClass("pageWithSlide");
			}
			
			j(".Email .email").click(function(){
				if (j(this).siblings(".shareForm").css("display")=="none") {
					j(this).closest(".Email").addClass("EmailActive");
					j(this).siblings(".shareForm").fadeIn();
					return false;
				}else{
					j(this).closest(".Email").removeClass("EmailActive");
					j(this).siblings(".shareForm").fadeOut();
					return false;
				}
			});
			
			j(".Email .closeShareForm").click(function(){
				j(this).closest(".Email").removeClass("EmailActive");
				j(this).closest(".shareForm").fadeOut();
				return false;
			});
			
			/*j.ajax({
			  type: "POST",
			   url: "/themes/mobilebhp/includes/getotherimages.php",
			   data: "mid="+mid,
			   cache: true,
			   success: function(data){
			   		var returned = explode('--break--', data);
			    	j("#allPhotos").append(returned[0]);
			    	j("#mycarousel").append(returned[1]);
			    	var l = j('#mycarousel').find("li").length;
					if(l>4)
			    	{
				    	j('#mycarousel').jcarousel({
							scroll: 4,
							initCallback: mycarousel_initCallback
						});
					}
			    	j("#showAll").fadeIn();
			    	Lightbox.initialize({autoPlay:false});
			   }
			});*/
			
			});
		})(jQuery);
		
		
		function slideShow() {
		//Set the opacity of all images to 0
		j('#gallery span').css({opacity: 0.0});
		
		//Get the first image and display it (set it to full opacity)
		j('#gallery span:first').css({opacity: 1.0});
		
		//Set the caption background to semi-transparent
		j('#gallery .caption').css({opacity: 0.7});
		
		//Resize the width of the caption according to the image width
		j('#gallery .caption').css({width: j('#gallery span').find('img').css('width')});
		
		//Get the caption of the first image from REL attribute and display it
		j('#gallery .content').html(j('#gallery span:first').find('img').attr('title'))
		.animate({opacity: 0.7}, 400);
		
		//Call the gallery function to run the slideshow, 6000 = change to next image after 6 seconds
		//setInterval('gallery()',6000);
		}
		
		function gallery() {
		//if no IMGs have the show class, grab the first image
		var current = (j('#gallery span.show')?  j('#gallery span.show') : j('#gallery span:first'));
		
		//Get next image, if it reached the end of the slideshow, rotate it back to the first image
		var next = ((current.next().length) ? ((current.next().hasClass('caption'))? j('#gallery span:first') :current.next('span')) : j('#gallery span:first'));	
		
		//Get next image caption
		var caption = next.find('img').attr('title');
		
		//Hide the current image
		current.animate({opacity: 0.0}, 1000)
		.removeClass('show');
		
		//Set the fade in effect for the next image, show class has higher z-index
		next.css({opacity: 0.0})
		.addClass('show')
		.animate({opacity: 1.0}, 1000);
		
		//Set the opacity to 0 and height to 1px
		j('#gallery .caption').animate({opacity: 0.0}, { queue:false, duration:0 }).animate({height: '1px'}, { queue:true, duration:300 });	
		
		//Animate the caption, opacity to 0.7 and heigth to 100px, a slide up effect
		j('#gallery .caption').animate({opacity: 0.7},100 ).animate({height: '30px'},500 );
		
		//Display the content
		j('#gallery .content').html(caption);
		var totalImages = j('#gallery span');
		p = totalImages.index(j('#gallery span.show'));
		/*mycarousel_initCallback();*/
		j('#c').text(p+1);
		}
		
		function galleryNext() {
		pos++;
		//if no IMGs have the show class, grab the first image
		var current = (j('#gallery span.show')?  j('#gallery span.show') : j('#gallery span:first'));
		
		//Get next image, if it reached the end of the slideshow, rotate it back to the first image
		var next = ((current.next().length) ? ((current.next().hasClass('caption'))? j('#gallery span:first') :current.next('span')) : j('#gallery span:first'));	
		
		//Get next image caption
		var caption = next.find('img').attr('title');
		
		//Hide the current image
		current.animate({opacity: 0.0}, 1000)
		.removeClass('show');
		
		//Set the fade in effect for the next image, show class has higher z-index
		next.css({opacity: 0.0})
		.addClass('show')
		.animate({opacity: 1.0}, 1000);
		
		//Set the opacity to 0 and height to 1px
		j('#gallery .caption').animate({opacity: 0.0}, { queue:false, duration:0 }).animate({height: '1px'}, { queue:true, duration:300 });	
		
		//Animate the caption, opacity to 0.7 and heigth to 100px, a slide up effect
		j('#gallery .caption').animate({opacity: 0.7},100 ).animate({height: '30px'},500 );
		
		//Display the content
		j('#gallery .content').html(caption);
		var totalImages = j('#gallery span');
		p = totalImages.index(j('#gallery span.show'));
		/*mycarousel_initCallback();*/
		j('#c').text(p+1);
			if(p+1==j('#gallery span').length)
			{
				//j('.next').attr('onclick', 'return false');
				j('.next').addClass('disable');
			}
			else
			{
				//j('.next').attr('onclick', 'galleryNext(); return false;');
				j('.next').removeClass('disable');
			}
			if(pos>0)
			{
				//j('.prev').attr('onclick', 'galleryPrev(); return false;');
				j('.prev').removeClass('disable');
			}
			else
			{
				//j('.prev').attr('onclick', 'return false;');
				j('.prev').addClass('disable');
			}
		j('#mycarousel li a').removeClass('active');
		j('#mycarousel li a').eq(p).addClass('active');
		}
		
		function galleryPrev() {
		pos--;
		//if no IMGs have the show class, grab the first image
		var current = (j('#gallery span.show')?  j('#gallery span.show') : j('#gallery span:last'));
		
		//Get next image, if it reached the end of the slideshow, rotate it back to the first image
		var next = ((current.prev().length) ? ((current.prev().hasClass('caption'))? j('#gallery span:first') :current.prev('span')) : j('#gallery span:last'));	
		
		//Get next image caption
		var caption = next.find('img').attr('title');
		
		//Hide the current image
		current.animate({opacity: 0.0}, 1000)
		.removeClass('show');
		
		//Set the fade in effect for the next image, show class has higher z-index
		next.css({opacity: 0.0})
		.addClass('show')
		.animate({opacity: 1.0}, 1000);
		
		//Set the opacity to 0 and height to 1px
		j('#gallery .caption').animate({opacity: 0.0}, { queue:false, duration:0 }).animate({height: '1px'}, { queue:true, duration:300 });	
		
		//Animate the caption, opacity to 0.7 and heigth to 100px, a slide up effect
		j('#gallery .caption').animate({opacity: 0.7},100 ).animate({height: '30px'},500 );
		
		//Display the content
		j('#gallery .content').html(caption);
		var totalImages = j('#gallery span');
		p = totalImages.index(j('#gallery span.show'));
		/*mycarousel_initCallback();*/
		j('#c').text(p+1);
			if(pos>0)
			{
				//j('.prev').attr('onclick', 'return false');
				j('.prev').removeClass('disable');
			}
			else
			{
				//j('.prev').attr('onclick', 'galleryPrev(); return false;');
				j('.prev').addClass('disable');
			}
			if(p+1==j('#gallery span').length)
			{
				//j('.next').attr('onclick', 'galleryNext(); return false;');
				j('.next').addClass('disable');
			}
			else
			{
				//j('.next').attr('onclick', 'return false;');
				j('.next').removeClass('disable');
			}
		j('#mycarousel li a').removeClass('active');
		j('#mycarousel li a').eq(p).addClass('active');
		}

		function showMain(i)
		{
			pos = i;
			var totalImages = j('#gallery span');
			p = totalImages.index(j('#gallery span.show'));
			j('#c').text(p+1);
			if(p+1==j('#gallery span').length)
			{
				j('.next').addClass('disable');
			}
			else
			{
				j('.next').removeClass('disable');
			}
			if(pos>0)
			{
				j('.prev').removeClass('disable');
			}
			else
			{
				j('.prev').addClass('disable');
			}
			clearInterval(refreshIntervalId);
			isOn=0;
			j('div#gallery span').removeClass('show');
			j('div#gallery span').css('opacity','0');
			j('div#gallery span').eq(i).animate({
			    opacity: 1
			});
			j('div#gallery span').eq(i).addClass('show');
			j('.caption .content').text(j('div#gallery span img').eq(i).attr('title'));
			j('#mycarousel li a').removeClass('active');
			j('#mycarousel li a').eq(i).addClass('active');
			j('#c').text(i+1);
			return false;
		}
	</script>		
	
	<!--[if lte IE 6]>
		<link rel="stylesheet" href="/css/ie6.css" type="text/css" media="screen" charset="utf-8" />
	<![endif]-->
	<style type="text/css">
		#gallery .caption{height:30px;}
		.allPhotos, .hide{display:none;}
	</style>
	<?php
$sql_urlforspecification=@mysqli_fetch_array(mysqli_query("select field_data_field_spec_nr_engine_type.entity_id,field_data_field_nr_make_model.field_nr_make_model_nid from field_data_field_nr_make_model, field_data_field_spec_nr_engine_type where field_data_field_nr_make_model.field_nr_make_model_nid=".$node->field_gallery_model['und'][0]['nid']." and field_data_field_nr_make_model.entity_id=field_data_field_spec_nr_engine_type.field_spec_nr_engine_type_nid LIMIT 1"));
	if($sql_urlforspecification!='')
		{
$sql_urlforspecific=@mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$sql_urlforspecification['entity_id']."'"));
		}


$sql_urlforfeature=@mysqli_fetch_array(mysqli_query("select entity_id from field_data_field_features_model where field_features_model_nid=".$node->field_gallery_model['und'][0]['nid']));
	$sql_forengine=mysqli_query("select node.title,field_data_field_nr_make_model.entity_id,field_data_field_nr_make_model.field_nr_make_model_nid from node,field_data_field_nr_make_model where node.nid=field_data_field_nr_make_model.entity_id and node.status=1 and field_data_field_nr_make_model.field_nr_make_model_nid=".$node->field_gallery_model['und'][0]['nid']);
			$engineid='';
			while($dateforengineid=mysqli_fetch_array($sql_forengine))
				{
				$engineid.=$dateforengineid['entity_id'].",";
				}
			//	echo $engineid;
			
			$sql_urlforfeature=@mysqli_fetch_array(mysqli_query("select field_data_field_features_nr_variant.entity_id from field_data_field_features_nr_variant,field_data_field_variant_nr_engine where field_data_field_features_nr_variant.field_features_nr_variant_nid=field_data_field_variant_nr_engine.entity_id and field_data_field_variant_nr_engine.field_variant_nr_engine_nid in (".@substr($engineid,0,-1).") limit 1"));
	
	if($sql_urlforfeature!='')
		{
$sql_urlforfeaturedata=@mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$sql_urlforfeature['entity_id']."'"));
		}
$forum_review_nid = @mysqli_fetch_array(mysqli_query("select entity_id from field_data_field_forum_model where field_forum_model_nid=".$node->field_gallery_model['und'][0]['nid']));
	
	if($forum_review_nid!='')
		{
$forum_review_alias = @mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$forum_review_nid['entity_id']."'"));
		}
		
		$sql_urlforprice=@mysqli_fetch_array(mysqli_query("select field_data_field_price_nr_variant.entity_id from field_data_field_nr_make_model, field_data_field_variant_nr_engine, field_data_field_price_nr_variant where field_data_field_nr_make_model.field_nr_make_model_nid=".$node->field_gallery_model['und'][0]['nid']." and field_data_field_nr_make_model.entity_id=field_data_field_variant_nr_engine.field_variant_nr_engine_nid and field_data_field_variant_nr_engine.entity_id=field_data_field_price_nr_variant.field_price_nr_variant_nid"));
		if($sql_urlforprice!='')
		{
$sql_urlforpricedata=@mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$sql_urlforprice['entity_id']."'"));
		}
	?>

							<h1 class="padL20 marB10">Reviews</h1>
							<ul class="tab TLR5 clearfix">
								<li><a href="<?php echo url("node/".$node->field_gallery_model['und'][0]['nid']);?>" class="TLR5" title="Overview">Overview</a></li>
								<li><a href="<?php echo url("node/".$node->nid);?>" class="TLR5 active" title="Photos">Photos</a></li>
								<?php
								if($sql_urlforspecific!='')
								{
								?>
								<li><a href="/<?php echo $sql_urlforspecific['alias'];?>" class="TLR5" title="Specifications">Specifications</a></li>
								<?php
								}
								if($sql_urlforfeaturedata!='')
								{
								?>
								<li><a href="/<?php echo $sql_urlforfeaturedata['alias'];?>" class="TLR5" title="Features">Features</a></li>
								<?php
								}
								if($forum_review_alias!='')
								{
								?>
								<li><a href="<?php echo "/?q=forum-reviews&modelname=".strtolower($model_title['title']);//$forum_review_alias['alias'];?>" class="TLR5" title="Forum Reviews">Forum Reviews</a></li>
								<?php
								}
								if($sql_urlforpricedata!='')
									{
								?>
								<li><a href="/<?php echo $sql_urlforpricedata['alias'];?>" class="TLR5" title="Price">Price</a></li>		
								<?php
								}
								?>
								</ul>
							
							<div class="Overview">
								<div class="carOverview BLR5 marB10">
									<div class="clearfix">
										<div class="fleft w480">
											<h1><?php  echo $make_res['title']." ". $node->title?> <span>Photos</span></h1>
										</div>
										<?php include ("includes/common/share.php"); ?>
									</div><!-- clearfix -->
										
									<div class="clearfix photosView marT10 clearfix">
										<div class="fleft w655 photogalleryHolder clearfix">
											<?php
								 				if($num_exterior>0)
												{
												?>
											<div class="reviewPhoto" id="gallery">
												<?php
												$cnt=1;
												while($data_ext_img=mysqli_fetch_array($sql_exterior_img))
													{
													$nid='';
												if($cnt==$num_exterior)
													{
													$nid.=$data_ext_img['entity_id'];
													}
													$sql_imgtitle=mysqli_fetch_array(mysqli_query("select title from node where nid=".$data_ext_img['field_gallery_exterior_fid']));
												?>
												<span<?php if($cnt==1) {?> class="show"<?php }?>>
													<img src="http://www.team-bhp.com/?q=sites/default/files/styles/check_photo_gallery/public/<?php echo str_replace("public://","",$data_ext_img['uri']);?>" alt="<?php echo $data_ext_img['field_gallery_exterior_title'];?>"  title="<?php echo $data_ext_img['field_gallery_exterior_title'];?>" />
												</span>
												<?php
														$cnt++;
													}
										
											$sql_qry=@mysql_fetch_assoc(mysqli_query("select field_gallery_interior_title as t from field_data_field_gallery_interior where entity_id=".$nid));
												?>
												<div class="caption">
													<div class="content"><?php echo $sql_qry['t'];?></div>
												</div>
												<div class="controls clearfix">
													<a href="#" class="next" onclick="galleryNext(); return false;"><b>&nbsp;</b></a>
													<a href="#" class="prev disable" onclick="galleryPrev(); return false;"><b>&nbsp;</b></a>
												</div>
												</div><!-- gallery -->
												<?php
												}
												?>
											<ul class="photoShare">
												<li><a href="#" title="play" class="window">&nbsp;</a></li>
												<li><a href="#" title="facebook" class="facebook">&nbsp;</a></li>
												<li><a href="#" title="twitter" class="twitter">&nbsp;</a></li>
											</ul>
										</div><!-- photo gallery Holder -->
										
										<div class="fright w225">
											<?php include ("includes/categories.php") ?>
											
											<!-- <div class="clearfix memberPhotolink">
												<a href="#" class="fright btnRight" title="Member submited photos">
													<span>Member submited photos</span>
												</a>
											</div> -->
											
											<div class="clearfix photosCount">
												<i id="c">1</i> of <i id="t"><?php echo $num_exterior;?></i> <span>Photos</span> 
											</div>
										</div><!-- 225 -->
									</div><!-- clearfix -->
									<?php
									if($num_exterior>0)
										{
									?>
									<div class="jcarousel-skin-tango clearfix">
											<ul id="mycarousel" class="clearfix">
											<?php
											$sql_exterior_new=@mysqli_query($q);
											$counter=0;
											while($data_ext_imgnew=mysqli_fetch_array($sql_exterior_new))
														{
														$sql_imgtitle=mysqli_fetch_array(mysqli_query("select title from node where nid=".$data_ext_imgnew['field_gallery_exterior_fid']));
											?>
											<li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-1 jcarousel-item-1-horizontal" style="float: left; list-style: none outside none;" jcarouselindex="1">	
											<a <?php if($counter==0) {?>class="active"<?php }?>onclick="return showMain(<?php echo $counter;?>);" title="<?php echo $sql_imgtitle['title'];?>" href="#">
												<span class="photosBucketImg"><img alt="<?php echo $sql_imgtitle['title'];?>" src="http://www.team-bhp.com/?q=sites/default/files/styles/check_medium_medium/public/<?php echo str_replace("public://","",$data_ext_imgnew['uri']);?>"></span>
											</a>
											</li>
												<?php
														$counter++;
														}
											$sql_interior_new=@mysqli_query($q_interior);
											while($data_interior_imgnew=mysqli_fetch_array($sql_interior_new))
														{
														$sql_imgtitle=mysqli_fetch_array(mysqli_query("select title from node where nid=".$data_ext_imgnew['field_gallery_interior_fid']));
											?>
											<li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-1 jcarousel-item-1-horizontal" style="float: left; list-style: none outside none;" jcarouselindex="1">	
											<a onclick="return showMain(<?php echo $counter;?>);" title="<?php echo $sql_imgtitle['title'];?>" href="#">
												<span class="photosBucketImg"><img alt="<?php echo $sql_imgtitle['title'];?>" src="http://www.team-bhp.com/?q=sites/default/files/styles/check_medium_medium/public/<?php echo str_replace("public://","",$data_interior_imgnew['uri']);?>"></span>
											</a>
											</li>
												<?php
														$counter++;
														}
											$sql_engine_new=@mysqli_query($q_engine);
											while($data_engine_imgnew=mysqli_fetch_array($sql_engine_new))
														{
														$sql_imgtitle=mysqli_fetch_array(mysqli_query("select title from node where nid=".$data_ext_imgnew['field_gallery_engine_fid']));
											?>
											<li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-1 jcarousel-item-1-horizontal" style="float: left; list-style: none outside none;" jcarouselindex="1">	
											<a onclick="return showMain(<?php echo $counter;?>);" title="<?php echo $sql_imgtitle['title'];?>" href="#">
												<span class="photosBucketImg"><img alt="<?php echo $sql_imgtitle['title'];?>" src="http://www.team-bhp.com/?q=sites/default/files/styles/check_medium_medium/public/<?php echo str_replace("public://","",$data_engine_imgnew['uri']);?>"></span>
											</a>
											</li>
												<?php
														$counter++;
														}
											$sql_smaller_new=@mysqli_query($q_smaller);
											while($data_smaller_imgnew=mysqli_fetch_array($sql_smaller_new))
														{
														$sql_imgtitle=mysqli_fetch_array(mysqli_query("select title from node where nid=".$data_ext_imgnew['field_gallery_exterior_fid']));
											?>
											<li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-1 jcarousel-item-1-horizontal" style="float: left; list-style: none outside none;" jcarouselindex="1">	
											<a onclick="return showMain(<?php echo $counter;?>);" title="<?php echo $sql_imgtitle['title'];?>" href="#">
												<span class="photosBucketImg"><img alt="<?php echo $sql_imgtitle['title'];?>" src="http://www.team-bhp.com/?q=sites/default/files/styles/check_medium_medium/public/<?php echo str_replace("public://","",$data_smaller_imgnew['uri']);?>"></span>
											</a>
											</li>
												<?php
														$counter++;
														}
												?>
										 </ul>
									</div>
									<div class="lessPhotos clearfix">
										<a href="#" id="showAll" class="btnLeft showAll fright marR40" style="display:none;">
											<span>Show all</span>
										</a>
									</div><!-- clearfix -->

									<ul class="clearfix photosBucket allPhotos" id="allPhotos">
									<?php
									$sql_exterior_new=@mysqli_query($q);
									$counter=0;
									while($data_ext_imgnew=mysqli_fetch_array($sql_exterior_new))
										{
										$sql_imgtitle=mysqli_fetch_array(mysqli_query("select title from node where nid=".$data_ext_imgnew['field_gallery_exterior_fid']));
									?>
										<li>
											<a href="http://www.team-bhp.com/?q=sites/default/files/styles/extra_large_for_review/public/<?php echo str_replace("public://","",$data_ext_imgnew['uri']);?>" title="<?php echo $sql_imgtitle['title'];?>" rel="lightbox[all]">
												<!--<img src="http://www.team-bhp.com/sites/default/files/<?php echo str_replace("public://","",$data_ext_imgnew['uri']);?>" alt="<?php echo $sql_imgtitle['title'];?>" width="165" height="124" />-->
												<span class="photosBucketImg"><img src="http://www.team-bhp.com/?q=sites/default/files/styles/check_medium_medium/public/<?php echo str_replace("public://","",$data_ext_imgnew['uri']);?>" alt="<?php echo $sql_imgtitle['title'];?>" width="165" height="124" /></span>
											</a>
										</li>
									<?php
										$counter++;
										}
									?>
									</ul><!-- photosBucket -->
										
									<div class="clearfix allPhotos">
									<a href="#" id="showLess" class="btnLeft showLess fright marR40">
									<span>Show less</span>
									</a>
									</div><!-- clearfix -->
								</div><!-- car over view -->
								<?php
									}
								?>
									
									<div class="clearfix articleNavi">
										<a class="fleft btnLeft" href="?q=reviews">
											<span>Back to Index</span>
										</a>
										<!--<a class="compareClose" id="compareBtn" href="#" onclick="return false;">&nbsp;</a>-->
									</div>	<!-- lcearfix -->
										<?php 
											$sql_model=@mysqli_query("SELECT node.title,node.nid, field_data_field_nr_make.field_nr_make_nid 
											FROM node,field_data_field_nr_make 	WHERE field_data_field_nr_make.entity_id = node.nid
									AND node.status =1 and node.nid=".$node->field_gallery_model['und'][0]['nid']." order by node.changed desc");
									$numberofrows=@mysqli_num_rows($sql_model);
									if($numberofrows>0)
											{
										$sql_sequenceimgmainimg=@mysqli_fetch_array(mysqli_query("SELECT distinct(field_gallery_interior_alt) as alt, field_gallery_interior_title as title, field_gallery_interior_fid as fid FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$node->field_gallery_model['und'][0]['nid']."' and field_data_field_gallery_interior.field_gallery_interior_alt!='' UNION SELECT distinct(field_gallery_exterior_alt) as alt, field_gallery_exterior_title as title, field_gallery_exterior_fid as fid FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$node->field_gallery_model['und'][0]['nid']."' and field_data_field_gallery_exterior.field_gallery_exterior_alt!='' UNION SELECT distinct(field_gallery_engine_alt) as alt, field_gallery_engine_title as title, field_gallery_engine_fid as fid FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$node->field_gallery_model['und'][0]['nid']."' and field_data_field_gallery_engine.field_gallery_engine_alt!='' UNION SELECT distinct(field_gallery_smaller_alt) as alt, field_gallery_smaller_title as title, field_gallery_smaller_fid as fid FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$node->field_gallery_model['und'][0]['nid']."' and field_data_field_gallery_smaller.field_gallery_smaller_alt!='' order by alt limit 0,1"));
											if($sql_sequenceimgmainimg=='')
												{
												$sql_sequenceimgwithoutorder=@mysqli_fetch_array(mysqli_query("SELECT field_data_field_gallery_interior.delta as delta , field_gallery_interior_title as title, field_gallery_interior_fid as fidint FROM `field_data_field_gallery_interior`,field_data_field_gallery_model WHERE field_data_field_gallery_interior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$node->field_gallery_model['und'][0]['nid']."' UNION SELECT field_data_field_gallery_exterior.delta as delta, field_gallery_exterior_title as title, field_gallery_exterior_fid as fidint FROM `field_data_field_gallery_exterior`, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$node->field_gallery_model['und'][0]['nid']."' UNION SELECT field_data_field_gallery_engine.delta as delta, field_gallery_engine_title as title, field_gallery_engine_fid as fidint FROM `field_data_field_gallery_engine`,field_data_field_gallery_model WHERE field_data_field_gallery_engine.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$node->field_gallery_model['und'][0]['nid']."' UNION SELECT field_data_field_gallery_smaller.delta as delta, field_gallery_smaller_title as title, field_gallery_smaller_fid as fidint FROM `field_data_field_gallery_smaller`,field_data_field_gallery_model WHERE field_data_field_gallery_smaller.entity_id=field_data_field_gallery_model.entity_id and field_data_field_gallery_model.field_gallery_model_nid='".$node->field_gallery_model['und'][0]['nid']."' order by delta limit 0,1"));
													if($sql_sequenceimgwithoutorder=='')
														{
														$model_modleimgname="sites/default/files/defaultmodel_46.gif";
														}
													else
														{
													$model_img=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$sql_sequenceimgwithoutorder['fidint']));
													$model_modleimgname="?q=sites/default/files/styles/check_thumb_compare_car/public/".str_replace("public://","",$model_img['uri']);
														}
												}
											else
												{
												$model_img=@mysqli_fetch_array(mysqli_query("select uri from file_managed where fid=".$sql_sequenceimgmainimg['fid']));
												$model_modleimgname="?q=sites/default/files/styles/check_thumb_compare_car/public/".str_replace("public://","",$model_img['uri']);
												}
											?>
											<div class="compareMesgInside"><p class="compareMesgPad roundAll5">You have already added that car. Please choose another car.</p></div>
											<div class="marB10 BLR5 reviewCompare" style="display:block">
												<ul class="clearfix" id="compareUL">
													<?php
													$data_model=mysqli_fetch_array($sql_model);
													$sql_url=@mysqli_fetch_array(mysqli_query("select alias from url_alias where source='node/".$data_model['nid']."'"));
													$mktitle=@mysqli_fetch_array(mysqli_query("select title from node,field_data_field_nr_make where field_data_field_nr_make.entity_id =".$data_model['nid']." and field_data_field_nr_make.field_nr_make_nid=node.nid"));
													$price_res = @mysql_fetch_assoc(mysqli_query("select min(on_road_price) as minPrice, max(on_road_price) as maxPrice from team_bhp_variant_price, field_data_field_price_nr_variant, field_data_field_variant_nr_engine, field_data_field_nr_make_model where team_bhp_variant_price.city='Delhi' and team_bhp_variant_price.nid=field_data_field_price_nr_variant.entity_id and field_data_field_price_nr_variant.field_price_nr_variant_nid=field_data_field_variant_nr_engine.entity_id and field_data_field_variant_nr_engine.field_variant_nr_engine_nid=field_data_field_nr_make_model.entity_id and field_data_field_nr_make_model.field_nr_make_model_nid=".$data_model['nid']));
													
													if($price_res['minPrice']>=100000)
													{
														$minPrice = to_lakh($price_res['minPrice']);
													}
												else
													{
														$minPrice = $price_res['minPrice'];
													}
												if($price_res['maxPrice']>=100000)
													{
														$maxPrice = to_lakh($price_res['maxPrice'])." Lakh";
													}
												else
													{
														$maxPrice = $price_res['maxPrice'];
													}

													?>
													<li class="clearfix">
														<div class="content firstContent clearfix" id="<?php echo $data_model['nid']; ?>"  rel="<?php echo str_replace("review/","",$sql_url['alias'])?>">
															<div class="img"><img src="http://www.team-bhp.com/<?php echo $model_modleimgname;?>" alt="<?php echo $data_model['title'];?>" title="<?php echo $data_model['title'];?>" /></div>
															<p class="desc">
																<span class="title"><?php echo $mktitle['title']." ".$data_model['title'];?></span>
																<?php
																if($minPrice!='' && $maxPrice!='')
																	{
																?>
																<span class="price"><?php echo $minPrice." - ".$maxPrice; ?></span>
																<?php
																	}
																?>
															</p>
														</div>
													</li>
													<?php
													include_once("includes/compare-inside.php");
													?>
												</ul><!-- clearfix -->
											</div><!-- reviewCompare -->
										<?php 
									}
										
									//$sql_modelalternative=@mysqli_query("SELECT node.title,node.nid,field_data_field_model_alternatives.field_model_alternatives_nid from node,field_data_field_model_alternatives WHERE field_data_field_model_alternatives.field_model_alternatives_nid = node.nid AND node.status =1  and field_data_field_model_alternatives.entity_id =".$node->field_gallery_model['und'][0]['nid']." order by node.changed desc");
									$sql_modelalternative=@mysqli_query("SELECT node.title AS title, node.nid AS nid, field_data_field_model_alternatives.field_model_alternatives_nid FROM node, field_data_field_model_alternatives WHERE field_data_field_model_alternatives.field_model_alternatives_nid = node.nid AND node.status =1 AND field_data_field_model_alternatives.entity_id=".$node->field_gallery_model['und'][0]['nid']." UNION SELECT node.title AS title, node.nid AS nid, field_data_field_model_alternatives.entity_id FROM node, field_data_field_model_alternatives WHERE field_data_field_model_alternatives.entity_id = node.nid AND node.status =1 AND field_data_field_model_alternatives.field_model_alternatives_nid=".$node->field_gallery_model['und'][0]['nid']." ORDER BY title");
									include("includes/alternative_forreview.php");
								 //include ("includes/cta/compare.php") 
								 ?>
								
								<?php //include ("includes/cta/reviews-alternatives.php") ?>
								
							</div><!-- overviewContainer -->
					
<?php
drupal_add_js('themes/mobilebhp/js/prototype.js');
drupal_add_js('themes/mobilebhp/js/scriptaculous.js');
drupal_add_js('themes/mobilebhp/js/lightbox.js');
?>
<link rel="stylesheet" type="text/css" href="/themes/mobilebhp/css/lightbox-slideshow.css" media="screen" />
