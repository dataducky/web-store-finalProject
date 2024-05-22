<?php
  include_once 'duck_store_fns.php';
  // The shopping cart needs sessions, so start one
  session_start();
  do_html_header("Welcome to Ducky Store");

  display_home_page();

  do_html_footer();
?>
