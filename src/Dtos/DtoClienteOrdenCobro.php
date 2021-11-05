<?php
declare(strict_types=1);

namespace AquiCobro\Sdk\Dtos;

use AquiCobro\Sdk\Datos;
use AquiCobro\Sdk\Exception;

class DtoClienteOrdenCobro
{
    /** @var string */
    public $codigo;

    /** @var string */
    public $nombre;

    /** @var string|null */
    public $email;

    /** @var bool */
    public $cobroAutomatico;

    /**
     * @param Datos $datos
     * @return DtoClienteOrdenCobro
     * @throws Exception
     */
    public static function fromDatos(Datos $datos): self
    {
        $dto = new self();
        $dto->codigo = $datos->getString('codigo');
        $dto->nombre = $datos->getString('nombre');
        $dto->email = $datos->getStringOrNull('email');
        $dto->cobroAutomatico = $datos->getBool('cobroAutomatico');
        return $dto;
    }
}
