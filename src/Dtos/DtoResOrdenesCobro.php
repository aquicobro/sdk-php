<?php
declare(strict_types=1);

namespace AquiCobro\Sdk\Dtos;

use AquiCobro\Sdk\Datos;
use AquiCobro\Sdk\Exception;

class DtoResOrdenesCobro extends DtoResultados
{
    /** @var DtoOrdenCobro[] */
    public $items;

    /**
     * @param Datos $datos
     * @return DtoResOrdenesCobro
     * @throws Exception
     */
    public static function fromDatos(Datos $datos): self
    {
        $dto = new self();
        $dto->setDatos($datos);
        /** @var $item Datos */
        foreach ($dto->items as $i => $item) {
            $dto->items[$i] = DtoOrdenCobro::fromDatos($item);
        }
        return $dto;
    }
}
