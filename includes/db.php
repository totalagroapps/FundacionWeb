<?php
// includes/db.php

$host = 'localhost';
$db   = 'u975680109_db';
$user = 'u975680109_user';
$pass = 'F6Fy2=69xWwB.~!';
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
    
    if ($key === 'contacto_phone') {
        if (!$result || empty($result['content_value']) || strpos($result['content_value'], '300') !== false) {
            try {
                $up = $pdo->prepare("INSERT INTO site_content (section_key, content_type, content_value) VALUES ('contacto_phone', 'text', '+57 316 252 2445') ON DUPLICATE KEY UPDATE content_value = '+57 316 252 2445'");
                $up->execute();
            } catch (\Exception $e) {}
            return '+57 316 252 2445';
        }
    }

    if ($key === 'contacto_location') {
        if (!$result || empty($result['content_value']) || $result['content_value'] === 'Colombia') {
            try {
                $up = $pdo->prepare("INSERT INTO site_content (section_key, content_type, content_value) VALUES ('contacto_location', 'text', 'Santa Rosa de Cabal, Risaralda - Colombia') ON DUPLICATE KEY UPDATE content_value = 'Santa Rosa de Cabal, Risaralda - Colombia'");
                $up->execute();
            } catch (\Exception $e) {}
            return 'Santa Rosa de Cabal, Risaralda - Colombia';
        }
    }

    if ($key === 'contacto_email') {
        if (!$result || empty($result['content_value']) || $result['content_value'] === 'info@adndeamor.org') {
            try {
                $up = $pdo->prepare("INSERT INTO site_content (section_key, content_type, content_value) VALUES ('contacto_email', 'text', 'info@fundacionadndeamor.org') ON DUPLICATE KEY UPDATE content_value = 'info@fundacionadndeamor.org'");
                $up->execute();
            } catch (\Exception $e) {}
            return 'info@fundacionadndeamor.org';
        }
    }

    if ($key === 'hero_slide1_btn1_url') {
        if (!$result || empty($result['content_value']) || $result['content_value'] === '#apadrinar') {
            try {
                $up = $pdo->prepare("INSERT INTO site_content (section_key, content_type, content_value, page_name) VALUES ('hero_slide1_btn1_url', 'text', 'apadrinar.php', 'inicio') ON DUPLICATE KEY UPDATE content_value = 'apadrinar.php'");
                $up->execute();
            } catch (\Exception $e) {
                try {
                    $up = $pdo->prepare("UPDATE site_content SET content_value = 'apadrinar.php' WHERE section_key = 'hero_slide1_btn1_url'");
                    $up->execute();
                } catch (\Exception $e2) {}
            }
            return 'apadrinar.php';
        }
    }

    if ($key === 'hero_slide2_btn1_url') {
        if (!$result || empty($result['content_value']) || $result['content_value'] === '#donar') {
            try {
                $up = $pdo->prepare("INSERT INTO site_content (section_key, content_type, content_value, page_name) VALUES ('hero_slide2_btn1_url', 'text', 'programas.php#cdt', 'inicio') ON DUPLICATE KEY UPDATE content_value = 'programas.php#cdt'");
                $up->execute();
            } catch (\Exception $e) {
                try {
                    $up = $pdo->prepare("UPDATE site_content SET content_value = 'programas.php#cdt' WHERE section_key = 'hero_slide2_btn1_url'");
                    $up->execute();
                } catch (\Exception $e2) {}
            }
            return 'programas.php#cdt';
        }
    }

    if ($result && !empty($result['content_value']) && is_string($result['content_value'])) {
        if (stripos($result['content_value'], 'detodopelis') !== false || stripos($result['content_value'], 'pelis') !== false) {
            $cleaned = str_replace(
                ['https://entornos.detodopelis.co/panel/', 'https://entornos.detodopelis.co/', 'http://entornos.detodopelis.co/panel/', 'http://entornos.detodopelis.co/', 'entornos.detodopelis.co', 'detodopelis.co'],
                ['index.php', 'index.php', 'index.php', 'index.php', 'fundacionadndeamor.org', 'fundacionadndeamor.org'],
                $result['content_value']
            );
            try {
                $up = $pdo->prepare("UPDATE site_content SET content_value = ? WHERE section_key = ?");
                $up->execute([$cleaned, $key]);
            } catch (\Exception $e) {}
            return $cleaned;
        }
    }
    
    return $result ? $result['content_value'] : $default;
}
?>
