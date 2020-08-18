<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: w10
 * Date: 18/08/2020
 * Time: 15:43
 */

namespace AquiCobro\Sdk\Dtos;

use AquiCobro\Sdk\Datos;
use AquiCobro\Sdk\Exception;

class DtoResultados
{
    /** @var int */
    public $desde;

    /** @var int */
    public $cant;

    /** @var int */
    public $total;

    /** @var Datos[] */
    public $items;

    /**
     * @param Datos $datos
     * @throws Exception
     */
    protected function setDatos(Datos $datos): void
    {
        $this->desde = $datos->getInt('desde');
        $this->cant = $datos->getInt('cant');
        $this->total = $datos->getInt('total');
        $this->items = $datos->getArrayDatos('items');
    }
}
