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
    $sql = "INSERT INTO usuarios (nome,email)VALUES(:nome,:email)";
      $cad_Cliente = $conn->prepare($sql);
      $cad_Cliente->bindParam(':nome',$dados['cliente']['nome']);
      $cad_Cliente->bindParam(':email',$dados['cliente']['email']);
      $cad_Cliente->execute();  
      if($cad_Cliente->rowCount()){
           
        $response=[
            "error" => false,
            "mensagem"=> "Error: Cliente Cadsatrado com Sucesso!"
          ];
        
     
  
      }else{
        $response=[
            "error" => true,
            "mensagem"=> "Error: Cliente não Cadsatrado com Sucesso!"
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