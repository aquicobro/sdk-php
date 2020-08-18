<?php
declare(strict_types=1);

namespace AquiCobro\Sdk;

class Datos
{
    /** @var array */
    private $datos;

    /**
     * Datos constructor.
     * @param array $datos
     */
    public function __construct(array $datos)
    {
        $this->datos = $datos;
    }

    /**
     * @param string $nombre
     * @return mixed
     * @throws Exception
     */
    public function getDato(string $nombre): Dato
    {
        if (!array_key_exists($nombre, $this->datos)) {
            throw new Exception(sprintf('Dato "%s" no encontrado.', $nombre));
        }
        return new Dato($nombre, $this->datos[$nombre]);
    }

    /**
     * @param string $nombre
     * @param callable|null $callable
     * @return array
     * @throws Exception
     */
    public function getArray(string $nombre, callable $callable = null): array
    {
        return $this->getDato($nombre)->getArray($callable);
    }

    /**
     * @param string $nombre
     * @param callable|null $callable
     * @return array
     * @throws Exception
     */
    public function getArrayOrNull(string $nombre, callable $callable = null): ?array
    {
        return $this->getDato($nombre)->getArrayOrNull($callable);
    }

    /**
     * @param string $nombre
     * @return bool
     * @throws Exception
     */
    public function getBool(string $nombre): bool
    {
        return $this->getDato($nombre)->getBool();
    }

    /**
     * @param string $nombre
     * @return bool
     * @throws Exception
     */
    public function getBoolOrNull(string $nombre): ?bool
    {
        return $this->getDato($nombre)->getBoolOrNull();
    }

    /**
     * @param string $nombre
     * @return float
     * @throws Exception
     */
    public function getFloat(string $nombre): float
    {
        return $this->getDato($nombre)->getFloat();
    }

    /**
     * @param string $nombre
     * @return float
     * @throws Exception
     */
    public function getFloatOrNull(string $nombre): ?float
    {
        return $this->getDato($nombre)->getFloatOrNull();
    }

    /**
     * @param string $nombre
     * @return int
     * @throws Exception
     */
    public function getInt(string $nombre): int
    {
        return $this->getDato($nombre)->getInt();
    }

    /**
     * @param string $nombre
     * @return int
     * @throws Exception
     */
    public function getIntOrNull(string $nombre): ?int
    {
        return $this->getDato($nombre)->getIntOrNull();
    }

    /**
     * @param string $nombre
     * @return string
     * @throws Exception
     */
    public function getString(string $nombre): string
    {
        return $this->getDato($nombre)->getString();
    }

    /**
     * @param string $nombre
     * @return string
     * @throws Exception
     */
    public function getStringOrNull(string $nombre): ?string
    {
        return $this->getDato($nombre)->getStringOrNull();
    }

    /**
     * @param string $nombre
     * @return Datos
     * @throws Exception
     */
    public function getDatos(string $nombre): Datos
    {
        return new Datos($this->getArray($nombre));
    }

    /**
     * @param string $nombre
     * @return Datos|null
     * @throws Exception
     */
    public function getDatosOrNull(string $nombre): ?Datos
    {
        $datos = $this->getArrayOrNull($nombre);
        if ($datos === null) {
            return null;
        }
        return new Datos($datos);
    }

    /**
     * @param string $nombre
     * @return Datos[]
     * @throws Exception
     */
    public function getArrayDatos(string $nombre): array
    {
        $array = $this->getDato($nombre)->getArray();
        foreach ($array as $i => $item) {
            if (!is_array($item)) {
                throw new Exception(sprintf('El item "%d" del dato "%s" no es del tipo array.', $i, $nombre));
            }
            $array[$i] = new Datos($item);
        }
        return $array;
    }
}
