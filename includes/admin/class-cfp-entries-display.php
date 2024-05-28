<?php 

/**
 * Handles displaying of entries 
 * 
 * @version 1.0.1
 */

 if ( ! class_exists( 'WP_List_Table' ) ){
  require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
 }
 

 class CFP_Entries_Display extends \WP_List_Table  {
  public $plugin_text_domain = "vfzcxv";

  /**
   * Cosntructor
   */
  public function __construct () {
   
  }
  public function prepare_items(){
    $o = "hello" ;
    $p = "fdsaf" ;

    $this -> items = [ 
      'id' => 123214,
      'title' => "the title"
    ];

    $column = $this -> get_columns();
    $hiddenColumn = $this -> get_hidden_columns(  );

    $this -> _column_headers = 
      [
        $column , $hiddenColumn
      ];
  }

  public function get_columns (){

    $table_columns = array(
      'cb'		=> '<input type="checkbox" />', // to display the checkbox.			 
      'user_login'	=> __( 'User Login'),
      'display_name'	=> __( 'Display Name'),			
      'user_registered' => _x( 'Registered On', 'column name'),
      'ID'		=> __( 'User Id'),
    );		
    return $table_columns;
  }

  public function no_items() {
    _e( 'No users avaliable.', $this->plugin_text_domain );
  }

  public function column_cb( $item ) {

    return '<input type="checkbox" /> ';

  }
  public function template () {
    ?>
<div class="wrap">    
    <h2><?php _e('WP List Table Demo', $this->plugin_text_domain); ?></h2>
        <div id="nds-wp-list-table-demo">			
            <div id="nds-post-body">		
		<form id="nds-user-list-form" method="get">					
			<?php $this->table_column->display(); ?>					
		</form>
            </div>			
        </div>
</div>
<?php
  }

  public function column_default ($item , $column_name){
    switch ( $column_name ) {
      case 'user_login':
      case 'display_name':
      case 'user_registered':
        return $item[$column_name];
        default:
        return 'non list found';
    }
  }

  

 }