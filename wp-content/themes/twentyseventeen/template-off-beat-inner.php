<?php
/**
 * Template Name: Off beat Inner
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
		<div class="row clearfix popular_innerpage">
			<div class="col-sm-3 rightheight pull-right">
				<div class="servicebg-right" >
					<div class="bg">
						<a href="<?php echo $url ; ?>"><img src="images/cross.png" ></a>
						<h2>Offbeat Tours</h2>
						<ul id="tabs" class="customtab-list nav nav-tabs nav-stacked" data-tabs="tabs">
						    <?php
								// Set up the objects needed
								$my_wp_query = new WP_Query();
								$all_wp_pages = $my_wp_query->query(array('post_type' => 'page','post_status'=>'publish' ,
									'posts_per_page' => -1));


								// Filter through all pages and find Portfolio's children
								$portfolio_children = get_page_children( get_the_id(), $all_wp_pages );
								$active = 'active';
								// echo what we get back from WP to the browser
								foreach ($portfolio_children as  $value) { ?>
								<li class="<?php echo $active; $active=""; ?>"><a id="tab01" href="#tab0<?php echo $value->ID ;?>C" data-toggle="tab"><?php echo $value->post_title ;?></a></li>
								<?php
									# code...
								}
								?>
							
						</ul>
					</div>
				</div>
			</div>
			<div class="col-sm-9 tab-content pull-left" id="my-tab-content">
			<?php $active = 'active'; foreach ($portfolio_children as  $pageValue) { ?>
				<div class="custom-tab leftheight tab-pane fade in <?php echo $active; $active=''; ?>" id="tab0<?php echo $pageValue->ID; ?>C">
					<div class="row">
						<div class="col-xs-12">
							<div class="tour-heading">
								<h2><?php echo $pageValue->post_title; ?></h2>
							</div>
							<?php
							if(has_post_thumbnail($pageValue->ID)){
			                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $pageValue->ID ), 'full','true' );
			                ?>
							<div class="tour-banner">
								<img src="<?php echo $image[0]; ?>">
							</div>
							<?php } ?>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="tour-tab">
								<ul class="nav nav-tabs">
			  						<li class="active"><a data-toggle="tab" href="#details<?php echo $pageValue->ID; ?>">Details</a></li>
			  						<li><a data-toggle="tab" href="#intinerary<?php echo $pageValue->ID; ?>">Itinerary</a></li>
			  						<li><a data-toggle="tab" href="#location<?php echo $pageValue->ID; ?>">Location</a></li>
			  						<li><a data-toggle="tab" href="#photos<?php echo $pageValue->ID; ?>">Photos</a></li>
								</ul>
								<div class="tab-content">
			  						<div id="details<?php echo $pageValue->ID; ?>" class="tab-pane fade in active">
				    					<?php echo get_post_meta( $pageValue->ID, '_off_beat_inner_details_editor', true ); ?>
									</div>
									
			  						<div id="intinerary<?php echo $pageValue->ID; ?>" class="tab-pane fade">
			  						<?php 
			  						$itinerary = get_post_meta( $pageValue->ID, '_off_beat_inner_itinerary_editor', true );
			  						if($itinerary !=''){
			  							  $gallery =	shortcode_parse_atts( $itinerary );
			  							  $gallery =	str_replace('ids=','', $gallery[1]);
			  							  $gallery =	str_replace(']','', $gallery);
			  							  $gallery =	str_replace('"','', $gallery);

			  							  $gallery =    explode(',', $gallery);

			  							  foreach ($gallery as  $value) {	
			  							  $attachment = get_post( $value );		  
									?>
										<div class="itinerary-box">
			    							<div class="row">
			    								<div class="col-sm-4">
			    									<div class="itinerary-image">
			    										<img src="<?php echo wp_get_attachment_url( $value); ?>">
			    									</div>
			    								</div>
			    								<div class="col-sm-8">
			    									<div class="itinerary-text">
			    									<h3><?php echo $attachment->post_excerpt; ?><h3>
													<?php echo $attachment->post_content; ?>
			    										
			    									</div>
			    								</div>
			    							</div>
			    						</div>
			  						 <?php } } ?>

			  						</div><! -- itenary ends -->
			  						<div id="location<?php echo $pageValue->ID; ?>" class="tab-pane fade ">
			    						<div class="location-map">
			    							<div style="width: 100%">
			    							<?php echo get_post_meta( $pageValue->ID, '_off_beat_inner_location_editor', true ); ?>
			    							</div><br />
			    						</div>
			  						</div>
			  						<?php 
			  						$itinerary = get_post_meta( $pageValue->ID, '_off_beat_inner_photos_editor', true );
			  						if($itinerary !=''){ ?>
			  						<div id="photos<?php echo $pageValue->ID; ?>" class="tab-pane fade">
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
				</div> <!--- content ends here -->
			<?php } ?>	
			<?php require_once locate_template('footer-middle.php'); ?>
				


			</div>
			
		</div>		
	</div>
<div class="enqbutton">
		<img src="images/enquarybutton.png">
	</div>
<?php echo do_shortcode( '[contact-form-7 id="58" title="Book Us Now"]' ); ?>
<?php wp_footer();?>
<script src="js/custom.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>