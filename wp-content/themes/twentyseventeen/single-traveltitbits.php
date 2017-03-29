<?php
$url = get_bloginfo( 'url' );
$ref = $_SERVER['HTTP_REFERER'] ;
global $post;
$args = array(
	'posts_per_page'   => -1,
	'offset'           => 0,
	'category'         => '',
	'category_name'    => '',
	'orderby'          => 'date',
	'order'            => 'DESC',
	'include'          => '',
	'exclude'          => '',
	'meta_key'         => '',
	'meta_value'       => '',
	'post_type'        => 'traveltitbits',
	'post_mime_type'   => '',
	'post_parent'      => '',
	'author'	   => '',
	'author_name'	   => '',
	'post_status'      => 'publish',
	'suppress_filters' => true 
);
$posts_array = get_posts( $args );
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
						<a href="<?php echo $url ; ?>"><img src="images/cross.png" ></a>
						<h2>Travel</h2>
						<ul id="tabs" class="customtab-list nav nav-tabs nav-stacked" data-tabs="tabs">
						<?php 
						 foreach ($posts_array as  $post) {
						 	 setup_postdata( $post );
						 	?>
							<li class="active"><a id="tab0C" href="#tab0<?php the_ID(); ?>C" data-toggle="tab"><?php the_title();?></a></li>
						<?php } ?>	

						</ul>
					</div>
				</div>
			</div>
			<div class="col-sm-9 tab-content pull-left" id="my-tab-content">
				<?php 
						 foreach ($posts_array as $post) {
						 	 setup_postdata( $post );
						 	 $active = 'leftheight  fade in active';
						 	 $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full','true' );
						 	?>

				<div class="custom-tab tab-pane <?php echo $active; ?>" id="tab0<?php the_ID(); ?>C">
					<div class="row">
						<div class="col-xs-12">
							<div class="tour-heading">
								<h2><?php the_title(); ?></h2>
							</div>
							<div class="tour-banner">
								<img src="<?php echo $image[0]; ?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="tour-tab">
								<ul class="nav nav-tabs">
			  						<li class="active"><a data-toggle="tab" href="#details<?php echo get_the_id(); ?>">Places to Visit</a></li>
			  						<li><a data-toggle="tab" href="#intinerary<?php echo get_the_id(); ?>">Best Time to Visit</a></li>
			  						<li><a data-toggle="tab" href="#location<?php echo get_the_id(); ?>">Map of the City</a></li>
			  						<li><a data-toggle="tab" href="#reach<?php echo get_the_id(); ?>">How to reach?</a></li>
			  						<li><a data-toggle="tab" href="#facts<?php echo get_the_id(); ?>">Facts</a></li>
			  						<li><a data-toggle="tab" href="#photos<?php echo get_the_id(); ?>">Picture Gallery</a></li>
								</ul>
								<div class="tab-content">
			  						<div id="details<?php echo get_the_id(); ?>" class="tab-pane fade in active">
				    					<?php echo get_post_meta(get_the_id(), '_off_beat_inner_details_editor', true ); ?>
				    					
									</div>
			  						<div id="intinerary<?php echo get_the_id(); ?>" class="tab-pane fade">
			    						<h3>best Time To Visit</h3>
				    					<?php echo get_post_meta(get_the_id(), '_off_beat_inner_itinerary_editor', true ); ?>

			  						</div>
			  						<div id="location<?php echo get_the_id(); ?>" class="tab-pane fade">
			    						<div class="location-map">
			    							<div style="width: 100%">
				    					<?php echo get_post_meta(get_the_id(), '_off_beat_inner_location_editor', true ); ?>
			    							

			    							</div><br />
			    						</div>
			  						</div>
			  						<div id="reach<?php echo get_the_id(); ?>" class="tab-pane fade">
				    					<?php echo get_post_meta(get_the_id(), '_off_beat_htr_editor', true ); ?>
			  						</div>
			  						<div id="facts<?php echo get_the_id(); ?>" class="tab-pane fade">
				    					<?php echo get_post_meta(get_the_id(), '_off_beat_facts_editor', true ); ?>
			    						
			  						</div>
			  						<?php 
			  						$itinerary = get_post_meta(get_the_id(), '_off_beat_inner_photos_editor', true );
			  						if($itinerary !=''){ ?>
			  						<div id="photos<?php echo get_the_id(); ?>" class="tab-pane fade">
									    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
											  <!-- Indicators -->
											<ol class="carousel-indicators">
											<?php
												 $gallery =	shortcode_parse_atts( $itinerary );
					  							  $gallery =	str_replace('ids=','', $gallery[1]);
					  							  $gallery =	str_replace(']','', $gallery);
					  							  $gallery =	str_replace('"','', $gallery);

					  							  $gallery =    explode(',', $gallery);
					  							  $c =0 ;
					  							  $active = 'active';
					  							  foreach ($gallery as  $value) {	
					  							  $attachment = get_post( $value );		  
											?>

											<li data-target="#carousel-example-generic" data-slide-to="<?php echo $c; ?>" class="<?php echo $active; ?>"><img src="<?php echo wp_get_attachment_url( $value); ?>" /></li>

											<?php $c++;$active=''; } ?>
											</ol>

											  <!-- Wrapper for slides -->
											<div class="carousel-inner" role="listbox">
											<?php
					  							$active = 'active';

												foreach ($gallery as  $value) {	
					  							  $attachment = get_post( $value );
					  							  ?>
											    <div class="item <?php echo $active; $active=''; ?>">
											      	<img src="<?php echo wp_get_attachment_url( $value); ?>" />
											    </div>
											    <?php } ?>
											</div>


										</div>
			  						</div>
			  						<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php $active=""; } ?>
			</div>
		</div>		
	</div>

<div class="enqbutton">
		<img src="images/enquarybutton.png">
	</div>

<?php echo do_shortcode( '[contact-form-7 id="58" title="Book Us Now"]' ); ?>

<?php wp_footer(); ?>
	<script src="js/custom.js"></script>
	<script src="js/bootstrap.min.js"></script>


</body>
</html>