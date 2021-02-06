<?php
define("TITLE", "Register");
include('../app/templates/header.php');

//Prevents access to register page if user is already logged in
if(Auth::isLoggedIn()){
    header("Location: profile.php");
    exit();
}
?>
<br>
<div class="contentRegister">
    <div class="form">
        <form class="login-form" action="../app/includes/register.inc.php" method="post">
            <input type="text" name="username" placeholder="Username"/>
            <input type="text" name="email" placeholder="Email"/>
            <input type="password" name="pwd" placeholder="Password"/>
            <input type="text" name="security_q" placeholder="Security question"/>
            <input type="password" name="secret_a" placeholder="Secret answer"/>
            <button type="submit" name="register">Create</button>
            <p class="message">Already registered? <a href="login.php">Sign In</a></p>
        </form>
  </div>
</div>

<?php include('../app/templates/footer.php'); ?>
