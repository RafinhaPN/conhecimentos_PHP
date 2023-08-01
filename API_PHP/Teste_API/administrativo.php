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
  $sql = "INSERT INTO produtos (nome,preco_compra,preco_venda,quantidade,situacao,usuario_id) 
            VALUES(:nome,:preco_compra,:preco_venda,:quantidade,:situacao,:usuario_id)";
    $cad_produto = $conn->prepare($sql);
    $cad_produto->bindParam(':nome',$dados['produto']['nome']);
    $cad_produto->bindParam(':preco_compra',$dados['produto']['preco_compra']);
    $cad_produto->bindParam(':preco_venda',$dados['produto']['preco_venda']);
    $cad_produto->bindParam(':quantidade',$dados['produto']['quantidade']);
    $cad_produto->bindParam(':situacao',$dados['produto']['situacao']);
    $cad_produto->bindParam(':usuario_id',$dados['produto']['usuario_id']);
    $cad_produto->execute();  
    if($cad_produto->rowCount()){
         
      
    $response=[
      "error" => false,
      "mensagem"=> "Produto cadastrado com sucesso!"
    ];
      
   

    }else{
      $response=[
        "error" => false,
        "mensagem"=> "Produto não cadastrado com sucesso!"
      ];
    }
}else{
    
    $response=[
        "error" => true,
        "mensagem"=> "Error: Servidor não encontrado!"
      ];
}







http_response_code(200);
echo json_encode($response);
?>