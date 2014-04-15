<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>
<?php

/*-----------------------------------------------------------------------------------*/
/* Start WooThemes Functions - Please refrain from editing this section */
/*-----------------------------------------------------------------------------------*/

// Define the theme-specific key to be sent to PressTrends.
define( 'WOO_PRESSTRENDS_THEMEKEY', 'zdmv5lp26tfbp7jcwiw51ix9sj389e712' );

// WooFramework init
require_once ( get_template_directory() . '/functions/admin-init.php' );

/*-----------------------------------------------------------------------------------*/
/* Load the theme-specific files, with support for overriding via a child theme.
/*-----------------------------------------------------------------------------------*/

$includes = array(
				'includes/theme-options.php', 			// Options panel settings and custom settings
				'includes/theme-functions.php', 		// Custom theme functions
				'includes/theme-actions.php', 			// Theme actions & user defined hooks
				'includes/theme-comments.php', 			// Custom comments/pingback loop
				'includes/theme-js.php', 				// Load JavaScript via wp_enqueue_script
				'includes/sidebar-init.php', 			// Initialize widgetized areas
				'includes/theme-widgets.php',			// Theme widgets
				'includes/theme-install.php',			// Theme installation
				'includes/theme-woocommerce.php'		// WooCommerce options
				);

// Allow child themes/plugins to add widgets to be loaded.
$includes = apply_filters( 'woo_includes', $includes );

foreach ( $includes as $i ) {
	locate_template( $i, true );
}

/*-----------------------------------------------------------------------------------*/
/* You can add custom functions below */
/*-----------------------------------------------------------------------------------*/


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
// function remove_admin_menus() {
// 	global $menu;
// 	$restricted = array( __('Dashboard'), __('Posts'), __('Media'), __('Links'), __('Pages'), __('Appearance'), __('Tools'), __('Users'), __('Settings'), __('Comments'), __('Plugins'));
// 	end ($menu);
 
// 	while (prev($menu)) {
// 		$value = explode(' ',$menu[key($menu)][0]);
// 		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)) {
// 			unset($menu[key($menu)]);
// 		}
// 	}
// }
// add_action('admin_menu', 'remove_admin_menus');

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

/*-----------------------------------------------------------------------------------*/
/* Don't add any code below here or the sky will fall down */
/*-----------------------------------------------------------------------------------*/
?>