<?php
declare(strict_types=1);

namespace AquiCobro\Sdk;

class Dato
{
    /** @var string */
    private $nombre;

    /** @var mixed */
    private $valor;

    /**
     * Dato constructor.
     * @param string $nombre
     * @param mixed $valor
     */
    public function __construct(string $nombre, $valor)
    {
        $this->nombre = $nombre;
        $this->valor = $valor;
    }

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * @return mixed
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @param callable|null $callable
     * @return array
     * @throws Exception
     */
    public function getArray(callable $callable = null): array
    {
        if (!is_array($this->valor)) {
            throw new Exception(sprintf('El dato "%s" no es del tipo array.', $this->nombre));
        }
        return ($callable !== null) ? array_map($callable, $this->valor) : $this->valor;
    }

    /**
     * @param callable|null $callable
     * @return array
     * @throws Exception
     */
    public function getArrayOrNull(callable $callable = null): ?array
    {
        return ($this->valor !== null) ? $this->getArray($callable) : null;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function getBool(): bool
    {
        if (!is_bool($this->valor)) {
            throw new Exception(sprintf('El dato "%s" no es del tipo bool.', $this->nombre));
        }
        return $this->valor;
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function getBoolOrNull(): ?bool
    {
        return ($this->valor !== null) ? $this->getBool() : null;
    }

    /**
     * @return float
     * @throws Exception
     */
    public function getFloat(): float
    {
        if (!is_float($this->valor) && !is_int($this->valor)) {
            throw new Exception(sprintf('El dato "%s" no es del tipo float.', $this->nombre));
        }
        return floatval($this->valor);
    }

    /**
     * @return float
     * @throws Exception
     */
    public function getFloatOrNull(): ?float
    {
        return ($this->valor !== null) ? $this->getFloat() : null;
    }

    /**
     * @return int
     * @throws Exception
     */
    public function getInt(): int
    {
        if (!is_int($this->valor)) {
            throw new Exception(sprintf('El dato "%s" no es del tipo int.', $this->nombre));
        }
        return $this->valor;
    }

    /**
     * @return int
     * @throws Exception
     */
    public function getIntOrNull(): ?int
    {
        return ($this->valor !== null) ? $this->getInt() : null;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getString(): string
    {
        if (!is_string($this->valor)) {
            throw new Exception(sprintf('El dato "%s" no es del tipo string.', $this->nombre));
        }
        return $this->valor;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getStringOrNull(): ?string
    {
        return ($this->valor !== null) ? $this->getString() : null;
    }
}
