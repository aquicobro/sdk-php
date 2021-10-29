<?php
declare(strict_types=1);

namespace AquiCobro\Sdk\Dtos;

use AquiCobro\Sdk\Datos;
use AquiCobro\Sdk\Exception;

class DtoComprobanteEmitido
{
    /** @var string */
    public $idComprobante;

    /** @var string */
    public $cuitEmisor;

    /** @var string */
    public $tipoComprobante;

    /** @var string */
    public $nroComprobante;

    /** @var string */
    public $fechaEmision;

    /** @var float */
    public $total;

    /** @var boolean|null */
    public $autorizado;

    /**
     * @param Datos $datos
     * @return DtoComprobanteEmitido
     * @throws Exception
     */
    public static function fromDatos(Datos $datos): self
    {
        $dto = new self();
        $dto->idComprobante = $datos->getString('idComprobante');
        $dto->cuitEmisor = $datos->getString('cuitEmisor');
        $dto->tipoComprobante = $datos->getString('tipoComprobante');
        $dto->nroComprobante = $datos->getString('nroComprobante');
        $dto->fechaEmision = $datos->getString('fechaEmision');
        $dto->total = $datos->getFloat('total');
        $dto->autorizado = $datos->getBoolOrNull('autorizado');
        return $dto;
    }
}
