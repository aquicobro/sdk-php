<?php
declare(strict_types=1);

namespace AquiCobro\Sdk\Dtos;

use AquiCobro\Sdk\Datos;
use AquiCobro\Sdk\Exception;

trait TraitOrdenCobro
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

    /** @var string|null */
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
     * @throws Exception
     */
    private function setDatos(Datos $datos): void
    {
        $this->idOrdenCobro = $datos->getString('idOrdenCobro');
        $this->creacion = $datos->getString('creacion');
        $this->creador = $datos->getString('creador');
        $this->concepto = $datos->getString('concepto');
        $this->referencia = $datos->getStringOrNull('referencia');
        $this->importe1 = $datos->getFloatOrNull('importe1');
        $this->venc1 = $datos->getStringOrNull('venc1');
        $this->importe2 = $datos->getFloatOrNull('importe2');
        $this->venc2 = $datos->getStringOrNull('venc2');
        $this->importe3 = $datos->getFloatOrNull('importe3');
        $this->venc3 = $datos->getStringOrNull('venc3');
        $this->pagosParciales = $datos->getBool('pagosParciales');
        $this->cobrado = $datos->getFloat('cobrado');
        $this->ultActualizacion = $datos->getString('ultActualizacion');
        $this->notificaciones = $datos->getArrayDatos('notificaciones');
        foreach ($this->notificaciones as $i => $item) {
            $this->notificaciones[$i] = DtoNotificacionOrdenCobro::fromDatos($item);
        }
        $this->cobros = $datos->getArrayDatos('cobros');
        foreach ($this->cobros as $i => $item) {
            $this->cobros[$i] = DtoCobroOrdenCobro::fromDatos($item);
        }
        $this->activa = $datos->getBool('activa');
        $this->vigente = $datos->getBool('vigente');
        $this->urlBotonPago = $datos->getStringOrNull('urlBotonPago');
        $this->nombreGrupo = $datos->getStringOrNull('nombreGrupo');
        $this->cantVenc = $datos->getInt('cantVenc');
        $this->notifEmail = $datos->getInt('notifEmail');
        $this->notifSms = $datos->getInt('notifSms');
    }
}
