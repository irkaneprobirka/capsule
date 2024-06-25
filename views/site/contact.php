<?php

function datasets_make_regression($coef, $data_size, $noise_sigma, $random_state) {
    $x = range(0, $data_size - 1);
    $mu = 0.0;
    srand($random_state);
    
    $noise = array();
    $y = array();
    
    for ($i = 0; $i < $data_size; $i++) {
        $noise[$i] = gauss($mu, $noise_sigma);
        $y[$i] = $coef[0] + $coef[1] * $x[$i] + $noise[$i];
    }
    
    return array($x, $y);
}

function gauss($mu, $sigma) {
    // Используем метод Box-Muller для генерации нормального распределения
    $u1 = (float)rand() / (float)getrandmax();
    $u2 = (float)rand() / (float)getrandmax();
    $rand_std_normal = sqrt(-2.0 * log($u1)) * sin(2.0 * M_PI * $u2);
    return $mu + $sigma * $rand_std_normal;
}

$coef_true = array(34.2, 2.0); // весовые коэффициенты
$data_size = 200; // размер генерируемого набора данных
$noise_sigma = 10; // СКО шума в данных
$random_state = 42;

list($x_scale, $y_estimate) = datasets_make_regression($coef_true, $data_size, $noise_sigma, $random_state);

// Отображение графика с использованием встроенного HTML и JavaScript (через Google Charts)
?>

<!DOCTYPE html>
<html>
<head>
    <title>Regression Plot</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('number', 'X');
            data.addColumn('number', 'Y');

            <?php
            echo "data.addRows([";
            for ($i = 0; $i < $data_size; $i++) {
                echo "[$x_scale[$i], $y_estimate[$i]]";
                if ($i < $data_size - 1) echo ",";
            }
            echo "]);";
            ?>

            var options = {
                title: 'Regression Data',
                hAxis: {title: 'x (порядковый номер измерения)', minValue: 0, maxValue: <?php echo $data_size; ?>},
                vAxis: {title: 'y (оценка температуры)', minValue: Math.min.apply(null, <?php echo json_encode($y_estimate); ?>), maxValue: Math.max.apply(null, <?php echo json_encode($y_estimate); ?>)},
                legend: 'none'
            };

            var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
</body>
</html>