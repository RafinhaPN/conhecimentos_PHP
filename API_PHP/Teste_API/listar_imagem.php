<?php
include './conexao/conexao.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: *");
header("Acess-Controll-Allow-Methods: GET,PUT,POST,DELETE");

$response_json = file_get_contents("php://input");

$dados =json_decode($response_json,true);
$response ="";

$sql = "SELECT * FROM album";
 $res = $conn->prepare($sql);
 $res->execute();

 if(($res) AND ($res->rowCount()!= 0)){
   
    while($row_contato = $res->fetch(PDO::FETCH_ASSOC)){
        extract($row_contato);
       // var_dump($row_contato);
    
        $lista_contato["results"][$id]=[
            'id'=> $id,
            'descricao'=>$descricao,
            'preco'=>$preco,
            'imagem'=>$imagem
        ];
     
    }

 }
http_response_code(200);
echo json_encode($lista_contato);

?>