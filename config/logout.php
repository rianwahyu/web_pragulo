<?php 

session_start();

session_destroy();

header("location:../auth_login?pesan=logout");
?>