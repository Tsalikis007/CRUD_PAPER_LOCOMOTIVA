<?php
session_start();
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conexao, $_POST['username']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

    // Consultar o banco de dados para verificar o usuário
    $sql = "SELECT * FROM usuarios WHERE username = '$username' LIMIT 1";
    $resultado = mysqli_query($conexao, $sql);
    
    if (mysqli_num_rows($resultado) > 0) {
        $usuario = mysqli_fetch_assoc($resultado);

        // Verificar a senha
        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['username'] = $usuario['username'];
            $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];

            // Redirecionar de acordo com o tipo de usuário
            if ($_SESSION['tipo_usuario'] == 'admin') {
                header("Location: dashboard.php");
            }  else if ($_SESSION['tipo_usuario'] == 'usuario'){
                header("Location: index.php");
            }  else{
                echo("Esse usuário não existe!");
            }
            exit();
        } else {
            $erro = "Senha incorreta!";
        }
    } else {
        $erro = "Usuário não encontrado!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap');
    html {height: 100%; width:100%}
    body{
        background-color:#212529;
        font-family: "Space Grotesk", sans-serif;
        background:-webkit-gradient(linear, 0% 0%, 0%, 100%, from(rgba(13,52,58,1)), to (#000000));
        background:-moz-linear-gradient(top, rgba(13,52,58,1) 0%, rgba(0,0,0,1) 100%);
        overflow: hidden;
    }

    .drop {
        background: #FFFFFF;
        width: 1px;
        height: 89px;
        position: absolute;
        bottom: 200px;
        -webkit-animation: fall  25s linear infinite;
        -moz-animation: fall  10s linear infinite;
   }

   .container{
        z-index:1;
        position: relative;
   }
   
   @-webkit-keyframes fall { to {margin-top: 700px;}}
   @-moz-keyframes fall { to {margin-top: 700px;}}
</style>
<body onload="createRain()">
    <section id="rain" class="rain">
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        
        <div class="card p-4" style="width: 400px;">
            <h2 class="text-center mb-4">Login</h2>

            <?php if (isset($erro)): ?>
                <div class="alert alert-danger"><?php echo $erro; ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Nome de Usuário</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>

        </div>
    </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        
        var nbDrop = 250;
   
   function randRange(maxNum, minNum) {
    return (Math.floor(Math.random(10) * (maxNum - minNum + 1)) + minNum);
   }
   
   function createRain() {
    for (i = 0; i < nbDrop; i++) {
     
     var dropLeft = randRange(0, 3000);
     var dropTop = randRange(-1000, 1000);
     $('.rain').append('<div class="drop" id="drop'+ i +'"></div>');
     $('#drop' + i).css('left', dropLeft);
     $('#drop' + i).css('top', dropTop); 
    }
   }
   settimeout(()=>{
    
   })
    </script>
</body>
</html>
