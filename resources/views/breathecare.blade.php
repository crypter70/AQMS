<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Breathe Care</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" rel="stylesheet" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/breathecare.css">
</head>

<body>
    @include('components.navbar')
    <main>
        <div class="container">
            <section class="content-section">
                <h2>Health Information</h2>
                <p>Air pollution can have significant impacts on health. Here are some key pollutants and their effects:</p>

                <div class="info-card">
                    <h3>What is Particulate Matter (PM)?</h3>
                    <p>Particulate Matter (PM) is a mixture of solid particles and liquid droplets found in the air. These particles can include dust, dirt, soot, and smoke.</p>
                </div>

                <div class="info-card">
                    <h3>Types of Particulate Matter</h3>
                    <ul>
                        <li><strong>PM1.0:</strong> Particles with a diameter of 1 micrometer or less. These particles can penetrate deeply into the lungs and even enter the bloodstream, causing respiratory and cardiovascular issues.</li>
                        <li><strong>PM2.5:</strong> Fine particulate matter with a diameter of 2.5 micrometers or less. PM2.5 can lodge deep in the lungs and is associated with increased rates of chronic bronchitis, reduced lung function, and premature death.</li>
                        <li><strong>PM10:</strong> Particulate matter with a diameter of 10 micrometers or less. PM10 can irritate the eyes, nose, and throat, and can cause more serious health issues for people with respiratory conditions.</li>
                    </ul>
                </div>

                <div class="info-card">
                    <h3>What is Carbon Monoxide (CO)?</h3>
                    <p>Carbon monoxide is a colorless, odorless gas that can cause harmful health effects by reducing the amount of oxygen that can be transported in the bloodstream to critical parts of the body.</p>
                </div>

                <div class="info-card">
                    <h3>What is ISPU?</h3>
                    <p>ISPU is a number without units, used to describe the condition of ambient air quality in a particular location and is based on the impact on human health, aesthetic value and other living creatures. Especially for areas prone to being affected by forest and land fires, this information can be used as an early warning system for the surrounding community. The purpose of preparing the ISPU is to provide convenience and uniformity of information on ambient air quality to the public at certain locations and times as well as as a consideration in making efforts to control air pollution for both the central government and regional governments.</p>
                    <!-- Kategori ISPU -->
                    <div class="ispu-categories">
                        <div class="ispu-category" style="background-color: #50EF50;">
                            <h4>Good</h4>
                            <p>1 - 50</p>
                        </div>
                        <div class="ispu-category" style="background-color: #5656EC;">
                            <h4>Moderate</h4>
                            <p>51 - 100</p>
                        </div>
                        <div class="ispu-category" style="background-color: #FBFA28;">
                            <h4>Unhealthy</h4>
                            <p>101 - 200</p>
                        </div>
                        <div class="ispu-category" style="background-color: #F93031;">
                            <h4>Very Unhealthy</h4>
                            <p>201 - 300</p>
                        </div>
                        <div class="ispu-category" style="background-color: #242222; color: #fff;">
                            <h4>Hazardous</h4>
                            <p style="color: #fff">301+</p>
                        </div>
                    </div>
                </div>

                <div class="info-card">
                    <h3>Prevention Recommendations</h3>
                    <ul>
                        <li>Avoid outdoor activities when air quality is poor.</li>
                        <li>Keep windows and doors closed to prevent outdoor air pollution from entering.</li>
                        <li>Use air purifiers to reduce indoor air pollution.</li>
                        <li>Wear masks that can filter out PM2.5 and other harmful particles when going outside.</li>
                        <li>Avoid smoking and reduce the use of products that produce smoke indoors.</li>
                        <li>Promote and support policies and initiatives aimed at reducing air pollution.</li>
                    </ul>
                </div>
            </section>
        </div>


    </main>


    <script src="script.js"></script>
</body>

</html>