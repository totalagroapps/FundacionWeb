<?php
require '../includes/db.php';

try {
    $new_content = [
        ['historia_btn_text', 'text', 'Leer la historia completa', 'inicio'],
        ['historia_btn_url', 'text', 'nosotros.php', 'inicio'],
        
        ['apadrinar_btn_url', 'text', 'apadrinar.html', 'inicio'],
        
        ['donar_btn_url', 'text', '#contacto', 'inicio'],
        
        ['empresas_btn_url', 'text', 'empresas', 'inicio'],
        
        ['voluntariado_btn1_url', 'text', '#contacto', 'inicio'],
        ['voluntariado_btn2_url', 'text', 'practicas', 'inicio'],
        
        ['tienda_btn_url', 'text', 'tienda.html', 'inicio']
    ];

    // Verificar si page_name existe
    $stmt = $pdo->query("SHOW COLUMNS FROM site_content LIKE 'page_name'");
    $has_page_name = $stmt->fetch();

    foreach ($new_content as $item) {
        // Only insert if it doesn't exist, we don't want to overwrite text if they already modified it
        // Wait, ON DUPLICATE KEY UPDATE content_type=VALUES(content_type) does exactly that (leaves content_value untouched).
        if ($has_page_name) {
            $stmt = $pdo->prepare("INSERT INTO site_content (section_key, content_type, content_value, page_name) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE content_type=VALUES(content_type)");
            $stmt->execute([$item[0], $item[1], $item[2], $item[3]]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO site_content (section_key, content_type, content_value) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE content_type=VALUES(content_type)");
            $stmt->execute([$item[0], $item[1], $item[2]]);
        }
    }
    echo "¡Todos los nuevos campos de botones (Historia, Apadrinar, Donar, Empresas, Voluntariado, Tienda) han sido agregados a la base de datos!";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
