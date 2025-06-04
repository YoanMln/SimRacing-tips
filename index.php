<?php
$pages = $_GET['pages'] ?? 'home';

include 'includes/header.php';

$path = "includes/pages/$pages.php";
if (file_exists($path)) {
    include $path;
} else {
    echo "<h2> Page introuvable</h2>";
}

include 'includes/footer.php';
