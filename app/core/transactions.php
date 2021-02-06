<?php

include_once ('C:\xampp\htdocs\trex\app\core\auth.php');

class Transactions{
    public static function add()
    {

        //SANITIZE POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $user_id = Auth::isLoggedIn()['id'];
        $amount = $post['transactionAmount'];

        define("DB_INSERT_TRANSACTION_0", "INSERT INTO TRANSACTIONS(collection_id, title, category, type, date, amount, description)");
        define("DB_INSERT_TRANSACTION_1", "INSERT INTO TRANSACTIONS(collection_id, title, category, type, amount, description)");


        if ($_POST['add']) {
            if ($post['transactionDate'] == '' && $post['transactionType'] == 'expense') {
                //Insert into MySQL database
                Database::query(DB_INSERT_TRANSACTION_1 . ' VALUES (:collection_id, :title, :category, :type, :amount, :description)',
                    array(':collection_id' => $post['collection_id'], ':title' => $post['transactionName'], ':category' => $post['transactionCategory'], ':type' => $post['transactionType'],
                        ':amount' => -$amount, ':description' => $post['transactionDescription']));
                header("Location: ../../transactions/index.php");
                return;
            } elseif ($post['transactionDate'] == '' && $post['transactionType'] == 'income') {
                Database::query(DB_INSERT_TRANSACTION_1 . ' VALUES (:collection_id, :title, :category, :type, :amount, :description)',
                    array(':collection_id' => $post['collection_id'], ':title' => $post['transactionName'], ':category' => $post['transactionCategory'], ':type' => $post['transactionType'],
                        ':amount' => $amount, ':description' => $post['transactionDescription']));
                header("Location: ../../transactions/index.php");
                return;
            } elseif ($post['transactionDate'] != '' && $post['transactionType'] == 'income') {
                Database::query(DB_INSERT_TRANSACTION_0 . ' VALUES (:collection_id, :title, :category, :type, :date, :amount, :description)',
                    array(':collection_id' => $post['collection_id'], ':title' => $post['transactionName'], ':category' => $post['transactionCategory'], ':type' => $post['transactionType'],
                        ':date'=> $post['transactionDate'], ':amount' => $amount, ':description' => $post['transactionDescription']));
                header("Location: ../../transactions/index.php");
                return;
            } elseif ($post['transactionDate'] != '' && $post['transactionType'] == 'expense') {
                Database::query(DB_INSERT_TRANSACTION_0 . ' VALUES (:collection_id, :title, :category, :type, :date, :amount, :description)',
                    array(':collection_id' => $post['collection_id'], ':title' => $post['transactionName'], ':category' => $post['transactionCategory'], ':type' => $post['transactionType'],
                        ':date'=> $post['transactionDate'], ':amount' => -$amount, ':description' => $post['transactionDescription']));
                header("Location: ../../transactions/index.php");
                return;
            }
        }
    }

    public static function export(){


        $user_id=Auth::isLoggedIn()['id'];
        $user_name=Auth::isLoggedIn()['user_name'];


        if (isset($_POST['exportJSON'])){

            $items=Database::query('SELECT t.title, t.category, t.type, t.date, CONCAT(t.amount," ",c.currency) AS `amount`
 FROM `collections` c join `transactions` t on c.collection_id=t.collection_id WHERE c.collection_id= :collection_id AND c.user_id = :user_id order by date desc ',
                array(':user_id'=> $user_id, ':collection_id' => $_POST['collection_id']));

            $file = 'C:\xampp\htdocs\trex\cache\\' . $user_name . $user_id .'export.json';
            file_put_contents($file, json_encode($items,JSON_PRETTY_PRINT));
            header("Content-type: application/json");
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Content-Length: ' . filesize($file));
            readfile($file);
        } else if (isset($_POST['exportCSV'])){

            $items=Database::query('SELECT t.title, t.category, t.type, t.date, CONCAT(t.amount," ",c.currency) AS `amount`
 FROM `collections` c join `transactions` t on c.collection_id=t.collection_id WHERE c.collection_id= :collection_id AND c.user_id = :user_id order by date desc ',
                array(':user_id'=> $user_id, ':collection_id' => $_POST['collection_id']));

            $file = 'C:\xampp\htdocs\trex\cache\\' . $user_name . $user_id .'export.csv';
            $output = fopen("$file",'w');
            fputcsv($output,array('title','category','type','date','amount'));
            foreach ($items as $item){
                fputcsv($output,$item);
            }
            header("Content-type: application/csv");
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Content-Length: ' . filesize($file));
            readfile($file);
        }
    }

    public static function showTable(){


    }
}