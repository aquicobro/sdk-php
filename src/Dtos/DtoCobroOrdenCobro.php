<?php
declare(strict_types=1);

namespace AquiCobro\Sdk\Dtos;

use AquiCobro\Sdk\Datos;
use AquiCobro\Sdk\Exception;

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

    /** @var DtoDatosFacturacion|null */
    public $datosFacturacion = null;

    /** @var DtoComprobanteEmitido|null */
    public $comprobanteEmitido = null;

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
        $dto->datosFacturacion = $datos->getDatosOrNull('datosFacturacion');
        if ($dto->datosFacturacion !== null) {
            $dto->datosFacturacion = DtoDatosFacturacion::fromDatos($dto->datosFacturacion);
        }
        $dto->comprobanteEmitido = $datos->getDatosOrNull('comprobanteEmitido');
        if ($dto->comprobanteEmitido !== null) {
            $dto->comprobanteEmitido = DtoComprobanteEmitido::fromDatos($dto->comprobanteEmitido);
        }
        return $dto;
    }
}
