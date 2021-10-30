<?php
declare(strict_types=1);

namespace AquiCobro\Sdk\Dtos\PagoCobro;

use AquiCobro\Sdk\Datos;
use AquiCobro\Sdk\Exception;

class DtoReceptorTransferencia
{
    use TraitCuentaTransferencia;

    /**
     * @param Datos $datos
     * @return DtoReceptorTransferencia
     * @throws Exception
     */
    public static function fromDatos(Datos $datos): self
    {
        $dto = new self();
        $dto->setDatos($datos);
        return $dto;
    }
}
