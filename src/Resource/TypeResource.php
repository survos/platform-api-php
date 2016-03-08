<?php
namespace Survos\Client\Resource;

use Survos\Client\Resource\Helper\DeleteByIdHelper;
use Survos\Client\Resource\Helper\GetByCodeHelper;
use Survos\Client\Resource\Helper\GetByIdHelper;
use Survos\Client\Resource\Helper\GetListHelper;
use Survos\Client\Resource\Helper\SaveHelper;

class TypeResource extends BaseResource
{
    use GetByIdHelper, GetByCodeHelper, GetListHelper ;

    /** @var string */
    protected $resource = 'types';

}
