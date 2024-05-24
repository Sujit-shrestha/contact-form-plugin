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
     * Installation class instance.
     */
    private $installationInstance ;

    /**
     * Privating constructor to make single instance available for use i.e. ( Singleton pattern ).
     * 
     * @since 1.0.1
     */
    private function __construct(){

    //setting up autoloader
    // require_once dirname( __FILE__ ) .'/autoloader.php';

    $this->init_hooks();

    }

    /**
     * Function to return the instance if available.
     *
     * @return void
     * @since 1.0.1
     */
    public static function getInstance():self {

      if( is_null( self::$instance ) ) {
        self::$instance = new self();
      }
      return self::$instance;
    }

    /**
     * Hook for actions and filters.
     * 
     * @since 1.0.1
     */
    private function init_hooks(){

      /**
       * Registrations
       */

       //activation hook
      register_activation_hook( CFP_PLUGIN_FILE, array( $this->installationInstance , 'install' ) );

      /**
       * Actions
       */

       //gets installation class instance : Used for registration in activation hook
       add_action( 'init' , array( $this , 'getInstallationInstance' ) );



      /**
       * Filters
       */

    }





     /**
  * Handles activation and deactivation jobs for CFP plugins.
  *
  * @return 
  */
//  function cfp_init_and_terminate_job(){

//  }


    /**
     * Gets installation instance form CFP_Install class
     * 
     */
    public function getInstallationInstance ( ) {
      if ( ! class_exists( 'CFP_Install' ) ) {
        include_once CFP_PLUGIN_FILE . '/includes/class-cfp-install.php';
      }
      $this->installationInstance = new CFP_Install();
    }




  }