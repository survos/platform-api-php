<?php
namespace Survos\Client\Resource;

use Survos\Client\Resource\Helper\GetListHelper;

class TrackResource extends BaseResource
{
    use GetListHelper;

    protected $resource = 'tracks';
}