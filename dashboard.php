<?php
session_start();
include('conexao.php');

// Verifica se o usuário é admin
if ($_SESSION['tipo_usuario'] != 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conexao, $_POST['username']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);
    $tipo_usuario = mysqli_real_escape_string($conexao, $_POST['tipo_usuario']);

    // Criptografa a senha do novo usuário
    $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);

    // Insere o novo usuário no banco de dados
    $sql = "INSERT INTO usuarios (username, senha, tipo_usuario) 
            VALUES ('$username', '$senha_criptografada', '$tipo_usuario')";

    if (mysqli_query($conexao, $sql)) {
        $mensagem = "Usuário criado com sucesso!";
    } else {
        $mensagem = "Erro ao criar o usuário!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap');
        body{
            font-family: "Space Grotesk", sans-serif;
            background-color:#202124;
        }
        .flex{
            display:flex;
            align-items:center;
            justify-content:space-between;
        }

        .bt-0{
            margin-left:35rem;
        }

        .outher-content{
            padding: 20px;
            background-color:#212529;
            box-shadow: 1px 1px 4px #f8f9fa;
        }

        .sub-title-vagao{
            color: #0b5ed7;
            letter-spacing: 2px;
            margin-bottom:1rem;
            text-shadow: 1px 1px 2px #f8f9fa;
        }
        .paragrafo{
            margin-left:32rem;
            text-align:start;
        }
        .paragrafo, .form-label{
            color:#FFF;
            letter-spacing: 2px;
        }

        .btn-danger{
            margin:1rem 0;
            letter-spacing: 2px;
        }

        #usuario{
            background:#ADD8E6;
        }

        .create-btn{
            margin-top:10px;
            letter-spacing: 2px;
        }

        .btn-excluir{
            margin-top:20px;
        }
    </style>

    <div class="container mt-5 flex">
        <h2 class="sub-title-vagao">Painel de Administração</h2>
        
        <a href="index.php"><button class="btn btn-primary bt-0">Acessar o sistema</button></a>
        <a href="logout.php" class="btn btn-danger bt-0">Sair</a>
    </div>
    <p class="paragrafo">Bem-vindo, <?php echo $_SESSION['username']; ?>! Aqui você pode gerenciar o sistema.</p>

    <div class="container outher-content">


        <?php if (isset($mensagem)): ?>
            <div class="alert alert-info"><?php echo $mensagem; ?></div>
        <?php endif; ?>


        <?php

        $sql = "SELECT * FROM usuarios WHERE username = '$usuario'";
        $resultado = mysqli_query($conexao, $sql);
        $usuario = mysqli_fetch_assoc($resultado);


        ?>

        <?php
        // Consulta para buscar todos os usuários, exceto o admin
        $sql_usuarios = "SELECT * FROM usuarios WHERE tipo_usuario != 'admin'";
        $resultado_usuarios = mysqli_query($conexao, $sql_usuarios);
        ?>
        <h3>Criar Novo Usuário</h3>


        <form method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Nome de Usuário</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <div class="mb-3">
                <label for="tipo_usuario" class="form-label">Tipo de Usuário</label>
                <select class="form-control" id="tipo_usuario" name="tipo_usuario">
                    <option value="usuario">Usuário Comum</option>
                    <option value="admin">Administrador</option>
                </select>
            </div>


            <button type="submit" class="btn btn-primary create-btn">Criar Usuário</button>


        </form>
    </div>

    <div class="container mt-5 outher-content">
        <h3 class="sub-title-vagao">Excluir Usuário</h3>

        <form action="delete_user.php" method="POST">

            <label for="usuario" class="form-label">Escolha um usuário para excluir</label>
            <select class="form-control" id="usuario" name="usuario" required>
                <option value="" >Selecione um usuário</option>
                <?php
                // Exibe os usuários no dropdown
                while ($usuario = mysqli_fetch_assoc($resultado_usuarios)) {
                    echo '<option value="' . $usuario['id'] . '">' . $usuario['username'] . '</option>';
                }
                ?>
            </select>


            <button type="submit" class="btn btn-danger btn-excluir">Excluir Usuário</button>
        </form>

    </div>



</body>

</html>