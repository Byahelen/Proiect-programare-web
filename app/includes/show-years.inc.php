<?php
include_once ('C:\xampp\htdocs\trex\app\core\auth.php');

$year_items=Database::query('SELECT DATE_FORMAT(t.date, \'%Y\') as `date` FROM collections c join transactions t on
 c.collection_id=t.collection_id WHERE c.user_id = :user_id group by DATE_FORMAT(t.date, \'%Y\') ', array(':user_id'=>Auth::isLoggedIn()['id']));