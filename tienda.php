<?php 
require_once 'includes/db.php'; 
$products = [];
try {
    $stmt = $pdo->query("SELECT * FROM products ORDER BY created_at DESC");
    if ($stmt) {
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (Exception $e) {
    // Silencioso, si no existe la tabla
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Solidaria | Fundación ADN de Amor</title>
    <meta name="description"
        content="Nuestra Tienda Solidaria estará activa muy pronto. Descubre productos con propósito que apoyan a niños y familias vulnerables.">

        <!-- Preconnect fuentes y assets externos -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="stylesheet" href="styles.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;800&family=Inter:wght@400;500;600&family=Great+Vibes&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <!-- Preloader -->
    <div id="preloader" class="preloader">
        <div class="loader-content">
            <img src="LOGO Y VISUAL WEB BOTONES/logo ADN_de_Amor_color_rectangulo.png" alt="Fundación ADN de Amor"
                class="loader-logo">
            <div class="loader-bar-container">
                <div class="loader-bar"></div>
            </div>
            <p class="loader-text">Abriendo caminos de esperanza...</p>
        </div>
    </div>

    <!-- Navbar -->
    <header class="navbar">
        <div class="container nav-container">
            <a href="/" class="logo">
                <img src="LOGO Y VISUAL WEB BOTONES/logo ADN_de_Amor_color_rectangulo.png"
                    alt="Fundación ADN de Amor Logo">
            </a>
            <button class="mobile-menu-btn"><i class="fas fa-bars"></i></button>
            <nav class="nav-links">
                <div class="dropdown">
                    <button class="dropbtn">
                        <i class="fas fa-user-friends nav-icon"></i>
                        <span class="nav-text">Quiénes Somos <i class="fas fa-chevron-down dropdown-icon"></i></span>
                    </button>
                    <div class="dropdown-content">
                        <a href="nosotros">¿Quiénes Somos?</a>
                        <a href="nosotros#mision">Nuestra Misión y Creencias</a>
                        <a href="nosotros#historia">Nuestra Historia</a>
                    </div>
                </div>

                <div class="dropdown">
                    <button class="dropbtn">
                        <i class="fas fa-hands-holding nav-icon"></i>
                        <span class="nav-text">Qué Hacemos <i class="fas fa-chevron-down dropdown-icon"></i></span>
                    </button>
                    <div class="dropdown-content">
                        <a href="programas#donde-estamos">Dónde Estamos</a>
                        <a href="programas#que-hacemos">¿Qué Hacemos?</a>
                        <a href="programas#cdt">Centro de Desarrollo de Talentos</a>
                        <a href="programas#esperanza">Programa Esperanza</a>
                        <a href="programas#choco">Misión Chocó</a>
                        <a href="programas#linea">Línea de Ayuda ADN</a>
                        <a href="memorias">Memorias de Nuestra Labor</a>
                    </div>
                </div>

                <div class="dropdown">
                    <button class="dropbtn">
                        <i class="fas fa-hand-holding-heart nav-icon"></i>
                        <span class="nav-text">Qué Puedes Hacer <i class="fas fa-chevron-down dropdown-icon"></i></span>
                    </button>
                    <div class="dropdown-content">
                        <a href="apadrinar">Apadrina un Niño</a>
                        <a href="/#donar">Dona por una Causa</a>
                        <a href="/#empresas">Empresas Socialmente Responsables</a>
                        <a href="/#empresas">Colaboradores y Prácticas</a>
                        <a href="/#voluntariado">Ser Voluntario</a>
                    </div>
                </div>

                <a href="tienda" style="font-weight: 600; color: var(--text-dark); text-decoration: none;">
                    <i class="fas fa-shopping-bag nav-icon"></i>
                    <span class="nav-text">Tienda Solidaria</span>
                </a>
                
                <a href="blog" style="font-weight: 600; color: var(--text-dark); text-decoration: none;">
                    <i class="fas fa-newspaper nav-icon"></i>
                    <span class="nav-text">Blog</span>
                </a>

                <a href="/#contacto" class="btn btn-primary">Contacto</a>
            </nav>
        </div>
    </header>

    <?php if (empty($products)): ?>
        <!-- Estado vacío -->
        <section class="section bg-light" style="min-height: 80vh; display: flex; align-items: center; justify-content: center; padding-top: 120px;">
            <div class="container">
                <div class="modern-card text-center" style="max-width: 700px; margin: 0 auto; background: var(--white);">
                    <div style="font-size: 4rem; color: var(--primary); margin-bottom: 1.5rem;">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <h3 style="color: var(--text-dark); margin-bottom: 1.5rem; font-weight: 500;">Nuestra Tienda Solidaria se está abasteciendo.</h3>
                    <p style="font-size: 1.1rem; color: var(--text-light); margin-bottom: 2rem;">Vuelve pronto para descubrir productos con propósito. Estamos trabajando para traerte lo mejor.</p>
                    <a href="/" class="btn btn-outline" style="border-color: var(--secondary); color: var(--secondary);">Volver al Inicio</a>
                </div>
            </div>
        </section>
    <?php else: ?>
        <!-- Tienda Hero Minimalista -->
        <section class="store-hero">
            <div class="container store-hero-container">
                <div class="store-hero-content">
                    <h1 class="store-hero-title"><i class="fas fa-dove" style="color: var(--primary); font-size: 0.8em; margin-right: 10px;"></i>Tienda Solidaria</h1>
                    <p class="store-hero-desc">Cada producto es una semilla de esperanza.<br>Tu compra transforma vidas y lleva amor a quienes más lo necesitan.</p>
                </div>
            </div>
        </section>

        <!-- Productos Section -->
        <section class="section store-main-section">
            <div class="container">
                <!-- Estilos Minimalistas y Elegantes -->
                <style>
                    .store-hero {
                        padding-top: 120px;
                        padding-bottom: 40px;
                        background-color: #ffffff;
                        text-align: center;
                    }
                    .store-hero-title {
                        font-size: 2.5rem;
                        color: #111827;
                        margin-bottom: 0.8rem;
                        font-family: var(--font-heading);
                        font-weight: 700;
                        letter-spacing: -0.5px;
                    }
                    .store-hero-desc {
                        font-size: 1.05rem;
                        color: #6b7280;
                        max-width: 600px;
                        margin: 0 auto;
                        line-height: 1.6;
                    }
                    .store-main-section {
                        background-color: #ffffff;
                        padding: 2rem 0 6rem 0;
                    }
                    .products-header {
                        display: flex;
                        justify-content: space-between;
                        align-items: flex-end;
                        margin-bottom: 2.5rem;
                        padding-bottom: 0.8rem;
                        border-bottom: 1px solid #f3f4f6;
                    }
                    .products-header h2 {
                        font-size: 1.5rem;
                        color: #374151;
                        margin: 0;
                        font-weight: 600;
                    }
                    .products-count {
                        color: #9ca3af;
                        font-size: 0.9rem;
                    }
                    .product-grid {
                        display: grid;
                        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
                        gap: 2rem;
                    }
                    .product-card {
                        background: #ffffff;
                        border-radius: 8px;
                        overflow: hidden;
                        display: flex;
                        flex-direction: column;
                        transition: transform 0.3s ease, box-shadow 0.3s ease;
                        position: relative;
                        border: 1px solid #f3f4f6;
                    }
                    .product-card:hover {
                        transform: translateY(-4px);
                        box-shadow: 0 12px 20px -8px rgba(0, 0, 0, 0.08);
                        border-color: #e5e7eb;
                    }
                    .product-img-wrapper {
                        position: relative;
                        height: 240px;
                        overflow: hidden;
                        background: #f9fafb;
                    }
                    .product-img {
                        width: 100%;
                        height: 100%;
                        object-fit: cover; 
                        transition: transform 0.8s ease;
                    }
                    .product-card:hover .product-img {
                        transform: scale(1.04);
                    }
                    .badge-offer {
                        position: absolute;
                        top: 1rem;
                        left: 1rem;
                        background: #111827;
                        color: white;
                        padding: 0.3rem 0.8rem;
                        border-radius: 4px;
                        font-weight: 600;
                        font-size: 0.7rem;
                        letter-spacing: 1px;
                        text-transform: uppercase;
                        z-index: 2;
                    }
                    .product-content {
                        padding: 1.5rem;
                        display: flex;
                        flex-direction: column;
                        flex-grow: 1;
                    }
                    .product-title {
                        font-family: var(--font-body);
                        font-size: 1.1rem;
                        font-weight: 600;
                        color: #1f2937;
                        margin-bottom: 0.5rem;
                        line-height: 1.3;
                    }
                    .product-price-wrapper {
                        display: flex;
                        align-items: center;
                        gap: 0.8rem;
                        margin-bottom: 1.5rem;
                        margin-top: auto;
                    }
                    .price-current {
                        font-size: 1.15rem;
                        font-weight: 700;
                        color: var(--primary);
                    }
                    .price-old {
                        font-size: 0.9rem;
                        text-decoration: line-through;
                        color: #9ca3af;
                        font-weight: 400;
                    }
                    .btn-buy {
                        width: 100%;
                        background: transparent;
                        border: 1px solid #d1d5db;
                        border-radius: 6px;
                        padding: 0.7rem;
                        color: #374151;
                        font-weight: 500;
                        font-size: 0.9rem;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        gap: 0.5rem;
                        transition: all 0.2s ease;
                        text-decoration: none;
                    }
                    .btn-buy:hover {
                        border-color: #25D366;
                        color: #25D366;
                        background-color: rgba(37, 211, 102, 0.05);
                    }
                    .btn-buy i {
                        font-size: 1.1rem;
                    }
                </style>

                <div class="products-header">
                    <h2>Colección con Propósito</h2>
                    <span class="products-count"><?php echo count($products); ?> producto(s)</span>
                </div>

                <!-- Grid de productos -->
                <div class="product-grid">
                    <?php foreach ($products as $prod): ?>
                        <?php 
                            $name = isset($prod['name']) ? $prod['name'] : '';
                            $image = isset($prod['image']) ? $prod['image'] : '';
                            $price = isset($prod['price']) ? (float)$prod['price'] : 0.0;
                            $discount = !empty($prod['discount']) ? (float)$prod['discount'] : null;
                            $wa_link = isset($prod['whatsapp_link']) ? $prod['whatsapp_link'] : '';
                            
                            if (!empty($wa_link) && strpos($wa_link, 'http') === false) {
                                $wa_link = 'https://' . $wa_link;
                            }
                            
                            // Placeholder imagen si está vacía
                            if (empty($image)) {
                                $image = 'https://images.unsplash.com/photo-1544816155-12df9643f363?auto=format&fit=crop&w=600&q=80'; 
                            }
                        ?>
                        <div class="product-card">
                            <div class="product-img-wrapper">
                                <img class="product-img" src="<?php echo htmlspecialchars($image); ?>" loading="lazy" decoding="async" alt="<?php echo htmlspecialchars($name); ?>">
                                <?php if ($discount): ?>
                                    <div class="badge-offer">Oferta</div>
                                <?php endif; ?>
                            </div>
                            
                            <div class="product-content">
                                <h3 class="product-title"><?php echo htmlspecialchars($name); ?></h3>
                                
                                <div class="product-price-wrapper">
                                    <?php if ($discount): ?>
                                        <span class="price-current">$<?php echo number_format($discount, 2); ?></span>
                                        <span class="price-old">$<?php echo number_format($price, 2); ?></span>
                                    <?php else: ?>
                                        <span class="price-current">$<?php echo number_format($price, 2); ?></span>
                                    <?php endif; ?>
                                </div>
                                
                                <a href="<?php echo htmlspecialchars($wa_link); ?>" target="_blank" class="btn-buy">
                                    <i class="fab fa-whatsapp"></i> Lo quiero
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php include 'includes/footer.php'; ?>

    <script src="main.js"></script>
</body>
</html>
