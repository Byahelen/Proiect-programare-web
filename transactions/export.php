<?php
define("TITLE", "add transaction");
include_once('C:\xampp\htdocs\trex\app\templates\header.php');
include_once('C:\xampp\htdocs\trex\app\includes\show-collections.inc.php');



//Prevents access to transactions page if user is NOT logged in
if(!Auth::isLoggedIn()) {
    header("Location: login.php");
    exit();
}
?>

<section id="export_transactions">
    <div class="container">
        <form method="post" action="/trex/app/includes/export.inc.php">
            <select id="ttype" name="collection_id">
                <?php foreach ($col_items as $col_item)  :?>
                    <option value="<?php echo $col_item['collection_id'] ?>"><?php echo $col_item['name']?></option>
                <?php endforeach;?>
            </select>
            <input type="submit" class="edbutton" name ="exportJSON" value="exportJSON">
            <input type="submit" class="edbutton" name ="exportCSV" value="exportCSV">
    </div>
</section>

<?php
include_once('C:\xampp\htdocs\trex\app\templates\footer.php');
?>

