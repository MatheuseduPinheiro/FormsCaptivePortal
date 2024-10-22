<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
// if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
//     header("Location: ../View/auth_login.php"); // Redireciona para a página de login se não estiver logado
//     exit;
// }

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

// Para depuração
var_dump($userData); // Isso ajudará a ver o que está sendo retornado

?>

<!DOCTYPE html>
<html lang="pt-BR">
<link rel="stylesheet" href="<?= $BASE_URL ?>../css/style-home.css">
<link rel="shortcut icon" href="<?= $BASE_URL ?>../img/logo-escarlate2-121x123.png" type="image/x-icon">

<head>
    <meta charset="UTF-8">
    <title>Home</title>
</head>
<body>
    <h1>Bem-vindo, <?php echo htmlspecialchars($userData['name_user']); ?>!</h1>
    
    <div class="download-section">
        <a href="caminho_do_arquivo" download class="download-btn">Baixar Arquivo</a>
    </div>

</body>
</html>
