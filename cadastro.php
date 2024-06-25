<?php
// Permite acesso de qualquer origem
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once "config.php";

$response = ["status" => "", "message" => ""];

// Verifica se houve envio via método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário e faz a limpeza dos dados
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST["password"];
    $mac_address = $_POST["mac_address"];

    // Hash da senha
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Verificar se o usuário já está cadastrado
        $sql_check = "SELECT id FROM users WHERE email = ?";
        $stmt_check = $conn->prepare($sql_check);
        if (!$stmt_check) {
            throw new Exception("Erro ao preparar a consulta: " . $conn->error);
        }
        $stmt_check->bind_param("s", $email);
        if (!$stmt_check->execute()) {
            throw new Exception("Erro ao executar a consulta: " . $stmt_check->error);
        }
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            // Usuário já cadastrado, exibe mensagem de erro
            $response["status"] = "error";
            $response["message"] = "Erro: Este e-mail já está cadastrado.";
        } else {
            // Inserir novo usuário se não estiver cadastrado
            $sql_insert = "INSERT INTO users (name, email, password, mac_address, registration_time) VALUES (?, ?, ?, ?, NOW())";
            $stmt_insert = $conn->prepare($sql_insert);
            if (!$stmt_insert) {
                throw new Exception("Erro ao preparar a inserção: " . $conn->error);
            }
            $stmt_insert->bind_param("ssss", $name, $email, $hashed_password, $mac_address);
            if (!$stmt_insert->execute()) {
                throw new Exception("Erro ao executar a inserção: " . $stmt_insert->error);
            }

            // Sucesso no cadastro
            $response["status"] = "success";
            $response["message"] = "Cadastro realizado com sucesso.";
        }

        // Fechar statement de verificação
        $stmt_check->close();

        // Fechar statement de inserção, se existir
        if (isset($stmt_insert)) {
            $stmt_insert->close();
        }
    } catch (Exception $e) {
        // Captura qualquer exceção e exibe mensagem de erro
        $response["status"] = "error";
        $response["message"] = "Erro no servidor: " . $e->getMessage();
    }
} else {
    // Método de requisição inválido
    $response["status"] = "error";
    $response["message"] = "Método de requisição inválido. Apenas POST é permitido.";
}

// Fechar conexão com o banco de dados
$conn->close();

// Retorna a resposta como JSON
echo json_encode($response);
?>
