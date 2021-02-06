<?php
include_once ('C:\xampp\htdocs\trex\app\core\auth.php');
if(!Auth::isLoggedIn()) {
    header("Location: login.php");
    exit();
}else{
    header("Location: profile.php");
}
