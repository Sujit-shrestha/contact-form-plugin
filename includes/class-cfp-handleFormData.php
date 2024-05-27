<?php 

/**
 * Handles the form data
 */
class CFP_Formhandler {

  /**
   * Constructor
   */
  public function __construct ( ) {

  }

  /**
   * 
   */
  public static function handleForm () {

    //parsing the serialized form data
    parse_str( $_POST["data"] ,$formData );

    //sanitization of fields
    $name    = sanitize_text_field($formData["name"]);
    $email   = sanitize_email( $formData["email"] );
    $subject = sanitize_text_field( $formData["subject"] );
    $message = sanitize_textarea_field( $formData["message"] );
    $nonce = $_POST["nonce"];
    
    $dataFromUser = array(
      $name,
      $email,
      $subject,
      $message,
      $nonce
    );
    error_log(print_r($dataFromUser , true));

    //nonce check
  self :: verify_nonce ( $nonce );

  
 
    wp_send_json_success(
      array(
        "message" => esc_html__( "Data received"),
        "data" => $dataFromUser
      )
    );
  }

  /**
   * Verifies the nonce provided to the form
   */
  private static function verify_nonce ( $nonce) {
   error_log(print_r($nonce , true));
    if ( ! wp_verify_nonce( $nonce , 'wp_ajax_submit_cfp_form_action_secure_themegrill9988') ) {
      wp_send_json_error( 
        array ( 
          "message" => esc_html__ ( "Nonce not verified. Please reload." )
         )
       );
       exit;
    }
  }
}