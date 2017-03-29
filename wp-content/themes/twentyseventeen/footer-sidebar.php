<div class="col-sm-3 rightheight pull-right">
				<div class="servicebg-right" >
					<div class="bg">
						<a href="<?php echo $url; ?>"><img src="images/cross.png" ></a>
						<ul class="customtab-list" style="margin-top: 20px;">
							<li class="active"><a href="<?php echo get_permalink( get_the_id() ); ?>"><?php echo get_the_title() ;?></a></li>
							<?php  
                				$pagesSelected = maybe_unserialize(get_post_meta(get_the_id(), "checkfield", true));
                				
				                   if(count($pagesSelected)>0){
				                     foreach ($pagesSelected as $key => $value) {
				                     	$tab++;
				                     	$style =="";
				                     	if($tab==1){
				                     	$style = 'style="margin-top: 50px;"';
				                     }
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