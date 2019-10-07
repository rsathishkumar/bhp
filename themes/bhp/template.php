<?php
// $Id: template.php,v 1.13 2010/12/14 01:04:27 dries Exp $

/**
 * Add body classes if certain regions have content.
 */
function bartik_preprocess_html(&$variables) {
	if (!empty($variables['page']['featured'])) {
		$variables['classes_array'][] = 'featured';
	}

	if (!empty($variables['page']['triptych_first'])
		|| !empty($variables['page']['triptych_middle'])
		|| !empty($variables['page']['triptych_last'])) {
		$variables['classes_array'][] = 'triptych';
	}

	if (!empty($variables['page']['footer_firstcolumn'])
		|| !empty($variables['page']['footer_secondcolumn'])
		|| !empty($variables['page']['footer_thirdcolumn'])
		|| !empty($variables['page']['footer_fourthcolumn'])) {
		$variables['classes_array'][] = 'footer-columns';
	}

	// Add conditional stylesheets for IE
	drupal_add_css(path_to_theme() . '/css/ie.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'lte IE 7', '!IE' => FALSE), 'preprocess' => FALSE));
	drupal_add_css(path_to_theme() . '/css/ie6.css', array('group' => CSS_THEME, 'browsers' => array('IE' => 'IE 6', '!IE' => FALSE), 'preprocess' => FALSE));
}
/**
 * Override or insert variables into the page template for HTML output.
 */
function bartik_process_html(&$variables) {
	// Hook into color.module.
	if (module_exists('color')) {
		_color_html_alter($variables);
	}
}

/**
 * Override or insert variables into the page template.
 */
function bartik_process_page(&$variables) {
	// Hook into color.module.
	if (module_exists('color')) {
		_color_page_alter($variables);
	}
	// Always print the site name and slogan, but if they are toggled off, we'll
	// just hide them visually.
	$variables['hide_site_name'] = theme_get_setting('toggle_name') ? FALSE : TRUE;
	$variables['hide_site_slogan'] = theme_get_setting('toggle_slogan') ? FALSE : TRUE;
	if ($variables['hide_site_name']) {
		// If toggle_name is FALSE, the site_name will be empty, so we rebuild it.
		$variables['site_name'] = filter_xss_admin(variable_get('site_name', 'Drupal'));
	}
	if ($variables['hide_site_slogan']) {
		// If toggle_site_slogan is FALSE, the site_slogan will be empty, so we rebuild it.
		$variables['site_slogan'] = filter_xss_admin(variable_get('site_slogan', ''));
	}
	// Since the title and the shortcut link are both block level elements,
	// positioning them next to each other is much simpler with a wrapper div.
	if (!empty($variables['title_suffix']['add_or_remove_shortcut']) && $variables['title']) {
		// Add a wrapper div using the title_prefix and title_suffix render elements.
		$variables['title_prefix']['shortcut_wrapper'] = array(
			'#markup' => '<div class="shortcut-wrapper clearfix">',
			'#weight' => 100,
		);
		$variables['title_suffix']['shortcut_wrapper'] = array(
			'#markup' => '</div>',
			'#weight' => -99,
		);
		// Make sure the shortcut link is the first item in title_suffix.
		$variables['title_suffix']['add_or_remove_shortcut']['#weight'] = -100;
	}
}

/**
 * Implements hook_preprocess_maintenance_page().
 */
function bartik_preprocess_maintenance_page(&$variables) {
	if (!$variables['db_is_active']) {
		unset($variables['site_name']);
	}
	drupal_add_css(drupal_get_path('theme', 'bhp') . '/css/maintenance-page.css');
}

/**
 * Override or insert variables into the maintenance page template.
 */
function bartik_process_maintenance_page(&$variables) {
	// Always print the site name and slogan, but if they are toggled off, we'll
	// just hide them visually.
	$variables['hide_site_name'] = theme_get_setting('toggle_name') ? FALSE : TRUE;
	$variables['hide_site_slogan'] = theme_get_setting('toggle_slogan') ? FALSE : TRUE;
	if ($variables['hide_site_name']) {
		// If toggle_name is FALSE, the site_name will be empty, so we rebuild it.
		$variables['site_name'] = filter_xss_admin(variable_get('site_name', 'Drupal'));
	}
	if ($variables['hide_site_slogan']) {
		// If toggle_site_slogan is FALSE, the site_slogan will be empty, so we rebuild it.
		$variables['site_slogan'] = filter_xss_admin(variable_get('site_slogan', ''));
	}
}

/**
 * Override or insert variables into the node template.
 */
function bartik_preprocess_node(&$variables) {
	$variables['submitted'] = t('published by !username on !datetime', array('!username' => $variables['name'], '!datetime' => $variables['date']));
	if ($variables['view_mode'] == 'full' && node_is_page($variables['node'])) {
		$variables['classes_array'][] = 'node-full';
	}
}

// function created as on 16-03-2012
/* function bhp_preprocess_page(&$vars) {
if (isset($vars['node']->type))
{
if (isset($_GET['modelname']))
{
$sqlqryformodelfreview="SELECT nid FROM field_data_field_forum_model, node
WHERE node.nid = field_data_field_forum_model.field_forum_model_nid
AND node.title LIKE '%".str_replace("-"," ",$_GET['modelname'])."%'";

$res_formodelfreview=@mysqli_query($sqlqryformodelfreview);
$noformodelfreview=@mysqli_num_rows($res_formodelfreview);
if($noformodelfreview==0)
{
// drupal_goto('page-not-found');
}
}
}
} */// end of function

/**
 * Override or insert variables into the block template.
 */
function bartik_preprocess_block(&$variables) {
	// In the header region visually hide block titles.
	if ($variables['block']->region == 'header') {
		$variables['title_attributes_array']['class'][] = 'element-invisible';
	}
}

/**
 * Implements theme_menu_tree().
 */
function bartik_menu_tree($variables) {
	return '<ul class="menu clearfix">' . $variables['tree'] . '</ul>';
}

/**
 * Implements theme_field__field_type().
 */
function bartik_field__taxonomy_term_reference($variables) {
	$output = '';

	// Render the label, if it's not hidden.
	if (!$variables['label_hidden']) {
		$output .= '<h3 class="field-label">' . $variables['label'] . ': </h3>';
	}

	// Render the items.
	$output .= ($variables['element']['#label_display'] == 'inline') ? '<ul class="links inline">' : '<ul class="links">';
	foreach ($variables['items'] as $delta => $item) {
		$output .= '<li class="taxonomy-term-reference-' . $delta . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</li>';
	}
	$output .= '</ul>';

	// Render the top-level DIV.
	$output = '<div class="' . $variables['classes'] . (!in_array('clearfix', $variables['classes_array']) ? ' clearfix' : '') . '">' . $output . '</div>';

	return $output;
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
 * Get the category name from the catname query string value
 *
 */

function bhp_helper_get_category_name() {

	$catname = false;

	if (isset($_GET['catname']) && !empty($_GET['catname'])) {

		$catname = strtolower($_GET['catname']);

	}

	return $catname;

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
 * Preprocesses the wrapping HTML.
 *
 * @param array &$variables
 * Template variables.
 */
function bhp_preprocess_html(&$vars) {

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
		$description = array(
			'#tag' => 'meta',
			'#attributes' => array(
				'name' => 'description',
				'content' => 'Your one stop guide to the latest trends in the Indian car and bike industry. Check ✓News ✓Launch dates ✓Prices ✓Pictures ✓Sales figures ✓Market analysis about newly launched Indian cars and bikes. Latest updates on new car and bike launches.',
			),
		);

		drupal_add_html_head($description, 'description');

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
		$description = array(
			'#tag' => 'meta',
			'#attributes' => array(
				'name' => 'description',
				'content' => 'List of things to check before taking delivery of your new car. Find your car\'s real manufacturing date by decoding the VIN. Tips on how to safely run-in your new car. How to drive for the best fuel economy. Keeping your car safe from theft.',
			),
		);

		drupal_add_html_head($description, 'description');

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

			//custom description
			$description = array(
				'#tag' => 'meta',
				'#attributes' => array(
					'name' => 'description',
					'content' => 'Read the adventurous travel stories by BHPians and know their first-hand experience on these car & bike trips in their travelogues. Find the best locations to travel to within India.',
				),
			);

			drupal_add_html_head($description, 'description');

		} else {

			//custom title
			$vars['head_title'] = 'Hot Threads - Popular discussions on Cars & Bikes in India | Team-BHP';

			//custom description
			$description = array(
				'#tag' => 'meta',
				'#attributes' => array(
					'name' => 'description',
					'content' => 'Find the most unbiased and informative updates about Cars & Bikes in India. Discussions including everything from ✓Reviews ✓Prices ✓Launch Dates ✓Scoops ✓Features and detailed analysis of all the new cars & bikes. All available only right here!',
				),
			);

			drupal_add_html_head($description, 'description');

		}

	}

}

/*

Replace all occurrence of all https:// with https://

 */

function bhp_replace_http_strings($string) {
	if (stristr($string, 'http://')) {

		return str_replace('http://', 'https://', $string);
	}

	return $string;
}
