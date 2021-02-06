<?php
define("TITLE", "transactions");
include_once('C:\xampp\htdocs\trex\app\templates\header.php');
include_once('C:\xampp\htdocs\trex\app\includes\show-table.php');
include_once('C:\xampp\htdocs\trex\app\includes\show-collections.inc.php');


//Prevents access to transactions page if user is NOT logged in
if(!Auth::isLoggedIn()) {
    header("Location: ../user/login.php");
    exit();
}
?>

<?php //var_dump($items) ?>

<section id="month-chooser">
    <div class="container">

        <ul>
            <li>  <a href="add.php">
                    <button class="atbutton"> <span>Add transaction </span></button>

                </a>
            </li>
            <li>  <a href="export.php">
                    <button class="atbutton"> <span>Export </span></button>
                </a>
            </li>
            <li><h3>Budget: <?php echo $budget; ?> (this month)</h3></li>
        </ul>
    </div>
</section>



<form>
    <div class="container">
        <select title="select collection" name="selectCollection" onchange="goToColURL(this.value)">
            <option></option>
            <option value="" disabled selected style="display:none;">Change collection</option>
                <?php foreach ($col_items as $col_item)  :?>
                    <option value="<?php echo $col_item['collection_id'] ?>"><?php echo $col_item['name'] . " - " . $col_item['Currency'];?></option>
                <?php endforeach;?>
        </select>
    </div>
</form>

<form>
    <div class="container">
        <select name="selectTransactionsRange" onchange="<?php ?>goToTimeURL(this.value)">
            <option value="" disabled selected style="display:none;">Transactions from</option>
            <option value="1">Today</option>
            <option value="7">Last 7 days</option>
            <option value="30">Last Month</option>
            <option value="365">This Year</option>
            <option value="all_time">All Time</option>
        </select>
    </div>
</form>

<!--
<div class="container">
    <div id = "transactionsTable"><h4>Loading...</h4></div>
</div>
-->

<section id="transactions">
    <div class="container">
        <table id = "transactions" class="table-fill">
            <thead>
            <tr>
                <th onclick="sortTable(0)" class="text-left" scope="col">Title</th>
                <th onclick="sortTable(1)" class="text-left" scope="col">Category</th>
                <th onclick="sortTable(2)" class="text-left" scope="col">Type</th>
                <th onclick="sortTable(3)" class="text-left" scope="col">Date</th>
                <th onclick="sortTable(4)" class="text-left" scope="col">Amount</th>
                <th class="text-left" scope="col">Notes</th>
            </tr>
            </thead>
            <tbody class="table-hover">


            <?php foreach ($items as $item) : ?>
                <?php if($item['type'] == 'expense') :?>
                    <tr>
                        <td class="text-left" scope="row"><?php echo $item['title'] ?></td>
                        <td class="text-left"><?php echo $item['category'] ?></td>
                        <td class="text-left"><?php echo $item['type'] ?></td>
                        <td class="text-left"><?php echo $item['date'] ?></td>
                        <td class="text-left expense"><?php echo $item['amount'] ?></td>
                        <td class="text-left"><?php echo $item['description'] ?></td>
                    </tr>
                <?php else : ?>
                    <tr>
                        <td class="text-left" scope="row"><?php echo $item['title'] ?></td>
                        <td class="text-left"><?php echo $item['category'] ?></td>
                        <td class="text-left"><?php echo $item['type'] ?></td>
                        <td class="text-left"><?php echo $item['date'] ?></td>
                        <td class="text-left income"><?php echo $item['amount'] ?></td>
                        <td class="text-left"><?php echo $item['description'] ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
            </tbody>
        </table>
            <?php
            $prev = $startrow - 10;

            //only print a "Previous" link if a "Next" was clicked
            if ($prev >= 0){
                echo '<a class="previous" href="'.$_SERVER['PHP_SELF'].'?col_id='.$_GET['col_id'] . '&time='. $time .'&startrow='.$prev.'">Previous</a>';
            }
            echo '<a class="next" href="'.$_SERVER['PHP_SELF'].'?col_id='.$col_id . '&time='. $time . '&startrow='.($startrow+10).'">Next</a>';

            ?>

    </div>
</section>


<?php
include_once('C:\xampp\htdocs\trex\app\templates\footer.php');
?>

