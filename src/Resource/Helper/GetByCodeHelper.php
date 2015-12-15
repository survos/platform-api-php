<?php
namespace Survos\Client\Resource\Helper;

trait GetByCodeHelper
{
    /**
     * @param $id
     * @return array
     */
    public function getByCode($code, $params = [])
    {
        $params['code'] = $code;
        $items = $this->getList(
            1,
            1,
            ['code' => $code],
            null,
            null,
            $params
        );

        // return first item
        return reset($items['items']);
    }
}