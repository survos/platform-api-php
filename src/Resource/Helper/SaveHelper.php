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
            return $this->put($data['id'], $data);
        } else {
            return $this->post($data);
        }
    }
}