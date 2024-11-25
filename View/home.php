<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    header("Location: ../View/auth_login.php"); // Redireciona para a página de login se não estiver logado
    exit;
}

require_once("../globals.php");
require_once("../Module/conexao.php");

// Aqui você pode incluir a lógica para buscar os dados do usuário
$c = new Conexao();
$userData = $c->getUserDataById($_SESSION['user_id']); // Busca os dados do usuário

// Verifica se os dados do usuário foram encontrados
if ($userData === null) {
    // Redireciona para a página de login se o usuário não for encontrado
    header("Location: ../View/auth_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="<?= htmlspecialchars($BASE_URL . '../css/style-home.css') ?>">
    <link rel="shortcut icon" href="<?= htmlspecialchars($BASE_URL . '../img/Ararajuba.jpeg') ?>" type="image/x-icon">
</head>

<body>
    <div class="container">
        <header class="navbar-container">
            <nav>
                <a href="#">
                    <img src="<?= htmlspecialchars($BASE_URL . '../img/Ararajuba.jpeg') ?>" alt="Logo VirtualTinga" class="logo">
                </a>
                <ul class="navbar-items">
                    <li>
                        <h1>Bem-vindo, <?php echo htmlspecialchars($userData['name_user']); ?>!</h1>
                    </li>
                </ul>

                <ul class="navbar-items-direita">
                    <li class="itens-direita"><a href="https://www.margalho.pro.br/site-escarlate/">
                            <h1>Grupo Escarlate</h1>
                        </a></li>
                    <li class="itens-direita"><a href="http://dgp.cnpq.br/dgp/espelhogrupo/0677840997008995">
                            <h1>CNPQ</h1>
                        </a></li>
                    <li class="itens-direita"><a href="https://stricto.unama.br/pt-br/conteudo/coordenacao">
                            <h1>PPAD</h1>
                        </a></li>
                    <li class="itens-direita"><a href="https://www.unama.br/">
                            <h1>UNAMA</h1>
                        </a></li>
                    <li class="itens-direita"><a href="https://ideflorbio.pa.gov.br/">
                            <h1>IDEFLOR</h1>
                        </a></li>

                </ul>
            </nav>
        </header>

        <main>
            <section class="main-banner">
                <div class="campo-banner">
                    <img src="<?= htmlspecialchars($BASE_URL . '../img/Templete-Virtualtinga.PNG') ?>" alt="Parque Estadual do Utinga">
                </div>
                <div class="banner-content">
                    <h1>VirtualTinga</h1>
                    <p>Jogo de realidade aumentada que promove a preservação e a biodiversidade amazônica no Parque Estadual do Utinga. O objetivo é ajudar na busca pela ararajuba perdida!</p>
                </div>
            </section>

            <section class="objetivos-container">
                <ul>
                    <li>
                        <i class="fas fa-tree"></i>
                        <h3>Preservação da Biodiversidade</h3>
                        <p>O Projeto Virtualtinga destaca a importância de preservar a biodiversidade, enfocando espécies ameaçadas como a Ararajuba. Com a realidade aumentada, é possível entender a complexidade dos ecossistemas e o impacto da extinção dessas espécies para o equilíbrio da natureza.</p>
                    </li>
                    <li>
                        <i class="fas fa-globe-americas"></i>
                        <h3>Conscientização Global</h3>
                        <p>Através de experiências imersivas, o projeto busca sensibilizar o público sobre a urgência da proteção ambiental. O uso de tecnologias inovadoras, como a realidade aumentada, traz uma nova perspectiva sobre a crise ambiental que afeta não apenas o Brasil, mas o planeta inteiro.</p>
                    </li>
                    <li>
                        <i class="fas fa-hand-holding-heart"></i>
                        <h3>Engajamento e Ação Coletiva</h3>
                        <p>O Virtualtinga não é apenas uma exposição, mas um convite à ação. Ao engajar o público em uma experiência interativa, incentivamos a participação ativa na conservação da natureza, promovendo iniciativas de preservação e apoio a políticas ambientais eficazes.</p>
                    </li>
                </ul>
            </section>

            <section class="patrocinadores-container">
                <h2>Parceiros do Projeto</h2>

                <p>O sucesso do Projeto Virtualtinga só é possível graças ao apoio fundamental de nossos parceiros, que compartilham nosso compromisso com a preservação ambiental e a promoção da educação sobre a biodiversidade. Juntos, buscamos um futuro mais sustentável para as próximas gerações.</p>
                <div class="parceiros-container">
                    <div class="parceiros-container">


                        <div class="parceiro">

                            <div class="campo-parceiro">
                                <img src="<?= htmlspecialchars($BASE_URL . '../img/logo-escarlate2-121x123.png') ?>" alt="Grupo Escarlate">
                            </div>
                        </div>

                        <div class="parceiro">

                            <div class="campo-parceiro">
                                <img src="<?= htmlspecialchars($BASE_URL . '../img/Unama.jpg') ?>" alt="UNAMA">
                            </div>
                        </div>


                        <div class="parceiro">

                            <div class="campo-parceiro">
                                <img src="<?= htmlspecialchars($BASE_URL . '../img/cnpq.jpg') ?>" alt="CNPQ">
                            </div>
                        </div>


                        <div class="parceiro">

                            <div class="campo-parceiro">
                                <img src="<?= htmlspecialchars($BASE_URL . '../img/Ideflor.png') ?>" alt="IDEFLOR">
                            </div>
                        </div>

                        <div class="parceiro">

                            <div class="campo-parceiro">
                                <img src="<?= htmlspecialchars($BASE_URL . '../img/PPAD.jpg') ?>" alt="PPAD">
                            </div>
                        </div>

                    </div>
            </section>


            <section class="membros-container">
                <h2>Membros do Projeto</h2>

                <p>O sucesso do Projeto Virtualtinga é resultado do empenho de uma equipe composta por Cientistas da Computação, dedicados ao avanço da ciência e à preservação ambiental.</p>

                <div class="membro">
                    <h3><a href="https://www.linkedin.com/in/mauromargalho" target="_blank" rel="noopener noreferrer">Professor Dr. Mauro Margalho Coutinho</a></h3>
                    <p>Orientador do projeto e coordenador do Grupo de Pesquisa Escarlate, que se dedica ao estudo de cidades inteligentes e à análise de infraestruturas emergentes de redes, com foco na aplicação de tecnologias para a sustentabilidade e inovação urbana.</p>
                </div>

                <div class="membro">
                    <h3><a href="https://www.linkedin.com/in/matheuseduardolima" target="_blank" rel="noopener noreferrer">Bolsista Matheus Eduardo Lima Pinheiro</a></h3>
                    <p>Pesquisador bolsista com foco em Redes de Computação e Cidades Inteligentes, explorando soluções tecnológicas para a sustentabilidade urbana.</p>
                </div>

                <div class="membro">
                    <h3><a href="https://www.linkedin.com/in/estherrochalima" target="_blank" rel="noopener noreferrer">Bolsista Esther Rocha Lima</a></h3>
                    <p>Pesquisadora bolsista, foco em Interação Humano-Computador (IHC), com ênfase no design de interfaces.</p>
                </div>
            </section>

            <section class="distribuição-apk-container">
                
            </section>
        </main>

        <footer>
            <p>&copy; VirtualTinga @ 2024</p>
        </footer>
    </div>
</body>

</html>