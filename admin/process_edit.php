<?php
session_start();
require '../includes/db.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $keys = $_POST['keys'] ?? [];
    $values = $_POST['values'] ?? [];
    
    // Directorio de subida (relativo a admin/)
    $upload_dir = '../FOTOS BANNERS/';

    foreach ($keys as $key) {
        // Actualizar textos
        if (isset($values[$key])) {
            $stmt = $pdo->prepare('UPDATE site_content SET content_value = ? WHERE section_key = ? AND content_type = "text"');
            $stmt->execute([trim($values[$key]), $key]);
        }

        // Manejar subida de imágenes
        if (isset($_FILES['images']['name'][$key]) && $_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['images']['tmp_name'][$key];
            $name = basename($_FILES['images']['name'][$key]);
            
            // Limpiar nombre de archivo (opcional pero recomendado)
            $name = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $name);
            $destination = $upload_dir . $name;
            
            // Ruta para guardar en base de datos (relativa a la raiz)
            $db_path = 'FOTOS BANNERS/' . $name;

            if (move_uploaded_file($tmp_name, $destination)) {
                $stmt = $pdo->prepare('UPDATE site_content SET content_value = ? WHERE section_key = ? AND content_type = "image"');
                $stmt->execute([$db_path, $key]);
            }
        }
    }

    header('Location: dashboard.php?success=1');
    exit;
}
?>
