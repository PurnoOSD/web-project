<?php
session_start();
include 'db.php';

/* 🔐 Login check */
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {

    $booking_id = (int) $_GET['id'];   // Safety cast
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare(
        "DELETE FROM bookings WHERE id = ? AND user_id = ?"
    );
    $stmt->bind_param("ii", $booking_id, $user_id);
    $stmt->execute();

    // Optional: check if delete worked
    // if ($stmt->affected_rows === 0) {
    //     echo "Delete failed or unauthorized!";
    // }

    $stmt->close();
}

header("Location: booking.php");
exit();
?>
