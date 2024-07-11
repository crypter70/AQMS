<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PolluFree</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    @include('components.navbar')
    <section class="container mt-3">
        <div class="row equal-height">
            <!-- ISPU Score Section -->
            <div class="col-md-8">
                <section class="ispu-score" style="background-image: url('images/BG-ispu.png');">
                    <div>
                        <h2 class="section-title-ispu mt-3">ISPU Score
                            <i class="fa-solid fa-circle-info" title="This is the ISPU (Indeks Standar Pencemaran Udara) Score which indicates the level of air pollution. 
                            1-50    = Good
                            51-100  = Moderate
                            101-200 = Unhealthy 
                            201-300 = Very Unhealthy 
                            ≥ 301   = Hazardous
                            "></i>
                        </h2>
                        <p class="card-text mb-0"><i class="fa-solid fa-location-dot"></i>
                            <select id="location" onchange="selectLocation(this)" class="transparent-background">
                                <option value="1" href="#">{{ $device['0']['name'] }}</option>
                                <option value="2" href="#">{{ $device['1']['name'] }}</option>
                                <option value="3" href="#">{{ $device['2']['name'] }}</option>
                            </select>
                        </p>
                        <p class="card-text"><i class="fa-solid fa-calendar-days"></i> <span id="date-time"></span></p>
                    </div>
                    <div class="card-container mt-3">
                        <div class="card" id="pm25-ispu-card">
                            <h3>PM2.5</h3>
                            <h2 id="pm25-ispu-value">{{ round($ispu['pm25']) }}</h2>
                            <p id="pm25-category">{{ $ispu['category_pm25'] }}</p>
                        </div>
                        <div class="card" id="pm10-ispu-card">
                            <h3>PM10</h3>
                            <h2 id="pm10-ispu-value">{{ round($ispu['pm10']) }}</h2>
                            <p id="pm10-category">{{ $ispu['category_pm10'] }}</p>
                        </div>
                        <div class="card" id="co-ispu-card">
                            <h3>CO</h3>
                            <h2 id="co-ispu-value">{{ round($ispu['co']) }}</h2>
                            <p id="co-category">{{ $ispu['category_co'] }}</p>
                        </div>
                    </div>
                </section>
            </div>

            <!-- AVG ISPU Score Section -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <h5 class="card-title-ispu-score">Avg ISPU Score</h5>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    PM2.5
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#" data-chart="pm25">PM2.5</a></li>
                                    <li><a class="dropdown-item" href="#" data-chart="pm10">PM10</a></li>
                                    <li><a class="dropdown-item" href="#" data-chart="co">CO</a></li>
                                </ul>
                            </div>
                        </div>
                        <canvas id="chartCanvas" width="auto" height="auto"></canvas>
                        <p class="card-text">July</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container mt-5">
        <h4 class="section-title-out">Today's Highlights</h4>
        <div class="row">
            <!-- PM1.0 -->
            <div class="col-lg-3 mt-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <a class="pm1-icon" href="#">
                            <img src="images/PM1.png" class="mb-3" height="30" alt="">
                        </a>
                        <h5 class="card-title">PM1.0</h5>
                        <p class="card-text"><span id="pm1-value">{{ $data['pm_1_0_level'] }}</span> µg/m³</p>
                    </div>
                </div>
            </div>
            <!-- PM2.5 -->
            <div class="col-lg-3 mt-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <a class="pm25-icon" href="#">
                            <img src="images/PM25.png" class="mb-3" height="30" alt="">
                        </a>
                        <h5 class="card-title">PM2.5</h5>
                        <p class="card-text"><span id="pm25-value">{{ $data['pm_2_5_level'] }}</span> µg/m³</p>
                    </div>
                </div>
            </div>
            <!-- PM10 -->
            <div class="col-lg-3 mt-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <a class="pm10-icon" href="#">
                            <img src="images/PM10.png" class="mb-3" height="30" alt="">
                        </a>
                        <h5 class="card-title">PM10</h5>
                        <p class="card-text"><span id="pm10-value">{{ $data['pm_10_0_level'] }}</span> µg/m³</p>
                    </div>
                </div>
            </div>
            <!-- CO -->
            <div class="col-lg-3 mt-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <a class="co-icon" href="#">
                            <img src="images/CO.png" class="mb-3" height="30" alt="">
                        </a>
                        <h5 class="card-title">CO</h5>
                        <p class="card-text"><span id="co-value">{{ $data['co_level'] }}</span> µg/m³</p>
                    </div>
                </div>
            </div>
            <!-- Suhu -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <a class="temperature-icon" href="#">
                            <img src="images/temp1.png" class="mb-3" height="30" alt="">
                        </a>
                        <h5 class="card-title">Temperature</h5>
                        <p class="card-text"><span id="temperature-value">{{ $data['dht22_temperature'] }}</span> °C</p>
                    </div>
                </div>
            </div>
            <!-- Kelembaban -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <a class="humidity-icon" href="#">
                            <img src="images/humidity1.png" class="mb-3" height="30" alt="">
                        </a>
                        <h5 class="card-title">Humidity</h5>
                        <p class="card-text"><span id="humidity-value">{{ $data['dht22_humidity'] }}</span>%</p>
                    </div>
                </div>
            </div>
            <!-- Tekanan Udara -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <a class="pressure-icon" href="#">
                            <img src="images/pressure1.png" class="mb-3" height="30" alt="">
                        </a>
                        <h5 class="card-title">Pressure</h5>
                        <p class="card-text"><span id="pressure-value">{{ $data['bme280_pressure'] }}</span> hPa</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container mt-5 mb-5">
        <h4 class="section-title-out mt-4 mb-4">Air Quality Forecast</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <canvas id="airQualityForecastChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://js.pusher.com/3.1/pusher.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('chartCanvas').getContext('2d');
            const ctxForecast = document.getElementById('airQualityForecastChart').getContext('2d');

            // Real-time display
            function updateDateTime() {
                const dateTimeElement = document.getElementById('date-time');
                const now = new Date();
                const formattedDateTime = now.toLocaleString();
                dateTimeElement.textContent = formattedDateTime;
            }

            setInterval(updateDateTime, 1000);
            updateDateTime();

            // Inisialisasi chart pertama (Bar chart)
            let chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    datasets: [{
                        label: 'PM2.5',
                        data: [10, 60, 80, 75, 66, 32, 20],
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Fungsi untuk memperbarui data chart
            function updateChart(chart, type) {
                const dataSets = {
                    pm25: [10, 60, 80, 75, 66, 32, 20],
                    pm10: [10, 50, 20, 15, 40, 52, 10],
                    co: [10, 20, 30, 25, 35, 45, 40],
                };

                chart.data.datasets[0].data = dataSets[type];
                chart.data.datasets[0].label = type.toUpperCase();
                chart.update();
            }

            // Event listener untuk dropdown
            document.querySelectorAll('.dropdown-item').forEach(item => {
                item.addEventListener('click', function(event) {
                    event.preventDefault();
                    const chartType = this.dataset.chart;
                    updateChart(chart, chartType);
                    document.querySelector('.dropdown-toggle').textContent = this.textContent;
                });
            });

            // Inisialisasi chart kedua (Line chart untuk forecast)
            let airQualityForecastChart = new Chart(ctxForecast, {
                type: 'line',
                data: {
                    labels: Array.from({length: 24}, (v, i) => `${i}:00`),
                    datasets: [{
                        label: 'PM2.5',
                        data: [30, 35, 32, 33, 36, 38, 37, 40, 42, 41, 43, 45, 47, 50, 52, 55, 53, 57, 60, 62, 65, 67, 68, 70],
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        fill: true
                    }, {
                        label: 'PM10',
                        data: [40, 45, 42, 44, 47, 49, 48, 50, 53, 55, 57, 60, 62, 65, 67, 70, 72, 74, 75, 78, 80, 82, 85, 87],
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        fill: true
                    }, {
                        label: 'CO',
                        data: [10, 12, 11, 13, 14, 15, 16, 17, 19, 18, 20, 21, 23, 25, 24, 26, 27, 28, 30, 31, 33, 32, 34, 35],
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                        }
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    },
                    scales: {
                        x: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Hours'
                            }
                        },
                        y: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Air Quality Index'
                            }
                        }
                    }
                }
            });

        });

        var currentLoc = 1;

        function selectLocation(selected) {
            var token = $("meta[name='csrf-token']").attr("content");
            var value = selected.value;
            $.ajax({
                type: 'GET',
                url: 'api/telemetry/get/' + value,
                data: {
                    'location': value,
                    '_token': token
                },
                beforeSend: function() {
                    console.log("Post data.");
                }
            }).done(function(response) {
                document.getElementById("pm1-value").innerHTML = response["data"]["pm_1_0_level"];
                document.getElementById("pm25-value").innerHTML = response["data"]["pm_2_5_level"];
                document.getElementById("pm10-value").innerHTML = response["data"]["pm_10_0_level"];
                document.getElementById("co-value").innerHTML = response["data"]["co_level"];
                document.getElementById("temperature-value").innerHTML = response["data"]["dht22_temperature"];
                document.getElementById("humidity-value").innerHTML = response["data"]["dht22_humidity"];
                document.getElementById("pressure-value").innerHTML = response["data"]["bme280_pressure"];

                document.getElementById("pm25-ispu-value").innerHTML = Math.round(response["ispu"]["pm25"]);
                document.getElementById("pm10-ispu-value").innerHTML = Math.round(response["ispu"]["pm10"]);
                document.getElementById("co-ispu-value").innerHTML = Math.round(response["ispu"]["co"]);

                document.getElementById("pm25-category").innerHTML = response["ispu"]["category_pm25"];
                document.getElementById("pm10-category").innerHTML = response["ispu"]["category_pm10"];
                document.getElementById("co-category").innerHTML = response["ispu"]["category_co"];

                currentLoc = value;
            }).fail(function(response) {
                console.log("Not sent: " + response);
            });
        }
    </script>
    <script>
        Pusher.logToConsole = true;
        var pusher = new Pusher('{{ env("PUSHER_APP_KEY") }}', {
            cluster: '{{ env("PUSHER_APP_CLUSTER") }}'
        });

        var channel = pusher.subscribe('telemetry');
        channel.bind("App\\Events\\TelemetryEvent", function(data) {
            if (data.telemetry.id_device == currentLoc) {
                document.getElementById("pm1-value").innerHTML = data.telemetry.pm_1_0_level;
                document.getElementById("pm25-value").innerHTML = data.telemetry.pm_2_5_level;
                document.getElementById("pm10-value").innerHTML = data.telemetry.pm_10_0_level;
                document.getElementById("co-value").innerHTML = data.telemetry.co_level;
                document.getElementById("temperature-value").innerHTML = data.telemetry.dht22_temperature;
                document.getElementById("humidity-value").innerHTML = data.telemetry.dht22_humidity;
                document.getElementById("pressure-value").innerHTML = data.telemetry.bme280_pressure;

                /* document.getElementById("pm25-ispu-value").innerHTML = Math.round(response["ispu"]["pm25"]);
                document.getElementById("pm10-ispu-value").innerHTML = Math.round(response["ispu"]["pm10"]);
                document.getElementById("co-ispu-value").innerHTML = Math.round(response["ispu"]["co"]);

                document.getElementById("pm25-category").innerHTML = response["ispu"]["category_pm25"];
                document.getElementById("pm10-category").innerHTML = response["ispu"]["category_pm10"];
                document.getElementById("co-category").innerHTML = response["ispu"]["category_co"]; */
            }

            console.log("Device: " + data.telemetry.id_device);
        });
    </script>

    
</body>

</html>