<?php
declare(strict_types=1);

namespace AquiCobro\Sdk\Dtos;

use AquiCobro\Sdk\Datos;
use AquiCobro\Sdk\Exception;

class DtoMovimientoCuenta
{
    /** @var int */
    public $nroOrden;

    /** @var string */
    public $fechaHora;

    /** @var string */
    public $codMov;

    /** @var string */
    public $leyenda;

    /** @var float */
    public $debito;

    /** @var float */
    public $credito;

    /** @var boolean */
    public $conciliado;

    /** @var string|null */
    public $observaciones;

    /**
     * @param Datos $datos
     * @return DtoMovimientoCuenta
     * @throws Exception
     */
    public static function fromDatos(Datos $datos): self
    {
        $dto = new self();
        $dto->nroOrden = $datos->getInt('nroOrden');
        $dto->fechaHora = $datos->getString('fechaHora');
        $dto->codMov = $datos->getString('codMov');
        $dto->leyenda = $datos->getString('leyenda');
        $dto->debito = $datos->getFloat('debito');
        $dto->credito = $datos->getFloat('credito');
        $dto->conciliado = $datos->getBool('conciliado');
        $dto->observaciones = $datos->getStringOrNull('observaciones');
        return $dto;
    }
}
