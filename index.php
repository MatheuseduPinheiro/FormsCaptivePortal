<?php
session_start();

require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta para verificar se o usuário com o email fornecido existe
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verifica se a senha fornecida corresponde à senha hash armazenada no banco de dados
        if (password_verify($password, $row['password'])) {
            // Senha correta, inicia a sessão e redireciona para a página desejada
            $_SESSION["loggedin"] = true;
            header("Location: https://www.margalho.pro.br/site-escarlate/");
            exit;
        } else {
            // Senha incorreta
            $error = "<p>Senha ou email inválido</p>";
        }
    } else {
        // Usuário com o email fornecido não encontrado
        $error = "<p>Usuário não encontrado</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/network-interface-card.png" type="image/x-icon">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="title">
            <h1>Login</h1>
        </div>
        <div class="inputs">
            <form method="post" action="index.php">

                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" name="password" required>
                </div>
                <div class="botao">
                    <input type="submit" value="Logar">
                </div>

                <?php if (isset($error)): ?>
                <div class="error-message">
                    <?php echo $error; ?>
                </div>
                <?php endif; ?>

            </form>
        </div>
        <div class="gatway">
            <a href="cadastrar.php">Ainda não é cadastrado?</a>
        </div>
    </div>
</body>
</html>
