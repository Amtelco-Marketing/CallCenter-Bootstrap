<?php
/**
 * @file
 * amtelco_rows.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function amtelco_rows_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "field_group" && $api == "field_group") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_views_api().
 */
function amtelco_rows_views_api($module = NULL, $api = NULL) {
  return array("api" => "3.0");
}

/**
 * Implements hook_eck_bundle_info().
 */
function amtelco_rows_eck_bundle_info() {
  $items = array(
    'banner_abstract_banner' => array(
      'machine_name' => 'banner_abstract_banner',
      'entity_type' => 'banner',
      'name' => 'abstract_banner',
      'label' => 'Abstract Banner',
    ),
    'banner_banner' => array(
      'machine_name' => 'banner_banner',
      'entity_type' => 'banner',
      'name' => 'banner',
      'label' => 'Banner',
    ),
    'row_content_columns' => array(
      'machine_name' => 'row_content_columns',
      'entity_type' => 'row',
      'name' => 'content_columns',
      'label' => 'Content Columns',
    ),
    'row_content_columns_image' => array(
      'machine_name' => 'row_content_columns_image',
      'entity_type' => 'row',
      'name' => 'content_columns_image',
      'label' => 'Content Columns + Image',
    ),
      'row_image_text' => array(
      'machine_name' => 'row_image_text',
      'entity_type' => 'row',
      'name' => 'image_text',
      'label' => 'Image + Text',
    ),
    'row_product_content' => array(
      'machine_name' => 'row_product_content',
      'entity_type' => 'row',
      'name' => 'product_content',
      'label' => 'Product content',
    ),
    'row_product_teaser' => array(
      'machine_name' => 'row_product_teaser',
      'entity_type' => 'row',
      'name' => 'product_teaser',
      'label' => 'Product teaser',
    ),
    'row_section_header' => array(
      'machine_name' => 'row_section_header',
      'entity_type' => 'row',
      'name' => 'section_header',
      'label' => 'Section Header',
    ),
    'row_video' => array(
      'machine_name' => 'row_video',
      'entity_type' => 'row',
      'name' => 'video',
      'label' => 'Video',
    ),
  );
  return $items;
}

/**
 * Implements hook_eck_entity_type_info().
 */
function amtelco_rows_eck_entity_type_info() {
  $items = array(
    'banner' => array(
      'name' => 'banner',
      'label' => 'Banner',
      'properties' => array(
        'title' => array(
          'label' => 'Title',
          'type' => 'text',
          'behavior' => 'title',
        ),
      ),
    ),
    'row' => array(
      'name' => 'row',
      'label' => 'Row',
      'properties' => array(
        'title' => array(
          'label' => 'Title',
          'type' => 'text',
          'behavior' => 'title',
        ),
        'language' => array(
          'label' => 'Entity language',
          'type' => 'language',
          'behavior' => 'language',
        ),
      ),
    ),
  );
  return $items;
}
