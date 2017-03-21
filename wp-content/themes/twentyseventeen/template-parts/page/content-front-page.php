<?php
/**
 * Displays content for front page
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
<?php the_content( ); ?>

<?php
wp_reset_postdata();

?>
<?php
        $args = array(
        'post_type'  => 'knowmoreservices',
        'posts_per_page' => -1,
        'post_status' =>'publish'
        );
      $the_query = new WP_Query( $args );
      $c = 0;
      $posts = $the_query->found_posts;
      if($posts > 0){ ?>
<section class="knowmore-services">
		<div class="container-fluid">
			<div class="row">
			<?php 
          $active = ' active';
          while ( $the_query->have_posts() ) {  
            $the_query->the_post(); 
              
              if(has_post_thumbnail()){
                $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full','true' );
                $pagesSelected = maybe_unserialize(get_post_meta(get_the_id(), "checkfield", true));
               ?>
				<div class="col-sm-4 image01" style="background: url(<?php echo $image[0]; ?>) no-repeat center;">
				<?php
                   if(count($pagesSelected)>0){
                     foreach ($pagesSelected as $key => $value) {
                  ?>
					<a class="knowmore-outer" href="<?php echo get_permalink($value); ?>">
					<?php } } ?>
						<div class="know-text">
							<h2><?php  _e(get_the_title($value)); ?></h2>
						</div>
						<div class="hover-bg">
							<div class="hover-text">
								<h4><?php the_title( ); ?></h4>
								<h5>View More</h5>
							</div>
						</div>					
					</a>
				</div>
          <?php } $active ="";} ?>  
				
			</div>
		</div>
		
	</section>
	<?php } else {echo _e("No services present");} ?>
	<footer class="footer scroll-here" id="footer">
		<div class="container">
			<div class="row" style="border-bottom: 1px solid #b4cb39; padding-bottom: 20px;">
				<div class="col-sm-2">
					<div class="footer-logo">
					   <?php
					     $custom_logo_id = get_theme_mod( 'custom_logo' );
					     echo wp_get_attachment_image( $custom_logo_id, 'full', false, array(
				'class'    => 'custom-logo',
				'itemprop' => 'logo',
			) ) ; ?>
					</div>
					<div class="ft-logotxt text-left">
						<p><?php echo get_option('killer_custom_option_footerfield1',true); ?></p>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="footer-text">
						<h3>Contact</h3>
						<p>It is a long established fact that a reader </p>
						<?php
							wp_nav_menu( array(
								'theme_location' => 'social',
								'menu_class'     => 'social-icon',
								'depth'          => 1,
								'before'    => '<div>',
								'after'     => '</div>',
							) );
						?>
						<?php echo get_option('killer_custom_option_address',true); ?>

						<!--<ul class="social-icon">
							<li><div><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></div></li>
							<li><div><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></div></li>
							<li><div><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></div></li>
							<li><div><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></div></li>
						</ul> -->
						<h6><?php echo get_option('killer_custom_option_copyright',true); ?></h6>
					</div>
				</div>
				<div class="col-sm-2">
					<div class="ft-paypal">
						<a target="_blank" href="<?php echo get_option('killer_custom_option_paypallink',true); ?>"><img src="images/paypal-payment.png"></a>
					</div>
				</div>
			</div>
			<?php echo get_option('killer_custom_option_footer_content',true); ?>
			
		</div>			
	</footer>      

	
