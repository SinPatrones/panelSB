<?php
$lat = $_GET['lat'];
$lng = $_GET['lng'];
?>
<div style="width: 100%; height: 450px">
    <div id="map"></div>
    <script>
        var map;
        var marker;
        var pos;
        function initMap() {
            document.getElementById("latitud").value = pos.lat;
            document.getElementById("longitud").value = pos.lng;

            pos = {lat: <?php echo $lat; ?>, lng: <?php echo $lng; ?>};

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
