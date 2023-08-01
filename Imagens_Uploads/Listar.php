<?php
include './conexao/conexao.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Imagens</title>
</head>
<body>
    <h1>Listar Fotos :</h1><br>

    <?php
   $sql = "SELECT id,nome,imagem FROM album";
   $listar_fotos =  $conn->prepare($sql);
   $listar_fotos->execute();

   while($listar_foto = $listar_fotos->fetch(PDO::FETCH_ASSOC)){
    extract($listar_foto);
    //var_dump($listar_foto);
    echo "ID : $id   <br>";
    echo "NOME : $nome   <br>";
    echo "Foto : $imagem   <br>";
    echo "<img src='imagens/$id/$imagem'>";

  

}
 
    ?>


   
</body>
</html>


