<?php
/*
Plugin Name: Meme Generator
Plugin URI: http://paratheme.com
Description: Meme Generator.
Version: 1.0
Author: paratheme
Author URI: http://paratheme.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

define('meme_generator_plugin_url', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
define('meme_generator_plugin_dir', plugin_dir_path( __FILE__ ) );
define('meme_generator_wp_url', 'https://wordpress.org/plugins/meme-generator' );
define('meme_generator_wp_reviews_url', 'http://wordpress.org/support/view/plugin-reviews/meme-generator' );
define('meme_generator_pro_url','http://paratheme.com' );
define('meme_generator_demo_url', 'http://paratheme.com/demo/meme-generator/' );
define('meme_generator_conatct_url', 'http://paratheme.com/contact' );
define('meme_generator_qa_url', 'http://paratheme.com/qa/' );
define('meme_generator_plugin_name', 'Meme Generator' );
define('meme_generator_share_url', 'http://paratheme.com' );
define('meme_generator_tutorial_video_url', '//www.youtube.com/embed/w_2qdMQqNQQ?rel=0' );

require_once( plugin_dir_path( __FILE__ ) . 'includes/meta.php');
require_once( plugin_dir_path( __FILE__ ) . 'includes/functions.php');




function meme_generator_init_scripts()
	{
		
		$meme_generator_sticker_size = get_option( 'meme_generator_sticker_size' );
		if(empty($meme_generator_sticker_size))
			{
				$meme_generator_sticker_size = intval(2*1000*1000);
			}
		else
			{
				$meme_generator_sticker_size = intval($meme_generator_sticker_size*1000*1000);
			}

		wp_enqueue_script('jquery');		
    	wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-widget' );
		wp_enqueue_script( 'jquery-ui-mouse' );
    	wp_enqueue_script( 'jquery-ui-draggable' );
		wp_enqueue_script( 'jquery-ui-resizable' );

		wp_enqueue_style('jquery-ui.css', meme_generator_plugin_url.'css/jquery-ui.css');

		wp_enqueue_script( 'html2canvas.js', plugins_url( '/js/html2canvas.js', __FILE__ ), array('jquery'), '1.0', false);
		
		wp_enqueue_script( 'jscolor.js', plugins_url( '/js/jscolor.js', __FILE__ ), array('jquery'), '1.0', false);
		
		wp_enqueue_script('meme_generator_js', plugins_url( '/js/scripts.js' , __FILE__ ) , array( 'jquery' ));

				
		wp_localize_script( 'meme_generator_js', 'meme_generator_ajax', array( 'meme_generator_ajaxurl' => admin_url( 'admin-ajax.php')));
		wp_enqueue_style('meme_generator_style', meme_generator_plugin_url.'css/style.css');





		//ParaAdmin
		wp_enqueue_style('ParaAdmin', meme_generator_plugin_url.'ParaAdmin/css/ParaAdmin.css');
		//wp_enqueue_style('ParaDashboard', meme_generator_plugin_url.'ParaAdmin/css/ParaDashboard.css');		
		//wp_enqueue_style('ParaIcons', meme_generator_plugin_url.'ParaAdmin/css/ParaIcons.css');		
		wp_enqueue_script('ParaAdmin', plugins_url( 'ParaAdmin/js/ParaAdmin.js' , __FILE__ ) , array( 'jquery' ));


		
	}
add_action("init","meme_generator_init_scripts");


register_activation_hook(__FILE__, 'meme_generator_activation');


function meme_generator_activation()
	{
		$meme_generator_version= "1.0";
		update_option('meme_generator_version', $meme_generator_version); //update plugin version.
		
		$meme_generator_customer_type= "free"; //customer_type "free"
		update_option('meme_generator_customer_type', $meme_generator_customer_type); //update plugin version.		
	}



add_action('admin_menu', 'meme_generator_menu_init');


	
function meme_generator_settings(){
	include('meme-generator-settings.php');
}

function meme_generator_menu_init()
	{
		//add_menu_page(__('Meme Settings','meme_generator'), __('Meme','meme_generator'), 'manage_options', 'meme_generator_settings', 'meme_generator_settings');
	}
	
	
	
	
	
	
//////////////

