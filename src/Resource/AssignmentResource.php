<?php

namespace Survos\Client\Resource;

use Survos\Client\Resource\Helper\GetListHelper;
use Survos\Client\Resource\Helper\GetOneByFieldHelper;
use Survos\Client\Resource\Helper\SaveHelper;

class AssignmentResource extends BaseResource
{
    use GetListHelper, SaveHelper, GetOneByFieldHelper;

    /** @var string */
    protected $resource = 'assignments';
}
