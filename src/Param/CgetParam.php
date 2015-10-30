<?php

namespace Survos\Client\Param;

class CgetParam extends BaseParam
{
    public function __construct($page = null, $maxPerPage = null, $criteria = null, $criteriaCmp = null, $order = null)
    {
        $this->params = [
            'page' => $page,
            'max_per_page' => $maxPerPage,
            'criteria' => $criteria,
            'criteria_cmp' => $criteriaCmp,
            'order' => $order,
        ];
    }
}