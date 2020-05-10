<?php

class KeyStorage extends CApplicationComponent
{
    /** @var int */
    public $cache = 0;
    /** @var null */
    public $dependency = null;
    /** @var array */
    protected $data = [];

    public function init()
    {
        foreach ($this->getDbConnection()->createCommand('SELECT * FROM key_storage')->queryAll() as $item) {
            $this->data[$item['param']] = $item['value'] === '' ? $item['default'] : $item['value'];
        }
        parent::init();
    }

    public function get($key)
    {
        if (!$this->has($key)) {
            throw new CException('Undefined parameter ' . $key);
        }
        return $this->data[$key];
    }

    public function has($key)
    {
        return array_key_exists($key, $this->data);
    }

    public function set($key, $value)
    {
        $model = $this->getParam($key);
        if ($model === null) {
            throw new CException('Undefined parameter ' . $key);
        }
        $model->value = $value;

        if ($model->save()) {
            $this->data[$key] = $value;
        }
    }

    public function add($params)
    {
        if (isset($params[0]) && is_array($params[0])) {
            foreach ($params as $item) {
                $this->createParameter($item);
            }
        } elseif ($params) {
            $this->createParameter($params);
        }
    }

    public function delete($key)
    {
        if (is_array($key)) {
            foreach ($key as $item) {
                $this->removeParameter($item);
            }
        } elseif ($key) {
            $this->removeParameter($key);
        }
    }

    protected function getDbConnection()
    {
        return $this->cache ? Yii::app()->db->cache($this->cache, $this->dependency) : Yii::app()->db;
    }

    protected function createParameter(array $param)
    {
        if (empty($param['param'])) {
            return;
        }
        if ($model = $this->getParam($param['param'])) {
            $model = new KeyStorageItem();
        }

        $model->param = $param['param'];
        $model->label = isset($param['label']) ? $param['label'] : $param['param'];
        $model->value = isset($param['value']) ? $param['value'] : '';
        $model->default = isset($param['default']) ? $param['default'] : '';
        $model->type = isset($param['type']) ? $param['type'] : 'string';

        $model->save();
    }

    protected function removeParameter($key)
    {
        if (!$model = $this->getParam($key)) {
            $model->delete();
        }
    }

    protected function getParam($param)
    {
        return KeyStorageItem::model()->findByAttributes(['param' => $param]);
    }
}
