<?php
declare(strict_types=1);

namespace AquiCobro\Sdk\Params;

use AquiCobro\Sdk\Params;

class ParamsNotificacionViaEmail extends Params
{
    /**
     * ParamsNotificacionViaEmail constructor.
     * @param string $idOrdenCobro
     * @param string|null $email
     */
    public function __construct(string $idOrdenCobro, string $email)
    {
        parent::__construct(
            [
                'idOrdenCobro' => $idOrdenCobro,
                'email' => $email,
            ]
        );
    }
}
