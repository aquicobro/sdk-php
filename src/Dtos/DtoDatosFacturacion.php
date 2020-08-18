<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: w10
 * Date: 18/08/2020
 * Time: 12:39
 */

namespace AquiCobro\Sdk\Dtos;

use AquiCobro\Sdk\Datos;
use AquiCobro\Sdk\Exception;

class DtoDatosFacturacion
{
    /** @var string */
    public $condicionIva;

    /** @var string */
    public $tipoIdent;

    /** @var string */
    public $nroIdent;

    /** @var string */
    public $nombre;

    /** @var string */
    public $domicilio;

    /**
     * @param Datos $datos
     * @return DtoDatosFacturacion
     * @throws Exception
     */
    public static function fromDatos(Datos $datos): self
    {
        $dto = new self();
        $dto->condicionIva = $datos->getString('condicionIva');
        $dto->tipoIdent = $datos->getString('tipoIdent');
        $dto->nroIdent = $datos->getString('nroIdent');
        $dto->nombre = $datos->getString('nombre');
        $dto->domicilio = $datos->getString('domicilio');
        return $dto;
    }
}
