<?php
/*
Plugin Name: Login Page Logo
Plugin URI:  http://awaisaltaf.weebly.com/login-page-logo-plugin.html
Description: Customize the admin logo on login page.
Author: Awais Altaf
Author URI: http://awaisaltaf.weebly.com/
Version: 1.0
Text Domain: lpl_login_page_logo
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
/*
Login Page Logo is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Login Page Logo is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Login Page Logo. If not, see http://www.gnu.org/licenses/gpl-2.0.html.
*/

/* Register Settings with Section */
add_action( 'admin_init', 'lpl_LoginPageLogo_init_settings' );
function lpl_LoginPageLogo_init_settings(){
	/* Register General Settings */
	register_setting( 'lpl_login_page_logo', 'lpl_LoginPageLogo_option_name' );

	// register a new section in the "wporg" page
	 add_settings_section(
		 'lpl_LoginPageLogo_section_developers',
		 __( 'Login Page Logo Settings', 'lpl_login_page_logo' ),  /* WordPress Function To Translate String  */
		 'lpl_LoginPageLogo_section_developers_function',
		 'lpl_login_page_logo'
	 );

	/* Logo Image Upload Field */
	 add_settings_field(
		 'lpl_LoginPageLogo_image_field', 
		 __( 'Upload Image', 'lpl_login_page_logo' ),  
		 'lpl_LoginPageLogo_image_field_callback_function',
		 'lpl_login_page_logo',
		 'lpl_LoginPageLogo_section_developers',
		 [
		 'label_for' => 'lpl_LoginPageLogo_image_field',
		 'class' => 'lpl_LoginPageLogo_row_image',
		 ]
	 );

	 

	 /* Logo Width Field */
	 add_settings_field(
		 'lpl_LoginPageLogo_width_field', 
		 __( 'Logo Width', 'lpl_login_page_logo' ),  
		 'lpl_LoginPageLogo_width_field_callback_function',
		 'lpl_login_page_logo',
		 'lpl_LoginPageLogo_section_developers',
		 [
		 'label_for' => 'lpl_LoginPageLogo_width_field',
		 'class' => 'lpl_LoginPageLogo_row_width_field',
		 ]
	 );

	 /* Logo Height Field */
	 add_settings_field(
		 'lpl_LoginPageLogo_height_field', 
		 __( 'Logo Height', 'lpl_login_page_logo' ),  
		 'lpl_LoginPageLogo_height_field_callback_function',
		 'lpl_login_page_logo',
		 'lpl_LoginPageLogo_section_developers',
		 [
		 'label_for' => 'lpl_LoginPageLogo_height_field',
		 'class' => 'lpl_LoginPageLogo_row_height_field',
		 ]
	 );

	
}

/* Settings Section Callback function */
function lpl_LoginPageLogo_section_developers_function( $args ){
?>	<!-- Setting Section -->
	<!-- Use Details -->
	
<?php
}

function lpl_LoginPageLogo_image_field_callback_function( $args ) {
	$lpl_options = get_option( 'lpl_LoginPageLogo_option_name' );
?><p>
		<input id="lpl_LoginPageLogo_image_button" type="button" value="Media Library" class="button-secondary" />
		<input id="lpl_LoginPageLogo_logo_image" class="regular-text code" type="text" 
		name="lpl_LoginPageLogo_option_name[<?php echo esc_attr($args['label_for']); ?>]" 
		value="<?php echo !empty($lpl_options[esc_attr($args['label_for'])]) ?( esc_attr($lpl_options[$args['label_for']]) ):('') ;?>">
	</p>
	<p class="description">Enter an image URL or use an image from media library.</p>
	<br>
	<div class="csl-preview-blocks" <?php  if(!empty($lpl_options['lpl_LoginPageLogo_image_field'])){  }else{ echo 'style=display:none;'; } ?>>
		<p id="csl-margi-btm"><strong><?php if(!empty($lpl_options['lpl_LoginPageLogo_image_field'])){ _e('Preview','lpl_login_page_logo'); } ?></strong></p>
		<img id="lpl_LoginPageLogo_admin_hover_preview" src="<?php echo esc_attr($lpl_options['lpl_LoginPageLogo_image_field']); ?>" alt="Logo" />
	</div>

	<div class="csl-error-logo-url">
		<p><?php _e('No Preview Available','lpl_login_page_logo'); ?></p>
	</div>
<?php		
		
	
}

/* Settings Width Logo Callback function  */
function lpl_LoginPageLogo_width_field_callback_function( $args ){
	$lpl_options = get_option( 'lpl_LoginPageLogo_option_name' );
?>
	<input id="lpl_LoginPageLogo_logo_width" class="regular-text code" type="number" 
	name="lpl_LoginPageLogo_option_name[<?php echo esc_attr($args['label_for']); ?>]" 
	value="<?php echo !empty($lpl_options[esc_attr($args['label_for'])]) ?( esc_attr($lpl_options[$args['label_for']]) ):('') ;?>">
	<p class="description">
		<?php _e('Put width in px. If you want default logo width with just leave it empty.','lpl_login_page_logo'); ?>
	</p>
<?php
}

/* Settings Height Logo Callback function  */
function lpl_LoginPageLogo_height_field_callback_function( $args ){
	$lpl_options = get_option( 'lpl_LoginPageLogo_option_name' );
	if(isset($lpl_options['lpl_LoginPageLogo_image_field'])){
		$lpl_width_height = getimagesize($lpl_options['lpl_LoginPageLogo_image_field']);
	}else{
		$lpl_width_height = '';
	}
?>
	<input id="lpl_LoginPageLogo_logo_height" class="regular-text code" type="number" 
	name="lpl_LoginPageLogo_option_name[<?php echo esc_attr($args['label_for']); ?>]" 
	value="<?php echo !empty($lpl_options[esc_attr($args['label_for'])]) ?( esc_attr($lpl_options[$args['label_for']]) ):('') ;?>">
	<p class="description">
		<?php _e('Put height in px. If you want default logo height with just leave it empty.','lpl_login_page_logo'); ?>
	</p>
<?php
}

/* Adding Admin Page */
add_action('admin_menu', 'lpl_LoginPageLogo_add_menu_page');
function lpl_LoginPageLogo_add_menu_page()
{
    add_submenu_page(
        'themes.php', /* Adding this submenu to Settings Main Menu */
        __('Custom Login Logo','lpl_login_page_logo'),
        __('Custom Login Page Logo','lpl_login_page_logo'),
        'manage_options',
        'lpl_login_page_logo',
        'lpl_LoginPageLogo_submenu_callback_function'
    );
}

/* Admin Page Callback Function */
function lpl_LoginPageLogo_submenu_callback_function(){
	/* Check user capability */
	if ( ! current_user_can( 'manage_options' ) ) {
 		return;
 	}
 	/* wordpress will add the "settings-updated" $_GET parameter to the url */
	if ( isset( $_GET['settings-updated'] ) ) {
	// add settings saved message with the class of "updated"
		add_settings_error( 'lpl_LoginPageLogo_messages', 'lpl_LoginPageLogo_message', __( 'Logo Settings Saved Successfully', 'lpl_login_page_logo' ), 'updated' );
?>
	<div id="message" class="updated">
	<p><strong><?php _e('Settings Saved Successfully.') ?></strong></p>
	</div>
<?php	
	}

	 
	?>
  <div class="wrap">
    <form action="options.php" method="post" class="lpl_LoginPageLogo_form" >
   	<!-- Display Settings Here -->
   	<?php

   	 // output security fields for the registered setting "lpl_login_page_logo"
	 settings_fields( 'lpl_login_page_logo' );
	 
	 // output setting sections and their fields
	 do_settings_sections( 'lpl_login_page_logo' );
	 
	 // output save settings button
	 submit_button( 'Save Settings' );

   	?>

   </form>
  </div><!-- wrap -->
  <?php
}

/*  */
function lpl_LoginPageLogo_enqueue_logo() { 
	$get_lpl_options  = get_option('lpl_LoginPageLogo_option_name');
	if(isset($get_lpl_options['lpl_LoginPageLogo_image_field']) && !empty($get_lpl_options['lpl_LoginPageLogo_image_field'])){
		$lpl_width_height = getimagesize($get_lpl_options['lpl_LoginPageLogo_image_field']);
		/* Setting  width */
		if(!empty($get_lpl_options['lpl_LoginPageLogo_width_field'])){
			$width = $get_lpl_options['lpl_LoginPageLogo_width_field'];
		}else{
			$width = $lpl_width_height[0];
		}
		/* Setting  height */
		if(!empty($get_lpl_options['lpl_LoginPageLogo_height_field'])){
			$height = $get_lpl_options['lpl_LoginPageLogo_height_field'];
		}else{
			$height = $lpl_width_height[1];
		}
		
		
?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo $get_lpl_options['lpl_LoginPageLogo_image_field']; ?>);
			height: <?php echo $height.'px'; ?>;
			width: <?php echo $width.'px'; ?>;
			background-size: contain;
			background-repeat: no-repeat;
        	padding-bottom: 30px;
        }
        @media(max-width: 768px){
        	#login h1 a, .login h1 a {
        		background-size: cover !important;
        	}
        }
    </style>
<?php } 
	}
add_action( 'login_enqueue_scripts', 'lpl_LoginPageLogo_enqueue_logo' );


/* Enqueuing Admin Scripts and Styles */
function lpl_LoginPageLogo_admin_modal_js()
{
	// Enqueue the JS & CSS:
	wp_enqueue_media(); // Fixing media library button
	wp_enqueue_style( 'thickbox' );
	wp_enqueue_script('lpl_LoginPageLogo_admin_js', plugins_url( 'assets/js/login-page-logo-admin.js', __FILE__ ), array('jquery', 'media-upload', 'thickbox'),'1.0', true);
}
add_action( 'admin_enqueue_scripts', 'lpl_LoginPageLogo_admin_modal_js'); 




  