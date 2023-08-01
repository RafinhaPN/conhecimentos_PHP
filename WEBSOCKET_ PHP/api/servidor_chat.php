<?php
// para da start o websocket

use Api\Websocket\sistemaChat;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;


require __DIR__. '/vendor/autoload.php';

// armazena a instancia do servidor
$server = IoServer::factory(
    //classe  conecta o cliente com o servidor
    new HttpServer(
        //classe fornece funcionalidade a websocket
        //permite a  comunicação birecional
        new WsServer(
            //minha classe
            new sistemaChat
        )
        ),
        8080, //porta 8080
    ); 

    // iniciar o servidor
  $server->run();


?>