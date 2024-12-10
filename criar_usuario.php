<?php
session_start();

// Verifica se o usuário está autenticado e é um administrador
if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo_usuario'] != 'admin') {
    header("Location: login.php");
    exit();
}

include('conexao.php');  // Conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta os dados do formulário
    $username = mysqli_real_escape_string($conexao, $_POST['username']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);
    $tipo_usuario = mysqli_real_escape_string($conexao, $_POST['tipo_usuario']);
    
    // Criptografa a senha
    $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);

    // Insere o novo usuário no banco de dados
    $sql = "INSERT INTO usuarios (username, senha, tipo_usuario) VALUES ('$username', '$senha_criptografada', '$tipo_usuario')";
    
    if (mysqli_query($conexao, $sql)) {
        echo "Novo usuário criado com sucesso!";
    } else {
        echo "Erro ao criar o usuário: " . mysqli_error($conexao);
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Novo Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
       
    </style>
</head>
<body>

<div class="container mt-5">
    <h2>Criar Novo Usuário</h2>

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
            <select class="form-control" id="tipo_usuario" name="tipo_usuario" required>
                <option value="usuario">Usuário Comum</option>
                <option value="admin">Administrador</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Criar Usuário</button>
    </form>
</div>

</body>
</html>
