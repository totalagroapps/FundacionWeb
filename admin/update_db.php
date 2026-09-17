<?php
require '../includes/db.php';

$new_content = [
    // Apadrinar
    ['apadrinar_card1_img', 'image', 'FOTOS BANNERS/foto prinicpal 2 niños banner final.png'],
    ['apadrinar_card1_title', 'text', 'A Largo Plazo'],
    ['apadrinar_card1_desc', 'text', 'Crea un vínculo constante con el apadrinado y su familia, apoyando su desarrollo integral.'],
    ['apadrinar_card2_img', 'image', 'FOTOS BANNERS/CDT MUSICA 1 SELECCIONADA.png'],
    ['apadrinar_card2_title', 'text', 'Desarrollo de Talentos'],
    ['apadrinar_card2_desc', 'text', 'Permite que asistan al CDT para clases de inglés, arte, música, danza y formación.'],
    ['apadrinar_card3_img', 'image', 'FOTOS BANNERS/MAMA CON ANGELICA  DEFINITIVA BANNER.png'],
    ['apadrinar_card3_title', 'text', 'Construye un Vínculo'],
    ['apadrinar_card3_desc', 'text', 'Sigue su proceso, recibe fotos y mantén contacto a través de cartas o mensajes.'],
    ['apadrinar_btn_text', 'text', 'Descubre cómo apadrinar y conocer a los niños'],

    // Donar
    ['donar_desc', 'text', 'Cada aporte que haces a la Fundación ADN de Amor contribuye a crear oportunidades, esperanza y bienestar en situación de vulnerabilidad.'],
    ['donar_li1', 'text', 'Centro de Desarrollo de Talentos: Clases de inglés, arte, música y danza.'],
    ['donar_li2', 'text', 'Programa Esperanza: Alimentos, ropa y acompañamiento educativo.'],
    ['donar_li3', 'text', 'Proyectos comunitarios: Brigadas de salud y construcción de viviendas.'],
    ['donar_footer_text', 'text', 'Tu aporte genera un efecto multiplicador. ¡Tú puedes marcar la diferencia!'],
    ['donar_btn_text', 'text', 'Dona Hoy'],

    // Empresas
    ['empresas_title', 'text', 'Empresas y Aliados Responsables'],
    ['empresas_desc', 'text', 'La colaboración con empresas es clave para generar un impacto positivo y sostenible en las comunidades.'],
    ['empresas_card1_title', 'text', 'Apoyo Financiero'],
    ['empresas_card1_desc', 'text', 'Contribuye a talleres, brigadas y programas comunitarios.'],
    ['empresas_card2_title', 'text', 'Voluntariado'],
    ['empresas_card2_desc', 'text', 'Fomenta el compromiso social de tu equipo.'],
    ['empresas_card3_title', 'text', 'Donación'],
    ['empresas_card3_desc', 'text', 'Materiales, alimentos, ropa o tecnología.'],
    ['empresas_card4_title', 'text', 'Alianzas'],
    ['empresas_card4_desc', 'text', 'Desarrollo de proyectos conjuntos de gran impacto.'],
    ['empresas_btn_text', 'text', 'Conviértete en Aliado'],
    ['empresas_img', 'image', 'FOTOS BANNERS/foto leo chicos mejorada ia.png'],

    // Voluntariado
    ['voluntariado_bg_img', 'image', 'FOTOS BANNERS/FOTO GRUPO JOVENES.png'],
    ['voluntariado_title', 'text', 'Ser Voluntario'],
    ['voluntariado_desc1', 'text', 'Únete a nuestra misión de acompañar, apoyar y generar oportunidades para niños y familias vulnerables. Ofrecemos oportunidades para colaborar en talleres, clases, acompañamiento en actividades del CDT y el Programa Esperanza.'],
    ['voluntariado_desc2', 'text', 'Ser voluntario en ADN de Amor es construir vínculos, vivir experiencias significativas y contribuir al desarrollo integral desde los principios cristianos de amor, fe, esperanza y servicio.'],
    ['voluntariado_btn1_text', 'text', 'Únete como Voluntario'],
    ['voluntariado_btn2_text', 'text', 'Prácticas Profesionales'],

    // Tienda
    ['tienda_img', 'image', 'FOTOS BANNERS/tienda_solidaria.png'],
    ['tienda_title', 'text', 'Tienda Solidaria'],
    ['tienda_subtitle', 'text', 'Tu apoyo genera oportunidades'],
    ['tienda_desc', 'text', 'En la Tienda Solidaria ADN de Amor encontrarás productos y servicios cuyo valor va más allá de lo material. Cada compra contribuye directamente a apoyar todas nuestras actividades y proyectos.'],
    ['tienda_li1', 'text', 'Productos con propósito.'],
    ['tienda_li2', 'text', 'Servicios educativos.'],
    ['tienda_btn_text', 'text', 'Ver Tienda'],

    // Contacto
    ['contacto_title', 'text', '¿Tienes preguntas o quieres unirte?'],
    ['contacto_desc', 'text', 'Déjanos tus datos y nos pondremos en contacto contigo lo más pronto posible para contarte más sobre cómo puedes apoyar a la Fundación ADN de Amor.'],
    ['contacto_email', 'text', 'info@adndeamor.org'],
    ['contacto_phone', 'text', '+57 (300) 000-0000'],
    ['contacto_location', 'text', 'Colombia'],

    // Footer
    ['footer_slogan', 'text', 'Amor que inspira,<br>acciones que transforman']
];

foreach ($new_content as $item) {
    $stmt = $pdo->prepare("INSERT INTO site_content (section_key, content_type, content_value) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE content_type=VALUES(content_type)");
    $stmt->execute([$item[0], $item[1], $item[2]]);
}

echo "Base de datos actualizada correctamente con las nuevas variables.<br>";
echo "Por favor elimina este archivo (update_db.php) por seguridad.";
?>
