<?php
session_start();
include 'db.php';

/* 🔐 Login check */
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

/* =========================
   CREATE: Add Booking
   ========================= */
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_booking'])) {

    $dest    = trim($_POST['destination']);
    $date    = $_POST['travelDate'];
    $persons = (int) $_POST['persons'];
    $hotel   = $_POST['hotel'];
    $user_id = $_SESSION['user_id'];

    // Prevent double booking same hotel same date
    $check = $conn->prepare(
        "SELECT id FROM bookings WHERE travel_date = ? AND hotel = ?"
    );
    $check->bind_param("ss", $date, $hotel);
    $check->execute();
    $checkRes = $check->get_result();

    if ($checkRes->num_rows > 0) {
        $error = "❌ This hotel is already booked for selected date!";
    } else {
        $stmt = $conn->prepare(
            "INSERT INTO bookings (user_id, destination, travel_date, persons, hotel)
             VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("issis", $user_id, $dest, $date, $persons, $hotel);
        $stmt->execute();
        header("Location: booking.php?success=1");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Bookings | TripGo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<nav>
    <div class="logo">TripGo</div>
    <ul>
        <li><a href="TripGo.php">Home</a></li>
        <li><a href="booking.php">My Bookings</a></li>
    </ul>
</nav>

<main class="container">
    <h2>Manage Your Trips</h2>

    <?php if (isset($error)): ?>
        <p style="color:red;font-weight:bold"><?= $error ?></p>
    <?php endif; ?>

    <?php if (isset($_GET['success'])): ?>
        <p style="color:green;font-weight:bold">Booking added successfully!</p>
    <?php endif; ?>

    <!-- =========================
         ADD BOOKING FORM
         ========================= -->
    <section class="form-section">
        <h3>Book a New Trip</h3>
        <form method="POST">

            <input type="text" name="destination" placeholder="Destination" required>

            <input type="date" name="travelDate" required>

            <input type="number" name="persons" min="1" max="10"
                   placeholder="Number of Persons" required>

            <select name="hotel" required>
                <option value="">Select Hotel</option>
                <?php
                $hotels = mysqli_query($conn, "SELECT * FROM hotels");
                while ($h = mysqli_fetch_assoc($hotels)) {
                    echo "<option value='{$h['hotel_name']}'>{$h['hotel_name']}</option>";
                }
                ?>
            </select>

            <button type="submit" name="add_booking" class="btn">Add Booking</button>
        </form>
    </section>

    <!-- =========================
         BOOKINGS TABLE
         ========================= -->
    <section class="table-section">
        <table>
            <thead>
                <tr>
                    <th>Destination</th>
                    <th>Date</th>
                    <th>Persons</th>
                    <th>Hotel</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $user_id = $_SESSION['user_id'];

                // Get booked hotels (for red mark)
                $bookedHotels = [];
                $bh = mysqli_query($conn, "SELECT travel_date, hotel FROM bookings");
                while ($b = mysqli_fetch_assoc($bh)) {
                    $bookedHotels[$b['travel_date']][] = $b['hotel'];
                }

                $stmt = $conn->prepare(
                    "SELECT * FROM bookings WHERE user_id = ? ORDER BY created_at DESC"
                );
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                        $isBooked = in_array(
                            $row['hotel'],
                            $bookedHotels[$row['travel_date']] ?? []
                        );

                        $rowStyle = $isBooked ? "style='background:#ffcccc'" : "";
                        ?>
                        <tr <?= $rowStyle ?>>
                            <td><?= htmlspecialchars($row['destination']) ?></td>
                            <td><?= $row['travel_date'] ?></td>
                            <td><?= $row['persons'] ?></td>
                            <td><?= $row['hotel'] ?></td>
                            <td>
                                <a class="delete-btn"
                                   href="delete.php?id=<?= $row['id'] ?>"
                                   onclick="return confirm('Delete this booking?')">
                                   Delete
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='5'>No bookings found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
</main>

</body>
</html>
