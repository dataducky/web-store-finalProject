<?php

// include function files for this application
require_once('duck_store_fns.php');
session_start();

do_html_header("Deleting product");
if (check_admin_user()) {
  if (isset($_POST['productid'])) {
    $productid = $_POST['productid'];
    if(delete_product($productid)) {
      echo "<p>Product ".htmlspecialchars($productid)." was deleted.</p>";
    } else {
      echo "<p>Product ".htmlspecialchars($productid)." could not be deleted.</p>";
    }
  } else {
    echo "<p>We need a ProductID to delete a product.  Please try again.</p>";
  }
  do_html_url("admin.php", "Back to administration menu");
} else {
  echo "<p>You are not authorised to view this page.</p>";
}

do_html_footer();

?>
