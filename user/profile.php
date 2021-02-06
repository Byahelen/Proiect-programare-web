<?php
define("TITLE", "Profile");
include('../app/templates/header.php');
include_once ('C:\xampp\htdocs\trex\app\core\collections.php');
include_once ('C:\xampp\htdocs\trex\app\includes\show-collections.inc.php');

//Prevents access to account/user-profile page if user is NOT logged in
if(!Auth::isLoggedIn()) {
    header("Location: login.php");
    exit();
}
?>
<br>

<div class="container">
    <div id="notification"></div>
    <div class="form">
        <img src="../assets/images/profile-picture_generic-user.png" alt="user" class="imgResize">
        <h2>Name: <?php echo Auth::isLoggedIn()['user_name']; ?></h2>
        <h2>Email: <?php echo Auth::isLoggedIn()['user_email']; ?></h2>
        <a href="#">
            <button class="edbutton" style="vertical-align:middle"> <span>Edit account </span></button>
        </a>
        <br>
        <label>Wallet collection</label>
        <form class="login-form" action="/trex/collections/add.php">
            <h3></h3>
            <label>Add collection</label>
            <input type="submit" value="Add">
        </form>

        <label>Delete collection</label>
        <form method="post" action="/trex/app/includes/delete-collection.inc.php">
            <select id="ttype" name="collection_id">
                <?php foreach ($col_items as $col_item)  :?>
                    <option value="<?php echo $col_item['collection_id'] ?>"><?php echo $col_item['name']?></option>
                <?php endforeach;?>
                <input type="submit" value="Delete" name="delete">
            </select>
        </form>


        <form action="../app/includes/logout.inc.php" method="post">
            <button class="atbutton" type="submit" name="logout" value="Logout"> Logout</button>
        </form>
    </div>
</div>



<script>document.getElementById("notification").innerHTML = findGetParameter('add_col');</script>

<div class="container">

</div>


<?php
include('../app/templates/footer.php');
?>

