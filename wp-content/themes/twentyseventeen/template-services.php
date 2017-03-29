<?php
/**
 * Template Name: services
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
		<div class="row clearfix">
			<?php require_once locate_template('footer-sidebar.php'); ?>
			<div class="col-sm-9 leftheight pull-left">
				<div class="row">
                
                <?php
				    /* The loop */
				    while ( have_posts() ) : the_post();
				        if ( get_post_gallery() ) :
				            $gallery = get_post_gallery( get_the_ID(), false );
				        	//print_r($gallery['ids']);die;
				            $gallery = explode(',', $gallery['ids']);
				            $c=0;
				            /* Loop through all the image and output them one by one */
				            foreach( $gallery as $id ) { 
				            	$attachment = get_post( $id );
				                //print_r($attachment);
				                if($c==0){
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
				            }
				            elseif($c==1){ ?>
				            <div class="col-sm-6 ">
						<div class="row">
							<div class="col-sm-12 tour">
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

				            <?php  }
				            elseif($c==2){ ?>
				            <div class="col-sm-12 tour">
								<!--  -->
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
						</div>
					</div>
				            <?php }
				            elseif($c==3 || $c==4) { ?>
				            <div class="col-sm-6 tour scroll-here" >
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

				           <?php }

				           else{ ?>
				           <div class="col-sm-6 tour">
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

				         <?php  }
				                $c++; 
				            }
				        endif;
				    endwhile;
				    if($c==1){ ?>
				     </div>
					</div>
				   <?php  }
					?>
					
			

				</div>
			</div>
		</div>		
	</div>

<div class="enqbutton">
		<img src="images/enquarybutton.png">
	</div>
<?php echo do_shortcode( '[contact-form-7 id="58" title="Book Us Now"]' ); ?>


</body>
    <?php wp_footer(); ?>
	<script src="js/custom.js"></script>
	<script src="js/bootstrap.min.js"></script>
</html>