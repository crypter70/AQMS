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
</head>

<body>
    <style>
      


    </style>
    @include('components.navbar')
    <section class="container mt-5">
        <div class="row">
            <!-- ISPU Score Section -->
            <div class="col-lg-8">
    <section class="custom-section">
        <div>
            <h2 class="section-title">ISPU Score</h2>
        </div>
        <div class="card-container">
            <div class="card">
                <h3>PM2.5</h3>
                <p>Penjelasan tentang skor parameter ISPU untuk PM2.5.</p>
            </div>
            <div class="card">
                <h3>PM10</h3>
                <p>Penjelasan tentang skor parameter ISPU untuk PM10.</p>
            </div>
            <div class="card">
                <h3>CO</h3>
                <p>Penjelasan tentang skor parameter ISPU untuk CO.</p>
            </div>
        </div>
    </section>
</div>

            <!-- Card Section -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Avg ISPU Score</h5>
                        <canvas id="pm25Chart" width="400" height="200"></canvas>
                        <p class="card-text">Bandung</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container mt-5">
        <h4 class="section-title-out">Today's Highlights</h4>
        <div class="row">
            <!-- PM1.0 -->
            <div class="col-lg-4 mt-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">PM1.0</h5>
                        <p class="card-text"><span id="pm1-value">{{ $data['pm_1_0_level'] }}</span> µg/m³</p>
                    </div>
                </div>
            </div>
            <!-- PM2.5 -->
            <div class="col-lg-4 mt-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">PM2.5</h5>
                        <p class="card-text"><span id="pm25-value">{{ $data['pm_2_5_level'] }}</span> µg/m³</p>
                    </div>
                </div>
            </div>
            <!-- PM10 -->
            <div class="col-lg-4 mt-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">PM10</h5>
                        <p class="card-text"><span id="pm10-value">{{ $data['pm_10_0_level'] }}</span> µg/m³</p>
                    </div>
                </div>
            </div>
            <!-- CO -->
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">CO</h5>
                        <p class="card-text"><span id="co-value">{{ $data['co_level'] }}</span> ppm</p>
                    </div>
                </div>
            </div>
            <!-- Suhu -->
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Suhu</h5>
                        <p class="card-text"><span id="temperature-value">{{ $data['dht22_temperature'] }}</span> °C</p>
                    </div>
                </div>
            </div>
            <!-- Kelembaban -->
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Kelembaban</h5>
                        <p class="card-text"><span id="humidity-value">{{ $data['dht22_humidity'] }}</span>%</p>
                    </div>
                </div>
            </div>
            <!-- Tekanan Udara -->
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tekanan Udara</h5>
                        <p class="card-text"><span id="pressure-value">{{ $data['bme280_pressure'] }}</span>hPa</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container mt-5">
    <h4 class="section-title-out mt-4">Air Quality Forecast</h4>
        <div class="row">
            <!-- Prediction -->
            <div class="col-lg-12">
                <section class="custom-section">
                    <div>
                        <h2 class="section-title">ISPU Score</h2>

                    </div>
                </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    var ctx = document.getElementById('pm25Chart').getContext('2d');
    var pm25Chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                label: 'PM2.5 Levels',
                data: [12, 19, 3, 5, 2, 3, 7, 22, 56, 88, 12, 22],
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
</script>

@stack('scripts')
</body>

</html>