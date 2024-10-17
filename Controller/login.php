<?php
include_once("../Module/conexao.php");

session_start(); // Inicia a sessão
$c = new Conexao();

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recupera os dados do formulário
    $email = trim($_POST["email"]);
    $senha = $_POST["senha"];

    // Valida o e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Email inválido";
        exit;
    }

    // Limite de tentativas (exemplo)
    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 0;
    }

    // Limite de tentativas
    if ($_SESSION['login_attempts'] >= 3) {
        echo "Muitas tentativas. Tente novamente mais tarde.";
        exit;
    }

    // Recupera o ID do usuário
    $id = $c->getIdByEmailAndPassword($email, $senha);

    if ($id == 0) {
        $_SESSION['login_attempts'] += 1; // Incrementa tentativas
        header("Location: ../View/erro.php?e=1");
        exit; // Adiciona exit após header
    } else {
        // Limpa tentativas em caso de sucesso
        $_SESSION['login_attempts'] = 0;

        // Armazena o ID do usuário na sessão
        $_SESSION['user_id'] = $id;

        // Atualiza o último login
        $c->updateLastLogin($id); // Atualiza o campo last_login na tabela

        header("Location: ../View/home.php?id=$id&tela=home");
        exit; // Adiciona exit após header
    }
} else {
    exit;
}
?>
