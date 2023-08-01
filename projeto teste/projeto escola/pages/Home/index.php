<?php

include '../../conexao/conexao.php';

//$cliente = Cadastrar::Cliente($nome, $mensagem, $email, $telefone)


// ate achei pra usar , mas nunca usei esse tipo de ferramenta  o projeto esta funcionando
// o CRUD usei o PDO


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


include '../../vendor/autoload.php';

$mail = new PHPMailer(true);

try {


    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.example.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'user@example.com';                     //SMTP username
    $mail->Password   = 'secret';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;      

    //Recipients
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
    $mail->addAddress('ellen@example.com');               //Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');





    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>
<!DOCTYPE html>
<html lang="en">

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
                <a class="navbar-brand" href="#">Agenda Novo</a>
            </nav>
        </header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link" href="../Home/index.php">Voltar</a>
                </li>
               <li class="nav-item">
                    <a class="nav-link" href="../Listar/listar.php">Listar</a>
                </li>

            </ul>
        </nav>
        <?php
        if (isset($_POST['btn'])) {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];
            $mensagem = $_POST['mensagem'];

            if (!empty($nome) && !empty($email) && !empty($telefone) && !empty($mensagem)) {

                $cliente = Cadastrar::Cliente($nome, $mensagem, $email, $telefone);
                if ($cliente) {
        ?>
                    <div class="alert alert-info text-center" role="alert">
                        <p>Contato cadastrado com sucesso</p>
                    </div>
                <?php
                } else {
                ?>
                    <p>Erro: no cadastro</p>
                <?php
                }
                return;
            } else {
                ?>
                <div class="alert alert-danger text-center" role="alert">
                    <p>Preencha os campos corretamente</p>
                </div>

        <?php
            }
        }


        ?>


        <form method="POST" action="#">
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Nome</label>
                <div class="col-sm-10">
                    <input type="text" name="nome" class="form-control" id="inputEmail3">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">E-mail</label>
                <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" id="inputPassword3">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Telefone</label>
                <div class="col-sm-10">
                    <input type="text" name="telefone" class="form-control" id="inputPassword3">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Mensagem</label>
                <div class="col-sm-10">
                    <input type="text" name="mensagem" class="form-control" id="inputPassword3">
                </div>
            </div>
            <input type="submit" name="btn" class="btn btn-primary mb-2" value="Cadastrar" />
        </form>

    </div>

</body>