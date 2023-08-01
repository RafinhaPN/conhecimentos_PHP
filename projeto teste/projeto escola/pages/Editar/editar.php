<?php
include '../../conexao/conexao.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <title>Teste Empresa </title>
</head>

<body>

<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo "Detalhes do cliente" . $id;
    $cliente = Listar::ClienteUnico($id);
   }
      if (isset($_POST['btn'])) {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];
            $mensagem = $_POST['mensagem'];

               $cliente = Atualizar::Cliente($id,$nome,$email,$telefone,$mensagem);
                if ($cliente) {
        ?>
                    <div class="alert alert-primary text-center" role="alert">
                        <p>Atualizado com sucesso</p>
                    </div>
                <?php
                 
                } else {
                ?>
                    <p>Erro: ao atualizar</p>
                <?php
                }
                return;
            } else {
                ?>

        <?php
            }
     ?>

    <div class="container">
        <header>
            <nav class="navbar navbar-light bg-light">
                <a class="navbar-brand" href="#">Atualizar Cliente</a>
            </nav>
        </header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link" href="../Home/index.php">Voltar</a>
                </li>
            </ul>
        </nav>
        <form method="POST" action="#">
        <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">ID</label>
                <div class="col-sm-10">
                    <input type="hidden" name="nome" class="form-control" id="inputEmail3" value="<?php echo $cliente->id ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Nome</label>
                <div class="col-sm-10">
                    <input type="text" name="nome" class="form-control" id="inputEmail3" value="<?php echo $cliente->nome ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">E-mail</label>
                <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" id="inputPassword3" value="<?php echo $cliente->email ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Telefone</label>
                <div class="col-sm-10">
                    <input type="text" name="telefone" class="form-control" id="inputPassword3" value="<?php echo $cliente->telefone ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Mensagem</label>
                <div class="col-sm-10">
                    <input type="text" name="mensagem" class="form-control" id="inputPassword3" value="<?php echo $cliente->mensagem ?>">
                </div>
            </div>
            <input type="submit" name="btn" class="btn btn-primary mb-2" value="Atualizar" />
        </form>
        <?php //} 
        ?>
    </div>
</body>