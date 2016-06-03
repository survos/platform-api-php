<?php
namespace Survos\Client;

use GuzzleHttp\HandlerStack;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Middleware;

trait GuzzleListener
{
    /** @var ResponseInterface */
    protected $lastResponse;

    /** @var RequestInterface */
    protected $lastRequest;

    /**
     * @return array|null
     */
    public function getLastResponseData()
    {
        if (is_null($this->lastResponse)) {
            return null;
        }
        return $this->lastResponse->getBody()->getContents();
    }

    public function getLastResponseStatus()
    {
        if (is_null($this->lastResponse)) {
            return null;
        }
        return $this->lastResponse->getStatusCode();
    }

    public function getLastRequestPath()
    {
        if (is_null($this->lastRequest)) {
            return null;
        }
        return $this->lastRequest->getUri();
    }

    /**
     * @return HandlerStack
     */
    protected function getGuzzleHandler()
    {
        $handler = HandlerStack::create();
        $handler->push(Middleware::mapResponse(function (ResponseInterface $response) {
            $this->lastResponse = $response;
            return $response;
        }));
        $handler->push(Middleware::mapRequest(function (RequestInterface $request) {
            $this->lastRequest = $request;
            return $request;
        }));
        return $handler;
    }
}