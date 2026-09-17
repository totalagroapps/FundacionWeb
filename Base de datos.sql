-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 24-08-2026 a las 19:33:58
-- Versión del servidor: 5.7.44-48
-- Versión de PHP: 8.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `detodop8_fundacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password_hash`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `whatsapp_link` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `discount`, `whatsapp_link`, `image`, `created_at`) VALUES
(1, 'Camiseta Solidaria Blanca', 35000.00, NULL, 'https://wa.me/573000000000?text=Hola,%20me%20interesa%20la%20Camiseta%20Solidaria%20Blanca', '', '2026-07-28 20:50:07'),
(2, 'Mug ADN de Amor', 22000.00, 18000.00, 'https://wa.me/573000000000?text=Hola,%20me%20interesa%20el%20Mug%20ADN%20de%20Amor', '', '2026-07-28 20:50:07'),
(3, 'Agenda de Gratitud 2025', 28000.00, NULL, 'https://wa.me/573000000000?text=Hola,%20me%20interesa%20la%20Agenda%20de%20Gratitud', '', '2026-07-28 20:50:07'),
(4, 'Pulsera Fe y Esperanza', 15000.00, NULL, 'https://wa.me/573000000000?text=Hola,%20me%20interesa%20la%20Pulsera%20Fe%20y%20Esperanza', '', '2026-07-28 20:50:07'),
(5, 'Kit Navidad Solidaria', 55000.00, 45000.00, 'https://wa.me/573000000000?text=Hola,%20me%20interesa%20el%20Kit%20Navidad%20Solidaria', '', '2026-07-28 20:50:07'),
(7, 'Pulcera de Amor', 21000.00, 15000.00, 'https://wa.me/573219602652?text=Hola%2C+me+interesa+el+producto%3A+Pulcera+de+Amor', 'uploads/tienda/1786143416_PULSERALUZDEAMOR_2891566a-7773-4fd8-909f-d383fe015ae8.jpg', '2026-08-07 22:56:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitulo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '6:30 PM',
  `dia_semana` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'Jueves',
  `lugar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Sede Finca Guacas (Santa Rosa de Cabal) / En Vivo',
  `modalidad` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'Híbrida (Presencial y Virtual)',
  `expositor` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Equipo ADN de Amor & Invitados',
  `imagen` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cupos` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'Entrada libre con inscripción previa',
  `whatsapp_contacto` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT '573162522445',
  `estado` enum('activo','proximo','finalizado') COLLATE utf8mb4_unicode_ci DEFAULT 'proximo',
  `destacado` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `site_content`
--

CREATE TABLE `site_content` (
  `id` int(11) NOT NULL,
  `page_name` varchar(50) NOT NULL DEFAULT 'inicio',
  `section_key` varchar(100) NOT NULL,
  `content_type` enum('text','image','link') NOT NULL DEFAULT 'text',
  `content_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `site_content`
--

INSERT INTO `site_content` (`id`, `page_name`, `section_key`, `content_type`, `content_value`) VALUES
(1, 'inicio', 'hero_slide1_title', 'text', 'Abre Caminos de Esperanza'),
(2, 'inicio', 'hero_slide1_desc', 'text', 'Cada apadrinamiento contribuye al desarrollo de un niño y su familia, generando oportunidades de crecimiento y bienestar.'),
(3, 'inicio', 'hero_slide1_img', 'image', 'FOTOS BANNERS/MAJO_BANNER_LOS_NI__OS_DE_DIOS_NO_SE_TOCAN_2.png'),
(4, 'inicio', 'hero_slide2_title', 'text', 'Centro de Desarrollo de Talentos'),
(5, 'inicio', 'hero_slide2_desc', 'text', 'Permite que asistan a clases de inglés, arte, música, danza y actividades de formación no formal.'),
(6, 'inicio', 'hero_slide2_img', 'image', 'FOTOS BANNERS/CDT ARTE FINAL PINTACARITAS SARI.png'),
(7, 'inicio', 'historia_title', 'text', 'Conoce Nuestra Historia'),
(8, 'inicio', 'historia_desc', 'text', 'Descubre el corazón de la Fundación ADN de Amor. Conoce cómo empezamos, nuestra misión y los valores que nos inspiran a transformar las vidas de miles de niños y familias.'),
(9, 'inicio', 'apadrinar_main_title', 'text', '¡Una oportunidad que abre caminos y esperanza!'),
(10, 'inicio', 'apadrinar_main_desc', 'text', 'Apadrinar significa ofrecer acompañamiento y apoyo a un niño, niña o adolescente, ayudándole a superar barreras y acceder a oportunidades educativas, formativas y de desarrollo integral.'),
(11, 'inicio', 'donar_title', 'text', 'Dona por una Causaa'),
(12, 'inicio', 'donar_img', 'image', 'FOTOS BANNERS/FOTO BANNER NAVIDADES SELECCION.png'),
(13, 'inicio', 'apadrinar_card1_img', 'image', 'FOTOS BANNERS/foto prinicpal 2 niños banner final.png'),
(14, 'inicio', 'apadrinar_card1_title', 'text', 'A Largo Plazo'),
(15, 'inicio', 'apadrinar_card1_desc', 'text', 'Crea un vínculo constante con el apadrinado y su familia, apoyando su desarrollo integral.'),
(16, 'inicio', 'apadrinar_card2_img', 'image', 'FOTOS BANNERS/CDT MUSICA 1 SELECCIONADA.png'),
(17, 'inicio', 'apadrinar_card2_title', 'text', 'Desarrollo de Talentos'),
(18, 'inicio', 'apadrinar_card2_desc', 'text', 'Permite que asistan al CDT para clases de inglés, arte, música, danza y formación.'),
(19, 'inicio', 'apadrinar_card3_img', 'image', 'FOTOS BANNERS/MAMA CON ANGELICA  DEFINITIVA BANNER.png'),
(20, 'inicio', 'apadrinar_card3_title', 'text', 'Construye un Vínculo'),
(21, 'inicio', 'apadrinar_card3_desc', 'text', 'Sigue su proceso, recibe fotos y mantén contacto a través de cartas o mensajes.'),
(22, 'inicio', 'apadrinar_btn_text', 'text', 'Descubre cómo apadrinar y conocer a los niños'),
(23, 'inicio', 'donar_desc', 'text', 'Cada aporte que haces a la Fundación ADN de Amor contribuye a crear oportunidades, esperanza y bienestar en situación de vulnerabilidad.'),
(24, 'inicio', 'donar_li1', 'text', 'Centro de Desarrollo de Talentos: Clases de inglés, arte, música y danza.'),
(25, 'inicio', 'donar_li2', 'text', 'Programa Esperanza: Alimentos, ropa y acompañamiento educativo.'),
(26, 'inicio', 'donar_li3', 'text', 'Proyectos comunitarios: Brigadas de salud y construcción de viviendas.'),
(27, 'inicio', 'donar_footer_text', 'text', 'Tu aporte genera un efecto multiplicador. ¡Tú puedes marcar la diferencia!'),
(28, 'inicio', 'donar_btn_text', 'text', 'Dona Hoy'),
(29, 'inicio', 'empresas_title', 'text', 'Empresas y Aliados Responsables'),
(30, 'inicio', 'empresas_desc', 'text', 'La colaboración con empresas es clave para generar un impacto positivo y sostenible en las comunidades.'),
(31, 'inicio', 'empresas_card1_title', 'text', 'Apoyo Financiero'),
(32, 'inicio', 'empresas_card1_desc', 'text', 'Contribuye a talleres, brigadas y programas comunitarios.'),
(33, 'inicio', 'empresas_card2_title', 'text', 'Voluntariado'),
(34, 'inicio', 'empresas_card2_desc', 'text', 'Fomenta el compromiso social de tu equipo.'),
(35, 'inicio', 'empresas_card3_title', 'text', 'Donación'),
(36, 'inicio', 'empresas_card3_desc', 'text', 'Materiales, alimentos, ropa o tecnología.'),
(37, 'inicio', 'empresas_card4_title', 'text', 'Alianzas'),
(38, 'inicio', 'empresas_card4_desc', 'text', 'Desarrollo de proyectos conjuntos de gran impacto.'),
(39, 'inicio', 'empresas_btn_text', 'text', 'Conviértete en Aliado'),
(40, 'inicio', 'empresas_img', 'image', 'FOTOS BANNERS/foto leo chicos mejorada ia.png'),
(41, 'inicio', 'voluntariado_bg_img', 'image', 'FOTOS BANNERS/foto_sandra_guamos_banner_final_mejor.png'),
(42, 'inicio', 'voluntariado_title', 'text', 'Ser Voluntario'),
(43, 'inicio', 'voluntariado_desc1', 'text', 'Únete a nuestra misión de acompañar, apoyar y generar oportunidades para niños y familias vulnerables. Ofrecemos oportunidades para colaborar en talleres, clases, acompañamiento en actividades del CDT y el Programa Esperanza.'),
(44, 'inicio', 'voluntariado_desc2', 'text', 'Ser voluntario en ADN de Amor es construir vínculos, vivir experiencias significativas y contribuir al desarrollo integral desde los principios cristianos de amor, fe, esperanza y servicio.'),
(45, 'inicio', 'voluntariado_btn1_text', 'text', 'Únete como Voluntario'),
(46, 'inicio', 'voluntariado_btn2_text', 'text', 'Prácticas Profesionales'),
(47, 'inicio', 'tienda_img', 'image', 'FOTOS BANNERS/tienda_solidaria.png'),
(48, 'inicio', 'tienda_title', 'text', 'Tienda Solidaria'),
(49, 'inicio', 'tienda_subtitle', 'text', 'Tu apoyo genera oportunidades'),
(50, 'inicio', 'tienda_desc', 'text', 'En la Tienda Solidaria ADN de Amor encontrarás productos y servicios cuyo valor va más allá de lo material. Cada compra contribuye directamente a apoyar todas nuestras actividades y proyectos.'),
(51, 'inicio', 'tienda_li1', 'text', 'Productos con propósito.'),
(52, 'inicio', 'tienda_li2', 'text', 'Servicios educativos.'),
(53, 'inicio', 'tienda_btn_text', 'text', 'Ver Tienda'),
(54, 'inicio', 'contacto_title', 'text', '¿Tienes preguntas o quieres unirte?'),
(55, 'inicio', 'contacto_desc', 'text', 'Déjanos tus datos y nos pondremos en contacto contigo lo más pronto posible para contarte más sobre cómo puedes apoyar a la Fundación ADN de Amor.'),
(56, 'inicio', 'contacto_email', 'text', 'info@adndeamor.org'),
(57, 'inicio', 'contacto_phone', 'text', '+57 (300) 000-0000'),
(58, 'inicio', 'contacto_location', 'text', 'Colombia'),
(59, 'inicio', 'footer_slogan', 'text', 'Amor que inspira,<br>acciones que transforman'),
(60, 'nosotros', 'nos_hero_title', 'text', 'Quiénes Somos'),
(61, 'nosotros', 'nos_hero_desc', 'text', 'Construyendo comunidades más humanas, unidas y llenas de oportunidades.'),
(62, 'nosotros', 'nos_hero_img', 'image', 'FOTOS BANNERS/MAMA_CON_ANGELICA__DEFINITIVA_BANNER.png'),
(63, 'nosotros', 'nos_quienes_title', 'text', '¿Quiénes Somos?'),
(64, 'nosotros', 'nos_quienes_desc1', 'text', 'La Fundación ADN de Amor, es una organización social de principios cristianos, inspirada en el legado de amor, servicio y solidaridad de la señora Nidia López de Giraldo. Nacimos con el propósito de acompañar a niños, niñas, adolescentes, jóvenes y madres cabeza de familia en situación de vulnerabilidad, especialmente en comunidades marginadas y afectadas por la violencia social y política.'),
(65, 'nosotros', 'nos_quienes_desc2', 'text', 'Trabajamos por el bienestar humano, emocional, espiritual y social de las comunidades, promoviendo oportunidades que contribuyan a generar cambios significativos y fortalecer proyectos de vida con esperanza y dignidad.'),
(66, 'nosotros', 'nos_quienes_desc3', 'text', 'Uno de los pilares fundamentales de nuestra labor es el Centro de Desarrollo de Talentos, un programa orientado a identificar y potenciar los talentos de niños, niñas, adolescentes y jóvenes, acompañándolos en procesos de crecimiento personal, fortalecimiento espiritual y construcción de propósito de vida.'),
(67, 'nosotros', 'nos_quienes_desc4', 'text', 'Creemos en el amor al prójimo, la solidaridad, la fe y el servicio como herramientas para construir comunidades más humanas, unidas y llenas de oportunidades.'),
(68, 'nosotros', 'nos_quienes_img', 'image', 'FOTOS BANNERS/FOTO BANNER NAVIDADES SELECCION.png'),
(69, 'nosotros', 'nos_mision_header_title', 'text', 'Nuestra Misión y Propósito'),
(70, 'nosotros', 'nos_mision_header_desc', 'text', 'Guiados por principios cristianos de amor, fe, esperanza y servicio, trabajamos para sembrar valores, brindar nuevas oportunidades y llevar esperanza a las nuevas generaciones.'),
(71, 'nosotros', 'nos_mision_title', 'text', 'Nuestra Misión'),
(72, 'nosotros', 'nos_mision_desc1', 'text', 'Contribuir al bienestar y desarrollo de niños, niñas, adolescentes, jóvenes y madres cabeza de familia en condición de vulnerabilidad social, económica o víctimas de violencia, a través de programas de acompañamiento psicosocial, formación no formal, desarrollo de talentos, ayuda humanitaria y espacios de integración social.'),
(73, 'nosotros', 'nos_mision_desc2', 'text', 'A través del Centro de Desarrollo de Talentos promovemos el fortalecimiento de habilidades artísticas, deportivas y vocacionales, acompañando procesos de crecimiento personal y proyectos de vida desde un enfoque basado en la esperanza, la restauración y el desarrollo humano.'),
(74, 'nosotros', 'nos_mision_img', 'image', 'FOTOS BANNERS/foto prinicpal 2 niños banner final.png'),
(75, 'nosotros', 'nos_mision_como_title', 'text', '¿Cómo lo hacemos?'),
(76, 'nosotros', 'nos_mision_como_desc1', 'text', 'Trabajamos de manera cercana y colaborativa con familias, comunidades, voluntarios, aliados e instituciones públicas y privadas, generando oportunidades de transformación social y humana para niños, niñas, adolescentes, jóvenes y madres cabeza de familia en condición de vulnerabilidad.'),
(77, 'nosotros', 'nos_mision_como_desc2', 'text', 'Desarrollamos procesos de acompañamiento fundamentados en principios cristianos de amor al prójimo, servicio, compasión y esperanza, promoviendo relaciones de confianza y apoyo con las comunidades. Nuestro trabajo busca atender no solo necesidades inmediatas, sino también fortalecer el crecimiento emocional, espiritual y social de cada persona.'),
(78, 'nosotros', 'nos_mision_como_desc3', 'text', 'Asimismo, impulsamos alianzas y redes de cooperación con organizaciones y personas comprometidas con la transformación social, convencidos de que el trabajo conjunto multiplica el impacto.'),
(79, 'nosotros', 'nos_mision_como_img', 'image', 'FOTOS BANNERS/foto sandra guamos banner final mejor.png'),
(80, 'nosotros', 'nos_mision_creemos_title', 'text', 'En lo que creemos'),
(81, 'nosotros', 'nos_mision_creemos_desc1', 'text', 'Creemos en el poder transformador del amor, la fe y el servicio. Creemos que cada niño, niña, adolescente y joven tiene talentos, propósito y un valor único.'),
(82, 'nosotros', 'nos_mision_creemos_desc2', 'text', 'Creemos en acompañar a las comunidades con dignidad, esperanza y solidaridad, reflejando el amor de Dios a través de acciones que generen impacto real en la vida de las personas.'),
(83, 'nosotros', 'nos_mision_creemos_desc3', 'text', 'Soñamos con generaciones fortalecidas en valores, con oportunidades para crecer, servir y transformar positivamente su entorno.'),
(84, 'nosotros', 'nos_mision_creemos_img', 'image', 'FOTOS BANNERS/CDT INGLES BANNER FINAL SANDRA.png'),
(85, 'nosotros', 'nos_historia_title', 'text', 'Nuestra Historia'),
(86, 'nosotros', 'nos_historia_desc1', 'text', 'Entre 1980 y el año 2008, la obra social que hoy inspira a la Fundación ADN de Amor tuvo como gran pionera a la señora Nidia López de Giraldo, una mujer de profunda vocación de servicio y amor por el prójimo. Activista social y ejemplo de generosidad, dedicó su vida a ayudar a miles de personas, especialmente niños, jóvenes y madres cabeza de familia, llevando siempre una sonrisa, palabras de esperanza, apoyo y comprensión.'),
(87, 'nosotros', 'nos_historia_desc2', 'text', 'Trabajó incansablemente por la misión social en el Chocó, especialmente en la vereda de Gingarabá, donde contribuyó a la construcción de viviendas para familias de la comunidad, apoyó la educación de varios niños y llevó ayuda humanitaria, incluyendo ropa, alimentos y medicamentos. Su labor estuvo siempre enfocada en acompañar y brindar esperanza a las comunidades más vulnerables, dejando una huella de amor, solidaridad y servicio en cada familia que ayudó.'),
(88, 'nosotros', 'nos_historia_desc3', 'text', 'Además, realizó obra social y evangelística en las cárceles del Eje Cafetero, tanto de mujeres como de hombres, llevando apoyo espiritual y acompañamiento a los internos. Durante muchos años celebraba la Navidad con ellos, organizando actividades con la colaboración de otros voluntarios, compartiendo alegría, esperanza y un mensaje de amor en estas comunidades privadas de libertad.'),
(89, 'nosotros', 'nos_historia_desc4', 'text', 'Su vida fue testimonio de entrega desinteresada y de un profundo compromiso con quienes más lo necesitaban. Hace más de 15 años partió al encuentro con Dios, pero su legado continúa vivo en cada obra de servicio y en cada vida transformada.'),
(90, 'nosotros', 'nos_historia_desc5_strong', 'text', 'Hoy, sus hijos y nieta, socios fundadores de la Fundación ADN de Amor, continuamos este legado de amor, servicio y compromiso social, honrando sus enseñanzas y manteniendo viva la misión de ayudar a quienes más lo necesitan.'),
(91, 'nosotros', 'nos_historia_img', 'image', 'FOTOS BANNERS/FOTO PERFIL MAMA PRIMERA.jpeg'),
(92, 'inicio', 'hero_slide1_btn1_text', 'text', 'Apadrina Hoy'),
(93, 'inicio', 'hero_slide1_btn1_url', 'text', '#apadrinar'),
(94, 'inicio', 'hero_slide1_btn2_text', 'text', 'Dona por una Causa'),
(95, 'inicio', 'hero_slide1_btn2_url', 'text', '#donar'),
(96, 'inicio', 'hero_slide2_btn1_text', 'text', 'Apoya el CDT'),
(97, 'inicio', 'hero_slide2_btn1_url', 'text', '#donar'),
(98, 'inicio', 'historia_btn_text', 'text', 'Leer la historia completa'),
(99, 'inicio', 'historia_btn_url', 'text', 'nosotros'),
(100, 'inicio', 'apadrinar_btn_url', 'text', 'apadrinar'),
(101, 'inicio', 'donar_btn_url', 'text', '#contacto'),
(102, 'inicio', 'empresas_btn_url', 'text', 'empresas'),
(103, 'inicio', 'voluntariado_btn1_url', 'text', 'voluntariado'),
(104, 'inicio', 'voluntariado_btn2_url', 'text', 'practicas'),
(105, 'inicio', 'tienda_btn_url', 'text', 'tienda'),
(106, 'programas', 'prog_donde_title', 'text', 'Dónde Estamos'),
(107, 'programas', 'prog_donde_p1', 'text', 'La Fundación ADN de Amor tiene su sede en Santa Rosa de Cabal, desde donde coordinamos y gestionamos todas nuestras actividades.'),
(108, 'programas', 'prog_donde_p2', 'text', 'Nuestro trabajo impacta diferentes regiones de Colombia, llevando apoyo integral a niños, niñas, adolescentes, jóvenes y madres cabeza de familia en situación de vulnerabilidad:'),
(109, 'programas', 'prog_donde_li1_title', 'text', 'Eje Cafetero:'),
(110, 'programas', 'prog_donde_li1_desc', 'text', 'Acompañamos a comunidades en distintas ciudades y veredas, ofreciendo programas de bienestar, programas de formación no formal, ofreciendo talleres y clases que fortalecen habilidades, talentos y capacidades en niños, niñas, adolescentes y jóvenes.'),
(111, 'programas', 'prog_donde_li2_title', 'text', 'Región Pacífica (Chocó):'),
(112, 'programas', 'prog_donde_li2_desc', 'text', 'Apoyamos a niños, niñas y familias vulnerables mediante apadrinamiento, ayuda educativa y acompañamiento integral, brindando apoyo para su educación y bienestar con la colaboración de padrinos y voluntarios.'),
(113, 'programas', 'prog_donde_img', 'image', 'FOTOS BANNERS/foto principal niños original tamaño mejorada luz.png'),
(114, 'programas', 'prog_que_title', 'text', '¿Qué Hacemos?'),
(115, 'programas', 'prog_que_p1', 'text', 'En la Fundación ADN de Amor, acompañamos y apoyamos el desarrollo integral de niños, niñas, adolescentes, jóvenes y madres cabeza de familia en situación de vulnerabilidad, promoviendo bienestar, esperanza y oportunidades para fortalecer sus proyectos de vida.'),
(116, 'programas', 'prog_que_h3', 'text', 'Principales acciones:'),
(117, 'programas', 'prog_que_li1_title', 'text', 'Centro de Desarrollo de Talentos:'),
(118, 'programas', 'prog_que_li1_desc', 'text', 'Potenciamos habilidades artísticas, deportivas y vocacionales, acompañando el crecimiento personal, espiritual y el propósito de vida.'),
(119, 'programas', 'prog_que_li2_title', 'text', 'Acompañamiento psicosocial:'),
(120, 'programas', 'prog_que_li2_desc', 'text', 'Apoyo emocional y social para superar vulnerabilidad o experiencias de violencia.'),
(121, 'programas', 'prog_que_li3_title', 'text', 'Ayuda humanitaria:'),
(122, 'programas', 'prog_que_li3_desc', 'text', 'Entrega de alimentos, ropa, medicinas y recursos esenciales.'),
(123, 'programas', 'prog_que_li4_title', 'text', 'Integración comunitaria:'),
(124, 'programas', 'prog_que_li4_desc', 'text', 'Talleres y actividades que fomentan inclusión y participación positiva.'),
(125, 'programas', 'prog_que_li5_title', 'text', 'Redes de cooperación:'),
(126, 'programas', 'prog_que_li5_desc', 'text', 'Colaboración con aliados, voluntarios y organizaciones para ampliar el alcance y las oportunidades.'),
(127, 'programas', 'prog_que_p2', 'text', 'Cada acción se guía por principios cristianos de amor, fe, esperanza y servicio, buscando sembrar valores, brindar oportunidades y fortalecer comunidades humanas y solidarias.'),
(128, 'programas', 'prog_que_img', 'image', 'FOTOS BANNERS/CENTRO DESARROLLO DE TALENTOS BANNER 1.png'),
(129, 'programas', 'prog_cdt_title', 'text', 'Centro de Desarrollo de Talentos'),
(130, 'programas', 'prog_cdt_p1', 'text', 'El Centro de Desarrollo de Talentos es nuestro programa integral diseñado para acompañar a niños, niñas, adolescentes y jóvenes en su crecimiento personal, emocional, artístico, deportivo y vocacional. Buscamos crear entornos protectores que fortalezcan sus capacidades, bienestar y proyectos de vida, brindando oportunidades de desarrollo real y aprendizaje, siempre desde principios cristianos de amor, fe, esperanza y servicio.'),
(131, 'programas', 'prog_cdt_p2', 'text', 'Actualmente trabajamos con participantes de 6 a 16 años, brindando atención personalizada y acompañamiento continuo para que cada niño y joven pueda descubrir sus talentos y potenciar sus habilidades.'),
(132, 'programas', 'prog_cdt_h3', 'text', 'Lo que hacemos'),
(133, 'programas', 'prog_cdt_card1_title', 'text', 'Perfilado de talentos'),
(134, 'programas', 'prog_cdt_card1_desc', 'text', 'Identificamos habilidades e intereses en artes, deportes, oficios e idiomas, creando rutas personalizadas de desarrollo.'),
(135, 'programas', 'prog_cdt_card2_title', 'text', 'Bienestar emocional y espiritual'),
(136, 'programas', 'prog_cdt_card2_desc', 'text', 'Brindamos acompañamiento emocional y espiritual, fomentando autoestima, resiliencia y propósito de vida.'),
(137, 'programas', 'prog_cdt_card3_title', 'text', 'Proyectos de vida'),
(138, 'programas', 'prog_cdt_card3_desc', 'text', 'Orientamos a los jóvenes en la planificación de metas personales, académicas y laborales, liderazgo y emprendimiento.'),
(139, 'programas', 'prog_cdt_card4_title', 'text', 'Deporte'),
(140, 'programas', 'prog_cdt_card4_desc', 'text', 'Fomentamos disciplina, hábitos saludables y habilidades socioemocionales mediante fútbol, natación y otras actividades físicas.'),
(141, 'programas', 'prog_cdt_card5_title', 'text', 'Artes'),
(142, 'programas', 'prog_cdt_card5_desc', 'text', 'Desarrollamos creatividad, sensibilidad estética y expresión emocional a través de pintura, música y danza.'),
(143, 'programas', 'prog_cdt_card6_title', 'text', 'Oficios'),
(144, 'programas', 'prog_cdt_card6_desc', 'text', 'Impulsamos habilidades prácticas para la empleabilidad y generación de ingresos: fotografía, tecnología y cocina emprendedora.'),
(145, 'programas', 'prog_cdt_card7_title', 'text', 'Idiomas'),
(146, 'programas', 'prog_cdt_card7_desc', 'text', 'Enseñamos inglés de manera práctica y comunicativa, ampliando oportunidades educativas y laborales.'),
(147, 'programas', 'prog_cdt_img1', 'image', 'FOTOS BANNERS/CDT INGLES BANNER FINAL SANDRA.png'),
(148, 'programas', 'prog_cdt_img2', 'image', 'FOTOS BANNERS/CDT ARTE FINAL PINTACARITAS SARI.png'),
(149, 'programas', 'prog_cdt_img3', 'image', 'FOTOS BANNERS/CDT MUSICA 1 SELECCIONADA.png'),
(150, 'programas', 'prog_cdt_bottom_title', 'text', 'Oportunidades de participación'),
(151, 'programas', 'prog_cdt_bottom_p1', 'text', 'Existen espacios para que voluntarios se unan como monitores, tutores o acompañantes de cada programa, así como la posibilidad de apadrinar a un niño o joven, apoyando su proceso de desarrollo y fortalecimiento de talentos. Más detalles sobre cómo participar se encuentran en la sección \"Cómo sumarte\" de nuestra web.'),
(152, 'programas', 'prog_cdt_bottom_p2', 'text', 'El Centro de Desarrollo de Talentos es un espacio donde cada participante puede descubrir sus capacidades, fortalecer su propósito y construir un futuro con esperanza, mientras crece en valores, fe y habilidades para la vida.'),
(153, 'programas', 'prog_cdt_btn_text', 'text', 'Apadrina un niño del CDT'),
(154, 'programas', 'prog_cdt_btn_url', 'text', 'apadrinar.php'),
(155, 'programas', 'prog_esp_title', 'text', 'Programa Esperanza'),
(156, 'programas', 'prog_esp_p1', 'text', 'Este programa brinda apoyo integral a familias vulnerables y madres cabeza de familia, ofreciendo asistencia esencial para mejorar su calidad de vida y bienestar general.'),
(157, 'programas', 'prog_esp_li1_title', 'text', 'Alimentación:'),
(158, 'programas', 'prog_esp_li1_desc', 'text', 'Apoyo con comidas y orientación nutricional.'),
(159, 'programas', 'prog_esp_li2_title', 'text', 'Vestimenta:'),
(160, 'programas', 'prog_esp_li2_desc', 'text', 'Entrega de ropa y calzado según necesidades.'),
(161, 'programas', 'prog_esp_li3_title', 'text', 'Salud:'),
(162, 'programas', 'prog_esp_li3_desc', 'text', 'Facilitamos acceso a atención médica y orientación sanitaria.'),
(163, 'programas', 'prog_esp_li4_title', 'text', 'Educación:'),
(164, 'programas', 'prog_esp_li4_desc', 'text', 'Apoyo escolar con materiales y acompañamiento.'),
(165, 'programas', 'prog_esp_li5_title', 'text', 'Bienestar familiar:'),
(166, 'programas', 'prog_esp_li5_desc', 'text', 'Fortalecimiento de la estabilidad familiar y celebraciones (como navidades).'),
(167, 'programas', 'prog_esp_btn_text', 'text', 'Dona al Programa Esperanza'),
(168, 'programas', 'prog_esp_btn_url', 'text', 'index.php#donar'),
(169, 'programas', 'prog_esp_img', 'image', 'FOTOS BANNERS/FOTO BANNER NAVIDADES SELECCION.png'),
(170, 'programas', 'prog_choco_title', 'text', 'Misión Chocó'),
(171, 'programas', 'prog_choco_p1', 'text', 'En la región del Chocó, estamos enfocados en desarrollar proyectos de ayuda humanitaria en Gingarabá y sus alrededores. Nuestro objetivo es apoyar a las comunidades más vulnerables.'),
(172, 'programas', 'prog_choco_p2', 'text', 'Actualmente buscamos apadrinamiento para tres niñas en situación de vulnerabilidad especial, y trabajamos en colaboración con aliados para llevar a cabo:'),
(173, 'programas', 'prog_choco_li1', 'text', 'Brigadas de salud integrales.'),
(174, 'programas', 'prog_choco_li2', 'text', 'Construcción y rehabilitación de viviendas.'),
(175, 'programas', 'prog_choco_li3', 'text', 'Entrega de ayuda humanitaria constante.'),
(176, 'programas', 'prog_choco_btn_text', 'text', 'Apadrina a una niña del Chocó'),
(177, 'programas', 'prog_choco_btn_url', 'text', 'apadrinar.php'),
(178, 'programas', 'prog_choco_img', 'image', 'FOTOS BANNERS/MISION CHOCO BANNER OPCION MEJOR 1.png'),
(179, 'apadrinar', 'apad_hero_title', 'text', 'Apadrina un Niño, Niña o Adolescente'),
(180, 'apadrinar', 'apad_hero_desc', 'text', 'Miles de niños, niñas y adolescentes esperan por un padrino o madrina como tú. ¡Una oportunidad que abre caminos y esperanza!'),
(181, 'apadrinar', 'apad_intro_title', 'text', '¿Qué significa apadrinar?'),
(182, 'apadrinar', 'apad_intro_p1', 'text', 'Apadrinar significa ofrecer acompañamiento y apoyo a un niño, niña o adolescente, ayudándole a superar barreras y acceder a oportunidades educativas, formativas y de desarrollo integral.'),
(183, 'apadrinar', 'apad_intro_p2', 'text', 'Cada apadrinamiento contribuye al desarrollo del niño y de su familia, apoyando programas educativos, talleres y actividades de formación, generando oportunidades de crecimiento y bienestar en toda la comunidad.'),
(184, 'apadrinar', 'apad_intro_img', 'image', 'FOTOS BANNERS/MAMA CON ANGELICA  DEFINITIVA BANNER.png'),
(185, 'apadrinar', 'apad_mod_title', 'text', 'Modalidades de Apadrinamiento'),
(186, 'apadrinar', 'apad_mod_p1', 'text', 'Puedes elegir la forma en que deseas involucrarte y apoyar el desarrollo integral de los niños.'),
(187, 'apadrinar', 'apad_mod_card1_title', 'text', 'A Largo Plazo'),
(188, 'apadrinar', 'apad_mod_card1_desc', 'text', 'Crea un vínculo constante y duradero con el apadrinado y su familia, acompañándolos en su crecimiento y desarrollo personal a través de los años.'),
(189, 'apadrinar', 'apad_mod_card2_title', 'text', 'Centro de Desarrollo de Talentos (CDT)'),
(190, 'apadrinar', 'apad_mod_card2_desc', 'text', 'Permite que tu apadrinado asista a clases de inglés, arte, música, danza y otras actividades de formación no formal, potenciando sus habilidades y propósito de vida.'),
(191, 'apadrinar', 'apad_como_title', 'text', '¿Cómo apadrinar?'),
(192, 'apadrinar', 'apad_como_p1', 'text', 'El proceso es sencillo y transparente. Sigue estos pasos para comenzar tu historia de apadrinamiento.'),
(193, 'apadrinar', 'apad_como_step1_title', 'text', 'Elige a quién apoyar'),
(194, 'apadrinar', 'apad_como_step1_desc', 'text', 'Llena el formulario al final de esta página. Nos pondremos en contacto contigo para que elijas al niño, niña o adolescente que deseas apoyar.'),
(195, 'apadrinar', 'apad_como_step2_title', 'text', 'Recibe la bienvenida'),
(196, 'apadrinar', 'apad_como_step2_desc', 'text', 'Recibirás un correo de bienvenida con la foto y el perfil detallado del apadrinado y de su comunidad.'),
(197, 'apadrinar', 'apad_como_step3_title', 'text', 'Construye un vínculo'),
(198, 'apadrinar', 'apad_como_step3_desc', 'text', 'Podrás seguir su proceso, recibir actualizaciones y fotos, y mantener contacto a través de cartas o mensajes según el programa.'),
(199, 'apadrinar', 'apad_ben_title', 'text', 'Construye un Vínculo Significativo'),
(200, 'apadrinar', 'apad_ben_p1', 'text', 'A medida que tu relación con tu ahijado crece, podrás:'),
(201, 'apadrinar', 'apad_ben_li1', 'text', 'Seguir el desarrollo del apadrinado y de su comunidad.'),
(202, 'apadrinar', 'apad_ben_li2', 'text', 'Recibir fotos, videos y actualizaciones periódicas de sus actividades.'),
(203, 'apadrinar', 'apad_ben_li3', 'text', 'Intercambiar cartas o mensajes directos con tu apadrinado.'),
(204, 'apadrinar', 'apad_ben_li4', 'text', 'Participar en eventos y actividades especiales organizados por la fundación.'),
(205, 'apadrinar', 'apad_ben_img', 'image', 'FOTOS BANNERS/foto principal niños banner final.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `site_content`
--
ALTER TABLE `site_content`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `section_key` (`section_key`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `site_content`
--
ALTER TABLE `site_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
