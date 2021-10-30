<?php
declare(strict_types=1);

namespace AquiCobro\Sdk;

use AquiCobro\Sdk\Dtos\DtoCobroTiendaVirtual;
use AquiCobro\Sdk\Params\ParamsNuevoCobroTiendaVirtual;

class CobrosTiendaVirtual extends OrdenesCobro
{
    /**
     * @param ParamsNuevoCobroTiendaVirtual $params
     * @return DtoCobroTiendaVirtual
     * @throws Exception
     */
    public function nuevo(ParamsNuevoCobroTiendaVirtual $params): DtoCobroTiendaVirtual
    {
        $response = $this->getClienteHttp()->post('cuentas-virtuales/cobros-tienda-virtual', [], $params->toArray());
        return DtoCobroTiendaVirtual::fromDatos($this->getClienteHttp()->getDatos($response));
    }

    /**
     * @param string $idOrdenCobro
     * @return DtoCobroTiendaVirtual
     * @throws Exception
     * @deprecated Usar OrdenesCobro::obtener. En próximas versiones será eliminado.
     */
    public function obtenerOrdenCobro(string $idOrdenCobro): DtoCobroTiendaVirtual
    {
        $query = ['idOrdenCobro' => $idOrdenCobro];
        $response = $this->getClienteHttp()->get('ordenes-cobro/orden-cobro', $query);
        return DtoCobroTiendaVirtual::fromDatos($this->getClienteHttp()->getDatos($response));
    }
}
