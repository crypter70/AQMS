<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PolluFree</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    @include('components.navbar')

    <section class="container mt-5">
        <div class="row">
            <!-- USPU Score Section -->
            <div class="col-lg-8">
                <section class="custom-section">
                    <div>
                        <h2 class="section-title">ISPU Score</h2>
                        
                    </div>
                </section>
            </div>
            <!-- Card Section -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Avg ISPU Score</h5>
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
            <div class="col-lg-4 col-md-6 mt-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">PM1.0</h5>
                        <p class="card-text"><span id="pm1-value">35.7</span> µg/m³</p>
                    </div>
                </div>
            </div>
            <!-- PM2.5 -->
            <div class="col-lg-4 col-md-6 mt-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">PM2.5</h5>
                        <p class="card-text">Nilai: <span id="pm25-value">35.7</span> µg/m³</p>
                    </div>
                </div>
            </div>
            <!-- PM10 -->
            <div class="col-lg-4 col-md-6 mt-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">PM10</h5>
                        <p class="card-text">Nilai: <span id="pm10-value">35.7</span> µg/m³</p>
                    </div>
                </div>
            </div>
            <!-- CO -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">CO</h5>
                        <p class="card-text">Nilai: <span id="co-value">90</span> ppm</p>
                    </div>
                </div>
            </div>
            <!-- Suhu -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Suhu</h5>
                        <p class="card-text">Nilai: <span id="temperature-value">35.7</span> °C</p>
                    </div>
                </div>
            </div>
            <!-- Kelembaban -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Kelembaban</h5>
                        <p class="card-text">Nilai: <span id="humidity-value">35.7</span> %</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>
