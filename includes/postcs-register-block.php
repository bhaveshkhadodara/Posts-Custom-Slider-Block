<?php

/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

$slider_attributes = $this->postcs_get_common_slider_attributes();

$dynamic_slider_attr = array(
	'itemToFetch'  => array(
		'type'    => 'number',
		'default' => 10,
	),
	'orderBy'      => array(
		'type'    => 'string',
		'default' => 'date'
	),
	'displayTitle' => array(
		'type'    => 'boolean',
		'default' => true
	),
	'textColor' => array(
		'type'    => 'string'
	),
	'textAlign' => array(
		'type'    => 'string',
		'default' => 'center'
	),
	'fontWeight' => array(
		'type'    => 'string',
		'default' => '300'
	),
	'displayImage' => array(
		'type'    => 'boolean',
		'default' => true
	)
);

register_block_type( 'postcs/dynamic-slider', array(
		'attributes'      => array_merge( $dynamic_slider_attr, $slider_attributes ),
		'render_callback' => array( $this, 'postcs_dynamic_slider_render_callback' ),
	)
);
