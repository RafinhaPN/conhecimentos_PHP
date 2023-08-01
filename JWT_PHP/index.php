<?php

echo "Gerando o token";
//1 Header indica o tipo do token "JWT",e o algoritmo utilizado "HS256"
$header =[
    'alg' => 'HS256', //chave 256
    'typ' => 'JWT'
];
// converter pra array em objeto
$header = json_encode($header);

//codificar em base64
$header = base64_encode($header);

echo "<br><br> Header : $header  <br><br>";


//2 payload é corpo do JWT recebe as informaçoes que precisa armazenar
// iss - o dominio da aplicação que gera o token
// aud - o define o dominio que pode usar o token
// exp - data de vencimento do token
// 7 days; 24hours; 60min;60secs

//$duracao = time() + (7 * 24 * 60 * 60); // valido por 7 dias

$duracao = time() + (10);// 60 segundo
echo "Data atual" .Date("Y-m-d H:i:s")."<br>Vencimento: ".Date("Y-m-d H:i:s", $duracao)."<br>";

// Gerar o payload
//array
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

//imprimir o payload
echo "<br><br> Payload : $payload  <br><br>";

//signature  header e o payload e codificar
//algoritmo sha256, junto com a chave
$chave = "ASDDFGHHJKLQWERTYYUIIOP";

//gera um valor de hash com chave o metodo HMAC
$signature = hash_hmac('sha256',"$header .$payload",$chave,true); //gerando a chave;

//codificar em base64
$signature = base64_encode($signature);

//imprimir o signature
echo "<br><br> Assinatura : $signature  <br><br>";

// imprimir o token
echo "token :$header.$payload.$signature";

//teste de validação
//https://jwt.io/








?>