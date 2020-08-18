<?php
declare(strict_types=1);

namespace AquiCobro\Sdk;

use AquiCobro\Sdk\Dtos\DtoOrdenCobro;
use AquiCobro\Sdk\Dtos\DtoResOrdenesCobro;
use AquiCobro\Sdk\Params\ParamsBuscarOrdenesCobro;
use AquiCobro\Sdk\Params\ParamsNotificacionViaEmail;
use AquiCobro\Sdk\Params\ParamsNotificacionViaSms;

class OrdenesCobro
{
    /** @var ClienteHttp */
    private $clienteHttp;

    /**
     * OrdenesCobro constructor.
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
     * @param ParamsBuscarOrdenesCobro $params
     * @return DtoResOrdenesCobro
     * @throws Exception
     */
    public function buscar(ParamsBuscarOrdenesCobro $params): DtoResOrdenesCobro
    {
        $response = $this->getClienteHttp()->get('ordenes-cobro/buscar', $params->toArray());
        $datos = $this->getClienteHttp()->getDatos($response);
        return DtoResOrdenesCobro::fromDatos($datos);
    }

    /**
     * @param string $idOrdenCobro
     * @return DtoOrdenCobro
     * @throws Exception
     */
    public function obtener(string $idOrdenCobro): DtoOrdenCobro
    {
        $query = ['idOrdenCobro' => $idOrdenCobro];
        $response = $this->getClienteHttp()->get('ordenes-cobro/orden-cobro', $query);
        $ordenCobro = $this->getClienteHttp()->getDatos($response);
        return DtoOrdenCobro::fromDatos($ordenCobro);
    }

    /**
     * @param ParamsNotificacionViaEmail $params
     * @return void
     * @throws Exception
     */
    public function notificarViaEmail(ParamsNotificacionViaEmail $params): void
    {
        $this->clienteHttp->post('ordenes-cobro/notificacion-via-email', [], $params->toArray());
    }

    /**
     * @param ParamsNotificacionViaSms $params
     * @return void
     * @throws Exception
     */
    public function notificarViaSms(ParamsNotificacionViaSms $params): void
    {
        $this->clienteHttp->post('ordenes-cobro/notificacion-via-sms', [], $params->toArray());
    }
}
