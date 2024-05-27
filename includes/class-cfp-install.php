<?php

/**
 * Handles the functions that need to be run in installation of the CFP plugin
 * 
 * @version 1.0.1
 */

 defined( 'ABSPATH' ) || exit;

 /**
  * CFP_Install class
  */
  class Cfp_Install {
   
   /**
    * Installation  or Activtion of plugin starts form here
    */
    public function install() {

     $this -> flushRewriteRules();
     $this -> setOption();
     $this -> tableCreation ();

   }
   
   /**
    * Flushes rewrite rules and recreates it.
    *
    * @return void
    */
   private function flushRewriteRules() {
     
      flush_rewrite_rules();
   }
   /**
    * Set activation key in options table
    *
    * @return void
    */

    private function setOption ( ) {
       //set plugin activated denotation in option table
     if ( ! get_option( "cfp_plugin_activated" ) ) {

      add_option( "cfp_plugin_activated", "true" );

      }
    }

   /**
    * Create table if not exists
    *
    * Simple table creation logic which can be further made better by checking the individual columns of already existing table in case already existing table is missing an  cokumsn
    */
    private function tableCreation ( ) {


      global $wpdb;

      $tablename = $wpdb->prefix ."cfp_form_entries";

      $tableCreationQuery = "
         CREATE TABLE IF NOT EXISTS $tablename (
            entry_id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            form_id INT UNSIGNED NOT NULL,
            user_id INT UNSIGNED ,
            name varchar(40) NOT NULL,
            email varchar(40) NOT NULL,
            subject varchar(100) ,
            message TEXT,
            form_creted_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
         )
         ";

      require_once ABSPATH . 'wp-admin/includes/upgrade.php';

      dbDelta( $tableCreationQuery , true );

    }

  }