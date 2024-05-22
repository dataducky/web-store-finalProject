<?php
 require_once('duck_store_fns.php');
 session_start();
 do_html_header("Change administrator password");
 check_admin_user();
 ?>
<div class="centercontent">
<?php
 display_password_form();
 ?>
</div>
<?php
 do_html_url("admin.php", "Back to administration menu");
 do_html_footer();
?>
