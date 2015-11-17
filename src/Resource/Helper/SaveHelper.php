<?php

namespace Survos\Client\Resource\Helper;

trait SaveHelper
{
    /**
     * @param array $data
     * @return array
     */
    public function save(array $data)
    {
        if (isset($data['id'])) {
            $id = $data['id'];
            unset($data['id']);
            return $this->patch($id, $data);
        } else {
            return $this->post($data);
        }
    }
}
