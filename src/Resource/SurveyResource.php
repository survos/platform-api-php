<?php
namespace Survos\Client\Resource;

use Survos\Client\Resource\Helper\DeleteByIdHelper;
use Survos\Client\Resource\Helper\GetByCodeHelper;
use Survos\Client\Resource\Helper\GetByIdHelper;
use Survos\Client\Resource\Helper\GetListHelper;
use Survos\Client\Resource\Helper\GetOneByFieldHelper;
use Survos\Client\Resource\Helper\SaveHelper;

class SurveyResource extends BaseResource
{
    use SaveHelper, GetListHelper, GetByIdHelper, GetByCodeHelper, DeleteByIdHelper, GetOneByFieldHelper;

    /** @var string */
    protected $resource = 'surveys';

    /**
     * @param integer $id
     * @return array
     * @throws \Survos\Client\SurvosException
     */
    public function getExportJson($id)
    {
        $guzzle = $this->getGuzzle();
        $response = $guzzle->get("{$this->resource}/{$id}/export-json", []);
        $this->assertResponse($response, 200);

        return $this->parseResponse($response);
    }

    public function importSurvey($data)
    {
        $guzzle = $this->getGuzzle();
        $response = $guzzle->post("{$this->resource}/import", ['form_params' => $data]);
        $this->assertResponse($response, 200);
        return $this->parseResponse($response);
    }
}
