<?php
include_once 'C:\xampp\htdocs\trex\app\core\auth.php';
class User{
    public static function login(){
        session_start();

//Checking if the submit button is pressed
        if (isset($_POST['login'])) {

            $username = $_POST['username'];
            $password = $_POST['pwd'];

            if (Database::query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))) {

                if (password_verify($password, Database::querySingle('SELECT hashed_password FROM users WHERE username=:username', array(':username'=>$username))['hashed_password'])) {
                    echo 'Logged in!';
                    $cstrong = True;
                    $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                    $user_id = Database::querySingle('SELECT user_id FROM users WHERE username=:username', array(':username'=>$username))['user_id'];
                    Database::query('INSERT INTO login_tokens(token,user_id) VALUES (:token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));

                    setcookie("TREX_ID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
                    setcookie("TREX_ID_V", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
                    header("Location: ../../user/profile.php?login=success");
                } else {
                    header("Location: ../../user/login.php?login=incorrect_pwd");
                }

            } else {
                header("Location: ../../user/login.php?login=incorrect_usr");
            }


            //If the submit button is NOT pressed go here
        } else {
            header("Location: ../../index.php?login=error");
            exit();
        }
    }

    public static function logout(){
        if (isset($_POST['logout'])) {
            if (isset($_COOKIE['TREX_ID'])) {
                Database::query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['TREX_ID'])));
            }
            setcookie('TREX_ID', '1', time()-3600);
            setcookie('TREX_ID_V', '1', time()-3600);

            header("Location: ../../index.php?logout=success");
            exit();
        }
    }

    public static function register(){
        if (isset($_POST['register'])) {

            $username = $_POST['username'];
            $password = $_POST['pwd'];
            $email = $_POST['email'];

            if (!Database::query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))) {
                //Error handlers
                //Check for username length
                if (strlen($username) >= 3 && strlen($username) <= 32) {
                    //Regular expression check for valid characters
                    if (preg_match('/[a-zA-Z0-9_]+/', $username)) {
                        //Check for password length
                        if (strlen($password) >= 6 && strlen($password) <= 64) {
                            //Email validation
                            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                //Email duplicates verification
                                if (!Database::query('SELECT email FROM users WHERE email=:email', array(':email'=>$email))) {

                                    Database::query('INSERT INTO users VALUES (\'\', :username, :password, :email)', array(':username'=>$username, ':password'=>password_hash($password, PASSWORD_BCRYPT), ':email'=>$email));
                                    header("Location: ../../user/login.php?register=success");
                                } else {
                                    header("Location: ../../user/register.php?register=duplicate_email");
                                }
                            } else {
                                header("Location: ../../user/register.php?register=email_error");
                            }
                        } else {
                            header("Location: ../../user/register.php?register=pwd_length_error");
                        }
                    } else {
                        header("Location: ../../user/register.php?register=login_invalid_chars");
                    }
                } else {
                    header("Location: ../../user/register.php?register=usr_length_error");
                }

            } else {
                header("Location: ../../user/register.php?register=duplicate_usr");
            }

        } else {
            header("Location: ../../user/register.php");
            exit();
        }
    }

    public static function resetPassword(){

    }

}