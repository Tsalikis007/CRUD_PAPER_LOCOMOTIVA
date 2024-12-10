<?php
// Incluir a conexão com o banco de dados
include('./conexao.php');
include('./criar.php');

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Receber os dados do formulário
    $nome = $_POST['nome'];
    $cor = $_POST['cor'];
    $peso = $_POST['peso'];
    $tipo_do_vagao = $_POST['tipo_do_vagao'];
    $tamanho = $_POST['tamanho'];

    var_dump($_POST);

    // Preparar a consulta SQL para inserção
    $sql = "INSERT INTO vagao (nome, cor, peso, tipo_do_vagao, tamanho) 
            VALUES ('$nome', '$cor', '$peso', '$tipo_do_vagao', '$tamanho')";

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
                    Erro ao criar vagão: " . $conexao->error . "
                </div>
              </div>";
    }

    
}
?>

