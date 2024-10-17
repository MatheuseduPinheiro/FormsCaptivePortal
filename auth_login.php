<?php
require_once("globals.php");
require_once("db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $BASE_URL ?>css/style.css">
    <title>CaptivePortal</title>
</head>

<body>
    <div id="login-container">
        <h2>Entrar</h2>
        <form action="<?= $BASE_URL ?>auth_process.php" method="POST">
            <input type="hidden" name="type" value="login">
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail">
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha">
            </div>
            <input type="submit" class="btn card-btn" value="Entrar">
            <div class="gatway">
                <a href="<?= $BASE_URL ?>auth_cadastro.php" >Ainda não estou cadastrado na rede</a>
            </div>
        </form>
    </div>
</body>

</html>