<?php
session_start(); // Access the current session
session_unset(); // Remove all session variables
session_destroy(); // Destroy the session entirely

// Redirect back to your home page
header("Location: TripGo.php"); 
exit();
?>