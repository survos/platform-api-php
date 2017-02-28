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
    public function getOneBy(array $criteria = [], array $orderBy = [])
    {
        $items = $this->getList(
            $criteria,
            $orderBy,
            $page = 1,
            $itemsPerPage = 1
        );

        return $items['hydra:member'][0] ?? null;
    }
}
