<?php
include_once ('C:\xampp\htdocs\trex\app\core\auth.php');
if (!isset($_GET['year']) && isset($_GET['col_id'])){
    $year= date("Y");
    $col_id = intval($_GET['col_id']);
    $incomeItems=Database::query('SELECT t.type, DATE_FORMAT(t.date,\'%M\') as date, SUM(t.amount) AS `amount` FROM `collections` c join `transactions` t on c.collection_id=t.collection_id WHERE 
c.collection_id= :collection_id AND c.user_id = :user_id AND DATE_FORMAT(t.date,\'%Y\')= :year AND t.type = "Income" group by DATE_FORMAT(t.date,\'%M\')',
        array(':user_id'=> Auth::isLoggedIn()['id'], ':collection_id' => $col_id, ':year' => $year));

    $expenseItems=Database::query('SELECT t.type, DATE_FORMAT(t.date,\'%M\') as date, SUM(t.amount) AS `amount` FROM `collections` c join `transactions` t on c.collection_id=t.collection_id WHERE 
c.collection_id= :collection_id AND c.user_id = :user_id AND DATE_FORMAT(t.date,\'%Y\')= :year AND t.type = "Expense" group by DATE_FORMAT(t.date,\'%M\')',
        array(':user_id'=> Auth::isLoggedIn()['id'], ':collection_id' => $col_id, ':year' => $year));
}



if (isset($_GET['year']) && isset($_GET['col_id'])){
    $col_id = intval($_GET['col_id']);
    if ($_GET['year']=='null'){
        $year= date("Y");
    } else {
        $year = intval($_GET['year']);
    }
    $incomeItems=Database::query('SELECT t.type, DATE_FORMAT(t.date,\'%M\') as date, SUM(t.amount) AS `amount` FROM `collections` c join `transactions` t on c.collection_id=t.collection_id WHERE 
c.collection_id= :collection_id AND c.user_id = :user_id AND DATE_FORMAT(t.date,\'%Y\')= :year AND t.type = "Income" group by DATE_FORMAT(t.date,\'%M\')',
            array(':user_id'=> Auth::isLoggedIn()['id'], ':collection_id' => $col_id, ':year' => $year));

    $expenseItems=Database::query('SELECT t.type, DATE_FORMAT(t.date,\'%M\') as date, SUM(t.amount) AS `amount` FROM `collections` c join `transactions` t on c.collection_id=t.collection_id WHERE 
c.collection_id= :collection_id AND c.user_id = :user_id AND DATE_FORMAT(t.date,\'%Y\')= :year AND t.type = "Expense" group by DATE_FORMAT(t.date,\'%M\')',
    array(':user_id'=> Auth::isLoggedIn()['id'], ':collection_id' => $col_id, ':year' => $year));
}
