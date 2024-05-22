<?php
  include ('duck_store_fns.php');
  // The shopping cart needs sessions, so start one
  session_start();

  $productid = $_GET['productid'];

  // get this product out of database
  $product = get_product_details($productid);
  do_html_header($product['title']);
  display_product_details($product);

  // set url for "continue button"
  $target = "index.php";
  if($product['catid']) {
    $target = "show_cat.php?catid=". urlencode($product['catid']);
  }

  // if logged in as admin, show edit product links
 ?>
<div class="centercontent">
<?php
  if(check_admin_user()) {
    display_button("edit_product_form.php?productid=". urlencode($productid), "edit-item", "Edit Item");
    display_button($target, "continue", "Continue");
  } else {
    display_button("show_cart.php?new=". urlencode($productid), "add-to-cart",
                   "Add ". htmlspecialchars($product['title']) ." To My Shopping Cart");
    display_button($target, "continue-shopping", "Continue Shopping");
  }
?>
</div>
<?php
  do_html_footer();
?>
