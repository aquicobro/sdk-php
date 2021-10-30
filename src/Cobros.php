<?php
declare(strict_types=1);

namespace AquiCobro\Sdk;

use AquiCobro\Sdk\Dtos\DtoCobro;
use AquiCobro\Sdk\Dtos\DtoNuevoCobro;
use AquiCobro\Sdk\Params\ParamsNuevoCobro;

class Cobros
{
    /** @var ClienteHttp */
    private $clienteHttp;

    /**
     * Cobros constructor.
     * @param ClienteHttp $clienteHttp
     */
    public function __construct(ClienteHttp $clienteHttp)
    {
        $this->clienteHttp = $clienteHttp;
    }

    /**
     * @return ClienteHttp
     */
    public function getClienteHttp(): ClienteHttp
    {
        return $this->clienteHttp;
    }

    /**
     * @param ParamsNuevoCobro $params
     * @return DtoNuevoCobro
     * @throws Exception
     */
    public function nuevo(ParamsNuevoCobro $params): DtoNuevoCobro
    {
        $response = $this->getClienteHttp()->post('cobros/cobro', [], $params->toArray());
        return DtoNuevoCobro::fromDatos($this->getClienteHttp()->getDatos($response));
    }

    /**
     * @param string $idCobro
     * @return DtoCobro
     * @throws Exception
     */
    public function obtener(string $idCobro): DtoCobro
    {
        $query = ['idCobro' => $idCobro];
        $response = $this->getClienteHttp()->get('cobros/cobro', $query);
        $cobro = $this->getClienteHttp()->getDatos($response);
        return DtoCobro::fromDatos($cobro);
    }
}
