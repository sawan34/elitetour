<?php
class CECP_saveMetaBoxes{

	//public $nonce ;
	public $metaBoxName ;
	public $postType = "post" ;
	public $serialize=false ;



	function saveMetaBox(){
		add_action("save_post", array($this,'saveBundleMetaBox'),22,3);
	}


	function saveBundleMetaBox($post_id, $post, $update){
	// Bail if we're doing an auto save
      if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    // if our nonce isn't there, or we can't verify it, bail
      if( !isset( $_POST['bundle_metabox_nonce'] ) || !wp_verify_nonce( $_POST['bundle_metabox_nonce'], 'encyrpted_nonce' ) ) return;

    // if our current user can't edit this post, bail
       //if( !current_user_can( 'edit_post' ) ) return;
      	//var_dump($_POST);die;
        if( isset( $_POST[$this->metaBoxName] ) ){
        	$value =  $_POST[$this->metaBoxName] ;
          // sanitize_text_field()
        	if($this->serialize){
            $productIdsIntoArray = array_map('intval',explode(",", $value));

            $productIdsIntoArray = array_filter($productIdsIntoArray, function($a) { return ($a !== 0); });

            $productIdsIntoSerialize  = serialize($productIdsIntoArray);
            $value =  $productIdsIntoSerialize;
              }

            update_post_meta( $post_id, $this->metaBoxName, $value );
           
          }


	}

}


?>