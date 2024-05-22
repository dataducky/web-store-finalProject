<?php
 require_once('duck_store_fns.php');
 session_start();
 do_html_header("Promote User");
 check_admin_user();
 ?>
<div class="centercontent">
<?php
 display_promote_user_form();
 ?>
</div>
<?php
 do_html_url("admin.php", "Back to administration menu");
 do_html_footer();
?>
