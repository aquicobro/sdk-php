<?php
declare(strict_types=1);

use AquiCobro\Sdk\ClienteHttp;
use AquiCobro\Sdk\CobrosTiendaVirtual;

ob_start();

require __DIR__ . '/../vendor/autoload.php';

$tipo = (string) filter_input(INPUT_POST, 'tipo');
$idOrdenCobro = (string) filter_input(INPUT_POST, 'id');

if ($tipo !== 'cobro') {
    die();
}

$idApiKey = (string) filter_input(INPUT_ENV, 'idApiKey');
$secretoCliente = (string) filter_input(INPUT_ENV, 'secretoCliente');

$clienteAquiCobro = ClienteHttp::conCredenciales($idApiKey, $secretoCliente);
$cobrosTiendaVirtual = new CobrosTiendaVirtual($clienteAquiCobro);

try {
    $dtoCobroTiendaVirtual = $cobrosTiendaVirtual->obtenerOrdenCobro($idOrdenCobro);

    // buscar la compra con la referencia
    $compra = buscarCompraConReferencia($dtoCobroTiendaVirtual->referencia);

    if ($dtoCobroTiendaVirtual->cobrado >= $compra->total) {
        procesarCompraCompletada($compra);
    } else {
        procesarCompraIncompleta($compra);
    }

} catch (\AquiCobro\Sdk\Exception $exc) {
    error_log((string) $exc);
    echo "Ha ocurrido un error al obtener los datos de la orden de cobro {$idOrdenCobro}.";
}

function buscarCompraConReferencia(string $referencia)
{
    // TODO: buscar la compra con la referencia
    return null;
}

function procesarCompraCompletada($compra) {
    // TODO: procesar compra completada en caso de pago aprobado
}

function procesarCompraIncompleta($compra) {
    // TODO: procesar compra incompleta en caso de pago inferior al total o pago devuelto
}