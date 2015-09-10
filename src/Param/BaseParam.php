<?php
namespace Survos\Client\Param;

class BaseParam
{
    /** @var array */
    protected $params = [];

    /**
     * @param bool $filterNulls
     * @return array
     */
    public function getParams($filterNulls = true)
    {
        return $filterNulls ? array_filter($this->params) : $this->params;
    }

    /**
     * @param array $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

    /**
     * @param $param
     * @return string
     */
    public function getParam($param)
    {
        return $this->params[$param];
    }

    /**
     * @param string $params
     * @param string $value
     */
    public function setParam($params, $value)
    {
        $this->params[] = $value;
    }
}