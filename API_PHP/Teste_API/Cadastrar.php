<?php
include './conexao/conexao.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: *");
//header("Acess-Controll-Allow-Methods: GET,PUT,POST,DELETE");

$response_json = file_get_contents("php://input");

$dados =json_decode($response_json,true);
$response ="";

if($dados){
  $sql = "INSERT INTO   login (usuario,email) VALUES(:usuario,:email)";
  $cad_usuario = $conn->prepare($sql);
  $cad_usuario->bindParam(':usuario',$dados['user']['usuario']);
  $cad_usuario->bindParam(':email',$dados['user']['email']);
  $cad_usuario->execute();   
  if($cad_usuario->rowCount())
  {
   //=========================== Gerando o Token ============================================
   /*    
   $header =[
            'alg' => 'HS256', //chave 256
            'typ' => 'JWT'
        ];
        // converter pra array em objeto
        $header = json_encode($header);

        //codificar em base64
        $header = base64_encode($header);

        $duracao = time() + (60);// 60 segundo
        
        $Data_Atual = Date("Y-m-d H:i:s")."<br>Vencimento: ".Date("Y-m-d H:i:s", $duracao)."<br>";
        
        //var_dump($dados['id']);

        $payload = [
          //dominio que ta Gerando
         //'iss' => 'localhost',
         //dominio que pode consumir
         //'aud' => 'localhost',
         //quando vence
         'exp' => $duracao,
         'id' => '1'
         // aqui voce pode acrescenta mais coisa do cliente id nome
      ];

            // converter pra array em objeto
      $payload = json_encode($payload);

      //codificar em base64
      $payload = base64_encode($payload);
     
      $chave = "ASDDFGHHJKLQWERTYYUIIOP";

      $signature = hash_hmac('sha256',"$header .$payload",$chave,true); //gerando a chave;

      //codificar em base64
         $signature = base64_encode($signature);


        */ 



   //==========================================================================================
          $response=[
            "error" => false,
            "mensagem"=> "Usuario cadastrado com sucesso!",
           // "Data" => $Data_Atual,
           // "Token" => $header.$payload.$signature
          ];
   }
     else
            {
              $response=[
                "error" => true,
                "mensagem"=> "Error: Usuario não cadastrado com sucesso!"
              ];
            }

} 
 else
      {
         
      }         

        
http_response_code(200);
echo json_encode($response);


?>