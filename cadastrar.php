<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="title">
            <h1>Cadastrar na Rede</h1>
        </div>

        <div class="inputs">
            <form id="registerForm">
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" id="name" name="name" required><br>
                </div>

                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required><br>
                </div>

                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" id="password" name="password" required><br>
                </div>

                <div class="botao">
                    <input type="submit" value="Cadastrar">
                </div>
            </form>
        </div>
        <p id="erro"></p>
        <div class="gatway">
            <a href="index.php">Faça Login</a>
        </div>
    </div>

    <script>
        document.getElementById("registerForm").addEventListener("submit", function(event) {
            event.preventDefault();

            var formData = new FormData(this);
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "cadastro.php", true);
            xhr.setRequestHeader("Accept", "application/json");

            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === "success") {
                        window.location.href = "https://www.google.com/";
                    } else {
                        document.getElementById("erro").textContent = response.message;
                    }
                }
            };

            xhr.send(formData);
        });
    </script>
</body>

</html>
