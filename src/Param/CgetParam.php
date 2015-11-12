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
        $criteriaCmp = null,
        $order = null,
        $other = []
    ) {
        $this->params = [
            'page'         => $page,
            'max_per_page' => $maxPerPage,
            'criteria'     => $criteria,
            'criteria_cmp' => $criteriaCmp,
            'order'        => $order,
        ];

        $this->params = array_merge($this->params, $other);
    }
}
