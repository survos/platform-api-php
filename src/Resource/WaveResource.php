<?php
namespace Survos\Client\Resource;

use Survos\Client\Resource\Helper\DeleteByIdHelper;
use Survos\Client\Resource\Helper\GetByCodeHelper;
use Survos\Client\Resource\Helper\GetByIdHelper;
use Survos\Client\Resource\Helper\GetListHelper;
use Survos\Client\Resource\Helper\GetOneByFieldHelper;
use Survos\Client\Resource\Helper\SaveHelper;

class WaveResource extends BaseResource
{
    use SaveHelper, GetListHelper, GetByCodeHelper, GetByIdHelper, DeleteByIdHelper, GetOneByFieldHelper;

    /** @var string */
    protected $resource = 'waves';
}
