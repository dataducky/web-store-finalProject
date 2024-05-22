<?php

function do_html_header($title = '') {
  // print an HTML header

  // declare the session variables we want access to inside the function
  if (empty($_SESSION['items'])) {
    $_SESSION['items'] = '0';
  }
  if (empty($_SESSION['total_price'])) {
    $_SESSION['total_price'] = '0.00';
  }
?>
  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($title); ?></title>
    <style>
      h2 { font-family: Cooper Black; font-size: 22px; color: red; margin: 6px }
      body { font-family: Cooper Black; font-size: 13px ; margin: 0px ; background-color:#F4ECD2}
      li, td { font-family: Cooper Black; font-size: 13px }
      hr { color: #FF0000; width=70%; text-align:center}
      a { color: #000000 }
    </style>
	<script>
	function resizeIframe(obj) {
		obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
	}
	</script>
	<link rel="stylesheet" type="text/css" href="src/navbar.css">
  </head>
  <body onload="startTime()">
  <div class="navbar"> <!-- Navbar code from w3schools -->
  <a href="index.php"><img src="images/ducky.png" alt="Rubber Duck Shop" border="0"
    class="button"   height="55" width="325"/></a>
  <div class="dropdown"style="border:5px">
    <button class="dropbtn"> Shop Ducks
    </button>
    <div class="dropdown-content">
	<?php
		$cat_array = get_categories();
		display_navbar_categories($cat_array)
	?>
    </div>
  </div>
<!--
  <div class="floatright">
  <?php
     if(isset($_SESSION['admin_user'])) {
       echo "&nbsp;";
     } else {
       echo "Total Items = " . htmlspecialchars($_SESSION['items'])."<br>";
       echo "Total Price = $".number_format($_SESSION['total_price'],2);
     }
  ?>
  </div>
-->
<!-- W3Schools timing clock javascript with added date & am/pm function -->
  <script>
	function startTime() {
		const today = new Date();
		let h = today.getHours();
		let m = today.getMinutes();
		let s = today.getSeconds();
		let date = today.getDate();
		let month = today.getMonth();
		let year = today.getYear() + 1900;
		let ampm = "am";
		date = checkTime(date);
		month = checkTime(month) + 1;
		m = checkTime(m);
		s = checkTime(s);
		if (h > 12) {
			ampm = "pm";
			h = h - 12;
		}
		document.getElementById('clock').innerHTML =  h + ":" + m + ":" + s + ampm
			+ "<br>" + month + "-" + date + "-" + year;
		setTimeout(startTime, 1000);
	}

	function checkTime(i) {
		if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
		return i;
	}
	</script>
  <div class="floatright">
  <?php
     if(isset($_SESSION['admin_user'])) {
       display_button('admin.php', 'admin-menu', 'Admin Menu');
     } else {
       display_button('show_cart.php', 'view-cart', 'View Your Shopping Cart');
     }
  ?>
  <?php
	if((isset($_SESSION['admin_user']))or(isset($_SESSION['user']))) {
		display_button('logout.php', 'log-out', 'Log Out');
	} else {
		display_button('login.php', 'login', 'Log into your account');
	}
  ?>
  </div>
  <div class="floatright"><strong>Time & Date</strong><div id="clock" style="margin:0px 14.3px;"></div></div>
  </div>
<?php
}

function do_html_footer() {
  // print an HTML footer
?>
  </body>
  </html>
<?php
}

function do_html_heading($heading) {
  // print heading
?>
  <h2><?php echo htmlspecialchars($heading); ?></h2>
<?php
}

function do_html_URL($url, $name) {
  // output URL as link and br
?>
  <a href="<?php echo htmlspecialchars($url); ?>"><?php echo htmlspecialchars($name, ENT_QUOTES); ?></a><br />
<?php
}
function do_html_cat_URL($url, $name) {
  // output URL as link and br
?>
  <a href="<?php echo htmlspecialchars($url); ?>"><?php echo htmlspecialchars($name, ENT_QUOTES); ?></a>
<?php
}
function do_html_URL_img($url, $imgLink) {
  // output URL as link and background image
?>
  <a href="<?php echo htmlspecialchars($url); ?>"><img <?php echo htmlspecialchars($imgLink, ENT_NOQUOTES); ?>></a><br />
<?php
}

function display_categories($cat_array) {
  if (!is_array($cat_array)) {
     echo "<p>No categories currently available</p>";
     return;
  }
  echo "<ul>";
  foreach ($cat_array as $row)  {
    $url = "show_cat.php?catid=".urlencode($row['catid']);
    $title = $row['catname'];
    echo "<li>";
    do_html_url($url, $title);
    echo "</li>";
  }
  echo "</ul>";
}

function display_navbar_categories($cat_array) {
	if (!is_array($cat_array)) {
     echo "<p>No categories currently available</p>";
     return;
  }
  foreach ($cat_array as $row)  {
    $url = "show_cat.php?catid=".urlencode($row['catid']);
    $title = $row['catname'];
    do_html_cat_url($url, $title);
  }
}

function display_products($product_array) {
  //display all products in the array passed in
  if (!is_array($product_array)) {
    echo "<p>No products currently available in this category</p>";
  } else {
    //create table
?>	
<div> <!-- overlay -->
<div class="sidebar"> <!-- right 20% / categories -->
<?php
$cat_array = get_categories();

 
 // display as links to cat pages
 echo "<h1 style=\"padding-left:5px;\">Categories Available</h1>";
 display_categories($cat_array);
?>
</div>
<div class="productblock">
<?php
    echo "<table width=\"100%\" border=\"0\">";

    //create a table row for each product
    foreach ($product_array as $row) {
      $url = "show_product.php?productid=" . urlencode($row['productid']);
      echo "<tr><td width=\"40%\">";
      if (@file_exists("images/{$row['productid']}.jpg")) {
        $title = "src=images/". htmlspecialchars($row['productid']) .'.jpg
                  style="border:1px solid black; height: 200px; width: 200px; margin-left:50px;"';
        do_html_URL_img($url, $title);
		
      } else {
        $title = "src=\"images/placeholder.jpg\"
                  style=\"border:1px solid black; height: 200px; width: 200px; margin-left:50px;\"";
        do_html_URL_img($url, $title);;
      }
      echo "</td><td>";
      $title = htmlspecialchars($row['title'], ENT_NOQUOTES);
	  $price = htmlspecialchars($row['price']);
      do_html_url($url, $title);
	  echo "$".htmlspecialchars($row['price']);
      echo "</td></tr>";
    }

    echo "</table>";
  }
?>
</div>
</div>
<?php

  echo "<hr />";
}

function display_brief_product($product_array) {
	echo "<table width=\"100%\" border=\"0\">";

    //create a table row for each product
    foreach ($product_array as $row) {
      $url = "show_product.php?productid=" . urlencode($row['productid']);
      echo "<tr><td width=\"40%\">";
      if (@file_exists("images/{$row['productid']}.jpg")) {
        $title = "src=images/". htmlspecialchars($row['productid']) .'.jpg
                  style="border:1px solid black; height: 75px; width: 75px; margin-left:50px;"';
        do_html_URL_img($url, $title);
		
      } else {
        echo "&nbsp;";
      }
      echo "</td><td>";
      $title = htmlspecialchars($row['title'], ENT_NOQUOTES);
	  $price = htmlspecialchars($row['price']);
      do_html_url($url, $title);
	  echo "$".htmlspecialchars($row['price']);
      echo "</td></tr>";
    }

    echo "</table>";
}

function display_product_details($product) {
  // display all details about this product
  if (is_array($product)) {
    echo "<div><table><tr>";
    //display the picture if there is one
    if (@file_exists("images/{$product['productid']}.jpg"))  {
      $size = GetImageSize("images/{$product['productid']}.jpg");
      if(($size[0] > 0) && ($size[1] > 0)) {
        echo "<td><img src=\"images/".htmlspecialchars($product['productid']).".jpg\"
              width=\"400\" height=\"400\" style=\"border: 1px solid black\"/></td>";
      }
	  
    } else {
	$size = GetImageSize("images/placeholder.jpg");
      if(($size[0] > 0) && ($size[1] > 0)) {
        echo "<td><img src=\"images/placeholder.jpg\"
              width=\"400\" height=\"400\" style=\"border: 1px solid black\"/></td>";
      }
	}
    echo "<td><ul>";
    echo "<h1>";
    echo htmlspecialchars($product['title']);
    echo "</h1><li><strong>Our Price:</strong> ";
    echo number_format($product['price'], 2);
    echo "</li><li><strong>Description:</strong> ";
    echo htmlspecialchars($product['description']);
    echo "</li></ul></td></tr></table></div>";
  } else {
    echo "<p>The details of this product cannot be displayed at this time.</p>";
  }
  echo "<hr />";
}

function display_checkout_form() {
  //display the form that asks for name and address
?>
  <br />
  <table border="0" width="100%" cellspacing="0">
  <form action="purchase.php" method="post">
  <tr><th colspan="2" bgcolor="#cccccc">Your Details</th></tr>
  <tr>
    <td width="50%">Name</td>
    <td width="50%"><input type="text" name="name" value="" maxlength="40" size="40"/></td>
  </tr>
  <tr>
    <td>Address</td>
    <td><input type="text" name="address" value="" maxlength="40" size="40"/></td>
  </tr>
  <tr>
    <td>City/Suburb</td>
    <td><input type="text" name="city" value="" maxlength="20" size="40"/></td>
  </tr>
  <tr>
    <td>State/Province</td>
    <td><input type="text" name="state" value="" maxlength="20" size="40"/></td>
  </tr>
  <tr>
    <td>Postal Code or Zip Code</td>
    <td><input type="text" name="zip" value="" maxlength="10" size="40"/></td>
  </tr>
  <tr>
    <td>Country</td>
    <td><input type="text" name="country" value="" maxlength="20" size="40"/></td>
  </tr>
  <tr><th colspan="2" bgcolor="#cccccc">Shipping Address (leave blank if as above)</th></tr>
  <tr>
    <td>Name</td>
    <td><input type="text" name="ship_name" value="" maxlength="40" size="40"/></td>
  </tr>
  <tr>
    <td>Address</td>
    <td><input type="text" name="ship_address" value="" maxlength="40" size="40"/></td>
  </tr>
  <tr>
    <td>City/Suburb</td>
    <td><input type="text" name="ship_city" value="" maxlength="20" size="40"/></td>
  </tr>
  <tr>
    <td>State/Province</td>
    <td><input type="text" name="ship_state" value="" maxlength="20" size="40"/></td>
  </tr>
  <tr>
    <td>Postal Code or Zip Code</td>
    <td><input type="text" name="ship_zip" value="" maxlength="10" size="40"/></td>
  </tr>
  <tr>
    <td>Country</td>
    <td><input type="text" name="ship_country" value="" maxlength="20" size="40"/></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><p><strong>Please press Purchase to confirm
         your purchase, or Continue Shopping to add or remove items.</strong></p>
     <?php display_form_button("purchase", "Purchase These Items"); ?>
    </td>
  </tr>
  </form>
  </table><hr />
<?php
}

function display_shipping($shipping) {
  // display table row with shipping cost and total price including shipping
?>
  <table border="0" width="100%" cellspacing="0">
  <tr><td width="76.5%" align="left" style="text-align:right;">Shipping</td>
      <td align="right" style="text-align:center;"> <?php echo "$".number_format($shipping, 2); ?></td></tr>
  <tr><th bgcolor="#cccccc" align="left" style="text-align:right;">TOTAL INCLUDING SHIPPING</th>
      <th bgcolor="#cccccc" align="right" style="text-align:center;">$ <?php echo number_format($shipping+$_SESSION['total_price'], 2); ?></th>
  </tr>
  </table><br />
<?php
}

function display_card_form($name) {
  //display form asking for credit card details
?>
  <table border="0" width="100%" cellspacing="0">
  <form action="process.php" method="post">
  <tr><th colspan="2" bgcolor="#cccccc">Credit Card Details</th></tr>
  <tr>
    <td>Type</td>
    <td><select name="card_type">
        <option value="VISA">VISA</option>
        <option value="MasterCard">MasterCard</option>
        <option value="American Express">American Express</option>
        </select>
    </td>
  </tr>
  <tr>
    <td>Number</td>
    <td><input type="text" name="card_number" value="" maxlength="16" size="40"></td>
  </tr>
  <tr>
    <td>AMEX code (if required)</td>
    <td><input type="text" name="amex_code" value="" maxlength="4" size="4"></td>
  </tr>
  <tr>
    <td>Expiry Date</td>
    <td>Month
       <select name="card_month">
       <option value="01">01</option>
       <option value="02">02</option>
       <option value="03">03</option>
       <option value="04">04</option>
       <option value="05">05</option>
       <option value="06">06</option>
       <option value="07">07</option>
       <option value="08">08</option>
       <option value="09">09</option>
       <option value="10">10</option>
       <option value="11">11</option>
       <option value="12">12</option>
       </select>
       Year
       <select name="card_year">
       <?php
       for ($y = date("Y"); $y < date("Y") + 10; $y++) {
         echo '<option value='.$y.'>'.$y.'</option>';
       }
       ?>
       </select>
  </tr>
  <tr>
    <td>Name on Card</td>
    <td><input type="text" name="card_name" value = "<?php echo $name; ?>" maxlength="40" size="40"></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
      <p><strong>Please press Purchase to confirm your purchase, or Continue Shopping to
      add or remove items</strong></p>
     <?php display_form_button('purchase', 'Purchase These Items'); ?>
    </td>
  </tr>
  </table>
<?php
}

function display_cart($cart, $change = true, $images = 1) {
  // display items in shopping cart
  // optionally allow changes (true or false)
  // optionally include images (1 - yes, 0 - no)

   echo "<table border=\"0\" width=\"100%\" cellspacing=\"0\">
         <form action=\"show_cart.php\" method=\"post\">
         <tr><th colspan=\"".(1 + $images)."\" bgcolor=\"#cccccc\">Item</th>
         <th bgcolor=\"#cccccc\">Price</th>
         <th bgcolor=\"#cccccc\">Quantity</th>
         <th bgcolor=\"#cccccc\">Total</th>
         </tr>";

  //display each item as a table row
  foreach ($cart as $productid => $qty)  {
    $product = get_product_details($productid);
    echo "<tr>";
    if($images == true) {
      echo "<td align=\"left\" width=\"20%\">";
      if (file_exists("images/{$productid}.jpg")) {
         $size = GetImageSize("images/{$productid}.jpg");
         if(($size[0] > 0) && ($size[1] > 0)) {
           echo "<img src=\"images/".htmlspecialchars($productid).".jpg\"
                  style=\"border: 1px solid black;margin-left:50px;\"
                  width=\"135\"
                  height=\"135\">";
         }
      } else {
         $size = GetImageSize("images/placeholder.jpg");
         if(($size[0] > 0) && ($size[1] > 0)) {
           echo "<img src=\"images/placeholder.jpg\"
                  style=\"border: 1px solid black;margin-left:50px;\"
                  width=\"135\"
                  height=\"135\">";;
		 }
      }
      echo "</td>";
    }
    echo "<td align=\"left\" style=\"text-align:center;\">
          <a href=\"show_product.php?productid=".urlencode($productid)."\">".htmlspecialchars($product['title'])."</a></td>
          <td align=\"center\">\$".number_format($product['price'], 2)."</td>
          <td align=\"center\">";

    // if we allow changes, quantities are in text boxes
    if ($change == true) {
      echo "<input type=\"text\" name=\"".htmlspecialchars($productid)."\" value=\"".htmlspecialchars($qty)."\" size=\"3\">";
    } else {
      echo $qty;
    }
    echo "</td><td align=\"center\">\$".number_format($product['price']*$qty,2)."</td></tr>\n";
  }
  // display total row
  echo "<tr>
        <th colspan=\"".(2+$images)."\" bgcolor=\"#cccccc\">&nbsp;</td>
        <th align=\"center\" bgcolor=\"#cccccc\">".htmlspecialchars($_SESSION['items'])."</th>
        <th align=\"center\" bgcolor=\"#cccccc\">
            \$".number_format($_SESSION['total_price'], 2)."
        </th>
        </tr>";

  // display save change button
  if($change == true) {
    echo "<tr>
          <td colspan=\"".(2+$images)."\">&nbsp;</td>
          <td align=\"center\">
             <input type=\"hidden\" name=\"save\" value=\"true\"/>
             <input type=\"image\" src=\"images/save-changes.gif\"
                    border=\"0\" alt=\"Save Changes\"/>
          </td>
          <td>&nbsp;</td>
          </tr>";
  }
  echo "</form></table>";
}

function display_login_form() {
  // dispaly form asking for name and password
?>
 <form method="post" action="admin.php" class="centercontent">
 <table bgcolor="#cccccc">
   <tr>
     <td>Username:</td>
     <td><input type="text" name="username"/></td></tr>
   <tr>
     <td>Password:</td>
     <td><input type="password" name="password"/></td></tr>
   <tr>
     <td colspan="2" align="center">
     <input type="submit" value="Log in"/></td></tr>
   <tr>
 </table></form>
<?php
}

function display_registration_form() {
  // dispaly form asking for name and password
?>
 <form method="post" action="registered.php" class="centercontent">
 <table bgcolor="#cccccc">
   <tr>
     <td>Set Username:</td>
     <td><input type="text" name="username"/></td></tr>
   <tr>
     <td>Set Password:</td>
     <td><input type="password" name="password" size="16" maxlength="16" /></td></tr>
	<tr>
     <td>Confirm Password:</td>
     <td><input type="password" name="confpass" size="16" maxlength="16" /></td></tr>
   <tr>
     <td colspan="2" align="center">
     <input type="submit" value="Register"/></td></tr>
   <tr>
 </table></form>
<?php
}
function display_home_page() {
?>
<div class="doublet">
<h1 style="text-align:center;">Welcome to Rubber Ducky Shop</h1>
<ul>
<li>Shop for ducks using the 'Shop Ducks' dropdown button on the navbar.</li><br>
<li>When done shopping, use the 'View Cart' button to access checkout.</li><br>
<li>For user & admin login & registration, use the 'Log in" button.</li>
</ul>
</div>
<div class="doublet">
<h3	 style="text-align:center;">Recent Rubber Duck Video Highlights</h3> <br>
<iframe width="100%" height="480px"
	src="https://www.youtube.com/embed/9eXnMBuUZQQ"/>
</iframe><br>
<iframe width="100%" height="480px"
	src="https://www.youtube.com/embed/85lRKp5GNSc/">
</iframe><br>
</div>
<?php
}

function display_admin_menu() {
?>
<div class="doublet">
<h1>Administrative Functions</h1>
<ul style="background-color:#E8D9AE;width:50%;margin:13px;">
<li><a href="index.php">Go to main site</a></li><br />
<li><a href="change_password_form.php">Change admin password</a></li><br />
<li><a href="promote_user_form.php">Promote user to admin</a></li><br />
<li><a href="demote_user_form.php">Demote admin to user</a></li><br />
</ul>
</div>
<div class="doublet">
<h1>Product Functions</h1>
<ul style="background-color:#E8D9AE;width:50%;margin:13px;">
<li><a href="insert_category_form.php">Add a new category</a></li><br />
<li><a href="insert_product_form.php">Add a new product</a></li><br />
</ul>
</div>
<?php
}

function display_button($target, $image, $alt) {
  echo "<a href=\"".htmlspecialchars($target)."\" class=\"button\" style=\"padding:2.5px;\">
          <img src=\"images/".htmlspecialchars($image).".gif\"
           alt=\"".htmlspecialchars($alt)."\" border=\"0\" height=\"50\"
           width=\"135\"/></a>";
}

function display_form_button($image, $alt) {
  echo "<div align=\"center\"><input type=\"image\"
           src=\"images/".htmlspecialchars($image).".gif\"
           alt=\"".htmlspecialchars($alt)."\" border=\"0\" height=\"50\"
           width=\"135\"/></div>";
}


?>

