<?php
define("TITLE", "Reset password");
include('..\app\templates\header.php');

?>


<div class="contentRegister">
    <div class="form">
    <form class="login-form">
      <input type="text" placeholder="Security question"/>
      <input type="text" placeholder="Secret answer"/>
	  <input type="password" placeholder="New password"/>
      <button>Reset</button>
    </form>
</div>
</div>

<?php include('..\app\templates\footer.php'); ?>

