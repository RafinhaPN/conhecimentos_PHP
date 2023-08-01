<?php
abstract class BancoDados{

const  host = 'localhost';
const dbname = 'login_jwt';
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
   echo "conectado!";
}else{
    echo"Erro ao se conectar";
}

abstract class Cadastrar{
    static function Usuario($usuario,$senha){
     try {
        $conexao= BancoDados::conectar();
        $cadastrar = $conexao->prepare("INSERT INTO  login(usuario,senha)VALUES(:usuario ,:senha)");
        $cadastrar->bindValue(':usuario',$usuario);
        $cadastrar->bindValue(':senha',$senha);
        $cadastrar->execute();
        
       // return $cadastrar;
      
     } catch (PDOException $e) {
          echo "Error : ".$e->getMessage();
     }
   }
}
abstract class Listar{


    static function ClienteUnico($id){
        try {
            $conexao=BancoDados::conectar();
            $listar = $conexao->prepare('SELECT * FROM login WHERE id = :id');
            $listar->bindValue(':id',$id);
            $listar->execute();
            $listar = $listar->fetch(PDO::FETCH_OBJ);
            return $listar;   
          }catch (PDOException $e) {
             echo "Error : ".$e->getMessage();
         }
       }
    }

    $cliente = Listar::ClienteUnico(1);

    //var_dump($cliente);



?>