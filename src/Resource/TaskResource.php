<?php
namespace Survos\Client\Resource;

use Survos\Client\Resource\Helper\GetListHelper;

class TaskResource extends BaseResource
{
    use GetListHelper;

    protected $resource = 'tasks';
}