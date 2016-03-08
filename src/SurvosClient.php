<?php

namespace Survos\Client;

use Survos\Client\Resource\AssignmentResource;
use Survos\Client\Resource\MemberResource;
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

    /**
     * SurvosClient constructor.
     *
     * @param string $endpoint
     */
    public function __construct($endpoint = 'https://demo.survos.com/api1.0/')
    {
        $this->endpoint = $endpoint;
    }

    /**
     * @param string $username
     * @param string $password
     * @return bool
     * @throws \Exception
     */
    public function authorize($usernameOrAccessToken, $password = null, $clientId = null, $clientSecret = null)
    {
        if (is_null($password) && is_null($clientId) && is_null($clientSecret)) {
            $this->accessToken = $usernameOrAccessToken;
        } else {
            $guzzle = new Client(['http_errors' => false]);
            $response = $guzzle->request(
                'POST',
                $this->endpoint.'/oauth/v2/token',
                [
                    'form_params' => [
                        'username'      => $usernameOrAccessToken,
                        'password'      => $password,
                        'grant_type'    => 'password',
                        'client_id'     => $clientId,
                        'client_secret' => $clientSecret,
                    ],
                ]
            );
            if (404 == $response->getStatusCode()) {
                throw new \Exception("Invalid login route: ".$this->endpoint);
            }
            if (200 !== $response->getStatusCode()) {
                return false;
            }
            $data = json_decode($response->getBody()->getContents(), true);
            $this->accessToken = $data['access_token'];
        }

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
        return '';
    }
}
