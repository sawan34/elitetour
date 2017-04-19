<?php
/**
 * Template Name: Tour Guide
 *
 * @package WordPress
 * @subpackage CECP
 * @since CECP 1.0
 */

$url = get_bloginfo( 'url' );
?>
<html>
<head>
<title>Elite Tour Agra</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo $url ; ?>/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $url ; ?>/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $url ; ?>/css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $url ; ?>/css/responsive.css">

    <?php wp_head(); ?> 
	
</head>
<body>
	<!-- <div id="google_translate_element"></div> -->
    <script type="text/javascript">
    function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
	
	<div class="container-fluid">
		<div class="row clearfix">
			<div class="col-sm-3 rightheight pull-right">
				<div class="servicebg-right" >
					<div class="bg">
						<a href="<?php echo $url; ?>"><img src="<?php echo $url ; ?>/images/cross.png" ></a>
						<h2>SERVICES</h2>
						<?php $tab =1 ;?>
						<ul id="tabs" class="customtab-list nav nav-tabs nav-stacked" data-tabs="tabs">
							<li class="active"><a id="tab01" href="#tab0<?php echo $tab; ?>C" data-toggle="tab"><?php echo get_the_title(get_the_id()); ?></a></li>
							<?php  
                				$pagesSelected = maybe_unserialize(get_post_meta(get_the_id(), "checkfield", true));
                				
				                   if(count($pagesSelected)>0){
				                     foreach ($pagesSelected as $key => $value) {
				                     	$tab++;
                                  ?>
							       <li><a href="#tab0<?php echo $value; ?>C" data-toggle="tab"><?php echo strtoupper(get_the_title($value))  ; ?></a></li>
								<?php } }?>
						</ul>
						<?php $tab =1 ;?>
					</div>
				</div>
			</div>
			<div class="col-sm-9 tab-content pull-left" id="my-tab-content">
				<div class="custom-tab tab-pane leftheight fade in active" id="tab0<?php echo get_the_id(); ?>C">
					<div class="row">
						<div class="col-xs-12">
							<div class="tour-heading">
								<h2>Tour Guide</h2>
							</div>
							<div class="tour-banner">
							<?php
							if(has_post_thumbnail()){
                			$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full','true' );
               					}
               				?>
								<img src="<?php echo $image[0] ; ?>">
							</div>
							<div class="tour-details">
								<!-- <h3>It is a long established</h3> -->
								<?php
									while ( have_posts() ) : the_post();
									 the_content( );
									endwhile; // End of the loop.
								?>
							</div>
						</div>
					</div>

<!-- ------------associates-section----------------- -->

							<div class="main-associates">
							<?php
        $args = array(
        'post_type'  => 'associates',
        'posts_per_page' => -1,
        'post_status' =>'publish'
        );
      $the_query = new WP_Query( $args );
      $c = 0;
      $posts = $the_query->found_posts;
      if($posts > 0){ ?>
								<div class="row">
									<div class="col-xs-12">
										<div class="tour-heading">
											<h2>Associates</h2>
										</div>
									</div>
							   </div>

        <?php 
          $active = ' active';
          while ( $the_query->have_posts() ) {  
            $the_query->the_post(); 
              $image="";
              if(has_post_thumbnail()){
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full','true' );
               }
                
               ?>


							<div class="row associates">
								<div class="col-sm-3">
								<img src="<?php echo $image[0]; ?>" class="img-responsive" />
								</div>
								<div class="col-sm-9">
								<div class="row namestyle">
									<div class="col-sm-3"><label><b>Name</b></label></div>
									<div class="col-sm-9"><?php echo get_post_meta(get_the_id(),'associates_name', true ); ?></div>
								</div>
								<div class="row namestyle">
									<div class="col-sm-3"><label><b>Languages Spoken</b></label></div>
									<div class="col-sm-9"><?php echo get_post_meta(get_the_id(),'associates_lang', true ); ?></div>
								</div>
								<div class="row namestyle">
									<div class="col-sm-3"><label><b>Experience</b></label></div>
									<div class="col-sm-9"><?php echo get_post_meta(get_the_id(),'associates_exp', true ); ?></div>
								</div>
								<div class="row namestyle">
									<div class="col-sm-3"><label><b>Area of Operations</b></label></div>
									<div class="col-sm-9"><?php echo get_post_meta(get_the_id(),'associates_area', true ); ?></div>
								</div>
								<div class="row namestyle">
									<div class="col-sm-3"><label><b>Tour Guide License</b></label></div>
									<div class="col-sm-9"><?php echo get_post_meta(get_the_id(),'associates_license', true ); ?></div>
								</div>
								<div class="row ">
									<div class="col-sm-12"><?php the_content( ); ?></div>
								</div>
								</div>
							</div>

			<?php }  ?>				
					
		<?php } else {echo _e("No Associates present");}

			wp_reset_query();
		?></div>
						<!-- </div>
					</div> -->
				</div> <!-- tab01c ends here -->
               
               <?php  
                				$pagesSelected = maybe_unserialize(get_post_meta(get_the_id(), "checkfield", true));
                				
				                   if(count($pagesSelected)>0){
				                     foreach ($pagesSelected as $key => $value) {
				                     	$tab++;
                                  ?>
							       <div class="custom-tab leftheight tab-pane" id="tab0<?php echo $value; ?>C">
					<div class="row">
						<div class="col-xs-12">
							<div class="tour-heading">
								<h2><?php echo get_the_title($value) ; ?></h2>
							</div>
							<div class="tour-banner">
							   <?php 
							   $image = wp_get_attachment_image_src( get_post_thumbnail_id( $value ), 'full','true' );
							   ?>
								<img src="<?php echo $image[0]; ?>">
							</div>
							<div class="tour-details">
								<?php get_post_content_by_id($value); ?>
							</div>
						</div>
					</div>
				</div>
								<?php } }?>
			<?php require_once locate_template('footer-middle.php'); ?>
								
			</div>
		</div>		
	</div>

div class="enqbutton">
	<img src="images/enquarybutton.png">
</div>
<div class="tourbutton">
	<img src="images/tourbutton.png">
</div>
<?php echo do_shortcode( '[contact-form-7 id="68" title="Book Us Now"]' ); ?>

<?php echo do_shortcode( '[contact-form-7 id="205" title="Book Us Now"]' ); ?>
<?php wp_footer();?>
<script src="<?php echo $url ; ?>/js/custom.js"></script>
	<script src="<?php echo $url ; ?>/js/bootstrap.min.js"></script>
</body>
</html>
