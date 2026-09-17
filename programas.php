<?php require_once 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuestros Programas | Fundación ADN de Amor</title>
    <meta name="description" content="Conoce el Centro de Desarrollo de Talentos, Programa Esperanza y Misión Chocó.">

    <!-- Open Graph / Redes Sociales -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://fundacionadndeamor.org/programas">
    <meta property="og:title" content="Nuestros Programas | Fundación ADN de Amor">
    <meta property="og:description"
        content="Conoce el Centro de Desarrollo de Talentos, Programa Esperanza y Misión Chocó.">
    <meta property="og:image"
        content="https://fundacionadndeamor.org/FOTOS%20BANNERS/foto%20principal%20ni%C3%B1os%20banner%20final.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://fundacionadndeamor.org/programas">
    <meta property="twitter:title" content="Nuestros Programas | Fundación ADN de Amor">
    <meta property="twitter:description"
        content="Conoce el Centro de Desarrollo de Talentos, Programa Esperanza y Misión Chocó.">
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

        /* Specific program layout fixes */
        .program-card {
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: 0.3s;
        }

        .program-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .program-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        .program-card-content {
            padding: 2rem;
        }

        .program-card-content h4 {
            color: var(--secondary);
            margin-bottom: 1rem;
            font-size: 1.25rem;
        }
    </style>
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
                        <a href="#donde-estamos">Dónde Estamos</a>
                        <a href="#que-hacemos">¿Qué Hacemos?</a>
                        <a href="#cdt">Centro de Desarrollo de Talentos</a>
                        <a href="#esperanza">Programa Esperanza</a>
                        <a href="#choco">Misión Chocó</a>
                        <a href="#linea">Línea de Ayuda ADN</a>
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
                        <a href="empresas">Empresas y Aliados</a>
                        <a href="practicas">Prácticas Profesionales</a>
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

    <!-- Page Hero -->
    <section class="page-hero">
        <div class="container">
            <h1><?= htmlspecialchars(get_site_content($pdo, 'prog_hero_title', 'Nuestros Programas y Proyectos')) ?></h1>
            <p style="font-size: 1.2rem; max-width: 800px; margin: 0 auto;"><?= htmlspecialchars(get_site_content($pdo, 'prog_hero_desc', 'En la Fundación ADN de Amor, acompañamos y apoyamos el desarrollo integral de niños, niñas, adolescentes y familias, promoviendo bienestar, esperanza y oportunidades.')) ?></p>
        </div>
    </section>

    <!-- Dónde Estamos -->
    <section id="donde-estamos" class="section">
        <div class="container">
            <div class="split-layout">
                <div class="split-content">
                    <h2><?= htmlspecialchars(get_site_content($pdo, 'prog_donde_title', 'Dónde Estamos')) ?></h2>
                    <p><?= htmlspecialchars(get_site_content($pdo, 'prog_donde_p1', 'La Fundación ADN de Amor tiene su sede principal y finca ubicada en la vereda Guacas en Santa Rosa de Cabal, cerca al Mirador del Café, desde donde coordinamos y desarrollamos todas nuestras actividades.')) ?></p>
                    <p style="margin-top: -0.5rem; margin-bottom: 1.5rem;">
                        <a href="https://maps.app.goo.gl/r8JanV3Fn8CeYPSt5" target="_blank" rel="noopener noreferrer" style="color: var(--primary); font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                            <i class="fas fa-map-marked-alt"></i> Ver ubicación de la finca en Google Maps
                        </a>
                    </p>
                    <p><?= htmlspecialchars(get_site_content($pdo, 'prog_donde_p2', 'Nuestro trabajo impacta diferentes regiones de Colombia, llevando apoyo integral a niños, niñas, adolescentes, jóvenes y madres cabeza de familia en situación de vulnerabilidad:')) ?></p>
                    <ul class="feature-list" style="margin-top: 1.5rem;">
                        <li><i class="fas fa-map-marker-alt"></i> <strong><?= htmlspecialchars(get_site_content($pdo, 'prog_donde_li1_title', 'Eje Cafetero:')) ?></strong> <?= htmlspecialchars(get_site_content($pdo, 'prog_donde_li1_desc', 'Acompañamos a comunidades en distintas ciudades y veredas, ofreciendo programas de bienestar, programas de formación no formal, ofreciendo talleres y clases que fortalecen habilidades, talentos y capacidades en niños, niñas, adolescentes y jóvenes.')) ?></li>
                        <li><i class="fas fa-map-marker-alt"></i> <strong><?= htmlspecialchars(get_site_content($pdo, 'prog_donde_li2_title', 'Región Pacífica (Chocó):')) ?></strong> <?= htmlspecialchars(get_site_content($pdo, 'prog_donde_li2_desc', 'Apoyamos a niños, niñas y familias vulnerables mediante apadrinamiento, ayuda educativa y acompañamiento integral, brindando apoyo para su educación y bienestar con la colaboración de padrinos y voluntarios.')) ?></li>
                    </ul>
                </div>
                <div class="split-image organic-img">
                    <img src="<?= htmlspecialchars(get_site_content($pdo, 'prog_donde_img', 'FOTOS BANNERS/foto principal niños original tamaño mejorada luz.png')) ?>" loading="lazy" decoding="async" alt="Sede y regiones">
                </div>
            </div>
        </div>
    </section>

    <!-- Qué Hacemos -->
    <section id="que-hacemos" class="section bg-light">
        <div class="container">
            <div class="split-layout reverse">
                <div class="split-content">
                    <h2><?= htmlspecialchars(get_site_content($pdo, 'prog_que_title', '¿Qué Hacemos?')) ?></h2>
                    <p><?= htmlspecialchars(get_site_content($pdo, 'prog_que_p1', 'En la Fundación ADN de Amor, acompañamos y apoyamos el desarrollo integral de niños, niñas, adolescentes, jóvenes y madres cabeza de familia en situación de vulnerabilidad, promoviendo bienestar, esperanza y oportunidades para fortalecer sus proyectos de vida.')) ?></p>
                    <h3 style="font-size: 1.5rem; margin-top: 1.5rem; margin-bottom: 1rem; color: var(--secondary);"><?= htmlspecialchars(get_site_content($pdo, 'prog_que_h3', 'Principales acciones:')) ?></h3>
                    <ul class="feature-list">
                        <li><i class="fas fa-star"></i> <strong><?= htmlspecialchars(get_site_content($pdo, 'prog_que_li1_title', 'Centro de Desarrollo de Talentos:')) ?></strong> <?= htmlspecialchars(get_site_content($pdo, 'prog_que_li1_desc', 'Potenciamos habilidades artísticas, deportivas y vocacionales, acompañando el crecimiento personal, espiritual y el propósito de vida.')) ?></li>
                        <li><i class="fas fa-heart"></i> <strong><?= htmlspecialchars(get_site_content($pdo, 'prog_que_li2_title', 'Acompañamiento psicosocial:')) ?></strong> <?= htmlspecialchars(get_site_content($pdo, 'prog_que_li2_desc', 'Apoyo emocional y social para superar vulnerabilidad o experiencias de violencia.')) ?></li>
                        <li><i class="fas fa-box-open"></i> <strong><?= htmlspecialchars(get_site_content($pdo, 'prog_que_li3_title', 'Ayuda humanitaria:')) ?></strong> <?= htmlspecialchars(get_site_content($pdo, 'prog_que_li3_desc', 'Entrega de alimentos, ropa, medicinas y recursos esenciales.')) ?></li>
                        <li><i class="fas fa-users"></i> <strong><?= htmlspecialchars(get_site_content($pdo, 'prog_que_li4_title', 'Integración comunitaria:')) ?></strong> <?= htmlspecialchars(get_site_content($pdo, 'prog_que_li4_desc', 'Talleres y actividades que fomentan inclusión y participación positiva.')) ?></li>
                        <li><i class="fas fa-hands-helping"></i> <strong><?= htmlspecialchars(get_site_content($pdo, 'prog_que_li5_title', 'Redes de cooperación:')) ?></strong> <?= htmlspecialchars(get_site_content($pdo, 'prog_que_li5_desc', 'Colaboración con aliados, voluntarios y organizaciones para ampliar el alcance y las oportunidades.')) ?></li>
                    </ul>
                    <p style="margin-top: 1.5rem;"><?= htmlspecialchars(get_site_content($pdo, 'prog_que_p2', 'Cada acción se guía por principios cristianos de amor, fe, esperanza y servicio, buscando sembrar valores, brindar oportunidades y fortalecer comunidades humanas y solidarias.')) ?></p>
                </div>
                <div class="split-image organic-img-2">
                    <img src="<?= htmlspecialchars(get_site_content($pdo, 'prog_que_img', 'FOTOS BANNERS/CENTRO DESARROLLO DE TALENTOS BANNER 1.png')) ?>" loading="lazy" decoding="async" alt="Labor de la Fundación">
                </div>
            </div>
        </div>
    </section>

    <!-- Centro de Desarrollo de Talentos (CDT) -->
    <section id="cdt" class="section">
        <div class="container">
            <div class="section-header text-center">
                <h2><?= htmlspecialchars(get_site_content($pdo, 'prog_cdt_title', 'Centro de Desarrollo de Talentos')) ?></h2>
                <p style="text-align: left; margin-bottom: 1rem; color: var(--text-dark);"><?= htmlspecialchars(get_site_content($pdo, 'prog_cdt_p1', 'El Centro de Desarrollo de Talentos es nuestro programa integral diseñado para acompañar a niños, niñas, adolescentes y jóvenes en su crecimiento personal, emocional, artístico, deportivo y vocacional. Buscamos crear entornos protectores que fortalezcan sus capacidades, bienestar y proyectos de vida, brindando oportunidades de desarrollo real y aprendizaje, siempre desde principios cristianos de amor, fe, esperanza y servicio.')) ?></p>
                <p style="text-align: left; margin-bottom: 2rem; color: var(--text-dark);"><?= htmlspecialchars(get_site_content($pdo, 'prog_cdt_p2', 'Actualmente trabajamos con participantes de 6 a 16 años, brindando atención personalizada y acompañamiento continuo para que cada niño y joven pueda descubrir sus talentos y potenciar sus habilidades.')) ?></p>
            </div>

            <h3 style="font-size: 2rem; color: var(--secondary); margin-bottom: 2rem; text-align: center;"><?= htmlspecialchars(get_site_content($pdo, 'prog_cdt_h3', 'Lo que hacemos')) ?></h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
                <div class="organic-card" style="background: var(--white); border-top: 4px solid var(--primary);">
                    <i class="fas fa-search" style="font-size: 2rem; color: var(--primary); margin-bottom: 1rem;"></i>
                    <h4><?= htmlspecialchars(get_site_content($pdo, 'prog_cdt_card1_title', 'Perfilado de talentos')) ?></h4>
                    <p style="font-size: 0.95rem;"><?= htmlspecialchars(get_site_content($pdo, 'prog_cdt_card1_desc', 'Identificamos habilidades e intereses en artes, deportes, oficios e idiomas, creando rutas personalizadas de desarrollo.')) ?></p>
                </div>
                <div class="organic-card" style="background: var(--white); border-top: 4px solid var(--secondary);">
                    <i class="fas fa-heart" style="font-size: 2rem; color: var(--secondary); margin-bottom: 1rem;"></i>
                    <h4><?= htmlspecialchars(get_site_content($pdo, 'prog_cdt_card2_title', 'Bienestar emocional y espiritual')) ?></h4>
                    <p style="font-size: 0.95rem;"><?= htmlspecialchars(get_site_content($pdo, 'prog_cdt_card2_desc', 'Brindamos acompañamiento emocional y espiritual, fomentando autoestima, resiliencia y propósito de vida.')) ?></p>
                </div>
                <div class="organic-card" style="background: var(--white); border-top: 4px solid var(--primary);">
                    <i class="fas fa-compass" style="font-size: 2rem; color: var(--primary); margin-bottom: 1rem;"></i>
                    <h4><?= htmlspecialchars(get_site_content($pdo, 'prog_cdt_card3_title', 'Proyectos de vida')) ?></h4>
                    <p style="font-size: 0.95rem;"><?= htmlspecialchars(get_site_content($pdo, 'prog_cdt_card3_desc', 'Orientamos a los jóvenes en la planificación de metas personales, académicas y laborales, liderazgo y emprendimiento.')) ?></p>
                </div>
                <div class="organic-card" style="background: var(--white); border-top: 4px solid var(--secondary);">
                    <i class="fas fa-futbol" style="font-size: 2rem; color: var(--secondary); margin-bottom: 1rem;"></i>
                    <h4><?= htmlspecialchars(get_site_content($pdo, 'prog_cdt_card4_title', 'Deporte')) ?></h4>
                    <p style="font-size: 0.95rem;"><?= htmlspecialchars(get_site_content($pdo, 'prog_cdt_card4_desc', 'Fomentamos disciplina, hábitos saludables y habilidades socioemocionales mediante fútbol, natación y otras actividades físicas.')) ?></p>
                </div>
                <div class="organic-card" style="background: var(--white); border-top: 4px solid var(--primary);">
                    <i class="fas fa-palette" style="font-size: 2rem; color: var(--primary); margin-bottom: 1rem;"></i>
                    <h4><?= htmlspecialchars(get_site_content($pdo, 'prog_cdt_card5_title', 'Artes')) ?></h4>
                    <p style="font-size: 0.95rem;"><?= htmlspecialchars(get_site_content($pdo, 'prog_cdt_card5_desc', 'Desarrollamos creatividad, sensibilidad estética y expresión emocional a través de pintura, música y danza.')) ?></p>
                </div>
                <div class="organic-card" style="background: var(--white); border-top: 4px solid var(--secondary);">
                    <i class="fas fa-tools" style="font-size: 2rem; color: var(--secondary); margin-bottom: 1rem;"></i>
                    <h4><?= htmlspecialchars(get_site_content($pdo, 'prog_cdt_card6_title', 'Oficios')) ?></h4>
                    <p style="font-size: 0.95rem;"><?= htmlspecialchars(get_site_content($pdo, 'prog_cdt_card6_desc', 'Impulsamos habilidades prácticas para la empleabilidad y generación de ingresos: fotografía, tecnología y cocina emprendedora.')) ?></p>
                </div>
                <div class="organic-card" style="background: var(--white); border-top: 4px solid var(--primary);">
                    <i class="fas fa-language" style="font-size: 2rem; color: var(--primary); margin-bottom: 1rem;"></i>
                    <h4><?= htmlspecialchars(get_site_content($pdo, 'prog_cdt_card7_title', 'Idiomas')) ?></h4>
                    <p style="font-size: 0.95rem;"><?= htmlspecialchars(get_site_content($pdo, 'prog_cdt_card7_desc', 'Enseñamos inglés de manera práctica y comunicativa, ampliando oportunidades educativas y laborales.')) ?></p>
                </div>
            </div>

            <div class="grid-3" style="margin-top: 3rem;">
                <div class="program-card">
                    <img src="<?= htmlspecialchars(get_site_content($pdo, 'prog_cdt_img1', 'FOTOS BANNERS/CDT INGLES BANNER FINAL SANDRA.png')) ?>" loading="lazy" decoding="async" alt="Clases de Inglés">
                </div>
                <div class="program-card">
                    <img src="<?= htmlspecialchars(get_site_content($pdo, 'prog_cdt_img2', 'FOTOS BANNERS/CDT ARTE FINAL PINTACARITAS SARI.png')) ?>" loading="lazy" decoding="async" alt="Clases de Arte">
                </div>
                <div class="program-card">
                    <img src="<?= htmlspecialchars(get_site_content($pdo, 'prog_cdt_img3', 'FOTOS BANNERS/CDT MUSICA 1 SELECCIONADA.png')) ?>" loading="lazy" decoding="async" alt="Música">
                </div>
            </div>

            <div class="split-layout" style="margin-top: 4rem; background: rgba(234, 90, 0, 0.05); padding: 2rem; border-radius: 20px;">
                <div class="split-content" style="width: 100%;">
                    <h3><?= htmlspecialchars(get_site_content($pdo, 'prog_cdt_bottom_title', 'Oportunidades de participación')) ?></h3>
                    <p><?= htmlspecialchars(get_site_content($pdo, 'prog_cdt_bottom_p1', 'Existen espacios para que voluntarios se unan como monitores, tutores o acompañantes de cada programa, así como la posibilidad de apadrinar a un niño o joven, apoyando su proceso de desarrollo y fortalecimiento de talentos. Más detalles sobre cómo participar se encuentran en la sección "Cómo sumarte" de nuestra web.')) ?></p>
                    <p style="margin-top: 1rem;"><strong><?= htmlspecialchars(get_site_content($pdo, 'prog_cdt_bottom_p2', 'El Centro de Desarrollo de Talentos es un espacio donde cada participante puede descubrir sus capacidades, fortalecer su propósito y construir un futuro con esperanza, mientras crece en valores, fe y habilidades para la vida.')) ?></strong></p>
                    <div style="margin-top: 1.5rem;">
                        <a href="<?= htmlspecialchars(get_site_content($pdo, 'prog_cdt_btn_url', 'apadrinar')) ?>" class="btn btn-primary"><?= htmlspecialchars(get_site_content($pdo, 'prog_cdt_btn_text', 'Apadrina un niño del CDT')) ?></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Programa Esperanza -->
    <section id="esperanza" class="section">
        <div class="container">
            <div class="split-layout reverse">
                <div class="split-content">
                    <h2><?= htmlspecialchars(get_site_content($pdo, 'prog_esp_title', 'Programa Esperanza')) ?></h2>
                    <p><?= htmlspecialchars(get_site_content($pdo, 'prog_esp_p1', 'Este programa brinda apoyo integral a familias vulnerables y madres cabeza de familia, ofreciendo asistencia esencial para mejorar su calidad de vida y bienestar general.')) ?></p>
                    <ul class="feature-list" style="margin-top: 1.5rem;">
                        <li><i class="fas fa-utensils"></i> <strong><?= htmlspecialchars(get_site_content($pdo, 'prog_esp_li1_title', 'Alimentación:')) ?></strong> <?= htmlspecialchars(get_site_content($pdo, 'prog_esp_li1_desc', 'Apoyo con comidas y orientación nutricional.')) ?></li>
                        <li><i class="fas fa-tshirt"></i> <strong><?= htmlspecialchars(get_site_content($pdo, 'prog_esp_li2_title', 'Vestimenta:')) ?></strong> <?= htmlspecialchars(get_site_content($pdo, 'prog_esp_li2_desc', 'Entrega de ropa y calzado según necesidades.')) ?></li>
                        <li><i class="fas fa-heartbeat"></i> <strong><?= htmlspecialchars(get_site_content($pdo, 'prog_esp_li3_title', 'Salud:')) ?></strong> <?= htmlspecialchars(get_site_content($pdo, 'prog_esp_li3_desc', 'Facilitamos acceso a atención médica y orientación sanitaria.')) ?></li>
                        <li><i class="fas fa-book"></i> <strong><?= htmlspecialchars(get_site_content($pdo, 'prog_esp_li4_title', 'Educación:')) ?></strong> <?= htmlspecialchars(get_site_content($pdo, 'prog_esp_li4_desc', 'Apoyo escolar con materiales y acompañamiento.')) ?></li>
                        <li><i class="fas fa-home"></i> <strong><?= htmlspecialchars(get_site_content($pdo, 'prog_esp_li5_title', 'Bienestar familiar:')) ?></strong> <?= htmlspecialchars(get_site_content($pdo, 'prog_esp_li5_desc', 'Fortalecimiento de la estabilidad familiar y celebraciones (como navidades).')) ?></li>
                    </ul>
                    <div style="margin-top: 2rem;">
                        <a href="<?= htmlspecialchars(get_site_content($pdo, 'prog_esp_btn_url', '/#donar')) ?>" class="btn btn-primary"><?= htmlspecialchars(get_site_content($pdo, 'prog_esp_btn_text', 'Dona al Programa Esperanza')) ?></a>
                    </div>
                </div>
                <div class="split-image">
                    <div class="organic-img-2">
                        <img src="<?= htmlspecialchars(get_site_content($pdo, 'prog_esp_img', 'FOTOS BANNERS/FOTO BANNER NAVIDADES SELECCION.png')) ?>" loading="lazy" decoding="async" alt="Programa Esperanza y Navidades">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Misión Chocó -->
    <section id="choco" class="section bg-light" style="background-color: var(--secondary); color: var(--white);">
        <div class="container">
            <div class="split-layout">
                <div class="split-content">
                    <h2 style="color: var(--white);"><?= htmlspecialchars(get_site_content($pdo, 'prog_choco_title', 'Misión Chocó')) ?></h2>
                    <p style="color: rgba(255,255,255,0.9);"><?= htmlspecialchars(get_site_content($pdo, 'prog_choco_p1', 'En la región del Chocó, estamos enfocados en desarrollar proyectos de ayuda humanitaria en Gingarabá y sus alrededores. Nuestro objetivo es apoyar a las comunidades más vulnerables.')) ?></p>
                    <p style="color: rgba(255,255,255,0.9); margin-top: 1rem;"><?= htmlspecialchars(get_site_content($pdo, 'prog_choco_p2', 'Actualmente buscamos apadrinamiento para tres niñas en situación de vulnerabilidad especial, y trabajamos en colaboración con aliados para llevar a cabo:')) ?></p>
                    <ul class="feature-list" style="margin-top: 1.5rem;">
                        <li style="color: var(--white);"><i class="fas fa-medkit" style="color: var(--white);"></i> <?= htmlspecialchars(get_site_content($pdo, 'prog_choco_li1', 'Brigadas de salud integrales.')) ?></li>
                        <li style="color: var(--white);"><i class="fas fa-hammer" style="color: var(--white);"></i> <?= htmlspecialchars(get_site_content($pdo, 'prog_choco_li2', 'Construcción y rehabilitación de viviendas.')) ?></li>
                        <li style="color: var(--white);"><i class="fas fa-hands-helping" style="color: var(--white);"></i> <?= htmlspecialchars(get_site_content($pdo, 'prog_choco_li3', 'Entrega de ayuda humanitaria constante.')) ?></li>
                    </ul>
                    <div style="margin-top: 2rem;">
                        <a href="<?= htmlspecialchars(get_site_content($pdo, 'prog_choco_btn_url', 'apadrinar')) ?>" class="btn btn-primary"
                            style="background: var(--white); color: var(--primary);"><?= htmlspecialchars(get_site_content($pdo, 'prog_choco_btn_text', 'Apadrina a una niña del Chocó')) ?></a>
                    </div>
                </div>
                <div class="split-image">
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        <img src="<?= htmlspecialchars(get_site_content($pdo, 'prog_choco_img', 'FOTOS BANNERS/MISION CHOCO BANNER OPCION MEJOR 1.png')) ?>" loading="lazy" decoding="async" alt="Misión Chocó"
                            style="border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Línea de Ayuda ADN -->
    <section id="linea" class="section text-center">
        <div class="container" style="max-width: 800px;">
            <i class="fas fa-headset" style="font-size: 3rem; color: var(--primary); margin-bottom: 1.5rem;"></i>
            <h2>Línea de Ayuda ADN</h2>
            <p style="font-size: 1.1rem; margin-top: 1rem;">Un proyecto a mediano plazo en Santa Rosa de Cabal que
                ofrecerá un espacio de escucha y orientación espiritual comunitaria. Funcionará mediante una línea de
                WhatsApp atendida por nuestro equipo y voluntarios, disponible para brindar acompañamiento, guía y apoyo
                seguro a quienes más lo necesiten.</p>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
    <script src="main.js"></script>
</body>

</html>