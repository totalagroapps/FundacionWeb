<?php
require '../includes/db.php';

try {
    $fixes = [
        ['hero_slide1_title', 'Abre Caminos de Esperanza'],
    ];

    $stmt = $pdo->query("SHOW COLUMNS FROM site_content LIKE 'page_name'");
    $has_page_name = $stmt->fetch();

    foreach ($fixes as $item) {
        [$key, $value] = $item;
        if ($has_page_name) {
            $stmt = $pdo->prepare("INSERT INTO site_content (section_key, content_type, content_value, page_name) VALUES (?, 'text', ?, 'inicio') ON DUPLICATE KEY UPDATE content_value = VALUES(content_value)");
            $stmt->execute([$key, $value]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO site_content (section_key, content_type, content_value) VALUES (?, 'text', ?) ON DUPLICATE KEY UPDATE content_value = VALUES(content_value)");
            $stmt->execute([$key, $value]);
        }
    }

    echo "Listo: 'hero_slide1_title' corregido (se quitaron las letras de más en 'Esperanzaaaa'). Puedes borrar este archivo después de ejecutarlo.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
