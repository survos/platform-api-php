<?php
namespace Survos\Client\Resource;

use Survos\Client\Resource\Helper\DeleteByIdHelper;
use Survos\Client\Resource\Helper\GetByIdHelper;
use Survos\Client\Resource\Helper\GetListHelper;
use Survos\Client\Resource\Helper\SaveHelper;

class DataResource extends BaseResource
{
    use SaveHelper, GetListHelper, GetByIdHelper, DeleteByIdHelper;

    /** @var string */
    protected $resource = 'datas';

    /**
     * @param string $projectCode
     * @param string $moduleCode
     * @return array
     * @throws SurvosException
     */
    public function addForImportWave($waveId, $data)
    {
        $guzzle = $this->getGuzzle();
        $response = $guzzle->post("{$this->resource}/for-import-wave/{$waveId}", ['body'=>json_encode($data)]);
        $this->assertResponse($response, 201);

        return $this->parseResponse($response);
    }
}
