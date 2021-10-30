<?php
declare(strict_types=1);

namespace AquiCobro\Sdk\Params;

use AquiCobro\Sdk\Params;

class ParamsNuevoCobroAutomatico extends Params
{
    /**
     * ParamsNuevoCobroAutomatico constructor.
     * @param ParamsClienteCobroAutomatico $cliente
     * @param string $concepto
     * @param string $referencia
     * @param float $importe
     * @param string $vencimiento
     * @param int|null $maxIntentos
     * @param string|null $primerIntento
     * @param string|null $urlPagoRealizado
     * @param string|null $urlPagoCancelado
     * @param string|null $urlPagoPendiente
     * @param string|null $urlNotificacionPago
     */
    public function __construct(
        ParamsClienteCobroAutomatico $cliente,
        string $concepto,
        string $referencia,
        float $importe,
        string $vencimiento,
        ?int $maxIntentos,
        ?string $primerIntento,
        ?string $urlPagoRealizado,
        ?string $urlPagoCancelado,
        ?string $urlPagoPendiente,
        ?string $urlNotificacionPago
    ) {
        parent::__construct(
            [
                'cliente' => $cliente->toArray(),
                'concepto' => $concepto,
                'referencia' => $referencia,
                'importe' => $importe,
                'vencimiento' => $vencimiento,
                'maxIntentos' => $maxIntentos,
                'primerIntento' => $primerIntento,
                'urlPagoRealizado' => $urlPagoRealizado,
                'urlPagoCancelado' => $urlPagoCancelado,
                'urlPagoPendiente' => $urlPagoPendiente,
                'urlNotificacionPago' => $urlNotificacionPago,
            ]
        );
    }
}
