<?php
namespace Survos\Client\Resource\Helper;

trait GetByIdHelper
{
    /**
     * @param int $id
     * @return array|null
     */
    public function getById($id)
    {
        return $this->get($id);
    }
}
