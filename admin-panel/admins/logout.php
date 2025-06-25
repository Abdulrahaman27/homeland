<?php require "../layouts/header.php";?>
<?php 
session_unset();
session_destroy();

echo "<script>window.location.href='".ADMIN_URL."/admins/login-admins.php'</script>";
