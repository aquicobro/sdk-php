<?php
declare(strict_types=1);

namespace AquiCobro\Sdk;

use AquiCobro\Sdk\Dtos\DtoCobroTiendaVirtual;
use AquiCobro\Sdk\Params\ParamsNuevoCobroTiendaVirtual;

class CobrosTiendaVirtual
{
    /** @var ClienteHttp */
    private $clienteHttp;

    /**
     * CobrosTiendaVirtual constructor.
     * @param ClienteHttp $clienteHttp
     */
    public function __construct(ClienteHttp $clienteHttp)
    {
        $this->clienteHttp = $clienteHttp;
    }

    /**
     * @param ParamsNuevoCobroTiendaVirtual $params
     * @return DtoCobroTiendaVirtual
     * @throws Exception
     */
    public function nuevo(ParamsNuevoCobroTiendaVirtual $params): DtoCobroTiendaVirtual
    {
        $response = $this->clienteHttp->post('cuentas-virtuales/cobros-tienda-virtual', [], $params->toArray());
        return DtoCobroTiendaVirtual::fromDatos($this->clienteHttp->getDatos($response));
    }

    /**
     * @param string $idOrdenCobro
     * @return DtoCobroTiendaVirtual
     * @throws Exception
     */
    public function obtenerOrdenCobro(string $idOrdenCobro): DtoCobroTiendaVirtual
    {
        $query = ['idOrdenCobro' => $idOrdenCobro];
        $response = $this->clienteHttp->get('/api/v1/ordenes-cobro/orden-cobro', $query);
        return DtoCobroTiendaVirtual::fromDatos($this->clienteHttp->getDatos($response));
    }
}
