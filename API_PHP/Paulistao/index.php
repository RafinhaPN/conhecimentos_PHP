<?php
require '../conexao/conexao.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: *");
header("Acess-Controll-Allow-Methods: GET,PUT,POST,DELETE");

$response_json = file_get_contents("php://input");

$dados =json_decode($response_json,true);
$response ="";

try{
  $sql = "SELECT * FROM produtos WHERE id = :usuario_id";
  $res = $conn->prepare($ql);
  $res->execute();
   

}catch(PDOException $e){

}



http_response_code(200);
echo json_encode($response);



?>