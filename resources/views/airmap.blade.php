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
    @include('components.navbar')
    <div class="container mt-3 mb-5">
        <div class="ratio ratio-16x9">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126748.56401209347!2d107.56058383120302!3d-6.903442349921637!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6398252477f%3A0x146a1f93d3e815b2!2sBandung%2C%20Kota%20Bandung%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1718263269837!5m2!1sid!2sid" allowfullscreen="false" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

    <!--            
    <div class="container mt-5 mb-5">
        <div class="row">
            Lokasi 1
            <div class="col-lg-4 mt-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <a class="housing-icon" href="#">
                            <img src="images/housing.png" class="mb-3" height="30" alt="">
                        </a>
                        <h5 class="card-title">KRU House, Buah Batu</h5>
                        <p class="card-text"><span id="ispu-kru"></span> µg/m³</p>
                    </div>
                </div>
            </div>
            Lokasi 2
            <div class="col-lg-4 mt-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <a class="mosque-icon" href="#">
                            <img src="images/mosque.png" class="mb-3" height="30" alt="">
                        </a>
                        <h5 class="card-title">Masjid Al Muslim, Cibeunying</h5>
                        <p class="card-text"><span id="ispu-almuslim"></span> µg/m³</p>
                    </div>
                </div>
            </div>
            Lokasi 3
            <div class="col-lg-4 mt-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <a class="office-icon" href="#">
                            <img src="images/office.png" class="mb-3" height="30" alt="">
                        </a>
                        <h5 class="card-title">FPTK UPI, Setiabudi</h5>
                        <p class="card-text"><span id="ispu-fptk"></span> µg/m³</p>
                    </div>
                </div>
            </div>
        </div> -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>