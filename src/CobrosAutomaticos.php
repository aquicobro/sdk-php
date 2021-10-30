<?php
declare(strict_types=1);

namespace AquiCobro\Sdk;

use AquiCobro\Sdk\Dtos\DtoOrdenCobro;
use AquiCobro\Sdk\Params\ParamsNuevoCobroAutomatico;

class CobrosAutomaticos extends OrdenesCobro
{
    /**
     * @param ParamsNuevoCobroAutomatico $params
     * @return DtoOrdenCobro
     * @throws Exception
     */
    public function nuevo(ParamsNuevoCobroAutomatico $params): DtoOrdenCobro
    {
        $response = $this->getClienteHttp()->post('cuentas-virtuales/cobros-automaticos', [], $params->toArray());
        return DtoOrdenCobro::fromDatos($this->getClienteHttp()->getDatos($response));
    }
}
