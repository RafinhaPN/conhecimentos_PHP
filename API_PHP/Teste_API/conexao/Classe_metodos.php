<?php

abstract class BancoDados{
    const  host = 'localhost';
    const dbname = 'api_myapp';
    const user = 'root';
    const password = '';

    static function conectar(){
         try {
            $pdo = new PDO("mysql:
             host=".self::host.";
             dbname=".self::dbname.";
             charset=utf8",
             self::user,
             self::password);
             $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
             return $pdo;
         } catch (PDOException $e) {
             echo "Error : ".$e->getMessage();
         }
    }
}
$conexao = BancoDados::conectar();
if($conexao){
   //echo "conectado!";
}
abstract class Listar {
   static function Produtos (){
        try{
         $conexao = BancoDados::conectar();
        $sql = "SELECT id,nome,preco_compra,preco_venda,quantidade,situacao 
                  FROM produtos 
                  WHERE usuario_id = 3";
        $res = $conexao->prepare($sql);
        $res->execute();
        $listar = $res->fetch(PDO::FETCH_ASSOC);     
         if($listar){
             return $retorna =[
                'Error'=>false,
                'mensagem'=>'Produtos encontrado!'
                      
            ];
           
           
         }else{
            return $retorna =[
                'Error'=>true,
                'mensagem'=>'Nenhum produtos encontrado!',
            ];
            echo json_encode($retorna);
         }
        }catch(PDOException $e){
       echo "Error :".   $e->getMessage();
        }
     }
}



?>