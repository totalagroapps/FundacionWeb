# Fundación ADN de Amor — Sitio Web Oficial

Sitio web dinámico de la **Fundación ADN de Amor** (*Oportunidades y Esperanza*), desarrollado en PHP, MySQL, HTML5, CSS3 y JavaScript.

- **Dominio oficial:** [https://fundacionadndeamor.org](https://fundacionadndeamor.org)
- **Panel de administración:** `https://fundacionadndeamor.org/admin/`

---

## 📁 Estructura del Proyecto

```text
Fundacion Web/
├── index.php              # Página principal (Hero slider, causas, testimonios)
├── nosotros.php           # Quiénes somos, misión, visión y equipo
├── programas.php          # Programas sociales y proyectos
├── apadrinar.php          # Información de apadrinamiento y donaciones
├── tienda.php             # Tienda solidaria
├── blog.php               # Noticias y artículos
├── memorias.php           # Memorias de gestión y transparencia
├── styles.css             # Estilos globales y responsive design
├── main.js                # Lógica del cliente, modales y sliders
├── admin/                 # Panel de administración interno
│   ├── login.php          # Acceso de administradores
│   ├── dashboard.php      # Edición de textos y banners
│   ├── productos.php      # Gestión de productos de la tienda
│   └── process_edit.php   # Procesamiento seguro de cambios
├── includes/
│   ├── db.php             # Conexión PDO a base de datos MySQL
│   └── footer.php         # Pie de página compartido
├── uploads/               # Imágenes cargadas dinámicamente desde el admin
├── FOTOS BANNERS/         # Fotografías y banners de cabecera
├── LOGO Y VISUAL WEB.../  # Logotipos e identidades de marca
└── Base de datos.sql      # Estructura y datos iniciales de MySQL
```

---

## 🚀 Despliegue Automático con Hostinger (Git Webhook)

Para que cada `git push` se refleje automáticamente en la web:

1. Crea un repositorio **Privado** en GitHub (ej. `fundacion-adn-de-amor`).
2. Sube esta carpeta al repositorio:
   ```bash
   git init
   git add .
   git commit -m "Initial commit - Web Fundación depurada"
   git branch -M main
   git remote add origin <URL_DE_TU_REPO_GITHUB>
   git push -u origin main
   ```
3. En **Hostinger hPanel**:
   - Ve a **Avanzado** > **Git**.
   - Ingresa el enlace del repositorio y la rama `main`.
   - Selecciona el directorio de destino (`public_html`).
   - Copia la URL del **Webhook** que te proporciona Hostinger.
4. En **GitHub**:
   - Entra a tu repositorio > **Settings** > **Webhooks** > **Add webhook**.
   - Pega la URL del Webhook de Hostinger y guarda.
