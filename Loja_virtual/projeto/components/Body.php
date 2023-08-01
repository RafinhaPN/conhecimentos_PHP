<?php
include_once '../conexao/conexao.php';
/*  
            // echo "ID".$row_produto['id']."<br>";
            // echo "Nome".$row_produto['name']."<br>";
            extract($row_produto);
            echo "ID: $id <br> ";
            echo "Nome: $name <br> ";
            echo "Preço: " . number_format($price, 2, ",", ".") . "<br>";
            echo "<img src='./imagem/$id/$image'><br>";
           */
?>
<body>
<div class="container m-auto">
        <h1 class="display-4 mt-5 mb-5">Produtos</h1>
        <?php
        $query_produtos = "SELECT id, name, price, image  FROM  products ";
        $result_produtos = $conn->prepare($query_produtos);
        $result_produtos->execute();
        while ($row_produto = $result_produtos->fetch(PDO::FETCH_ASSOC)) {
            extract($row_produto);
        ?>
            <div class="row">
                <div class="col-sm-12 mb-3 mb-sm-0">
                    <div class="card-body text-center">
                        <div class="card mb-2">
                            <div class="card-body text-center">
                                <img src='<?php echo "../imagem/$id/$image"; ?>' class="card-img-top mb-5" alt="...">
                                <span> <?php echo $id; ?></span><br>
                                <span> <?php echo $name; ?></span><br>
                                <span> <?php echo "R$:" . number_format($price, 2, ",", "."); ?></span><br>
                                <a href="../pages/Detalhe_produto.php?id=<?php echo $id ?>" class="btn btn-primary m-2">Detalhes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            

        <?php
        }
        ?>
    </div>
