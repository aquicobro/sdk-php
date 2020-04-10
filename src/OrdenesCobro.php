<?php
declare(strict_types=1);

namespace AquiCobro\Sdk;

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
