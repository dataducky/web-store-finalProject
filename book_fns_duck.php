<?php
function calculate_shipping_cost() {
  // as we are shipping products all over the world
  // via teleportation, shipping is fixed
  return 15.00;
}

function get_categories() {
   // query database for a list of categories
   $conn = db_connect();
   $query = "select catid, catname from categories";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_category_name($catid) {
   // query database for the name for a category id
   $conn = db_connect();
   $query = "select catname from categories
             where catid = '".$conn->real_escape_string($catid)."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $row = $result->fetch_object();
   return $row->catname;
}


function get_products($catid) {
   // query database for the products in a category
   if ((!$catid) || ($catid == '')) {
     return false;
   }

   $conn = db_connect();
   $query = "select * from products where catid = '".$conn->real_escape_string($catid)."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_products = @$result->num_rows;
   if ($num_products == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_all_product() {
   // query database for all products


   $conn = db_connect();
   $query = "select * from product";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_products = @$result->num_rows;
   if ($num_products == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_products_details($productid) {
  // query database for all details for a particular product
  if ((!$productid) || ($productid=='')) {
     return false;
  }
  $conn = db_connect();
  $query = "select * from products where productid='".$conn->real_escape_string($productid)."'";
  $result = @$conn->query($query);
  if (!$result) {
     return false;
  }
  $result = @$result->fetch_assoc();
  return $result;
}

function calculate_price($cart) {
  // sum total price for all items in shopping cart
  $price = 0.0;
  if(is_array($cart)) {
    $conn = db_connect();
    foreach($cart as $productid => $qty) {
      $query = "select price from products where productid='".$conn->real_escape_string($productid)."'";
      $result = $conn->query($query);
      if ($result) {
        $item = $result->fetch_object();
        $item_price = $item->price;
        $price +=$item_price*$qty;
      }
    }
  }
  return $price;
}

function calculate_items($cart) {
  // sum total items in shopping cart
  $items = 0;
  if(is_array($cart))   {
    foreach($cart as $productid => $qty) {
      $items += $qty;
    }
  }
  return $items;
}
?>
