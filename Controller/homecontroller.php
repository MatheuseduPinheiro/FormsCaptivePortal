<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: ../View/login.php"); // Redireciona para a página de login se não estiver logado
    exit;
}

include_once("../Module/conexao.php");
$c = new Conexao();

try {
    $userId = $_SESSION['user_id'];
    $userData = $c->getUserDataById($userId); // Busca os dados do usuário

    if (!$userData) {
        throw new Exception("Usuário não encontrado.");
    }

    // Aqui você pode incluir a lógica para renderizar a view
    include("../View/home.php"); // Inclui a view home

} catch (Exception $e) {
    // Tratar exceções adequadamente
    echo "Ocorreu um erro: " . $e->getMessage();
} finally {
    $c->close(); // Fecha a conexão
}
?>
