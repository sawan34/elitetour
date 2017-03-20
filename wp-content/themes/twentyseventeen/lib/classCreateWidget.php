<?php
//widget change
class CECF_Widget_builder extends WP_Widget
{
	
	public $textfields=array();
  public $textareafields=array();
	public $imagefields=array(); 
  public $checkbox = array();
  public $selectHtml = array();

  /**
   *  widget_upload_scripts
   * 
   */
  function widget_upload_scripts(){
  	wp_enqueue_media();
  	wp_enqueue_script('upload_media_widget', CECP_URL . 'lib/admin/assets/js/upload-media.js', array('jquery'));
  }
     /**
      * Front-end display of widget.
      *
      * @see WP_Widget::widget()
      *
      * @param array $args     Widget arguments.
      * @param array $instance Saved values from database.
      */ 


     public function creatingTextFields($instance,$key,$label="") {

     	$title = ! empty( $instance[$key] ) ? $instance[$key] : __( '');
     	?>
     	<p class="cecp-widget">
     		<label for="<?php echo $this->get_field_id( $key ); ?>"><?php _e( $label.":" ); ?></label> 
     		<input class="widefat" id="<?php echo $this->get_field_id( $key ); ?>" name="<?php echo $this->get_field_name( $key ); ?>" type="text" value="<?php echo esc_attr__( $title ); ?>">
     	</p>          
     	<?php 
     }     


     public function creatingTextareaFields($instance,$key,$label="") {

      $title = ! empty( $instance[$key] ) ? $instance[$key] : __( '');
      ?>
      <p class="cecp-widget">
        <label for="<?php echo $this->get_field_id( $key ); ?>"><?php _e( $label.":" ); ?></label> 
        <textarea  class="widefat" id="<?php echo $this->get_field_id( $key ); ?>" name="<?php echo $this->get_field_name( $key ); ?>" > <?php echo esc_attr__( $title ); ?> </textarea>
      </p>          
      <?php 
     }    

     public function checkboxWidget($instance,$key,$label="",$classes="") { 
        $filter = isset( $instance[$key] ) ? $instance[$key] : 0;
      ?>
      <p><input class="<?php echo $classes; ?>" id="<?php echo $this->get_field_id($key); ?>" name="<?php echo $this->get_field_name($key); ?>" type="checkbox"
      <?php checked( $filter,'on',true ); ?> />&nbsp;<label for="<?php echo $this->get_field_id($key); ?>"><?php _e($label); ?></label></p>
     <?php 
      }

     public function creatingImageUlpoadFields($instance,$key,$imagePlaceHolderId,$label) {
     	$image = ! empty( $instance[$key] ) ? $instance[$key] :'';
     	$imageurl = wp_get_attachment_url($image);
     	?>
     	<p class="cecp-widget-image">
      
     		<label for="<?php echo $this->get_field_name($key); ?>"><?php _e($label.' :' ); ?></label>
        
     		<img src="<?php echo  $imageurl ; ?>" class="<?php echo $this->get_field_id( $key ); ?>_widget_up_src" style="width:90px;height:90px" />
     		<input name="<?php echo $this->get_field_name($key); ?>" id="<?php echo $this->get_field_id( $key ); ?>" class="widefat <?php echo $this->get_field_id( $key ); ?>_widget_up" type="hidden" size="36"  value="<?php echo  (int)$image ; ?>" />

     		<input class="upload_image_button button button-primary" type="button" value="Upload Image"  data-holder-id="<?php echo $this->get_field_id( $key ); ?>_widget_up" id="testjust" />
     	</p>
     	<?php

     }

     public function selectBox($data,$instance,$key,$label="",$classes=""){ 
    $selectedData = ! empty( $instance[$key] ) ? $instance[$key] : __( '');
    echo '<p class="cecp-widget">';
    echo  '<label for="'.$this->get_field_id( $key ).'">'.__( $label.':' ).'</label>'; 
    echo '<select class="'.$classes.' " name="'.$this->get_field_name( $key ).'"  id="'.$this->get_field_id( $key ).'">' ;
    foreach ($data as $key => $value) {
      echo '<option value="'.$value.'" '.selected($selectedData,$value ).'>'.$value.'</option>';
    }
    echo '</select>';
   echo '</p>';
}

     //creating form 
     

     public function form( $instance ) {
       
      $checkboxs = apply_filters("cecp_widget_filter_checkbox",$this->checkbox,$instance);

     	$inputBoxes  =  apply_filters("cecp_widget_filter_text",$this->textfields,$instance);
     	$textareas = apply_filters("cecp_widget_filter_textarea",$this->textareafields,$instance);
      $inputImages = apply_filters("cecp_widget_filter_image",$this->imagefields,$instance);
      //$this->checkbox;

     foreach ($checkboxs as $key => $value) {
        $this->checkboxWidget($instance,$key,$value['label'],$value['classes']);

        }

     	foreach ($inputBoxes as $key => $value) {
     		$this->creatingTextFields($instance,$key,$value);
     	}
       foreach ($textareas as $key => $value) {
        $this->creatingTextareaFields($instance,$key,$value);
      }
     	foreach ($inputImages as $key => $value) {
     		$this->creatingImageUlpoadFields($instance,$key,$key,$value);

     	}

      


     }

     /**
      * Sanitize widget form values as they are saved.
      *
      * @see WP_Widget::update()
      *
      * @param array $new_instance Values just sent to be saved.
      * @param array $old_instance Previously saved values from database.
      *
      * @return array Updated safe values to be saved.
      */
     public function update( $new_instance, $old_instance ) {
     // print_r($new_instance);
     	$instance = array();
     	$inputBoxes  =  $this->textfields;
     	$inputImages = $this->imagefields;
      $textarea = $this->textareafields;
      $checkbox = $this->checkbox;
      $select = $this->selectHtml;

     	$allFileds = array_merge($inputBoxes,$inputImages,$textarea,$checkbox,$select);
     // print_r($allFileds);die;
     	foreach ($allFileds as $key=>$value ) {  
     		$instance[$key] = ( ! empty( $new_instance[$key] ) ) ?  trim($new_instance[$key]) :'';
     	}

      // foreach ($_POST as $key => $value) {
      //   foreach ($value as $key1 => $value1) {
      //      if($key1 = "select_post_type") {
      //        $instance[$key1] = ( ! empty( $new_instance[$key1] ) ) ?  trim($new_instance[$key1]) :'';
      //      }

      //      if($key1 = "api_link") {
      //        $instance[$key1] = ( ! empty( $new_instance[$key1] ) ) ?  trim($new_instance[$key1]) :'';
      //      }
      //   }
      // }
      //die;
     	return $instance;
     }

     function cecp_button($link,$text,$title){
        $output = "";
        $title =  esc_attr__($title,CECP_SLUG);
       if($link !=" " && $link !=""){
          $output = sprintf('<div class="clearfix"> <a href="%s" title="%s" class="blue-btn">%s</a></div>',$link,$title,$text);
           
       }
       echo $output;
     }

     function cecp_description($title,$description=""){
        $output = "";
        if(strlen($title) > 0){
          $output .= sprintf('<h3>%s</h3>',$title); 
        }
        
        if(strlen($description) > 0) {
          $output .= sprintf('<p>%s</p>',$description); 
        }
        

        echo $output; 
               
     }

     function getimageById($imageId){
       $imageId = (int)$imageId;
       $imageurl ="";
       if(!empty($imageId) && $imageId >0 ) {
          $imageurl = wp_get_attachment_url($imageId);
       }
       return $imageurl;
     }
 }
// register Foo_Widget widget
