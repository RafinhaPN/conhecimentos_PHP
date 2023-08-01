<?php

include '../conexao/Classe_metodos.php';


 $produtos = Listar ::Produtos();
    
 foreach($produtos as $produto){
    print_r($produto);
         
  }
   


?>