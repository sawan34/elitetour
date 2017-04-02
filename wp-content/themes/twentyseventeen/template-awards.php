<?php
/**
 * Template Name: Rewards
 *
 * @package WordPress
 * @subpackage CECP
 * @since CECP 1.0
 */

$url = get_bloginfo( 'url' );
$ref = $_SERVER['HTTP_REFERER'] ;
?>
<html>
<head>
<title>Elite Tour Agra</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/lightslider.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/responsive.css">

	
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
			<?php require_once locate_template('footer-sidebar.php'); 
				    /* The loop */
				    while ( have_posts() ) : the_post();
				    ?>
			<div class="col-sm-9 tab-content pull-left">
				<div class="row">
					<div class="col-xs-12">
						<div class="tour-heading">
							<h2><?php the_title(); ?></h2>
						</div>

						<div class="demo">
						    <ul id="lightSlider">
						    <?php
						     if ( get_post_gallery() ) :
				            $gallery = get_post_gallery( get_the_ID(), false );
				        	//print_r($gallery['ids']);die;
				            $gallery = explode(',', $gallery['ids']);
				            /* Loop through all the image and output them one by one */
				            foreach( $gallery as $id ) : 
				            	$attachment = get_post( $id );
				                //print_r($attachment);
				            	?>
						        <li data-thumb="<?php echo wp_get_attachment_url( $id); ?>">
						            <img src="<?php echo wp_get_attachment_url( $id); ?>" />
						            <p><?php echo $attachment->post_excerpt; ?></p>
						        </li>
						        <?php
				            endforeach;
				        endif;?>
						    </ul>
						</div>


						<div class="tour-details">
							<p><?php echo get_post_meta(get_the_id(),'rewars_content', true ); ?></p>
						</div>
					</div>
				</div>
				<?php  endwhile;
					?>
			<?php require_once locate_template('footer-middle.php'); ?>

			</div>
		</div>		
	</div>

<div class="enqbutton">
		<img src="images/enquarybutton.png">
	</div>
<?php echo do_shortcode( '[contact-form-7 id="58" title="Book Us Now"]' ); ?>

	<?php wp_footer(); ?>
    
	<script src="js/lightslider.js"></script>
	<script src="js/custom.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
	(function($){
		$(document).ready(function(){
			$('#lightSlider').lightSlider({
			    gallery: true,
			    item: 1,
			    loop: true,
			    slideMargin: 0,
			    thumbItem: 5
			});
		});
		})(jQuery);
	</script>
</body>
</html>