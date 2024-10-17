<?php
include_once("../Module/conexao.php");
session_start(); // Inicia a sessão

// Instancia a conexão
$c = new Conexao();

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recupera os dados do formulário de login
    $email = trim($_POST["email"]);
    $senha = $_POST["senha"];

    // Validação do e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../View/erro.php?e=1"); // Email inválido
        exit;
    }

    // Busca o ID do usuário pelo email e senha
    $user_id = $c->getIdByEmailAndPassword($email, $senha);

    if ($user_id > 0) {
        // Se o login for bem-sucedido, atualiza a última data de login
        if ($c->updateLastLogin($user_id)) {
            // Armazena o ID do usuário na sessão
            $_SESSION['user_id'] = $user_id;
            
            // Redireciona para a página de sucesso
            header("Location: ../View/sucesso.php?id=$user_id");
            exit;
        } else {
            // Se a atualização falhar
            header("Location: ../View/erro.php?e=5"); // Erro ao atualizar último login
            exit;
        }
    } else {
        // Se o login falhar
        header("Location: ../View/erro.php?e=6"); // Credenciais incorretas
        exit;
    }
} else {
    // Se não for uma requisição POST
    header("Location: ../View/erro.php?e=4"); // Requisição inválida
    exit;
}
?>
