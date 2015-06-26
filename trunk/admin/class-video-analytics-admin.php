<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/jpw123/
 * @since      1.0.0
 *
 * @package    Video_Analytics
 * @subpackage Video_Analytics/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Video_Analytics
 * @subpackage Video_Analytics/admin
 * @author     Jan Wojtasinski <jan@829llc.com>
 */
class Video_Analytics_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Video_Analytics_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Video_Analytics_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/video-analytics-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Video_Analytics_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Video_Analytics_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/video-analytics-admin.js', array( 'jquery' ), $this->version, false );

	}
	
        /**
         * Register the settings fields and add them to the options page
         * 
         * @since 1.0.0
         */
        public function video_analytics_settings_init(){
            
            //Add Vimeo Settings
            register_setting( 'vimeo-options', 'vimeo-switch' );
            add_settings_section('vimeo-options', 'Vimeo Settings', '', 'video-analytics-options-page');
            add_settings_field('vimeo-switch', 'Track Vimeo Videos', array($this, 'vimeo_switch' ), 'video-analytics-options-page', 'vimeo-options');
            
            
            
        }
        
        /**
         * 
         */
        public function vimeo_switch(){
            $setting = esc_attr( get_option( 'vimeo-switch' ) );
            echo "<input " . checked($setting, 1, false) .  " type='checkbox' name='vimeo-switch' value='1' />";
        }
	/**
	* Register the admin menu in the admin dashboard
	*
	* @since	1.0.0
	*/
	
        public function add_admin_menu() {
            //Add the admin options page
            add_options_page('Video Analytics Settings', 'Video Analytics', 'manage_options', 'video-analytics-options-page', array($this, 'display_admin_page'));
        }
	
        /**
         * Load the settings page for the plugin
         * 
         * @since 1.0.0
         */
        
        public function display_admin_page() {
            //Include the admin view page
            include_once('views/video-analytics-admin-display.php');
        }
        
}
