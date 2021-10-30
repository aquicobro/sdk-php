<?php
declare(strict_types=1);

namespace AquiCobro\Sdk\Dtos\PagoCobro;

use AquiCobro\Sdk\Datos;
use AquiCobro\Sdk\Exception;

class DtoLiquidacion
{
    /** @var string */
    public $presentacion;

    /** @var string */
    public $liquidacion;

    /** @var float */
    public $netoCobrar;

    /** @var float */
    public $cargo;

    /** @var float */
    public $comision;

    /** @var float */
    public $interes;

    /** @var string|null */
    public $nroMovAcreditacion;

    /** @var string|null */
    public $nroLiquidacion;

    /** @var DtoRetencion[] */
    public $retenciones;

    /**
     * @param Datos $datos
     * @return DtoLiquidacion
     * @throws Exception
     */
    public static function fromDatos(Datos $datos): self
    {
        $dto = new self();
        $dto->presentacion = $datos->getString('presentacion');
        $dto->liquidacion = $datos->getString('liquidacion');
        $dto->netoCobrar = $datos->getFloat('netoCobrar');
        $dto->cargo = $datos->getFloat('cargo');
        $dto->comision = $datos->getFloat('comision');
        $dto->interes = $datos->getFloat('interes');
        $dto->nroMovAcreditacion = $datos->getStringOrNull('nroMovAcreditacion');
        $dto->nroLiquidacion = $datos->getStringOrNull('nroLiquidacion');
        $dto->retenciones = $datos->getArrayDatos('retenciones');
        foreach ($dto->retenciones as $i => $item) {
            $dto->retenciones[$i] = DtoRetencion::fromDatos($item);
        }
        return $dto;
    }
}
