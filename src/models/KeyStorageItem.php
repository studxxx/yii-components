<?php

/**
 * @property string $id
 * @property string $param
 * @property string $value
 * @property string $default
 * @property string $label
 * @property string $type
 */
class KeyStorageItem extends CActiveRecord
{
    /**
     * @inheritdoc
     */
    public function tableName()
    {
        return 'key_storage';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['param, value, default, label, type', 'required'],
            ['param, type', 'length', 'max' => 128],
            ['label', 'length', 'max' => 255],
            ['id, param, value, default, label, type', 'safe', 'on' => 'search'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'param' => 'Param',
            'value' => 'Value',
            'default' => 'Default',
            'label' => 'Label',
            'type' => 'Type',
        ];
    }

    /**
     * @return CActiveDataProvider
     */
    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('param', $this->param, true);
        $criteria->compare('value', $this->value, true);
        $criteria->compare('default', $this->default, true);
        $criteria->compare('label', $this->label, true);
        $criteria->compare('type', $this->type, true);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    /**
     * @param string $className
     * @return KeyStorageItem|CActiveRecord the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
