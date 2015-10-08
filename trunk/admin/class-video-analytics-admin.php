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
 * enqueue the admin-specific styles heet and JavaScript.
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
                 * @todo Get rid of this if we are not using custom admin 
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
                 * @todo Get rid of this if we are not using JS
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
            //Add General Settings Section
            add_settings_section('video-general-options', 'General Settings', '', 'video-analytics-options-page');
       
            $settings = array(
                array(
                    "option_group" => 'video-options',
                    "option_name" => 'content-switch',
                    "add_field" => true,
                    "title" => 'Filter Post Content',
                    "callback" => array( $this, 'content_switch' ),
                    'page' => 'video-analytics-options-page',
                    'section' => 'video-general-options'
                    ),
                array(
                    "option_group" => 'video-options',
                    "option_name" => 'excerpt-switch',
                    "add_field" => true,
                    "title" => 'Filter Excerpt Content',
                    "callback" => array( $this, 'excerpt_switch' ),
                    'page' => 'video-analytics-options-page',
                    'section' => 'video-general-options'
                    ),
                array(
                    "option_group" => 'video-options',
                    "option_name" => 'widgetText-switch',
                    "add_field" => true,
                    "title" => 'Filter Widget Content',
                    "callback" => array( $this, 'widgetText_switch' ),
                    'page' => 'video-analytics-options-page',
                    'section' => 'video-general-options'
                    ),
            );
            //Add Vimeo Settings Section
            add_settings_section('vimeo-options', 'Vimeo Settings', '', 'video-analytics-options-page');
            
            $vimeoSettings = array(
                array(
                    "option_group" => 'video-options',
                    "option_name" => 'vimeo-switch',
                    "add_field" => true,
                    "title" => 'Track Vimeo Videos',
                    "callback" => array( $this, 'vimeo_switch' ),
                    'page' => 'video-analytics-options-page',
                    'section' => 'vimeo-options'
                    ),
                array(
                    "option_group" => 'video-options',
                    "option_name" => 'vimeo-modFrame',
                    "add_field" => true,
                    "title" => 'Modify Vimeo Iframes',
                    "callback" => array( $this, 'vimeo_modFrame' ),
                    'page' => 'video-analytics-options-page',
                    'section' => 'vimeo-options'
                    ),
                array(
                    "option_group" => 'video-options',
                    "option_name" => 'vimeo-dataProgress',
                    "add_field" => true,
                    "title" => 'Track the Progress of Vimeo Videos',
                    "callback" => array( $this, 'vimeo_dataProgress' ),
                    'page' => 'video-analytics-options-page',
                    'section' => 'vimeo-options'
                    ),
                 array(
                    "option_group" => 'video-options',
                    "option_name" => 'vimeo-dataSeek',
                    "add_field" => true,
                    "title" => 'Track Skipping in Vimeo Videos',
                    "callback" => array( $this, 'vimeo_dataSeek' ),
                    'page' => 'video-analytics-options-page',
                    'section' => 'vimeo-options'
                    ),
                array(
                    "option_group" => 'video-options',
                    "option_name" => 'vimeo-dataBounce',
                    "add_field" => true,
                    "title" => 'Trigger Interactive Events',
                    "callback" => array( $this, 'vimeo_dataBounce' ),
                    'page' => 'video-analytics-options-page',
                    'section' => 'vimeo-options'
                    ),
                array(
                    "option_group" => 'video-options',
                    "option_name" => 'vimeo-videoTitle',
                    "add_field" => true,
                    "title" => 'Use Iframe Title for Analytics Event',
                    "callback" => array( $this, 'vimeo_videoTitle' ),
                    'page' => 'video-analytics-options-page',
                    'section' => 'vimeo-options'
                    ),
            );
            $settings = array_merge($settings, $vimeoSettings);
            //Loop through the settings and fields
            foreach ($settings as $setting) {
                register_setting( $setting['option_group'], $setting['option_name'] );
                //Add the field
                if ($setting['add_field']) {
                    add_settings_field( $setting['option_name'], $setting['title'], $setting['callback'], $setting['page'], $setting['section'] );
                }
            }
            
        }
        
        /**
         * The vimeo switch field
         * 
         * @since 1.0.0
         */
        public function vimeo_switch(){
            $setting = esc_attr( get_option( 'vimeo-switch' ) );
            echo "<input " . checked($setting, 1, false) .  " type='checkbox' name='vimeo-switch' value='1' />";
        }
        
        /**
         * The vimeo mod frame field
         * 
         * @since 1.0.0
         */
        public function vimeo_modFrame(){
            $setting = esc_attr( get_option( 'vimeo-modFrame' ) );
            echo "<input " . checked($setting, 1, false) .  " type='checkbox' name='vimeo-modFrame' value='1' />";
        }
        
        /**
         * The vimeo data progress field
         * 
         * @since 1.0.0
         */
        public function vimeo_dataProgress(){
            $setting = esc_attr( get_option( 'vimeo-dataProgress' ) );
            echo "<input " . checked($setting, 1, false) .  " type='checkbox' name='vimeo-dataProgress' value='1' />";
        }
        
        /**
         * The vimeo data seek field
         * 
         * @since 1.0.0
         */
        public function vimeo_dataSeek(){
            $setting = esc_attr( get_option( 'vimeo-dataSeek' ) );
            echo "<input " . checked($setting, 1, false) .  " type='checkbox' name='vimeo-dataSeek' value='1' />";
        }
        
        /**
         * The vimeo data bounce field
         * 
         * @since 1.0.0
         */
        public function vimeo_dataBounce(){
            $setting = esc_attr( get_option( 'vimeo-dataBounce' ) );
            echo "<input " . checked($setting, 1, false) .  " type='checkbox' name='vimeo-dataBounce' value='1' />";
        }
        
        /**
         * The vimeo title field
         * 
         * @since 1.0.0
         */
        public function vimeo_videoTitle(){
            $setting = esc_attr( get_option( 'vimeo-videoTitle' ) );
            echo "<input " . checked($setting, 1, false) .  " type='checkbox' name='vimeo-videoTitle' value='1' />";
        }
        
        /**
         * The content switch field
         * 
         * @since 1.0.0
         */
    
        public function content_switch() {
            $setting = esc_attr( get_option( 'content-switch' ) );
            echo "<input " . checked($setting, 1, false) .  " type='checkbox' name='content-switch' value='1' />";
        }
        
        /**
         * The excerpt switch field
         * 
         * @since 1.0.0
         */
        public function excerpt_switch() {
            $setting = esc_attr( get_option( 'excerpt-switch' ) );
            echo "<input " . checked($setting, 1, false) .  " type='checkbox' name='excerpt-switch' value='1' />";
        }
        
        /**
         * The widgetText switch field
         * 
         * @since 1.0.0
         */
        public function widgetText_switch() {
            $setting = esc_attr( get_option( 'widgetText-switch' ) );
            echo "<input " . checked($setting, 1, false) .  " type='checkbox' name='widgetText-switch' value='1' />";
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
