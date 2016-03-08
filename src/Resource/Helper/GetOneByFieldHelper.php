<?php
namespace Survos\Client\Resource\Helper;

use Survos\Client\SurvosCriteria;

trait GetOneByFieldHelper
{
    /**
     * @param array $criteria
     * @param array $params
     * @return array|null
     */
    public function getOneBy(array $criteria, $params = [])
    {

        $items = $this->getList(
            $page = 1,
            $maxPerPage = 1,
            $criteria,
            null,
            $params
        );

        // return first item
        return reset($items['hydra:member']);
    }
}
