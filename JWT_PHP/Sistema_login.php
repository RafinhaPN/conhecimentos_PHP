<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" 
    rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" 
    crossorigin="anonymous">
    <title>Login com token</title>
</head>
<body>


<?php
include './BancoDados.php';

  // echo  password_hash('12345',PASSWORD_DEFAULT);

   if(isset($_POST['btnCadastrar'])){
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
 
    if(!empty($usuario) && !empty($senha)){
       $usuario = Cadastrar::Usuario($usuario,MD5($senha));
       ?>
        <div class="alert alert-primary text-center" role="alert">
            <p>Usuario Cadastrado com sucesso!</p>
        </div>
      <?php
        
        return exit;
          
    }
    else{
        ?>
                    <div class=" container alert alert-danger text-center" role="alert">
                        <p>Preencha os campos corretamente</p>
                    </div>

        <?php
    }
        
   }



?>
<form class="container m-auto" action="" method="post">
     <h1>Login:</h1>
    <label for="">Usuario</label>
    <input type="text" name="usuario" ><br><br>
    <label for="">Senha</label>
    <input type="password" name="senha"><br><br>
    <input type="submit" name="btnCadastrar" value="Cadastrar">

</form>


</body>
</html>