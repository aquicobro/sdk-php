<?php
declare(strict_types=1);

namespace AquiCobro\Sdk\Params;

use AquiCobro\Sdk\Params;

class ParamsNuevoCobro extends Params
{
    /**
     * ParamsNuevoCobro constructor.
     * @param string $concepto
     * @param float $importe
     * @param string|null $referencia
     */
    public function __construct(
        string $concepto,
        float $importe,
        ?string $referencia
    ) {
        parent::__construct(
            [
                'concepto' => $concepto,
                'importe' => $importe,
                'referencia' => $referencia,
            ]
        );
    }
}
