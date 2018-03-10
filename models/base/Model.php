<?php

namespace app\models\base;


class Model
{
    protected $attributes;
    protected $tableName;

    protected function getAttributes()
    {
        return $this->attributes;
    }

    protected function setAttributes()
    {
        $attributes = array_flip($this->getAttributes());

        foreach ($attributes as $field => &$value) {
            $value = $this->$field;
        }

        $this->attributes = $attributes;
    }

    protected function getTableName()
    {
        return $this->tableName;
    }

    /**
     * @param $params
     */
    public function load($params)
    {
        $attributes = array_flip($this->getAttributes());
        if (is_array($params)) {
            foreach ($params as $key => $value) {
                if (isset($attributes[$key])) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function validate()
    {
        $attributes = $this->getAttributes();

        foreach ($attributes as $attribute) {
            if ($attribute === 'status') {
                $this->$attribute = (int)boolval($this->$attribute);
            } else {
                $this->$attribute = htmlspecialchars($this->$attribute);
            }
        }

        $this->setAttributes();
    }
}