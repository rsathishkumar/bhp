<?php

// $Id: template.php,v 1.13 2010/12/14 01:04:27 dries Exp $

/**
 * Implements hook_process_html().
 */
function mobilebhp_process_html(&$vars) {
	// Flatten out html_attributes and body_attributes.
	$vars['html_attributes'] = drupal_attributes($vars['html_attributes_array']);
	$vars['body_attributes'] = drupal_attributes($vars['body_attributes_array']);
}
/**
 * Implements hook_html_head_alter().
 */
function mobilebhp_html_head_alter(&$head_elements) {
	// Simplify the meta charset declaration.
	$head_elements['system_meta_content_type']['#attributes'] = array(
		'charset' => 'utf-8',
	);
}

/**
 * hackish way to escape a JSON string properly
 *
 */

function bhp_helper_json_encode_string($string = null) {

	if (!$string) {
		return '';
	}

	//this returns a string enclosed in double quotes.
	$json_string = json_encode($string);

	//remove the leading double quote
	$json_string = ltrim($json_string, "\"");

	//remove the trailing double quote
	$json_string = rtrim($json_string, "\"");

	return $json_string;
}

/**
 * Get the node alias for use in the template.
 *
 */

function bhp_helper_get_current_node_alias() {
	$return = false;

	if (arg(0) == 'node' && is_numeric(arg(1))) {
		$nid = arg(1);
		$path = 'node/' . (int) $nid;
		$alias = drupal_get_path_alias($path);
	}

	if ($alias && !empty($alias)) {
		return $alias;
	}

	return $return;

}

function bhp_helper_get_category_name() {

	$catname = false;

	if (isset($_GET['catname']) && !empty($_GET['catname'])) {

		$catname = strtolower($_GET['catname']);

	}

	return $catname;

}

/**
 * Helper function to get schema markup codes
 * @param $type string Type of schema markup to return
 * @param $meta array Array to attach different metadata
 * @return string | null
 * @important DO NOT ALTER THE HEREDOC FORMAT. IT WILL BREAK THE CODE
 */

function bhp_helper_get_schema_markup($type, $meta = array()) {

	$str = null;

	if ($type === 'organization') {
		$str = <<<EOD
<script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "NewsMediaOrganization",
          "name": "Team-BHP",
          "url": "https://www.team-bhp.com/",
          "logo": "https://www.team-bhp.com/themes/bhp/images/team-bhp-logo-190x60.png",
          "sameAs": [
            "https://www.facebook.com/teambhp/",
            "https://twitter.com/teambhpforum",
            "https://www.youtube.com/teamBHPChannel"
          ]
        }
        </script>
EOD;

	}

	if ($type === 'siteNav') {

		$str = <<<EOD
<!-- sitenav element -->
<script type="application/ld+json">
{
    "@context": "https://schema.org/",
    "@type": "SiteNavigationElement",
        "description":"The Definitive Indian Car Website",
        "image":"https://www.team-bhp.com/themes/bhp/images/team-bhp-logo-190x60.png"
}
</script>
EOD;

	}

//template for news articles

	if ($type === 'newsArticleTemplate') {

		$str = <<<EOD
<!-- newsArticle element -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "NewsArticle",
  "headline": "__##headline##__",
  "datePublished": "__##published##__",
  "author":  "__##author##__",
  "image": {
    "@type": "ImageObject",
    "url": "__##imageurl##__"
  },
  "mainEntityOfPage": {
         "@type": "WebPage",
         "@id": "https://www.team-bhp.com/"
  },
  "publisher": {
        "@type": "Organization",
      "name": "Team-BHP",
        "logo": {
            "@type": "ImageObject",
            "url": "https://www.team-bhp.com/themes/bhp/images/team-bhp-logo-190x60.png",
            "width": "255",
            "height": "60"
        }
  }
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": "1",
      "item": {
        "@id": "https://www.team-bhp.com",
        "name": "Team-BHP.com",
        "image": "https://www.team-bhp.com/themes/bhp/images/team-bhp-logo-190x60.png"
      }
    },
    {
      "@type": "ListItem",
      "position": "2",
      "item": {
        "@id": "https://www.team-bhp.com/news",
        "name": "News",
        "image": "https://www.team-bhp.com/themes/bhp/images/team-bhp-logo-190x60.png"
      }
    },
    {
      "@type": "ListItem",
      "position": "3",
      "item": {
        "@id": "__##link##__",
        "name": "__##headline##__",
        "image": "__##imageurl##__"
      }
    }
  ]
}
</script>
EOD;

	}

//markup for news articles using newsArticleTemplate

	if ($type === 'newsArticle') {
		//fetch the template
		$news_article_template = bhp_helper_get_schema_markup($type = 'newsArticleTemplate');
		//fetch the content
		$news_content = bhp_helper_node_get_details($meta['nid'], $type = 'news');

		//fill in the content
		$str = str_replace("__##headline##__", bhp_helper_json_encode_string($news_content->title), $news_article_template);
		$str = str_replace("__##imageurl##__", $news_content->image, $str);
		$str = str_replace("__##link##__", $news_content->link, $str);
		$str = str_replace("__##author##__", bhp_helper_json_encode_string($news_content->author), $str);
		$str = str_replace("__##published##__", $news_content->published, $str);

	}

//markup for news listing pages

	if ($type === 'newsArticleIndex') {

		$str = <<<EOD
<!-- breadCrumbList element -->

<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": "1",
      "item": {
        "@id": "https://www.team-bhp.com",
        "name": "Team-BHP.com",
        "image": "https://www.team-bhp.com/themes/bhp/images/team-bhp-logo-190x60.png"
      }
    },
    {
      "@type": "ListItem",
      "position": "2",
      "item": {
        "@id": "https://www.team-bhp.com/news",
        "name": "News",
        "image": "https://www.team-bhp.com/themes/bhp/images/team-bhp-logo-190x60.png"
      }
    }
  ]
}
</script>
EOD;

	}

/* advice article markup template for single advice */

	if ($type === 'adviceArticleTemplate') {

		$str = <<<EOD
<!-- Article element -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "__##headline##__",
  "datePublished": "__##published##__",
  "author":  "Team-BHP",
  "image": {
    "@type": "ImageObject",
    "url": "__##imageurl##__"
  },
  "mainEntityOfPage": {
         "@type": "WebPage",
         "@id": "https://www.team-bhp.com/"
  },
  "publisher": {
        "@type": "Organization",
      "name": "Team-BHP",
        "logo": {
            "@type": "ImageObject",
            "url": "https://www.team-bhp.com/themes/bhp/images/team-bhp-logo-190x60.png",
            "width": "255",
            "height": "60"
        }
  }
}
</script>


<!-- breadcrumb element -->

<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": "1",
      "item": {
        "@id": "https://www.team-bhp.com",
        "name": "Team-BHP.com",
        "image": "https://www.team-bhp.com/themes/bhp/images/team-bhp-logo-190x60.png"
      }
    },
    {
      "@type": "ListItem",
      "position": "2",
      "item": {
        "@id": "https://www.team-bhp.com/advice",
        "name": "Advice",
        "image": "https://www.team-bhp.com/themes/bhp/images/team-bhp-logo-190x60.png"
      }
    },
    {
      "@type": "ListItem",
      "position": "3",
      "item": {
        "@id": "__##link##__",
        "name": "__##headline##__",
        "image": "__##imageurl##__"
      }
    }
  ]
}
</script>

EOD;

	}

	/* advice article markup for single advice */

	if ($type === 'adviceArticle') {
		//fetch the template
		$news_article_template = bhp_helper_get_schema_markup($type = 'adviceArticleTemplate');
		//fetch the content
		$news_content = bhp_helper_node_get_details($meta['nid'], $type = 'advice');
		//fill in the content
		$str = str_replace("__##headline##__", bhp_helper_json_encode_string($news_content->title), $news_article_template);
		$str = str_replace("__##imageurl##__", $news_content->image, $str);
		$str = str_replace("__##link##__", $news_content->link, $str);
		$str = str_replace("__##author##__", bhp_helper_json_encode_string($news_content->author), $str);
		$str = str_replace("__##published##__", $news_content->published, $str);

	}

//markup for advice listing pages

	if ($type === 'adviceArticleIndex') {

		$str = <<<EOD
<!-- breadCrumbList element -->

<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": "1",
      "item": {
        "@id": "https://www.team-bhp.com",
        "name": "Team-BHP.com",
        "image": "https://www.team-bhp.com/themes/bhp/images/team-bhp-logo-190x60.png"
      }
    },
    {
      "@type": "ListItem",
      "position": "2",
      "item": {
        "@id": "https://www.team-bhp.com/advice",
        "name": "Advice",
        "image": "https://www.team-bhp.com/themes/bhp/images/team-bhp-logo-190x60.png"
      }
    }
  ]
}
</script>
EOD;

	}

/* safety article markup template for single item */

	if ($type === 'safetyArticleTemplate') {

		$str = <<<EOD

<!-- Article element -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "__##headline##__",
  "datePublished": "__##published##__",
  "author":  "Team-BHP",
  "image": {
    "@type": "ImageObject",
    "url": "__##imageurl##__"
  },
  "mainEntityOfPage": {
         "@type": "WebPage",
         "@id": "https://www.team-bhp.com/"
  },
  "publisher": {
        "@type": "Organization",
      "name": "Team-BHP",
        "logo": {
            "@type": "ImageObject",
            "url": "https://www.team-bhp.com/themes/bhp/images/team-bhp-logo-190x60.png",
            "width": "255",
            "height": "60"
        }
  }
}
</script>

<!-- breadcrumb element -->

<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": "1",
      "item": {
        "@id": "https://www.team-bhp.com",
        "name": "Team-BHP.com",
        "image": "https://www.team-bhp.com/themes/bhp/images/team-bhp-logo-190x60.png"
      }
    },
    {
      "@type": "ListItem",
      "position": "2",
      "item": {
        "@id": "https://www.team-bhp.com/safety",
        "name": "Road Safety",
        "image": "https://www.team-bhp.com/themes/bhp/images/team-bhp-logo-190x60.png"
      }
    },
    {
      "@type": "ListItem",
      "position": "3",
      "item": {
        "@id": "__##link##__",
        "name": "__##headline##__",
        "image": "__##imageurl##__"
      }
    }
  ]
}
</script>

EOD;

	}

	/* advice article markup for single advice */

	if ($type === 'safetyArticle') {
		//fetch the template
		$article_template = bhp_helper_get_schema_markup($type = 'safetyArticleTemplate');
		//fetch the content
		$node_content = bhp_helper_node_get_details($meta['nid'], $type = 'safety');
		//fill in the content
		$str = str_replace("__##headline##__", bhp_helper_json_encode_string($node_content->title), $article_template);
		$str = str_replace("__##imageurl##__", $node_content->image, $str);
		$str = str_replace("__##link##__", $node_content->link, $str);
		$str = str_replace("__##author##__", bhp_helper_json_encode_string($node_content->author), $str);
		$str = str_replace("__##published##__", $node_content->published, $str);

	}

	if ($type === 'safetyArticleIndex') {

		$str = <<<EOD
<!-- breadCrumbList element -->

<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": "1",
      "item": {
        "@id": "https://www.team-bhp.com",
        "name": "Team-BHP.com",
        "image": "https://www.team-bhp.com/themes/bhp/images/team-bhp-logo-190x60.png"
      }
    },
    {
      "@type": "ListItem",
      "position": "2",
      "item": {
        "@id": "https://www.team-bhp.com/safety",
        "name": "Safety",
        "image": "https://www.team-bhp.com/themes/bhp/images/team-bhp-logo-190x60.png"
      }
    }
  ]
}
</script>
EOD;

	}

/* tech stuff article markup template for single item */

	if ($type === 'techStuffArticleTemplate') {

		$str = <<<EOD

<!-- Article element -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "__##headline##__",
  "datePublished": "__##published##__",
  "author":  "Team-BHP",
  "image": {
    "@type": "ImageObject",
    "url": "__##imageurl##__"
  },
  "mainEntityOfPage": {
         "@type": "WebPage",
         "@id": "https://www.team-bhp.com/"
  },
  "publisher": {
        "@type": "Organization",
      "name": "Team-BHP",
        "logo": {
            "@type": "ImageObject",
            "url": "https://www.team-bhp.com/themes/bhp/images/team-bhp-logo-190x60.png",
            "width": "255",
            "height": "60"
        }
  }
}
</script>

<!-- breadcrumb element -->

<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": "1",
      "item": {
        "@id": "https://www.team-bhp.com",
        "name": "Team-BHP.com",
        "image": "https://www.team-bhp.com/themes/bhp/images/team-bhp-logo-190x60.png"
      }
    },
    {
      "@type": "ListItem",
      "position": "2",
      "item": {
        "@id": "https://www.team-bhp.com/tech-stuff",
        "name": "Technical Stuff",
        "image": "https://www.team-bhp.com/themes/bhp/images/team-bhp-logo-190x60.png"
      }
    },
    {
      "@type": "ListItem",
      "position": "3",
      "item": {
        "@id": "__##link##__",
        "name": "__##headline##__",
        "image": "__##imageurl##__"
      }
    }
  ]
}
</script>

EOD;

	}

	/* article markup for single tech stuff post */

	if ($type === 'techStuffArticle') {
		//fetch the template
		$article_template = bhp_helper_get_schema_markup($type = 'techStuffArticleTemplate');
		//fetch the content
		$node_content = bhp_helper_node_get_details($meta['nid'], $type = 'tech_stuff');
		//fill in the content
		$str = str_replace("__##headline##__", bhp_helper_json_encode_string($node_content->title), $article_template);
		$str = str_replace("__##imageurl##__", $node_content->image, $str);
		$str = str_replace("__##link##__", $node_content->link, $str);
		$str = str_replace("__##author##__", bhp_helper_json_encode_string($node_content->author), $str);
		$str = str_replace("__##published##__", $node_content->published, $str);

	}

	if ($type === 'techStuffArticleIndex') {

		$str = <<<EOD
<!-- breadCrumbList element -->

<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": "1",
      "item": {
        "@id": "https://www.team-bhp.com",
        "name": "Team-BHP.com",
        "image": "https://www.team-bhp.com/themes/bhp/images/team-bhp-logo-190x60.png"
      }
    },
    {
      "@type": "ListItem",
      "position": "2",
      "item": {
        "@id": "https://www.team-bhp.com/tech-stuff",
        "name": "Tech Stuff",
        "image": "https://www.team-bhp.com/themes/bhp/images/team-bhp-logo-190x60.png"
      }
    }
  ]
}
</script>
EOD;

	}

	return $str;

}

/**
 * Helper function that returns the node type
 * @return boolean | false
 */

function bhp_helper_get_node_type() {

	$return = false;

	if (arg(0) == 'node' && is_numeric(arg(1))) {
		$nid = arg(1);
		$node = node_load($nid);
	}

	if (isset($node->type) && !empty($node->type)) {

		return $node->type;
	}

	return $return;

}

/**
 * Helper function that returns true if node type is news
 * @param $type string Type of schema markup to return
 * @return string | null
 */

function bhp_helper_node_type_is_news() {

	$return = false;

	if (arg(0) == 'node' && is_numeric(arg(1))) {
		$nid = arg(1);
		$node = node_load($nid);
		$type = $node->type;
	}

	if ($type === 'news') {
		return $nid;
	}

	return $return;

}

/**
 * Helper function that returns true if node type is advice
 * @return boolean | false
 */

function bhp_helper_node_type_is_advice() {

	$return = false;

	if (arg(0) == 'node' && is_numeric(arg(1))) {
		$nid = arg(1);
		$node = node_load($nid);
		$type = $node->type;
	}

	if ($type === 'advice') {
		return $nid;
	}

	return $return;

}

/**
 * Helper function that returns true if node type is safety
 * @return boolean | false
 */

function bhp_helper_node_type_is_safety() {

	$return = false;

	if (arg(0) == 'node' && is_numeric(arg(1))) {
		$nid = arg(1);
		$node = node_load($nid);
		$type = $node->type;
	}

	if ($type === 'safety') {
		return $nid;
	}

	return $return;

}

/**
 * Helper function that returns true if node type is tech stuff
 * @return boolean | false
 */

function bhp_helper_node_type_is_tech_stuff() {

	$return = false;

	if (arg(0) == 'node' && is_numeric(arg(1))) {
		$nid = arg(1);
		$node = node_load($nid);
		$type = $node->type;
	}

	if ($type === 'tech_stuff') {
		return $nid;
	}

	return $return;

}

/**
 * Helper function that returns a node's full URL. If it can't find a valid nid, the current node's URL is returned.
 * @return string | false
 */

function bhp_helper_get_node_full_url($nid = null) {

	return $GLOBALS['base_url'] . base_path() . bhp_helper_get_current_node_alias();

	//return url("node/$nid");
}

/**
 * Helper function that returns a node's details
 * @return object | null
 */

function bhp_helper_node_get_details($nid, $type) {

	$return = null;

	$type = strtolower($type);

	$node = node_load($nid);

	$node_type = null;

	if (!$node) {

		return null;

	}

	if ($node && isset($node->type)) {

		$node_type = $node->type;

	}

	if ($node_type != $type) {

		return false;
	}

	if ($type === 'news') {
		$return = new stdClass;

		$return->title = $node->title;
		$return->link = bhp_helper_get_node_full_url($nid);
		$return->author = $node->name;
		$return->published = date('c', $node->created);

		/* start the SQL dance to get the image URL */
		$sql_img_checkintern = @mysqli_fetch_array(mysqli_query("select field_news_media_type_value from field_data_field_news_media_type where entity_id =" . $nid));

		if ($sql_img_checkintern['field_news_media_type_value'] == 'Images') {
			$img_resinter = @mysqli_query("select field_news_images_fid, uri from field_data_field_news_images, file_managed where field_data_field_news_images.field_news_images_fid=file_managed.fid  and field_data_field_news_images.entity_id=" . $nid);
			$img_newsintern = mysqli_fetch_array($img_resinter);
		} else {
			$img_resinter = @mysqli_query("select field_news_list_image_fid, uri from field_data_field_news_list_image, file_managed where field_data_field_news_list_image.field_news_list_image_fid=file_managed.fid  and field_data_field_news_list_image.entity_id=" . $nid);
			$img_newsintern = mysqli_fetch_array($img_resinter);
		}

		/* SQL dance ends*/

		/*format the URL correctly */
		$img_file = str_replace("public://", "", $img_newsintern['uri']);

		//$return->image = 'https://www.team-bhp.com/?q=sites/default/files/styles/check_medium_medium/public/DS1_47073.JPG';
		//$return->image = $img_file;
		$img_file_path = "https://www.team-bhp.com/sites/default/files/styles/check_large_review/public/$img_file";
		$return->image = $img_file_path;
	}

	if ($type === 'advice') {
		$return = new stdClass;

		$return->title = $node->title;
		$return->link = bhp_helper_get_node_full_url($nid);
		$return->author = $node->name;
		$return->published = date('c', $node->created);
		/* start the SQL dance to get the image URL */
		$sql_img_checkintern = @mysqli_fetch_array(mysqli_query("select field_advice_media_type_value from field_data_field_advice_media_type where entity_id =" . $nid));

		if ($sql_img_checkintern['field_advice_media_type_value'] == 'Image') {
			$img_resinter = @mysqli_query("select field_advice_images_fid, uri from field_data_field_advice_images, file_managed where field_data_field_advice_images.field_advice_images_fid=file_managed.fid  and field_data_field_advice_images.entity_id=" . $nid);
			$img_newsintern = mysqli_fetch_array($img_resinter);
		} else {
			$img_resinter = @mysqli_query("select field_advice_list_image_fid, uri from field_data_field_advice_list_image, file_managed where field_data_field_advice_list_image.field_advice_list_image_fid=file_managed.fid  and field_data_field_advice_list_image.entity_id=" . $nid);
			$img_newsintern = mysqli_fetch_array($img_resinter);
		}

		/* SQL dance ends*/

		/*format the URL correctly */
		$img_file = str_replace("public://", "", $img_newsintern['uri']);
		$img_file_path = "https://www.team-bhp.com/sites/default/files/styles/check_tech_stuff_hover/public/$img_file";
		$return->image = $img_file_path;
	}

	if ($type === 'safety') {
		$return = new stdClass;

		$return->title = $node->title;
		$return->link = bhp_helper_get_node_full_url($nid);
		$return->author = $node->name;
		$return->published = date('c', $node->created);

		/* start the SQL dance to get the image URL */
		$img_resinter = @mysqli_query("select file_managed.uri from file_managed,field_data_field_safety_image where file_managed.fid=field_data_field_safety_image.field_safety_image_fid and field_data_field_safety_image.entity_id=$nid");
		$img_newsintern = mysqli_fetch_array($img_resinter);

		/* SQL dance ends*/

		/*format the URL correctly */
		$img_file = str_replace("public://", "", $img_newsintern['uri']);
		$img_file_path = "https://www.team-bhp.com/sites/default/files/styles/check_tech_stuff_hover/public/$img_file";
		$return->image = $img_file_path;
	}

	if ($type === 'tech_stuff') {
		$return = new stdClass;

		$return->title = $node->title;
		$return->link = bhp_helper_get_node_full_url($nid);
		$return->author = $node->name;
		$return->published = date('c', $node->created);

		/* start the SQL dance to get the image URL */
		$img_resinter = @mysqli_query("select file_managed.uri from file_managed,field_data_field_tech_stuff_image where file_managed.fid=field_data_field_tech_stuff_image.field_tech_stuff_image_fid and field_data_field_tech_stuff_image.entity_id=$nid");
		$img_newsintern = mysqli_fetch_array($img_resinter);
		//var_export($img_newsintern);

		/* SQL dance ends*/

		/*format the URL correctly */
		$img_file = str_replace("public://", "", $img_newsintern['uri']);
		$img_file_path = "https://www.team-bhp.com/sites/default/files/styles/check_tech_stuff_hover/public/$img_file";
		$return->image = $img_file_path;
	}

	return $return;

}

/**
 * Implements hook_preprocess_html().
 */

function mobilebhp_preprocess_html(&$vars) {
	$vars['html_attributes_array'] = array();
	$vars['body_attributes_array'] = array();
	// HTML element attributes.
	$vars['html_attributes_array']['lang'] = $vars['language']->language;
	$vars['html_attributes_array']['dir'] = $vars['language']->dir;

	// BODY element attributes.
	$vars['body_attributes_array']['class'] = $vars['classes_array'];
	$vars['body_attributes_array'] += $vars['attributes_array'];
	$vars['attributes_array'] = '';

	if (arg(0) == 'node' && is_numeric(arg(1))) {
		$nid = arg(1);
		$path = 'node/' . (int) $nid;
		$alias = drupal_get_path_alias($path);
	}

	//Add custom page title and description for mobile reviews page
	if ($alias === 'team-bhp-reviews') {

		//custom title
		$vars['head_title'] = 'Car & Bike Reviews - Latest User Reviews & Expert Opinions | Team-BHP';

		//custom description
		/*$description = array(
			'#tag' => 'meta',
			'#attributes' => array(
				'name' => 'description',
				'content' => 'Read detailed reviews of cars and bikes. Find ✓Pricing ✓Pictures ✓Features ✓Specifications ✓Fuel Economy ✓Performance of cars. Check out the latest ownership reviews and service costs by car & bike enthusiasts right here!',
			),
		);

		drupal_add_html_head($description, 'description');*/

		//description is added via templates/page.tpl.php

	}

	//get the node alias so that we can set the correct page titles

	$alias = bhp_helper_get_current_node_alias();

	$node_is_news = bhp_helper_node_type_is_news();

	$node_is_advice = bhp_helper_node_type_is_advice();

	$node_is_safety = bhp_helper_node_type_is_safety();

	$node_is_tech_stuff = bhp_helper_node_type_is_tech_stuff();

	$node_type = bhp_helper_get_node_type();

	$category = bhp_helper_get_category_name();

	if ($node_is_news) {

		//$newsarticle_schema = bhp_helper_get_schema_markup($type = 'newsarticleTemplate');
		//$newsarticle_schema = bhp_helper_node_get_details($node_is_news, $type = 'news');
		$newsarticle_schema = bhp_helper_get_schema_markup($type = 'newsArticle', $meta = array('nid' => $node_is_news));

		$vars['page']['page_top'][] = array(
			'debug_text' => array('#markup' => '<!-- node is news -->'),
			'newsarticle_schema' => array('#markup' => $newsarticle_schema),
		);

	}

	//add advice schema on advice items

	if ($node_is_advice) {

		$newsarticle_schema = bhp_helper_get_schema_markup($type = 'adviceArticle', $meta = array('nid' => $node_is_advice));

		$vars['page']['page_top'][] = array(
			'debug_text' => array('#markup' => '<!-- node is advice -->'),
			'newsarticle_schema' => array('#markup' => $newsarticle_schema),
		);

	}

	//add safety schema on safety items

	if ($node_is_safety) {

		$newsarticle_schema = bhp_helper_get_schema_markup($type = 'safetyArticle', $meta = array('nid' => $node_is_safety));

		$vars['page']['page_top'][] = array(
			'debug_text' => array('#markup' => '<!-- node is safety -->'),
			'newsarticle_schema' => array('#markup' => $newsarticle_schema),
		);

	}

	if ($node_is_tech_stuff) {

		$newsarticle_schema = bhp_helper_get_schema_markup($type = 'techStuffArticle', $meta = array('nid' => $node_is_tech_stuff));

		$vars['page']['page_top'][] = array(
			'debug_text' => array('#markup' => '<!-- node is tech stuff -->'),
			'newsarticle_schema' => array('#markup' => $newsarticle_schema),
		);

	}

	if (drupal_is_front_page()) {
		//add org schema/sitenav schema on front page
		$org_schema = bhp_helper_get_schema_markup($type = 'organization');
		$sitenav_schema = bhp_helper_get_schema_markup($type = 'siteNav');
		//$vars['page']['page_top'][] = array('org_schema' => array('#markup' => $org_schema), 'sitenav_schema' => array('#markup' => $sitenav_schema));
		$vars['page']['page_top'][] = array('org_schema' => array('#markup' => $org_schema)); //sitenav is now used as RDF markup in the navigation template itself.
	}

	//process news listing page
	if ($alias === 'news') {

		//custom title
		$vars['head_title'] = 'Latest Car & Bike News - Upcoming launch dates in India | Team-BHP';

		//custom description
		/*$description = array(
			'#tag' => 'meta',
			'#attributes' => array(
				'name' => 'description',
				'content' => 'Your one stop guide to the latest trends in the Indian car and bike industry. Check ✓News ✓Launch dates ✓Prices ✓Pictures ✓Sales figures ✓Market analysis about newly launched Indian cars and bikes. Latest updates on new car and bike launches.',
			),
		);

		drupal_add_html_head($description, 'description');*/

		//description is added via templates/page.tpl.php

		/*add the breadcrumbs schema*/
		$listing_page_schema = bhp_helper_get_schema_markup($type = 'newsArticleIndex');

		$vars['page']['page_top'][] = array(
			'debug_text' => array('#markup' => '<!-- news article index -->'),
			'listing_page_schema' => array('#markup' => $listing_page_schema),
		);

	}

	//process advice listing page
	if ($alias === 'advice') {

		//custom title
		$vars['head_title'] = 'Advice on Buying, Owning & Modifying your Car - Expert Tips | Team-BHP';

		//custom description
		/*$description = array(
			'#tag' => 'meta',
			'#attributes' => array(
				'name' => 'description',
				'content' => 'List of things to check before taking delivery of your new car. Find your car\'s real manufacturing date by decoding the VIN. Tips on how to safely run-in your new car. How to drive for the best fuel economy. Keeping your car safe from theft.',
			),
		);

		drupal_add_html_head($description, 'description');*/

		//description is added via templates/page.tpl.php

		/*add the breadcrumbs schema*/
		$listing_page_schema = bhp_helper_get_schema_markup($type = 'adviceArticleIndex');

		$vars['page']['page_top'][] = array(
			'debug_text' => array('#markup' => '<!-- advice article index -->'),
			'listing_page_schema' => array('#markup' => $listing_page_schema),
		);

	}

	//process advice listing page
	if ($alias === 'safety') {

		/*add the breadcrumbs schema*/
		$listing_page_schema = bhp_helper_get_schema_markup($type = 'safetyArticleIndex');

		$vars['page']['page_top'][] = array(
			'debug_text' => array('#markup' => '<!-- advice article index -->'),
			'listing_page_schema' => array('#markup' => $listing_page_schema),
		);

	}

	//process advice listing page
	if ($alias === 'tech-stuff') {

		/*add the breadcrumbs schema*/
		$listing_page_schema = bhp_helper_get_schema_markup($type = 'techStuffArticleIndex');

		$vars['page']['page_top'][] = array(
			'debug_text' => array('#markup' => '<!-- advice article index -->'),
			'listing_page_schema' => array('#markup' => $listing_page_schema),
		);

	}

	//process hot threads listing page
	if ($alias === 'hot-threads') {

		if ($category === 'travelogues') {

			//custom title
			$vars['head_title'] = 'Travelogues - Guide to Best Roadtrips & Bike Rides in India | Team-BHP';

		} else {

			//custom title
			$vars['head_title'] = 'Hot Threads - Popular discussions on Cars & Bikes in India | Team-BHP';

		}

		//custom description
		/*$description = array(
			'#tag' => 'meta',
			'#attributes' => array(
				'name' => 'description',
				'content' => 'Find the most unbiased and informative updates about Cars & Bikes in India. Discussions including everything from ✓Reviews ✓Prices ✓Launch Dates ✓Scoops ✓Features and detailed analysis of all the new cars & bikes. All available only right here!',
			),
		);

		drupal_add_html_head($description, 'description');*/

		//description is added via templates/page.tpl.php

	}

}

/*

Replace all occurrence of all http:// with https:// (mobile version)

 */
/*

function mobilebhp_replace_http_strings($string)
{
if (stristr($string, 'http://'))
{

return str_replace('http://', 'https://', $string);
}

return $string;
}
 */

/*

Replace all occurrence of all https:// with https://

 */

function bhp_replace_http_strings($string) {
	if (stristr($string, 'http://')) {

		return str_replace('http://', 'https://', $string);
	}

	return $string;
}
