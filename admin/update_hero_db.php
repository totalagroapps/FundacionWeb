<?php
require '../includes/db.php';

try {
    $new_content = [
        ['hero_slide1_btn1_text', 'text', 'Apadrina Hoy', 'inicio'],
        ['hero_slide1_btn1_url', 'text', 'apadrinar.php', 'inicio'],
        ['hero_slide1_btn2_text', 'text', 'Dona por una Causa', 'inicio'],
        ['hero_slide1_btn2_url', 'text', '#donar', 'inicio'],
        ['hero_slide2_btn1_text', 'text', 'Apoya el CDT', 'inicio'],
        ['hero_slide2_btn1_url', 'text', 'programas.php#cdt', 'inicio']
    ];

    // Verificar si page_name existe, si no, lo insertamos sin él (el fallback de update_db.php)
    $stmt = $pdo->query("SHOW COLUMNS FROM site_content LIKE 'page_name'");
    $has_page_name = $stmt->fetch();

    foreach ($new_content as $item) {
        if ($has_page_name) {
            $stmt = $pdo->prepare("INSERT INTO site_content (section_key, content_type, content_value, page_name) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE content_type=VALUES(content_type)");
            $stmt->execute([$item[0], $item[1], $item[2], $item[3]]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO site_content (section_key, content_type, content_value) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE content_type=VALUES(content_type)");
            $stmt->execute([$item[0], $item[1], $item[2]]);
        }
    }
    echo "Botones de Hero agregados a la base de datos.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
