<?php
session_start();
session_destroy();
header("location: http://localhost/amit_php/admin/admin_login.php");
