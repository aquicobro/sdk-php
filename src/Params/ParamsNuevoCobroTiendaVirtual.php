<?php
declare(strict_types=1);

namespace AquiCobro\Sdk\Params;

use AquiCobro\Sdk\Params;

class ParamsNuevoCobroTiendaVirtual extends Params
{
    /**
     * ParamsNuevoCobroTiendaVirtual constructor.
     * @param string $concepto
     * @param string|null $referencia
     * @param float $importe
     * @param string|null $vencimiento
     * @param string|null $urlPagoRealizado
     * @param string|null $urlPagoCancelado
     * @param string|null $urlPagoPendiente
     * @param string|null $urlNotificacionPago
     * @param ParamsClienteTiendaVirtual|null $cliente
     */
    public function __construct(
        string $concepto,
        ?string $referencia,
        float $importe,
        ?string $vencimiento,
        ?string $urlPagoRealizado,
        ?string $urlPagoCancelado,
        ?string $urlPagoPendiente,
        ?string $urlNotificacionPago,
        ParamsClienteTiendaVirtual $cliente = null
    ) {
        parent::__construct(
            [
                'concepto' => $concepto,
                'referencia' => $referencia,
                'importe' => $importe,
                'vencimiento' => $vencimiento,
                'urlPagoRealizado' => $urlPagoRealizado,
                'urlPagoCancelado' => $urlPagoCancelado,
                'urlPagoPendiente' => $urlPagoPendiente,
                'urlNotificacionPago' => $urlNotificacionPago,
                'cliente' => ($cliente !== null) ? $cliente->toArray() : null,
            ]
        );
    }
}
