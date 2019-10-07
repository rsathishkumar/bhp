<?php
//echo "SELECT * FROM url_alias WHERE `source` = 'node/".$node->nid."'";
//$sql_url_alias=@mysqli_fetch_array(mysqli_query("SELECT * FROM url_alias WHERE `source` = 'node/".$node->nid."'"));
$sql_url=@mysqli_fetch_array(mysqli_query("select entity_id,field_gallery_model_nid from field_data_field_gallery_model where entity_id=".$node->nid));

$q="SELECT node.title, field_data_field_gallery_model.field_gallery_model_nid, field_data_field_gallery_exterior.field_gallery_exterior_fid, file_managed.uri FROM node, file_managed, field_data_field_gallery_exterior, field_data_field_gallery_model WHERE field_data_field_gallery_exterior.entity_id = field_data_field_gallery_model.entity_id AND file_managed.fid = field_data_field_gallery_exterior.field_gallery_exterior_fid AND field_data_field_gallery_model.field_gallery_model_nid =".$node->field_gallery_model['und'][0]['nid']." AND field_data_field_gallery_model.field_gallery_model_nid = node.nid order by field_data_field_gallery_exterior.field_gallery_exterior_fid desc";
$sql_exterior_img=@mysqli_query($q);
$num_exterior=@mysqli_num_rows($sql_exterior_img);
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

?>
	<script type="text/javascript">
	/*function showimgbycat(val)
		{
		//alert ($(this).attr("rel"));
		if(val=='Interiors')
			{
			document.getElementById("Interiors").style.display='block';
			document.getElementById("mycarousel").style.display='none';
			document.getElementById("Engine").style.display='none';
			document.getElementById("SmallerandSignificant").style.display='none';
			}
		else if(val=='Exterior')
			{
			document.getElementById("mycarousel").style.display='block';
			document.getElementById("Interiors").style.display='none';
			document.getElementById("Engine").style.display='none';
			document.getElementById("SmallerandSignificant").style.display='none';
			}
		else if(val=='Engine')
			{
			document.getElementById("Engine").style.display='block';
			document.getElementById("mycarousel").style.display='none';
			document.getElementById("Interiors").style.display='none';
			document.getElementById("SmallerandSignificant").style.display='none';
			}
		else if(val=='Smaller & Significant')
			{
			document.getElementById("SmallerandSignificant").style.display='block';
			document.getElementById("mycarousel").style.display='none';
			document.getElementById("Interiors").style.display='none';
			document.getElementById("Engine").style.display='none';
			}
		}*/
		function showimgbycat(val)	//for brands dropdown
	{
	var mid=<?php echo $node->field_gallery_model['und'][0]['nid'];?>;
	(function ($) {	
		//$("div#ajax").html('<div class="loader">&nbsp;</div>');
		$.ajax({
		   type: "POST",
		   url: "themes/bhp/show_modelgallerybycat.php",
		   cache: false,
		   data: "mid="+mid+"&action=show"+"&category="+val,
		   success: function(data){
		    //  $("#ajax").html(data);
		   }
		 });})(jQuery);
	}
		var isOn = 0
		var refreshIntervalId;
		var p;
		var pos=0;
		function mycarousel_initCallback(carousel) {
	        carousel.scroll(jQuery.jcarousel.intval(p));
	        return false;
	        jQuery('a.window').bind('click', function() {
				if(isOn==0)
				{
				var totalImages = j('#gallery a');
				p = totalImages.index(j('#gallery a.show'));
		        carousel.scroll(jQuery.jcarousel.intval(p+1));
		        carousel.startAuto(5);
		        }
		        else
		        {
		        carousel.startAuto(0);
		        }
		        j('#c').text(p+1);
		        return false;
		    });
		    jQuery('#mycarousel li').click(function(){
		    	var totalLi = j('#mycarousel li');
		    	p = totalLi.index(this);
		    	carousel.scroll(jQuery.jcarousel.intval(p+1));
		    	j('#c').text(p+1);
		    });
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
		
		var j = jQuery.noConflict();
		(function (j) {
			j(function(){
		
			j('#t').text(j('#gallery span').length);
			j('#mycarousel').jcarousel({
				scroll: 4,
				initCallback: mycarousel_initCallback
			});
			
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
				j('.allPhotos').show();
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
			
			
			j(".reviewCompare").css("display","block");
			j(".reviewCompare").addClass("roundAll5");
			j(".firstContent").css("display","block");
			j(".reviewCompare li").eq(1).find(".contentOpt").css("display","block");
			j(".reviewCompare li").eq(1).find(".n").css("display","none");
			j(".reviewCompare li").eq(1).removeClass("num");
			j(".reviewCompare li").eq(1).addClass("clearfix");
			
			//show/hide interaction
			ji = 1;
			j('option.flip').click(function(){
				if(j(this).closest('.contentOpt').find('select.marB5 option:selected').text()=='Honda')
					{
						j(this).closest('.contentOpt').hide();
						j(this).closest('.clearfix').find('.content').show();
						j(this).closest('.clearfix').next('li.num').find('.n').hide();
						j(this).closest('.clearfix').next('li.num').find('.contentOpt').show();
						j(this).closest('.clearfix').next('li.num').attr('class', 'clearfix');
					}
				if(ji>0)
				{
					j('#compare').attr('href', 'compare.php?s='+(ji+1));
				}
				ji++
			});
			
			//add car to compare
			j(".add").click(function(){
				j('.reviewCompare').css('display', 'block');
				j('div.content:hidden').eq(1).closest('li').find('.contentOpt').hide();
				j('div.content:hidden').eq(1).closest('li').attr('class', 'clearfix');
				j('div.content:hidden').eq(1).closest('li').find('.n').hide();
				j('div.content:hidden').eq(2).closest('li').find('.n').hide();
				j('div.content:hidden').eq(2).closest('li').find('.contentOpt').show();
				j('div.content:hidden').eq(2).closest('li').attr('class', 'clearfix');
				j('div.content:hidden').eq(1).show();
				j('#compareBtn').removeClass("compareOpen");
				j('#compareBtn').parent("div").removeClass("marB10");
				j('#compareBtn').addClass("compareClose");
				if(ji>0)
				{
					j('#compare').attr('href', 'compare.php?s='+(ji+1));
				}
				ji++;
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
			//alert(i);
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
	<div id="container" class="clearfix roundAll3 TwoColumn">
		<div id="leftColumn" class="clearfix fleft">
				<div class="article">
							<h1 class="padL20 marB10">Reviews</h1>
							<ul class="tab TLR5 clearfix">
								<li><a href="<?php echo url("node/".$node->field_gallery_model['und'][0]['nid']);?>" class="TLR5" title="Overview">Overview</a></li>
								<li><a href="<?php echo url("node/".$node->nid);?>" class="TLR5 active" title="Photos">Photos</a></li>
								<?php
								if($sql_urlforspecific!='')
								{
								?>
								<li><a href="?q=<?php echo $sql_urlforspecific['alias'];?>" class="TLR5" title="Specifications">Specifications</a></li>
								<?php
								}
								if($sql_urlforfeaturedata!='')
								{
								?>
								<li><a href="?q=<?php echo $sql_urlforfeaturedata['alias'];?>" class="TLR5" title="Features">Features</a></li>
								<?php
								}
								if($forum_review_alias!='')
								{
								?>
								<li><a href="?q=<?php echo $forum_review_alias['alias'];?>" class="TLR5" title="Forum Reviews">Forum Reviews</a></li>
								<?php
								}
								if($sql_urlforpricedata!='')
									{
								?>
								<li><a href="?q=<?php echo $sql_urlforpricedata['alias'];?>" class="TLR5" title="Price">Price</a></li>		
								<?php
								}
								?>
								</ul>
							
							<div class="Overview">
								<div class="carOverview BLR5 marB10">
									<div class="clearfix">
										<div class="fleft w480">
											<h1><?php echo $node->title?> <span>Photos</span></h1>
										</div>
										<?php include ("includes/common/share.php"); ?>
									</div><!-- clearfix -->
										
									<div class="clearfix photosView marT10 clearfix">
										<div class="fleft w655 photogalleryHolder clearfix">
											<?php
								 				if($num_exterior>0)
												{
												?>
											<div id="gallery">
												<?php
												$cnt=1;
												while($data_ext_img=mysqli_fetch_array($sql_exterior_img))
													{
													$sql_imgtitle=mysqli_fetch_array(mysqli_query("select title from node where nid=".$data_ext_img['field_gallery_exterior_fid']));
												?>
												<span<?php if($cnt==1) {?> class="show"<?php }?>>
													<img src="http://www.team-bhp.com/sites/default/files/<?php echo str_replace("public://","",$data_ext_img['uri']);?>" alt="<?php echo $sql_imgtitle['title'];?>" width="655" height="480" title="<?php echo $sql_imgtitle['title'];?>" />
												</span>
												<?php
														$cnt++;
													}
												?>
												
												<div class="controls clearfix">
													<a href="javascript:void(0);" class="next" onclick="galleryNext(); return false;"><b>&nbsp;</b></a>
													<a href="#" class="prev disable" onclick="galleryPrev(); return false;"><b>&nbsp;</b></a>
												</div>
												<div class="caption">
													<div class="content"></div>
												</div>
												
											</div><!-- gallery -->
										<?php
											}
										?>
											<ul class="photoShare">
												<li><a href="#" title="window" class="window">&nbsp;</a></li>
												<li><a href="#" title="facebook" class="facebook">&nbsp;</a></li>
												<li><a href="#" title="twitter" class="twitter">&nbsp;</a></li>
											</ul>
										</div><!-- photo gallery Holder -->
										
										<div class="fright w225">
											<?php include ("includes/categories.php") ?>
											
											<div class="clearfix memberPhotolink">
												<!--  <a href="#" class="fright btnRight" title="Member submited photos">
													<span>Member submited photos</span>
												</a>-->
											</div>
											<div class="marL20 marB10 clearfix">
												<a id="startShow" href="themes/bhp/images/photo/big/skoda-1.jpg" title="New-Stylish rear grill below tail lamp" rel="lightbox[skoda]" onclick="return false;">&nbsp;</a>
												<a class="hide" href="themes/bhp/images/photo/big/skoda-2.jpg" title="New-Stylish rear grill below tail lamp" rel="lightbox[skoda]">&nbsp;</a>
												<a class="hide" href="themes/bhp/images/photo/big/skoda-3.jpg" title="New-Stylish rear grill below tail lamp" rel="lightbox[skoda]">&nbsp;</a>
												<a class="hide" href="themes/bhp/images/photo/big/skoda-4.jpg" title="New-Stylish rear grill below tail lamp" rel="lightbox[skoda]">&nbsp;</a>
												<a class="hide" href="themes/bhp/images/photo/big/skoda-5.jpg" title="New-Stylish rear grill below tail lamp" rel="lightbox[skoda]">&nbsp;</a>
												<a class="hide" href="themes/bhp/images/photo/big/skoda-6.jpg" title="New-Stylish rear grill below tail lamp" rel="lightbox[skoda]">&nbsp;</a>
												<a class="hide" href="themes/bhp/images/photo/big/skoda-7.jpg" title="New-Stylish rear grill below tail lamp" rel="lightbox[skoda]">&nbsp;</a>
												<a class="hide" href="themes/bhp/images/photo/big/skoda-8.jpg" title="New-Stylish rear grill below tail lamp" rel="lightbox[skoda]">&nbsp;</a>
												<a class="hide" href="themes/bhp/images/photo/big/skoda-9.jpg" title="New-Stylish rear grill below tail lamp" rel="lightbox[skoda]">&nbsp;</a>
												<a class="hide" href="themes/bhp/images/photo/big/skoda-10.jpg" title="New-Stylish rear grill below tail lamp" rel="lightbox[skoda]">&nbsp;</a>
											</div>
											
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
													<img width="165" height="124" alt="<?php echo $sql_imgtitle['title'];?>" src="http://www.team-bhp.com/sites/default/files/<?php echo str_replace("public://","",$data_ext_imgnew['uri']);?>">
												</a>
												</li>
													<?php
															$counter++;
															}
													?>
												
										 	 </ul>
								 	
								 </div>
										<div class="lessPhotos clearfix">
										<a href="#" id="showAll" class="btnLeft showAll fright marR40">
											<span>Show all</span>
										</a>
										</div><!-- clearfix -->
									
										<div class="clearfix allPhotos"  style="display:none">
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
										<a class="compareClose" id="compareBtn" href="#" onclick="return false;">&nbsp;</a>
										<div class="compareMesg">You have already added that car. Please choose another car.</div>
									</div>	<!-- lcearfix -->
										<?php 
											$sql_model=@mysqli_query("SELECT node.title,node.nid, file_managed.uri,field_data_field_nr_make.field_nr_make_nid,field_data_field_model_dashboard.field_model_dashboard_fid
									FROM node,file_managed,field_data_field_nr_make,field_data_field_model_dashboard
									WHERE field_data_field_model_dashboard.field_model_dashboard_fid = file_managed.fid
									AND field_data_field_model_dashboard.entity_id = node.nid
									AND node.status =1 AND field_data_field_nr_make.entity_id=field_data_field_model_dashboard.entity_id and node.nid=".$node->field_gallery_model['und'][0]['nid']." order by node.changed desc");
									$numberofrows=@mysqli_num_rows($sql_model);
									if($numberofrows>0)
											{
											?>
											<div class="marB10 BLR5 reviewCompare" style="display:block">
												<ul class="clearfix" id="compareUL">
													<?php
													$data_model=mysqli_fetch_array($sql_model);
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
														<div class="content firstContent clearfix" id="<?php echo $data_model['nid']; ?>">
															<div class="img"><img src="http://www.team-bhp.com/sites/default/files/<?php echo str_replace("public://","",$data_model['uri']);?>" alt="car" width="61" height="46" /></div>
															<p class="desc">
																<span class="title"><?php echo $data_model['title'];?></span>
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
										
									$sql_modelalternative=@mysqli_query("SELECT node.title,node.nid,field_data_field_model_alternatives.field_model_alternatives_nid from node,field_data_field_model_alternatives WHERE field_data_field_model_alternatives.field_model_alternatives_nid = node.nid AND node.status =1  and field_data_field_model_alternatives.entity_id =".$node->field_gallery_model['und'][0]['nid']." order by node.changed desc");
									include("includes/alternative_forreview.php");
								 //include ("includes/cta/compare.php") 
								 ?>
								
								<?php //include ("includes/cta/reviews-alternatives.php") ?>
								
							</div><!-- overviewContainer -->
						</div><!-- articles -->
					</div><!-- Left Column -->
				</div><!-- container -->
