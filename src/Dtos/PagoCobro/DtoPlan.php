<?php
declare(strict_types=1);

namespace AquiCobro\Sdk\Dtos\PagoCobro;

use AquiCobro\Sdk\Datos;
use AquiCobro\Sdk\Exception;

class DtoPlan
{
    /** @var string */
    public $nombre;

    /** @var int */
    public $cuotas;

    /**
     * @param Datos $datos
     * @return DtoPlan
     * @throws Exception
     */
    public static function fromDatos(Datos $datos): self
    {
        $dto = new self();
        $dto->nombre = $datos->getString('nombre');
        $dto->cuotas = $datos->getInt('cuotas');
        return $dto;
    }
}
