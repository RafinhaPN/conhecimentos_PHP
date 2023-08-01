<?php
include './conexao/conexao.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: *");
header("Acess-Controll-Allow-Methods: GET,PUT,POST,DELETE");

$response_json = file_get_contents("php://input");

$dados =json_decode($response_json,true);
$response ="";

if($dados){
     
    $arquivo = $_FILES['imagem'];
        
    // echo"<pre>";
   echo  var_dump($arquivo);


    $sql ="INSERT INTO  album (descricao,preco,imagem) VALUES(:descricao,:preco,:imagem)";
    $cad_foto = $conn->prepare($sql);
    $cad_foto->bindParam(':descricao',$dados['Album']['descricao']);
    $cad_foto->bindParam(':preco',$dados['Album']['preco']);
    $cad_foto->bindParam(':imagem',$arquivo['Album']['name']);
    $cad_foto->execute();
    if($cad_foto->rowCount()){
        $response=[
            "error" => false,
            "mensagem"=> "Dados enviado com sucesso!",
            "Dados" => $dados,
            "imagem" => $arquivo['name']
        ];
          
    }else{

    }
}else{
    $response=[
        "error" => true,
        "mensagem"=> "Error: Tente mais tarde!"
    ];
}




http_response_code(200);
echo json_encode($response);