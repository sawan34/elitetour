<?php
/********************************
    GENERATE ALL BASIC OPTIONS
*********************************/	 
	
function killer_theme_options_of_options(){
			
	// VARIABLES
	$themename = "Killer Theme Options";
	$shortname = "killer_custom_option";
	
	// Populate OptionsFramework option in array for use in theme
	global $kto_of_options;
	$kto_of_options = get_option('kto_of_options');
	
	// Image Links to Options
	$options_image_link_to = array("image" => "The Image","post" => "The Post"); 
	
	//Testing 
	$options_select = array("one","two","three","four","five"); 
	$options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five"); 
	$align_option = array("left" => "Left", "center" => "Center", "right" => "Right"); 
	$contact_option = array("no" => "Show no cotact in sidebar", "one" => "Show one contact in sidebar", "two" => "Show two contacts in sidebar"); 
	
	// Set the Options Array
	$options = array();
	
	/********** 
	Begin Adding options here ( IMPORTANT: Add your 1st heading before you add any options )***/
	
	//Options Heading
	$options[] = array( "name" => "General Options",
						"type" => "heading"); 
	
	$options[] = array( "name" => "Address",
						"desc" => "<p>Add your address here. you can get address in your wordpress template of your theme. if you can want custom code in your wordpress template like this</p><p style='word-break: break-all;'><b>&lt;?php echo get_option('killer_custom_option_address',true); ?&gt;</b></p>",
						"id" => $shortname."_address",
						"type" => "textarea");
																
	$options[] = array( "name" => "Copyright Information",
						"desc" => "<p>Enter text into the field. you can get copyright information in your wordpress template like this</p> <p style='word-break: break-all;'><b>&lt;?php echo get_option('killer_custom_option_copyright',true); ?&gt;</b></p>",
						"id" => $shortname."_copyright",
						"std" => "",
						"type" => "text");   
	
	$options[] = array( "name" => "Tracking Code",
						"desc" => "<p>Paste your Google Analytics (or other) tracking code here. This will be automatically added into the footer template of your theme. if you can want custom code in your wordpress template like this</p><p style='word-break: break-all;'><b>&lt;?php echo get_option('killer_custom_option_google_analytics',true); ?&gt;</b></p>",
						"id" => $shortname."_google_analytics",
						"type" => "textarea");	

	$options[] = array( "name" => "Footer Content",
						"desc" => "<p>Paste HTML here</p>",
						"id" => $shortname."_footer_content",
						"type" => "textarea");									
	
	// Social SETTING 					
	/*$options[] = array( "name" => "Social Setting",
						"type" => "heading");		*/			
						
	/*$options[] = array( "name" => "Facebook",
						"desc" => "<p>(e.g https://www.facebook.com/killer-theme-option). you can get facebook url in your wordpress template like this</p> <p style='word-break: break-all;'><b>&lt;?php echo get_option('killer_custom_option_facebookname',true); ?&gt;</b></p>",
						"id" => $shortname."_facebook",
						"type" => "text"); 
	
	
	$options[] = array( "name" => "Twitter",
						"desc" => "<p>(e.g https://www.twitter.com/killer-theme-option). you can get twitter url in your wordpress template like this</p> <p style='word-break: break-all;'><b>&lt;?php echo get_option('killer_custom_option_twittername',true); ?&gt;</b></p>",
						"id" => $shortname."_twitter",
						"type" => "text");
	
	$options[] = array( "name" => "LinkdIn",
						"desc" => "<p>(e.g https://www.linkdin.com/killer-theme-option). you can get linkedin url in your wordpress template like this</p> <p style='word-break: break-all;'><b>&lt;?php echo get_option('killer_custom_option_linkedinname',true); ?&gt;</b></p>",
						"id" => $shortname."_linkdin",
						"type" => "text"); 
	
	$options[] = array( "name" => "Google Plus",
						"desc" => "<p>(e.g https://plus.google.com/killer-theme-option). you can get google plus url in your wordpress template like this</p> <p style='word-break: break-all;'><b>&lt;?php echo get_option('killer_custom_option_googleplus',true); ?&gt;</b></p>",
						"id" => $shortname."_googleplus",
						"type" => "text");
						*/
						
	// Extra Fields 					
	$options[] = array( "name" => "Extra Fields",
						"type" => "heading");
	
	$get_option = get_option($shortname."_dynamic_options");
	if(!empty($get_option)){
		foreach($get_option as $key=>$dyn_option){
			$options[] = $get_option[$key];	
		}
	}
	
	// Extra Fields 					
	$options[] = array( "name" => "Create New Field",
						"type" => "heading");
						
						
	$options[] = array( "name" => "Field Name",
						"desc" => "(e.g: First Field)",
						"id" => $shortname."_option_name",
						"type" => "text"); 
						
	// For shortcode
	/* <p>Also get using shortcode <b>[killer_short_code value='".$shortname."_".ereg_replace('[^A-Za-z0-9]', '', strtolower($new_value))."']</b></p> */		
	add_shortcode('killer_short_code','kto_get_shortcode_value');																	
	
	/*** Stop adding options ***/
	update_option('kto_of_template',$options); 					  
	update_option('kto_of_themename',$themename);   
	update_option('kto_of_shortname',$shortname);
}

if ( get_option( 'activated_killer_theme_options' ) == KILLER_OPTIONS ) {	
	killer_theme_options_of_options();
}

// Shortcode value returns
function kto_get_shortcode_value ($atts){
	return get_option($atts['value']);
}

// Add settings link on plugin page
function killer_theme_options_settings_link($links) { 
  $settings_link = '<a href="themes.php?page=killeroptionsframework">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}

add_filter("plugin_action_links_".KTO_OF_BASENAME, 'killer_theme_options_settings_link' );

/*-----------------------------------------------------------------------------------*/
/* Show analytics code in footer */
/*-----------------------------------------------------------------------------------*/

function killer_theme_options_analytics(){
	$shortname =  get_option('kto_of_shortname');
	$output = get_option($shortname . '_google_analytics');
	if ( $output <> "" ) 
		echo stripslashes($output) . "\n";
}
add_action('wp_footer','killer_theme_options_analytics');

include('killer_theme_options_interface.php');
?>