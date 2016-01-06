<?php
namespace Survos\Client\Resource\Helper;

trait DeleteByIdHelper
{
    /**
     * @param int $id
     * @return bool
     */
    public function deleteById($id)
    {
        return $this->delete($id);
    }
}
