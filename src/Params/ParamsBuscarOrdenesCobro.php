<?php
declare(strict_types=1);

namespace AquiCobro\Sdk\Params;

class ParamsBuscarOrdenesCobro extends ParamsConsultaPaginada
{
    /**
     * ParamsBuscarOrdenesCobro constructor.
     * @param string|null $origen
     * @param string|null $referencia
     * @param ParamsPaginacion|null $paramsPaginacion
     * @param string|null $desde
     * @param string|null $hasta
     */
    public function __construct(
        ?string $origen,
        ?string $referencia,
        ?ParamsPaginacion $paramsPaginacion,
        string $desde = null,
        string $hasta = null
    ) {
        $data = [];
        if ($origen !== null) {
            $data['origen'] = $origen;
        }
        if ($desde !== null) {
            $data['desde'] = $desde;
        }
        if ($hasta !== null) {
            $data['hasta'] = $hasta;
        }
        if ($referencia !== null) {
            $data['referencia'] = $referencia;
        }
        parent::__construct($data, $paramsPaginacion);
    }
}
