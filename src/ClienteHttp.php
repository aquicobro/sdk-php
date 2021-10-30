<?php
declare(strict_types=1);

namespace AquiCobro\Sdk;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
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
     * Crea un cliente http sin autenticacion.
     * @see ClienteHttp::conAccessToken()
     * @see ClienteHttp::conCredenciales()
     */
    private function __construct()
    {

    }

    /**
     * Crea un cliente http que se autenticará con el access token provisto.
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
     * Crea un cliente http que se autenticará con las credenciales provistas.
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
     * Realiza una solicitud HTTP usando el método GET
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
     * Realiza una solicitud HTTP usando el método POST
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
     * Realiza una solicitud HTTP usando el método PUT
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
     * Realiza una solicitud HTTP usando el método DELETE
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
     * Realiza una solicitud HTTP
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
        }
    }

    /**
     * Extrae los datos devueltos por una respuesta exitosa codificada en JSON
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
     * Extrae el mensaje de error devuelto por una respuesta fallida codificada en JSON
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
     * Devuelve el cliente HTTP creado o crea uno si aún no existe. Si no existe un access token trata de obtener uno.
     * @return Client
     * @throws Exception
     */
    private function client(): Client
    {
        /** @var Client|null $client */
        static $client = null;
        if ($client === null) {
            if ($this->accessToken === null && $this->idApiKey !== null && $this->secreto !== null) {
                $this->accessToken = self::getAccessToken($this->idApiKey, $this->secreto);
            }
            $client = new Client(self::getOpciones($this->accessToken));
        }
        return $client;
    }

    /**
     * Obtiene un access token para las credenciales provistas.
     * @param string $idApiKey
     * @param string $secreto
     * @return string
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
     * Devuelve las opciones predeterminadas para todas las solicitudes del cliente HTTP.
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
        return [
            'base_uri' => 'https://www.aquicobro.com/api/v1/',
            RequestOptions::VERIFY => __DIR__ . '/cacert.pem',
            RequestOptions::HEADERS => $headers
        ];
    }

    /**
     * Encapsula la respuesta en un objeto Datos para acceder y válidar los datos obtenidos.
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

    /**
     * Encapsula la respuesta en un array de objetos Datos para acceder y válidar el conjunto de datos obtenidos.
     * @param $response
     * @return Datos[]
     * @throws Exception
     */
    public function getArrayDatos($response): array
    {
        if (!is_array($response)) {
            throw new Exception('Se esperaba una respuesta del tipo array.');
        }
        $array = [];
        foreach ($response as $i => $item) {
            if (!is_array($item)) {
                throw new Exception(sprintf('El item "%d" de la respuesta no es del tipo array.', $i));
            }
            $array[$i] = new Datos($item);
        }
        return $array;
    }
}
