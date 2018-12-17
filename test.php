<?php
include_once "system/gestionDatos.php";

$gd = gestionDatos::getInstance();

$gd->obtenerDatosGraficos($lbl, $vls, $id_reproduciones);

$etiquetas = "['".implode("','", $lbl)."']";
$valores = "[".implode(",", $vls)."]";

print_r($lbl);
echo "<br>";
print_r($vls);
echo "<br>--------------------------------<br>";
echo $etiquetas."<br>";
echo $valores."<br>";
print_r($id_reproduciones);

/*<html>
<head>
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.0.2.js"></script>
    <script type="text/javascript" src="js/charts/Chart.js"></script>
    <script type="text/javascript">
        var data = [
            {
                value: 300,
                color:"#F7464A",
                highlight: "#FF5A5E",
                label: "Red"
            },
            {
                value: 50,
                color: "#46BFBD",
                highlight: "#5AD3D1",
                label: "Green"
            },
            {
                value: 100,
                color: "#FDB45C",
                highlight: "#FFC870",
                label: "Yellow"
            }
        ];

        $(document).ready(
            function () {
                var ctx = document.getElementById("myChart").getContext("2d");
                var myNewChart = new Chart(ctx).Pie(data);

                $("#myChart").click(
                    function(evt){
                        var activePoints = myNewChart.getSegmentsAtEvent(evt);
                        var url = "http://example.com/?label=" + activePoints[0].label + "&value=" + activePoints[0].value;
                        alert(url);
                    }
                );
            }
        );
    </script>
</head>
<body>
<canvas id="myChart" width="400" height="400"></canvas>
</body>
</html>*/