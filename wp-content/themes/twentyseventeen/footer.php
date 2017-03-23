<div class="enqbutton">
	<img src="images/enquarybutton.png">
</div>
<?php echo do_shortcode( '[contact-form-7 id="68" title="Book Us Now"]' ); ?>

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