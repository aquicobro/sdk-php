<?php
declare(strict_types=1);

namespace AquiCobro\Sdk;

use AquiCobro\Sdk\Dtos\DtoMovimientoCuenta;

class CuentaVirtual extends OrdenesCobro
{
    /**
     * @param int $timeDesde
     * @param int $timeHasta
     * @return DtoMovimientoCuenta[]
     * @throws Exception
     */
    public function obtenerMovimientos(int $timeDesde, int $timeHasta): array
    {
        $query = [
            'desde' => date('c', $timeDesde),
            'hasta' => date('c', $timeHasta),
        ];
        $response = $this->getClienteHttp()->get('cuentas-virtuales/movimientos', $query);
        $movimientos = $this->getClienteHttp()->getArrayDatos($response);
        foreach ($movimientos as $i => $item) {
            $movimientos[$i] = DtoMovimientoCuenta::fromDatos($item);
        }
        return $movimientos;
    }
}
