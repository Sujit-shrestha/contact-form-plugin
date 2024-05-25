<?php

 defined( 'ABSPATH' ) || exit;

 /**
  * Main class for Contact Form PLugin.
  *
  *@version 1.0.1
  */

  final class Contact_Forms_Plugin {


    /**
     * Single instance of the main class.
     * 
     * @var Contact_Forms_Plugin
     * 
     */
    private static $instance  = null;

    /**
     * Plugins Installation class instance.
     */
    private $installationInstance ;

    /**
     * Privating constructor to make single instance available for use i.e. ( Singleton pattern ).
     * 
     * @since 1.0.1
     */
    private function __construct() {

    //setting up autoloader
    // require_once dirname( __FILE__ ) .'/autoloader.php';

    $this->init_hooks();

    }

    /**
     * Function to return the instance if available.
     *
     * @return self
     * @since 1.0.1
     */
    public static function getInstance(): self {

      if( is_null( self::$instance ) ) {
        self::$instance = new self();
      }
      return self::$instance;
    }

    /**
     * Hook for actions and filters.
     * 
     * @since 1.0.1
     * @return void
     */
    private function init_hooks(): void {

      /**
       * Registrations
       */
     
      
       //activation hook registration
      register_activation_hook( CFP_PLUGIN_FILE , array( $this, 'activate_plugin' ) );

      /**
       * Actions
       */




      /**
       * Filters
       */

    }

    /**
     * Gets installation instance form CFP_Install class
     * 
     */
    public function getInstallationInstance ( ) {
      if ( ! class_exists( 'Cfp_Install' ) ) {
        include_once dirname(CFP_PLUGIN_FILE) . '/includes/class-cfp-install.php';
      }
      
      $this->installationInstance = new Cfp_Install();

    }

    /**
     * Plugin activation jobs : Handled by CFP_Install calss in includes/class-cfp-intall.php
     */
    public function activate_plugin() {
      
      $this->getInstallationInstance();
      $this->installationInstance->install();

    }




  }