<?php
include_once ('C:\xampp\htdocs\trex\app\core\auth.php');

//check if the starting row variable was passed in the URL or not
if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
  //we give the value of the starting row to 0 because nothing was found in URL
  $startrow = 0;
//otherwise we take the value from the URL
} else {
  $startrow = (int)$_GET['startrow'];
}

if (!isset($_GET['col_id'])){
    $col_id = intval(Database::querySingle("SELECT collection_id as 'collection_id' FROM `collections` where 
user_id= :user_id LIMIT 1", array(':user_id'=> Auth::isLoggedIn()['id']))['collection_id']);
} else {
    $col_id = intval($_GET['col_id']);
}


if (isset($_GET['col_id']) || $col_id != null){
    if($_GET['time'] != 'all_time' && isset($_GET['time'])){
        $time = intval($_GET['time']);
        $items=Database::query('SELECT t.title, t.category, t.type, DATE_FORMAT(t.date, \'%Y-%m-%d\') AS `date`, CONCAT(t.amount," ",c.currency) AS `amount`, t.description
 FROM `collections` c  join `transactions` t on c.collection_id=t.collection_id  WHERE 
 c.collection_id= :collection_id AND c.user_id = :user_id AND (t.date BETWEEN SYSDATE() AND DATE_SUB(SYSDATE(),INTERVAL :date DAY)) order by t.date desc LIMIT ' . $startrow .  ', 10',
            array(':user_id'=> Auth::isLoggedIn()['id'], ':collection_id' => $col_id, ':date'=> $time));
    } elseif($_GET['time'] == 'all_time' || !isset($_GET['time'])){
        $time = 'all_time';
        $items=Database::query('SELECT t.title, t.category, t.type, DATE_FORMAT(t.date, \'%Y-%m-%d\') AS `date`, CONCAT(t.amount," ",c.currency) AS `amount`, t.description
 FROM `collections` c  join `transactions` t on c.collection_id=t.collection_id  WHERE 
 c.collection_id= :collection_id AND c.user_id = :user_id order by t.date desc LIMIT ' . $startrow .  ', 10',
            array(':user_id'=> Auth::isLoggedIn()['id'], ':collection_id' => $col_id));
    }


}

$budget=Database::querySingle('SELECT SUM(t.amount) AS `amount` FROM `collections` c join `transactions` t on c.collection_id=t.collection_id 
WHERE c.collection_id= :collection_id AND c.user_id = :user_id AND DATE_FORMAT(t.date, \'%M\') = DATE_FORMAT(SYSDATE(), \'%M\')',
    array(':collection_id'=>$col_id, ':user_id'=> Auth::isLoggedIn()['id']))['amount'];
