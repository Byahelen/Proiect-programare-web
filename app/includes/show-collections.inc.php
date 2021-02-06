<?php
include_once ('C:\xampp\htdocs\trex\app\core\auth.php');

$col_items=Database::query('SELECT collection_id, name, Currency FROM `collections`  WHERE user_id = :user_id ',
    array(':user_id'=> Auth::isLoggedIn()['id']));