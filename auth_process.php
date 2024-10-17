<?php
require_once("globals.php");
require_once("db.php");

// Verifica se o formulário foi submetido e qual tipo de ação está sendo executada
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST['type']) && $_POST['type'] === 'login') {
        // Processamento do formulário de login
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            try {
                // Preparar a consulta SQL com parâmetros seguros
                $query = "SELECT * FROM autenticado WHERE email = :email AND senha = :password";
                $stmt = $conn->prepare($query);
                
                // Vincular parâmetros à consulta preparada
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $password);
                
                // Executar a consulta
                $stmt->execute();
                
                // Verificar se encontrou algum registro
                if ($stmt->rowCount() > 0) {
                    // Usuário autenticado com sucesso, pode redirecionar ou fazer qualquer outra ação necessária
                    // Por exemplo, definir uma sessão de usuário
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    session_start();
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['user_email'] = $row['email'];
                    header("Location: {$BASE_URL}dashboard.php");
                    exit();
                } else {
                    // Falha na autenticação
                    header("Location: {$BASE_URL}auth_login.php?error=invalid_credentials");
                    exit();
                }
            } catch (PDOException $e) {
                // Tratar erros de PDO
                header("Location: {$BASE_URL}auth_login.php?error=database_error");
                exit();
            }
        }
    } elseif (isset($_POST['type']) && $_POST['type'] === 'register') {
        // Processamento do formulário de registro
        if (isset($_POST['email']) && isset($_POST['name']) && isset($_POST['password']) && isset($_POST['confirmpassword'])) {
            $email = $_POST['email'];
            $name = $_POST['name'];
            $password = $_POST['password'];
            $confirmpassword = $_POST['confirmpassword'];
            
            // Verificar se as senhas coincidem
            if ($password !== $confirmpassword) {
                header("Location: {$BASE_URL}auth_cadastro.php?error=password_mismatch");
                exit();
            }
            
            try {
                // Verificar se o email já está registrado
                $query = "SELECT * FROM autenticado WHERE email = :email";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                
                if ($stmt->rowCount() > 0) {
                    header("Location: {$BASE_URL}auth_cadastro.php?error=email_taken");
                    exit();
                }
                
                // Inserir novo usuário no banco de dados
                $insert_query = "INSERT INTO autenticado (nome, sobrenome, email, mac_address) VALUES (:nome, :sobrenome, :email, :mac_address)";
                $mac_address = ''; // Defina o valor correto para o endereço MAC do usuário
                $stmt = $conn->prepare($insert_query);
                $stmt->bindParam(':nome', $name);
                $stmt->bindParam(':sobrenome', $sobrenome);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':mac_address', $mac_address);
                $stmt->execute();
                
                // Registro bem-sucedido, redireciona para a página de login
                header("Location: {$BASE_URL}auth_login.php?success=registered");
                exit();
            } catch (PDOException $e) {
                // Erro ao inserir no banco de dados
                header("Location: {$BASE_URL}auth_cadastro.php?error=database_error");
                exit();
            }
        }
    } else {
        // Tipo de ação inválido
        header("Location: {$BASE_URL}auth_login.php");
        exit();
    }
} else {
    // Redirecionar se o acesso direto ao script for tentado sem submissão de formulário
    header("Location: {$BASE_URL}auth_login.php");
    exit();
}
?>
