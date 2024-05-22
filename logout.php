<?php

// include function files for this application
require_once('duck_store_fns.php');
session_start();
 // store  to test if they *were* logged in
if (isset($_SESSION['admin_user'])) {
	$old_admin_user = $_SESSION['admin_user'];  
	unset($_SESSION['admin_user']);
}
if (isset($_SESSION['user'])) {
	$old_user = $_SESSION['user'];
	unset($_SESSION['user']);
}
session_destroy();

// start output html
do_html_header("Logging Out");

if ((!empty($old_user)) || (!empty($old_admin_user))) {
  echo "<p>Logged out.</p>";
  do_html_url("login.php", "Login");
} else {
  // if they weren't logged in but came to this page somehow
  echo "<p>You were not logged in, and so have not been logged out.</p>";
  do_html_url("login.php", "Login");
}

do_html_footer();

?>
