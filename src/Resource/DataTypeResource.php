<?php
namespace Survos\Client\Resource;

use Survos\Client\Resource\Helper\DeleteByIdHelper;
use Survos\Client\Resource\Helper\GetByCodeHelper;
use Survos\Client\Resource\Helper\GetByIdHelper;
use Survos\Client\Resource\Helper\GetListHelper;
use Survos\Client\Resource\Helper\SaveHelper;

class DataTypeResource extends BaseResource
{
    use GetByIdHelper, GetByCodeHelper, GetListHelper ;

    /** @var string */
    protected $resource = 'data_types';

}
