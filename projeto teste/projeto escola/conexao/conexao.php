<?php

abstract class BancoDados{

    const  host = 'localhost';
    const dbname = 'contatos';
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
}

abstract class Cadastrar{
    static function Cliente($nome,$mensagem,$email,$telefone){
        try {
            $conexao= BancoDados::conectar();
           $inserir = $conexao->prepare('INSERT INTO agenda (nome,email,telefone,mensagem)VALUES(:nome,:email,:telefone,:mensagem)');
           $inserir->bindValue(':nome',$nome); 
           $inserir->bindValue(':email',$email);
           $inserir->bindValue(':telefone',$telefone);  
           $inserir->bindValue(':mensagem',$mensagem);  
           $inserir->execute();
           
           
           return $inserir;
        }catch(PDOException  $e){
            echo "Error : ".$e->getMessage();
        }
    }
}
    abstract class Listar{
        static function Clientes(){
              try {
                $conexao=BancoDados::conectar();
                $listar = $conexao->prepare('SELECT * FROM agenda');
                $listar->execute();
                $listar = $listar->fetchAll(PDO::FETCH_OBJ);
                return $listar;   
              }catch (PDOException $e) {
                 echo "Error : ".$e->getMessage();
             }
        }

         static function ClienteUnico($id){
    try {
        $conexao=BancoDados::conectar();
        $listar = $conexao->prepare('SELECT * FROM agenda WHERE id = :id');
        $listar->bindValue(':id',$id);
        $listar->execute();
        $listar = $listar->fetch(PDO::FETCH_OBJ);
        return $listar;   
      }catch (PDOException $e) {
         echo "Error : ".$e->getMessage();
     }
   }
}   


abstract class Atualizar{
    static function Cliente($id,$nome,$email,$telefone,$mensagem){
        try {
        $conexao=BancoDados::conectar();//(nome,sobrenome,cpf,email,telefone
        $update = $conexao->prepare("UPDATE agenda SET  nome = :nome,email = :email, telefone = :telefone,  mensagem = :mensagem WHERE id = :id ");
            $update->bindValue(':id',$id);
            $update->bindValue(':nome',$nome);
            $update->bindValue(':email',$email);
            $update->bindValue(':telefone',$telefone);
            $update->bindValue(':mensagem',$mensagem);
            $update->execute();
        
        return $update;
            }catch (PDOException $e) {
                echo "Error : ".$e->getMessage();
            }
      }
   }

   abstract class Delete{
    static function cliente($id){
        try {
            $conexao=BancoDados::conectar();
            $delete = $conexao->prepare("DELETE FROM agenda WHERE id = :id");
            $delete->bindValue(':id',$id);
            $delete->execute();
        }catch (PDOException $e) {
            echo "Error : ".$e->getMessage();
        }
    }
}
