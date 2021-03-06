<?php
namespace Survos\Client\Resource;

use Survos\Client\Resource\Helper\DeleteByIdHelper;
use Survos\Client\Resource\Helper\GetByIdHelper;
use Survos\Client\Resource\Helper\GetListHelper;
use Survos\Client\Resource\Helper\GetOneByFieldHelper;
use Survos\Client\Resource\Helper\SaveHelper;

class ServerResource extends BaseResource
{
    use SaveHelper, GetListHelper, GetByIdHelper, DeleteByIdHelper, GetOneByFieldHelper;

    /** @var string */
    protected $resource = 'servers';
}
