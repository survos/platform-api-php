<?php
namespace Survos\Client\Resource;

use Survos\Client\Resource\Helper\DeleteByIdHelper;
use Survos\Client\Resource\Helper\GetByIdHelper;
use Survos\Client\Resource\Helper\GetListHelper;
use Survos\Client\Resource\Helper\SaveHelper;

class DataImageResource extends BaseResource
{
    use SaveHelper, GetListHelper, GetByIdHelper, DeleteByIdHelper;

    /** @var string */
    protected $resource = 'images';
}
