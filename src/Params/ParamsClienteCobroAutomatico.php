<?php
declare(strict_types=1);

namespace AquiCobro\Sdk\Params;

use AquiCobro\Sdk\Params;

class ParamsClienteCobroAutomatico extends Params
{
    /**
     * ParamsClienteCobroAutomatico constructor.
     * @param string $codigo
     * @param string|null $nombre
     * @param string|null $email
     */
    public function __construct(string $codigo, ?string $nombre, ?string $email)
    {
        parent::__construct(
            [
                'codigo' => $codigo,
                'nombre' => $nombre,
                'email' => $email,
            ]
        );
    }
}
