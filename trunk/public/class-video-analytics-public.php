<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/jpw123/
 * @since      1.0.0
 *
 * @package    Video_Analytics
 * @subpackage Video_Analytics/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Video_Analytics
 * @subpackage Video_Analytics/public
 * @author     Jan Wojtasinski <jan@829llc.com>
 */
class Video_Analytics_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;               

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/video-analytics-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/video-analytics-public.js', array( 'jquery' ), $this->version, false );

	}
        
        /**
         * The function in charge of loading all the appropriate public filters for the Video Analytics Plugin.
         * 
         * @param mixed $content Output from Wordpress the_content()
         * @since   1.0.0
         */
        public function video_analytics_actions_loader($content) {
            
            //Filter the excerpt code
            if (get_option( 'excerpt-switch', false ) == 1 ){
                add_filter( 'the_excerpt' , array($this, 'add_video_analytics_actions') );
            }
            //Filter the content code
            if (get_option( 'content-switch', false ) == 1 ){
                add_filter( 'the_content' , array($this, 'add_video_analytics_actions') );
            }
            //Filter widgets with iFrames that use the widget_text filter
            if (get_option( 'widgetText-switch', false ) == 1){
                add_filter( 'widget_text' , array($this, 'add_video_analytics_actions') );
            }
            
        }
        
        /**
         * The function in charge of loading Vimeo dependencies and the tracking scripts.
         * 
         * @since 1.0.0
         */
        private function vimeo_analytics(){
            
            
            
        }

}
