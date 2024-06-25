<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PolluFree</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    @include('components.navbar')
    <div class="container mt-3 mb-5">
        <div id="map" style="height: 800px; width: 100%;"></div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('AIzaSyCYIS_w6_3nx6Hg1uxMTDKm_M92qCqkCSQ') }}&callback=initMap" async defer></script>
    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 10,
                center: {
                    lat: -6.864124298095703,
                    lng: 107.59412384033203
                }
            });

            var markers = [{
                    lat: -6.864124298095703,
                    lng: 107.59412384033203,
                    count: 200, // ispu score nanti diisi dr nilai konversi
                   
                },
                {
                    lat: -6.887461233889979,
                    lng: 107.62825738820264,
                    count: 96,
                 
                },
                {
                    lat: -6.944840590703077, 
                    lng: 107.62355432423948,
                    count: 79,
                
                }
            ];

            markers.forEach(function(markerData) {
                var marker = new google.maps.Marker({
                    position: {
                        lat: markerData.lat,
                        lng: markerData.lng
                    },
                    map: map,
                    label: markerData.count.toString()
                });

                var circle = new google.maps.Circle({
                    map: map,
                    radius: markerData.count * 10, 
                    fillColor: '#00f',
                    fillOpacity: 0.2,
                    strokeColor: '#00f',
                    strokeOpacity: 0.5
                });
                circle.bindTo('center', marker, 'position');
            });
        }
    </script>
</body>

</html>