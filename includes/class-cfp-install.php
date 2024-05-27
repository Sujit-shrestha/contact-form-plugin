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

     $this ->tableCreation ( );

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
    * Create table if not exists
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