<?php
require_once '../includes/db.php';

try {
    $sql = "CREATE TABLE IF NOT EXISTS `products` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        `price` decimal(10,2) NOT NULL,
        `discount` decimal(10,2) DEFAULT NULL,
        `whatsapp_link` varchar(255) NOT NULL,
        `image` varchar(255) NOT NULL,
        `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

    $pdo->exec($sql);
    echo "<h2 style='font-family:sans-serif; color:green; text-align:center; margin-top:50px;'>Tabla de productos creada correctamente en la base de datos.</h2>";
} catch (PDOException $e) {
    echo "<h2 style='font-family:sans-serif; color:red; text-align:center; margin-top:50px;'>Error creando la tabla: " . $e->getMessage() . "</h2>";
}
?>
