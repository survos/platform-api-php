<?php

namespace Survos\Client\Resource;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Survos\Client\SurvosClient;
use Survos\Client\SurvosException;
use Survos\Client\Param\CgetParam;

abstract class BaseResource
{
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
        $data = $this->parseResponse($response);
        if ($expectedCode !== $response->getStatusCode()) {
            $message = is_array($data) ? json_encode($data) : 'Unknown error';
            throw new SurvosException($message);
        }
        if (!is_array($data)) {
            throw new SurvosException("Bad data in server response: ".substr($response->getBody(),0,200));
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
        $response = $guzzle->post($this->resource, ['form_params' => $data]);
        $this->assertResponse($response, 200);
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
        $response = $guzzle->put($this->resource.'/'.$id, ['form_params' => $data]);
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
        $response = $guzzle->patch($this->resource.'/'.$id, ['form_params' => $data]);
        $this->assertResponse($response, 200);
        return $this->parseResponse($response);
    }
}
