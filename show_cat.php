<?php
  include ('duck_store_fns.php');
  // The shopping cart needs sessions, so start one
  session_start();

  $catid = $_GET['catid'];
  $name = get_category_name($catid);

  do_html_header($name);

  // get the book info out from db
  $product_array = get_products($catid);

  display_products($product_array);

?>
<div class="centercontent">
<?php
  // if logged in as admin, show add, delete book links
  if(isset($_SESSION['admin_user'])) {
    display_button("index.php", "continue", "Continue Shopping");
    display_button("edit_category_form.php?catid=". urlencode($catid),
                   "edit-category", "Edit Category");
  } else {
    display_button("index.php", "continue-shopping", "Continue Shopping");
  }
?>
</div>
<?php

  do_html_footer();
?>
