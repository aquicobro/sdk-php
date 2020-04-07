<?php
declare(strict_types=1);

namespace AquiCobro\Sdk;

class Params
{
    /** @var array */
    private $data = [];

    /**
     * Params constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->data;
    }
}
