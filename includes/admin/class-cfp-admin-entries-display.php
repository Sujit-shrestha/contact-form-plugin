<?php 

/**
 * Handles display of table data
 */

 class CFP_Display_Entries {
  /**
   * Constructor
   */
  public function __construct ( ) {

    add_action( 'during_table_columns_filling' , array( $this , 'render_sorting_button' ) );
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
    #svg_cfp {
      height: 20px;
      padding: 10 10;
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
           do_action('during_table_columns_filling' , $col);
           
          ?>

        </th>

      <?php
      }
      ?>
    </tr>
      <tbody id="cfp_table_rows" >
      <?php 
      $this->render_table_rows( $constraints );
      ?>
      </tbody>
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

   
    foreach( $dataAvailable as $row ){
    ?>
      <tr class="table_class_row">
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
              "searchKeyword" => $_POST["searchKeyword"],
            )
          ); 
  }
  /**
   * Handles sorting in the admin entries
   */
  public static function handle_sort () {
    $formEntriesDisplay = new self () ;
    // error_log( print_r ( "reached here" , true ) );
    
    $formEntriesDisplay -> render_table_rows(
      array(
        "orderby"       => $_POST["orderby"],
        "sortorder"     => $_POST["sortby"],
        "searchKeyword" => $_POST["searchKeyword"]
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
        <svg id="svg_cfp" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M137.4 41.4c12.5-12.5 32.8-12.5 45.3 0l128 128c9.2 9.2 11.9 22.9 6.9 34.9s-16.6 19.8-29.6 19.8H32c-12.9 0-24.6-7.8-29.6-19.8s-2.2-25.7 6.9-34.9l128-128zm0 429.3l-128-128c-9.2-9.2-11.9-22.9-6.9-34.9s16.6-19.8 29.6-19.8H288c12.9 0 24.6 7.8 29.6 19.8s2.2 25.7-6.9 34.9l-128 128c-12.5 12.5-32.8 12.5-45.3 0z"/></svg>
       </span>
       

       <?php
    }
  }
 }