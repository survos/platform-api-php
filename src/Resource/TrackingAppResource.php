<?php

namespace Survos\Client\Resource;

use Survos\Client\Resource\Helper\GetListHelper;

class TrackingAppResource extends BaseResource
{
    use GetListHelper;

    /** @var string */
    protected $resource = 'tracking-apps';
}
