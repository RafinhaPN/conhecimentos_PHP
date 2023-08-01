<?php
include './conexao/conexao.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: *");
header("Acess-Controll-Allow-Methods: GET,PUT,POST,DELETE");

$response_json = file_get_contents("php://input");


$Gols = rand(1,3);

$id = rand(1,5);

$dados =json_decode($response_json,true);
$response ="";
     $sql = "UPDATE jogos set Gols = Gols + $Gols , Pts = Pts + 3,vitorias = vitorias + 1  WHERE id = $id ";
        $times = $conn->prepare($sql);
        //$times->bindParam(':id',$id);
        $times->execute();
        if($times->rowCount()){
            $response=[
                "error" => false,
                "mensagem"=> "Gols foi Feito !",
                 "gols" => $Gols
              ];

        }
  $sql = "SELECT  nome FROM  times 
WHERE id = $id";
$res =  $conn->prepare($sql);
$res->execute();
if(($res) AND ($res->rowCount()!= 0)){
    while($row_usuario = $res->fetch(PDO::FETCH_ASSOC)){
        extract($row_usuario);
       // var_dump($row_contato);
        $lista_times["results"][$id]=[
           'id'=> $id,
           'nome' =>$nome
           
            
        ];
     
    }
    echo json_encode( $lista_times);
}

    $sql="SELECT * FROM jogos ORDER BY Pts DESC";
    $res = $conn->prepare($sql);
    $res->execute();

    if(($res) AND ($res->rowCount()!= 0)){
        while($row_usuario = $res->fetch(PDO::FETCH_ASSOC)){
            extract($row_usuario);
           // var_dump($row_contato);
            $lista_dados["results"][$id]=[
               'id'=> $id,
               'Pontos'=> $Pts,
                'Gols'=>$Gols,
                'vitorias'=>$vitorias,
                'Empates'=>$empates,
                'Derrotas'=>$derrotas 
            ];
         
        }
         
        echo json_encode( $lista_dados);
    }

http_response_code(200);
echo json_encode($response);