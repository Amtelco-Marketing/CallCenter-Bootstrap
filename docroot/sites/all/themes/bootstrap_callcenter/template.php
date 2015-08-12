<?php

/**
 * @file
 * template.php
 */

/**
 * Implements template_preprocess_html()
 */
function bootstrap_callcenter_preprocess_html(&$variables) {
  $mobileOptimized = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array(
      'name' =>  'MobileOptimized',
      'content' =>  'width'
    )
  );
  $handheldFriendly = array(
    '#type' => 'html_tag',
    '#tag' => 'meta',
    '#attributes' => array(
      'name' =>  'HandheldFriendly',
      'content' =>  'true'
    )
  );
  drupal_add_html_head($mobileOptimized, 'mobile-optimized');
  drupal_add_html_head($handheldFriendly, 'handheld-friendly');

  drupal_add_css('http://fonts.googleapis.com/css?family=Roboto:400,700|Roboto+Slab:400,700', array('type' => 'external'));
}

/**
 * Implements template_preprocess_page()
 */
function bootstrap_callcenter_preprocess_page(&$variables) {
  // unset $navbar_classes array
  $variables['navbar_classes_array'] = array();

  // Pull out rendered node content
  if (isset($variables['node']) && isset($variables['page']['content']['system_main']['nodes'][$variables['node']->nid]['field_banner'])) {
    $node_content = $variables['page']['content']['system_main']['nodes'][$variables['node']->nid];
    $variables['banner'] = render($node_content['field_banner']);
  } else {
    $variables['classes_array'][] = 'no-banner';
  }

  // Define small logo
  $variables['logo_small'] = '/' . drupal_get_path('theme', 'bootstrap_callcenter') . '/logo-small.png';

  // Initialize javascripts
  drupal_add_js("jQuery( document ).ready(function() {
    jQuery('.main-container').css({'margin-top': jQuery('#header').height()});
  });", array('type' => 'inline', 'scope' => 'header', 'group' => JS_THEME));
  drupal_add_js('jQuery(".field-item").fitVids();', array('type' => 'inline', 'scope' => 'footer', 'group' => JS_THEME));
  drupal_add_js("jQuery('select').selectpicker({style : 'btn'});", array('type' => 'inline', 'scope' => 'footer', 'group' => JS_THEME));

  if (isset($variables['node']) && $variables['node']->type == 'blog_post') {
    // Add "ShareThis" javascript
    drupal_add_js('var switchTo5x=true;', 'inline');
    $st_buttons = ((isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') ? "https://ws." : "http://w.") . "sharethis.com/button/buttons.js";
    drupal_add_js($st_buttons, 'external');
    $st_options = 'stLight.options({publisher: "b56361f8-b0cc-40d6-bba2-70c41deed3fd", doNotHash: true, doNotCopy: true, hashAddressBar: false});';
    drupal_add_js($st_options, 'inline');
  }
}

/**
 * Implements template_preprocess_breadcrumb()
 */
function bootstrap_callcenter_preprocess_breadcrumb(&$variables) {
  // Change "Home" to "1Call"
  $variables['breadcrumb'][0] = l('AMTELCO', '<front>');
}

/**
 * Implements template_process_page()
 */
function bootstrap_callcenter_process_page(&$variables) {
  // Adjust page title for blog posts
  if (isset($variables['node']) && $variables['node']->type == 'blog_post') {
    $variables['title'] = l(t('News'), 'news');
  }
}

/**
 * Implements template_preprocess_node()
 */
function bootstrap_callcenter_preprocess_node(&$variables, $hook) {
  // hide fields we're rendering via page.tpl
  // see bootstrap_callcenter_preprocess_page()
  if (isset($variables['content']['field_banner'])) {
    unset($variables['content']['field_banner']);
  }
  // Generate date box for blog/news
  if ($variables['type'] == 'blog_post') {
    $event = FALSE;
    $node_wrapper = entity_metadata_wrapper('node', $variables['node']);
    $categories = $node_wrapper->field_categories->value();
    foreach ($categories as $category) {
      if ($category->tid == 1) {
        $event = TRUE;
      }
    }
    if ($event) {
      $variables['post_date'] = '<div class="event">' . t('Event') . '</div>';
    } else {
      $posted = $variables['created'];
      $variables['post_date'] = '<div class="day">' . date('j', $posted) . '</div><div class="month">' . date('M', $posted) . '</div>';
    }
    if ($variables['view_mode'] == 'full') {
      $variables['content']['sharethis'] = array(
        '#type' => 'markup',
        '#markup' => "<span class='st_email_large' displayText='Email'></span>
<span class='st_facebook_large' displayText='Facebook'></span>
<span class='st_twitter_large' displayText='Tweet'></span>
<span class='st_pinterest_large' displayText='Pinterest'></span>
<span class='st_linkedin_large' displayText='LinkedIn'></span>
<span class='st_digg_large' displayText='Digg'></span>
<span class='st_googleplus_large' displayText='Google +'></span>
<span class='st_reddit_large' displayText='Reddit'></span>
<span class='st_tumblr_large' displayText='Tumblr'></span>",
        '#weight' => 1,
        '#prefix' => '<div class="field faux-field faux-field-sharethis">',
        '#suffix' => '</div>'
      );
    }
  }
  if ($variables['view_mode'] != 'teaser') {
    $variables['classes_array'][] = 'node-' . $variables['view_mode'];
  }
}
/**
 * Implements template_preprocess_block()
 */
function bootstrap_callcenter_preprocess_block(&$variables, $hook) {
  $block = $variables['block'];
  switch ($block->region) {
    case 'footer':
    case 'footer_bottom':
      $variables['title_tag'] = 'h4';
      break;
    default:
      $variables['title_tag'] = 'h3';
  }
}

/**
 * Implements template_preprocess_region()
 */
function bootstrap_callcenter_preprocess_region(&$variables) {
  if ($variables['region'] == 'title_bar') {
    //$variables['classes_array'][] = 'button-group';
  }
}

/**
 * Implements template_preprocess_entity()
 */
function bootstrap_callcenter_preprocess_entity(&$variables, $hook) {
  // Optionally, generate entity-type-specific preprocess functions
  if (isset($variables['elements']['#entity_type'])) {
    $function = __FUNCTION__ . '__' . $variables['elements']['#entity_type'];
    if (function_exists($function)) {
      $function($variables, $hook);
    }
  }
}
function bootstrap_callcenter_preprocess_entity__banner(&$variables, $hook) {
  $banner = $variables['banner'];
  // Apply background image, if set
  $banner_wrapper = entity_metadata_wrapper('banner', $banner);
  if (!empty($banner_wrapper->field_banner_image)) {
    $background = $banner_wrapper->field_banner_image->value();
    $image = file_create_url($background['uri']);
    $variables['attributes_array']['style'] = 'background-image: url(' . $image . ')';
  }
}


/**
 * Implements template_preprocess_field()
 */
function bootstrap_callcenter_preprocess_field(&$variables, $hook) {
  // Generate field-name-specific preprocess functions
  if (isset($variables['element']['#field_name'])) {
    $function = __FUNCTION__ . '__' . $variables['element']['#field_name'];
    if (function_exists($function)) {
      $function($variables, $hook);
    }
  }
}

function bootstrap_callcenter_preprocess_field__body(&$variables, $hook) {
  if ($variables['element']['#view_mode'] == 'full' && $variables['element']['#bundle'] != 'blog_post') {
    $variables['classes_array'][] = 'container';
  }
}

/**
 * Implements template_preprocess_webform_form()
 */
function bootstrap_callcenter_preprocess_webform_view(&$variables) {
  $variables['webform']['#form']['#attributes']['class'][] = 'container';
}

/*
 * Implements template_preprocess_flippy()
 */
function bootstrap_callcenter_preprocess_flippy(&$vars) {
  $links = $vars['links'];
  $links['middle'] = array('title' => t('View All Articles'), 'href' => 'news');

  $vars['links'] = array(); // reset for our new order

  // Set the order that we want the links to be in
  foreach (array('prev', 'middle', 'next') as $order) {
    if (isset($links[$order])) {
      $vars['links'][$order] = $links[$order];
    }
  }
  $vars['links']['prev']['classes_array'] = array('fa', 'fa-caret-left');
}

/**
 * Implements theme_menu_tree()
 * - Reverts bootstrap_menu_tree()
 */
function bootstrap_callcenter_menu_tree($variables) {
  return '<ul class="menu">' . $variables['tree'] . '</ul>';
}
// - Triggered from earley_preprocess_page() for main nav
function bootstrap_callcenter_menu_tree__main_navigation($variables) {
  return '<ul class="menu nav navbar-nav">' . $variables['tree'] . '</ul>';
}
// - Triggered from earley_preprocess_page() for bootstrap dropdown
function bootstrap_callcenter_menu_tree__dropdown($variables) {
  return '<ul class="menu dropdown-menu">' . $variables['tree'] . '</ul>';
}
