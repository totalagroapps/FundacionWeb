<?php
// includes/db.php

$host = 'localhost';
$db   = 'detodop8_fundacion';
$user = 'detodop8_usu_fundacion';
$pass = 'oqOSmo@J2]2k';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // En lugar de arrojar un Error 500, mostramos un mensaje amigable
    die("<div style='text-align:center; padding: 50px; font-family: sans-serif;'>
            <h2 style='color: red;'>Error de Conexión a la Base de Datos</h2>
            <p>El servidor MySQL está rechazando la conexión. Por favor verifica si la base de datos está activa o si se alcanzó el límite de conexiones.</p>
            <p><strong>Detalle técnico:</strong> " . htmlspecialchars($e->getMessage()) . "</p>
         </div>");
}

// Función auxiliar para obtener contenido del sitio
function get_site_content($pdo, $key, $default = '') {
    $stmt = $pdo->prepare('SELECT content_value FROM site_content WHERE section_key = ?');
    $stmt->execute([$key]);
    $result = $stmt->fetch();
    return $result ? $result['content_value'] : $default;
}
?>
