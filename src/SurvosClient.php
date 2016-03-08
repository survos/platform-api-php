<?php

namespace Survos\Client;

use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\GenericProvider;
use League\OAuth2\Client\Token\AccessToken;
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
            $provider = new GenericProvider(
                [
                    'clientId'                => $clientId,    // The client ID assigned to you by the provider
                    'clientSecret'            => $clientSecret,   // The client password assigned to you by the provider
                    'redirectUri'             => '/',
                    'urlAuthorize'            => $this->endpoint.'/oauth/v2/auth',
                    'urlAccessToken'          => $this->endpoint.'/oauth/v2/token',
                    'urlResourceOwnerDetails' => '',
                ]
            );

            try {

                // Try to get an access token using the resource owner password credentials grant.
                $accessToken = $provider->getAccessToken(
                    'password',
                    [
                        'username' => $usernameOrAccessToken,
                        'password' => $password,
                    ]
                );

            } catch (IdentityProviderException $e) {

                // Failed to get the access token
                exit($e->getMessage());

            }

            /** @type AccessToken $accessToken */
            $this->accessToken = $accessToken->getToken();
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
