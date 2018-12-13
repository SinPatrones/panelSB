<?php
    include_once "page/start.php";
    include_once "system/Anuncios.php";
    $anuncios = Anuncios::getInstance();
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
        <div class="courses-area">
            <div class="container-fluid">
                <div align="center">
                    <h2>Lista de Anuncios creados</h2>
                </div>

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <td align="center">Id Anuncio</td>
                            <td align="center">Contenido</td>
                            <td align="center">Estado</td>
                            <td align="center">Alcance</td>
                            <td align="center">Fecha de creación</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </thead>

                    <?php
                        $ListaDeAnuncios = $anuncios->obtenerInfoAnuncios($_SESSION["user"]["id"]);
                        while ($row = mysqli_fetch_array($ListaDeAnuncios)){
                            echo "<tr>";
                                echo "<td align='center'>".$row['id_anuncio']."</td>";
                                echo "<td align='center'>".$row['contenido']."</td>";
                                if ($row['estado'] == "0"){
                                    echo "<td align='center'>Inactivo</td>";
                                }else{
                                    echo "<td align='center'>Activo</td>";
                                }
                                switch ($row['tipo_alcance']){
                                    case "1":
                                        echo "<td align='center'>Local</td>";
                                        break;
                                    case "2";
                                        echo "<td align='center'>Distrital</td>";
                                        break;
                                    case "3";
                                        echo "<td align='center'>Regional</td>";
                                        break;
                                }
                                echo "<td align='center'>".$row['fecha_creacion']."</td>";
                                echo "<td align='center'><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#myModal' onclick='alert(\"Hola\");'>VER</button> </td>";
                                echo "<td align='center'><a class='btn btn-info' href=''>EDITAR</a> </td>";
                                echo "<td align='center'><a class='btn btn-danger' href=''>BORRAR</a> </td>";
                            echo "</tr>";
                        }
                    ?>

                    <tfoot>
                        <tr>
                            <td align="center">Id Anuncio</td>
                            <td align="center">Contenido</td>
                            <td align="center">Estado</td>
                            <td align="center">Alcance</td>
                            <td align="center">Fecha de creación</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>

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
    <!-- counterup JS
		============================================ -->
    <script src="js/counterup/jquery.counterup.min.js"></script>
    <script src="js/counterup/waypoints.min.js"></script>
    <script src="js/counterup/counterup-active.js"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/scrollbar/mCustomScrollbar-active.js"></script>
    <!-- metisMenu JS
		============================================ -->
    <script src="js/metisMenu/metisMenu.min.js"></script>
    <script src="js/metisMenu/metisMenu-active.js"></script>
    <!-- morrisjs JS
		============================================ -->
    <script src="js/morrisjs/raphael-min.js"></script>
    <script src="js/morrisjs/morris.js"></script>
    <script src="js/morrisjs/morris-active.js"></script>
    <!-- morrisjs JS
		============================================ -->
    <script src="js/sparkline/jquery.sparkline.min.js"></script>
    <script src="js/sparkline/jquery.charts-sparkline.js"></script>
    <script src="js/sparkline/sparkline-active.js"></script>



    <script src="js/calendar/moment.min.js"></script>
    <script src="js/calendar/fullcalendar.min.js"></script>
    <script src="js/calendar/fullcalendar-active.js"></script>
    <!-- plugins JS
		============================================ -->
    <script src="js/plugins.js"></script>
    <!-- main JS
		============================================ -->
    <script src="js/main.js"></script>

</body>

</html>