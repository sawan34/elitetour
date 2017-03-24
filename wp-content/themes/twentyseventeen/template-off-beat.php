<?php
/**
 * Template Name: Template offbeat
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
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/responsive.css">

	<?php wp_head(); ?>
	<script src="js/custom.js"></script>
	<script src="js/bootstrap.min.js"></script>
</head>
<body class="page-scroller">
	<!-- <div id="google_translate_element"></div> -->
    <script type="text/javascript">
    function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

	<div class="container-fluid">
		<div class="row clearfix popularpage">
			<div class="col-sm-3 rightheight pull-right">
				<div class="servicebg-right" >
					<div class="bg">
						<a href="<?php $url ;?>"><img src="images/cross.png" ></a>
						<ul class="customtab-list" style="margin-top: 20px;">
							<li class="active"><a href="<?php echo get_permalink(get_the_id() );?>"><?php echo get_the_title(); ?></a></li>
							 <?php  
                				$pagesSelected = maybe_unserialize(get_post_meta(get_the_id(), "checkfield", true));
                				
				                   if(count($pagesSelected)>0){
				                     foreach ($pagesSelected as $key => $value) {
				                     	$tab++;
				                     	$style = 'style="margin-top: 50px;"';
                                  ?>
							<li <?php echo $style; ?>><a href="<?php echo get_permalink($value); ?>"><?php echo get_the_title($value ); ?></a></li>
							
							<?php
								$style="";
							 } }?>
						</ul>
					</div>
					<div class="trigger-scroll">&gt;</div>
				</div>
			</div>
			<div class="col-sm-9 leftheight pull-left">
				<div class="row">
					<?php
				    /* The loop */
				    while ( have_posts() ) : the_post();
				        if ( get_post_gallery() ) :
				            $gallery = get_post_gallery( get_the_ID(), false );
				        	//print_r($gallery['ids']);die;
				            $gallery = explode(',', $gallery['ids']);
				            /* Loop through all the image and output them one by one */
				            foreach( $gallery as $id ) : 
				            	$attachment = get_post( $id );
				                //print_r($attachment);
				            	?>
				            <div class="col-sm-6 tour scroll-here">
						<div class="tour-inner">
							<a href="<?php echo get_permalink(get_post_meta( $attachment->ID, '_gallery_link_url', true ) ); ?>#tab0<?php echo get_post_meta( $attachment->ID, '_gallery_link_sub_url', true ); ?>C">
								<img src="<?php echo wp_get_attachment_url( $id); ?>" class="img-responsive ser">
								<div class="bottom">
									<h1><?php echo $attachment->post_excerpt; ?></h1>
									<p><?php echo $attachment->post_content; ?></p>
								</div>
							</a>
						</div>	
					</div>
				                <?php
				            endforeach;
				        endif;
				    endwhile;
					?>

					



					
				</div>
			</div>
		</div>		
	</div>

<div class="enqbutton">
		<img src="<?php echo $url ; ?>/images/enquarybutton.png">
	</div>
<?php echo do_shortcode( '[contact-form-7 id="58" title="Book Us Now"]' ); ?>
<?php wp_footer();?>
	
</body>
</html>