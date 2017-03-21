<section class="form-section">
	<div class="form-outer">
		<div class="form-inner">
			<div class="form-close text-right">
				<a href="#">Close <img src="images/formclose.png"></a>
			</div>
			<form action="" method="" style="margin-bottom: 0;">
				<div class="form-list">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
							    <p>Name:</p>
							    <input type="text" class="form-control" id="name" required>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
							    <p>Phone no:</p>
							    <input type="text" class="form-control" id="number" required>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
							    <p>Email:</p>
							    <input type="email" class="form-control" id="email" required>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
							    <p>Country:</p>
							    <input type="text" class="form-control" id="query" required>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
							    <p>Arrival Date:</p>
							    <input type="text" class="form-control" id="name" required>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
							    <p>Departure Date:</p>
							    <input type="text" class="form-control" id="number" required>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
							    <p>Number of Adults:</p>
							    <input type="email" class="form-control" id="email" required>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
							    <p>Number of Kids:</p>
							    <input type="text" class="form-control" id="query" required>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
							    <p>Travel Type:</p>
							    <select name="" class="form-control">
							    	<option value="">Select Travel Type</option>
							    	<option value="">Family Vacation</option>
							    	<option value="">Honeymoon</option>
							    	<option value="">Business</option>
							    </select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
							    <p>Hotel Type:</p>
							    <select name="" class="form-control">
							    <option value="">Select Hotel</option>
							    	<option value="">Budget Hotel</option>
							    	<option value="">Three Star Hotel</option>
							    	<option value="">Four Star Hotel</option>
							    	<option value="">Five Star Hotel</option>
							    	<option value="">Heritage Hotel</option>
							    	</select>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
							    <p>Message:</p>
							    <textarea name="message" class="form-control messaget"></textarea>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group text-center">
								<button type="submit" class="btn btn-default">Submit</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>

</body>
<script src="js/bootstrap.min.js"></script>
	<script src="js/wow.min.js"></script>
	<script src="js/custom.js"></script>
	<script>
	(function($){
new WOW().init();
$(function(){
	$(window).scroll(function() {    
	    var scroll = $(window).scrollTop();
	    if (scroll >= 20) {
	        $(".menu1") .addClass("darkHeader");
	        $(".menu1").css('top', '0');
	    }
	    else  {
	        $(".menu1") .removeClass("darkHeader");
	        $(".menu1").css('top', '25');
	    }
	});

	$('#show_hide_button').click( function() {
        $('#some_box').toggleClass('expanded');
        $("#myCarousel").toggleClass('lightbg');
    });

    $("#show_button").click(function() {
    	$("#show_button a").toggleClass('close_button');
    });

});
})(jQuery);
</script>
<?php  wp_footer(); ?>
<?php echo get_option('killer_custom_option_google_analytics',true); ?>
</html>