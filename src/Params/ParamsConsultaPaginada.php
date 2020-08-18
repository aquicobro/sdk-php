<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: w10
 * Date: 18/08/2020
 * Time: 12:59
 */

namespace AquiCobro\Sdk\Params;

use AquiCobro\Sdk\Params;

class ParamsConsultaPaginada extends Params
{
    /**
     * ParamsConsultaPaginada constructor.
     * @param array $data
     * @param ParamsPaginacion|null $paramsPaginacion
     */
    public function __construct(array $data, ?ParamsPaginacion $paramsPaginacion)
    {
        if ($paramsPaginacion !== null) {
            $data = array_merge($data, $paramsPaginacion->toArray());
        }
        parent::__construct($data);
    }
}
