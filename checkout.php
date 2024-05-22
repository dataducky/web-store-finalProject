<?php
  //include our function set
  include ('duck_store_fns.php');

  // The shopping cart needs sessions, so start one
  session_start();

  do_html_header("Checkout");

  if((isset($_SESSION['cart'])) && (array_count_values($_SESSION['cart']))) {
    display_cart($_SESSION['cart'], false, 0);
    display_checkout_form();
  } else {
    echo "<p>There are no items in your cart</p>";
  }
	echo "<div class=\"centercontent\">";
  display_button("show_cart.php", "continue-shopping", "Continue Shopping");
	echo "</div>";
  do_html_footer();
?>
