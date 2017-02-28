<?php

namespace Survos\Client\Resource;

use Survos\Client\Resource\Helper\GetByIdHelper;
use Survos\Client\Resource\Helper\GetListHelper;
use Survos\Client\Resource\Helper\GetOneByFieldHelper;
use Survos\Client\Resource\Helper\SaveHelper;

class MemberResource extends BaseResource
{
    use GetListHelper,SaveHelper, GetByIdHelper, GetOneByFieldHelper;

    /** @var string */
    protected $resource = 'members';

    /**
     * @param int $id
     * @param string $action "accept"|"reject"
     * @param string $comment
     * @param string $message Message to applicant
     * @return array
     * @throws \Survos\Client\SurvosException
     */
    public function setApplicantsStatus($id, $action, $comment = null, $message = null)
    {
        $guzzle = $this->getGuzzle();
        $response = $guzzle->patch($this->resource.'/applicants/'.$action, ['form_params' => [
            'id' => $id,
            'comment' => $comment,
            'message' => $message,
        ]]);
        $this->assertResponse($response, 200);
        return $this->parseResponse($response);
    }
}
