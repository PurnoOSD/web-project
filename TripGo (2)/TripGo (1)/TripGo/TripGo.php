<?php 
// Start the session to track if a user is logged in
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TripGo | Explore the World</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <div class="logo"><h2>TripGo</h2></div>
        <ul>
            <li><a href="TripGo.php">Home</a></li>
            <li><a href="packages.php">Packages</a></li>
            <li><a href="booking.php">My Bookings</a></li>
            
            <?php if(isset($_SESSION['username'])): ?>
                <li class="user-greet">Welcome, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></li>
                <li><a href="logout.php" class="logout-btn">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php" class="btn-small">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <header class="hero">
        <div class="hero-content">
            <h1>Adventure Awaits</h1>
            <p>Book your dream destination today with TripGo.</p>
            <a href="booking.php" class="btn">Start Booking</a>
        </div>
    </header>

    <section class="destinations container">
        <h2>Popular Destinations</h2>
        <div class="grid">
            
            <a href="destination.php?city=Paris" class="card-link">
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1502602898657-3e91760cbb34?q=80&w=400" alt="Paris">
                    <div class="card-info">
                        <h3>Paris</h3>
                        <p>The city of lights and love.</p>
                    </div>
                </div>
            </a>

            <a href="destination.php?city=Venice" class="card-link">
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1523906834658-6e24ef2386f9?q=80&w=400" alt="Venice">
                    <div class="card-info">
                        <h3>Venice</h3>
                        <p>Experience the magic of canals.</p>
                    </div>
                </div>
            </a>

            <a href="destination.php?city=Kyoto" class="card-link">
                <div class="card">
                    <img src="https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?q=80&w=400" alt="Kyoto">
                    <div class="card-info">
                        <h3>Kyoto</h3>
                        <p>Tradition meets natural beauty.</p>
                    </div>
                </div>
            </a>

        </div>
    </section>

    <footer>
        <p>&copy; 2026 TripGo Travel Group. All rights reserved.</p>
    </footer>
</body>
</html>