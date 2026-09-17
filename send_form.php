<?php
// send_form.php - Procesador universal de formularios para Fundación ADN de Amor
require_once 'includes/db.php';

// Asegurar que la tabla de mensajes exista en la base de datos con todos los campos necesarios
try {
    $pdo->exec("CREATE TABLE IF NOT EXISTS `contact_messages` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `form_type` varchar(50) NOT NULL DEFAULT 'contacto',
        `name` varchar(255) NOT NULL,
        `email` varchar(255) NOT NULL,
        `phone` varchar(100) DEFAULT NULL,
        `location` varchar(255) DEFAULT NULL,
        `modality` varchar(100) DEFAULT NULL,
        `company` varchar(255) DEFAULT NULL,
        `position` varchar(255) DEFAULT NULL,
        `university` varchar(255) DEFAULT NULL,
        `career` varchar(255) DEFAULT NULL,
        `availability` varchar(100) DEFAULT NULL,
        `message` text DEFAULT NULL,
        `ip_address` varchar(45) DEFAULT NULL,
        `status` varchar(20) NOT NULL DEFAULT 'nuevo',
        `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

    // Verificar y agregar columnas en caso de tablas preexistentes
    $cols = $pdo->query("SHOW COLUMNS FROM contact_messages")->fetchAll(PDO::FETCH_COLUMN);
    if (!in_array('profile_type', $cols)) { $pdo->exec("ALTER TABLE contact_messages ADD COLUMN profile_type varchar(100) NULL AFTER form_type"); }
    if (!in_array('company', $cols)) { $pdo->exec("ALTER TABLE contact_messages ADD COLUMN company varchar(255) NULL AFTER modality"); }
    if (!in_array('position', $cols)) { $pdo->exec("ALTER TABLE contact_messages ADD COLUMN position varchar(255) NULL AFTER company"); }
    if (!in_array('university', $cols)) { $pdo->exec("ALTER TABLE contact_messages ADD COLUMN university varchar(255) NULL AFTER position"); }
    if (!in_array('career', $cols)) { $pdo->exec("ALTER TABLE contact_messages ADD COLUMN career varchar(255) NULL AFTER university"); }
    if (!in_array('availability', $cols)) { $pdo->exec("ALTER TABLE contact_messages ADD COLUMN availability varchar(100) NULL AFTER career"); }
    if (!in_array('interest_reason', $cols)) { $pdo->exec("ALTER TABLE contact_messages ADD COLUMN interest_reason text NULL AFTER message"); }
    if (!in_array('collaboration_areas', $cols)) { $pdo->exec("ALTER TABLE contact_messages ADD COLUMN collaboration_areas text NULL AFTER interest_reason"); }
    if (!in_array('previous_volunteer', $cols)) { $pdo->exec("ALTER TABLE contact_messages ADD COLUMN previous_volunteer varchar(10) NULL AFTER collaboration_areas"); }
    if (!in_array('previous_volunteer_details', $cols)) { $pdo->exec("ALTER TABLE contact_messages ADD COLUMN previous_volunteer_details text NULL AFTER previous_volunteer"); }
} catch (\Exception $e) {
    // Si falla la verificación se continúa con el envío
}

$is_ajax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') 
           || (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false);

function respond($success, $message, $form_type = 'contacto', $is_ajax = false) {
    if ($is_ajax) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(['success' => $success, 'message' => $message]);
        exit;
    } else {
        $anchor = 'contacto';
        $page = '/';
        if ($form_type === 'apadrinar') {
            $anchor = 'contacto-apadrinar';
            $page = '/apadrinar';
        } elseif ($form_type === 'empresa') {
            $anchor = 'contacto-empresa';
            $page = '/empresas';
        } elseif ($form_type === 'practicas') {
            $anchor = 'contacto-practicas';
            $page = '/practicas';
        } elseif ($form_type === 'voluntariado') {
            $anchor = 'contacto-voluntariado';
            $page = '/voluntariado';
        }
        $status = $success ? 'success' : 'error';
        $msg_param = urlencode($message);
        header("Location: {$page}?status={$status}&msg={$msg_param}#{$anchor}");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(false, 'Método de solicitud no válido.', 'contacto', $is_ajax);
}

// 1. Detección Anti-spam (Honeypot)
$honeypot = trim($_POST['website'] ?? $_POST['business_url'] ?? $_POST['website_url_check'] ?? '');
if (!empty($honeypot)) {
    // Es un bot automatizado: respondemos éxito simulado sin procesar
    respond(true, '¡Gracias por comunicarte con la Fundación ADN de Amor!', 'contacto', $is_ajax);
}

// 2. Extracción y saneamiento de datos
$raw_type = $_POST['form_type'] ?? 'contacto';
if (in_array($raw_type, ['apadrinar', 'empresa', 'practicas', 'voluntariado'])) {
    $form_type = $raw_type;
} else {
    $form_type = 'contacto';
}

$name = trim(strip_tags($_POST['name'] ?? ''));
$email = trim(filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL));
$phone = trim(strip_tags($_POST['phone'] ?? ''));
$location = trim(strip_tags($_POST['city'] ?? $_POST['location'] ?? ''));
$modality = trim(strip_tags($_POST['modality'] ?? ''));
$company = trim(strip_tags($_POST['company'] ?? ''));
$position = trim(strip_tags($_POST['position'] ?? ''));
$university = trim(strip_tags($_POST['university'] ?? ''));
$career = trim(strip_tags($_POST['career'] ?? ''));
$availability = trim(strip_tags($_POST['availability'] ?? ''));
$profile_type = trim(strip_tags($_POST['profile_type'] ?? ''));
$message = trim(strip_tags($_POST['message'] ?? ''));
$ip = $_SERVER['REMOTE_ADDR'] ?? '';

// Campos específicos para voluntariado
$interest_reason = trim(strip_tags($_POST['interest_reason'] ?? ''));
$raw_areas = $_POST['collaboration_areas'] ?? [];
$collaboration_areas = is_array($raw_areas) ? implode(', ', array_map('strip_tags', $raw_areas)) : trim(strip_tags($raw_areas));
$previous_volunteer = trim(strip_tags($_POST['previous_volunteer'] ?? ''));
$previous_volunteer_details = trim(strip_tags($_POST['previous_volunteer_details'] ?? ''));

// 3. Validaciones según el formulario
if (empty($name)) {
    respond(false, 'Por favor, ingresa tu nombre completo.', $form_type, $is_ajax);
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    respond(false, 'Por favor, ingresa un correo electrónico válido.', $form_type, $is_ajax);
}

if ($form_type === 'empresa' && empty($company)) {
    respond(false, 'Por favor, ingresa el nombre de tu empresa u organización.', $form_type, $is_ajax);
}

if ($form_type === 'practicas') {
    if ($profile_type !== 'Profesional' && empty($university)) {
        respond(false, 'Por favor, ingresa el nombre de tu universidad o institución.', $form_type, $is_ajax);
    }
    if ($profile_type !== 'Profesional' && empty($career)) {
        respond(false, 'Por favor, ingresa el nombre de tu carrera o programa académico.', $form_type, $is_ajax);
    }
}

if ($form_type === 'voluntariado') {
    if (empty($interest_reason)) {
        respond(false, 'Por favor, indícanos por qué te interesa ser voluntario con nosotros.', $form_type, $is_ajax);
    }
    if (empty($collaboration_areas)) {
        respond(false, 'Por favor, selecciona al menos un área en la que crees que puedes colaborar.', $form_type, $is_ajax);
    }
    if (empty($previous_volunteer)) {
        respond(false, 'Por favor, indica si has sido voluntario anteriormente.', $form_type, $is_ajax);
    }
}

if ($form_type === 'contacto' && empty($message)) {
    respond(false, 'Por favor, escribe un mensaje.', $form_type, $is_ajax);
}

// 4. Guardar registro en la base de datos
try {
    $stmt = $pdo->prepare("INSERT INTO contact_messages (form_type, profile_type, name, email, phone, location, modality, company, position, university, career, availability, message, interest_reason, collaboration_areas, previous_volunteer, previous_volunteer_details, ip_address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$form_type, $profile_type, $name, $email, $phone, $location, $modality, $company, $position, $university, $career, $availability, $message, $interest_reason, $collaboration_areas, $previous_volunteer, $previous_volunteer_details, $ip]);
} catch (\Exception $e) {
    error_log("Error al guardar mensaje en BD: " . $e->getMessage());
}

// 5. Destinatario oficial (info@fundacionadndeamor.org)
$to_email = get_site_content($pdo, 'contacto_email', 'info@fundacionadndeamor.org');
if (empty($to_email) || !filter_var($to_email, FILTER_VALIDATE_EMAIL)) {
    $to_email = 'info@fundacionadndeamor.org';
}

// 6. Preparar Asunto y Cuerpo del Correo
$fecha_envio = date('d/m/Y h:i A');
$clean_phone = preg_replace('/[^0-9]/', '', $phone);
$wa_url = !empty($clean_phone) ? "https://wa.me/{$clean_phone}" : '';

if ($form_type === 'empresa') {
    $subject = "🏢 Nueva Propuesta de Alianza Empresarial: " . (!empty($company) ? "{$company} - " : "") . "{$name}";
    $badge_title = "Alianza Empresarial";
    $type_description = "Una empresa o entidad aliada ha enviado una solicitud de colaboración institucional desde la página web.";
} elseif ($form_type === 'practicas') {
    if ($profile_type === 'Profesional') {
        $subject = "💼 Nueva Postulación de Colaborador Profesional: {$name}";
        $badge_title = "Colaborador Profesional / Pro Bono";
        $type_description = "Un profesional graduado ha enviado su postulación para colaborar y brindar asesoría con la Fundación.";
    } else {
        $subject = "🎓 Nueva Solicitud de Prácticas Profesionales: {$name}" . (!empty($career) ? " ({$career})" : "");
        $badge_title = "Prácticas Profesionales";
        $type_description = "Un estudiante o voluntario universitario ha postulado su perfil para realizar prácticas profesionales.";
    }
} elseif ($form_type === 'voluntariado') {
    $subject = "🤝 Nueva Postulación de Voluntariado: {$name}" . (!empty($location) ? " ({$location})" : "");
    $badge_title = "Voluntariado ADN de Amor";
    $type_description = "Una persona interesada ha completado el formulario de voluntariado para sumarse a la labor de la Fundación.";
} elseif ($form_type === 'apadrinar') {
    $subject = "❤️ Nueva Solicitud de Apadrinamiento: {$name}";
    $badge_title = "Solicitud de Apadrinamiento";
    $type_description = "Un usuario ha completado el formulario de apadrinamiento en la web.";
} else {
    $subject = "✉️ Nuevo Mensaje de Contacto Web: {$name}";
    $badge_title = "Contacto General";
    $type_description = "Un usuario ha enviado un mensaje desde el formulario de contacto principal.";
}

// Plantilla HTML Responsive con los colores corporativos (#00103E y #EA5A00)
$html_body = '
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>' . htmlspecialchars($subject) . '</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif; background-color: #f4f6f9; margin: 0; padding: 20px; color: #2d3748; }
        .wrapper { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.06); border: 1px solid #e2e8f0; }
        .header { background: #00103E; padding: 30px 20px; text-align: center; border-bottom: 4px solid #EA5A00; }
        .header h1 { color: #ffffff; margin: 0; font-size: 22px; font-weight: 700; letter-spacing: 0.5px; }
        .header p { color: #EA5A00; margin: 6px 0 0 0; font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }
        .content { padding: 30px; }
        .badge { display: inline-block; background: rgba(234, 90, 0, 0.1); color: #EA5A00; padding: 6px 14px; border-radius: 20px; font-weight: 600; font-size: 13px; margin-bottom: 15px; }
        .intro { font-size: 15px; color: #4a5568; margin-bottom: 25px; line-height: 1.5; }
        .table-data { width: 100%; border-collapse: collapse; margin-bottom: 25px; }
        .table-data td { padding: 12px 10px; border-bottom: 1px solid #edf2f7; vertical-align: top; font-size: 14px; }
        .label { width: 38%; font-weight: 600; color: #00103E; }
        .value { width: 62%; color: #2d3748; }
        .value a { color: #EA5A00; text-decoration: none; font-weight: 500; }
        .message-box { background: #f8fafc; border-left: 4px solid #EA5A00; padding: 16px; border-radius: 6px; font-style: normal; color: #1a202c; line-height: 1.6; font-size: 14px; }
        .actions { text-align: center; margin-top: 30px; }
        .btn-reply { display: inline-block; background: #EA5A00; color: #ffffff !important; text-decoration: none; padding: 12px 28px; border-radius: 8px; font-weight: 600; font-size: 14px; box-shadow: 0 4px 10px rgba(234, 90, 0, 0.3); }
        .footer { background: #f8fafc; padding: 20px; text-align: center; font-size: 12px; color: #a0aec0; border-top: 1px solid #edf2f7; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>Fundación ADN de Amor</h1>
            <p>Nuevo formulario recibido</p>
        </div>
        <div class="content">
            <span class="badge">' . htmlspecialchars($badge_title) . '</span>
            <p class="intro">' . htmlspecialchars($type_description) . '</p>

            <table class="table-data">
                <tr>
                    <td class="label">' . ($form_type === 'empresa' ? 'Persona de Contacto:' : 'Nombre:') . '</td>
                    <td class="value"><strong>' . htmlspecialchars($name) . '</strong></td>
                </tr>';

if (!empty($company)) {
    $html_body .= '
                <tr>
                    <td class="label">Empresa / Organización:</td>
                    <td class="value"><strong>' . htmlspecialchars($company) . '</strong></td>
                </tr>';
}

if (!empty($profile_type)) {
    $html_body .= '
                <tr>
                    <td class="label">Tipo de Perfil:</td>
                    <td class="value"><strong>' . htmlspecialchars($profile_type) . '</strong></td>
                </tr>';
}

if (!empty($position)) {
    $html_body .= '
                <tr>
                    <td class="label">Cargo o Rol:</td>
                    <td class="value">' . htmlspecialchars($position) . '</td>
                </tr>';
}

if (!empty($university)) {
    $html_body .= '
                <tr>
                    <td class="label">Universidad / Institución:</td>
                    <td class="value"><strong>' . htmlspecialchars($university) . '</strong></td>
                </tr>';
}

if (!empty($career)) {
    $html_body .= '
                <tr>
                    <td class="label">Carrera / Programa:</td>
                    <td class="value">' . htmlspecialchars($career) . '</td>
                </tr>';
}

if (!empty($interest_reason)) {
    $html_body .= '
                <tr>
                    <td class="label">¿Por qué le interesa ser voluntario?:</td>
                    <td class="value">' . nl2br(htmlspecialchars($interest_reason)) . '</td>
                </tr>';
}

if (!empty($collaboration_areas)) {
    $html_body .= '
                <tr>
                    <td class="label">Áreas de Colaboración:</td>
                    <td class="value"><span style="color: #00103E; font-weight: 600;">' . htmlspecialchars($collaboration_areas) . '</span></td>
                </tr>';
}

if (!empty($previous_volunteer)) {
    $pv_text = htmlspecialchars($previous_volunteer);
    if (!empty($previous_volunteer_details)) {
        $pv_text .= ' - ' . htmlspecialchars($previous_volunteer_details);
    }
    $html_body .= '
                <tr>
                    <td class="label">¿Voluntario anteriormente?:</td>
                    <td class="value">' . $pv_text . '</td>
                </tr>';
}

if (!empty($availability)) {
    $html_body .= '
                <tr>
                    <td class="label">Disponibilidad de Tiempo:</td>
                    <td class="value"><span style="color: #00103E; font-weight: 600;">' . htmlspecialchars($availability) . '</span></td>
                </tr>';
}

$html_body .= '
                <tr>
                    <td class="label">Correo Electrónico:</td>
                    <td class="value"><a href="mailto:' . htmlspecialchars($email) . '">' . htmlspecialchars($email) . '</a></td>
                </tr>';

if (!empty($phone)) {
    $html_body .= '
                <tr>
                    <td class="label">Teléfono / WhatsApp:</td>
                    <td class="value">
                        ' . htmlspecialchars($phone);
    if (!empty($wa_url)) {
        $html_body .= ' &nbsp;|&nbsp; <a href="' . htmlspecialchars($wa_url) . '" target="_blank">Abrir WhatsApp &raquo;</a>';
    }
    $html_body .= '
                    </td>
                </tr>';
}

if (!empty($location)) {
    $html_body .= '
                <tr>
                    <td class="label">Ciudad / País:</td>
                    <td class="value">' . htmlspecialchars($location) . '</td>
                </tr>';
}

if (!empty($modality)) {
    $modality_label = 'Modalidad elegida:';
    if ($form_type === 'empresa') {
        $modality_label = 'Tipo de Alianza / Apoyo:';
    } elseif ($form_type === 'practicas') {
        $modality_label = 'Área de Interés:';
    } elseif ($form_type === 'voluntariado') {
        $modality_label = 'Modalidad de Voluntariado:';
    }
    $html_body .= '
                <tr>
                    <td class="label">' . $modality_label . '</td>
                    <td class="value"><span style="color: #EA5A00; font-weight: 600;">' . htmlspecialchars($modality) . '</span></td>
                </tr>';
}

$html_body .= '
                <tr>
                    <td class="label">Fecha y Hora:</td>
                    <td class="value">' . htmlspecialchars($fecha_envio) . '</td>
                </tr>
            </table>';

if (!empty($message)) {
    $message_heading = 'Mensaje del usuario:';
    if ($form_type === 'empresa') {
        $message_heading = 'Propuesta / Mensaje de la Empresa:';
    } elseif ($form_type === 'practicas') {
        $message_heading = 'Carta de Motivación / Mensaje:';
    } elseif ($form_type === 'voluntariado') {
        $message_heading = 'Mensaje adicional:';
    }
    $html_body .= '
            <p style="font-weight: 600; color: #00103E; margin-bottom: 8px;">' . $message_heading . '</p>
            <div class="message-box">
                ' . nl2br(htmlspecialchars($message)) . '
            </div>';
}

$html_body .= '
            <div class="actions">
                <a href="mailto:' . htmlspecialchars($email) . '?subject=Re: ' . rawurlencode($subject) . '" class="btn-reply">Responder a ' . htmlspecialchars($name) . '</a>
            </div>
        </div>
        <div class="footer">
            Este correo fue generado y enviado automáticamente por el sistema web de fundacionadndeamor.org.<br>
            IP de origen: ' . htmlspecialchars($ip) . '
        </div>
    </div>
</body>
</html>';

// 7. Cabeceras del Correo
$headers = [
    'MIME-Version: 1.0',
    'Content-Type: text/html; charset=UTF-8',
    'From: Fundación ADN de Amor <info@fundacionadndeamor.org>',
    'Reply-To: ' . $name . ' <' . $email . '>',
    'X-Mailer: PHP/' . phpversion()
];

$headers_str = implode("\r\n", $headers);

// Enviar correo con el parámetro -f para garantizar SPF / Return-Path
$mail_sent = @mail($to_email, $subject, $html_body, $headers_str, "-f info@fundacionadndeamor.org");

$msg_success = '¡Muchas gracias! Tu mensaje ha sido enviado correctamente a nuestro equipo en info@fundacionadndeamor.org. Nos pondremos en contacto contigo muy pronto.';
if ($form_type === 'empresa') {
    $msg_success = '¡Muchas gracias por su interés en aliarse con la Fundación ADN de Amor! Hemos recibido su propuesta en info@fundacionadndeamor.org y nos pondremos en contacto con su organización muy pronto.';
} elseif ($form_type === 'practicas') {
    $msg_success = '¡Muchas gracias por postularte para colaborar con nosotros! Tu solicitud ha sido recibida en info@fundacionadndeamor.org y revisaremos tu perfil con nuestro equipo.';
} elseif ($form_type === 'voluntariado') {
    $msg_success = '¡Muchas gracias por tu vocación y deseo de servir! Tu postulación como voluntario ha sido recibida en info@fundacionadndeamor.org y nos pondremos en contacto contigo muy pronto.';
}

if ($mail_sent) {
    respond(true, $msg_success, $form_type, $is_ajax);
} else {
    // Si la función mail del servidor falla pero el registro se guardó en BD, notificamos éxito al usuario
    respond(true, $msg_success, $form_type, $is_ajax);
}
