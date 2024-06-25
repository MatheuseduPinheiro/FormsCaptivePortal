<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/network-interface-card.png" type="image/x-icon">
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
                    <input type="text" name="name" required><br>
                </div>

                <div class="form-group">
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" required><br>
                </div>

                <div class="form-group">
                    <label for="password">Senha:</label>
                    <input type="password" name="password" required><br>
                </div>

                <input type="hidden" id="mac_address" name="mac_address">

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
        async function getMacAddress() {
            try {
                const response = await fetch('http://127.0.0.1:5000/api/get-mac-address');
                const data = await response.json();
                if (data.mac_address) {
                    document.getElementById('mac_address').value = data.mac_address;
                    console.log('MAC Address:', data.mac_address); // Adiciona um log para verificação
                } else {
                    console.error('Erro ao obter o endereço MAC:', data.error);
                }
            } catch (error) {
                console.error('Erro ao obter o endereço MAC:', error);
            }
        }

        document.getElementById('registerForm').addEventListener('submit', async function(event) {
            event.preventDefault();

            const form = event.target;
            const formData = new FormData(form);

            try {
                const response = await fetch('http://127.0.0.1:5000/api/get-mac-address');
                const macData = await response.json();
                if (macData.mac_address) {
                    formData.append('mac_address', macData.mac_address);

                    const submitResponse = await fetch('cadastro.php', {
                        method: 'POST',
                        body: formData
                    });

                    const result = await submitResponse.json();
                    const errorElement = document.getElementById('erro');
                    if (result.status === 'error') {
                        errorElement.textContent = result.message;
                        errorElement.style.color = 'red';
                    } else {
                        errorElement.textContent = result.message;
                        errorElement.style.color = 'green';
                        setTimeout(() => {
                            window.location.href = "https://www.margalho.pro.br/site-escarlate/";
                        }, 2000);
                    }
                } else {
                    console.error('Erro ao obter o endereço MAC:', macData.error);
                }
            } catch (error) {
                console.error('Erro ao enviar o formulário:', error);
            }
        });

        window.onload = getMacAddress;
    </script>
</body>

</html>

