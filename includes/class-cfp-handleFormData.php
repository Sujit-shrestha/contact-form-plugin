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
    
    $dataFromUser = array(
      $name,
      $email,
      $subject,
      $message
    );
  error_log(print_r($_POST , true));

  
 
    wp_send_json_success(
      array(
        "message" => esc_html__( "Data received"),
        "data" => $dataFromUser
      )
    );
  }
}