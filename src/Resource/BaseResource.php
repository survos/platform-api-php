<?php

namespace Survos\Client\Resource;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Survos\Client\GuzzleListener;
use Survos\Client\SurvosClient;
use Survos\Client\SurvosException;

abstract class BaseResource
{
    use GuzzleListener;

    /** @var string */
    protected $resource;

    /** @var SurvosClient */
    protected $client;

    /**
     * @param SurvosClient $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * @return Client
     */
    protected function getGuzzle()
    {
        return new Client([
            'base_uri' => $this->client->getEndpoint(),
            'headers' => ['authorization' => 'Bearer '.$this->client->getAccessToken()],
            'http_errors' => false,
            'handler' => $this->getGuzzleHandler()
        ]);
    }


    /**
     * @return string
     */
    public function getLastPath()
    {
        return $this->lastPath;
    }

    /**
     * @param ResponseInterface $response
     * @return array
     * @throws SurvosException
     */
    protected function parseResponse($response)
    {
        $content = $response->getBody()->getContents();
        $data = json_decode($content, true);
        if (!is_array($data)) {
            throw new SurvosException("Bad data in server response: ".substr($response->getBody(),0,200));
        }
        return $data;
    }

    /**
     * @param ResponseInterface $response
     * @param int $expectedCode
     * @throws SurvosException
     */
    protected function assertResponse($response, $expectedCode = 200)
    {
        if ($expectedCode !== $response->getStatusCode()) {
            $data = $this->parseResponse($response);
            $message = is_array($data) ? json_encode($data) : 'Unknown error';
            throw new SurvosException($message);
        }

    }

    /**
     * @param array $params
     * @return array
     */
    protected function cget($params)
    {
        $guzzle = $this->getGuzzle();
        $response = $guzzle->get($this->resource, ['query' => $params]);
        $this->assertResponse($response, 200);
        return $this->parseResponse($response);
    }

    /**
     * @param int $id
     * @return array
     * @throws SurvosException
     */
    protected function get($id)
    {
        $guzzle = $this->getGuzzle();
        $response = $guzzle->get($this->resource.'/'.$id);
        $this->assertResponse($response, 200);
        return $this->parseResponse($response);
    }

    /**
     * @param int $id
     * @return bool
     * @throws SurvosException
     */
    protected function delete($id)
    {
        $guzzle = $this->getGuzzle();
        $response = $guzzle->delete($this->resource.'/'.$id);
        $this->assertResponse($response, 204);
        return true;
    }

    /**
     * @param array $data
     * @return array
     * @throws SurvosException
     */
    protected function post(array $data)
    {
        $guzzle = $this->getGuzzle();
        $response = $guzzle->post($this->resource, ['json' => $data]);
        $this->assertResponse($response, 201);
        return $this->parseResponse($response);
    }

    /**
     * @param int $id
     * @param array $data
     * @return array
     * @throws SurvosException
     */
    protected function put($id, array $data)
    {
        $guzzle = $this->getGuzzle();
        $response = $guzzle->put($this->resource.'/'.$id, ['json' => $data]);
        $this->assertResponse($response, 200);
        return $this->parseResponse($response);
    }

    /**
     * @param int $id
     * @param array $data
     * @return array
     * @throws SurvosException
     */
    protected function patch($id, array $data)
    {
        $guzzle = $this->getGuzzle();
        $response = $guzzle->patch($this->resource.'/'.$id, ['json' => $data]);
        $this->assertResponse($response, 200);
        return $this->parseResponse($response);
    }
}
