<?php
namespace Survos\Client\Resource\Helper;

use Survos\Client\SurvosCriteria;

trait GetOneByFieldHelper
{
    /**
     * @param $id
     * @return array
     */
    public function getOneBy(array $criteria, $params = [])
    {
        $cmpList = [];
        foreach($criteria as $key => $val) {
            $cmpList[$key] = SurvosCriteria::EQUAL;
        }
        $items = $this->getList(
            $page = 1,
            $maxPerPage = 1,
            $criteria,
            $cmpList,
            null,
            $params
        );

        // return first item
        return reset($items['items']);
    }
}