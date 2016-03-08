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
        return new Client(
            [
                'base_uri'    => $this->client->getEndpoint(),
                'headers'     => ['authorization' => 'Bearer '.$this->client->getAccessToken()],
                'http_errors' => false,
            ]
        );
    }

    /**
     * @param ResponseInterface $response
     * @return array
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
        $statusCode = $response->getStatusCode();
        if ($expectedCode !== $statusCode) {
            $data = $this->parseResponse($response);
            if (is_array($data) && isset($data['hydra:description'])) {
                $message = $data['hydra:description'];
            } else {
                $message = is_array($data) ? json_encode($data) : 'Unknown error';
            }
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
        $response = $guzzle->post($this->resource, $data);
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
        $response = $guzzle->put($this->resource.'/'.$id, ['body' => json_encode($data)]);
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
        $response = $guzzle->patch($this->resource.'/'.$id, ['body' => json_encode($data)]);
        $this->assertResponse($response, 200);
        return $this->parseResponse($response);
    }
}
