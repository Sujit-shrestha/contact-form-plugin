<?php 

/**
 * Class for handling deactivation jobs in the CFP plugin
 * 
 * @version 1.0.1
 * 
 */

 class CFP_Deactivate {
  /**
   * Deactivation instance
   */
  private static $deactivationInstance = null ;

  /**
   * Constructor
   * 
   * Privatizing the construct for deactivaiton to prevent others to deactivate this without use of proper deactivation method
   * 
   * @since 1.0.1
   */

  private function __construct ( ) {

   }

   /**
    * Creates the object of self and returns it
    *
    *@return self
    */
  public static function getDeactivationInstance ( ) : self {

        if( is_null( self :: $deactivationInstance ) ) {
          $deactivationInstance = new self();
        }
    
        return $deactivationInstance;
      }

      /**
       * DEactivation jobs handler
       */
  public function deactivate ( ) {

        flush_rewrite_rules (  ) ;

      }
    }

 