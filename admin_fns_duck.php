<?php
// This file contains functions used by the admin interface
// for the Book-O-Rama shopping cart.

function display_category_form($category = '') {
// This displays the category form.
// This form can be used for inserting or editing categories.
// To insert, don't pass any parameters.  This will set $edit
// to false, and the form will go to insert_category.php.
// To update, pass an array containing a category.  The
// form will contain the old data and point to update_category.php.
// It will also add a "Delete category" button.

  // if passed an existing category, proceed in "edit mode"
  $edit = is_array($category);

  // most of the form is in plain HTML with some
  // optional PHP bits throughout
?>
  <form method="post"
      action="<?php echo $edit ? 'edit_category.php' : 'insert_category.php'; ?>">
  <table border="0">
  <tr>
    <td>Category Name:</td>
    <td><input type="text" name="catname" size="40" maxlength="40"
          value="<?php echo htmlspecialchars($edit ? $category['catname'] : ''); ?>" /></td>
   </tr>
  <tr>
    <td <?php if (!$edit) { echo "colspan=2";} ?> align="center">
      <?php
         if ($edit) {
            echo "<input type=\"hidden\" name=\"catid\" value=\"". htmlspecialchars($category['catid'])."\" />";
         }
      ?>
      <input type="submit"
       value="<?php echo $edit ? 'Update' : 'Add'; ?> Category" /></form>
     </td>
     <?php
        if ($edit) {
          //allow deletion of existing categories
          echo "<td>
                <form method=\"post\" action=\"delete_category.php\">
                <input type=\"hidden\" name=\"catid\" value=\"". htmlspecialchars($category['catid'])."\" />
                <input type=\"submit\" value=\"Delete category\" />
                </form></td>";
       }
     ?>
  </tr>
  </table>
<?php
}

function display_product_form($product = '') {
// This displays the product form.
// It is very similar to the category form.
// This form can be used for inserting or editing products.
// To insert, don't pass any parameters.  This will set $edit
// to false, and the form will go to insert_product.php.
// To update, pass an array containing a product.  The
// form will be displayed with the old data and point to update_product.php.
// It will also add a "Delete product" button.


  // if passed an existing product, proceed in "edit mode"
  $edit = is_array($product);

  // most of the form is in plain HTML with some
  // optional PHP bits throughout
?>
  <form method="post"
        action="<?php echo $edit ? 'edit_product.php' : 'insert_product.php';?>">
  <table border="0">
  <tr>
    <td>Product ID:</td>
    <td><input type="text" name="productid"
         value="<?php echo htmlspecialchars($edit ? $product['productid'] : ''); ?>" /></td>
  </tr>
  <tr>
    <td>Product Name:</td>
    <td><input type="text" name="title"
         value="<?php echo htmlspecialchars($edit ? $product['title'] : ''); ?>" /></td>
  </tr>
   <tr>
      <td>Category:</td>
      <td><select name="catid">
      <?php
          // list of possible categories comes from database
          $cat_array=get_categories();
          foreach ($cat_array as $thiscat) {
               echo "<option value=\"".htmlspecialchars($thiscat['catid'])."\"";
               // if existing product, put in current catgory
               if (($edit) && ($thiscat['catid'] == $product['catid'])) {
                   echo " selected";
               }
               echo ">".htmlspecialchars($thiscat['catname'])."</option>";
          }
          ?>
          </select>
        </td>
   </tr>
   <tr>
    <td>Price:</td>
    <td><input type="text" name="price"
               value="<?php echo htmlspecialchars($edit ? $product['price'] : ''); ?>" /></td>
   </tr>
   <tr>
     <td>Description:</td>
     <td><textarea rows="3" cols="50"
          name="description"><?php echo htmlspecialchars($edit ? $product['description'] : ''); ?></textarea></td>
    </tr>
    <tr>
      <td <?php if (!$edit) { echo "colspan=2"; }?> align="center">
         <?php
            if ($edit)
             // we need the old id to find product in database
             // if the id is being updated
             echo "<input type=\"hidden\" name=\"oldid\"
                    value=\"".htmlspecialchars($product['productid'])."\" />";
         ?>
        <input type="submit"
               value="<?php echo $edit ? 'Update' : 'Add'; ?> Product" />
        </form></td>
        <?php
           if ($edit) {
             echo "<td>
                   <form method=\"post\" action=\"delete_product.php\">
                   <input type=\"hidden\" name=\"productid\"
                    value=\"".htmlspecialchars($product['productid'])."\" />
                   <input type=\"submit\" value=\"Delete product\"/>
                   </form></td>";
            }
          ?>
         </td>
      </tr>
  </table>
  </form>
<?php
}

function display_password_form() {
// displays html change password form
?>
   <br />
   <form action="change_password.php" method="post">
   <table width="250" cellpadding="2" cellspacing="0" bgcolor="#cccccc">
   <tr><td>Old password:</td>
       <td><input type="password" name="old_passwd" size="16" maxlength="16" /></td>
   </tr>
   <tr><td>New password:</td>
       <td><input type="password" name="new_passwd" size="16" maxlength="16" /></td>
   </tr>
   <tr><td>Repeat new password:</td>
       <td><input type="password" name="new_passwd2" size="16" maxlength="16" /></td>
   </tr>
   <tr><td colspan=2 align="center"><input type="submit" value="Change password">
   </td></tr>
   </table>
   <br />
<?php
}

function display_promote_user_form() {
?>
<br />
   <form action="promote_user.php" method="post">
   <table width="250" cellpadding="2" cellspacing="0" bgcolor="#cccccc">
   <tr><td>Username:</td>
       <td><input type="text" name="username"/></td>
   </tr>
   <tr><td>Confirm Username:</td>
       <td><input type="text" name="confuser"/></td>
   </tr>
   <tr><td>Confirm Your Password:</td>
       <td><input type="password" name="password" size="16" maxlength="16" /></td>
   </tr>
   <tr><td colspan=2 align="center"><input type="submit" value="Promote to Administrator">
   </td></tr>
   </table>
   <br />
<?php	
}

function display_demote_user_form() {
?>
<br />
   <form action="demote_user.php" method="post">
   <table width="250" cellpadding="2" cellspacing="0" bgcolor="#cccccc">
   <tr><td>Username:</td>
       <td><input type="text" name="username"/></td>
   </tr>
   <tr><td>Confirm Username:</td>
       <td><input type="text" name="confuser"/></td>
   </tr>
   <tr><td>Confirm Your Password:</td>
       <td><input type="password" name="password" size="16" maxlength="16" /></td>
   </tr>
   <tr><td colspan=2 align="center"><input type="submit" value="Demote to User">
   </td></tr>
   </table>
   <br />
<?php	
}

function insert_category($catname) {
// inserts a new category into the database

   $conn = db_connect();

   // check category does not already exist
   $query = "select *
             from categories
             where catname='".$conn->real_escape_string($catname)."'";
   $result = $conn->query($query);
   if ((!$result) || ($result->num_rows!=0)) {
     return false;
   }

   // insert new category
   $query = "insert into categories values
            ('', '".$conn->real_escape_string($catname)."')";
   $result = $conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

function insert_product($productid, $title, $catid, $price, $description) {
// insert a new product into the database

   $conn = db_connect();

   // check product does not already exist
   $query = "select *
             from product
             where productid='".$conn->real_escape_string($productid)."'";

   $result = $conn->query($query);
   if ((!$result) || ($result->num_rows!=0)) {
     return false;
   }

   // insert new product
   $query = "insert into product values
            ('".$conn->real_escape_string($productid) ."','". $conn->real_escape_string($title) ."', '". $conn->real_escape_string($catid) . 
              "', '". $conn->real_escape_string($price) ."', '" . $conn->real_escape_string($description) ."')";

   $result = $conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

function update_category($catid, $catname) {
// change the name of category with catid in the database

   $conn = db_connect();

   $query = "update categories
             set catname='".$conn->real_escape_string($catname) ."'
             where catid='".$conn->real_escape_string($catid) ."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

function update_product($oldid, $productid, $title, $catid,
                     $price, $description) {
// change details of product stored under $oldid in
// the database to new details in arguments

   $conn = db_connect();

   $query = "update product
             set productid= '".$conn->real_escape_string($productid)."',
             title = '".$conn->real_escape_string($title)."',
             catid = '".$conn->real_escape_string($catid)."',
             price = '".$conn->real_escape_string($price)."',
             description = '".$conn->real_escape_string($description)."'
             where productid = '".$conn->real_escape_string($oldid)."'";

	// check if productid is already assigned
	$productcheck = "select productid
					 from product
					 where productid= '".$conn->real_escape_string($productid)."'";
	$checkresult = $conn->query($productcheck);
   if ((!$checkresult) || ($checkresult->num_rows!=0)) {
	   return false;
   }
	$result = @$conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
   
}

function delete_category($catid) {
// Remove the category identified by catid from the db
// If there are products in the category, it will not
// be removed and the function will return false.

   $conn = db_connect();

   // check if there are any products in category
   // to avoid deletion anomalies
   $query = "select *
             from product
             where catid='".$conn->real_escape_string($catid)."'";

   $result = @$conn->query($query);
   if ((!$result) || (@$result->num_rows > 0)) {
     return false;
   }

   $query = "delete from categories
             where catid='".$conn->real_escape_string($catid)."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}


function delete_product($productid) {
// Deletes the product identified by $productid from the database.

   $conn = db_connect();

   $query = "delete from product
             where productid='".$conn->real_escape_string($productid)."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   } else {
     return true;
   }
}

?>
