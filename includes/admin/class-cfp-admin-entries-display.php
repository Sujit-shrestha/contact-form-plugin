<?php 

/**
 * Handles display of table data
 */

 class CFP_Display_Entries {
  /**
   * Constructor
   */
  public function __construct ( ) {

    add_action( 'after_table_columns_filled' , array( $this , 'render_sorting_button' ) );
  }

  /**
   * Inititates the table rendering , data pulling task
   *
   * @return void
   */
  public function init () {

   //render search area
   $this -> render_search_template();

    //render table
    $this -> render_table_template ();
  

  }

  /**
   * Display search area
   */
  public function render_search_template (){

    ?>
    <label for="Search" ><?php  _e("Search:" , CFP_text_domain) ?></label>
    <input id="cfp_form_entry_search" type="text" placeholder="<?php  _e("Type here to search..." , CFP_text_domain) ?>" />
  
    </br></br>
    <?php

  }


  /**
   * Table displaying
   */
  public function render_table_template (  $constraints=[]  ) {

    $dbOps           = CFP_DbOperations :: getInstance ( ) ;
    $columsAvailable = $dbOps -> get_columns ( ) ;

    $dataAvailable   = $dbOps -> get_data ( $constraints ) ;
  ?>

<!DOCTYPE html>
<html>

<head>
  <style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
      table-layout: auto;
    }

    td,
    th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }
  </style>
</head>

<body>
  <table id="cfp_table_entries">
    <tr>
      <?php 
      foreach( $columsAvailable as $col){
      ?>
        <th id="cfp_table_entries_<?php echo $col ?>" >
          <?php
           esc_html_e($col , CFP_text_domain );
           do_action('after_table_columns_filled' , $col);
          ?>
        </th>
      <?php
      }
      ?>
    </tr>
      <?php
    $this->render_table_rows( $constraints );
    ?>
  </table>
</body>

</html>

<?php

  }

  /**
   * Render table rows
   */
  public function render_table_rows( $constraints){
    $dbOps           = CFP_DbOperations :: getInstance ( ) ;
    $dataAvailable   = $dbOps -> get_data ( $constraints ) ;

    ?>
    <div id="cfp_table_rows" >
    <?php 
    foreach( $dataAvailable as $row ){
    ?>
      <tr>
        <?php
        foreach( $row as $unit ) {
        ?>
          <td>
            <?php 
            esc_html_e($unit , CFP_text_domain);
            ?>
          </td>
      
        <?php
        }
        ?>
      </tr>
    <?php
    }
    ?>
  </div>
  <?php
  }

  /**
   * Enqueue scripts and css
   */
  public static function admin_enqueuing () {

    //script
    wp_enqueue_script( 'admin_search_js' , plugins_url( 'contact-form-plugin/includes/admin/js/cfp-admin-display-handler.js' , 'contact-form-plugin' ) , [ 'jquery' ] , '1.0.1' );

     //localization for ajax request 
    wp_localize_script(
      'admin_search_js' ,
      'cfp_jquery_object',
      array (  
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'cfp_nonce_search' => wp_create_nonce ( 'wp_ajax_admin_search_secure_themegrill9988' )
      )
    );
  }

  /**
   * Handles search in the admin entries display
   */
  public static function handle_search() {
      
    $formEntriesDisplay = new self();
    
          $formEntriesDisplay -> render_table_template (
            array(
              "searchKeyword" => $_POST["data"],
            )
          ); 
  }
  /**
   * Handles sorting in the admin entries
   */
  public static function handle_sort () {
    $formEntriesDisplay = new self () ;
    
    $formEntriesDisplay -> render_table_rows(
      array(
        "orderby"       => $_POST["orderby"],
        "sortorder"     => $_POST["sortby"]
      )
    );



  }

  /**
   * Conditionally reders soritng button 
   */
  public function render_sorting_button($args){
    
    $addSortingButtonOn = array( 'name' , 'email' );
    
    if( in_array( $args , $addSortingButtonOn ) ) {
       ?><span class="cfp_sorting_unit" id="<?php echo $args ?>">
        <img src="contact-form-plugin\assets\sort.svg"/>
       </span>
       

       <?php
    }
  }
 }