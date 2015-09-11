<?php
namespace Survos\Client\Resource\Helper;

trait GetByIdHelper
{
    /**
     * @param $id
     * @return array
     */
    public function getById($id)
    {
        return $this->get($id);
    }
}