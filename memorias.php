<?php require_once 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memorias de Nuestra Labor | Fundación ADN de Amor</title>
    <meta name="description"
        content="Memorias de Nuestra Labor. A lo largo de nuestro recorrido, hemos acompañado a niños y familias en distintas iniciativas que reflejan nuestro compromiso.">

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
            <a href="https://entornos.detodopelis.co/panel/" class="logo">
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
                        <a href="index.php#donar">Dona por una Causa</a>
                        <a href="index.php#empresas">Empresas Socialmente Responsables</a>
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

                <a href="index.php#contacto" class="btn btn-primary">Contacto</a>
            </nav>
        </div>
    </header>

    <!-- Memorias Hero -->
    <section class="section" style="padding-top: 150px; text-align: center;">
        <div class="container" style="max-width: 900px;">
            <h1 style="font-size: 3.5rem; color: var(--secondary); margin-bottom: 0.5rem;">
                Memorias <span style="font-family: 'Great Vibes', cursive; font-weight: 400; color: var(--primary); font-size: 4.5rem;">de Nuestra Labor</span>
                <i class="far fa-heart" style="color: var(--primary); font-size: 1.5rem; margin-left: 5px;"></i>
            </h1>
            <div style="display: flex; align-items: center; justify-content: center; gap: 15px; margin-bottom: 3rem;">
                <div style="height: 1px; width: 50px; background: rgba(230, 57, 70, 0.4);"></div>
                <i class="far fa-heart" style="color: var(--primary);"></i>
                <div style="height: 1px; width: 50px; background: rgba(230, 57, 70, 0.4);"></div>
            </div>
            
            <p style="font-size: 1.2rem; color: var(--text-dark); line-height: 1.8; font-weight: 500;">
                A lo largo de nuestro recorrido, desde 2009, hemos acompañado a niños, niñas, adolescentes, jóvenes y madres cabeza de familia en distintas iniciativas que reflejan nuestro compromiso con su <strong>bienestar, apoyo educativo, formación no formal</strong> y <strong>desarrollo integral</strong>.
            </p>
        </div>
    </section>

    <!-- Actividades -->
    <section class="section" style="padding-top: 0;">
        <div class="container">
            <h3 style="text-align: center; color: var(--primary); font-size: 1.8rem; margin-bottom: 3rem;">Algunas de nuestras actividades incluyen:</h3>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 3rem;">
                <!-- Card 1 -->
                <div style="display: flex; gap: 1.5rem; align-items: flex-start;">
                    <div style="width: 80px; height: 80px; border-radius: 50%; background: rgba(230, 57, 70, 0.1); display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 2px solid rgba(230, 57, 70, 0.3);">
                        <i class="fas fa-book-open" style="font-size: 2.2rem; color: var(--secondary);"></i>
                    </div>
                    <div>
                        <h4 style="color: var(--secondary); font-size: 1.3rem; margin-bottom: 0.8rem;">Clases y talleres</h4>
                        <p style="color: var(--text-dark); font-size: 1.05rem;">Inglés, arte, música y danza para fortalecer talentos y habilidades creativas y artísticas.</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div style="display: flex; gap: 1.5rem; align-items: flex-start;">
                    <div style="width: 80px; height: 80px; border-radius: 50%; background: rgba(230, 57, 70, 0.1); display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 2px solid rgba(230, 57, 70, 0.3);">
                        <i class="fas fa-home" style="font-size: 2.2rem; color: var(--secondary);"></i>
                        <i class="fas fa-heart" style="position: absolute; font-size: 0.8rem; color: var(--primary); margin-top: 5px;"></i>
                    </div>
                    <div>
                        <h4 style="color: var(--secondary); font-size: 1.3rem; margin-bottom: 0.8rem;">Programa Esperanza</h4>
                        <p style="color: var(--text-dark); font-size: 1.05rem;">Apoyo a familias vulnerables mediante entrega de alimentos, ropa y acompañamiento educativo, celebraciones navideñas y otras actividades comunitarias.</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div style="display: flex; gap: 1.5rem; align-items: flex-start;">
                    <div style="width: 80px; height: 80px; border-radius: 50%; background: rgba(230, 57, 70, 0.1); display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 2px solid rgba(230, 57, 70, 0.3);">
                        <i class="fas fa-users" style="font-size: 2.2rem; color: var(--secondary);"></i>
                        <i class="fas fa-heart" style="position: absolute; font-size: 0.8rem; color: var(--primary); margin-bottom: 25px; margin-left: 20px;"></i>
                    </div>
                    <div>
                        <h4 style="color: var(--secondary); font-size: 1.3rem; margin-bottom: 0.8rem;">Visitas y actividades comunitarias</h4>
                        <p style="color: var(--text-dark); font-size: 1.05rem;">Hospitales, brigadas y eventos en distintas comunidades para brindar acompañamiento, alegría y esperanza.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Galería en Carruseles -->
    <section class="section" style="padding-top: 0;">
        <div class="container">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                
                <!-- Carrusel 1 -->
                <div style="text-align: center; display: flex; flex-direction: column;">
                    <div style="position: relative; display: flex; align-items: center; justify-content: center; border-radius: 15px; margin-bottom: 1.5rem;">
                        <button onclick="this.parentElement.querySelector('.carousel-container').scrollBy({left: -300, behavior: 'smooth'})" style="position: absolute; left: -15px; z-index: 10; width: 35px; height: 35px; border-radius: 50%; background: var(--secondary); color: white; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 5px 15px rgba(0,0,0,0.2);"><i class="fas fa-chevron-left"></i></button>
                        
                        <div class="carousel-container" style="display: flex; overflow-x: auto; scroll-snap-type: x mandatory; scrollbar-width: none; border-radius: 15px; box-shadow: 0 10px 20px rgba(0,0,0,0.1); width: 100%;">
                            <img src="FOTOS BANNERS/CDT ARTE FINAL PINTACARITAS SARI.png" alt="Clases y talleres" style="flex: 0 0 100%; width: 100%; height: 280px; object-fit: cover; scroll-snap-align: center;">
                            <img src="FOTOS BANNERS/FOTO BANNER NAVIDADES SELECCION.png" alt="Otras clases" style="flex: 0 0 100%; width: 100%; height: 280px; object-fit: cover; scroll-snap-align: center;">
                            <img src="FOTOS BANNERS/MISION CHOCO BANNER OPCION MEJOR 1.png" alt="Más clases" style="flex: 0 0 100%; width: 100%; height: 280px; object-fit: cover; scroll-snap-align: center;">
                        </div>

                        <button onclick="this.parentElement.querySelector('.carousel-container').scrollBy({left: 300, behavior: 'smooth'})" style="position: absolute; right: -15px; z-index: 10; width: 35px; height: 35px; border-radius: 50%; background: var(--secondary); color: white; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 5px 15px rgba(0,0,0,0.2);"><i class="fas fa-chevron-right"></i></button>
                    </div>
                    
                    <div class="carousel-dots" style="display: flex; justify-content: center; gap: 6px; margin-bottom: 10px;">
                        <div class="dot" style="width: 8px; height: 8px; border-radius: 50%; background: var(--secondary); transition: background 0.3s;"></div>
                        <div class="dot" style="width: 8px; height: 8px; border-radius: 50%; background: rgba(0,16,62,0.2); transition: background 0.3s;"></div>
                        <div class="dot" style="width: 8px; height: 8px; border-radius: 50%; background: rgba(0,16,62,0.2); transition: background 0.3s;"></div>
                    </div>
                    <p style="color: var(--text-dark); font-weight: 500; display: flex; align-items: center; justify-content: center; gap: 0.5rem; font-size: 1.1rem; margin-top: auto;">
                        <i class="fas fa-heart" style="color: var(--primary);"></i> En distintas ocasiones
                    </p>
                </div>

                <!-- Carrusel 2 -->
                <div style="text-align: center; display: flex; flex-direction: column;">
                    <div style="position: relative; display: flex; align-items: center; justify-content: center; border-radius: 15px; margin-bottom: 1.5rem;">
                        <button onclick="this.parentElement.querySelector('.carousel-container').scrollBy({left: -300, behavior: 'smooth'})" style="position: absolute; left: -15px; z-index: 10; width: 35px; height: 35px; border-radius: 50%; background: var(--secondary); color: white; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 5px 15px rgba(0,0,0,0.2);"><i class="fas fa-chevron-left"></i></button>
                        
                        <div class="carousel-container" style="display: flex; overflow-x: auto; scroll-snap-type: x mandatory; scrollbar-width: none; border-radius: 15px; box-shadow: 0 10px 20px rgba(0,0,0,0.1); width: 100%;">
                            <img src="FOTOS BANNERS/FOTO BANNER NAVIDADES SELECCION.png" alt="Programa Esperanza" style="flex: 0 0 100%; width: 100%; height: 280px; object-fit: cover; scroll-snap-align: center;">
                            <img src="FOTOS BANNERS/MISION CHOCO BANNER OPCION MEJOR 1.png" alt="Esperanza" style="flex: 0 0 100%; width: 100%; height: 280px; object-fit: cover; scroll-snap-align: center;">
                            <img src="FOTOS BANNERS/CDT ARTE FINAL PINTACARITAS SARI.png" alt="Esperanza 2" style="flex: 0 0 100%; width: 100%; height: 280px; object-fit: cover; scroll-snap-align: center;">
                        </div>

                        <button onclick="this.parentElement.querySelector('.carousel-container').scrollBy({left: 300, behavior: 'smooth'})" style="position: absolute; right: -15px; z-index: 10; width: 35px; height: 35px; border-radius: 50%; background: var(--secondary); color: white; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 5px 15px rgba(0,0,0,0.2);"><i class="fas fa-chevron-right"></i></button>
                    </div>
                    
                    <div class="carousel-dots" style="display: flex; justify-content: center; gap: 6px; margin-bottom: 10px;">
                        <div class="dot" style="width: 8px; height: 8px; border-radius: 50%; background: var(--secondary); transition: background 0.3s;"></div>
                        <div class="dot" style="width: 8px; height: 8px; border-radius: 50%; background: rgba(0,16,62,0.2); transition: background 0.3s;"></div>
                        <div class="dot" style="width: 8px; height: 8px; border-radius: 50%; background: rgba(0,16,62,0.2); transition: background 0.3s;"></div>
                    </div>
                    <p style="color: var(--text-dark); font-weight: 500; display: flex; align-items: center; justify-content: center; gap: 0.5rem; font-size: 1.1rem; margin-top: auto;">
                        <i class="fas fa-heart" style="color: var(--primary);"></i> A lo largo de nuestras actividades
                    </p>
                </div>

                <!-- Carrusel 3 -->
                <div style="text-align: center; display: flex; flex-direction: column;">
                    <div style="position: relative; display: flex; align-items: center; justify-content: center; border-radius: 15px; margin-bottom: 1.5rem;">
                        <button onclick="this.parentElement.querySelector('.carousel-container').scrollBy({left: -300, behavior: 'smooth'})" style="position: absolute; left: -15px; z-index: 10; width: 35px; height: 35px; border-radius: 50%; background: var(--secondary); color: white; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 5px 15px rgba(0,0,0,0.2);"><i class="fas fa-chevron-left"></i></button>
                        
                        <div class="carousel-container" style="display: flex; overflow-x: auto; scroll-snap-type: x mandatory; scrollbar-width: none; border-radius: 15px; box-shadow: 0 10px 20px rgba(0,0,0,0.1); width: 100%;">
                            <img src="FOTOS BANNERS/MISION CHOCO BANNER OPCION MEJOR 1.png" alt="Visitas Comunitarias" style="flex: 0 0 100%; width: 100%; height: 280px; object-fit: cover; scroll-snap-align: center;">
                            <img src="FOTOS BANNERS/CDT ARTE FINAL PINTACARITAS SARI.png" alt="Visitas 2" style="flex: 0 0 100%; width: 100%; height: 280px; object-fit: cover; scroll-snap-align: center;">
                            <img src="FOTOS BANNERS/FOTO BANNER NAVIDADES SELECCION.png" alt="Visitas 3" style="flex: 0 0 100%; width: 100%; height: 280px; object-fit: cover; scroll-snap-align: center;">
                        </div>

                        <button onclick="this.parentElement.querySelector('.carousel-container').scrollBy({left: 300, behavior: 'smooth'})" style="position: absolute; right: -15px; z-index: 10; width: 35px; height: 35px; border-radius: 50%; background: var(--secondary); color: white; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: 0 5px 15px rgba(0,0,0,0.2);"><i class="fas fa-chevron-right"></i></button>
                    </div>
                    
                    <div class="carousel-dots" style="display: flex; justify-content: center; gap: 6px; margin-bottom: 10px;">
                        <div class="dot" style="width: 8px; height: 8px; border-radius: 50%; background: var(--secondary); transition: background 0.3s;"></div>
                        <div class="dot" style="width: 8px; height: 8px; border-radius: 50%; background: rgba(0,16,62,0.2); transition: background 0.3s;"></div>
                        <div class="dot" style="width: 8px; height: 8px; border-radius: 50%; background: rgba(0,16,62,0.2); transition: background 0.3s;"></div>
                    </div>
                    <p style="color: var(--text-dark); font-weight: 500; display: flex; align-items: center; justify-content: center; gap: 0.5rem; font-size: 1.1rem; margin-top: auto;">
                        <i class="fas fa-heart" style="color: var(--primary);"></i> En distintas ocasiones
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- Banner Final -->
    <section class="section" style="padding-top: 0; padding-bottom: 80px;">
        <div class="container">
            <div style="background: rgba(230, 57, 70, 0.08); border-radius: 20px; padding: 2.5rem 3rem; display: flex; align-items: center; justify-content: space-between; gap: 3rem; flex-wrap: wrap;">
                
                <div style="display: flex; align-items: center; gap: 2rem; flex: 1; min-width: 300px;">
                    <!-- Icono Corazon y Cruz -->
                    <div style="position: relative; color: var(--secondary); flex-shrink: 0; display: flex; align-items: center; justify-content: center;">
                        <i class="far fa-heart" style="font-size: 5rem;"></i>
                        <i class="fas fa-plus" style="position: absolute; font-size: 1.8rem; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i>
                    </div>

                    <!-- Texto -->
                    <div>
                        <p style="color: var(--secondary); font-size: 1.15rem; line-height: 1.6; margin: 0; font-weight: 500;">
                            Cada momento compartido nos motiva a seguir sembrando <strong>amor, fe y esperanza,</strong> contribuyendo al <strong>desarrollo integral</strong> y al bienestar de nuestras comunidades.
                        </p>
                    </div>
                </div>

                <!-- Cursiva -->
                <div style="flex-shrink: 0; text-align: center; position: relative;">
                    <span style="font-family: 'Great Vibes', cursive; font-size: 3.5rem; color: var(--primary); line-height: 1;">¡Seguimos <br>caminando juntos!</span>
                    <i class="far fa-heart" style="color: var(--primary); font-size: 1.2rem; position: absolute; bottom: 0; right: -20px;"></i>
                </div>

            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <script src="main.js"></script>
    <script>
        document.querySelectorAll('.carousel-container').forEach(container => {
            container.addEventListener('scroll', () => {
                const index = Math.round(container.scrollLeft / container.clientWidth);
                const dots = container.parentElement.nextElementSibling.querySelectorAll('.dot');
                dots.forEach((dot, i) => {
                    dot.style.background = i === index ? 'var(--secondary)' : 'rgba(0,16,62,0.2)';
                });
            });
        });
    </script>
</body>

</html>
