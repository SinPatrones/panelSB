<div style="width: 100%; height: 450px">
    <div id="map"></div>
    <script>
        var map;
        var marker;
        var pos;
        function initMap() {
            if(navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    pos = {lat: position.coords.latitude, lng: position.coords.longitude};
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

                }, function(notPosition){
                    pos = {lat: -16.398999, lng: -71.536503};
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
                });
                /*
                map.addListener('rightclick',function(){
                    marker.setMap(null);
                    marker = null;
                });*/

            }else{
                alert("Su navegador no soporta geolocalización");
            }
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDyn8SmflpFXcyV89QKfgdnW03wwytrJTM&callback=initMap"
            async defer></script>
</div>