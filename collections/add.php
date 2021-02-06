<?php
define("TITLE", "add collection");
include_once('C:\xampp\htdocs\trex\app\templates\header.php');

//Prevents access to transactions page if user is NOT logged in
if(!Auth::isLoggedIn()) {
    header("Location: login.php");
    exit();
}
?>


<section id="add_transaction">
    <div class="container">
        <form action="/trex/app/includes/add-collection.inc.php" method="post">
            <div class="row">
                <div class="col-25">
                    <label for="tname">Collection title</label>
                </div>
                <div class="col-75">
                    <input type="text" id="tname" name="collectionName" placeholder="Name">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="tgroup">Currency</label>
                </div>
                <div class="col-75">
                    <select name="currency">
                        <optgroup label="Choose">
                            <option value="RON">RON</option>
                            <option value="EUR">EUR</option>
                            <option value="USD">USD</option>
                            <option value="YEN">YEN</option>
                        </optgroup>
                    </select>
                </div>
            </div>
            <div class="row">
                <input type="submit" name="add" value="Add">
            </div>
        </form>
        <form action="/trex/collections/index.php">
            <input type="submit" name="cancel" value="Cancel">
        </form>
    </div>
</section>




<?php
include('C:\xampp\htdocs\trex\app\templates\footer.php');
?>

