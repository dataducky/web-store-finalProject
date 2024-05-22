<?php

// include function files for this application
require_once('duck_store_fns.php');
session_start();

do_html_header("Updating product");
if (check_admin_user()) {
  if (filled_out($_POST)) {
    $oldid = $_POST['oldid'];
    $productid = $_POST['productid'];
    $title = $_POST['title'];
    $catid = $_POST['catid'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    if(update_product($oldid, $productid, $title, $catid, $price, $description)) {
      echo "<p>Product was updated.</p>";
    } else {
      echo "<p>Product could not be updated.</p>";
    }
  } else {
    echo "<p>You have not filled out the form.  Please try again.</p>";
  }
  do_html_url("admin.php", "Back to administration menu");
} else {
  echo "<p>You are not authorised to view this page.</p>";
}

do_html_footer();

?>
