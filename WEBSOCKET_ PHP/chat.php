<?php

session_start(); //iniciar a sessão


ob_start(); //limpa o buffer de saida

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat websocket com PHP</title>
</head>
<body>
         <h2>Chat</h2>
            <!-- Imprimir o nome do usuario que esta na session da pagina index.php -->
  
        <p>Bem vindo : <span id="nome-usuario"><?php echo $_SESSION['usuario']; ?></span></p>

           <!-- campo pro usuario digitar a nova mensagem -->
         <label for="">Nova mensagem:</label>
         <input type="text" name="mensagem" id="mensagem" placeholder="digite a mensagem...">
         <br><br>

         <input type="button" onclick="enviar()" value="enviar"><br><br>



     <span id="mensagem-chat"></span> 

 <script>
  //recupera o id que deve receber a mensagem do chat
const mensagemChat = document.getElementById('mensagem-chat');

// endereço do websocket
 const ws = new WebSocket('ws://localhost:8080');

 //realizar a conexão com websocket
 ws.onopen =(e) =>{
    console.log("conectado");
 }
  
  //receber as mensagem do websocket
  ws.onmessage =(mensagemRecebida) =>{
     
    // ler as mensagem  enviada pelo websocket
   let resultado  =  JSON.parse(mensagemRecebida.data);

   

   //Enviar a mensagem pro HTML inserir no final da lista de mensagem
   // no caso esta recebendo a mensagem 
   // cria um formulario pra obter a mensagem recebida
       mensagemChat.insertAdjacentHTML('beforeend',`${resultado.mensagem} <br>`)

      
  }
  
  const enviar = () =>{
       // recupera do campo mensagem
    let mensagemUsuario  = document.getElementById('mensagem');
    
   

    // recupera o texto desse seletor
   let nome_usuario  = document.getElementById('nome-usuario').textContent;


    // cria array de dados pra enviar pro websocket
    //objeto dados
    let dados = {
        mensagem: `${nome_usuario}: ${mensagemUsuario.value} <br>`
       // mensagem: mensagemUsuario.value

    
    }
    
     
     
    
    //enviar a mensagem pra o websocket
    ws.send(JSON.stringify(dados))


    //Enviar a mensagem pro HTML inserir no final da lista de mensagem
    mensagemChat.insertAdjacentHTML('beforeend',`${nome_usuario}: ${mensagemUsuario.value} <br>`)
    
  
    //limpa o campo  mensagemUsuario
    mensagemUsuario.value = '';
  }

</script>
</body>
</html>