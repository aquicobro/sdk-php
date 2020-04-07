<?php
declare(strict_types=1);

use AquiCobro\Sdk\ClienteHttp;
use AquiCobro\Sdk\CobrosTiendaVirtual;
use AquiCobro\Sdk\Params\ParamsNuevoCobroTiendaVirtual;

ob_start();

require __DIR__ . '/../vendor/autoload.php';

$idApiKey = (string) filter_input(INPUT_ENV, 'idApiKey');
$secretoCliente = (string) filter_input(INPUT_ENV, 'secretoCliente');

$clienteAquiCobro = ClienteHttp::conCredenciales($idApiKey, $secretoCliente);
$cobrosTiendaVirtual = new CobrosTiendaVirtual($clienteAquiCobro);

$concepto = 'Artículos varios';
$referencia = '1452'; // ej. Id de la compra [sirve para vincular con el sistema propio]
$importe = 150.50;
$vencimiento = date('c', strtotime('+10 minutes')); // en formato ISO-8601
$urlPagoRealizado = 'https://www.dominio.com/dir/subdir/pago-realizado';
$urlPagoCancelado = 'https://www.dominio.com/dir/subdir/pago-cancelado';
$urlPagoPendiente = 'https://www.dominio.com/dir/subdir/pago-pendiente';
$urlNotificacionPago = 'https://www.dominio.com/dir-secreto/subdir/procesar-notificacion-pago';

$params = new ParamsNuevoCobroTiendaVirtual(
    $concepto,
    $referencia,
    $importe,
    $vencimiento,
    $urlPagoRealizado,
    $urlPagoCancelado,
    $urlPagoPendiente,
    $urlNotificacionPago
);

try {
    $dtoCobroTiendaVirtual = $cobrosTiendaVirtual->nuevo($params);

    guardarIdOrdenCobro($dtoCobroTiendaVirtual->idOrdenCobro);

    // redireccionamos al formulario de pago
    header("Location: {$dtoCobroTiendaVirtual->urlBotonPago}");

} catch (\AquiCobro\Sdk\Exception $exc) {
    error_log((string) $exc);
    echo 'Ha ocurrido un error al crear la orden de cobro.';
}

function guardarIdOrdenCobro(string $idOrdenCobro): void {
    // TODO: Guardar el Id. de la orden de cobro para futuras referencias [opcional]
}