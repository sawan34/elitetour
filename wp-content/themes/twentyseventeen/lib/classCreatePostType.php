<?php
/*
 * This class would be used to create
 * Post Types
 */
class CECP_postTypeClass{

 public $slug, $name, $taxonomies='', $extras, $extra_labels;
 public $taxonomySlug,$taxonomyName,$taxonomyHierachical=true;

 public function registerTaxonomies($multiple=0){
    $name = $this->taxonomyName;
    $slug = $this->taxonomySlug;
    
    $postType = $this->slug;
    
   $labels = array(
    'name'              => _x( $name, 'taxonomy general name', 'textdomain' ),
    'singular_name'     => _x( $name, 'taxonomy singular name', 'textdomain' ),
    'search_items'      => __( 'Search '.$name, 'textdomain' ),
    'all_items'         => __( 'All '.$name, 'textdomain' ),
    'parent_item'       => __( 'Parent '.$name, 'textdomain' ),
    'parent_item_colon' => __( 'Parent :'.$name, 'textdomain' ),
    'edit_item'         => __( 'Edit '.$name, 'textdomain' ),
    'update_item'       => __( 'Update '.$name, 'textdomain' ),
    'add_new_item'      => __( 'Add New '.$name, 'textdomain' ),
    'new_item_name'     => __( 'New Genre '.$name, 'textdomain' ),
    'menu_name'         => __( $name, 'textdomain' ),
    );

   $args = array(
    'hierarchical'      => $this->taxonomyHierachical,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => $slug ),
    );

   if($multiple !==0){
                register_taxonomy( $slug, $multiple, $args );
                    }else{
               register_taxonomy( $slug, array( $postType ), $args );
                  }
}

public function registerPost() {

        // Register Custom Post Type
    $postTypeName =  ucfirst($this->name)  ;
    if(strtolower($postTypeName) =="ceo"){
        $postTypeName = "CEO";
    }
    $postTypeSlug = $this->slug; 
    $postTypeExtraLabels = $this->extra_labels;
    $postTypeExtra = $this->extras;
    $postTypeTaxonomies = $this->taxonomies;
    $labels = array();

    $labels = array(
        'name' => _x($postTypeName, 'Post Type General Name', CECP_SLUG),
        'singular_name' => _x($postTypeName, 'Post Type Singular Name', CECP_SLUG)
        );


    if(isset($postTypeExtraLabels))
        $labels = array_merge($labels, $postTypeExtraLabels);

    $args = array(
        "labels" => $labels,
        "rewrite" => array(
            "slug" => $postTypeSlug,
            "with_front" => false,
            ),
        "has_archives" => true,
        );
    if(!empty($postTypeTaxonomies ) && $postTypeTaxonomies !=""){
        $args = array(
            "labels" => $labels,
            "rewrite" => array(
                "slug" => $postTypeSlug,
                "with_front" => false,
                ),
            "has_archives" => true,
            "taxonomies" => $this->taxonomies
            );
    }


    if(isset($postTypeExtra)){
      $args = array_merge($args,$postTypeExtra);

  }


  if(isset($postTypeName) && isset($postTypeSlug))
  {
    if (!post_type_exists( $postTypeSlug )){
        register_post_type($postTypeSlug, $args);
    }
}
        }//method register ends here 
    } 

    ?>