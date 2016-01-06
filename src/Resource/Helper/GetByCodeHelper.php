<?php
namespace Survos\Client\Resource\Helper;

trait GetByCodeHelper
{
    use GetListHelper;

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
            null,
            $params
        );

        // return first item
        return reset($items['items']);
    }
}
