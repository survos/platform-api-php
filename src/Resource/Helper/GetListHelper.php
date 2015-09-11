<?php
namespace Survos\Client\Resource\Helper;

use Survos\Client\Param\CgetParam;

trait GetListHelper
{
    /**
     * @param int|null $page
     * @param int|null $maxPerPage
     * @param array|null $criteria
     * @return array
     */
    public function getList($page = null, $maxPerPage = null, array $criteria = null)
    {
        $param = new CgetParam($page, $maxPerPage, $criteria);
        return $this->cget($param);
    }

}