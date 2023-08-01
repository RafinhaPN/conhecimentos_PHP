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

    

    $sql = "INSERT INTO times (nome)VALUES(:nome)";
    $cad_times = $conn->prepare($sql);
    $cad_times->bindParam(':nome',$dados['times']['nome']);
    $cad_times->execute(); 
    if($cad_times->rowCount()){
        $response=[
            "error" => false,
            "mensagem"=> "Error: Time Cadastrado com Sucesso!"
          ];
        
    }




}else{
    $response=[
        "error" => false,
        "mensagem"=> "Error: Servidor fora do ar tente mais tarde!"
      ];
}






?>