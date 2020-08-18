<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: w10
 * Date: 18/08/2020
 * Time: 12:59
 */

namespace AquiCobro\Sdk\Params;

class ParamsBuscarOrdenesCobro extends ParamsConsultaPaginada
{
    /**
     * ParamsBuscarOrdenesCobro constructor.
     * @param string|null $origen
     * @param string|null $referencia
     * @param ParamsPaginacion|null $paramsPaginacion
     */
    public function __construct(?string $origen, ?string $referencia, ?ParamsPaginacion $paramsPaginacion)
    {
        $data = [];
        if ($origen !== null) {
            $data['origen'] = $origen;
        }
        if ($referencia !== null) {
            $data['referencia'] = $referencia;
        }
        parent::__construct($data, $paramsPaginacion);
    }
}
