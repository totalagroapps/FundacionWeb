<?php
session_start();
require '../includes/db.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

$upload_dir = '../uploads/eventos/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Auto-creación de tabla de eventos si no existe
try {
    $pdo->exec("CREATE TABLE IF NOT EXISTS `eventos` (
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
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

    // Verificar si está vacía para sembrar eventos de muestra
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
    }
} catch (Exception $e) {}

// Procesar acciones CRUD
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'add' || $action === 'edit') {
        $titulo = trim($_POST['titulo'] ?? '');
        $subtitulo = trim($_POST['subtitulo'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $fecha = $_POST['fecha'] ?? date('Y-m-d');
        $hora = trim($_POST['hora'] ?? '6:30 PM');
        $dia_semana = trim($_POST['dia_semana'] ?? 'Jueves');
        $lugar = trim($_POST['lugar'] ?? 'Sede Finca Guacas (Santa Rosa de Cabal) / En Vivo');
        $modalidad = $_POST['modalidad'] ?? 'Híbrida (Presencial y Virtual)';
        $expositor = trim($_POST['expositor'] ?? 'Equipo ADN de Amor & Invitados');
        $cupos = trim($_POST['cupos'] ?? 'Entrada libre con inscripción previa');
        $whatsapp_contacto = preg_replace('/[^0-9]/', '', $_POST['whatsapp_contacto'] ?? '573162522445');
        if (empty($whatsapp_contacto)) $whatsapp_contacto = '573162522445';
        $estado = $_POST['estado'] ?? 'proximo';
        $destacado = isset($_POST['destacado']) ? 1 : 0;

        $imagePath = ($action === 'edit') ? ($_POST['existing_image'] ?? '') : 'FOTOS BANNERS/MAMA CON ANGELICA  DEFINITIVA BANNER.webp';

        // Procesar subida de archivo si existe
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['image']['tmp_name'];
            $fileInfo = pathinfo($_FILES['image']['name']);
            $ext = strtolower($fileInfo['extension']);
            $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
            if (in_array($ext, $allowed)) {
                $filename = 'evento_' . time() . '_' . rand(100, 999) . '.' . $ext;
                $target = $upload_dir . $filename;
                if (move_uploaded_file($tmp_name, $target)) {
                    $imagePath = 'uploads/eventos/' . $filename;
                }
            }
        }

        if ($action === 'add') {
            $stmt = $pdo->prepare("INSERT INTO eventos (titulo, subtitulo, descripcion, fecha, hora, dia_semana, lugar, modalidad, expositor, imagen, cupos, whatsapp_contacto, estado, destacado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$titulo, $subtitulo, $descripcion, $fecha, $hora, $dia_semana, $lugar, $modalidad, $expositor, $imagePath, $cupos, $whatsapp_contacto, $estado, $destacado]);
        } else {
            $id = (int)$_POST['id'];
            $stmt = $pdo->prepare("UPDATE eventos SET titulo=?, subtitulo=?, descripcion=?, fecha=?, hora=?, dia_semana=?, lugar=?, modalidad=?, expositor=?, imagen=?, cupos=?, whatsapp_contacto=?, estado=?, destacado=? WHERE id=?");
            $stmt->execute([$titulo, $subtitulo, $descripcion, $fecha, $hora, $dia_semana, $lugar, $modalidad, $expositor, $imagePath, $cupos, $whatsapp_contacto, $estado, $destacado, $id]);
        }

        header('Location: eventos.php?success=1');
        exit;
    }

    if ($action === 'toggle_status') {
        $id = (int)$_POST['id'];
        $current = $_POST['current_status'] ?? 'proximo';
        $new = ($current === 'proximo' || $current === 'activo') ? 'finalizado' : 'proximo';
        $stmt = $pdo->prepare("UPDATE eventos SET estado=? WHERE id=?");
        $stmt->execute([$new, $id]);
        header('Location: eventos.php?success=1');
        exit;
    }

    if ($action === 'delete') {
        $id = (int)$_POST['id'];
        $stmt = $pdo->prepare("DELETE FROM eventos WHERE id=?");
        $stmt->execute([$id]);
        header('Location: eventos.php?success=1');
        exit;
    }
}

// Obtener todas las charlas ordenadas por fecha más reciente/próxima
$stmt = $pdo->query("SELECT * FROM eventos ORDER BY CASE WHEN estado = 'proximo' THEN 0 ELSE 1 END, fecha ASC, id DESC");
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$totalEventos = count($eventos);
$proximosCount = count(array_filter($eventos, fn($e) => $e['estado'] === 'proximo' || $e['estado'] === 'activo'));
$finalizadosCount = count(array_filter($eventos, fn($e) => $e['estado'] === 'finalizado'));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charlas con Propósito de los Jueves | Admin ADN</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-dark: #f1f5f9; --bg-card: #ffffff; --bg-hover: #f8fafc;
            --text-main: #1e293b; --text-muted: #64748b;
            --primary: #ea5a00; --primary-hover: #cc4d00; --secondary: #00103e;
            --border-light: #e2e8f0; --surface: #ffffff;
            --danger: #ef4444; --success: #10b981;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
            --shadow-md: 0 8px 25px rgba(0,0,0,0.06);
            --font-heading: 'Outfit', sans-serif;
            --font-body: 'Inter', sans-serif;
        }

        body.dark-mode {
            --bg-dark: #0f172a; --bg-card: #1e293b; --bg-hover: #334155;
            --text-main: #f8fafc; --text-muted: #94a3b8;
            --border-light: #334155; --surface: #1e293b;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.4);
            --shadow-md: 0 8px 25px rgba(0,0,0,0.3);
        }
        body.dark-mode .logo-area img {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 4px 8px;
            border-radius: 6px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: var(--font-body); background-color: var(--bg-dark); color: var(--text-main);
            min-height: 100vh; overflow-x: hidden; transition: background-color 0.3s, color 0.3s;
        }
        
        .preload * { transition: none !important; }
        
        .top-navbar {
            background-color: var(--surface); height: 60px; display: flex; align-items: center;
            justify-content: space-between; padding: 0 2rem; border-bottom: 1px solid var(--border-light);
            z-index: 100; box-shadow: var(--shadow-sm); position: sticky; top: 0;
        }
        .logo-area { display: flex; align-items: center; gap: 20px; }
        .logo-area img { height: 40px; }
        .logo-divider { width: 1px; height: 30px; background: var(--border-light); }
        .page-selector { display: flex; gap: 10px; flex-wrap: wrap; }
        .page-tab {
            padding: 8px 16px; border-radius: 20px; font-family: 'Outfit', sans-serif; font-weight: 500;
            font-size: 0.95rem; cursor: pointer; transition: all 0.2s; color: var(--text-muted);
            border: 1px solid transparent; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;
        }
        .page-tab:hover { background: var(--bg-hover); color: var(--secondary); }
        .page-tab.active { background: rgba(234, 90, 0, 0.1); color: var(--primary); border-color: rgba(234, 90, 0, 0.2); font-weight: 600; }
        
        .user-actions { display: flex; align-items: center; gap: 12px; }
        .btn-icon {
            background: transparent; border: 1px solid var(--border-light); color: var(--text-main);
            width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center;
            justify-content: center; cursor: pointer; transition: all 0.2s;
        }
        .btn-icon:hover { background: var(--bg-hover); color: var(--primary); border-color: var(--primary); }
        .btn-outline {
            border: 1px solid var(--border-light); background: transparent; padding: 8px 16px;
            border-radius: 8px; color: var(--text-main); text-decoration: none; font-size: 0.9rem;
            font-weight: 500; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-outline:hover { background: var(--bg-hover); border-color: var(--border-light); }
        .btn-logout { background: #fff1f2; color: #E63946; border: none; }
        .btn-logout:hover { background: #ffe4e6; color: #d62d3a; }

        .main-content { padding: 2rem; max-width: 1280px; margin: 0 auto; }
        
        .header-actions {
            display: flex; justify-content: space-between; align-items: flex-start;
            margin-bottom: 2rem; gap: 1.5rem; flex-wrap: wrap;
        }
        .header-actions h2 { font-family: var(--font-heading); font-size: 1.85rem; color: var(--text-main); display: flex; align-items: center; gap: 10px; }
        .header-actions p { color: var(--text-muted); font-size: 0.95rem; margin-top: 4px; }
        
        .btn-primary {
            background: var(--primary); color: white; border: none; padding: 0.75rem 1.4rem;
            border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.2s;
            text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;
            font-family: var(--font-heading); font-size: 0.95rem;
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(234, 90, 0, 0.3); background: var(--primary-hover); }

        .btn-secondary {
            background: var(--bg-hover); color: var(--text-main); border: 1px solid var(--border-light);
            padding: 0.6rem 1rem; border-radius: 8px; font-weight: 500; cursor: pointer;
            font-family: var(--font-body); font-size: 0.88rem; display: inline-flex; align-items: center; gap: 6px;
        }
        .btn-secondary:hover { background: var(--border-light); }

        .kpi-row {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.25rem; margin-bottom: 2rem;
        }
        .kpi-card {
            background: var(--bg-card); border: 1px solid var(--border-light); border-radius: 12px;
            padding: 1.25rem; display: flex; align-items: center; gap: 1rem; box-shadow: var(--shadow-sm);
        }
        .kpi-icon {
            width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center;
            justify-content: center; font-size: 1.3rem;
        }
        .kpi-title { font-size: 0.85rem; color: var(--text-muted); font-weight: 500; }
        .kpi-val { font-size: 1.7rem; font-weight: 700; font-family: var(--font-heading); color: var(--text-main); }

        .toolbar {
            background: var(--bg-card); border: 1px solid var(--border-light); border-radius: 12px;
            padding: 1rem 1.25rem; margin-bottom: 2rem; display: flex; justify-content: space-between;
            align-items: center; gap: 1rem; flex-wrap: wrap;
        }
        .filter-tabs { display: flex; gap: 8px; }
        .filter-tab {
            padding: 6px 14px; border-radius: 20px; font-size: 0.85rem; font-weight: 600;
            background: var(--bg-dark); color: var(--text-muted); border: 1px solid transparent; cursor: pointer;
        }
        .filter-tab.active { background: var(--primary); color: #fff; }

        .search-box {
            position: relative; width: 280px; max-width: 100%;
        }
        .search-box input {
            width: 100%; padding: 0.6rem 1rem 0.6rem 2.4rem; border-radius: 8px;
            border: 1px solid var(--border-light); background: var(--bg-dark); color: var(--text-main);
            font-size: 0.9rem; font-family: var(--font-body);
        }
        .search-box i {
            position: absolute; left: 0.85rem; top: 50%; transform: translateY(-50%);
            color: var(--text-muted); font-size: 0.9rem;
        }

        /* Grid de Charlas */
        .grid-events {
            display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 1.75rem;
        }
        .event-card {
            background: var(--bg-card); border: 1px solid var(--border-light); border-radius: 16px;
            overflow: hidden; display: flex; flex-direction: column; box-shadow: var(--shadow-sm);
            transition: all 0.3s ease; position: relative;
        }
        .event-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-md); border-color: rgba(234, 90, 0, 0.3); }

        .event-card-img-wrap {
            position: relative; height: 180px; background: #e2e8f0; overflow: hidden;
        }
        .event-card-img-wrap img {
            width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;
        }
        .event-card:hover .event-card-img-wrap img { transform: scale(1.05); }

        .event-date-badge {
            position: absolute; top: 12px; left: 12px; background: #ffffff; color: var(--secondary);
            border-radius: 10px; padding: 6px 10px; text-align: center; box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            font-family: var(--font-heading); line-height: 1.1; min-width: 52px; z-index: 2;
        }
        .event-date-day { font-size: 1.3rem; font-weight: 700; color: var(--primary); }
        .event-date-month { font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; }

        .event-status-badge {
            position: absolute; top: 12px; right: 12px; padding: 4px 10px; border-radius: 20px;
            font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; z-index: 2;
        }
        .status-proximo { background: #dcfce7; color: #15803d; border: 1px solid rgba(21,128,61,0.2); }
        .status-finalizado { background: #f1f5f9; color: #64748b; border: 1px solid rgba(100,116,139,0.2); }

        .event-card-body {
            padding: 1.4rem; display: flex; flex-direction: column; flex-grow: 1; gap: 0.75rem;
        }
        .event-meta {
            display: flex; gap: 10px; flex-wrap: wrap; font-size: 0.82rem; color: var(--text-muted);
        }
        .event-pill {
            display: inline-flex; align-items: center; gap: 5px; background: var(--bg-dark);
            padding: 3px 9px; border-radius: 6px; font-weight: 500;
        }
        .event-title {
            font-family: var(--font-heading); font-size: 1.18rem; font-weight: 700;
            color: var(--text-main); line-height: 1.35;
        }
        .event-sub {
            font-size: 0.88rem; color: var(--primary); font-weight: 600; line-height: 1.4;
        }
        .event-desc {
            font-size: 0.88rem; color: var(--text-muted); line-height: 1.5; display: -webkit-box;
            -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;
        }
        .event-info-line {
            font-size: 0.84rem; color: var(--text-main); display: flex; align-items: center; gap: 8px;
        }
        .event-info-line i { color: var(--primary); width: 16px; text-align: center; }

        .event-card-footer {
            padding: 1rem 1.4rem; border-top: 1px solid var(--border-light); background: var(--bg-hover);
            display: flex; justify-content: space-between; align-items: center; gap: 0.5rem;
        }

        /* Modal */
        .modal {
            display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.75);
            backdrop-filter: blur(5px); z-index: 1000; align-items: center; justify-content: center; padding: 1.5rem;
        }
        .modal.active { display: flex; }
        .modal-content {
            background: var(--bg-card); border: 1px solid var(--border-light); border-radius: 16px;
            padding: 2rem; width: 100%; max-width: 720px; max-height: 90vh; overflow-y: auto;
            position: relative; box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }
        .modal-close {
            position: absolute; top: 1.25rem; right: 1.25rem; background: none; border: none;
            color: var(--text-muted); font-size: 1.5rem; cursor: pointer; width: 32px; height: 32px;
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
        }
        .modal-close:hover { background: var(--bg-dark); color: var(--danger); }
        .modal-title { font-family: var(--font-heading); font-size: 1.4rem; margin-bottom: 1.5rem; color: var(--text-main); }

        .form-grid {
            display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;
        }
        @media (max-width: 640px) {
            .form-grid { grid-template-columns: 1fr; }
        }
        .form-group { margin-bottom: 1.25rem; }
        .form-group.full { grid-column: 1 / -1; }
        .form-group label {
            display: block; margin-bottom: 0.4rem; font-weight: 600; font-size: 0.85rem; color: var(--text-muted);
        }
        .form-control {
            width: 100%; background: var(--bg-dark); border: 1px solid var(--border-light);
            border-radius: 8px; padding: 0.65rem 0.9rem; color: var(--text-main);
            font-family: var(--font-body); font-size: 0.92rem;
        }
        .form-control:focus {
            outline: none; border-color: var(--primary); box-shadow: 0 0 0 2px rgba(234, 90, 0, 0.2);
        }
        textarea.form-control { resize: vertical; min-height: 90px; }

        .checkbox-label {
            display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 0.9rem;
            color: var(--text-main); font-weight: 500;
        }

        .alert {
            background: rgba(16, 185, 129, 0.1); border: 1px solid var(--success); color: var(--success);
            padding: 1rem 1.25rem; border-radius: 8px; margin-bottom: 2rem; display: flex;
            align-items: center; gap: 0.75rem; font-weight: 500;
        }
    </style>
</head>
<body class="preload">
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add('dark-mode');
        }
    </script>

    <!-- Top Navbar -->
    <header class="top-navbar">
        <div class="logo-area">
            <img src="../LOGO Y VISUAL WEB BOTONES/logo ADN_de_Amor_color_rectangulo.png" alt="ADN de Amor">
            <div class="logo-divider"></div>
            <div class="page-selector">
                <a href="dashboard.php#inicio" class="page-tab">Inicio</a>
                <a href="dashboard.php#nosotros" class="page-tab">Quiénes Somos</a>
                <a href="dashboard.php#programas" class="page-tab">Qué Hacemos</a>
                <a href="dashboard.php#apadrinar" class="page-tab">Qué Puedes Hacer</a>
                <a href="productos.php" class="page-tab"><i class="fas fa-store"></i> Gestionar Tienda</a>
                <a href="eventos.php" class="page-tab active"><i class="fas fa-calendar-alt"></i> Charlas y Eventos</a>
                <a href="mensajes.php" class="page-tab"><i class="fas fa-inbox"></i> Formularios Recibidos</a>
            </div>
        </div>
        <div class="user-actions">
            <button class="btn-icon" id="darkModeToggle" title="Cambiar Tema">
                <i class="fas fa-moon"></i>
            </button>
            <a href="/programas#eventos" target="_blank" class="btn-outline"><i class="fas fa-external-link-alt"></i> Ver en Web</a>
            <a href="logout.php" class="btn-outline btn-logout"><i class="fas fa-sign-out-alt"></i> Salir</a>
        </div>
    </header>

    <main class="main-content">
        <?php if(isset($_GET['success'])): ?>
            <div class="alert">
                <i class="fas fa-check-circle" style="font-size: 1.2rem;"></i> Acción realizada correctamente. Los cambios ya se reflejan en la página de Qué Hacemos.
            </div>
        <?php endif; ?>

        <div class="header-actions">
            <div>
                <h2><i class="fas fa-calendar-check" style="color: var(--primary);"></i> Charlas con Propósito de los Jueves</h2>
                <p>Gestiona y programa las charlas semanales que se muestran en la sección de <strong>Qué Hacemos</strong>.</p>
            </div>
            <button type="button" class="btn-primary" onclick="openAddModal()">
                <i class="fas fa-plus-circle"></i> Nueva Charla del Jueves
            </button>
        </div>

        <!-- KPIs -->
        <div class="kpi-row">
            <div class="kpi-card">
                <div class="kpi-icon" style="background: rgba(234, 90, 0, 0.1); color: var(--primary);">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div>
                    <div class="kpi-title">Total de Charlas</div>
                    <div class="kpi-val"><?= $totalEventos ?></div>
                </div>
            </div>
            <div class="kpi-card">
                <div class="kpi-icon" style="background: rgba(16, 185, 129, 0.1); color: var(--success);">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <div class="kpi-title">Próximas en Agenda</div>
                    <div class="kpi-val"><?= $proximosCount ?></div>
                </div>
            </div>
            <div class="kpi-card">
                <div class="kpi-icon" style="background: rgba(100, 116, 139, 0.1); color: var(--text-muted);">
                    <i class="fas fa-check-double"></i>
                </div>
                <div>
                    <div class="kpi-title">Finalizadas / Histórico</div>
                    <div class="kpi-val"><?= $finalizadosCount ?></div>
                </div>
            </div>
        </div>

        <!-- Barra de herramientas -->
        <div class="toolbar">
            <div class="filter-tabs">
                <button type="button" class="filter-tab active" data-filter="all">Todas (<?= $totalEventos ?>)</button>
                <button type="button" class="filter-tab" data-filter="proximo">Próximas (<?= $proximosCount ?>)</button>
                <button type="button" class="filter-tab" data-filter="finalizado">Finalizadas (<?= $finalizadosCount ?>)</button>
            </div>
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchEvent" placeholder="Buscar por tema o expositor...">
            </div>
        </div>

        <!-- Rejilla de Charlas -->
        <div class="grid-events" id="eventsGrid">
            <?php if (empty($eventos)): ?>
                <div style="grid-column: 1 / -1; text-align: center; padding: 4rem 1rem; background: var(--bg-card); border-radius: 16px; border: 1px dashed var(--border-light);">
                    <i class="fas fa-calendar-plus" style="font-size: 3rem; color: var(--text-muted); margin-bottom: 1rem; display: block;"></i>
                    <h3 style="font-family: var(--font-heading); margin-bottom: 0.5rem;">No hay charlas registradas aún</h3>
                    <p style="color: var(--text-muted); max-width: 450px; margin: 0 auto 1.5rem auto;">Crea la primera charla de los jueves para comenzar a recibir inscripciones desde la web.</p>
                    <button type="button" class="btn-primary" onclick="openAddModal()">
                        <i class="fas fa-plus"></i> Crear Charla
                    </button>
                </div>
            <?php else: ?>
                <?php foreach ($eventos as $e): 
                    $fechaObj = strtotime($e['fecha']);
                    $meses = ['01'=>'ENE','02'=>'FEB','03'=>'MAR','04'=>'ABR','05'=>'MAY','06'=>'JUN','07'=>'JUL','08'=>'AGO','09'=>'SEP','10'=>'OCT','11'=>'NOV','12'=>'DIC'];
                    $diaNum = date('d', $fechaObj);
                    $mesNum = date('m', $fechaObj);
                    $mesNom = $meses[$mesNum] ?? 'MES';
                    $imgUrl = !empty($e['imagen']) ? '../' . ltrim($e['imagen'], '/') : '../FOTOS BANNERS/MAMA CON ANGELICA  DEFINITIVA BANNER.webp';
                    $isProximo = ($e['estado'] === 'proximo' || $e['estado'] === 'activo');
                ?>
                    <div class="event-card" data-status="<?= $isProximo ? 'proximo' : 'finalizado' ?>" data-search="<?= strtolower(htmlspecialchars($e['titulo'] . ' ' . $e['subtitulo'] . ' ' . $e['expositor'])) ?>">
                        <div class="event-card-img-wrap">
                            <img src="<?= htmlspecialchars($imgUrl) ?>" alt="<?= htmlspecialchars($e['titulo']) ?>" onerror="this.src='../FOTOS BANNERS/MAMA CON ANGELICA  DEFINITIVA BANNER.webp'">
                            <div class="event-date-badge">
                                <div class="event-date-day"><?= $diaNum ?></div>
                                <div class="event-date-month"><?= $mesNom ?></div>
                            </div>
                            <span class="event-status-badge <?= $isProximo ? 'status-proximo' : 'status-finalizado' ?>">
                                <?= $isProximo ? '<i class="fas fa-circle" style="font-size:0.5rem; vertical-align:middle; margin-right:4px;"></i> Próxima' : '<i class="fas fa-check"></i> Finalizada' ?>
                            </span>
                        </div>
                        <div class="event-card-body">
                            <div class="event-meta">
                                <span class="event-pill"><i class="far fa-clock"></i> <?= htmlspecialchars($e['hora']) ?></span>
                                <span class="event-pill"><i class="fas fa-video"></i> <?= htmlspecialchars($e['modalidad']) ?></span>
                                <?php if($e['destacado']): ?>
                                    <span class="event-pill" style="background: rgba(234, 90, 0, 0.1); color: var(--primary); font-weight: 600;"><i class="fas fa-star"></i> Destacada</span>
                                <?php endif; ?>
                            </div>

                            <h3 class="event-title"><?= htmlspecialchars($e['titulo']) ?></h3>
                            <?php if(!empty($e['subtitulo'])): ?>
                                <div class="event-sub"><?= htmlspecialchars($e['subtitulo']) ?></div>
                            <?php endif; ?>

                            <p class="event-desc"><?= htmlspecialchars($e['descripcion']) ?></p>

                            <div style="margin-top: auto; display: flex; flex-direction: column; gap: 6px; padding-top: 0.5rem;">
                                <div class="event-info-line">
                                    <i class="fas fa-user-tie"></i>
                                    <span><strong>Expositor:</strong> <?= htmlspecialchars($e['expositor']) ?></span>
                                </div>
                                <div class="event-info-line">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span><?= htmlspecialchars($e['lugar']) ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="event-card-footer">
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="action" value="toggle_status">
                                <input type="hidden" name="id" value="<?= $e['id'] ?>">
                                <input type="hidden" name="current_status" value="<?= $e['estado'] ?>">
                                <button type="submit" class="btn-secondary" title="<?= $isProximo ? 'Marcar como finalizada' : 'Reactivar como próxima' ?>">
                                    <i class="fas <?= $isProximo ? 'fa-check' : 'fa-undo' ?>"></i> <?= $isProximo ? 'Finalizar' : 'Reactivar' ?>
                                </button>
                            </form>

                            <div style="display: flex; gap: 6px;">
                                <button type="button" class="btn-secondary" onclick='openEditModal(<?= json_encode($e, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>)'>
                                    <i class="fas fa-edit"></i> Editar
                                </button>
                                <form method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta charla?');" style="display:inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?= $e['id'] ?>">
                                    <button type="submit" class="btn-secondary" style="color: var(--danger);" title="Eliminar charla">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </main>

    <!-- Modal para Agregar / Editar Charla -->
    <div class="modal" id="eventModal">
        <div class="modal-content">
            <button type="button" class="modal-close" onclick="closeModal()">&times;</button>
            <h3 class="modal-title" id="modalTitle">Nueva Charla del Jueves</h3>

            <form method="POST" enctype="multipart/form-data" id="eventForm">
                <input type="hidden" name="action" id="formAction" value="add">
                <input type="hidden" name="id" id="eventId" value="">
                <input type="hidden" name="existing_image" id="existingImage" value="">

                <div class="form-grid">
                    <div class="form-group full">
                        <label>Título de la Charla *</label>
                        <input type="text" name="titulo" id="inputTitulo" class="form-control" required placeholder="Ej: Crianza con Amor y Propósito">
                    </div>

                    <div class="form-group full">
                        <label>Subtítulo o Frase Clave</label>
                        <input type="text" name="subtitulo" id="inputSubtitulo" class="form-control" placeholder="Ej: Fortaleciendo los lazos del hogar desde la empatía y la fe">
                    </div>

                    <div class="form-group">
                        <label>Fecha del Evento (Jueves) *</label>
                        <input type="date" name="fecha" id="inputFecha" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Hora de Inicio</label>
                        <input type="text" name="hora" id="inputHora" class="form-control" value="6:30 PM" placeholder="Ej: 6:30 PM">
                    </div>

                    <div class="form-group">
                        <label>Día de la Semana</label>
                        <input type="text" name="dia_semana" id="inputDia" class="form-control" value="Jueves">
                    </div>

                    <div class="form-group">
                        <label>Modalidad</label>
                        <select name="modalidad" id="inputModalidad" class="form-control">
                            <option value="Híbrida (Presencial y Virtual)">Híbrida (Presencial y Virtual)</option>
                            <option value="Presencial">Solo Presencial</option>
                            <option value="Virtual (En Vivo)">Solo Virtual (En Vivo)</option>
                        </select>
                    </div>

                    <div class="form-group full">
                        <label>Expositor / Facilitador / Invitado</label>
                        <input type="text" name="expositor" id="inputExpositor" class="form-control" value="Equipo ADN de Amor & Invitados" placeholder="Ej: Psic. María Rodríguez / Equipo ADN de Amor">
                    </div>

                    <div class="form-group full">
                        <label>Lugar / Sede</label>
                        <input type="text" name="lugar" id="inputLugar" class="form-control" value="Sede Finca Guacas (Santa Rosa de Cabal) / En Vivo" placeholder="Lugar presencial y/o plataforma">
                    </div>

                    <div class="form-group full">
                        <label>Descripción del Tema y Objetivos *</label>
                        <textarea name="descripcion" id="inputDescripcion" class="form-control" rows="4" required placeholder="Describe los temas que se tratarán, a quién va dirigida y los aprendizajes que se llevarán los asistentes..."></textarea>
                    </div>

                    <div class="form-group">
                        <label>Cupos / Acceso</label>
                        <input type="text" name="cupos" id="inputCupos" class="form-control" value="Entrada libre (Cupos limitados con reserva)">
                    </div>

                    <div class="form-group">
                        <label>WhatsApp para Inscripciones</label>
                        <input type="text" name="whatsapp_contacto" id="inputWhatsapp" class="form-control" value="573162522445">
                    </div>

                    <div class="form-group">
                        <label>Estado de la Charla</label>
                        <select name="estado" id="inputEstado" class="form-control">
                            <option value="proximo">Próxima (En Agenda / Visible)</option>
                            <option value="finalizado">Finalizada (Archivada)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Afiche / Fotografía</label>
                        <input type="file" name="image" id="inputImage" class="form-control" accept="image/*">
                        <small style="color: var(--text-muted); font-size: 0.78rem; display: block; margin-top: 4px;">Si no subes una nueva, se mantendrá la imagen actual o predeterminada.</small>
                    </div>

                    <div class="form-group full" style="margin-top: 0.5rem;">
                        <label class="checkbox-label">
                            <input type="checkbox" name="destacado" id="inputDestacado" value="1" checked>
                            <span>Marcar como Charla Destacada (Aparece al inicio de la agenda)</span>
                        </label>
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 1.5rem; border-top: 1px solid var(--border-light); padding-top: 1.25rem;">
                    <button type="button" class="btn-secondary" onclick="closeModal()">Cancelar</button>
                    <button type="submit" class="btn-primary" id="submitBtn">
                        <i class="fas fa-save"></i> Guardar Charla
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Prevenir flash
        window.addEventListener('load', () => {
            document.body.classList.remove('preload');
        });

        // Modo oscuro
        const darkModeToggle = document.getElementById('darkModeToggle');
        if (darkModeToggle) {
            darkModeToggle.addEventListener('click', () => {
                document.body.classList.toggle('dark-mode');
                const isDark = document.body.classList.contains('dark-mode');
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
                const icon = darkModeToggle.querySelector('i');
                if (icon) {
                    icon.className = isDark ? 'fas fa-sun' : 'fas fa-moon';
                }
            });
            if (localStorage.getItem('theme') === 'dark') {
                const icon = darkModeToggle.querySelector('i');
                if (icon) icon.className = 'fas fa-sun';
            }
        }

        // Filtro y Búsqueda
        const filterTabs = document.querySelectorAll('.filter-tab');
        const eventCards = document.querySelectorAll('.event-card');
        const searchInput = document.getElementById('searchEvent');
        let currentFilter = 'all';

        filterTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                filterTabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                currentFilter = tab.getAttribute('data-filter');
                applyFilters();
            });
        });

        if (searchInput) {
            searchInput.addEventListener('input', applyFilters);
        }

        function applyFilters() {
            const query = searchInput ? searchInput.value.toLowerCase().trim() : '';
            eventCards.forEach(card => {
                const status = card.getAttribute('data-status');
                const searchStr = card.getAttribute('data-search') || '';
                
                const matchesFilter = (currentFilter === 'all') || (status === currentFilter);
                const matchesSearch = !query || searchStr.includes(query);

                if (matchesFilter && matchesSearch) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Modal
        const modal = document.getElementById('eventModal');
        const modalTitle = document.getElementById('modalTitle');
        const formAction = document.getElementById('formAction');
        const eventId = document.getElementById('eventId');
        const existingImage = document.getElementById('existingImage');

        function openAddModal() {
            document.getElementById('eventForm').reset();
            modalTitle.innerText = 'Nueva Charla del Jueves';
            formAction.value = 'add';
            eventId.value = '';
            existingImage.value = '';
            document.getElementById('inputHora').value = '6:30 PM';
            document.getElementById('inputDia').value = 'Jueves';
            document.getElementById('inputLugar').value = 'Sede Finca Guacas (Santa Rosa de Cabal) / En Vivo';
            document.getElementById('inputExpositor').value = 'Equipo ADN de Amor & Invitados';
            document.getElementById('inputCupos').value = 'Entrada libre (Cupos limitados con reserva)';
            document.getElementById('inputWhatsapp').value = '573162522445';
            document.getElementById('inputDestacado').checked = true;
            
            // Sugerir la fecha del próximo jueves
            const today = new Date();
            const dayOfWeek = today.getDay(); // 0 domingo, 4 jueves
            let daysUntilNextThursday = (4 - dayOfWeek + 7) % 7;
            if (daysUntilNextThursday === 0) daysUntilNextThursday = 7;
            const nextThursday = new Date(today);
            nextThursday.setDate(today.getDate() + daysUntilNextThursday);
            const yyyy = nextThursday.getFullYear();
            const mm = String(nextThursday.getMonth() + 1).padStart(2, '0');
            const dd = String(nextThursday.getDate()).padStart(2, '0');
            document.getElementById('inputFecha').value = `${yyyy}-${mm}-${dd}`;

            modal.classList.add('active');
        }

        function openEditModal(eventData) {
            modalTitle.innerText = 'Editar Charla del Jueves';
            formAction.value = 'edit';
            eventId.value = eventData.id;
            existingImage.value = eventData.imagen || '';

            document.getElementById('inputTitulo').value = eventData.titulo || '';
            document.getElementById('inputSubtitulo').value = eventData.subtitulo || '';
            document.getElementById('inputFecha').value = eventData.fecha || '';
            document.getElementById('inputHora').value = eventData.hora || '6:30 PM';
            document.getElementById('inputDia').value = eventData.dia_semana || 'Jueves';
            document.getElementById('inputModalidad').value = eventData.modalidad || 'Híbrida (Presencial y Virtual)';
            document.getElementById('inputExpositor').value = eventData.expositor || '';
            document.getElementById('inputLugar').value = eventData.lugar || '';
            document.getElementById('inputDescripcion').value = eventData.descripcion || '';
            document.getElementById('inputCupos').value = eventData.cupos || '';
            document.getElementById('inputWhatsapp').value = eventData.whatsapp_contacto || '573162522445';
            document.getElementById('inputEstado').value = eventData.estado || 'proximo';
            document.getElementById('inputDestacado').checked = (parseInt(eventData.destacado) === 1);

            modal.classList.add('active');
        }

        function closeModal() {
            modal.classList.remove('active');
        }

        window.onclick = function(e) {
            if (e.target === modal) {
                closeModal();
            }
        };
    </script>
</body>
</html>
