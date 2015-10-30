<?php

namespace Survos\Client\Resource;

use Survos\Client\Param\CgetParam;
use Survos\Client\Resource\Helper\GetListHelper;

class MemberResource extends BaseResource
{
    use GetListHelper;

    protected $resource = 'members';

    /**
     * @param array $ids
     * @param string $action "accept"|"reject"
     * @param string $comment
     * @param string $message Message to applicant
     * @return array
     * @throws \Survos\Client\SurvosException
     */
    public function setApplicantsStatus(array $ids, $action, $comment = null, $message = null)
    {
        $guzzle = $this->getGuzzle();
        $response = $guzzle->patch($this->resource.'/applicants/'.$action, ['form_params' => [
            'ids' => $ids,
            'comment' => $comment,
            'message' => $message,
        ]]);
        $this->assertResponse($response, 200);
        return $this->parseResponse($response);
    }
}