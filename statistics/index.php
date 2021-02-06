<?php
define("TITLE", "statistics");
include_once('C:\xampp\htdocs\trex\app\templates\header.php');
include_once('C:\xampp\htdocs\trex\app\includes\statistics.inc.php');
include_once('C:\xampp\htdocs\trex\app\includes\show-collections.inc.php');
include_once('C:\xampp\htdocs\trex\app\includes\show-years.inc.php');

//Prevents access to statistics page if user is NOT logged in
if(!Auth::isLoggedIn()) {
    header("Location: ../user/login.php");
    exit();
}
?>
<br>
<script src="/trex/library/Chart.js/utils.js"></script>
<script src="/trex/library/Chart.js/Chart.js"></script>

<?php //echo $_SERVER['PHP_SELF'] . '?year='?>

    <div class="container">
<form>
    <select title="select collection" name="selectCollection" onchange="goToColStatisticsURL(this.value)">
        <option></option>
        <option value="" disabled selected style="display:none;">Change collection</option>
        <?php foreach ($col_items as $col_item)  :?>
            <option value="<?php echo $col_item['collection_id'] ?>"><?php echo $col_item['name'] . " - " . $col_item['Currency'];?></option>
        <?php endforeach;?>
    </select>
</form>

<form>
    <select name="selectTransactionsRange" onchange="goToYearURL(this.value)">
        <option value="" disabled selected style="display:none;">Year</option>
        <?php foreach ($year_items as $year_item) : ?>
        <option value="<?php echo $year_item['date']?>"><?php echo $year_item['date']?></option>
        <?php endforeach;?>
    </select>
</form>
    </div>

<section>
    <div id="statisticsBar">
        <canvas id="canva"></canvas>
    </div>
</section>

<?php // foreach ($items as $item) echo $item['amount'] ; endforeach; ?>

<!--
<button id="randomizeData">Randomize Data</button>
<button id="addDataset">Add Dataset</button>
<button id="removeDataset">Remove Dataset</button>
<button id="addData">Add Data</button>
<button id="removeData">Remove Data</button>
-->
<script>
    let MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    let color = Chart.helpers.color;
    let barChartData = {
        labels: [ <?php foreach ($incomeItems as $item) :
            echo "'" . $item['date'] . "',"  ?>
            <?php endforeach; ?>
        ],

        datasets: [{
            label: 'Expense',
            backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
            borderColor: window.chartColors.red,
            borderWidth: 1,
            data: [
                <?php foreach ($expenseItems as $item) :?>
                <?php echo $item['amount'] . ',' ?>
                <?php endforeach; ?>

            ]
        },
            {
                label: 'Income',
                backgroundColor: color(window.chartColors.green).alpha(0.5).rgbString(),
                borderColor: window.chartColors.green,
                borderWidth: 1,
                data: [
                    <?php foreach ($incomeItems as $item) :?>
                    <?php echo $item['amount'] . ',' ?>
                    <?php endforeach; ?>
                ]
            }
        ]

    };

    window.onload = function() {
        var ctx = document.getElementById('canva').getContext('2d');
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Chart.js Bar Chart'
                }
            }
        });

    };

    document.getElementById('randomizeData').addEventListener('click', function() {
        var zero = Math.random() < 0.2 ? true : false;
        barChartData.datasets.forEach(function(dataset) {
            dataset.data = dataset.data.map(function() {
                return zero ? 0.0 : randomScalingFactor();
            });

        });
        window.myBar.update();
    });

    var colorNames = Object.keys(window.chartColors);
    document.getElementById('addDataset').addEventListener('click', function() {
        var colorName = colorNames[barChartData.datasets.length % colorNames.length];
        var dsColor = window.chartColors[colorName];
        var newDataset = {
            label: 'Dataset ' + barChartData.datasets.length,
            backgroundColor: color(dsColor).alpha(0.5).rgbString(),
            borderColor: dsColor,
            borderWidth: 1,
            data: []
        };

        for (var index = 0; index < barChartData.labels.length; ++index) {
            newDataset.data.push(randomScalingFactor());
        }

        barChartData.datasets.push(newDataset);
        window.myBar.update();
    });

    document.getElementById('addData').addEventListener('click', function() {
        if (barChartData.datasets.length > 0) {
            var month = MONTHS[barChartData.labels.length % MONTHS.length];
            barChartData.labels.push(month);

            for (var index = 0; index < barChartData.datasets.length; ++index) {
                // window.myBar.addData(randomScalingFactor(), index);
                barChartData.datasets[index].data.push(randomScalingFactor());
            }

            window.myBar.update();
        }
    });

    document.getElementById('removeDataset').addEventListener('click', function() {
        barChartData.datasets.splice(0, 1);
        window.myBar.update();
    });

    document.getElementById('removeData').addEventListener('click', function() {
        barChartData.labels.splice(-1, 1); // remove the label first

        barChartData.datasets.forEach(function(dataset) {
            dataset.data.pop();
        });

        window.myBar.update();
    });
</script>


<?php
include('C:\xampp\htdocs\trex\app\templates\footer.php');
?>