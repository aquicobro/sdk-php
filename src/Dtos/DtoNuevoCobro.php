<?php
declare(strict_types=1);

namespace AquiCobro\Sdk\Dtos;

use AquiCobro\Sdk\Datos;
use AquiCobro\Sdk\Exception;

class DtoNuevoCobro
{
    /** @var string */
    public $idCobro;

    /** @var string */
    public $cobrador;

    /** @var string */
    public $creacion;

    /** @var string */
    public $concepto;

    /** @var string|null */
    public $referencia;

    /** @var float */
    public $importe;

    /** @var string */
    public $estado;

    /**
     * @param Datos $datos
     * @return DtoNuevoCobro
     * @throws Exception
     */
    public static function fromDatos(Datos $datos): self
    {
        $dto = new self();
        $dto->idCobro = $datos->getString('idCobro');
        $dto->cobrador = $datos->getString('cobrador');
        $dto->creacion = $datos->getString('creacion');
        $dto->concepto = $datos->getString('concepto');
        $dto->referencia = $datos->getStringOrNull('referencia');
        $dto->importe = $datos->getFloat('importe');
        $dto->estado = $datos->getString('estado');
        return $dto;
    }
}
