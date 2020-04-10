<?php
declare(strict_types=1);

namespace AquiCobro\Sdk\Params;

use AquiCobro\Sdk\Params;

class ParamsNotificacionViaSms extends Params
{
    /**
     * ParamsNotificacionViaSms constructor.
     * @param string $idOrdenCobro
     * @param string $codPais
     * @param string $codArea
     * @param string $nroLinea
     */
    public function __construct(string $idOrdenCobro, string $codPais, string $codArea, string $nroLinea)
    {
        parent::__construct(
            [
                'idOrdenCobro' => $idOrdenCobro,
                'codPais' => $codPais,
                'codArea' => $codArea,
                'nroLinea' => $nroLinea,
            ]
        );
    }
}
