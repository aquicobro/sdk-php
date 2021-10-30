<?php
declare(strict_types=1);

namespace AquiCobro\Sdk\Dtos\PagoCobro;

use AquiCobro\Sdk\Datos;
use AquiCobro\Sdk\Exception;

class DtoDatosTarjeta
{
    /** @var string */
    public $ultimosDigitos;

    /** @var string */
    public $tipoDoc;

    /** @var string */
    public $nroDoc;

    /** @var string */
    public $nombreTitular;

    /**
     * @param Datos $datos
     * @return DtoDatosTarjeta
     * @throws Exception
     */
    public static function fromDatos(Datos $datos): self
    {
        $dto = new self();
        $dto->ultimosDigitos = $datos->getString('ultimosDigitos');
        $dto->tipoDoc = $datos->getString('tipoDoc');
        $dto->nroDoc = $datos->getString('nroDoc');
        $dto->nombreTitular = $datos->getString('nombreTitular');
        return $dto;
    }
}
