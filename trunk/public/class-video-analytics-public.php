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
	 * The class that handles all vimeo processing
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Video_Analytics_Vimeo   $vimeo    Takes care of the vimeo stuff
	 */
	protected $vimeo;
        
        /**
	 * The options for the plugin
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $settings    The settings pertinent to this portion of the plugin
	 */
	protected $settings;
        
        /**
	 * The scripts for the plugin
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $scripts    The scripts pertinent to this portion of the plugin
	 */
	protected $scripts;
        
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
                
                $this->set_options();

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
                
                //Add the scripts in the script array
                foreach ($this->scripts as $script) {
                    wp_enqueue_script($script['handle'], $script['src'], $script['deps'], $script['ver'], $script['in_footer']);
                }
	}
        
        
        /**
         * The function in charge of calling general video functions.
         * 
         * @since 1.0.0
         */
        private function load_video_analytics_actions( $input ){
            if (!empty( $input )) {
                //Vimeo Loader
                if (esc_attr(get_option( 'vimeo-switch' ) == 1)) {
                    require_once 'class-video-analytics-vimeo.php';
                    if (!isset($this->vimeo)) {
                        $this->vimeo = new Video_Analytics_Vimeo( $this->plugin_name, $this->version, $this->settings );
                    }
                    
                    //Overwrite input with output from Vimeo class.
                    $output = $this->vimeo->run( $input );
                    
                }
            }
            
            if ($output['script']) {
                $this->add_script($this->plugin_name, plugin_dir_url( __FILE__ ) . $output['script'], array( 'jquery' ), $this->version, true);
            }
            
            return $output['input'];
        }
        
        /**
         * The handler function for the_content filter
         * 
         * @since 1.0.0
         * @param mixed input The input from the_content.
         * @todo RETURN THE MODIFIED CONTENT TO THE APPROPRIATE PLACE
         */
        public function add_video_analytics_content_actions( $input ){
                        
            return $this->load_video_analytics_actions( $input );  
            
            
        }
        
        /**
         * The handler function for the_excerpt filter
         * 
         * @since 1.0.0
         * @param mixed input The input from the_excerpt.
         */
        public function add_video_analytics_excerpt_actions( $input ){
                        
            return $this->load_video_analytics_actions( $input );
            
        }
        
        /**
         * The handler function for widget_text filter
         * 
         * @since 1.0.0
         * @param mixed input The input from widget_text.
         */
        public function add_video_analytics_widget_actions( $input ){
                        
           return $this->load_video_analytics_actions( $input );
            
        }
        
        /**
	 * Gets the relevant options database and returns them in an array
	 *
	 * @since    1.0.0
         * @return  $settings array( 'option-name' => 'option-setting')
         * @TODO INVESTIGATE AUTOLOADING THESE BY OPTION GROUP
	 */
        public function get_options( $type ) {
            
            if ($type == 'all' || $type == 'vimeo') {
                
                $settings['vimeo'] = array(
                'vimeo-modFrame' => esc_attr(get_option( 'vimeo-modframe' )),
                'vimeo-dataProgress' => esc_attr(get_option( 'vimeo-dataProgress' )),
                'vimeo-dataSeek' => esc_attr(get_option( 'vimeo-Dataseek' )),
                'vimeo-dataBounce' => esc_attr(get_option( 'vimeo-dataBounce' )),
                'vimeo-videoTitle' => esc_attr(get_option( 'vimeo-videoTitle' ))
                );
            }
            
            if ($type == 'all' || $type == 'youtube') {
                
            }
            
            if ($type == 'all' || $type == 'html5') {
                
            }
            
            return $settings;
        }
        
        /**
	 * Sets the $settings parameter from the options database by calling get_options(). Has an optional override to update and overwrite the settings.
	 *
         * 
	 * @since    1.0.0
         * @param optional $override Overwrite the current settings stored in the variable
	 */
        public function set_options( $overwrite = false) {
            if ( $overwrite == true || !isset($this->settings)) {
                $this->settings = $this->get_options();
            }
        }
        
        /**
	 * Add a script to the loader for the public facing plugin
         * 
	 * @since    1.0.0
         * @param follows the syntax of wp_enque_scripts
	 */
        public function add_script($handle, $src = false, array $deps, $ver = false, $in_footer = false) {
            $this->scripts[] = array(
                'handle' => $handle,
                'src' => $src,
                'deps' => $deps,
                'ver' => $ver,
                'in_footer' => $in_footer
            );            
        }
        

}
