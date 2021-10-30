<?php
declare(strict_types=1);

namespace AquiCobro\Sdk\Dtos\PagoCobro;

use AquiCobro\Sdk\Datos;
use AquiCobro\Sdk\Exception;

class DtoDatosTransferencia
{
    /** @var DtoOrdenanteTransferencia */
    public $ordenante;

    /** @var DtoReceptorTransferencia */
    public $receptor;

    /**
     * @param Datos $datos
     * @return DtoDatosTransferencia
     * @throws Exception
     */
    public static function fromDatos(Datos $datos): self
    {
        $dto = new self();
        $dto->ordenante = DtoOrdenanteTransferencia::fromDatos($datos->getDatos('ordenante'));
        $dto->receptor = DtoReceptorTransferencia::fromDatos($datos->getDatos('receptor'));
        return $dto;
    }
}
