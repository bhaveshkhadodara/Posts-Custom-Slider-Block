<?php

/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

if ( ! class_exists( 'PostCustomSlider' ) ) {

	class PostCustomSlider {

		/**
		 * Initializes WP hooks and filter
		 *
		 * @since 1.0.0
		 */
		public function postcs_init_hook() {

			//Action for add gutenberg custom block
			add_action( 'enqueue_block_editor_assets', array( $this, 'postcs_add_block_editor_script' ) );

			// Action to register all dynamic blocks
			add_action( 'init', array( $this, 'postcs_register_dynamic_blocks' ) );

			// Action to Enqueue script and style
			add_action( 'wp_enqueue_scripts', array( $this, 'postcs_enqueue_front_script' ), 999 );

		}

		/**
		 * Enqueue gutenberg custom block script
		 *
		 * @since 1.0.0
		 */
		public static function postcs_add_block_editor_script() {

			wp_enqueue_script( 'postcs-gutenberg-block', plugins_url( 'assets/js/blocks/block.build.js', __FILE__ ), array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-components', 'jquery' ), '1.4' );

			wp_enqueue_script( 'postcs-bx-slider', plugins_url( 'assets/js/jquery.bxslider.min.js', __FILE__ ), array( 'jquery' ), null, true );

			wp_enqueue_style( 'postcs-bxslider-style', plugin_dir_url( __FILE__ ) . 'assets/css/jquery.bxslider.css' );
			wp_enqueue_style( 'postcs-blocks-style', plugin_dir_url( __FILE__ ) . 'assets/css/postcs-blocks-admin.css' );
		}

		/**
		 * Enqueue gutenberg custom block script and style for front side
		 *
		 * @since 1.0.0
		 */
		public function postcs_enqueue_front_script() {

			wp_enqueue_script( 'postcs-blocks-script', plugins_url( 'assets/js/postcs-blocks.min.js', __FILE__ ), array( 'jquery' ), null, true );
			wp_enqueue_script( 'postcs-bx-slider', plugins_url( 'assets/js/jquery.bxslider.min.js', __FILE__ ), array( 'jquery' ), null, true );

			if ( ! wp_style_is( 'bootstrap' ) && ! wp_style_is( 'bootstrap-css' ) ) {
				wp_enqueue_style( 'bootstrap', plugin_dir_url( __FILE__ ) . 'assets/css/bootstrap.min.css' );
			}

			wp_enqueue_style( 'postcs-blocks-style', plugin_dir_url( __FILE__ ) . 'assets/css/postcs-blocks.css' );
			wp_enqueue_style( 'postcs-bxslider-style', plugin_dir_url( __FILE__ ) . 'assets/css/jquery.bxslider.css' );

		}

		/**
		 * Register all dynamic blocks
		 *
		 * @since 1.0.0
		 */
		public function postcs_register_dynamic_blocks() {

			require_once( plugin_dir_path( __FILE__ ) . 'includes/postcs-register-block.php' );
		}

		/**
		 * Fetch dynamic slider slide according to block attributes
		 *
		 * @param $attributes
		 *
		 * @return string
		 * @since 1.0.0
		 */
		public function postcs_dynamic_slider_render_callback( $attributes ) {

			ob_start();

			include( plugin_dir_path( __FILE__ ) . 'includes/postcs-dynamic-slider-callback.php' );

			$html = ob_get_clean();

			return $html;

		}

		/**
		 * Prepare common slider attributes.
		 *
		 * @param int $min_slides
		 *
		 * @return array
		 *
		 * @since 1.0.0
		 */
		public function postcs_get_common_slider_attributes( $min_slides = 4 ) {

			$slider_attributes = array(
				'sliderActive' => array(
					'type'    => 'boolean',
					'default' => true
				),
				'minSlides'    => array(
					'type'    => 'number',
					'default' => $min_slides
				),
				'autoplay'     => array(
					'type'    => 'boolean',
					'default' => false
				),
				'infiniteLoop' => array(
					'type'    => 'boolean',
					'default' => true
				),
				'pager'        => array(
					'type'    => 'boolean',
					'default' => false
				),
				'controls'     => array(
					'type'    => 'boolean',
					'default' => true
				),
				'sliderSpeed'  => array(
					'type'    => 'number',
					'default' => 500
				),
				'slideWidth'   => array(
					'type'    => 'number',
					'default' => 400
				),
				'slideMargin'  => array(
					'type'    => 'number',
					'default' => 30
				),
				'arrowIcons'   => array(
					'type'    => 'string',
					'default' => 'slider-arrow-1'
				)
			);

			return $slider_attributes;
		}
	}
}
