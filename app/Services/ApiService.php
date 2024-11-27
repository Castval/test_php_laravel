<?php


namespace App\Services;

use App\Entities\Order;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Log;

class ApiService
{
    const REQUEST_TYPE_POST = 'post';
    const REQUEST_TYPE_GET = 'get';

    /**
     * @var Client
     */
    private $client;

    /**
     * NexiClient constructor.
     */
    public function __construct()
    {
        $this->prepareClient();
    }

    private function prepareClient()
    {

        $headers = [
            'Content-Type' => 'application/json',
        ];

        $this->client = new Client([
            'base_uri' => env('OPENBREWERYDB_SERVER_URL'),
            'headers' => $headers,
            'verify' => false
        ]);
    }

    public function getList()
    {
        return $this->request(self::REQUEST_TYPE_GET, 'breweries');
    }


    private function request(string $method, string $url, array $data = null, array $params = null)
    {
        //        Log::debug("BEGIN $method - $url");
        try {

            if (!empty($data)) {
                $options['json'] = $data;
            }
            if (!empty($params)) {
                $options['query'] = $params;
            }

            $response = $this->client->request($method, $url);
            $contents = $response->getBody()->getContents();

            // Log::info(collect($contents));

            return json_decode($contents, true);
        } catch (GuzzleException $e) {
            Log::error("EXCEPTION", [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);
            throw new \Exception($e->getMessage(), $e->getCode());
        } finally {
            //            Log::debug("END $method - $url");
        }
    }
}
