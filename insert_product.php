<?php

// include function files for this application
require_once('duck_store_fns.php');
session_start();

do_html_header("Adding a product");
if (check_admin_user()) {
  if (filled_out($_POST)) {
    $productid = $_POST['productid'];
    $title = $_POST['title'];
    $catid = $_POST['catid'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    if(insert_product($productid, $title, $catid, $price, $description)) {
      echo "<p>Product <em>".htmlspecialchars($title)."</em> was added to the database.</p>";
    } else {
      echo "<p>Product <em>".htmlspecialchars($title)."</em> could not be added to the database.</p>";
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
