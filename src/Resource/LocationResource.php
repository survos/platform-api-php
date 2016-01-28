<?php

namespace Survos\Client\Resource;

use Survos\Client\Resource\Helper\GetListHelper;

class LocationResource extends BaseResource
{
    use GetListHelper;

    /** @var string */
    protected $resource = 'locations';
}
