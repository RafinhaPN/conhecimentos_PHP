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
    <title>Pagamentos</title>
</head>

<body>
     <?php 
      include '../components/menu.php';
     ?>
  
    
    <?php
    $query_produto = "SELECT id, name,  price FROM products WHERE id = :id LIMIT 1";
    $result_produto = $conn->prepare($query_produto);
    $result_produto->bindParam(':id', $id);
    $result_produto->execute();
    $row_produto = $result_produto->fetch(PDO::FETCH_ASSOC);
    //var_dump($row_produto);
    extract($row_produto);
    ?>
    <div class="container m-auto">

        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="" alt="" width="72" height="57">
            <h2>Formulario de Pagamento </h2>
            <p class="lead"> form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
        </div>
        <div class="row col-mb-5">
            <div class="col-md-8">
                <h3><?php echo $name; ?></h3>
            </div>
            <div class="col-md-4">
                <div class="mb-1 text-muted">
                    <p> Por R$: <?php echo "R$:" . number_format($price, 2, ",", "."); ?></p><br>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-3">Informações Pessoais</h4>
                <form class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">Nome</label>
                            <input type="text" 
                                   name="nome"
                                   class="form-control" id="firstName" 
                                   placeholder="Nome" 
                                   value="" required
                                >
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Sobrenome</label>
                            <input type="text"
                                   name="sobrenome" 
                                  class="form-control" 
                                  id="lastName" 
                                  placeholder="sobrenome" value="" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">CPF</label>
                            <input type="text"
                                     name="cpf" 
                                   class="form-control" 
                                   id="firstName" 
                                   placeholder="CPF - valido" 
                                   oninput="MaskCPF(this)"
                                   maxlength="14" 
                                   value="" required
                                  >
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Telefone</label>
                            <input type="text"
                                    name="telefone" 
                                   class="form-control" 
                                   id="lastName" 
                                   placeholder="numero pra contato" 
                                   oninput="MaskFone(this)"
                                   maxlength="14" 
                                   value="" required
                                 >
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" 
                                name="email"
                              class="form-control" 
                              id="email" 
                              placeholder="email valido" 
                              value="" required
                            >
                        <div class="invalid-feedback">
                            Valid last name is required.
                        </div>
                    </div>
                    <button class="btn btn-primary btn-lg mb-5 mt-5" type="submit">Enviar</button>
                </form>
            </div>
        </div>


    </div>


    <script src="./js/scirpt.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
</body>

</html>