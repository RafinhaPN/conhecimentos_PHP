<h1>Validar token </h1>

<form action="" method="post">
    <label for="">Token:</label>
    <input type="text" name="token"  >
   <input type="submit" name="btnVerificar" value="Verificação de token">
</form>

<?php
//validacao do token

$dados= filter_input_array(INPUT_POST,FILTER_DEFAULT);

if(!empty($dados['btnVerificar'])){
//var_dump($dados);

// converter em um array
$token_array = explode('.',$dados['token']);
echo"<br><pre>";
//var_dump($token_array);

//pegando os dados do array
$header= $token_array[0];
$payload= $token_array[1];
$signature=$token_array[2];


// pegar a mesma chave 
$chave = "ASDDFGHHJKLQWERTYYUIIOP";

// pra verificar 
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
 
echo "Data de Vencimento";
//var_dump($dados_token);

//compara a  data de vencimento com a data atual
//data for maior 
if($dados_token->exp > time()){
    echo" Data: Token valido ";
}else{
    echo"Data:  Token invalido , token vencido!";
}
////////////////////////////////////////////

 //echo"Token valido";

}else{

    echo"Token invalido";

}




}

?>