<?php
#=================================================================#
# App function
#=================================================================#

#=======================#
# + Get style from Salient theme
#=======================#

function wpm_enqueue_styles()
{
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

add_action( 'wp_enqueue_scripts', 'wpm_enqueue_styles' );

#=======================#
# + Add custom style
#=======================#

function custom_main_styles() {	
	// Register 
	wp_register_style('bootstrap-app2', get_stylesheet_directory_uri() . '/assets/style/scss/vendors/_bootstrap.css');
	wp_register_style('custom-app2', get_stylesheet_directory_uri() . '/assets/style/stylesheets/app_v2.css');
	wp_register_style('custom-app2addon', get_stylesheet_directory_uri() . '/assets/style/stylesheets/addon.css');
	// Enqueue
	wp_enqueue_style('bootstrap-app2'); 
	wp_enqueue_style('custom-app2'); 
	wp_enqueue_style('custom-app2addon'); 
}

add_action('wp_enqueue_scripts', 'custom_main_styles');

#=======================#
# + Add custom scripts
#=======================#

function custom_main_scripts() {
    wp_enqueue_script( 'app', get_stylesheet_directory_uri() . '/assets/js/app.js', array(), '1.0.0', true );
    wp_enqueue_script('bootstrap', get_stylesheet_directory_uri() . '/assets/style/scss/vendors/_bootstrap.js'); 
}
add_action( 'wp_enqueue_scripts', 'custom_main_scripts' );



#=======================#
# + Latest articles widget footer category Actualites (id 46) 
#=======================#

add_filter('widget_posts_args','modify_widget');

function modify_widget() {
    $r = array( 'cat' => '46','posts_per_page' => 4, );
    return $r;
}

function my_mce_buttons_efi( $buttons ) {	
	/**
	 * Add in a core button that's disabled by default
	 */
	$buttons[] = 'underline';
	$buttons[] = 'fontsizeselect';

	return $buttons;
}
add_filter( 'mce_buttons_2', 'my_mce_buttons_efi' );

#=======================#
# + Require function
#=======================#
require "functions/app.php";
require "functions/config.php";
require "functions/user.php";
require "functions/page.php";
require "functions/page_repeatable.php";
require "functions/cpt_entreprise.php";
require "functions/cpt_portfolio.php";
require "functions/cpt_news.php";
require "functions/cpt_evenements.php";
require "functions/cpt_emploi.php";
require "functions/term_portfolio.php";
require "functions/term_category.php";
require "functions/widget_cta.php";
require "functions/widget_banner.php";
require "functions/widget_gammes.php";