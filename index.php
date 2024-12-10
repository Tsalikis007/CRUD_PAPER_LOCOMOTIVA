<?php include('./conexao.php'); ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PHP</title>

    <!-- INCLUINDO O BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap');

        body {
            font-family: "Space Grotesk", sans-serif;
            background-color: #202124;
        }

        .container {
            margin-top: 3rem;
        }

        .m-0 {
            color: #0b5ed7;
            padding-right: 14rem;
            letter-spacing: 2px;
            font-weight: bold;
            text-shadow: 1px 1px 2px #202020;
        }

        .vagao-ms-0 {
            flex: 1;
            margin-left: 1rem;
        }

        .buttonCadastrar {
            display: flex;
            justify-content: center;
            height: 100px;
            padding-top: 15px;
        }

        .Cadastrar_Vagao {
            padding: 10px 20px;
            background-color: #0b5ed7;
            color: #FFF;
            font-size: 1.2rem;
            letter-spacing: 2px;
            border: none;
            border-radius: 5px;
            text-shadow: 1px 1px 2px #202020;
            transition: 0.3s ease-in-out;
            cursor: pointer;
        }

        .Cadastrar_Vagao:hover {
            opacity: 0.8;
        }

        .absolute-01,
        .absolute-02 {
            color: #0b5ed7;
            text-shadow: 1px 1px 3px #f8f9fa;
        }

        .absolute-02 {
            margin-bottom: 2rem;
        }

        .table-responsive {
            padding: 3rem 0;
        }

        .w-100 {
            padding: 1rem;
        }

        .espace {
            padding: 2rem 0;
        }

        .bt-0 a {
            text-decoration: none;
            color: #FFF;
        }

        .bt-0 {
            margin-right: 1rem;
        }
    </style>
</head>

<body>

    <?php
    // Incluir a conexão com o banco de dados primeiro
    include('./conexao.php');

    $pesquisa = $_POST['buscaa'] ?? '';

    $sql = "SELECT * FROM vagao WHERE nome LIKE '%$pesquisa%'";

    $dados = mysqli_query($conexao, $sql);
    ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
                    <div class="container-fluid">
                        <form action="index.php" class="d-flex justify-content-between align-items-center w-100" method="POST" role="search">
                            <div class="d-flex">
                                <input class="form-control me-0" style="width: 300px;" type="search" placeholder="Pesquisar" aria-label="Search" name="buscaa">
                            </div>
                            <div class="vagao-ms-0">
                                <button class="btn btn-outline-success ms-0" type="submit">Pesquisar</button>
                            </div>
                            <h2 class="m-0">Vagões</h2>
                            <button class="btn btn-primary bt-0">
                                <a href="dashboard.php">Cadastrar usuários</a>
                            </button>
                            <a href="logout.php" class="btn btn-danger">Sair do sistema</a>
                        </form>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Cor</th>
                    <th scope="col">Peso</th>
                    <th scope="col">Tipo do Vagão</th>
                    <th scope="col">Tamanho</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>

            <!-- Incluindo os dados do banco na tabela do navegador -->
            <tbody>

                <?php
                while ($linha = mysqli_fetch_assoc($dados)) {
                    $id = $linha['id'];
                    $nome = !empty($linha['nome']) ? $linha['nome'] : 'Não especificado';  // Verificando se nome está vazio
                    $cor =  $linha['cor'];
                    $peso =  $linha['peso'];
                    $tipo_do_vagao = $linha['tipo_do_vagao'];
                    $tamanho = $linha['tamanho'];

                    echo "<tr>
                            <th scope='row'>$id</th>
                            <td>$nome</td>
                            <td>$cor</td>
                            <td>$peso</td>
                            <td>$tipo_do_vagao</td>
                            <td>$tamanho</td>
                             <td><a href='editar.php?id=$id' class='btn btn-primary'>Editar</a></td>
                             <td><a href='deletar.php?id=$id' class='btn btn-danger'>Excluir</a></td>
                          </tr>";
                }
                ?>

            </tbody>
        </table>
    </div>

    <div class="buttonCadastrar"> <a href="./criar.php"><button class="Cadastrar_Vagao">Cadastrar vagão</button></a></div>

    <?php
    // Incluir a conexão com o banco de dados primeiro
    include('./conexao.php');

    $pesquisaa = $_POST['busca'] ?? '';

    $sql = "SELECT * FROM locomotiva WHERE nome LIKE '%$pesquisaa%'";

    $dados = mysqli_query($conexao, $sql);
    ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
                    <div class="container-fluid">
                        <form action="index.php" class="d-flex justify-content-between align-items-center w-100" method="POST" role="search">
                            <div class="d-flex">
                                <input class="form-control me-0" style="width: 300px;" type="search" placeholder="Pesquisar" aria-label="Search" name="busca">
                            </div>
                            <div class="vagao-ms-0">
                                <button class="btn btn-outline-success ms-0" type="submit">Pesquisar</button>
                            </div>
                            <h2 class="m-0">Locomotivas</h2>
                        </form>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Cor</th>
                    <th scope="col">Peso</th>
                    <th scope="col">Torque</th>
                    <th scope="col">Data de Criação</th>
                    <th scope="col">Usuário Criador</th>
                    <th scope="col">Data de Atualização</th>
                    <th scope="col">Usuário Atualizador</th>
                </tr>
            </thead>

            <tbody>
                <?php
                while ($linha = mysqli_fetch_assoc($dados)) {
                    $id = $linha['id'];
                    $nome = !empty($linha['nome']) ? $linha['nome'] : 'Não especificado';  // Verificando se nome está vazio
                    $cor =  $linha['cor'];
                    $peso =  $linha['peso'];
                    $torque = $linha['torque'];
                    $data_criacao = $linha['data_criacao'];
                    $user_criou = !empty($linha['user_criou']) ? $linha['user_criou'] : 'Não especificado'; // Verificação de campo vazio
                    $data_atualizacao = $linha['data_atualizacao'];
                    $user_atualizou = !empty($linha['user_atualizou']) ? $linha['user_atualizou'] : 'Não especificado'; // Verificação de campo vazio

                    echo "<tr>
                            <th scope='row'>$id</th>
                            <td>$nome</td>
                            <td>$cor</td>
                            <td>$peso</td>
                            <td>$torque</td>
                            <td>$data_criacao</td>
                            <td>$user_criou</td>
                            <td>$data_atualizacao</td>
                            <td>$user_atualizou</td>
                             <td><a href='editar_locomotiva.php?id=$id' class='btn btn-primary'>Editar</a></td>
                             <td><a href='delete_locomotiva.php?id=$id' class='btn btn-danger'>Excluir</a></td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="buttonCadastrar"> <a href="./criar_locomotiva.php"><button class="Cadastrar_Vagao">Cadastrar Locomotiva</button></a></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
