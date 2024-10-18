<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header("Location: ../View/auth_login.php"); // Redireciona para a página de login se não estiver logado
    exit;
}

require_once("../globals.php");
require_once("../Module/conexao.php");

// Aqui você pode incluir a lógica para buscar os dados do usuário
$c = new Conexao();
$userData = $c->getUserDataById($_SESSION['user_id']); // Busca os dados do usuário

// Verifica se os dados do usuário foram encontrados
if ($userData === null) {
    // Redireciona para a página de login se o usuário não for encontrado
    header("Location: ../View/auth_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>
    <h1>Bem-vindo, <?php echo htmlspecialchars($userData['name']); ?>!</h1>
    <p>Email: <?php echo htmlspecialchars($userData['email']); ?></p>
    <p>Último login: <?php echo htmlspecialchars($userData['last_login']); ?></p>
</body>
</html>
