<?php
require '../includes/db.php';

try {
    $fixes = [
        ['nos_historia_desc1', 'Entre 1980 y el año 2008, la obra social que hoy inspira a la Fundación ADN de Amor tuvo como gran pionera a la señora Nidia López de Giraldo, una mujer de profunda vocación de servicio y amor por el prójimo. Activista social y ejemplo de generosidad, dedicó su vida a ayudar a miles de personas, especialmente niños, jóvenes y madres cabeza de familia, llevando siempre una sonrisa, palabras de esperanza, apoyo y comprensión.'],
        ['voluntariado_btn1_url', 'voluntariado'],
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

    echo "Listo: 'nos_historia_desc1' y 'voluntariado_btn1_url' actualizados en site_content. Puedes borrar este archivo después de ejecutarlo.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
