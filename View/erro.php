<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 400px;
        }
        h1 {
            color: #dc3545;
            font-size: 2rem;
        }
        p {
            color: #6c757d;
            font-size: 1rem;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }
        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Erro</h1>
        <p>
            <?php
            // Recebe o código de erro da URL
            $error_code = $_GET['e'] ?? null;

            // Exibe a mensagem de erro com base no código de erro
            switch ($error_code) {
                case 1:
                    echo "Email inválido. Por favor, insira um email válido.";
                    break;
                case 2:
                    echo "Erro ao cadastrar o usuário. Tente novamente.";
                    break;
                case 4:
                    echo "Requisição inválida. Acesse a página correta.";
                    break;
                case 5:
                    echo "Erro ao atualizar o último login. Tente novamente.";
                    break;
                case 6:
                    echo "Credenciais incorretas. Verifique seu email e senha.";
                    break;
                default:
                    echo "Ocorreu um erro desconhecido. Tente novamente.";
                    break;
            }
            ?>
        </p>
        <a href="javascript:history.back()">Voltar</a>
    </div>
</body>
</html>
