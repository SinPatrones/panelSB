<?php
    include_once "page/start.php";
    include_once "system/Anuncios.php";
    $editMode = false;

    $anuncios = Anuncios::getInstance();
    $datosAnuncio = null;

    if (isset($_POST['id'])){
        $editMode = true;
        $datosAnuncio = $anuncios->obtenerDatosAnuncio($_POST['id']);
        $datosAnuncio = mysqli_fetch_array($datosAnuncio);
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
    <!-- TextToSpeech JS
		============================================ -->
    <script src='https://code.responsivevoice.org/responsivevoice.js'></script>
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
                            <ul id="myTabedu1" class="tab-review-design">
                                <li class="active"><a href="#description">Detalles de Anuncio</a></li>
                                <p> <br> <br>Para crear un anuncio, deberá especificar el alcance que tendrá, el punto de referencia en el mapa y el contenido, el cual es el audio que se emitira.</p>
                                <p>No olvide que pude crearlo y tenerlo inactivo aun el anuncio para lanzarlo cuando vea conveniente. La palabra clave es una etiqueta breve que describira el anuncio, que sea usado para mostrar en los gráficos.</p>
                                <input onclick='responsiveVoice.speak("Para crear un anuncio, deberá especificar el alcance que tendrá, el punto de referencia en el mapa y el contenido, el cual es el audio que se emitira. No olvide que pude crearlo y tenerlo inactivo aun el anuncio para lanzarlo cuando vea conveniente.", "Spanish Female", {pitch: 1});' type='button' value='🔊 Leer Indicaciones' />

                            </ul>
                            <div id="myTabContent" class="tab-content custom-product-edit">
                                <div class="product-tab-list tab-pane fade active in" id="description">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="review-content-section">
                                                <div id="dropzone1" class="pro-ad addcoursepro">
                                                    <form <?php if ($editMode) echo "action='page/updateAd.php'"; else echo "action=\"page/insertAd.php\""; ?> class="dropzone dropzone-custom needsclick addcourse" id="demo1-upload" method="post">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <input name="fullname" type="text" class="form-control" value="USUARIO: <?php echo $_SESSION["user"]["fullname"]; ?>" readonly="readonly">
                                                                </div>
                                                                <label for="scope">Alcance: </label>
                                                                <select name="scope" id="scope" class="form-control" data-placeholder="Seleccione">
                                                                    <option disabled>Seleccione Prioridad</option>
                                                                    <option value="1" <?php if ($datosAnuncio['tipo_alcance'] == 1) echo "selected";?> >Local</option>
                                                                    <option value="2" <?php if ($datosAnuncio['tipo_alcance'] == 2) echo "selected";?> >Distrital</option>
                                                                    <option value="3" <?php if ($datosAnuncio['tipo_alcance'] == 3) echo "selected";?> >Regional</option>
                                                                </select>
                                                                <br>
                                                                <label for="status">Estado: </label>
                                                                <select name="status" id="status" class="form-control">
                                                                    <option value="0" <?php if ($datosAnuncio['estado'] == 0) echo "selected";?>>Inactivo</option>
                                                                    <option value="1" <?php if ($datosAnuncio['estado'] == 1) echo "selected";?>>Activo</option>
                                                                </select>
                                                                <br>
                                                                <div align="center">
                                                                    <h4>Arrastre el marcador a su negocio en el mapa</h4>
                                                                </div>
                                                                <br>
                                                                <div align="center">
                                                                    <label for="latitud">Latitud:</label>
                                                                    <input type="text" id="latitud" name="latitud">
                                                                    <label for="longitud">Longitud:</label>
                                                                    <input type="text" id="longitud" name="longitud">
                                                                </div>
                                                                <br>
                                                                <!--<iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=Socabaya&key=AIzaSyDyn8SmflpFXcyV89QKfgdnW03wwytrJTM" allowfullscreen></iframe>
                                                                <br>-->
                                                                <?php
                                                                if ($editMode){?>
                                                                    <div style="width: 100%; height: 450px">
                                                                        <div id="map"></div>
                                                                        <script>
                                                                            var map;
                                                                            var marker;
                                                                            var pos;
                                                                            function initMap() {
                                                                                pos = {lat: <?php echo $datosAnuncio['pos_latitud'] ?>, lng: <?php echo $datosAnuncio['pos_longitud']; ?>};

                                                                                document.getElementById("latitud").value = pos.lat;
                                                                                document.getElementById("longitud").value = pos.lng;

                                                                                map = new google.maps.Map(document.getElementById('map'), {
                                                                                    center: pos,
                                                                                    zoom: 17
                                                                                });
                                                                                marker = new google.maps.Marker({
                                                                                    position: pos,
                                                                                    map: map,
                                                                                    draggable:true,
                                                                                    title: "Arrastrame a tu negocio!!"
                                                                                });

                                                                                map.addListener('center_changed', function() {
                                                                                    // 3 seconds after the center of the map has changed, pan back to the
                                                                                    // marker.
                                                                                    window.setTimeout(function() {
                                                                                        map.panTo(marker.getPosition());
                                                                                    }, 10000);
                                                                                });
                                                                                map.addListener('click', function() {
                                                                                    marker = new google.maps.Marker({
                                                                                        position: aqp,
                                                                                        map: map,
                                                                                        draggable:true,
                                                                                        title: "Arrastrame!!"
                                                                                    });
                                                                                    map.setZoom(17);
                                                                                    map.setCenter(marker.getPosition());
                                                                                });
                                                                                google.maps.event.addListener(marker,'dragend',function(event) {
                                                                                    document.getElementById("latitud").value = this.getPosition().lat();
                                                                                    document.getElementById("longitud").value = this.getPosition().lng();
                                                                                    map.panTo(marker.getPosition());
                                                                                });
                                                                            }
                                                                        </script>
                                                                        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDyn8SmflpFXcyV89QKfgdnW03wwytrJTM&callback=initMap"
                                                                        async defer></script>
                                                                    </div>
                                                                <?php
                                                                }else{
                                                                    include_once "includes/showPosition.php";
                                                                }
                                                                ?>
                                                                ?>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <input onclick='testad();' type='button' value='🔊 Probar' />
                                                                <div class="form-group">
                                                                    <textarea id="content" name="content" placeholder="Escriba el Anuncio que será reporducido.
Ejemplo. (Bienvenidos. Estas viajando en un bus inteligente con SmartBas. Disfuta del viaje.)" required><?php if ($editMode) echo $datosAnuncio['contenido'];  ?></textarea>
                                                                </div>

                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label for="PalabraClave">Palabra Clave:</label>
                                                                    <input id="PalabraClave" name="keyword" minlength="7" maxlength="20" <?php if($editMode) echo "value=\"".$datosAnuncio['palabra_clave']."\""; ?> required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <hr>
                                                                <div class="payment-adress">
                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light" <?php if($editMode) echo "name=\"id_anuncio\" value=\"".$datosAnuncio['id_anuncio']."\""; ?> ><?php if($editMode) echo "Modificar Anuncio"; else echo "Crear Anuncio"; ?></button>
                                                                    <a class="btn btn-info" href="ad-active.php">REGRESAR A LISTA</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
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

<script>
    if(responsiveVoice.voiceSupport()) {
        responsiveVoice.speak("<?php if($editMode) echo "Editando anuncio"; else echo "Creando un anuncio para SmartBas."; ?>", "Spanish Female");
    }
    function testad(){
        var text = document.getElementById("content").value;
        if(text=="") responsiveVoice.speak("Porfavor ingrese el contenido del anuncio primero.", "Spanish Female");
        else responsiveVoice.speak(text, "Spanish Female");
    }
</script>

</body>

</html>