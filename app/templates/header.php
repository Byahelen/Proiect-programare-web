<?php
define("PROJECT_NAME","TrEx ");
include( 'C:\xampp\htdocs\trex\app\includes\arrays.inc.php');
include_once( 'C:\xampp\htdocs\trex\app\core\auth.php');
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="/trex/assets/styles/style.css">
    <script type ="text/javascript" src="/trex/assets/scripts/main.js"></script>
    <title><?php echo PROJECT_NAME .' | '. TITLE; ?></title>
</head>
<body>
<?php
    include('C:\xampp\htdocs\trex\app\templates\nav-header.php');
    include('C:\xampp\htdocs\trex\app\templates\nav.php');
    ?>

