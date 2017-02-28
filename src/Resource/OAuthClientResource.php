<?php

namespace Survos\Client\Resource;


use Survos\Client\Resource\Helper\GetByIdHelper;
use Survos\Client\Resource\Helper\GetListHelper;
use Survos\Client\Resource\Helper\GetOneByFieldHelper;
use Survos\Client\Resource\Helper\SaveHelper;

class OAuthClientResource extends BaseResource
{
    use GetListHelper, GetByIdHelper, GetOneByFieldHelper, SaveHelper;

    protected $resource = 'o_auth_clients';
}