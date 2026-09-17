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
        if (!$result || empty($result['content_value']) || $result['content_value'] === '#apadrinar' || $result['content_value'] === 'apadrinar.php') {
            try {
                $up = $pdo->prepare("INSERT INTO site_content (section_key, content_type, content_value, page_name) VALUES ('hero_slide1_btn1_url', 'text', 'apadrinar', 'inicio') ON DUPLICATE KEY UPDATE content_value = 'apadrinar'");
                $up->execute();
            } catch (\Exception $e) {
                try {
                    $up = $pdo->prepare("UPDATE site_content SET content_value = 'apadrinar' WHERE section_key = 'hero_slide1_btn1_url'");
                    $up->execute();
                } catch (\Exception $e2) {}
            }
            return 'apadrinar';
        }
    }

    if ($key === 'hero_slide2_btn1_url') {
        if (!$result || empty($result['content_value']) || $result['content_value'] === '#donar' || $result['content_value'] === 'programas.php#cdt') {
            try {
                $up = $pdo->prepare("INSERT INTO site_content (section_key, content_type, content_value, page_name) VALUES ('hero_slide2_btn1_url', 'text', 'programas#cdt', 'inicio') ON DUPLICATE KEY UPDATE content_value = 'programas#cdt'");
                $up->execute();
            } catch (\Exception $e) {
                try {
                    $up = $pdo->prepare("UPDATE site_content SET content_value = 'programas#cdt' WHERE section_key = 'hero_slide2_btn1_url'");
                    $up->execute();
                } catch (\Exception $e2) {}
            }
            return 'programas#cdt';
        }
    }

    if ($key === 'prog_donde_p1') {
        $guacas_desc = 'La Fundación ADN de Amor tiene su sede principal y finca ubicada en la vereda Guacas en Santa Rosa de Cabal, cerca al Mirador del Café, desde donde coordinamos y desarrollamos todas nuestras actividades.';
        if (!$result || empty($result['content_value']) || strpos($result['content_value'], 'Guacas') === false) {
            try {
                $up = $pdo->prepare("INSERT INTO site_content (section_key, content_type, content_value, page_name) VALUES ('prog_donde_p1', 'text', ?, 'programas') ON DUPLICATE KEY UPDATE content_value = ?");
                $up->execute([$guacas_desc, $guacas_desc]);
            } catch (\Exception $e) {
                try {
                    $up = $pdo->prepare("UPDATE site_content SET content_value = ? WHERE section_key = 'prog_donde_p1'");
                    $up->execute([$guacas_desc]);
                } catch (\Exception $e2) {}
            }
            return $guacas_desc;
        }
    }

    if ($key === 'empresas_btn_url') {
        if (!$result || empty($result['content_value']) || strpos($result['content_value'], 'adepo') !== false) {
            try {
                $up = $pdo->prepare("INSERT INTO site_content (section_key, content_type, content_value, page_name) VALUES ('empresas_btn_url', 'text', 'empresas', 'inicio') ON DUPLICATE KEY UPDATE content_value = 'empresas'");
                $up->execute();
            } catch (\Exception $e) {
                try {
                    $up = $pdo->prepare("UPDATE site_content SET content_value = 'empresas' WHERE section_key = 'empresas_btn_url'");
                    $up->execute();
                } catch (\Exception $e2) {}
            }
            return 'empresas';
        }
    }

    if ($key === 'voluntariado_btn2_url') {
        if (!$result || empty($result['content_value']) || strpos($result['content_value'], 'adepo') !== false) {
            try {
                $up = $pdo->prepare("INSERT INTO site_content (section_key, content_type, content_value, page_name) VALUES ('voluntariado_btn2_url', 'text', 'practicas', 'inicio') ON DUPLICATE KEY UPDATE content_value = 'practicas'");
                $up->execute();
            } catch (\Exception $e) {
                try {
                    $up = $pdo->prepare("UPDATE site_content SET content_value = 'practicas' WHERE section_key = 'voluntariado_btn2_url'");
                    $up->execute();
                } catch (\Exception $e2) {}
            }
            return 'practicas';
        }
    }

    // Reemplazo automático de banners publicitarios con texto por fotografías limpias de los niños
    $clean_image_replacements = [
        'apadrinar_card2_img' => 'FOTOS BANNERS/CDT_musica_nino_guitarra.png',
        'hero_slide2_img'     => 'FOTOS BANNERS/CDT_arte_nina_pintura.png',
        'prog_que_img'        => 'FOTOS BANNERS/CDT_talentos_completo_ninos.png',
        'prog_cdt_img1'       => 'FOTOS BANNERS/CDT_ingles_clase_real.png',
        'prog_cdt_img2'       => 'FOTOS BANNERS/CDT_arte_nina_pintura.png',
        'prog_cdt_img3'       => 'FOTOS BANNERS/CDT_musica_nino_guitarra.png',
        'prog_choco_img'      => 'FOTOS BANNERS/mision_choco_ninos_limpio.png',
        'nos_mision_creemos_img' => 'FOTOS BANNERS/CDT_ingles_clase_real.png',
    ];

    if (isset($clean_image_replacements[$key])) {
        $clean_path = $clean_image_replacements[$key];
        $current = (is_array($result) && isset($result['content_value'])) ? (string)$result['content_value'] : '';
        $is_old_banner = false;
        $old_flyers = [
            'CDT ARTE FINAL PINTACARITAS',
            'CDT MUSICA 1 SELECCIONADA',
            'CDT INGLES BANNER FINAL SANDRA',
            'CENTRO DESARROLLO DE TALENTOS BANNER 1',
            'MISION CHOCO BANNER OPCION MEJOR 1',
            'MISION CHOCO MEJOR BANNER OPCION DOS'
        ];
        foreach ($old_flyers as $old_name) {
            if ($current !== '' && stripos($current, $old_name) !== false) {
                $is_old_banner = true;
                break;
            }
        }
        if (empty($current) || $is_old_banner) {
            try {
                $up = $pdo->prepare("INSERT INTO site_content (section_key, content_type, content_value) VALUES (?, 'image', ?) ON DUPLICATE KEY UPDATE content_value = ?");
                $up->execute([$key, $clean_path, $clean_path]);
            } catch (\Exception $e) {
                try {
                    $up = $pdo->prepare("UPDATE site_content SET content_value = ? WHERE section_key = ?");
                    $up->execute([$clean_path, $key]);
                } catch (\Exception $e2) {}
            }
            return $clean_path;
        }
    }

    if ($result && !empty($result['content_value']) && is_string($result['content_value'])) {
        $val = $result['content_value'];
        if (stripos($val, 'detodopelis') !== false || stripos($val, 'pelis') !== false) {
            $cleaned = str_replace(
                ['https://entornos.detodopelis.co/panel/', 'https://entornos.detodopelis.co/', 'http://entornos.detodopelis.co/panel/', 'http://entornos.detodopelis.co/', 'entornos.detodopelis.co', 'detodopelis.co'],
                ['/', '/', '/', '/', 'fundacionadndeamor.org', 'fundacionadndeamor.org'],
                $val
            );
            try {
                $up = $pdo->prepare("UPDATE site_content SET content_value = ? WHERE section_key = ?");
                $up->execute([$cleaned, $key]);
            } catch (\Exception $e) {}
            $val = $cleaned;
        }

        // Clean internal .php URLs for SEO
        if (strpos($key, '_url') !== false || strpos($key, '_link') !== false) {
            $clean_url = preg_replace('/^index\.php(#.*)?$/i', '/$1', $val);
            $clean_url = preg_replace('/^(nosotros|programas|apadrinar|tienda|blog|memorias)\.php(#.*)?$/i', '$1$2', $clean_url);
            if ($clean_url !== $val) {
                try {
                    $up = $pdo->prepare("UPDATE site_content SET content_value = ? WHERE section_key = ?");
                    $up->execute([$clean_url, $key]);
                } catch (\Exception $e) {}
                $val = $clean_url;
            }
        }

        return $val;
    }
    
    return $result ? $result['content_value'] : $default;
}
?>
