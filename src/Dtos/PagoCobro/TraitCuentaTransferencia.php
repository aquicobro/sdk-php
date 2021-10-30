<?php
declare(strict_types=1);

namespace AquiCobro\Sdk\Dtos\PagoCobro;

use AquiCobro\Sdk\Datos;
use AquiCobro\Sdk\Exception;

trait TraitCuentaTransferencia
{
    /** @var string */
    public $tipoClave;

    /** @var string */
    public $claveUniforme;

    /** @var string */
    public $tipoIdent;

    /** @var string */
    public $nroIdent;

    /** @var string */
    public $nombre;

    /**
     * @param Datos $datos
     * @throws Exception
     */
    private function setDatos(Datos $datos): void
    {
        $this->tipoClave = $datos->getString('tipoClave');
        $this->claveUniforme = $datos->getString('claveUniforme');
        $this->tipoIdent = $datos->getString('tipoIdent');
        $this->nroIdent = $datos->getString('nroIdent');
        $this->nombre = $datos->getString('nombre');
    }
}
