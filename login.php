<?php
 require_once('duck_store_fns.php');
 do_html_header("Log in");

 display_login_form();
 ?>
<div class="centercontent">
<?php
 display_button("registration.php", "registration", "Register your account");
?>
</div>
<?php
 do_html_footer();
?>
