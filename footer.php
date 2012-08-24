<?php
/**
 * The template for displaying the footer.
 *
 * @package Sampression-Lite
 * @since Sampression Lite 1.0
 */
?>

 </div>
</div>
<!-- #content -->

<footer id="footer">
<div class="container">
<div class="columns fourteen">
<div class="alignleft copyright"><?php esc_attr_e( 'Copyright', 'sampression' ); ?> &copy; <?php _e(date('Y')); ?> "<?php bloginfo( 'name' ); ?>".</div><?php do_action( 'sampression_credits' ); ?>
</div>

<div class="columns two footer-right">
<div id="btn-top-wrapper">
<a href="javascript:pageScroll('.top');" class="btn-top"><?php _e('Goto Top', 'sampression'); ?></a>
</div>
</div>

</div>
</footer>

<!--
// Enables advanced css selectors in IE, must be used with a JavaScript library (jQuery Enabled in functions.php)
// HTML5 Supporter for ie  -->
<!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/lib/js/html5.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/lib/js/selectivizr.js"></script>
<![endif]-->

<!-- Prompt IE 6 users to install Chrome Frame --> 
<!--[if lt IE 7 ]>
	<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent("onload",function(){CFInstall.check({mode:"overlay"})})</script>
<![endif]-->
<?php
	/* Include codes in Footer from Theme Option (Advance) */
	 echo get_option( 'opt_sam_footer' ); ?>
     
<?php wp_footer(); ?>
</body>
</html>