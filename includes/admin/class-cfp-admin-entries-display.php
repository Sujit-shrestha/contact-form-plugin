<?php 

/**
 * Handles display of table data
 */

 class CFP_Display_Entries {
  /**
   * Constructor
   */
  public function __construct ( ) {

  }

  /**
   * Inititates the table rendering , data pulling task
   *
   * @return void
   */
  public function init () {
    //render table
    $this -> render_table_template ();

    //render searchablility

    //sortability ?
  }

  /**
   * Table displaying
   */
  public function render_table_template () {

    $dbOps           = CFP_DbOperations :: getInstance ( ) ;
    $columsAvailable = $dbOps -> get_columns ( ) ;
    $dataAvailable   = $dbOps -> get_data ( ) ;

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
  <table>
    <tr>
      <?php 
      foreach( $columsAvailable as $col){
      ?>
        <th>
          <?php
          echo $col;
          ?>
        </th>
      <?php
      }
      ?>
    </tr>
      <?php 
      foreach( $dataAvailable as $row ){
      ?>
        <tr>
          <?php
          foreach( $row as $unit ) {
          ?>
            <td>
              <?php 
              echo $unit;
              ?>
            </td>
        
          <?php
          }
          ?>
        </tr>
      <?php
      }
      ?>
  </table>

</body>

</html>

<?php

  }
 }