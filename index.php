<?php require_once 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fundación ADN de Amor | Oportunidades y Esperanza</title>
    <meta name="description"
        content="Apadrina, dona y colabora con la Fundación ADN de Amor para generar oportunidades, esperanza y bienestar para niños, niñas y adolescentes en situación de vulnerabilidad.">

    <!-- Open Graph / Redes Sociales -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://fundacionadndeamor.org/">
    <meta property="og:title" content="Fundación ADN de Amor | Oportunidades y Esperanza">
    <meta property="og:description"
        content="Apadrina, dona y colabora con la Fundación ADN de Amor para generar oportunidades, esperanza y bienestar para niños, niñas y adolescentes.">
    <meta property="og:image"
        content="https://fundacionadndeamor.org/FOTOS%20BANNERS/foto%20principal%20ni%C3%B1os%20banner%20final.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://fundacionadndeamor.org/">
    <meta property="twitter:title" content="Fundación ADN de Amor | Oportunidades y Esperanza">
    <meta property="twitter:description"
        content="Apadrina, dona y colabora con la Fundación ADN de Amor para generar oportunidades, esperanza y bienestar para niños, niñas y adolescentes.">
    <meta property="twitter:image"
        content="https://fundacionadndeamor.org/FOTOS%20BANNERS/foto%20principal%20ni%C3%B1os%20banner%20final.png">

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
            <a href="#" class="logo">
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
                        <a href="nosotros.php">¿Quiénes Somos?</a>
                        <a href="nosotros.php#mision">Nuestra Misión y Creencias</a>
                        <a href="nosotros.php#historia">Nuestra Historia</a>
                    </div>
                </div>

                <div class="dropdown">
                    <button class="dropbtn">
                        <i class="fas fa-hands-holding nav-icon"></i>
                        <span class="nav-text">Qué Hacemos <i class="fas fa-chevron-down dropdown-icon"></i></span>
                    </button>
                    <div class="dropdown-content">
                        <a href="programas.php#donde-estamos">Dónde Estamos</a>
                        <a href="programas.php#que-hacemos">¿Qué Hacemos?</a>
                        <a href="programas.php#cdt">Centro de Desarrollo de Talentos</a>
                        <a href="programas.php#esperanza">Programa Esperanza</a>
                        <a href="programas.php#choco">Misión Chocó</a>
                        <a href="programas.php#linea">Línea de Ayuda ADN</a>
                        <a href="memorias.php">Memorias de Nuestra Labor</a>
                    </div>
                </div>

                <div class="dropdown">
                    <button class="dropbtn">
                        <i class="fas fa-hand-holding-heart nav-icon"></i>
                        <span class="nav-text">Qué Puedes Hacer <i class="fas fa-chevron-down dropdown-icon"></i></span>
                    </button>
                    <div class="dropdown-content">
                        <a href="apadrinar.php">Apadrina un Niño</a>
                        <a href="#donar">Dona por una Causa</a>
                        <a href="#empresas">Empresas Socialmente Responsables</a>
                        <a href="#empresas">Colaboradores y Prácticas</a>
                        <a href="#voluntariado">Ser Voluntario</a>
                    </div>
                </div>

                <a href="tienda.php" style="font-weight: 600; color: var(--text-dark); text-decoration: none;">
                    <i class="fas fa-shopping-bag nav-icon"></i>
                    <span class="nav-text">Tienda Solidaria</span>
                </a>
                
                <a href="blog.php" style="font-weight: 600; color: var(--text-dark); text-decoration: none;">
                    <i class="fas fa-newspaper nav-icon"></i>
                    <span class="nav-text">Blog</span>
                </a>

                <a href="#contacto" class="btn btn-primary">Contacto</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="carousel">
            <div class="slide active"
                style="background-image: url('<?= htmlspecialchars(get_site_content($pdo, 'hero_slide1_img', 'FOTOS BANNERS/foto principal niños banner final.png')) ?>');">
                <div class="hero-overlay"></div>
                <div class="hero-content container">
                    <h1><?= htmlspecialchars(get_site_content($pdo, 'hero_slide1_title', 'Abre Caminos de Esperanza')) ?></h1>
                    <p><?= htmlspecialchars(get_site_content($pdo, 'hero_slide1_desc', 'Cada apadrinamiento contribuye al desarrollo de un niño y su familia, generando oportunidades de crecimiento y bienestar.')) ?></p>
                    <div class="hero-buttons">
                        <a href="<?= htmlspecialchars(get_site_content($pdo, 'hero_slide1_btn1_url', '#apadrinar')) ?>" class="btn btn-primary btn-large"><?= htmlspecialchars(get_site_content($pdo, 'hero_slide1_btn1_text', 'Apadrina Hoy')) ?></a>
                        <a href="<?= htmlspecialchars(get_site_content($pdo, 'hero_slide1_btn2_url', '#donar')) ?>" class="btn btn-outline btn-large"><?= htmlspecialchars(get_site_content($pdo, 'hero_slide1_btn2_text', 'Dona por una Causa')) ?></a>
                    </div>
                </div>
            </div>
            <div class="slide" style="background-image: url('<?= htmlspecialchars(get_site_content($pdo, 'hero_slide2_img', 'FOTOS BANNERS/CDT ARTE FINAL PINTACARITAS SARI.png')) ?>');">
                <div class="hero-overlay"></div>
                <div class="hero-content container">
                    <h1><?= htmlspecialchars(get_site_content($pdo, 'hero_slide2_title', 'Centro de Desarrollo de Talentos')) ?></h1>
                    <p><?= htmlspecialchars(get_site_content($pdo, 'hero_slide2_desc', 'Permite que asistan a clases de inglés, arte, música, danza y actividades de formación no formal.')) ?></p>
                    <div class="hero-buttons">
                        <a href="<?= htmlspecialchars(get_site_content($pdo, 'hero_slide2_btn1_url', '#donar')) ?>" class="btn btn-primary btn-large"><?= htmlspecialchars(get_site_content($pdo, 'hero_slide2_btn1_text', 'Apoya el CDT')) ?></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-controls">
            <button id="prev-slide"><i class="fas fa-chevron-left"></i></button>
            <button id="next-slide"><i class="fas fa-chevron-right"></i></button>
        </div>
    </section>

    <!-- Sobre Nosotros Preview -->
    <section class="section bg-light text-center" style="padding: 4rem 0;">
        <div class="container">
            <h2 style="margin-bottom: 1rem;"><?= htmlspecialchars(get_site_content($pdo, 'historia_title', 'Conoce Nuestra Historia')) ?></h2>
            <p class="max-w-800 mx-auto" style="margin-bottom: 2rem; font-size: 1.1rem;"><?= htmlspecialchars(get_site_content($pdo, 'historia_desc', 'Descubre el corazón de la Fundación ADN de Amor. Conoce cómo empezamos, nuestra misión y los valores que nos inspiran a transformar las vidas de miles de niños y familias.')) ?></p>
            <a href="<?= htmlspecialchars(get_site_content($pdo, 'historia_btn_url', 'nosotros.php')) ?>" class="btn btn-outline"
                style="border-color: var(--primary); color: var(--primary);"><?= htmlspecialchars(get_site_content($pdo, 'historia_btn_text', 'Leer la historia completa')) ?></a>
        </div>
    </section>

    <!-- Apadrinar Section -->
    <section id="apadrinar" class="section apadrinar-section">
        <div class="container">
            <div class="section-header text-center">
                <h2><?= htmlspecialchars(get_site_content($pdo, 'apadrinar_main_title', '¡Una oportunidad que abre caminos y esperanza!')) ?></h2>
                <p><?= htmlspecialchars(get_site_content($pdo, 'apadrinar_main_desc', 'Apadrinar significa ofrecer acompañamiento y apoyo a un niño, niña o adolescente, ayudándole a superar barreras y acceder a oportunidades educativas, formativas y de desarrollo integral.')) ?></p>
            </div>

            <div class="grid-3">
                <div class="image-card organic-card card-blue" style="padding: 0; overflow: hidden;">
                    <img src="<?= htmlspecialchars(get_site_content($pdo, 'apadrinar_card1_img', 'FOTOS BANNERS/foto prinicpal 2 niños banner final.png')) ?>" alt="A Largo Plazo"
                        loading="lazy" decoding="async" style="width: 100%; height: 200px; object-fit: cover;">
                    <div style="padding: 1rem 3rem 3.5rem 3rem;">
                        <h3 style="margin-top: 1rem;"><?= htmlspecialchars(get_site_content($pdo, 'apadrinar_card1_title', 'A Largo Plazo')) ?></h3>
                        <p style="font-size: 0.95rem;"><?= htmlspecialchars(get_site_content($pdo, 'apadrinar_card1_desc', 'Crea un vínculo constante con el apadrinado y su familia, apoyando su desarrollo integral.')) ?></p>
                    </div>
                </div>
                <div class="image-card organic-card card-orange" style="padding: 0; overflow: hidden;">
                    <img src="<?= htmlspecialchars(get_site_content($pdo, 'apadrinar_card2_img', 'FOTOS BANNERS/CDT MUSICA 1 SELECCIONADA.png')) ?>" alt="Desarrollo de Talentos"
                        loading="lazy" decoding="async" style="width: 100%; height: 200px; object-fit: cover;">
                    <div style="padding: 1rem 3rem 3.5rem 3rem;">
                        <h3 style="margin-top: 1rem;"><?= htmlspecialchars(get_site_content($pdo, 'apadrinar_card2_title', 'Desarrollo de Talentos')) ?></h3>
                        <p style="font-size: 0.95rem;"><?= htmlspecialchars(get_site_content($pdo, 'apadrinar_card2_desc', 'Permite que asistan al CDT para clases de inglés, arte, música, danza y formación.')) ?></p>
                    </div>
                </div>
                <div class="image-card organic-card card-green" style="padding: 0; overflow: hidden;">
                    <img src="<?= htmlspecialchars(get_site_content($pdo, 'apadrinar_card3_img', 'FOTOS BANNERS/MAMA CON ANGELICA  DEFINITIVA BANNER.png')) ?>" alt="Construye un Vínculo"
                        loading="lazy" decoding="async" style="width: 100%; height: 200px; object-fit: cover;">
                    <div style="padding: 1rem 3rem 3.5rem 3rem;">
                        <h3 style="margin-top: 1rem;"><?= htmlspecialchars(get_site_content($pdo, 'apadrinar_card3_title', 'Construye un Vínculo')) ?></h3>
                        <p style="font-size: 0.95rem;"><?= htmlspecialchars(get_site_content($pdo, 'apadrinar_card3_desc', 'Sigue su proceso, recibe fotos y mantén contacto a través de cartas o mensajes.')) ?></p>
                    </div>
                </div>
            </div>

            <div class="text-center" style="margin-top: 4rem;">
                <a href="<?= htmlspecialchars(get_site_content($pdo, 'apadrinar_btn_url', 'apadrinar.php')) ?>" class="btn btn-primary btn-large"><?= htmlspecialchars(get_site_content($pdo, 'apadrinar_btn_text', 'Descubre cómo apadrinar y conocer a los niños')) ?></a>
            </div>
        </div>
    </section>

    <!-- Donar Section -->
    <section id="donar" class="section donar-section bg-light">
        <div class="container">
            <div class="split-layout">
                <div class="split-image organic-img">
                    <img src="<?= htmlspecialchars(get_site_content($pdo, 'donar_img', 'FOTOS BANNERS/FOTO BANNER NAVIDADES SELECCION.png')) ?>" alt="Dona por una causa" loading="lazy" decoding="async">
                </div>
                <div class="split-content">
                    <h2><?= htmlspecialchars(get_site_content($pdo, 'donar_title', 'Dona por una Causa')) ?></h2>
                    <p><?= htmlspecialchars(get_site_content($pdo, 'donar_desc', 'Cada aporte que haces a la Fundación ADN de Amor contribuye a crear oportunidades, esperanza y bienestar en situación de vulnerabilidad.')) ?></p>
                    <ul class="feature-list">
                        <li><i class="fas fa-check-circle"></i> <?= htmlspecialchars(get_site_content($pdo, 'donar_li1', 'Centro de Desarrollo de Talentos: Clases de inglés, arte, música y danza.')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <?= htmlspecialchars(get_site_content($pdo, 'donar_li2', 'Programa Esperanza: Alimentos, ropa y acompañamiento educativo.')) ?></li>
                        <li><i class="fas fa-check-circle"></i> <?= htmlspecialchars(get_site_content($pdo, 'donar_li3', 'Proyectos comunitarios: Brigadas de salud y construcción de viviendas.')) ?></li>
                    </ul>
                    <p><strong><?= htmlspecialchars(get_site_content($pdo, 'donar_footer_text', 'Tu aporte genera un efecto multiplicador. ¡Tú puedes marcar la diferencia!')) ?></strong></p>
                    <a href="<?= htmlspecialchars(get_site_content($pdo, 'donar_btn_url', '#contacto')) ?>" class="btn btn-primary mt-3"><?= htmlspecialchars(get_site_content($pdo, 'donar_btn_text', 'Dona Hoy')) ?></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Empresas y Aliados -->
    <section id="empresas" class="section empresas-section">
        <div class="container">
            <div class="section-header text-center">
                <h2><?= htmlspecialchars(get_site_content($pdo, 'empresas_title', 'Empresas y Aliados Responsables')) ?></h2>
                <p><?= htmlspecialchars(get_site_content($pdo, 'empresas_desc', 'La colaboración con empresas es clave para generar un impacto positivo y sostenible en las comunidades.')) ?></p>
            </div>

            <div class="split-layout">
                <div class="split-content">
                    <div class="grid-2"
                        style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; text-align: left;">
                        <div class="stat-card" style="padding: 1.5rem;">
                            <i class="fas fa-handshake" style="font-size: 2rem;"></i>
                            <h4><?= htmlspecialchars(get_site_content($pdo, 'empresas_card1_title', 'Apoyo Financiero')) ?></h4>
                            <p style="font-size: 0.9rem;"><?= htmlspecialchars(get_site_content($pdo, 'empresas_card1_desc', 'Contribuye a talleres, brigadas y programas comunitarios.')) ?></p>
                        </div>
                        <div class="stat-card" style="padding: 1.5rem;">
                            <i class="fas fa-users" style="font-size: 2rem;"></i>
                            <h4><?= htmlspecialchars(get_site_content($pdo, 'empresas_card2_title', 'Voluntariado')) ?></h4>
                            <p style="font-size: 0.9rem;"><?= htmlspecialchars(get_site_content($pdo, 'empresas_card2_desc', 'Fomenta el compromiso social de tu equipo.')) ?></p>
                        </div>
                        <div class="stat-card" style="padding: 1.5rem;">
                            <i class="fas fa-box-open" style="font-size: 2rem;"></i>
                            <h4><?= htmlspecialchars(get_site_content($pdo, 'empresas_card3_title', 'Donación')) ?></h4>
                            <p style="font-size: 0.9rem;"><?= htmlspecialchars(get_site_content($pdo, 'empresas_card3_desc', 'Materiales, alimentos, ropa o tecnología.')) ?></p>
                        </div>
                        <div class="stat-card" style="padding: 1.5rem;">
                            <i class="fas fa-project-diagram" style="font-size: 2rem;"></i>
                            <h4><?= htmlspecialchars(get_site_content($pdo, 'empresas_card4_title', 'Alianzas')) ?></h4>
                            <p style="font-size: 0.9rem;"><?= htmlspecialchars(get_site_content($pdo, 'empresas_card4_desc', 'Desarrollo de proyectos conjuntos de gran impacto.')) ?></p>
                        </div>
                    </div>
                    <a href="<?= htmlspecialchars(get_site_content($pdo, 'empresas_btn_url', 'https://adepo.eu/hello-world')) ?>" target="_blank"
                        class="btn btn-primary btn-large mt-4"><?= htmlspecialchars(get_site_content($pdo, 'empresas_btn_text', 'Conviértete en Aliado')) ?></a>
                </div>
                <div class="split-image organic-img-2">
                    <img src="<?= htmlspecialchars(get_site_content($pdo, 'empresas_img', 'FOTOS BANNERS/foto leo chicos mejorada ia.png')) ?>" alt="Niños felices" loading="lazy" decoding="async">
                </div>
            </div>
        </div>
    </section>

    <!-- Voluntariado -->
    <section id="voluntariado" class="section voluntariado-section text-white"
        style="background-image: linear-gradient(rgba(0, 80, 133, 0.65), rgba(0, 80, 133, 0.65)), url('<?= htmlspecialchars(get_site_content($pdo, 'voluntariado_bg_img', 'FOTOS BANNERS/FOTO GRUPO JOVENES.png')) ?>'); background-size: cover; background-position: center;">
        <div class="container text-center">
            <h2><?= htmlspecialchars(get_site_content($pdo, 'voluntariado_title', 'Ser Voluntario')) ?></h2>
            <p class="max-w-800 mx-auto mb-4"><?= htmlspecialchars(get_site_content($pdo, 'voluntariado_desc1', 'Únete a nuestra misión de acompañar, apoyar y generar oportunidades para niños y familias vulnerables.')) ?></p>
            <p class="max-w-800 mx-auto mb-4"><?= htmlspecialchars(get_site_content($pdo, 'voluntariado_desc2', 'Ser voluntario en ADN de Amor es construir vínculos, vivir experiencias significativas y contribuir al desarrollo integral...')) ?></p>

            <div class="hero-buttons justify-center">
                <a href="<?= htmlspecialchars(get_site_content($pdo, 'voluntariado_btn1_url', '#contacto')) ?>" class="btn btn-primary btn-large"><?= htmlspecialchars(get_site_content($pdo, 'voluntariado_btn1_text', 'Únete como Voluntario')) ?></a>
                <a href="<?= htmlspecialchars(get_site_content($pdo, 'voluntariado_btn2_url', 'https://adepo.eu/form-pro')) ?>" target="_blank" class="btn btn-outline-white btn-large"><?= htmlspecialchars(get_site_content($pdo, 'voluntariado_btn2_text', 'Prácticas Profesionales')) ?></a>
            </div>
        </div>
    </section>

    <!-- Tienda Solidaria -->
    <section id="tienda" class="section tienda-section bg-light">
        <div class="container">
            <div class="split-layout reverse">
                <div class="split-image organic-img-2">
                    <img src="<?= htmlspecialchars(get_site_content($pdo, 'tienda_img', 'FOTOS BANNERS/tienda_solidaria.png')) ?>" alt="Productos de la Tienda Solidaria" loading="lazy" decoding="async">
                </div>
                <div class="split-content">
                    <h2><?= htmlspecialchars(get_site_content($pdo, 'tienda_title', 'Tienda Solidaria')) ?></h2>
                    <p><strong><?= htmlspecialchars(get_site_content($pdo, 'tienda_subtitle', 'Tu apoyo genera oportunidades')) ?></strong></p>
                    <p><?= htmlspecialchars(get_site_content($pdo, 'tienda_desc', 'En la Tienda Solidaria ADN de Amor encontrarás productos y servicios cuyo valor va más allá de lo material.')) ?></p>
                    <ul class="feature-list">
                        <li><i class="fas fa-shopping-bag"></i> <?= htmlspecialchars(get_site_content($pdo, 'tienda_li1', 'Productos con propósito.')) ?></li>
                        <li><i class="fas fa-laptop-code"></i> <?= htmlspecialchars(get_site_content($pdo, 'tienda_li2', 'Servicios educativos.')) ?></li>
                    </ul>
                    <a href="<?= htmlspecialchars(get_site_content($pdo, 'tienda_btn_url', 'tienda.php')) ?>" class="btn btn-primary mt-3"><?= htmlspecialchars(get_site_content($pdo, 'tienda_btn_text', 'Ver Tienda')) ?></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section id="contacto" class="section contact-section">
        <div class="container">
            <div class="split-layout">
                <div class="split-content">
                    <h2><?= htmlspecialchars(get_site_content($pdo, 'contacto_title', '¿Tienes preguntas o quieres unirte?')) ?></h2>
                    <p><?= htmlspecialchars(get_site_content($pdo, 'contacto_desc', 'Déjanos tus datos y nos pondremos en contacto contigo lo más pronto posible para contarte más sobre cómo puedes apoyar a la Fundación ADN de Amor.')) ?></p>
                    <ul class="feature-list">
                        <li><i class="fas fa-envelope"></i> <?= htmlspecialchars(get_site_content($pdo, 'contacto_email', 'info@adndeamor.org')) ?></li>
                        <li><a href="tel:+573162522445" style="color: inherit; text-decoration: none;"><i class="fas fa-phone"></i> <?= htmlspecialchars(get_site_content($pdo, 'contacto_phone', '+57 316 252 2445')) ?></a></li>
                        <li><a href="https://maps.app.goo.gl/r8JanV3Fn8CeYPSt5" target="_blank" rel="noopener noreferrer" style="color: inherit; text-decoration: none;" title="Ver ubicación en Google Maps"><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars(get_site_content($pdo, 'contacto_location', 'Santa Rosa de Cabal, Risaralda - Colombia')) ?></a></li>
                    </ul>
                </div>
                <div class="split-image" style="flex: 1.5;">
                    <form class="contact-form modern-card"
                        onsubmit="event.preventDefault(); alert('¡Gracias por tu mensaje! Nos pondremos en contacto contigo pronto.');">
                        <h3>Envíanos un mensaje</h3>
                        <div class="form-group">
                            <label>Nombre Completo</label>
                            <input type="text" placeholder="Ej. Juan Pérez" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Correo Electrónico</label>
                            <input type="email" placeholder="ejemplo@correo.com" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Tu Mensaje</label>
                            <textarea placeholder="¿En qué te podemos ayudar?" required class="form-control"
                                rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-large btn-block">Enviar Mensaje <i
                                class="fas fa-paper-plane"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <script src="main.js"></script>
</body>

</html>