<?php

/* 
API
ENDPOINTS
http://localhost/API_PHP/API_POO/?funcao=create&nome=Felipe
http://localhost/API_PHP/API_POO/?funcao=read
http://localhost/API_PHP/API_POO/?funcao=update&nome=bolacha&id=1
http://localhost/API_PHP/API_POO/?funcao=delete&id=2
http://localhost/API_PHP/API_POO/?funcao=read_id&id=1

*/

require_once './Pessoa.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: *");


$data = [];

$funcao = $_REQUEST["funcao"] ?? null;
$id = $_REQUEST["id"] ?? 0;
$nome = $_REQUEST["nome"] ?? null;

$response ="";

$pessoa = new Pessoa;

$pessoa->setId($id);

if($funcao === "create" && $nome !== null)
{
    $pessoa->setNome($nome);
    $data['pessoa'] = $pessoa->create();
}

if($funcao === "read")
{
    $data['pessoa'] = $pessoa->read();
}

if($funcao === "read_id")
{
    $data['pessoa'] = $pessoa->read_id();
}



if($funcao === "update" && $id > 0 && $nome !== null)
{
    $pessoa->setNome($nome);
    $data['pessoa'] = $pessoa->update();
}

if($funcao === "delete" && $id > 0)
{
   
    $data['pessoa'] = $pessoa->delete();
}

http_response_code(200);
echo json_encode($data);

//var_dump(json_encode($data));

?>