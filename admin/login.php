<?php
session_start();
require '../includes/db.php';

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $pdo->prepare('SELECT id, password_hash FROM admin_users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_id'] = $user['id'];
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Usuario o contraseña incorrectos.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Premium - ADN de Amor</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #E63946;
            --primary-glow: rgba(230, 57, 70, 0.4);
            --secondary: #1D3557;
            --accent: #457B9D;
            --light: #F8FAFC;
            --dark: #0f172a;
            --gray: #64748b;
            --glass-bg: rgba(255, 255, 255, 0.85);
            --glass-border: rgba(255, 255, 255, 0.5);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--dark);
            height: 100vh;
            overflow: hidden;
            display: flex;
        }

        /* Cinematic Background */
        .cinematic-bg {
            position: absolute;
            inset: 0;
            background-image: url('../FOTOS BANNERS/MAMA CON ANGELICA  DEFINITIVA BANNER.png');
            background-size: cover;
            background-position: center 25%;
            z-index: 0;
            filter: brightness(0.85);
        }

        .cinematic-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.95) 0%, rgba(29, 53, 87, 0.75) 100%);
            z-index: 1;
        }

        /* Layout Main */
        .layout-container {
            position: relative;
            z-index: 10;
            display: flex;
            width: 100%;
            height: 100%;
        }

        /* Lado Izquierdo: Copy Inspiracional */
        .hero-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 5rem;
            color: white;
            animation: fadeRight 1s ease-out;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 0.9rem;
            font-weight: 500;
            backdrop-filter: blur(10px);
            margin-bottom: 2rem;
            width: fit-content;
        }

        .hero-badge i { color: #A8DADC; }

        .hero-title {
            font-family: 'Outfit', sans-serif;
            font-size: 4rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            text-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        .hero-title span { color: #A8DADC; }

        .hero-desc {
            font-size: 1.25rem;
            line-height: 1.6;
            color: rgba(255,255,255,0.85);
            max-width: 550px;
        }

        /* Lado Derecho: Glassmorphism Form */
        .login-section {
            flex: 0 0 550px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .glass-panel {
            width: 100%;
            max-width: 440px;
            background: var(--glass-bg);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 3rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25), 
                        inset 0 1px 0 rgba(255,255,255,0.6);
            animation: fadeLeft 1s ease-out 0.2s both;
        }

        .logo-box {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo-box img {
            max-width: 200px;
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.05));
        }

        .panel-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .panel-header h2 {
            font-family: 'Outfit', sans-serif;
            color: var(--secondary);
            font-size: 1.75rem;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .panel-header p {
            color: var(--gray);
            font-size: 0.95rem;
            margin-top: 5px;
        }

        /* Floating Label Inputs */
        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-icon {
            position: absolute;
            left: 1.2rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1.1rem;
            z-index: 10;
            transition: all 0.3s ease;
        }

        .form-input {
            width: 100%;
            padding: 1.2rem 1.2rem 1.2rem 3.2rem;
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            color: var(--dark);
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            border-radius: 14px;
            outline: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }

        .form-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(230, 57, 70, 0.1), 
                        0 4px 6px rgba(0,0,0,0.04);
            background: #ffffff;
        }

        .form-input:focus + .input-icon,
        .form-input:not(:placeholder-shown) + .input-icon {
            color: var(--primary);
        }

        .form-label {
            position: absolute;
            left: 3.2rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1rem;
            pointer-events: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            padding: 0 4px;
            background: transparent;
        }

        .form-input:focus ~ .form-label,
        .form-input:not(:placeholder-shown) ~ .form-label {
            top: 0;
            left: 2.8rem;
            font-size: 0.8rem;
            color: var(--primary);
            font-weight: 600;
            background: white;
            border-radius: 4px;
            padding: 0 6px;
        }

        /* Epic Button */
        .btn-epic {
            width: 100%;
            padding: 1.1rem;
            background: linear-gradient(135deg, #E63946 0%, #c1121f 100%);
            color: white;
            font-family: 'Outfit', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            border: none;
            border-radius: 14px;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            margin-top: 1rem;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
            box-shadow: 0 8px 20px var(--primary-glow),
                        inset 0 1px 0 rgba(255,255,255,0.2);
        }

        .btn-epic:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(230, 57, 70, 0.5),
                        inset 0 1px 0 rgba(255,255,255,0.2);
            filter: brightness(1.1);
        }

        .btn-epic:active {
            transform: translateY(0);
        }

        .btn-epic i {
            transition: transform 0.3s ease;
        }

        .btn-epic:hover i {
            transform: translateX(4px);
        }

        /* Security Badge */
        .security-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 2rem;
            color: #94a3b8;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .security-badge i { color: #10b981; }

        /* Error Message */
        .error-message {
            background: rgba(254, 242, 242, 0.9);
            color: #dc2626;
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
            border: 1px solid #fecaca;
            animation: shake 0.5s;
            backdrop-filter: blur(5px);
        }

        /* Animations */
        @keyframes fadeRight {
            from { opacity: 0; transform: translateX(-40px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes fadeLeft {
            from { opacity: 0; transform: translateX(40px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .hero-title { font-size: 3rem; }
            .login-section { flex: 0 0 450px; }
        }

        @media (max-width: 800px) {
            .layout-container { flex-direction: column; }
            .hero-section {
                flex: none;
                padding: 3rem 2rem;
                align-items: center;
                text-align: center;
            }
            .hero-badge { margin: 0 auto 1.5rem; }
            .hero-desc { display: none; }
            .login-section {
                flex: 1;
                padding: 0 1.5rem 2rem;
                align-items: flex-start;
            }
            .glass-panel { padding: 2rem 1.5rem; }
        }
    </style>
</head>
<body>

    <!-- Fondos Cinematográficos -->
    <div class="cinematic-bg"></div>
    <div class="cinematic-overlay"></div>

    <div class="layout-container">
        
        <!-- Lado Izquierdo: Inspiración Cinematográfica -->
        <div class="hero-section">
            <div class="hero-badge">
                <i class="fas fa-shield-alt"></i> Panel de Administración Seguro
            </div>
            <h1 class="hero-title">Transformando<br>Vidas <span>Juntos</span></h1>
            <p class="hero-desc">Accede a tu centro de control digital. Desde aquí podrás gestionar el contenido, publicar actualizaciones y seguir inspirando a cientos de personas.</p>
        </div>

        <!-- Lado Derecho: Formulario Glassmorphism -->
        <div class="login-section">
            <div class="glass-panel">
                
                <div class="logo-box">
                    <img src="../LOGO Y VISUAL WEB BOTONES/logo ADN_de_Amor_color_rectangulo.png" alt="ADN de Amor">
                </div>

                <div class="panel-header">
                    <h2>Bienvenido de vuelta</h2>
                    <p>Ingresa tus credenciales maestras</p>
                </div>

                <?php if ($error): ?>
                    <div class="error-message">
                        <i class="fas fa-exclamation-triangle"></i>
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="">
                    <!-- Floating Label Input 1 -->
                    <div class="input-group">
                        <input type="text" name="username" id="username" class="form-input" placeholder=" " required autocomplete="username">
                        <i class="fas fa-user input-icon"></i>
                        <label for="username" class="form-label">Nombre de usuario</label>
                    </div>

                    <!-- Floating Label Input 2 -->
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-input" placeholder=" " required autocomplete="current-password">
                        <i class="fas fa-lock input-icon"></i>
                        <label for="password" class="form-label">Contraseña</label>
                    </div>

                    <button type="submit" class="btn-epic">
                        Iniciar Sesión <i class="fas fa-chevron-right"></i>
                    </button>
                </form>

                <div class="security-badge">
                    <i class="fas fa-lock"></i> Conexión encriptada y segura
                </div>
                
                <div style="text-align: center; margin-top: 1rem;">
                    <a href="../index.php" style="color: var(--gray); text-decoration: none; font-size: 0.9rem; transition: color 0.3s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--gray)'">
                        <i class="fas fa-arrow-left"></i> Volver a la web
                    </a>
                </div>

            </div>
        </div>

    </div>

</body>
</html>
