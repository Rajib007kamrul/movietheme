<?php

function testproject_setup() {
  add_theme_support( 'post-thumbnails');
	add_image_size( 'boxes', 437, 291, true );

	add_image_size('Specialties', 768, 515, true);

	add_image_size('Specialty-portrait', 435, 530, true);

	update_option( 'thumbnail_size_w', 253);

	update_option( 'thumbnail_size_h', 164);

	add_theme_support('title-tag');
}

add_action ('after_setup_theme', 'testproject_setup');

function testproject_custom_logo() {
	$logo = array(
			'height' => 200,
			'width' =>  250
		);
		add_theme_support('custom-logo', $logo);

		add_theme_support('custom-logo', $logo);
}

add_action('after_setup_theme', 'testproject_custom_logo');



add_action('wp_enqueue_scripts', 'testproject_styles');

function testproject_styles() {
	//adding stylesheets
	wp_register_style('bootstrap', get_template_directory_uri(). '/css/bootstrap.css', array(),'8.0.1');
	wp_register_style('fontawesome', get_template_directory_uri(). '/css/font-awesome.css', array(),'8.0.1');
	wp_register_style('owlcarousel', get_template_directory_uri(). '/css/owl.carousel.css', array(),'8.0.1');
	wp_register_style('owltheme', get_template_directory_uri(). '/css/owl.theme.default.css', array(),'8.0.1');
	wp_register_style('style', get_template_directory_uri(). '/css/style.css', array(),'8.0.1');


	//Enqueue the style
	wp_enqueue_style('bootstrap');
	wp_enqueue_style('fontawesome');
	wp_enqueue_style('owlcarousel');
	wp_enqueue_style('owltheme');
	wp_enqueue_style('style');

	//register_script
	
	wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'), '1.0.0', true );
	wp_register_script( 'owlcarousel', get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'), '1.0.0', true );
	wp_register_script( 'bxslider', 'https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js', array('jquery'), '1.0.0', true );
	wp_register_script( 'main', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0.0', true );

	// javaScript file
	wp_enqueue_script('jquery');
	wp_enqueue_script('bootstrap');
	wp_enqueue_script('owlcarousel');
	wp_enqueue_script('bxslider');
	wp_enqueue_script('main');
}

function testproject_menus() {

	register_nav_menus(array(
		'main-menu' => __( 'Main Menu', 'testproject'),
		'top-menu' => __( 'Top Menu', 'testproject'),
	) );

}

add_action('init', 'testproject_menus');

	
/*** Widget Zone ***/

function testproject_widgets() {
	register_sidebar( array(
		'name' => 'Blog sidebar',
		'id'   => 'blog_sidebar',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3> ',
		'after_title' => '</h3>'
	));

		register_sidebar( array(
		'name' => 'Shop sidebar',
		'id'   => 'shop_sidebar',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3> ',
		'after_title' => '</h3>'
	));

}


add_action('widgets_init', 'testproject_widgets');

function add_async_defer($tag, $handle) {
	if('googlemap' !== $handle){
		return $tag;
	}
		return str_replace(' src', 'async="async" defer="defer" src', $tag);
}

add_filter('script_loader_tag', 'add_async_defer', 10, 2);	





//[foobar]
function foobar_func( $atts ){
	return "foo and bar";
}
add_shortcode( 'foobar', 'foobar_func' );


// add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' ); 

// function woocommerce_custom_single_add_to_cart_text( $add_to_cart_text  ) {
//     return __( 'Buy Now', 'woocommerce' ); 
// }

// add_action( 'rajib_mori_ka', 'morika', 10 );
// add_action( 'rajib_mori_ka', 'mojaloss', 15 );

// function mojaloss() {
// 	echo 'mojaloss ka' . '</br>';
// }

// function morika() {
// 	echo 'mori ka' . '</br>';
// }

// remove_action( 'rajib_mori_ka', 'morika' );

// add_action( 'woocommerce_before_shop_loop', 'morika', 10 );


// remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
// remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

function adjust_lifetime_price( $price ) {
	$price = (float ) $price;	
	return $price * 2.5;
}


function adjust_lifetime_variable_price( $price, $variation, $product ) {	
	return $price * 2.5;
}

add_filter( 'woocommerce_variation_prices_price', 'adjust_lifetime_price' );
add_filter( 'woocommerce_product_get_price', 'adjust_lifetime_price' );

/**

* Add custom field to the checkout page

*/

add_action('woocommerce_after_order_notes', 'custom_checkout_field');

function custom_checkout_field( $checkout ) {
	echo '<div id="custom_checkout_field"><h2>' . __('New Heading') . '</h2>';

	woocommerce_form_field('custom_field_name', array(
		'type' => 'text',
		'class' => array(
			'my-field-class form-row-wide'
		) ,
		'label' => __('Custom Additional Field') ,
		'placeholder' => __('New Custom Field') ,
	) ,

	$checkout->get_value('custom_field_name'));

echo '</div>';

}

/**

* Checkout Process

*/

add_action('woocommerce_checkout_process', 'customised_checkout_field_process');

function customised_checkout_field_process() {

// Show an error message if the field is not set.
	if (!$_POST['customised_field_name']) 
		wc_add_notice(__('Please enter value!') , 'error');

}

/**

* Update the value given in custom field

*/

add_action('woocommerce_checkout_update_order_meta', 'custom_checkout_field_update_order_meta');

function custom_checkout_field_update_order_meta($order_id) {
	if (!empty($_POST['customised_field_name'])) {
		update_post_meta($order_id, 'customised_field_name',sanitize_text_field($_POST['customised_field_name']));
	}
}

// remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );

include_once get_template_directory() . '/inc/custom-meta.php';
include_once get_template_directory() . '/inc/custom-term-meta.php';
include_once get_template_directory() . '/inc/class-test-widget.php';
include_once get_template_directory() . '/inc/class-custom-post.php';
include_once get_template_directory() . '/inc/class-movie-post.php';

add_shortcode( 'rajib_product', 'get_rajib_product' );

function get_rajib_product() {
ob_start();

	$args = array(
    'post_type' => 'product',
);
// The Query
$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) {
    while ( $the_query->have_posts() ) { $the_query->the_post();
			get_template_part( 'template-parts/content', 'product');
    }
 } else {
      // no posts found
      }
      /* Restore original Post Data */
      wp_reset_postdata();

	$output = ob_get_contents();
	
	ob_end_clean();
	
  return $output;
}

// [momin]

function momin_func( $atts) {
	ob_start();
	?>
<div> momin mojaa assos </div>
<?php 
$contant = ob_get_contents();
ob_clean();
	return $contant;
}
add_shortcode( 'momin', 'momin_func');

?>