<?php
include '../../conexao/conexao.php';
$clientes = Listar::Clientes();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete = Delete::cliente($id);
    if($delete){
        ?>
        <div class="alert alert-danger text-center" role="alert">
        <p>Contato deletado com sucesso!</p>    
        </div>
        
        <?php
    }
    $clientes = Listar::Clientes();
}  
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <title>Teste Empresa Escola web </title>
</head>

<body>
    <div class="container">
        <header>
            <nav class="navbar navbar-light bg-light">
                <a class="navbar-brand" href="#">Listar Clientes</a>
            </nav>
        </header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link" href="../Home/index.php">Voltar</a>
                </li>
            </ul>
        </nav>
        <table class="table">
            <thead class="table-dark">
                <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Mensagem</th>
                    <th scope="col">Acões</th>
                </tr>
            </thead>
            <?php foreach ($clientes as $cliente) { ?>
            <tbody>
                <tr class="text-center">
                    <th scope="row">1</th>
                    <td><?php echo $cliente->nome ?></td>
                    <td><?php echo $cliente->email ?></td>
                    <td><?php echo $cliente->telefone ?></td>
                    <td><?php echo $cliente->mensagem ?></td>
                    <td>
                        <a href="../Editar/editar.php/?id=<?php echo $cliente->id; ?>">Editar</a>
                        <a href="?id=<?php echo $cliente->id; ?>">Apagar</a>
                    </td>
                </tr>
            </tbody>
            <?php } ?>
        </table>
        <div>
</body>