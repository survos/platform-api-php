<?php

namespace Survos\Client\Resource;

use Survos\Client\Param\CgetParam;
use Survos\Client\Resource\Helper\DeleteByIdHelper;
use Survos\Client\Resource\Helper\GetByCodeHelper;
use Survos\Client\Resource\Helper\GetByIdHelper;
use Survos\Client\Resource\Helper\GetListHelper;
use Survos\Client\Resource\Helper\GetOneByFieldHelper;
use Survos\Client\Resource\Helper\SaveHelper;

class ProjectResource extends BaseResource
{
    use SaveHelper, GetListHelper, GetByIdHelper, DeleteByIdHelper, GetByCodeHelper, GetOneByFieldHelper;

    protected $resource = 'projects';

    public function addModule($projectCode, $moduleCode)
    {
        $project = $this->getOneBy('code', $projectCode);
        $guzzle = $this->getGuzzle();
        $response = $guzzle->post("{$this->resource}/{$project['id']}/add-module/{$moduleCode}", []);
        $this->assertResponse($response, 200);

        return $this->parseResponse($response);
    }
}