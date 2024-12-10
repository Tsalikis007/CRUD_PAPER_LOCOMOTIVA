<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "crud_php";


// Defina a senha em texto claro
$senha_admin = 'admin123'; // A senha em texto claro

// Criptografe a senha
$senha_criptografada = password_hash($senha_admin, PASSWORD_DEFAULT);




$conexao = new mysqli($servidor, $usuario, $senha, $banco);


// Inserindo o usuário admin na tabela
$sql = "INSERT INTO usuarios (username, senha, tipo_usuario) VALUES ('admin', '$senha_admin', 'admin')";
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

?>
