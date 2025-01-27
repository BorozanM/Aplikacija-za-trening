<?php
session_start();

if (isset($_POST["logout"])) {
    // Uništava sve sesije
    session_unset();
    session_destroy();

    header("Location: index.php");
    exit();
}
?>