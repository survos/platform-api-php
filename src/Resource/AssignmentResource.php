<?php

namespace Survos\Client\Resource;

use Survos\Client\Resource\Helper\GetListHelper;

class AssignmentResource extends BaseResource
{
    use GetListHelper;

    protected $resource = 'assignments';
}