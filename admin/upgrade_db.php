<?php
require '../includes/db.php';

try {
    // Verificar si la columna ya existe
    $stmt = $pdo->query("SHOW COLUMNS FROM site_content LIKE 'page_name'");
    $exists = $stmt->fetch();

    if (!$exists) {
        // Añadir columna page_name
        $pdo->exec("ALTER TABLE site_content ADD COLUMN page_name VARCHAR(50) NOT NULL DEFAULT 'inicio' AFTER id");
        echo "Columna 'page_name' añadida correctamente.<br>";
        
        // Actualizar todos los registros existentes a 'inicio'
        $pdo->exec("UPDATE site_content SET page_name = 'inicio'");
        echo "Todos los registros actuales han sido asignados a la página 'inicio'.<br>";
    } else {
        echo "La columna 'page_name' ya existe. No se requieren cambios en la base de datos.<br>";
    }

    echo "<br><strong>¡Actualización completada!</strong> Ahora puedes disfrutar del nuevo diseño del panel. Por favor elimina este archivo (upgrade_db.php) por seguridad.";

} catch (PDOException $e) {
    echo "Error al actualizar la base de datos: " . $e->getMessage();
}
?>
