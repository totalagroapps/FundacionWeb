<?php
require '../includes/db.php';

try {
    $new_content = [
        // Hero Banners
        ['apad_hero_title', 'text', 'Apadrina un Niño, Niña o Adolescente', 'apadrinar'],
        ['apad_hero_desc', 'text', 'Miles de niños, niñas y adolescentes esperan por un padrino o madrina como tú. ¡Una oportunidad que abre caminos y esperanza!', 'apadrinar'],
        
        // Intro
        ['apad_intro_title', 'text', '¿Qué significa apadrinar?', 'apadrinar'],
        ['apad_intro_p1', 'text', 'Apadrinar significa ofrecer acompañamiento y apoyo a un niño, niña o adolescente, ayudándole a superar barreras y acceder a oportunidades educativas, formativas y de desarrollo integral.', 'apadrinar'],
        ['apad_intro_p2', 'text', 'Cada apadrinamiento contribuye al desarrollo del niño y de su familia, apoyando programas educativos, talleres y actividades de formación, generando oportunidades de crecimiento y bienestar en toda la comunidad.', 'apadrinar'],
        ['apad_intro_img', 'image', 'FOTOS BANNERS/MAMA CON ANGELICA  DEFINITIVA BANNER.png', 'apadrinar'],
        
        // Modalidades
        ['apad_mod_title', 'text', 'Modalidades de Apadrinamiento', 'apadrinar'],
        ['apad_mod_p1', 'text', 'Puedes elegir la forma en que deseas involucrarte y apoyar el desarrollo integral de los niños.', 'apadrinar'],
        ['apad_mod_card1_title', 'text', 'A Largo Plazo', 'apadrinar'],
        ['apad_mod_card1_desc', 'text', 'Crea un vínculo constante y duradero con el apadrinado y su familia, acompañándolos en su crecimiento y desarrollo personal a través de los años.', 'apadrinar'],
        ['apad_mod_card2_title', 'text', 'Centro de Desarrollo de Talentos (CDT)', 'apadrinar'],
        ['apad_mod_card2_desc', 'text', 'Permite que tu apadrinado asista a clases de inglés, arte, música, danza y otras actividades de formación no formal, potenciando sus habilidades y propósito de vida.', 'apadrinar'],
        
        // Cómo Funciona
        ['apad_como_title', 'text', '¿Cómo apadrinar?', 'apadrinar'],
        ['apad_como_p1', 'text', 'El proceso es sencillo y transparente. Sigue estos pasos para comenzar tu historia de apadrinamiento.', 'apadrinar'],
        ['apad_como_step1_title', 'text', 'Elige a quién apoyar', 'apadrinar'],
        ['apad_como_step1_desc', 'text', 'Llena el formulario al final de esta página. Nos pondremos en contacto contigo para que elijas al niño, niña o adolescente que deseas apoyar.', 'apadrinar'],
        ['apad_como_step2_title', 'text', 'Recibe la bienvenida', 'apadrinar'],
        ['apad_como_step2_desc', 'text', 'Recibirás un correo de bienvenida con la foto y el perfil detallado del apadrinado y de su comunidad.', 'apadrinar'],
        ['apad_como_step3_title', 'text', 'Construye un vínculo', 'apadrinar'],
        ['apad_como_step3_desc', 'text', 'Podrás seguir su proceso, recibir actualizaciones y fotos, y mantener contacto a través de cartas o mensajes según el programa.', 'apadrinar'],
        
        // Beneficios
        ['apad_ben_title', 'text', 'Construye un Vínculo Significativo', 'apadrinar'],
        ['apad_ben_p1', 'text', 'A medida que tu relación con tu ahijado crece, podrás:', 'apadrinar'],
        ['apad_ben_li1', 'text', 'Seguir el desarrollo del apadrinado y de su comunidad.', 'apadrinar'],
        ['apad_ben_li2', 'text', 'Recibir fotos, videos y actualizaciones periódicas de sus actividades.', 'apadrinar'],
        ['apad_ben_li3', 'text', 'Intercambiar cartas o mensajes directos con tu apadrinado.', 'apadrinar'],
        ['apad_ben_li4', 'text', 'Participar en eventos y actividades especiales organizados por la fundación.', 'apadrinar'],
        ['apad_ben_img', 'image', 'FOTOS BANNERS/foto principal niños banner final.png', 'apadrinar']
    ];

    foreach ($new_content as $item) {
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
    echo "Contenido de Apadrinar agregado a la base de datos.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
