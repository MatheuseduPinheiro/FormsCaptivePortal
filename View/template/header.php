<?php

require_once("../globals.php");
require_once("../Module/conexao.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VirtualTinga</title>
    <link rel="shortcut icon" href="<?= $BASE_URL ?>../img/logo-escarlate2-121x123.png">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.css" integrity="sha512-drnvWxqfgcU6sLzAJttJv7LKdjWn0nxWCSbEAtxJ/YYaZMyoNLovG7lPqZRdhgL1gAUfa+V7tbin8y+2llC1cw==" crossorigin="anonymous" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <!-- CSS do projeto -->
    <link rel="stylesheet" href="<?= $BASE_URL ?>css/style.css">
    <script src="<?= $BASE_URL ?>js/script.js"></script>
</head>

<body>
    <header>
        <nav id="main-navbar" class="navbar navbar-expand-lg">
            <a href="<?= $BASE_URL ?>" class="navbar-brand">
                <img src="<?= $BASE_URL ?>../img/logo-escarlate2-121x123.png" id="logo">
                <span id="VirtualTinga-title">VirtualTinga</span>
            </a>

            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav">
                    <?php if (isset($_SESSION['id'])) : ?> <!-- Corrigido para verificar a sessão 'id' -->
                        <li class="nav-item">
                            <a href="<?= $BASE_URL ?>user_profile.php" class="nav-link bold"> <!-- Substitua 'user_profile.php' pelo arquivo desejado -->
                                <i class="fas fa-user"></i>
                                <?= $_SESSION['user_name'] ?> <!-- Exibe o nome do usuário da sessão -->
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= $BASE_URL ?>logout.php" class="nav-link">
                                <i class="fas fa-sign-in-alt"></i>
                                Sair
                            </a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a href="<?= $BASE_URL ?>---" class="nav-link">
                                <i class="fas fa-sign-in-alt"></i>
                                Entrar / Cadastrar
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </header>