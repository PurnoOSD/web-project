<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TripGo | Travel Packages</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <div class="logo"><h2>TripGo</h2></div>
    <ul>
        <li><a href="TripGo.php">Home</a></li>
        <li><a href="destination.php">Destinations</a></li>
        <li><a href="packages.php" class="active">Packages</a></li>
        <li><a href="booking.php">Booking</a></li>
        <li><a href="login.php">Login</a></li>
    </ul>
</nav>

<section class="container">
    <h2 class="section-title">🌍 Travel Package Catalog</h2>

    <div class="grid">

        <div class="card">
            <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=400" alt="Maldives">
            <div class="card-info">
                <h3>Maldives Getaway</h3>
                <p>5 Days / 4 Nights</p>
                <p><b>$1200</b></p>
                <a href="booking.php" class="btn">Book Now</a>
            </div>
        </div>

        <div class="card">
            <img src="https://images.unsplash.com/photo-1505761671935-60b3a7427bad?w=400" alt="Paris">
            <div class="card-info">
                <h3>Paris Romantic Tour</h3>
                <p>4 Days / 3 Nights</p>
                <p><b>$950</b></p>
                <a href="booking.php" class="btn">Book Now</a>
            </div>
        </div>

        <div class="card">
            <img src="https://images.unsplash.com/photo-1548013146-72479768bada?w=400" alt="Bali">
            <div class="card-info">
                <h3>Bali Adventure</h3>
                <p>6 Days / 5 Nights</p>
                <p><b>$1100</b></p>
                <a href="booking.php" class="btn">Book Now</a>
            </div>
        </div>

    </div>
</section>

</body>
</html>
