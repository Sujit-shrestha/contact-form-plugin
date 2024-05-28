<?php 

/**
 * Loooping through the folder to include the files in each folder
 */
foreach (glob(__DIR__ . '/includes/*.php') as $file) {

  require_once $file;
}
foreach (glob(__DIR__ . '/includes/*/*.php') as $file) {

  require_once $file;
}
foreach (glob(__DIR__ . '/public/*/*.php') as $file) {

  require_once $file;
}

