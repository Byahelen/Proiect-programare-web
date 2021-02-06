<?php
define("TITLE", "add transaction");
include_once('C:\xampp\htdocs\trex\app\templates\header.php');
include_once ('C:\xampp\htdocs\trex\app\includes\show-collections.inc.php');

//Prevents access to transactions page if user is NOT logged in
if(!Auth::isLoggedIn()) {
    header("Location: login.php");
    exit();
}
?>


<section id="add_transaction">
    <div class="container">
        <form method="post" action="../app/includes/add-transaction.inc.php">
            <div class="row">
                <div class="col-25">
                    <label for="ttype">Collection</label>
                </div>
                <div class="col-75">
                    <select id="ttype" name="collection_id">
                        <?php foreach ($col_items as $col_item)  :?>
                        <option value="<?php echo $col_item['collection_id'] ?>"><?php echo $col_item['name']?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="tname">Transaction title</label>
                </div>
                <div class="col-75">
                    <input type="text" id="tname" name="transactionName" placeholder="Transaction title...">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="tgroup">Group</label>
                </div>
                <div class="col-75">
                    <input type="text" id="tgroup" name="transactionCategory" placeholder="Gifts, invoices...">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="ttype">Transaction type</label>
                </div>
                <div class="col-75">
                    <select id="ttype" name="transactionType">
                        <option value="expense">Expense</option>
                        <option value="income">Income</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="tdate">Date</label>
                </div>
                <div class="col-75">
                    <input type="text" id="tdate" name="transactionDate" placeholder="YYYY-MM-DD (Optional)">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="tdate">Amount</label>
                </div>
                <div class="col-75">
                    <input type="text" id="tdate" name="transactionAmount" placeholder="100,200..">
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="subject">Transaction details</label>
                </div>
                <div class="col-75">
                    <textarea id="subject" name="transactionDescription" placeholder="Optional.." style="height:200px"></textarea>
                </div>
            </div>
            <div class="row">
                <input type="submit" name ="add" value="Add">
            </div>
        </form>
        <form action="index.php">
            <input type="submit" name = "cancel" value="Cancel">
        </form>
    </div>
</section>




<?php
include_once('C:\xampp\htdocs\trex\app\templates\footer.php');
?>

