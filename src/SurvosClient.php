<?php

namespace Survos\Client;

use Survos\Client\Resource\AssignmentResource;
use Survos\Client\Resource\UserResource;
use GuzzleHttp\Client;

class SurvosClient
{
    const ENDPOINT_TPL = 'http://%s.l.survos.net/app_dev.php/api1.0/';

    /** @var string */
    private $endpoint;
    /** @var string */
    private $project;
    /** @var string */
    private $accessToken;
    /** @var array */
    private $loggedUser;

    public function __construct($project = 'demo')
    {
        $this->project = $project;
        $this->endpoint = sprintf(self::ENDPOINT_TPL, $project);
        $this->initControllers();
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

    /**
     * @return string
     */
    public function getProject()
    {
        return $this->project;
    }


    /** @var AssignmentResource */
    public $assignment;

    /** @var UserResource */
    public $user;

    private function initControllers()
    {
        $this->assignment = new AssignmentResource($this);
        $this->user = new UserResource($this);
    }
}