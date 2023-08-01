<?php
include_once '../conexao/conexao.php';
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <title>Visualizar produto</title>
</head>

<body>
   <?php 
      include '../components/menu.php';
     ?>
  


    <?php
    $query_produto =  "SELECT id, name, description, price, image  FROM products WHERE id = :id LIMIT 1";
    $result_produto = $conn->prepare($query_produto);
    $result_produto->bindParam(':id', $id);
    $result_produto->execute();
    $row_produto = $result_produto->fetch(PDO::FETCH_ASSOC);
    extract($row_produto);
    $acrecimo_preco = ($price * 0.10) + $price;
    ?>
    <div class="container m-auto">
        <h1 class="display-4 mt-5 mb-5"><?php echo $name;  ?></h1>
        <div class="row">
            <div class="col-md-6">
                <img src='<?php echo "../imagem/$id/$image"; ?>' class="card-img-top mb-5" alt="...">
            </div>
            <div class="col-md-6">
                <p>De R$: <?php echo "R$:" . number_format($acrecimo_preco, 2, ",", "."); ?> </p>
                <p> Por R$: <?php echo "R$:" . number_format($price, 2, ",", "."); ?></p><br>
                <p class="m-1">
                    <a href="../pages/form_pagamento.php?id=<?php echo $id ?>" class="btn btn-primary m-2">Comprar</a>
                </p>
            </div>
            <div class="row">
                <div class="col-md-12 mt-5">
                    <?php echo $description;  ?>
                </div>
            </div>
        </div>
    </div>



    <script src="./js/scirpt.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

</body>

</html>