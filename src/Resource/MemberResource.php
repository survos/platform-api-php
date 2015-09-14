<?php

namespace Survos\Client\Resource;

use Survos\Client\Param\CgetParam;
use Survos\Client\Resource\Helper\GetListHelper;

class MemberResource extends BaseResource
{
    use GetListHelper;

    protected $resource = 'members';

    /**
     * @param int|null $page
     * @param int|null $maxPerPage
     * @param array|null $criteria
     * @return array
     */
    public function getApplicants($page = null, $maxPerPage = null, array $criteria = null)
    {
        $param = new CgetParam($page, $maxPerPage, $criteria);
        $guzzle = $this->getGuzzle();
        $response = $guzzle->get($this->resource.'/applicants', ['query' => $param->getParams()]);
        $this->assertResponse($response, 200);
        return $this->parseResponse($response);
    }

    /**
     * @param array $ids
     * @param string $action "accept"|"reject"
     * @return array
     * @throws \Survos\Client\SurvosException
     */
    public function setApplicantsStatus(array $ids, $action)
    {
        $guzzle = $this->getGuzzle();
        $response = $guzzle->patch($this->resource.'/applicants/status', ['form_params' => [
            'ids' => $ids,
            'action' => $action
        ]]);
        $this->assertResponse($response, 200);
        return $this->parseResponse($response);
    }
}