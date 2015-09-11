<?php

namespace Survos\Client;

use Survos\Client\Resource\AssignmentResource;
use Survos\Client\Resource\UserResource;
use GuzzleHttp\Client;

class SurvosClient
{
    /** @var string */
    private $endpoint;

    /** @var string */
    private $accessToken;

    /** @var array */
    private $loggedUser;

    public function __construct($endpoint = 'https://demo.survos.com/api1.0/')
    {
        $this->endpoint = $endpoint;
    }

    public function authorize($username, $password)
    {
        $guzzle = new Client(['http_errors' => false]);
        $response = $guzzle->request('POST', $this->endpoint.'security/login', ['form_params' => [
            'username' => $username, 'password' => $password
        ]]);
        if (200 !== $response->getStatusCode()) {
            return false;
        }
        $data = json_decode($response->getBody()->getContents(), true);
        $this->accessToken = $data['accessToken'];
        $this->loggedUser = $data['user'];
        return true;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @return array
     */
    public function getLoggedUser()
    {
        return $this->loggedUser;
    }

    /** @var AssignmentResource */
    private $assignment;

    /** @var UserResource */
    private $user;

    /**
     * @return AssignmentResource
     */
    public function getAssignment()
    {
        if (is_null($this->assignment)) {
            $this->assignment = new AssignmentResource($this);
        }
        return $this->assignment;
    }

    /**
     * @return UserResource
     */
    public function getUser()
    {
        if (is_null($this->user)) {
            $this->user = new UserResource($this);
        }
        return $this->user;
    }
}