<?php
/**
 * Template Name: Travel titbit
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
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/responsive.css">

	<?php wp_head(); ?>
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
			<?php require_once locate_template('footer-sidebar.php'); ?>
			
			<div class="col-sm-9 leftheight pull-left">
				<div class="row">

				<?php
				    /* The loop */
				    $args = array(
        'post_type'  => 'traveltitbits',
        'posts_per_page' => -1,
        'post_status' =>'publish'
        );
      $the_query = new WP_Query( $args );
      $c = 0;
      $posts = $the_query->found_posts;
				    while ( $the_query->have_posts() ) { $the_query->the_post(); 
				     $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full','true' ); ?>
				    <div class="col-sm-6 tour scroll-here">
						<div class="tour-inner">
							<a href="<?php the_permalink(); ?>#tab0<?php echo get_the_id(); ?>C">
								<img src="<?php echo $image[0]; ?>" class="img-responsive ser">
								<div class="bottom">
									<h1><?php the_title( ); ?></h1>
									<?php the_content( ); ?>
								</div>
							</a>
						</div>	
					</div>
				     
				  <?php  }
				    ?>
					
				</div>
			<?php require_once locate_template('footer-middle.php'); ?>
				
			</div>
		</div>		
	</div>

<div class="enqbutton">
	<img src="images/enquarybutton.png">
</div>
<div class="tourbutton">
	<img src="images/tourbutton.png">
</div>
<?php echo do_shortcode( '[contact-form-7 id="68" title="Book Us Now"]' ); ?>

<?php echo do_shortcode( '[contact-form-7 id="205" title="Book Us Now"]' ); ?>

</body>
	<?php wp_footer(); ?>
	<script src="js/custom.js"></script>
	<script src="js/bootstrap.min.js"></script>

</html>