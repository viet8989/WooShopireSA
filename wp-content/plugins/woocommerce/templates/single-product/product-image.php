<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.7.0
 */

use Automattic\WooCommerce\Enums\ProductType;

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ( $post_thumbnail_id ? 'with-images' : 'without-images' ),
		'woocommerce-product-gallery--columns-' . absint( $columns ),
		'images',
	)
);

// Enqueue Owl Carousel assets
add_action('wp_enqueue_scripts', function() {
    if (is_product()) {
        wp_enqueue_style('owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
        wp_enqueue_style('owl-theme', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css');
        wp_enqueue_script('owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array('jquery'), null, true);
        wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
    }
});
?>

<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>">
    <figure class="woocommerce-product-gallery__wrapper owl-carousel owl-theme">
        <?php
        // Add main image
        if ($post_thumbnail_id) {
            $main_image_url = wp_get_attachment_image_url($post_thumbnail_id, 'full');
            $main_image_alt = get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true);
            ?>
            <div class="woocommerce-product-gallery__image" data-thumb="<?php echo esc_url($main_image_url); ?>">
                <a href="<?php echo esc_url($main_image_url); ?>">
                    <img src="<?php echo esc_url($main_image_url); ?>" 
                         class="wp-post-image" 
                         alt="<?php echo esc_attr($main_image_alt); ?>" 
                         loading="lazy">
                </a>
            </div>
            <?php
        }

        // Add gallery images
        $attachment_ids = $product->get_gallery_image_ids();
        if ($attachment_ids) {
            foreach ($attachment_ids as $attachment_id) {
                $image_url = wp_get_attachment_image_url($attachment_id, 'full');
                $image_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
                ?>
                <div class="woocommerce-product-gallery__image" data-thumb="<?php echo esc_url($image_url); ?>">
                    <a href="<?php echo esc_url($image_url); ?>">
                        <img src="<?php echo esc_url($image_url); ?>" 
                             class="wp-post-image" 
                             alt="<?php echo esc_attr($image_alt); ?>" 
                             loading="lazy">
                    </a>
                </div>
                <?php
            }
        }
        ?>
    </figure>

    <ol class="product-control-nav owl-carousel owl-theme">
        <?php
        // Thumbnails for main image and gallery
        if ($post_thumbnail_id) {
            $thumb_url = wp_get_attachment_image_url($post_thumbnail_id, 'thumbnail');
            echo '<li><img src="' . esc_url($thumb_url) . '" alt="Thumbnail"></li>';
        }
        if ($attachment_ids) {
            foreach ($attachment_ids as $attachment_id) {
                $thumb_url = wp_get_attachment_image_url($attachment_id, 'thumbnail');
                echo '<li><img src="' . esc_url($thumb_url) . '" alt="Thumbnail"></li>';
            }
        }
        ?>
    </ol>

    <script type="text/javascript">
    jQuery(document).ready(function($) {
        // Initialize main carousel
        var $mainCarousel = $('.woocommerce-product-gallery__wrapper');
        var $thumbCarousel = $('.product-control-nav');

        $mainCarousel.owlCarousel({
            items: 1,
            nav: true,
            dots: false,
            navText: [
                '<i class="fas fa-angle-left"></i>',
                '<i class="fas fa-angle-right"></i>'
            ]
        });

        // Initialize thumbnail carousel
        $thumbCarousel.owlCarousel({
            items: 4,
            nav: true,
            dots: false,
            margin: 20,
            navText: ['‹', '›']
        });

        // Sync thumbnails with main carousel
        $thumbCarousel.on('click', 'li', function(e) {
            e.preventDefault();
            var index = $(this).parent().index();
            $mainCarousel.trigger('to.owl.carousel', [index, 300, true]);
        });

        $mainCarousel.on('changed.owl.carousel', function(e) {
            var index = e.item.index;
            $thumbCarousel.trigger('to.owl.carousel', [index, 300, true]);
            $thumbCarousel.find('.owl-item').removeClass('current');
            $thumbCarousel.find('.owl-item').eq(index).addClass('current');
        });

        setTimeout(() => {
            if(jQuery('.owl-nav').length > 1) {
                jQuery('.owl-nav').eq(1).hide();
            }
        }, 1000);
    });
    </script>    
</div>