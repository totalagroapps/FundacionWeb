<?php
session_start();
require '../includes/db.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

$upload_dir = '../uploads/tienda/';
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Procesar acciones CRUD
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'add' || $action === 'edit') {
        $name = $_POST['name'] ?? '';
        $price = $_POST['price'] ?? 0;
        $discount = !empty($_POST['discount']) ? $_POST['discount'] : null;
        $whatsapp_input = $_POST['whatsapp_link'] ?? '';
        
        // Si ya trae "http", lo guardamos tal cual, de lo contrario generamos el enlace
        if (strpos($whatsapp_input, 'http') !== false) {
            $whatsapp_link = $whatsapp_input;
        } else {
            // Limpiamos cualquier cosa que no sea número
            $numero = preg_replace('/[^0-9]/', '', $whatsapp_input);
            
            // Si el número tiene 10 dígitos y empieza por 3 (formato normal de Colombia), le agregamos el 57
            if (strlen($numero) === 10 && substr($numero, 0, 1) === '3') {
                $numero = '57' . $numero;
            }
            
            $mensaje = urlencode("Hola, me interesa el producto: " . $name);
            $whatsapp_link = "https://wa.me/" . $numero . "?text=" . $mensaje;
        }
        
        $imagePath = '';
        if ($action === 'edit') {
            $imagePath = $_POST['existing_image'] ?? '';
        }
        
        // Handle upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $tmp_name = $_FILES['image']['tmp_name'];
            $filename = time() . '_' . basename($_FILES['image']['name']);
            $target = $upload_dir . $filename;
            if (move_uploaded_file($tmp_name, $target)) {
                $imagePath = 'uploads/tienda/' . $filename;
            }
        }
        
        if ($action === 'add') {
            $stmt = $pdo->prepare("INSERT INTO products (name, price, discount, whatsapp_link, image) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $price, $discount, $whatsapp_link, $imagePath]);
        } else {
            $id = $_POST['id'];
            $stmt = $pdo->prepare("UPDATE products SET name=?, price=?, discount=?, whatsapp_link=?, image=? WHERE id=?");
            $stmt->execute([$name, $price, $discount, $whatsapp_link, $imagePath, $id]);
        }
        
        header('Location: productos.php?success=1');
        exit;
    }
    
    if ($action === 'delete') {
        $id = $_POST['id'];
        $stmt = $pdo->prepare("DELETE FROM products WHERE id=?");
        $stmt->execute([$id]);
        header('Location: productos.php?success=1');
        exit;
    }
}

$stmt = $pdo->query("SELECT * FROM products ORDER BY created_at DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tienda | Admin ADN</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-dark: #f1f5f9; --bg-card: #ffffff; --bg-hover: #f8fafc;
            --text-main: #1e293b; --text-muted: #64748b;
            --primary: #ea5a00; --primary-hover: #cc4d00; --secondary: #00103e;
            --border-light: #e2e8f0; --surface: #ffffff;
            --danger: #ef4444; --success: #10b981;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.05);
            
            --font-heading: 'Outfit', sans-serif;
            --font-body: 'Inter', sans-serif;
        }

        body.dark-mode {
            --bg-dark: #0f172a; --bg-card: #1e293b; --bg-hover: #334155;
            --text-main: #f8fafc; --text-muted: #94a3b8;
            --border-light: #334155; --surface: #1e293b;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.4);
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
        
        .top-navbar { background-color: var(--surface); height: 60px; display: flex; align-items: center; justify-content: space-between; padding: 0 2rem; border-bottom: 1px solid var(--border-light); z-index: 100; box-shadow: var(--shadow-sm); position: sticky; top: 0; }
        .logo-area { display: flex; align-items: center; gap: 20px; }
        .logo-area img { height: 40px; }
        .logo-divider { width: 1px; height: 30px; background: var(--border-light); }
        .page-selector { display: flex; gap: 10px; }
        .page-tab { padding: 8px 16px; border-radius: 20px; font-family: 'Outfit', sans-serif; font-weight: 500; font-size: 0.95rem; cursor: pointer; transition: all 0.2s; color: var(--text-muted); border: 1px solid transparent; text-decoration: none; display: inline-block; }
        .page-tab:hover { background: var(--bg-hover); color: var(--secondary); }
        .page-tab.active { background: rgba(234, 90, 0, 0.1); color: var(--primary); border-color: rgba(234, 90, 0, 0.2); }
        
        .user-actions { display: flex; align-items: center; gap: 15px; }
        .btn-icon { background: transparent; border: 1px solid var(--border-light); color: var(--text-main); width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s; }
        .btn-icon:hover { background: var(--bg-hover); color: var(--primary); border-color: var(--primary); }
        .btn-outline { border: 1px solid var(--border-light); background: transparent; padding: 8px 16px; border-radius: 8px; color: var(--text-main); text-decoration: none; font-size: 0.9rem; font-weight: 500; transition: all 0.2s; display: inline-flex; align-items: center; gap: 6px; }
        .btn-outline:hover { background: var(--bg-hover); border-color: var(--border-light); }
        .btn-logout { background: #fff1f2; color: #E63946; border: none; }
        .btn-logout:hover { background: #ffe4e6; color: #d62d3a; }
        
        .main-content { padding: 2rem; max-width: 1200px; margin: 0 auto; }
        .header-actions { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
        .header-actions h2 { font-family: var(--font-heading); font-size: 2rem; color: var(--text-main); }
        
        .btn-primary {
            background: var(--primary); color: white; border: none; padding: 0.75rem 1.5rem; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.2s; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; font-family: var(--font-heading);
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(234, 90, 0, 0.3); }
        
        .btn-danger { background: var(--danger); }
        .btn-danger:hover { box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3); }
        
        .grid-products { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem; }
        .card { background: var(--bg-card); border: 1px solid var(--border-light); border-radius: 12px; padding: 1.5rem; display: flex; flex-direction: column; gap: 1rem; }
        .card img { width: 100%; height: 200px; object-fit: cover; border-radius: 8px; }
        .card-title { font-family: var(--font-heading); font-size: 1.25rem; font-weight: 600; }
        .card-price { color: var(--primary); font-weight: 700; font-size: 1.1rem; }
        .card-discount { text-decoration: line-through; color: var(--text-muted); font-size: 0.9rem; }
        .card-actions { display: flex; gap: 0.5rem; margin-top: auto; }
        .card-actions button { flex: 1; }
        
        /* Modal */
        .modal { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.7); backdrop-filter: blur(5px); z-index: 1000; align-items: center; justify-content: center; }
        .modal.active { display: flex; }
        .modal-content { background: var(--bg-card); border: 1px solid var(--border-light); border-radius: 16px; padding: 2rem; width: 100%; max-width: 600px; position: relative; }
        .modal-close { position: absolute; top: 1rem; right: 1rem; background: none; border: none; color: var(--text-muted); font-size: 1.5rem; cursor: pointer; }
        
        .form-group { margin-bottom: 1.5rem; }
        .form-group label { display: block; margin-bottom: 0.5rem; font-weight: 500; font-size: 0.9rem; color: var(--text-muted); }
        .form-control { width: 100%; background: var(--bg-dark); border: 1px solid var(--border-light); border-radius: 8px; padding: 0.75rem 1rem; color: var(--text-main); font-family: var(--font-body); font-size: 1rem; }
        .form-control:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 2px rgba(234, 90, 0, 0.2); }
        
        .alert { background: rgba(16, 185, 129, 0.1); border: 1px solid var(--success); color: var(--success); padding: 1rem; border-radius: 8px; margin-bottom: 2rem; display: flex; align-items: center; gap: 0.5rem; }
    </style>
</head>
<body class="preload">
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
                <a href="productos.php" class="page-tab active" style="border-left: 1px solid var(--border-light); margin-left: 10px; padding-left: 15px;"><i class="fas fa-store"></i> Gestionar Tienda</a>
            </div>
        </div>
        <div class="user-actions">
            <button class="btn-icon" id="darkModeToggle" title="Cambiar Tema">
                <i class="fas fa-moon"></i>
            </button>
            <a href="/tienda" target="_blank" class="btn-outline"><i class="fas fa-globe"></i> Ver Tienda</a>
            <a href="logout.php" class="btn-outline btn-logout"><i class="fas fa-sign-out-alt"></i> Salir</a>
        </div>
    </header>

    <main class="main-content">
        <?php if(isset($_GET['success'])): ?>
            <div class="alert">
                <i class="fas fa-check-circle"></i> Acción realizada correctamente.
            </div>
        <?php endif; ?>

        <div class="header-actions">
            <h2>Productos de la Tienda</h2>
            <div style="display: flex; gap: 1rem; align-items: center;">
                <input type="text" id="searchProduct" class="form-control" placeholder="Buscar producto..." style="width: 250px; background: var(--bg-card); padding: 0.6rem 1rem;">
                <button class="btn-primary" onclick="openModal('add')"><i class="fas fa-plus"></i> Nuevo Producto</button>
            </div>
        </div>

        <div class="grid-products">
            <?php foreach($products as $prod): ?>
                <div class="card">
                    <img src="../<?= htmlspecialchars($prod['image']) ?>" alt="<?= htmlspecialchars($prod['name']) ?>">
                    <div class="card-title"><?= htmlspecialchars($prod['name']) ?></div>
                    <div>
                        <?php if($prod['discount']): ?>
                            <span class="card-discount">$<?= number_format($prod['price'], 2) ?></span>
                            <span class="card-price">$<?= number_format($prod['discount'], 2) ?></span>
                        <?php else: ?>
                            <span class="card-price">$<?= number_format($prod['price'], 2) ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="card-actions">
                        <button class="btn-primary" style="background: var(--secondary); color: white;" onclick="openModal('edit', <?= htmlspecialchars(json_encode($prod)) ?>)"><i class="fas fa-edit"></i></button>
                        <form method="POST" style="flex:1; display:flex;" onsubmit="return confirm('¿Seguro que quieres eliminar este producto?');">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?= $prod['id'] ?>">
                            <button type="submit" class="btn-primary btn-danger" style="width:100%;"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php if(empty($products)): ?>
                <div style="grid-column: 1 / -1; text-align: center; padding: 4rem; color: var(--text-muted); border: 1px dashed var(--border-light); border-radius: 12px;">
                    <i class="fas fa-box-open" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                    <h3>Aún no hay productos</h3>
                    <p>Agrega tu primer producto para comenzar a vender.</p>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <!-- Modal Form -->
    <div class="modal" id="productModal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeModal()"><i class="fas fa-times"></i></button>
            <h3 style="font-family: var(--font-heading); margin-bottom: 1.5rem; font-size: 1.5rem;" id="modalTitle">Agregar Producto</h3>
            
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" id="formAction" value="add">
                <input type="hidden" name="id" id="productId">
                <input type="hidden" name="existing_image" id="existingImage">
                
                <div class="form-group">
                    <label>Nombre del Producto</label>
                    <input type="text" name="name" id="prodName" class="form-control" required>
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label>Precio Normal ($)</label>
                        <input type="number" step="0.01" name="price" id="prodPrice" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Precio con Descuento ($) (Opcional)</label>
                        <input type="number" step="0.01" name="discount" id="prodDiscount" class="form-control">
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Número de WhatsApp (Sin código de país)</label>
                    <input type="text" name="whatsapp_link" id="prodWhatsapp" class="form-control" required placeholder="Ej. 3162522445">
                    <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 0.5rem;">Ingresa tu número (se añadirá automáticamente +57). El sistema generará el enlace completo.</p>
                </div>
                
                <div class="form-group">
                    <label>Imagen del Producto</label>
                    <input type="file" name="image" id="prodImage" class="form-control" accept="image/*">
                    <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 0.5rem;" id="imgHelp">Selecciona una imagen para el producto.</p>
                </div>
                
                <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">Guardar Producto</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(action, data = null) {
            document.getElementById('productModal').classList.add('active');
            document.getElementById('formAction').value = action;
            
            if (action === 'edit' && data) {
                document.getElementById('modalTitle').textContent = 'Editar Producto';
                document.getElementById('productId').value = data.id;
                document.getElementById('prodName').value = data.name;
                document.getElementById('prodPrice').value = data.price;
                document.getElementById('prodDiscount').value = data.discount || '';
                
                // Intentar extraer solo el número si ya es un enlace de wa.me
                let waLink = data.whatsapp_link || '';
                let waMatch = waLink.match(/wa\.me\/([0-9]+)/);
                if (waMatch) {
                    let extractedNum = waMatch[1];
                    // Si empieza por 57 y tiene 12 dígitos, le quitamos el 57 para mostrarlo limpio
                    if (extractedNum.length === 12 && extractedNum.startsWith('57')) {
                        extractedNum = extractedNum.substring(2);
                    }
                    document.getElementById('prodWhatsapp').value = extractedNum;
                } else {
                    document.getElementById('prodWhatsapp').value = waLink;
                }
                
                document.getElementById('existingImage').value = data.image;
                document.getElementById('imgHelp').textContent = 'Deja este campo vacío si deseas mantener la imagen actual.';
                document.getElementById('prodImage').required = false;
            } else {
                document.getElementById('modalTitle').textContent = 'Agregar Producto';
                document.getElementById('productId').value = '';
                document.getElementById('prodName').value = '';
                document.getElementById('prodPrice').value = '';
                document.getElementById('prodDiscount').value = '';
                document.getElementById('prodWhatsapp').value = '';
                document.getElementById('existingImage').value = '';
                document.getElementById('imgHelp').textContent = 'Selecciona una imagen para el producto.';
                document.getElementById('prodImage').required = true;
            }
        }
        
        function closeModal() {
            document.getElementById('productModal').classList.remove('active');
        }

        window.addEventListener('load', () => {
            document.body.classList.remove('preload');
        });

        // Dark Mode Logic
        const darkModeToggle = document.getElementById('darkModeToggle');
        const icon = darkModeToggle.querySelector('i');
        
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
        // Filtrado de Búsqueda
        const searchInput = document.getElementById('searchProduct');
        if(searchInput) {
            searchInput.addEventListener('input', function() {
                const term = this.value.toLowerCase();
                const cards = document.querySelectorAll('.grid-products .card');
                cards.forEach(card => {
                    const titleElement = card.querySelector('.card-title');
                    if(titleElement) {
                        const title = titleElement.textContent.toLowerCase();
                        if (title.includes(term)) {
                            card.style.display = 'flex';
                        } else {
                            card.style.display = 'none';
                        }
                    }
                });
            });
        }
    </script>
</body>
</html>
