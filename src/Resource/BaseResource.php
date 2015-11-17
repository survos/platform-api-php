<?php

namespace Survos\Client\Resource;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Survos\Client\SurvosClient;
use Survos\Client\SurvosException;
use Survos\Client\Param\CgetParam;

abstract class BaseResource
{
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

    protected function getGuzzle()
    {
        return new Client([
            'base_uri' => $this->client->getEndpoint(),
            'headers' => ['authorization' => 'Bearer '.$this->client->getAccessToken()],
            'http_errors' => false,
        ]);
    }

    /**
     * @param ResponseInterface $response
     * @return array
     */
    protected function parseResponse($response)
    {
        $content = $response->getBody()->getContents();
        return json_decode($content, true);
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
     * @param CgetParam $param
     * @return array
     */
    protected function cget($param)
    {
        $guzzle = $this->getGuzzle();
        $response = $guzzle->get($this->resource, ['query' => $param->getParams()]);
        $this->assertResponse($response, 200);
        return $this->parseResponse($response);
    }

    protected function get($id)
    {
        $guzzle = $this->getGuzzle();
        $response = $guzzle->get($this->resource.'/'.$id);
        $this->assertResponse($response, 200);
        return $this->parseResponse($response);
    }

    protected function delete($id)
    {
        $guzzle = $this->getGuzzle();
        $response = $guzzle->delete($this->resource.'/'.$id);
        $this->assertResponse($response, 204);
        return true;
    }

    protected function post(array $data)
    {
        $guzzle = $this->getGuzzle();
        $response = $guzzle->post($this->resource, ['form_params' => $data]);
        $this->assertResponse($response, 200);
        return $this->parseResponse($response);
    }

    protected function put($id, array $data)
    {
        $guzzle = $this->getGuzzle();
        $response = $guzzle->put($this->resource.'/'.$id, ['form_params' => $data]);
        $this->assertResponse($response, 200);
        return $this->parseResponse($response);
    }

    protected function patch($id, array $data)
    {
        $guzzle = $this->getGuzzle();
        $response = $guzzle->patch($this->resource.'/'.$id, ['form_params' => $data]);
        $this->assertResponse($response, 200);
        return $this->parseResponse($response);
    }
}