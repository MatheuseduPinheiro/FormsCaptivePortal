<!-- login.php -->
<?php
include_once("../Module/conexao.php");

session_start(); // Inicia a sessão
$c = new Conexao();

// Define limite de tentativas
define('LOGIN_ATTEMPT_LIMIT', 3);

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

    // Inicializa tentativas se não existir
    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = 0;
    }

    

    try {
        // Recupera o ID do usuário
        $id = $c->getIdByEmailAndPassword($email, $senha);

        if ($id == 0) {
            $_SESSION['login_attempts'] += 1; // Incrementa tentativas
            header("Location: ../View/erro.php?e=1");
            exit;
        } else {
            // Limpa tentativas em caso de sucesso
            $_SESSION['login_attempts'] = 0;

            // Armazena o ID do usuário na sessão
            $_SESSION['user_id'] = $id;

            // Atualiza o último login
            $c->updateLastLogin($id);

            header("Location: ../View/home.php?id=$id&tela=home");
            exit;
        }
    } catch (Exception $e) {
        // Tratar exceções adequadamente
        echo "Ocorreu um erro ao processar seu login.";
    } finally {
        $c->close(); // Fecha a conexão
    }
} else {
    exit;
}
?>
