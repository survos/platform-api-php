<?php

namespace Survos\Client\Param;

class CgetParam extends BaseParam
{
    /**
     * CgetParam constructor.
     *
     * @param null  $page
     * @param null  $maxPerPage
     * @param null  $criteria
     * @param null  $criteriaCmp
     * @param null  $order
     * @param array $other other parameters needed in query string
     */
    public function __construct(
        $page = null,
        $maxPerPage = null,
        $criteria = null,
        $order = null,
        $other = []
    ) {
        $this->params = array_merge($criteria,[
            'page'         => $page,
            'max_per_page' => $maxPerPage,
            'order'        => $order,
        ]);

        $this->params = array_merge($this->params, $other);
    }
}
