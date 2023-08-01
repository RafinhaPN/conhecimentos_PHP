<?php



header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: *");
header("Acess-Controll-Allow-Methods: GET,PUT,POST,DELETE");

include './conexao/conexao.php';

//define fuso horario padrao
date_default_timezone_set('America/Sao_Paulo');


$response_json = file_get_contents("php://input");

$dados = json_decode($response_json, true);
$response = "";

//echo password_hash(123456, PASSWORD_DEFAULT);



    //recupera os dados do usuario
    $sql = "SELECT id,nome,usuario,senha_usuario FROM usuarios
       WHERE usuario = :usuario
       LIMIT 1";
    // prepara a QUERY
    $result_query = $conn->prepare($sql);
    // substituir o link :usuario pelo valor
    $result_query->bindParam(":usuario", $dados['login']['usuario']);
    $result_query->execute();

    if (($result_query) && ($result_query->rowCount() != 0)) {

        $row_usuario = $result_query->fetch(PDO::FETCH_ASSOC);
        extract($row_usuario);
        //var_dump($row_usuario);

        //verifica       se a senha digitada        é igual a senha do banco   
        if (password_verify($dados['login']['senha'], $row_usuario['senha_usuario'])) {

                         

            //recupera a data atual
            $data = Date('Y-m-d H:i:s');

           

            //gerar numero randomico pra ser o codigo autentificacao
            $codigo_autentificacao =  mt_rand(100000, 999999);

           // var_dump($codigo_autentificacao);

         
               
        $contato = [
            'id' => $id,
            'nome' => $nome,
            'usuario' => $usuario,
            'senha' => $senha_usuario,
            "codigo_autentificação" => $codigo_autentificacao,
            "data Atual" => $data
        ];
        
        $response = [
            "erro" => false,
            "messagem" => "usuario encontrado!",
            "usuario" => $contato,
           
        ];
        



        } else {
          
        }
        
        //  atualiza o codigo autentificação no banco
        $query_up_usuario = "UPDATE  usuarios SET 
       codigo_autentificacao =:codigo_autentificacao,
       data_codigo_autentificacao =:data_codigo_autentificacao 
       WHERE id = :id 
       LIMIT 1 ";
        //prepara a Query
        $result_up_usuario  = $conn->prepare($query_up_usuario);
        $result_up_usuario->bindParam(':codigo_autentificacao', $codigo_autentificacao);
        $result_up_usuario->bindParam(':data_codigo_autentificacao', $data);
        //vem do banco de dados
        $result_up_usuario->bindParam(':id', $row_usuario['id']);
        $result_up_usuario->execute();
    } else {
        
   
    }


http_response_code(200);
echo json_encode($response);

?>
