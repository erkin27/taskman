<?php

//namespace app\models\sort;


class Sort
{
    const DESC = 'desc';
    const ASC = 'asc';

    public $params = [];

    public function setParams($params = [])
    {
        $this->params = $params;
    }

    public function getOrderBy($name)
    {
        $param = trim($name, '-');

        if (isset($this->params[$param][$name])){
            $sql = "ORDER BY " . strip_tags($param) . " " . $this->params[$param][$name];
            unset($this->params[$param][$name]);

            return $sql;
        }
        return '';
    }
}