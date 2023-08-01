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
  
    $sql = "INSERT INTO eleicao2022 (nome_canditado,numero_canditado) 
            VALUES(:nome_canditado,:numero_canditado)";
    $cad_canditado = $conn->prepare($sql);
    $cad_canditado->bindParam(':nome_canditado',$dados['canditado']['nome_canditado']);
    $cad_canditado->bindParam(':numero_canditado',$dados['canditado']['numero_canditado']);
    //$cad_canditado->bindParam(':voto_recebidos',$dados['canditado']['voto_recebidos']);
    $cad_canditado->execute();
    if($cad_canditado->rowCount()){
        $response=[
            "error" => false,
            "mensagem"=> "Canditado cadastrado com sucesso!",
           
          ];
    }else{
        $response=[
            "error" => true,
            "mensagem"=> "Error: Canditado não cadastrado com sucesso!",
            
          ];
    }   
  
   

}else{
    $response=[
        "error" => true,
        "mensagem"=> "Error: Tente mais tarde!",
        
      ];
}



http_response_code(200);
echo json_encode($response);

?>