<?php

namespace Survos\Client\Resource;

use Survos\Client\Param\CgetParam;
use Survos\Client\Resource\Helper\DeleteByIdHelper;
use Survos\Client\Resource\Helper\GetByCodeHelper;
use Survos\Client\Resource\Helper\GetByIdHelper;
use Survos\Client\Resource\Helper\GetListHelper;
use Survos\Client\Resource\Helper\GetOneByFieldHelper;
use Survos\Client\Resource\Helper\SaveHelper;
use Survos\Client\SurvosException;

class ProjectResource extends BaseResource
{
    use SaveHelper, GetListHelper, GetByIdHelper, DeleteByIdHelper, GetByCodeHelper, GetOneByFieldHelper;

    /** @var string */
    protected $resource = 'projects';

    /**
     * @param string $projectCode
     * @param string $moduleCode
     * @return array
     * @throws SurvosException
     */
    public function addModule($projectCode, $moduleCode)
    {
        $project = $this->getOneBy(['code' => $projectCode]);
        if (!$project) {
            throw new SurvosException("Project '$projectCode' not found'");
        }
        $guzzle = $this->getGuzzle();
        $response = $guzzle->post("{$this->resource}/{$project['id']}/add-module/{$moduleCode}", []);
        $this->assertResponse($response, 200);

        return $this->parseResponse($response);
    }
}
