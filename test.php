<!doctype html>
<html lang="es">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <title>Hello, world!</title>

    <script type="application/javascript" language="JavaScript">
        function seleccion() {
            var lista = document.getElementById("productList");
            var indice = lista.selectedIndex;
            var descripcion = document.getElementById("descripcion");
            //alert(indice);
            descripcion.innerHTML = lista.options[indice].text;
        }

        function texto() {
            var palabra = document.getElementById("producto").value;
            //alert(palabra);
            $.ajax({
                type: "POST",
                url: "obtenerProductos.php",
                data:{
                    "words" : palabra
                },
                success: function(data){
                    $("#productList").html(data);
                },
                error: function(jqXHR, textStatus, errorThrown){
                    //if(textStatus === 'timeout'){alert('Failed from timeout');}
                    if (jqXHR.status === 0) {alert('Not connect: Verify Network: ' + textStatus);}
                    else if (jqXHR.status == 404) {alert('Requested page not found [404]');}
                    else if (jqXHR.status == 500) {alert('Internal Server Error [500].');}
                    else if (textStatus === 'parsererror') {alert('Requested JSON parse failed.');}
                    else if (textStatus === 'timeout') {alert('Time out error.');}
                    else if (textStatus === 'abort') {alert('Ajax request aborted.');}
                    else {alert('Uncaught Error: ' + jqXHR.responseText);}
                },
            });
        }
    </script>
</head>
<body>
    <div class="container">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label for="ejemplo_email_3" class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="producto" placeholder="producto" onkeyup="return texto();">
                        </div>
                    </div>
                    <div class="form-group">
                        <label id="descripcion" class="col-lg-2 form-label" readonly>...</label>
                    </div>
                    <div class="form-group">
                        <label for="productList" class="col-lg-2 control-label">Lista</label>
                        <div class="col-lg-10">
                            <select class="form-control" size="6" id="productList" onchange="seleccion();">
                                <option value="1">AQP</option>
                                <option value="2">Cuzqueña</option>
                                <option value="3">Pilse</option>
                                <option value="5">Brahma</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button type="submit" class="btn btn-default">Entrar</button>
                        </div>
                    </div>
                </form>

    </div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>