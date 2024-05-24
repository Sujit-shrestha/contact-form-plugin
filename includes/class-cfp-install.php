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
  class CFP_Install {

  /**
   * Constructor
   */
   public function __construct() {
   
   }
   
   /**
    * Installation starts form here
    */
    public function install() {
     
      $this -> flushRewriteRules();
    }
   
   /**
    * Flushes rewrite rules and recreates it.
    *
    * @return void
    */
   private function flushRewriteRules() {
     
      flush_rewrite_rules();
   }

  }