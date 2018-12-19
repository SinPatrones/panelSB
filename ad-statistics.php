<?php
include_once "page/start.php";
include_once "system/Anuncios.php";
include_once "system/gestionDatos.php";

$gestiondatos = gestionDatos::getInstance();

$anuncios = Anuncios::getInstance();
$allData = $anuncios->obtenerInfoAnuncios($_SESSION['user']['id'], $count);
$anuncios->obtenerAnunciosPorEstado($_SESSION['user']['id'], "1", $AnunciosActivos);
$anuncios->obtenerAnunciosPorEstado($_SESSION['user']['id'], "0", $AnunciosInactivos);

if ($gestiondatos->obtenerDatosGraficos($_SESSION['user']['id'], $etiquetas, $valores, $id_reproduciones)){
    $etiquetas = "['".implode("','", $etiquetas)."']";
    $valores = "[".implode(",", $valores)."]";
}
?>
<!doctype html>
<html class="no-js" lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>UNSA | SmartBus</title>
    <meta name="description" content="unsa Smartbus">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/icono.png">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="css/owl.transitions.css">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="css/animate.css">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- meanmenu icon CSS
		============================================ -->
    <link rel="stylesheet" href="css/meanmenu.min.css">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="css/main.css">
    <!-- educate icon CSS
		============================================ -->
    <link rel="stylesheet" href="css/educate-custon-icon.css">
    <!-- morrisjs CSS
		============================================ -->
    <link rel="stylesheet" href="css/morrisjs/morris.css">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="css/scrollbar/jquery.mCustomScrollbar.min.css">
    <!-- metisMenu CSS
		============================================ -->
    <link rel="stylesheet" href="css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="css/metisMenu/metisMenu-vertical.css">
    <!-- calendar CSS
		============================================ -->
    <link rel="stylesheet" href="css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="css/calendar/fullcalendar.print.min.css">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="style.css">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Theme UNSA SmartBus
		============================================ -->
    <link rel="stylesheet" href="css/smartbus.css">
    <!-- modernizr JS
		============================================ -->
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>

</head>

<body>
<!--[if lt IE 8]>
<p class="browserupgrade">Estas usando un navegador <strong>antiguo</strong> . Por favor <a href="http://browsehappy.com/">actualiza tu navegador</a> para tener una mejor experiencia.</p>
<![endif]-->
<!-- Start Left menu area -->
<?php include_once 'includes/lef-sidebar.php'; ?>
<!-- End Left menu area -->
<!-- Start Welcome area -->
<div class="all-content-wrapper">
    <?php include_once 'includes/logo.php'; ?>
    <?php include_once 'includes/nav.php'; ?>
    <div class="single-pro-review-area mt-t-30 mg-b-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-payment-inner-st">
                        <div id="myTabContent" class="tab-content custom-product-edit">
                            <div class="product-tab-list tab-pane fade active in" id="description">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="review-content-section">
                                            <div id="dropzone1" class="pro-ad addcoursepro">
                                                <h2 align="center">DATOS GENERADOS DE ANUNCIOS</h2>
                                                <div align="center">
                                                    <div class="row">
                                                        <div class="col-md-12 col-lg-6">
                                                            <label for="activos">Avisos Activos: </label>
                                                            <input id="activos" value="<?php if ($AnunciosActivos > 0) echo $AnunciosActivos; else echo "0";?>" disabled>
                                                        </div>
                                                        <div class="col-md-12 col-lg-6">
                                                            <label for="inactivos">Avisos Inactivos: </label>
                                                            <input id="inactivos" value="<?php if ($AnunciosInactivos > 0) echo $AnunciosInactivos; else echo "0";?>" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <table class="table table-striped table-striped">
                                                    <thead>
                                                        <tr>
                                                            <td align="center" >Palabra Clave</td>
                                                            <td align="center" >Contenido Anuncio</td>
                                                            <td align="center">Estado</td>
                                                            <td align="center">Fecha de Creación</td>
                                                            <td align="center">Tipo de Alcance</td>
                                                            <td align="center">Reproducciones</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            while($row = mysqli_fetch_array($allData)){
                                                                echo "<tr>";
                                                                echo "<td align=\"center\" >".$row['palabra_clave']."</td>";
                                                                echo "<td align=\"center\" >".$row['contenido']."</td>";
                                                                if ($row['estado']=="1")
                                                                    echo "<td align=\"center\" >Activo</td>";
                                                                else
                                                                    echo "<td align=\"center\" >Inactivo</td>";
                                                                echo "<td align=\"center\" >".$row['fecha_creacion']."</td>";
                                                                echo "<td align=\"center\" >".$row['tipo_alcance']."</td>";
                                                                if (isset($id_reproduciones[$row['id_anuncio']])){
                                                                    echo "<td align='center'>".$id_reproduciones[$row['id_anuncio']]."</td>";
                                                                }else{
                                                                    echo "<td align='center'>0</td>";
                                                                }
                                                                echo "</tr>";
                                                            }
                                                        ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td align="center" >Palabra Clave</td>
                                                            <td align="center" >Contenido Anuncio</td>
                                                            <td align="center">Estado</td>
                                                            <td align="center">Fecha de Creación</td>
                                                            <td align="center">Tipo de Alcance</td>
                                                            <td align="center">Reproducciones</td>
                                                        </tr>
                                                    </tfoot>
                                                </table>

                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="charts-single-pro mg-tb-30 responsive-mg-b-0">
                                                            <div class="alert-title">
                                                                <h2>Cantidad de Reproducciones</h2>
                                                                <p>En la siguiente grafica podremos ver la cantidad de veces que fueron reproducidos sus anuncions en las unidades móviles.</p>
                                                            </div>

                                                            <div id="stepped-chart">
                                                                <canvas id="linechartstepped"></canvas>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'includes/footer.php'; ?>
</div>

<!-- jquery
		============================================ -->
<script src="js/vendor/jquery-1.12.4.min.js"></script>
<!-- bootstrap JS
    ============================================ -->
<script src="js/bootstrap.min.js"></script>
<!-- wow JS
    ============================================ -->
<script src="js/wow.min.js"></script>
<!-- price-slider JS
    ============================================ -->
<script src="js/jquery-price-slider.js"></script>
<!-- meanmenu JS
    ============================================ -->
<script src="js/jquery.meanmenu.js"></script>
<!-- owl.carousel JS
    ============================================ -->
<script src="js/owl.carousel.min.js"></script>
<!-- sticky JS
    ============================================ -->
<script src="js/jquery.sticky.js"></script>
<!-- scrollUp JS
    ============================================ -->
<script src="js/jquery.scrollUp.min.js"></script>
<!-- mCustomScrollbar JS
    ============================================ -->
<script src="js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="js/scrollbar/mCustomScrollbar-active.js"></script>
<!-- metisMenu JS
    ============================================ -->
<script src="js/metisMenu/metisMenu.min.js"></script>
<script src="js/metisMenu/metisMenu-active.js"></script>
<!-- Charts JS
    ============================================ -->
<script src="js/charts/Chart.js"></script>
<script src="js/charts/line-chart.js"></script>
<!-- tab JS
    ============================================ -->
<script src="js/tab.js"></script>
<!-- plugins JS
    ============================================ -->
<script src="js/plugins.js"></script>
<!-- main JS
    ============================================ -->
<script src="js/main.js"></script>
<!-- tawk chat JS
    ============================================ -->
<script src="js/tawk-chat.js"></script>


<script type="application/javascript" language="JavaScript">
    var linechartstepped = null;
    function aleatorio(a,b) {
        return Math.round(Math.random()*(b-a)+parseInt(a));
    }

    function getPropertyNames(obj) {
        var proto = Object.getPrototypeOf(obj);
        return (
            (typeof proto === 'object' && proto !== null ? getPropertyNames(proto) : [])
                .concat(Object.getOwnPropertyNames(obj))
                .filter(function(item, pos, result) { return result.indexOf(item) === pos; })
                .sort()
        );
    }

    (function ($) {
        "use strict";
        var ctx = document.getElementById("linechartstepped");
        linechartstepped = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo $etiquetas; ?>,//l_labels,//['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 3', 'Day 4', 'Day 5', 'Day 6'],
                datasets: [{
                    label: "Reproducciones",
                    fill: false,
                    backgroundColor: '#f00600',
                    borderColor: '#006DF0',
                    data: <?php echo $valores; ?> //l_values //[3, 0, 0, -3, 9, 12, 19, 0, 0, -3, 9, 12, 19, 5, 10, -30, 9, 12, 19, 0, 0, -3, 9, 12, 19, 0, 0, -3, 9, 12, 19, 0, 0, -3, 9, 12, 19]
                }]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text:'Anuncios',
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            autoSkip: true,
                            maxRotation: 0
                        },
                        ticks: {
                            fontColor: "#fff", // this here
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            autoSkip: false,
                            maxRotation: 0
                        },
                        ticks: {
                            fontColor: "#fff", // this here
                        }
                    }]
                }/*
                'onClick':function (evt, item) {
                    var punto = linechartstepped.getElementsAtEvent(evt);
                    alert(punto[0].value);
                }*/
            }
        });
    })(jQuery);
</script>

</body>

</html>