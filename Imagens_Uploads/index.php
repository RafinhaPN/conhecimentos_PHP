<?php
include './conexao/conexao.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploads Imagens</title>
</head>
<body>
    <a href="Listar.php">Veja as Fotos</a>
    <h1>Uploads de imagem :</h1><br>

    <?php
      $dados = filter_input_array(INPUT_POST,FILTER_DEFAULT);
    


     if(!empty($dados['Salvar'])){
         $arquivo = $_FILES['imagem'];
        
       // echo"<pre>";
        var_dump($arquivo);


    $sql ="INSERT INTO  album (descricao,preco,imagem) VALUES(:descricao,:preco,:imagem)";
     $cad_foto = $conn->prepare($sql);
     $cad_foto->bindParam(':descricao',$dados['descricao']);
     $cad_foto->bindParam(':preco',$dados['preco']);
     $cad_foto->bindParam(':imagem',$arquivo['name']);
     $cad_foto->execute();
     if($cad_foto->rowCount()){
          // verifica se esta enviando a imagem
          // pra fazer o upload
          // e se esta com o nome o arquivo
          if((isset($arquivo['name'])) and (!empty($arquivo['name']))){
          
            // recupera o ultimo id
           $ultimo_id = $conn->lastInsertId();
          
            // diretorio onde o arquivo sera salvo
             //cada usuario tera seu proprio diretorio
             $diretorio = "imagens/ $ultimo_id /";
           
             //criar um diretorio
             mkdir($diretorio,0755);

             //fazer o upload do arquivo 
             $nome_arquivo = $arquivo['name'];

             move_uploaded_file($arquivo['tmp_name'],$diretorio . $nome_arquivo);
             echo"<p>upload realizado com sucesso e Salvo !</p>";
          }else{
            echo"<p> usuario Salvo com sucesso!</p>";
          }
     }else{
        echo"<p>Erro ao Salva</p>";
     }
     }
    ?>

    <form name="cad_usuario" method="POST" action="" enctype="multipart/form-data">
     <label for="">Descrição</label>
     <input type="text" name="descricao" placeholder="descrição..."><br><br>
     <label for="">Preço</label>
     <input type="number" name="preco"  placeholder="Preço..."><br><br>
     <label for="">Foto</label>
     <input type="file" name="imagem" id="foto"><br><br>
     <input type="submit" value="Uploads da Imagem" name="Salvar">
    </form>


</body>
</html>


