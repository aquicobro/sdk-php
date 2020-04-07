<?php
declare(strict_types=1);

namespace AquiCobro\Sdk\Dtos;

use AquiCobro\Sdk\Exception;
use AquiCobro\Sdk\Datos;

class DtoCobroTiendaVirtual
{
    /** @var string */
    public $idOrdenCobro;

    /** @var string */
    public $creacion;

    /** @var string */
    public $creador;

    /** @var string */
    public $concepto;

    /** @var null|string */
    public $referencia = null;

    /** @var null|float */
    public $importe1 = null;

    /** @var null|string */
    public $venc1 = null;

    /** @var null|float */
    public $importe2 = null;

    /** @var null|string */
    public $venc2 = null;

    /** @var null|float */
    public $importe3 = null;

    /** @var null|string */
    public $venc3 = null;

    /** @var bool */
    public $pagosParciales;

    /** @var float */
    public $cobrado;

    /** @var string */
    public $ultActualizacion;

    /** @var DtoNotificacionOrdenCobro[] */
    public $notificaciones = [];

    /** @var DtoCobroOrdenCobro[] */
    public $cobros = [];

    /** @var bool */
    public $activa;

    /** @var bool */
    public $vigente;

    /** @var string */
    public $urlBotonPago;

    /** @var null|string */
    public $nombreGrupo = null;

    /** @var int */
    public $cantVenc;

    /** @var int */
    public $notifEmail;

    /** @var int */
    public $notifSms;

    /**
     * @param Datos $datos
     * @return DtoCobroTiendaVirtual
     * @throws Exception
     */
    public static function fromDatos(Datos $datos): self
    {
        $dto = new self();
        $dto->idOrdenCobro = $datos->getString('idOrdenCobro');
        $dto->creacion = $datos->getString('creacion');
        $dto->creador = $datos->getString('creador');
        $dto->concepto = $datos->getString('concepto');
        $dto->referencia = $datos->getStringOrNull('referencia');
        $dto->importe1 = $datos->getFloatOrNull('importe1');
        $dto->venc1 = $datos->getStringOrNull('venc1');
        $dto->importe2 = $datos->getFloatOrNull('importe2');
        $dto->venc2 = $datos->getStringOrNull('venc2');
        $dto->importe3 = $datos->getFloatOrNull('importe3');
        $dto->venc3 = $datos->getStringOrNull('venc3');
        $dto->pagosParciales = $datos->getBool('pagosParciales');
        $dto->cobrado = $datos->getFloat('cobrado');
        $dto->ultActualizacion = $datos->getString('ultActualizacion');
        $dto->notificaciones = $datos->getArrayDatos('notificaciones');
        foreach ($dto->notificaciones as $i => $item) {
            $dto->notificaciones[$i] = DtoNotificacionOrdenCobro::fromDatos($item);
        }
        $dto->cobros = $datos->getArrayDatos('cobros');
        foreach ($dto->cobros as $i => $item) {
            $dto->cobros[$i] = DtoCobroOrdenCobro::fromDatos($item);
        }
        $dto->activa = $datos->getBool('activa');
        $dto->vigente = $datos->getBool('vigente');
        $dto->urlBotonPago = $datos->getString('urlBotonPago');
        $dto->nombreGrupo = $datos->getStringOrNull('nombreGrupo');
        $dto->cantVenc = $datos->getInt('cantVenc');
        $dto->notifEmail = $datos->getInt('notifEmail');
        $dto->notifSms = $datos->getInt('notifSms');
        return $dto;
    }
}
