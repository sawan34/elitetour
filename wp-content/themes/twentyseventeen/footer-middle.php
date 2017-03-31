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