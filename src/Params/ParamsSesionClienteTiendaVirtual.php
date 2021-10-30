<?php
declare(strict_types=1);

namespace AquiCobro\Sdk\Params;

use AquiCobro\Sdk\Params;

class ParamsSesionClienteTiendaVirtual extends Params
{
    /**
     * ParamsSesionClienteTiendaVirtual constructor.
     * @param string $idSesion
     * @param string $ipCliente
     */
    public function __construct(string $idSesion, string $ipCliente)
    {
        parent::__construct(
            [
                'idSesion' => $idSesion,
                'ipCliente' => $ipCliente,
            ]
        );
    }
}
