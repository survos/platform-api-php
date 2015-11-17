<?php
namespace Survos\Client\Resource\Helper;

use Survos\Client\SurvosCriteria;

trait GetByCodeHelper
{
    /**
     * @param $id
     * @return array
     */
    public function getByCode($code)
    {
        $items = $this->getList(
            $page = 1,
            $maxPerPage = 1,
            $criteria = ['code' => $code],
            $criteriaCmp = ['code' => SurvosCriteria::EQUAL]
        );

        // return first item
        return reset($items['items']);
    }
}