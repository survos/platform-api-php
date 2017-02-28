<?php

namespace Survos\Client\Resource;


use Survos\Client\Resource\Helper\GetByIdHelper;
use Survos\Client\Resource\Helper\GetListHelper;
use Survos\Client\Resource\Helper\GetOneByFieldHelper;

class OAuthClientResource extends BaseResource
{
    use GetListHelper, GetByIdHelper, GetOneByFieldHelper;

    protected $resource = 'o_auth_clients';
}