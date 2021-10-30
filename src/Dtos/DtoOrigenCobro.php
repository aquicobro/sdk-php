<?php
declare(strict_types=1);

namespace AquiCobro\Sdk\Dtos;

use AquiCobro\Sdk\Datos;
use AquiCobro\Sdk\Exception;

class DtoOrigenCobro
{
    /** @var string */
    public $codigo;

    /** @var string */
    public $descripcion;

    /**
     * @param Datos $datos
     * @return DtoOrigenCobro
     * @throws Exception
     */
    public static function fromDatos(Datos $datos): self
    {
        $dto = new self();
        $dto->codigo = $datos->getString('codigo');
        $dto->descripcion = $datos->getString('descripcion');
        return $dto;
    }
}
