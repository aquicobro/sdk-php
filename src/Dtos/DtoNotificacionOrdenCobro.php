<?php
declare(strict_types=1);

namespace AquiCobro\Sdk\Dtos;

use AquiCobro\Sdk\Exception;
use AquiCobro\Sdk\Datos;

class DtoNotificacionOrdenCobro
{
    /** @var string */
    public $tipoEnvio;

    /** @var string */
    public $solicitud;

    /** @var string */
    public $canal;

    /** @var string */
    public $destinatario;

    /** @var null|string */
    public $envio = null;

    /** @var bool */
    public $activa;

    /**
     * @param Datos $datos
     * @return DtoNotificacionOrdenCobro
     * @throws Exception
     */
    public static function fromDatos(Datos $datos): self
    {
        $dto = new self();
        $dto->tipoEnvio = $datos->getString('tipoEnvio');
        $dto->solicitud = $datos->getString('solicitud');
        $dto->canal = $datos->getString('canal');
        $dto->destinatario = $datos->getString('destinatario');
        $dto->envio = $datos->getStringOrNull('envio');
        $dto->activa = $datos->getBool('activa');
        return $dto;
    }
}
