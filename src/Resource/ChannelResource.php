<?php
namespace Survos\Client\Resource;

class ChannelResource extends BaseResource
{
    /**
     * @param string $channelCode
     * @param array $data
     * @return array
     */
    public function sendData(string $channelCode, array $data)
    {
        $data = array_merge([
            'answers' => [],
            'memberId' => null,
            'assignmentId' => -1,
            'taskId' => null,
            'language' => 'en',
        ], $data);

        $guzzle = $this->getGuzzle();
        $response = $guzzle->post("/channel/receive/{$channelCode}", ['json' => $data]);
        $this->assertResponse($response, 200);
        return $this->parseResponse($response);
    }
}
