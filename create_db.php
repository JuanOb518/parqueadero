<?php
// Script para crear la base de datos MySQL
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', '');
    $pdo->exec('CREATE DATABASE IF NOT EXISTS parqueadero_motos CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
    echo "✅ Base de datos 'parqueadero_motos' creada exitosamente.\n";
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
