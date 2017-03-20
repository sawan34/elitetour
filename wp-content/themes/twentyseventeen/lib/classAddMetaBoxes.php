<?php
class CECP_addMetaBox{

	  public $inputType="text" ;
  	public $metaBoxName;
  	public $postType="post"; 
    public $serialize = false; 
    public $label = "meta box";
    public $context = "normal";
    public $imagePlaceHolderIdMeta="";
    public $imageLabel ="";
    public $template ="";
    public $buttonName;
    //public $metaBoxSlug ; 

    
    function registerMetaBox(){
    	$inputType = $this->inputType;
    	

    	$inputType = strtolower($inputType);
    	$funct = 'create_'.$inputType.'_metabox';
    	add_action( 'add_meta_boxes', array($this,$funct) );

    }

    function registerImageMetaBox(){       

      add_action( 'add_meta_boxes', array($this,"create_image_meta_box") );

    }

  	function create_text_metabox(){
      global $post;
       if($this->template!=""){
          $pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);
          if($pageTemplate != $this->template){
            return;
          }
        }
        add_meta_box( $this->metaBoxName, $this->label, array($this,'justcallback'), $this->postType,$this->context );
        }
   function create_textarea_metabox(){
       global $post;

       if($this->template !=""){
          $pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);
          if($pageTemplate != $this->template){
            return;
          }
        }
        add_meta_box( $this->metaBoxName, $this->label, array($this,'textareacallback'), $this->postType,$this->context );
        }     

    
    function textareacallback($post){
     wp_nonce_field( 'encyrpted_nonce', 'bundle_metabox_nonce' );
        $value = get_post_meta( $post->ID, $this->metaBoxName, true );
        if($this->serialize){
        $value = unserialize($value);
        $value = implode(',',$value);
        } 
        ?>
        <p>
        <label for="my_meta_box_text"><?php echo "Enter ".$this->label. " below:"; ?> </label>
        <textarea type="text" style="width:100%;" name="<?php echo $this->metaBoxName; ?>" id="<?php echo $this->metaBoxName; ?> " />
            <?php  echo $value; ?>
        </textarea>
      </p>
      <?php
   }      

    
    function create_image_meta_box(){
      global $post;
       if($this->template !=""){
          $pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);
          if($pageTemplate != $this->template){
            return;
          }
        }
      add_meta_box( $this->metaBoxName, $this->label, array($this,'creatingImageUlpoadFields'), $this->postType,$this->context );
    } 

    public function creatingImageUlpoadFields($post) {
        //$instance,$key,$imagePlaceHolderId,$label
        $imagePlaceHolderId= $this->imagePlaceHolderIdMeta;
        $label  = $this->imageLabel;
        $image = get_post_meta( $post->ID, $this->metaBoxName, true );
        if(!empty($image)){
          $imageurl = wp_get_attachment_url($image);
          if(get_post_mime_type($image) == "application/pdf"){
            $imageurl =  get_bloginfo('url').'/wp-includes/images/media/document.png';
          }

        }else{
          $imageurl ="";
        }
        wp_nonce_field( 'encyrpted_nonce', 'bundle_metabox_nonce' );
      ?>
      <p class="cecp-widget-image" style="float:none;">
      
        <label ><?php _e($label.' :' ); ?></label>
        
        <img src="<?php echo  $imageurl ; ?>" class="<?php echo $imagePlaceHolderId; ?>_src" style="width:90px;height:90px" />
        <input name="<?php echo $this->metaBoxName; ?>" class="widefat <?php echo $imagePlaceHolderId; ?>" type="hidden" size="36"  value="<?php echo  (int)$image ; ?>" />

        <input class="upload_image_button button button-primary" type="button" value="<?php _e($this->buttonName); ?>"  data-holder-id="<?php echo $imagePlaceHolderId; ?>" id="testjust" />
      </p>
      <?php

     }

    function   justcallback($post){  
  		  wp_nonce_field( 'encyrpted_nonce', 'bundle_metabox_nonce' );
        $value = get_post_meta( $post->ID, $this->metaBoxName, true );
        if($this->serialize){
        $value = unserialize($value);
        $value = implode(',',$value);
        } 
        ?>
        <p>
        <label for="my_meta_box_text"><?php echo "Enter ".$this->label. " below:"; ?> </label>
        <input type="text" style="width:100%;" name="<?php echo $this->metaBoxName; ?>" id="<?php echo $this->metaBoxName; ?>" value="<?php  echo $value; ?>" />
      </p>
      <?php  
  	}
}
?>
