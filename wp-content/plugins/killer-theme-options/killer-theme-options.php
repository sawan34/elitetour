<?php
/*
Plugin Name: Killer Theme Options
Plugin URI: http://www.artoonsolustion.com
Description: Custom theme options like logo, google analytics code option, copyright text, social links options and dynamic custom fields create as per user requirement more... 
Author: Punit Bhalodiya
Author URI: http://www.artoonsolutions.com	
Version: 2.0
*/

/********************************
    DEFINE CONTANT
*********************************/

if(!defined('KTO_OF_DIRECTORY'))		
	define('KTO_OF_DIRECTORY', plugin_dir_url(__FILE__));

if(!defined('KTO_OF_BASENAME'))
	define('KTO_OF_BASENAME',plugin_basename(__FILE__));	

if(!defined('KILLER_OPTIONS'))
	define('KILLER_OPTIONS', 'killer_options');
	
/********************************************
    PLUGIN ACTIVATION AND DEACTIVATEION HOOK
**********************************************/
function killer_theme_options_activate() {
	if(is_admin()){
		add_option("activated_killer_theme_options",KILLER_OPTIONS);
	}
}
register_activation_hook( __FILE__, 'killer_theme_options_activate' );

function killer_theme_options_load() {
    if ( get_option( 'activated_killer_theme_options' ) == KILLER_OPTIONS ) {
        include('option/killer_theme_options_design.php');
    }
}
add_action( 'init', 'killer_theme_options_load' );

function killer_theme_options_deactivate(){
	if(is_admin()){
		delete_option("activated_killer_theme_options");
	}
}
register_deactivation_hook( __FILE__, 'killer_theme_options_deactivate' );

?>