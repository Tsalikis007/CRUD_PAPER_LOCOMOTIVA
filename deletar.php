<?php
include('./conexao.php');

if (isset($_GET['id'])) {
    // Garantir que o ID seja um número
    $id = intval($_GET['id']);  // Usando intval para garantir que seja um valor inteiro

   
    if ($id > 0) {
        $sql = "DELETE FROM vagao WHERE id = '$id'";

        echo "Consulta SQL: " . $sql . "<br>";  

        if (mysqli_query($conexao, $sql)) {
            header("Location: index.php");
            exit(); 
        } else {
            echo "Erro ao excluir o registro: " . mysqli_error($conexao);
        }
    } else {
        echo "ID inválido fornecido!";
    }
} else {
    echo "ID não fornecido!";
}
?>
