
<?php
// Start the session
session_start();

// Destroy the session and all its data
session_destroy();

// Redirect the user to the login page or home page
header("Location: index.php");
exit();
?>
