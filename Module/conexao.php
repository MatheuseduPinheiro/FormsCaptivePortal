<!-- conexão.php -->
<?php
class Conexao
{
    private $conexao;

    function __construct()
    {
        $this->conexao = new mysqli("localhost", "root", "", "captiveportal");
        if ($this->conexao->connect_error) {
            throw new Exception("Erro na conexão com o banco de dados: " . $this->conexao->connect_error);
        }
        $this->conexao->set_charset("utf8mb4");
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    }

    public function setAllDataAndReturnId($nome, $email, $senha)
    {
        $sql = "INSERT INTO users (name_user, email, password) VALUES (?, ?, ?)";
        $senha_hash = password_hash($senha, PASSWORD_BCRYPT);
        $stmt = $this->conexao->prepare($sql);
        if (!$stmt) {
            throw new Exception("Erro na preparação da consulta: " . $this->conexao->error);
        }
        $stmt->bind_param("sss", $nome, $email, $senha_hash);
        if ($stmt->execute()) {
            return $stmt->insert_id;
        } else {
            return 0;
        }
    }

    public function getIdByEmailAndPassword($email, $senha)
    {
        $sql = "SELECT id, password FROM users WHERE email = ?";
        $stmt = $this->conexao->prepare($sql);
        if (!$stmt) {
            throw new Exception("Erro na preparação da consulta: " . $this->conexao->error);
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $senha_hash);
            $stmt->fetch();
            if (password_verify($senha, $senha_hash)) {
                return $id; // Retorna o ID se a senha estiver correta
            }
        }
        return 0;
    }

    public function updateLastLogin($id)
    {
        $sql = "UPDATE users SET last_login = NOW() WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        if (!$stmt) {
            throw new Exception("Erro na preparação da consulta: " . $this->conexao->error);
        }
        $stmt->bind_param("i", $id);
        return $stmt->execute(); // Retorna true em caso de sucesso
    }

    // Função para buscar dados do usuário pelo ID
    public function getUserDataById($id){
        // trocar no sql para nome msm
        $sql = "SELECT name_user , email, last_login FROM users WHERE id = ?";
        $stmt = $this->conexao->prepare($sql);
        if (!$stmt) {
            throw new Exception("Erro na preparação da consulta: " . $this->conexao->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc(); // Retorna um array associativo com os dados do usuário
        }
        return null; // Retorna null se o usuário não for encontrado
    }

    public function close()
    {
        if ($this->conexao) {
            $this->conexao->close();
        }
    }
}