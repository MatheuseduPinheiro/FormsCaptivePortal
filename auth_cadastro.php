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
    <div id="register-container">
        <h2>Criar Conta</h2>
        <form action="<?= $BASE_URL ?>auth_process.php" method="POST">
            <input type="hidden" name="type" value="register">
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail">
            </div>
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Digite seu nome">
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha">
            </div>
            <div class="form-group">
                <label for="confirmpassword">Confirmação de senha:</label>
                <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirme sua senha">
            </div> 

            <input type="submit" class="btn card-btn" value="Registrar">

            <div class="gatway">
                <a href="<?= $BASE_URL ?>auth_login.php" >Já estou cadastrado na rede.</a>
            </div>
        </form>
    </div>
</body>

</html>