<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PolluFree</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" rel="stylesheet" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="style/style.css" rel="stylesheet">
</head>

<body>
    @include('components.navbar')
    <div class="container mt-3 mb-5">
        <div id="map" style="height: 800px; width: 100%;"></div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            mbUrl =
            'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZXJpcHJhdGFtYSIsImEiOiJjbGZubmdib3UwbnRxM3Bya3M1NGE4OHRsIn0.oxYqbBbaBwx0dHLguu5gOA';

        // Membuat beberapa layer untuk tampilan map: satelitte, dark mode, street.
        satellite = L.tileLayer(mbUrl, {
            id: 'mapbox/satellite-v9',
            tileSize: 512,
            zoomOffset: -1,
            attribution: mbAttr
        }),

        dark = L.tileLayer(mbUrl, {
            id: 'mapbox/dark-v10',
            tileSize: 512,
            zoomOffset: -1,
            attribution: mbAttr
        }),

        streets = L.tileLayer(mbUrl, {
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            attribution: mbAttr
        }),

        google_streets = L.tileLayer('http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            minZoom: 4,
            noWrap: true,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }),

        google_hybrid = L.tileLayer('http://{s}.google.com/vt?lyrs=s,h&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            minZoom: 4,
            noWrap: true,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }),

        google_satellite = L.tileLayer('http://{s}.google.com/vt?lyrs=s&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            minZoom: 4,
            noWrap: true,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }),

        google_terrain = L.tileLayer('http://{s}.google.com/vt?lyrs=p&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            minZoom: 4,
            noWrap: true,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        });

        var baseLayers = {
            "Grayscale": dark,
            "Satellite": satellite,
            "Streets": streets,
            "Google Streets": google_streets,
            "Google Hybrid": google_hybrid,
            "Google Satellite": google_satellite,
            "Google Terrain": google_terrain,
        };

        var overlays = {
            "Streets": streets,
            "Grayscale": dark,
            "Satellite": satellite,
            "Google Streets": google_streets,
            "Google Hybrid": google_hybrid,
            "Google Satellite": google_satellite,
            "Google Terrain": google_terrain,
        };

        var map = L.map('map').setView([-6.920378544188283, 107.60651489414], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        L.control.layers(baseLayers, overlays).addTo(map);
        map.attributionControl.setPrefix(false);

        var data = [
            @foreach ($devices as $device)
            {
                "id": "{{ $device['id'] }}",
                "name": "{{ $device['name'] }}",
                "lat": "{{ $device['latitude'] }}",
                "lng": "{{ $device['longitude'] }}",
                
                "pm25": "{{ $ispu[$device['id']]['pm25'] }}",
                "pm10": "{{ $ispu[$device['id']]['pm10'] }}",
                "co": "{{ $ispu[$device['id']]['co'] }}",

                "category_pm25": "{{ $ispu[$device['id']]['category_pm25'] }}",
                "category_pm10": "{{ $ispu[$device['id']]['category_pm10'] }}",
                "category_co": "{{ $ispu[$device['id']]['category_co'] }}",
                "category_highest": "{{ $ispu[$device['id']]['highest'] }}"
            },
            @endforeach
        ];
        
        var spot = []; 
        data.forEach(function (item) {
            let color;
            switch (item.category_highest) {
                case 'Good':
                    color = 'green'
                    break;
                case 'Moderate':
                    color = 'blue'
                    break;
                case 'Unhealthy':
                    color = 'yellow'
                    break;
                case 'Very Unhealthy':
                    color = 'red'
                    break;
                case 'Hazardous':
                    color = 'black'
                    break;
                default:
                    break;
            }

            spot[item.id] = L.circle([item.lat, item.lng], {
                color: color,
                fillColor: color,
                fillOpacity: 0.5,
                radius: 250
            }).addTo(map).bindPopup(
                "<div class='my-2'><strong>Location: </strong>" + item.name + "<br></div>" +
                "<div class='my-2'><strong>Latitude: </strong>" + item.lat + "<br></div>" +
                "<div class='my-2'><strong>Longitude: </strong>" + item.lng + "<br></div>" +
                "<hr/>" +
                "<div class='my-2 text-center'><strong>ISPU</strong><br></div>" +
                "<div class='my-2'><strong>PM2.5: </strong>" + item.pm25 + "<br></div>" +
                "<div class='my-2'><strong>PM10: </strong>" + item.pm10 + "<br></div>" +
                "<div class='my-2'><strong>CO: </strong>" + item.co + "<br></div>" +
                "<div class='my-2'><strong>Status: </strong><span style='color:" + color + "';>" + item.category_highest + "<br></span></div>"
            );
        });
    </script>
</body>

</html>