<?php

$host="localhost";
 $user="root";
 $pass="";
 $dbname="api_myapp";
 $port=3306;

 $conn = new PDO("mysql:host=$host;port=$port;dbname=".$dbname,$user,$pass);
 
 if($conn){
     //echo"conectado com sucesso!";
 }else{
     //echo"Erro ao se conectar!";
 }

?>