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
 * The public-facing vimeo specific functionality of the plugin.
 *
 * Handles all of the plugin functionality in relation to modifying vimeo iframes and adding appropriate tracking scripts.
 *
 * @package    Video_Analytics
 * @subpackage Video_Analytics/public
 * @author     Jan Wojtasinski <jan@829llc.com>
 */
class Video_Analytics_Vimeo {
    
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
	 * The options for the plugin
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $settings    The settings pertinent to this portion of the plugin
	 */
	private $settings;
        
         /**
	 * The vimeo tracking script location
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $script    the URL for the tracking script
	 */
	private $script = 'modules/vimeo-tracker/modules/vimeo.ga.min.js';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
         * @param      array     $settings  An array of the Vimeo settings -- must match the output from Wordpress.
	 */
	public function __construct( $plugin_name, $version, $settings ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
                $this->settings = $settings;
	}
        
        /**
	 * Executes the vimeo related plugin functions on the input provided.
	 *
         * 
	 * @since    1.0.0
         * @param $input The input to be modified by the class.
         * @return array $output 'input' => modified or original input, 'script' => URL is needed, or False if no script should be embedded
	 */
        public function run ( $input ) {
            
            $output['input'] = $input;
            $output['script'] = false;
            
            if( $this->vimeo_check( $input ) ) {
                
                //Set the script URL
                $output['script'] = $this->get_script();
                
                //Run the modFrame code
                if ($this->settings['vimeo-modFrame'] == 1) {
                    $output['input'] = $this->modify_frames($output['input']);
                }
                
            }
            
            return $output;
        }
       
         /**
	 * Checks for Vimeo Iframes.
	 *
         * 
	 * @since    1.0.0
         * @param $input The input to be checked.
         * @return bool $output True if vimeo is detected, false if else.
	 */
        public function vimeo_check( $input ) {            
            
            if (strpos($input, '/player.vimeo.com/video/')) {
                
                return true;
            }
            
            return false;
 
        }
        
        /**
	 * Modifies Vimeo Iframes
	 *
         * 
	 * @since    1.0.0
         * @param $input The input to be modified.
	 */
        private function modify_frames( $input ) {
            
            
            return $output;
        }
        
        public function get_script() {
            
            return $this->script;
            
        }
    
}
