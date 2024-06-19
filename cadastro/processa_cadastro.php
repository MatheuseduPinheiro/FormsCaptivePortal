<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $nome = $_POST["nome"];
    $sobrenome = $_POST["sobrenome"];
    $email = $_POST["email"];

    // Conexão com o banco de dados (substitua pelos seus próprios dados)
    $servername = "localhost";
    $usuario = "Matheus";
    $senha = "zGy#9pWv!s4L";
    $dbname = "captive_portal";

    $conn = new mysqli($servername, $usuario, $senha, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Insere os dados na tabela "pessoas"
    $sql = "INSERT INTO pessoas (nome_tb, sobrenome_tb, email_tb) VALUES ('$nome', '$sobrenome', '$email')";

    if ($conn->query($sql) === TRUE) {
        // Redireciona para o site do Google
        header("Location: https://www.google.com");
        exit(); // Certifica-se de que nenhum código adicional seja executado após o redirecionamento
    } else {
        echo "Erro ao cadastrar os dados: " . $conn->error;
    }

    // Fecha a conexão
    $conn->close();
} else {
    // Se o formulário não foi enviado, redireciona para a página de cadastro
    header("Location: index.php");
    exit();
}
?> 