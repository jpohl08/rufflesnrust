<?php

/**
 * Sampression Lite Theme Options
 *
 * @package Sampression-Lite
 * @since Sampression Lite 1.0
 */

/*=======================================================================
 * Function to build theme options
 *=======================================================================*/
add_action('admin_menu', 'sampression_theme_options');

function sampression_theme_options() {
	add_theme_page('Sempression Theme Option', 'Theme Options', 'read', 'sampression-options', 'build_sampression_options');
}

/*=======================================================================
 * Getting js and css files for theme options
 *=======================================================================*/
function sampression_admin_enqueue_scripts( $hook_suffix ) {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_style( 'sampression-theme-options', get_template_directory_uri() . '/includes/theme-options/theme-options.css', false, '1.0' );
	wp_enqueue_style('thickbox', get_template_directory_uri() . 'wp-includes/js/thickbox/thickbox.css', false, false, 'screen');
	wp_enqueue_script( 'sampression-theme-options', get_template_directory_uri() . '/includes/theme-options/theme-options.js', array( 'jquery' ), '1.0' );
}

add_action( 'admin_print_styles-appearance_page_sampression-options', 'sampression_admin_enqueue_scripts' );

/*=======================================================================
 * Building tabs for Theme Options
 *=======================================================================*/
function build_sampression_options() {
	$tabs = array( 'icons' => 'Logo &amp; Icons', 'social-media' => 'Social Media', 'advance' => 'Advance' );
	echo '<div id="icon-themes" class="icon32"><br></div>';
	echo '<h2 class="nav-tab-wrapper">';
	$current = 'icons';
	if(isset($_GET['tab'])) {
		$current = $_GET['tab'];
	}
	foreach( $tabs as $tab => $name ) {
		$class = ( $tab == $current ) ? ' nav-tab-active' : '';
		echo "<a class='nav-tab$class' href='?page=sampression-options&tab=$tab'>$name</a>";
	}
	echo '</h2>';
	if ( isset($_POST['sampression_theme_action']) && $_POST['sampression_theme_action'] == 'submit' ) {
		$options = array ( 'sam_logo', 'sam_use_logo', 'sam_favicons', 'sam_apple_icons_57', 'sam_apple_icons_72', 'sam_apple_icons_114', 'sam_header', 'sam_footer', 'get_facebook', 'get_twitter' );
		foreach ( $options as $opt ) {
			if(isset($_POST[$opt])) {
				delete_option ( 'opt_'.$opt, $_POST[$opt] );
				add_option ( 'opt_'.$opt, $_POST[$opt] );
			}
		}
	} else if ( isset($_POST['sampression_theme_action']) && $_POST['sampression_theme_action'] == 'restore' ) {
		$options = array ( 'sam_logo', 'sam_use_logo', 'sam_favicons', 'sam_apple_icons_57', 'sam_apple_icons_72', 'sam_apple_icons_114' );
		foreach ( $options as $opt ) {
			if(isset($_POST[$opt])) {
				delete_option ( 'opt_'.$opt, $_POST[$opt] );
			}
		}
	}
	sampression_options_tabs($current);
}

/*=======================================================================
 * Buiding different tab cotent for Theme Options
 *=======================================================================*/
function sampression_options_tabs($tab) {
	?>
    <form method="post" name="frm_theme_option" class="options-tab" action="<?php admin_url( 'themes.php?page=sampression-options' ); ?>">
    	<?php
		if($tab == 'icons') {
			$use_logo = get_option('opt_sam_use_logo');
			$use_check = '';
			if($use_logo == 'yes') {
				$use_check = ' checked="checked" ';
			}
		?>
        <fieldset class="fieldset-1">
        	<legend><?php echo _e('Site Logo','sampression'); ?></legend>
            <div class="group">
                <label><?php echo _e('Browse or enter logo URL','sampression'); ?></label>
                <input type="text" name="sam_logo" class="upload_image text-box" value="<?php echo get_option('opt_sam_logo'); ?>" />
                <input class= "upload_image_button button" type="button" value="Browse" />
                <div class="image-block image-holder">
                	<?php if(get_option('opt_sam_logo')) { ?>
                    <img src="<?php echo get_option('opt_sam_logo'); ?>" alt="Logo" />
                    <?php } else { ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/sampression-logo.png" alt="Logo" />
                    <?php } ?>
                </div>
                <p>
                	<input type="checkbox" id="logo_front_end" value="yes" <?php echo $use_check; ?> onclick="check_frontend_logo()"/>
                    <input type="hidden" name="sam_use_logo" id="sam_use_logo" value="<?php if(get_option('opt_sam_use_logo')) { echo get_option('opt_sam_use_logo'); } else { echo _e('no','sampression'); } ?>" />
                    <label for="logo_front_end" class="inline"><?php echo _e('I dont want to use Logo.','sampression'); ?></label>
                </p>
            </div>
        </fieldset>
        
        
        <fieldset class="fieldset-1">
        	<legend><?php echo _e('Favicon and apple touch icons','sampression'); ?></legend>
            <div class="group">
                <label><?php echo _e('Favicon','sampression'); ?></label>
                <input type="text" class="upload_image text-box" name="sam_favicons" value="<?php echo get_option('opt_sam_favicons'); ?>" />
                <input class= "upload_image_button button" type="button" value="Browse" />
                <div class="image-block image-holder">
                	<?php if(get_option('opt_sam_favicons')) { ?>
                    <img src="<?php echo get_option('opt_sam_favicons'); ?>" alt="<?php echo _e('Favicon','sampression'); ?>" width="16" />
                    <?php } else { ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" alt="<?php echo _e('Favicon','sampression'); ?>" width="16" />
                    <?php } ?>
                    <p class="note"><?php _e('file name should be "favicon.ico" and dimension should be 16x16', 'sampression'); ?></p>
                </div>
            </div>
            <div class="group">
                <label><?php echo _e('Apple Touch Icon (57x57)','sampression'); ?></label>
                <input type="text" class="upload_image text-box" name="sam_apple_icons_57" value="<?php echo get_option('opt_sam_apple_icons_57'); ?>" />
                <input class= "upload_image_button button" type="button" value="Browse" />
                <div class="image-block image-holder">
                	<?php if(get_option('opt_sam_apple_icons_57')) { ?>
                    <img src="<?php echo get_option('opt_sam_apple_icons_57'); ?>" alt="Apple Icon 57 x 57" width="57" />
                    <?php } else { ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon.png" alt="Apple Icon 57 x 57" width="57" />
                    <?php } ?>
                    <p class="note"><?php _e('file name should be "apple-touch-icon.png"', 'sampression'); ?></p>
                </div>
            </div>
            <div class="group">
                <label><?php echo _e('Apple Touch Icon for first and second generation iPad (72x72)','sampression'); ?></label>
                <input type="text" class="upload_image text-box" name="sam_apple_icons_72" value="<?php echo get_option('opt_sam_apple_icons_72'); ?>" />
                <input class= "upload_image_button button" type="button" value="Browse" />
                <div class="image-block image-holder">
                	<?php if(get_option('opt_sam_apple_icons_72')) { ?>
                    <img src="<?php echo get_option('opt_sam_apple_icons_72'); ?>" alt="Apple Icon 72 x 72" width="72" />
                    <?php } else { ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-72x72.png" alt="Apple Icon 72 x 72" width="72" />
                    <?php } ?>
                    <p class="note"><?php _e('file name should be "apple-touch-icon-72x72.png"', 'sampression'); ?></p>
                </div>
            </div>
            <div class="group">
                <label><?php echo _e('Apple Touch Icon for for high-resolution iPad and iPhone Retina displays (114x114)','sampression'); ?></label>
                <input type="text" class="upload_image text-box" name="sam_apple_icons_114" value="<?php echo get_option('opt_sam_apple_icons_114'); ?>" />
                <input class= "upload_image_button button" type="button" value="Browse" />
                <div class="image-block image-holder">
                	<?php if(get_option('opt_sam_apple_icons_114')) { ?>
                    <img src="<?php echo get_option('opt_sam_apple_icons_114'); ?>" alt="Apple Icon 114 x 114" width="114" />
                    <?php } else { ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon-114x114.png" alt="Apple Icon 114 x 114" width="114" />
                    <?php } ?>
                    <p class="note"><?php _e('file name should be "apple-touch-icon-114x114.png"', 'sampression'); ?></p>
                </div>
            </div>
        </fieldset>
        <input type="hidden" name="sampression_theme_action" id="sampression_theme_action" value="" />
        <input class="button-primary" type="button" onclick="load_theme_action('submit')" value="Save" /> <input class="button-primary" type="button" onclick="load_theme_action('restore')" value="Re-store Default" />
        <?php }
		 else if($tab == 'social-media') {
		?>
        
        <ul class="admin-style-1">
        	<li class="group">
            <label for="get_facebook"><?php _e('Facebook','sampression'); ?></label>
            <input type="text" name="get_facebook" id="get_facebook" value="<?php echo get_option('opt_get_facebook'); ?>" />
            <p class="note"><em><?php _e('Insert your Facebook ID only, For eg. <strong>jimbatamang</strong> from http://facebook.com/jimbatamang', 'sampression'); ?></em></p>
        	</li>
            
            <li class="group">
            <label for="get_twitter"><?php _e('Twitter','sampression'); ?></label>
            <input type="text" name="get_twitter" id="get_twitter" value="<?php echo get_option('opt_get_twitter'); ?>" />
            <p class="note"><em><?php _e('Insert your Twitter ID only, For eg. <strong>jimbatamang</strong> from http://twitter.com/jimbatamang', 'sampression'); ?></em></p>
        	</li>
            <li class="group">
            <input type="hidden" name="sampression_theme_action" id="sampression_theme_action" value="" />
        <input class="button-primary" type="button" onclick="load_theme_action('submit')" value="Save" />
            </li>
        </ul>
        
        <?php } else if($tab == 'advance') { ?>
        <fieldset class="fieldset-1">
        	<legend><?php _e('Codes for Header','sampression'); ?></legend>
            <textarea name="sam_header" class="text-area" rows="10" cols="100"><?php echo get_option('opt_sam_header'); ?></textarea>
            <p class="note"><?php _e('Write/Paste the codes which you want to insert in Header','sampression'); ?></p>
        </fieldset>
        <fieldset class="fieldset-1">
        	<legend><?php _e('Codes for Footer','sampression'); ?></legend>
            <textarea name="sam_footer" class="text-area" rows="10" cols="100"><?php echo get_option('opt_sam_footer'); ?></textarea>
            <p class="note"><?php _e('Write/Paste the codes which you want to insert in Footer. For eg Google Analytics Codes','sampression'); ?></p>
        </fieldset>
        <input type="hidden" name="sampression_theme_action" value="submit" />
        <input class="button-primary" type="submit" value="Save" />
        <?php } ?>
    </form>
    <?php
}
?>