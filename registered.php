<?php
 require_once('duck_store_fns.php');
 session_start();

if ((isset($_REQUEST['username'])) && isset(($_REQUEST['password'])) && isset(($_REQUEST['confpass']))) {
	// they have just tried logging in

    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
	$confpass = $_REQUEST['confpass'];

    if (register_user($username, $password, $confpass)) {
      // if they are in the database register the user id
      $_SESSION['user'] = $username;
	  do_html_header("Registered");
	  echo "<p>Your account has been registered.</p>";
   } else {
      // unsuccessful login
      do_html_header("Problem:");
      echo "<p>You could not be registered.</p>";
      do_html_url('login.php', 'Login');
      do_html_footer();
      exit;
    }
}

 do_html_footer();
?>
