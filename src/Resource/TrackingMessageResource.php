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
            1,
            1,
            ['uuid' => $uuid],
            null,
            null,
            $params
        );

        // return first item
        return reset($items['items']);
    }
}
