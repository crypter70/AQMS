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
        <div class="row">
            <!-- ISPU Score Section -->
            <div class="col-md-8">
                <section class="ispu-score" style="background-image: url('images/BG-ispu.png');">
                    <div>
                        <h2 class="section-title-ispu mt-3">ISPU Score
                            <i class="fa-solid fa-circle-info" title="This is the ISPU (Indeks Standar Pencemaran Udara) Score which indicates the level of air pollution. 
                            1-50    = Good
                            51-100  = Moderate
                            101-200 = Unhealthy for Sensitive Groups
                            201-300 = Unhealthy for All
                            ≥ 301   = Hazardous
                            "></i>
                        </h2>
                        <p class="card-text mb-0"><i class="fa-solid fa-location-dot"></i>
                            <select id="location" onchange="selectLocation()" class="transparent-background">
                                <option value="Gegerkalong Girang" href="#">FPTK UPI, Setiabudi</option>
                                <option value="KRU House" href="#">KRU House, Buah Batu</option>
                                <option value="Masjid Al Muslim" href="#">Masjid Al Muslim, Cibeunying</option>
                            </select>
                        </p>
                        <p class="card-text"><i class="fa-solid fa-calendar-days"></i> <span id="date-time">{{ $data['time_captured'] }}</spa></p>
                    </div>
                    <div class="card-container mt-3">
                        <div class="card" id="pm25-ispu-card">
                            <h3>PM2.5</h3>
                            <h2 id="pm25-ispu-value">200</h2>
                            <p id="pm25-category"></p>
                        </div>
                        <div class="card" id="pm10-ispu-card">
                            <h3>PM10</h3>
                            <h2 id="pm10-ispu-value">96</h2>
                            <p id="pm10-category"></p>
                        </div>
                        <div class="card" id="co-ispu-card">
                            <h3>CO</h3>
                            <h2 id="co-ispu-value">20</h2>
                            <p id="co-category"></p>
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
                                    <li><a class="dropdown-item" href="#" data-chart="pm2.5">PM2.5</a></li>
                                    <li><a class="dropdown-item" href="#" data-chart="pm10">PM10</a></li>
                                    <li><a class="dropdown-item" href="#" data-chart="co">CO</a></li>
                                </ul>
                            </div>
                        </div>
                        <canvas id="chartCanvas" width="400" height="200"></canvas>
                        <p class="card-text">June</p>
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
                        <p class="card-text"><span id="co-value">{{ $data['co_level'] }}</span> ppm</p>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('chartCanvas').getContext('2d');
            const ctxForecast = document.getElementById('airQualityForecastChart').getContext('2d');

            // Fungsi untuk memperbarui kategori berdasarkan nilai ISPU
            function getCategory(value, type) {
                if (type === 'PM2.5' || type === 'PM10') {
                    if (value >= 1 && value <= 50) {
                        return 'Good';
                    } else if (value >= 51 && value <= 100) {
                        return 'Moderate';
                    } else if (value >= 101 && value <= 200) {
                        return 'Unhealthy';
                    } else if (value >= 201 && value <= 300) {
                        return 'Unhealthy for All';
                    } else if (value > 300) {
                        return 'Hazardous';
                    }
                } else if (type === 'CO') {
                    if (value >= 1 && value <= 50) {
                        return 'Good';
                    } else if (value >= 51 && value <= 100) {
                        return 'Moderate';
                    } else if (value >= 101 && value <= 150) {
                        return 'Unhealthy';
                    } else if (value >= 151 && value <= 200) {
                        return 'Very Unhealthy';
                    } else if (value > 200) {
                        return 'Hazardous';
                    }
                }
                return 'Invalid';
            }

            function updateCategory(elementId, value, type) {
                const categoryElement = document.getElementById(elementId);
                const category = getCategory(value, type);
                categoryElement.textContent = category;
            }

            // Inisialisasi chart pertama (Bar chart)
            let chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['W1', 'W2', 'W3', 'W4'],
                    datasets: [{
                        label: 'PM2.5',
                        data: [10, 60, 80, 75],
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
                    pm25: [10, 60, 80, 75],
                    pm10: [10, 58, 70, 45],
                    co: [5, 20, 30, 44],
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

            // Perbarui kategori ISPU berdasarkan nilai
            const pm25Value = parseInt(document.getElementById('pm25-ispu-value').textContent);
            const pm10Value = parseInt(document.getElementById('pm10-ispu-value').textContent);
            const coValue = parseInt(document.getElementById('co-ispu-value').textContent);

            updateCategory('pm25-category', pm25Value, 'PM2.5');
            updateCategory('pm10-category', pm10Value, 'PM10');
            updateCategory('co-category', coValue, 'CO');

            // Inisialisasi chart kedua (Line chart untuk forecast)
            let airQualityForecastChart = new Chart(ctxForecast, {
                type: 'line',
                data: {
                    labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                    datasets: [{
                        label: 'PM2.5',
                        data: [30, 50, 70, 60, 80, 100, 90],
                        borderColor: 'rgba(255, 99, 132, 1)',
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        fill: true
                    }, {
                        label: 'PM10',
                        data: [40, 60, 80, 70, 90, 110, 100],
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        fill: true
                    }, {
                        label: 'CO',
                        data: [10, 20, 30, 25, 35, 45, 40],
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
                                text: 'Days'
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
    </script>

</body>

</html>