<?php

namespace Survos\Client\Resource;

use Survos\Client\Resource\Helper\GetByIdHelper;
use Survos\Client\Resource\Helper\GetListHelper;

class OAuthAccessToken extends BaseResource
{
    use GetListHelper, GetByIdHelper;

    protected $resource = 'o_auth_access_tokens';
}
