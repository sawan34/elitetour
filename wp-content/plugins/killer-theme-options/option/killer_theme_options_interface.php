<?php
function killer_theme_options_of_head() { do_action( 'killer_theme_options_of_head' ); }
/*-----------------------------------------------------------------------------------*/
/* Add default options after activation */
/*-----------------------------------------------------------------------------------*/
if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
	//Call action that sets
	add_action('admin_head','killer_theme_options_of_option_setup');
}
function killer_theme_options_of_option_setup(){
	//Update EMPTY options
	$of_array = array();
	add_option('kto_of_options',$of_array);
	$template = get_option('kto_of_template');
	
	$saved_options = get_option('kto_of_options');
	
	foreach($template as $option) {
		if($option['type'] != 'heading'){
			$id = $option['id'];
			$std = $option['std'];
			$db_option = get_option($id);
			if(empty($db_option)){
				if(is_array($option['type'])) {
					foreach($option['type'] as $child){
						$c_id = $child['id'];
						$c_std = $child['std'];
						update_option($c_id,$c_std);
						$of_array[$c_id] = $c_std; 
					}
				} else {
					update_option($id,$std);
					$of_array[$id] = $std;
				}
			}
			else { //So just store the old values over again.
				$of_array[$id] = $db_option;
			}
		}
	}
	update_option('kto_of_options',$of_array);
}
if ( get_option( 'activated_killer_theme_options' ) == KILLER_OPTIONS ) {
	
	// interface
	function killer_theme_options_optionsframework_add_admin() {
		global $query_string;
		$themename =  get_option('kto_of_themename');      
		$shortname =  get_option('kto_of_shortname'); 
		
		if ( isset($_REQUEST['page']) && $_REQUEST['page'] == 'killeroptionsframework' ) {
			
			if (isset($_REQUEST['of_save']) && 'reset' == $_REQUEST['of_save']) {
	
				$options =  get_option('kto_of_template'); 
	
				killer_theme_options_of_reset_options($options,'killeroptionsframework');
	
				header("Location: admin.php?page=killeroptionsframework&reset=true");
	
				die;
	
			}
	
		}
		$of_page = add_submenu_page('themes.php', $themename, 'Killer Theme Options', 'edit_theme_options', 'killeroptionsframework','killer_theme_options_optionsframework_options_page'); // Default
		
		// Add framework functionaily to the head individually
	
		add_action("admin_print_scripts-$of_page", 'killer_theme_options_of_load_only');
	
		add_action("admin_print_styles-$of_page",'killer_theme_options_of_style_only');
	
	} 
		
	add_action('admin_menu', 'killer_theme_options_optionsframework_add_admin');
	
	
}
/*-----------------------------------------------------------------------------------*/
/* Options Framework Reset Function - of_reset_options */
/*-----------------------------------------------------------------------------------*/
function killer_theme_options_of_reset_options($options,$page = ''){
	global $wpdb;
	$query_inner = '';
	$count = 0;
	
	$excludes = array( 'blogname' , 'blogdescription' );
	
	foreach($options as $option){
			
		if(isset($option['id'])){ 
			$count++;
			$option_id = $option['id'];
			$option_type = $option['type'];
			
			//Skip assigned id's
			if(in_array($option_id,$excludes)) { continue; }
			
			if($count > 1){ $query_inner .= ' OR '; }
			if(is_array($option_type)) {
				$type_array_count = 0;
				foreach($option_type as $inner_option){
					$type_array_count++;
					$option_id = $inner_option['id'];
					if($type_array_count > 1){ $query_inner .= ' OR '; }
					$query_inner .= "option_name = '$option_id'";
				}
				
			} else {
				$query_inner .= "option_name = '$option_id'";
			}
		}
			
	}
	
	//When Theme Options page is reset - Add the kto_of_options option
	if($page == 'killeroptionsframework'){
		$query_inner .= " OR option_name = 'kto_of_options'";
	}
	
	//echo $query_inner;
	
	$query = "DELETE FROM $wpdb->options WHERE $query_inner";
	$wpdb->query($query);
		
}
/*-----------------------------------------------------------------------------------*/
/* Build the Options Page - optionsframework_options_page */
/*-----------------------------------------------------------------------------------*/
function killer_theme_options_optionsframework_options_page(){
    $options =  get_option('kto_of_template');      
    $themename =  get_option('kto_of_themename');
?>
<div class="wrap" id="of_container">
     <div id="of-popup-save" class="of-save-popup">
          <div class="of-save-save">Options Updated</div>
     </div>
     <div id="of-popup-reset" class="of-save-popup">
          <div class="of-save-reset">Options Reset</div>
     </div>
     <form action="" enctype="multipart/form-data" id="ofform">
          <div id="header">
               <div class="logo">
                    <h2><?php echo ucfirst(get_bloginfo('name')).' General Setting'; ?></h2>
               </div>
               <div class="icon-option"> </div>
               <div class="clear"></div>
          </div>
          <?php 
		// Rev up the Options Machine
        $return = killer_theme_options_optionsframework_machine($options);
        ?>
          <div id="main">
               <div id="of-nav">
                    <ul>
                         <?php echo $return[1]; ?>
                    </ul>
               </div>
               <div id="content"> <?php echo $return[0]; /* Settings */ ?> </div>
               <div class="clear"></div>
          </div>
          <div class="save_bar_top">
          <img style="display:none" src="<?php echo KTO_OF_DIRECTORY; ?>option/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
          <input type="submit" value="Save Options" class="button-primary" />
     </form>
     <form action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ) ?>" method="post" style="display:inline" id="ofform-reset">
          <span class="submit-footer-reset">
          <input name="reset" type="submit" value="Reset Options" class="button submit-button reset-button" onclick="return confirm('Click OK to reset. Any settings will be lost!');" />
          <input type="hidden" name="of_save" value="reset" />
          </span>
     </form>
</div>
<?php  if (!empty($update_message)) echo $update_message; ?>
<div style="clear:both;"></div>
</div>
<!--wrap-->
<?php
}

/*-----------------------------------------------------------------------------------*/
/* Load required styles for Options Page - of_style_only */
/*-----------------------------------------------------------------------------------*/
function killer_theme_options_of_style_only() {
	
	wp_enqueue_style('admin-style', KTO_OF_DIRECTORY.'option/css/admin-style.css');
}	


/*-----------------------------------------------------------------------------------*/
/* Load required javascripts for Options Page - of_load_only */
/*-----------------------------------------------------------------------------------*/
function killer_theme_options_of_load_only() {
	add_action('admin_head', 'killer_theme_options_of_admin_head');
}


function killer_theme_options_of_admin_head() {
?>
<?php //AJAX Upload ?>
<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery('.group').hide();
				jQuery('.group:first').fadeIn();
				
				jQuery('.group .collapsed').each(function(){
					jQuery(this).find('input:checked').parent().parent().parent().nextAll().each( 
						function(){
           					if (jQuery(this).hasClass('last')) {
           						jQuery(this).removeClass('hidden');
           						return false;
           					}
           					jQuery(this).filter('.hidden').removeClass('hidden');
           				});
           		});
           					
				jQuery('.group .collapsed input:checkbox').click(unhideHidden);
				
				function unhideHidden(){
					if (jQuery(this).attr('checked')) {
						jQuery(this).parent().parent().parent().nextAll().removeClass('hidden');
					}
					else {
						jQuery(this).parent().parent().parent().nextAll().each( 
							function(){
           						if (jQuery(this).filter('.last').length) {
           							jQuery(this).addClass('hidden');
									return false;
           						}
           						jQuery(this).addClass('hidden');
           					});
           					
					}
				}
				
				jQuery('#of-nav li:first').addClass('current');
				jQuery('#of-nav li a').click(function(evt){
				
						jQuery('#of-nav li').removeClass('current');
						jQuery(this).parent().addClass('current');
						
						var clicked_group = jQuery(this).attr('href');
		 
						jQuery('.group').hide();
						
							jQuery(clicked_group).fadeIn();
		
						evt.preventDefault();
						
					});
				
				if('<?php if(isset($_REQUEST['reset'])) { echo $_REQUEST['reset'];} else { echo 'false';} ?>' == 'true'){
					
					var reset_popup = jQuery('#of-popup-reset');
					reset_popup.fadeIn();
					window.setTimeout(function(){
						   reset_popup.fadeOut();                        
						}, 2000);
						//alert(response);
					
				}
					
			//Update Message popup
			jQuery.fn.center = function () {
				this.animate({"top":( jQuery(window).height() - this.height() - 200 ) / 2+jQuery(window).scrollTop() + "px"},100);
				this.css("left", 250 );
				return this;
			}
		
			
			jQuery('#of-popup-save').center();
			jQuery('#of-popup-reset').center();
			jQuery(window).scroll(function() { 
			
				jQuery('#of-popup-save').center();
				jQuery('#of-popup-reset').center();
			
			});
			
			
				
			//Save everything else
			jQuery('#ofform').submit(function(){
					function newValues() {
					  var serializedValues = jQuery("#ofform").serialize();
					  return serializedValues;
					}
					jQuery('.ajax-loading-img').fadeIn();
					var serializedReturn = newValues();
					var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
					//var data = {data : serializedReturn};
					var data = {
						<?php if(isset($_REQUEST['page']) && $_REQUEST['page'] == 'killeroptionsframework'){ ?>
						type: 'options',
						<?php } ?>
						action: 'killer_theme_options_of_ajax_post_action',
						data: serializedReturn
					};
					
					jQuery.post(ajax_url, data, function(response) {
						var success = jQuery('#of-popup-save');
						var loading = jQuery('.ajax-loading-img');
						loading.fadeOut();  
						success.fadeIn();
						window.setTimeout(function(){		
						   success.fadeOut(); 
						   location.reload();
						}, 1000);
					});
					return false; 
				});   	 	
			
			jQuery('.delete-field').on("click",function(){
					var data_id = jQuery(this).parent().parent().parent().attr('id');
					var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
					//var data = {data : serializedReturn};
					var data = {
						<?php if(isset($_REQUEST['page']) && $_REQUEST['page'] == 'killeroptionsframework'){ ?>
						type: 'delete-option',
						<?php } ?>
						action: 'killer_theme_options_of_ajax_post_action',
						data: data_id
					};
					
					jQuery.post(ajax_url, data, function(response) {
						var success = jQuery('#of-popup-save');
						var loading = jQuery('.ajax-loading-img');
						loading.fadeOut();  
						success.fadeIn();
						window.setTimeout(function(){		
						   success.fadeOut(); 
						   location.reload();
						}, 1000);
					});
					return false; 
				});	
				
				
			});
		</script>
<?php
}
/*-----------------------------------------------------------------------------------*/
/* Ajax Save Action - of_ajax_callback */
/*-----------------------------------------------------------------------------------*/
add_action('wp_ajax_killer_theme_options_of_ajax_post_action', 'killer_theme_options_of_ajax_callback');
function killer_theme_options_of_ajax_callback() {
	global $wpdb; // this is how you get access to the database
	$save_type = $_POST['type'];
	
	if($save_type == 'delete-option'){
		$shortname = get_option("kto_of_shortname");
		$data_id = $_POST['data'];
		
		$get_option = get_option($shortname."_dynamic_options");
							
		if(!empty($get_option)){
			foreach($get_option as $key=>$custom_val){
				$chk_id = $custom_val['id'];
				$delete_id = $data_id;
				
				if($chk_id == $delete_id){
					unset($get_option[$key]);
									
				}
			}
			update_option($shortname."_dynamic_options",$get_option);
		}
		
	}	
	elseif ($save_type == 'options' OR $save_type == 'framework') {
		
		$shortname =  get_option('kto_of_shortname'); 
		$data = $_POST['data'];
		
		parse_str($data,$output);
		//print_r($output);
		//Pull options
        $options = get_option('kto_of_template');
		
		foreach($options as $option_array){
			
			$id = $option_array['id'];
			$old_value = get_option($id);
			$new_value = '';
			
			if(isset($output[$id])){
				$new_value = $output[$option_array['id']];
			}
	
			if(isset($option_array['id'])) { // Non - Headings...
					$type = $option_array['type'];
					
					if ( is_array($type)){
						
						foreach($type as $array){
							if($array['type'] == 'text'){
								$id = $array['id'];
								$std = $array['std'];
								$new_value = $output[$id];
								if($new_value == ''){ $new_value = $std; }
								
								update_option( $id, stripslashes($new_value));
								
							}
						}                 
					}
					
					elseif($type == 'text' && $option_array['id'] == $shortname."_option_name"){
						if(!empty($new_value)){
							
							$get_option = get_option($shortname."_dynamic_options");
							
							if(!empty($get_option)){
								$flag = 0;
								foreach($get_option as $custom_val){
									$chk_id = $custom_val['id'];
									$new_id = $shortname."_".ereg_replace("[^A-Za-z0-9]", "", strtolower($new_value));
									
									if($chk_id == $new_id){
										$flag = 1;
									}
								}
								if(!$flag){
									$get_option[] = array(
														"name"=>$new_value,
														"desc"=>"<p class='killer-extra-option'>you can get value of ".$new_value." in your wordpress template like this</p> <p style='word-break: break-all;'><b>&lt;?php echo get_option('".$shortname."_".ereg_replace('[^A-Za-z0-9]', '', strtolower($new_value))."',true); ?&gt;</b></p>", 
														"id"=>$shortname."_".ereg_replace('[^A-Za-z0-9]', '', strtolower($new_value)), 
														"type"=>"text",
														"del" => 1
													);
									
									update_option($shortname."_dynamic_options",$get_option);				
									update_option( $id, "");
								}
							}else{
								$dyn_option[] = array(
													"name"=>$new_value,
													"desc"=>"<p class='killer-extra-option'>you can get value of ".$new_value." in your wordpress template like this</p> <p style='word-break: break-all;'><b>&lt;?php echo get_option('".$shortname."_".ereg_replace('[^A-Za-z0-9]', '', strtolower($new_value))."',true); ?&gt;</b></p>", 
													"id"=>$shortname."_".ereg_replace('[^A-Za-z0-9]', '', strtolower($new_value)),  
													"type"=>"text",
													"del" => 1
												);
								
								update_option($shortname."_dynamic_options",$dyn_option);				
								update_option( $id, "");
							}
						}
					}
					elseif($new_value == '' && $type == 'checkbox'){ // Checkbox Save
						update_option($id,'false');
					}
					elseif ($new_value == 'true' && $type == 'checkbox'){ // Checkbox Save
						update_option($id,'true');
					}elseif($type != 'upload_min'){
						update_option($id,stripslashes($new_value));
					}
				}
			}	
	
	}
  die();
}
/*-----------------------------------------------------------------------------------*/
/* Generates The Options Within the Panel - optionsframework_machine */
/*-----------------------------------------------------------------------------------*/
function killer_theme_options_optionsframework_machine($options) {
	//print_r($options);
	//die;	
    $counter = 0;
	$menu = '';
	$output = '';
	
	
	foreach ($options as $value) {
		$counter++;
		$val = '';
		
		$extra_class = "";
		$extra_id = "";
		if ( $value['del'] )
		 {
			 $extra_class = "delete-field";
			 $extra_id = $value['id'];
		 }
		
		
		//Start Heading
		 if ( $value['type'] != "heading" )
		 {
		 	$class = ''; if(isset( $value['class'] )) { $class = $value['class']; }
			//$output .= '<div class="section section-'. $value['type'] .'">'."\n".'<div class="option-inner">'."\n";
			$output .= '<div class="section section-'.$value['type'].' '. $class .'" id="'.$extra_id.'">'."\n";
			$output .= '<h3 class="heading">'. $value['name'] .'</h3>'."\n";
			$output .= '<div class="option">'."\n" . '<div class="controls">'."\n";
		 } 
		 //End Heading
		$select_value = '';                                   
		switch ( $value['type'] ) {
		
		case 'text':
			$val = $value['std'];
			$std = get_option($value['id']);
			if ( $std != "") { $val = $std; }
			$output .= '<input class="of-input " name="'. $value['id'] .'" id="'. $value['id'] .'" type="'. $value['type'] .'" value="'. $val .'" />';
			if(!empty($extra_class)){
				$output .= "<span class='".$extra_class."'> X </span>";
			}
		break;
		
		case 'textarea':
			
			$cols = '8';
			$ta_value = '';
			
			if(isset($value['std'])) {
				
				$ta_value = $value['std']; 
				
				if(isset($value['options'])){
					$ta_options = $value['options'];
					if(isset($ta_options['cols'])){
					$cols = $ta_options['cols'];
					} else { $cols = '8'; }
				}
				
			}
				$std = get_option($value['id']);
				if( $std != "") { $ta_value = stripslashes( $std ); }
				$output .= '<textarea class="of-input" name="'. $value['id'] .'" id="'. $value['id'] .'" cols="'. $cols .'" rows="8">'.$ta_value.'</textarea>';
			
			
		break;
		
		case "info":
			$default = $value['std'];
			$output .= $default;
		break;                                   
		
		case "heading":
			
			if($counter >= 2){
			   $output .= '</div>'."\n";
			}
			$jquery_click_hook = ereg_replace("[^A-Za-z0-9]", "", strtolower($value['name']) );
			$jquery_click_hook = "of-option-" . $jquery_click_hook;
			$menu .= '<li><a title="'.  $value['name'] .'" href="#'.  $jquery_click_hook  .'">'.  $value['name'] .'</a></li>';
			$output .= '<div class="group" id="'. $jquery_click_hook  .'"><h2>'.$value['name'].'</h2>'."\n";
		break;                                  
		} 
		
		// if TYPE is an array, formatted into smaller inputs... ie smaller values
		if ( is_array($value['type'])) {
			foreach($value['type'] as $array){
			
					$id = $array['id']; 
					$std = $array['std'];
					$saved_std = get_option($id);
					if($saved_std != $std){$std = $saved_std;} 
					$meta = $array['meta'];
					
					if($array['type'] == 'text') { // Only text at this point
						 
						 $output .= '<input class="input-text-small of-input" name="'. $id .'" id="'. $id .'" type="text" value="'. $std .'" />';  
						 $output .= '<span class="meta-two">'.$meta.'</span>';
					}
				}
		}
		if ( $value['type'] != "heading" ) { 
			if ( $value['type'] != "checkbox" ) 
				{ 
				$output .= '<br/>';
				}
			if(!isset($value['desc'])){ $explain_value = ''; } else{ $explain_value = $value['desc']; } 
			$output .= '</div><div class="explain">'. $explain_value .'</div>'."\n";
			$output .= '<div class="clear"> </div></div></div>'."\n";
			}
	   
	}
    $output .= '</div>';
    return array($output,$menu);
}	
?>
