<?php

// include function files for this application
require_once('duck_store_fns.php');
session_start();

if ((isset($_REQUEST['username'])) && isset(($_REQUEST['password']))) {
	// they have just tried logging in

    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    if (login($username, $password)) {
      // if they are in the database register the user id
      $_SESSION['admin_user'] = $username;

   } elseif(usercheck($username, $password)) {
	   $_SESSION['user'] = $username;
	   
   } else {
      // unsuccessful login
      do_html_header("Problem:");
      echo "<p>You could not be logged in.<br/>
            You must be logged in to view this page.</p>";
      do_html_url('login.php', 'Login');
      do_html_footer();
      exit;
    }
}

do_html_header("Admin Menu");
if (check_admin_user()) {
  display_admin_menu();
} elseif (check_user()) {
	echo "<p>Successfully logged in<br/>
    Please view site to continue.</p>";
	do_html_url('index.php', 'Index');
}
		
do_html_footer();

?>
