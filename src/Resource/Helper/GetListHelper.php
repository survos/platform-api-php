<?php
namespace Survos\Client\Resource\Helper;

use Survos\Client\Param\CgetParam;

trait GetListHelper
{
    /**
     * @param int|null $page
     * @param int|null $maxPerPage
     * @param array|null $criteria
     * @param array|null $criteriaCmp
     * @param array|null $order
     * @return array
     */
    public function getList(
        $page = null,
        $maxPerPage = null,
        array $criteria = null,
        array $criteriaCmp = null,
        array $order = null,
        $other = []
    ) {
        $param = new CgetParam($page, $maxPerPage, $criteria, $criteriaCmp, $order, $other);

        return $this->cget($param);
    }
}
