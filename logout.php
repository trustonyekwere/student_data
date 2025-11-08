<?php

    // Start session if not already started
    if (!isset($_SESSION['id'])) {
        session_start();
    }

    // Destroy all session data to log user out
    session_unset();
    session_destroy();

    // Redirect to login page after logout
    header('Location: admin_login.php');
    exit();

?>