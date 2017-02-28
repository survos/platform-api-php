<?php

namespace Survos\Client\Resource;

use Survos\Client\Resource\Helper\GetListHelper;

class TrackingMessageResource extends BaseResource
{
    use GetListHelper;

    /** @var string */
    protected $resource = 'tracking-messages';

    /**
     * @param string $uuid
     * @param array $params
     * @return array|null
     */
    public function getByUuid($uuid, $params = [])
    {
        $params['uuid'] = $uuid;
        $items = $this->getList(
            array_merge(['uuid' => $uuid], $params),
            [],
            1,
            1
        );

        // return first item
        return reset($items['items']);
    }
}
