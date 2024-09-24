<?php
// Carregar variáveis do arquivo .env
$dotenv = parse_ini_file('.env');

// Conexão PDO com o banco de dados
try {
    $conn = new PDO(
        "mysql:host=" . $dotenv['DB_HOST'] . ";dbname=" . $dotenv['DB_NAME'],
        $dotenv['DB_USER'],
        $dotenv['DB_PASS']
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>
