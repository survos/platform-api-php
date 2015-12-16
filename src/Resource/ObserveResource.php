<?php

namespace Survos\Client\Resource;

class ObserveResource extends BaseResource
{
    /** @var string */
    protected $resource = 'observe';

    /**
     * @param array $data
     * @return array
     * @throws \Survos\Client\SurvosException
     */
    public function postLocation(array $data)
    {
        $guzzle = $this->getGuzzle();
        $response = $guzzle->post(
            $this->resource.'/location',
            ['json' => $data]
        );
        $this->assertResponse($response, 200);
        return $this->parseResponse($response);
    }
}
