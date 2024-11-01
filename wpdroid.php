<?php
/*
Plugin Name: WPdroid
Plugin URI: http://wordpress.org/extend/plugins/wpdroid/
Description: WPdroid is official plugin developed by http://www.appyet.com service that allows you to create, in just a few clicks, stunning, feature-rich and presentable Android offline readers for your blog. You can share with the world by deploying on Android Market or hosting it by yourself.
Author: http://www.appyet.com
Author URI: http://www.appyet.com
Version: 1.0.1
License: GPLv2 or later
*/
ini_set('display_errors', true);
//avoid direct calls to this file where wp core files not present
if(!defined('ABSPATH'))
	die('Please do not load this file directly.');

class wpdroid_app_plugin {

	
	
	/* ********************************** *
	 	  		   construct
	 * ********************************** */
	function __construct() {
		add_action('admin_menu', array(&$this, 'on_admin_menu')); 
		add_action("plugin_action_links_wpdroid/wpdroid.php", array(&$this, 'add_plugin_action_links'));
	}
	
	
	
	/* ********************************** *
 	  	  add links in plugin mananger
	 * ********************************** */
	function add_plugin_action_links($links){
		array_unshift($links, '<a href="admin.php?page=wpdroid">Settings</a>');
		return $links;
	}
	
	/* ********************************** *
		 		  Build menu
	 * ********************************** */
	function on_admin_menu() {
		$menus[] = $connect = add_menu_page('Apps', "WPdroid", 'manage_options', 'wpdroid', array(&$this, 'on_show_connect'), WP_PLUGIN_URL . '/wpdroid/images/android.png');
	}
	
	function on_show_connect() {
			?>
			<?php wp_enqueue_script("jquery"); ?>
			<script type="text/javascript">
				function WPdroid_CreateApp()
				{
					jQuery.get('http://www.appyet.com/handler/Api.ashx?api_key=02e39794-1af0-4bf1-9320-c9e8086ff7db&action=create_app&user_email=<?php echo rawurlencode(get_bloginfo('admin_email')); ?>&app_name=<?php echo rawurlencode(get_bloginfo('name')); ?>&app_feed=<?php echo rawurlencode(get_bloginfo('rss2_url')); ?>');
					alert('Your request has been sent, please check your email at ' + '<?php bloginfo('admin_email'); ?>' + ' to confirm your request.');
				}
			</script>
			<div class="wrap">
			<?php screen_icon('options-general'); ?>
			<h2>WPdroid</h2>
				<div id="poststuff">
					<div id="post-body">
						<p>
							App.Yet is a web based Android application builder that lets you quickly and easily create Android app for your wordpress blog.
						</p>
						
						<p>
							There are two methods to create Android App for your blog. 
							<ul>
							<li><b>Create it directly from this plugin:</b> pros: Quick and easy, only one button click. cons: Can't pick package name for your application</li>
							<li><b>Visit http://www.appyet.com to create it manually:</b> pros: Also quick and easy. cons: Full control over your application creation process</li>
							</ul>
						</p>
						
						<p>
							Following steps guide you through both methods.
						</p>
						<p><b>Create it directly from this plugin by click following Create App link</p>
						<p><a href="javascript:WPdroid_CreateApp();">Create App</a></b></p>
						
						<p><b>Visit http://www.appyet.com to create it manually</b></p>
						<p>
							1. You first go to the site <a href="http://www.appyet.com" target="_blank">www.appyet.com</a> you will want to sign up your free account.
						</p>
							<img width="" alt="Sign Up" src="<?php echo WP_PLUGIN_URL . '/wpdroid/images/ss_signup.png' ?>" title="Sign Up">
						<p>
							2. Then click on 'Create App' at the top right of the screen. Once you are done there, click 'Create App'.
						
							<ul>
							  <li><b>Application Name:</b> 	<?php bloginfo('name'); ?></li>
							  <li><b>Package Name:</b>	Package name is created automatically for you base on Application Name</li>
							  <li><b>RSS/Atom Feed(s):</b> 	<?php bloginfo('rss2_url'); ?></li>
							</ul>
						</p>	
							
						
						<img width="" alt="Create" src="<?php echo WP_PLUGIN_URL . '/wpdroid/images/ss_create.png' ?>" title="Create">
						<p>
							3. You will receive your application by email or you can download from the website.
						</p>
						<p>
							4. Sample application screenshot:
						</p>
						<img  src="<?php echo WP_PLUGIN_URL . '/wpdroid/images/snap0_m.png' ?>">
						<img  src="<?php echo WP_PLUGIN_URL . '/wpdroid/images/snap3_m.png' ?>">
						<img  src="<?php echo WP_PLUGIN_URL . '/wpdroid/images/snap5_m.png' ?>">
						<img  src="<?php echo WP_PLUGIN_URL . '/wpdroid/images/snap9_m.png' ?>">
						<img  src="<?php echo WP_PLUGIN_URL . '/wpdroid/images/snap6_m.png' ?>">
						<img  src="<?php echo WP_PLUGIN_URL . '/wpdroid/images/snap7_m.png' ?>">
					</div>
					<br class="clear"/>				
				</div>
			</div>
			<?php
	}
	
	
}

	new wpdroid_app_plugin();
?>