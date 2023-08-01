<?php
// composer require cboden/ratchet
//pra roda php servidor_chat.php
//indica no composer.json
namespace Api\Websocket;

use Exception;
use Ratchet\ConnectionInterface;
use Ratchet\WebSocket\MessageComponentInterface;

class  sistemaChat implements MessageComponentInterface{
    // que não pode ser instanciado
    protected $cliente;
    //construtor
    public function __construct() 
    {
        // iniciar o objeto que deve armazenar os clientes conectados
       $this->cliente = new \SplObjectStorage; 
    }
   //Abrir conexao para o novo cliente
   // metodo publico pode ser instanciado
   public function onOpen(ConnectionInterface $conn)
   {
      // adiciona o cliente na lista
      $this->cliente->attach($conn);
      // frase sera impressa no terminal ok
         echo "novaa conexao: {$conn->resourceId}\n \n";
   }
   //enviar mensagem para todos os usuarios conectados
   public function onMessage(ConnectionInterface $from, $msg)
   {
     // percorre a lista de usuarios conectados
     foreach($this->cliente as $cliente){

        //não enviar a mensagem para i usuario que enviou a mensagem
           if($from !== $cliente){
     
          //envia a mensagem para todos os usuarios
           $cliente->send($msg);
           }
     
     }

     echo"usuario: {$from->resourceId} enviou uma mensagem \n\n";
   
   }
   //desconectar o cliente  do websocket
   public function onClose(ConnectionInterface $conn)
   {
      // fechar e retira o  cliente da listar
      $this->cliente->detach($conn);
   
      echo"usuario:{$conn->resourceId} desconectou.\n\n ";
   
    }

    //funcao que sera chamada caso ocorra algum erro no websocket
  
    public  function onError(ConnectionInterface $conn, Exception $e)
  {
    $conn->close();

    echo"Ocorreu um error: {$e->getMessage()} \n\n";
  }
   
}

   
?>