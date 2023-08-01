<?php

session_start(); //iniciar a sessão


ob_start(); //limpa o buffer de saida

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <h2>Acessar o Chat</h2>
   
   <!-- receber os dados -->
  <?php
   $dados =  filter_input_array(INPUT_POST,FILTER_DEFAULT);

   if(!empty($dados['acessar'])){
    //var_dump($dados);
    
    //cria uma variavel global recebe  o dados['usuario']
    $_SESSION['usuario'] = $dados['usuario'];

    //fazer o redirecionamento

    header("Location: chat.php");

   }
  ?>


   <form action="" method="post">
    <label for="">Nome:</label>
    <input type="text" name="usuario" placeholder="nome do usuario"><br><br>

    <input type="submit" name="acessar" value="Acessar"><br><br>
   </form>

</body>
</html>