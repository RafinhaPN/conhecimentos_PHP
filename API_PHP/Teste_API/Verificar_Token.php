<?php
include './conexao/conexao.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: *");
header("Acess-Controll-Allow-Methods: GET,PUT,POST,DELETE");

$response_json = file_get_contents("php://input");

$dados =json_decode($response_json,true);
$response ="";

 if(!$dados){
 $sql = "SELECT usuario,email FROM login";
 $res = $conn->prepare($sql);
 $res->execute();
  //================================= cabeçalho ===================================  
  $header =[
    'alg' => 'HS256', //chave 256
    'typ' => 'JWT'
];


  $header = json_encode($header);

  //codificar em base64
  $header = base64_encode($header);

  
  $duracao = time() + (10);// 60 segundo



  $Data_Atual = Date("Y-m-d H:i:s")."<br>Vencimento: ".Date("Y-m-d H:i:s", $duracao)."<br>";

  $payload = [
    'exp' => $duracao,
    'id' => $id
  ];


  $payload = json_encode($payload);

  //codificar em base64
  $payload = base64_encode($payload);

  $chave = "ASDDFGHHJKLQWERTYYUIIOP";
 
  $signature = hash_hmac('sha256',"$header .$payload",$chave,true); //gerando a chave;

  //codificar em base64
     $signature = base64_encode($signature);
 //=========================================================================================


   //verificação começar daqui
  $chave = "ASDDFGHHJKLQWERTYYUIIOP";

  $validar_assinatura = hash_hmac('sha256',"$header .$payload",$chave,true);
//codificar em base64
$validar_assinatura = base64_encode($validar_assinatura);

//agora verificar ou compara $signature com o $validar_assinatura 

if($signature == $validar_assinatura){
 ///////////////////////////////////////////   
    // verificar data de validade
    //decodificar em base64
$dados_token = base64_decode($payload);

// converter  objeto em array
$dados_token = json_decode($dados_token);
 
//echo "Data de Vencimento";
//var_dump($dados_token);

//echo "token :$header.$payload.$signature";

//compara a  data de vencimento com a data atual
//data for maior 
if($dados_token->exp > time()){
   
    if(($res) AND ($res->rowCount()!= 0))
    {
        while($row_contato = $res->fetch(PDO::FETCH_ASSOC))
        {
            extract($row_contato);
             $lista_contato["results"][$id]=[
                'id'=> $id,
                'usuario'=>$usuario,
                'email'=>$email,
                
            ];
        }

   }
   //var_dump($lista_contato);
  


   $response=[
    "error" => false,
    "Data"=>  $Data_Atual,
    "Token" => $header.$payload.$signature
     
  ];

}else{
    $response=[
        "error" => true,
        "mensagem"=> "Necessario Fazer o Cadastro pra logar se!",
        "Token"=> "inValido!",
        "Data"=>  $Data_Atual,
       
      ];
}


  //============================================================================
  
}
 }
http_response_code(200);
echo json_encode($response);
echo json_encode($lista_contato);



?>