<?php
require "../third-party/phpqrcode/qrlib.php";

$datos = "Nombre:Cacho";
QRcode::png($datos,false,QR_ECLEVEL_L,8);

$ruta_qr = "./cacho.png";
$level = "Q";
$tamaño = 10;
$framSize = 3;
QRcode::png('texto', $ruta_qr, $level, $tamaño, $framSize);

?>
