<?php
declare(strict_types=1);

namespace AquiCobro\Sdk\Dtos;

use AquiCobro\Sdk\Datos;
use AquiCobro\Sdk\Dtos\PagoCobro\DtoDatosTarjeta;
use AquiCobro\Sdk\Dtos\PagoCobro\DtoDatosTransferencia;
use AquiCobro\Sdk\Dtos\PagoCobro\DtoLiquidacion;
use AquiCobro\Sdk\Dtos\PagoCobro\DtoMedioPago;
use AquiCobro\Sdk\Dtos\PagoCobro\DtoPlan;
use AquiCobro\Sdk\Exception;

class DtoPagoCobro
{
    /** @var string */
    public $idPago;

    /** @var string */
    public $creacion;

    /** @var float */
    public $importe;

    /** @var DtoMedioPago */
    public $medioPago;

    /** @var DtoPlan */
    public $plan;

    /** @var DtoDatosTarjeta|null */
    public $datosTarjeta;

    /** @var DtoDatosTransferencia|null */
    public $datosTransferencia;

    /** @var string */
    public $estado;

    /** @var string|null */
    public $motivoRechazo;

    /** @var string|null */
    public $codAutorizacion;

    /** @var bool */
    public $firmado;

    /** @var string|null */
    public $urlReciboPago;

    /** @var string|null */
    public $urlReciboDevolucion;

    /** @var string[] */
    public $emailsEnviados;

    /** @var DtoLiquidacion|null */
    public $liquidacion = null;

    /**
     * @param Datos $datos
     * @return DtoPagoCobro
     * @throws Exception
     */
    public static function fromDatos(Datos $datos): self
    {
        $dto = new self();
        $dto->idPago = $datos->getString('idPago');
        $dto->creacion = $datos->getString('creacion');
        $dto->importe = $datos->getFloat('importe');
        $dto->medioPago = DtoMedioPago::fromDatos($datos->getDatos('medioPago'));
        $dto->plan = DtoPlan::fromDatos($datos->getDatos('plan'));
        $dto->datosTarjeta = $datos->getDatosOrNull('datosTarjeta');
        if ($dto->datosTarjeta !== null) {
            $dto->datosTarjeta = DtoDatosTarjeta::fromDatos($dto->datosTarjeta);
        }
        $dto->datosTransferencia = $datos->getDatosOrNull('datosTransferencia');
        if ($dto->datosTransferencia !== null) {
            $dto->datosTransferencia = DtoDatosTransferencia::fromDatos($dto->datosTransferencia);
        }
        $dto->estado = $datos->getString('estado');
        $dto->motivoRechazo = $datos->getStringOrNull('motivoRechazo');
        $dto->codAutorizacion = $datos->getStringOrNull('codAutorizacion');
        $dto->firmado = $datos->getBool('firmado');
        $dto->urlReciboPago = $datos->getStringOrNull('urlReciboPago');
        $dto->urlReciboDevolucion = $datos->getStringOrNull('urlReciboDevolucion');
        $dto->emailsEnviados = $datos->getArray('emailsEnviados', function ($item) {
            return (string) $item;
        });
        $dto->liquidacion = $datos->getDatosOrNull('liquidacion');
        if ($dto->liquidacion !== null) {
            $dto->liquidacion = DtoLiquidacion::fromDatos($dto->liquidacion);
        }
        return $dto;
    }
}
