<?php
declare(strict_types=1);

namespace AquiCobro\Sdk\Dtos;

use AquiCobro\Sdk\Datos;
use AquiCobro\Sdk\Exception;

class DtoCobroTiendaVirtual
{
    use TraitOrdenCobro;

    /**
     * @param Datos $datos
     * @return DtoCobroTiendaVirtual
     * @throws Exception
     */
    public static function fromDatos(Datos $datos): self
    {
        $dto = new self();
        $dto->setDatos($datos);
        return $dto;
    }
}
