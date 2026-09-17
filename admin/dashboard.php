<?php
session_start();
require '../includes/db.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Intentar leer la base de datos. Si no tiene 'page_name', asumir 'inicio'
$stmt = $pdo->query('SELECT * FROM site_content ORDER BY id ASC');
$contents = $stmt->fetchAll();

$pages = [];

foreach ($contents as $content) {
    // Fallback si el usuario no ha corrido upgrade_db.php
    $page = isset($content['page_name']) && !empty($content['page_name']) ? strtolower($content['page_name']) : 'inicio';
    $key = $content['section_key'];
    
    if (!isset($pages[$page])) {
        if ($page === 'inicio') {
            $pages[$page] = [
                'Hero Banners' => [], 'Historia' => [], 'Apadrinar' => [], 'Donar' => [],
                'Empresas' => [], 'Voluntariado' => [], 'Tienda' => [], 'Contacto y Footer' => [], 'Otras' => []
            ];
        } elseif ($page === 'nosotros') {
            $pages[$page] = [
                'Hero Banners' => [], '¿Quiénes Somos?' => [], 'Nuestra Misión' => [], 'Nuestra Historia' => [], 'Otras' => []
            ];
        } elseif ($page === 'programas') {
            $pages[$page] = [
                'Dónde Estamos' => [], 'Qué Hacemos' => [], 'CDT' => [], 'Programa Esperanza' => [], 'Misión Chocó' => [], 'Otras' => []
            ];
        } elseif ($page === 'apadrinar') {
            $pages[$page] = [
                'Hero Banners' => [], 'Intro' => [], 'Modalidades' => [], 'Cómo Funciona' => [], 'Beneficios' => [], 'Otras' => []
            ];
        } else {
            $pages[$page] = ['General' => [], 'Otras' => []];
        }
    }
    
    if ($page === 'inicio') {
        if (strpos($key, 'hero_') === 0) $pages[$page]['Hero Banners'][] = $content;
        elseif (strpos($key, 'historia_') === 0) $pages[$page]['Historia'][] = $content;
        elseif (strpos($key, 'apadrinar_') === 0) $pages[$page]['Apadrinar'][] = $content;
        elseif (strpos($key, 'donar_') === 0) $pages[$page]['Donar'][] = $content;
        elseif (strpos($key, 'empresas_') === 0) $pages[$page]['Empresas'][] = $content;
        elseif (strpos($key, 'voluntariado_') === 0) $pages[$page]['Voluntariado'][] = $content;
        elseif (strpos($key, 'tienda_') === 0) $pages[$page]['Tienda'][] = $content;
        elseif (strpos($key, 'contacto_') === 0 || strpos($key, 'footer_') === 0) $pages[$page]['Contacto y Footer'][] = $content;
        else $pages[$page]['Otras'][] = $content;
    } elseif ($page === 'nosotros') {
        if (strpos($key, 'nos_hero_') === 0) $pages[$page]['Hero Banners'][] = $content;
        elseif (strpos($key, 'nos_quienes_') === 0) $pages[$page]['¿Quiénes Somos?'][] = $content;
        elseif (strpos($key, 'nos_mision_') === 0) $pages[$page]['Nuestra Misión'][] = $content;
        elseif (strpos($key, 'nos_historia_') === 0) $pages[$page]['Nuestra Historia'][] = $content;
        else $pages[$page]['Otras'][] = $content;
    } elseif ($page === 'programas') {
        if (strpos($key, 'prog_donde_') === 0) $pages[$page]['Dónde Estamos'][] = $content;
        elseif (strpos($key, 'prog_que_') === 0) $pages[$page]['Qué Hacemos'][] = $content;
        elseif (strpos($key, 'prog_cdt_') === 0) $pages[$page]['CDT'][] = $content;
        elseif (strpos($key, 'prog_esp_') === 0) $pages[$page]['Programa Esperanza'][] = $content;
        elseif (strpos($key, 'prog_choco_') === 0) $pages[$page]['Misión Chocó'][] = $content;
        else $pages[$page]['Otras'][] = $content;
    } elseif ($page === 'apadrinar') {
        if (strpos($key, 'apad_hero_') === 0) $pages[$page]['Hero Banners'][] = $content;
        elseif (strpos($key, 'apad_intro_') === 0) $pages[$page]['Intro'][] = $content;
        elseif (strpos($key, 'apad_mod_') === 0) $pages[$page]['Modalidades'][] = $content;
        elseif (strpos($key, 'apad_como_') === 0) $pages[$page]['Cómo Funciona'][] = $content;
        elseif (strpos($key, 'apad_ben_') === 0) $pages[$page]['Beneficios'][] = $content;
        else $pages[$page]['Otras'][] = $content;
    } else {
        $pages[$page]['General'][] = $content;
    }
}

// Limpiar arrays vacíos
foreach ($pages as $p => $sections) {
    foreach ($sections as $s => $items) {
        if (empty($items)) unset($pages[$p][$s]);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Premium - ADN de Amor</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #E63946;
            --primary-hover: #d62d3a;
            --secondary: #00103e;
            --secondary-light: #001e73;
            --bg-color: #f1f5f9;
            --surface: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border-light: #e2e8f0;
            --bg-input: #f8fafc;
            --bg-hover: #f8fafc;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.05), 0 4px 6px -2px rgba(0,0,0,0.025);
            --radius-md: 12px;
            --radius-lg: 16px;
        }

        body.dark-mode {
            --bg-color: #0f172a;
            --surface: #1e293b;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --border-light: #334155;
            --secondary: #e2e8f0;
            --bg-input: #0f172a;
            --bg-hover: #334155;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.4);
            --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.4), 0 2px 4px -1px rgba(0,0,0,0.2);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.4), 0 4px 6px -2px rgba(0,0,0,0.2);
        }
        body.dark-mode .logo-area img {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 4px 8px;
            border-radius: 6px;
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background-color: var(--bg-color); color: var(--text-main); display: flex; flex-direction: column; height: 100vh; overflow: hidden; transition: background-color 0.3s, color 0.3s; }
        
        /* Top Navigation */
        .top-navbar { background-color: var(--surface); height: 60px; display: flex; align-items: center; justify-content: space-between; padding: 0 2rem; border-bottom: 1px solid var(--border-light); z-index: 20; box-shadow: var(--shadow-sm); }
        .logo-area { display: flex; align-items: center; gap: 20px; }
        .logo-area img { height: 40px; }
        .logo-divider { width: 1px; height: 30px; background: var(--border-light); }
        .page-selector { display: flex; gap: 10px; }
        .page-tab { padding: 8px 16px; border-radius: 20px; font-family: 'Outfit', sans-serif; font-weight: 500; font-size: 0.95rem; cursor: pointer; transition: all 0.2s; color: var(--text-muted); border: 1px solid transparent; }
        .page-tab:hover { background: var(--bg-hover); color: var(--secondary); }
        .page-tab.active { background: rgba(230, 57, 70, 0.1); color: var(--primary); border-color: rgba(230, 57, 70, 0.2); }
        .page-tab.disabled { opacity: 0.5; cursor: not-allowed; }
        
        .user-actions { display: flex; align-items: center; gap: 15px; }
        .btn-icon { background: transparent; border: 1px solid var(--border-light); color: var(--text-main); width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s; }
        .btn-icon:hover { background: var(--bg-hover); color: var(--primary); border-color: var(--primary); }
        .btn-outline { border: 1px solid var(--border-light); background: transparent; padding: 8px 16px; border-radius: 8px; color: var(--text-main); text-decoration: none; font-size: 0.9rem; font-weight: 500; transition: all 0.2s; }
        .btn-outline:hover { background: var(--bg-hover); border-color: var(--border-light); }
        .btn-logout { background: #fff1f2; color: var(--primary); border: none; }
        .btn-logout:hover { background: #ffe4e6; color: var(--primary-hover); }

        /* Layout Container */
        .layout-container { display: flex; flex: 1; overflow: hidden; }

        /* Sidebar (Sections) */
        .sidebar { width: 240px; background-color: var(--surface); border-right: 1px solid var(--border-light); display: flex; flex-direction: column; z-index: 10; transition: background-color 0.3s, border-color 0.3s; }
        .sidebar-title { padding: 1.2rem 1.5rem 0.5rem 1.5rem; font-family: 'Outfit', sans-serif; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: var(--text-muted); font-weight: 600; }
        .sidebar-menu { flex: 1; overflow-y: auto; padding: 0.5rem 1rem; }
        .section-item { display: flex; align-items: center; gap: 10px; padding: 10px 14px; margin-bottom: 4px; border-radius: 8px; cursor: pointer; color: var(--text-muted); font-weight: 500; font-size: 0.9rem; transition: all 0.2s; }
        .section-item i { font-size: 1.1rem; width: 24px; text-align: center; color: var(--text-muted); transition: all 0.2s; }
        .section-item:hover { background: var(--bg-hover); color: var(--secondary); }
        .section-item.active { background: var(--primary); color: #fff; box-shadow: 0 4px 10px rgba(230, 57, 70, 0.2); }
        .section-item.active i { color: #fff; }

        /* Main Content */
        .main-content { flex: 1; display: flex; flex-direction: column; overflow: hidden; position: relative; }
        
        /* Decorative Background Blob */
        .bg-blob { position: absolute; top: -100px; right: -100px; width: 400px; height: 400px; background: radial-gradient(circle, rgba(230,57,70,0.05) 0%, rgba(255,255,255,0) 70%); border-radius: 50%; z-index: 0; pointer-events: none; }
        
        .content-scroll { flex: 1; overflow-y: auto; padding: 1.5rem 2rem; z-index: 1; }
        .content-grid { display: grid; grid-template-columns: 1fr 450px; gap: 1.5rem; align-items: start; min-height: 100%; }
        .form-column { flex: 1; }
        
        /* Iframe Preview */
        .preview-column { position: sticky; top: 0; height: calc(100vh - 120px); background: var(--surface); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-md); border: 4px solid var(--surface); display: flex; flex-direction: column; transition: background-color 0.3s, border-color 0.3s; }
        .preview-header { background: var(--bg-hover); padding: 10px 15px; font-size: 0.8rem; font-weight: 600; color: var(--text-muted); display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--border-light); transition: background-color 0.3s; }
        .preview-header .dots { display: flex; gap: 6px; }
        .preview-header .dot { width: 10px; height: 10px; border-radius: 50%; background: #cbd5e1; }
        .preview-header .dot:nth-child(1) { background: #ff5f56; }
        .preview-header .dot:nth-child(2) { background: #ffbd2e; }
        .preview-header .dot:nth-child(3) { background: #27c93f; }
        .preview-iframe { flex: 1; width: 100%; border: none; background: #fff; }
        .content-header { margin-bottom: 1.5rem; }
        .content-header h2 { font-family: 'Outfit', sans-serif; font-size: 1.6rem; color: var(--secondary); font-weight: 700; margin-bottom: 5px; }
        .content-header p { color: var(--text-muted); font-size: 0.9rem; }

        /* Alert */
        .alert { background: rgba(34, 197, 94, 0.1); border-left: 4px solid #22c55e; color: #166534; padding: 1rem 1.5rem; border-radius: 0 var(--radius-md) var(--radius-md) 0; margin-bottom: 2rem; font-weight: 500; display: flex; align-items: center; gap: 10px; animation: slideIn 0.4s ease-out; }
        
        /* Form Cards */
        .page-wrapper { display: none; flex: 1; width: 100%; }
        .page-wrapper.active { display: block; }
        .section-wrapper { display: none; animation: fadeIn 0.3s ease-out; }
        .section-wrapper.active { display: block; }

        .card { background: var(--surface); border-radius: var(--radius-lg); padding: 1.5rem; box-shadow: var(--shadow-md); margin-bottom: 1.2rem; border: 1px solid var(--border-light); transition: background-color 0.3s, border-color 0.3s; }
        .card-title { display: flex; align-items: center; gap: 10px; font-family: 'Outfit', sans-serif; font-size: 1.05rem; color: var(--secondary); font-weight: 600; margin-bottom: 1.2rem; padding-bottom: 0.8rem; border-bottom: 1px solid var(--border-light); }
        .card-title i { color: var(--primary); }

        .form-group { margin-bottom: 1.2rem; }
        .form-group label { display: block; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-muted); margin-bottom: 0.4rem; }
        .form-control { width: 100%; padding: 10px 14px; border: 1px solid var(--border-light); border-radius: 6px; font-family: 'Inter', sans-serif; font-size: 0.9rem; color: var(--text-main); transition: all 0.2s; background: var(--bg-input); }
        .form-control:focus { outline: none; border-color: rgba(230, 57, 70, 0.4); background: var(--surface); box-shadow: 0 0 0 4px rgba(230, 57, 70, 0.1); }
        textarea.form-control { resize: vertical; min-height: 80px; line-height: 1.4; }
        
        /* Modern Image Preview */
        .image-upload-box { display: flex; gap: 20px; align-items: flex-start; background: var(--bg-input); border: 1px dashed var(--border-light); padding: 1.5rem; border-radius: 12px; margin-top: 0.5rem; transition: all 0.2s; }
        .image-upload-box:hover { border-color: var(--primary); background: var(--surface); box-shadow: var(--shadow-sm); }
        .img-preview { width: 140px; height: 100px; object-fit: cover; border-radius: 8px; box-shadow: var(--shadow-sm); border: 2px solid var(--surface); }
        .img-details { flex: 1; }
        .img-details .path { font-size: 0.8rem; color: var(--text-muted); font-family: monospace; background: var(--bg-hover); padding: 4px 8px; border-radius: 4px; display: inline-block; margin-bottom: 10px; border: 1px solid var(--border-light); }
        
        /* Floating Save Bar */
        .floating-save { position: sticky; bottom: 1.5rem; margin: 0 auto; width: calc(100% - 3rem); max-width: 800px; background: var(--surface); backdrop-filter: blur(12px); border: 1px solid var(--border-light); padding: 0.8rem 1.2rem; border-radius: 100px; box-shadow: var(--shadow-lg); display: flex; justify-content: space-between; align-items: center; z-index: 50; transition: background-color 0.3s; opacity: 0.95; }
        .save-text { font-size: 0.9rem; color: var(--text-muted); font-weight: 500; }
        .btn-primary { background: var(--primary); color: #fff; border: none; padding: 10px 24px; border-radius: 100px; font-family: 'Outfit', sans-serif; font-size: 0.95rem; font-weight: 600; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 12px rgba(230, 57, 70, 0.3); display: flex; align-items: center; gap: 8px; }
        .btn-primary:hover { background: var(--primary-hover); transform: translateY(-2px); box-shadow: 0 6px 16px rgba(230, 57, 70, 0.4); }

        .fade-bottom { position: absolute; bottom: 0; width: 100%; height: 100px; background: linear-gradient(to top, var(--bg-color) 0%, transparent 100%); pointer-events: none; z-index: 40; }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slideIn { from { opacity: 0; transform: translateX(-20px); } to { opacity: 1; transform: translateX(0); } }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        
        /* Preload to prevent transition flash */
        .preload * { transition: none !important; }
    </style>
</head>
<body class="preload">
    <script>
        // Evitar el parpadeo (Flash of Unstyled Content) aplicando el tema inmediatamente
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
                <?php foreach (array_keys($pages) as $idx => $p): 
                        if ($p === 'nosotros') $pageTitle = 'Quiénes Somos';
                        elseif ($p === 'programas') $pageTitle = 'Qué Hacemos';
                        elseif ($p === 'apadrinar') $pageTitle = 'Qué Puedes Hacer';
                        else $pageTitle = ucfirst($p);
                ?>
                    <div class="page-tab" data-page-target="page-<?= md5($p) ?>">
                        <?= htmlspecialchars($pageTitle) ?>
                    </div>
                <?php endforeach; ?>
                <a href="productos.php" class="page-tab" style="text-decoration:none; color: var(--text-muted); border-left: 1px solid rgba(255,255,255,0.1); margin-left: 10px; padding-left: 15px;">
                    <i class="fas fa-store"></i> Gestionar Tienda
                </a>
            </div>
        </div>
        <div class="user-actions">
            <button class="btn-icon" id="darkModeToggle" title="Cambiar Tema">
                <i class="fas fa-moon"></i>
            </button>
            <a href="../index.php" target="_blank" class="btn-outline"><i class="fas fa-globe"></i> Ver Web</a>
            <a href="logout.php" class="btn-outline btn-logout"><i class="fas fa-sign-out-alt"></i> Salir</a>
        </div>
    </header>

    <div class="layout-container">
        
        <!-- Formularios por Página -->
        <form action="process_edit.php" method="POST" enctype="multipart/form-data" style="display: contents;">
            
            <?php 
            foreach ($pages as $p => $sections): 
            ?>
            <div class="page-wrapper" id="page-<?= md5($p) ?>">
                <div style="display: flex; height: 100%;">
                    
                    <!-- Sidebar Contextual -->
                    <aside class="sidebar">
                        <?php 
                        if ($p === 'nosotros') $sidebarTitle = 'Quiénes Somos';
                        elseif ($p === 'programas') $sidebarTitle = 'Qué Hacemos';
                        elseif ($p === 'apadrinar') $sidebarTitle = 'Qué Puedes Hacer';
                        else $sidebarTitle = ucfirst($p);
                        ?>
                        <div class="sidebar-title">Secciones de <?= htmlspecialchars($sidebarTitle) ?></div>
                        <div class="sidebar-menu">
                            <?php 
                            foreach ($sections as $sectionName => $items): 
                                $iconClass = "fas fa-layer-group";
                                if(strpos($sectionName, 'Hero') !== false) $iconClass = "fas fa-image";
                                if(strpos($sectionName, 'Historia') !== false) $iconClass = "fas fa-book-open";
                                if(strpos($sectionName, 'Apadrinar') !== false) $iconClass = "fas fa-child-reaching";
                                if(strpos($sectionName, 'Donar') !== false) $iconClass = "fas fa-hand-holding-dollar";
                                if(strpos($sectionName, 'Empresas') !== false) $iconClass = "fas fa-handshake";
                                if(strpos($sectionName, 'Voluntariado') !== false) $iconClass = "fas fa-users";
                                if(strpos($sectionName, 'Tienda') !== false) $iconClass = "fas fa-shopping-bag";
                                if(strpos($sectionName, 'Contacto') !== false) $iconClass = "fas fa-envelope";
                            ?>
                                <div class="section-item" data-sec-target="sec-<?= md5($p.$sectionName) ?>">
                                    <i class="<?= $iconClass ?>"></i> <?= htmlspecialchars($sectionName) ?>
                                </div>
                            <?php 
                            endforeach; 
                            ?>
                        </div>
                    </aside>

                    <!-- Main Editor -->
                    <main class="main-content">
                        <div class="bg-blob"></div>
                        <div class="content-scroll">
                            
                            <?php if(isset($_GET['success'])): ?>
                                <div class="alert">
                                    <i class="fas fa-check-circle"></i> Cambios publicados correctamente en el sitio en vivo.
                                </div>
                            <?php endif; ?>

                            <div class="content-header">
                                <h2 class="dynamic-title">Editando Sección</h2>
                                <p>Modifica los textos e imágenes. Los cambios se guardarán y reflejarán inmediatamente.</p>
                            </div>

                            <div class="content-grid">
                                <div class="form-column">
                                    <?php 
                                    foreach ($sections as $sectionName => $items): 
                                    ?>
                                        <div class="section-wrapper" id="sec-<?= md5($p.$sectionName) ?>" data-title="<?= htmlspecialchars($sectionName) ?>">
                                            
                                            <div class="card">
                                                <div class="card-title">
                                                    <i class="fas fa-edit"></i> Propiedades de la sección
                                                </div>
                                                
                                                <?php 
                                                // Preprocesar los items para agrupar los botones
                                                $regular_items = [];
                                                $button_items = [];
                                                foreach ($items as $content) {
                                                    if (strpos($content['section_key'], '_btn') !== false) {
                                                        // Extraer el prefijo (ej. hero_slide1_btn1)
                                                        preg_match('/(.*_btn\d*)_(text|url)$/', $content['section_key'], $matches);
                                                        if (!empty($matches)) {
                                                            $btn_group = $matches[1];
                                                            $btn_type = $matches[2];
                                                            $button_items[$btn_group][$btn_type] = $content;
                                                        } else {
                                                            $regular_items[] = $content;
                                                        }
                                                    } else {
                                                        $regular_items[] = $content;
                                                    }
                                                }
                                                ?>
                                                
                                                <?php foreach ($regular_items as $content): ?>
                                                    <div class="form-group">
                                                        <?php 
                                                        $label = strtoupper(str_replace('_', ' ', $content['section_key']));
                                                        if (strpos($label, 'IMG') !== false) $label = str_replace('IMG', 'IMAGEN', $label);
                                                        if (strpos($label, 'DESC') !== false) $label = str_replace('DESC', 'DESCRIPCIÓN', $label);
                                                        ?>
                                                        <label><?= htmlspecialchars($label) ?></label>
                                                        <input type="hidden" name="keys[]" value="<?= htmlspecialchars($content['section_key']) ?>">
                                                        
                                                        <?php if ($content['content_type'] === 'text' || $content['content_type'] === 'textarea'): ?>
                                                            <?php if ($content['content_type'] === 'text' && (strpos($content['section_key'], '_url') !== false || strpos($content['section_key'], 'btn_text') !== false || strpos($content['section_key'], '_title') !== false || strpos($content['section_key'], 'title') !== false)): ?>
                                                                <input type="text" name="values[<?= htmlspecialchars($content['section_key']) ?>]" class="form-control" value="<?= htmlspecialchars($content['content_value']) ?>">
                                                            <?php else: ?>
                                                                <textarea name="values[<?= htmlspecialchars($content['section_key']) ?>]" class="form-control" spellcheck="false" style="min-height: 100px;"><?= htmlspecialchars($content['content_value']) ?></textarea>
                                                            <?php endif; ?>
                                                        
                                                        <?php elseif ($content['content_type'] === 'image'): ?>
                                                            <div class="image-upload-box">
                                                                <img src="../<?= htmlspecialchars($content['content_value']) ?>" class="img-preview" alt="Preview">
                                                                <div class="img-details">
                                                                    <div class="path"><?= htmlspecialchars($content['content_value']) ?></div>
                                                                    <input type="file" name="images[<?= htmlspecialchars($content['section_key']) ?>]" class="form-control" accept="image/*">
                                                                    <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 8px;">Para mantener esta imagen, no selecciones ningún archivo nuevo.</p>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                <?php endforeach; ?>

                                                <?php if (!empty($button_items)): ?>
                                                    <div style="margin-top: 2rem; border-top: 1px dashed var(--border-light); padding-top: 1.5rem;">
                                                        <h4 style="margin-bottom: 1rem; color: var(--secondary); font-family: var(--font-heading); font-size: 0.95rem; text-transform: uppercase;"><i class="fas fa-link"></i> Configuración de Botones</h4>
                                                        <?php foreach ($button_items as $group_key => $btn_data): ?>
                                                            <div style="background: var(--bg-hover); border: 1px solid var(--border-light); border-radius: 8px; padding: 1.2rem; margin-bottom: 1rem;">
                                                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                                                                    
                                                                    <?php if(isset($btn_data['text'])): $content = $btn_data['text']; ?>
                                                                    <div class="form-group" style="margin-bottom: 0;">
                                                                        <label><i class="fas fa-font"></i> Texto del Botón (<?= strtoupper(str_replace('_', ' ', $group_key)) ?>)</label>
                                                                        <input type="hidden" name="keys[]" value="<?= htmlspecialchars($content['section_key']) ?>">
                                                                        <input type="text" name="values[<?= htmlspecialchars($content['section_key']) ?>]" class="form-control" value="<?= htmlspecialchars($content['content_value']) ?>" placeholder="Ej. Apadrina Hoy">
                                                                    </div>
                                                                    <?php endif; ?>
                                                                    
                                                                    <?php if(isset($btn_data['url'])): $content = $btn_data['url']; ?>
                                                                    <div class="form-group" style="margin-bottom: 0;">
                                                                        <label><i class="fas fa-link"></i> Enlace / URL de destino</label>
                                                                        <input type="hidden" name="keys[]" value="<?= htmlspecialchars($content['section_key']) ?>">
                                                                        <input type="text" name="values[<?= htmlspecialchars($content['section_key']) ?>]" class="form-control" value="<?= htmlspecialchars($content['content_value']) ?>" placeholder="Ej. #contacto o https://...">
                                                                    </div>
                                                                    <?php endif; ?>
                                                                    
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                <?php endif; ?>
                                                
                                            </div>
                                        </div>
                                    <?php 
                                    endforeach; 
                                    ?>
                                </div>
                                
                                <div class="preview-column">
                                    <div class="preview-header">
                                        <div class="dots">
                                            <div class="dot"></div><div class="dot"></div><div class="dot"></div>
                                        </div>
                                        <span>Vista Previa en Vivo</span>
                                        <i class="fas fa-mobile-alt"></i>
                                    </div>
                                    <?php 
                                        $previewUrl = ($p === 'inicio') ? '../index.php' : '../' . $p . '.php'; 
                                    ?>
                                    <iframe src="<?= htmlspecialchars($previewUrl) ?>" class="preview-iframe" title="Vista Previa"></iframe>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Fixed Save Bar -->
                        <div class="fade-bottom"></div>
                        <div class="floating-save">
                            <div class="save-text">Tienes cambios sin guardar en esta pestaña</div>
                            <button type="submit" class="btn-primary">
                                Guardar Cambios <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>

                    </main>

                </div>
            </div>
            <?php endforeach; ?>
        </form>
    </div>

    <script>
        // Navegación principal (Páginas)
        const pageTabs = document.querySelectorAll('.page-tab:not(.disabled)');
        const pageWrappers = document.querySelectorAll('.page-wrapper');

        function activatePage(targetId) {
            pageTabs.forEach(t => t.classList.remove('active'));
            pageWrappers.forEach(w => w.classList.remove('active'));
            
            const tab = document.querySelector(`.page-tab[data-page-target="${targetId}"]`);
            if (tab) tab.classList.add('active');
            
            const targetSection = document.getElementById(targetId);
            if (targetSection) targetSection.classList.add('active');
            
            sessionStorage.setItem('activePage', targetId);
        }

        pageTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                activatePage(tab.getAttribute('data-page-target'));
            });
        });

        // Navegación secundaria (Secciones por página)
        const allSectionItems = document.querySelectorAll('.section-item');
        
        function activateSection(item, targetId) {
            const sidebar = item.closest('.sidebar');
            const mainContent = sidebar.nextElementSibling;
            
            sidebar.querySelectorAll('.section-item').forEach(i => i.classList.remove('active'));
            mainContent.querySelectorAll('.section-wrapper').forEach(s => s.classList.remove('active'));
            
            item.classList.add('active');
            const targetSec = document.getElementById(targetId);
            if (targetSec) targetSec.classList.add('active');
            
            const title = targetSec ? targetSec.getAttribute('data-title') : '';
            const dynamicTitle = mainContent.querySelector('.dynamic-title');
            if (dynamicTitle) dynamicTitle.textContent = 'Editando ' + title;
            
            sessionStorage.setItem('activeSection', targetId);
        }

        allSectionItems.forEach(item => {
            item.addEventListener('click', function() {
                activateSection(this, this.getAttribute('data-sec-target'));
            });
        });

        // Restaurar estado de sesión o setear por defecto
        const hash = window.location.hash.substring(1); // 'inicio', 'nosotros', etc
        let targetId = '';
        if (hash) {
            // Mapeo simple de nombres a IDs (usando md5 del nombre de la página)
            const map = {
                'inicio': 'page-<?= md5('inicio') ?>',
                'nosotros': 'page-<?= md5('nosotros') ?>',
                'programas': 'page-<?= md5('programas') ?>',
                'apadrinar': 'page-<?= md5('apadrinar') ?>'
            };
            targetId = map[hash];
        }
        
        const savedPage = targetId || sessionStorage.getItem('activePage');
        if (savedPage && document.getElementById(savedPage)) {
            activatePage(savedPage);
            // Si vino por hash, limpiar el hash de la URL para que no interfiera luego
            if (hash && targetId) {
                history.replaceState(null, null, window.location.pathname);
            }
        } else {
            const firstTab = document.querySelector('.page-tab:not(.disabled)');
            if (firstTab) activatePage(firstTab.getAttribute('data-page-target'));
        }

        const savedSection = sessionStorage.getItem('activeSection');
        if (savedSection && document.getElementById(savedSection)) {
            const savedItem = document.querySelector(`.section-item[data-sec-target="${savedSection}"]`);
            if (savedItem) {
                activateSection(savedItem, savedSection);
            }
        } else {
            const activePage = document.querySelector('.page-wrapper.active');
            if (activePage) {
                const firstItem = activePage.querySelector('.section-item');
                if (firstItem) activateSection(firstItem, firstItem.getAttribute('data-sec-target'));
            }
        }

        // Remover clase preload tras cargar DOM
        window.addEventListener('load', () => {
            document.body.classList.remove('preload');
        });

        // Dark Mode Logic (Toggle)
        const darkModeToggle = document.getElementById('darkModeToggle');
        const icon = darkModeToggle.querySelector('i');
        
        // Ajustar ícono en base a lo que se aplicó en el <head>
        if (document.body.classList.contains('dark-mode')) {
            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');
        }

        darkModeToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            
            if (document.body.classList.contains('dark-mode')) {
                localStorage.setItem('theme', 'dark');
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            } else {
                localStorage.setItem('theme', 'light');
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
            }
        });
    </script>
</body>
</html>
