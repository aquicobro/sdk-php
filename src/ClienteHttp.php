<?php
declare(strict_types=1);

namespace AquiCobro\Sdk;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;

class ClienteHttp
{
    /** @var string|null */
    private $idApiKey = null;

    /** @var string|null */
    private $secreto = null;

    /** @var string|null */
    private $accessToken = null;

    /**
     * ClienteHttpAquiCobro constructor.
     */
    private function __construct()
    {

    }

    /**
     * @param string $accessToken
     * @return ClienteHttp
     */
    public static function conAccessToken(string $accessToken): self
    {
        $clienteHttp = new self();
        $clienteHttp->accessToken = $accessToken;
        return $clienteHttp;
    }

    /**
     * @param string $idApiKey
     * @param string $secreto
     * @return ClienteHttp
     */
    public static function conCredenciales(string $idApiKey, string $secreto): self
    {
        $clienteHttp = new self();
        $clienteHttp->idApiKey = $idApiKey;
        $clienteHttp->secreto = $secreto;
        return $clienteHttp;
    }

    /**
     * @param string $uri
     * @param array $query
     * @return mixed
     * @throws Exception
     */
    public function get(string $uri, array $query = [])
    {
        return self::request($this->client(), 'GET', $uri, $query);
    }

    /**
     * @param string $uri
     * @param array $query
     * @param array $params
     * @return mixed
     * @throws Exception
     */
    public function post(string $uri, array $query = [], array $params = [])
    {
        return self::request($this->client(), 'POST', $uri, $query, $params);
    }

    /**
     * @param string $uri
     * @param array $query
     * @param array $params
     * @return mixed
     * @throws Exception
     */
    public function put(string $uri, array $query = [], array $params = [])
    {
        return self::request($this->client(), 'PUT', $uri, $query, $params);
    }

    /**
     * @param string $uri
     * @param array $query
     * @param array $params
     * @return mixed
     * @throws Exception
     */
    public function delete(string $uri, array $query = [], array $params = [])
    {
        return self::request($this->client(), 'DELETE', $uri, $query, $params);
    }

    /**
     * @param Client $client
     * @param string $method
     * @param string $uri
     * @param array $query
     * @param array $params
     * @return mixed
     * @throws Exception
     */
    private static function request(Client $client, string $method, string $uri, array $query = [], array $params = [])
    {
        try {
            $options = [];
            if (!empty($query)) {
                $options[RequestOptions::QUERY] = $query;
            }
            if (!empty($params)) {
                $options[RequestOptions::JSON] = $params;
            }
            $res = $client->request($method, $uri, $options);
            return self::getData((string) $res->getBody());

        } catch (BadResponseException $exc) {
            $error = (string) $exc->getResponse()->getBody();
            if ($exc->getResponse()->hasHeader('content-type')
                && $exc->getResponse()->getHeader('content-type')[0] === 'application/json; charset=utf-8'
            ) {
                $error = self::getError($error);
            }
            throw new Exception($error, 0, $exc);
        } catch (GuzzleException $exc) {
            throw new Exception($exc->getMessage(), 0, $exc);
        }
    }

    /**
     * @param string $apiOkResponse
     * @return mixed
     * @throws Exception
     */
    private static function getData(string $apiOkResponse)
    {
        $res = json_decode($apiOkResponse, true);

        if (!is_array($res)
            || !array_key_exists('estado', $res)
            || $res['estado'] !== 'ok'
            || !array_key_exists('data', $res)
        ) {
            throw new Exception('Respuesta API inválida.');
        }

        return $res['data'];
    }

    /**
     * @param string $apiErrorResponse
     * @return string
     * @throws Exception
     */
    private static function getError(string $apiErrorResponse): string
    {
        $res = json_decode($apiErrorResponse, true);

        if ($res === false) {
            throw new Exception('Respuesta JSON inválida.');
        }

        if (is_string($res)) {
            return $res;
        }

        if (!is_array($res)
            || !array_key_exists('estado', $res)
            || $res['estado'] !== 'error'
            || !array_key_exists('mensaje', $res)
        ) {
            throw new Exception('Respuesta de error con formato inválido.');
        }

        return $res['mensaje'];
    }

    /**
     * @return Client
     * @throws Exception
     */
    private function client(): Client
    {
        /** @var Client|null $client */
        static $client = null;
        if ($client === null) {
            if ($this->accessToken === null) {
                $this->accessToken = $this->getAccessToken((string) $this->idApiKey, (string) $this->secreto);
            }
            $client = new Client(self::getOpciones($this->accessToken));
        }
        return $client;
    }

    /**
     * @param string $idApiKey
     * @param string $secreto
     * @return ClienteHttp
     * @throws Exception
     */
    public static function getAccessToken(string $idApiKey, string $secreto): string
    {
        $client = new Client(self::getOpciones());
        $params = [
            'grant_type' => 'apikey',
            'idApiKey' => $idApiKey,
            'secreto' => $secreto
        ];
        $data = self::request($client, 'POST', '/api/v1/usuarios/token', [], $params);
        if (!is_array($data) || !array_key_exists('accessToken', $data)) {
            throw new Exception('Error de autenticación.');
        }
        return $data['accessToken'];
    }

    /**
     * @param string|null $accessToken
     * @return array
     */
    private static function getOpciones(string $accessToken = null): array
    {
        $headers = [
            'Accept' => 'application/json',
            'Cache-Control' => 'no-cache',
            'Origin' => 'https://www.aquicobro.com'
        ];
        if ($accessToken !== null) {
            $headers['Authorization'] = 'Bearer ' . $accessToken;
        }
        $opciones = [
            'base_uri' => 'https://www.aquicobro.com/api/v1/',
            RequestOptions::VERIFY => __DIR__ . '/cacert.pem',
            RequestOptions::HEADERS => $headers
        ];
        return $opciones;
    }

    /**
     * @param $response
     * @return Datos
     * @throws Exception
     */
    public function getDatos($response): Datos
    {
        if (!is_array($response)) {
            throw new Exception('Se esperaba una respuesta del tipo array.');
        }
        return new Datos($response);
    }
}
