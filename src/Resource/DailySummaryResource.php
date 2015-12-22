<?php
namespace Survos\Client\Resource;

use Survos\Client\Resource\Helper\GetByIdHelper;
use Survos\Client\Resource\Helper\GetListHelper;
use Survos\Client\Resource\Helper\GetOneByFieldHelper;

class DailySummaryResource extends BaseResource
{
    use GetListHelper, GetByIdHelper, GetOneByFieldHelper;

    protected $resource = 'daily-summary';
}
