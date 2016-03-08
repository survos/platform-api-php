<?php
namespace Survos\Client\Resource\Helper;

trait GetByCodeHelper
{
    /**
     * @param string $code
     * @param array $params
     * @return array|null
     */
    public function getByCode($code, $params = [])
    {
        $params['code'] = $code;
        $items = $this->getList(
            1,
            1,
            ['code' => $code],
            null,
            $params
        );

        // return first item
        return reset($items['hydra:member']);
    }
}
