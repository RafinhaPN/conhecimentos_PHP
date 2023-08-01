<?php
include './conexao/conexao.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: *");
header("Acess-Controll-Allow-Methods: GET,PUT,POST,DELETE");

$response_json = file_get_contents("php://input");

$dados =json_decode($response_json,true);
$response ="";


$id = filter_input(INPUT_GET,'id',FILTER_DEFAULT);

if(!empty($id)){
    $response =[
        "erro" => false,
        "mensagem" => "id encontrado com sucesso .$id"
   
    ];


    $sql = "SELECT  nome,Gols FROM  times 
    WHERE id = :id";
   $res =  $conn->prepare($sql);
   $res->bindParam(':id',$id);
   $res->execute();
   if(($res) AND ($res->rowCount()!= 0)){
    while($row_usuario = $res->fetch(PDO::FETCH_ASSOC)){
        extract($row_usuario);
       // var_dump($row_contato);
        $lista_times["results"][$id]=[
           'id'=> $id,
           'nome' =>$nome,
            'Gols'=>$Gols,
            
        ];
     
    }
    echo json_encode( $lista_times);
   }
    $sql = "SELECT  id,Pts,Gols,vitorias,empates,derrotas FROM jogos 
    WHERE id = :id";
   $res =  $conn->prepare($sql);
   $res->bindParam(':id',$id);
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

}else{
    $response =[
        "erro" => false,
        "mensagem" => "id não encontrado"
   
    ];
}

}

http_response_code(200);
echo json_encode($response);





?>