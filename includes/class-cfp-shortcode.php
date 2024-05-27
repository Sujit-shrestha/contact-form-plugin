<?php 

/**
 *  CFM shortcodes
 * 
 * @version 1.0.1
 */

 defined( 'ABSPATH' ) || exit;

 /**
  * Contact form plugin shortcodes
  */

 class CFP_Shortcodes { 

  /**
   * Constructor
   */

   public function __construct (  ) {
    /**
     * Actions
     */

    add_action( 'init' , array( $this , 'shortcode_define' ) );

    add_action( 'wp_enqueue_scripts' , array( $this , 'enqueueCpfFormHandlerScripts' ) );
    

   }

  /**
   * Defining shortcode as [Cfp_form_code]
   * 
   * 
   */
  public function shortcode_define (  ) {
    
    add_shortcode( 'CFP_form_code' , array( $this , 'getCFPFormTemplate' ) );
  }

  /**
   * Gets template for the form
   * 
   * Returns a php file with html template
   */

   public function getCFPFormTemplate ( ) {

    $templateFile = file_get_contents( dirname(CFP_PLUGIN_FILE) . '/templates/cfp-form-template.php' );

    return $templateFile;
   }

   /**
    * Gets the form handling scripts

    *@return void
    */
    public function enqueueCpfFormHandlerScripts () {

      wp_enqueue_script( 'csutomjs' , plugins_url( 'contact-form-plugin/public/js/cfp-form-handler.js' , 'contact-form-plugin' ) , [ 'jquery' ] , '1.0.1' );

      //localization for ajax request 
      wp_localize_script(
        'customjs' ,
        esc_html__ ( 'my_ajax_obj' ),
        array (  
          'ajax_url' => admin_url( 'admin-ajax.php' ),
          'current_user_id' => get_current_user_id(),
          'cfp_nonce' => wp_create_nonce ( 'cfp_secure_nonce' )
        )
      );

    }

 }