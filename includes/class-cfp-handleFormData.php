<?php 

/**
 * Handles the form data
 */

 defined( 'ABSPATH' ) || exit;
class CFP_Formhandler {

  /**
   * Constructor
   */
  public function __construct ( ) {

  }

  /**
   * Handles the form data 
   * 
   * Parses , sanitizes , validates and sedn a escaped & translated result
   * 
   * @param none
   * @return void
   */
  public static function handleForm () {

    //parsing the serialized form data
    parse_str( $_POST["data"] ,$formData );

    //sanitization of fields
    $name    = sanitize_text_field($formData["name"]);
    $email   = sanitize_text_field( $formData["email"] );
    $subject = sanitize_text_field( $formData["subject"] );
    $message = sanitize_textarea_field( $formData["message"] );
    $nonce   = $_POST["nonce"];
    $form_id = $formData["form_id"];
    
    //formating user data for further processing
    $dataFromUser = array(
      'name'      => $name,
      'email'     => $email,
      'subject'   => $subject,
      'message'   => $message,
      'nonce'     => $nonce,
      'form_id'   => $form_id
    );


    //nonce check
    self :: verify_nonce ( $nonce );


    //keys definition to check different validations
    $keys = array( 
      'name'    => array( 'required' , 'empty' , 'maxLength' , 'minLength' ) ,
      'email'   => array( 'required' , 'empty' , 'emailFormat' , 'maxLength' , 'minLength' ),
      'subject' => array( 'maxLength'  ),
      'message' => array( 'maxLength'  )
    );

      //validate data
    $validationResponseIsTrue = self :: validate_data ( $dataFromUser  , $keys );


  //save in database

    if( $validationResponseIsTrue ) {
      $dbOperationInstance = CFP_DbOperations :: getInstance();

      $responseFromDatabase = $dbOperationInstance -> save( $dataFromUser );
    }

  
    if(  $responseFromDatabase  != 1){
      //despite its an eror message  , following funciotn is used to send the message directly on the place of form.
      wp_send_json_success(
        array(
          "message"   => esc_html__( $responseFromDatabase ),
          "data"      => $dataFromUser
        )
      );
    }

    //reaches here if everything is on par : success
    wp_send_json_success(
      array(
        "message" => esc_html__( "Thanks for submission of the form. We are glad to get your thoughts. We will get back to you soon."),
        "data"    => $dataFromUser
      )
    );
  }
 
  

  /**
   * Verifies the nonce provided to the form
   */
  private static function verify_nonce ( $nonce) {

    if ( ! wp_verify_nonce( $nonce , 'wp_ajax_submit_cfp_form_action_secure_themegrill9988') ) {
      wp_send_json_error( 
        array ( 
          "message" => esc_html__ ( "Nonce not verified. Please reload." ),
          "display_div_id_suffix" => esc_html( "default" )
         )
       );
       exit;
    }

  }

  /**
   * Validates the data based on keys provided
   * 
   * data are provided by the user
   * keys are array of constraints for each attribute
   * 
   * @param array
   * @return ..
   * 
   */
  public static function validate_data ( $data , $keys) {

    $validation = [];
   
    foreach ( $keys as $k => $v ) {

      //validation for requried field chceck
      if ( in_array ( 'required' , $v ) ){
        if ( ! isset ( $data[$k] ) ) {
         
          $validation[$k] = array(
            "message"               => esc_html__( "This is a requried field." ),
            "display_div_id_suffix" => $k
          );
        }
      }

      //validaiton for empty field
      if ( in_array ( 'empty' , $v ) ){
        if (  empty ( $data[$k] ) ) {
          
          $validation[$k] = array(
            "message"               => esc_html__( "The field cannot be empty." ),
            "display_div_id_suffix" => $k
          );
        }
      }

      //validation for max length
      if ( in_array( 'maxLength' , $v ) ) {
        $maxAllowedLength = array ( 
          'name'    => 40 ,
          'email'   => 40 ,
          'subject' => 100 ,
          'message' => 3000
        );

        $inputLength = strlen( $data[$k] ) ;

        if ( $inputLength > $maxAllowedLength[$k] ) {
       
          $validation[$k] = array(
            "message"               => esc_html__( "The field has exceeded max length." ),
            "display_div_id_suffix" => $k
          );
        }
      }

      //validation for min length
      if ( in_array( 'minLength' , $v ) ) {
        $minAllowedLength = array ( 
          'name'    => 1 ,
          'email'   => 7 ,
          'subject' => 0 ,
          'message' => 0
        );

        $inputLength = strlen( $data[$k] ) ;

        if ( $inputLength < $minAllowedLength[$k] ) {

          $validation[$k] = array(
            "message"               => esc_html__( "The field should have at least length of $minAllowedLength[$k]." ),
            "display_div_id_suffix" => $k
          );
        }
      } 

      //email validation
      if ( in_array( "emailFormat" , $v ) ){
        function isValidEmail ( $email ) {
          $tempp = filter_var( $email , FILTER_VALIDATE_EMAIL );

          if ( $tempp !== false ) {
            $temp = explode ( '@' , $email );
            if ( substr( $temp[0] , -1 ) === '+' ) {
             return false;
            }

            return true;
          } else {
            return false;
          }
        }

        isValidEmail( $data[$k] ) ? array( ) : 
        $validation[$k] = array(
          "message"               => esc_html__( "Email is not valid" ),
          "display_div_id_suffix" => $k
        );
        continue;
      }
      
    }
    if ( count( $validation ) > 0 ){
      //sending all validation data at once
      wp_send_json_error(
              array(
                "message"          => esc_html__( "Validation errors foind." ),
                "validation_error" => $validation,
                "data"             => $data
              )
            );  
    }
    
    return true;
  
  }
}