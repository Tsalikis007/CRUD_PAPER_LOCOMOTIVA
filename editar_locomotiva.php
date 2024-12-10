<?php
include('./conexao.php');

// Exibir erros para depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verificando se o ID foi fornecido na URL
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conexao, $_GET['id']);

    // Consultando o banco usando o ID, e não o nome
    $sql = "SELECT * FROM locomotiva WHERE id = '$id'";
    $resultado = mysqli_query($conexao, $sql);

    if ($linha = mysqli_fetch_assoc($resultado)) {
        // Armazenando os dados para preencher o formulário
        $nome = $linha['nome'];
        $cor = $linha['cor'];
        $peso = $linha['peso'];
        $torque = $linha['torque'];
        $data_criacao = $linha['data_criacao'];
        $user_criou = $linha['user_criou'];
        $data_atualizacao = $linha['data_atualizacao'];
        $user_atualizou = $linha['user_atualizou'];
    } else {
        echo "Locomotiva não encontrada!";
        exit();
    }
} else {
    echo "ID não fornecido!";
    exit();
}

// Verificando se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pegando os dados enviados pelo formulário
    $novo_nome = $_POST['nome'];
    $nova_cor = $_POST['cor'];
    $novo_peso = $_POST['peso'];
    $novo_torque = $_POST['torque'];
    $nova_data_criacao = $_POST['data_criacao'];
    $novo_user_criou = $_POST['user_criou'];
    $nova_data_atualizacao = $_POST['data_atualizacao'];
    $novo_user_atualizou = $_POST['user_atualizou'];

    // Sanitizando os dados antes de atualizar no banco
    $novo_nome = mysqli_real_escape_string($conexao, $novo_nome);
    $nova_cor = mysqli_real_escape_string($conexao, $nova_cor);
    $novo_peso = mysqli_real_escape_string($conexao, $novo_peso);
    $novo_torque = mysqli_real_escape_string($conexao, $novo_torque);
    $nova_data_criacao = mysqli_real_escape_string($conexao, $nova_data_criacao);
    $novo_user_criou = mysqli_real_escape_string($conexao, $novo_user_criou);
    $nova_data_atualizacao = mysqli_real_escape_string($conexao, $nova_data_atualizacao);
    $novo_user_atualizou = mysqli_real_escape_string($conexao, $novo_user_atualizou);

    // Consulta SQL para atualizar o registro baseado no ID
    $sql_update = "UPDATE locomotiva SET 
        nome = '$novo_nome', 
        cor = '$nova_cor', 
        peso = '$novo_peso', 
        torque = '$novo_torque', 
        data_criacao = '$nova_data_criacao', 
        user_criou = '$novo_user_criou', 
        data_atualizacao = '$nova_data_atualizacao', 
        user_atualizou = '$novo_user_atualizou' 
        WHERE id = '$id'";

    if (mysqli_query($conexao, $sql_update)) {
        // Redireciona para a página principal após a atualização
        header("Location: index.php");
        exit();
    } else {
        echo "Erro ao atualizar o registro: " . mysqli_error($conexao);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Locomotiva</title>

    <!-- INCLUINDO O BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap');

        body {
            font-family: "Space Grotesk", sans-serif;
            background-color: #202124;
        }

        .outher-content {
            padding: 20px;
            background-color: #212529;
            box-shadow: 1px 1px 4px #f8f9fa;
        }

        .sub-title-vagao {
            color: #0b5ed7;
            letter-spacing: 2px;
            margin-bottom: 1rem;
            text-shadow: 1px 1px 2px #f8f9fa;
        }

        .form-label {
            color: #FFF;
            margin: 10px 0;
            letter-spacing: 2px;
        }

        .form-control {
            outline: none;
        }

        .btn-success,
        .btn-secondary {
            letter-spacing: 2px;
            margin: 20px 20px 10px 0px;
        }
    </style>
</head>

<body>

    <div class="container mt-5 outher-content">
        <h2 class="sub-title-vagao">Editar Locomotiva</h2>

        <form method="POST" action="editar_locomotiva.php?id=<?php echo urlencode($id); ?>">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $nome; ?>" required>
            </div>
            <div class="mb-3">
                <label for="cor" class="form-label">Cor</label>
                <input type="text" class="form-control" id="cor" name="cor" value="<?php echo $cor; ?>" required>
            </div>
            <div class="mb-3">
                <label for="peso" class="form-label">Peso</label>
                <input type="number" class="form-control" id="peso" name="peso" value="<?php echo $peso; ?>" step="any" required>
            </div>
            <div class="mb-3">
                <label for="torque" class="form-label">Torque</label>
                <input type="text" class="form-control" id="torque" name="torque" value="<?php echo $torque; ?>" required>
            </div>
            <div class="mb-3">
                <label for="data_criacao" class="form-label">Data de criacao</label>
                <input type="text" class="form-control" id="data_criacao" name="data_criacao" value="<?php echo $data_criacao; ?>" required>
            </div>

            <div class="mb-3">
                <label for="user_criou" class="form-label">Usuário Criador</label>
                <input type="text" class="form-control" id="user_criou" name="user_criou" value="<?php echo $user_criou; ?>" required>
            </div>

            <div class="mb-3">
                <label for="data_atualizacao" class="form-label">Data de atualização</label>
                <input type="text" class="form-control" id="data_atualizacao" name="data_atualizacao" value="<?php echo $data_atualizacao; ?>" required>
            </div>

            <div class="mb-3">
                <label for="user_atualizou" class="form-label">Usuário que atualizou</label>
                <input type="text" class="form-control" id="user_atualizou" name="user_atualizou" value="<?php echo $user_atualizou; ?>" required>
            </div>

            <button type="submit" class="btn btn-success">Atualizar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
