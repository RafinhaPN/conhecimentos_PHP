<?php
// composer tem esta instalado
//composer install
//composer -v
//composer init
// composer require chillerlan/php-qrcode


//incluir o composer


// cria a variavel destino pro QRCode


namespace chillerlan\QRCodeExamples;

use chillerlan\QRCode\{QRCode,QROptions};

include '../QRCode/vendor/autoload.php';

$url = 'https://outlook.live.com/mail/0/';

// imprimir um titulo
echo "<h2>Gerar QRCode da : $url</h2>";


// Gerando o QRCode
echo '<img src="'.(new QRCode)->render($url).'"alt="imagem" />'; 

?>