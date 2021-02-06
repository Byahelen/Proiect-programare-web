<?php
define("TITLE", "Login");
include_once('../app/templates/header.php');

//Prevents access to login page if user is already logged in
if(Auth::isLoggedIn()){
    header("Location: profile.php");
}
?>
    <br>
<div class="contentLogin">
  <div class="form">
    <form class="login-form" action="../app/includes/login.inc.php" method="post">
        <input type="text" name="username" placeholder="Username"/>
        <input type="password" name="pwd" placeholder="Password"/>
        <button type="submit" name="login">login</button>
        <p class="message">Not registered? <a href="register.php">Create an account</a></p>
        <p class="message"><a href="forgot.php">Forgot password?</a></p>
    </form>
  </div>
</div>

<?php include('../app/templates/footer.php'); ?>