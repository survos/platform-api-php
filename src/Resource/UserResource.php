<?php
namespace Survos\Client\Resource;

use Survos\Client\Resource\Helper\DeleteByIdHelper;
use Survos\Client\Resource\Helper\GetByIdHelper;
use Survos\Client\Resource\Helper\GetListHelper;
use Survos\Client\Resource\Helper\GetOneByFieldHelper;
use Survos\Client\Resource\Helper\SaveHelper;

class UserResource extends BaseResource
{
    use SaveHelper, GetListHelper, GetByIdHelper, DeleteByIdHelper, GetOneByFieldHelper;

    protected $resource = 'users';

    /**
     * @param array $data
     * @return bool
     * @throws \Survos\Client\SurvosException
     */
    public function register(array $data)
    {
        $guzzle = $this->getGuzzle();
        $response = $guzzle->post('security/register', ['form_params' => $data]);
        return 201 === $response->getStatusCode();
    }
}