<?php
// Incluir a conexão com o banco de dados
include('./conexao.php');
include('./criar_locomotiva.php');

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Receber os dados do formulário
    $nome = $_POST['nome'];
    $cor = $_POST['cor'];
    $peso = $_POST['peso'];
    $torque = $_POST['torque'];
    $data_criacao = $_POST['data_criacao'];
    $user_criou = $_POST['user_criou'];
    $data_atualizacao = $_POST['data_atualizacao'];
    $user_atualizou = $_POST['user_atualizou'];

    var_dump($_POST);

    // Preparar a consulta SQL para inserção
    $sql = "INSERT INTO locomotiva (nome, cor, peso, torque, data_criacao, user_criou, data_atualizacao, user_atualizou) 
            VALUES ('$nome', '$cor', '$peso', '$torque', '$data_criacao', '$user_criou',
            '$data_atualizacao', '$user_atualizou')";

    // Executar a consulta
    if ($conexao->query($sql) === TRUE) {
        echo "<div class='container mt-5'>
                <div class='alert alert-success' role='alert'>
                    Vagão criado com sucesso! <a href='index.php' class='alert-link'>Voltar para a tabela</a>.
                </div>
              </div>";
    } else {
        echo "<div class='container mt-5'>
                <div class='alert alert-danger' role='alert'>
                    Erro ao criar locomotiva: " . $conexao->error . "
                </div>
              </div>";
    }

    
}
?>

