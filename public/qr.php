<?php
require "../third-party/phpqrcode/qrlib.php";


$level = "Q";
$tamaño = 8;
$framSize = 2;
$ruta="https//:localhost/perfil/perfil&idUsuario=".$_GET['id'];
QRcode::png($ruta, null, $level, $tamaño, $framSize);

?>
