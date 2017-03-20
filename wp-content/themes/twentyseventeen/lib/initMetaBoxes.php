<?php
  
  class CECP_metabox{
     private static $_instance = null;

     public static function instance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

    function __construct (){

     $this->metaBoxAddingAndSaving("cecp_whats_new_button_text","whatsnew","Button Text", false, "normal");  

     $this->metaBoxAddingAndSaving("cecp_whats_new_external_link","whatsnew","External Link"
                                   );
     $this->metaBoxAddingAndSaving("cecp_companies_ceo_name","companies","CEO Name"
                                   );
     $this->metaBoxAddingAndSaving("company_link","companies","Company URL"
                                   );

     $this->metaBoxAddingAndSaving("testimonial_author_rank","testimonial","Author Postion"
                                   );   
     $this->metaBoxAddingAndSaving("whatsnew_secondary_title","whatsnew","Secondary Title", false, "normal");

     $this->metaBoxAddingAndSaving("banner_title","page","Banner Title", false, "normal");

     $this->metaBoxAddingAndSaving("banner_secondary_title","page","Banner Secondary Title", false, "normal");

     $this->metaBoxAddingAndSaving("banner_button_text","page","Banner Button Text", false, "normal");

     

     $this->metaBoxAddingAndSaving("banner_button_link","page","Banner Button Link", false, "normal");

     $this->metaBoxAddingAndSaving("career_button_link","careers","Button Text", false, "normal");

     $this->metaBoxAddingAndSaving("career_button_link1","careers","Button Link", false, "normal");

     $this->metaBoxAddingAndSaving("expertise_title","page","EXPERTISE Heading", false, "normal","page-templates/templates-about.php");

     $this->metaBoxAddingAndSaving("team_text","page","Team Section Heading", false, "normal","page-templates/templates-about.php");

     $this->metaBoxAddingAndSaving("bod_text","page","Board of Director Section Heading", false, "normal","page-templates/templates-about.php");


     $this->metaBoxAddingAndSaving("press_release_text","page","Press Release Text", false, "normal","page-templates/templates-about.php");

     $this->metaBoxImageAddingAndSaving("press_release_image","page","Press Release Image", false, "normal","page-templates/templates-about.php");

     $this->metaBoxAddingAndSaving("news_text","page","News Text", false, "normal","page-templates/templates-about.php");

     $this->metaBoxImageAddingAndSaving("news_image","page","CECP NEWS Image", false, "normal","page-templates/templates-about.php");

     $this->metaBoxAddingAndSaving("career_text","page","Career Text", false, "normal","page-templates/templates-about.php");

     $this->metaBoxImageAddingAndSaving("career_image","page","Career Image", false, "normal","page-templates/templates-about.php");

     $this->metaBoxAddingAndSaving("address_text","page","Address Text", false, "normal","page-templates/templates-about.php","textarea");

     $this->metaBoxImageAddingAndSaving("map_image","page","Map Image", false, "normal","page-templates/templates-about.php");

     //home page meta

     $this->metaBoxAddingAndSaving("testimonial_text","page","Testimonial Heading", false, "normal","page-templates/templates-homepage.php");

     $this->metaBoxAddingAndSaving("services_text","page","Services Heading", false, "normal","page-templates/templates-homepage.php");
     $this->metaBoxAddingAndSaving("services_subtext","page","Services Sub Heading", false, "normal","page-templates/templates-homepage.php");
     $this->metaBoxAddingAndSaving("whatsnew_heading","page","What's New Heading", false, "normal","page-templates/templates-homepage.php");

     $this->metaBoxImageAddingAndSaving("post_author_image","post","Author Image", false, "normal", false);

     $this->metaBoxAddingAndSaving("phots_heading","page","Photos Heading", false, "normal","page-templates/templates-photos-video.php");
     $this->metaBoxAddingAndSaving("photos_description","page","Photos Description", false, "normal","page-templates/templates-photos-video.php");
     $this->metaBoxAddingAndSaving("videos_heading","page","Videos Heading", false, "normal","page-templates/templates-photos-video.php");
     $this->metaBoxAddingAndSaving("videos_description","page","Videos Description", false, "normal","page-templates/templates-photos-video.php");

     //=================================Meta Box added for The Global Exchange Page=================================================================

    $this->metaBoxAddingAndSaving("globalMap_heading","page","Insert Global Exchange Map Title", false, "normal","page-templates/template-globalExchange.php");
    $this->metaBoxImageAddingAndSaving("map_image","page","Map Image", false, "normal","page-templates/template-globalExchange.php");
	$this->metaBoxAddingAndSaving("globalMap_content","page","Content After logo", false, "normal","page-templates/template-globalExchange.php");
	
	//=================================Meta Box added for The Post Type Network Partners=================================================================
	$this->metaBoxAddingAndSaving("networkpartner_link","networkpartners","Network Link", false, "normal");

  $this->metaBoxAddingAndSaving("thought_leader_pdf_link","thought_leadership","PDF Link", false, "normal");

  //=================================Meta Box added for Giving Tuesday Page=================================================================
  $this->metaBoxImageAddingAndSaving("givingTuesday_image","page","Giving Tuesday Image", false, "normal","page-templates/templates-giving-tuesday.php");

  $this->metaBoxAddingAndSaving("event_register_link","events","Event Register Link", false, "normal","");

  $this->metaBoxAddingAndSaving("news_external_link","news","External Link", false, "normal","");

  $this->metaBoxImageAddingAndSaving("pressrelease_pdf", "pressreleases", "Press Releases PDF", false, "normal","");

  $this->metaBoxAddingAndSaving("movement_external_link","movements","External Link", false, "normal","");

  $this->metaBoxAddingAndSaving("event_member_image_info","events","Member Image Info", false, "normal","");

  $this->metaBoxAddingAndSaving("advisoryboard_designation","advisoryboard","Member Designation", false, "normal","");

  $this->metaBoxImageAddingAndSaving("investor_board_image","page","Investor Advisery Board Image", false, "normal","page-templates/templates-investors.php");


  //giving cecp page
  for($i=1 ; $i<=4;$i++){

    $this->metaBoxImageAddingAndSaving("giving_pdf_image".$i,"giving_in_numbers","Upload PDF Image ".$i, false, "side");

    $this->metaBoxImageAddingAndSaving("giving_pdf".$i,"giving_in_numbers","Upload PDF Only".$i, false, "side","none","Upload Pdf");
   
  }
  


  if(class_exists("myCecp")){    
    $this->metaBoxAddingAndSaving("mycecp_addition_cecp_resoursec_text","page","Additional CECP Resources text", false, "normal","page-templates/template-mycecp.php");
    $this->metaBoxImageAddingAndSaving("mycecp_knw","knowledge_center","Upload PDF Only", false, "side","none","Upload Pdf");
  }
     

    //$this->metaBoxAddingAndSaving("companylogo_pageId","page","Insert Logo Page ID", false, "normal","page-templates/templates-homepage.php");

    } // __construct ends

    function metaBoxImageAddingAndSaving($metaBoxName,$postType,$label,$serialize=false,$content="side",$template="none",$buttonName="Upload Image"){       
       require_once(CECP_DIR.'lib/classAddMetaBoxes.php');
       require_once(CECP_DIR.'lib/classSaveMetaBoxes.php');
       $metabox = new CECP_addMetaBox;
        if($template !="none"){
            $metabox->template = $template;
          }        

          $metabox->metaBoxName = $metaBoxName;
          $metabox->postType    = $postType;
          $metabox->label       = $label;
          $metabox->context  =$content;
          $metabox->serialize  =$serialize;
          $metabox->imageLabel  = "Upload ". $label;
          $metabox->imagePlaceHolderIdMeta  =$metaBoxName;
          $metabox->buttonName = $buttonName;
          $metabox->registerImageMetaBox();

          //saving meta box
          $saveMetaBox = new CECP_saveMetaBoxes;
          $saveMetaBox->metaBoxName = $metaBoxName;
          $saveMetaBox->postType    = $postType;
          $saveMetaBox->serialize    = $serialize;
          $saveMetaBox->saveMetaBox();
    } 
    function metaBoxAddingAndSaving($metaBoxName,$postType,$label,$serialize=false,$content="side",$template="none",$type="text"){
        require_once(CECP_DIR.'lib/classAddMetaBoxes.php');
        require_once(CECP_DIR.'lib/classSaveMetaBoxes.php');
        $metabox = new CECP_addMetaBox;
        $saveMetaBox = new CECP_saveMetaBoxes;
        //inserting external link in whats news
        
        if($template !="none"){
            $metabox->template = $template;
          }

        if($type != "text"){
             $metabox->inputType = $type;

          }   
          $metabox->metaBoxName = $metaBoxName;
          $metabox->postType    = $postType;
          $metabox->label       = $label;
          $metabox->context  =$content;
          $metabox->serialize  =$serialize;
          $metabox->registerMetaBox();

          //saving meta box
          $saveMetaBox->metaBoxName = $metaBoxName;
          $saveMetaBox->postType    = $postType;
          $saveMetaBox->serialize    = $serialize;
          $saveMetaBox->saveMetaBox();

    }

  }

  add_action( "admin_init" , "CECP_metabox::instance");
?>
