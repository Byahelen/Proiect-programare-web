<?php
include_once ('C:\xampp\htdocs\trex\app\core\auth.php');
class Collections{
    public static function add(){
        //SANITIZE POST aka Removing any illegal character from the input data
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $user_id= Auth::isLoggedIn()['id'];


        if($_POST['add']) {
            if ($post['collectionName'] == '') {
                header("Location: ../../user/index.php?add_col=failed");
                return;
            } else if (Database::query('SELECT * from COLLECTIONS where user_id = :user_id AND name = :name' , array(':user_id'=>$user_id, ':name'=>$post['collectionName']))){
                header("Location: ../../user/index.php?add_col=failed");
                return;
            } else {
                //Insert into MySQL database
                Database::query('INSERT INTO COLLECTIONS(name, Currency, user_id) VALUES (:name, :currency, :user_id)', array(':name' => $post['collectionName'], ':currency' => $post['currency'], 'user_id'=>$user_id));
                header("Location: ../../user/index.php?add_col=success");
            }
        }
    }

    public static function delete(){
        if(isset($_POST['delete'])){
            Database::querySingle('DELETE FROM COLLECTIONS WHERE collection_id= :collection_id', array(':collection_id'=>$_POST['collection_id']) );
            header("Location: ../../user/index.php?del_col=success");
        }
    }
}