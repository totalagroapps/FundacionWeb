<?php
session_start();
require '../includes/db.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Asegurar que la tabla existe con todas sus columnas
try {
    $pdo->exec("CREATE TABLE IF NOT EXISTS `contact_messages` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `form_type` varchar(50) NOT NULL DEFAULT 'contacto',
        `name` varchar(255) NOT NULL,
        `email` varchar(255) NOT NULL,
        `phone` varchar(100) DEFAULT NULL,
        `location` varchar(255) DEFAULT NULL,
        `modality` varchar(100) DEFAULT NULL,
        `company` varchar(255) DEFAULT NULL,
        `position` varchar(255) DEFAULT NULL,
        `university` varchar(255) DEFAULT NULL,
        `career` varchar(255) DEFAULT NULL,
        `availability` varchar(100) DEFAULT NULL,
        `message` text DEFAULT NULL,
        `ip_address` varchar(45) DEFAULT NULL,
        `status` varchar(20) NOT NULL DEFAULT 'nuevo',
        `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

    $cols = $pdo->query("SHOW COLUMNS FROM contact_messages")->fetchAll(PDO::FETCH_COLUMN);
    if (!in_array('company', $cols)) { $pdo->exec("ALTER TABLE contact_messages ADD COLUMN company varchar(255) NULL AFTER modality"); }
    if (!in_array('position', $cols)) { $pdo->exec("ALTER TABLE contact_messages ADD COLUMN position varchar(255) NULL AFTER company"); }
    if (!in_array('university', $cols)) { $pdo->exec("ALTER TABLE contact_messages ADD COLUMN university varchar(255) NULL AFTER position"); }
    if (!in_array('career', $cols)) { $pdo->exec("ALTER TABLE contact_messages ADD COLUMN career varchar(255) NULL AFTER university"); }
    if (!in_array('availability', $cols)) { $pdo->exec("ALTER TABLE contact_messages ADD COLUMN availability varchar(100) NULL AFTER career"); }
} catch (\Exception $e) {}

// Procesar acciones (eliminar o cambiar estado)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $msg_id = intval($_POST['id'] ?? 0);
    
    if ($action === 'delete' && $msg_id > 0) {
        $stmt = $pdo->prepare("DELETE FROM contact_messages WHERE id = ?");
        $stmt->execute([$msg_id]);
        header('Location: mensajes.php?deleted=1');
        exit;
    }
    
    if ($action === 'toggle_status' && $msg_id > 0) {
        $current = $_POST['current_status'] ?? 'nuevo';
        $new_status = ($current === 'nuevo') ? 'atendido' : 'nuevo';
        $stmt = $pdo->prepare("UPDATE contact_messages SET status = ? WHERE id = ?");
        $stmt->execute([$new_status, $msg_id]);
        header('Location: mensajes.php?updated=1');
        exit;
    }
}

// Obtener mensajes
$filter = $_GET['filter'] ?? 'all';
$sql = "SELECT * FROM contact_messages";
$params = [];

if ($filter === 'contacto') {
    $sql .= " WHERE form_type = 'contacto'";
} elseif ($filter === 'apadrinar') {
    $sql .= " WHERE form_type = 'apadrinar'";
} elseif ($filter === 'empresa') {
    $sql .= " WHERE form_type = 'empresa'";
} elseif ($filter === 'practicas') {
    $sql .= " WHERE form_type = 'practicas'";
} elseif ($filter === 'nuevo') {
    $sql .= " WHERE status = 'nuevo'";
}

$sql .= " ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Conteo total y nuevos
$count_all = $pdo->query("SELECT COUNT(*) FROM contact_messages")->fetchColumn();
$count_nuevos = $pdo->query("SELECT COUNT(*) FROM contact_messages WHERE status = 'nuevo'")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bandeja de Mensajes y Formularios | Panel ADN de Amor</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #EA5A00;
            --primary-dark: #cc4e00;
            --secondary: #00103E;
            --bg-body: #f8fafc;
            --bg-card: #ffffff;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border-light: #e2e8f0;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            --header-bg: #ffffff;
        }

        body.dark-mode {
            --bg-body: #090d16;
            --bg-card: #131b2e;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --border-light: #1e293b;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.5);
            --header-bg: #0f172a;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; background-color: var(--bg-body); color: var(--text-main); line-height: 1.5; }
        
        .top-navbar {
            background-color: var(--header-bg);
            border-bottom: 1px solid var(--border-light);
            padding: 0 2rem;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .logo-area { display: flex; align-items: center; gap: 1.5rem; }
        .logo-area img { height: 40px; }
        .logo-divider { width: 1px; height: 30px; background: var(--border-light); }
        .page-selector { display: flex; align-items: center; gap: 0.5rem; }
        .page-tab {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            color: var(--text-muted);
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s;
            cursor: pointer;
        }
        .page-tab:hover, .page-tab.active {
            background: rgba(234, 90, 0, 0.1);
            color: var(--primary);
        }
        .user-actions { display: flex; align-items: center; gap: 1rem; }
        .btn-icon {
            background: transparent;
            border: 1px solid var(--border-light);
            color: var(--text-muted);
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-outline {
            border: 1px solid var(--border-light);
            background: transparent;
            color: var(--text-main);
            padding: 0.5rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
        }
        .btn-logout { color: #ef4444; border-color: rgba(239, 68, 68, 0.3); }

        .main-content { max-width: 1200px; margin: 2rem auto; padding: 0 1.5rem; }
        .header-title { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem; }
        .header-title h1 { font-family: 'Outfit', sans-serif; font-size: 1.8rem; font-weight: 700; }
        .header-title p { color: var(--text-muted); font-size: 0.95rem; }

        .filters-bar {
            display: flex;
            gap: 0.5rem;
            background: var(--bg-card);
            padding: 0.5rem;
            border-radius: 8px;
            border: 1px solid var(--border-light);
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }
        .filter-btn {
            padding: 0.4rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--text-muted);
            transition: all 0.2s;
        }
        .filter-btn.active, .filter-btn:hover {
            background: var(--primary);
            color: white;
        }

        .messages-list { display: flex; flex-direction: column; gap: 1rem; }
        .message-card {
            background: var(--bg-card);
            border: 1px solid var(--border-light);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: var(--card-shadow);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .message-card:hover { transform: translateY(-2px); box-shadow: 0 8px 15px rgba(0,0,0,0.06); }
        .message-card.status-nuevo { border-left: 5px solid var(--primary); }
        .message-card.status-atendido { border-left: 5px solid #10b981; }

        .card-top { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem; flex-wrap: wrap; gap: 0.8rem; }
        .sender-info h3 { font-size: 1.15rem; font-weight: 600; color: var(--text-main); margin-bottom: 0.2rem; }
        .sender-meta { display: flex; gap: 1rem; color: var(--text-muted); font-size: 0.85rem; flex-wrap: wrap; }
        .sender-meta a { color: var(--primary); text-decoration: none; }
        
        .badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .badge-contacto { background: rgba(0, 16, 62, 0.1); color: var(--secondary); }
        body.dark-mode .badge-contacto { background: rgba(255, 255, 255, 0.1); color: #93c5fd; }
        .badge-apadrinar { background: rgba(234, 90, 0, 0.15); color: var(--primary); }
        .badge-empresa { background: rgba(0, 80, 133, 0.15); color: #005085; }
        body.dark-mode .badge-empresa { background: rgba(56, 189, 248, 0.2); color: #38bdf8; }
        .badge-practicas { background: rgba(16, 185, 129, 0.15); color: #059669; }
        body.dark-mode .badge-practicas { background: rgba(52, 211, 153, 0.2); color: #34d399; }

        .card-body {
            background: var(--bg-body);
            border-radius: 8px;
            padding: 1rem 1.25rem;
            margin: 1rem 0;
            font-size: 0.95rem;
            line-height: 1.6;
            color: var(--text-main);
            white-space: pre-wrap;
        }

        .card-actions { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; font-size: 0.85rem; }
        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            border: 1px solid var(--border-light);
            background: var(--bg-card);
            color: var(--text-main);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-action:hover { border-color: var(--primary); color: var(--primary); }
        .btn-whatsapp { color: #16a34a; border-color: rgba(22, 163, 74, 0.3); }
        .btn-whatsapp:hover { background: rgba(22, 163, 74, 0.1); color: #16a34a; }
        .btn-delete { color: #ef4444; border-color: rgba(239, 68, 68, 0.3); }
        .btn-delete:hover { background: rgba(239, 68, 68, 0.1); color: #ef4444; }

        .empty-state { text-align: center; padding: 4rem 1rem; background: var(--bg-card); border-radius: 12px; border: 1px solid var(--border-light); }
        .empty-state i { font-size: 3.5rem; color: var(--text-muted); margin-bottom: 1rem; }
    </style>
</head>
<body>
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add('dark-mode');
        }
    </script>

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
                <a href="mensajes.php" class="page-tab active" style="border-left: 1px solid var(--border-light); margin-left: 10px; padding-left: 15px;">
                    <i class="fas fa-inbox"></i> Formularios Recibidos
                    <?php if ($count_nuevos > 0): ?>
                        <span style="background: var(--primary); color: white; border-radius: 10px; padding: 2px 7px; font-size: 0.75rem; margin-left: 4px;"><?= $count_nuevos ?></span>
                    <?php endif; ?>
                </a>
            </div>
        </div>
        <div class="user-actions">
            <button class="btn-icon" id="darkModeToggle" title="Cambiar Tema">
                <i class="fas fa-moon"></i>
            </button>
            <a href="/" target="_blank" class="btn-outline"><i class="fas fa-globe"></i> Ver Web</a>
            <a href="logout.php" class="btn-outline btn-logout"><i class="fas fa-sign-out-alt"></i> Salir</a>
        </div>
    </header>

    <main class="main-content">
        <div class="header-title">
            <div>
                <h1>Bandeja de Formularios y Mensajes</h1>
                <p>Todos los envíos se entregan automáticamente a <strong>info@fundacionadndeamor.org</strong> y además quedan registrados aquí para su respaldo permanente.</p>
            </div>
        </div>

        <div class="filters-bar">
            <a href="mensajes.php?filter=all" class="filter-btn <?= $filter === 'all' ? 'active' : '' ?>">Todos (<?= $count_all ?>)</a>
            <a href="mensajes.php?filter=nuevo" class="filter-btn <?= $filter === 'nuevo' ? 'active' : '' ?>">Nuevos (<?= $count_nuevos ?>)</a>
            <a href="mensajes.php?filter=contacto" class="filter-btn <?= $filter === 'contacto' ? 'active' : '' ?>">Contacto</a>
            <a href="mensajes.php?filter=apadrinar" class="filter-btn <?= $filter === 'apadrinar' ? 'active' : '' ?>">Apadrinamiento</a>
            <a href="mensajes.php?filter=empresa" class="filter-btn <?= $filter === 'empresa' ? 'active' : '' ?>">Empresas</a>
            <a href="mensajes.php?filter=practicas" class="filter-btn <?= $filter === 'practicas' ? 'active' : '' ?>">Prácticas</a>
        </div>

        <?php if (empty($messages)): ?>
            <div class="empty-state">
                <i class="fas fa-envelope-open-text"></i>
                <h3>No hay mensajes en esta categoría</h3>
                <p style="color: var(--text-muted); margin-top: 0.5rem;">Cuando los usuarios completen los formularios web en el inicio o en la sección de apadrinar, aparecerán aquí y llegarán a info@fundacionadndeamor.org.</p>
            </div>
        <?php else: ?>
            <div class="messages-list">
                <?php foreach ($messages as $msg): 
                    $clean_phone = preg_replace('/[^0-9]/', '', $msg['phone'] ?? '');
                    if (strlen($clean_phone) === 10 && substr($clean_phone, 0, 1) === '3') {
                        $clean_phone = '57' . $clean_phone;
                    }
                ?>
                    <div class="message-card status-<?= htmlspecialchars($msg['status']) ?>">
                        <div class="card-top">
                            <div class="sender-info">
                                <h3><?= htmlspecialchars($msg['name']) ?></h3>
                                <div class="sender-meta">
                                    <span><i class="fas fa-envelope"></i> <a href="mailto:<?= htmlspecialchars($msg['email']) ?>"><?= htmlspecialchars($msg['email']) ?></a></span>
                                    <?php if (!empty($msg['phone'])): ?>
                                        <span><i class="fas fa-phone"></i> <?= htmlspecialchars($msg['phone']) ?></span>
                                    <?php endif; ?>
                                    <?php if (!empty($msg['location'])): ?>
                                        <span><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($msg['location']) ?></span>
                                    <?php endif; ?>
                                    <span><i class="far fa-clock"></i> <?= date('d/m/Y h:i A', strtotime($msg['created_at'])) ?></span>
                                </div>
                            </div>
                            <div style="display: flex; gap: 0.5rem; align-items: center;">
                                <?php if ($msg['form_type'] === 'empresa'): ?>
                                    <span class="badge badge-empresa"><i class="fas fa-building"></i> Alianza Empresa</span>
                                <?php elseif ($msg['form_type'] === 'practicas'): ?>
                                    <span class="badge badge-practicas"><i class="fas fa-graduation-cap"></i> Prácticas</span>
                                <?php elseif ($msg['form_type'] === 'apadrinar'): ?>
                                    <span class="badge badge-apadrinar"><i class="fas fa-heart"></i> Apadrinamiento</span>
                                <?php else: ?>
                                    <span class="badge badge-contacto"><i class="fas fa-envelope"></i> Contacto</span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if (!empty($msg['company'])): ?>
                            <div style="margin-bottom: 0.35rem; font-size: 0.95rem;">
                                <strong><i class="fas fa-building" style="color: var(--text-muted); margin-right: 4px;"></i> Empresa:</strong> 
                                <span style="font-weight: 600; color: var(--secondary);"><?= htmlspecialchars($msg['company']) ?></span>
                                <?php if (!empty($msg['position'])): ?>
                                    <span style="color: var(--text-muted);"> &bull; Cargo: <?= htmlspecialchars($msg['position']) ?></span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($msg['university'])): ?>
                            <div style="margin-bottom: 0.35rem; font-size: 0.95rem;">
                                <strong><i class="fas fa-university" style="color: var(--text-muted); margin-right: 4px;"></i> Universidad:</strong> 
                                <span style="font-weight: 600; color: var(--secondary);"><?= htmlspecialchars($msg['university']) ?></span>
                                <?php if (!empty($msg['career'])): ?>
                                    <span style="color: var(--text-muted);"> &bull; Carrera: <?= htmlspecialchars($msg['career']) ?></span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($msg['availability'])): ?>
                            <div style="margin-bottom: 0.35rem; font-size: 0.9rem;">
                                <strong><i class="far fa-calendar-check" style="color: #059669; margin-right: 4px;"></i> Disponibilidad:</strong> 
                                <span style="color: #059669; font-weight: 600;"><?= htmlspecialchars($msg['availability']) ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($msg['modality'])): ?>
                            <div style="margin-bottom: 0.5rem; font-size: 0.9rem;">
                                <strong><?= $msg['form_type'] === 'empresa' ? 'Tipo de Alianza:' : ($msg['form_type'] === 'practicas' ? 'Área de Interés:' : 'Modalidad:') ?></strong> 
                                <span style="color: var(--primary); font-weight: 600;"><?= htmlspecialchars($msg['modality']) ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($msg['message'])): ?>
                            <div class="card-body">
                                <?= htmlspecialchars($msg['message']) ?>
                            </div>
                        <?php endif; ?>

                        <div class="card-actions">
                            <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                <a href="mailto:<?= htmlspecialchars($msg['email']) ?>?subject=Re: Mensaje Fundación ADN de Amor" class="btn-action">
                                    <i class="fas fa-reply"></i> Responder por Email
                                </a>
                                <?php if (!empty($clean_phone)): ?>
                                    <a href="https://wa.me/<?= $clean_phone ?>?text=Hola%20<?= urlencode($msg['name']) ?>,%20te%20escribimos%20de%20la%20Fundaci%C3%B3n%20ADN%20de%20Amor" target="_blank" class="btn-action btn-whatsapp">
                                        <i class="fab fa-whatsapp"></i> WhatsApp
                                    </a>
                                <?php endif; ?>
                            </div>

                            <div style="display: flex; gap: 0.5rem; align-items: center;">
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="action" value="toggle_status">
                                    <input type="hidden" name="id" value="<?= $msg['id'] ?>">
                                    <input type="hidden" name="current_status" value="<?= htmlspecialchars($msg['status']) ?>">
                                    <button type="submit" class="btn-action">
                                        <?= $msg['status'] === 'nuevo' ? '<i class="fas fa-check"></i> Marcar Atendido' : '<i class="fas fa-undo"></i> Marcar Nuevo' ?>
                                    </button>
                                </form>

                                <form method="POST" style="display: inline;" onsubmit="return confirm('¿Seguro que deseas eliminar este registro?');">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?= $msg['id'] ?>">
                                    <button type="submit" class="btn-action btn-delete">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <script>
        const darkModeBtn = document.getElementById('darkModeToggle');
        darkModeBtn.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            const isDark = document.body.classList.contains('dark-mode');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            darkModeBtn.innerHTML = isDark ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
        });

        if (document.body.classList.contains('dark-mode')) {
            darkModeBtn.innerHTML = '<i class="fas fa-sun"></i>';
        }
    </script>
</body>
</html>
