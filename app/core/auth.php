<?php
include_once ('C:\xampp\htdocs\trex\app\core\database.php');
class Auth{
    public static function isLoggedIn() {

        if (isset($_COOKIE['TREX_ID'])) {
            if (Database::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['TREX_ID'])))) {
                $u_uid = array();
                $u_uid['id'] = Database::querySingle('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['TREX_ID'])))['user_id'];
                $u_uid['user_name'] = Database::querySingle('SELECT username FROM users WHERE user_id=:user_id', array(':user_id'=>$u_uid['id']))['username'];
                $u_uid['user_email'] = Database::querySingle('SELECT email FROM users WHERE user_id=:user_id', array(':user_id'=>$u_uid['id']))['email'];
                if (isset($_COOKIE['TREX_ID_V'])) {
                    return $u_uid;
                } else {
                    $cstrong = True;
                    $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                    Database::query('INSERT INTO login_tokens VALUES (\'\', :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$u_uid['id']));
                    Database::query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['TREX_ID'])));

                    setcookie("TREX_ID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
                    setcookie("TREX_ID_V", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);

                    return $u_uid;
                }
            }
        }

        return false;
    }
}
