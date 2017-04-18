<?php
require_once(CECP_DIR.'lib/classCreateWidget.php');
// 

class SliderWidget extends CECF_Widget_builder{
  function __construct(){
    parent::__construct(
               'elite_slider',
               __("Slider",'text_domain') ,
               array('description' => __( 'Widget for Slider', 'text_domain' ),)     
      );

     }

   public function widget($args,$instance){ ?>

   <section class="index-banner">
    <div id="wowslider-container1" >
      <div class="ws_images">
        <?php
        $args = array(
        'post_type'  => 'slider',
        'posts_per_page' => -1,
        'post_status' =>'publish'
        );
      $the_query = new WP_Query( $args );
      $c = 0;
      $posts = $the_query->found_posts;
      if($posts > 0){ ?>
        <ul>        
        <?php 
          $active = 0;
          while ( $the_query->have_posts() ) {  
            $the_query->the_post(); 
              
              if(has_post_thumbnail()){
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full','true' );
                
               ?>
                 <li><img src="<?php echo $image[0]; ?>" alt="collage" title="" id="wows1_<?php echo $active; ?>"/>
                           <?php the_title(); ?>
                  </li>
          <?php } 
                   $active++;
                 } 
           ?>  
        
            </ul>
            <?php } else {echo _e("No slider present");} ?>        
        </div>
    </div>
  </section>

   <?php }  
}


 class CEOS extends CECF_Widget_builder{


 	public $textfields=array(
 		'title'=>'Title',
 		'description'=>'Description',
 		'link'=>'Link',
 		'button' => "Enter Button",
 		'ceo_name1'  => "Enter CEO name for the first placeholder",
 		'ceo_name2' => "Enter CEO name for the Second placeholder",
 		'company_name1' => "Enter Company Name First placeholder",
 		'company_name2' => "Enter Company Name Second placeholder",

 		);

 	public $imagefields=array(
 		'ceo_image_1' =>"Upload First CEO Image " ,
 		'ceo_image_2' => "Upload Second CEO Image ", 
 		'logo_image_1' => "Upload First Company Logo",
 		'logo_image_2' => "Upload Second Company Logo"
 		);  



 	function __construct(){
 		parent::__construct(
               'cecp_ceo',
               __("Select CEO's ",'text_domain') ,
               array('description' => __( 'Widget for cecp', 'text_domain' ),)     
	  	);

 		add_action('admin_enqueue_scripts', array($this, 'widget_upload_scripts'));

 	   }

   private function ceoDescriptions($instance=array()) {
       $output ="";
      for ($i=1; $i <= 2 ; $i++) { 

        $imageUrlCeo = $this->getimageById($instance['ceo_image_'.$i]);
        $metaceo   =  esc_attr__( $instance["ceo_name".$i] );

        $ceoName  = $instance["ceo_name".$i];
        $companyName = $instance["company_name".$i];
        $imageUrlLogo = $this->getimageById($instance['logo_image_'.$i]);
        $metalogo = esc_attr__( $instance["company_name".$i] );

        //ceo image
        //ceo alt
        //ceo name        
        //company name
        // logo image
        // logo alt
        $output .=sprintf('<li> <img src="%s" alt="%s"><strong>%s</strong> <span>%s</span>
                  <div class="clearfix"><img src="%s" alt="%s"></div>
                </li>',$imageUrlCeo,$metaceo,$ceoName,$companyName,$imageUrlLogo,$metalogo);
      }

      echo $output;
   }   

   public function widget( $args, $instance ) {
      ?>
      <div class="row">
          <div class="col left">
            <div class="content-box">
              <?php 
                $this->cecp_description($instance["title"],$instance["description"]);
                $this->cecp_button($instance["link"],$instance["button"],$instance["title"]);
              ?>              
            </div>
          </div>
          <div class="col right">
          <a href="<?php echo $instance["link"]; ?>">
            <div class="img-block-bg">
              <ul class="ceo-detials">
                <?php $this->ceoDescriptions($instance); ?>
              </ul>
            </div>
            </a>
          </div>
        </div>
      <?php
     } 
 }

 class corporate_leaders extends CECF_Widget_builder {
   
 	public $textfields=array(
 		'title'=>'Title',
 		'description'=>'Description',
 		'link'=>'Link',
 		'button' => "Enter Button String",

 		);
 	public $imagefields=array(
 		'logo_image_1' =>"Upload Logo Image 1" ,
 		'logo_image_2' => "Upload Logo Image 2", 
 		'logo_image_3' => "Upload Logo Image 3",
 		'logo_image_4' => "Upload Logo Image 4"
 		);  

 	function __construct(){
 		parent::__construct(
 			'cecp_corporate_leaders',
 			__("Select Corporate Leaders ",'text_domain') ,
 			array('description' => __( 'Widget for Corporate Leaders', 'text_domain' ),)     
 			);

 		add_action('admin_enqueue_scripts', array($this, 'widget_upload_scripts'));

 	}

  public function getcompaniesLogo($instance=array()){
       $output="";
       for ($i=1; $i <= 4 ; $i++) { 
         $imageUrlLogo = $this->getimageById($instance['logo_image_'.$i]);
         if(strlen($imageUrlLogo) > 0){
         $output .= sprintf('<li><div class="img-block-bg"><div class="minheight"><img src="%s" alt="logo"></div></div></li>',$imageUrlLogo);
          }
       }
       echo $output;
  }

   public function widget( $args, $instance ) {
    //var_dump($instance);
      ?>
         <div class="row mar0 left-to-right">
          <div class="col right">
            <div class="content-box">
              <?php 
                $this->cecp_description($instance["title"],$instance["description"]);
                $this->cecp_button($instance["link"],$instance["button"],$instance["title"]);
              ?> 
            </div>
          </div>
          <div class="col left">
          <a href="<?php echo $instance["link"]; ?>">
            <ul class="corporate-block">
              <?php 
                  $this->getcompaniesLogo($instance);
               ?>
            </ul>
            </a>
          </div>
        </div>
      <?php 
    } //widget method ends

 }

 class stragicInvestorWidget extends CECF_Widget_builder{
    public $textfields=array(
 		'title'=>'Title',
 		'description'=>'Description',
 		'link'=>'Link',
 		'button' => "Enter Button String",
     'imagetext' => "Enter Text which reflect on the image" 
 		);
    public $imagefields=array(
 		'strategicimage' =>"Upload STRATEGIC  Image"
 		);  
    function __construct(){
 		parent::__construct(
 			'cecp_strategic_investor',
 			__("Strategic Investor Initiative",'text_domain') ,
 			array('description' => __( 'Widget for Strategic Investor Initiative', 'text_domain' ),)     
 			);

 		add_action('admin_enqueue_scripts', array($this, 'widget_upload_scripts'));

 	  }//construct ends here

    public function widget( $args, $instance ) { ?>
        <div class="row">
          <div class="col left">
            <div class="content-box">
               <?php 
                $this->cecp_description($instance["title"],$instance["description"]);
                $this->cecp_button($instance["link"],$instance["button"],$instance["title"]);
              ?> 
            </div>
          </div>
          <div class="col right">
          <a href="<?php echo $instance["link"]; ?>">
            <div class="img-block-bg the-strategic">
             <?php
                $image = $this->getimageById($instance['strategicimage']);
                $imageText =  $instance['imagetext'] ;
             ?>
              <P><?php echo $imageText; ?></P>
              <img src="<?php echo $image; ?>" alt="<?php echo esc_attr__($imageText); ?>" class="left"> </div>
          </div>
          </a>
        </div>
    <?php }  //widgets methods ends here

 }

 class globalExchangeWidget extends CECF_Widget_builder{
    public $textfields=array(
 		'title'=>'Title',
 		'link'=>'Link',
 		'button' => "Enter Button String"
 		);
    public $imagefields=array(
 		'globalexchangeimage' =>"Upload Global Exchange Image"
 		);  
    function __construct(){
 		parent::__construct(
 			'cecp_global_exchange',
 			__("THE GLOBAL EXCHANGE",'text_domain') ,
 			array('description' => __( 'Widget for THE GLOBAL EXCHANGE', 'text_domain' ),)     
 			);

 		add_action('admin_enqueue_scripts', array($this, 'widget_upload_scripts'));

 	  } //construct ends here


    public function widget( $args, $instance ) { ?>
         <div class="row  left-to-right">
        <div class="col right">
            <div class="content-box">
              <?php
                 $this->cecp_description($instance["title"]);
                 $this->cecp_button($instance["link"],$instance["button"],$instance["title"]);
               ?>
            </div>
          </div>
          <div class="col left">
          <a href="<?php echo $instance["link"];?>">
            <div class="img-block-bg the-global"> 
               <?php
                $image = $this->getimageById($instance['globalexchangeimage']);
                $alttext =  $instance['title'] ;
               ?>
               <img src="<?php echo $image; ?>" alt="<?php esc_attr_e($alttext); ?>" class="left"> </div>
          </div>
          </a>
        </div>
    <?php 
     }
 }

 function register_cmf_widgets() {

 	  register_widget( 'SliderWidget' );
   // register_widget( 'corporate_leaders' );
    //register_widget( 'stragicInvestorWidget' );
   // register_widget( 'globalExchangeWidget' );
   
    do_action( 'cecp_add_widget_init' );      


 }
 add_action( 'widgets_init', 'register_cmf_widgets' );
?>