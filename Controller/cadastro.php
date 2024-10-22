<?php
include_once("../Module/conexao.php"); 
session_start(); // Inicia a sessão
$c = new Conexao();

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recupera os dados do formulário
    $nome = trim($_POST["name_user"]);
    $email = trim($_POST["email"]);
    $senha = $_POST["senha"];
    $confirmar_senha = $_POST["confirmar_senha"];

    // Validação do e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email inválido";
        exit;
    }

    // Verifica se as senhas coincidem
    if ($senha !== $confirmar_senha) {
        echo "As senhas não coincidem.";
        exit;
    }

    // Verifica se o e-mail já existe no banco de dados
    if ($c->emailExists($email)) {
        header("Location: ../View/erro.php?e=7");
        exit;
    }

    // Insere os dados no banco e recupera o ID
    $id = $c->setAllDataAndReturnId($nome, $email, $senha); // A senha já será hashada na função

    // Redireciona com base no resultado
    if ($id == 0) {
        header("Location: ../View/erro.php?e=2");
        exit; // Adiciona exit após header
    } else {
        $_SESSION['user_id'] = $id; // Armazena o ID do usuário na sessão
        header("Location: ../View/auth_login.php?msg=success");
        exit; // Adiciona exit após header
    }
} else {
    exit;
}
?>
