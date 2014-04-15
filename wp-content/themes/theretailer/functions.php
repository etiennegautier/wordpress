<?php

/*********************************************/
/**************** INCLUDES *******************/
/*********************************************/

//global $theretailer_theme_options;

include_once('admin/index.php'); // Load Theme Options
include_once('inc/custom_styles.php'); // Load Custom Styles
include_once('inc/paginate.php'); // Load Pagination
include_once('inc/widgets/connect.php'); // Load Widget Connect
include_once('inc/widgets/recent-posts.php'); // Load Widget Recent Posts
if (file_exists(get_template_directory().'/_demo_add_to_cart.php')) include_once('_demo_add_to_cart.php');
add_theme_support( 'woocommerce');

/**********************************************/
/************* Theme Options Array ************/
/**********************************************/
//$theretailer_theme_options = get_option('The Retailer_options');
$theretailer_theme_options = $smof_data;
include_once('inc/fonts_from_google.php'); // Load Fonts from Google

/******************************************************************************/
/***************** add links/menus to the admin bar ***************************/
/******************************************************************************/
function theretailer_admin_bar_render() {
	global $wp_admin_bar;
	$wp_admin_bar->add_menu( array(
		'parent' => 'appearance', // use 'false' for a root menu, or pass the ID of the parent menu
		'id' => 'theretailer_theme_options_admin_bar_link', // link ID, defaults to a sanitized title value
		'title' => __('Theme Options'), // link title
		'href' => admin_url( 'themes.php?page=optionsframework'), // name of file
		'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
	));
}
add_action( 'wp_before_admin_bar_render', 'theretailer_admin_bar_render' );

/**********************************************/
/************ Plugin recommendations **********/
/**********************************************/

include_once ('inc/class-tgm-plugin-activation.php');
add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
function my_theme_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme
		array(
			'name'     				=> 'Previous and Next Post in Same Taxonomy', // The plugin name
			'slug'     				=> 'previous-and-next-post-in-same-taxonomy', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/inc/plugins/previous-and-next-post-in-same-taxonomy.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'Contact Form 7', // The plugin name
			'slug'     				=> 'contact-form-7', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/inc/plugins/contact-form-7.3.5.4.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '3.5.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'WooCommerce', // The plugin name
			'slug'     				=> 'woocommerce', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/inc/plugins/woocommerce.2.0.20.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '2.0.20', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'Revolution Slider', // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/inc/plugins/revslider.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '2.3.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'MailChimp List Subscribe Form', // The plugin name
			'slug'     				=> 'mailchimp', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/inc/plugins/mailchimp.1.4.1.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.4.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'Envato Toolkit', // The plugin name
			'slug'     				=> 'envato-wordpress-toolkit-master', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/inc/plugins/envato-wordpress-toolkit-master.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'WP Retina 2x', // The plugin name
			'slug'     				=> 'wp-retina-2x', // The plugin slug (typically the folder name)
			'source'   				=> get_stylesheet_directory() . '/inc/plugins/wp-retina-2x.1.6.2.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '1.6.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		)

	);

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> 'theretailer',         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', 'theretailer' ),
			'menu_title'                       			=> __( 'Install Plugins', 'theretailer' ),
			'installing'                       			=> __( 'Installing Plugin: %s', 'theretailer' ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', 'theretailer' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', 'theretailer' ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'theretailer' ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'theretailer' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}

/*********************************************/
/****************** STYLES *******************/
/*********************************************/

function theretailer_styles() {	

	global $theretailer_theme_options;
	
	wp_register_style('stylesheet', get_stylesheet_uri(), array(), '1.8.1', 'all');	
	wp_register_style('font-awesome', get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.min.css', array(), '3.2.1', 'all' );
	wp_register_style('audioplayer', get_template_directory_uri() . '/css/audioplayer.css', array(), '1.0', 'all' );
	wp_register_style('fresco', get_template_directory_uri() . '/css/fresco/fresco.css', array(), '1.2.7', 'all' );
	if ( ($theretailer_theme_options['let_it_snow']) && ($theretailer_theme_options['let_it_snow'] == 1) ) {
		wp_register_style('snowfall', get_template_directory_uri() . '/css/snowfall.css', array(), '1.0', 'all' );
	}
	
	wp_enqueue_style( 'stylesheet' );
	wp_enqueue_style( 'font-awesome' );
	wp_enqueue_style( 'audioplayer' );
	wp_enqueue_style( 'fresco' );
	if ( ($theretailer_theme_options['let_it_snow']) && ($theretailer_theme_options['let_it_snow'] == 1) ) {
		wp_enqueue_style( 'snowfall' );
	}
	
}  
add_action( 'wp_enqueue_scripts', 'theretailer_styles', 99 );

/*********************************************/
/****************** SCRIPTS ******************/
/*********************************************/


function theretailer_scripts() {  

	global $theretailer_theme_options;

	wp_register_script('youtube-api', 'http://www.youtube.com/iframe_api', array(), NULL, TRUE);
	wp_register_script('vimeo-api', 'http://a.vimeocdn.com/js/froogaloop2.min.js', array(), NULL, TRUE);
	
	wp_register_script('hoverIntent', get_template_directory_uri() . '/js/hoverIntent.js', 'jquery', '1', TRUE);
	wp_register_script('superfish', get_template_directory_uri() . '/js/jquery.superfish-1.5.0.js', 'jquery', '1.5.0', TRUE);
	wp_register_script('iosslider', get_template_directory_uri() . '/js/jquery.iosslider.min.js', 'jquery', '1.1.56', TRUE);
	wp_register_script('footable', get_template_directory_uri() . '/js/footable-0.1.js', 'jquery', '0.1', TRUE);
	wp_register_script('customSelect', get_template_directory_uri() . '/js/jquery.customSelect.min.js', 'jquery', '0.3.0', TRUE);
	wp_register_script('favico', get_template_directory_uri() . '/js/favico-0.3.3.min.js', 'jquery', '0.3.3', FALSE);
	wp_register_script('audioplayer', get_template_directory_uri() . '/js/audioplayer.min.js', 'jquery', '1.0', TRUE);
	wp_register_script('fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', 'jquery', '1.0.3', TRUE);
	wp_register_script('fresco', get_template_directory_uri() . '/js/fresco.js', 'jquery', '1.2.7', TRUE);
	if ( ($theretailer_theme_options['let_it_snow']) && ($theretailer_theme_options['let_it_snow'] == 1) ) {
		wp_register_script('snowfall', get_template_directory_uri() . '/js/snowfall.min.jquery.js', 'jquery', '1.0', TRUE);
	}
	wp_register_script('init', get_template_directory_uri() . '/js/init.js', 'jquery', '1.8.1', TRUE);

	wp_enqueue_script('youtube-api');
	wp_enqueue_script('vimeo-api');
	wp_enqueue_script('hoverIntent');
	wp_enqueue_script('superfish');
	wp_enqueue_script('iosslider');
	wp_enqueue_script('footable');
	wp_enqueue_script('customSelect');
	wp_enqueue_script('favico');
	wp_enqueue_script('audioplayer');
	wp_enqueue_script('fitvids');
	wp_enqueue_script('fresco');
	if ( ($theretailer_theme_options['let_it_snow']) && ($theretailer_theme_options['let_it_snow'] == 1) ) {
		wp_enqueue_script('snowfall');
	}
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	global $is_IE;

    if ( $is_IE ) {
        wp_register_script('html5', get_template_directory_uri() . '/js/html5.js', array(), '3.6', TRUE);
		wp_register_script('respond', get_template_directory_uri() . '/js/respond.min.js', array(), NULL, TRUE);
		
		wp_enqueue_script('html5');
		wp_enqueue_script('respond');
    }
	
	add_filter( 'wp_enqueue_scripts', 'the_retailer_init', 100 ); // enqueue script with a priority of 100
	function the_retailer_init() {
		wp_enqueue_script( 'init' );
	}	
	
}

add_action( 'wp_enqueue_scripts', 'theretailer_scripts', 10 );


/*********************************************/
/***** adding shortcodes to excerpts *********/
/*********************************************/

add_filter('the_excerpt', 'do_shortcode');

/*********************************************/
/******* modify the excerpt read more ********/
/*********************************************/

/*function new_excerpt_more( $excerpt ) {
	global $post;
	$excerpt_more = '<div class="clr"></div><a href="'. get_permalink($post->ID) . '" class="more-link">'.__( 'Continue reading &raquo;', 'theretailer' ).'</a>';
	$trans = array(
		"[...]" => $excerpt_more, //Wordpress < v3.5.2
		"[&hellip;]" => $excerpt_more //Wordpress >= v3.6
	);
	return strtr($excerpt, $trans);
	//return str_replace( '[...]', '<div class="clr"></div><a href="'. get_permalink($post->ID) . '" class="more-link">'.__( 'Continue reading &raquo;', 'theretailer' ).'</a>', $excerpt );
}
add_filter( 'wp_trim_excerpt', 'new_excerpt_more' );*/

function new_excerpt_more( $excerpt ) {
	global $post;
	$excerpt_more = '';
	$trans = array(
		"[...]" => $excerpt_more, //Wordpress < v3.5.2
		"[&hellip;]" => $excerpt_more //Wordpress >= v3.6
	);
	return strtr($excerpt, $trans);
}
add_filter( 'wp_trim_excerpt', 'new_excerpt_more' );



/*function gbtr_excerpt_more(){
	global $post;
	$link = '<a class="more-link" href='.get_permalink($post->ID ).'>'.__( 'Continue reading &raquo;', 'theretailer' ).'</a>';
	$excerpt = get_the_excerpt($post->ID);
	echo $excerpt . "<br />" . $link;
}
add_filter('the_excerpt','gbtr_excerpt_more');*/






/**********************************************/
/**************** TAXONOMIES ******************/
/**********************************************/

// create Portfolio
add_action( 'init', 'create_portfolio_item' );
function create_portfolio_item() {
	
	$labels = array(
		'name' => _x('Portfolio', 'post type general name', 'theretailer'),
		'singular_name' => _x('Portfolio Item', 'post type singular name', 'theretailer'),
		'add_new' => _x('Add New', 'Portfolio Item', 'theretailer'),
		'add_new_item' => __('Add New Portfolio item', 'theretailer'),
		'edit_item' => __('Edit Portfolio item', 'theretailer'),
		'new_item' => __('New Portfolio item', 'theretailer'),
		'all_items' => __('All Portfolio items', 'theretailer'),
		'view_item' => __('View Portfolio item', 'theretailer'),
		'search_items' => __('Search Portfolio item', 'theretailer'),
		'not_found' =>  __('No Portfolio item found', 'theretailer'),
		'not_found_in_trash' => __('No Portfolio item found in Trash', 'theretailer'), 
		'parent_item_colon' => '',
		'menu_name' => 'Portfolio'
	);

	$args = array(
		'labels' => $labels,
		'public' => false,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'show_in_nav_menus' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'has_archive' => true, 
		'hierarchical' => true,
		'menu_position' => 4,
		'supports' => array('title', 'editor', 'thumbnail'),
		'rewrite' => array('slug' => 'portfolio-item'),
		'with_front' => FALSE
	);
	
	register_post_type('portfolio',$args);
	
}

register_taxonomy("portfolio_filter", array("portfolio"), array("hierarchical" => true, "label" => "Portfolio Filter", "singular_label" => "Project Filter", "rewrite" => true));


/***************************************************/
/**************** Enable excerpts ******************/
/***************************************************/

add_action('init', 'theretailer_post_type_support');
function theretailer_post_type_support() {
	add_post_type_support( 'page', 'excerpt' );
	add_post_type_support( 'portfolio', 'excerpt' );
}


/******************************************************/
/**************** CUSTOM IMAGE SIZES ******************/
/******************************************************/

add_image_size('portfolio-details', 1180, 2000, true);
add_image_size('recent_posts_shortcode', 190, 190, true);
add_image_size('portfolio_4_col', 220, 165, true); //4X3
add_image_size('portfolio_3_col', 300, 225, true); //4X3
add_image_size('portfolio_2_col', 460, 345, true); //4X3
add_image_size('review_thumb', 140, 300, true);

/******************************************************/
/******************* SHORTCODES ***********************/
/******************************************************/


// [full_column]
function content_grid_12($params = array(), $content = null) {	
	$content = do_shortcode($content);
	$full_column = '<div class="content_grid_12">'.$content.'</div>';
	return $full_column;
}

// [one_half]
function content_grid_6($params = array(), $content = null) {	
	$content = do_shortcode($content);
	$one_half = '<div class="content_grid_6">'.$content.'</div>';
	return $one_half;
}

// [one_third]
function content_grid_4($params = array(), $content = null) {	
	$content = do_shortcode($content);
	$one_third = '<div class="content_grid_4">'.$content.'</div>';
	return $one_third;
}

// [two_third]
function content_grid_2_3($params = array(), $content = null) {	
	$content = do_shortcode($content);
	$two_third = '<div class="content_grid_2_3">'.$content.'</div>';
	return $two_third;
}

// [one_fourth]
function content_grid_3($params = array(), $content = null) {	
	$content = do_shortcode($content);
	$one_fourth = '<div class="content_grid_3">'.$content.'</div>';
	return $one_fourth;
}

// [one_sixth]
function content_grid_2($params = array(), $content = null) {	
	$content = do_shortcode($content);
	$one_sixth = '<div class="content_grid_2">'.$content.'</div>';
	return $one_sixth;
}

// [one_twelves]
function content_grid_1($params = array(), $content = null) {	
	$content = do_shortcode($content);
	$one_twelves = '<div class="content_grid_1">'.$content.'</div>';
	return $one_twelves;
}

// [column_demo]
function column_demo($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'bgcolor' => '#ccc'
	), $params));
	
	$content = do_shortcode($content);
	$column_demo = '<div class="column_demo" style="background-color:'.$bgcolor.'">'.$content.'</div>';
	return $column_demo;
}

// [separator]
function shortcode_separator($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'top_space' => '10px',
		'bottom_space' => '30px'
	), $params));
	$separator = '
		<div class="clr"></div><div class="content_hr" style="margin-top:'.$top_space.';margin-bottom:'.$bottom_space.'"></div><div class="clr"></div>
	';
	return $separator;
}

// [empty_separator]
function shortcode_empty_separator($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'top_space' => '10px',
		'bottom_space' => '30px'
	), $params));
	$empty_separator = '
		<div class="clr"></div><div class="empty_separator" style="margin-top:'.$top_space.';margin-bottom:'.$bottom_space.'"></div><div class="clr"></div>
	';
	return $empty_separator;
}

// [featured_box]
function shortcode_big_box_txt_bg($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'title' => 'Title',
		'background_url' => ''
	), $params));
	
	$content = do_shortcode($content);
	$featured_box = '
		<div class="shortcode_big_box_txt_bg_wrapper" style="background-image:url('.$background_url.')">
		<div class="shortcode_big_box_txt_bg">
			<h3>'.$title.'</h3>
			<div class="sep"></div>
			<h5>'.$content.'</h5>
		</div>
		</div>
	';
	return $featured_box;
}

// [text_block]
function shortcode_text_block($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'title' => 'Title'
	), $params));
	
	$content = do_shortcode($content);
	$text_block = '		
		<div class="shortcode_text_block">
			<h3>'.$title.'</h3>
			<p>'.$content.'</p>
		</div>
	';
	return $text_block;
}

// [featured_1]
function shortcode_featured_1($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'image_url' => '',
		'title' => 'Title',
		'button_text' => 'Link button',
		'button_url' => '#'
	), $params));
	
	$content = do_shortcode($content);
	$featured_1 = '		
		<div class="shortcode_featured_1">
			<div class="shortcode_featured_1_img_placeholder"><img src="'.$image_url.'" alt="" /></div>
			<h3>'.$title.'</h3>
			<p>'.$content.'</p>
			<a href="'.$button_url.'">'.$button_text.'</a>
		</div>
	';
	return $featured_1;
}

//[section_title]

function section_title($params = array(), $content = null) {
	
	$content = do_shortcode($content);
	$section_title = '<div class="section_title">'.$content.'</div>';
	return $section_title;
}


// [tabgroup]
function tabgroup( $params, $content = null ) {
	$GLOBALS['tabs'] = array();
	$GLOBALS['tab_count'] = 0;
	$i = 1;
	$randomid = rand();
	
	extract(shortcode_atts(array(
		'title' => 'Title'
	), $params));

	do_shortcode($content);

	if( is_array( $GLOBALS['tabs'] ) ){
	
		foreach( $GLOBALS['tabs'] as $tab ){	
			$tabs[] = '<li class="tab"><a href="#panel'.$randomid.$i.'">'.$tab['title'].'</a></li>';
			$panes[] = '<div class="panel" id="panel'.$randomid.$i.'"><p>'.do_shortcode($tab['content']).'</p></div>';
			$i++;
		}
		$return = '
		<div class="shortcode_tabgroup">
			<h3>'.$title.'</h3>
			<ul class="tabs">'.implode( "\n", $tabs ).'</ul><div class="panels">'.implode( "\n", $panes ).'</div><div class="clr"></div></div>';
	}
	return $return;
}

function tab( $params, $content = null) {
	extract(shortcode_atts(array(
			'title' => ''
	), $params));
	
	$x = $GLOBALS['tab_count'];
	$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  $content );
	$GLOBALS['tab_count']++;
}

// [team_member]
function team_member($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'image_url' => '',
		'name' => 'Name',
		'role' => 'Role'
	), $params));
	
	$content = do_shortcode($content);
	$team_member = '
		<div class="shortcode_meet_the_team">
			<div class="shortcode_meet_the_team_img_placeholder"><img src="'.$image_url.'" alt="" /></div>
			<h3>'.$name.'</h3>
			<div class="small_sep"></div>
			<div class="role">'.$role.'</div>
			<p>'.$content.'</p>
		</div>
	';
	return $team_member;
}

// [bold_title]
function bold_title($params = array(), $content = null) {
	$bold_title = '
		<h2 class="bold_title"><span>'.$content.'</span></h2>
	';
	return $bold_title;
}

// [our_services]
function our_services($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'image_url' => '',
		'title' => 'Title',
		'link_name' => '',
		'link_url' => ''
	), $params));
	
	$content = do_shortcode($content);
	$our_services = '		
		<div class="shortcode_our_services">
			<div class="shortcode_our_services_img_placeholder"><img src="'.$image_url.'" alt="" /></div>
			<h3>'.$title.'</h3>
			<div class="small_sep"></div>
			<p>'.$content.'</p>
			<a href="'.$link_url.'">'.$link_name.'</a>
		</div>
	';
	return $our_services;
}

// [accordion]
function accordion($atts, $content=null, $code) {

	extract(shortcode_atts(array(
		'open' => '1',
		'title' => 'Title'
	), $atts));

	if (!preg_match_all("/(.?)\[(accordion-item)\b(.*?)(?:(\/))?\](?:(.+?)\[\/accordion-item\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	} 
	else {
		$output = '';
		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
						
			$output .= '<div class="accordion-title"><a href="#">' . $matches[3][$i]['title'] . '</a></div><div class="accordion-inner">' . do_shortcode(trim($matches[5][$i])) .'</div>';
		}
		return '<h3 class="accordion_h3">'.$title.'</h3><div class="accordion" rel="'.$open.'">' . $output . '</div>';
		
	}	
}

// [container]
function shortcode_container($params = array(), $content = null) {
	
	$content = do_shortcode($content);
	$container = '		
		<div class="shortcode_container">'.$content.'<div class="clr"></div></div>';
	return $container;
}

// [banner_simple]
function banner_simple($params = array(), $content = null) {
	extract(shortcode_atts(array(
		'title' => 'Title',
		'subtitle' => 'Subtitle',
		'link_url' => '',
		'title_color' => '#fff',
		'subtitle_color' => '#fff',
		'border_color' => '#000',
		'inner_stroke' => '2px',
		'inner_stroke_color' => '#fff',
		'bg_color' => '#000',
		'bg_image' => '',
		'h_padding' => '20px',
		'v_padding' => '20px',
		'sep_padding' => '5px',
		'sep_color' => '#fff',
		'with_bullet' => 'no',
		'bullet_text' => '',
		'bullet_bg_color' => '',
		'bullet_text_color' => ''
	), $params));
	
	$content = do_shortcode($content);
	$banner_simple = '
		<div class="shortcode_banner_simple" onclick="location.href=\''.$link_url.'\';" style="background-color:'.$border_color.'; background-image:url('.$bg_image.')">
			<div class="shortcode_banner_simple_inside" style="padding:'.$v_padding.' '.$h_padding.'; background-color:'.$bg_color.'; border: '.$inner_stroke.' solid '.$inner_stroke_color.'">
				<div><h3 style="color:'.$title_color.'">'.$title.'</h3></div>
				<div class="shortcode_banner_simple_sep" style="margin:'.$sep_padding.' auto; background-color:'.$sep_color.';"></div>
				<div><h4 style="color:'.$subtitle_color.'">'.$subtitle.'</h4></div>
			</div>';
	if ($with_bullet == 'yes') {
		$banner_simple .= '<div class="shortcode_banner_simple_bullet" style="background:'.$bullet_bg_color.'; color:'.$bullet_text_color.'"><span>'.$bullet_text.'</span></div>';
	}
	$banner_simple .= '</div>';
	return $banner_simple;
}


// [custom_featured_products]
function shortcode_custom_featured_products($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"title" => '',
		'per_page'  => '12',
        'orderby' => 'date',
        'order' => 'desc'
	), $atts));
	ob_start();
	?>
    
    <?php 
	/**
	* Check if WooCommerce is active
	**/
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	?>  
    
    <script>
	(function($){
		$(window).load(function(){
			
			/* items_slider */
			$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_slider').iosSlider({
				snapToChildren: true,
				desktopClickDrag: true,
				scrollbar: true,
				scrollbarHide: true,
				scrollbarLocation: 'bottom',
				scrollbarHeight: '2px',
				scrollbarBackground: '#ccc',
				scrollbarBorder: '0',
				scrollbarMargin: '0',
				scrollbarOpacity: '1',
				navNextSelector: $('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_sliders_nav .big_arrow_right'),
				navPrevSelector: $('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_sliders_nav .big_arrow_left'),
				onSliderLoaded: custom_featured_products_UpdateSliderHeight,
				//onSlideChange: custom_featured_products_UpdateSliderHeight,
				//onSliderResize: custom_featured_products_UpdateSliderHeight
			});
			
			function custom_featured_products_UpdateSliderHeight(args) {
									
				//currentSlide = args.currentSlideNumber;
				
				/* update height of the first slider */
				
				var t = 0; // the height of the highest element (after the function runs)
				var t_elem;  // the highest element (after the function runs)
				$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .product_item').each(function () {
					$this = $(this);
					if ( $this.outerHeight() > t ) {
						t_elem = this;
						t = $this.outerHeight();
					}
				});
	
				setTimeout(function() {
					//var setHeight = $('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_slider .product_item:eq(' + (args.currentSlideNumber-1) + ')').outerHeight(true);
					//$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_slider').animate({ height: setHeight+20 }, 300);
					$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_slider').css({
						height: t+30,
						visibility: "visible"
					});
				},300);
				
			}
		
		})
	})(jQuery);
	</script>
    
    <div class="gbtr_items_slider_id_<?php echo $sliderrandomid ?>">
    
        <div class="gbtr_items_sliders_header">
            <div class="gbtr_items_sliders_title">
                <div class="gbtr_featured_section_title"><strong><?php echo $title ?></strong></div>
            </div>
            <div class="gbtr_items_sliders_nav">                        
                <a class='big_arrow_right'></a>
                <a class='big_arrow_left'></a>
                <div class='clr'></div>
            </div>
        </div>
    
        <div class="gbtr_bold_sep"></div>   
    
        <div class="gbtr_items_slider_wrapper">
            <div class="gbtr_items_slider">
                <ul class="slider">
                    <?php
            
                    $args = array(
                        'post_status' => 'publish',
                        'post_type' => 'product',
						'ignore_sticky_posts'   => 1,
                        'meta_key' => '_featured',
                        'meta_value' => 'yes',
                        'posts_per_page' => $per_page,
						'orderby' => $orderby,
						'order' => $order,
                    );
                    
                    $products = new WP_Query( $args );
                    
                    if ( $products->have_posts() ) : ?>
                                
                        <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                    
                            <?php woocommerce_get_template_part( 'content', 'product' ); ?>
                
                        <?php endwhile; // end of the loop. ?>
                        
                    <?php
                    
                    endif; 
                    //wp_reset_query();
                    
                    ?>
                </ul>     
            </div>
        </div>
    
    </div>
    
    <?php } ?>

	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}


// [custom_on_sale_products]
function shortcode_custom_on_sale_products($atts, $content = null) {
	global $woocommerce;
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"title" => '',
		'per_page'  => '12',
        'orderby' => 'date',
        'order' => 'desc'
	), $atts));
	ob_start();
	?>
    
    <?php 
	/**
	* Check if WooCommerce is active
	**/
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	?>
    
    <script>
	(function($){
		$(window).load(function(){
		
			/* items_slider */
			$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_slider').iosSlider({
				snapToChildren: true,
				desktopClickDrag: true,
				scrollbar: true,
				scrollbarHide: true,
				scrollbarLocation: 'bottom',
				scrollbarHeight: '2px',
				scrollbarBackground: '#ccc',
				scrollbarBorder: '0',
				scrollbarMargin: '0',
				scrollbarOpacity: '1',
				navNextSelector: $('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_sliders_nav .big_arrow_right'),
				navPrevSelector: $('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_sliders_nav .big_arrow_left'),
				onSliderLoaded: custom_on_sale_products_UpdateSliderHeight,
				//onSlideChange: custom_on_sale_products_UpdateSliderHeight,
				//onSliderResize: custom_on_sale_products_UpdateSliderHeight
			});
			
			function custom_on_sale_products_UpdateSliderHeight(args) {
									
				//currentSlide = args.currentSlideNumber;
				
				/* update height of the first slider */
				
				var t = 0; // the height of the highest element (after the function runs)
				var t_elem;  // the highest element (after the function runs)
				$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .product_item').each(function () {
					$this = $(this);
					if ( $this.outerHeight() > t ) {
						t_elem = this;
						t = $this.outerHeight();
					}
				});
	
				setTimeout(function() {
					//var setHeight = $('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_slider .product_item:eq(' + (args.currentSlideNumber-1) + ')').outerHeight(true);
					//$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_slider').animate({ height: setHeight+20 }, 300);
					$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_slider').css({
						height: t+30,
						visibility: "visible"
					});
				},300);
				
			}
			
		})
	})(jQuery);
	</script>
    
    <div class="gbtr_items_slider_id_<?php echo $sliderrandomid ?>">
    
        <div class="gbtr_items_sliders_header">
            <div class="gbtr_items_sliders_title">
                <div class="gbtr_featured_section_title"><strong><?php echo $title ?></strong></div>
            </div>
            <div class="gbtr_items_sliders_nav">                        
                <a class='big_arrow_right'></a>
                <a class='big_arrow_left'></a>
                <div class='clr'></div>
            </div>
        </div>
    
        <div class="gbtr_bold_sep"></div>   
    
        <div class="gbtr_items_slider_wrapper">
            <div class="gbtr_items_slider">
                <ul class="slider">
                    <?php
            
                    /*$args = array(
                        'post_type' => 'product',
						'post_status' => 'publish',
						'ignore_sticky_posts'   => 1,
						'posts_per_page' => $per_page,
						'orderby' => $orderby,
						'order' => $order,
						'meta_query' => array(
							array(
								'key' => '_visibility',
								'value' => array('catalog', 'visible'),
								'compare' => 'IN'
							),
							array(
								'key' => '_sale_price',
								'value' =>  0,
								'compare'   => '>',
								'type'      => 'NUMERIC'
							)
						)
                    );*/
					
					// Get products on sale
					$product_ids_on_sale = woocommerce_get_product_ids_on_sale();
					$product_ids_on_sale[] = 0;
					
					$meta_query = $woocommerce->query->get_meta_query();
					
					$args = array(
						'posts_per_page' 	=> $per_page,
						'no_found_rows' => 1,
						'post_status' 	=> 'publish',
						'post_type' 	=> 'product',
						'orderby' 		=> 'date',
						'order' 		=> 'ASC',
						'meta_query' 	=> $meta_query,
						'post__in'		=> $product_ids_on_sale
					);
                    
                    $products = new WP_Query( $args );
                    
                    if ( $products->have_posts() ) : ?>
                                
                        <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                    
                            <?php woocommerce_get_template_part( 'content', 'product' ); ?>
                
                        <?php endwhile; // end of the loop. ?>
                        
                    <?php
                    
                    endif; 
                    //wp_reset_query();
                    
                    ?>
                </ul>     
            </div>
        </div>
    
    </div>
    
    <?php } ?>

	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}


// [custom_latest_products]
function shortcode_custom_latest_products($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"title" => '',
		'per_page'  => '12',
        'orderby' => 'date',
        'order' => 'desc'
	), $atts));
	ob_start();
	?>
    
    <?php 
	/**
	* Check if WooCommerce is active
	**/
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	?>
    
    <script>
	(function($){
		$(window).load(function(){
		
			/* items_slider */
			$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_slider').iosSlider({
				snapToChildren: true,
				desktopClickDrag: true,
				scrollbar: true,
				scrollbarHide: true,
				scrollbarLocation: 'bottom',
				scrollbarHeight: '2px',
				scrollbarBackground: '#ccc',
				scrollbarBorder: '0',
				scrollbarMargin: '0',
				scrollbarOpacity: '1',
				navNextSelector: $('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_sliders_nav .big_arrow_right'),
				navPrevSelector: $('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_sliders_nav .big_arrow_left'),
				onSliderLoaded: custom_latest_products_UpdateSliderHeight,
				//onSlideChange: custom_latest_products_UpdateSliderHeight,
				//onSliderResize: custom_latest_products_UpdateSliderHeight
			});
			
			function custom_latest_products_UpdateSliderHeight(args) {
									
				//currentSlide = args.currentSlideNumber;
				
				/* update height of the first slider */
				
				var t = 0; // the height of the highest element (after the function runs)
				var t_elem;  // the highest element (after the function runs)
				$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .product_item').each(function () {
					$this = $(this);
					if ( $this.outerHeight() > t ) {
						t_elem = this;
						t = $this.outerHeight();
					}
				});
	
				setTimeout(function() {
					//var setHeight = $('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_slider .product_item:eq(' + (args.currentSlideNumber-1) + ')').outerHeight(true);
					//$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_slider').animate({ height: setHeight+20 }, 300);
					$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_slider').css({
						height: t+30,
						visibility: "visible"
					});
				},300);
				
			}
			
		})
	})(jQuery);
	</script>
    
    <div class="gbtr_items_slider_id_<?php echo $sliderrandomid ?>">
    
        <div class="gbtr_items_sliders_header">
            <div class="gbtr_items_sliders_title">
                <div class="gbtr_featured_section_title"><strong><?php echo $title ?></strong></div>
            </div>
            <div class="gbtr_items_sliders_nav">                        
                <a class='big_arrow_right'></a>
                <a class='big_arrow_left'></a>
                <div class='clr'></div>
            </div>
        </div>
    
        <div class="gbtr_bold_sep"></div>   
    
        <div class="gbtr_items_slider_wrapper">
            <div class="gbtr_items_slider">
                <ul class="slider">
                    <?php
            
                    $args = array(
                        'post_type' => 'product',
						'post_status' => 'publish',
						'ignore_sticky_posts'   => 1,
						'posts_per_page' => $per_page
                    );
                    
                    $products = new WP_Query( $args );
                    
                    if ( $products->have_posts() ) : ?>
                                
                        <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                    
                            <?php woocommerce_get_template_part( 'content', 'product' ); ?>
                
                        <?php endwhile; // end of the loop. ?>
                        
                    <?php
                    
                    endif; 
                    //wp_reset_query();
                    
                    ?>
                </ul>     
            </div>
        </div>
    
    </div>
    
    <?php } ?>

	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}


// [products_by_category]
function shortcode_products_by_category($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"title" => '',
		'per_page'  => '12',
        'orderby' => 'date',
        'order' => 'desc',
		'category' => ''
	), $atts));
	ob_start();
	?>
    
    <?php 
	/**
	* Check if WooCommerce is active
	**/
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	?>
    
    <script>
	(function($){
		$(window).load(function(){
		
			/* items_slider */
			$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_slider').iosSlider({
				snapToChildren: true,
				desktopClickDrag: true,
				scrollbar: true,
				scrollbarHide: true,
				scrollbarLocation: 'bottom',
				scrollbarHeight: '2px',
				scrollbarBackground: '#ccc',
				scrollbarBorder: '0',
				scrollbarMargin: '0',
				scrollbarOpacity: '1',
				navNextSelector: $('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_sliders_nav .big_arrow_right'),
				navPrevSelector: $('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_sliders_nav .big_arrow_left'),
				onSliderLoaded: custom_latest_products_UpdateSliderHeight,
				//onSlideChange: custom_latest_products_UpdateSliderHeight,
				//onSliderResize: custom_latest_products_UpdateSliderHeight
			});
			
			function custom_latest_products_UpdateSliderHeight(args) {
									
				//currentSlide = args.currentSlideNumber;
				
				/* update height of the first slider */
				
				var t = 0; // the height of the highest element (after the function runs)
				var t_elem;  // the highest element (after the function runs)
				$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .product_item').each(function () {
					$this = $(this);
					if ( $this.outerHeight() > t ) {
						t_elem = this;
						t = $this.outerHeight();
					}
				});
	
				setTimeout(function() {
					//var setHeight = $('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_slider .product_item:eq(' + (args.currentSlideNumber-1) + ')').outerHeight(true);
					//$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_slider').animate({ height: setHeight+20 }, 300);
					$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_slider').css({
						height: t+30,
						visibility: "visible"
					});
				},300);
				
			}
			
		})
	})(jQuery);
	</script>
    
    <div class="gbtr_items_slider_id_<?php echo $sliderrandomid ?>">
    
        <div class="gbtr_items_sliders_header">
            <div class="gbtr_items_sliders_title">
                <div class="gbtr_featured_section_title"><strong><?php echo $title ?></strong></div>
            </div>
            <div class="gbtr_items_sliders_nav">                        
                <a class='big_arrow_right'></a>
                <a class='big_arrow_left'></a>
                <div class='clr'></div>
            </div>
        </div>
    
        <div class="gbtr_bold_sep"></div>   
    
        <div class="gbtr_items_slider_wrapper">
            <div class="gbtr_items_slider">
                <ul class="slider">
                    <?php
            
                    $args = array(
                        'post_type' => 'product',
						'post_status' => 'publish',
						'tax_query' => array(
							array(
								'taxonomy' => 'product_cat',
								'field' => 'slug',
								'terms' => $category
							)
						),
						'ignore_sticky_posts'   => 1,
						'posts_per_page' => $per_page
                    );
                    
                    $products = new WP_Query($args);
                    
                    if ( $products->have_posts() ) : ?>
                                
                        <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                    
                            <?php woocommerce_get_template_part( 'content', 'product' ); ?>
                
                        <?php endwhile; // end of the loop. ?>
                        
                    <?php
                    
                    endif; 
                    //wp_reset_query();
                    
                    ?>
                </ul>     
            </div>
        </div>
    
    </div>
    
    <?php } ?>

	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}


// [custom_best_sellers]
function shortcode_custom_best_sellers($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"title" => '',
		'per_page'  => '12',
        'orderby' => 'date',
        'order' => 'desc'
	), $atts));
	ob_start();
	?>
    
    <?php 
	/**
	* Check if WooCommerce is active
	**/
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	?>
    
    <script>
	(function($){
		$(window).load(function(){
		
			/* items_slider */
			$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_slider').iosSlider({
				snapToChildren: true,
				desktopClickDrag: true,
				scrollbar: true,
				scrollbarHide: true,
				scrollbarLocation: 'bottom',
				scrollbarHeight: '2px',
				scrollbarBackground: '#ccc',
				scrollbarBorder: '0',
				scrollbarMargin: '0',
				scrollbarOpacity: '1',
				navNextSelector: $('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_sliders_nav .big_arrow_right'),
				navPrevSelector: $('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_sliders_nav .big_arrow_left'),
				onSliderLoaded: custom_best_sellers_UpdateSliderHeight,
				//onSlideChange: custom_best_sellers_UpdateSliderHeight,
				//onSliderResize: custom_best_sellers_UpdateSliderHeight
			});
			
			function custom_best_sellers_UpdateSliderHeight(args) {
									
				//currentSlide = args.currentSlideNumber;
				
				/* update height of the first slider */
				
				var t = 0; // the height of the highest element (after the function runs)
				var t_elem;  // the highest element (after the function runs)
				$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .product_item').each(function () {
					$this = $(this);
					if ( $this.outerHeight() > t ) {
						t_elem = this;
						t = $this.outerHeight();
					}
				});
	
				setTimeout(function() {
					//var setHeight = $('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_slider .product_item:eq(' + (args.currentSlideNumber-1) + ')').outerHeight(true);
					//$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_slider').animate({ height: setHeight+20 }, 300);
					$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_slider').css({
						height: t+30,
						visibility: "visible"
					});
				},300);
				
			}
			
		})
	})(jQuery);
	</script>
    
    <div class="gbtr_items_slider_id_<?php echo $sliderrandomid ?>">
    
        <div class="gbtr_items_sliders_header">
            <div class="gbtr_items_sliders_title">
                <div class="gbtr_featured_section_title"><strong><?php echo $title ?></strong></div>
            </div>
            <div class="gbtr_items_sliders_nav">                        
                <a class='big_arrow_right'></a>
                <a class='big_arrow_left'></a>
                <div class='clr'></div>
            </div>
        </div>
    
        <div class="gbtr_bold_sep"></div>   
    
        <div class="gbtr_items_slider_wrapper">
            <div class="gbtr_items_slider">
                <ul class="slider">
                    <?php
            
                    $args = array(
                        'post_type' => 'product',
						'post_status' => 'publish',
						'ignore_sticky_posts'   => 1,
						'posts_per_page' => $per_page,
						'meta_key' 		=> 'total_sales',
    					'orderby' 		=> 'meta_value'
                    );
                    
                    $products = new WP_Query( $args );
                    
                    if ( $products->have_posts() ) : ?>
                                
                        <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                    
                            <?php woocommerce_get_template_part( 'content', 'product' ); ?>
                
                        <?php endwhile; // end of the loop. ?>
                        
                    <?php
                    
                    endif; 
                    //wp_reset_query();
                    
                    ?>
                </ul>     
            </div>
        </div>
    
    </div>
    
    <?php } ?>

	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}


function string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit) {
		array_pop($words);
		return implode(' ', $words) . '...';
	} else {
		return $string;
	}
}

// [from_the_blog]
function shortcode_from_the_blog($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"title" => '',
		"posts" => '2',
		"category" => ''
	), $atts));
	ob_start();
	?> 
    
    <script>
	jQuery(document).ready(function($) {
		/* items_slider */
		$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_slider').iosSlider({
			snapToChildren: true,
			desktopClickDrag: true,
			scrollbar: true,
			scrollbarHide: true,
			scrollbarLocation: 'bottom',
			scrollbarHeight: '2px',
			scrollbarBackground: '#ccc',
			scrollbarBorder: '0',
			scrollbarMargin: '0',
			scrollbarOpacity: '1',
			navNextSelector: $('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_sliders_nav .big_arrow_right'),
			navPrevSelector: $('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_sliders_nav .big_arrow_left'),
			onSliderLoaded: gbtr_items_slider_UpdateSliderHeight,
		});
		
		function gbtr_items_slider_UpdateSliderHeight(args) {
			
			/* update height of the first slider */
			
			var t = 0; // the height of the highest element (after the function runs)
			var t_elem;  // the highest element (after the function runs)
			$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .from_the_blog_item').each(function () {
				$this = $(this);
				if ( $this.outerHeight() > t ) {
					t_elem = this;
					t = $this.outerHeight();
				}
			});

			setTimeout(function() {
				$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_slider').css({
					height: t+30,
					visibility: "visible"
				});
			});
			
		}
	});
	</script>
    
    <div class="gbtr_items_slider_id_<?php echo $sliderrandomid ?>">
    
        <div class="gbtr_items_sliders_header">
            <div class="gbtr_items_sliders_title">
                <div class="gbtr_featured_section_title"><strong><?php echo $title ?></strong></div>
            </div>
            <div class="gbtr_items_sliders_nav">                        
                <a class='big_arrow_right'></a>
                <a class='big_arrow_left'></a>
                <div class='clr'></div>
            </div>
        </div>
    
        <div class="gbtr_bold_sep"></div>   
    
        <div class="gbtr_items_slider_wrapper">
            <div class="gbtr_items_slider from_the_blog">
                <ul class="slider">
					
					<?php
            
                    $args = array(
                        'post_status' => 'publish',
                        'post_type' => 'post',
						'category_name' => $category,
                        'posts_per_page' => $posts
                    );
                    
                    $recentPosts = new WP_Query( $args );
                    
                    if ( $recentPosts->have_posts() ) : ?>
                                
                        <?php while ( $recentPosts->have_posts() ) : $recentPosts->the_post(); ?>
                    
                            <?php $post_format = get_post_format(get_the_ID()); ?>
                            
                            <li class="from_the_blog_item <?php echo $post_format; ?> <?php if ( !has_post_thumbnail()) : ?>no_thumb<?php endif; ?>">
                                
                                <a class="from_the_blog_img" href="<?php the_permalink() ?>">
                                    <?php if ( has_post_thumbnail()) : ?>
                                    	<?php the_post_thumbnail('recent_posts_shortcode') ?>
                                    <?php else : ?>
                                    	<span class="from_the_blog_noimg"></span>
                                    <?php endif; ?>
                                    <span class="from_the_blog_date">
										<span class="from_the_blog_date_day"><?php echo get_the_time('d', get_the_ID()); ?></span>
                                        <span class="from_the_blog_date_month"><?php echo get_the_time('M', get_the_ID()); ?></span>
                                    </span>
                                    <?php if ($post_format != "") : ?>
                                    <span class="post_format_icon"></span>
                                    <?php endif ?>
                                </a>
                                
                                <div class="from_the_blog_content">
                                
                                    <?php if ( ($post_format == "") || ($post_format == "video") ) : ?>
                                    	<a class="from_the_blog_title" href="<?php the_permalink() ?>"><h3><?php echo string_limit_words(get_the_title(), 5); ?></h3></a>
                                    <?php endif ?>	
                                                                
                                    <div class="from_the_blog_excerpt">
										<?php											
											$limit_words = 12;
											if ( ($post_format == "status") || ($post_format == "quote") || ($post_format == "aside") ) {
												$limit_words = 40;
											}
											$excerpt = get_the_excerpt();
                                            echo string_limit_words($excerpt, $limit_words);
                                        ?>
                                    </div>

                                    <?php if ( ($post_format == "") || ($post_format == "quote") || ($post_format == "video") || ($post_format == "image") || ($post_format == "audio") || ($post_format == "gallery") ) : ?>
                                    	<div class="from_the_blog_comments">
											<?php comments_popup_link( __( 'Leave a comment', 'theretailer' ), __( '1 Comment', 'theretailer' ), __( '% Comments', 'theretailer' ), '', '' ); ?>
                                        </div>
                                    <?php endif ?>
                                
                                </div>
                                
                            </li>
                
                        <?php endwhile; // end of the loop. ?>
                        
                    <?php

                    endif;
					//wp_reset_query();
                    
                    ?>
                </ul>     
            </div>
        </div>
    
    </div>

	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

// [from_the_portfolio]
function shortcode_from_the_portfolio($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		"posts" => '4'
	), $atts));
	ob_start();
	?> 

    <div class="from_the_portfolio">

            <?php
    
            $args = array(
                'post_status' => 'publish',
                'post_type' => 'portfolio',
                'posts_per_page' => $posts
            );
            
            $recentPosts = new WP_Query( $args );
            
            if ( $recentPosts->have_posts() ) : ?>
                        
                <?php while ( $recentPosts->have_posts() ) : $recentPosts->the_post(); ?>
            
                    <div class="from_the_portfolio_item">
                        <a class="from_the_portfolio_img" href="<?php the_permalink() ?>">
                            <?php if ( has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('portfolio_4_col') ?>
                            <?php else : ?>
                            <span class="from_the_portfolio_noimg"></span>
                            <?php endif; ?>
                        </a>
                        
                        <a class="from_the_portfolio_title" href="<?php the_permalink() ?>"><h3><?php the_title(); ?></h3></a>
                        
                        <div class="portfolio_sep"></div>	
                                                    
                        <div class="from_the_portfolio_cats">
                            <?php 
                            echo strip_tags (
                                get_the_term_list( get_the_ID(), 'portfolio_filter', "",", " )
                            );
                            ?>
                        </div>
                    </div>
        
                <?php endwhile; // end of the loop. ?>
                
                <div class="clr"></div>
                
            <?php

            endif;
            //wp_reset_query();
            
            ?>   
    </div>


	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

// [slide_everything]
function shortcode_slide_everything($atts, $content=null, $code) {
	$sliderrandomid = rand();
	ob_start();
	?> 
    
    <script>
	
	(function($){
		$(window).load(function(){
			
				/* items_slider */
				$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_slider').iosSlider({
					snapToChildren: true,
					desktopClickDrag: true,
					scrollbar: true,
					scrollbarHide: true,
					scrollbarLocation: 'bottom',
					scrollbarHeight: '2px',
					scrollbarBackground: '#ccc',
					scrollbarBorder: '0',
					scrollbarMargin: '0',
					scrollbarOpacity: '1',
					navNextSelector: $('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .slide_everything_next'),
					navPrevSelector: $('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .slide_everything_previous'),
					onSliderLoaded: update_height_slide_everything,
					onSlideChange: update_height_slide_everything,
					onSliderResize: update_height_slide_everything
				});
				
				function update_height_slide_everything(args) {
					
					/* update height of the first slider */
					
					setTimeout(function() {
						var setHeight = $('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .slide_everything .slide_everything_item:eq(' + (args.currentSlideNumber-1) + ')').outerHeight(true);
						$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .slide_everything').css({ visibility: "visible" });
						$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .slide_everything').stop().animate({ height: setHeight+20 }, 300);
					},0);
					
				}
			
		})
	})(jQuery);

	</script>
    
    <div class="gbtr_items_slider_id_<?php echo $sliderrandomid ?> slide_everything">  
    
        <div class="gbtr_items_slider_wrapper">
            <div class="gbtr_items_slider slide_everything">
                <ul class="slider">
                    
                    <?php
                    if (!preg_match_all("/(.?)\[(slide)\b(.*?)(?:(\/))?\](?:(.+?)\[\/slide\])?(.?)/s", $content, $matches)) {
						return do_shortcode($content);
					} 
					else {
						$output = '';
						for($i = 0; $i < count($matches[0]); $i++) {
										
							$output .= '<li class="slide_everything_item">
											<div class="slide_everything_content">' . do_shortcode(trim($matches[5][$i])) .'</div>
										</li>';
						}
						echo $output;
						
					}
					?>

                </ul>
                                       
                <div class='slide_everything_previous'></div>
                <div class='slide_everything_next'></div>
                    
            </div>
        </div>
    
    </div>

	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}



// [products_slider]
function shortcode_products_slider($atts, $content=null, $code) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		'per_page'  => '12',
        'orderby' => 'date',
        'order' => 'desc'
	), $atts));
	ob_start();
	?> 
    
    <script>
	(function($){
	   $(window).load(function(){
		    
			/* items_slider */
			$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .gbtr_items_slider').iosSlider({
				snapToChildren: true,
				desktopClickDrag: true,
				scrollbar: true,
				scrollbarHide: true,
				scrollbarLocation: 'bottom',
				scrollbarHeight: '2px',
				scrollbarBackground: '#ccc',
				scrollbarBorder: '0',
				scrollbarMargin: '0',
				scrollbarOpacity: '1',
				navNextSelector: $('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .products_slider_next'),
				navPrevSelector: $('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .products_slider_previous'),
				onSliderLoaded: update_height_products_slider,
				onSlideChange: update_height_products_slider,
				onSliderResize: update_height_products_slider
			});
			
			function update_height_products_slider(args) {
				
				/* update height of the first slider */
	
				//alert (setHeight);
				setTimeout(function() {
					var setHeight = $('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .products_slider_item:eq(' + (args.currentSlideNumber-1) + ')').outerHeight(true);
					$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .products_slider').css({ visibility: "visible" });
					$('.gbtr_items_slider_id_<?php echo $sliderrandomid ?> .products_slider').stop().animate({ height: setHeight+20 }, 300);
				},0);
				
			}
			
			$(".style_1 .products_slider_item").mouseenter(function(){
				$(this).find('.products_slider_infos').stop().fadeTo(100, 0);
				$(this).find('.products_slider_images img').stop().fadeTo(100, 0.1, function() {
					$(this).parent().parent().parent().find('.products_slider_infos').stop().fadeTo(200, 1);
				});
				//alert("aaaaaaa");
			}).mouseleave(function(){
				$(this).find('.products_slider_images img').stop().fadeTo(100, 1);
				$(this).find('.products_slider_infos').stop().fadeTo(100, 0);
			});
			
	   })
	})(jQuery);

	</script>
    
    <div class="gbtr_items_slider_id_<?php echo $sliderrandomid ?> products_slider">  
    
        <div class="gbtr_items_slider_wrapper">
            <div class="gbtr_items_slider products_slider">
                <ul class="slider style_1">
                    
                    <?php
            
					$args = array(
						'post_status' => 'publish',
						'post_type' => 'product',
						'ignore_sticky_posts'   => 1,
						'meta_key' => '_featured',
						'meta_value' => 'yes',
						'posts_per_page' => $per_page,
						'orderby' => $orderby,
						'order' => $order,
					);
					
					$products = new WP_Query( $args );
					
					if ( $products->have_posts() ) : ?>
								
						<?php while ( $products->have_posts() ) : $products->the_post(); ?>
                    
                            <?php woocommerce_get_template_part( 'content', 'product-slider' ); ?>
                
                        <?php endwhile; // end of the loop. ?>
						
					<?php
					
					endif; 
					//wp_reset_query();
					
					?>

                </ul>
                                       
                <div class='products_slider_previous'></div>
                <div class='products_slider_next'></div>
                    
            </div>
        </div>
    
    </div>

	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}


// [sourcecode]
function shortcode_sourcecode($params = array(), $content = null) {
	$content = preg_replace('#<br\s*/?>#', "", $content);
	$sourcecode = '<pre class="shortcode_sourcecode">'.$content.'</pre>';
	return $sourcecode;
}

// [code]
function shortcode_code($params = array(), $content = null) {
	$content = preg_replace('#<br\s*/?>#', "", $content);
	$code = '<span class="shortcode_code">'.$content.'</span>';
	return $code;
}

// [testimonial_left]
function shortcode_testimonial_left($params = array(), $content = null) {
	extract(shortcode_atts(array(
		"image_url" => '',
		"name" => '',
		"company" => ''
	), $params));
	$content = preg_replace('#<br\s*/?>#', "", $content);
	$testimonial_left = '
	<div class="testimonial_left">
		<div class="testimonial_left_content">
			<div><span>'.$content.'</span></div>
		</div>
		<div class="testimonial_left_author">
			<img src="'.$image_url.'" alt="'.$name.'" />
			<h4>'.$name.'</h4>
			<h5>'.$company.'</h5>
		</div>
		<div class="clr"></div>
	</div>
	';
	return $testimonial_left;
}

// [testimonial_right]
function shortcode_testimonial_right($params = array(), $content = null) {
	extract(shortcode_atts(array(
		"image_url" => '',
		"name" => '',
		"company" => ''
	), $params));
	$content = preg_replace('#<br\s*/?>#', "", $content);
	$testimonial_right = '
	<div class="testimonial_right">
		<div class="testimonial_right_content">
			<div><span>'.$content.'</span></div>
		</div>
		<div class="testimonial_right_author">
			<img src="'.$image_url.'" alt="'.$name.'" />
			<h4>'.$name.'</h4>
			<h5>'.$company.'</h5>
		</div>
		<div class="clr"></div>
	</div>
	';
	return $testimonial_right;
}

// [light_button]
function shortcode_light_button($params = array(), $content = null) {
	extract(shortcode_atts(array(
		"url" => '',
		"target" => ''
	), $params));
	$light_button = '<a href="'.$url.'" class="light_button" target="'.$target.'">'.$content.'</a>';
	return $light_button;
}

// [dark_button]
function shortcode_dark_button($params = array(), $content = null) {
	extract(shortcode_atts(array(
		"url" => '',
		"target" => ''
	), $params));
	$dark_button = '<a href="'.$url.'" class="dark_button" target="'.$target.'">'.$content.'</a>';
	return $dark_button;
}

// [light_grey_button]
function shortcode_light_grey_button($params = array(), $content = null) {
	extract(shortcode_atts(array(
		"url" => '',
		"target" => ''
	), $params));
	$light_grey_button = '<a href="'.$url.'" class="light_grey_button" target="'.$target.'">'.$content.'</a>';
	return $light_grey_button;
}

// [dark_grey_button]
function shortcode_dark_grey_button($params = array(), $content = null) {
	extract(shortcode_atts(array(
		"url" => '',
		"target" => ''
	), $params));
	$dark_grey_button = '<a href="'.$url.'" class="dark_grey_button" target="'.$target.'">'.$content.'</a>';
	return $dark_grey_button;
}

// [custom_button]
function shortcode_custom_button($params = array(), $content = null) {
	extract(shortcode_atts(array(
		"url" => '',
		"color" => '',
		"bg_color" => '',
		"target" => ''
	), $params));
	$custom_button = '<a href="'.$url.'" class="custom_button" target="'.$target.'" style="background-color:'.$bg_color.'; border-color:'.$bg_color.'; color:'.$color.';">'.$content.'</a>';
	return $custom_button;
}


// [google_map]
function shortcode_google_map($atts, $content=null, $code) {
	extract(shortcode_atts(array(
		'lat'  => '',
        'long' => '',
        'height' => '400px',
		'color' => '#b39964',
		'button_text' => __( 'Get Directions', 'theretailer' )
	), $atts));
	ob_start();
	?> 
    
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript">
    
    function initialize() {
        var styles = {
            'theretailer':  [{
            "featureType": "administrative",
            "stylers": [
              { "visibility": "on" }
            ]
          },
          {
            "featureType": "road",
            "stylers": [
              { "visibility": "on" },
              { "hue": "<?php echo $color ?>" }
            ]
          },
          {
            "stylers": [
			  { "visibility": "on" },
			  { "hue": "<?php echo $color ?>" },
			  { "saturation": -50 }
            ]
          }
        ]};
        
        var myLatlng = new google.maps.LatLng(<?php echo $lat ?>, <?php echo $long ?>);
        var myOptions = {
            zoom: 17,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true,
            mapTypeId: 'theretailer',
            draggable: true,
            zoomControl: false,
			panControl: false,
			mapTypeControl: false,
			scaleControl: false,
			streetViewControl: false,
			overviewMapControl: false,
            scrollwheel: false,
            disableDoubleClickZoom: false
        }
        var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
        var styledMapType = new google.maps.StyledMapType(styles['theretailer'], {name: 'theretailer'});
        map.mapTypes.set('theretailer', styledMapType);
        
        var marker = new google.maps.Marker({
            position: myLatlng, 
            map: map,
            title:""
        });   
    }
    
    google.maps.event.addDomListener(window, 'load', initialize);
    google.maps.event.addDomListener(window, 'resize', initialize);
    
    </script>
    
    <div id="map_container">
        <div id="map_canvas" style="height:<?php echo $height ?>;"></div>
        <div id="map_overlay_top"></div>
        <div id="map_overlay_bottom"></div>
        <div class="map_button_wrapper"><div class="map_button_wrapped"><a href="https://maps.google.com/maps?saddr=&amp;daddr=<?php echo $lat ?>,<?php echo $long ?>&amp;hl=en" id="map_button" target="_blank"><?php echo $button_text ?></a></div></div>
    </div>

	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

/* Add shortcodes */

add_shortcode('full_column', 'content_grid_12');
add_shortcode('one_half', 'content_grid_6');
add_shortcode('one_third', 'content_grid_4');
add_shortcode('two_third', 'content_grid_2_3');
add_shortcode('one_fourth', 'content_grid_3');
add_shortcode('one_sixth', 'content_grid_2');
add_shortcode('one_twelves', 'content_grid_1');
add_shortcode('column_demo', 'column_demo');
add_shortcode('separator', 'shortcode_separator');
add_shortcode('empty_separator', 'shortcode_empty_separator');
add_shortcode('featured_box', 'shortcode_big_box_txt_bg');
add_shortcode('text_block', 'shortcode_text_block');
add_shortcode('featured_1', 'shortcode_featured_1');
add_shortcode('section_title', 'section_title');
add_shortcode( 'tabgroup', 'tabgroup' );
add_shortcode( 'tab', 'tab' );
add_shortcode('team_member', 'team_member');
add_shortcode('bold_title', 'bold_title');
add_shortcode('our_services', 'our_services');
add_shortcode('accordion', 'accordion');
add_shortcode('container', 'shortcode_container');
add_shortcode('banner_simple', 'banner_simple');
add_shortcode("custom_featured_products", "shortcode_custom_featured_products");
add_shortcode("custom_on_sale_products", "shortcode_custom_on_sale_products");
add_shortcode("custom_latest_products", "shortcode_custom_latest_products");
add_shortcode("products_by_category", "shortcode_products_by_category");
add_shortcode("custom_best_sellers", "shortcode_custom_best_sellers");
add_shortcode("from_the_blog", "shortcode_from_the_blog");
add_shortcode("from_the_portfolio", "shortcode_from_the_portfolio");
add_shortcode("slide_everything", "shortcode_slide_everything");
add_shortcode("products_slider", "shortcode_products_slider");
add_shortcode('sourcecode', 'shortcode_sourcecode');
add_shortcode('code', 'shortcode_code');
add_shortcode('testimonial_left', 'shortcode_testimonial_left');
add_shortcode('testimonial_right', 'shortcode_testimonial_right');
add_shortcode('light_button', 'shortcode_light_button');
add_shortcode('dark_button', 'shortcode_dark_button');
add_shortcode('light_grey_button', 'shortcode_light_grey_button');
add_shortcode('dark_grey_button', 'shortcode_dark_grey_button');
add_shortcode('custom_button', 'shortcode_custom_button');
add_shortcode("google_map", "shortcode_google_map");



/*****************************************************************/
/******************* THE RETAILER SETTINGS ***********************/
/*****************************************************************/

if ( ! isset( $content_width ) ) $content_width = 620; /* pixels */

if ( ! function_exists( 'theretailer_setup' ) ) :
function theretailer_setup() {
	
	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/extras.php' );

	/**
	 * Customizer additions
	 */
	require( get_template_directory() . '/inc/customizer.php' );
	
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on theretailer, use a find and replace
	 * to change 'theretailer' to the name of your theme in all the template files
	 */

	load_theme_textdomain( 'theretailer', get_template_directory() . '/language' );
	$locale = get_locale();
	$locale_file = get_template_directory() . "/language/$locale.php";
	if ( is_readable($locale_file) ) require_once($locale_file);

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	
	
	
	
	function theretailer_register_custom_background() {
		$args = array(
			'default-color' => 'ffffff',
			'default-image' => '',
		);
	
		$args = apply_filters( 'theretailer_custom_background_args', $args );
	
		if ( function_exists( 'wp_get_theme' ) ) {
			add_theme_support( 'custom-background', $args );
		} else {
			define( 'BACKGROUND_COLOR', $args['default-color'] );
			if ( ! empty( $args['default-image'] ) )
				define( 'BACKGROUND_IMAGE', $args['default-image'] );
			add_custom_background();
		}
	}
	add_action( 'after_setup_theme', 'theretailer_register_custom_background' );
	
	

	function theretailer_add_editor_styles() {
		add_editor_style( 'custom-editor-style.css' );
	}
	add_action( 'init', 'theretailer_add_editor_styles' );

	/**
	 * This theme uses wp_nav_menu() in 4 location.
	 */
	register_nav_menus( array(
		'tools' => __( 'Top Header Menu', 'theretailer' ),
		'primary' => __( 'Primary Menu', 'theretailer' ),
		'secondary' => __( 'Secondary Menu', 'theretailer' ),
		'my_account' => __( 'My Account Menu', 'theretailer' ),
	) );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'video', 'audio', 'gallery', 'image', 'status', 'quote') );
}
endif; // theretailer_setup
add_action( 'after_setup_theme', 'theretailer_setup' );



/*******************************************************/
/******************* WOOCOMMERCE ***********************/
/*******************************************************/


function woocommerce_output_related_products() {
	woocommerce_related_products(12,12);
}

if (!isset($theretailer_theme_options['gb_header_style'])) $theretailer_theme_options['gb_header_style'] = "0";

if (($theretailer_theme_options['gb_header_style']) && ($theretailer_theme_options['gb_header_style'] == "1")) {

// Handle cart in header fragment for ajax add to cart
add_filter('add_to_cart_fragments', 'woocommerceframework_header_add_to_cart_fragment');
if (!function_exists('woocommerceframework_header_add_to_cart_fragment')) {
	function woocommerceframework_header_add_to_cart_fragment( $fragments ) {		
		global $woocommerce;
		global $theretailer_theme_options;		
		ob_start();
		?>
		
        <!---->
                                    
        <li class="shopping_bag_centered_style">                       
            
            <?php _e('Shopping Bag', 'theretailer'); ?> <span class="items_number"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
        
            <div class="gbtr_minicart_wrapper">
            <div class="gbtr_minicart">
            <?php                                    
            echo '<ul class="cart_list">';                                        
                if (sizeof($woocommerce->cart->cart_contents)>0) : foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) :
                
                    $_product = $cart_item['data'];                                            
                    if ($_product->exists() && $cart_item['quantity']>0) :                                            
                        echo '<li class="cart_list_product">';                                                
                            echo '<a class="cart_list_product_img" href="'.get_permalink($cart_item['product_id']).'">' . $_product->get_image().'</a>';                                                    
                            echo '<div class="cart_list_product_title">';
                                $gbtr_product_title = $_product->get_title();
                                //$gbtr_short_product_title = (strlen($gbtr_product_title) > 28) ? substr($gbtr_product_title, 0, 25) . '...' : $gbtr_product_title;
                                echo '<a href="'.get_permalink($cart_item['product_id']).'">' . apply_filters('woocommerce_cart_widget_product_title', $gbtr_product_title, $_product) . '</a>';
                                echo '<div class="cart_list_product_quantity">'.__('Quantity:', 'theretailer').' '.$cart_item['quantity'].'</div>';
                            echo '</div>';
                            echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __('Remove this item', 'theretailer') ), $cart_item_key );
                            echo '<div class="cart_list_product_price">'.woocommerce_price($_product->get_price()).'</div>';
                            echo '<div class="clr"></div>';                                                
                        echo '</li>';                                         
                    endif;                                        
                endforeach;
                ?>
                        
                <div class="minicart_total_checkout">                                        
                    <?php _e('Cart subtotal', 'theretailer'); ?><span><?php echo $woocommerce->cart->get_cart_total(); ?></span>                                   
                </div>
                
                <a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="button gbtr_minicart_cart_but"><?php _e('View Shopping Bag', 'theretailer'); ?></a>   
                
                <a href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>" class="button gbtr_minicart_checkout_but"><?php _e('Proceed to Checkout', 'theretailer'); ?></a>
                
                <?php                                        
                else: echo '<li class="empty">'.__('No products in the shopping bag.','theretailer').'</li>'; endif;                                    
            echo '</ul>';                                    
            ?>                                                                        

            </div>
            </div>
            
            <!--<a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="gbtr_little_shopping_bag_wrapper_mobiles"><span><?php echo $woocommerce->cart->cart_contents_count; ?></span></a>-->
            
            <script type="text/javascript">// <![CDATA[
			jQuery(function(){
				jQuery(".cart_list_product_title a").each(function(i){
					len = jQuery(this).text().length;
					if(len>25) {
						jQuery(this).text(jQuery(this).text().substr(0,25)+'...');
					}
				});
			});
			// ]]></script>

        </li>
        
        <!---->
        
        <script type="text/javascript">
		jQuery(document).ready(function($) {
			"use strict";
			favicon.badge(<?php echo $woocommerce->cart->cart_contents_count; ?>);
		});
		</script>

		<?php		
		$fragments['.shopping_bag_centered_style'] = ob_get_clean();		
		return $fragments;
	}
}

} else {

// Handle cart in header fragment for ajax add to cart
add_filter('add_to_cart_fragments', 'woocommerceframework_header_add_to_cart_fragment');
if (!function_exists('woocommerceframework_header_add_to_cart_fragment')) {
	function woocommerceframework_header_add_to_cart_fragment( $fragments ) {		
		global $woocommerce;
		global $theretailer_theme_options;		
		ob_start();
		?>
		
        <!---->
                    
        <div class="gbtr_dynamic_shopping_bag">
    
            <div class="gbtr_little_shopping_bag_wrapper 
            <?php if (($theretailer_theme_options['shopping_bag_style']) && ($theretailer_theme_options['shopping_bag_style'] == "style2")) { ?>
                shopping_bag_mobile_style
            <?php } else { ?>
                shopping_bag_default_style
            <?php } ?>
            
            <?php if ((!$theretailer_theme_options['shopping_bag_in_header']) || ($theretailer_theme_options['shopping_bag_in_header'] == "1")) { ?>
                shopping_bag_in_header
            <?php } else{ ?>
                no_shopping_bag_in_header
            <?php } ?>
            ">
                <div class="gbtr_little_shopping_bag">
                    <div class="title"><a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>"><?php _e('Shopping Bag', 'theretailer'); ?></a></div>
                    <div class="overview"><?php echo $woocommerce->cart->get_cart_total(); ?> <span class="minicart_items">/ <?php echo $woocommerce->cart->cart_contents_count; ?> <?php _e('item(s)', 'theretailer'); ?></span></div>
                    <div class="gb_cart_contents_count"><?php echo $woocommerce->cart->cart_contents_count; ?></div>
                </div>
                <div class="gbtr_minicart_wrapper">
                    <div class="gbtr_minicart">
                    <?php                                    
                    echo '<ul class="cart_list">';                                        
                        if (sizeof($woocommerce->cart->cart_contents)>0) : foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) :
                        
                            $_product = $cart_item['data'];                                            
                            if ($_product->exists() && $cart_item['quantity']>0) :                                            
                                echo '<li class="cart_list_product">';                                                
                                    echo '<a class="cart_list_product_img" href="'.get_permalink($cart_item['product_id']).'">' . $_product->get_image().'</a>';                                                    
                                    echo '<div class="cart_list_product_title">';
                                        $gbtr_product_title = $_product->get_title();
                                        //$gbtr_short_product_title = (strlen($gbtr_product_title) > 28) ? substr($gbtr_product_title, 0, 25) . '...' : $gbtr_product_title;
                                        echo '<a href="'.get_permalink($cart_item['product_id']).'">' . apply_filters('woocommerce_cart_widget_product_title', $gbtr_product_title, $_product) . '</a>';
                                        echo '<div class="cart_list_product_quantity">'.__('Quantity:', 'theretailer').' '.$cart_item['quantity'].'</div>';
                                    echo '</div>';
                                    echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __('Remove this item', 'theretailer') ), $cart_item_key );
                                    echo '<div class="cart_list_product_price">'.woocommerce_price($_product->get_price()).'</div>';
                                    echo '<div class="clr"></div>';                                                
                                echo '</li>';                                         
                            endif;                                        
                        endforeach;
                        ?>
                                
                        <div class="minicart_total_checkout">                                        
                            <?php _e('Cart subtotal', 'theretailer'); ?><span><?php echo $woocommerce->cart->get_cart_total(); ?></span>                                   
                        </div>
                        
                        <a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="button gbtr_minicart_cart_but"><?php _e('View Shopping Bag', 'theretailer'); ?></a>   
                        
                        <a href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>" class="button gbtr_minicart_checkout_but"><?php _e('Proceed to Checkout', 'theretailer'); ?></a>
                        
                        <?php                                        
                        else: echo '<li class="empty">'.__('No products in the shopping bag.','theretailer').'</li>'; endif;                                    
                    echo '</ul>';                                    
                    ?>                                                                        
    
                    </div>
                </div>
                
            </div>
            
            <a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="gbtr_little_shopping_bag_wrapper_mobiles"><span><?php echo $woocommerce->cart->cart_contents_count; ?></span></a>
        
        </div>
        
        <script type="text/javascript">// <![CDATA[
        jQuery(function(){
			jQuery(".cart_list_product_title a").each(function(i){
				len = jQuery(this).text().length;
				if(len>25) {
					jQuery(this).text(jQuery(this).text().substr(0,25)+'...');
				}
			});
        });
        // ]]></script>
        
        <!---->
        
        <script type="text/javascript">
		jQuery(document).ready(function($) {
			"use strict";
			favicon.badge(<?php echo $woocommerce->cart->cart_contents_count; ?>);
		});
		</script>

		<?php		
		$fragments['.gbtr_dynamic_shopping_bag'] = ob_get_clean();		
		return $fragments;
	}
}

}

// Sidebars
function theretailer_widgets_init() {
	
	global $theretailer_theme_options;
	
	if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'name' => __( 'Sidebar', 'theretailer' ),
			'id' => 'sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',
		));
		
		register_sidebar(array(
			'name' => __( 'Product listing', 'theretailer' ),
			'id' => 'widgets_product_listing',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',
		));
		
		if (isset($theretailer_theme_options['light_footer_layout'])) {
			if ((!$theretailer_theme_options['light_footer_layout']) || ($theretailer_theme_options['light_footer_layout'] == "4col")) {
				$light_footer_grid = 3;
			} else {
				$light_footer_grid = 4;
			}
		} else {
			$light_footer_grid = 4;
		}
		
		register_sidebar(array(
			'name' => __( 'Light footer', 'theretailer' ),
			'id' => 'widgets_light_footer',
			'before_widget' => '<div class="grid_'.$light_footer_grid.'"><div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div></div>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',
		));
		
		
		if (isset($theretailer_theme_options['dark_footer_layout'])) {
			if ((!$theretailer_theme_options['dark_footer_layout']) || ($theretailer_theme_options['dark_footer_layout'] == "4col")) {
				$dark_footer_grid = 3;
			} else {
				$dark_footer_grid = 4;
			}
		} else {
			$dark_footer_grid = 4;
		}
		
		register_sidebar(array(
			'name' => __( 'Dark footer', 'theretailer' ),
			'id' => 'widgets_dark_footer',
			'before_widget' => '<div class="grid_'.$dark_footer_grid.'"><div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div></div>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',
		));
	}
}
add_action( 'widgets_init', 'theretailer_widgets_init' );

/*********************************************************************************************/
/******************* ADD SHORTCODES TO THE WP EDITOR (VISUAL AND TEXT) ***********************/
/*********************************************************************************************/

add_action('media_buttons','add_sc_select',11);
function add_sc_select(){
    global $shortcode_tags;
     /* ------------------------------------- */
     /* enter names of shortcode to exclude bellow */
     /* ------------------------------------- */
    $exclude = array("wp_caption", "embed", 'caption', 'mailchimpsf_widget', 'mailchimpsf_form', 'column_demo');
    echo '&nbsp;<select id="sc_select"><option>The Retailer Shortcodes</option>';
    $shortcodes_list = "";
	foreach ($shortcode_tags as $key => $val){
            if(!in_array($key,$exclude)){
            $shortcodes_list .= '<option value="['.$key.'][/'.$key.']">'.$key.'</option>';
            }
        }
     echo $shortcodes_list;
     echo '</select>';
}
add_action('admin_head', 'button_js');
function button_js() {
        echo '<script type="text/javascript">
        jQuery(document).ready(function(){
           jQuery("#sc_select").change(function() {
                          send_to_editor(jQuery("#sc_select :selected").val());
                          return false;
                });
        });
        </script>';
}


/*********************************************************************************************/
/******************* ADD prettyPhoto rel to [gallery] with link=file  ************************/
/*********************************************************************************************/

add_filter( 'wp_get_attachment_link', 'sant_prettyadd', 10, 6);
function sant_prettyadd ($content, $id, $size, $permalink, $icon, $text) {
    if ($permalink) {
    	return $content;    
    }
    $content = preg_replace("/<a/","<a class=\"fresco\" data-fresco-group=\"\"", $content, 1);
    return $content;
}

/*********************************************************************************************/
/********************************** Number of Products / Page  *******************************/
/*********************************************************************************************/
if ( (!isset($theretailer_theme_options['products_per_page'])) ) {
	$gb_products_per_page = 12;
} else {
	$gb_products_per_page = $theretailer_theme_options['products_per_page'];
}

add_filter( 'loop_shop_per_page', create_function( '$cols', 'return ' . $gb_products_per_page . ';' ), 20 );



/*********************************************************************************************/
/******************************** Remove mediaelement  ***************************************/
/*********************************************************************************************/

function theretailer_deregister() {
	wp_deregister_script('wp-mediaelement');
	wp_deregister_script('mediaelement');
	
	wp_deregister_style('wp-mediaelement');
	wp_deregister_style('mediaelement');
}
add_action('wp_enqueue_scripts', 'theretailer_deregister');





/*********************************************************************************************/
/******************************** Disable PRETTY PHOTO ***************************************/
/*********************************************************************************************/

/*
//DISABLE WOOCOMMERCE PRETTY PHOTO SCRIPTS
function my_deregister_javascript() {
	wp_deregister_script( 'prettyPhoto' );
	wp_deregister_script( 'prettyPhoto-init' );
}
add_action( 'wp_print_scripts', 'my_deregister_javascript', 100 );

//DISABLE WOOCOMMERCE PRETTY PHOTO STYLE
function my_deregister_styles() {
	wp_deregister_style( 'woocommerce_prettyPhoto_css' );
}
add_action( 'wp_print_styles', 'my_deregister_styles', 100 );
*/





/*********************************************************************************************/
/***************************** Set woocommerce images sizes ***********************************/
/*********************************************************************************************/

/**
 * Hook in on activation
 */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'yourtheme_woocommerce_image_dimensions', 1 );

/**
 * Define image sizes
 */
function yourtheme_woocommerce_image_dimensions() {
  	$catalog = array(
		'width' 	=> '190',	// px
		'height'	=> '243',	// px
		'crop'		=> 1 		// true
	);

	$single = array(
		'width' 	=> '510',	// px
		'height'	=> '652',	// px
		'crop'		=> 1 		// true
	);

	$thumbnail = array(
		'width' 	=> '114',	// px
		'height'	=> '145',	// px
		'crop'		=> 1 		// false
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}

// On supprime les differents bloc du dashboard
function disable_default_dashboard_widgets() {
	remove_meta_box('dashboard_right_now', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
	remove_meta_box('dashboard_primary', 'dashboard', 'core');			// Autres news WordPress
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');			// News WordPress
}
add_action('admin_menu', 'disable_default_dashboard_widgets');

// On supprime les elements du menu administration
function remove_admin_menus() {
	global $menu;
	$restricted = array( __('Dashboard'), __('Posts'), __('Media'), __('Links'), __('Pages'), __('Appearance'), __('Tools'), __('Users'), __('Settings'), __('Comments'), __('Plugins'));
	end ($menu);
 
	while (prev($menu)) {
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)) {
			unset($menu[key($menu)]);
		}
	}
}
add_action('admin_menu', 'remove_admin_menus');

// On modifie la page de login 
add_filter('login_headertitle', create_function(false,"return 'Tapascomprix';"));
add_filter('login_headerurl', create_function(false,"return 'http://www.tapascomprix.com';"));

// modification de la barre administration
function wp_admin_bar_new_page() {
	global $wp_admin_bar;
	$wp_admin_bar->add_menu( array( 'id' => 'new-page', 'title' => __( 'Add New Page' ), 'href' => admin_url( 'post-new.php?post_type=page' ) ) );
}
function sf_admin_bar() {
	remove_action( 'admin_bar_menu', 'wp_admin_bar_new_content_menu', 40 );
	remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 50 );
	add_action( 'admin_bar_menu', 'wp_admin_bar_new_page', 40 );
}
add_action('add_admin_bar_menus', 'sf_admin_bar');
// afficher la barre d'administration qu'aux administrateurs
if (!current_user_can('manage_options')) {
add_filter('show_admin_bar', '__return_false');
}
// afficher la barre d'administration qu'aux administrateurs et aux éditeurs
if (!current_user_can('edit_posts')) {
add_filter('show_admin_bar', '__return_false');
}
// custom tableau de bord
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
function my_custom_dashboard_widgets() {
wp_add_dashboard_widget('custom_help_widget', 'Help and Support', 'custom_dashboard_help');
}
function custom_dashboard_help() {
echo '<p>Bienvenu dans l\'espace d\'administration <b>Tapascomprix</b> ! Si vous avez besoin d\'aide à la soumission d\'un article, n\'hésitez pas à consulter le support technique.</p>';
}
// suppression des liens dans la barre d'aministration
function remove_admin_bar_links() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');          // Remove the WordPress logo
    $wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
    $wp_admin_bar->remove_menu('wporg');            // Remove the WordPress.org link
    $wp_admin_bar->remove_menu('documentation');    // Remove the WordPress documentation link
    $wp_admin_bar->remove_menu('support-forums');   // Remove the support forums link
    $wp_admin_bar->remove_menu('feedback');         // Remove the feedback link
    // $wp_admin_bar->remove_menu('site-name');        // Remove the site name menu
    // $wp_admin_bar->remove_menu('view-site');        // Remove the view site link
    $wp_admin_bar->remove_menu('updates');          // Remove the updates link
    $wp_admin_bar->remove_menu('comments');         // Remove the comments link
    // $wp_admin_bar->remove_menu('new-content');      // Remove the content link
    $wp_admin_bar->remove_menu('w3tc');             // If you use w3 total cache remove the performance link
    // $wp_admin_bar->remove_menu('my-account');       // Remove the user details tab
    $wp_admin_bar->remove_menu('posts'); 
}
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );

// on desactive la soumission d'article 
function remove_admin_menu ()
{ 
   // remove_menu_page('edit.php'); // on retire les articles
   remove_menu_page('edit-comments.php'); // on retire les commentaires
   remove_menu_page( 'woothemes' ); // on retire la configuration du theme 
}
add_action('admin_menu', 'remove_admin_menu'); 

// suppression de sous menu inutiles


function adjust_the_wp_menu() {
  $page = remove_submenu_page( 'index.php', 'woothemes-plugin-updater' );
}
add_action( 'admin_menu', 'adjust_the_wp_menu', 999 );


// on reroute les utilisateurs pour se logguer vers /mon-compte
function site_router(){
	$root = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
	$url = str_replace( $root, '', $_SERVER['REQUEST_URI']);
	$url = explode('/',$url);
	
	if(count($url) == 1 && $url[0] == 'login'){
		header('location:mon-compte');
	}
}
add_action('send_headers','site_router');

// modification des noms menus
function replace_woocommerce( $menu ) {
	
	// $menu = str_ireplace( 'original name', 'new name', $menu );
	$menu = str_ireplace( 'WooCommerce', 'Gestion des commandes', $menu );
	
	// return $menu array
	return $menu;
}
add_filter('gettext', 'replace_woocommerce');
add_filter('ngettext', 'replace_woocommerce');

