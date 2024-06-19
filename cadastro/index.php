<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>REDE-HOME</title>
</head>
<body>
    <div class="container">
        <h2>Entre com seus detalhes</h2>
        <form action="processa_cadastro.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" required><br>

            <label for="sobrenome">Sobrenome:</label>
            <input type="text" name="sobrenome" required><br>

            <label for="email">Email:</label>
            <input type="email" name="email" required><br>

            <input type="submit" value="Cadastrar na Rede">
        </form>
    </div>
</body>
</html>
