<?php
/*
Plugin Name: WP Branding
Plugin URI: http://www.mobisoft.gr/wordpress/plugins/wp-total-branding/index.php
Description: Just a branding Wordpress plugin.
Version: 1.0
Author: Giannopoulos Kostas
Author URI: http://www.mobisoft.gr/
License: GPL2
*/

/*
This file is part of wp-braning plugin.
wp-branding plugin is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
wp-branding plugin is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.
You should have received a copy of the GNU General Public License along with underConstruction.  If not, see <http://www.gnu.org/licenses/>.
*/


require_once( ABSPATH . "wp-includes/pluggable.php" );

class wpbranding {

	var $installationFolder = "";
	var $mainOptionsPage = "wpbrandingMainOptions";

	function __construct()
	{
		$this->installedFolder = basename(dirname(__FILE__));
	}

	function wpbrandingMain()
	{
		$this->__construct();
	}

	function getMainOptionsPage()
	{
		return $this->mainOptionsPage;
	}


	function wpbrandingIncOpt()
	{
		require_once ('wpbranding-options.php');
	}

	function wpbranding_adminMenu()
	{
		$page = add_options_page('WP Branding', 'WP Branding', 'activate_plugins', $this->mainOptionsPage, array($this, 'wpbrandingIncOpt'));		
	}

}







$wpbrandingPlugin = new wpbranding();

register_uninstall_hook(__FILE__, 'wpbrandingPlugin_delete');

add_action('admin_menu', array($wpbrandingPlugin, 'wpbranding_adminMenu'));



function wpbrandingPlugin_delete() {

	delete_option('wpmbtb_developer');
	delete_option('wpmbtb_developer_website');
	delete_option('wpmbtb_logo');
	delete_option('wpmbtb_customversion');

}





function wpbrandingPluginLinks($links, $file)
	{
		global $wpbrandingPlugin;
		if ($file == basename(dirname(__FILE__)).'/'.basename(__FILE__) && function_exists("admin_url"))
			{
				$manage_link = '<a href="'.admin_url('options-general.php?page='.$wpbrandingPlugin->getMainOptionsPage()).'">'.__('Settings').'</a>';
				array_unshift($links, $manage_link);
			}
		return $links;
	}

add_filter('plugin_action_links', 'wpbrandingPluginLinks', 10, 2);




	define ( 'MOBISOFT_UPLOAD_PLUGIN_URL', plugin_dir_url(__FILE__)); 

	function mbbranding_upload_admin_scripts() 
		{
			wp_enqueue_script('jquery');
			wp_enqueue_script('media-upload');
			wp_enqueue_script('thickbox');
			wp_register_script('my-upload', MOBISOFT_UPLOAD_PLUGIN_URL.'mobisoft-upload.js', array('jquery','media-upload','thickbox'));
			wp_enqueue_script('my-upload');
		}

	function mbbranding_upload_admin_styles()
		{
			wp_enqueue_style('thickbox');
		}
	
	add_action('admin_print_scripts', 'mbbranding_upload_admin_scripts');
	add_action('admin_print_styles', 'mbbranding_upload_admin_styles');
	
	
	

/*----------------------------------------------------------------------------------------------
	1. Replace footer text
----------------------------------------------------------------------------------------------*/

function mb_replace_footer_admin ()   
	{  
    	$mbCustomFooterText =  '
    	<span id="footer-thankyou">Designed & Developed by <a href="' . get_option('wpmbtb_developer_website') . '">' . get_option('wpmbtb_developer') . '</a></span>';  
    	return $mbCustomFooterText;
    }  

add_filter('admin_footer_text', 'mb_replace_footer_admin');

/*----------------------------------------------------------------------------------------------
	2. Replace footer wordpress version tag
----------------------------------------------------------------------------------------------*/

function mb_replace_footer_version() 
	{
		$mbCustomFooterVersion =  _e('Version') . ' ' . get_option('wpmbtb_customversion');
		return $mbCustomFooterVersion;
	}

add_filter( 'update_footer', 'mb_replace_footer_version', '1188');

/*----------------------------------------------------------------------------------------------
	3. Remove 'Upgrade Now' message for non-admin users
----------------------------------------------------------------------------------------------*/

function no_update_nag() 
	{
    	remove_action( 'admin_notices', 'update_nag', 3 );
    }

if ( !current_user_can( 'edit_users' ) ) { add_action( 'admin_init', 'no_update_nag' ); }

/*----------------------------------------------------------------------------------------------
	4. Replace default login logo with a custom one
----------------------------------------------------------------------------------------------*/

function mb_replace_login_logo()
	{
		echo '<style  type="text/css"> h1 a {  background-image:url(' . get_option('wpmbtb_logo') . ')  !important; } </style>';
	}

add_action('login_head',  'mb_replace_login_logo');


/*
	5. Add custom widgets to WordPress dashboard
*/

function example_dashboard_widget_function() {
	// Display whatever it is you want to show
	echo "Hello World, I'm a great Dashboard Widget";
} 

// Create the function use in the action hook
function example_add_dashboard_widgets() {
	wp_add_dashboard_widget('example_dashboard_widget', 'Example Dashboard Widget', 'example_dashboard_widget_function');
}
// Hoook into the 'wp_dashboard_setup' action to register our other functions
add_action('wp_dashboard_setup', 'example_add_dashboard_widgets' );


?>