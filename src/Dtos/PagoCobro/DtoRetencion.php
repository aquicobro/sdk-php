<?php
declare(strict_types=1);

namespace AquiCobro\Sdk\Dtos\PagoCobro;

use AquiCobro\Sdk\Datos;
use AquiCobro\Sdk\Exception;

class DtoRetencion
{
    /** @var string */
    public $concepto;

    /** @var float */
    public $importe;

    /**
     * @param Datos $datos
     * @return DtoRetencion
     * @throws Exception
     */
    public static function fromDatos(Datos $datos): self
    {
        $dto = new self();
        $dto->concepto = $datos->getString('concepto');
        $dto->importe = $datos->getFloat('importe');
        return $dto;
    }
}
