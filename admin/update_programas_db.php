<?php
require '../includes/db.php';

try {
    $new_content = [
        // Dónde Estamos
        ['prog_donde_title', 'text', 'Dónde Estamos', 'programas'],
        ['prog_donde_p1', 'text', 'La Fundación ADN de Amor tiene su sede principal y finca ubicada en la vereda Guacas en Santa Rosa de Cabal, cerca al Mirador del Café, desde donde coordinamos y desarrollamos todas nuestras actividades.', 'programas'],
        ['prog_donde_p2', 'text', 'Nuestro trabajo impacta diferentes regiones de Colombia, llevando apoyo integral a niños, niñas, adolescentes, jóvenes y madres cabeza de familia en situación de vulnerabilidad:', 'programas'],
        ['prog_donde_li1_title', 'text', 'Eje Cafetero:', 'programas'],
        ['prog_donde_li1_desc', 'text', 'Acompañamos a comunidades en distintas ciudades y veredas, ofreciendo programas de bienestar, programas de formación no formal, ofreciendo talleres y clases que fortalecen habilidades, talentos y capacidades en niños, niñas, adolescentes y jóvenes.', 'programas'],
        ['prog_donde_li2_title', 'text', 'Región Pacífica (Chocó):', 'programas'],
        ['prog_donde_li2_desc', 'text', 'Apoyamos a niños, niñas y familias vulnerables mediante apadrinamiento, ayuda educativa y acompañamiento integral, brindando apoyo para su educación y bienestar con la colaboración de padrinos y voluntarios.', 'programas'],
        ['prog_donde_img', 'image', 'FOTOS BANNERS/foto principal niños original tamaño mejorada luz.png', 'programas'],
        
        // Qué Hacemos
        ['prog_que_title', 'text', '¿Qué Hacemos?', 'programas'],
        ['prog_que_p1', 'text', 'En la Fundación ADN de Amor, acompañamos y apoyamos el desarrollo integral de niños, niñas, adolescentes, jóvenes y madres cabeza de familia en situación de vulnerabilidad, promoviendo bienestar, esperanza y oportunidades para fortalecer sus proyectos de vida.', 'programas'],
        ['prog_que_h3', 'text', 'Principales acciones:', 'programas'],
        ['prog_que_li1_title', 'text', 'Centro de Desarrollo de Talentos:', 'programas'],
        ['prog_que_li1_desc', 'text', 'Potenciamos habilidades artísticas, deportivas y vocacionales, acompañando el crecimiento personal, espiritual y el propósito de vida.', 'programas'],
        ['prog_que_li2_title', 'text', 'Acompañamiento psicosocial:', 'programas'],
        ['prog_que_li2_desc', 'text', 'Apoyo emocional y social para superar vulnerabilidad o experiencias de violencia.', 'programas'],
        ['prog_que_li3_title', 'text', 'Ayuda humanitaria:', 'programas'],
        ['prog_que_li3_desc', 'text', 'Entrega de alimentos, ropa, medicinas y recursos esenciales.', 'programas'],
        ['prog_que_li4_title', 'text', 'Integración comunitaria:', 'programas'],
        ['prog_que_li4_desc', 'text', 'Talleres y actividades que fomentan inclusión y participación positiva.', 'programas'],
        ['prog_que_li5_title', 'text', 'Redes de cooperación:', 'programas'],
        ['prog_que_li5_desc', 'text', 'Colaboración con aliados, voluntarios y organizaciones para ampliar el alcance y las oportunidades.', 'programas'],
        ['prog_que_p2', 'text', 'Cada acción se guía por principios cristianos de amor, fe, esperanza y servicio, buscando sembrar valores, brindar oportunidades y fortalecer comunidades humanas y solidarias.', 'programas'],
        ['prog_que_img', 'image', 'FOTOS BANNERS/CDT_talentos_completo_ninos.png', 'programas'],
        
        // CDT
        ['prog_cdt_title', 'text', 'Centro de Desarrollo de Talentos', 'programas'],
        ['prog_cdt_p1', 'text', 'El Centro de Desarrollo de Talentos es nuestro programa integral diseñado para acompañar a niños, niñas, adolescentes y jóvenes en su crecimiento personal, emocional, artístico, deportivo y vocacional. Buscamos crear entornos protectores que fortalezcan sus capacidades, bienestar y proyectos de vida, brindando oportunidades de desarrollo real y aprendizaje, siempre desde principios cristianos de amor, fe, esperanza y servicio.', 'programas'],
        ['prog_cdt_p2', 'text', 'Actualmente trabajamos con participantes de 6 a 16 años, brindando atención personalizada y acompañamiento continuo para que cada niño y joven pueda descubrir sus talentos y potenciar sus habilidades.', 'programas'],
        ['prog_cdt_h3', 'text', 'Lo que hacemos', 'programas'],
        ['prog_cdt_card1_title', 'text', 'Perfilado de talentos', 'programas'],
        ['prog_cdt_card1_desc', 'text', 'Identificamos habilidades e intereses en artes, deportes, oficios e idiomas, creando rutas personalizadas de desarrollo.', 'programas'],
        ['prog_cdt_card2_title', 'text', 'Bienestar emocional y espiritual', 'programas'],
        ['prog_cdt_card2_desc', 'text', 'Brindamos acompañamiento emocional y espiritual, fomentando autoestima, resiliencia y propósito de vida.', 'programas'],
        ['prog_cdt_card3_title', 'text', 'Proyectos de vida', 'programas'],
        ['prog_cdt_card3_desc', 'text', 'Orientamos a los jóvenes en la planificación de metas personales, académicas y laborales, liderazgo y emprendimiento.', 'programas'],
        ['prog_cdt_card4_title', 'text', 'Deporte', 'programas'],
        ['prog_cdt_card4_desc', 'text', 'Fomentamos disciplina, hábitos saludables y habilidades socioemocionales mediante fútbol, natación y otras actividades físicas.', 'programas'],
        ['prog_cdt_card5_title', 'text', 'Artes', 'programas'],
        ['prog_cdt_card5_desc', 'text', 'Desarrollamos creatividad, sensibilidad estética y expresión emocional a través de pintura, música y danza.', 'programas'],
        ['prog_cdt_card6_title', 'text', 'Oficios', 'programas'],
        ['prog_cdt_card6_desc', 'text', 'Impulsamos habilidades prácticas para la empleabilidad y generación de ingresos: fotografía, tecnología y cocina emprendedora.', 'programas'],
        ['prog_cdt_card7_title', 'text', 'Idiomas', 'programas'],
        ['prog_cdt_card7_desc', 'text', 'Enseñamos inglés de manera práctica y comunicativa, ampliando oportunidades educativas y laborales.', 'programas'],
        
        ['prog_cdt_img1', 'image', 'FOTOS BANNERS/CDT_ingles_clase_real.png', 'programas'],
        ['prog_cdt_img2', 'image', 'FOTOS BANNERS/CDT_arte_nina_pintura.png', 'programas'],
        ['prog_cdt_img3', 'image', 'FOTOS BANNERS/CDT_musica_nino_guitarra.png', 'programas'],
        
        ['prog_cdt_bottom_title', 'text', 'Oportunidades de participación', 'programas'],
        ['prog_cdt_bottom_p1', 'text', 'Existen espacios para que voluntarios se unan como monitores, tutores o acompañantes de cada programa, así como la posibilidad de apadrinar a un niño o joven, apoyando su proceso de desarrollo y fortalecimiento de talentos. Más detalles sobre cómo participar se encuentran en la sección "Cómo sumarte" de nuestra web.', 'programas'],
        ['prog_cdt_bottom_p2', 'text', 'El Centro de Desarrollo de Talentos es un espacio donde cada participante puede descubrir sus capacidades, fortalecer su propósito y construir un futuro con esperanza, mientras crece en valores, fe y habilidades para la vida.', 'programas'],
        ['prog_cdt_btn_text', 'text', 'Apadrina un niño del CDT', 'programas'],
        ['prog_cdt_btn_url', 'text', 'apadrinar.php', 'programas'],
        
        // Programa Esperanza
        ['prog_esp_title', 'text', 'Programa Esperanza', 'programas'],
        ['prog_esp_p1', 'text', 'Este programa brinda apoyo integral a familias vulnerables y madres cabeza de familia, ofreciendo asistencia esencial para mejorar su calidad de vida y bienestar general.', 'programas'],
        ['prog_esp_li1_title', 'text', 'Alimentación:', 'programas'],
        ['prog_esp_li1_desc', 'text', 'Apoyo con comidas y orientación nutricional.', 'programas'],
        ['prog_esp_li2_title', 'text', 'Vestimenta:', 'programas'],
        ['prog_esp_li2_desc', 'text', 'Entrega de ropa y calzado según necesidades.', 'programas'],
        ['prog_esp_li3_title', 'text', 'Salud:', 'programas'],
        ['prog_esp_li3_desc', 'text', 'Facilitamos acceso a atención médica y orientación sanitaria.', 'programas'],
        ['prog_esp_li4_title', 'text', 'Educación:', 'programas'],
        ['prog_esp_li4_desc', 'text', 'Apoyo escolar con materiales y acompañamiento.', 'programas'],
        ['prog_esp_li5_title', 'text', 'Bienestar familiar:', 'programas'],
        ['prog_esp_li5_desc', 'text', 'Fortalecimiento de la estabilidad familiar y celebraciones (como navidades).', 'programas'],
        ['prog_esp_btn_text', 'text', 'Dona al Programa Esperanza', 'programas'],
        ['prog_esp_btn_url', 'text', 'index.php#donar', 'programas'],
        ['prog_esp_img', 'image', 'FOTOS BANNERS/FOTO BANNER NAVIDADES SELECCION.png', 'programas'],
        
        // Misión Chocó
        ['prog_choco_title', 'text', 'Misión Chocó', 'programas'],
        ['prog_choco_p1', 'text', 'En la región del Chocó, estamos enfocados en desarrollar proyectos de ayuda humanitaria en Gingarabá y sus alrededores. Nuestro objetivo es apoyar a las comunidades más vulnerables.', 'programas'],
        ['prog_choco_p2', 'text', 'Actualmente buscamos apadrinamiento para tres niñas en situación de vulnerabilidad especial, y trabajamos en colaboración con aliados para llevar a cabo:', 'programas'],
        ['prog_choco_li1', 'text', 'Brigadas de salud integrales.', 'programas'],
        ['prog_choco_li2', 'text', 'Construcción y rehabilitación de viviendas.', 'programas'],
        ['prog_choco_li3', 'text', 'Entrega de ayuda humanitaria constante.', 'programas'],
        ['prog_choco_btn_text', 'text', 'Apadrina a una niña del Chocó', 'programas'],
        ['prog_choco_btn_url', 'text', 'apadrinar.php', 'programas'],
        ['prog_choco_img', 'image', 'FOTOS BANNERS/mision_choco_ninos_limpio.png', 'programas']
    ];

    foreach ($new_content as $item) {
        // Verificar si existe la columna page_name
        $stmt = $pdo->query("SHOW COLUMNS FROM site_content LIKE 'page_name'");
        $has_page = $stmt->rowCount() > 0;
        
        if ($has_page) {
            $stmt = $pdo->prepare("INSERT INTO site_content (section_key, content_type, content_value, page_name) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE content_type=VALUES(content_type), page_name=VALUES(page_name)");
            $stmt->execute([$item[0], $item[1], $item[2], $item[3]]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO site_content (section_key, content_type, content_value) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE content_type=VALUES(content_type)");
            $stmt->execute([$item[0], $item[1], $item[2]]);
        }
    }
    echo "Contenido de Programas agregado a la base de datos.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
