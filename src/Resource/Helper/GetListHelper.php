<?php
namespace Survos\Client\Resource\Helper;


trait GetListHelper
{
    /**
     * @param array $criteria
     * @param array $order
     * @param int|null $page
     * @param int|null $itemsPerPage
     * @return array
     */
    public function getList(
        array $criteria = [],
        array $orderBy = [],
        $page = null,
        $itemsPerPage = null
    ) {
        $params = array_merge($criteria, [
            'page'         => $page,
            'itemsPerPage' => $itemsPerPage,
//            'XDEBUG_SESSION_START' => 1
            ]);
        if (!empty($orderBy)) {
            $params['order'] = $orderBy;
        }
        return $this->cget(array_filter($params));
    }
}
