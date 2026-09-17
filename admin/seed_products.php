<?php
require_once '../includes/db.php';

$products = [
    [
        'name' => 'Camiseta Solidaria Blanca',
        'price' => 35000,
        'discount' => null,
        'whatsapp_link' => 'https://wa.me/573000000000?text=Hola,%20me%20interesa%20la%20Camiseta%20Solidaria%20Blanca',
        'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=500&q=80'
    ],
    [
        'name' => 'Mug "ADN de Amor"',
        'price' => 20000,
        'discount' => 15000,
        'whatsapp_link' => 'https://wa.me/573000000000?text=Hola,%20me%20interesa%20el%20Mug%20ADN%20de%20Amor',
        'image' => 'https://images.unsplash.com/photo-1514228742587-6b1558fcca3d?auto=format&fit=crop&w=500&q=80'
    ],
    [
        'name' => 'Cuaderno Artesanal',
        'price' => 25000,
        'discount' => null,
        'whatsapp_link' => 'https://wa.me/573000000000?text=Hola,%20me%20interesa%20el%20Cuaderno%20Artesanal',
        'image' => 'https://images.unsplash.com/photo-1531346878377-a541e4ab04ce?auto=format&fit=crop&w=500&q=80'
    ],
    [
        'name' => 'Bolsa Ecológica (Tote Bag)',
        'price' => 18000,
        'discount' => 12000,
        'whatsapp_link' => 'https://wa.me/573000000000?text=Hola,%20me%20interesa%20la%20Bolsa%20Ecologica',
        'image' => 'https://images.unsplash.com/photo-1597484661643-2f5fef640eb1?auto=format&fit=crop&w=500&q=80'
    ],
    [
        'name' => 'Termo Metálico',
        'price' => 45000,
        'discount' => 40000,
        'whatsapp_link' => 'https://wa.me/573000000000?text=Hola,%20me%20interesa%20el%20Termo%20Metalico',
        'image' => 'https://images.unsplash.com/photo-1602143407151-7111542de6e8?auto=format&fit=crop&w=500&q=80'
    ]
];

try {
    $stmt = $pdo->prepare("INSERT INTO products (name, price, discount, whatsapp_link, image) VALUES (?, ?, ?, ?, ?)");
    
    foreach ($products as $p) {
        $stmt->execute([$p['name'], $p['price'], $p['discount'], $p['whatsapp_link'], $p['image']]);
    }
    
    echo "<h2 style='font-family:sans-serif; color:green; text-align:center; margin-top:50px;'>¡Se insertaron 5 productos de prueba correctamente!</h2>";
    echo "<p style='text-align:center;'><a href='dashboard.php'>Volver al panel</a></p>";
} catch (PDOException $e) {
    echo "<h2 style='font-family:sans-serif; color:red; text-align:center; margin-top:50px;'>Error: " . $e->getMessage() . "</h2>";
}
?>
