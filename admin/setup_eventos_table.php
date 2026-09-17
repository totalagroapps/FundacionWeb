<?php
// admin/setup_eventos_table.php
require_once '../includes/db.php';

header('Content-Type: text/html; charset=utf-8');

try {
    $sql = "CREATE TABLE IF NOT EXISTS `eventos` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `titulo` varchar(255) NOT NULL,
        `subtitulo` varchar(255) DEFAULT NULL,
        `descripcion` text NOT NULL,
        `fecha` date NOT NULL,
        `hora` varchar(50) DEFAULT '6:30 PM',
        `dia_semana` varchar(50) DEFAULT 'Jueves',
        `lugar` varchar(255) DEFAULT 'Sede Finca Guacas (Santa Rosa de Cabal) / En Vivo',
        `modalidad` varchar(50) DEFAULT 'Híbrida (Presencial y Virtual)',
        `expositor` varchar(255) DEFAULT 'Equipo ADN de Amor & Invitados',
        `imagen` varchar(500) DEFAULT NULL,
        `cupos` varchar(100) DEFAULT 'Entrada libre con inscripción previa',
        `whatsapp_contacto` varchar(50) DEFAULT '573162522445',
        `estado` enum('activo','proximo','finalizado') DEFAULT 'proximo',
        `destacado` tinyint(1) DEFAULT 1,
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

    $pdo->exec($sql);

    // Verificar si ya existen registros
    $count = $pdo->query("SELECT COUNT(*) FROM eventos")->fetchColumn();
    if ($count == 0) {
        $insert = "INSERT INTO eventos (titulo, subtitulo, descripcion, fecha, hora, dia_semana, lugar, modalidad, expositor, imagen, cupos, whatsapp_contacto, estado, destacado) VALUES
        ('Crianza con Amor y Propósito: Claves para el Bienestar Familiar', 
         'Fortaleciendo los lazos del hogar desde la empatía, el diálogo y la fe', 
         'Un espacio de encuentro cálido para padres, madres y cuidadores. Abordaremos herramientas prácticas sobre comunicación asertiva, disciplina positiva con amor y cómo construir un ambiente protector que potencie el propósito de vida de nuestros hijos.', 
         DATE_ADD(CURDATE(), INTERVAL (4 - WEEKDAY(CURDATE()) + 7) % 7 DAY), 
         '6:30 PM', 
         'Jueves', 
         'Sede Finca Guacas (Santa Rosa de Cabal) y En Vivo por Internet', 
         'Híbrida (Presencial y Virtual)', 
         'Equipo Psicosocial & Pastoral ADN de Amor', 
         'FOTOS BANNERS/MAMA CON ANGELICA  DEFINITIVA BANNER.webp', 
         'Entrada libre (Cupos limitados con reserva)', 
         '573162522445', 
         'proximo', 
         1),

        ('Superando la Adversidad: Resiliencia, Esperanza y Salud Emocional', 
         'Cómo renovar las fuerzas y encontrar dirección en momentos desafiantes', 
         'Espacio reflexivo y de acompañamiento donde compartiremos pautas para la gestión de las emociones, superación del desánimo y el fortalecimiento de la fe en comunidad frente a los retos cotidianos.', 
         DATE_ADD(DATE_ADD(CURDATE(), INTERVAL (4 - WEEKDAY(CURDATE()) + 7) % 7 DAY), INTERVAL 7 DAY), 
         '6:30 PM', 
         'Jueves', 
         'Sede Finca Guacas y Transmisión Online', 
         'Híbrida (Presencial y Virtual)', 
         'Mentores Invitados y Especialistas en Bienestar', 
         'FOTOS BANNERS/foto principal niños original tamaño mejorada luz.webp', 
         'Entrada libre (Cupos limitados con reserva)', 
         '573162522445', 
         'proximo', 
         0),

        ('Juventud con Visión: Descubriendo Talentos y Proyecto de Vida', 
         'Liderazgo, motivación y enfoque vocacional para adolescentes y jóvenes', 
         'Charla dinámica e interactiva enfocada en inspirar a las nuevas generaciones a identificar sus dones, trazar metas claras y construir un futuro lleno de esperanza y oportunidades reales.', 
         DATE_ADD(DATE_ADD(CURDATE(), INTERVAL (4 - WEEKDAY(CURDATE()) + 7) % 7 DAY), INTERVAL 14 DAY), 
         '6:30 PM', 
         'Jueves', 
         'Sede Finca Guacas y Transmisión Online', 
         'Híbrida (Presencial y Virtual)', 
         'Líderes de Juventud & Talleristas del CDT', 
         'FOTOS BANNERS/FOTO GRUPO JOVENES.webp', 
         'Entrada libre (Cupos limitados con reserva)', 
         '573162522445', 
         'proximo', 
         0)";
        $pdo->exec($insert);
        echo "<h2 style='font-family:sans-serif; color:#00A651; text-align:center; margin-top:50px;'>Tabla 'eventos' creada y charlas iniciales de los jueves sembradas exitosamente.</h2>";
    } else {
        echo "<h2 style='font-family:sans-serif; color:#00A651; text-align:center; margin-top:50px;'>Tabla 'eventos' verificada. Ya contiene $count eventos registrados.</h2>";
    }
} catch (PDOException $e) {
    echo "<h2 style='font-family:sans-serif; color:#E63946; text-align:center; margin-top:50px;'>Error: " . htmlspecialchars($e->getMessage()) . "</h2>";
}
?>
