<?php
declare(strict_types=1);

namespace AquiCobro\Sdk\Dtos\PagoCobro;

use AquiCobro\Sdk\Datos;
use AquiCobro\Sdk\Exception;

class DtoMedioPago
{
    /** @var string */
    public $tipo;

    /** @var string */
    public $marca;

    /**
     * @param Datos $datos
     * @return DtoMedioPago
     * @throws Exception
     */
    public static function fromDatos(Datos $datos): self
    {
        $dto = new self();
        $dto->tipo = $datos->getString('tipo');
        $dto->marca = $datos->getString('marca');
        return $dto;
    }
}
