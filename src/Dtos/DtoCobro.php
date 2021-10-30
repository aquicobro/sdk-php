<?php
declare(strict_types=1);

namespace AquiCobro\Sdk\Dtos;

use AquiCobro\Sdk\Datos;
use AquiCobro\Sdk\Exception;

class DtoCobro
{
    /** @var string */
    public $idCobro;

    /** @var string */
    public $iniciador;

    /** @var DtoOrigenCobro */
    public $origen;

    /** @var string */
    public $creacion;

    /** @var string */
    public $concepto;

    /** @var string|null */
    public $referencia;

    /** @var float */
    public $importe;

    /** @var string|null */
    public $idOrdenCobro;

    /** @var DtoPagoCobro[] */
    public $pagos;

    /** @var DtoDatosFacturacion|null */
    public $datosFacturacion = null;

    /** @var DtoComprobanteEmitido|null */
    public $comprobanteEmitido = null;

    /** @var string */
    public $estado;

    /**
     * @param Datos $datos
     * @return DtoCobro
     * @throws Exception
     */
    public static function fromDatos(Datos $datos): self
    {
        $dto = new self();
        $dto->idCobro = $datos->getString('idCobro');
        $dto->iniciador = $datos->getString('iniciador');
        $dto->origen = DtoOrigenCobro::fromDatos($datos->getDatos('origen'));
        $dto->creacion = $datos->getString('creacion');
        $dto->concepto = $datos->getString('concepto');
        $dto->referencia = $datos->getStringOrNull('referencia');
        $dto->importe = $datos->getFloat('importe');
        $dto->idOrdenCobro = $datos->getStringOrNull('idOrdenCobro');
        $dto->pagos = $datos->getArrayDatos('pagos');
        foreach ($dto->pagos as $i => $item) {
            $dto->pagos[$i] = DtoPagoCobro::fromDatos($item);
        }
        $dto->datosFacturacion = $datos->getDatosOrNull('datosFacturacion');
        if ($dto->datosFacturacion !== null) {
            $dto->datosFacturacion = DtoDatosFacturacion::fromDatos($dto->datosFacturacion);
        }
        $dto->comprobanteEmitido = $datos->getDatosOrNull('comprobanteEmitido');
        if ($dto->comprobanteEmitido !== null) {
            $dto->comprobanteEmitido = DtoComprobanteEmitido::fromDatos($dto->comprobanteEmitido);
        }
        $dto->estado = $datos->getString('estado');
        return $dto;
    }
}
