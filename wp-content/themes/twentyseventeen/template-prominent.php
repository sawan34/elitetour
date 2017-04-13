<?php
/**
 * Template Name: Prominent
 *
 * @package WordPress
 * @subpackage CECP
 * @since CECP 1.0
 */

$url = get_bloginfo( 'url' );
$ref = $_SERVER['HTTP_REFERER'] ;

$args = array(
	    'green'=>'first',
		'red'=>'second',
		'yellow' =>'third'
       );

?>
<html>
<head>
<title>Elite Tour Agra</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/responsive.css">

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
			<?php require_once locate_template('footer-sidebar.php'); ?>
			
			<div class="col-sm-9 pull-left">
				<div class="custom-tab leftheight">
					<div class="row">
						<div class="col-xs-12">
							<div class="tour-heading">
								<h2><?php echo get_the_title( ); ?></h2>
							</div>
							<div class="tour-banner">
								<?php
							if(has_post_thumbnail()){
                			$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full','true' );
               					}
               				?>
								<img src="<?php echo $image[0] ; ?>">
							</div>
						</div>
					</div>
					<div class="row" style="padding-bottom:50px;"> 
					<?php 
			  						$itinerary = get_post_meta(get_the_id(), '_prominent_guest_galley', true );
			  						if($itinerary !=''){
			  							  $gallery =	shortcode_parse_atts( $itinerary );
			  							  $gallery =	str_replace('ids=','', $gallery[1]);
			  							  $gallery =	str_replace(']','', $gallery);
			  							  $gallery =	str_replace('"','', $gallery);

			  							  $gallery =    explode(',', $gallery);

			  							  foreach ($gallery as  $value) {	
			  							  $attachment = get_post( $value );		  
									?>
						<div class="col-sm-4">
							<div class="prominent-box">
								<div class="prominent-image <?php echo $args[get_post_meta( $value, '_gallery_text_color', true )]; ?>">
									<div class="prominent-inner">
										<img src="<?php echo wp_get_attachment_url( $value); ?>">
										
									</div>
								</div>
								<div class="prominent-text">
									<h4 class="<?php echo get_post_meta( $value, '_gallery_text_color', true ); ?>">
									<?php echo $attachment->post_excerpt; ?></h4>
								</div>
							</div>
						</div>	
						<?php } } ?>


					</div>
				</div>
			<?php require_once locate_template('footer-middle.php'); ?>

			</div>
		</div>
	</div>


<div class="enqbutton">
	<img src="images/enquarybutton.png">
</div>
<?php echo do_shortcode( '[contact-form-7 id="58" title="Book Us Now"]' ); ?>


<!-- ----------2nd-form------------ -->


</body>
</html>