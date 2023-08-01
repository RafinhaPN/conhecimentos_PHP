<?php
include './conexao/conexao.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: *");
header("Acess-Controll-Allow-Methods: GET,PUT,POST,DELETE");

$response_json = file_get_contents("php://input");

$dados =json_decode($response_json,true);
$response ="";

$sql = "SELECT * FROM eleicao2022";
 $res = $conn->prepare($sql);
 $res->execute();

 if(($res) AND ($res->rowCount()!= 0)){
   
    while($row_canditado = $res->fetch(PDO::FETCH_ASSOC)){
        extract($row_canditado);
       // var_dump($row_contato);
    
        $lista_canditado["results"][$id]=[
            'id'=> $id,
            'nome_canditado'=>$nome_canditado,
            'numero_canditado'=>$numero_canditado,
            'voto_recebidos'=>$voto_recebidos
        ];
     
    }
 }
    http_response_code(200);
    echo json_encode($lista_canditado);


?>