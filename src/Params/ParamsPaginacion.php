<?php
declare(strict_types=1);

namespace AquiCobro\Sdk\Params;

use AquiCobro\Sdk\Params;

class ParamsPaginacion extends Params
{
    /**
     * ParamsPaginacion constructor.
     * @param int|null $desde
     * @param int|null $limite
     */
    public function __construct(?int $desde, ?int $limite)
    {
        parent::__construct(
            [
                '_desde' => $desde,
                '_limite' => $limite,
            ]
        );
    }
}
