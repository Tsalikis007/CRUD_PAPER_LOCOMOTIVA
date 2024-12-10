<?php
session_start();
include('conexao.php');

// Verifica se o usuário é admin
if ($_SESSION['tipo_usuario'] != 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['usuario']) && !empty($_POST['usuario'])) {
        $usuario_id = mysqli_real_escape_string($conexao, $_POST['usuario']);

        // Consulta para verificar se o usuário existe no banco
        $sql = "SELECT * FROM usuarios WHERE id = '$usuario_id' AND tipo_usuario != 'admin'";
        $resultado = mysqli_query($conexao, $sql);

        if (mysqli_num_rows($resultado) > 0) {
            // O usuário foi encontrado, agora podemos excluir
            $sql_delete = "DELETE FROM usuarios WHERE id = '$usuario_id'";

            if (mysqli_query($conexao, $sql_delete)) {
                $mensagem = "Usuário excluído com sucesso!";
            } else {
                $mensagem = "Erro ao excluir o usuário!";
            }
        } else {
            // O usuário não existe ou é um admin
            $mensagem = "Usuário não encontrado ou não pode ser excluído!";
        }
    } else {
        $mensagem = "Por favor, selecione um usuário para excluir!";
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

<div class="container mt-5">
    <h2>Painel de Administração</h2>

    <?php if (isset($mensagem)): ?>
        <div class="alert alert-info"><?php echo $mensagem; ?></div>
    <?php endif; ?>

    <a href="dashboard.php"><button class="btn btn-primary">Voltar ao painel</button></a>
    <a href="logout.php" class="btn btn-danger">Sair</a>
</div>

</body>
</html>
