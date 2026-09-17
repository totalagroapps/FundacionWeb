<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
echo "PHP is working fine!<br>";
try {
    require_once 'includes/db.php';
    echo "db.php included successfully!<br>";
    echo "test get_site_content: " . htmlspecialchars(get_site_content($pdo, 'contacto_telefono', 'default')) . "<br>";
} catch (Throwable $t) {
    echo "Caught Throwable: " . $t->getMessage() . " on line " . $t->getLine() . " of " . $t->getFile() . "<br>";
}
