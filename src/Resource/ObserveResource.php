<?php

namespace Survos\Client\Resource;

class ObserveResource extends BaseResource
{
    /** @var string */
    protected $resource = 'observe';

    /**
     * @param array $data
     * @param int|null $userId (usable only if API user is superuser)
     * @return array
     * @throws \Survos\Client\SurvosException
     */
    public function postLocation(array $data, $userId = null)
    {
        $path = $this->resource.'/location';
        if ($userId) {
            $path .= '/'.$userId;
        }
        $guzzle = $this->getGuzzle();
        $response = $guzzle->post(
            $path,
            ['json' => $data]
        );
        $this->assertResponse($response, 200);
        return $this->parseResponse($response);
    }

    public function saveResponses($data)
    {
        $guzzle = $this->getGuzzle();
        $response = $guzzle->post("{$this->resource}/save-responses", ['json' => $data]);
        $this->assertResponse($response, 200);
        return $this->parseResponse($response);
    }
}
