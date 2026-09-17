<?php require_once 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apadrina un Niño | Fundación ADN de Amor</title>
    <meta name="description" content="Apadrina a un niño, niña o adolescente. Con tu apoyo, abres caminos de esperanza y bienestar.">
    
    <!-- Open Graph / Redes Sociales -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://entornos.detodopelis.co/apadrinar.php">
    <meta property="og:title" content="Apadrina un Niño | Fundación ADN de Amor">
    <meta property="og:description" content="Apadrina a un niño, niña o adolescente. Con tu apoyo, abres caminos de esperanza y bienestar.">
    <meta property="og:image" content="https://entornos.detodopelis.co/FOTOS%20BANNERS/foto%20principal%20ni%C3%B1os%20banner%20final.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://entornos.detodopelis.co/apadrinar.php">
    <meta property="twitter:title" content="Apadrina un Niño | Fundación ADN de Amor">
    <meta property="twitter:description" content="Apadrina a un niño, niña o adolescente. Con tu apoyo, abres caminos de esperanza y bienestar.">
    <meta property="twitter:image" content="https://entornos.detodopelis.co/FOTOS%20BANNERS/foto%20principal%20ni%C3%B1os%20banner%20final.png">

    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;800&family=Inter:wght@400;500;600&family=Great+Vibes&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .page-hero {
            margin-top: 85px;
            padding: 4rem 1rem;
            text-align: center;
            background: linear-gradient(135deg, rgba(234, 90, 0, 0.05) 0%, rgba(0, 16, 62, 0.05) 100%);
        }
        .page-hero h1 {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }
        .timeline {
            display: flex;
            flex-direction: column;
            gap: 2rem;
            margin: 3rem 0;
            position: relative;
        }
        .timeline-step {
            display: flex;
            align-items: flex-start;
            gap: 1.5rem;
            background: var(--white);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: 1px solid rgba(0,0,0,0.05);
        }
        .timeline-number {
            width: 50px;
            height: 50px;
            background: var(--primary);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 800;
            flex-shrink: 0;
        }
        @media (min-width: 768px) {
            .timeline {
                flex-direction: row;
            }
            .timeline-step {
                flex: 1;
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <!-- Preloader -->
    <div id="preloader" class="preloader">
        <div class="loader-content">
            <img src="LOGO Y VISUAL WEB BOTONES/logo ADN_de_Amor_color_rectangulo.png" alt="Fundación ADN de Amor" class="loader-logo">
            <div class="loader-bar-container">
                <div class="loader-bar"></div>
            </div>
            <p class="loader-text">Abriendo caminos de esperanza...</p>
        </div>
    </div>

    <!-- Navbar -->
    <header class="navbar">
        <div class="container nav-container">
            <a href="https://entornos.detodopelis.co/panel/" class="logo">
                <img src="LOGO Y VISUAL WEB BOTONES/logo ADN_de_Amor_color_rectangulo.png" alt="Fundación ADN de Amor Logo">
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
                        <a href="index.php#donar">Dona por una Causa</a>
                        <a href="index.php#empresas">Colaboradores y Prácticas</a>
                        <a href="index.php#voluntariado">Ser Voluntario</a>
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
                
                <a href="#contacto-apadrinar" class="btn btn-primary">Contacto</a>
            </nav>
        </div>
    </header>

    <!-- Page Hero -->
    <section class="page-hero">
        <div class="container">
            <h1><?= htmlspecialchars(get_site_content($pdo, 'apad_hero_title', 'Apadrina un Niño, Niña o Adolescente')) ?></h1>
            <p style="font-size: 1.2rem; max-width: 800px; margin: 0 auto;"><?= htmlspecialchars(get_site_content($pdo, 'apad_hero_desc', 'Miles de niños, niñas y adolescentes esperan por un padrino o madrina como tú. ¡Una oportunidad que abre caminos y esperanza!')) ?></p>
        </div>
    </section>

    <!-- Intro Section -->
    <section class="section">
        <div class="container">
            <div class="split-layout">
                <div class="split-content">
                    <h2><?= htmlspecialchars(get_site_content($pdo, 'apad_intro_title', '¿Qué significa apadrinar?')) ?></h2>
                    <p><?= htmlspecialchars(get_site_content($pdo, 'apad_intro_p1', 'Apadrinar significa ofrecer acompañamiento y apoyo a un niño, niña o adolescente, ayudándole a superar barreras y acceder a oportunidades educativas, formativas y de desarrollo integral.')) ?></p>
                    <p><?= htmlspecialchars(get_site_content($pdo, 'apad_intro_p2', 'Cada apadrinamiento contribuye al desarrollo del niño y de su familia, apoyando programas educativos, talleres y actividades de formación, generando oportunidades de crecimiento y bienestar en toda la comunidad.')) ?></p>
                </div>
                <div class="split-image">
                    <div class="organic-img-2">
                        <img src="<?= htmlspecialchars(get_site_content($pdo, 'apad_intro_img', 'FOTOS BANNERS/MAMA CON ANGELICA  DEFINITIVA BANNER.png')) ?>" alt="Niña sonriendo">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modalidades Section -->
    <section class="section bg-light">
        <div class="container">
            <div class="section-header text-center">
                <h2><?= htmlspecialchars(get_site_content($pdo, 'apad_mod_title', 'Modalidades de Apadrinamiento')) ?></h2>
                <p><?= htmlspecialchars(get_site_content($pdo, 'apad_mod_p1', 'Puedes elegir la forma en que deseas involucrarte y apoyar el desarrollo integral de los niños.')) ?></p>
            </div>
            <div class="grid-2" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                <div class="organic-card" style="background: var(--white); border-top: 5px solid var(--primary);">
                    <i class="fas fa-heart" style="font-size: 2.5rem; color: var(--primary); margin-bottom: 1rem;"></i>
                    <h3><?= htmlspecialchars(get_site_content($pdo, 'apad_mod_card1_title', 'A Largo Plazo')) ?></h3>
                    <p><?= htmlspecialchars(get_site_content($pdo, 'apad_mod_card1_desc', 'Crea un vínculo constante y duradero con el apadrinado y su familia, acompañándolos en su crecimiento y desarrollo personal a través de los años.')) ?></p>
                </div>
                <div class="organic-card" style="background: var(--white); border-top: 5px solid var(--secondary);">
                    <i class="fas fa-palette" style="font-size: 2.5rem; color: var(--secondary); margin-bottom: 1rem;"></i>
                    <h3><?= htmlspecialchars(get_site_content($pdo, 'apad_mod_card2_title', 'Centro de Desarrollo de Talentos (CDT)')) ?></h3>
                    <p><?= htmlspecialchars(get_site_content($pdo, 'apad_mod_card2_desc', 'Permite que tu apadrinado asista a clases de inglés, arte, música, danza y otras actividades de formación no formal, potenciando sus habilidades y propósito de vida.')) ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Cómo funciona -->
    <section class="section">
        <div class="container">
            <div class="section-header text-center">
                <h2><?= htmlspecialchars(get_site_content($pdo, 'apad_como_title', '¿Cómo apadrinar?')) ?></h2>
                <p><?= htmlspecialchars(get_site_content($pdo, 'apad_como_p1', 'El proceso es sencillo y transparente. Sigue estos pasos para comenzar tu historia de apadrinamiento.')) ?></p>
            </div>
            
            <div class="timeline">
                <div class="timeline-step">
                    <div class="timeline-number">1</div>
                    <div>
                        <h3><?= htmlspecialchars(get_site_content($pdo, 'apad_como_step1_title', 'Elige a quién apoyar')) ?></h3>
                        <p><?= htmlspecialchars(get_site_content($pdo, 'apad_como_step1_desc', 'Llena el formulario al final de esta página. Nos pondremos en contacto contigo para que elijas al niño, niña o adolescente que deseas apoyar.')) ?></p>
                    </div>
                </div>
                <div class="timeline-step">
                    <div class="timeline-number">2</div>
                    <div>
                        <h3><?= htmlspecialchars(get_site_content($pdo, 'apad_como_step2_title', 'Recibe la bienvenida')) ?></h3>
                        <p><?= htmlspecialchars(get_site_content($pdo, 'apad_como_step2_desc', 'Recibirás un correo de bienvenida con la foto y el perfil detallado del apadrinado y de su comunidad.')) ?></p>
                    </div>
                </div>
                <div class="timeline-step">
                    <div class="timeline-number">3</div>
                    <div>
                        <h3><?= htmlspecialchars(get_site_content($pdo, 'apad_como_step3_title', 'Construye un vínculo')) ?></h3>
                        <p><?= htmlspecialchars(get_site_content($pdo, 'apad_como_step3_desc', 'Podrás seguir su proceso, recibir actualizaciones y fotos, y mantener contacto a través de cartas o mensajes según el programa.')) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Beneficios / Vínculo -->
    <section class="section bg-light" style="background: var(--primary); color: var(--white);">
        <div class="container">
            <div class="split-layout reverse">
                <div class="split-content">
                    <h2 style="color: var(--white);"><?= htmlspecialchars(get_site_content($pdo, 'apad_ben_title', 'Construye un Vínculo Significativo')) ?></h2>
                    <p style="color: rgba(255,255,255,0.9);"><?= htmlspecialchars(get_site_content($pdo, 'apad_ben_p1', 'A medida que tu relación con tu ahijado crece, podrás:')) ?></p>
                    <ul class="feature-list" style="color: var(--white);">
                        <li style="color: var(--white);"><i class="fas fa-check-circle" style="color: var(--white);"></i> <?= htmlspecialchars(get_site_content($pdo, 'apad_ben_li1', 'Seguir el desarrollo del apadrinado y de su comunidad.')) ?></li>
                        <li style="color: var(--white);"><i class="fas fa-check-circle" style="color: var(--white);"></i> <?= htmlspecialchars(get_site_content($pdo, 'apad_ben_li2', 'Recibir fotos, videos y actualizaciones periódicas de sus actividades.')) ?></li>
                        <li style="color: var(--white);"><i class="fas fa-check-circle" style="color: var(--white);"></i> <?= htmlspecialchars(get_site_content($pdo, 'apad_ben_li3', 'Intercambiar cartas o mensajes directos con tu apadrinado.')) ?></li>
                        <li style="color: var(--white);"><i class="fas fa-check-circle" style="color: var(--white);"></i> <?= htmlspecialchars(get_site_content($pdo, 'apad_ben_li4', 'Participar en eventos y actividades especiales organizados por la fundación.')) ?></li>
                    </ul>
                </div>
                <div class="split-image">
                    <div class="organic-img">
                        <img src="<?= htmlspecialchars(get_site_content($pdo, 'apad_ben_img', 'FOTOS BANNERS/foto principal niños banner final.png')) ?>" alt="Niños felices">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Formulario de Contacto Especializado -->
    <section id="contacto-apadrinar" class="section">
        <div class="container" style="max-width: 800px; margin: 0 auto;">
            <div class="section-header text-center">
                <h2>¿Quieres apadrinar y abrir caminos de esperanza?</h2>
                <p>Contáctanos para recibir información y descubrir como puedes crear un vínculo de apoyo y acompañamiento.</p>
            </div>
            
            <form class="contact-form modern-card" onsubmit="event.preventDefault(); alert('¡Gracias por tu interés en apadrinar! Nos pondremos en contacto contigo muy pronto para continuar el proceso.');">
                <div class="grid-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div class="form-group">
                        <label>Nombre y Apellidos</label>
                        <input type="text" placeholder="Ej. Juan Pérez" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Correo Electrónico</label>
                        <input type="email" placeholder="ejemplo@correo.com" required class="form-control">
                    </div>
                </div>
                
                <div class="grid-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div class="form-group">
                        <label>Teléfono / WhatsApp</label>
                        <input type="tel" placeholder="+57 300 000 0000" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Localidad / País</label>
                        <input type="text" placeholder="Ej. Bogotá, Colombia" required class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <label>¿Como deseas apadrinar?</label>
                    <select class="form-control" required style="cursor: pointer;">
                        <option value="">Selecciona una opción...</option>
                        <option value="largo-plazo">Apadrinamiento a Largo Plazo</option>
                        <option value="cdt">Para el Centro de Desarrollo de Talentos (CDT)</option>
                        <option value="asesoria">Aún no estoy seguro, quiero que me asesoren</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Mensaje Opcional (Cuéntanos un poco sobre ti y tu motivación para apadrinar)</label>
                    <textarea placeholder="Tu mensaje aquí..." class="form-control" rows="4"></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary btn-large btn-block" style="font-size: 1.1rem; padding: 1.2rem;">Enviar Solicitud de Apadrinamiento <i class="fas fa-heart"></i></button>
            </form>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
    <script src="main.js"></script>
</body>
</html>
