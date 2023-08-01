<?php
include './conexao/conexao.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: *");
header("Acess-Controll-Allow-Methods: GET,PUT,POST,DELETE");

$response_json = file_get_contents("php://input");

$dados =json_decode($response_json,true);
$response ="";

   $sql = "SELECT * FROM usuarios  ORDER BY id DESC";
   $res =  $conn->prepare($sql);
   $res->execute();

   if(($res) AND ($res->rowCount()!= 0)){
    while($row_usuario = $res->fetch(PDO::FETCH_ASSOC)){
        extract($row_usuario);
       // var_dump($row_contato);
        $lista_usuario["results"][$id]=[
            'id'=> $id,
            'nome'=>$nome,
            'email'=>$email,
           
        ];
     
    }
   
    $response=[
      "error" => false,
      "mensagem"=> "Error: GRUPO A!"
    ];  

    echo json_encode($lista_usuario);
 }else{
 
 }
 
http_response_code(200);
echo json_encode($response);
?>