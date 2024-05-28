<?php

/**
 * Handles all the dtabase operaitons
 * 
 * @version 1.0.1
 */

defined('ABSPATH') || die;

class CFP_DbOperations {
  
  /**
   * Instance of CFP_DbOperations
   */
  public static $instance = null  ;

  /**
   * CFP form main table name
   */
  private $entriesTablenameSuffix   = "cfp_form_entries";

  /**
   * Constructor privated to make use of singgel instance of database operator
   */
  private function __construct(){

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
   * Saving in database
   * 
   * @param array
   * @return ..bool
   */
  public function save( array $data ) {

    global $wpdb ;
    $tableName = $wpdb->prefix . $this->entriesTablenameSuffix;

    //data to insert in ( colummn : data ) format
    $to_insert =  array( 
        "form_id"   => $data['form_id'],
        "user_id"   => get_current_user_id(),
        "name"      => $data['name'],
        "email"     => $data['email'],
        "subject"   => $data['subject'],
        "message"   => $data['message'],

    );
     
    //insertion
    $wpdb -> insert (
        $tableName,
        $to_insert
    );
    //return true if no error
    if( ! $wpdb->last_error ){
      return true;
    }
    return "Something went wrong. Please reload and submit the form agian. Thank you.";
    
  }
}