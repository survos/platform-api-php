<?php
namespace Survos\Client\Resource\Helper;

use Survos\Client\SurvosCriteria;

trait GetOneByFieldHelper
{
    /**
     * @param $id
     * @return array
     */
    public function getOneBy($field, $value)
    {
        $items = $this->getList(
            $page = 1,
            $maxPerPage = 1,
            $criteria = [$field => $value],
            $criteriaCmp = [$field => SurvosCriteria::EQUAL]
        );

        // return first item
        return reset($items['items']);
    }
}