<?php
session_start();

// Get the city name from the URL, default to 'Paris' if none found
$city = isset($_GET['city']) ? $_GET['city'] : 'Paris';

// Simple data array (In a real project, this would be in a database)
$details = [
    'Paris' => [
        'title' => 'Paris, France',
        'img' => 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?q=80&w=800',
        'desc' => 'Known as the City of Light, Paris is famous for its cafes, the Eiffel Tower, and world-class art museums like the Louvre.',
        'price' => '$1,200'
    ],
    'Venice' => [
        'title' => 'Venice, Italy',
        'img' => 'https://images.unsplash.com/photo-1523906834658-6e24ef2386f9?q=80&w=800',
        'desc' => 'Explore the floating city of Venice. Famous for its winding canals, gondolas, and beautiful Venetian Gothic architecture.',
        'price' => '$1,500'
    ],
    'Kyoto' => [
        'title' => 'Kyoto, Japan',
        'img' => 'https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?q=80&w=800',
        'desc' => 'Kyoto offers a glimpse into traditional Japan with its thousands of Buddhist temples, Shinto shrines, and zen gardens.',
        'price' => '$1,800'
    ]
];

// Fallback if city isn't in our list
$info = isset($details[$city]) ? $details[$city] : $details['Paris'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $info['title']; ?> | TripGo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <div class="logo"><h2>TripGo</h2></div>
        <ul>
            <li><a href="TripGo.php">Home</a></li>
            <li><a href="booking.php">My Bookings</a></li>
        </ul>
    </nav>

    <main class="container destination-details">
        <div class="detail-header">
            <img src="<?php echo $info['img']; ?>" alt="<?php echo $city; ?>" class="main-img">
            <div class="text-info">
                <h1><?php echo $info['title']; ?></h1>
                <p class="description"><?php echo $info['desc']; ?></p>
                <p class="price">Starting from: <strong><?php echo $info['price']; ?></strong></p>
                
                <a href="booking.php?dest=<?php echo $city; ?>" class="btn">Book This Trip</a>
            </div>
        </div>
    </main>
</body>
</html>