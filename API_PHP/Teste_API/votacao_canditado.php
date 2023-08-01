<?php
include './conexao/conexao.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: *");
header("Acess-Controll-Allow-Methods: GET,PUT,POST,DELETE");

$response_json = file_get_contents("php://input");

$dados =json_decode($response_json,true);
$response ="";

$sql = "UPDATE eleicao2022 set voto_recebidos = voto_recebidos + 1  WHERE id = :id ";
$voto_canditado = $conn->prepare($sql);
$voto_canditado->bindParam(':id',$dados['votando']['id']);
$voto_canditado->execute();
if($voto_canditado->rowCount()){
    $response=[
        "error" => false,
        "mensagem"=> "Canditado recebeu !".$dados['id'],
       
      ];
}else{
    $response=[
        "error" => true,
        "mensagem"=> "Error: Canditado não recebeu voto!",
        
      ];
}   







http_response_code(200);
echo json_encode($response);


?>