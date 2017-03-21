<?php
   Class initPostType {
     private static $_instance = null;

     public static function instance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }


    private function __construct() {
        require(CECP_DIR . "lib/classCreatePostType.php");
        $registerPost = new CECP_postTypeClass;
        $this->registerPostType("Slider",$registerPost);

        $registerPost = new CECP_postTypeClass;
        $this->registerPostType("Know More Services",$registerPost);

      // $this->registerPostType("Companies",$registerPost);
       // $this->registerPostType("Press Releases",$registerPost);
       // $this->registerPostType("News",$registerPost);
       // $this->registerPostType("Advisory Board",$registerPost);
       // $this->registerPostType("Careers",$registerPost);
       // $taxArgs = array(
       //    "taxoslug" => "service_type",
       //    "taxoname" => "Service Type"
       //  );
       // $this->registerPostType("services",$registerPost,$taxArgs);

       //  $taxArgs = array(
       //    "taxoslug" => "thought_type",
       //    "taxoname" => "Thought Type"
       //  );
       // $this->registerPostType("thought_leadership",$registerPost,$taxArgs);

       // $taxArgs = array(
       //    "taxoslug" => "giving_in_numbers_years",
       //    "taxoname" => "Years"
       //  );
       // $this->registerPostType("giving_in_numbers",$registerPost,$taxArgs);

       // $this->registerEventPostType($registerPost);
       // $this->registerCompanyPostType($registerPost);
       // $this->registerCEOPostType($registerPost);

       // if(class_exists("myCecp")){
       //  $this->registerPostType("Knowledge_center",$registerPost);
       //  $this->registerCustomContent($registerPost);

       // }

    }


    public function registerCustomContent($registerPost){
      $postTypeName = 'custom_content';
      $postTypeName = strtolower($postTypeName);
      $registerPost->name = str_replace('_', ' ', $postTypeName);
      $registerPost->slug = str_replace(' ', '', $postTypeName);
      $registerPost->taxonomyHierachical = true;
        $registerPost->extras = array(
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array('title')
        );
        $registerPost->registerPost();
     }   

    public function registerCompanyPostType($registerPost){
      $postTypeName = 'company';
      $postTypeName = strtolower($postTypeName);
      $registerPost->name = $postTypeName;
      $registerPost->slug = str_replace(' ', '', $postTypeName);
      $registerPost->taxonomyHierachical = true;
        $registerPost->extras = array(
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array('title', 'editor','excerpt', 'author', 'thumbnail')
        );
        $registerPost->registerPost();

        
        $registerPost->taxonomySlug = "industrys";
        $registerPost->taxonomyName = "Industries";
        $registerPost->registerTaxonomies(array('ceo','company'));

        $registerPost->taxonomySlug = "category_company";
        $registerPost->taxonomyName = "Company Category";
        $registerPost->registerTaxonomies(array('ceo','company'));

        $registerPost->taxonomySlug = "company_region";
        $registerPost->taxonomyName = "Company region";
        $registerPost->registerTaxonomies(array('ceo','company'));

        $registerPost->taxonomySlug = "author_blogger";
        $registerPost->taxonomyName = "Author and Blogger";
        $registerPost->taxonomyHierachical = false;
        $registerPost->registerTaxonomies(array('post'));


        
        $registerPost->taxonomySlug = "company";
        $registerPost->taxonomyName = "Company";
        $registerPost->taxonomyHierachical = false;
        $registerPost->registerTaxonomies(array('ceo','company'));


                

    }

    public function registerCEOPostType($registerPost){
      $postTypeName = 'ceo';
      $postTypeName = strtolower($postTypeName);
      $registerPost->name = $postTypeName;
      $registerPost->slug = str_replace(' ', '', $postTypeName);
      $registerPost->taxonomyHierachical = true;
        $registerPost->extras = array(
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array('title', 'editor','excerpt', 'author', 'thumbnail')
        );
        $registerPost->registerPost();

       /* $registerPost->taxonomySlug = "industrys";
        $registerPost->taxonomyName = "Industries";
        $registerPost->registerTaxonomies();

        $registerPost->taxonomySlug = "category_company";
        $registerPost->taxonomyName = "Comapny Category";
        $registerPost->registerTaxonomies();

        $registerPost->taxonomySlug = "company_region";
        $registerPost->taxonomyName = "Company region";
        $registerPost->registerTaxonomies();

        $registerPost->taxonomySlug = "company";
        $registerPost->taxonomyName = "Company";
        $registerPost->taxonomyHierachical = false;
        $registerPost->registerTaxonomies();
       */

                

    }


    public function registerEventPostType($registerPost){
      $postTypeName = 'Events';
      $postTypeName = strtolower($postTypeName);
      $registerPost->name = $postTypeName;
      $registerPost->slug = str_replace(' ', '', $postTypeName);

        $registerPost->extras = array(
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array('title', 'editor','excerpt', 'author', 'thumbnail')
        );
        $registerPost->registerPost();

        $registerPost->taxonomySlug = "type_of_event";
        $registerPost->taxonomyName = "Type of Event";
        $registerPost->registerTaxonomies();

        $registerPost->taxonomySlug = "audience";
        $registerPost->taxonomyName = "Audience";
        $registerPost->registerTaxonomies();

        $registerPost->taxonomySlug = "events_board";
        $registerPost->taxonomyName = "Events Board";
        $registerPost->registerTaxonomies();

        $registerPost->taxonomySlug = "events_year";
        $registerPost->taxonomyName = "Events Year";
        $registerPost->registerTaxonomies();

        $registerPost->taxonomySlug = "region";
        $registerPost->taxonomyName = "Region";
        $registerPost->taxonomyHierachical = false;
        $registerPost->registerTaxonomies();

        
        

    }


    public function registerPostType($postTypeName,$registerPost,$taxArgs=array()){
      $postTypeName = strtolower($postTypeName);
      $registerPost->name =  str_replace('_',' ',ucfirst($postTypeName));
      $registerPost->slug = str_replace(' ', '', $postTypeName);

        $registerPost->extras = array(
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array('title', 'editor','excerpt', 'author', 'thumbnail')
        );
        $registerPost->registerPost();

        if(!empty($taxArgs) && count($taxArgs) > 0){
             //var_dump($taxArgs);
             $registerPost->taxonomySlug = $taxArgs["taxoslug"];
             $registerPost->taxonomyName = $taxArgs["taxoname"];
             $registerPost->registerTaxonomies();
        }

     } //registerPostType ends here


   } //class ends

   add_action( "init" , "initPostType::instance");
?>