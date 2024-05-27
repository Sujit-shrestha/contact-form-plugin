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
   * constructor
   */

   public function __construct (  ) {

    /**
     * Actions
     */

    add_action( 'init' , array( $this , 'shortcode_define' ) );

    

   }

  /**
   * Defining shortcode as Cfp_form_code
   * 
   * 
   */
  public function shortcode_define (  ) {
    
    add_shortcode( 'CFP_form_code' , array( $this , 'getCFPFormTemplate' ) );
  }

  /**
   * Gets template for the form
   */

   public function getCFPFormTemplate ( ) {

    $templateFile = file_get_contents( dirname(CFP_PLUGIN_FILE) . '/templates/cfp-form-template.php' );

    return $templateFile;

    
    // return readfile(CFP_PLUGIN_FILE . '/templates/cfp-foorm-template.php' );

   }

 }