<?php
require '../includes/db.php';

$contents = [
    // Hero Banners
    ['nos_hero_title', 'Quiénes Somos', 'text'],
    ['nos_hero_desc', 'Construyendo comunidades más humanas, unidas y llenas de oportunidades.', 'text'],
    ['nos_hero_img', 'FOTOS BANNERS/MAMA CON ANGELICA  DEFINITIVA BANNER.png', 'image'],

    // ¿Quiénes Somos?
    ['nos_quienes_title', '¿Quiénes Somos?', 'text'],
    ['nos_quienes_desc1', 'La Fundación ADN de Amor, es una organización social de principios cristianos, inspirada en el legado de amor, servicio y solidaridad de la señora Nidia López de Giraldo. Nacimos con el propósito de acompañar a niños, niñas, adolescentes, jóvenes y madres cabeza de familia en situación de vulnerabilidad, especialmente en comunidades marginadas y afectadas por la violencia social y política.', 'text'],
    ['nos_quienes_desc2', 'Trabajamos por el bienestar humano, emocional, espiritual y social de las comunidades, promoviendo oportunidades que contribuyan a generar cambios significativos y fortalecer proyectos de vida con esperanza y dignidad.', 'text'],
    ['nos_quienes_desc3', 'Uno de los pilares fundamentales de nuestra labor es el Centro de Desarrollo de Talentos, un programa orientado a identificar y potenciar los talentos de niños, niñas, adolescentes y jóvenes, acompañándolos en procesos de crecimiento personal, fortalecimiento espiritual y construcción de propósito de vida.', 'text'],
    ['nos_quienes_desc4', 'Creemos en el amor al prójimo, la solidaridad, la fe y el servicio como herramientas para construir comunidades más humanas, unidas y llenas de oportunidades.', 'text'],
    ['nos_quienes_img', 'FOTOS BANNERS/FOTO BANNER NAVIDADES SELECCION.png', 'image'],

    // Nuestra Misión
    ['nos_mision_header_title', 'Nuestra Misión y Propósito', 'text'],
    ['nos_mision_header_desc', 'Guiados por principios cristianos de amor, fe, esperanza y servicio, trabajamos para sembrar valores, brindar nuevas oportunidades y llevar esperanza a las nuevas generaciones.', 'text'],
    
    ['nos_mision_title', 'Nuestra Misión', 'text'],
    ['nos_mision_desc1', 'Contribuir al bienestar y desarrollo de niños, niñas, adolescentes, jóvenes y madres cabeza de familia en condición de vulnerabilidad social, económica o víctimas de violencia, a través de programas de acompañamiento psicosocial, formación no formal, desarrollo de talentos, ayuda humanitaria y espacios de integración social.', 'text'],
    ['nos_mision_desc2', 'A través del Centro de Desarrollo de Talentos promovemos el fortalecimiento de habilidades artísticas, deportivas y vocacionales, acompañando procesos de crecimiento personal y proyectos de vida desde un enfoque basado en la esperanza, la restauración y el desarrollo humano.', 'text'],
    ['nos_mision_img', 'FOTOS BANNERS/foto prinicpal 2 niños banner final.png', 'image'],
    
    ['nos_mision_como_title', '¿Cómo lo hacemos?', 'text'],
    ['nos_mision_como_desc1', 'Trabajamos de manera cercana y colaborativa con familias, comunidades, voluntarios, aliados e instituciones públicas y privadas, generando oportunidades de transformación social y humana para niños, niñas, adolescentes, jóvenes y madres cabeza de familia en condición de vulnerabilidad.', 'text'],
    ['nos_mision_como_desc2', 'Desarrollamos procesos de acompañamiento fundamentados en principios cristianos de amor al prójimo, servicio, compasión y esperanza, promoviendo relaciones de confianza y apoyo con las comunidades. Nuestro trabajo busca atender no solo necesidades inmediatas, sino también fortalecer el crecimiento emocional, espiritual y social de cada persona.', 'text'],
    ['nos_mision_como_desc3', 'Asimismo, impulsamos alianzas y redes de cooperación con organizaciones y personas comprometidas con la transformación social, convencidos de que el trabajo conjunto multiplica el impacto.', 'text'],
    ['nos_mision_como_img', 'FOTOS BANNERS/foto sandra guamos banner final mejor.png', 'image'],
    
    ['nos_mision_creemos_title', 'En lo que creemos', 'text'],
    ['nos_mision_creemos_desc1', 'Creemos en el poder transformador del amor, la fe y el servicio. Creemos que cada niño, niña, adolescente y joven tiene talentos, propósito y un valor único.', 'text'],
    ['nos_mision_creemos_desc2', 'Creemos en acompañar a las comunidades con dignidad, esperanza y solidaridad, reflejando el amor de Dios a través de acciones que generen impacto real en la vida de las personas.', 'text'],
    ['nos_mision_creemos_desc3', 'Soñamos con generaciones fortalecidas en valores, con oportunidades para crecer, servir y transformar positivamente su entorno.', 'text'],
    ['nos_mision_creemos_img', 'FOTOS BANNERS/CDT INGLES BANNER FINAL SANDRA.png', 'image'],

    // Nuestra Historia
    ['nos_historia_title', 'Nuestra Historia', 'text'],
    ['nos_historia_desc1', 'Entre 1980 y el año 2008, la obra social que hoy inspira a la Fundación ADN de Amor tuvo como gran pionera a la señora Nidia López de Giraldo, una mujer de profunda vocación de servicio y amor por el prójimo. Activista social y ejemplo de generosidad, dedicó su vida a ayudar a miles de personas, especialmente niños, jóvenes y madres cabeza de familia, llevando siempre una sonrisa, palabras de esperanza, apoyo y comprensión.', 'text'],
    ['nos_historia_desc2', 'Trabajó incansablemente por la misión social en el Chocó, especialmente en la vereda de Gingarabá, donde contribuyó a la construcción de viviendas para familias de la comunidad, apoyó la educación de varios niños y llevó ayuda humanitaria, incluyendo ropa, alimentos y medicamentos. Su labor estuvo siempre enfocada en acompañar y brindar esperanza a las comunidades más vulnerables, dejando una huella de amor, solidaridad y servicio en cada familia que ayudó.', 'text'],
    ['nos_historia_desc3', 'Además, realizó obra social y evangelística en las cárceles del Eje Cafetero, tanto de mujeres como de hombres, llevando apoyo espiritual y acompañamiento a los internos. Durante muchos años celebraba la Navidad con ellos, organizando actividades con la colaboración de otros voluntarios, compartiendo alegría, esperanza y un mensaje de amor en estas comunidades privadas de libertad.', 'text'],
    ['nos_historia_desc4', 'Su vida fue testimonio de entrega desinteresada y de un profundo compromiso con quienes más lo necesitaban. Hace más de 15 años partió al encuentro con Dios, pero su legado continúa vivo en cada obra de servicio y en cada vida transformada.', 'text'],
    ['nos_historia_desc5_strong', 'Hoy, sus hijos y nieta, socios fundadores de la Fundación ADN de Amor, continuamos este legado de amor, servicio y compromiso social, honrando sus enseñanzas y manteniendo viva la misión de ayudar a quienes más lo necesitan.', 'text'],
    ['nos_historia_img', 'FOTOS BANNERS/FOTO PERFIL MAMA PRIMERA.jpeg', 'image']
];

try {
    $pdo->beginTransaction();

    $stmt_check = $pdo->prepare('SELECT COUNT(*) FROM site_content WHERE section_key = ?');
    $stmt_insert = $pdo->prepare('INSERT INTO site_content (page_name, section_key, content_value, content_type) VALUES (?, ?, ?, ?)');

    $insertedCount = 0;

    foreach ($contents as $item) {
        $stmt_check->execute([$item[0]]);
        if ($stmt_check->fetchColumn() == 0) {
            $stmt_insert->execute(['nosotros', $item[0], $item[1], $item[2]]);
            $insertedCount++;
        }
    }

    $pdo->commit();
    echo "¡Proceso completado! Se insertaron {$insertedCount} registros para la página Nosotros.\n";
} catch (PDOException $e) {
    $pdo->rollBack();
    echo "Error al insertar en la base de datos: " . $e->getMessage() . "\n";
}
?>
