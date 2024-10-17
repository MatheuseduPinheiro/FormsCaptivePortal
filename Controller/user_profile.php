<?php
session_start(); // Inicia a sessão
require_once("../Module/conexao.php"); // Inclui a classe de conexão

// Verifica se o usuário está logado
if (!isset($_SESSION['id'])) {
    header("Location: auth_login.php"); // Redireciona para a página de login se não estiver logado
    exit;
}

$c = new Conexao(); // Cria uma nova conexão
$userData = $c->getUserById($_SESSION['id']); // Obtém os dados do usuário logado

// Verifica se os dados do usuário foram obtidos com sucesso
if (!$userData) {
    echo "Erro: usuário não encontrado!";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.css" />
</head>

<body>
    <div class="container mt-5">
        <h1>Perfil do Usuário</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Nome: <?= htmlspecialchars($userData['name']); ?></h5>
                <p class="card-text">Email: <?= htmlspecialchars($userData['email']); ?></p>
                <p class="card-text">Último login: <?= htmlspecialchars($userData['last_login']); ?></p>
                <a href="logout.php" class="btn btn-danger">Sair</a>
            </div>
        </div>
    </div>
</body>

</html>
