<?php
    setcookie("username", "", time() - 3600);
    setcookie("user_id", "", time() - 3600);

    header("location: /admin/login.php");
?>