<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir Vagão</title>
   
    <!-- INCLUINDO O BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&display=swap');
        body{
            font-family: "Space Grotesk", sans-serif;
            background-color:#202124;
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

        .form-label{
            color:#FFF;
            margin:10px 0;
            letter-spacing: 2px;
        }

        .form-control{
            outline:none;
        }

        .btn-primary{
            letter-spacing: 2px;
            margin: 20px 20px 10px 0px;
        }
    </style>
</head>
<body>

<div class="container mt-5 outher-content">
    <h2 class="sub-title-vagao">Inserir Vagão</h2>

    <!-- Formulário de Inserção -->
    <form action="create.php" method="POST">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Vagão</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>
        <div class="mb-3">
            <label for="cor" class="form-label">Cor do Vagão</label>
            <input type="text" class="form-control" id="cor" name="cor" required>
        </div>
        <div class="mb-3">
            <label for="peso" class="form-label">Peso do Vagão</label>
            <input type="number" class="form-control" id="peso" name="peso" required>
        </div>
        <div class="mb-3">
            <label for="tipo_do_vagao" class="form-label">Tipo do Vagão</label>
            <input type="text" class="form-control" id="tipo_do_vagao" name="tipo_do_vagao" required>
        </div>
        <div class="mb-3">
            <label for="tamanho" class="form-label">Tamanho do Vagão</label>
            <input type="text" class="form-control" id="tamanho" name="tamanho" required>
        </div>
        <button type="submit" class="btn btn-primary">Inserir Vagão</button>
        <a href="./index.php" class="btn btn-primary">Voltar</a>
    </form>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>