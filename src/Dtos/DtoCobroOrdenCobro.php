<?php
declare(strict_types=1);

namespace AquiCobro\Sdk\Dtos;

use AquiCobro\Sdk\Exception;
use AquiCobro\Sdk\Datos;

class DtoCobroOrdenCobro
{
    /** @var string */
    public $idCobro;

    /** @var string */
    public $creacion;

    /** @var float */
    public $importe;

    /** @var string */
    public $estado;

    /**
     * @param Datos $datos
     * @return DtoCobroOrdenCobro
     * @throws Exception
     */
    public static function fromDatos(Datos $datos): self
    {
        $dto = new self();
        $dto->idCobro = $datos->getString('idCobro');
        $dto->creacion = $datos->getString('creacion');
        $dto->importe = $datos->getFloat('importe');
        $dto->estado = $datos->getString('estado');
        return $dto;
    }
}
