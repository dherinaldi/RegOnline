<?php
$path = (getenv('MPDF_ROOT')) ? getenv('MPDF_ROOT') : __DIR__;
require_once $path . '/vendor/autoload.php';

//require_once __DIR__ . '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf([
    'debugfonts' => true,
]);

$mpdf->WriteHTML('<h1 >Hello world!</h1>');

$mpdf->Output();
?>