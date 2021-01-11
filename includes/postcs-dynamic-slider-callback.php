<?php

/**
 * Exit if accessed directly
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

$block_post_type    = 'post';
$posts_per_page     = isset( $attributes['itemToFetch'] ) && $attributes['itemToFetch'] > 0 ? $attributes['itemToFetch'] : 10;
$slider_active      = isset( $attributes['sliderActive'] ) ? $attributes['sliderActive'] : true;
$min_slides         = isset( $attributes['minSlides'] ) ? $attributes['minSlides'] : 4;
$slide_width        = isset( $attributes['slideWidth'] ) ? $attributes['slideWidth'] : 400;
$autoplay           = isset( $attributes['autoplay'] ) ? $attributes['autoplay'] : false;
$infinite_loop      = isset( $attributes['infiniteLoop'] ) ? $attributes['infiniteLoop'] : true;
$pager              = isset( $attributes['pager'] ) ? $attributes['pager'] : false;
$controls           = isset( $attributes['controls'] ) ? $attributes['controls'] : false;
$slider_speed       = isset( $attributes['sliderSpeed'] ) ? $attributes['sliderSpeed'] : 500;
$order_by           = isset( $attributes['orderBy'] ) ? $attributes['orderBy'] : 'date';
$slider_margin      = isset( $attributes['slideMargin'] ) ? $attributes['slideMargin'] : 30;
$block_order        = 'date' === $order_by ? 'DESC' : 'ASC';
$display_title      = isset( $attributes['displayTitle'] ) ? $attributes['displayTitle'] : false;
$display_image      = isset( $attributes['displayImage'] ) ? $attributes['displayImage'] : true;
$arrow_icons        = isset( $attributes['arrowIcons'] ) ? $attributes['arrowIcons'] : 'slider-arrow-1';
$class_name         = isset( $attributes['className'] ) && ! empty( $attributes['className'] ) ? $attributes['className'] : '';

//Title
$text_align         = isset( $attributes['textAlign'] ) ? $attributes['textAlign'] : 'center';
$text_color         = isset( $attributes['textColor'] ) ? $attributes['textColor'] : '';
$font_weight         = isset( $attributes['fontWeight'] ) ? $attributes['fontWeight'] : '300';
$class_name         = $class_name . ' text_align_' . $text_align;
$class_name         = $class_name . ' font_weight_' . $font_weight;;

$query_args = array(
    'post_type'      => $block_post_type,
    'posts_per_page' => $posts_per_page,
    'orderby'        => $order_by,
    'order'          => $block_order,
    'meta_key'       => '_thumbnail_id',
);

$query = new WP_Query( $query_args );
?>
		<style>
            .display-title .flip-box .flip-box-title div{ <?php echo ! empty( $text_color ) ? "color: $text_color" : '' ?> }
            .display-title .flip-box .flip-box-price div{ <?php echo ! empty( $price_color ) ? "color: $price_color" : '' ?> }
            .display-title .flip-box .flip-box-button a{ <?php echo ! empty( $button_color ) ? "color: $button_color" : '' ?> }
            .display-title .flip-box .flip-box-button a{ <?php echo ! empty( $button_bgcolor ) ? "background-color: $button_bgcolor" : '' ?> }
            .display-title .flip-box .flip-box-button a{ <?php echo ! empty( $button_bordercolor ) ? "border-color: $button_bordercolor" : '' ?> }
            .display-title .flip-box .flip-box-rating span{ <?php echo ! empty( $rating_color ) ? "color: $rating_color" : '' ?> }
            .on_sale .postcs-image:before{ <?php echo ! empty( $salestag_color ) ? "color: $salestag_color" : '' ?> }
		</style>
<?php
if ( $query->have_posts() ) {
?>
    <div class="slider-arrow-main <?php echo esc_attr($arrow_icons); ?>">
<?php
        if ( $slider_active ) {
        ?>
            <div class="nab-dynamic-slider items-md nab-box-slider <?php echo esc_attr($class_name); ?>" data-minslides="<?php echo esc_attr($min_slides);?>" data-slidewidth="<?php echo esc_attr($slide_width);?>" data-auto="<?php echo esc_attr($autoplay);?>" data-infinite="<?php echo esc_attr($infinite_loop);?>" data-pager="<?php echo esc_attr($pager);?>" data-controls="<?php echo esc_attr($controls);?>" data-speed="<?php echo esc_attr($slider_speed);?>" data-slidemargin="<?php echo esc_attr($slider_margin);?>">
        <?php
        } else {
        ?>
            <div class="nab-dynamic-list nab-box-slider <?php echo esc_attr($class_name); ?>">
        <?php
        }

        while ( $query->have_posts() ) {
			$postid = get_the_ID();
        	$query->the_post();
            $thumbnail_url = get_the_post_thumbnail_url();
            $class = '';
        ?>
            <div class="<?php echo $display_title ? esc_attr( 'item display-title' ) : esc_attr( 'item' ); echo $class; ?>">
                <div class="flip-box">
                    <div class="flip-box-inner">

            <?php
            if ( $display_image ) {
            ?>
                <a class="postcs-image" href="<?php echo esc_url( get_the_permalink() ); ?>">
                    <img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="item-logo">
                </a>
            <?php
            }
                        if ( $display_title ) { ?>
                        <div class="flip-box-back flip-box-title rounded-circle">
                            <div>
                            <?php
                                echo esc_html( get_the_title() );
                            ?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        </div>
    </div>
<?php
} else {
?>
    <p>No posts found.</p>
<?php
}

wp_reset_postdata();
