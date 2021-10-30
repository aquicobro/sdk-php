<?php
declare(strict_types=1);

namespace AquiCobro\Sdk\Params;

use AquiCobro\Sdk\Params;

class ParamsClienteTiendaVirtual extends Params
{
    /**
     * ParamsClienteTiendaVirtual constructor.
     * @param string $codigo
     * @param string $nombre
     * @param ParamsSesionClienteTiendaVirtual|null $sesion
     */
    public function __construct(string $codigo, string $nombre, ParamsSesionClienteTiendaVirtual $sesion = null)
    {
        parent::__construct(
            [
                'codigo' => $codigo,
                'nombre' => $nombre,
                'sesion' => ($sesion !== null) ? $sesion->toArray() : null,
            ]
        );
    }
}
