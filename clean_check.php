<?php
// clean_check.php - Diagnostic & Cleanup utility
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/includes/db.php';

$results = [
    'files_with_pelis' => [],
    'db_with_pelis' => [],
    'db_updated' => []
];

// 1. Check database
try {
    // Check site_content
    $stmt = $pdo->query("SELECT id, page_name, section_key, content_value FROM site_content WHERE content_value LIKE '%detodopelis%' OR content_value LIKE '%pelis%'");
    while ($row = $stmt->fetch()) {
        $results['db_with_pelis'][] = [
            'table' => 'site_content',
            'id' => $row['id'],
            'section_key' => $row['section_key'],
            'content_value' => $row['content_value']
        ];
        
        $cleaned = str_replace(
            ['https://entornos.detodopelis.co/panel/', 'https://entornos.detodopelis.co/', 'http://entornos.detodopelis.co/panel/', 'http://entornos.detodopelis.co/', 'entornos.detodopelis.co', 'detodopelis.co'],
            ['index.php', 'index.php', 'index.php', 'index.php', 'fundacionadndeamor.org', 'fundacionadndeamor.org'],
            $row['content_value']
        );
        $up = $pdo->prepare("UPDATE site_content SET content_value = ? WHERE id = ?");
        $up->execute([$cleaned, $row['id']]);
        $results['db_updated'][] = ['id' => $row['id'], 'new_value' => $cleaned];
    }

    // Check products
    $stmt = $pdo->query("SELECT id, name, whatsapp_link, image FROM products WHERE whatsapp_link LIKE '%detodopelis%' OR whatsapp_link LIKE '%pelis%' OR image LIKE '%detodopelis%' OR image LIKE '%pelis%'");
    while ($row = $stmt->fetch()) {
        $results['db_with_pelis'][] = [
            'table' => 'products',
            'id' => $row['id'],
            'whatsapp_link' => $row['whatsapp_link'],
            'image' => $row['image']
        ];
    }
} catch (Exception $e) {
    $results['db_error'] = $e->getMessage();
}

// 2. Check files in public_html
$dir = new RecursiveDirectoryIterator(__DIR__, RecursiveDirectoryIterator::SKIP_DOTS);
$iterator = new RecursiveIteratorIterator($dir);

foreach ($iterator as $file) {
    if ($file->isFile() && in_array(strtolower($file->getExtension()), ['php', 'html', 'js', 'txt', 'htaccess'])) {
        $filePath = $file->getPathname();
        // Skip this check script
        if (basename($filePath) === 'clean_check.php') continue;
        
        $content = @file_get_contents($filePath);
        if ($content !== false && (stripos($content, 'detodopelis') !== false || stripos($content, 'pelis') !== false)) {
            // Find line numbers
            $lines = explode("\n", $content);
            $matchedLines = [];
            foreach ($lines as $idx => $line) {
                if (stripos($line, 'detodopelis') !== false || stripos($line, 'pelis') !== false) {
                    $matchedLines[] = [
                        'line' => $idx + 1,
                        'text' => trim($line)
                    ];
                }
            }
            $results['files_with_pelis'][] = [
                'file' => str_replace(__DIR__, '', $filePath),
                'matches' => $matchedLines
            ];
        }
    }
}

echo json_encode($results, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
